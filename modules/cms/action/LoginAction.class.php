<?php

namespace cms\action;


use cms\auth\Auth;
use cms\base\DB;
use cms\model\User;
use cms\model\Group;


use util\Http;
use cms\auth\InternalAuth;
use logger\Logger;
use \ObjectNotFoundException;
use util\exception\UIException;
use \security\Password;
use util\Session;
use util\Mail;
use util\Text;


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


define('PROJECTID_ADMIN',-1);

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
	
		global $conf;
		global $SESS;
	
		unset( $SESS['user'] );	
	
		
		$db = \cms\base\DB::get();
		
		if	( !is_object($db) )
		{
			$this->addNotice('database','','DATABASE_CONNECTION_ERROR',OR_NOTICE_ERROR,array(),array('no connection'));
			//$this->callSubAction('showlogin');
			return false;
		}
		
		if	( !$db->available )
		{
			$this->addNotice('database',$db->conf['description'],'DATABASE_CONNECTION_ERROR',OR_NOTICE_ERROR,array(),array('Database Error: '.$db->error));
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
			Logger::info( "login failed for user ".Logger::sanitizeInput($user->name)." from IP $ip" );

			return false;
		}
	}


    /**
     * Anzeigen der Loginmaske.
     *
     * Es wird nur die Loginmaske angezeigt.
     * @throws UIException
     */
    function loginView()
    {
        // Hier nie "304 not modified" setzen, da sonst keine
        // Login-Fehlermeldung erscheinen kann.
        global $conf;

        $sso = $conf['security']['sso'];
        $ssl = $conf['security']['ssl'];

        $ssl_trust    = false;
        $ssl_user_var = '';
        extract( $ssl, EXTR_PREFIX_ALL, 'ssl' );

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

                $user = User::loadWithName( $username );

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

            $user = User::loadWithName( $username );

            if	( !$user->isValid() )
                throw new \LogicException( 'unknown username: '.$username );

            $user->setCurrent();

            $this->callSubAction('show');
        }

        $dbids = array();

        $databases = Conf()->get('database');

        if   ( !is_array($databases))
            throw new \LogicException("Corrupt configuration: Databases configuration must be an array.");


        foreach( $databases as $dbid => $dbconf )
        {
            if   ( !is_array($dbconf))
                throw new \LogicException("Corrup configuration: Database configuration '".$dbid."' must be an array.'");

            $dbconf += $conf['database-default']['defaults']; // Add Default-Values

            if	( is_array($dbconf) && $dbconf['enabled'] ) // Database-Connection is enabled
                $dbids[$dbid] = !$dbconf['name'] ? $dbid : $dbconf['name'].' - '.$dbconf['description'];
        }


        if	( empty($dbids) )
            $this->addNotice('','','no_database_configuration',OR_NOTICE_WARN);

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

        $this->setTemplateVar('objectid'  ,$this->getRequestVar('objectid'  ,OR_FILTER_NUMBER) );
        $this->setTemplateVar('projectid' ,$this->getRequestVar('projectid' ,OR_FILTER_NUMBER) );
        $this->setTemplateVar('modelid'   ,$this->getRequestVar('modelid'   ,OR_FILTER_NUMBER) );
        $this->setTemplateVar('languageid',$this->getRequestVar('languageid',OR_FILTER_NUMBER) );

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
	 * Anzeigen der Loginmaske.
	 *
	 * Es wird nur die Loginmaske angezeigt.
	 * Hier nie "304 not modified" setzen, da sonst keine
	 * Login-Fehlermeldung erscheinen kann
	 */
	function openidView()
	{
		global $conf;

		foreach( $conf['database'] as $dbname=>$dbconf )
		{
			if	( is_array($dbconf) && $dbconf['enabled'] )
				$dbids[$dbname] = array('key'  =>$dbname,
				                        'value'=>Text::maxLength($dbconf['description']),
				                        'title'=>$dbconf['description'].(isset($dbconf['host'])?' ('.$dbconf['host'].')':'') );
		}

		$openid_provider = array();
		foreach( explode(',',$conf['security']['openid']['provider']['name']) as $provider )
			$openid_provider[$provider] = config('security','openid','provider.'.$provider.'.name');
		$this->setTemplateVar('openid_providers',$openid_provider);
		$this->setTemplateVar('openid_user_identity',config('security','openid','user_identity'));
		//$this->setTemplateVar('openid_provider','identity');


		if	( empty($dbids) )
			$this->addNotice('','','no_database_configuration',OR_NOTICE_WARN);

		if	( !isset($_COOKIE['or_username']) )
			$this->setTemplateVar('login_name',$_COOKIE['or_username']);
		else
			$this->setTemplateVar('login_name',$conf['security']['default']['username']);

		$this->setTemplateVar( 'dbids',$dbids );

		$db = DB::get();
		if	( is_object($db) )
			$this->setTemplateVar('actdbid',$db->id);
		else
			$this->setTemplateVar('actdbid',$conf['database']['default']);

		$this->setTemplateVar('objectid'  ,$this->getRequestVar('objectid'  ,OR_FILTER_NUMBER) );
		$this->setTemplateVar('projectid' ,$this->getRequestVar('projectid' ,OR_FILTER_NUMBER) );
		$this->setTemplateVar('modelid'   ,$this->getRequestVar('modelid'   ,OR_FILTER_NUMBER) );
		$this->setTemplateVar('languageid',$this->getRequestVar('languageid',OR_FILTER_NUMBER) );

	}



	/**
	 * Erzeugt eine Anwendungsliste.
     * TODO: unused at the moment
	 */
	function applications()
	{
		global $conf;
		
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
	 * Open-Id Login, ?berpr?fen der Anmeldung.<br>
	 * Spezifikation: http://openid.net/specs/openid-authentication-1_1.html<br>
	 * Kapitel "4.4. check_authentication"<br>
	 * <br>
	 * Im 2. Schritt (Mode "id_res") erfolgte ein Redirect vom Open-Id Provider an OpenRat zur?ck.<br>
	 * Wir befinden uns nun im darauf folgenden Request des Browsers.<br>
	 * <br>
	 * Es muss noch beim OpenId-Provider die Best?tigung eingeholt werden, danach ist der
	 * Benutzer angemeldet.<br>
	 */
	public function openidloginView()
	{
		global $conf;
		$openId = Session::get('openid');

		if	( !$openId->checkAuthentication() )
		{
			throw new \util\exception\SecurityException('OpenId-Login failed' );
		}
		
		//Html::debug($openId);
		
		// Anmeldung wurde mit "is_valid:true" best?tigt.
		// Der Benutzer ist jetzt eingeloggt.
		$username = $openId->getUserFromIdentiy();
		
		Logger::debug("OpenId-Login successful for $username");
		
		if	( empty($username) )
		{
			// Es konnte kein Benutzername ermittelt werden.
			throw new \util\exception\SecurityException('no username supplied by openid provider' );
		}
		
		$user = User::loadWithName( $username );
		
		if	( $user->userid <=0)
		{
			// Benutzer ist (noch) nicht vorhanden.
			if	( $conf['security']['openid']['add'])  // Anlegen?
			{
				$user->name     = $username;
				$user->add();

				$user->mail     = @$openId->info['email'];
				$user->fullname = @$openId->info['fullname'];
				$user->save();  // Um E-Mail zu speichern (wird bei add() nicht gemacht)
			}
			else
			{
				Logger::debug("OpenId-Login failed for $username");
				// Benutzer ist nicht in Benutzertabelle vorhanden (und angelegt werden soll er auch nicht).
				throw new \util\exception\SecurityException('user',$username,'LOGIN_OPENID_FAILED','error',array('name'=>$username) );
			}
		}
		else
		{
			// Benutzer ist bereits vorhanden.
			if	( @$conf['security']['openid']['update_user'])
			{
				$user->fullname = @$openId->info['fullname'];
				$user->mail     = @$openId->info['email'];
				$user->save();
			}
		}

		Logger::info("User login successful: ".$username);
		$user->setCurrent();  // Benutzer ist jetzt in der Sitzung.
		
		$this->setStyle( $user->style );

		$server = Http::getServer();
		Logger::debug("Redirecting to $server");
		header('Location: '.slashify($server) );
		exit();
	}
	

	/**
	 * Login.
	 */
	function openidPost()
	{
		global $conf;

		Session::setUser('');
		
		if	( $conf['login']['nologin'] )
			throw new \util\exception\SecurityException('login disabled');

		$openid_user   = $this->getRequestVar('openid_url'    );
		$loginName     = $this->getRequestVar('login_name'    ,OR_FILTER_ALPHANUM);
		$loginPassword = $this->getRequestVar('login_password',OR_FILTER_ALPHANUM);
		$newPassword1  = $this->getRequestVar('password1'     ,OR_FILTER_ALPHANUM);
		$newPassword2  = $this->getRequestVar('password2'     ,OR_FILTER_ALPHANUM);
		
		// Cookie setzen
		$this->setCookie('or_username',$loginName );
		
		// Login mit Open-Id.
		if	( $this->hasRequestVar('openid_provider') && ($this->getRequestVar('openid_provider') != 'identity' || !empty($openid_user)) )
		{
			$openId = new OpenId($this->getRequestVar('openid_provider'),$openid_user);
			
			if	( ! $openId->login() )
			{
				$this->addNotice('user',$openid_user,'LOGIN_OPENID_FAILED','error',array('name'=>$openid_user),array($openId->error) );
				$this->addValidationError('openid_url','');
				$this->callSubAction('showlogin');
				return;
			}
			
			Session::set('openid',$openId);
			$this->redirect( $openId->getRedirectUrl() );
			return;
		}
	}


    /**
     * Synchronisiert die bisherigen Gruppen des Benutzers mit den Gruppen, die sich aus der Authentifzierung ergeben haben.
     *
     * @param $user User Benutzerobjekt
     * @param $groups array $groups Einfaches Array von Gruppennamen.
     */
	private function checkGroups($user, $groups)
	{
		if	( $groups == null )
			return;

		$oldGroups = $user->getGroups();
		
		foreach( $oldGroups as $id=>$name)
		{
			if	( !in_array($name,$groups) )
				$user->delGroup($id);
		}
		
		foreach( $groups as $name)
		{
			if	( ! in_array($name,$oldGroups))
			{
				try
				{
					$group = Group::loadWithName( $name );
					$user->addGroup($group->groupid);
				}
				catch (ObjectNotFoundException $e)
				{
					// Gruppe fehlt. Anlegen?
					if	( config('ldap','authorize','auto_add' ) )
					{
						// Die Gruppe in der OpenRat-Datenbank hinzufuegen.
						$g = new Group();
						$g->name = $group;
						$g->add(); // Gruppe hinzufuegen
						$user->addGroup($g->groupid); // Und Gruppe dem Benutzer hinzufuegen.
					}
					
				}
			}
		}
	}

	
	/**
	 * Login.
	 * Zuerst wird die Datenbankverbindung aufgebaut und falls notwendig, aktualisiert.
	 */
	function loginPost()
	{
		global $conf;

		Session::setUser(''); // Altes Login entfernen.
		
		if	( $conf['login']['nologin'] )
			throw new \util\exception\SecurityException('login disabled');

		$loginName     = $this->getRequestVar('login_name'    ,OR_FILTER_ALPHANUM);
		$loginPassword = $this->getRequestVar('login_password',OR_FILTER_ALPHANUM);
		$newPassword1  = $this->getRequestVar('password1'     ,OR_FILTER_ALPHANUM);
		$newPassword2  = $this->getRequestVar('password2'     ,OR_FILTER_ALPHANUM);
		$token         = $this->getRequestVar('user_token'    ,OR_FILTER_ALPHANUM);

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
					$user = User::loadWithName($loginName);
					$user->setPassword( $newPassword1,true );
					
					// Das neue gesetzte Kennwort für die weitere Authentifizierung benutzen.
					$loginPassword = $newPassword1;
				}
			}
			else
			{
				// Anmeldung gescheitert.
				$this->addNotice('user',$loginName,'LOGIN_FAILED','error',array('name'=>$loginName) );
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
		$groups             = null;
		$lastModule         = null;
		
		// Jedes Authentifizierungsmodul durchlaufen, bis ein Login erfolgreich ist.
		foreach( $modules as $module)
		{
            $moduleClass = Auth::NS.'\\' . $module . 'Auth';
			$auth        = new $moduleClass;
			Logger::info('Trying to login with module '.$moduleClass);
			$loginStatus = $auth->login( $loginName,$loginPassword, $token );
			$loginOk     = $loginStatus === true || $loginStatus === OR_AUTH_STATUS_SUCCESS;
			
			if   ( $loginStatus === OR_AUTH_STATUS_PW_EXPIRED )
				$mustChangePassword = true;
			if   ( $loginStatus === OR_AUTH_STATUS_TOKEN_NEEDED )
				$tokenFailed = true;
				
			if	( $loginOk )
			{
				Logger::info('Login successful for '.$loginName);
				$lastModule = $module;
				
				if	( isset($auth->groups ) )
					$groups = $auth->groups;
					
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
				$user = User::loadWithName($loginName);
				$user->loginModuleName = $lastModule;
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
			
			Logger::debug("Login failed for user ".Logger::sanitizeInput($loginName)." from IP $ip");
			
			if	( $tokenFailed )
			{
				// Token falsch.
				$this->addNotice('user',$loginName,'LOGIN_FAILED_TOKEN_FAILED','error' );
				$this->addValidationError('user_token','');
			}
			elseif	( $mustChangePassword )
			{
				// Anmeldung gescheitert, Benutzer muss Kennwort ?ndern.
				$this->addNotice('user',$loginName,'LOGIN_FAILED_MUSTCHANGEPASSWORD','error' );
				$this->addValidationError('password1','');
				$this->addValidationError('password2','');
			}
			else
			{
				// Anmeldung gescheitert.
				$this->addNotice('user',$loginName,'LOGIN_FAILED','error',array('name'=>$loginName) );
				$this->addValidationError('login_name'    ,'');
				$this->addValidationError('login_password','');
			}

			return;
		}
		else
		{
		    
			Logger::debug("Login successful for user '$loginName' from IP $ip");

			$this->checkGroups( $user, $groups );	

			if	( $this->hasRequestVar('remember') )
			{
				// Cookie setzen
				$this->setCookie('or_username',$user->name         );
                $this->setCookie('or_token'   ,$user->createNewLoginToken() );
			}
				
			// Anmeldung erfolgreich.
            if	( config()->subset('security')->is('renew_session_login',false) )
				$this->recreateSession();
			
			$this->addNotice('user',$user->name,'LOGIN_OK',OR_NOTICE_OK,array('name'=>$user->fullname));
			
			$this->setStyle( $user->style ); // Benutzer-Style setzen

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
		global $conf;
		
		$user = Session::getUser();
		if	( is_object($user) )
			$this->setTemplateVar('login_username',$user->name);
		
		if	( config()->subset('security')->is('renew_session_logout',false) )
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

        // Umleiten auf eine definierte URL.s
		$redirect_url = @$conf['security']['logout']['redirect_url'];

		if	( !empty($redirect_url) )
		{
			$this->redirect($redirect_url);
		}

		// Style zurücksetzen.
		// Der Style des Benutzers koennte auch stehen bleiben. Aber dann gäbe es Rückschlüsse darauf, wer zuletzt angemeldet war (Sicherheit!).
		$this->setStyle( config('interface','style','default') );

        $this->addNotice('user',$user->name,'LOGOUT_OK',OR_NOTICE_OK);

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
	function userinfo()
	{
		$user = Session::getUser();
		$info = array('username'   => $user->name,
		              'fullname'   => $user->fullname,
		              'mail'       => $user->mail,
		              'telephone'  => $user->tel,
		              'style'      => $user->style,
		              'admin'      => $user->isAdmin?'true':'false',
		              'ldap'       => $user->ldap_dn,
		              'groups'     => implode(',',$user->getGroups()),
		              'description'=> $user->desc
		             );
		        
		// Wenn der HTTP-Parameter "xml" vorhanden ist, dann geben wir die
		// Informationen per XML aus.     
		if	( $this->hasRequestVar('xml') )
		{
			header('Content-Type: text/xml');
			echo '<userinfo>';
			foreach( $info as $n=>$i )
				echo '<'.$n.'>'.$i.'</'.$n.'>'."\n";
			echo '</userinfo>';
			
		}
		
		// Sonst normale Textausgabe im INI-Datei-Format.
		else
		{
			header('Content-Type: text/plain');
			foreach( $info as $n=>$i )
				echo $n.'="'.$i."\"\n";
		}
		
		exit; // Fertig.
	}
	
	
	function project()
	{
		$user = Session::getUser();
		if   ( ! is_object($user) )
		{
			$this->callSubAction('show');
			return;
		}

		$this->evaluateRequestVars( array('projectid'=>$this->getRequestId()) );
		
		Session::setUser( $user );
	}


	function object()
	{
		$user = Session::getUser();
		if   ( ! is_object($user) )
		{
			$this->callSubAction('show');
			return;
		}
		
		$this->evaluateRequestVars( array('objectid'=>$this->getRequestId()) );

		Session::setUser( $user );
	}


	function language()
	{
		$user = Session::getUser();
		if   ( ! is_object($user) )
		{
			$this->callSubAction('show');
			return;
		}
		
		$this->evaluateRequestVars( array(REQ_PARAM_LANGUAGE_ID=>$this->getRequestId()) );
	}


	function model()
	{
		$user = Session::getUser();
		if   ( ! is_object($user) )
		{
			$this->callSubAction('show');
			return;
		}
		
		$this->evaluateRequestVars( array(REQ_PARAM_MODEL_ID=>$this->getRequestId()) );

		$user     = Session::getUser();
	}
	

	/**
	 * Auswerten der Request-Variablen.
	 *
	 * @param Array $add
	 */
	function evaluateRequestVars( $add = array() )
	{
	}


	function showtree()
	{
		Session::set('showtree',true );
	}
		

	function hidetree()
	{
		Session::set('showtree',false );
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
		global $conf;
		global $PHP_AUTH_USER;
		global $PHP_AUTH_PW;

		$user = Session::getUser();
		// Gast-Login
		if   ( ! is_object($user) )
		{
			if	( $conf['security']['guest']['enable'] )
			{
				$username = $conf['security']['guest']['user'];
				$user = User::loadWithName($username);
				if	( $user->userid > 0 )
					$user->setCurrent();
				else
				{
					Logger::warn('Guest login failed, user not found: '.$username);
					$this->addNotice('user',$username,'LOGIN_FAILED',OR_NOTICE_WARN,array('name'=>$username) );
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
						header( 'WWW-Authenticate: Basic realm="'.OR_TITLE.' - '.lang('HTTP_REALM').'"' );
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
			$this->addNotice( 'user',$user->name,'PASSWORD_TIMEOUT','warn' );
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
		global $conf;
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
		global $conf;

		Session::set('registerMail',$this->getRequestVar('mail') );
		
			srand ((double)microtime()*1000003);
		$registerCode = rand();
		
		Session::set('registerCode',$registerCode                );

		$email_address = $this->getRequestVar('mail',OR_FILTER_MAIL);
		
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
			$this->addNotice('','','mail_sent',OR_NOTICE_OK);
		}
		else
		{
			$this->addNotice('','','mail_not_sent',OR_NOTICE_ERROR,array(),$mail->error);
			return;
		}
	}

	
	/**
	 * Benutzerregistierung.
	 * Benutzer hat Best?tigungscode erhalten und eingegeben.
	 */
	function registercodePost()
	{
		global $conf;

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
		
		$user = User::loadWithName( $this->getRequestVar('username') );
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
			
		$this->addNotice('user',$newUser->name,'user_added','ok');
	}



	/**
	 * Vergessenes Kennwort zusenden lassen.
	 */
	function passwordView()
	{
		// TODO: Attribut "Password" abfragen
		foreach( config('database') as $dbname=>$dbconf )
		{
		    $dbconf = $dbconf + config('database-default','defaults');
			if	( $dbconf['enabled'] )
				$dbids[$dbname] = $dbconf['description'];
		}

		$this->setTemplateVar( 'dbids',$dbids );
		
		
		$db = DB::get();
		
		if	( is_object($db) )
			$this->setTemplateVar('actdbid',$db->id);
		else
			$this->setTemplateVar('actdbid',config('database-default','default-id'));		
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
		
		$user = User::loadWithName( $this->getRequestVar("username") );
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
				$this->addNotice('user',$user->getName(),'mail_sent',OR_NOTICE_OK);
			else
				$this->addNotice('user',$user->getName(),'mail_not_sent',OR_NOTICE_ERROR,array(),$eMail->error);
			
		}
		else
		{
			//$this->addNotice('','user','username_not_found');
			// Trotzdem vort?uschen, eine E-Mail zu senden, damit die G?ltigkeit
			// eines Benutzernamens nicht von au?en gepr?ft werden kann.
			// 
			$this->addNotice('user',$this->getRequestVar("username"),'mail_sent');

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
		
		$user  = User::loadWithName( $username );
			
		if	( !$user->isValid() )
		{
			// Benutzer konnte nicht geladen werden.
			$this->addNotice('user',$username,'error',OR_NOTICE_ERROR);
			return;
		}
		
		$newPw = User::createPassword(); // Neues Kennwort erzeugen.
		
		$eMail = new Mail( $user->mail,'password_new' );
		$eMail->setVar('name'    ,$user->getName());
		$eMail->setVar('password',$newPw          );

		if	( $eMail->send() )
		{
			$user->setPassword( $newPw, false ); // Kennwort muss beim n?. Login ge?ndert werden.
			$this->addNotice('user',$username,'mail_sent',OR_NOTICE_OK);
		}
		else
		{
			// Sollte eigentlich nicht vorkommen, da der Benutzer ja auch schon den
			// Code per E-Mail erhalten hat.
			$this->addNotice('user',$username,'error',OR_NOTICE_ERROR,array(),$eMail->error);
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

        $this->setTemplateVar('cms_name'    , Conf()->subset('application')->get('name'    ) );
        $this->setTemplateVar('cms_version' , Conf()->subset('application')->get('version' ) );
        $this->setTemplateVar('cms_operator', Conf()->subset('application')->get('operator') );

        $user = Session::getUser();
        if   ( !empty($user) )
        {
            $this->setTemplateVar('user_login'   , $user->loginDate );
            $this->setTemplateVar('user_name'    , $user->name      );
            $this->setTemplateVar('user_fullname', $user->fullname  );
        }

    }

}


