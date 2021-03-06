<?php
namespace cms\action\project;
use cms\action\Action;
use cms\action\Method;
use cms\action\ProjectAction;

class ProjectEditAction extends ProjectAction implements Method {

	public $security = Action::SECURITY_GUEST;

    public function view() {

		$this->setTemplateVar('name'            ,$this->project->name);
        $this->setTemplateVar('projectid'       ,$this->project->projectid);
        $this->setTemplateVar('rootobjectid'    ,$this->project->getRootObjectId());
        $this->setTemplateVar('is_project_admin',$this->userIsProjectAdmin());
    }
    public function post() {
    }
}
