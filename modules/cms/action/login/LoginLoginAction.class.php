<?php
namespace cms\action\login;
use cms\action\Action;
use cms\action\LoginAction;
use cms\action\Method;
use cms\action\RequestParams;
use cms\auth\Auth;
use cms\auth\AuthRunner;
use cms\auth\InternalAuth;
use cms\base\Configuration;
use cms\base\DB;
use cms\model\User;
use language\Language;
use language\Messages;
use logger\Logger;
use security\Password;
use util\exception\ObjectNotFoundException;
use util\exception\SecurityException;
use util\Session;
use util\text\TextMessage;


class LoginLoginAction extends LoginAction implements Method {
    public function view() {
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
            $this->addWarningFor( null,Messages::NO_DATABASE_CONFIGURATION );

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


    public function post() {

		Session::setUser(null); // Altes Login entfernen.
		
		if	( Configuration::subset('login')->is('nologin',false ) )
			throw new SecurityException('login disabled');

		$loginName     = $this->getRequestVar('login_name'    ,RequestParams::FILTER_ALPHANUM);
		$loginPassword = $this->getRequestVar('login_password',RequestParams::FILTER_ALPHANUM);
		$newPassword1  = $this->getRequestVar('password1'     ,RequestParams::FILTER_ALPHANUM);
		$newPassword2  = $this->getRequestVar('password2'     ,RequestParams::FILTER_ALPHANUM);
		$token         = $this->getRequestVar('user_token'    ,RequestParams::FILTER_ALPHANUM);


		// Jedes Authentifizierungsmodul durchlaufen, bis ein Login erfolgreich ist.
		$authResult = AuthRunner::checkLogin('authenticate',$loginName,$loginPassword, $token );
		Password::delay();

		$mustChangePassword = ( $authResult === Auth::STATUS_PW_EXPIRED   );
		$tokenFailed        = ( $authResult === Auth::STATUS_TOKEN_NEEDED );
		$loginOk            = ( $authResult === Auth::STATUS_SUCCESS      );

		if  ( $mustChangePassword ) {

			// Der Benutzer hat zwar ein richtiges Kennwort eingegeben, aber dieses ist abgelaufen.
			// Wir versuchen hier, das neue zu setzen (sofern eingegeben).
			if	( $newPassword1 )
			{
				$passwordConfig = Configuration::subset(['security','password']);

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
					$loginPassword = $newPassword1;

					$loginOk            = true;
					$mustChangePassword = false;
				}
			}
		}

		if	( $tokenFailed ) {
			// Token falsch.
			$this->addErrorFor(null,Messages::LOGIN_FAILED_TOKEN_FAILED );
			$this->addValidationError('user_token','');
			return;
		}

		if	( $mustChangePassword ) {
			// Anmeldung gescheitert, Benutzer muss Kennwort ?ndern.
			$this->addErrorFor( null,Messages::LOGIN_FAILED_MUSTCHANGEPASSWORD);
			$this->addValidationError('password1','');
			$this->addValidationError('password2','');
			return;
		}

		$ip = getenv("REMOTE_ADDR");

		if	( ! $loginOk ) {
			Logger::debug(TextMessage::create('login failed for user ${name} from IP ${ip}',
				[
					'name' => $loginName,
					'ip' => $ip
				]
			));

			// Anmeldung gescheitert.
			$this->addErrorFor( null,Messages::LOGIN_FAILED, ['name' => $loginName] );
			$this->addValidationError('login_name'    , '');
			$this->addValidationError('login_password', '');
			return;
		}

		Logger::info(TextMessage::create('Login successful for user ${0}', [$loginName]));
		Logger::debug("Login successful for user '$loginName' from IP $ip");

		try {
			// Benutzer über den Benutzernamen laden.
			$user = User::loadWithName($loginName, User::AUTH_TYPE_INTERNAL, null);
			$user->setCurrent();
			$user->updateLoginTimestamp();

			if ($user->passwordAlgo != Password::bestAlgoAvailable())
				// Re-Hash the password with a better hash algo.
				$user->setPassword($loginPassword);

		} catch (ObjectNotFoundException $ex) {
			// Benutzer wurde zwar authentifiziert, ist aber in der
			// internen Datenbank nicht vorhanden
			if (Configuration::subset(['security', 'newuser'])->is('autoadd', true)) {

				// Neue Benutzer in die interne Datenbank uebernehmen.
				$user = new User();
				$user->name = $loginName;
				$user->fullname = $loginName;
				$user->persist();
				Logger::debug( TextMessage::create('user ${0} authenticated successful and added to internal user table',[$loginName]) );
				$user->updateLoginTimestamp();
			} else {
				// Benutzer soll nicht angelegt werden.
				// Daher ist die Anmeldung hier gescheitert.
				// Anmeldung gescheitert.
				Logger::warn( TextMessage::create('user ${0} authenticated successful, but not found in internal user table',[$loginName]) );

				$this->addErrorFor(null,Messages::LOGIN_FAILED, ['name' => $loginName ]);
				$this->addValidationError('login_name', '');
				$this->addValidationError('login_password', '');

				return;
			}
		}

		// Cookie setzen
		$this->setCookie(Action::COOKIE_DB_ID   ,DB::get()->id );
		$this->setCookie(Action::COOKIE_USERNAME,$user->name   );

		if	( $this->hasRequestVar('remember') ) {
			// Sets the login token cookie
			$this->setCookie(Action::COOKIE_TOKEN   ,$user->createNewLoginToken() );
		}

		// Anmeldung erfolgreich.
		if	( Configuration::subset('security')->is('renew_session_login',false) )
			$this->recreateSession();

		$this->addNoticeFor( $user,Messages::LOGIN_OK, array('name' => $user->getName() ));

		// Setting the user-defined language
		$config = Session::getConfig();
		$language = new Language();
		$config['language'] = $language->getLanguage($user->language);
		$config['language']['language_code'] = $user->language;

		Session::setConfig( $config );
    }
}
