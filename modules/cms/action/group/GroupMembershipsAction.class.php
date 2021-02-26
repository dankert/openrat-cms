<?php
namespace cms\action\group;
use cms\action\GroupAction;
use cms\action\Method;
use cms\model\User;
use language\Messages;

class GroupMembershipsAction extends GroupAction implements Method {

    public function view() {
		// Mitgliedschaften ermitteln
		//
		$userliste = array();
		
		$allUsers = User::listAll();
		
		$actualGroupUsers = $this->group->getUsers();
		
		foreach( $allUsers as $id=>$name )
		{
			$hasUser = array_key_exists($id,$actualGroupUsers);
			$varName  = 'user'.$id;
			$userliste[$id] = array('name'       => $name,
			                        'id'         => $id,
			                        'var'        => $varName,
			                        'member'     => $hasUser
			                        );
			$this->setTemplateVar($varName,$hasUser);
		}
		$this->setTemplateVar('memberships',$userliste);
    }

    public function post() {

		$allUsers  = User::listAll();
		$groupUsers = $this->group->getUsers();
		
		foreach( $allUsers as $id=>$name )
		{
			$hasUser = array_key_exists($id,$groupUsers);
			
			if	( !$hasUser && $this->request->has('user'.$id) )
				$this->group->addUser($id);

			if	( $hasUser && !$this->request->has('user'.$id) )
				$this->group->delUser($id);
		}

		$this->addNoticeFor($this->group, Messages::USER_ADDED_TO_GROUP);
    }
}
