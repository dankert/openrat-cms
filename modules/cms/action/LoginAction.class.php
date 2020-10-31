<?php

namespace cms\action;


use cms\auth\Auth;
use cms\base\Configuration;
use cms\base\DB;
use cms\base\Startup;
use cms\model\User;
use cms\model\Group;


use configuration\Config;
use Exception;
use http\Env\Request;
use openid_connect\OpenIDConnectClient;
use util\FileUtils;
use util\Http;
use cms\auth\InternalAuth;
use logger\Logger;
use \util\exception\ObjectNotFoundException;
use util\exception\UIException;
use \security\Password;
use util\Session;
use util\Mail;
use util\Text;
use util\text\TextMessage;


// OpenRat Content Management System
// Copyright (C) 2002-2007 Jan Dankert, jandankert@jandankert.de
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; version 2.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.


/**
 * Action-Klasse fuer die Start-Action
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */

class LoginAction extends BaseAction
{
	public $security = Action::SECURITY_GUEST;


	public function __construct()
    {
        parent::__construct();
    }



    /**
     * Führt ein Login durch.
     * @param $name string Benutzername
     * @param $pw string Password
     * @param $pw1 string new Password
     * @param $pw2 string new Password repeated
     * @return bool
     * @throws ObjectNotFoundException
     */
    private function checkLogin($name, $pw, $pw1, $pw2 )
	{
		Logger::debug( "Login user: '$name'.'" );
	
		$conf = Configuration::rawConfig();

		Session::setUser(null);
	
		
		$db = \cms\base\DB::get();
		
		if	( !is_object($db) )
		{
			$this->addNotice('database', 0, '', 'DATABASE_CONNECTION_ERROR', Action::NOTICE_ERROR, array(), array('no connection'));
			//$this->callSubAction('showlogin');
			return false;
		}
		
		if	( !$db->available )
		{
			$this->addNotice('database', 0, $db->conf['description'], 'DATABASE_CONNECTION_ERROR', Action::NOTICE_ERROR, array(), array('Database Error: ' . $db->error));
			//$this->callSubAction('showlogin');
			return false;
		}
		
		$ip = getenv("REMOTE_ADDR");
	
		$user = new User();
		$user->name = $name;
		
		$ok = $user->checkPassword( $pw );
		
		$mustChangePassword = $user->mustChangePassword;
		
		if	( $mustChangePassword )
		{
			// Der Benutzer hat zwar ein richtiges Kennwort eingegeben, aber dieses ist abgelaufen.
			// Wir versuchen hier, das neue zu setzen (sofern eingegeben).
			if	( empty($pw1) )
			{
			}
			elseif	( $pw1 != $pw2 )
			{
				$this->addValidationError('password1','PASSWORDS_DO_NOT_MATCH');
				$this->addValidationError('password2','');
			}
			elseif	( strlen($pw2) < $conf['security']['password']['min_length'] )
			{
				$this->addValidationError('password1','PASSWORD_MINLENGTH',array('minlength'=>$conf['security']['password']['min_length']));
				$this->addValidationError('password2','');
			}
			else
			{
				// Kennw?rter identisch und lang genug.
				$user->setPassword( $pw1,true );
				
				// Das neue Kennwort ist gesetzt, die Anmeldung ist also doch noch gelungen. 
				$ok = true;
				$mustChangePassword = false;
				
				$pw = $pw1;
			}
		}
		
		// Falls Login erfolgreich
		if  ( $ok )
		{
			// Login war erfolgreich!
			$user->load();
			$user->setCurrent();
			
			if ($user->passwordAlgo != Password::bestAlgoAvailable() )
    			// Re-Hash the password with a better hash algo.
			    $user->setPassword($pw);
			
			
			Logger::info( "login successful for {$user->name} from IP $ip" );

			return true;
		}
		else
		{
			Logger::info( TextMessage::create('login failed for user ${name} from IP ${ip}',
				[
					'name' => $user->name,
					'ip'   => $ip
				]
			) );

			return false;
		}
	}


