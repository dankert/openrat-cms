<?php
namespace cms\action\profile;
use cms\action\Action;
use cms\action\Method;
use cms\action\ProfileAction;

class ProfilePingAction extends ProfileAction implements Method {

    public function view() {
    	// Only visible in API requests.
		$this->setTemplateVar('pong',1);
    }
    public function post() {
    }

    public function checkAccess() {
		return true;
	}
}
