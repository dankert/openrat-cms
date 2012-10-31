<?php
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
 * Darstellen der Projektstruktur
 * @author $Author$
 * @version $Revision$
 * @package openrat.services
 */
class ProjectTree extends AbstractTree
{
	var $projectId;
	var $userIsProjectAdmin = false;

	function root()
	{
		$treeElement = new TreeElement();
		$treeElement->text        = lang('GLOBAL_PROJECT');
		$treeElement->description = lang('GLOBAL_PROJECT');
		$treeElement->type        = 'project';
		$treeElement->icon        = 'project';

		$this->addTreeElement( $treeElement );
	}



	function pageelements( $id )
	{
		$page = new Page( $id );
		$page->load();
	
		$template = new Template( $page->templateid );
	
		foreach( $template->getElementIds() as $elementid )
		{
			$element = new Element( $elementid );
			$element->load();
	
			if	( $element->isWritable() )
			{
				$treeElement = new TreeElement();
				$treeElement->id   = $id.'_'.$elementid;
				$treeElement->extraId['elementid'] =  $elementid;
				$treeElement->text = $element->name;
				$treeElement->url  = Html::url('pageelement','edit',
				                               $id.'_'.$elementid,
				                               array('elementid'=>$elementid,
				                                     REQ_PARAM_TARGETSUBACTION=>'edit',REQ_PARAM_TARGET=>'content'));
				$treeElement->action = 'pageelement'; 
				$treeElement->icon = 'el_'.$element->type;

				$treeElement->description = lang('EL_'.$element->type);
				if	( $element->desc != '' )
					$treeElement->description .= ' - '.Text::maxLaenge( 25,$element->desc );
				else
					$treeElement->description .= ' - '.lang('GLOBAL_NO_DESCRIPTION_AVAILABLE');
				$treeElement->target      = 'content';

				if	( in_array($element->type,array('link','list','include') ) )
				{
					$treeElement->type = 'value';
					$value = new Value();
					$value->pageid  = $page->pageid;
					$value->element = $element;
					$value->load();
					$treeElement->internalId = $value->valueid;
				}

				$this->addTreeElement( $treeElement );
			}
		}
	}


	function value( $id )
	{
				//echo "id: $id";
		if	( $id != 0 )
		{
			$value = new Value();
			$value->loadWithId( $id );
		
			$objectid = intval($value->linkToObjectId);
			if	( $objectid != 0 )
			{
				$object = new Object( $objectid );
				$object->load();
		
				$treeElement = new TreeElement();
				$treeElement->id         = $id;
				$treeElement->text       = $object->name;
				if	( in_array($object->getType(),array('page','folder')))
				{
					$treeElement->type       = $object->getType();
					$treeElement->internalId = $object->objectid;
				}
				$treeElement->url    = Html::url($object->getType(),'',$objectid,array(REQ_PARAM_TARGET=>'content'));
				$treeElement->action = $object->getType();
				$treeElement->icon   = $object->getType();
	
				$treeElement->description = lang('GLOBAL_'.$object->getType());
				if	( $object->desc != '' )
					$treeElement->description .= ' - '.Text::maxLaenge( 25,$object->desc );
				else
					$treeElement->description .= ' - '.lang('GLOBAL_NO_DESCRIPTION_AVAILABLE');
				$treeElement->target      = 'content';
	
				$this->addTreeElement( $treeElement );
			}
		}
	}


	function link( $id )
	{
		$link = new Link( $id );
		$link->load();

		if	( $link->isLinkToObject )
		{
			$o = new Object( $link->linkedObjectId );
			$o->load();
			
			$treeElement = new TreeElement();
			$treeElement->id         = $o->objectid;
			$treeElement->internalId = $o->objectid;
			$treeElement->target     = 'content';
			$treeElement->text       = $o->name;
			$treeElement->description= lang( 'GLOBAL_'.$o->getType() ).' '.$id;

			if	( $o->desc != '' )
				$treeElement->description .= ': '.$o->desc;
			else
				$treeElement->description .= ' - '.lang('GLOBAL_NO_DESCRIPTION_AVAILABLE');

			$treeElement->url        = Html::url($o->getType(),'',$o->objectid,array(REQ_PARAM_TARGET=>'content') );
			$treeElement->action     = $o->getType(); 
			$treeElement->icon       = $o->getType();
			
			// Besonderheiten fuer bestimmte Objekttypen	

			if   ( $o->isPage )
			{
				// Nur wenn die Seite beschreibbar ist, werden die
				// Elemente im Baum angezeigt
				if   ( $o->hasRight( ACL_WRITE ) )
					$treeElement->type='pageelements';
			}
			$this->addTreeElement( $treeElement );
		}
	}