	public function oidcView() {

    	if   ( $this->hasRequestVar("id")) {
			$providerName = $this->request->getRequestVar('id',RequestParams::FILTER_ALPHANUM);
			Session::set(Session::KEY_OIDC_PROVIDER,$providerName);
		}else {
			$providerName = Session::get( Session::KEY_OIDC_PROVIDER);
		}


    	$providerConfig = Configuration::subset(['security','oidc','provider',$providerName]);

    	$oidc = new OpenIDConnectClient();
    	$oidc->setProviderURL ( $providerConfig->get('url'          ));
    	$oidc->setIssuer      ( $providerConfig->get('url'          ));
    	$oidc->setClientID    ( $providerConfig->get('client_id'    ));
    	$oidc->setClientSecret( $providerConfig->get('client_secret'));

    	try {
			$oidc->authenticate();
			$subjectIdentifier = $oidc->requestUserInfo('sub');

			$user = User::loadWithName( $subjectIdentifier,User::AUTH_TYPE_OIDC,$providerName );

			if   ( ! $user ) {
				// Create user
				$user = new User();
				$user->name   = $subjectIdentifier;
				$user->type   = User::AUTH_TYPE_OIDC;
				$user->issuer = $providerName;
				$user->add();

			}

			Session::setUser( $user );

		} catch( Exception $e) {
    		throw new \RuntimeException('OpenId-Connect authentication failed',0,$e);
		}

    	header( 'Location: ./');
	}



    /**
     * Anzeigen der Loginmaske.
     *
     * Es wird nur die Loginmaske angezeigt.
     * @throws UIException
     */
    function loginView()
    {
        $conf = Configuration::rawConfig();

        $sso = $conf['security']['sso'];
        $ssl = $conf['security']['ssl'];

        $ssl_trust    = false;
        $ssl_user_var = '';
        extract( $ssl, EXTR_PREFIX_ALL, 'ssl' );

        $oidcList = [];

        $authenticateConfig  = Configuration::subset('authenticate');
        $authenticateEnabled = $authenticateConfig->is('enable',true);



        $oidcConfig = Configuration::subset(['security','oidc']);

        if   ( $oidcConfig->is('enabled',true) ) {
        	foreach ( $oidcConfig->subset('provider')->subsets() as $name=>$providerConfig ) {
        		if   ( $providerConfig->is('enabled',true)) {
        			$oidcList[ $name ] = $providerConfig->get('label',$name );
				}
			}
		}

        $this->setTemplateVar('enableUserPasswordLogin',$authenticateEnabled);
        $this->setTemplateVar('enableOpenIdConnect'    ,(boolean)$oidcList  );
        $this->setTemplateVar('provider'               ,$oidcList           );

        if	( $sso['enable'] )
        {
            $authid = $this->getRequestVar( $sso['auth_param_name']);

            if	( empty( $authid) )
                throw new \util\exception\SecurityException( 'no authorization data (no auth-id)');

            if	( $sso['auth_param_serialized'] )
                $authid = unserialize( $authid );

            $purl = parse_url($sso['url']);
            // Verbindung zu URL herstellen.
            $errno=0; $errstr='';
            $fp = fsockopen ($purl['host'],80, $errno, $errstr, 30);
            if	( !$fp )
            {
                echo "Connection failed: $errstr ($errno)";
            }
            else
            {
                $http_get = $purl['path'];
                if	( !empty($purl['query']) )
                    $http_get .= '?'.$purl['query'];

                $header = array();

                $header[] = "GET $http_get HTTP/1.0";
                $header[]  ="Host: ".$purl['host'];
                $header[] = "User-Agent: Mozilla/5.0 (OpenRat CMS Single Sign-on Check)";
                $header[] = "Connection: Close";

                if	( $sso['cookie'] )
                {
                    $cookie = 'Cookie: ';
                    if	( is_array($authid))
                        foreach( $authid as $cookiename=>$cookievalue)
                            $cookie .= $cookiename.'='.$cookievalue."; ";
                    else
                        $cookie .= $sso['cookie_name'].'='.$authid;

                    $header[] = $cookie;
                }

                fputs ($fp, implode("\r\n",$header)."\r\n\r\n");

                $inhalt=array();
                while (!feof($fp)) {
                    $inhalt[] = fgets($fp,128);
                }
                fclose($fp);

                $html = implode('',$inhalt);
                if	( !preg_match($sso['expect_regexp'],$html) )
                    throw new \util\exception\SecurityException('auth failed');
                $treffer=0;
                if	( !preg_match($sso['username_regexp'],$html,$treffer) )
                    throw new \util\exception\SecurityException('auth failed');
                if	( !isset($treffer[1]) )
                    throw new \util\exception\SecurityException('authorization failed');

                $username = $treffer[1];

                $user = User::loadWithName( $username,User::AUTH_TYPE_INTERNAL );

                if	( ! $user->isValid( ))
                    throw new \util\exception\SecurityException('authorization failed: user not found: '.$username);

                $user->setCurrent();

                $this->callSubAction('show');
            }
        }

        elseif	( $ssl_trust )
        {
            if	( empty($ssl_user_var) )
                throw new \LogicException( 'please set environment variable name in ssl-configuration.' );

            $username = getenv( $ssl_user_var );

            if	( empty($username) )
                throw new \util\exception\SecurityException( 'no username in client certificate ('.$ssl_user_var.') (or there is no client certificate...?)' );

            $user = User::loadWithName( $username,User::AUTH_TYPE_INTERNAL );

            if	( !$user->isValid() )
                throw new \LogicException( 'unknown username: '.$username );

            $user->setCurrent();

            $this->callSubAction('show');
        }

        $databases = Configuration::subset('database')->subsets();

        // Filter all enabled databases
        $databases = array_filter( $databases, function($dbConfig) {
        	$dbConfig->is('enabled',true);
		});

        $dbids = [];
        foreach( $databases as $dbid => $dbconf )
        {
        	// Getting the first not-null information about the connection.
	        $dbids[ $dbid ] =  array_filter( array(
	        	$dbconf->get('description'),
				$dbconf->get('name'),
				$dbconf->get('host'),
				$dbconf->get('driver'),
				$dbid))[0];
        }


        if	( empty($dbids) )
            $this->addNotice('', 0, '', 'no_database_configuration', Action::NOTICE_WARN);

        if	( !isset($this->templateVars['login_name']) && isset($_COOKIE['or_username']) )
            $this->setTemplateVar('login_name',$_COOKIE['or_username']);

        if	( !isset($this->templateVars['login_name']) )
            $this->setTemplateVar('login_name',@$conf['security']['default']['username']);

        if	( @$this->templateVars['login_name']== @$conf['security']['default']['username'])
            $this->setTemplateVar('login_password',@$conf['security']['default']['password']);

        $this->setTemplateVar( 'dbids',$dbids );

        // Database was already connected in the Dispatcher. So we MUST have a db connection here.
        $db = Session::getDatabase();
        $this->setTemplateVar('dbid',$db->id);


        // Den Benutzernamen aus dem Client-Zertifikat lesen und in die Loginmaske eintragen.
        $ssl_user_var = $conf['security']['ssl']['client_cert_dn_env'];
        if	( !empty($ssl_user_var) )
        {
            $username = getenv( $ssl_user_var );

            if	( empty($username) )
            {
                // Nothing to do.
                // if user has no valid client cert he could not access this form.
            }
            else {

                // Benutzername ist in Eingabemaske unver�nderlich
                $this->setTemplateVar('force_username',true);
                $this->setTemplateVar('login_name'    ,$username);
            }

        }

        $this->setTemplateVar('register'     ,$conf['login'   ]['register' ]);
        $this->setTemplateVar('send_password',$conf['login'   ]['send_password']);

        // Versuchen, einen Benutzernamen zu ermitteln, der im Eingabeformular vorausgewählt wird.
        $modules = $conf['security']['preselect']['modules'];

        $username = '';
        foreach( $modules as $module)
        {
            Logger::debug('Preselecting module: '.$module);
            $moduleClass = Auth::NS.'\\'.$module.'Auth';
            /** @var \cms\auth\Auth $auth */
            $auth = new $moduleClass;
            $username = $auth->username();

            if	( !empty($username) )
            {
                Logger::debug('Preselecting User '.$username);
                break; // Benutzername gefunden.
            }
        }

        $this->setTemplateVar('login_name',$username);
    }


