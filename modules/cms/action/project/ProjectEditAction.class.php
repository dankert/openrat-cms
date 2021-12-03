<?php
namespace cms\action\project;
use cms\action\Action;
use cms\action\Method;
use cms\action\ProjectAction;
use cms\model\Folder;
use cms\model\Permission;
use util\exception\SecurityException;

class ProjectEditAction extends ProjectAction implements Method {

    public function view() {

		$this->setTemplateVar('name'            ,$this->project->name);
        $this->setTemplateVar('projectid'       ,$this->project->projectid);
        $this->setTemplateVar('rootobjectid'    ,$this->project->getRootObjectId());
        $this->setTemplateVar('is_project_admin',$this->userIsProjectAdmin());
    }
    public function post() {
    }



	/**
	 * the root object must be readable by the current user.
	 */
	public function checkAccess() {
		$rootFolderId = $this->project->getRootObjectId();

		$rootFolder = new Folder( $rootFolderId );
		$rootFolder->load();

		if   ( ! $rootFolder->hasRight( Permission::ACL_READ )  )
			throw new SecurityException();
	}

}
