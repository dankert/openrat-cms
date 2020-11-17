<?php
namespace cms\action\group;
use cms\action\Action;
use cms\action\GroupAction;
use cms\action\Method;

class GroupRemoveAction extends GroupAction implements Method {
    public function view() {
		$this->setTemplateVars( $this->group->getProperties() );
    }

    public function post() {
		if   ( $this->hasRequestVar('confirm') )
		{
			$this->group->delete();
	
			$this->addNotice('group', 0, $this->group->name, 'DELETED', Action::NOTICE_OK);
		}
		else
		{
			$this->addNotice('group', 0, $this->group->name, 'NOTHING_DONE', Action::NOTICE_WARN);
		}
    }
}
