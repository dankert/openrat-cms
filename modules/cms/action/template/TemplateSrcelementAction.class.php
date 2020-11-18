<?php
namespace cms\action\template;
use cms\action\Method;
use cms\action\RequestParams;
use cms\action\TemplateAction;
use cms\model\Element;
use language\Messages;
use util\exception\ValidationException;


class TemplateSrcelementAction extends TemplateAction implements Method {
    public function view() {
		$elements           = array();
		$writable_elements = array();
	
		foreach( $this->template->getElementIds() as $elid )
		{
			$element = new Element( $elid );
			$element->load();

			$elements[$elid] = $element->name;

			if	( $element->isWritable() )
				$writable_elements[$elid] = $element->name;
		}

		$this->setTemplateVar('elements'         ,$elements         );
		$this->setTemplateVar('writable_elements',$writable_elements);
    }



    public function post() {
		$tplModel = $this->template->loadTemplateModelFor( $this->request->getRequestVar(RequestParams::PARAM_MODEL_ID));

		$elementToAdd = new Element( $this->getRequestVar('elementid') );
		$elementToAdd->load();

		switch( $this->getRequestVar('type') )
		{
			case 'addelement':
				$tplModel->src .= "\n".'{{'.$elementToAdd->name.'}}';
				break;
		
			default:
				throw new ValidationException('type');
		}
		
		$tplModel->persist();

		$this->addNoticeFor($this->template,Messages::SAVED);
    }
}
