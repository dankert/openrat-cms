<?php
namespace cms\action\login;
use cms\action\Action;
use cms\action\LoginAction;
use cms\action\Method;
use cms\action\RequestParams;
use cms\auth\Auth;
use cms\auth\AuthRunner;
use cms\base\Configuration;
use cms\base\DB;
use cms\base\Startup;
use cms\model\User;
use language\Language;
use language\Messages;
use logger\Logger;
use security\Password;
use util\Browser;
use util\exception\ObjectNotFoundException;
use util\exception\SecurityException;
use util\exception\ValidationException;
use util\mail\Mail;
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

		$dbids = $this->getSelectableDatabases();

        if	( ! $dbids )
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

		$loginName     = $this->request->getAlphanum('login_name' );
		$loginPassword = $this->request->getText('login_password');
		$newPassword1  = $this->request->getText('password1'     );
		$newPassword2  = $this->request->getText('password2'     );
		$token         = $this->request->getText('user_token'    );


		// Jedes Authentifizierungsmodul durchlaufen, bis ein Login erfolgreich ist.
		$authResult = AuthRunner::checkLogin('authenticate',$loginName,$loginPassword, $token );
		Password::delay();

		if  ( $authResult & Auth::STATUS_PW_EXPIRED ) {

			// Der Benutzer hat zwar ein richtiges Kennwort eingegeben, aber dieses ist abgelaufen.
			// Wir versuchen hier, das neue zu setzen (sofern eingegeben).
			if	( $newPassword1 )
			{
				$passwordConfig = Configuration::subset(['security','password']);

				if	( $newPassword1 != $newPassword2 )
					throw new ValidationException('password2',Messages::PASSWORDS_DO_NOT_MATCH);
				elseif	( strlen($newPassword1) < $passwordConfig->get('min_length',10) )
					throw new ValidationException('password1',Messages::PASSWORD_MINLENGTH,array('minlength'=>$passwordConfig->get('min_length',10)));
				else
				{
					// Kennwoerter identisch und lang genug.
					$user = User::loadWithName($loginName,User::AUTH_TYPE_INTERNAL);
					$user->setPassword( $newPassword1,true );
					$loginPassword = $newPassword1;

					$authResult -= Auth::STATUS_PW_EXPIRED;
				}
			}
		}

		if	( $authResult & Auth::STATUS_TOKEN_NEEDED )
			// Token falsch.
			throw new ValidationException('user_token',Messages::LOGIN_FAILED_TOKEN_FAILED );

		if	( $authResult & Auth::STATUS_PW_EXPIRED ) {

			if   ( $authResult & Auth::STATUS_FAILED )
				// Anmeldung gescheitert, Benutzer muss Kennwort ?ndern.
				throw new ValidationException('password1',Messages::LOGIN_FAILED_MUSTCHANGEPASSWORD);
		}

		$ip = getenv("REMOTE_ADDR");

		if	( $authResult & Auth::STATUS_FAILED ) {
			Logger::debug(TextMessage::create('login failed for user ${name} from IP ${ip}',
				[
					'name' => $loginName,
					'ip' => $ip
				]
			));

			// Increase fail counter
			$user = User::loadWithName($loginName,User::AUTH_TYPE_INTERNAL);

			if   ( $authResult & Auth::STATUS_ACCOUNT_LOCKED ) {
				;
				// the account is locked, so the login failed.
				// we are NOT informing the UI about this. The user is already informed about the lock.
			}
			else {
				// Increase password fail counter
				$user->increaseFailedPasswordCounter();
				// $user->passwordFailedCount is now at least 1.

				$lockAfter = Configuration::subset(['security','password'])->get('lock_after_fail_count',10);
				if   ( $lockAfter && $user->passwordFailedCount % $lockAfter == 0 ) {
					// exponentially increase the lock duration.
					$factor         = pow(2, intval($user->passwordFailedCount/$lockAfter) - 1 ) ;
					$lockedDuration = Configuration::subset(['security','password'])->get('lock_duration',120) * $factor * 60;

					$lockedUntil = Startup::getStartTime() + $lockedDuration;
					$user->passwordLockedUntil = $lockedUntil;
					$user->persist();

					// Inform the user about the lock.
					if   ( $user->mail ) {
						$mail = new Mail( $user->mail,Messages::MAIL_PASSWORD_LOCKED_SUBJECT,Messages::MAIL_PASSWORD_LOCKED);
						$mail->setVar('username',$user->name);
						$mail->setVar('name',$user->getName() );
						$mail->setVar('until',date( \cms\base\Language::lang(Messages::DATE_FORMAT ), $lockedUntil ) );
						$mail->send();
					}
				}
			}

			// Login failed.
			throw new ValidationException('login_password',Messages::LOGIN_FAILED, ['name' => $loginName] );
		}

		if ( $authResult & Auth::STATUS_SUCCESS ) {

			Logger::info(TextMessage::create('Login successful for user ${0}', [$loginName]));

			$browser = new Browser();
			Logger::debug(TextMessage::create('Login successful for user ${0} from IP ${1} with ${2} (${3})',[$loginName,$ip,$browser->name,$browser->platform]));

			try {
				// Benutzer über den Benutzernamen laden.
				$user = User::loadWithName($loginName, User::AUTH_TYPE_INTERNAL, null);
				$user->setCurrent();
				$user->updateLoginTimestamp();
				$user->resetFailedPasswordCounter();

				if ($user->passwordAlgo != Password::bestAlgoAvailable())
					// Re-Hash the password with a better hash algo.
					$user->setPassword($loginPassword);

			} catch (ObjectNotFoundException $ex) {
				// Benutzer wurde zwar authentifiziert, ist aber in der
				// internen Datenbank nicht vorhanden
				if (Configuration::subset(['security', 'newuser'])->is('autoadd', true)) {

					if   ( Startup::readonly() )
						throw new \LogicException('System is readonly so this user cannot be inserted.');

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

					throw new ValidationException('login_password',Messages::LOGIN_FAILED,['name' => $loginName ]);
				}
			}

			// Cookie setzen
			$this->setCookie(Action::COOKIE_DB_ID   ,DB::get()->id );
			$this->setCookie(Action::COOKIE_USERNAME,$user->name   );

			if	( $this->request->has('remember') ) {
				// Sets the login token cookie
				$this->setCookie(Action::COOKIE_TOKEN   ,$user->createNewLoginToken() );
			}

			// Anmeldung erfolgreich.
			if	( Configuration::subset('security')->is('renew_session_login',false) )
				$this->recreateSession();

			// Send mail to user to inform about the new login.
			if   ( $user->mail && Configuration::subset('security')->is('inform_user_about_new_login',true) ) {
				$mail = new Mail( $user->mail, Messages::MAIL_NEW_LOGIN_SUBJECT, Messages::MAIL_NEW_LOGIN_TEXT );
				$browser = new \util\Browser();
				$mail->setVar( 'platform',$browser->platform );
				$mail->setVar( 'browser' ,$browser->name     );
				$mail->setVar( 'username',$user->name        );
				$mail->setVar( 'name'    ,$user->getName()   );
				$mail->send();
			}

			$this->addNoticeFor( $user,Messages::LOGIN_OK, array('name' => $user->getName() ));

			// Setting the user-defined language
			$config = Session::getConfig();
			$language = new Language();
			$config['language'] = $language->getLanguage($user->language);
			$config['language']['language_code'] = $user->language;

			Session::setConfig( $config );

			return; // everything ok, user logged in.
		}

		throw new \LogicException('Auth module must return either SUCCESS or FAIL, but got '.$authResult);
	}
}