	/**
	 * get all enabled databases.
	 * @return Config[]
	 */
    protected function getAllEnabledDatabases() {

		return array_filter( Configuration::subset('database')->subsets(), function($dbConfig) {
			$dbConfig->is('enabled',true);
		});

	}


	/**
	 * Gets a list of all databases.
	 * @return string[] list of databases.
	 */
	protected function getSelectableDatabases() {

		return array_map( function($dbconf) {
			// Getting the first not-null information about the connection.
			return array_filter( array(
				$dbconf->get('description'),
				$dbconf->get('name'  ),
				$dbconf->get('host'  ),
				$dbconf->get('driver'),
				$dbconf->get('type'  ),
				'unknown'))[0];

		}, $this->getAllEnabledDatabases() );

	}





	/**
	 * Erzeugt eine Anwendungsliste.
     * TODO: unused at the moment
	 */
	function applications()
	{
		$conf = Configuration::rawConfig();
		
		// Diese Seite gilt pro Sitzung. 
		$user       = Session::getUser();
		$userGroups = $user->getGroups();
		$this->lastModified( $user->loginDate );

		// Applikationen ermitteln
		$list = array();
		foreach( $conf['applications'] as $id=>$app )
		{
			if	( !is_array($app) )
				continue;
				
			if	( isset($app['group']) )
				if	( !in_array($app['group'],$userGroups) )
					continue; // Keine Berechtigung, da Benutzer nicht in Gruppe vorhanden.
					
			$p = array();
			$p['url']         = $app['url'];
			$p['description'] = @$app['description'];
			if	( isset($app['param']) )
			{
				$p['url'] .= strpos($p['url'],'?')!==false?'&':'?';
				$p['url'] .= $app['param'].'='.session_id();
			}
			$p['name'] = $app['name'];
			
			$list[] = $p;
		}


		$this->setTemplateVar('applications',$list);
	}

	

