<?php
// ---------------------------------------------------------------------------
// $Id$
// ---------------------------------------------------------------------------
// DaCMS Content Management System
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
// Revision 1.1  2004-04-03 22:55:00  dankert
// Neuer Controller
//
// ---------------------------------------------------------------------------

$conf = parse_ini_file( 'config.ini.php',true );

require_once( $conf['directories']['incldir'].
              '/config.inc.'.
              $conf['global']['ext']            );

session_start();

include( "./DB.php" );

include( "$conf_incldir/acl.inc.$conf_php" );
include( "$conf_incldir/template.inc.$conf_php" );
include( "$conf_incldir/db.inc.$conf_php" );
include( "$conf_incldir/object.class.$conf_php" );
include( "$conf_incldir/upload.class.$conf_php" );
include( "$conf_incldir/language.inc.$conf_php" );
include( "$conf_incldir/theme.inc.$conf_php" );
include( "$conf_incldir/folder.inc.$conf_php" );
include( "$conf_incldir/link.class.$conf_php" );
include( "$conf_incldir/file.inc.$conf_php" );
include( "$conf_incldir/user.inc.$conf_php" );
include( "$conf_incldir/group.inc.$conf_php" );
include( "$conf_incldir/project.inc.$conf_php" );
include( "$conf_incldir/request.inc.$conf_php" );
include( "$conf_incldir/page.inc.$conf_php" );
include( "$conf_incldir/text.inc.$conf_php" );
include( "$conf_incldir/publish.inc.$conf_php" );
include( "$conf_incldir/language.class.$conf_php" );
include( "$conf_incldir/model.class.$conf_php" );
include( "$conf_incldir/element.inc.$conf_php" );
include( "$conf_incldir/api.inc.$conf_php" );

request_into_session('folderid');
request_into_session('folderaction');

// Verbindung zur Datenbank
//
$db = db_connection();


$projectid = $SESS['projectid'];

if   ( !is_numeric($projectid) )
	message('ERROR','ERROR_NO_PROJECT');

if   ( !is_numeric($SESS['folderid']) )
{
	$SESS['folderid'] = Folder::getRootFolderId();
}

$objectid = $SESS['objectid'];

$folder = new Folder( $objectid );
$folder->load();

if   ( !$folder->isFolder )
	message('ERROR','ERROR_NOT_A_FOLDER');

$var = array();

// Default: Ordner anzeigen
if   ( !isset($SESS['folderaction']) )
	$SESS['folderaction'] = 'show';


