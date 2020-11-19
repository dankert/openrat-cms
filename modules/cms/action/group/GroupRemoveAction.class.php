<?php
namespace cms\action\group;
use cms\action\GroupAction;
use cms\action\Method;
use language\Messages;

/**
 * Removing this group.
 */
class GroupRemoveAction extends GroupAction implements Method {

    public function view() {
		$this->setTemplateVars( $this->group->getProperties() );
    }


    public function post() {

		$this->group->delete();
		$this->addNoticeFor($this->group, Messages::DELETED);
    }
}
