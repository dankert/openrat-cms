<?php
namespace cms\action\grouplist;
use cms\action\GrouplistAction;
use cms\action\Method;
use cms\model\Group;
use language\Messages;

class GrouplistAddAction extends GrouplistAction implements Method {

	public function view() {
    }

    public function post() {

		$this->group = new Group();
		$this->group->name = $this->request->getRequiredText('name');
		$this->group->persist();

		$this->addNoticeFor( $this->group, Messages::ADDED);
    }
}
