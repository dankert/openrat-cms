<?php
namespace cms\action\pageelement;

use cms\action\Method;
use cms\action\PageelementAction;
use cms\action\ValueMapping;
use cms\base\Language as L;
use cms\generator\PageContext;
use cms\generator\PageGenerator;
use cms\generator\Producer;
use cms\generator\Publisher;
use cms\generator\PublishOrder;
use cms\model\BaseObject;
use cms\model\Content;
use cms\model\Element;
use cms\model\Folder;
use cms\model\Language;
use cms\model\PageContent;
use cms\model\Permission;
use cms\model\Project;
use cms\model\Value;
use language\Messages;
use logger\Logger;
use util\exception\SecurityException;
use util\Session;
use util\Text;


/**
 * Edit values for all languages.
 */
class PageelementAllAction extends PageelementAction implements Method {

	use ValueMapping;

	public function getRequiredPermission() {
		return Permission::ACL_WRITE;
	}


	public function view()
	{
		$elements = [];

		foreach( $this->getLanguageIds() as $languageId ) {

			$language = new Language($languageId);
			$language->load();

			$this->setTemplateVar('value_time',time() );
			$this->setTemplateVar('writable'  ,$this->page->hasRight( Permission::ACL_WRITE ) );

			$element = $this->element;
			$element->load();

			$pageContent = new PageContent();
			$pageContent->elementId  = $element->elementid;
			$pageContent->pageId     = $this->page->pageid;
			$pageContent->languageid = $languageId;
			$pageContent->load();

			if   ( $pageContent->isPersistent() ) {
				$value = new Value();
				$value->contentid = $pageContent->contentId;
				$value->load();
			}
			else {
				// There is no content yet, so creating an empty value.
				$value = new Value();
			}

			$output = [];
			$output += $element->getProperties();
			$output += $value->getProperties();
			$output['label'] = $language->getName();

			$output['items'] = $element->getSelectItems();

			$output += $this->outputValue($element,$value);

			$output[ 'name'   ] = $language->isoCode;
			//$this->setTemplateVar( $language->getId(), $content );

			$elements[ $language->getId() ] = $output;
		}

		if ($this->page->hasRight(Permission::ACL_RELEASE))
			$this->setTemplateVar('release', true);
		if ($this->page->hasRight(Permission::ACL_PUBLISH))
			$this->setTemplateVar('publish', false);

		$this->setTemplateVar('elements', $elements );
	}



    public function post()
	{
		if   ( !$this->page->hasRight( Permission::ACL_WRITE ))
			throw new SecurityException();

		$element = $this->element;
		$element->load();
		$log = [];

		foreach( $this->getLanguageIds() as $languageid ) {

			$language = new Language($languageid);
			$language->load();

			$language = new Language($languageid);
			$language->load();

			$pageContent = new PageContent();
			$pageContent->elementId = $element->elementid;
			$pageContent->pageId = $this->page->pageid;
			$pageContent->languageid = $languageid;
			$pageContent->load();
			$pageContent->persist(); // Create the content if it does not exist yet.

			$value = new Value();
			$value->contentid = $pageContent->contentId;

			$oldValue = clone $value;
			$oldValue->load();
			$value->format = $oldValue->format;

			$this->parseToValue( $element, $value, $language->isoCode );

			// Inhalt sofort freigegeben, wenn
			// - Recht vorhanden
			// - Freigabe gewuenscht
			$value->publish = $this->page->hasRight(Permission::ACL_RELEASE) && $this->request->isTrue('release');

			// Up-To-Date-Check
			$content = new Content( $pageContent->contentId );
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
				$log[] = str_pad($language->name,20).': Not changed';
				continue; // nothing has changed.
			}

			// Inhalt speichern
			$value->persist();
			$log[] = str_pad($language->name,20).': Saved';

			// Wenn Inhalt in allen Sprachen gleich ist, dann wird der Inhalt
			// fuer jede Sprache einzeln gespeichert.
			if ($element->allLanguages) {
				$project = new Project($this->page->projectid);
				foreach ($project->getLanguageIds() as $languageid) {
					if ($languageid != $pageContent->languageid) {
						$otherPageContent = clone $pageContent;
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

		// Falls ausgewaehlt die Seite sofort veroeffentlichen
		if ($this->page->hasRight(Permission::ACL_PUBLISH) && $this->request->isTrue('publish')) {
			$this->publishPage( $languageid );
			$log[] = 'published page: '.$this->page->getName();
		}

		$this->page->setTimestamp(); // "Letzte Aenderung" setzen

		$this->addNoticeFor($this->page, Messages::SAVED,[],$log);
	}

	/**
	 * @return int[]
	 */
	protected function getLanguageIds()
	{
		return $this->page->getProject()->getLanguageIds();
	}

}