	/**
	 * Login.
	 * Zuerst wird die Datenbankverbindung aufgebaut und falls notwendig, aktualisiert.
	 */
	function loginPost()
	{
		$conf = Configuration::rawConfig();

		Session::setUser(''); // Altes Login entfernen.
		
		if	( $conf['login']['nologin'] )
			throw new \util\exception\SecurityException('login disabled');

		$loginName     = $this->getRequestVar('login_name'    ,RequestParams::FILTER_ALPHANUM);
		$loginPassword = $this->getRequestVar('login_password',RequestParams::FILTER_ALPHANUM);
		$newPassword1  = $this->getRequestVar('password1'     ,RequestParams::FILTER_ALPHANUM);
		$newPassword2  = $this->getRequestVar('password2'     ,RequestParams::FILTER_ALPHANUM);
		$token         = $this->getRequestVar('user_token'    ,RequestParams::FILTER_ALPHANUM);

		// Der Benutzer hat zwar ein richtiges Kennwort eingegeben, aber dieses ist abgelaufen.
		// Wir versuchen hier, das neue zu setzen (sofern eingegeben).
		if	( empty($newPassword1) )
		{
			// Kein neues Kennwort,
			// nichts zu tun...
		}
		else
		{
			$auth = new InternalAuth();
			
			if	( $auth->login($loginName, $loginPassword,$token) || $auth->mustChangePassword )
			{
				if	( $newPassword1 != $newPassword2 )
				{
					$this->addValidationError('password1','PASSWORDS_DO_NOT_MATCH');
					$this->addValidationError('password2','');
					return;
				}
				elseif	( strlen($newPassword1) < $conf['security']['password']['min_length'] )
				{
					$this->addValidationError('password1','PASSWORD_MINLENGTH',array('minlength'=>$conf['security']['password']['min_length']));
					$this->addValidationError('password2','');
					return;
				}
				else
				{
					// Kennwoerter identisch und lang genug.
					$user = User::loadWithName($loginName,User::AUTH_TYPE_INTERNAL);
					$user->setPassword( $newPassword1,true );
					
					// Das neue gesetzte Kennwort für die weitere Authentifizierung benutzen.
					$loginPassword = $newPassword1;
				}
			}
			else
			{
				// Anmeldung gescheitert.
				$this->addNotice('user', 0, $loginName, 'LOGIN_FAILED', 'error', array('name' => $loginName));
				$this->addValidationError('login_name'    ,'');
				$this->addValidationError('login_password','');
				return;
			}
		}
		
		// Cookie setzen
		$this->setCookie('or_username',$loginName );
		$this->setCookie('or_dbid'    ,$this->getRequestVar('dbid'));

		// Authentifizierungs-Module.
		$modules = $conf['security']['authenticate']['modules'];
		
		$loginOk            = false;
		$mustChangePassword = false;
		$tokenFailed        = false;
		$lastModule         = null;
		
		// Jedes Authentifizierungsmodul durchlaufen, bis ein Login erfolgreich ist.
		foreach( $modules as $module)
		{
            $moduleClass = Auth::NS.'\\' . $module . 'Auth';
			$auth        = new $moduleClass;
			Logger::info('Trying to login with module '.$moduleClass);
			$loginStatus = $auth->login( $loginName,$loginPassword, $token );
			$loginOk     = $loginStatus === true || $loginStatus === Auth::STATUS_SUCCESS;
			
			if   ( $loginStatus === Auth::STATUS_PW_EXPIRED )
				$mustChangePassword = true;
			if   ( $loginStatus === Auth::STATUS_TOKEN_NEEDED )
				$tokenFailed = true;
				
			if	( $loginOk )
			{
				Logger::info('Login successful for '.$loginName);
				$lastModule = $module;
				
				break; // Login erfolgreich, erstes Modul gewinnt.
			}
		}
		
		/*
		$loginOk = $this->checkLogin( $loginName,
		                              $loginPassword,
		                              $newPassword1,
		                              $newPassword2 );
		*/
		
		
		if	( $loginOk )
		{
			
			try
			{
				// Benutzer über den Benutzernamen laden.
				$user = User::loadWithName($loginName,User::AUTH_TYPE_INTERNAL,null);
                $user->setCurrent();
                $user->updateLoginTimestamp();

                if ($user->passwordAlgo != Password::bestAlgoAvailable() )
                    // Re-Hash the password with a better hash algo.
                    $user->setPassword($loginPassword);
                
			}
			catch( ObjectNotFoundException $ex )
			{
				// Benutzer wurde zwar authentifiziert, ist aber in der
				// internen Datenbank nicht vorhanden
				if	( $conf['security']['newuser']['autoadd'] )
				{
					// Neue Benutzer in die interne Datenbank uebernehmen.
					$user = new User();
					$user->name     = $loginName;
					$user->fullname = $loginName;
					$user->add();
					$user->save();
				}
				else
				{
	 				// Benutzer soll nicht angelegt werden.
					// Daher ist die Anmeldung hier gescheitert.
					$loginOk = false;
				}				
			}			
		}
		
		Password::delay();
		
	    $ip = getenv("REMOTE_ADDR");
		
		if	( !$loginOk )
		{
			// Anmeldung nicht erfolgreich
			
			Logger::debug( TextMessage::create('login failed for user ${name} from IP ${ip}',
				[
					'name' => $loginName,
					'ip'   => $ip
				]
			) );

			if	( $tokenFailed )
			{
				// Token falsch.
				$this->addNotice('user', 0, $loginName, 'LOGIN_FAILED_TOKEN_FAILED', 'error');
				$this->addValidationError('user_token','');
			}
			elseif	( $mustChangePassword )
			{
				// Anmeldung gescheitert, Benutzer muss Kennwort ?ndern.
				$this->addNotice('user', 0, $loginName, 'LOGIN_FAILED_MUSTCHANGEPASSWORD', 'error');
				$this->addValidationError('password1','');
				$this->addValidationError('password2','');
			}
			else
			{
				// Anmeldung gescheitert.
				$this->addNotice('user', 0, $loginName, 'LOGIN_FAILED', 'error', array('name' => $loginName));
				$this->addValidationError('login_name'    ,'');
				$this->addValidationError('login_password','');
			}

			return;
		}
		else
		{
		    
			Logger::debug("Login successful for user '$loginName' from IP $ip");

			if	( $this->hasRequestVar('remember') )
			{
				// Cookie setzen
				$this->setCookie('or_username',$user->name         );
                $this->setCookie('or_token'   ,$user->createNewLoginToken() );
			}
				
			// Anmeldung erfolgreich.
            if	( Configuration::config()->subset('security')->is('renew_session_login',false) )
				$this->recreateSession();
			
			$this->addNotice('user', 0, $user->name, 'LOGIN_OK', Action::NOTICE_OK, array('name' => $user->fullname));
			
            $config = Session::getConfig();
            $language = new \language\Language();
            $config['language'] = $language->getLanguage($user->language);
            $config['language']['language_code'] = $user->language;
            Session::setConfig( $config );
		}
		
	}


