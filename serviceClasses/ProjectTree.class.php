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


	function root()
	{
		$treeElement = new TreeElement();
		$treeElement->text        = lang('PROJECT');
		$treeElement->description = lang('PROJECT');
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
				$treeElement->text        = $element->name;
				$treeElement->url         = Html::url(array('action'  =>'main',
		                                                      'callAction'      =>'pageelement',
		                                                      'callSubaction'   =>'edit',
		                                                      'objectid'        =>$id,
		                                                      'elementid'       =>$elementid       ));
		          $treeElement->icon        = 'el_'.$element->type;
				$treeElement->description = Text::maxLaenge( 25,$element->desc );
				$treeElement->target      = 'cms_main';
				$this->addTreeElement( $treeElement );
			}
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
	
		foreach( $f->getObjectIds() as $id )
		{
			$o = new Object( $id );
	
			// Wenn keine Leseberechtigung	
			if	( !$o->hasRight('read') )
				continue;
	
			$o->load();
			$treeElement = new TreeElement();
			$treeElement->internalId = $id;
			$treeElement->target     = 'cms_main';
			$treeElement->text       = Text::maxLaenge( 25,$o->name );
			$treeElement->description= lang( $o->getType() ).' '.$id.' '.$o->desc;
			$treeElement->url        = Html::url(array('action'       =>'main',
		                                                'callAction'   =>$o->getType(),
		                                                'objectid'       =>$id ));
			$treeElement->icon       = $o->getType();
			
			// Besonderheiten f�r bestimmte Objekttypen	

			if   ( $o->isPage )
			{
				// Nur wenn die Seite beschreibbar ist, werden die
				// Elemente im Baum angezeigt
				if   ( $o->hasRight('write') )
					$treeElement->type='pageelements';
			}

			if   ( $o->isFile )
			{
				$file = new File( $id );
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
		if	( !isset($SESS['languageid']) || intval($SESS['languageid']) == 0 )
			// Ermitteln Default-Sprache
			$SESS['languageid'] = Language::getDefaultId();
	
		// Ermitteln Default-Projektmodell
		if	( !isset($SESS['modelid']) || intval($SESS['modelid']) == 0 )
			$SESS['modelid'] = Model::getDefaultId();


		// H�chster Ordner der Projektstruktur
		$f      = new Folder();
		$f->projectid = $this->projectid;
		$folder = new Folder( $f->getRootObjectId() );
		unset( $f );
		$folder->load();

		if   ( $folder->hasRight('read') )
		{
			$treeElement = new TreeElement();
			$treeElement->text        = $folder->name;
			$treeElement->description = $folder->desc;
			$treeElement->icon        = 'folder';
			$treeElement->url         = Html::url(array('action'       =>'main',
			                                                                 'callAction'   =>'folder',
			                                                                 'objectid'    =>$folder->objectid       ));
			$treeElement->target      = 'cms_main';
			$treeElement->type        = 'folder';
			$treeElement->internalId  = $folder->objectid;
			$this->addTreeElement( $treeElement );
		}


		// Templates
		$treeElement = new TreeElement();
		$treeElement->text       = lang('TEMPLATES');
		$treeElement->url        = Html::url(array('action'       =>'main',
			                                      'callAction'   =>'template',
			                                      'callSubaction'=>'listing',
			                                      'templateid'   =>'0' ));
		$treeElement->description= '';
		$treeElement->icon       = 'tpl_list';
		$treeElement->target     = 'cms_main';
		$treeElement->type       = 'templates';
		$this->addTreeElement( $treeElement );


		// Sprachen
		$treeElement = new TreeElement();
		$treeElement->description= '';
		$treeElement->text       = lang('LANGUAGES');
		$treeElement->url        = Html::url(array('action'       =>'main',
				                                 'callAction'   =>'language',
				                                 'callSubaction'=>'listing' ));
		$treeElement->icon       = 'lang_list';
		$treeElement->description= '';
		$treeElement->target     = 'cms_main';
		$treeElement->type       = 'languages';
		$this->addTreeElement( $treeElement );


		// Projektmodelle
		$treeElement = new TreeElement();
		$treeElement->description= '';
		$treeElement->type       = 'models';

		$treeElement->text       = lang('MODELS');
		$treeElement->url        = Html::url(array('action'       =>'main',
				                                 'callAction'   =>'model',
				                                 'callSubaction'=>'listing'));
		$treeElement->icon       = 'model_list';
		$treeElement->target     = 'cms_main';
		$this->addTreeElement( $treeElement );


		// Sonstiges
		$treeElement = new TreeElement();
		$treeElement->text       = lang('OTHER');
		$treeElement->description='';
		$treeElement->icon       = 'other';
		$treeElement->type       = 'other';
		$this->addTreeElement( $treeElement );


		// Wechseln zu Administration
		$treeElement = new TreeElement();
		$treeElement->text       = lang('ADMINISTRATION');
		$treeElement->description='';
		$treeElement->icon       = 'other';
		$treeElement->type       = '';
		$treeElement->target     = 'cms_tree';
		$treeElement->url        = Html::url(array('action'       =>'tree',
				                                 'subaction'    =>'reload',
				                                 'projectid'    =>'-1'));
		$this->addTreeElement( $treeElement );


		// Wechsel zu ...
		$treeElement = new TreeElement();
		
		$treeElement->text         = lang('CHANGE_TO');
		$treeElement->icon         = 'project';
		$treeElement->type         = 'changeto';
		$treeElement->description  = '';

		$this->addTreeElement( $treeElement );
	}



	function changeto()
	{
		// Wechseln zu: Projekte...
		foreach( Project::getAll() as $id=>$name )
		{
			$treeElement = new TreeElement();
			
			$treeElement->text         = lang('PROJECT').' '.$name;
			$treeElement->url          = Html::url(array('action'       =>'tree',
		                                                  'subaction'    =>'reload',
			                                             'projectid'    =>$id       ));
			$treeElement->icon         = 'project';
			$treeElement->description  = '';
			$treeElement->target       = 'cms_tree';

			$this->addTreeElement( $treeElement );
		}
	}



	function templates()
	{
		// Templates anzeigen
		//
//		if   ( $SESS['user']['is_admin'] == '1' )
//		{
			foreach( Template::getAll() as $id=>$name )
			{
				$treeElement = new TreeElement();

				$t = new Template( $id );
				$t->load();
				$treeElement->text        = $t->name;
				$treeElement->url         = Html::url(array('action'       =>'main',
		                                                      'callAction'   =>'template',
		                                                      'templateid'    =>$id       ));
				$treeElement->icon        = 'tpl';
				$treeElement->target      = 'cms_main';
				$treeElement->internalId  = $id;
				$treeElement->type        = 'template';
				$this->addTreeElement( $treeElement );
			}
//		}
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
			$treeElement = new TreeElement();
			$treeElement->text = $e->name;
			$treeElement->url  = Html::url(array('action'       =>'main',
                                                    'callAction'   =>'element',
                                                    'callSubaction'=>'edit',
                                                    'templateid'=>$id,
                                                    'elementid'    =>$elementid       ));
			$treeElement->icon = 'el_'.$e->type;
			$treeElement->target = 'cms_main';
			$this->addTreeElement( $treeElement );
		}
	}


	function languages()
	{
          // Sprachvarianten
          //
          $l = new Language();
//		$l->projectid = $projectid;
		$languages = $l->getAll();

		if	( count($languages) > 0)
		{
	
			foreach( $languages as $languageid=>$name )
			{
				$treeElement = new TreeElement();
				$treeElement->text         = $name;
				$treeElement->url          = Html::url(array('action'       =>'main',
			                                                  'callAction'   =>'language',
			                                                  'callSubaction'=>'edit',
			                                                  'languageid'    =>$languageid       ));
				$treeElement->icon         = 'lang';
				$treeElement->description  = '';
				$treeElement->target       = 'cms_main';
				$this->addTreeElement( $treeElement );
			}
		}
	}


	function models()
	{
          // Projektvarianten
          //
		$m = new Model();
//		$m->projectid = $projectid;
	
		$models = $m->getAll();

		if	( count($models) > 1 )
		{

			if	( $this->userIsAdmin() )
			{
				foreach( $models as $id=>$name )
				{
					$treeElement = new TreeElement();
					$treeElement->text        = $name;
					$treeElement->url         = Html::url(array('action'       =>'main',
				                                                 'callAction'   =>'model',
				                                                 'callSubaction'=>'edit',
				                                                 'modelid'    =>$id       ));
					$treeElement->icon        = 'model';
					$treeElement->description = '';
					$treeElement->target      = 'cms_main';
					$this->addTreeElement( $treeElement );
				}
			}
		}
	}


	function other()
	{
//		if	( $SESS['user']['is_admin'] )
//		{
			$treeElement = new TreeElement();
		     $treeElement->text        = lang('FILE_TRANSFER');
		     $treeElement->description = '';
		     $treeElement->url         = Html::url(array('action'       =>'main',
		                                                 'callAction'   =>'transfer'));
			$treeElement->icon        = 'transfer';
			$treeElement->target      = 'cms_main';
			$this->addTreeElement( $treeElement );
//		}

		$treeElement = new TreeElement();
		$treeElement->text        = lang('SEARCH');
		$treeElement->url         = Html::url(array('action'       =>'main',
		                                            'callAction'   =>'search' ));
		$treeElement->icon        = 'search';
		$treeElement->description = '';
		$treeElement->target      = 'cms_main';
		$this->addTreeElement( $treeElement );
	}
}

?>