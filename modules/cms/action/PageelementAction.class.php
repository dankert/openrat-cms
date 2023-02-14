<?php

namespace cms\action;

use cms\base\Language as L;
use cms\generator\PageContext;
use cms\generator\PageGenerator;
use cms\generator\Producer;
use cms\generator\Publisher;
use cms\generator\PublishOrder;
use cms\generator\ValueContext;
use cms\generator\ValueGenerator;
use cms\model\Content;
use cms\model\PageContent;
use cms\model\Permission;
use cms\model\BaseObject;
use cms\model\Element;
use cms\model\Folder;
use cms\model\Page;
use cms\model\Pageelement;
use cms\model\Project;
use cms\model\Template;
use cms\model\User;
use cms\model\Value;
use language\Messages;
use LogicException;
use util\ArrayUtils;
use util\exception\ObjectNotFoundException;
use util\exception\PublisherException;
use util\exception\SecurityException;
use util\exception\ValidationException;
use util\Html;
use util\Session;
use util\Text;
use util\Transformer;

// OpenRat Content Management System
// Copyright (C) 2002-2012 Jan Dankert, cms@jandankert.de
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.


/**
 * Action-Klasse zum Bearbeiten eines Seitenelementes
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */
class PageelementAction extends BaseAction
{
	/**
	 * Enthaelt das Seitenobjekt
	 * @type Page
	 */
	protected $page;

	/**
	 * Enthaelt das Elementobjekt
	 * @type Element
	 */
	protected $element;


	/**
	 * @type PageContent
	 */
	protected $pageContent;



	/**
	 * Enth�lt den Inhalt
	 *
	 * @var Value
	 */
	var $value;



	/**
	 * Konstruktor
	 */
	function __construct()
	{
        parent::__construct();
    }


    public function init()
    {

        $this->value = new Value();

		$id = $this->request->getRequiredText(RequestParams::PARAM_ID );
		$ids = explode('_',$id);
		if	( count($ids) > 1 )
		{
			list( $pageid, $elementid ) = $ids;
		}
		else
		{
			$pageid    = $this->request->getId();
			$elementid = $this->request->getRequiredNumber('elementid');
		}

		$this->page = new Page( $pageid );
        $this->page->load();

        if   ( ! $this->page->isPersistent() )
        	throw new ObjectNotFoundException("page not found");

		if	( $elementid != 0 )
		{
			$this->elementid = $elementid;
			$this->element   = new Element( $elementid );
		}

		if  ( $languageId = $this->request->getLanguageId() ) {

			$this->pageContent = new PageContent();
			$this->pageContent->pageId     = $this->page->pageid;
			$this->pageContent->elementId  = $this->element->elementid;
			$this->pageContent->languageid = $languageId;
			$this->pageContent->load();
		}

		if   ( ! $this->page->hasRight( $this->getRequiredPagePermission() ) ) {
			throw new SecurityException('Insufficient permissions for this page' );
		}
	}


	protected function getRequiredPagePermission() {
		return Permission::ACL_READ;
	}


	protected function createValueContext( $scheme ) {

		$pageContext = new PageContext( $this->page->objectid,$scheme );

		if  ( $languageId = $this->request->getLanguageId())
			$pageContext->languageId = $languageId;

		if  ( $modelId = $this->request->getModelId())
			$pageContext->modelId = $modelId;

		if  ( !$pageContext->languageId )
			$pageContext->languageId = $this->page->getProject()->getDefaultLanguageId();

		if  ( !$pageContext->modelId )
			$pageContext->modelId = $this->page->getProject()->getDefaultModelId();

		$valueContext = new ValueContext( $pageContext );
		$valueContext->elementid = $this->element->elementid;

		return $valueContext;
	}



	/**
	 * Verkn�pfung bearbeiten.
	 *
	 */
	protected function editLink()
	{
        $project = new Project($this->page->projectid);
		$this->setTemplateVar('rootfolderid',$project->getRootObjectId() );
		
		// Ermitteln, welche Objekttypen verlinkt werden d�rfen.
		$type = $this->element->subtype;

		if	( substr($type,0,5) == 'image' )
		$type = 'file';
			
		if	( !in_array($type,array('file','page','link','folder')) )
			$types = array('file','page','link'); // Fallback: Der Link kann auf Seiten,Dateien und Verknüpfungen zeigen
		else
			$types = array($type); // gewünschten Typ verwenden

        $oid  = $this->value->linkToObjectId;
        $name = '';

        if   ( $oid ) {
            $o = new BaseObject($oid);
            $o->load();
            $name = $o->filename;
        }

		$this->setTemplateVar('objects'         ,array() );
		$this->setTemplateVar('linkobjectid',$oid );
		$this->setTemplateVar('linkname'    ,$name);

		$this->setTemplateVar('types',implode(',',$types));
	}