	/**
	 * Benutzer meldet sich ab.
	 */
	public function logoutPost()
	{
		$conf = Configuration::rawConfig();
		
		$user = Session::getUser();
		if	( is_object($user) )
			$this->setTemplateVar('login_username',$user->name);
		
		if	( Configuration::config()->subset('security')->is('renew_session_logout',false) )
			$this->recreateSession();

		if	( @$conf['theme']['compiler']['compile_at_logout'] )
		{
			foreach( $conf['action'] as $actionName => $actionConfig )
			{
				foreach( $actionConfig as $subActionName=>$subaction )
				{
					if	( is_array($subaction) &&
						  !isset($subaction['goto'  ]) && 
						  !isset($subaction['direct']) &&
						  !isset($subaction['action']) &&
						  !isset($subaction['async' ]) &&
						  !isset($subaction['alias' ]) &&
						  $subActionName != 'menu'            )
					{
						$engine = new template_engine\TemplateEngine();
						$engine->compile( strtolower(str_replace('Action','',$actionName)).'/'.$subActionName);
					}
				}
			}
		}
		
		// Login-Token löschen:
		// Wenn der Benutzer sich abmelden will, dann soll auch die automatische
		// Anmeldung deaktiviert werden.

        // Bestehendes Login-Token aus dem Cookie lesen und aus der Datenbank löschen.
        list( $selector,$token ) = array_pad( explode('.',@$_COOKIE['or_token']),2,'');

		if   ( $selector )
		    $this->currentUser->deleteLoginToken( $selector );

		// Cookie mit Logintoken löschen.
        $this->setCookie('or_token'   ,null );

        //session_unset();
        Session::setUser(null);

        $this->addNotice('user', 0, $user->name, 'LOGOUT_OK', Action::NOTICE_OK);

    }

	
	
