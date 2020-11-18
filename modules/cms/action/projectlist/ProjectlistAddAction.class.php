<?php
namespace cms\action\projectlist;
use cms\action\Method;
use cms\action\ProjectlistAction;
use cms\model\Project;
use language\Messages;
use util\exception\SecurityException;

class ProjectlistAddAction extends ProjectlistAction implements Method {

    public function view() {
	    if( ! $this->userIsAdmin() )
	        throw new SecurityException('user is not allowed to add a project');

		$this->setTemplateVar( 'projects',Project::getAllProjects() );
    }


    public function post() {

	    if( !$this->userIsAdmin())
	        throw new SecurityException();

		$projectid = $this->getRequestVar('projectid');

		if   ( $projectid ) {

			$db = \cms\base\DB::get();
			$project = Project::create($projectid);
			$project->load();
			$project->export($db->id);
			$this->addNoticeFor($project,Messages::DONE);

		} else {
			$name = $this->hasRequestVar('name');

			if	( !$name )
				throw new \util\exception\ValidationException('name');

			$project = new Project();
			$project->name = $name;
			$project->persist();
			$this->addNoticeFor($project,Messages::ADDED);

		}

    }
}
