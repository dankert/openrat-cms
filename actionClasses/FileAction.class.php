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
// Revision 1.2  2004-04-24 16:55:27  dankert
// Korrektur: pub()
//
// Revision 1.1  2004/04/24 15:14:52  dankert
// Initiale Version
//
// ---------------------------------------------------------------------------


class FileAction extends Action
{
	var $file;
	var $defaultSubAction = 'show';

	/**
	 * Konstruktor
	 */
	function FileAction()
	{
		$this->file = new File( $this->getSessionVar('objectid') );
		$this->file->load();
	}


	function move()
	{
		$this->objectMove();

		$this->callSubAction('show');
	}


	function addAccessACL()
	{
		$this->objectAddAccessACL();

		$this->callSubAction('rights');
	}


	function delACL()
	{
		$this->objectDelACL();

		$this->callSubAction('rights');
	}


	function replace()
	{
		$upload = new Upload();

		$this->file->filename  = $upload->filename;
		$this->file->extension = $upload->extension;		
		$this->file->size      = $upload->size;
		$this->file->save();
		
		$this->file->value = $upload->value;
		$this->file->saveValue();

		//$setTemplateVar('tree_refresh',true);

		$this->callSubAction('show');
	}


	function savevalue()
	{
		$this->file->value = $this->getRequestVar('value');
		$this->file->saveValue();
	
		$this->callSubAction('show');
	}


	function save()
	{
		global $SESS;

		// Wenn Dateiname gefüllt, dann Datenbank-Update
		if   ( $this->getRequestVar('delete') != '' )
		{
			// Datei löschen
			$this->file->delete();

			unset( $SESS['objectid'] );
		}
		else
		{
			// Eigenschaften speichern
			$this->file->filename  = $this->getRequestVar('filename' );
			$this->file->name      = $this->getRequestVar('name'     );
			$this->file->extension = $this->getRequestVar('extension');
			$this->file->desc      = $this->getRequestVar('desc'     );
			
			$this->file->save();
		}

		$this->setTemplateVar('tree_refresh',true);
		$this->callSubAction('show');
	}


	/**
	 * Anzeigen des Inhaltes, der Inhalt wird samt Header direkt
	 * auf die Standardausgabe geschrieben
	 */
	function show()
	{
		// Angabe Content-Type
		header('Content-Type: '.$this->file->mimeType() );

		// Angabe Content-Disposition mit Dateinamen
		header('Content-Disposition: filename='.$this->file->filenameWithExtension().';' );

		echo $this->file->loadValue();
		exit;
	}	


	function resize()
	{
		$width  = $this->getRequestVar('width' );
		$height = $this->getRequestVar('height');
		
		if	( $width != '' || $height != '' )

		$this->file->imageResize( intval($width),intval($height) );
		$this->file->save();
		$this->file->saveValue();

		$this->callSubAction('show');
	}


	function prop()
	{
		// MIME-Types aus Datei lesen
		$this->setTemplateVars( $this->file->getProperties() );

		$this->setTemplateVar('full_filename',$this->file->full_filename());

		if   ( substr($this->file->mimetype(),0,5) == 'text/' )
			$var['src_url'] = Html::url(array('fileaction'=>'src'));
	
		if	( is_numeric($this->file->lastchange_userid) )
		{
			$user = new User( $this->file->lastchange_userid );
			$user->load();
			$this->setTemplateVar('lastchange_user',array('name'=>$user->name,
			                                              'url' =>Html::url(array('action'=>'user',
			                                                                      'userid'=>$user->userid))));
		}
		else
		{
			$this->setTemplateVar('lastchange_user',array('name'=>lang('UNKNOWN')));
		}
	
		if	( is_numeric($this->file->create_userid) )
		{
			$user = new User( $this->file->create_userid );
			$user->load();
			$this->setTemplateVar('create_user',array('name'=>$user->name,
			                                          'url' =>Html::url(array('action'=>'user',
			                                                                  'userid'=>$user->userid))));
		}
		else
		{
			$this->setTemplateVar('create_user',array('name'=>lang('UNKNOWN')));
		}
		
		// Alle Ordner ermitteln
		$this->setTemplateVar('act_folderobjectid',$this->file->parentid);
		$list = array();
		
		$f = new Folder( $this->file->parentid );

		foreach( $f->getOtherFolders() as $oid )
		{
			$folder = new Folder( $oid );
			$folder->load();
			$list[$oid] = implode(' &raquo; ',$folder->parentObjectNames(true,true) );
		}
		asort( $list );
		$this->setTemplateVar('folderobject',$list);
	
	
	
		// Alle Seiten mit dieser Datei ermitteln
		$pages = $this->file->getDependentObjectIds();
			
		$list = array();
		foreach( $pages as $id )
		{
			$o = new Object( $id );
			$o->load();
			$list[$id] = array();
			$list[$id]['url' ] = 'main.'.$conf_php.'?action=page&objectid='.$id;
			$list[$id]['name'] = $o->name;
		}
		asort( $list );
		$this->setTemplateVar('pages',$list);
	
		$this->forward( 'file_prop' );
	}
		

	/**
	 * Anzeigen des Inhaltes
	 */
	function src()
	{
		$this->setTemplateVar('value',$this->file->loadValue());
		
		$this->forward('file_src');
	}


	/**
	 * Datei veröffentlichen
	 */
	function pub()
	{
		$this->file->publish();

		$list = array();
		foreach( $this->file->publish->publishedObjects as $o )
		{
			$list[] = $o['filename'];
		}

		$this->setTemplateVar('filenames',$list);

		$this->forward('publish');
	}


	function rights()
	{
		$acl = new Acl();
		$acl->objectid = $this->file->objectid;

		$var['access_acls']  = array();

		foreach( $acl->getAccessACLsFromObject() as $id )
		{
			$acl = new Acl( $id );
			$acl->load();
			$var['access_acls'][$id] = $acl->getProperties();
			$var['access_acls'][$id]['delete_url'] = 'folder.'.$conf_php.'?folderaction=delACL&aclid='.$id;
		}

		$var['users']     = User::listAll();
		$var['groups']    = Group::getAll();
		$var['languages'] = Language::getAll();

		$this->forward('file_rights');
	}
}

?>