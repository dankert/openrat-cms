<?php
namespace cms\action\profile;
use cms\action\Method;
use cms\action\ProfileAction;
use language\Messages;
use logger\Logger;
use util\exception\ValidationException;
use util\Mail;
use util\Session;

class ProfileMailAction extends ProfileAction implements Method {
    public function view() {
    }
    public function post() {
		srand ((double)microtime()*1000003);
		$code = rand(); // Zufalls-Freischaltcode erzeugen
		$newMail = $this->getRequestVar('mail');

		if	( empty($newMail) )
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
			$mail = new Mail( $newMail,'mail_change_code' );
			$mail->setVar('code',$code                 );
			$mail->setVar('name',$this->user->getName());
			
			if	( $mail->send() )
			{
				$this->addNoticeFor( $this->user, Messages::MAIL_SENT);
			}
			else
			{
				Logger::warn('Mail could not be sent: '.$mail->error);
				$this->addNoticeFor($this->user, Messages::MAIL_NOT_SENT,[],$mail->error); // Meldung
			}
		}
    }
}
