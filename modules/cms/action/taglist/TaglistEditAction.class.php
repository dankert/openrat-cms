<?php
namespace cms\action\taglist;
use cms\action\Method;
use cms\action\TaglistAction;
use cms\model\Permission;
use cms\model\Folder;

class TaglistEditAction extends TaglistAction implements Method {

	/**
	 * Get a listing of all tags in the project
	 *
	 * @return void
	 */
    public function view() {

		$this->setTemplateVar('tags',$this->project->getTags() );

		// is the user allowed to add tags?
		$rootFolder = new Folder( $this->project->getRootObjectId() );
		$this->setTemplateVar('add' ,$rootFolder->hasRight(Permission::ACL_PROP)      );
    }


    public function post() {
    }

}
