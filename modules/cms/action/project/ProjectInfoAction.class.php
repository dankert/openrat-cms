<?php
namespace cms\action\project;
use cms\action\Method;
use cms\action\ProjectAction;

class ProjectInfoAction extends ProjectAction implements Method {

	public function view() {
		$this->setTemplateVar( 'info', $this->project->info() );
		$this->setTemplateVar( 'name', $this->project->name   );
		$this->setTemplateVar( 'url' , $this->makeAbsoluteHostnameLink($this->project->url)  );
    }

    public function post() {
    }
}
