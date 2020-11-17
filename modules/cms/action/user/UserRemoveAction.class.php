<?php
namespace cms\action\user;
use cms\action\Method;
use cms\action\UserAction;
use language\Messages;


class UserRemoveAction extends UserAction implements Method {
    public function view() {
		$this->setTemplateVars( $this->user->getProperties() );
    }
    public function post() {
		$this->user->delete();
		$this->addNoticeFor( $this->user ,Messages::DELETED);
    }
}