    /**
     * Auswahlbox.
     *
     */
    protected function editSelect()
    {
        $this->setTemplateVar( 'items',$this->element->getSelectItems() );
        $this->setTemplateVar( 'text' ,$this->value->text                      );

    }



    /**
     * Einf�gen-Element.
     *
     */
    protected function editList()
    {
        $this->editInsert();
    }



    /**
     * Einf�gen-Element.
     *
     */
    protected function editInsert()
    {
        // Auswahl ueber alle Elementtypen
        $objects = array();
        //Änderung der möglichen Types
        $types = array('file','page','link');
        $objects[ 0 ] = \cms\base\Language::lang('LIST_ENTRY_EMPTY'); // Wert "nicht ausgewählt"

        $project = new Project( $this->page->projectid );
        $folder = new Folder($project->getRootObjectId());
        $folder->load();

        //Auch Dateien dazu
        foreach( $project->getAllObjectIds($types) as $id )
        {
            $f = new Folder( $id );
            $f->load();

            $objects[ $id ]  = \cms\base\Language::lang( $f->getType() ).': ';
            $objects[ $id ] .=  implode( ' &raquo; ',$f->parentObjectNames(false,true) );
        }

        foreach( $project->getAllFolders() as $id )
        {
            $f = new Folder( $id );
            $f->load();

            $objects[ $id ]  = \cms\base\Language::lang( $f->getType() ).': ';
            $objects[ $id ] .=  implode( ' &raquo; ',$f->parentObjectNames(false,true) );
        }

        asort( $objects ); // Sortieren

        $this->setTemplateVar('objects'         ,$objects);
        $this->setTemplateVar('linkobjectid',$this->value->linkToObjectId);

    }



    /**
     * Zahl bearbeiten.
     *
     */
    protected function editNumber()
    {
        $this->setTemplateVar('number',$this->value->number / pow(10,$this->element->decimals) );
    }


    /**
     * Date.
     *
     */
    protected function editDate()
    {
        $this->setTemplateVar('date',date('Y-m-d',$this->value->date ));
        $this->setTemplateVar('time',date('H:i'  ,$this->value->date ));
    }


    /**
     * Ein Element der Seite bearbeiten
     *
     * Es wird ein Formular erzeugt, mit dem der Benutzer den Inhalt bearbeiten kann.
     */
    protected function editLongtext()
    {
        if   ( ($f = $this->request->getNumber('format')) !== null ) // beware: format may be 0, which is false
            // Individual format from request.
            $format = $f;
        elseif   ( $this->value->format != null )
            $format = $this->value->format;
        else
            // There is no saved value. Get the format from the template element.
            $format = $this->element->format;

        $this->setTemplateVar('format'   ,$format );

        $this->setTemplateVar( 'editor',Element::getAvailableFormats()[ $format ] );

        $this->setTemplateVar( 'text',$this->linkifyOIDs( $this->value->text ) );
    }


    protected function editData() {
    	$this->editText();
	}

    protected function editCoord() {
    	$this->editText();
	}


    /**
     * Ein Element der Seite bearbeiten
     *
     * Es wird ein Formular erzeugt, mit dem der Benutzer den Inhalt bearbeiten kann.
     */
    protected function editText()
    {
        $this->setTemplateVar( 'text',$this->value->text );
    }

    protected function editCheckbox()
    {
        $this->setTemplateVar( 'number',$this->value->number );
    }

	protected function saveData()
	{
		$this->saveText();
	}

	protected function saveCoord()
	{
		$this->saveText();
	}

		/**
     * Element speichern
     *
     * Der Inhalt eines Elementes wird abgespeichert
     */
    protected function saveText()
    {
		$value = new Value();
		$value->contentid = $this->pageContent->contentId;
		$value->load();

        if   ( $linkObjectId = $this->request->getNumber('linkobjectid') )
        	$value->linkToObjectId = $linkObjectId;
        else
        	$value->text           = $this->request->getRaw('text');

        $this->afterSave($value);
    }



