<?php
namespace cms\action\projectlist;
use cms\action\Action;
use cms\action\Method;
use cms\action\ProjectlistAction;
use cms\model\Project;
use language\Messages;
use util\exception\SecurityException;

class ProjectlistAddAction extends ProjectlistAction implements Method {

    public function view() {

    }


	/**
	 * Add a new project.
	 */
    public function post() {

		$name = $this->request->getRequiredText('name');

		$project = new Project();
		$project->name = $name;
		$project->persist();

		$this->addNoticeFor( $project,Messages::ADDED );
    }


    public function checkAccess()
	{
		if   ( ! $this->userIsAdmin() )
			throw new SecurityException();
	}
}
