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


/**
 * Action-Klasse zum Bearbeiten einer Datei
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */
class FilemanagerAction extends ObjectAction
{
	var $command;
	var $resourceType;
	
	/**
	 * Ordner
	 *
	 * @var String
	 */
	var $currentFolder;
	
	/**
	 * Aktueller Ordner
	 *
	 * @var Object
	 */
	var $folder;
	
	/**
	 * Konstruktor
	 */
	function FilemanagerAction()
	{
		// PHP-Fehler ins Log schreiben, damit die Ausgabe nicht zerstört wird.
		set_error_handler('filemanagerErrorHandler');

		// Get the main request information.
		$this->command		 = $this->getRequestVar('Command'      );
		$this->resourceType	 = $this->getRequestVar('Type'         );
		$this->currentFolder = $this->getRequestVar('CurrentFolder');

		// Check if it is an allowed type.
		if ( !in_array( $this->resourceType, array('File','Image','Flash','Media') ) )
			$this->sendError(101,'unknown resource type');
	
		// Check the current folder syntax (must begin and end with a slash).
		if ( ! ereg( '/$', $this->currentFolder ) ) $this->currentFolder .= '/' ;
		if ( strpos( $this->currentFolder, '/' ) !== 0 ) $this->currentFolder = '/' . $this->currentFolder;		
		
		$this->investigateCurrentFolder();
	}

	
	/**
	 * Ermittelt das aktuelle Ordnerobjekt.
	 *
	 */
	function investigateCurrentFolder()
	{
		$folderid = Folder::getRootFolderId();
		$this->folder = new Folder( Folder::getRootFolderId() );
		$parts = explode('/',$this->currentFolder);

		foreach( $parts as $part )
		{
			if	( empty($part) )
				continue;

			$oid = $this->folder->getObjectIdByFileName($part);
			
			if	( !$this->folder->available($oid) )
				$this->sendError(102,"currentFolder is invalid (no folder inside): "+$this->currentFolder);
			
			$this->folder = new Folder($oid);

			if	( ! $this->folder->isFolder )
				$this->sendError(102,"currentFolder is invalid (not a folder): "+$this->currentFolder);
		}
	}

	
	
	/**
	 * Anzeigen des Inhaltes, der Inhalt wird samt Header direkt
	 * auf die Standardausgabe geschrieben
	 */
	function show()
	{
		Logger::debug(getenv('REQUEST_URI'));
		Logger::debug($this->command);
		Logger::debug($this->resourceType);
		Logger::debug($this->currentFolder);
		Logger::debug($this->folder->objectid);

		// File Upload doesn't have to Return XML, so it must be intercepted before anything.
		if ( $this->command == 'FileUpload' )
		{
			$this->fileUpload() ;
			return ;
		}
		Logger::debug("Start");
		
		$this->setXmlHeaders();
		$this->createXmlHeader();
		
		// Execute the required command.
		switch ( $this->command )
		{
			case 'GetFolders':
				$this->getFolders() ;
				break ;
				
			case 'GetFoldersAndFiles':
				$this->getFoldersAndFiles() ;
				break ;
				
			case 'CreateFolder':
				$this->createFolder() ;
				break ;
				
			default:
				Logger::warn('Unknown Filemanager-Command: '.$this->command);
				trigger_error('Unknown Command: '.$this->command);
				$this->sendError( 102,"unknown command: ".$this->command ) ;
		}
		Logger::debug("ok");

		$this->createXmlFooter();
		exit;
	}
	
	
	function setXmlHeaders()
	{
		// Prevent the browser from caching the result.
		// Date in the past
		header("Expires: ".gmdate("D, d M Y H:i:s")." GMT");
		// always modified
		header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
		
		// HTTP/1.1
		header('Cache-Control: no-store, no-cache, must-revalidate') ;
		header('Cache-Control: post-check=0, pre-check=0', false) ;

		// HTTP/1.0
		header('Pragma: no-cache') ;
	
	}


	/**
	 * 
	 */
	function createXmlHeader()
	{
		// Set the response format.
		header( 'Content-Type:text/xml' ) ;

		echo '<?xml version="1.0" encoding="utf-8" ?>' ;
		
		// Create the main "Connector" node.
		echo '<Connector command="' . $this->command . '" resourceType="' . $this->resourceType . '">' ;
		
		// Add the current folder node.
		echo '<CurrentFolder path="' . convertToXmlAttribute($this->currentFolder).'" url="'.convertToXmlAttribute($this->currentFolder) . '" />' ;
	}

	
	
