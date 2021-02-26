<?php
namespace cms\action\profile;
use cms\action\Method;
use cms\action\ProfileAction;
use language\Messages;
use logger\Logger;
use util\exception\ValidationException;
use util\Mail;
use util\Session;
use util\text\TextMessage;

class ProfileMailAction extends ProfileAction implements Method {

    public function view() {
    }

    public function post() {
		srand ((double)microtime()*1000003);
		$code = rand(); // Zufalls-Freischaltcode erzeugen
		$newMail = $this->request->getText('mail');

		if	( !$newMail )
		{
			// Keine E-Mail-Adresse eingegeben.
			throw new ValidationException('mail');
		}
		else
		{
			// Der Freischaltcode wird in der Sitzung gespeichert.
			Session::set( Session::KEY_MAIL_CHANGE_CODE,$code   );
			Session::set( Session::KEY_MAIL_CHANGE_MAIL,$newMail);
			
			// E-Mail an die neue Adresse senden.
			$mail = new Mail($newMail, Messages::MAIL_SUBJECT_MAIL_CHANGE_CODE,Messages::MAIL_TEXT_MAIL_CHANGE_CODE);
			$mail->setVar('code',$code                 );
			$mail->setVar('name',$this->user->getName());

			try {
				$mail->send();
				$this->addNoticeFor( $this->user, Messages::MAIL_SENT);
			} catch( \Exception $e ) {
				Logger::warn( new \Exception( TextMessage::create('Mail could not be sent for user ${name} with the new email adress {mail} ',['name'=>$this->user->name,'mail'=>$newMail]),$e) );
				$this->addNoticeFor($this->user, Messages::MAIL_NOT_SENT );
			}
		}
    }
}
