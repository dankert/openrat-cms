<?php
// ---------------------------------------------------------------------------
// $Id$
// ---------------------------------------------------------------------------
// OpenRat Content Management System
// Copyright (C) 2002-2004 Jan Dankert, cms@jandankert.de
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
// Revision 1.2  2004-04-24 16:57:13  dankert
// Korrektur: pub()
//
// Revision 1.1  2004/04/24 15:14:52  dankert
// Initiale Version
//
// ---------------------------------------------------------------------------


class FolderAction extends Action
{
	var $defaultSubAction = 'show';
	var $folder;


	function FolderAction()
	{
		$this->folder = new Folder( $this->getSessionVar('objectid') );
		$this->folder->load();

		if	( ! $this->folder->isFolder )
			$this->message('','object id '.$this->folder->objectid.' is not a folder' );
	}


	function createnew()
	{
		// Neues Objekt in diesem Ordner anlegen
		switch( $this->getRequestVar('type') )
		{
			case 'folder':

				if   ( $this->getRequestVar('foldername') != '' )
				{
					$f = new Folder();
					$f->name     = $this->getRequestVar('foldername');
					$f->filename = $this->getRequestVar('foldername');
					$f->parentid = $this->folder->objectid; 

					$f->add();
				}

				break;
			
			case 'page':

				if   ( $this->getRequestVar('pagename') != '' )
				{
					$page = new Page();
					$page->name       = $this->getRequestVar('pagename'  );
					$page->filename   = $this->getRequestVar('pagename'  );
					$page->templateid = $this->getRequestVar('templateid');
					$page->parentid   = $this->folder->objectid;

					$page->add();
				}

				break;
			
			case 'file':

				$file   = new File();
				$upload = new Upload();
		
				$file->filename  = $upload->filename;
				$file->name      = $upload->filename;
				$file->extension = $upload->extension;		
				$file->size      = $upload->size;
				$file->parentid  = $this->folder->objectid;
		
				$file->value     = $upload->value;
		
				$file->add(); // Datei hinzufuegen
				break;
			
			case 'link':

				if   ( $this->getRequestVar('linkname') != '' )
				{
					$link = new Link();
					$link->name     = $this->getRequestVar('linkname');
					$link->parentid = $this->folder->objectid; 
					$link->isLinkToObject = false;
					$link->url = '/';
					$link->add();
				}
				break;
			
			default: die();
		}

		$this->setTemplateVar('tree_refresh',true);
		$this->callSubAction('show');
	}	


	function save()
	{
		// Wenn Dateiname gefüllt, dann Datenbank-Update
		if   ( $this->getRequestVar('filename') != '' )
		{
			if   ( $this->getRequestVar('name') != '' )
				$this->folder->name     = $this->getRequestVar('name'    );
			else	$this->folder->name     = $this->getRequestVar('filename');

			$this->folder->filename = $this->getRequestVar('filename');
			$this->folder->desc     = $this->getRequestVar('desc');
			$this->folder->save();
		}
	
		$this->setTemplateVar('tree_refresh',true);
		$this->callSubAction('show');
	}


	// Reihenfolge von Objekten aendern
	function changesequence()
	{
		$ids = $this->folder->getObjectIds();
		$seq = 0;
		foreach( $ids as $id )
		{
			$seq++; // Sequenz um 1 erhoehen
			
			// Die beiden Ordner vertauschen
			if   ( $id == $this->getRequestVar('objectid1') )
				$id = $this->getRequestVar('objectid2');
			elseif ( $id == $this->getRequestVar('objectid2') )
				$id = $this->getRequestVar('objectid1');
				
			$o = new Object( $id );
			$o->setOrderId( $seq );
	
			unset( $o ); // Selfmade Garbage Collection :-)
		}
		
		// Ordner anzeigen
		$this->callSubAction('show');
		
	}


	function move()
	{
		$this->objectMove();

		$this->callSubAction('show');
	}


	function addACL()
	{
		$this->objectAddACL();

		$this->callSubAction('rights');
	}


	function delACL()
	{
		$this->objectDelACL();

		$this->callSubAction('rights');
	}


	function create()
	{

		if   ( $this->folder->hasRight('create_page') )
			$this->setTemplateVar('templates',Template::getAll());

		$this->setTemplateVar('create_folder',$this->folder->hasRight('create_folder'));
		$this->setTemplateVar('create_file'  ,$this->folder->hasRight('create_file')  );
		$this->setTemplateVar('create_link'  ,$this->folder->hasRight('create_link')  );
		$this->setTemplateVar('create_page'  ,$this->folder->hasRight('create_page')  );
		
		$this->forward('folder_new');
		
	}



