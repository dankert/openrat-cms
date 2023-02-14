<?php
namespace cms\action\model;
use cms\action\Method;
use cms\action\ModelAction;
use cms\model\Project;
use language\Messages;
use util\exception\ClientException;


class ModelRemoveAction extends ModelAction implements Method {
    public function view() {
		$this->model->load();

		$project = Project::create( $this->model->projectid );

		// There must be at least 1 model
		if   ( count( $project->getModelIds() ) <= 1 )
			throw new ClientException('There must be at least 1 model.');

		$this->setTemplateVar( 'name',$this->model->name );
    }



    public function post() {

		if   ( $this->request->isTrue('confirm') )
		{
			$project = Project::create( $this->model->projectid );

			// There must be at least 1 model
			if   ( count( $project->getModelIds() ) > 1 ) {
				$this->model->delete();
				$this->addNoticeFor($this->model, Messages::DONE);
			}else {
				$this->addWarningFor( $this->model, Messages::NOTHING_DONE);
			}
		}
		else
		{
			$this->addWarningFor( $this->model, Messages::NOTHING_DONE);
		}
    }
}