    /**
     * Nach dem Speichern weitere Dinge ausfuehren.<br>
     * - Inhalt freigeben<br>
     * - Seite veroeffentlichen<br>
     * - Inhalt fuer andere Sprachen speichern<br>
     * - Hinweis ueber erfolgtes Speichern ausgeben<br>
     * <br>
     * Nicht zu verwechseln mit <i>Aftershave</i> :)
     * @param $value Value
     * @throws \util\exception\ObjectNotFoundException
     */
    protected function afterSave( $value )
    {
        // Inhalt sofort freigegeben, wenn
        // - Recht vorhanden
        // - Freigabe gewuenscht
		$value->publish = $this->page->hasRight( Permission::ACL_RELEASE ) && $this->request->isTrue('release');

        // Up-To-Date-Check
		$content = new Content( $this->pageContent->contentId );
        $lastChangeTime = $content->getLastChangeSinceByAnotherUser( $this->request->getText('value_time'), $this->getCurrentUserId() );

        if	( $lastChangeTime  )
            $this->addWarningFor( $this->value,Messages::CONCURRENT_VALUE_CHANGE, array('last_change_time'=>date(L::lang('DATE_FORMAT'),$lastChangeTime)));

        // Inhalt speichern
		$value->persist();

        // Wenn Inhalt in allen Sprachen gleich ist, dann wird der Inhalt
        // fuer jede Sprache einzeln gespeichert.
        if	( $this->element->allLanguages )
        {
            $project = new Project( $this->page->projectid );
            foreach( $project->getLanguageIds() as $languageid )
            {
            	if   ( $languageid != $this->pageContent->languageid ) {
            		$otherPageContent = clone $this->pageContent;
            		$otherPageContent->languageid = $languageid;
            		$otherPageContent->contentId = null;
            		$otherPageContent->load();
            		if   ( ! $otherPageContent->contentId )
            			$otherPageContent->persist(); // create pagecontent if it does not exist.

					$otherValue = clone $value;
					$otherValue->contentid = $otherPageContent->contentId;
					$otherValue->persist();
				}
            }
        }

        $this->addNoticeFor( $this->page, Messages::SAVED);
        
        $this->page->setTimestamp(); // "Letzte Aenderung" setzen

        // Falls ausgewaehlt die Seite sofort veroeffentlichen
        if	( $this->page->hasRight( Permission::ACL_PUBLISH ) && $this->request->isTrue('publish') )
        {
			$this->publishPage();
        }
    }


    /**
     * Element speichern
     *
     * Der Inhalt eines Elementes wird abgespeichert
     */
    protected function saveLongtext()
    {
        $value = new Value();
        $value->contentid = $this->pageContent->contentId;
        $value->load();

        if   ( is_numeric($format = $this->request->getNumber('format')) )
            $value->format     = $format;
        else
            // Fallback: Format of the element.
            $value->format     = $this->element->format;

        $value->text           = $this->compactOIDs( $this->request->getRaw('text') );

        $this->afterSave($value);
    }


    /**
     * Element speichern
     *
     * Der Inhalt eines Elementes wird abgespeichert
     */
    protected function saveDate()
    {
		$value = new Value();
		$value->contentid = $this->pageContent->contentId;

        if   ( $linkTo = $this->request->getNumber('linkobjectid') )
            $value->linkToObjectId = $linkTo;
        else {
            $value->date = strtotime( $this->request->getText( 'date' ).' '.$this->request->getText( 'time' ) );

        }

        $this->afterSave($value);
    }



    /**
     * Element speichern
     *
     * Der Inhalt eines Elementes wird abgespeichert
     */
    protected function saveSelect()
    {
		$value = new Value();
		$value->contentid = $this->pageContent->contentId;
		$value->load();

        $value->text           = $this->request->getRequiredText('text');

        $this->afterSave($value);
    }



    /**
     * Element speichern
     *
     * Der Inhalt eines Elementes wird abgespeichert
     */
    protected function saveLink()
    {
		$value = new Value();
		$value->contentid = $this->pageContent->contentId;

        $value->load();

        if	( $linkUrl = $this->request->getText('linkurl') )
            $value->linkToObjectId = $this->parseSimpleOID($linkUrl);
        else
            $value->linkToObjectId = $this->request->getNumber('linkobjectid');

        $this->afterSave($value);
    }



    /**
     * Element speichern
     *
     * Der Inhalt eines Elementes wird abgespeichert
     */
    protected function saveList()
    {
        $this->saveInsert();
    }



    /**
     * Element speichern
     *
     * Der Inhalt eines Elementes wird abgespeichert
     */
    protected function saveInsert()
    {
		$value = new Value();
		$value->contentid = $this->pageContent->contentId;
		$value->load();

        $value->linkToObjectId = intval($this->request->getText('linkobjectid'));

        $this->afterSave($value);
    }



	protected function saveCheckbox()
	{
		$this->saveNumber();
	}

