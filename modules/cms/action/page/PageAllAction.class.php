<?php
namespace cms\action\page;

use cms\action\Method;
use cms\action\PageAction;
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
use cms\model\Page;
use cms\model\PageContent;
use cms\model\Permission;
use cms\model\Project;
use cms\model\Value;
use language\Messages;
use util\exception\PublisherException;
use util\exception\SecurityException;
use util\exception\ValidationException;
use util\Session;
use util\Text;

class PageAllAction extends PageAction implements Method {

	public function getRequiredPermission() {
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
			$output += $element->getProperties();
			$output += $value->getProperties();

			$content = '';

			switch( $element->typeid) {

				case Element::ELEMENT_TYPE_DATE:
					$output['date']=date('Y-m-d',$value->date );
					$output['time']=date('H:i'  ,$value->date );
					break;

				case Element::ELEMENT_TYPE_LINK:
					$project = new Project($this->page->projectid);
					$output['rootfolderid'] = $project->getRootObjectId();

					// Ermitteln, welche Objekttypen verlinkt werden d�rfen.
					$type = $element->subtype;

					if (substr($type, 0, 5) == 'image')
						$type = 'file';

					if (!in_array($type, array('file', 'page', 'link', 'folder')))
						$types = array('file', 'page', 'link'); // Fallback: Der Link kann auf Seiten,Dateien und Verknüpfungen zeigen
					else
						$types = array($type); // gewünschten Typ verwenden

					$oid = $value->linkToObjectId;
					$name = '';

					if ($oid) {
						$o = new BaseObject($oid);
						$o->load();
						$name = $o->filename;
					}

					$output['objects'] = array();
					$output['linkobjectid']= $oid;
					$content = $oid;
					$output['linkname']= $name;

					$output['types'] = implode(',', $types);

					break;

				case Element::ELEMENT_TYPE_SELECT:
					$output['items'] = $element->getSelectItems();
					$content = $value->text;
					break;

				case Element::ELEMENT_TYPE_INSERT:
					// Auswahl ueber alle Elementtypen
					$objects = array();
					//Änderung der möglichen Types
					$types = array('file', 'page', 'link');
					$objects[0] = \cms\base\Language::lang('LIST_ENTRY_EMPTY'); // Wert "nicht ausgewählt"

					$project = new Project($this->page->projectid);
					$folder = new Folder($project->getRootObjectId());
					$folder->load();

					//Auch Dateien dazu
					foreach ($project->getAllObjectIds($types) as $id) {
						$f = new Folder($id);
						$f->load();

						$objects[$id] = \cms\base\Language::lang($f->getType()) . ': ';
						$objects[$id] .= implode(' &raquo; ', $f->parentObjectNames(false, true));
					}

					foreach ($project->getAllFolders() as $id) {
						$f = new Folder($id);
						$f->load();

						$objects[$id] = \cms\base\Language::lang($f->getType()) . ': ';
						$objects[$id] .= implode(' &raquo; ', $f->parentObjectNames(false, true));
					}

					asort($objects); // Sortieren

					$output['objects'] = $objects;
					$content = $value->linkToObjectId;

					break;

				case Element::ELEMENT_TYPE_NUMBER:
					$content = $value->number / pow(10, $element->decimals);
					break;

				case Element::ELEMENT_TYPE_CHECKBOX:
					$content = $value->number;
					break;

				case Element::ELEMENT_TYPE_LONGTEXT:
					if ($requestFormat = $this->request->getText('format'))
						// Individual format from request.
						$format = $requestFormat;
					elseif ($value->format != null)
						$format = $value->format;
					else
						// There is no saved value. Get the format from the template element.
						$format = $element->format;

					$output['format'] = $format;
					$output['editor'] = Element::getAvailableFormats()[$format];

					$content = $this->linkifyOIDs($value->text);
					break;

				case Element::ELEMENT_TYPE_TEXT:
				case Element::ELEMENT_TYPE_DATA:
				case Element::ELEMENT_TYPE_COORD:

					$content = $value->text;
					break;
			}

			$output[ 'name'   ] = $element->name;
			$output[ 'value'  ] = $content;
			$this->setTemplateVar( $element->name, $content );

			$elements[ $element->elementid ] = $output;
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

		/** @var Element $element */
		foreach ($this->getElements() as $element) {

			$pageContent = new PageContent();
			$pageContent->elementId = $element->elementid;
			$pageContent->pageId = $this->page->pageid;
			$pageContent->languageid = $languageid;
			$pageContent->load();
			$pageContent->persist(); // Create if it does not exist yet.

			$value = new Value();
			$value->contentid = $pageContent->contentId;
			$oldValue = clone $value;
			$oldValue->load();

			switch ($element->typeid) {

				case Element::ELEMENT_TYPE_TEXT:
				case Element::ELEMENT_TYPE_DATA:
				case Element::ELEMENT_TYPE_COORD:
					$value->text = $this->request->getText($element->name);
					break;
				case Element::ELEMENT_TYPE_LONGTEXT:
					$value->text   = $this->compactOIDs($this->request->getText($element->name));
					$value->format = $oldValue->format;
					break;

				case Element::ELEMENT_TYPE_DATE:
					$value->date = strtotime($this->request->getText($element->name . '_date') . $this->request->getText($element->name . '_time'));
					break;

				case Element::ELEMENT_TYPE_SELECT:
					$value->text = $this->request->getText($element->name);
					break;
				case Element::ELEMENT_TYPE_CHECKBOX:
					$value->number = $this->request->getText($element->name)?1:0;
					break;
				case Element::ELEMENT_TYPE_LINK:
				case Element::ELEMENT_TYPE_INSERT:
					$value->linkToObjectId = $this->request->getNumber($element->name);
					break;

				case Element::ELEMENT_TYPE_NUMBER:
					$value->number = $this->request->getText($element->name) * pow(10, $element->decimals);
					break;
				default:
					throw new \LogicException('Unknown element type: ' . $element->getTypeName());
			}


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
			)
				continue; // nothing has changed.

			// Inhalt speichern
			$value->persist();

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
		}

		$this->page->setTimestamp(); // "Letzte Aenderung" setzen

		$this->addNoticeFor($this->page, Messages::SAVED);
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
