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
	var $search        = false;
	var $obj;

	
	function MainmenuAction()
	{
		$this->setTemplateVar('type',$this->getRequestVar(REQ_PARAM_SUBACTION) );
		
		
		switch( $this->getRequestVar( REQ_PARAM_SUBACTION) )
		{
			case 'page':
			case 'pageelement':
			case 'file':
			case 'link':
			case 'folder':
			case 'language':
			case 'model':
			case 'template':
			case 'element':
				$this->addSubAction( 'show'  ,-1 );
				$this->addSubAction( 'create',-1 );
				$this->addSubAction( 'edit'  ,-1 );
				$this->addSubAction( 'el'    ,-1 );
				$this->addSubAction( 'pub'   ,-1 );
				$this->addSubAction( 'prop'  ,-1 );
				$this->addSubAction( 'src'   ,-1 );
				$this->addSubAction( 'rights',-1 );
				$this->search = true;
				break;

			case 'project':
			case 'user':
			case 'group':
				$this->addSubAction( 'listing'    ,-1 );
				$this->addSubAction( 'add'        ,-1 );
				$this->addSubAction( 'edit'       ,-1 );
				$this->addSubAction( 'memberships',-1 );
				$this->addSubAction( 'pw'         ,-1 );
				$this->addSubAction( 'rights'     ,-1 );
				$this->addSubAction( 'phpinfo'    ,-1 );
				break;

			case 'blank':
			default:
				$this->setTemplateVar('windowMenu',array() );
				$this->setTemplateVar('text'      ,''      );
		}
	}
	
	
	function addSubAction( $name,$aclbit=0 )
	{
		// Wenn $aclbit nicht vorhanden oder die entsprechende Berechtigung vorhanden ist,
		// dann Men�punkt erg�nzen.
		if   ( $aclbit==-1 )
			$url = '';
		elseif   ( $aclbit==0 || $this->obj->hasRight($aclbit) )
			$url = Html::url($this->subActionName,$name,$this->getRequestId() );
		else
			$url = '';
		$this->subActionList[ $name ] = array( 'text' =>'MENU_'.strtoupper($name),
		                                       'title'=>'MENU_'.strtoupper($name).'_DESC',
		                                       'key'  =>strtoupper(lang('ACCESSKEY_MAIN_'.strtoupper($name))),
		                                       'url'  =>$url );
	}
	
	
	function element()
	{
		$this->subActionName = 'element';
		$this->setTemplateVar('type','element' );

		$element = new Element( $this->getRequestId() );
		$element->load();

		//global $REQ;
		//$REQ['id'] = $element->templateid;
		
		$template = new Template( $element->templateid );
		$template->load();

		$this->addPath( lang('templates'),lang('templates'),Html::url('main','template',0,array(REQ_PARAM_TARGETSUBACTION=>'listing')),'');
		$this->addPath( $template->name,lang('TEMPLATE'),Html::url('main','template',$template->templateid),'');
		$this->setTemplateVar('text',$element->name );
		
		//$this->addSubaction('listing');
		//$this->addSubaction('show' );
		//$this->addSubaction('edit' );
		//$this->addSubaction('el'   );
		//if	( $this->writable )
		//	$this->addSubaction('src'  );
		//$this->addSubaction('prop' );

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
		//$this->addSubaction('listing');
	
		if   ( $this->getRequestId() != 0 )
		{
			$template = new Template( $this->getRequestId() );
			$template->load();
			$this->setTemplateVar('text',$template->name );
			$this->addPath( lang('templates'),lang('templates'),Html::url('main','template',0,array(REQ_PARAM_TARGETSUBACTION=>'listing')),'');
			
			$this->addSubaction('show' );
//			$this->addSubaction('edit' );
			$this->addSubaction('src'  );
			$this->addSubaction('el'   );
			$this->addSubaction('prop' );
		}
		else
		{
			$this->setTemplateVar('text',lang('templates') );
		}

		$this->setTemplateVar('param' ,'templateid');
		$this->setTemplateVar('windowMenu',$this->subActionList);
	}



	function pageelement()
	{
		//$this->subActionName = 'page';
		//$this->callSubAction('page');
		
		
		$page = Session::getObject();
		if	( $page->objectid != $this->getRequestId() )
		{
			$page = new Page( $this->getRequestId() );
			Session::setObject( $page );
			$page->load();
		}
		
		$folder = new Folder( $page->parentid );
		$folder->filenames = false;
		$folder->load();

		foreach( $folder->parentObjectNames(true,true) as $id=>$name )
			$this->addPath($name,$name,Html::url('main','folder',$id),'folder');

		$this->addPath($page->name,$page->name,Html::url('main','page',$page->id),'page');
		
		// Ermitteln Namen des Elementes
		$element = new Element( $this->getRequestVar('elementid'));
		$element->load();
		$this->setTemplateVar('text',$element->name);
	
//		$this->obj = &$page;
//		$this->addSubAction('show'  ,ACL_READ    );
//		$this->addSubAction('edit'  ,ACL_WRITE   );
//		$this->addSubAction('el'    ,ACL_WRITE   );
//		$this->addSubAction('form'  ,ACL_WRITE   );

//		$this->addSubAction('pub'   ,ACL_PUBLISH );
//		$this->addSubAction('prop'  ,ACL_PROP    );
//		$this->addSubAction('src'   ,ACL_PROP    );
//		$this->addSubAction('rights',ACL_GRANT   );

		$this->setTemplateVar('windowMenu',$this->subActionList);
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

//		$others = $folder->getObjects();
//		$o2 = array();
//		foreach( $others as $o )
//			if	( $o->isPage )
//				$o2[$o->objectid] = Text::maxLength($o->name,25);
//			
//		$this->setTemplateVar('otherObjects',$o2);
	
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
		global $conf;
		
		$this->addSubaction('add'    );
		
		// Liste immer anzeigen, da es ja mind. 1 Benutzer gibt.
		$this->addSubaction('listing');

		if	( $this->getRequestId() != 0 )
		{
			$this->addPath( lang('USER'),lang('USER'),Html::url('main','user',0,array(REQ_PARAM_TARGETSUBACTION=>'listing')),'user');
			$user = new User( $this->getRequestId() );
			$user->load();
				
			$this->setTemplateVar('text',$user->name);
		
			$this->addSubaction('edit'   );
			$this->addSubaction('memberships' );
			
			// Kennwortaenderung ist nur sinnvoll, wenn kein LDAP verwendet wird
			if	( @$conf['security']['auth']['type'] == 'database' && 
				     ( empty($user->ldap_dn) ||
				       !@$conf['security']['auth']['userdn'])  )
			$this->addSubaction('pw'     );

			$this->addSubaction('rights' );
		}
		else
		{
			$this->setTemplateVar('text',lang('USERS'));			
		}
		
		$this->setTemplateVar('windowMenu',$this->subActionList);
		$this->setTemplateVar('param'    ,'userid'            );
	}



	function group()
	{

		$this->addSubaction('listing'    );
		$this->addSubaction('add'        );

		if	( $this->getRequestId() != 0 )
		{
			$group = new Group( $this->getRequestId() );
			$group->load();
			$this->setTemplateVar('text',$group->name);
			
			$this->addPath( lang('GROUPS'),lang('GROUPS'),Html::url('main','group',0,array(REQ_PARAM_TARGETSUBACTION=>'listing')),'group');
			$this->addSubaction('memberships');
			$this->addSubaction('edit'   );
			$this->addSubaction('rights' );
		}
		else
		{
			$this->setTemplateVar('text',lang('GROUPS'));			
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

		//$this->addSubaction('listing');
		$this->addSubaction('add'    );
		$this->addSubaction('phpinfo');
		
		if   ( $this->getRequestId() > 0 )
		{
			$this->addSubaction('edit');

			$project = new Project( $this->getRequestId() );
			$project->load();
			$this->setTemplateVar('text',$project->name );
			$this->addPath( lang('PROJECTS'),lang('PROJECTS'),Html::url('main','project',0,array(REQ_PARAM_TARGETSUBACTION=>'listing')),'user');
		}
		else
		{
			$this->setTemplateVar('text',lang('GLOBAL_PROJECTS') );
		}
		
		if	( count( Project::getAllProjectIds() ) > 0 )
			$this->addSubAction('listing');
		
		$this->setTemplateVar('windowMenu',$this->subActionList);
		$this->setTemplateVar('param','projectid');
	}


	function language()
	{
		//$this->addSubaction('listing');

		if	( $this->userIsAdmin() && $this->getRequestId()>0 )
		{
			$language = new Language($this->getRequestId());
			$language->load();
			$this->addPath( lang('LANGUAGES'),lang('LANGUAGES'),Html::url('main','language',0,array(REQ_PARAM_TARGETSUBACTION=>'listing')),'');
			$this->addSubaction('edit');
			$this->setTemplateVar('text',$language->name);
		}
		else
		{
			$this->setTemplateVar('text',lang('LANGUAGES'));
		}

		$this->setTemplateVar('windowMenu',$this->subActionList);
		$this->setTemplateVar('param',REQ_PARAM_LANGUAGE_ID);
	}



	function model()
	{
		//$this->addSubaction('listing');

		if	( $this->userIsAdmin() && $this->getRequestId()>0 )
		{
			$model = new Model( $this->getRequestId() );
			$model->load();
			$this->addPath( lang('MODELS'),lang('MODELS'),Html::url('main','model',0,array(REQ_PARAM_TARGETSUBACTION=>'listing')),'');
			$this->addSubaction('edit');
			$this->setTemplateVar('text',$model->name);
		}
		else
		{
			$this->setTemplateVar('text',lang('MODELS'));
		}
			
		$this->setTemplateVar('param','modelid');
		$this->setTemplateVar('windowMenu',$this->subActionList);
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

		if	( $this->subActionName == 'pageelement')
			$this->setTemplateVar('action','page');
		else
			$this->setTemplateVar('action',$this->subActionName  );
		
		$this->setTemplateVar('name'          ,$this->subActionName);
		$this->setTemplateVar('css_body_class','menu'              );
		
		$this->setTemplateVar('path'          ,$this->path         );
	}
	
	
	
	function blank()
	{
	}
}

?>