	/**
	 * Laedt Elemente zu einem Ordner
	 * @return Array
	 */
	function folder( $id )
	{
		global
		$SESS,
		$projectid;

		$f = new Folder( $id );
		$t = time();
	
		foreach( $f->getObjects() as $o )
		{
			// Wenn keine Leseberechtigung	
			if	( !$o->hasRight( ACL_READ ) )
				continue;
	
			$treeElement = new TreeElement();
			$treeElement->id         = $o->objectid;
			$treeElement->internalId = $o->objectid;
			$treeElement->target     = 'content';
			$treeElement->text       = $o->name;
			$treeElement->description= lang( 'GLOBAL_'.$o->getType() ).' '.$o->objectid;

			if	( $o->desc != '' )
				$treeElement->description .= ': '.$o->desc;
			else
				$treeElement->description .= ' - '.lang('GLOBAL_NO_DESCRIPTION_AVAILABLE');

			$treeElement->url        = Html::url( $o->getType(),'',$o->objectid,array('readit'=>'__OID__'.$o->objectid.'__',REQ_PARAM_TARGET=>'content') );
			$treeElement->action     = $o->getType();
			$treeElement->icon       = $o->getType();
			
			// Besonderheiten fuer bestimmte Objekttypen	

			if   ( $o->isLink )
			{
				$treeElement->type='link';
			}

			if   ( $o->isPage )
			{
				// Nur wenn die Seite beschreibbar ist, werden die
				// Elemente im Baum angezeigt
				if   ( $o->hasRight( ACL_WRITE ) )
					$treeElement->type='pageelements';
			}

			if   ( $o->isFile )
			{
				$file = new File( $o->objectid );
				$file->load();

				if	( substr($file->mimeType(),0,6) == 'image/' )
					$treeElement->icon = 'image';
				else	$treeElement->icon = 'file';
			}

			if   ( $o->isFolder )
			{
				$treeElement->type = 'folder';
			}


			$this->addTreeElement( $treeElement );
		}
	}