	/**
	 * Benutzer meldet sich ab.
	 */
	function logoutView()
	{
	}
	

	/**
	 * Ausgeben von maschinenlesbaren Benutzerinformationen.
	 * 
	 * Diese Funktion dient dem Single-Signon f?r fremde Anwendungen, welche
	 * die Benutzerinformationen des angemeldeten Benutzers aus dieser
	 * Anwendung auslesen k?nnen.
	 */
	function userinfoView()
	{
		$user = Session::getUser();

		$info = array('username'   => $user->name,
		              'fullname'   => $user->fullname,
		              'mail'       => $user->mail,
		              'telephone'  => $user->tel,
		              'style'      => $user->style,
		              'admin'      => $user->isAdmin,
		              'groups'     => implode(',',$user->getGroups()),
		              'description'=> $user->desc
		             );
		        
		$this->setTemplateVar('userinfo',$info);
	}
	
	
	function switchuser()
	{
		$user = Session::getUser();
		
		if	( ! $user->isAdmin )
			throw new \util\exception\SecurityException("Switching the user is only possible for admins.");
		
		$this->recreateSession();
		
		$newUser = new User( $this->getRequestId() );
		$newUser->load();
		
		$newUser->setCurrent();
	}
	
	
	function show()
	{
		$conf = Configuration::rawConfig();

		$user = Session::getUser();
		// Gast-Login
		if   ( ! is_object($user) )
		{
			if	( $conf['security']['guest']['enable'] )
			{
				$username = $conf['security']['guest']['user'];
				$user = User::loadWithName($username,User::AUTH_TYPE_INTERNAL);
				if	( $user->userid > 0 )
					$user->setCurrent();
				else
				{
					Logger::warn('Guest login failed, user not found: '.$username);
					$this->addNotice('user', 0, $username, 'LOGIN_FAILED', Action::NOTICE_WARN, array('name' => $username));
					$user = null;
				}
			}
		}
		
		if   ( ! is_object($user) )
		{
			switch( $conf['security']['login']['type'] )
			{
					
				// Authorization ueber HTTP
				//
				case 'http':
					$ok = false;
		
				    if	( isset($_SERVER['PHP_AUTH_USER']) )
				    {
						$ok = $this->checkLogin( $_SERVER['PHP_AUTH_USER'],$_SERVER['PHP_AUTH_PW'] );
				    }
				    
					if	( ! $ok )
					{
						header( 'WWW-Authenticate: Basic realm="'.Startup::TITLE.' - '.\cms\base\Language::lang('HTTP_REALM').'"' );
						header( 'HTTP/1.0 401 Unauthorized' );
						echo 'Authorization Required!';
						exit;
					}
					break;
					
				case 'form':
					// Benutzer ist nicht angemeldet
					$this->callSubAction( 'showlogin' ); // Anzeigen der Login-Maske
					return;
					break;
					
				default:
					throw new \LogicException('Unknown auth-type: '.$conf['security']['login']['type'].'. Please check the configuration setting /security/login/type' );
			}
		}
		
		if	( $user->mustChangePassword ) 
		{
			$this->addNotice('user', 0, $user->name, 'PASSWORD_TIMEOUT', 'warn');
			$this->callSubAction( 'changepassword' ); // Zwang, das Kennwort zu ?ndern.
		}

		// Seite ?ndert sich nur 1x pro Session
		$this->lastModified( $user->loginDate );

	}



