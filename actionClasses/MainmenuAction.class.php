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
// Revision 1.14  2004-12-19 18:09:05  dankert
// Korrektur Gruppen-Men?
//
// Revision 1.13  2004/12/19 18:06:41  dankert
// Korrektur Benutzer-Men?
//
// Revision 1.12  2004/12/15 23:24:38  dankert
// diverse Aenderungen
//
// Revision 1.11  2004/12/13 22:11:55  dankert
// Anpassung model() und language()
//
// Revision 1.10  2004/12/13 21:44:09  dankert
// Anpassung template()
//
// Revision 1.9  2004/11/28 22:33:14  dankert
// Benutzer/Gruppen Menue
//
// Revision 1.8  2004/11/28 19:46:45  dankert
// Bei Dateien immer Menuepunkt "Bearbeiten"
//
// Revision 1.7  2004/11/28 18:39:18  dankert
// Anpassen an neue Sprachdatei-Konventionen
//
// Revision 1.6  2004/11/28 16:54:56  dankert
// Abfrage der Berechtigungen bei Menueaufbau
//
// Revision 1.5  2004/11/27 13:07:34  dankert
// Korrektur in page()
//
// Revision 1.4  2004/11/10 22:37:46  dankert
// Verlinken von Sprach/Modell-Angabe
//
// Revision 1.3  2004/10/13 21:20:11  dankert
// Neue Seitenfunktion zum gleichzeitigen Bearbeiten aller Seiteninhalte
//
// Revision 1.2  2004/05/02 14:49:37  dankert
// Einf?gen package-name (@package)
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

	var $subActionList = array();
	var $obj;
	

	function element()
	{
		$this->subActionName = 'template';
		$this->callSubAction('template');
	}


	function addSubAction( $name,$aclbit=0 )
	{
		if   ( $aclbit==0 || $this->obj->hasRight($aclbit) )
			$this->subActionList[ $name ] = lang( 'MENU_'.strtoupper($name) );
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
			$this->addSubaction('el'   );
			$this->addSubaction('src'  );
			$this->addSubaction('prop' );
		}

		$this->setTemplateVar('param' ,'templateid');
		$this->setTemplateVar('subaction',$this->subActionList);

		$this->callSubAction('show');
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
		
		$this->setTemplateVar('nr'      ,$page->objectid);
		$this->setTemplateVar('actionid',$page->objectid);
	
		$folder = new Folder( $page->parentid );
		$folder->filenames = false;
		$folder->load();

		$this->setTemplateVar('folder',$folder->parentObjectNames(true,true));
	
		// Ermitteln Namen der Seite
		$this->setTemplateVar('text',$page->name);
	
		$this->obj = &$page;
		$this->addSubAction('show'  ,ACL_READ    );
		$this->addSubAction('edit'  ,ACL_WRITE   );
		$this->addSubAction('el'    ,ACL_WRITE   );
		$this->addSubAction('form'  ,ACL_WRITE   );

		$this->addSubAction('pub'   ,ACL_PUBLISH );
		$this->addSubAction('prop'  ,ACL_PROP    );
		$this->addSubAction('src'   ,ACL_PROP    );
		$this->addSubAction('rights',ACL_GRANT   );

		$this->setTemplateVar('subaction',$this->subActionList);

		$this->callSubAction('show');
	}



	function user()
	{
		$this->setTemplateVar('folder',array() );
		$user = new User( $this->getRequestId() );
		$user->load();
			
		$this->setTemplateVar('text',$user->name);
	
		$this->addSubaction('listing');

		if	( $this->getRequestId() != 0 )
		{
			$this->addSubaction('edit'   );
			$this->addSubaction('groups' );
			$this->addSubaction('pw'     );
			$this->addSubaction('rights' );
		}
		
		$this->setTemplateVar('subaction',$this->subActionList);
		$this->setTemplateVar('param'    ,'userid'            );

		$this->callSubAction('show');
	}



	function group()
	{
		$this->setTemplateVar('folder',array() );

		$group = new Group( $this->getRequestId() );
		$group->load();
		$this->setTemplateVar('text',$group->name);

		$this->addSubaction('listing');

		if	( $this->getRequestId() != 0 )
		{
			$this->addSubaction('edit'   );
			$this->addSubaction('users'  );
		}
		$this->setTemplateVar('subaction',$this->subActionList);

		$this->setTemplateVar('param'    ,'groupid'           );
		$this->callSubAction('show');
	}


	function file()
	{
		$file = new File( $this->getRequestId() );
		$file->load();
		
		$folder = new Folder( $file->parentid );
		$folder->filenames = false;
		$folder->load();

		$this->setTemplateVar('nr',$this->getSessionVar('objectid'));

		$this->setTemplateVar('folder',$folder->parentObjectNames(true,true));
		$this->setTemplateVar('text'  ,$file->name);

		$this->setTemplateVar('id','o'.$file->objectid);
	
		$this->obj = &$file;
		$this->addSubAction('show'  ,ACL_READ    );

		$this->addSubAction('edit'  ,ACL_WRITE   );

		$this->addSubAction('pub'   ,ACL_PUBLISH );
		$this->addSubAction('prop'  ,ACL_PROP    );
		$this->addSubAction('rights',ACL_GRANT   );

		$this->setTemplateVar('subaction',$this->subActionList);

		$this->setTemplateVar('param','objectid');

		$this->callSubAction('show');
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

		$this->setTemplateVar('folder',$folder->parentObjectNames(true,true));
		$this->setTemplateVar('text'  ,$link->name);

		$this->setTemplateVar('id','o'.$link->objectid);

		$this->obj = &$link;
		$this->addSubAction('prop'  ,ACL_PROP );
		$this->addSubAction('rights',ACL_GRANT);

		$this->setTemplateVar('subaction',$this->subActionList);
		$this->setTemplateVar('param','objectid');

		$this->callSubAction('show');
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

		$folder->load();

		$this->setTemplateVar('folder',$folder->parentObjectNames(true,false));
		
		$this->setTemplateVar('text',$folder->name);
	
		$this->addSubAction('show',ACL_READ    );

		if   ( !$folder->isRoot )
			$this->addSubAction('prop',ACL_PROP    );

		$this->addSubAction('create',ACL_CREATE_FOLDER );
		$this->addSubAction('create',ACL_CREATE_FILE   );
		$this->addSubAction('create',ACL_CREATE_PAGE   );
		$this->addSubAction('create',ACL_CREATE_LINK   );

		$this->addSubAction('pub'   ,ACL_PUBLISH );
		$this->addSubAction('rights',ACL_GRANT);

		$this->setTemplateVar('subaction',$this->subActionList);
		$this->setTemplateVar('param','objectid');

		$this->callSubAction('show');
	}


	function project()
	{
		$this->setTemplateVar('folder',array() );

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
			$this->setTemplateVar('text','' );
		}

		$this->setTemplateVar('subaction',$this->subActionList);
		$this->setTemplateVar('param','projectid');

		$this->callSubAction('show');
	}


	function language()
	{
		$this->addSubaction('listing');

		$this->setTemplateVar('subaction',$this->subActionList);
		$this->setTemplateVar('param','languageid');

		$this->callSubAction('show');
	}



	function model()
	{
		$this->addSubaction('listing');
		$this->setTemplateVar('subaction',$this->subActionList);
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
		$this->setTemplateVar('actionid',$this->getRequestId() );
		$this->setTemplateVar('action'  ,$this->subActionName  );

		if	( $this->subActionName == 'pageelement')
			$this->setTemplateVar('action','page');
		
		$this->setTemplateVar('name'          ,$this->subActionName);
		$this->setTemplateVar('css_body_class','menu'              );
		
		$this->setTemplateVar('type'          ,$this->subActionName);

		$this->forward( 'main_menu' );
	}
}

?>