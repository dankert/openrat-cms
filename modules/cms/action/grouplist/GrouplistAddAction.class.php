<?php
namespace cms\action\grouplist;
use cms\action\GrouplistAction;
use cms\action\Method;
use cms\model\Group;

class GrouplistAddAction extends GrouplistAction implements Method {
    public function view() {
    }
    public function post() {
		if	( $this->getRequestVar('name') != '')
		{
			$this->group = new Group();
			$this->group->name = $this->getRequestVar('name');
			$this->group->add();
			$this->addNotice('group', 0, $this->group->name, 'ADDED', 'ok');
			$this->callSubAction('listing');
		}
		else
		{
			$this->addValidationError('name');
			$this->callSubAction('add');
		}
    }
}
