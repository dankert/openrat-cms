<?php
namespace cms\action\model;
use cms\action\Method;
use cms\action\ModelAction;
use language\Messages;


class ModelSetdefaultAction extends ModelAction implements Method {
    public function view() {
    }
    public function post() {
		if	( !$this->userIsAdmin() ) exit();

		$this->model->setDefault();

		$this->addNoticeFor( $this->model, Messages::DONE );
    }
}
