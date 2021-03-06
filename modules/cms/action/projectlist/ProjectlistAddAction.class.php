<?php
namespace cms\action\projectlist;
use cms\action\Action;
use cms\action\Method;
use cms\action\ProjectlistAction;
use cms\model\Project;
use language\Messages;
use util\exception\SecurityException;

class ProjectlistAddAction extends ProjectlistAction implements Method {

	public $security = Action::SECURITY_ADMIN;

    public function view() {

		$this->setTemplateVar( 'projects',Project::getAllProjects() );
    }


    public function post() {

		/*
		$projectid = $this->request->getVar('projectid');

		if   ( $projectid ) {

			$db = \cms\base\DB::get();
			$project = Project::create($projectid);
			$project->load();
			$project->export($db->id);
			$this->addNoticeFor($project,Messages::DONE);

		} else {*/

		$name = $this->request->getRequiredText('name');

		$project = new Project();
		$project->name = $name;
		$project->persist();

		$this->addNoticeFor( $project,Messages::ADDED );
		//}

    }
}
