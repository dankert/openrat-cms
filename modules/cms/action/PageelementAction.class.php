<?php

namespace cms\action;

use cms\base\Language as L;
use cms\generator\PageContext;
use cms\generator\PageGenerator;
use cms\generator\Producer;
use cms\generator\PublishEdit;
use cms\generator\Publisher;
use cms\generator\PublishOrder;
use cms\generator\PublishPreview;
use cms\generator\ValueContext;
use cms\generator\ValueGenerator;
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
	public $security = Action::SECURITY_USER;


	/**
	 * Enthaelt das Seitenobjekt
	 * @type Page
	 */
	var $page;

	/**
	 * Enthaelt das Elementobjekt
	 * @type Element
	 */
	var $element;


	/**
	 * @type Pageelement
	 */
	protected $pageelement;


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
			$elementid = $this->request->getNumber('elementid');
		}

		if	( $pageid != 0  )
		{
			$this->page = new Page( $pageid );

            if  ( $this->request->has('languageid'))
                $this->page->languageid = $this->request->getNumber('languageid');

            $this->page->load();
		}

		if	( $elementid != 0 )
		{
			$this->elementid = $elementid;
			$this->element   = new Element( $elementid );
		}

		$this->pageelement = new Pageelement($id);
	}


	protected function createValueContext( $scheme ) {

		$pageContext = new PageContext( $this->page->objectid,$scheme );

		if  ( $this->request->hasLanguageId())
			$pageContext->languageId = $this->request->getLanguageId();

		if  ( $this->request->hasModelId())
			$pageContext->modelId = $this->request->getModelId();

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
	protected function editlink()
	{
        $project = new Project($this->page->projectid);
		$this->setTemplateVar('rootfolderid',$project->getRootObjectId() );
		
		// Ermitteln, welche Objekttypen verlinkt werden d�rfen.
		$type = $this->value->element->subtype;

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
    protected function editselect()
    {
        $this->setTemplateVar( 'items',$this->value->element->getSelectItems() );
        $this->setTemplateVar( 'text' ,$this->value->text                      );

    }



    /**
     * Einf�gen-Element.
     *
     */
    protected function editlist()
    {
        $this->editinsert();
    }



    /**
     * Einf�gen-Element.
     *
     */
    protected function editinsert()
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
    protected function editnumber()
    {
        $this->setTemplateVar('number',$this->value->number / pow(10,$this->value->element->decimals) );
    }


    /**
     * Ein Element der Seite bearbeiten
     *
     * Es wird ein Formular erzeugt, mit dem der Benutzer den Inhalt bearbeiten kann.
     */
    protected function editlongtext()
    {
        if   ( $this->request->has('format') )
            // Individual format from request.
            $format = $this->request->getNumber('format');
        elseif   ( $this->value->format != null )
            $format = $this->value->format;
        else
            // There is no saved value. Get the format from the template element.
            $format = $this->element->format;

        $this->setTemplateVar('format'   ,$format );
        $this->setTemplateVar( 'editor',Element::getAvailableFormats()[ $format ] );

        $this->setTemplateVar( 'text',$this->linkifyOIDs( $this->value->text ) );
    }



    /**
     * Ein Element der Seite bearbeiten
     *
     * Es wird ein Formular erzeugt, mit dem der Benutzer den Inhalt bearbeiten kann.
     */
    protected function edittext()
    {
        $this->setTemplateVar( 'text',$this->value->text );
    }

    /**
     * Element speichern
     *
     * Der Inhalt eines Elementes wird abgespeichert
     */
    protected function savetext()
    {
        $value = new Value();
        $value->publisher  = $this->page->publisher;
        $value->languageid = $this->page->languageid;
        $value->objectid   = $this->page->objectid;
        $value->pageid     = Page::getPageIdFromObjectId( $this->page->objectid );

        if	( !$this->request->has('elementid') )
            throw new ValidationException('elementid');
        $value->element = new Element( $this->request->getText('elementid') );

        $value->element->load();
        $value->load();

        if   ( $this->request->has('linkobjectid') )
        $value->linkToObjectId = $this->request->getText('linkobjectid');
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
        $value->page = new Page( $value->objectid );
        $value->page->load();


        // Inhalt sofort freigegeben, wenn
        // - Recht vorhanden
        // - Freigabe gewuenscht
        if	( $value->page->hasRight( Permission::ACL_RELEASE ) && $this->request->has('release') )
        $value->publish = true;
        else
        $value->publish = false;

        // Up-To-Date-Check
        $lastChangeTime = $value->getLastChangeSinceByAnotherUser( $this->request->getText('value_time'), Session::getUser()->userid );
        if	( $lastChangeTime  )
            $this->addWarningFor( $this->value,Messages::CONCURRENT_VALUE_CHANGE, array('last_change_time'=>date(L::lang('DATE_FORMAT'),$lastChangeTime)));

        // Inhalt speichern

        // Wenn Inhalt in allen Sprachen gleich ist, dann wird der Inhalt
        // fuer jede Sprache einzeln gespeichert.
        if	( $value->element->allLanguages )
        {
            $project = new Project( $this->page->projectid );
            foreach( $project->getLanguageIds() as $languageid )
            {
                $value->languageid = $languageid;
                $value->add();
            }
        }
        else
        {
            // sonst nur 1x speichern (fuer die aktuelle Sprache)
            $value->add();
        }

        $this->addNoticeFor( $this->pageelement, Messages::SAVED);
        
        $this->page->setTimestamp(); // "Letzte Aenderung" setzen

        // Falls ausgewaehlt die Seite sofort veroeffentlichen
        if	( $value->page->hasRight( Permission::ACL_PUBLISH ) && $this->request->has('publish') )
        {
			$this->publishPage();
        }
    }


    /**
     * Element speichern
     *
     * Der Inhalt eines Elementes wird abgespeichert
     */
    protected function savelongtext()
    {
        $value = new Value();
        $value->languageid = $this->page->languageid;
        $value->objectid   = $this->page->objectid;
        $value->publisher  = $this->page->publisher;

        $value->pageid     = Page::getPageIdFromObjectId( $this->page->objectid );

        if	( !$this->request->has('elementid') )
            throw new ValidationException('elementid');
        $value->element = new Element( $this->request->getText('elementid') );

        $value->element->load();
        $value->load();

        if   ( $this->request->has('format') )
            $value->format     = $this->request->getNumber('format');
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
    protected function savedate()
    {
        $value = new Value();
        $value->languageid = $this->page->languageid;
        $value->objectid   = $this->page->objectid;
        $value->pageid     = Page::getPageIdFromObjectId( $this->page->objectid );
        $value->publisher  = $this->page->publisher;

        if	( !$this->request->has('elementid') )
            throw new ValidationException('elementid');

        $value->element = new Element( $this->request->getText('elementid') );
        $value->element->load();
        $value->load();

        if   ( $this->request->has('linkobjectid') )
            $value->linkToObjectId = $this->request->getText('linkobjectid');
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
    protected function saveselect()
    {
        $value = new Value();
        $value->languageid = $this->page->languageid;
        $value->objectid   = $this->page->objectid;
        $value->pageid     = Page::getPageIdFromObjectId( $this->page->objectid );
        $value->publisher  = $this->page->publisher;

        if	( !$this->request->has('elementid') )
            throw new ValidationException('elementid');
        $value->element = new Element( $this->request->getText('elementid') );

        $value->element->load();
        $value->load();

        $value->text           = $this->request->getText('text');

        $this->afterSave($value);
    }



    /**
     * Element speichern
     *
     * Der Inhalt eines Elementes wird abgespeichert
     */
    protected function savelink()
    {
        $value = new Value();
        $value->publisher  = $this->page->publisher;
        $value->languageid = $this->page->languageid;
        $value->objectid   = $this->page->objectid;
        $value->pageid     = Page::getPageIdFromObjectId( $this->page->objectid );

        if	( !$this->request->has('elementid') )
            throw new ValidationException('elementid');
        $value->element = new Element( $this->request->getText('elementid') );

        $value->element->load();
        $value->load();

        if	( $this->request->has('linkurl') )
            $value->linkToObjectId = $this->parseSimpleOID($this->request->getText('linkurl'));
        else
            $value->linkToObjectId = intval($this->request->getText('linkobjectid'));

        $this->afterSave($value);
    }



    /**
     * Element speichern
     *
     * Der Inhalt eines Elementes wird abgespeichert
     */
    protected function savelist()
    {
        $this->saveinsert();
    }



    /**
     * Element speichern
     *
     * Der Inhalt eines Elementes wird abgespeichert
     */
    protected function saveinsert()
    {
        $value = new Value();
        $value->publisher = $this->page->publisher;
        $value->languageid = $this->page->languageid;
        $value->objectid   = $this->page->objectid;
        $value->pageid     = Page::getPageIdFromObjectId( $this->page->objectid );

        if	( !$this->request->has('elementid') )
            throw new ValidationException('elementid');
        $value->element = new Element( $this->request->getText('elementid') );

        $value->element->load();
        $value->load();

        $value->linkToObjectId = intval($this->request->getText('linkobjectid'));

        $this->afterSave($value);
    }



    /**
     * Element speichern
     *
     * Der Inhalt eines Elementes wird abgespeichert
     */
    protected function savenumber()
    {
        $value = new Value();
        $value->publisher  = $this->page->publisher;
        $value->languageid = $this->page->languageid;
        $value->objectid   = $this->page->objectid;
        $value->pageid     = Page::getPageIdFromObjectId( $this->page->objectid );

        if	( !$this->request->has('elementid') )
            throw new ValidationException('elementid');
        $value->element = new Element( $this->request->getText('elementid') );

        $value->element->load();
        $value->load();

        if   ( $this->request->has('linkobjectid') )
        $value->linkToObjectId = $this->request->getText('linkobjectid');
        else
        $value->number         = $this->request->getText('number') * pow(10,$value->element->decimals);

        $this->afterSave($value);
    }



    protected function linkifyOIDs( $text )
    {
		$pageContext = new PageContext( $this->page->objectid, Producer::SCHEME_PREVIEW );
		$pageContext->modelId    = 0;
		$pageContext->languageId = $this->value->languageid;

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

			$pageContext = new PageContext( $this->page->objectid, Producer::SCHEME_PUBLIC );
			$pageContext->modelId    = $modelId;
			$pageContext->languageId = $this->value->languageid;

			$pageGenerator = new PageGenerator( $pageContext );

			$publisher->addOrderForPublishing( new PublishOrder( $pageGenerator->getCache()->load()->getFilename(),$pageGenerator->getPublicFilename(), $this->page->lastchangeDate ) );
			$this->page->setPublishedTimestamp();
		}

		$publisher->publish();

		$this->addNoticeFor( $this->value,Messages::PUBLISHED,[],
			implode("\n",$publisher->getDestinationFilenames() ) );

	}



	/**
	 * Textual representation of a value.
	 *
	 * @param Value $value
	 * @return string
	 */
	protected function calculateValue(Value $value)
	{
		switch( $value->element->typeid ) {
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
				$name = $linkObject->getNameForLanguage( $value->languageid )->name;

				if   ( empty( $name ))
					$name = $linkObject->filename();

				return $name;

			case Element::ELEMENT_TYPE_NUMBER:
				return $value->number;

			default:
				return '';
		}
	}
}
