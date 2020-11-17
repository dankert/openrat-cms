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
use cms\model\Acl;
use cms\model\BaseObject;
use cms\model\Element;
use cms\model\Folder;
use cms\model\Page;
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

		$id = $this->request->id;
		$ids = explode('_',$id);
		if	( count($ids) > 1 )
		{
			list( $pageid, $elementid ) = $ids;
		}
		else
		{
			$pageid    = $this->getRequestId();
			$elementid = $this->getRequestVar('elementid');
		}

		if	( $pageid != 0  )
		{
			$this->page = new Page( $pageid );

            if  ( $this->hasRequestVar('languageid'))
                $this->page->languageid = $this->getRequestId('languageid');

            $this->page->load();
		}

		if	( $elementid != 0 )
		{
			$this->elementid = $elementid;
			$this->element   = new Element( $elementid );
		}
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
	 * Anzeigen des Element-Inhaltes.
	 * @deprecated
	 */
	public function propView_Unused()
	{
		$this->value->languageid = $this->page->languageid;
		$this->value->objectid   = $this->page->objectid;
		$this->value->pageid     = $this->page->pageid;
		$this->value->page       = $this->page;
		$this->value->simple = false;
		$this->value->element = &$this->element;
		$this->value->element->load();
		$this->value->load();

		$this->setTemplateVar('name'        ,$this->value->element->name     );
		$this->setTemplateVar('description' ,$this->value->element->desc     );
		$this->setTemplateVar('elementid'   ,$this->value->element->elementid);
		$this->setTemplateVar('element_type',$this->value->element->type     );

		$user = new User( $this->value->lastchangeUserId );
		$user->load();
		$this->setTemplateVar('lastchange_user',$user->getProperties());
		$this->setTemplateVar('lastchange_date',$this->value->lastchangeTimeStamp);

		$t = new Template( $this->page->templateid );
		$t->load();
		$this->setTemplateVar('template_name',$t->name );
		$this->setTemplateVar('template_url' ,Html::url('template','prop',$t->templateid) );

		$this->setTemplateVar('element_name' ,$this->value->element->name );
		$this->setTemplateVar('element_url'  ,Html::url('element','name',$this->value->element->elementid) );

	}



	/**
	 * Anzeigen des Element-Inhaltes.
	 */
	public function infoView()
	{
		$this->value->languageid = $this->page->languageid;
		$this->value->objectid   = $this->page->objectid;
		$this->value->pageid     = $this->page->pageid;
		$this->value->page       = $this->page;
		$this->value->simple = false;
		$this->value->element = &$this->element;
		$this->value->element->load();
		$this->value->load();

		$this->setTemplateVar('name'          ,$this->value->element->name     );
		$this->setTemplateVar('description'   ,$this->value->element->desc     );
		$this->setTemplateVar('elementid'     ,$this->value->element->elementid);
        $this->setTemplateVar('element_id'    ,$this->value->element->elementid );
        $this->setTemplateVar('element_name'  ,$this->value->element->name );
		$this->setTemplateVar('element_type'  ,$this->value->element->getTypeName() );
		$this->setTemplateVar('element_format',Element::getAvailableFormats()[ $this->value->element->format] );
		$this->setTemplateVar('format'        ,@Element::getAvailableFormats()[ $this->value->format         ] );

		$user = new User( $this->value->lastchangeUserId );

		try{
            $user->load();
        }catch (\util\exception\ObjectNotFoundException $e) {
		    $user = new User(); // Empty User.
        }

        $this->setTemplateVar('lastchange_user',$user->getProperties());
        $this->setTemplateVar('lastchange_date',$this->value->lastchangeTimeStamp);

		$t = new Template( $this->page->templateid );
		$t->load();
		$this->setTemplateVar('template_name',$t->name );
		$this->setTemplateVar('template_id'  ,$t->templateid );


	}


	/**
	 * Normaler Editiermodus.
	 *
	 * Es wird ein Formular erzeugt, mit dem der Benutzer den Inhalt bearbeiten kann.
	 */
	public function editView()
	{
		$this->value->objectid   = $this->page->objectid;
		$this->value->pageid     = $this->page->pageid;
		$this->value->page       = $this->page;
		$this->value->element    = &$this->element;
		$this->value->elementid  = $this->element->elementid;
		$this->value->element->load();

		$this->setTemplateVar('name'       ,$this->value->element->label    );
		$this->setTemplateVar('description',$this->value->element->desc     );
		$this->setTemplateVar('elementid'  ,$this->value->element->elementid);
		$this->setTemplateVar('type'       ,$this->value->element->getTypeName() );

		$languages = array();

		foreach ( $this->page->getProject()->getLanguages() as $languageId=>$languageName )
        {
        	$value = clone $this->value; // do not overwrite the value
            $value->languageid = $languageId;
            $value->load();

            $languages[$languageId] = array(
                'languageid'   => $languageId,
                'languagename' => $languageName,
                'text'         => $this->calculateValue( $value ),
                'number'       => $value->number,
                'date'         => $value->date,
                'linkObjectId' => $value->linkToObjectId,
        );
        }

        $this->setTemplateVar('languages',$languages);
	}






	/**
	 * Erweiterter Modus.
	 */
	public function advancedView()
	{
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



	public function valueView()
	{
		$this->value->languageid = $this->page->languageid;
		$this->value->objectid   = $this->page->objectid;
		$this->value->pageid     = $this->page->pageid;
		$this->value->element = &$this->element;
		$this->value->elementid = &$this->element->elementid;
		$this->value->element->load();
		$this->value->publish = false;


		$valueId =$this->getRequestId('valueid');
		if   ( $valueId ) {
			$this->value->valueid = $valueId;
			$this->value->loadWithId();
		}
		else {
			$this->value->load();
		}

		$this->setTemplateVar('name'     ,$this->value->element->name     );
		$this->setTemplateVar('desc'     ,$this->value->element->desc     );
		$this->setTemplateVar('elementid',$this->value->element->elementid);
		$this->setTemplateVar('languageid',$this->value->languageid       );
		$this->setTemplateVar('type'     ,$this->value->element->getTypeName() );
		$this->setTemplateVar('value_time',time() );


		$this->value->page             = new Page( $this->page->objectid );
		$this->value->page->languageid = $this->value->languageid;
		$this->value->page->load();

		$this->setTemplateVar( 'objectid',$this->value->page->objectid );

		if	( $this->value->page->hasRight(Acl::ACL_RELEASE) )
		$this->setTemplateVar( 'release',true  );
		if	( $this->value->page->hasRight(Acl::ACL_PUBLISH) )
		$this->setTemplateVar( 'publish',false );

		$funktionName = 'edit'.$this->value->element->type;

		if	( ! method_exists($this,$funktionName) )
		throw new \LogicException('Method does not exist: PageElementAction#'.$funktionName );

		$this->$funktionName(); // Aufruf der Funktion "edit<Elementtyp>()".
	}



	/**
	 * Vorschau.
	 */
	public function previewView()
	{
		$valueGenerator = new ValueGenerator( $this->createValueContext( Producer::SCHEME_PREVIEW) );
		$this->setTemplateVar('preview' ,$valueGenerator->getCache()->get() );
	}



	/**
	 * Datum bearbeiten.
	 *
	 */
	private function editdate()
	{
        $this->setTemplateVar( 'date' ,$this->value->date==null?'':date('Y-m-d',$this->value->date) );
        $this->setTemplateVar( 'time' ,$this->value->date==null?'':date('H:i'  ,$this->value->date) );
    }



	/**
	 * Verkn�pfung bearbeiten.
	 *
	 */
	private function editlink()
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



	function linkView()
	{
		$this->value->languageid = $this->page->languageid;
		$this->value->objectid   = $this->page->objectid;
		$this->value->pageid     = $this->page->pageid;
		$this->value->element = &$this->element;
		$this->value->element->load();
		$this->value->load();

		$this->setTemplateVar('name'     ,$this->value->element->name     );
		$this->setTemplateVar('desc'     ,$this->value->element->desc     );

        $project = new Project($this->page->projectid);
        $this->setTemplateVar('rootfolderid'     ,$project->getRootObjectId() );
		
		// Ermitteln, welche Objekttypen verlinkt werden d�rfen.
		if	( empty($this->value->element->subtype) )
		$types = array('page','file','link'); // Fallback: Alle erlauben :)
		else
		$types = explode(',',$this->value->element->subtype );

		$objects = array();
			
		$objects[ 0 ] = \cms\base\Language::lang('LIST_ENTRY_EMPTY'); // Wert "nicht ausgewählt"

		
		$t = new Template( $this->page->templateid );

		foreach( $t->getDependentObjectIds() as $id )
		{
			$o = new BaseObject( $id );
			$o->load();
				
			//			if	( in_array( $o->getType(),$types ))
			//			{
			$f = new Folder( $o->parentid );
			//					$f->load();

			$objects[ $id ]  = \cms\base\Language::lang( $o->getType() ).': ';
			$objects[ $id ] .=  implode( \util\Text::FILE_SEP,$f->parentObjectNames(false,true) );
			$objects[ $id ] .= \util\Text::FILE_SEP.$o->name;
			//			}
		}

        asort( $objects ); // Sortieren

        $this->setTemplateVar('objects'         ,$objects);
        $this->setTemplateVar('linkobjectid',$this->value->linkToObjectId);

        $this->value->page             = new Page( $this->page->objectid );
        $this->value->page->languageid = $this->value->languageid;
        $this->value->page->load();

        $this->setTemplateVar( 'release',$this->value->page->hasRight(Acl::ACL_RELEASE) );
        $this->setTemplateVar( 'publish',$this->value->page->hasRight(Acl::ACL_PUBLISH) );

        $this->setTemplateVar( 'objectid',$this->value->page->objectid );
    }



    /**
     * Auswahlbox.
     *
     */
    private function editselect()
    {
        $this->setTemplateVar( 'items',$this->value->element->getSelectItems() );
        $this->setTemplateVar( 'text' ,$this->value->text                      );

    }



    /**
     * Einf�gen-Element.
     *
     */
    private function editlist()
    {
        $this->editinsert();
    }



    /**
     * Einf�gen-Element.
     *
     */
    private function editinsert()
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


        if	( $this->getSessionVar('pageaction') != '' )
        $this->setTemplateVar('old_pageaction',$this->getSessionVar('pageaction'));
        else	$this->setTemplateVar('old_pageaction','show'                            );
    }



    /**
     * Zahl bearbeiten.
     *
     */
    private function editnumber()
    {
        $this->setTemplateVar('number',$this->value->number / pow(10,$this->value->element->decimals) );
    }


    /**
     * Ein Element der Seite bearbeiten
     *
     * Es wird ein Formular erzeugt, mit dem der Benutzer den Inhalt bearbeiten kann.
     */
    private function editlongtext()
    {
        if   ( $this->hasRequestVar('format') )
            // Individual format from request.
            $format = $this->getRequestId('format');
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
    private function edittext()
    {
        $this->setTemplateVar( 'text',$this->value->text );
    }



    /**
     * Wiederherstellung eines alten Inhaltes.
     */
    public function restorePost()
    {
        $this->value->valueid = $this->getRequestVar('valueid');
        $this->value->loadWithId();
        $this->value->element = new Element( $this->value->elementid );

        if	( $this->value->pageid != $this->page->pageid )
            throw new \LogicException( 'Cannot find value','page-id does not match' );

        // Pruefen, ob Berechtigung zum Freigeben besteht
        //$this->value->release = $this->page->hasRight(Acl::ACL_RELEASE);
        $this->value->release = false;

        // Inhalt wieder herstellen, in dem er neu gespeichert wird.
        $this->value->save();

        $this->addNotice('pageelement', 0, $this->value->element->name, 'PAGEELEMENT_USE_FROM_ARCHIVE', Action::NOTICE_OK);
    }



    /**
     * Freigeben eines Inhaltes
     */
    public function releasePost()
    {
		$this->value->objectid   = $this->page->objectid;
		$this->value->pageid     = $this->page->pageid;
		$this->value->page       = $this->page;
		$this->value->element    = &$this->element;
		$this->value->elementid  = $this->element->elementid;
		$this->value->element->load();

        $this->value->valueid = intval($this->getRequestVar('valueid'));
        $this->value->loadWithId();

        if	( $this->value->pageid != $this->page->pageid )
            throw new LogicException( 'cannot release, bad page' );

        // Pruefen, ob Berechtigung zum Freigeben besteht
        if	( !$this->page->hasRight(Acl::ACL_RELEASE) )
            throw new SecurityException( 'Cannot release','no right' );

        // Inhalt freigeben
        $this->value->release();

        $this->addNoticeFor($this->value, Messages::PAGEELEMENT_RELEASED );
    }


    /**
     * Erzeugt eine Liste aller Versionsst?nde zu diesem Inhalt
     */
    public function historyView()
    {
        $this->page->load();

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
			foreach($value->getVersionList() as $value) {

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


    /**
     * Vergleicht 2 Versionen eines Inhaltes
     */
    function diffView()
    {
        $value1id = $this->getRequestVar('compareid');
        $value2id = $this->getRequestVar('withid'   );

        // Wenn Value1-Id groesser als Value2-Id, dann Variablen tauschen
        if	( $value1id == $value2id )
        {
            $this->addValidationError('compareid'   );
            $this->addValidationError('withid'   ,'');
            $this->callSubAction('archive');
            return;
        }

        // Wenn Value1-Id groesser als Value2-Id, dann Variablen tauschen
        if	( $value1id > $value2id )
        list($value1id,$value2id) = array( $value2id,$value1id );


        $value1 = new Value( $value1id );
        $value2 = new Value( $value2id );
        $value1->valueid = $value1id;
        $value2->valueid = $value2id;

        $value1->loadWithId();
        $value2->loadWithId();

        $this->setTemplateVar('date_left' ,$value1->lastchangeTimeStamp);
        $this->setTemplateVar('date_right',$value2->lastchangeTimeStamp);

        $text1 = explode("\n",$value1->text);
        $text2 = explode("\n",$value2->text);

        // Unterschiede feststellen.
        $diffResult = Text::diff($text1,$text2);

        $outputResult = array_map( function( $left,$right) {
        	return [
        		'left' => $left,
				'right'=> $right
			];
		},$diffResult[0],$diffResult[1] );

        $this->setTemplateVar('diff',$outputResult );
    }



    /**
     * Ein Element der Seite speichern.
     */
    public function valuePost()
    {
        $this->element->load();
        $type = $this->element->type;

        if	( empty($type))
            throw new \InvalidArgumentException('No element type available');

        $funktionName = 'save'.$type;

        if  ( !method_exists($this,$funktionName))
            throw new \InvalidArgumentException('Function not available: '.$funktionName);

        $this->$funktionName(); // Aufruf Methode "save<ElementTyp>()"
    }



    /**
     * Element speichern
     *
     * Der Inhalt eines Elementes wird abgespeichert
     */
    private function savetext()
    {
        $value = new Value();
        $value->publisher  = $this->page->publisher;
        $value->languageid = $this->page->languageid;
        $value->objectid   = $this->page->objectid;
        $value->pageid     = Page::getPageIdFromObjectId( $this->page->objectid );

        if	( !$this->hasRequestVar('elementid') )
            throw new ValidationException('elementid');
        $value->element = new Element( $this->getRequestVar('elementid') );

        $value->element->load();
        $value->load();

        if   ( $this->hasRequestVar('linkobjectid') )
        $value->linkToObjectId = $this->getRequestVar('linkobjectid');
        else
        $value->text           = $this->getRequestVar('text','raw');

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
    private function afterSave( $value )
    {
        $value->page = new Page( $value->objectid );
        $value->page->load();


        // Inhalt sofort freigegeben, wenn
        // - Recht vorhanden
        // - Freigabe gewuenscht
        if	( $value->page->hasRight( Acl::ACL_RELEASE ) && $this->hasRequestVar('release') )
        $value->publish = true;
        else
        $value->publish = false;

        // Up-To-Date-Check
        $lastChangeTime = $value->getLastChangeSinceByAnotherUser( $this->getRequestVar('value_time'), Session::getUser()->userid );
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
                $value->save();
            }
        }
        else
        {
            // sonst nur 1x speichern (fuer die aktuelle Sprache)
            $value->save();
        }

        $this->addNotice('pageelement', 0, $value->element->label, 'SAVED', Action::NOTICE_OK);
        $this->page->setTimestamp(); // "Letzte Aenderung" setzen

        // Falls ausgewaehlt die Seite sofort veroeffentlichen
        if	( $value->page->hasRight( Acl::ACL_PUBLISH ) && $this->hasRequestVar('publish') )
        {
			$this->publishPage();
        }
    }


    /**
     * Element speichern
     *
     * Der Inhalt eines Elementes wird abgespeichert
     */
    private function savelongtext()
    {
        $value = new Value();
        $value->languageid = $this->page->languageid;
        $value->objectid   = $this->page->objectid;
        $value->publisher  = $this->page->publisher;

        $value->pageid     = Page::getPageIdFromObjectId( $this->page->objectid );

        if	( !$this->hasRequestVar('elementid') )
            throw new ValidationException('elementid');
        $value->element = new Element( $this->getRequestVar('elementid') );

        $value->element->load();
        $value->load();

        if   ( $this->hasRequestVar('format') )
            $value->format     = $this->getRequestId('format');
        else
            // Fallback: Format of the element.
            $value->format     = $this->element->format;

        $value->text           = $this->compactOIDs( $this->getRequestVar('text','raw') );

        $this->afterSave($value);

    }


    /**
     * Element speichern
     *
     * Der Inhalt eines Elementes wird abgespeichert
     */
    private function savedate()
    {
        $value = new Value();
        $value->languageid = $this->page->languageid;
        $value->objectid   = $this->page->objectid;
        $value->pageid     = Page::getPageIdFromObjectId( $this->page->objectid );
        $value->publisher  = $this->page->publisher;

        if	( !$this->hasRequestVar('elementid') )
            throw new ValidationException('elementid');

        $value->element = new Element( $this->getRequestVar('elementid') );
        $value->element->load();
        $value->load();

        if   ( $this->hasRequestVar('linkobjectid') )
            $value->linkToObjectId = $this->getRequestVar('linkobjectid');
        else {
            $value->date = strtotime( $this->getRequestVar( 'date' ).' '.$this->getRequestVar( 'time' ) );

        }

        $this->afterSave($value);
    }



    /**
     * Element speichern
     *
     * Der Inhalt eines Elementes wird abgespeichert
     */
    private function saveselect()
    {
        $value = new Value();
        $value->languageid = $this->page->languageid;
        $value->objectid   = $this->page->objectid;
        $value->pageid     = Page::getPageIdFromObjectId( $this->page->objectid );
        $value->publisher  = $this->page->publisher;

        if	( !$this->hasRequestVar('elementid') )
            throw new ValidationException('elementid');
        $value->element = new Element( $this->getRequestVar('elementid') );

        $value->element->load();
        $value->load();

        $value->text           = $this->getRequestVar('text');

        $this->afterSave($value);
    }



    /**
     * Element speichern
     *
     * Der Inhalt eines Elementes wird abgespeichert
     */
    private function savelink()
    {
        $value = new Value();
        $value->publisher  = $this->page->publisher;
        $value->languageid = $this->page->languageid;
        $value->objectid   = $this->page->objectid;
        $value->pageid     = Page::getPageIdFromObjectId( $this->page->objectid );

        if	( !$this->hasRequestVar('elementid') )
            throw new ValidationException('elementid');
        $value->element = new Element( $this->getRequestVar('elementid') );

        $value->element->load();
        $value->load();

        if	( $this->hasRequestVar('linkurl') )
            $value->linkToObjectId = $this->parseSimpleOID($this->getRequestVar('linkurl'));
        else
            $value->linkToObjectId = intval($this->getRequestVar('linkobjectid'));

        $this->afterSave($value);
    }



    /**
     * Element speichern
     *
     * Der Inhalt eines Elementes wird abgespeichert
     */
    private function savelist()
    {
        $this->saveinsert();
    }



    /**
     * Element speichern
     *
     * Der Inhalt eines Elementes wird abgespeichert
     */
    private function saveinsert()
    {
        $value = new Value();
        $value->publisher = $this->page->publisher;
        $value->languageid = $this->page->languageid;
        $value->objectid   = $this->page->objectid;
        $value->pageid     = Page::getPageIdFromObjectId( $this->page->objectid );

        if	( !$this->hasRequestVar('elementid') )
            throw new ValidationException('elementid');
        $value->element = new Element( $this->getRequestVar('elementid') );

        $value->element->load();
        $value->load();

        $value->linkToObjectId = intval($this->getRequestVar('linkobjectid'));

        $this->afterSave($value);
    }



    /**
     * Element speichern
     *
     * Der Inhalt eines Elementes wird abgespeichert
     */
    private function savenumber()
    {
        $value = new Value();
        $value->publisher  = $this->page->publisher;
        $value->languageid = $this->page->languageid;
        $value->objectid   = $this->page->objectid;
        $value->pageid     = Page::getPageIdFromObjectId( $this->page->objectid );

        if	( !$this->hasRequestVar('elementid') )
            throw new ValidationException('elementid');
        $value->element = new Element( $this->getRequestVar('elementid') );

        $value->element->load();
        $value->load();

        if   ( $this->hasRequestVar('linkobjectid') )
        $value->linkToObjectId = $this->getRequestVar('linkobjectid');
        else
        $value->number         = $this->getRequestVar('number') * pow(10,$value->element->decimals);

        $this->afterSave($value);
    }


    function exportlongtext()
    {
        $types = array();

        foreach( array('odf','plaintext') as $type )
        {
            $types[$type] = \cms\base\Language::lang('FILETYPE_'.$type);
        }

        $this->setTemplateVar('types',$types);
    }


    function importlongtext()
    {
        $types = array();

        foreach( array('odf','plaintext') as $type )
        {
            $types[$type] = \cms\base\Language::lang('FILETYPE_'.$type);
        }
        $this->setTemplateVar('types',$types);
    }


    function doexportlongtext()
    {
        $type = $this->getRequestVar('type');
        switch($type)
        {
            case 'odf':

                // Angabe Content-Type
                //				header('Content-Type: '.$this->file->mimeType());
                //				header('X-File-Id: '.$this->file->fileid);

                //				header('Content-Disposition: inline; filename='.$this->id.'.odt');
                header('Content-Transfer-Encoding: binary');
                //				header('Content-Description: '.$this->file->name);

                echo $this->createOdfDocument();

                exit;

            default:
        }

        exit;
    }


    /**
     * ODF erzeugen.<br>
     * vorerst ZURUECKGESTELLT!
     *
     * @return unknown
     */
    private function createOdfDocument()
    {
        // TODO: ODF ist nicht ganz ohne.
        $transformer = new Transformer();
        $transformer->text = $this->value->text;
        $transformer->type = 'odf';
        $transformer->transform();
        return $transformer->text;
    }




    private function linkifyOIDs( $text )
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


    private function compactOIDs( $text )
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
    private function parseSimpleOID($text )
    {
        $treffer = Text::parseOID( $text );

        if   ( isset($treffer[0]))
            // Found an Object-Id.
            return $treffer[0][0];
        else
            return intval($text);
    }

	/**
	 * Seite veroeffentlichen
	 *
	 * Es wird ein Formular angzeigt, mit dem die Seite veroeffentlicht
	 * werden kann 
	 */
	public function pubView()
	{
	}



	/**
	 * Seite veroeffentlichen
	 *
	 * Die Seite wird generiert.
	 */
	function pubPost()
	{
		if	( !$this->page->hasRight( Acl::ACL_PUBLISH ) )
            throw new SecurityException( 'no right for publish' );

		$this->publishPage();
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
	
?>