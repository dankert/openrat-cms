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
		if	( $this->getRequestId() != 0  )
		{
			$fid = $this->getRequestId();
		}
		else
		{
			$project = Session::getProject();
			$fid = $project->getRootObjectId();
		}
		
		$this->folder = new Folder( $fid );
		$this->folder->load();
		
		
	}

	
	/**
	 * Ermittelt das aktuelle Ordnerobjekt.
	 *
	 */
	function investigateCurrentFolder()
	{
		$parts = explode('/',$this->currentFolder);

		foreach( $parts as $part )
		{
			if	( empty($part) )
				continue;

			$oid = $this->folder->getObjectIdByFileName($part);
			
			if	( !$this->folder->available($oid) )
				$this->sendErrorDocument(102,"currentFolder is invalid (no folder inside): "+$this->currentFolder);
			
			$this->folder = new Folder($oid);

			if	( ! $this->folder->isFolder )
				$this->sendErrorDocument(102,"currentFolder is invalid (not a folder): "+$this->currentFolder);
		}
	}

	
	
	/**
	 * Anzeigen des Inhaltes, der Inhalt wird samt Header direkt
	 * auf die Standardausgabe geschrieben
	 */
	function connector()
	{
		// PHP-Fehler ins Log schreiben, damit die Ausgabe nicht zerst�rt wird.
		if (version_compare(PHP_VERSION, '5.0.0', '>'))
			set_error_handler('filemanagerErrorHandler',E_ALL & ~E_NOTICE);
		else
			set_error_handler('filemanagerErrorHandler');
		
		Logger::debug('Filemanager: '.getenv('REQUEST_URI'));
		Logger::debug($this->command);
		Logger::debug($this->resourceType);
		Logger::debug($this->currentFolder);
		//Logger::debug($this->folder->objectid);

		
		// Get the main request information.
		$this->command		 = $this->getRequestVar('Command'      );
		$this->resourceType	 = $this->getRequestVar('Type'         );
		$this->currentFolder = $this->getRequestVar('CurrentFolder');

		// Check if it is an allowed type.
		if ( !in_array( $this->resourceType, array('File','Image','Flash','Media') ) )
		{
			$this->sendErrorDocument(1,'unknown resource type');
			exit;
		}
	
		// Check the current folder syntax (must begin and end with a slash).
		if ( ! ereg( '/$', $this->currentFolder ) ) $this->currentFolder .= '/' ;
		if ( strpos( $this->currentFolder, '/' ) !== 0 ) $this->currentFolder = '/' . $this->currentFolder;		
		
		$this->investigateCurrentFolder();
		
		
		// File Upload doesn't have to Return XML, so it must be intercepted before anything.
		if ( $this->command == 'FileUpload' )
		{
			$this->fileUpload('NewFile') ;
			return ;
		}
		if ( $this->command == 'DirectUpload' )
		{
			$this->fileUpload('upload') ;
			return ;
		}
		
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
				$this->sendError( 1,"unknown command: ".$this->command ) ;
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
	 * Sendet eine Fehlermeldung zum Client.
	 *
	 * @param Integer $number FehlerNr.
	 * @param String $text Fehlermeldung
	 */
	function sendError( $number, $text )
	{
		echo '<Error number="' . $number . '" text="' . htmlspecialchars( $text ) . '" />' ;
	}
	
	
	/**
	 * Sendet eine Fehlermeldung zum Client und beendet den Request.
	 *
	 * @param Integer $number FehlerNr.
	 * @param String $text Fehlermeldung
	 */
	function sendErrorDocument( $number, $text )
	{
		$this->createXmlHeader();
		$this->sendError( $number, $text );
		$this->createXmlFooter();
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
			echo '<File name="' . convertToXmlAttribute( $name ).'" url="'.convertToXmlAttribute( Html::url('file','show',$id,array('oid'=>'__OID__'.$id.'__') ) ).'" size="' . '1' . '" />' ;
	
		echo '</Files>' ;
	}
	
	
	/**
	 * Legt einen neuen Unterordner an.
	 *
	 */
	function createFolder()
	{	
		// Possible Error Numbers are: 
		//   0 : No Errors Found. The folder has been created. 
		// 101 : Folder already exists. 
		// 102 : Invalid folder name. 
		// 103 : You have no permissions to create the folder. 
		// 110 : Unknown error creating folder.
		
		$filename = $this->getRequestVar('NewFolderName');
		
		if ( empty($filename) )
		{
			$this->sendError(102,'missing name for new folder.');
		}
		elseif( !$this->folder->hasRight(ACL_CREATE_FOLDER) )
		{
			$this->sendError(103,'You have no permissions to create the folder.');
		}
		elseif( $this->folder->hasFilename( $filename ) )
		{
			$this->sendError(101,'Folder already exists.');
		}
		else
		{
			$newFolder = new Folder();
			$newFolder->parentid = $this->folder->objectid;
			$newFolder->filename = $filename;
			$newFolder->name     = $filename;
			
			$newFolder->add();
			
			$this->sendError(0,"OK");
		}
	}
	
	

	/**
	 * Datei-Upload.
	 *
	 */
	function fileUpload( $var )
	{
		$upload = new Upload( $var );
		
		// From FCK-Editor-Doc:
		// The "OnUploadCompleted" is a JavaScript function that is called to expose the upload result. The possible values are: 
		// OnUploadCompleted( 0 ) : no errors found on the upload process. 
		// OnUploadCompleted( 1, , , 'Reason' ) : the upload filed because of "Reason". 
		// OnUploadCompleted( 201, ,'FileName(1).ext' ) : the file has been uploaded successfully, but its name has been changed to "FileName(1).ext". 
		// OnUploadCompleted( 202 ) : invalid file.
		if	( !$upload->isValid() )
		{
			echo 'Upload failed, reason: '.$upload->error; 
		}
		else
		{
			$file = new File();
			$file->parentid  = $this->folder->objectid;
			$file->name      = $upload->filename;
			$file->filename  = $upload->filename;
			$file->extension = $upload->extension;
			$file->value     = $upload->value;
			$file->add();
			
			$newId  = $file->objectid;
			$newUrl = str_replace('&amp;','&',Html::url('file','show',$newId,array('oid'=>'__OID__'.$newId.'__')));
			
			echo '<script type="text/javascript">' ;
			echo 'window.parent.CKEDITOR.tools.callFunction('.$this->getRequestVar('CKEditorFuncNum','123').",'".$newUrl."','');</script>";
			echo '</script>' ;
			echo 'OK' ;
		}
	
	}

	
	function browse()
	{
		global $conf_php;
		$funcNum = $this->getRequestVar('CKEditorFuncNum','123');

		if   ( ! $this->folder->isRoot )
			$this->setTemplateVar('up_url',Html::url('filemanager','browse',$this->folder->parentid,array('CKEditorFuncNum'=>$funcNum)));

		$this->setTemplateVar('writable',$this->folder->hasRight(ACL_WRITE) );
		
		$list = array();

		// Schleife ueber alle Objekte in diesem Ordner
		foreach( $this->folder->getObjects() as $o )
		{
			$id = $o->objectid;

			if   ( $o->hasRight(ACL_READ) )
			{
				$list[$id]['name']     = Text::maxLaenge( 30,$o->name     );
				$list[$id]['filename'] = Text::maxLaenge( 20,$o->filename );
				$list[$id]['desc']     = Text::maxLaenge( 30,$o->desc     );
				if	( $list[$id]['desc'] == '' )
					$list[$id]['desc'] = lang('NO_DESCRIPTION_AVAILABLE');
				$list[$id]['desc'] = $list[$id]['desc'].' - '.lang('IMAGE').' '.$id; 

				$list[$id]['type'] = $o->getType();
				
				$list[$id]['icon' ] = $o->getType();
				$list[$id]['class'] = $o->getType();
				if	( $o->isFolder )
					$list[$id]['url' ] = Html::url('filemanager','browse',$id,array('CKEditorFuncNum'=>$funcNum) );
				else
					$list[$id]['url' ] = "javascript:window.top.opener.CKEDITOR.tools.callFunction($funcNum,'".Html::url('file','show',$id,array('oid'=>'__OID__'.$id.'__'))."','');window.top.close();window.top.opener.focus();";					
				
				
				
				if	( $o->getType() == 'file' )
				{
					$file = new File( $id );
					$file->load();
					$list[$id]['desc'] .= ' - '.intval($file->size/1000).'kB';

					if	( $file->isImage() )
					{
						$list[$id]['icon' ] = 'image';
						$list[$id]['class'] = 'image';
						//$list[$id]['url' ] = Html::url('file','show',$id) nur sinnvoll bei Lightbox-Anzeige
					}
//					if	( substr($file->mimeType(),0,5) == 'text/' )
//						$list[$id]['icon'] = 'text';
				}

				$list[$id]['date'] = $o->lastchangeDate;
				$list[$id]['user'] = $o->lastchangeUser;
			}
		}

		$this->setTemplateVar('object'      ,$list            );
		$this->setTemplateVar('CKEditorFuncNum',$funcNum );
		$this->setTemplateVar('token',token() );
		$this->setTemplateVar('id',$this->folder->objectid );
	}


	function addfolder()
	{
		
		$filename = $this->getRequestVar('name');
		
		if ( empty($filename) )
		{
			$this->addNotice('folder',$this->name,'ADDED',OR_NOTICE_ERROR);
		}
		elseif( !$this->folder->hasRight(ACL_CREATE_FOLDER) )
		{
			$this->addNotice('folder',$this->name,'ERROR',OR_NOTICE_ERROR);
		}
		elseif( $this->folder->hasFilename( $filename ) )
		{
			$this->addNotice('folder',$this->name,'ERROR',OR_NOTICE_ERROR);
			
		}
		else
		{
			$newFolder = new Folder();
			$newFolder->parentid = $this->folder->objectid;
			$newFolder->filename = $filename;
			$newFolder->name     = $filename;
			$newFolder->add();
			
			$this->addNotice('folder',$this->folder->name,'ADDED',OR_NOTICE_OK);
		}
	}
	
	
	
	function upload()
	{
		$upload = new Upload('file');
		
		if	( !$upload->isValid() )
		{
			Html::debug($upload);
			$this->addValidationError('file','COMMON_VALIDATION_ERROR',array(),$upload->error);
			return;
		}
		// Pr�fen der maximal erlaubten Dateigr��e.
		elseif	( $upload->size < 0 )
		{
			// Maximale Dateigr��e ist �berschritten
			$this->addValidationError('file','MAX_FILE_SIZE_EXCEEDED');
			return;
		}
		elseif( $upload->size > 0 )
		{
			$file   = new File();
			$file->desc      = '';
			$file->filename  = $upload->filename;
			$file->name      = $upload->filename;
			$file->extension = $upload->extension;		
			$file->size      = $upload->size;
			$file->parentid  = $this->folder->objectid;
	
			$file->value     = $upload->value;
	
			$file->add(); // Datei hinzufuegen
			$this->folder->setTimestamp();
			$this->addNotice('file',$file->name,'ADDED','ok');
		}
	}
}


/**
 * Fehler-Handler f�r WEBDAV.<br>
 * Bei einem Laufzeitfehler ist eine Ausgabe des Fehlers auf der Standardausgabe sinnlos.
 * Daher wird der Fehler nur geloggt.
 */
function filemanagerErrorHandler($errno, $errstr, $errfile, $errline) 
{
	Logger::warn('FCKEDITOR FILEMANAGER ERROR: '.$errno.'/'.$errstr.'/file:'.$errfile.'/line:'.$errline);

	// Wir teilen dem Client mit, dass auf dem Server was schief gelaufen ist.	
	Http::serverError('Filemanager failed with: '.$errno.'/'.$errstr.'/file:'.$errfile.'/line:'.$errline);
}

?>