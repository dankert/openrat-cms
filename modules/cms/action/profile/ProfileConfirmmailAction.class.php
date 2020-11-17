<?php
namespace cms\action\profile;
use cms\action\Method;
use cms\action\ProfileAction;
use language\Messages;
use util\exception\ValidationException;
use util\Session;

class ProfileConfirmmailAction extends ProfileAction implements Method {
    public function view() {
    }
    public function post() {
		$sessionCode       = Session::get( Session::KEY_MAIL_CHANGE_CODE );
		$newMail           = Session::get( Session::KEY_MAIL_CHANGE_MAIL );
		$inputRegisterCode = $this->getRequestVar('code');
		
		if	( $sessionCode == $inputRegisterCode )
		{
			// Best�tigungscode stimmt �berein.
			// E-Mail-Adresse �ndern.	
			$this->user->mail = $newMail;
			$this->user->save();
			
			$this->addNoticeFor( $this->user,Messages::SAVED );
		}
		else
		{
			// Validation code does not match
			throw new ValidationException('code',Messages::CODE_NOT_MATCH );
		}
		
    }
}
