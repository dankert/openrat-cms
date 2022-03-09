<?php
namespace cms\action\model;
use cms\action\Method;
use cms\action\ModelAction;
use language\Messages;


class ModelRemoveAction extends ModelAction implements Method {
    public function view() {
		$this->model->load();

		$this->setTemplateVar( 'name',$this->model->name );
    }
    public function post() {
		if   ( $this->request->isTrue('confirm') )
		{
			$this->model->delete();
			$this->addNoticeFor( $this->model, Messages::DONE );
		}
		else
		{
			$this->addWarningFor( $this->model, Messages::NOTHING_DONE);
		}
    }
}
