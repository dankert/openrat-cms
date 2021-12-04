<?php
namespace cms\action\pageelement;
use cms\action\Method;
use cms\action\PageelementAction;
use cms\model\Element;
use cms\model\PageContent;
use cms\model\Template;
use cms\model\User;

class PageelementInfoAction extends PageelementAction implements Method {

    public function view() {

		$this->element->load();

		$this->setTemplateVar('name'          ,$this->element->name     );
		$this->setTemplateVar('description'   ,$this->element->desc     );
		$this->setTemplateVar('elementid'     ,$this->element->elementid);
        $this->setTemplateVar('element_id'    ,$this->element->elementid );
        $this->setTemplateVar('element_name'  ,$this->element->name );
		$this->setTemplateVar('element_type'  ,$this->element->getTypeName() );
		$this->setTemplateVar('element_format',Element::getAvailableFormats()[ $this->element->format] );

		$this->setTemplateVar('lastchange_date',0);

		$t = new Template( $this->page->templateid );
		$t->load();
		$this->setTemplateVar('template_name',$t->name );
		$this->setTemplateVar('template_id'  ,$t->templateid );
    }


    public function post() {
    }
}
