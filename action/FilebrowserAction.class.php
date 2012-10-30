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
class FilebrowserAction extends ObjectAction
{
	public $security = SECURITY_USER;
	
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
	function FilebrowserAction()
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
	 * 
	 */
	function show()
	{
		Http::notAuthorized('no subaction found');
	}
	

	/**
	 * Datei-Upload.
	 *
	 */
	public function directuploadPost()
	{
		$upload = new Upload( $this->getRequestVar('name','abc') );
		
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
			echo 'window.parent.CKEDITOR.tools.callFunction('.$this->getRequestVar('CKEditorFuncNum',OR_FILTER_NUMBER).",'".$newUrl."','');</script>";
			echo '</script>' ;
			echo 'OK' ;
		}
	
	}

	
	public function browseView()
	{
		global $conf_php;
		$funcNum = $this->getRequestVar('CKEditorFuncNum',OR_FILTER_NUMBER);

		if   ( ! $this->folder->isRoot )
			$this->setTemplateVar('up_url',Html::url('filebrowser','browse',$this->folder->parentid,array('CKEditorFuncNum'=>$funcNum)));

		$user = Session::getUser();
		$this->setTemplateVar('writable',$this->folder->hasRight(ACL_WRITE) );
		$this->setTemplateVar('style',$user->style );
		
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
					$list[$id]['url' ] = Html::url('filebrowser','browse',$id,array('CKEditorFuncNum'=>$funcNum) );
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


	public function addfolderPost()
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
	
	
	
	public function uploadPost()
	{
		if	( $this->hasRequestVar('name') )
			$name = $this->getRequestVar('name','abc');
		else
			$name = 'file';
			
		$upload = new Upload($name);
		
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

?>