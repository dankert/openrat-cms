<?php

namespace cms\action;

use cms\model\Acl;
use cms\model\Project;
use cms\model\User;
use cms\model\Value;
use cms\model\Element;
use cms\model\Template;
use cms\model\Page;
use cms\model\Folder;
use cms\model\BaseObject;
use cms\publish\PublishEdit;
use cms\publish\PublishPreview;
use cms\publish\PublishShow;
use Html;
use Http;
use LogicException;
use Session;
use Transformer;
use \Text;
use ValidationException;

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
class PageelementAction extends Action
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
        $this->value->publisher = new PublishPreview();

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



	/**
	 * Anzeigen des Element-Inhaltes.
	 */
	public function propView()
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
        }catch (\ObjectNotFoundException $e) {
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
	 * Anzeigen des Element-Inhaltes.
	 */
	public function structureView()
	{
		$this->value->languageid = $this->page->languageid;
		$this->value->objectid   = $this->page->objectid;
		$this->value->pageid     = $this->page->pageid;
		$this->value->page       = $this->page;
		$this->value->simple = false;
		$this->value->element = &$this->element;
		$this->value->element->load();
		$this->value->load();

		if	( $this->value->element->type == 'longtext' && $this->value->element->wiki )
		{
			$this->setTemplateVar('text',$this->value->text);
		}

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
		$this->value->element = &$this->element;
		$this->value->element->load();
		$this->value->publisher = new PublishEdit();

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
                'value'        => $this->value->generate()
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
		$this->value->element->load();
		$this->value->publisher = new PublishEdit();

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
                'value'        => $this->value->generate(),
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
		$this->value->element->load();
		$this->value->publish = false;

		if	( intval($this->value->valueid)!=0 )
		$this->value->loadWithId();
		else
		$this->value->load();

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
		$this->value->languageid = $this->page->languageid;
		$this->value->objectid   = $this->page->objectid;
		$this->value->pageid     = $this->page->pageid;
		$this->value->element = &$this->element;
		$this->value->element->load();

		if	( intval($this->value->valueid)!=0 )
		$this->value->loadWithId();
		else
		$this->value->load();


		$this->value->page             = new Page( $this->page->objectid );
		$this->value->page->languageid = $this->value->languageid;
		$this->value->page->load();

		$this->value->generate();
		$this->setTemplateVar('preview' ,$this->value->value );
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

		$this->setTemplateVar('objects'         ,array() );
		$this->setTemplateVar('linkobjectid',$this->value->linkToObjectId);
		
		$this->setTemplateVar('types',implode(',',$types));

		if	( $this->getSessionVar('pageaction') != '' )
    		$this->setTemplateVar('old_pageaction',$this->getSessionVar('pageaction'));
		else
	    	$this->setTemplateVar('old_pageaction','show'                            );
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
			
		$objects[ 0 ] = lang('LIST_ENTRY_EMPTY'); // Wert "nicht ausgewählt"

		
		$t = new Template( $this->page->templateid );

		foreach( $t->getDependentObjectIds() as $id )
		{
			$o = new BaseObject( $id );
			$o->load();
				
			//			if	( in_array( $o->getType(),$types ))
			//			{
			$f = new Folder( $o->parentid );
			//					$f->load();

			$objects[ $id ]  = lang( $o->getType() ).': ';
			$objects[ $id ] .=  implode( FILE_SEP,$f->parentObjectNames(false,true) );
			$objects[ $id ] .= FILE_SEP.$o->name;
			//			}
		}

        asort( $objects ); // Sortieren

        $this->setTemplateVar('objects'         ,$objects);
        $this->setTemplateVar('linkobjectid',$this->value->linkToObjectId);

        if	( $this->getSessionVar('pageaction') != '' )
        $this->setTemplateVar('old_pageaction',$this->getSessionVar('pageaction'));
        else	$this->setTemplateVar('old_pageaction','show'                            );

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


        if	( $this->getSessionVar('pageaction') != '' )
        $this->setTemplateVar('old_pageaction',$this->getSessionVar('pageaction'));
        else	$this->setTemplateVar('old_pageaction','show'                            );
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
        $objects[ 0 ] = lang('LIST_ENTRY_EMPTY'); // Wert "nicht ausgewählt"

        $project = new Project( $this->page->projectid );
        $folder = new Folder($project->getRootObjectId());
        $folder->load();

        //Auch Dateien dazu
        foreach( $project->getAllObjectIds($types) as $id )
        {
            $f = new Folder( $id );
            $f->load();

            $objects[ $id ]  = lang( $f->getType() ).': ';
            $objects[ $id ] .=  implode( ' &raquo; ',$f->parentObjectNames(false,true) );
        }

        foreach( $project->getAllFolders() as $id )
        {
            $f = new Folder( $id );
            $f->load();

            $objects[ $id ]  = lang( $f->getType() ).': ';
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

        if	( $this->getSessionVar('pageaction') != '' )
        $this->setTemplateVar('old_pageaction',$this->getSessionVar('pageaction'));
        else	$this->setTemplateVar('old_pageaction','show'                            );
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

        if ( !isset($this->templateVars['text']))
            // Möglicherweise ist die Ausgabevariable bereits gesetzt, wenn man bereits
            // einen Text eingegeben hat (Vorschaufunktion).
            $this->setTemplateVar( 'text',$this->linkifyOIDs( $this->value->text ) );


        if	( $this->getSessionVar('pageaction') != '' )
        $this->setTemplateVar('old_pageaction',$this->getSessionVar('pageaction'));
        else	$this->setTemplateVar('old_pageaction','show'                            );



        if	( $this->element->wiki && false /* OLD */ )
        {
            $project = new Project( $this->page->projectid );
            $languages = $project->getLanguages();

            if	( count($languages) > 1 )
            {
                $languages[$this->value->languageid] = $languages[$this->value->languageid].' *';
                $this->setTemplateVar('languages',$languages);
            }

            if	( $this->hasRequestVar('otherlanguageid') )
            {
                $lid = $this->getRequestVar('otherlanguageid');
                $otherValue = new Value();
                $otherValue->languageid = $lid;
                $otherValue->pageid     = $this->value->pageid;
                $otherValue->element    = $this->value->element;
                $otherValue->elementid  = $this->value->elementid;
                $otherValue->publisher    = $this->value->publisher;
                $otherValue->load();
                $this->setTemplateVar('languagetext'   ,wordwrap($otherValue->text,100)  );
                $this->setTemplateVar('languagename'   ,$languages[$lid]   );
                $this->setTemplateVar('otherlanguageid',$lid               );
            }

            if ( !isset($this->templateVars['text']))
            // Möglicherweise ist die Ausgabevariable bereits gesetzt, wenn man bereits
            // einen Text eingegeben hat (Vorschaufunktion).
            $this->setTemplateVar( 'text',$this->value->text          );
        }

    }



    /**
     * Ein Element der Seite bearbeiten
     *
     * Es wird ein Formular erzeugt, mit dem der Benutzer den Inhalt bearbeiten kann.
     */
    private function edittext()
    {
        $this->setTemplateVar( 'text',$this->value->text );

        if	( $this->getSessionVar('pageaction') != '' )
        $this->setTemplateVar('old_pageaction',$this->getSessionVar('pageaction'));
        else	$this->setTemplateVar('old_pageaction','show'                            );
    }



    /**
     * Wiederherstellung eines alten Inhaltes.
     */
    public function usePost()
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

        $this->addNotice('pageelement',$this->value->element->name,'PAGEELEMENT_USE_FROM_ARCHIVE',OR_NOTICE_OK);
    }



    /**
     * Freigeben eines Inhaltes
     */
    public function releasePost()
    {
        $this->value->valueid = intval($this->getRequestVar('valueid'));
        $this->value->loadWithId();

        if	( $this->value->pageid != $this->page->pageid )
            throw new LogicException( 'cannot release, bad page' );

        // Pruefen, ob Berechtigung zum Freigeben besteht
        if	( !$this->page->hasRight(Acl::ACL_RELEASE) )
            throw new \SecurityException( 'Cannot release','no right' );

        // Inhalt freigeben
        $this->value->release();

        $this->addNotice('pageelement',$this->value->element->name,'PAGEELEMENT_RELEASED',OR_NOTICE_OK);
    }


    /**
     * Erzeugt eine Liste aller Versionsst?nde zu diesem Inhalt
     */
    public function historyView()
    {
        $this->page->load();
        $this->value->page = &$this->page;

        $this->value->publisher  = $this->page->publisher;
        $this->value->languageid = $this->page->languageid;
        $this->value->objectid   = $this->page->objectid;
        $this->value->pageid     = Page::getPageIdFromObjectId( $this->page->objectid );
        $this->value->element    = &$this->element;
        $this->value->element->load();

        $list         = array();
        //		$version_list = array();
        $lfd_nr       = 0;

        foreach( $this->value->getVersionList() as $value )
        {
            $lfd_nr++;
            $value->element = &$this->element;
            $value->page    = &$this->page;
            $value->publisher = &$this->page->publisher;
            $value->generate();


            //			$date = date( lang('DATE_FORMAT'),$value->lastchangeTimeStamp);

            //			if	( in_array(	$this->element->type,array('text','longtext') ) )
            //				$version_list[ $value->valueid ] = '('.$lfd_nr.') '.$date;

            $zeile = array(  'value'     => Text::maxLength($value->value, 50),
                         'objectid'  => $this->page->objectid,
                         'date'      => $value->lastchangeTimeStamp,
                         'lfd_nr'    => $lfd_nr,
                         'id'        => $value->valueid,
                         'valueid'   => $value->valueid,
                         'user'      => $value->lastchangeUserName );

            // Nicht aktive Inhalte k�nnen direkt bearbeitet werden und sind
            // nach dem Speichern dann wieder aktiv (nat�rlich als n�chster/neuer Inhalt)
            if	( ! $value->active )
            $zeile['useUrl'] = Html::url('pageelement','usevalue',$this->page->objectid,array('valueid'  =>$value->valueid,'mode'=>'edit'));

            // Freigeben des Inhaltes.
            // Nur das aktive Inhaltselement kann freigegeben werden. Nat�rlich auch nur,
            // wenn es nicht schon freigegeben ist.
            if	( ! $value->publish && $value->active )
            $zeile['releaseUrl'] = Html::url('pageelement','release',$this->page->objectid,array('valueid'  =>$value->valueid ));

            $zeile['public'] = $value->publish;
            $zeile['active'] = $value->active;

            $list[$lfd_nr] = $zeile;

        }

        if	( in_array( $this->value->element->type, array('longtext') ) && $lfd_nr >= 2 )
        {
            $this->setTemplateVar('compareid',$list[$lfd_nr-1]['id']);
            $this->setTemplateVar('withid'   ,$list[$lfd_nr  ]['id']);
        }

        $this->setTemplateVar('name'     ,$this->element->name);
        $this->setTemplateVar('el'       ,$list                );
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
        $res_diff = Text::diff($text1,$text2);

        list( $text1,$text2 ) = $res_diff;

        $diff = array();
        $i = 0;
        while( isset($text1[$i]) || isset($text2[$i]) )
        {
            $line = array();

            if	( isset($text1[$i]['text']) )
            $line['left'] = $text1[$i];

            if	( isset($text2[$i]['text']) )
            $line['right'] = $text2[$i];

            $i++;
            $diff[] = $line;
        }
        $this->setTemplateVar('diff',$diff );
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
     * @throws \ObjectNotFoundException
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
        $lastChangeTime = $value->getLastChangeTime();
        if	( $lastChangeTime > $this->getRequestVar('value_time') )
        {
            $this->addNotice('pageelement',$value->element->name,'CONCURRENT_VALUE_CHANGE',OR_NOTICE_WARN,array('last_change_time'=>date(lang('DATE_FORMAT'),$lastChangeTime)));
        }

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

        $this->addNotice('pageelement',$value->element->name,'SAVED',OR_NOTICE_OK);
        $this->page->setTimestamp(); // "Letzte Aenderung" setzen

        // Falls ausgewaehlt die Seite sofort veroeffentlichen
        if	( $value->page->hasRight( Acl::ACL_PUBLISH ) && $this->hasRequestVar('publish') )
        {
            $this->page->publish();
            $this->addNotice('pageelement',$value->element->name,'PUBLISHED',OR_NOTICE_OK);
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

        // Vorschau anzeigen
        if	( $this->hasRequestVar('preview'  ) ||
        $this->hasRequestVar('addmarkup')    )
        {
            $inputText = $this->getRequestVar('text','raw');

            if	( $this->hasRequestVar('preview') )
            {
                $value->page             = $this->page;
                $value->simple           = false;
                $value->page->languageid = $value->languageid;
                $value->page->load();
                $value->generate();
                $this->setTemplateVar('preview',$value->value );
            }


            $this->setTemplateVar( 'release' ,$this->page->hasRight(Acl::ACL_RELEASE) );
            $this->setTemplateVar( 'publish' ,$this->page->hasRight(Acl::ACL_PUBLISH) );
            $this->setTemplateVar( 'html'    ,$value->element->html );
            $this->setTemplateVar( 'wiki'    ,$value->element->wiki );
            $this->setTemplateVar( 'text'    ,$inputText );
            $this->setTemplateVar( 'name'    ,$value->element->name );
            $this->setTemplateVar( 'desc'    ,$value->element->desc );
            $this->setTemplateVar( 'objectid',$this->page->objectid );

            $this->setTemplateVar( 'mode'    ,'edit' );
        }
        else
        {
            $this->afterSave($value);
        }

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
            $types[$type] = lang('FILETYPE_'.$type);
        }

        $this->setTemplateVar('types',$types);
    }


    function importlongtext()
    {
        $types = array();

        foreach( array('odf','plaintext') as $type )
        {
            $types[$type] = lang('FILETYPE_'.$type);
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
        foreach( Text::parseOID($text) as $oid=>$t )
        {
            $url = $this->page->path_to_object($oid);
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
            throw new \SecurityException( 'no right for publish' );

		$this->page->public = true;
		$this->page->publish();
		$this->page->publisher->close();

		$this->addNotice( 'page',
		                  $this->page->fullFilename,
		                  'PUBLISHED',
		                  OR_NOTICE_OK,
		                  array(),
		                  $this->page->publisher->log  );
	}
	
}
	
?>