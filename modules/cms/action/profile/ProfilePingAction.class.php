<?php
namespace cms\action\profile;
use cms\action\Action;
use cms\action\Method;
use cms\action\ProfileAction;

class ProfilePingAction extends ProfileAction implements Method {

	public $security = Action::SECURITY_GUEST;

    public function view() {
		$this->setTemplateVar('pong',1);
    }
    public function post() {
    }
}
