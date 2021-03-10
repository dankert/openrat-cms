<?php
namespace cms\action\group;
use cms\action\GroupAction;
use cms\action\Method;
use cms\model\Group;
use language\Messages;
use util\exception\ValidationException;


class GroupPropAction extends GroupAction implements Method {

	/**
	 * Reads the properties of this group.
	 */
    public function view() {

		$this->setTemplateVars( $this->group->getProperties() );

		$otherGroups = Group::getAll();

		unset( $otherGroups[$this->group->groupid] );

		foreach ( $this->group->getAllDescendantsIds() as $descendantGroupId )
			unset( $otherGroups[ $descendantGroupId ] );

		$this->setTemplateVar('groups',$otherGroups );
    }


	/**
	 * Store the group properties.
	 *
	 * @throws ValidationException
	 */
    public function post() {

        $this->group->name     = $this->request->getRequiredText('name');
		$this->group->parentid = $this->request->getNumber('parentid');

		if   ( ! $this->group->parentid )
			$this->group->parentid = null;

        $this->group->persist();

        $this->addNoticeFor($this->group,Messages::SAVED);
    }
}
