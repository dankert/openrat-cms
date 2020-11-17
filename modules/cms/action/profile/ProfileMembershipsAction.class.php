<?php
namespace cms\action\profile;
use cms\action\Method;
use cms\action\ProfileAction;


class ProfileMembershipsAction extends ProfileAction implements Method {
    public function view() {
		$this->setTemplateVar( 'groups',$this->user->getGroups() );
    }
    public function post() {
    }
}
