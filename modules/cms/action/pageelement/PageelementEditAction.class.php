<?php
namespace cms\action\pageelement;
use cms\action\Method;
use cms\action\PageelementAction;
use cms\model\PageContent;
use cms\model\Value;

class PageelementEditAction extends PageelementAction implements Method {
    public function view() {

		$this->element->load();
		$this->setTemplateVar('name'       ,$this->element->label         );
		$this->setTemplateVar('description',$this->element->desc          );
		$this->setTemplateVar('elementid'  ,$this->element->elementid     );
		$this->setTemplateVar('type'       ,$this->element->getTypeName() );

		$languages = array();

		foreach ( $this->page->getProject()->getLanguages() as $languageId=>$languageName )
        {
			$pageContent = new PageContent();
			$pageContent->pageId     = $this->page->pageid;
			$pageContent->languageid = $languageId;
			$pageContent->elementId  = $this->element->elementid;
			$pageContent->load();

			$value = new Value();
			$value->contentid = $pageContent->contentId;
			$value->load();

            $languages[$languageId] = array(
                'languageid'   => $languageId,
                'languagename' => $languageName,
                'text'         => $this->calculateValue($value, $this->element->typeid),
                'number'       => $value->number,
                'date'         => $value->date,
                'linkObjectId' => $value->linkToObjectId,
        );
        }

        $this->setTemplateVar('languages',$languages);
    }


    public function post() {
    }
}