	function createXmlFooter()
	{
		echo '</Connector>' ;
	}
	

	
	/**
	 * Sendet eine Fehlermeldung zum Client und beendet den Request.
	 *
	 * @param Integer $number FehlerNr.
	 * @param String $text Fehlermeldung
	 */
	function sendError( $number, $text )
	{
		echo '<Error number="' . $number . '" text="' . htmlspecialchars( $text ) . '" />' ;
		exit ;
	}
	
	
	/**
	 * Ermittelt alle Unterordner.
	 *
	 */
	function getFolders()
	{
		echo "<Folders>" ;

		foreach( $this->folder->getSubfolderFilenames() as $id=>$name )
			echo '<Folder name="'. convertToXmlAttribute($name).'" />';
	
		echo "</Folders>" ;
	}
	
	
	/**
	 * Ermittelt alle Unterordner und Dateien.
	 *
	 */
	function getFoldersAndFiles()
	{
		echo '<Folders>' ;

		foreach( $this->folder->getSubfolderFilenames() as $id=>$name )
			echo '<Folder name="'. convertToXmlAttribute($name).'" />';
			
		echo '</Folders>' ;
		echo '<Files>' ;

		foreach( $this->folder->getFileFilenames() as $id=>$name )
//			echo '<File name="' . convertToXmlAttribute( $name ).'" url="'.convertToXmlAttribute('do.php?action=file&subaction=show&id=').$id.'" size="' . '1' . '" />' ;
			echo '<File name="' . convertToXmlAttribute( $name ).'" url="'.convertToXmlAttribute( Html::url('file','show',$id) ).'" size="' . '1' . '" />' ;
	
		echo '</Files>' ;
	}
	
	
	/**
	 * Legt einen neuen Unterordner an.
	 *
	 */
	function createFolder()
	{
		if ( $this->hasRequestVar('NewFolderName') )
		{
			$newFolder = new Folder();
			$newFolder->parentid = $this->folder->objectid;
			$newFolder->filename = $this->getRequestVar('NewFolderName');
			$newFolder->name     = $this->getRequestVar('NewFolderName');
			
			$newFolder->add();
			
			$this->sendError(0,"OK");
		}
		else
			$this->sendError(102,'missing name for new folder');
	
		// Create the "Error" node.
		//		echo '<Error number="' . $sErrorNumber . '" originalDescription="' . ConvertToXmlAttribute( $sErrorMsg ) . '" />' ;
	}
	
	

	/**
	 * Datei-Upload.
	 *
	 */
	function fileUpload()
	{
		Logger::debug("Upload beginnt");
		$upload = new Upload('NewFile');
		
		Logger::debug("Upload ok");
		
		$file = new File();
		$file->parentid = $this->folder->objectid;
		$file->filename = $upload->filename;
//		if	( !empty($upload->extension) )
//			$file->filename .= '.'.$upload->extension;
			
		$file->filename = $upload->filename;
		$file->value = $upload->value;
		$file->add();
		Logger::debug("Upload added :)");
	
		echo '<script type="text/javascript">' ;
		echo 'window.parent.frames["frmUpload"].OnUploadCompleted(' .'0'.',"' . str_replace( '"', '\\"', $file->filename ) . '") ;' ;
		echo '</script>' ;
	
		exit ;
	}
	
}


/**
 * Fehler-Handler für WEBDAV.<br>
 * Bei einem Laufzeitfehler ist eine Ausgabe des Fehlers auf der Standardausgabe sinnlos.
 * Daher wird der Fehler nur geloggt.
 */
function filemanagerErrorHandler($errno, $errstr, $errfile, $errline) 
{
	Logger::warn('FCKEDITOR FILEMANAGER ERROR: '.$errno.'/'.$errstr.'/file:'.$errfile.'/line:'.$errline);

	// Wir teilen dem Client mit, dass auf dem Server was schief gelaufen ist.	
	WebdavAction::httpStatus('500 Internal Server Error');
}

?>