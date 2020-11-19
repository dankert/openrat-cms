<?php
namespace cms\action\project;
use cms\action\Method;
use cms\action\ProjectAction;
use language\Messages;

class ProjectRemoveAction extends ProjectAction implements Method {

    public function view() {

		$this->setTemplateVar( 'name',$this->project->name );
    }


    public function post() {

		// Gesamtes Projekt loeschen
		$this->project->delete();

		$this->addNoticeFor( $this->project,Messages::DELETED);
    }
}
