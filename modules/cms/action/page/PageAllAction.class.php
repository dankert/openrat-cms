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
use cms\model\Element;
use cms\model\Folder;
use cms\model\Language;
use cms\model\Page;
use cms\model\Permission;
use cms\model\Project;
use cms\model\Value;
use language\Messages;
use util\exception\ValidationException;
use util\Session;
use util\Text;

class PageAllAction extends PageAction implements Method {

	public function getRequiredPermission() {
		return Permission::ACL_WRITE;
	}


	public function view()
	{

		$languageid = $this->request->getRequiredId('languageid');
		$language = new Language($languageid);
		$language->load();

		$this->setTemplateVar('language_name', $language->getName());
		$this->setTemplateVar('languageid'   , $language->languageid );

		$this->setTemplateVar('value_time',time() );

		$elements = [];

		/** @var Element $element */
		foreach ($this->getElements() as $element) {
			$value = new Value();
			$value->languageid = $languageid;
			$value->objectid   = $this->page->objectid;
			$value->pageid     = $this->page->pageid;
			$value->element    = &$element;
			$value->elementid  = &$element->elementid;
			$value->element->load();
			$value->publish    = false;
			$value->load();

			$output = [];
			$output += $element->getProperties();
			$output += $value->getProperties();

			$content = '';

			switch( $element->typeid) {

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
					$output['items'] = $value->element->getSelectItems();
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
					$content = $value->number / pow(10, $value->element->decimals);
					break;

				case Element::ELEMENT_TYPE_LONGTEXT:
					if ($this->request->has('format'))
						// Individual format from request.
						$format = $this->request->getNumber('format');
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
		//echo "<pre>" . print_r($elements,true) . '</pre>';
	}



    public function post()
	{


		$languageid = $this->request->getRequiredNumber('languageid');
		$language = new Language($languageid);
		$language->load();

		/** @var Element $element */
		foreach ($this->getElements() as $element) {

			$value = new Value();
			$value->languageid = $languageid;
			$value->objectid = $this->page->objectid;
			$value->pageid = $this->page->pageid;
			$value->element = &$element;
			$value->elementid = &$element->elementid;
			$value->element->load();
			$value->publish = false;
			$value->load();

			switch ($element->typeid) {

				case Element::ELEMENT_TYPE_TEXT:
					$value->text = $this->request->getVar($element->name, 'raw');
					break;
				case Element::ELEMENT_TYPE_LONGTEXT:
					$value->text = $this->compactOIDs($this->request->getVar($element->name, 'raw'));
					break;

				case Element::ELEMENT_TYPE_DATE:
					$value->date = strtotime($this->request->getText($element->name.'_date') . $this->request->getText($element->name.'_time'));
					break;

				case Element::ELEMENT_TYPE_SELECT:
					$value->text = $this->request->getText($element->name);
					break;
				case Element::ELEMENT_TYPE_LINK:
				case Element::ELEMENT_TYPE_INSERT:
					$value->linkToObjectId = intval($this->request->getVar($element->name));
					break;

				case Element::ELEMENT_TYPE_NUMBER:
					$value->number = $this->request->getVar($element->name) * pow(10, $value->element->decimals);
					break;
				default:
					throw new \LogicException('Unknown element type: '.$element->getTypeName() );
			}
			$value->page = new Page($value->objectid);
			$value->page->load();


			// Inhalt sofort freigegeben, wenn
			// - Recht vorhanden
			// - Freigabe gewuenscht
			$value->publish = $value->page->hasRight(Permission::ACL_RELEASE) && $this->request->has('release');

			// Up-To-Date-Check
			$lastChangeTime = $value->getLastChangeSinceByAnotherUser($this->request->getVar('value_time'), Session::getUser()->userid);
			if ($lastChangeTime)
				$this->addWarningFor($value, Messages::CONCURRENT_VALUE_CHANGE, array('last_change_time' => date(L::lang('DATE_FORMAT'), $lastChangeTime)));

			// Inhalt speichern

			// Wenn Inhalt in allen Sprachen gleich ist, dann wird der Inhalt
			// fuer jede Sprache einzeln gespeichert.
			if ($value->element->allLanguages) {
				$project = new Project($this->page->projectid);
				foreach ($project->getLanguageIds() as $languageid) {
					$value->languageid = $languageid;
					$value->add();
				}
			} else {
				// sonst nur 1x speichern (fuer die aktuelle Sprache)
				$value->add();
			}


		}

		// Falls ausgewaehlt die Seite sofort veroeffentlichen
		if ($value->page->hasRight(Permission::ACL_PUBLISH) && $this->request->has('publish')) {
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

		return $this->page->getWritableElements();
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

		$publisher->publish();
		$this->page->setPublishedTimestamp();

		$this->addNoticeFor( $this->page,Messages::PUBLISHED,[],
			implode("\n",$publisher->getDestinationFilenames() ) );

	}
}
