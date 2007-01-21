<?php
#
#  DaCMS Content Management System
#  Copyright (C) 2002 Jan Dankert, jandankert@jandankert.de
#
#  This program is free software; you can redistribute it and/or
#  modify it under the terms of the GNU General Public License
#  as published by the Free Software Foundation; either version 2
#  of the License, or (at your option) any later version.
#
#  This program is distributed in the hope that it will be useful,
#  but WITHOUT ANY WARRANTY; without even the implied warranty of
#  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#  GNU General Public License for more details.
#
#  You should have received a copy of the GNU General Public License
#  along with this program; if not, write to the Free Software
#  Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
#

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
				$treeElement->text = $element->name;
				$treeElement->url  = Html::url('main',
				                               'pageelement',
				                               $id,
				                               array('elementid'=>$elementid,
				                                     REQ_PARAM_TARGETSUBACTION=>'edit'.$element->type));
				$treeElement->icon = 'el_'.$element->type;

				$treeElement->description = lang('EL_'.$element->type);
				if	( $element->desc != '' )
					$treeElement->description .= ' - '.Text::maxLaenge( 25,$element->desc );
				else
					$treeElement->description .= ' - '.lang('GLOBAL_NO_DESCRIPTION_AVAILABLE');
				$treeElement->target      = 'cms_main';

				if	( in_array($element->type,array('link') ) )
				{
					$treeElement->type = 'value';
					$value = new Value();
					$value->pageid  = $id;
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
				$treeElement->text       = $object->name;
				if	( in_array($object->getType(),array('page','folder')))
				{
					$treeElement->type       = $object->getType();
					$treeElement->internalId = $object->objectid;
				}
				$treeElement->url  = Html::url('main',$object->getType(),$objectid);
				$treeElement->icon = $object->getType();
	
				$treeElement->description = lang('GLOBAL_'.$object->getType());
				if	( $object->desc != '' )
					$treeElement->description .= ' - '.Text::maxLaenge( 25,$object->desc );
				else
					$treeElement->description .= ' - '.lang('GLOBAL_NO_DESCRIPTION_AVAILABLE');
				$treeElement->target      = 'cms_main';
	
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
			$treeElement->internalId = $o->objectid;
			$treeElement->target     = 'cms_main';
			$treeElement->text       = Text::maxLaenge( 25,$o->name );
			$treeElement->description= lang( 'GLOBAL_'.$o->getType() ).' '.$id;

			if	( $o->desc != '' )
				$treeElement->description .= ': '.$o->desc;
			else
				$treeElement->description .= ' - '.lang('GLOBAL_NO_DESCRIPTION_AVAILABLE');

			$treeElement->url        = Html::url('main',$o->getType(),$o->objectid );
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
			$treeElement->internalId = $o->objectid;
			$treeElement->target     = 'cms_main';
			$treeElement->text       = Text::maxLaenge( 25,$o->name );
			$treeElement->description= lang( 'GLOBAL_'.$o->getType() ).' '.$o->objectid;

			if	( $o->desc != '' )
				$treeElement->description .= ': '.$o->desc;
			else
				$treeElement->description .= ' - '.lang('GLOBAL_NO_DESCRIPTION_AVAILABLE');

			$treeElement->url        = Html::url( 'main',$o->getType(),$o->objectid );
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
		$f      = new Folder();
		$f->projectid = $this->projectid;
		$folder = new Folder( $project->getRootObjectId() );
		unset( $f );
		$folder->load();

		
		// Ermitteln, ob der Benutzer Projektadministrator ist
		// Projektadministratoren haben das Recht, im Root-Ordner die Eigenschaften zu aendern.
		if   ( $folder->hasRight( ACL_PROP ) )
			$this->userIsProjectAdmin = true;

		if   ( $folder->hasRight( ACL_READ ) )
		{
			$treeElement = new TreeElement();
			$treeElement->text        = $folder->name;
			$treeElement->description = lang('FOLDER_ROOT_DESC');
			$treeElement->icon        = 'folder';
			$treeElement->url         = Html::url( 'main','folder',$folder->objectid );
			$treeElement->target      = 'cms_main';
			$treeElement->type        = 'folder';
			$treeElement->internalId  = $folder->objectid;
			$this->addTreeElement( $treeElement );
		}


		if	( $this->userIsProjectAdmin )
		{
			// Templates
			$treeElement = new TreeElement();
			$treeElement->text       = lang('GLOBAL_TEMPLATES');
			$treeElement->url        = Html::url('main','template');
			$treeElement->description= lang('GLOBAL_TEMPLATES_DESC');
			$treeElement->icon       = 'template_list';
			$treeElement->target     = 'cms_main';
			$treeElement->type       = 'templates';
			$this->addTreeElement( $treeElement );
		}


		// Sprachen
		$treeElement = new TreeElement();
		$treeElement->description= '';
		$treeElement->text       = lang('GLOBAL_LANGUAGES');
		$treeElement->url        = Html::url('main','language');
		$treeElement->icon       = 'lang_list';
		$treeElement->description= lang('GLOBAL_LANGUAGES_DESC');
		$treeElement->target     = 'cms_main';

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

		$treeElement->description= lang('GLOBAL_MODELS_DESC');
		$treeElement->text       = lang('GLOBAL_MODELS');
		$treeElement->url        = Html::url('main','model');
		$treeElement->icon       = 'model_list';
		$treeElement->target     = 'cms_main';
		$this->addTreeElement( $treeElement );


		// Sonstiges
		$treeElement = new TreeElement();
		$treeElement->text       = lang('GLOBAL_OTHER');
		$treeElement->description= lang('GLOBAL_OTHER_DESC');
		$treeElement->icon       = 'other';
		$treeElement->type       = 'other';
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
			$treeElement->url         = Html::url('main','template',$id);
			$treeElement->icon        = 'template';
			$treeElement->target      = 'cms_main';
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
			$treeElement->text        = $e->name;
			$treeElement->url         = Html::url('main','element',$elementid );
			$treeElement->icon        = 'el_'.$e->type;
			
			if	( $e->desc == '' )
				$desc = lang('GLOBAL_NO_DESCRIPTION_AVAILABLE');
			else
				$desc = $e->desc; 
			$treeElement->description = $e->name.' ('.lang('EL_'.$e->type).'): '.Text::maxLaenge( 40,$desc );
			$treeElement->target      = 'cms_main';
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
			$treeElement->text         = $name;
			$treeElement->url          = Html::url('main','language',$languageid,
			                                       array(REQ_PARAM_TARGETSUBACTION=>'edit') );
			$treeElement->icon         = 'lang';
			$treeElement->description  = '';
			$treeElement->target       = 'cms_main';
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
			$treeElement->text        = $name;
			$treeElement->url         = Html::url('main','model',$id,
			                                      array(REQ_PARAM_TARGETSUBACTION=>'edit'));
			$treeElement->icon        = 'model';
			$treeElement->description = '';
			$treeElement->target      = 'cms_main';
			$this->addTreeElement( $treeElement );
		}
	}


	function other()
	{
// Deaktiviert, da
// - Dateien auf den Server laden unverständlich/undurchsichtig erscheint
// - Möglichkeit zum Entpacken von ZIP/TAR online besteht.
//		if	( $this->userIsProjectAdmin )
//		{
//			$treeElement = new TreeElement();
//			$treeElement->text        = lang('GLOBAL_FILE_TRANSFER');
//			$treeElement->description = lang('GLOBAL_FILE_TRANSFER_DESC');
//			$treeElement->url         = Html::url('main','transfer');
//			$treeElement->icon        = 'transfer';
//			$treeElement->target      = 'cms_main';
//			$this->addTreeElement( $treeElement );
//		}

		$treeElement = new TreeElement();
		$treeElement->text        = lang('GLOBAL_SEARCH');
		$treeElement->url         = Html::url('main','search');
		$treeElement->icon        = 'search';
		$treeElement->description = lang('GLOBAL_SEARCH_DESC');
		$treeElement->target      = 'cms_main';
		$this->addTreeElement( $treeElement );
	}
}

?>