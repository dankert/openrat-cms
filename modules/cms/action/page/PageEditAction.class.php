<?php
namespace cms\action\page;
use cms\action\Method;
use cms\action\PageAction;
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

        /** @var Element[] $elements */
        $elements = $template->getElements();

        $elements = array_filter(/**
         * @param $element Element
         * @return Element
         */ $elements, function($element ) {
            return $element->isWritable();
        } );

        $elements = array_map( function( $element ) {
            return get_object_vars( $element ) + array('pageelementid'=>$this->page->objectid.'_'.$element->elementid,'typename'=>$element->getTypeName() );
        }, $elements);

		$this->setTemplateVar('elements',$elements);

		$project   = $this->page->getProject();
		$languages = $project->getLanguages();

		$this->setTemplateVar('languages',$languages);
    }



    public function post() {

    }
}