	function show()
	{
		global $conf_php;

		if   ( ! $this->folder->isRoot )
			$this->setTemplateVar('up_url',"main.$conf_php?action=folder&objectid=".$this->folder->parentid);
		
		$list = array();
		$last_objectid = 0;

		// Schleife ueber alle Objekte in diesem Ordner
		foreach( $this->folder->getObjectIds() as $id )
		{
			$o = new Object( $id );
			
			if   ( $o->hasRight('read') )
			{
				$o->objectLoad();
				$list[$id]['name']     = Text::maxLaenge( 30,$o->name     );
				$list[$id]['filename'] = Text::maxLaenge( 20,$o->filename );
				$list[$id]['desc']     = Text::maxLaenge( 30,$o->desc     );

				$list[$id]['type'] = $o->getType();
				
				$list[$id]['icon'] = $o->getType();

				if	( $o->getType() == 'file' )
				{
					$file = new File( $id );
					$file->load();
					if	( substr($file->mimeType(),0,6) == 'image/' )
						$list[$id]['icon'] = 'image';
//					if	( substr($file->mimeType(),0,5) == 'text/' )
//						$list[$id]['icon'] = 'text';
				}

				$list[$id]['url' ] = Html::url(array('action'    =>'main',
				                                     'callAction'=>$o->getType(),
				                                     'objectid'  =>$id));
				$list[$id]['propurl' ] = Html::url(array('action'=>$o->getType(),
				                                         'subaction'=>'prop',
				                                         'objectid'=>$id));
				$list[$id]['date'] = date( lang('DATE_FORMAT'),$o->lastchange_date );
				$list[$id]['user'] = User::getUserName( $o->lastchange_userid );

				if   ( $last_objectid != 0 )
				{
					$list[$id           ]['upurl'  ] = Html::url(array('action'=>'folder',
					                                                   'subaction'=>'changesequence',
					                                                   'objectid1'=>$id,
					                                                   'objectid2'=>$last_objectid));
					$list[$last_objectid]['downurl'] = $list[$id]['upurl'];
				}

				$last_objectid = $id;
			}
		}
		$this->setTemplateVar('object',$list);

		$this->forward('folder_show');
		
	}


	function prop()
	{
		$this->setTemplateVars( $this->folder->getProperties() );
	
		// Alle Ordner ermitteln
		$this->setTemplateVar('act_objectid',$this->folder->objectid);
		
		$list = array();
		$allsubfolders = $this->folder->getAllSubFolderIds();
		
		foreach( $this->folder->getOtherFolders() as $id )
		{
			$f = new Folder( $id );
			if   ( ! in_array($id,$allsubfolders) )
				$list[$id] = implode( ' &raquo; ',$f->parentObjectNames(true,true) );
		}
		asort( $list );
		$this->setTemplateVar('folder',$list);
	
		$this->forward('folder_prop');
	}


	function rights()
	{
		global $SESS;
		global $conf_php;
		if   ($SESS['user']['is_admin'] != '1') die('nice try');

		$acllist = array();	
		foreach( $this->folder->getAllInheritedAclIds() as $aclid )
		{
			$acl = new Acl( $aclid );
			$acl->load();
			$key = 'au'.$acl->username.'g'.$acl->groupname.'a'.$aclid;
			$acllist[$key] = $acl->getProperties();
		}

//		$this->setTemplateVar('inherited_acls',$acllist );
//		$acllist = array();	

		foreach( $this->folder->getAllAclIds() as $aclid )
		{
			$acl = new Acl( $aclid );
			$acl->load();
			$key = 'bu'.$acl->username.'g'.$acl->groupname.'a'.$aclid;
			$acllist[$key] = $acl->getProperties();
			$acllist[$key]['delete_url'] = Html::url(array('subaction'=>'delACL','aclid'=>$aclid));
		}
		ksort( $acllist );

		$this->setTemplateVar('acls',$acllist );

		$this->setTemplateVar('users'    ,User::listAll()   );
		$this->setTemplateVar('groups'   ,Group::getAll()   );

		$languages = Language::getAll();
		$languages[0] = lang('ALL_LANGUAGES');
		$this->setTemplateVar('languages',$languages);

		$this->forward('folder_rights');
	}


	function pub()
	{
		if	( $this->getRequestVar('go') == '1' )
		{
			if	( $this->getRequestVar('subdirs') == '1' )
				$subdirs = true;
			else	$subdirs = false;

			$publish = new Publish();
			
			$this->folder->publish = &$publish;
			$this->folder->publish( $subdirs );

			$list = array();

			foreach( $publish->publishedObjects as $o )
			{
				$list[] = $o['filename'];
			}
			$this->setTemplateVar('filenames',$list);

			$this->forward('publish');
		}
		else
		{
			$this->forward('folder_pub');
		}
	}
}