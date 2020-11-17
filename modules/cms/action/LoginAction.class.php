<?php

namespace cms\action;


use cms\auth\Auth;
use cms\auth\AuthRunner;
use cms\auth\InternalAuth;
use cms\base\Configuration;
use cms\base\DB;
use cms\base\Startup;
use cms\model\User;
use configuration\Config;
use Exception;
use language\Messages;
use logger\Logger;
use openid_connect\OpenIDConnectClient;
use security\Password;
use util\exception\ObjectNotFoundException;
use util\exception\SecurityException;
use util\exception\UIException;
use util\exception\ValidationException;
use util\Mail;
use util\Session;
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

		$passwordConfig = Configuration::subset(['security','password']);
		
		if	( $mustChangePassword )
		{
			// Der Benutzer hat zwar ein richtiges Kennwort eingegeben, aber dieses ist abgelaufen.
			// Wir versuchen hier, das neue zu setzen (sofern eingegeben).
			if	( empty($pw1) )
			{
			}
			elseif	( $pw1 != $pw2 )
			{
				$this->addValidationError('password1',Messages::PASSWORDS_DO_NOT_MATCH);
				$this->addValidationError('password2','');
			}
			elseif	( strlen($pw2) < $passwordConfig->get('min_length',10) )
			{
				$this->addValidationError('password1',Messages::PASSWORD_MINLENGTH,[
					'minlength'=>$passwordConfig->get('min_length',10)
				]);
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
        $loginConfig    = Configuration::subset('security');
        $securityConfig = Configuration::subset('security');
        $authenticateConfig  = Configuration::subset('authenticate');

        $authenticateEnabled = $authenticateConfig->is('enable',true);
		$oidcList = [];

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

        $this->setTemplateVar( 'dbids',$dbids );

        // Database was already connected in the Dispatcher. So we MUST have a db connection here.
        $db = Session::getDatabase();
        $this->setTemplateVar('dbid',$db->id);

        $this->setTemplateVar('register'     ,$loginConfig->get('register' ));
        $this->setTemplateVar('send_password',$loginConfig->get('send_password'));

        // Versuchen, einen Benutzernamen zu ermitteln, der im Eingabeformular vorausgewählt wird.
        $username = AuthRunner::getUsername('preselect');

        $this->setTemplateVar('login_name',$username);

        // If the preselected user is the default user, we have a password.
		if   ( $username == $securityConfig->subset('default')->get('username') )
			$this->setTemplateVar('login_password',  $securityConfig->subset('default')->get('password') );
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
	 * @deprecated
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
		Session::setUser(null); // Altes Login entfernen.
		
		if	( Configuration::subset('login')->is('nologin',false ) )
			throw new SecurityException('login disabled');

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

			$passwordConfig = Configuration::subset(['security','password']);

			if	( $auth->login($loginName, $loginPassword,$token) || $auth->mustChangePassword )
			{
				if	( $newPassword1 != $newPassword2 )
				{
					$this->addValidationError('password1',Messages::PASSWORDS_DO_NOT_MATCH);
					$this->addValidationError('password2','');
					return;
				}
				elseif	( strlen($newPassword1) < $passwordConfig->get('min_length',10) )
				{
					$this->addValidationError('password1',Messages::PASSWORD_MINLENGTH,array('minlength'=>$passwordConfig->get('min_length',10)));
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

		// Jedes Authentifizierungsmodul durchlaufen, bis ein Login erfolgreich ist.
		$result = AuthRunner::checkLogin('authenticate',$loginName,$loginPassword, $token );

		$mustChangePassword = ( $result === Auth::STATUS_PW_EXPIRED   );
		$tokenFailed        = ( $result === Auth::STATUS_TOKEN_NEEDED );
		$loginOk            = ( $result === Auth::STATUS_SUCCESS      );

		if	( $loginOk )
		{
			Logger::info('Login successful for '.$loginName);

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
				if	( Configuration::subset(['security','newuser'])->is('autoadd',true ) )
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
            if	( Configuration::subset('security')->is('renew_session_login',false) )
				$this->recreateSession();
			
			$this->addNoticeFor( $user,Messages::LOGIN_OK, array('name' => $user->getName() ));
			
            $config = Session::getConfig();
            $language = new \language\Language();
            $config['language'] = $language->getLanguage($user->language);
            $config['language']['language_code'] = $user->language;
            Session::setConfig( $config );
		}
		
	}


	/**
	 * Logout current user.
	 */
	public function logoutPost()
	{
		if	( Configuration::subset('security')->is('renew_session_logout',false) )
			$this->recreateSession();

        // Reading the login token cookie
        list( $selector,$token ) = array_pad( explode('.',@$_COOKIE['or_token']),2,'');

        // Logout forces the removal of all login tokens
		if   ( $selector )
		    $this->currentUser->deleteLoginToken( $selector );

		// Cookie mit Logintoken löschen.
        $this->setCookie('or_token'   ,null );

        Session::setUser(null);

        $this->addNoticeFor( $this->currentUser, Messages::LOGOUT_OK );
    }

	
	
	/**
	 * Benutzer meldet sich ab.
	 */
	function logoutView()
	{
		// There is no view for this action.
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
			throw new SecurityException("Switching the user is only possible for admins.");
		
		$this->recreateSession();
		
		$newUser = new User( $this->getRequestId() );
		$newUser->load();
		
		$newUser->setCurrent();
	}


	/**
	 * @throws ObjectNotFoundException
	 * @deprecated not in use
	 */
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

		$this->setTemplateVar( 'dbids',$this->getSelectableDatabases() );
		
		$db = DB::get();
		if	( $db )
			$this->setTemplateVar('actdbid',$db->id);
		else
			$this->setTemplateVar('actdbid',$conf['database-defaults']['default-id']);
		
		
		
	}

	
	
	public function registerPost()
	{
		$email_address = $this->getRequestVar('mail',RequestParams::FILTER_MAIL);

		if	( ! Mail::checkAddress($email_address) )
		{
			$this->addValidationError('mail');
			return;
		}

		Session::set( Session::KEY_REGISTER_MAIL,$email_address );
		
		srand ((double)microtime()*1000003);
		$registerCode = rand();
		
		Session::set( Session::KEY_REGISTER_CODE,$registerCode  );


		// E-Mail and die eingegebene Adresse verschicken
		$mail = new Mail($email_address,
		                 'register_commit_code');
		$mail->setVar('code',$registerCode); // Registrierungscode als Text-Variable
		
		if	( $mail->send() )
		{
			$this->addNoticeFor( new User(), Messages::MAIL_SENT);
		}
		else
		{
			$this->addErrorFor( new User(),Messages::MAIL_NOT_SENT, [], $mail->error);
		}
	}

	
	/**
	 * Benutzerregistierung.
	 * Benutzer hat Best?tigungscode erhalten und eingegeben.
	 */
	function registercodePost()
	{
		$conf = Configuration::rawConfig();

		$origRegisterCode  = Session::get( Session::KEY_REGISTER_CODE );
		$inputRegisterCode = $this->getRequestVar('code');
		
		if	( $origRegisterCode != $inputRegisterCode )
			throw new ValidationException('code', Messages::CODE_NOT_MATCH ); // Validation code does not match.

		// Best?tigungscode stimmt ?berein.
		// Neuen Benutzer anlegen.
			
		if	( !$this->hasRequestVar('username') )
		{
			$this->addValidationError('username');
			return;
		}
		
		$user = User::loadWithName( $this->getRequestVar('username'),User::AUTH_TYPE_INTERNAL );
		if	( $user )
			throw new ValidationException('username',Messages::USER_ALREADY_IN_DATABASE );

		if	( strlen($this->getRequestVar('password')) < $conf['security']['password']['min_length'] )
			throw new ValidationException('password', Messages::PASSWORD_MINLENGTH/*,[
				'minlength'=>$conf['security']['password']['min_length']
			]*/);

		$newUser = new User();
		$newUser->name = $this->getRequestVar('username');
		$newUser->fullname = $newUser->name;
		$newUser->add();
			
		$newUser->mail = Session::get( Session::KEY_REGISTER_MAIL );
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
			$this->setTemplateVar('actdbid', Configuration::subset('database-default')->get('default-id',''));
	}	
	
	

	/**
	 * Einen Kennwort-Anforderungscode an den Benutzer senden.
	 */
	function passwordPost()
	{
		$username = $this->getRequestVar('username');
		if	( ! $username  )
			throw new ValidationException('username');

		$user = User::loadWithName( $username,User::AUTH_TYPE_INTERNAL );

		Password::delay(); // Crypto-Wait

		if	( $user )
		{
			srand ((double)microtime()*1000003);
			$code = rand();
			$this->setSessionVar(Session::KEY_PASSWORD_COMMIT_CODE,$code);
			
			$eMail = new Mail( $user->mail,'password_commit_code' );
			$eMail->setVar('name',$user->getName());
			$eMail->setVar('code',$code);
			if	( $eMail->send() )
				$this->addNoticeFor( new User(), Messages::MAIL_SENT);
			else
				// Yes, the mail is not sent but we are faking a sent mail.
				// so no one is able to check if the username exists (if the mail system is down)
				$this->addNoticeFor( new User(), Messages::MAIL_SENT);

			$this->setSessionVar(Session::KEY_PASSWORD_COMMIT_NAME,$user->name);
		}
		else
		{
			// There is no user with this name.
			// We are faking a sending mail, so no one is able to check if this username exists.
			sleep(1);
			$this->addNoticeFor( new User(), Messages::MAIL_SENT);
		}
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
		$username = $this->getSessionVar(Session::KEY_PASSWORD_COMMIT_NAME);

		if	( $this->getRequestVar("code")=='' ||
			  $this->getSessionVar(Session::KEY_PASSWORD_COMMIT_CODE) != $this->getRequestVar("code") )
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
		
		$newPw = $user->createPassword(); // Neues Kennwort erzeugen.
		
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


