<?php
namespace cms\action\profile;
use cms\action\Method;
use cms\action\ProfileAction;
use cms\base\Configuration;
use cms\model\User;

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

		if	( ! $this->user->checkPassword( $this->getRequestVar('act_password') ) )
		{
			$this->addValidationError('act_password');
		}
		elseif	( $this->getRequestVar('password1') == '' )
		{
			$this->addValidationError('password1');
		}
		elseif ( $this->getRequestVar('password1') != $this->getRequestVar('password2') )
		{
			$this->addValidationError('password2','PASSWORDS_DO_NOT_MATCH');
		}
		elseif ( strlen($this->getRequestVar('password1'))<$pwMinLength )
		{
			$this->addValidationError('password1','PASSWORD_MINLENGTH',array('minlength'=> $pwMinLength));
		}
		else
		{
			$this->user->setPassword( $this->getRequestVar('password1') );
			$this->addNotice('user', 0, $this->user->name, 'SAVED', 'ok');
		}
    }
}