	/**
	 * Maske anzeigen, um Benutzer zu registrieren.
	 */
	public function registerView()
	{
		
	}

	
	/**
	 * Registriercode erzeugen und per E-Mail dem Benutzer mitteilen.
	 * Maske anzeigen, damit Benuter Registriercode anzeigen kann.
	 */
	public function registercodeView()
	{
		$conf = Configuration::rawConfig();
		foreach( $conf['database'] as $dbname=>$dbconf )
		{
			if	( is_array($dbconf) && $dbconf['enabled'] )
				$dbids[$dbname] = $dbconf['description'];
		}

		$this->setTemplateVar( 'dbids',$dbids );
		
		$db = DB::get();
		if	( is_object($db) )
			$this->setTemplateVar('actdbid',$db->id);
		else
			$this->setTemplateVar('actdbid',$conf['database-defaults']['default-id']);
		
		
		
	}

	
	
	public function registerPost()
	{
		$conf = Configuration::rawConfig();

		Session::set('registerMail',$this->getRequestVar('mail') );
		
			srand ((double)microtime()*1000003);
		$registerCode = rand();
		
		Session::set('registerCode',$registerCode                );

		$email_address = $this->getRequestVar('mail',RequestParams::FILTER_MAIL);
		
		if	( ! Mail::checkAddress($email_address) )
		{
			$this->addValidationError('mail');
			return;
		}
		
		// E-Mail and die eingegebene Adresse verschicken
		$mail = new Mail($email_address,
		                 'register_commit_code');
		$mail->setVar('code',$registerCode); // Registrierungscode als Text-Variable
		
		if	( $mail->send() )
		{
			$this->addNotice('', 0, '', 'mail_sent', Action::NOTICE_OK);
		}
		else
		{
			$this->addNotice('', 0, '', 'mail_not_sent', Action::NOTICE_ERROR, array(), $mail->error);
			return;
		}
	}

	
	/**
	 * Benutzerregistierung.
	 * Benutzer hat Best?tigungscode erhalten und eingegeben.
	 */
	function registercodePost()
	{
		$conf = Configuration::rawConfig();

		$origRegisterCode  = Session::get('registerCode');
		$inputRegisterCode = $this->getRequestVar('code');
		
		if	( $origRegisterCode != $inputRegisterCode )
		{
			// Best?tigungscode stimmt nicht.
			$this->addValidationError('code','code_not_match');
			return;
		}

		// Best?tigungscode stimmt ?berein.
		// Neuen Benutzer anlegen.
			
		if	( !$this->hasRequestVar('username') )
		{
			$this->addValidationError('username');
			return;
		}
		
		$user = User::loadWithName( $this->getRequestVar('username'),User::AUTH_TYPE_INTERNAL );
		if	( $user->isValid() )
		{
			$this->addValidationError('username','USER_ALREADY_IN_DATABASE');
			return;
		}
		
		if	( strlen($this->getRequestVar('password')) < $conf['security']['password']['min_length'] )
		{
			$this->addValidationError('password','password_minlength',array('minlength'=>$conf['security']['password']['min_length']));
			return;
		}
		
		$newUser = new User();
		$newUser->name = $this->getRequestVar('username');
		$newUser->add();
			
		$newUser->mail     = Session::get('registerMail');
		$newUser->save();
			
		$newUser->setPassword( $this->getRequestVar('password'),true );
			
		$this->addNotice('user', 0, $newUser->name, 'user_added', 'ok');
	}



	/**
	 * Vergessenes Kennwort zusenden lassen.
	 */
	function passwordView()
	{
		// TODO: Attribut "Password" abfragen

		$this->setTemplateVar( 'dbids',$this->getSelectableDatabases() );
		
		$db = DB::get();
		
		if	( is_object($db) )
			$this->setTemplateVar('actdbid',$db->id);
		else
			$this->setTemplateVar('actdbid', Configuration::config('database-default','default-id'));
	}	
	
	

	/**
	 * Einen Kennwort-Anforderungscode an den Benutzer senden.
	 */
	function passwordPost()
	{
		if	( !$this->hasRequestVar('username') )
		{
			$this->addValidationError('username');
			return;
		}
		
		$user = User::loadWithName( $this->getRequestVar("username"),User::AUTH_TYPE_INTERNAL );
		//		Html::debug($user);
		Password::delay();
		if	( $user->isValid() )
		{
			srand ((double)microtime()*1000003);
			$code = rand();
			$this->setSessionVar("password_commit_code",$code);
			
			$eMail = new Mail( $user->mail,'password_commit_code' );
			$eMail->setVar('name',$user->getName());
			$eMail->setVar('code',$code);
			if	( $eMail->send() )
				$this->addNotice('user', 0, $user->getName(), 'mail_sent', Action::NOTICE_OK);
			else
				$this->addNotice('user', 0, $user->getName(), 'mail_not_sent', Action::NOTICE_ERROR, array(), $eMail->error);
			
		}
		else
		{
			//$this->addNotice('','user','username_not_found');
			// Trotzdem vort?uschen, eine E-Mail zu senden, damit die G?ltigkeit
			// eines Benutzernamens nicht von au?en gepr?ft werden kann.
			// 
			$this->addNotice('user', 0, $this->getRequestVar("username"), 'mail_sent');

		}
		
		$this->setSessionVar("password_commit_name",$user->name);
	}

	
	
