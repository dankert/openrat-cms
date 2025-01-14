<?php
namespace cms\action\pageelement;
use cms\action\Method;
use cms\action\PageelementAction;
use cms\action\ValueMapping;
use cms\base\Language as L;
use cms\base\Startup;
use cms\model\Content;
use cms\model\PageContent;
use cms\model\Permission;
use cms\model\Page;
use cms\model\Project;
use cms\model\Value;
use language\Messages;

class PageelementValueAction extends PageelementAction implements Method {

	use ValueMapping;

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

		$output = $this->outputValue( $this->element,$this->value );
		$this->setTemplateVars( $output );

		/*
		$methodName = 'edit'.ucfirst($this->element->getTypeName());

		if	( ! method_exists($this,$methodName) )
			throw new \LogicException('Method does not exist: PageElementAction#'.$methodName );

		$this->$methodName(); // Call method "edit<Elementtyp>()".
		*/
    }


    public function post() {

        $this->element->load();

		$log  = [];
        $type = $this->element->getTypeName();

		$value = new Value();
		$value->contentid = $this->pageContent->contentId;
		$value->load();

		$oldValue = clone $value;

		$this->parseToValue( $this->element,$value,$this->element->name );

		// Inhalt sofort freigegeben, wenn
		// - Recht vorhanden
		// - Freigabe gewuenscht
		$value->publish = $this->page->hasRight(Permission::ACL_RELEASE) && $this->request->isTrue('release');
		$value->format  = $this->request->getNumber('format');

		// Up-To-Date-Check
		$content = new Content( $this->pageContent->contentId );
		$lastChangeTime = $content->getLastChangeSinceByAnotherUser($this->request->getNumber('value_time'), $this->getCurrentUserId());
		if ($lastChangeTime)
			$this->addWarningFor($value, Messages::CONCURRENT_VALUE_CHANGE, array('last_change_time' => date(L::lang('DATE_FORMAT'), $lastChangeTime)));

		// Check if anything has changed
		if   ( $oldValue->text           == $value->text     &&
			$oldValue->linkToObjectId == $value->linkToObjectId  &&
			$oldValue->format         == $value->format    &&
			$oldValue->number         == $value->number    &&
			$oldValue->date           == $value->date      &&
			!(!$oldValue->publish && $value->publish)
		) {
			$log[] = 'Status: Unchanged';
		} else {

			// Inhalt speichern
			$value->persist();
			$log[] = 'Status: Saved '."\u{2713}";

			// Wenn Inhalt in allen Sprachen gleich ist, dann wird der Inhalt
			// fuer jede Sprache einzeln gespeichert.
			if ($this->element->allLanguages) {
				$project = new Project($this->page->projectid);
				foreach ($project->getLanguageIds() as $languageid) {
					if ($languageid != $this->pageContent->languageid) {
						$otherPageContent = clone $this->pageContent;
						$otherPageContent->languageid = $languageid;
						$otherPageContent->contentId = null;
						$otherPageContent->load();
						if (!$otherPageContent->contentId)
							$otherPageContent->persist(); // create pagecontent if it does not exist.

						$otherValue = clone $value;
						$otherValue->contentid = $otherPageContent->contentId;
						$otherValue->persist();
					}
				}
			}
		}



		$this->page->setTimestamp(); // "Letzte Aenderung" setzen

		// Falls ausgewaehlt die Seite sofort veroeffentlichen
		if	( $this->page->hasRight( Permission::ACL_PUBLISH ) && $this->request->isTrue('publish') )
		{
			$this->publishPage();
			$log[] = 'Published page "'.$this->page->getName().'".';
		}

		$this->addNoticeFor( $this->page, Messages::SAVED,[],$log);

		/**
		$methodName = 'save'.ucfirst($type);

        if  ( !method_exists($this,$methodName))
            throw new \InvalidArgumentException('Method not available: '.$methodName);

        $this->$methodName(); // Call method "save<ElementType>()"
		 * */
    }
}