switch( $SESS['folderaction'] )
{
	case 'createnew':

		// Neues Objekt in diesem Ordner anlegen
		switch( $REQ['type'] )
		{
			case 'folder':

				if   ( $REQ['foldername'] != '' )
				{
					$f = new Folder();
					$f->name     = $REQ['foldername'];
					$f->filename = $REQ['foldername'];
					$f->parentid = $folder->objectid; 

					$f->add();
				}

				break;
			
			case 'page':

				if   ( $REQ['pagename'] != '' )
				{
					$page = new Page();
					$page->name       = $REQ['pagename'];
					$page->templateid = $REQ['templateid'];
					$page->parentid   = $folder->objectid; 

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
				$file->parentid  = $folder->objectid;
		
				$file->value     = $upload->value;
		
				$file->add(); // Datei hinzufuegen
				break;
			
			case 'link':

				if   ( $REQ['linkname'] != '' )
				{
					$link = new Link();
					$link->name     = $REQ['linkname'];
					$link->parentid = $folder->objectid; 

					$link->add();
				}
				break;
			
			default: die();
		}

		$var['tree_refresh'] = true;
		$SESS['folderaction'] = 'show';

		break;	




	case 'save':
		// Falls Name leer, dann Dateinamen dafür benutzen
		if   ( $REQ['name'] == '' )
			$REQ['name'] = $REQ['filename'];
		
		// Wenn Dateiname gefüllt, dann Datenbank-Update
		if   ( $REQ['filename'] != '' )
		{
			$folder->filename = $REQ['filename'];
			$folder->name     = $REQ['name'];
			$folder->desc     = $REQ['desc'];
			$folder->save();
		}
	
		$SESS['folderaction'] = 'show';
		$var['tree_refresh'] = true;
		
		break;


	// Reihenfolge von Objekten aendern
	case 'changesequence':

		$ids = $folder->getObjectIds();
		$seq = 0;
		foreach( $ids as $id )
		{
			$seq++; // Sequenz um 1 erhoehen
			
			// Die beiden Ordner vertauschen
			if   ( $id == $REQ['objectid1'] )
				$id = $REQ['objectid2'];
			elseif ( $id == $REQ['objectid2'] )
				$id = $REQ['objectid1'];
				
			$o = new Object( $id );
			$o->setOrderId( $seq );
	
			unset( $o ); // Selfmade Garbage Collection :-)
		}
		
		// Ordner anzeigen
		$SESS['folderaction'] = 'show';
		
		break;


	case 'move':

		$subaction = $SESS['folderaction'];
		require( 'functions/global_subactions.inc.php' );

		$folder->load();
		$SESS['folderaction'] = 'show';
		
		break;


	case 'addDefaultACL':
	case 'addAccessACL':
	case 'delACL':

		$subaction = $SESS['folderaction'];
		require( 'functions/global_subactions.inc.php' );

		// Berechtigungen anzeigen
		$SESS['folderaction'] = 'rights';

		break;
}


//session_write_close();

switch( $SESS['folderaction'] )
{
	case 'new':

		if   ( $folder->hasRight('create_page') )
		{
			$var['templates'] = Template::getAll();
		}

		$var['create_folder'] = $folder->hasRight('create_folder');
		$var['create_file']   = $folder->hasRight('create_file');
		$var['create_link']   = $folder->hasRight('create_link');
		$var['create_page']   = $folder->hasRight('create_page');
		
		output('folder_new',$var);
		
		break;



	case 'show':

		if   ( ! $folder->isRoot )
			$var['up_url'] = "main.$conf_php?action=folder&objectid=".$folder->parentid;
		
		$var['object'] = array();
		$last_objectid = 0;

		// Schleife ueber alle Objekte in diesem Ordner
		foreach( $folder->getObjectIds() as $id )
		{
			$o = new Object( $id );
			
			if   ( $o->hasRight('read') )
			{
				$o->objectLoad();
				$var['object'][$id]['name']     = Text::maxLaenge( 30,$o->name     );
				$var['object'][$id]['filename'] = Text::maxLaenge( 20,$o->filename );
				$var['object'][$id]['desc']     = Text::maxLaenge( 30,$o->desc     );

				$var['object'][$id]['type'] = $o->getType();
				$var['object'][$id]['url' ] = "main.$conf_php?action=".$o->getType()."&objectid=".$id;
				$var['object'][$id]['date'] = date( lang('DATE_FORMAT'),$o->lastchange_date );
				$var['object'][$id]['user'] = User::getUserName( $o->lastchange_userid );

				if   ( $last_objectid != 0 )
				{
					$var['object'][$id           ]['upurl'  ] = "folder.$conf_php?folderaction=changesequence&objectid1=".$id."&objectid2=".$last_objectid;
					$var['object'][$last_objectid]['downurl'] = "folder.$conf_php?folderaction=changesequence&objectid1=".$id."&objectid2=".$last_objectid;
				}

				$last_objectid = $id;
			}
		}


		output('folder_show',$var);
		
		break;


	case 'prop':
	
		$var['name'     ] = $folder->name;
		$var['filename' ] = $folder->filename;
		$var['desc'     ] = $folder->desc;
	
		// Alle Ordner ermitteln
		$var['act_objectid'] = $folder->objectid;

		$var['folder'] = array();
		
		$allsubfolders = $folder->getAllSubFolderIds();
		
		foreach( $folder->getOtherFolders() as $id )
		{
			$f = new Folder( $id );
			if   ( ! in_array($id,$allsubfolders ) )
				$var['folder'][$id] = implode( ' &raquo; ',$f->parentObjectNames(true,true) );
		}
		asort( $var['folder'] );
	
		output('folder_prop',$var);
		break;


	case 'rights':
		if   ($SESS['user']['is_admin'] != '1') die('nice try');
	
		$acl = new Acl();
		$acl->objectid = $folder->objectid;

		$var['access_acls']  = array();
		$var['default_acls'] = array();

		foreach( $acl->getAccessACLsFromObject() as $id )
		{
			$acl = new Acl( $id );
			$acl->load();
			$var['access_acls'][$id] = $acl->getProperties();
			$var['access_acls'][$id]['delete_url'] = 'folder.'.$conf_php.'?folderaction=delACL&aclid='.$id;
		}

		foreach( $acl->getDefaultACLsFromObject() as $id )
		{
			$acl = new Acl( $id );
			$acl->load();
			$var['default_acls'][$id] = $acl->getProperties();
			$var['default_acls'][$id]['delete_url'] = 'folder.'.$conf_php.'?folderaction=delACL&aclid='.$id;
		}

		$var['users']     = User::listAll();
		$var['groups']    = Group::getAll();
		$var['languages'] = Language::getAll();

		output('folder_rights',$var);
		
		break;


	case 'pub':
		if	( $REQ['go'] == '1' )
		{
			if	( $REQ['subdirs'] == '1' )
				$subdirs = true;
			else	$subdirs = false;

			$publish = new Publish();
			
			$folder->publish = &$publish;
			$folder->publish( $subdirs );

			$var['filenames'] = array();

			foreach( $publish->publishedObjects as $o )
			{
				$var['filenames'][] = $o['filename'];
			}

			output('all_publish',$var);
		}
		else
		{
			output('folder_pub',$var);
		}
		break;
}

?>