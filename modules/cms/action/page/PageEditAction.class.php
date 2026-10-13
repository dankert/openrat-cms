<?php
namespace cms\action\page;
use cms\action\Method;
use cms\action\PageAction;
use cms\api\Language;
use cms\api\PageAll;
use cms\model\Permission;
use cms\model\BaseObject;
use cms\model\Element;
use cms\model\Folder;
use cms\model\Page;
use cms\model\Project;
use cms\model\Template;
use cms\model\Value;

class PageEditAction extends PageAction implements Method {


    public function view() {

        $template = new Template( $this->page->templateid );
        $template->load();

		$pageAll = new PageAll();
		$pageAll->objectId = $this->page->objectid;
		$pageAll->pageId   = $this->page->pageid;

		/** @var Element[] $elements */
		$elements = $template->getElements();

		/** @var Element[] $elements */
        $elements = array_filter(/**
         * @param $element Element
         * @return Element
         */ $elements, function($element ) {
            return $element->isWritable();
        } );

		foreach ( $elements as $element ) {
			$uiElement = new \cms\api\Element();
			$uiElement->id = $element->getId();
			$uiElement->label = $element->label;
			$uiElement->name = $element->name;
			$uiElement->description = $element->desc;
			$uiElement->type = $element->getTypeName();
			$uiElement->typeId = $element->typeid;

			$pageAll->elements[] = $uiElement;
		}
        $elements = array_map( function( $element ) {
            return get_object_vars( $element ) + array('pageelementid'=>$this->page->objectid.'_'.$element->elementid,'typename'=>$element->getTypeName() );
        }, $elements);

		#$this->setTemplateVar('elements',$elements);

		$project   = $this->page->getProject();

		$languages = $project->getLanguageList();

		foreach( $languages as $language ) {
			$language->load();
			$uiLanguage = new Language();
			$uiLanguage->id = $language->getId();
			$uiLanguage->isoCode = $language->isoCode;
			$uiLanguage->label = $language->getName();

			$pageAll->languages[] = $uiLanguage;
		}

		#$this->setTemplateVar('languages',$languages);
		return $pageAll;
    }



    public function post() {

    }
}
