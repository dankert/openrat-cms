<?php
namespace cms\action\login;
use cms\action\LoginAction;
use cms\action\Method;
use cms\base\Configuration;
use cms\base\DB;
use cms\model\User;
use language\Messages;
use logger\Logger;
use security\Password;
use util\exception\ValidationException;
use util\mail\Mail;
use util\Session;


class LoginPasswordAction extends LoginAction implements Method {
    public function view() {
		// TODO: Attribut "Password" abfragen

		$this->setTemplateVar( 'dbids',$this->getSelectableDatabases() );
		
		$db = DB::get();
		
		if	( is_object($db) )
			$this->setTemplateVar('actdbid',$db->id);
		else
			$this->setTemplateVar('actdbid', Configuration::subset('database-default')->get('default-id',''));
	}	
	
	



    public function post() {
		$username = $this->request->getText('username');
		if	( ! $username  )
			throw new ValidationException('username');

		$user = User::loadWithName( $username,User::AUTH_TYPE_INTERNAL );

		Password::delay(); // Crypto-Wait

		if	( $user )
		{
			srand ((double)microtime()*1000003);
			$code = rand();
			Session::set(Session::KEY_PASSWORD_COMMIT_CODE,$code);
			
			$eMail = new Mail($user->mail,Messages::MAIL_SUBJECT_PASSWORD_COMMIT_CODE,Messages::MAIL_TEXT_PASSWORD_COMMIT_CODE);
			$eMail->setVar('name',$user->getName());
			$eMail->setVar('code',$code);

			try {
				$eMail->send();
				Session::set(Session::KEY_PASSWORD_COMMIT_NAME,$user->name);
			}
			catch( \Exception $e ) {
				Logger::warn( $e );
			}
		}

		// For security reasons:
		// Always display a message that a mail is sent.
		// So no one is able to check if this username exists.
		sleep(1);
		$this->addNoticeFor( new User(), Messages::MAIL_SENT);
	}
}
