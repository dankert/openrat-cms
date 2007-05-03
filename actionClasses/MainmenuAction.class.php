<?php
// $Id$
//
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


/**
 * Action-Klasse fuer die Darstellung des Untermenues.
 * 
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */
class MainmenuAction extends Action
{
	var $defaultSubAction = 'login';

	var $subActionList = array();
	var $path          = array();
	var $obj;

	
	function MainmenuAction()
	{
		$this->Action(); // Elternklasse-Konstruktor
		
		$this->setTemplateVar('type',$this->getRequestVar( 'subaction') );
		
		
		switch( $this->getRequestVar( 'subaction') )
		{
			case 'page':
			case 'pageelement':
			case 'file':
			case 'link':
			case 'folder':
				$this->addSubAction( 'show'  ,-1 );
				$this->addSubAction( 'create',-1 );
				$this->addSubAction( 'edit'  ,-1 );
				$this->addSubAction( 'el'    ,-1 );
				$this->addSubAction( 'pub'   ,-1 );
				$this->addSubAction( 'prop'  ,-1 );
				$this->addSubAction( 'src'   ,-1 );
				$this->addSubAction( 'rights',-1 );
				break;

			case 'language':
			case 'model':
			case 'project':
				$this->addSubAction( 'listing',-1 );
				$this->addSubAction( 'edit'   ,-1 );
				break;

			case 'user':
			case 'group':
				$this->addSubAction( 'listing',-1 );
				$this->addSubAction( 'edit'   ,-1 );
				$this->addSubAction( 'groups' ,-1 );
				$this->addSubAction( 'pw'     ,-1 );
				$this->addSubAction( 'rights' ,-1 );
				break;

			case 'template':
				$this->addSubAction( 'listing',-1 );
				$this->addSubAction( 'show'   ,-1 );
				$this->addSubAction( 'edit'   ,-1 );
				$this->addSubAction( 'el'     ,-1 );
				$this->addSubAction( 'src'    ,-1 );
				$this->addSubAction( 'prop'   ,-1 );
				break;

			default:
		}
	}
	
	
	function addSubAction( $name,$aclbit=0 )
	{
		// Wenn $aclbit nicht vorhanden oder die entsprechende Berechtigung vorhanden ist,
		// dann Menüpunkt ergänzen.
		if   ( $aclbit==-1 )
			$url = '';
		elseif   ( $aclbit==0 || $this->obj->hasRight($aclbit) )
			$url = Html::url($this->subActionName,$name,$this->getRequestId() );
		else
			$url = '';
		$this->subActionList[ $name ] = array( 'text' =>lang('MENU_'.strtoupper($name) ),
		                                       'title'=>lang('MENU_'.strtoupper($name).'_DESC' ),
		                                       'key'  =>strtoupper(lang('ACCESSKEY_MAIN_'.strtoupper($name))),
		                                       'url'  =>$url );
	}
	
	
	function element()
	{
		$this->subActionName = 'template';
		$this->setTemplateVar('type','template' );

		$element = new Element( $this->getRequestId() );
		$element->load();

		global $REQ;
		$REQ['id'] = $element->templateid;
		
		$template = new Template( $element->templateid );
		$template->load();

		$this->setTemplateVar('text',$template->name );
		
		$this->addSubaction('listing');
		$this->addSubaction('show' );
		$this->addSubaction('edit' );
		$this->addSubaction('el'   );
		if	( $this->writable )
			$this->addSubaction('src'  );
		$this->addSubaction('prop' );

		$this->setTemplateVar('windowMenu',$this->subActionList);
	}


	function addPath( $name,$title,$url,$type )
	{
		$this->path[$name] = array('name' =>$name ,
		                           'title'=>$title,
		                           'url'  =>$url  ,
		                           'type' =>$type  ); 
	}


	function template()
	{
		$this->setTemplateVar('folder',array() );
		$this->addSubaction('listing');
	
		if   ( $this->getRequestId() != 0 )
		{
			$template = new Template( $this->getRequestId() );
			$template->load();
			$this->setTemplateVar('text',$template->name );
			
			$this->addSubaction('show' );
			$this->addSubaction('edit' );
			$this->addSubaction('el'   );
			$this->addSubaction('prop' );
		}
		else
		{
			$this->setTemplateVar('text',lang('global_templates') );
		}

		$this->setTemplateVar('param' ,'templateid');
		$this->setTemplateVar('windowMenu',$this->subActionList);
	}



	function pageelement()
	{
		$this->subActionName = 'page';
		$this->callSubAction('page');
	}



