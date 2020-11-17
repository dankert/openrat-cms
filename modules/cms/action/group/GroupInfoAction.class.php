<?php
namespace cms\action\group;
use cms\action\GroupAction;
use cms\action\Method;

class GroupInfoAction extends GroupAction implements Method {
    public function view() {
		$this->setTemplateVars( $this->group->getProperties() );
		$this->setTemplateVar( 'users',$this->group->getUsers() );
    }


    public function post() {
    }
}
