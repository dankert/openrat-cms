<?php
namespace cms\action\profile;
use cms\action\Method;
use cms\action\ProfileAction;
use cms\base\Configuration;
use cms\model\User;
use language\Messages;
use util\exception\ValidationException;
use util\Mail;

class ProfilePwAction extends ProfileAction implements Method {
    public function view() {
		// Kennwortänderung funktioniert natürlich nur in der internen Datenbank.
		//
		// Hier wird festgestellt, ob der Benutzer sich über die interne Datenbank angemeldet hat.
		// Nur dann kann man auch sein Kennwort ändern.
		$user             = $this->getUserFromSession();
		$pwchangePossible = $user->type == User::AUTH_TYPE_INTERNAL;
		$this->setTemplateVar('pwchange_enabled', $pwchangePossible);
    }



    public function post() {

		$pwMinLength = Configuration::subset(['security','password'])->get('min_length',10);

		if	( $this->user->type != User::AUTH_TYPE_INTERNAL )
			throw new \LogicException('password change only possible for internal users.');

		if	( ! $this->user->checkPassword( $this->request->getText('act_password') ) )
			throw new ValidationException('act_password');

		if	( $this->request->getText('password1') == '' )
			throw new ValidationException('password1');

		if ( $this->request->getText('password1') != $this->request->getText('password2') )
			throw new ValidationException('password2', Messages::PASSWORDS_DO_NOT_MATCH);

		if ( strlen($this->request->getText('password1'))<$pwMinLength )
			throw new ValidationException('password1',Messages::PASSWORD_MINLENGTH,array('minlength'=> $pwMinLength));

		$this->user->setPassword( $this->request->getText('password1') );
		$this->addNoticeFor( $this->user,Messages::SAVED);

		// Send mail to user to inform about the new password.
		if   ( $this->user->mail ) {
			$mail = new Mail( $this->user->mail,Messages::MAIL_PASSWORD_CHANGE_SUCCESS_SUBJECT,Messages::MAIL_PASSWORD_CHANGE_SUCCESS);
			$mail->send();
		}
    }
}
