<?php
namespace cms\action\pageelement;
use cms\action\Method;
use cms\action\PageelementAction;
use cms\model\Element;

class PageelementAdvancedAction extends PageelementAction implements Method {
    public function view() {
		$this->value->objectid   = $this->page->objectid;
		$this->value->pageid     = $this->page->pageid;
		$this->value->page       = $this->page;
		$this->value->element = &$this->element;
		$this->value->elementid  = $this->element->elementid;
		$this->value->element->load();

		$this->setTemplateVar('name'       ,$this->value->element->label    );
		$this->setTemplateVar('description',$this->value->element->desc     );
		$this->setTemplateVar('elementid'  ,$this->value->element->elementid);
		$this->setTemplateVar('type'       ,$this->value->element->getTypeName() );

		$languages = array();

		foreach ( $this->page->getProject()->getLanguages() as $languageId=>$languageName )
        {
            $this->value->languageid = $languageId;
            $this->value->load();

            $languages[$languageId] = array(
                'languageid'   => $languageId,
                'languagename' => $languageName,
				'text'         => $this->calculateValue( $this->value ),
                'number'       => $this->value->number,
                'date'         => $this->value->date,
                'linkObjectId' => $this->value->linkToObjectId,
                'editors'      => Element::getAvailableFormats()
            );
        }

        $this->setTemplateVar('languages',$languages);
    }
    public function post() {
    }
}