	function page()
	{
		$page = Session::getObject();
		if	( $page->objectid != $this->getRequestId() )
		{
			$page = new Page( $this->getRequestId() );
			Session::setObject( $page );
		}
		$page->load();
		$this->lastModified( $page->lastchangeDate );
		
		$this->setTemplateVar('nr'      ,$page->objectid);
		$this->setTemplateVar('actionid',$page->objectid);
	
		$folder = new Folder( $page->parentid );
		$folder->filenames = false;
		$folder->load();

		foreach( $folder->parentObjectNames(true,true) as $id=>$name )
			$this->addPath($name,$name,Html::url('main','folder',$id),'folder');

		$others = $folder->getObjects();
		$o2 = array();
		foreach( $others as $o )
			if	( $o->isPage )
				$o2[$o->objectid] = Text::maxLength($o->name,25);
			
		$this->setTemplateVar('otherObjects',$o2);
	
		// Ermitteln Namen der Seite
		$this->setTemplateVar('text',$page->name);
	
		$this->obj = &$page;
		$this->addSubAction('show'  ,ACL_READ    );
		$this->addSubAction('edit'  ,ACL_WRITE   );
		$this->addSubAction('el'    ,ACL_WRITE   );
//		$this->addSubAction('form'  ,ACL_WRITE   );

		$this->addSubAction('pub'   ,ACL_PUBLISH );
		$this->addSubAction('prop'  ,ACL_PROP    );
		$this->addSubAction('src'   ,ACL_PROP    );
		$this->addSubAction('rights',ACL_GRANT   );

		$this->setTemplateVar('windowMenu',$this->subActionList);
	}



	function user()
	{
		$this->setTemplateVar('path',array() );
		$user = new User( $this->getRequestId() );
		$user->load();
			
		$this->setTemplateVar('text',$user->name);
	
		$this->addSubaction('listing');

		if	( $this->getRequestId() != 0 )
		{
			$this->addSubaction('edit'   );
			$this->addSubaction('groups' );
			
			// Kennwortaenderung ist nur sinnvoll, wenn kein LDAP verwendet wird
			if	( empty($user->ldap_dn) )
				$this->addSubaction('pw'     );

			$this->addSubaction('rights' );
		}
		
		$this->setTemplateVar('windowMenu',$this->subActionList);
		$this->setTemplateVar('param'    ,'userid'            );
	}



	function group()
	{
		$this->setTemplateVar('path',array() );

		$group = new Group( $this->getRequestId() );
		$group->load();
		$this->setTemplateVar('text',$group->name);

		$this->addSubaction('listing');

		if	( $this->getRequestId() != 0 )
		{
			$this->addSubaction('edit'   );
			
//			Deaktiviert, da nicht funktionsfähig $this->addSubaction('users'  );
		}
		$this->setTemplateVar('windowMenu',$this->subActionList);

		$this->setTemplateVar('param'    ,'groupid'           );
	}


	function file()
	{
		$file = new File( $this->getRequestId() );
		$file->load();
		$this->lastModified( $file->lastchangeDate );
		
		$folder = new Folder( $file->parentid );
		$folder->filenames = false;
		$folder->load();

		$this->setTemplateVar('nr',$this->getSessionVar('objectid'));

		foreach( $folder->parentObjectNames(true,true) as $id=>$name )
		{
			$this->addPath($name,$name,Html::url('main','folder',$id),'folder');
		}

		$this->setTemplateVar('text'  ,$file->name);

		$this->setTemplateVar('id','o'.$file->objectid);
	
		$this->obj = &$file;
		$this->addSubAction('show'  ,ACL_READ    );

		$this->addSubAction('edit'  ,ACL_WRITE   );

		$this->addSubAction('pub'   ,ACL_PUBLISH );
		$this->addSubAction('prop'  ,ACL_PROP    );
		$this->addSubAction('rights',ACL_GRANT   );

		$this->setTemplateVar('windowMenu',$this->subActionList);

		$this->setTemplateVar('param','objectid');
	}



	function prefs()
	{
		$this->addSubaction('show');

		$this->setTemplateVar('windowMenu',$this->subActionList);
		$this->setTemplateVar('param','conf');
	}
	
	
	
