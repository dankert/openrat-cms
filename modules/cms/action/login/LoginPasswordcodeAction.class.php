<?php
namespace cms\action\login;
use cms\action\LoginAction;
use cms\action\Method;
use cms\model\User;
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
}
