<?php
// ---------------------------------------------------------------------------
// $Id$
// ---------------------------------------------------------------------------
// OpenRat Content Management System
// Copyright (C) 2002 Jan Dankert, jandankert@jandankert.de
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
// ---------------------------------------------------------------------------
// $Log$
// Revision 1.2  2004-05-02 14:49:37  dankert
// Einfügen package-name (@package)
//
// Revision 1.1  2004/04/24 15:14:52  dankert
// Initiale Version
//
// ---------------------------------------------------------------------------


/**
 * Action-Klasse fuer die Darstellung des Untermenues
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */
class MainmenuAction extends Action
{
	var $defaultSubAction = 'login';
	

	function login()
	{
		$this->setTemplateVar('folder',array()      );
		$this->setTemplateVar('action','login'      );
		$this->setTemplateVar('name'  ,'loginaction');
		$this->setTemplateVar('param' ,'objectid'   );
		$this->setTemplateVar('subaction',array('login'=>lang('LOGIN')) );

		$this->callSubAction('show');
	}


	function element()
	{
		$this->subActionName = 'template';
		$this->callSubAction('template');
	}


	function template()
	{
		$this->setTemplateVar('folder',array() );
		// Ermitteln Projectmodell
		$model = new Model($this->getSessionVar('modelid'));
		$model->load();		
		$this->setTemplateVar('projectmodel_name',$model->name);
		
		$this->setTemplateVar('id','tpl'.$this->getSessionVar('templateid'));
	
		if   ( intval($this->getSessionVar('templateid')) != 0 )
		{
			$template = new Template( $this->getSessionVar('templateid') );
			$template->load();
			$this->setTemplateVar('text',$template->name );
			
			$this->setTemplateVar('subaction',array('listing'=>lang('LISTING'),
			                                        'show'   =>lang('SHOW'),
			                                        'el'     =>lang('ELEMENTS'),
			                                        'src'    =>lang('SOURCECODE'),
			                                        'prop'   =>lang('PROP') ));
		}
		else
		{
			$this->setTemplateVar('subaction',array('listing'=>lang('LISTING')));
		
		}
		$this->setTemplateVar('param' ,'templateid');

		$this->callSubAction('show');
	}



	function pageelement()
	{
		$this->subActionName = 'page';
		$this->callSubAction('page');
	}

	function page()
	{

		$this->setTemplateVar('nr',$this->getSessionVar('objectid'));
	
		// Ermitteln Sprache
		$language = new Language( $this->getSessionVar('languageid') );
		$language->load();
		$this->setTemplateVar('language_name',$language->name);
	
		// Ermitteln Projectmodell
		$model = new Model( $this->getSessionVar('modelid') );
		$model->load();
		$this->setTemplateVar('projectmodel_name',$model->name);

		$page = new Page($this->getSessionVar('objectid'));
		$page->load();
		
		$folder = new Folder( $page->parentid );
		$folder->filenames = false;
		$folder->load();

		$this->setTemplateVar('folder',$folder->parentObjectNames(true,true));
	
		// Ermitteln Namen der Seite
		$this->setTemplateVar('text',$page->name);
	
		$this->setTemplateVar('id','o'.$page->objectid);
	
		$list = array();
		$list['show'] = lang('SHOW');

		if   ( $page->hasRight('write') )
		{
			$list['edit'] = lang('EDIT');
			$list['el'  ] = lang('ELEMENTS');
		}
		if   ( $page->hasRight('publish') )
		{
			$list['pub' ] = lang('PUBLISH');
		}

		if   ( $page->hasRight('prop') )
		{
			$list['prop'] = lang('PROP');
		}
				
		$user = $this->getSessionVar('user');
		if   ( $user['is_admin'] )
			$list['src' ] = lang('SOURCECODE');

		if   ( $user['is_admin'] == '1' )
			$list['rights'] = lang('RIGHTS');
		$this->setTemplateVar('subaction',$list);
		$this->setTemplateVar('param','objectid');

		$this->callSubAction('show');
	}



	function user()
	{
		$this->setTemplateVar('folder',array() );
		$user = new User( $this->getSessionVar('userid') );
		$user->load();
			
		$this->setTemplateVar('text',$user->name);
	
		if	( intval($this->getSessionVar('userid') == 0 ))
			$this->setTemplateVar('subaction',array('listing'  =>lang('LISTING')));
		else	$this->setTemplateVar('subaction',array('listing'  =>lang('LISTING'),
		                                             'edit'  =>lang('EDIT'),
		                                             'groups'=>lang('MEMBERSHIPS'),
		                                             'pw'    =>lang('PASSWORD')   ));

		$this->setTemplateVar('param','userid');
		$this->callSubAction('show');
	}



	function group()
	{
		$this->setTemplateVar('folder',array() );

		$group = new Group( $this->getSessionVar('groupid') );
		$group->load();
		$this->setTemplateVar('text',$group->name);

		if	( intval($this->getSessionVar('groupid') == 0 ))
			$this->setTemplateVar('subaction',array('listing'=>lang('LISTING') ));
		else	$this->setTemplateVar('subaction',array('listing'=>lang('LISTING'),
		                                             'edit'   =>lang('EDIT'),
		                                             'users'  =>lang('MEMBERSHIPS') ));

		$this->setTemplateVar('param','groupid');
		$this->callSubAction('show');
	}