	/**
     * Element speichern
     *
     * Der Inhalt eines Elementes wird abgespeichert
     */
    protected function saveNumber()
    {
		$value = new Value();
		$value->contentid = $this->pageContent->contentId;


        if   ( $linkTo = $this->request->getText('linkobjectid') )
	        $value->linkToObjectId = $linkTo;
        else
    	    $value->number         = $this->request->getText('number') * pow(10,$this->element->decimals);

        $this->afterSave($value);
    }



    protected function linkifyOIDs( $text )
    {
		$pageContext = new PageContext( $this->page->objectid, Producer::SCHEME_PREVIEW );
		$pageContext->modelId    = 0;
		$pageContext->languageId = $this->request->getNumber('languageid');

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


    /**
     * Gets the Object-Id from an string.
     *
     * @param $text
     * @return int
     */
    protected function parseSimpleOID($text )
    {
        $treffer = Text::parseOID( $text );

        if   ( isset($treffer[0]))
            // Found an Object-Id.
            return $treffer[0][0];
        else
            return intval($text);
    }


	protected function publishPage() {

		$project = $this->page->getProject();

		// Nothing is written to the session from this point. so we should free the session.
		Session::close();

		$publisher = new Publisher( $project->projectid );

		foreach( $project->getModelIds() as $modelId ) {


			foreach( $project->getLanguageIds() as $languageId ) {

				$pageContext = new PageContext($this->page->objectid, Producer::SCHEME_PUBLIC);
				$pageContext->modelId    = $modelId;
				$pageContext->languageId = $languageId;

				$pageGenerator = new PageGenerator($pageContext);

				$publisher->addOrderForPublishing(new PublishOrder($pageGenerator->getCache()->load()->getFilename(), $pageGenerator->getPublicFilename(), $this->page->lastchangeDate));
				$this->page->setPublishedTimestamp();
			}
		}

		try {
			$publisher->publish();

			$this->addNoticeFor( $this->value,Messages::PUBLISHED,[],
				implode("\n",$publisher->getDestinationFilenames() ) );

		} catch( PublisherException $e ) {
			$this->addErrorFor( $this->value,Messages::PUBLISHED_ERROR,[],$e->getMessage() );
		}

	}



	/**
	 * Textual representation of a value.
	 *
	 * @param Value $value
	 * @param int $elementTypeId
	 * @return string
	 */
	protected function calculateValue(Value $value, $elementTypeId = 0)
	{
		switch( $elementTypeId ) {
			case Element::ELEMENT_TYPE_DATE:
				if   ( ! $value->date )
					return '';

				return date( \cms\base\Language::lang(Messages::DATE_FORMAT), $value->date );

			case Element::ELEMENT_TYPE_TEXT:
			case Element::ELEMENT_TYPE_LONGTEXT:
			case Element::ELEMENT_TYPE_SELECT:
				return $value->text;

			case Element::ELEMENT_TYPE_LINK:

				if   ( ! $value->linkToObjectId )
					return '';

				$linkObject = new BaseObject( $value->linkToObjectId );
				$linkObject->load();
				$name = $linkObject->filename();

				return $name;

			case Element::ELEMENT_TYPE_NUMBER:
				return $value->number;

			case Element::ELEMENT_TYPE_CHECKBOX:
				return $value->number?'ON':'OFF';

			default:
				return '';
		}
	}


	/**
	 * User must have read rights to the page.
	 */
	public function checkAccess() {
		if   ( ! $this->page->hasRight( Permission::ACL_READ )  )
			throw new SecurityException();
	}


	/**
	 * Get page contents.
	 *
	 * @return PageContent[] array of pagecontents of the page
	 * @throws ObjectNotFoundException
	 */
	protected function getContents()
	{
		$this->page->load();
		$this->element->load();

		return ArrayUtils::mapToNewArray(
			$this->page->getProject()->getLanguages(),
			function ( $languageId, $languageName ) {
				$pageContent = new PageContent();
				$pageContent->languageid = $languageId;
				$pageContent->elementId  = $this->element->elementid;
				$pageContent->pageId     = $this->page->pageid;
				$pageContent->load();
				return [ $pageContent->contentId => new Content( $pageContent->contentId ) ];
			}
		);
	}




	protected function ensureValueIdIsInAnyContent( $valueId )
	{
		foreach ($this->getContents() as $content ) {
			if   ( in_array( $valueId,$content->getVersionList() ) )
				return;
		}

		throw new SecurityException('valueId is not valid in this context');
	}

	protected function ensureContentIdIsPartOfPage( $contentId )
	{
		if  ( ! in_array( $contentId, array_keys($this->getContents()) ) )
			throw new SecurityException('content '.$contentId.' is not part of page #'.$this->page->objectid.' with contents '.print_r($this->getContents(),true) );
	}

}