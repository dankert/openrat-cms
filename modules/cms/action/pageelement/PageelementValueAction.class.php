<?php
namespace cms\action\pageelement;
use cms\action\Method;
use cms\action\PageelementAction;
use cms\base\Startup;
use cms\model\PageContent;
use cms\model\Permission;
use cms\model\Page;

class PageelementValueAction extends PageelementAction implements Method {

	protected function getRequiredPagePermission()
	{
		return Permission::ACL_WRITE;
	}

	public function view() {

		$this->element->load();
		$this->pageContent->load();

		$this->value->contentid = $this->pageContent->contentId;

		$valueId =$this->request->getNumber('valueid');

		if   ( $valueId ) {
			$this->ensureValueIdIsInAnyContent( $valueId );

			$this->value->valueid = $valueId;
			$this->value->loadWithId();
		}
		else {
			$this->value->load();
		}

		$this->setTemplateVar('name'      ,$this->element->name     );
		$this->setTemplateVar('desc'      ,$this->element->desc     );
		$this->setTemplateVar('elementid' ,$this->element->elementid);
		$this->setTemplateVar('languageid',$this->pageContent->languageid );
		$this->setTemplateVar('type'      ,$this->element->getTypeName() );
		$this->setTemplateVar('value_time',Startup::getStartTime() );

		$this->setTemplateVar( 'objectid' ,$this->page->objectid );

		if	( $this->page->hasRight(Permission::ACL_RELEASE) )
			$this->setTemplateVar( 'release',true  );

		if	( $this->page->hasRight(Permission::ACL_PUBLISH) )
			$this->setTemplateVar( 'publish',false );

		$methodName = 'edit'.ucfirst($this->element->getTypeName());

		if	( ! method_exists($this,$methodName) )
			throw new \LogicException('Method does not exist: PageElementAction#'.$methodName );

		$this->$methodName(); // Call method "edit<Elementtyp>()".
    }


    public function post() {

        $this->element->load();

        $type = $this->element->getTypeName();

        $methodName = 'save'.ucfirst($type);

        if  ( !method_exists($this,$methodName))
            throw new \InvalidArgumentException('Method not available: '.$methodName);

        $this->$methodName(); // Call method "save<ElementType>()"
    }
}