	function file()
	{
		// Ermitteln Sprache
		$language = new Language( $this->getSessionVar('languageid') );
		$language->load();
		$this->setTemplateVar('language_name',$language->name);

		$file = new File( $this->getSessionVar('objectid') );
		$file->load();
		
		$folder = new Folder( $file->parentid );
		$folder->filenames = false;
		$folder->load();

		$this->setTemplateVar('nr',$this->getSessionVar('objectid'));

		$this->setTemplateVar('folder',$folder->parentObjectNames(true,true));
		$this->setTemplateVar('text'  ,$file->name);

		$this->setTemplateVar('id','o'.$file->objectid);
	
		$list = array();
		$list['show'] = lang('SHOW');

		if   ( substr($file->mimeType(),0,5) == 'text/' )
			$list['src'] = lang('EDIT');
			
		if   ( $file->hasRight('prop') )
			$list['prop'] = lang('PROP');

		if   ( $file->hasRight('publish') )
			$list['pub' ] = lang('PUBLISH');

		$user = $this->getSessionVar('user');
		if   ( $user['is_admin'] == '1' )
			$list['rights'] = lang('RIGHTS');

		$this->setTemplateVar('subaction',$list);
		$this->setTemplateVar('param','objectid');

		$this->callSubAction('show');
	}



	function link()
	{
		// Ermitteln Sprache
		$link = new Link( $this->getSessionVar('objectid') );
		$link->load();
		
		$folder = new Folder( $link->parentid );
		$folder->filenames = false;
		$folder->load();

		$this->setTemplateVar('nr',$this->getSessionVar('objectid'));

		$language = new Language( $this->getSessionVar('languageid') );
		$language->load();
		$this->setTemplateVar('language_name',$language->name);
		
		$this->setTemplateVar('folder',$folder->parentObjectNames(true,true));
		$this->setTemplateVar('text'  ,$link->name);

		$this->setTemplateVar('id','o'.$link->objectid);

		$list = array();	
		if   ( $link->hasRight('prop') )
			$list['prop'] = lang('PROP');

		if   ( $this->userIsAdmin() )
			$list['rights'] = lang('RIGHTS');
		$this->setTemplateVar('subaction',$list);
		$this->setTemplateVar('param','objectid');

		$this->callSubAction('show');
	}



	function folder()
	{

		// Ermitteln Sprache
		$language = new Language( $this->getSessionVar('languageid') );
		$language->load();
		$this->setTemplateVar('language_name',$language->name);

		$this->setTemplateVar('nr',$this->getSessionVar('objectid'));
		if   ( !is_numeric($this->getSessionVar('objectid')) )
		{
			$SESS['objectid'] = Folder::getRootObjectId();
		}

		$folder = new Folder( $this->getSessionVar('objectid') );
		$folder->filenames = false;
		$folder->load();

		$this->setTemplateVar('folder',$folder->parentObjectNames(true,false));
		
		$this->setTemplateVar('text',$folder->name);

		$this->setTemplateVar('id','o'.$folder->objectid);
	
		$list = array();
		$list['show'] = lang('SHOW');
		
		if   ( $this->getSessionVar('objectid') != '' && !$folder->isRoot )
			if   ( $folder->hasRight('prop') )
				$list['prop'] = lang('PROP');

		if   ( $this->getSessionVar('objectid') != '' )
			if   (    $folder->hasRight('create_folder')
			       || $folder->hasRight('create_file'  )
			       || $folder->hasRight('create_link'  )
			       || $folder->hasRight('create_page'  ) )
				$list['create'] = lang('NEW');
	
		$user = $this->getSessionVar('user');
		if   ( $user['is_admin'] == '1' )
			$list['rights'] = lang('RIGHTS');

		if   ( $folder->hasRight('publish') )
			$list['pub' ] = lang('PUBLISH');
		$this->setTemplateVar('subaction',$list);
		$this->setTemplateVar('param','objectid');

		$this->callSubAction('show');
	}


	function project()
	{
		$this->setTemplateVar('folder',array() );

		$list = array();	
		$list['listing'] = lang('LISTING');

		if   ( intval($this->getSessionVar('projectid')) != 0 )
		{
			$list['edit'] = lang('EDIT');
			$project = new Project($this->getSessionVar('projectid'));
			$project->load();
			$this->setTemplateVar('text',$project->name );
		}
		else
		{
			$this->setTemplateVar('text','' );
		}

		$this->setTemplateVar('subaction',$list);
		$this->setTemplateVar('param','projectid');

		$this->callSubAction('show');
	}


	function language()
	{
		$this->setTemplateVar('id','lang');
	
		$this->setTemplateVar('subaction',array('listing'=>lang('LISTING')));
		$this->setTemplateVar('param','languageid');

		$this->callSubAction('show');
	}



	function model()
	{
		$this->setTemplateVar('id','pvar');
	
		$this->setTemplateVar('subaction',array('listing'=>lang('LISTING')));
		$this->setTemplateVar('param','modelid');

		$this->callSubAction('show');
	}


	function search()
	{
		$this->setTemplateVar('subaction',array('prop'   =>lang('SEARCH_PROP'    ),
		                                        'content'=>lang('SEARCH_CONTENT' ) ));
		$this->setTemplateVar('param','objectid');

		$this->callSubAction('show');
	}


	function transfer()
	{
		$this->setTemplateVar('subaction',array('import'=>lang('import')));
		$this->setTemplateVar('param','objectid');

		$this->callSubAction('show');
	}


	function show()
	{
		$this->setTemplateVar('action',$this->subActionName);

		if	( $this->subActionName == 'pageelement')
			$this->setTemplateVar('action','page');
		
		$this->setTemplateVar('name'          ,$this->subActionName);
		$this->setTemplateVar('css_body_class','menu'              );
		
		$this->setTemplateVar('type'          ,$this->subActionName);

		$this->forward( 'main_menu' );
	}
}

?>