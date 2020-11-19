<?php
namespace cms\action\user;
use cms\action\Method;
use cms\action\UserAction;
use cms\model\Group;
use language\Messages;


class UserMembershipsAction extends UserAction implements Method {
    public function view() {
		$gruppenListe = array();
		
		$allGroups  = Group::getAll();
		$userGroups = $this->user->getGroups();
		
		foreach( $allGroups as $id=>$name )
		{
			
			$hasGroup = array_key_exists($id,$userGroups);
			$varName  = 'group'.$id;
			$gruppenListe[$id] = array('name'       =>$name,
			                           'id'         =>$id,
			                           'var'        =>$varName,
			                           'member'     =>$hasGroup
			                          );
			$this->setTemplateVar($varName,$hasGroup);
		}
		$this->setTemplateVar('memberships',$gruppenListe);
    }

    public function post() {
		$allGroups  = Group::getAll();
		$userGroups = $this->user->getGroups();
		$aenderung = false;
		
		foreach( $allGroups as $id=>$name )
		{
			$hasGroup = array_key_exists($id,$userGroups);
			
			if	( !$hasGroup && $this->hasRequestVar('group'.$id) )
				$this->user->addGroup($id);

			if	( $hasGroup && !$this->hasRequestVar('group'.$id) )
				$this->user->delGroup($id);
		}
		
		$this->addNoticeFor($this->user,Messages::GROUP_MEMBERSHIPS_UPDATED);
    }
}
