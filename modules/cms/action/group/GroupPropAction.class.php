<?php
namespace cms\action\group;
use cms\action\GroupAction;
use cms\action\Method;
use cms\model\Group;
use language\Messages;


class GroupPropAction extends GroupAction implements Method {

    public function view() {

		$this->setTemplateVars( $this->group->getProperties() );

		$otherGroups = Group::getAll();

		unset( $otherGroups[$this->group->groupid] );

		foreach ( $this->group->getAllDescendantsIds() as $descendantGroupId )
			unset( $otherGroups[ $descendantGroupId ] );

		$this->setTemplateVar('groups',$otherGroups );
    }

    public function post() {

		if	( ! $this->getRequestVar('name') )
		    throw new \util\exception\ValidationException('name');

        $this->group->name     = $this->getRequestVar('name');
		$this->group->parentid = $this->getRequestId('parentid');
		if   ( ! $this->group->parentid )
			$this->group->parentid = null;

        $this->group->save();

        $this->addNoticeFor($this->group,Messages::SAVED);
    }
}
