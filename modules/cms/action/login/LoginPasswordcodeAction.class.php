<?php
namespace cms\action\login;
use cms\action\LoginAction;
use cms\action\Method;
use cms\model\User;
use language\Messages;
use logger\Logger;
use security\Password;
use util\Mail;
use util\Session;


class LoginPasswordcodeAction extends LoginAction implements Method {
    public function view() {

    }
    public function post() {

		$username = $this->getSessionVar(Session::KEY_PASSWORD_COMMIT_NAME);

		if	( $this->getRequestVar("code")=='' ||
			  $this->getSessionVar(Session::KEY_PASSWORD_COMMIT_CODE) != $this->getRequestVar("code") )
		{
			$this->addValidationError('code','PASSWORDCODE_NOT_MATCH');
		  	return;
		}
		
		$user  = User::loadWithName( $username,User::AUTH_TYPE_INTERNAL );
			
		if	( $user && $user->isValid() )
		{
			$newPw = $user->createPassword(); // Neues Kennwort erzeugen.

			$eMail = new Mail( $user->mail,'password_new' );
			$eMail->setVar('name'    ,$user->getName());
			$eMail->setVar('password',$newPw          );

			try {
				if	( $eMail->send() )
					$user->setPassword( $newPw, false ); // Kennwort muss beim n?. Login ge?ndert werden.
				else
					Logger::warn('Mail could not be sent: '.$eMail->error);
			} catch( \Exception $e ) {
				Logger::warn( $e );
			}
		}

		sleep(1);
		Password::delay();

		// For security reasons:
		// Always display this message, so no one is able to find out if a username exists.
		$this->addNoticeFor( null,Messages::MAIL_SENT );
    }
}
