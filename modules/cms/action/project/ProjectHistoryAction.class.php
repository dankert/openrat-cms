<?php
namespace cms\action\project;
use cms\action\Method;
use cms\action\ProjectAction;

class ProjectHistoryAction extends ProjectAction implements Method {
    public function view() {
		$result = $this->project->getLastChanges();
	
		$this->setTemplateVar('timeline', $result);
    }
    public function post() {
    }
}
