<?php
namespace cms\action\projectlist;
use cms\action\Method;
use cms\action\ProjectlistAction;
use cms\model\Project;

class ProjectlistHistoryAction extends ProjectlistAction implements Method {
    public function view() {
		$result = Project::getAllLastChanges();
		$this->setTemplateVar('timeline', $result);
    }
    public function post() {
    }
}
