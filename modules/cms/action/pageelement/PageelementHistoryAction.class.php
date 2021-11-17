<?php
namespace cms\action\pageelement;
use cms\action\Method;
use cms\action\PageelementAction;
use cms\model\Content;
use cms\model\Element;
use cms\model\PageContent;
use cms\model\Value;

class PageelementHistoryAction extends PageelementAction implements Method {
    public function view() {

        $this->page->load();


		$pageContent = new PageContent();
		$pageContent->languageid = $this->page->languageid;
		$pageContent->elementId  = &$this->element->elementid;
		$pageContent->pageId     = $this->page->pageid;
		$pageContent->load();
		$this->value->contentid = $pageContent->contentId;

		$this->value->objectid   = $this->page->objectid;
		$this->value->pageid     = $this->page->pageid;
		$this->value->page       = $this->page;
		$this->value->element    = &$this->element;
		$this->value->elementid  = $this->element->elementid;
		$this->value->element->load();

		$languages = array();

		foreach ( $this->page->getProject()->getLanguages() as $languageId=>$languageName )
		{
			$language = [
				'id'     => $languageId,
				'name'   => $languageName,
				'values' => [],
			];

			$value = clone $this->value; // do not overwrite the value
			$value->languageid = $languageId;

			/** @var Value $value */
			$content = new Content( $this->value->contentid );

			foreach($content->getVersionList() as $valueId) {

				$value = new Value();
				$value->loadWithId( $valueId );

				$language['values'][] = [
					'text'       => $this->calculateValue( $value ),
					'active'     => $value->active,
					'publish'    => $value->publish,
					'user'       => $value->lastchangeUserName,
					'date'       => $value->lastchangeTimeStamp,
					'id'         => $value->getId(),
					'usable'     => ! $value->active,
					'releasable' => $value->active && ! $value->publish,
					'comparable' => in_array($this->element->typeid,[Element::ELEMENT_TYPE_LONGTEXT]),
				];
			}

			$languages[$languageId] = $language;
		}

        $this->setTemplateVar('name'     ,$this->element->label );
        $this->setTemplateVar('languages',$languages );
    }


    public function post() {
    }
}
