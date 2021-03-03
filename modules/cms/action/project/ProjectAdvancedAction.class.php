<?php
namespace cms\action\project;
use cms\action\Method;
use cms\action\ProjectAction;
use language\Messages;

class ProjectAdvancedAction extends ProjectAction implements Method {
    public function view() {
    }
    public function post() {
		switch( $this->request->getText('type') )
		{
			case 'check_files':
				// Konsistenzprüfungen
				$log = $this->project->checkLostFiles();

				$this->addNoticeFor($this->project,Messages::DONE, [], implode("\n",$log) );
				break;
				
			case 'check_limit':
				// Alte Versionen löschen.
				$this->project->checkLimit();
				$this->addNoticeFor($this->project,Messages::DONE);
				break;
				
			default:
				$this->addValidationError('type');
		}
    }
}
