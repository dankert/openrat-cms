<?php
namespace cms\action\login;
use cms\action\LoginAction;
use cms\action\Method;
use cms\action\RequestParams;
use cms\model\User;
use language\Messages;
use logger\Logger;
use util\Mail;
use util\Session;
use util\text\TextMessage;


class LoginRegisterAction extends LoginAction implements Method {
    public function view() {

    }
    public function post() {

		$email_address = $this->request->getVar('mail',RequestParams::FILTER_MAIL);

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
		$mail = new Mail($email_address, Messages::MAIL_SUBJECT_REGISTER_COMMIT_CODE,Messages::MAIL_TEXT_REGISTER_COMMIT_CODE);
		$mail->setVar('code',$registerCode); // Registrierungscode als Text-Variable

		try {
			$mail->send();
			$this->addNoticeFor( new User(), Messages::MAIL_SENT);
		} catch( \Exception $e ) {
			Logger::warn( new \Exception(TextMessage::create('Mail could not be sent for unregistered user with adress ${0}', [$email_address]), $e) );
			$this->addErrorFor( new User(),Messages::MAIL_NOT_SENT);
		}
    }
}