	/**
	 * Anzeige Formular zum Eingeben des Kennwort-Codes.
	 *
	 */
	function passwordcodeView()
	{
		
	}
	
	
	/**
	 * Neues Kennwort erzeugen und dem Benutzer zusenden.
	 */
	function passwordcodePost()
	{
		$username = $this->getSessionVar("password_commit_name");

		if	( $this->getRequestVar("code")=='' ||
			  $this->getSessionVar("password_commit_code") != $this->getRequestVar("code") )
		{
			$this->addValidationError('code','PASSWORDCODE_NOT_MATCH');
		  	return;
		}
		
		$user  = User::loadWithName( $username,User::AUTH_TYPE_INTERNAL );
			
		if	( !$user->isValid() )
		{
			// Benutzer konnte nicht geladen werden.
			$this->addNotice('user', 0, $username, 'error', Action::NOTICE_ERROR);
			return;
		}
		
		$newPw = User::createPassword(); // Neues Kennwort erzeugen.
		
		$eMail = new Mail( $user->mail,'password_new' );
		$eMail->setVar('name'    ,$user->getName());
		$eMail->setVar('password',$newPw          );

		if	( $eMail->send() )
		{
			$user->setPassword( $newPw, false ); // Kennwort muss beim n?. Login ge?ndert werden.
			$this->addNotice('user', 0, $username, 'mail_sent', Action::NOTICE_OK);
		}
		else
		{
			// Sollte eigentlich nicht vorkommen, da der Benutzer ja auch schon den
			// Code per E-Mail erhalten hat.
			$this->addNotice('user', 0, $username, 'error', Action::NOTICE_ERROR, array(), $eMail->error);
		}
	}
	

	/**
	 * Erzeugt eine neue Sitzung.
	 */
	function recreateSession()
	{
		
        session_regenerate_id(true);
	}
	
	
	function licenseView()
	{
		$software = array();
		
		$software[] = array('name'   =>'OpenRat Content Management System',
		                    'url'    =>'http://www.openrat.de/',
		                    'license'=>'GPL v2');
		$software[] = array('name'   =>'jQuery Core Javascript Framework',
		                    'url'    =>'http://jquery.com/',
		                    'license'=>'MPL, GPL v2');
		$software[] = array('name'   =>'jQuery UI Javascript Framework',
		                    'url'    =>'http://jqueryui.com/',
		                    'license'=>'MPL, GPL v2');
		$software[] = array('name'   =>'GeSHi - Generic Syntax Highlighter',
		                    'url'    =>'http://qbnz.com/highlighter/',
		                    'license'=>'GPL v2');
		$software[] = array('name'   =>'TAR file format',
		                    'url'    =>'http://www.phpclasses.org/package/529',
		                    'license'=>'LGPL');
		$software[] = array('name'   =>'JSON file format',
		                    'url'    =>'http://pear.php.net/pepr/pepr-proposal-show.php?id=198',
		                    'license'=>'BSD');
		
		$this->setTemplateVar('software',$software);



        $this->setTemplateVar('time'     ,date('r')     );
        $this->setTemplateVar('os'       ,php_uname('s') );
        $this->setTemplateVar('release'  ,php_uname('r') );
        $this->setTemplateVar('machine'  ,php_uname('m') );
        $this->setTemplateVar('version' , phpversion()          );

        $this->setTemplateVar('cms_name'    , Configuration::Conf()->subset('application')->get('name'    ) );
        $this->setTemplateVar('cms_version' , Configuration::Conf()->subset('application')->get('version' ) );
        $this->setTemplateVar('cms_operator', Configuration::Conf()->subset('application')->get('operator') );

        $user = Session::getUser();
        if   ( !empty($user) )
        {
            $this->setTemplateVar('user_login'   , $user->loginDate );
            $this->setTemplateVar('user_name'    , $user->name      );
            $this->setTemplateVar('user_fullname', $user->fullname  );
        }

    }

}


