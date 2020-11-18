<?php
namespace cms\action\login;
use cms\action\LoginAction;
use cms\action\Method;
use cms\base\Configuration;
use cms\base\DB;
use cms\model\User;
use language\Messages;
use util\exception\ValidationException;
use util\Session;


class LoginRegistercodeAction extends LoginAction implements Method {
    public function view() {
		$conf = Configuration::rawConfig();

		$this->setTemplateVar( 'dbids',$this->getSelectableDatabases() );
		
		$db = DB::get();
		if	( $db )
			$this->setTemplateVar('actdbid',$db->id);
		else
			$this->setTemplateVar('actdbid',$conf['database-defaults']['default-id']);
		
		
		
    }



    public function post() {
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
		$newUser->mail = Session::get( Session::KEY_REGISTER_MAIL );

		$newUser->persist();

		$newUser->setPassword( $this->getRequestVar('password'),true );
			
		$this->addNotice('user', 0, $newUser->name, 'user_added', 'ok');
    }
}
