<?php
namespace cms\action\user;
use cms\action\Method;
use cms\action\UserAction;
use cms\model\User;

class UserListingAction extends UserAction implements Method {
    public function view() {
		$list = array();

		foreach( User::getAllUsers() as $user )
		{
		    /* @var $user User */
			$list[$user->userid]         = $user->getProperties();
		}
		$this->setTemplateVar('el',$list);
	}	
		
    public function post() {
    }
}
