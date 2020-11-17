<?php
namespace cms\action\login;
use cms\action\LoginAction;
use cms\action\Method;
use cms\base\Configuration;
use cms\base\DB;
use cms\model\User;
use language\Messages;
use security\Password;
use util\exception\ValidationException;
use util\Mail;
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
		$username = $this->getRequestVar('username');
		if	( ! $username  )
			throw new ValidationException('username');

		$user = User::loadWithName( $username,User::AUTH_TYPE_INTERNAL );

		Password::delay(); // Crypto-Wait

		if	( $user )
		{
			srand ((double)microtime()*1000003);
			$code = rand();
			$this->setSessionVar(Session::KEY_PASSWORD_COMMIT_CODE,$code);
			
			$eMail = new Mail( $user->mail,'password_commit_code' );
			$eMail->setVar('name',$user->getName());
			$eMail->setVar('code',$code);
			if	( $eMail->send() )
				$this->addNoticeFor( new User(), Messages::MAIL_SENT);
			else
				// Yes, the mail is not sent but we are faking a sent mail.
				// so no one is able to check if the username exists (if the mail system is down)
				$this->addNoticeFor( new User(), Messages::MAIL_SENT);

			$this->setSessionVar(Session::KEY_PASSWORD_COMMIT_NAME,$user->name);
		}
		else
		{
			// There is no user with this name.
			// We are faking a sending mail, so no one is able to check if this username exists.
			sleep(1);
			$this->addNoticeFor( new User(), Messages::MAIL_SENT);
		}
    }
}
