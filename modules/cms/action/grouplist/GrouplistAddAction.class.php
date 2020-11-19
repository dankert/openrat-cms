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
			$this->group->persist();
			$this->addNotice('group', 0, $this->group->name, 'ADDED', 'ok');
		}
		else
		{
			$this->addValidationError('name');
		}
    }
}
