<?php
namespace cms\action\model;
use cms\action\Method;
use cms\action\ModelAction;


class ModelEditAction extends ModelAction implements Method {

    public function view() {
		$this->model->load();
	
		$this->setTemplateVars( $this->model->getProperties() );
    }
    public function post() {
    }
}
