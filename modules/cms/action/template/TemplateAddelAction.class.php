<?php
namespace cms\action\template;
use cms\action\Action;
use cms\action\Method;
use cms\action\RequestParams;
use cms\action\TemplateAction;
use cms\model\Element;
use cms\model\Project;
use cms\model\Template;
use language\Messages;


class TemplateAddelAction extends TemplateAction implements Method {
    public function view() {
		// Die verschiedenen Element-Typen
		$types = array();

		foreach( Element::getAvailableTypes() as $typeid => $t )
		{
			$types[ $typeid ] = 'EL_'.$t;
		}

		// Code-Element nur fuer Administratoren (da voller Systemzugriff!)		
		if	( !$this->userIsAdmin() )
			unset( $types[Element::ELEMENT_TYPE_CODE] );

		// Auswahlmoeglichkeiten:
		$this->setTemplateVar('types',$types);

		// Vorbelegung:
		$this->setTemplateVar('typeid',Element::ELEMENT_TYPE_TEXT);
    }
    public function post() {

		$name = $this->getRequestVar('name',RequestParams::FILTER_ALPHANUM);

		if  ( empty($name) )
		    throw new \util\exception\ValidationException('name');

		$newElement = $this->template->addElement( $name,$this->getRequestVar('description'),$this->getRequestVar('typeid') );

		if	( $this->hasRequestVar('addtotemplate') )
		{
		    $project  = new Project( $this->template->projectid);
		    $modelIds = $project->getModelIds();

		    foreach( $modelIds as $modelId )
            {
                $template = new Template( $this->template->templateid );
                $templateModel = $template->loadTemplateModelFor( $modelId );
                $templateModel->load();
                $templateModel->src .= "\n".'{{'.$newElement->name.'}}';
                $templateModel->persist();
            }

		}

		$this->addNoticeFor($this->template,Messages::SAVED);
    }
}
