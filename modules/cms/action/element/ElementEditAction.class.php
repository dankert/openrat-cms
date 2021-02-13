<?php
namespace cms\action\element;
use cms\action\ElementAction;
use cms\action\Method;


class ElementEditAction extends ElementAction implements Method {
    public function view() {
		$this->setTemplateVar('id'  ,$this->element->elementid );
		$this->setTemplateVar('name',$this->element->name );
		$this->setTemplateVar('type',$this->element->getTypeName() );
    }


    public function post() {
    }
}
