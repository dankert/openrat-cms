<?php
namespace cms\action\projectlist;
use cms\action\Action;
use cms\action\Method;
use cms\action\ProjectlistAction;
use cms\model\Permission;
use cms\model\Folder;
use cms\model\Project;

class ProjectlistEditAction extends ProjectlistAction implements Method {

	/**
	 * Get a listing of all readable projects.
	 *
	 * @return void
	 */
    public function view() {

		$list = array();

		foreach (Project::getAllProjects() as $id => $name) {

			$project    = new Project($id);
			$rootFolder = new Folder($project->getRootObjectId());

			// Check permission, the user must have the READ permission.
			if ($rootFolder->hasRight(Permission::ACL_READ)) {
				$list[ $id ] = [
					'id'      => $id,
					'name'    => $name,
				];
			}
		}

		$this->setTemplateVar('projects',$list);
		$this->setTemplateVar('add',$this->userIsAdmin());
    }


    public function post() {
    }


	/**
	 * Check permission.
	 * This action is allowed to all users.
	 *
	 * @return true
	 */
	function checkAccess()
	{
		return true;
	}
}
