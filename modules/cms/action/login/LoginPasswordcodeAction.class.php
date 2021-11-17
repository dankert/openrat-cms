<?php
namespace cms\action\login;
use cms\action\LoginAction;
use cms\action\Method;
use cms\model\User;
use language\Messages;
use logger\Logger;
use security\Password;
use util\exception\ValidationException;
use util\mail\Mail;
use util\Session;


class LoginPasswordcodeAction extends LoginAction implements Method {
    public function view() {

    }
    public function post() {

		$username = Session::get(Session::KEY_PASSWORD_COMMIT_NAME);

		if	( $this->request->getText("code")=='' ||
			  Session::get(Session::KEY_PASSWORD_COMMIT_CODE) != $this->request->getText("code") )
			throw new ValidationException( 'code',Messages::PASSWORDCODE_NOT_MATCH );

		$user  = User::loadWithName( $username,User::AUTH_TYPE_INTERNAL );
			
		if	( $user && $user->isValid() )
		{
			$newPw = $user->createPassword(); // Neues Kennwort erzeugen.

			$eMail = new Mail($user->mail, Messages::MAIL_SUBJECT_PASSWORD_NEW,Messages::MAIL_TEXT_PASSWORD_NEW);
			$eMail->setVar('name'    ,$user->getName());
			$eMail->setVar('password',$newPw          );

			try {
				$eMail->send();
				$user->setPassword( $newPw, false ); // Kennwort muss beim n?. Login ge?ndert werden.
			} catch( \Exception $e ) {
				Logger::warn( $e );
				Logger::warn('Mail could not be sent: '.$user->mail);
			}
		}

		sleep(1);
		Password::delay();

		// For security reasons:
		// Always display this message, so no one is able to find out if a username exists.
		$this->addNoticeFor( null,Messages::MAIL_SENT );
    }
}
