<?php
namespace cms\action\pageelement;

use cms\action\Method;
use cms\action\PageelementAction;
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
use util\exception\SecurityException;
use util\Session;
use util\Text;


/**
 * Edit values for all languages.
 */
class PageelementAllAction extends PageelementAction implements Method {

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
					if ($requestedFormat = $this->request->getText('format'))
						// Individual format from request.
						$format = $requestedFormat;
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

			$output[ 'name'   ] = $language->isoCode;
			$output[ 'value'  ] = $content;
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

			switch ($element->typeid) {

				case Element::ELEMENT_TYPE_TEXT:
				case Element::ELEMENT_TYPE_DATA:
				case Element::ELEMENT_TYPE_COORD:
					$value->text = $this->request->getText($language->isoCode);
					break;
				case Element::ELEMENT_TYPE_LONGTEXT:
					$value->text = $this->compactOIDs($this->request->getText($language->isoCode));
					$value->format = $oldValue->format; // keep the format
					break;

				case Element::ELEMENT_TYPE_DATE:
					$value->date = strtotime($this->request->getText($language->isoCode . '_date') . $this->request->getText($language->isoCode . '_time'));
					break;

				case Element::ELEMENT_TYPE_SELECT:
					$value->text = $this->request->getText($language->isoCode);
					break;
				case Element::ELEMENT_TYPE_LINK:
				case Element::ELEMENT_TYPE_INSERT:
					$value->linkToObjectId = $this->request->getNumber($language->isoCode);
					break;

				case Element::ELEMENT_TYPE_NUMBER:
					$value->number = $this->request->getText($language->isoCode) * pow(10, $element->decimals);
					break;
				case Element::ELEMENT_TYPE_CHECKBOX:
					$value->number = $this->request->getText($language->isoCode)?1:0;
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
	 * @return int[]
	 */
	protected function getLanguageIds()
	{
		return $this->page->getProject()->getLanguageIds();
	}

}
