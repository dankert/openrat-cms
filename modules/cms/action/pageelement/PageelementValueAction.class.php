<?php
namespace cms\action\pageelement;
use cms\action\Method;
use cms\action\PageelementAction;
use cms\model\Permission;
use cms\model\Page;

class PageelementValueAction extends PageelementAction implements Method {

    public function view() {
		$this->value->languageid = $this->page->languageid;
		$this->value->objectid   = $this->page->objectid;
		$this->value->pageid     = $this->page->pageid;
		$this->value->element = &$this->element;
		$this->value->elementid = &$this->element->elementid;
		$this->value->element->load();
		$this->value->publish = false;


		$valueId =$this->getRequestId('valueid');
		if   ( $valueId ) {
			$this->value->valueid = $valueId;
			$this->value->loadWithId();
		}
		else {
			$this->value->load();
		}

		$this->setTemplateVar('name'     ,$this->value->element->name     );
		$this->setTemplateVar('desc'     ,$this->value->element->desc     );
		$this->setTemplateVar('elementid',$this->value->element->elementid);
		$this->setTemplateVar('languageid',$this->value->languageid       );
		$this->setTemplateVar('type'     ,$this->value->element->getTypeName() );
		$this->setTemplateVar('value_time',time() );


		$this->value->page             = new Page( $this->page->objectid );
		$this->value->page->languageid = $this->value->languageid;
		$this->value->page->load();

		$this->setTemplateVar( 'objectid',$this->value->page->objectid );

		if	( $this->value->page->hasRight(Permission::ACL_RELEASE) )
		$this->setTemplateVar( 'release',true  );
		if	( $this->value->page->hasRight(Permission::ACL_PUBLISH) )
		$this->setTemplateVar( 'publish',false );

		$funktionName = 'edit'.$this->value->element->type;

		if	( ! method_exists($this,$funktionName) )
		throw new \LogicException('Method does not exist: PageElementAction#'.$funktionName );

		$this->$funktionName(); // Aufruf der Funktion "edit<Elementtyp>()".
    }


    public function post() {
        $this->element->load();
        $type = $this->element->type;

        if	( empty($type))
            throw new \InvalidArgumentException('No element type available');

        $funktionName = 'save'.$type;

        if  ( !method_exists($this,$funktionName))
            throw new \InvalidArgumentException('Function not available: '.$funktionName);

        $this->$funktionName(); // Aufruf Methode "save<ElementTyp>()"
    }
}
