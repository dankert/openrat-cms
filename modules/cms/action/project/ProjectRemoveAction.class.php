<?php
namespace cms\action\project;
use cms\action\Method;
use cms\action\ProjectAction;

class ProjectRemoveAction extends ProjectAction implements Method {
    public function view() {
		$this->setTemplateVar( 'name',$this->project->name );
    }


    public function post() {
		if   ( !$this->hasRequestVar('delete') )
		{
			$this->addValidationError('delete');
			return;
		}
		
		// Gesamtes Projekt loeschen
		$this->project->delete();

		$this->setTemplateVar('tree_refresh',true);
		$this->addNotice('project', 0, $this->project->name, 'DELETED');
    }
}