	function project()
	{
		$language = Session::getProjectLanguage();
		$model    = Session::getProjectModel();
		$user     = Session::getUser();

		$project  = Session::getProject();
		$this->projectid = $project->projectid;

		// Hoechster Ordner der Projektstruktur
		$folder = new Folder( $project->getRootObjectId() );
		$folder->load();

		
		// Ermitteln, ob der Benutzer Projektadministrator ist
		// Projektadministratoren haben das Recht, im Root-Ordner die Eigenschaften zu aendern.
		if   ( $folder->hasRight( ACL_PROP ) )
			$this->userIsProjectAdmin = true;

		if   ( $folder->hasRight( ACL_READ ) )
		{
			$treeElement = new TreeElement();
			$treeElement->id          = $folder->objectid;
			//			$treeElement->text        = $folder->name;
			$treeElement->text        = lang('FOLDER_ROOT');
			$treeElement->description = lang('FOLDER_ROOT_DESC');
			$treeElement->icon        = 'folder';
			$treeElement->action      = 'folder'; 
			$treeElement->url         = Html::url( 'folder','',$folder->objectid,array(REQ_PARAM_TARGET=>'content') );
			$treeElement->target      = 'content';
			$treeElement->type        = 'folder';
			$treeElement->internalId  = $folder->objectid;
			$this->addTreeElement( $treeElement );
		}


		if	( $this->userIsProjectAdmin )
		{
			// Templates
			$treeElement = new TreeElement();
			$treeElement->id         = 0;
			$treeElement->text       = lang('GLOBAL_TEMPLATES');
			$treeElement->url        = Html::url('template','listing',0,array(REQ_PARAM_TARGETSUBACTION=>'listing',REQ_PARAM_TARGET=>'content'));
			$treeElement->description= lang('GLOBAL_TEMPLATES_DESC');
			$treeElement->icon       = 'templatelist';
			$treeElement->action     = 'templatelist';
			$treeElement->target     = 'content';
			$treeElement->type       = 'templates';
			$this->addTreeElement( $treeElement );
		}


		// Sprachen
		$treeElement = new TreeElement();
		$treeElement->description= '';
		$treeElement->id          = 0;
		$treeElement->action     = 'languagelist';
		$treeElement->text       = lang('GLOBAL_LANGUAGES');
		$treeElement->url        = Html::url('language','listing',0,array(REQ_PARAM_TARGETSUBACTION=>'listing',REQ_PARAM_TARGET=>'content'));
		$treeElement->icon       = 'languagelist';
		$treeElement->description= lang('GLOBAL_LANGUAGES_DESC');
		$treeElement->target     = 'content';

		// Nur fuer Projekt-Administratoren aufklappbar
		if	( $this->userIsProjectAdmin )
			$treeElement->type   = 'languages';

		$this->addTreeElement( $treeElement );


		// Projektmodelle
		$treeElement = new TreeElement();
		$treeElement->description= '';

		// Nur fuer Projekt-Administratoren aufklappbar
		if	( $this->userIsProjectAdmin )
			$treeElement->type   = 'models';

		$treeElement->id          = 0;
		$treeElement->description= lang('GLOBAL_MODELS_DESC');
		$treeElement->text       = lang('GLOBAL_MODELS');
		$treeElement->url        = Html::url('model','listing',0,array(REQ_PARAM_TARGETSUBACTION=>'listing',REQ_PARAM_TARGET=>'content'));
		$treeElement->action     = 'modellist';
		$treeElement->icon       = 'modellist';
		$treeElement->target     = 'content';
		$this->addTreeElement( $treeElement );


		// Sonstiges
//		$treeElement = new TreeElement();
//		$treeElement->text       = lang('GLOBAL_OTHER');
//		$treeElement->description= lang('GLOBAL_OTHER_DESC');
//		$treeElement->icon       = 'other';
//		$treeElement->type       = 'other';
//		$this->addTreeElement( $treeElement );
		
		// Suche
		$treeElement = new TreeElement();
		$treeElement->id          = 0;
		$treeElement->text        = lang('GLOBAL_SEARCH');
		$treeElement->url         = Html::url('search','',0,array(REQ_PARAM_TARGET=>'content'));
		$treeElement->action      = 'search';
		$treeElement->icon        = 'search';
		$treeElement->description = lang('GLOBAL_SEARCH_DESC');
		$treeElement->target      = 'content';
		$this->addTreeElement( $treeElement );
		
	}


	function templates()
	{
		foreach( Template::getAll() as $id=>$name )
		{
			$treeElement = new TreeElement();

			$t = new Template( $id );
			$t->load();
			$treeElement->text        = $t->name;
			$treeElement->id          = $id;
			$treeElement->url         = Html::url('template','src',$id,array(REQ_PARAM_TARGETSUBACTION=>'src',REQ_PARAM_TARGET=>'content'));
			$treeElement->icon        = 'template';
			$treeElement->action      = 'template';
			$treeElement->target      = 'content';
			$treeElement->internalId  = $id;
			$treeElement->type        = 'template';
			$treeElement->description = $t->name.' ('.lang('GLOBAL_TEMPLATE').' '.$id.'): '.htmlentities(Text::maxLaenge( 40,$t->src ));
			$this->addTreeElement( $treeElement );
		}
	}