	function link()
	{
		// Ermitteln Sprache
		$link = new Link( $this->getRequestId() );
		$link->load();
		
		$folder = new Folder( $link->parentid );
		$folder->filenames = false;
		$folder->load();

		$this->setTemplateVar('nr',$this->getSessionVar('objectid'));

		foreach( $folder->parentObjectNames(true,true) as $id=>$name )
			$this->addPath($name,$name,Html::url('main','folder',$id),'folder');

		$this->setTemplateVar('text'  ,$link->name);

		$this->setTemplateVar('id','o'.$link->objectid);

		$this->obj = &$link;
		$this->addSubAction('edit'  ,ACL_WRITE);
		$this->addSubAction('prop'  ,ACL_PROP );
		$this->addSubAction('rights',ACL_GRANT);

		$this->setTemplateVar('windowMenu',$this->subActionList);
		$this->setTemplateVar('param','objectid');
	}



	function folder()
	{
		$folder = Session::getObject();
		if	( $folder->objectid != $this->getRequestId() )
		{
			$folder = new Folder( $this->getRequestId() );
			Session::setObject( $folder );
		}
		$folder = new Folder( $folder->objectid );
		$folder->load();
		$this->obj = &$folder;
		$this->setTemplateVar('nr',$folder->objectid);

		$this->lastModified( $folder->lastchangeDate );

		foreach( $folder->parentObjectNames(true,false) as $id=>$name )
			$this->addPath($name,$name,Html::url('main','folder',$id),'folder');
		
		$this->setTemplateVar('text',$folder->name);
	
		$this->addSubAction('show',ACL_READ    );

		$this->addSubAction('create',ACL_CREATE_FOLDER );
		$this->addSubAction('create',ACL_CREATE_FILE   );
		$this->addSubAction('create',ACL_CREATE_PAGE   );
		$this->addSubAction('create',ACL_CREATE_LINK   );
		$this->addSubaction('el',-1 );

		$this->addSubAction('pub'   ,ACL_PUBLISH );

		if   ( !$folder->isRoot )
			$this->addSubAction('prop',ACL_PROP    );

		$this->addSubAction('rights',ACL_GRANT);

		$this->setTemplateVar('windowMenu',$this->subActionList);
		$this->setTemplateVar('param','objectid');
	}


	function project()
	{
		$this->setTemplateVar('path',array() );

		$this->addSubaction('listing');

		if   ( $this->getRequestId() > 0 )
		{
			$this->addSubaction('edit');

			$project = new Project( $this->getRequestId() );
			$project->load();
			$this->setTemplateVar('text',$project->name );
		}
		else
		{
			$this->setTemplateVar('text',lang('GLOBAL_PROJECTS') );
		}

		$this->setTemplateVar('windowMenu',$this->subActionList);
		$this->setTemplateVar('param','projectid');
	}


	function language()
	{
		$this->addSubaction('listing');

		if	( $this->userIsAdmin() && $this->getRequestId()>0 )
			$this->addSubaction('edit');

		$this->setTemplateVar('windowMenu',$this->subActionList);
		$this->setTemplateVar('param','languageid');
		$this->setTemplateVar('text',lang('GLOBAL_LANGUAGE'));
	}



	function model()
	{
		$this->addSubaction('listing');

		if	( $this->userIsAdmin() && $this->getRequestId()>0 )
			$this->addSubaction('edit');
			
		$this->setTemplateVar('windowMenu',$this->subActionList);
		$this->setTemplateVar('param','modelid');
		$this->setTemplateVar('text',lang('GLOBAL_MODEL'));
	}


	function search()
	{
		$this->addSubaction('prop'   );
		$this->addSubaction('content');
		$this->setTemplateVar('text',lang('GLOBAL_SEARCH'));
		$this->setTemplateVar('windowMenu',$this->subActionList);
		$this->setTemplateVar('param','objectid');
	}


	function transfer()
	{
		$this->addSubaction('import');
		$this->setTemplateVar('windowMenu',$this->subActionList);
	}


	function show()
	{
		$this->setTemplateVar('windowIcons',array( array('url'   =>Html::url('index','projectmenu'),
		                                                 'target'=>'_top',
		                                                 'type'  =>'min'),
		                                           array('url'   =>Html::url('index','logout'),
		                                                 'target'=>'_top',
		                                                 'type'  =>'close')
		                                                                            ) );
		$this->setTemplateVar('actionid',$this->getRequestId() );
		$this->setTemplateVar('action'  ,$this->subActionName  );

		if	( $this->subActionName == 'pageelement')
			$this->setTemplateVar('action','page');
		
		$this->setTemplateVar('name'          ,$this->subActionName);
		$this->setTemplateVar('css_body_class','menu'              );
		
		$this->setTemplateVar('path'          ,$this->path         );
	}
}

?>