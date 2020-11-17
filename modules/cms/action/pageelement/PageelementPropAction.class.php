<?php
namespace cms\action\pageelement;
use cms\action\Method;
use cms\action\PageelementAction;
use cms\model\Template;
use cms\model\User;
use util\Html;

class PageelementPropAction extends PageelementAction implements Method {

    public function view() {
		$this->value->languageid = $this->page->languageid;
		$this->value->objectid   = $this->page->objectid;
		$this->value->pageid     = $this->page->pageid;
		$this->value->page       = $this->page;
		$this->value->simple = false;
		$this->value->element = &$this->element;
		$this->value->element->load();
		$this->value->load();

		$this->setTemplateVar('name'        ,$this->value->element->name     );
		$this->setTemplateVar('description' ,$this->value->element->desc     );
		$this->setTemplateVar('elementid'   ,$this->value->element->elementid);
		$this->setTemplateVar('element_type',$this->value->element->type     );

		$user = new User( $this->value->lastchangeUserId );
		$user->load();
		$this->setTemplateVar('lastchange_user',$user->getProperties());
		$this->setTemplateVar('lastchange_date',$this->value->lastchangeTimeStamp);

		$t = new Template( $this->page->templateid );
		$t->load();
		$this->setTemplateVar('template_name',$t->name );
		$this->setTemplateVar('template_url' ,Html::url('template','prop',$t->templateid) );

		$this->setTemplateVar('element_name' ,$this->value->element->name );
		$this->setTemplateVar('element_url'  ,Html::url('element','name',$this->value->element->elementid) );
    }

    public function post() {
    }
}
