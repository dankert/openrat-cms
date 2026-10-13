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

		$pageAll = new PageAll($this->page->objectid,$this->page->pageid,array(),array());

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
			$pageAll->elements[] = new \cms\api\Element(
				$element->getId(),
				$element->name,
				$element->label,
				$element->desc,
				$element->getTypeName(),
				$element->typeid );
		}

		$project   = $this->page->getProject();

		$languages = $project->getLanguageList();

		foreach( $languages as $language ) {
			$language->load();
			$pageAll->languages[] = new Language(
				$language->getId(),
				$language->isoCode,
				$language->getName()
			);

		}

		return $pageAll;
    }



    public function post() {

    }
}
