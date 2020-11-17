<?php
namespace cms\action\pageelement;
use cms\action\Method;
use cms\action\PageelementAction;
use cms\model\Element;
use cms\model\Template;
use cms\model\User;

class PageelementInfoAction extends PageelementAction implements Method {

    public function view() {
		$this->value->languageid = $this->page->languageid;
		$this->value->objectid   = $this->page->objectid;
		$this->value->pageid     = $this->page->pageid;
		$this->value->page       = $this->page;
		$this->value->simple = false;
		$this->value->element = &$this->element;
		$this->value->element->load();
		$this->value->load();

		$this->setTemplateVar('name'          ,$this->value->element->name     );
		$this->setTemplateVar('description'   ,$this->value->element->desc     );
		$this->setTemplateVar('elementid'     ,$this->value->element->elementid);
        $this->setTemplateVar('element_id'    ,$this->value->element->elementid );
        $this->setTemplateVar('element_name'  ,$this->value->element->name );
		$this->setTemplateVar('element_type'  ,$this->value->element->getTypeName() );
		$this->setTemplateVar('element_format',Element::getAvailableFormats()[ $this->value->element->format] );
		$this->setTemplateVar('format'        ,@Element::getAvailableFormats()[ $this->value->format         ] );

		$user = new User( $this->value->lastchangeUserId );

		try{
            $user->load();
        }catch (\util\exception\ObjectNotFoundException $e) {
		    $user = new User(); // Empty User.
        }

        $this->setTemplateVar('lastchange_user',$user->getProperties());
        $this->setTemplateVar('lastchange_date',$this->value->lastchangeTimeStamp);

		$t = new Template( $this->page->templateid );
		$t->load();
		$this->setTemplateVar('template_name',$t->name );
		$this->setTemplateVar('template_id'  ,$t->templateid );
    }


    public function post() {
    }
}
