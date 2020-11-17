<?php
namespace cms\action\login;
use cms\action\LoginAction;
use cms\action\Method;
use cms\model\User;
use language\Messages;
use util\Mail;
use util\Session;


class LoginRegisterAction extends LoginAction implements Method {
    public function view() {

    }
    public function post() {
		$email_address = $this->getRequestVar('mail',RequestParams::FILTER_MAIL);

		if	( ! Mail::checkAddress($email_address) )
		{
			$this->addValidationError('mail');
			return;
		}

		Session::set( Session::KEY_REGISTER_MAIL,$email_address );
		
		srand ((double)microtime()*1000003);
		$registerCode = rand();
		
		Session::set( Session::KEY_REGISTER_CODE,$registerCode  );


		// E-Mail and die eingegebene Adresse verschicken
		$mail = new Mail($email_address,
		                 'register_commit_code');
		$mail->setVar('code',$registerCode); // Registrierungscode als Text-Variable
		
		if	( $mail->send() )
		{
			$this->addNoticeFor( new User(), Messages::MAIL_SENT);
		}
		else
		{
			$this->addErrorFor( new User(),Messages::MAIL_NOT_SENT, [], $mail->error);
		}
    }
}
