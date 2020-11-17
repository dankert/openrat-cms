<?php
namespace cms\action\user;
use cms\action\Method;
use cms\action\UserAction;
use cms\model\Group;
use language\Messages;

class UserAddgrouptouserAction extends UserAction implements Method {
    public function view() {

    }
    public function post() {
		$group = new Group( $this->request->getRequiredRequestId('groupid' ) );
		$group->load();

		$this->user->addGroup( $group->groupid );

		$this->addNoticeFor( $this->user, Messages::ADDED);
    }
}
