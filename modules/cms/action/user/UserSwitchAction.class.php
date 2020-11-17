<?php
namespace cms\action\user;
use cms\action\Method;
use cms\action\UserAction;
use language\Messages;
use util\Session;


class UserSwitchAction extends UserAction implements Method {
    public function view() {
		$this->setTemplateVar('username',$this->user->getName() );
    }
    public function post() {
		$this->addNoticeFor( $this->user,Messages::USER_LOGIN );

		// Und in der Sitzung speichern.
		Session::setUser( $this->user );
    }
}
