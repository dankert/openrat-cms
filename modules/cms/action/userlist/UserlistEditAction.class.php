<?php
namespace cms\action\userlist;
use cms\action\Method;
use cms\action\UserlistAction;
use cms\model\User;

/**
 * Shows all users.
 */
class UserlistEditAction extends UserlistAction implements Method {

    public function view() {
		$list = array();

		foreach( User::getAllUsers() as $user )
		{
			$list[$user->userid]        = $user->getProperties();
			$list[$user->userid]['id' ] = $user->userid;
		}
		$this->setTemplateVar('list',$list);
    }


    public function post() {
    }
}
