<?php
namespace cms\action\user;
use cms\action\Method;
use cms\action\UserAction;
use cms\base\Configuration;
use cms\model\User;
use language\Messages;
use security\Password;
use util\exception\ValidationException;
use util\mail\Mail;


class UserPwAction extends UserAction implements Method {

    public function view() {
		$this->setTemplateVar('enabled',$this->user->type == User::AUTH_TYPE_INTERNAL );
		$this->setTemplateVar('mail'   ,(boolean) $this->user->mail );

		$this->setTemplateVar('password_proposal', Password::createPassword() );
    }


    public function post() {
		$password = $this->request->getText('password');

		if   ( !$password )
			$password = $this->request->getText('password_proposal');

		if ( strlen($password) < Configuration::subset(['security','password'])->get('min_length',8) )
			throw new ValidationException('password',Messages::PASSWORD_MINLENGTH );

		$this->user->setPassword($password,!$this->request->isTrue('timeout') ); // Kennwort setzen
		
		// E-Mail mit dem neuen Kennwort an Benutzer senden
		if	( $this->request->isTrue('email') &&
			  $this->user->mail                      && // user has an e-mail.
			  Configuration::subset('mail')->is('enabled',true)
			) {
			$eMail = new Mail($this->user->mail, Messages::MAIL_SUBJECT_PASSWORD_NEW,Messages::MAIL_TEXT_PASSWORD_NEW);
			$eMail->setVar('name'    ,$this->user->getName());
			$eMail->setVar('password',$password          );
			$eMail->send();
			$this->addNoticeFor( $this->user, Messages::MAIL_SENT);
		}

		$this->addNoticeFor($this->user, Messages::SAVED);

    }
}