	function template( $id )
	{

		$t = new Template( $id );
		$t->load();

		// Anzeigen der Template-Elemente
		//
		foreach( $t->getElementIds() as $elementid )
		{
			$e = new Element( $elementid );
			$e->load();

			// "Code"-Element nur fuer Administratoren			
			if	( $e->type == 'code' && !$this->userIsAdmin )
				continue;

			$treeElement = new TreeElement();
			$treeElement->id          = $elementid;
			$treeElement->text        = $e->name;
			$treeElement->url         = Html::url('element','',$elementid,array(REQ_PARAM_TARGET=>'content') );
			$treeElement->icon        = 'el_'.$e->type;
			$treeElement->action      = 'element';
			
			if	( $e->desc == '' )
				$desc = lang('GLOBAL_NO_DESCRIPTION_AVAILABLE');
			else
				$desc = $e->desc; 
			$treeElement->description = $e->name.' ('.lang('EL_'.$e->type).'): '.Text::maxLaenge( 40,$desc );
			$treeElement->target      = 'content';
			$this->addTreeElement( $treeElement );
		}
	}


	/**
	 * Sprachen
	 */
	function languages()
	{
		// Sprachvarianten
		//
		$l = Session::getProjectLanguage();
		$languages = $l->getAll();

		foreach( $languages as $languageid=>$name )
		{
			$treeElement = new TreeElement();
			$treeElement->id          = $languageid;
			$treeElement->text         = $name;
			$treeElement->url          = Html::url('language','edit',$languageid,
			                                       array(REQ_PARAM_TARGETSUBACTION=>'edit',REQ_PARAM_TARGET=>'content') );
			$treeElement->icon         = 'language';
			$treeElement->action       = 'language'; 
			$treeElement->description  = '';
			$treeElement->target       = 'content';
			$this->addTreeElement( $treeElement );
		}
	}


	// Projektvarianten
	//
	function models()
	{
		$m = Session::getProjectModel();
		$models = $m->getAll();

		foreach( $models as $id=>$name )
		{
			$treeElement = new TreeElement();
			$treeElement->id          = $id;
			$treeElement->text        = $name;
			$treeElement->url         = Html::url('model','edit',$id,
			                                      array(REQ_PARAM_TARGETSUBACTION=>'edit',REQ_PARAM_TARGET=>'content'));
			$treeElement->action      = 'model';
			$treeElement->icon        = 'model';
			$treeElement->description = '';
			$treeElement->target      = 'content';
			$this->addTreeElement( $treeElement );
		}
	}


	function other()
	{
// Deaktiviert, da
// - Dateien auf den Server laden unverst�ndlich/undurchsichtig erscheint
// - M�glichkeit zum Entpacken von ZIP/TAR online besteht.
//		if	( $this->userIsProjectAdmin )
//		{
//			$treeElement = new TreeElement();
//			$treeElement->text        = lang('GLOBAL_FILE_TRANSFER');
//			$treeElement->description = lang('GLOBAL_FILE_TRANSFER_DESC');
//			$treeElement->url         = Html::url('main','transfer');
//			$treeElement->icon        = 'transfer';
//			$treeElement->target      = 'content';
//			$this->addTreeElement( $treeElement );
//		}

		$treeElement = new TreeElement();
		$treeElement->id          = 0;
		$treeElement->text        = lang('GLOBAL_SEARCH');
		$treeElement->url         = Html::url('search');
		$treeElement->icon        = 'search';
		$treeElement->action      = 'search';
		$treeElement->description = lang('GLOBAL_SEARCH_DESC');
		$treeElement->target      = 'content';
		$this->addTreeElement( $treeElement );


		$treeElement = new TreeElement();
		$treeElement->id          = 0;
		$treeElement->text        = lang('USER_YOURPROFILE');
		$treeElement->url         = Html::url('profile','edit',0,array(REQ_PARAM_TARGET=>'content'));
		$treeElement->icon        = 'user';
		$treeElement->action      = 'profile';
		$treeElement->description = lang('USER_PROFILE_DESC');
		$treeElement->target      = 'content';
		$this->addTreeElement( $treeElement );


		$treeElement = new TreeElement();
		$treeElement->id          = 0;
		$treeElement->text        = lang('GLOBAL_PROJECTS');
		$treeElement->url         = Html::url('index','projectmenu',0,array(REQ_PARAM_TARGET=>'content'));
		$treeElement->icon        = 'project';
		$treeElement->description = lang('GLOBAL_PROJECTS');
		$treeElement->target      = 'content';
		$this->addTreeElement( $treeElement );
	}
}

?>