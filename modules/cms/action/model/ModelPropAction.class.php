<?php
namespace cms\action\model;
use cms\action\Method;
use cms\action\ModelAction;
use language\Messages;


class ModelPropAction extends ModelAction implements Method {

    public function view() {
        $this->setTemplateVar('name'      ,$this->model->name      );
        $this->setTemplateVar('is_default',$this->model->isDefault );
    }

    public function post() {
        if	( $this->hasRequestVar('name') ) {
            $this->model->name = $this->getRequestVar('name');
            $this->model->save();
        }

        if  ( $this->hasRequestVar('is_default') )
            $this->model->setDefault();

        $this->addNoticeFor( $this->model, Messages::DONE );
    }
}
