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
// Revision 1.5  2004-12-26 20:20:57  dankert
// Bei erstem Aufruf Fehlermeldung vermeiden
//
// Revision 1.4  2004/11/28 23:55:36  dankert
// addNotice()
//
// Revision 1.3  2004/05/02 14:49:37  dankert
// Einf?gen package-name (@package)
//
// Revision 1.2  2004/04/24 20:30:23  dankert
// addslashes() entfernt
//
// Revision 1.1  2004/04/24 15:14:52  dankert
// Initiale Version
//
// ---------------------------------------------------------------------------


/**
 * Action-Klasse fuer Dateitransfers
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */

class TransferAction extends Action
{
	var $defaultSubAction = 'import';


	function TransferAction()
	{
	}


	function import()
	{
		$folderName = $this->getRequestVar('local_folder');

		if	( $folderName != '' )
		{
			$dir = @opendir( $folderName );

			if   ( !is_resource( $dir ) )
			{
				$this->addNotice('file',"directory '$folderName' not readable",'ERROR','error');
			}
			else
			{
				while( $filename = readdir($dir) )
				{
					$full_filename = $folderName.'/'.$filename;

	    				if ( $filename != "."  &&
	    				     $filename != ".." &&
	    				     is_file($full_filename) )
	    				{
	        				$file = new File();
	        				$file->parentid = intval( $this->getRequestVar('objectid') );
	        				$file->parse_filename( basename($filename) );
	        				$file->name = $file->filename;
	        				$file->desc = '';

						// Datei lesen
						$f = fopen( $full_filename,'r' );
						$file->value = fread($f,filesize($full_filename));
						fclose( $f );

        				$file->add();
						$this->addNotice('file',$file->name,'IMPORTED','ok');
	
	        			unset( $file );
					} 
				}
				closedir( $dir );
			}
		} 

		$folders = array();
	
		$folder = new Folder();
		foreach( $folder->getAllFolders() as $objectid )
		{
			$f = new Folder( $objectid );
			$folders[$objectid] = implode( FILE_SEP,$f->parentObjectNames(true,true) );
		}
	
		asort( $folders );
		$this->setTemplateVar( 'folders',$folders );
		
		$this->forward( 'transfer_import' );
	}


//	function export()
//	{
//		if   ( isset($REQ['folderid']) && isset($REQ['local_folder']) )
//		{
//			if   ( !is_dir( $REQ['local_folder'] ) )
//			{
//				$var['log'] = 'directory not found';
//			}
//			else
//			{
//				$var['log'] = "reading projectfolder ...\n";
//				
//				$sql = new Sql( 'SELECT * FROM {t_file}'.
//				                ' WHERE folderid={folderid}' );
//				$sql->setInt('folderid',$REQ['folderid']);
//				$files = $db->getCol( $sql->query );
//
//				foreach( $files as $fileid )
//				{
//        				$file = new File();
//        				$file->fileid = $fileid;
//        				$file->load();
//
//					$full_filename = $REQ['local_folder'].'/'.$file->filename;
//					if   ( $file->extension != '' )
//						$full_filename .= '.'.$file->extension; 
//    					$var['log'] .= "saving $full_filename\n"; 
//
//					// Datei lesen
//					$f = fopen( $file->tmpfile(),'r' );
//					$value = fread($f,filesize($file->tmpfile()));
//					fclose( $f );
//
//					// Datei lesen
//					$f = fopen( $full_filename,'w' );
//					fwrite( $f,$value );
//					fclose( $f );
//
//        				unset( $file );
//				}
//			} 
//		} 
//
//
//		$folders = array();
//	
//		$folder = new Folder();
//		foreach( $folder->getAllFolders() as $objectid )
//		{
//			$f = new Folder( $objectid );
//			$folders[$objectid] = implode( ' &raquo; ',$f->parentObjectNames(true,true) );
//		}
//
//		asort( $folders );
//		$this->setTemplateVar( 'folders',$folders );
//		
//
//		$this->forward( 'transfer_export' );
//	}


//	function copyproject()
//	{
//		if   ( isset($REQ['folderid']) && isset($REQ['local_folder']) )
//		{
//			if   ( !is_dir( $REQ['local_folder'] ) )
//			{
//				$var['log'] = 'directory not found';
//			}
//			else
//			{
//				$var['log'] = "reading projectfolder ...\n";
//				
//				$sql = new Sql( 'SELECT * FROM {t_file}'.
//				                ' WHERE folderid={folderid}' );
//				$sql->setInt('folderid',$REQ['folderid']);
//				$files = $db->getCol( $sql->query );
//
//				foreach( $files as $fileid )
//				{
//        				$file = new File();
//        				$file->fileid = $fileid;
//        				$file->load();
//
//					$full_filename = $REQ['local_folder'].'/'.$file->filename;
//					if   ( $file->extension != '' )
//						$full_filename .= '.'.$file->extension; 
//    					$var['log'] .= "saving $full_filename\n"; 
//
//					// Datei lesen
//					$f = fopen( $file->tmpfile(),'r' );
//					$value = fread($f,filesize($file->tmpfile()));
//					fclose( $f );
//
//					// Datei lesen
//					$f = fopen( $full_filename,'w' );
//					fwrite( $f,$value );
//					fclose( $f );
//
//        				unset( $file );
//				}
//			} 
//		} 
//
//
//		$sql = new Sql( 'SELECT id FROM {t_folder}' );
//		$sql->setInt('projectid',$projectid);
//		$folders = $db->getCol( $sql->query );
//	
//		$var['folders'] = array();
//	
//		foreach( $folders as $folderid )
//		{
//			$folder = new Folder( $folderid );
//			$folder->load();
//			$folder->filenames = false;
//			$var['folders'][$folderid] = implode(' &raquo; ',$folder->parentfolder( true,true ));
//		}
//	
//		asort( $var['folders'] );
//		
//		$this->forward( 'transfer_copyproject' );
//	}

}

?>