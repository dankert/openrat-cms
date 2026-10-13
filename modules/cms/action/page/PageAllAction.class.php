<?php
namespace cms\action\page;

use cms\action\Method;
use cms\action\PageAction;
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
use cms\model\Language;
use cms\model\PageContent;
use cms\model\Permission;
use cms\model\Project;
use cms\model\Value;
use language\Messages;
use logger\Logger;
use util\exception\PublisherException;
use util\exception\SecurityException;
use util\Session;
use util\Text;
use function logger\Logger;

class PageAllAction extends PageAction implements Method {

	use ValueMapping;

	public function getRequiredPermission(): int
	{
		return Permission::ACL_READ;
	}


	public function view()
	{
		$languageid = $this->request->getRequiredNumber('languageid');
		$language = new Language($languageid);
		$language->load();

		$this->setTemplateVar('language_name', $language->getName());
		$this->setTemplateVar('languageid'   , $language->languageid );

		$this->setTemplateVar('value_time',time() );
		$this->setTemplateVar('writable'  ,$this->page->hasRight( Permission::ACL_WRITE ) );

		$elements = [];

		/** @var Element $element */
		foreach ($this->getElements() as $element) {

			$pageContent = new PageContent();
			$pageContent->elementId  = $element->elementid;
			$pageContent->pageId     = $this->page->pageid;
			$pageContent->languageid = $languageid;
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
			$output['element' ] = $element->getProperties();
			$output['type'    ] = $element->getTypeName();
			$output['decimals'] = $element->decimals;
			$output['name'    ] = $element->name;
			$output['label'   ] = $element->label;
			$output['desc'    ] = $element->desc;

			//$output['value'  ] = $value->getProperties();
			$output += $this->outputValue($element,$value);

			//$this->setTemplateVar( $element->name, $output['value'] );

			$elements[ $element->name ] = $output;
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

		$languageid = $this->request->getRequiredNumber('languageid');
		$language = new Language($languageid);
		$language->load();
		$log = [];

		/** @var Element $element */
		foreach ($this->getElements() as $element) {

			$pageContent = new PageContent();
			$pageContent->elementId  = $element->elementid;
			$pageContent->pageId     = $this->page->pageid;
			$pageContent->languageid = $languageid;
			$pageContent->load();
			$pageContent->persist(); // Create if it does not exist yet.

			$value = new Value();
			$value->contentid = $pageContent->contentId;
			$oldValue = clone $value;
			$oldValue->load();
			$value->format = $oldValue->format;

			$this->parseToValue( $element, $value, $element->name );

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
				$log[] = str_pad($element->label,20).': Unchanged';
				continue; // nothing has changed.
			}

			// Inhalt speichern
			$value->persist();
			$log[] = str_pad($element->label,20).': '."Saved \u{2713}";

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
			$log[] = 'Published page "'.$this->page->getName().'"';
		}

		$this->page->setTimestamp(); // "Letzte Aenderung" setzen

		$this->addNoticeFor($this->page, Messages::SAVED,[],$log);
	}


	/**
	 * Gets all elements of the current page.
	 *
	 * @return array
	 */
    protected function getElements() {

		return $this->page->getTemplate()->getWritableElements();
	}


	protected function linkifyOIDs( $text )
	{
		$pageContext = $this->createPageContext( Producer::SCHEME_PREVIEW );

		$linkFormat = $pageContext->getLinkScheme();

		foreach( Text::parseOID($text) as $oid=>$t )
		{
			$url = $linkFormat->linkToObject($this->page, (new BaseObject($oid))->load() );
			foreach( $t as $match)
				$text = str_replace($match,$url,$text);
		}

		return $text;
	}




	protected function compactOIDs( $text )
	{
		foreach( Text::parseOID($text) as $oid=>$t )
		{
			foreach( $t as $match)
				$text = str_replace($match,'?__OID__'.$oid.'__',$text);
		}

		return $text;
	}



	protected function publishPage( $languageid ) {

		$project = $this->page->getProject();

		// Nothing is written to the session from this point. so we should free the session.
		Session::close();

		$publisher = new Publisher( $project->projectid );

		foreach( $project->getModelIds() as $modelId ) {

			$pageContext = new PageContext( $this->page->objectid, Producer::SCHEME_PUBLIC );
			$pageContext->modelId    = $modelId;
			$pageContext->languageId = $languageid;

			$pageGenerator = new PageGenerator( $pageContext );

			$publisher->addOrderForPublishing( new PublishOrder( $pageGenerator->getCache()->load()->getFilename(),$pageGenerator->getPublicFilename(), $this->page->lastchangeDate ) );
		}

		try {
			$publisher->publish();
		} catch( PublisherException $e ) {
			$this->addErrorFor( $this->page,Messages::PUBLISHED_ERROR,[],$e->getMessage() );
		}

		$this->page->setPublishedTimestamp();

		$this->addNoticeFor( $this->page,Messages::PUBLISHED,[],
			implode("\n",$publisher->getDestinationFilenames() ) );

	}
}
