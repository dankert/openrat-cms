<?php
namespace cms\action\projectlist;
use cms\action\Action;
use cms\action\Method;
use cms\action\ProjectlistAction;
use cms\model\Permission;
use cms\model\Folder;
use cms\model\Project;

class ProjectlistEditAction extends ProjectlistAction implements Method {

	public $security = Action::SECURITY_GUEST;

    public function view() {
		// Projekte ermitteln
		$list = array();

		// Schleife ueber alle Projekte
		foreach (Project::getAllProjects() as $id => $name) {

			$project = new Project($id);
			$rootFolder = new Folder($project->getRootObjectId());
			$rootFolder->load();

			// Berechtigt für das Projekt?
			if ($rootFolder->hasRight(Permission::ACL_READ)) {
				$list[$id]             = array();
				$list[$id]['id'      ] = $id;
				$list[$id]['name'    ] = $name;
			}
		}

		$this->setTemplateVar('projects',$list);
		$this->setTemplateVar('add',$this->userIsAdmin());
    }
    public function post() {
    }
}
