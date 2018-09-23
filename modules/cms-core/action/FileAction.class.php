<?php

namespace cms\action;

use cms\model\Folder;
use cms\model\BaseObject;
use cms\model\File;

use Http;
use \Html;
use Upload;

// OpenRat Content Management System
// Copyright (C) 2002-2012 Jan Dankert, cms@jandankert.de
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
class FileAction extends ObjectAction
{
	public $security = SECURITY_USER;

	var $file;
	var $defaultSubAction = 'show';

	/**
	 * Konstruktor
	 */
	function __construct()
    {
        parent::__construct();
    }


    public function init()
    {
		$this->file = new File( $this->getRequestId() );
		$this->file->languageid = $this->getRequestVar(REQ_PARAM_LANGUAGE_ID);
		$this->file->load();
	}


	/**
	 * Ersetzt den Inhalt mit einer anderen Datei
	 */
	public function editPost()
	{
		$upload = new Upload();

		$this->file->filename  = $upload->filename;
		$this->file->extension = $upload->extension;		
		$this->file->size      = $upload->size;

		$this->file->save();
		
		$this->file->value = $upload->value;
		$this->file->saveValue();
		$this->file->setTimestamp();

		//$setTemplateVar('tree_refresh',true);
		$this->addNotice($this->file->getType(),$this->file->name,'VALUE_SAVED','ok');
	}


	public function valuePost()
	{
		$this->file->value = $this->getRequestVar('value',OR_FILTER_RAW);
		$this->file->saveValue();
	
		$this->addNotice($this->file->getType(),$this->file->name,'VALUE_SAVED','ok');
		$this->file->setTimestamp();
	}


	/**
	 * Abspeichern der Eigenschaften zu dieser Datei.
	 *
	 */
	function propPost()
	{
		// Eigenschaften speichern
		$this->file->filename  = $this->getRequestVar('filename'   ,OR_FILTER_FILENAME);
		$this->file->name      = $this->getRequestVar('name'       ,OR_FILTER_FULL    );
		$this->file->extension = $this->getRequestVar('extension'  ,OR_FILTER_FILENAME);
		$this->file->desc      = $this->getRequestVar('description',OR_FILTER_FULL    );
		
		$this->file->save();
		$this->file->setTimestamp();
		$this->addNotice($this->file->getType(),$this->file->name,'PROP_SAVED','ok');
	}

	
	
	/**
	 * Anzeigen des Inhaltes, der Inhalt wird samt Header direkt
	 * auf die Standardausgabe geschrieben
	 */
	function previewView()
	{
		$url = Html::url('file','show',$this->file->objectid,array('target'=>'none',REQ_PARAM_EMBED=>'1') );
		$this->setTemplateVar('preview_url',$url );
		
		$this->setTemplateVar('image',$this->file->isImage() );
		
	}
	

	/**
	 * Anzeigen des Inhaltes, der Inhalt wird samt Header direkt
	 * auf die Standardausgabe geschrieben
	 */
	function showView()
	{
		$this->lastModified( $this->file->lastchangeDate );
		
		if	( $this->file->extension == 'gz' )
		{
			global $conf;
			$mime_types = $conf['mime-types'];
			
			$pos = strrpos($this->file->filename,'.');
			if	( $pos === false )
				$ext = '';
			else
				$ext = substr($this->file->filename,$pos+1);
			
			$ext = strtolower($ext);
			
			if	( !empty($mime_types[$ext]) )
				$mime_type = $mime_types[$ext];
			else
				// Wenn kein Mime-Type gefunden, dann Standartwert setzen
				$mime_type = OR_FILE_DEFAULT_MIMETYPE;
				
			header('Content-Type: '.$mime_type );
			header('Content-Encoding: gzip' );
		}
		else
		{
			// Angabe Content-Type
			header('Content-Type: '.$this->file->mimeType() );
		}
		
		header('X-File-Id: '   .$this->file->fileid     );
		header('X-Id: '        .$this->file->id         );
		
		// Angabe Content-Disposition
		// - Bild soll "inline" gezeigt werden
		// - Dateiname wird benutzt, wenn der Browser das Bild speichern moechte
		header('Content-Disposition: inline; filename='.$this->file->filename() );
		header('Content-Transfer-Encoding: binary' );
		header('Content-Description: '.$this->file->name );
		
		$this->file->write(); // Bild aus Datenbank laden
		
		// Groesse des Bildes in Bytes
		// Der Browser hat so die Moeglichkeit, einen Fortschrittsbalken zu zeigen
		header('Content-Length: '.filesize($this->file->tmpfile()) );
		
		if	( in_array( getenv('HTTP_ACCEPT'),array('application/php-array','application/php-serialized','application/json','application/xml')))
		{
			$this->setTemplateVar('encoding', 'base64');
			$this->setTemplateVar('value'   , base64_encode($this->file->tmpfile()) );
		}
		// Unterscheidung, ob PHP-Code in der Datei ausgefuehrt werden soll.
		elseif	( ( config('publish','enable_php_in_file_content')=='auto' && $this->file->getRealExtension()=='php') ||
		        config('publish','enable_php_in_file_content')===true )
		    // PHP-Code ausfuehren
			require( $this->file->tmpfile() );
		else
		    // PHP-Code nicht ausfuehren, Datei direkt auf die Standardausgabe schreiben
			readfile( $this->file->tmpfile() );
		exit;
	}


	function propView()
	{
		
				global $conf;
		
		if	( $this->file->filename == $this->file->objectid )
			$this->file->filename = '';

		// Eigenschaften der Datei uebertragen
		$this->setTemplateVars( $this->file->getProperties() );

		$this->setTemplateVar('size',number_format($this->file->size/1000,0,',','.').' kB' );
		$this->setTemplateVar('full_filename',$this->file->full_filename());
		
		if	( is_file($this->file->tmpfile()))
		{
			$this->setTemplateVar('cache_filename' ,$this->file->tmpfile());
			$this->setTemplateVar('cache_filemtime',@filemtime($this->file->tmpfile()));
		}

		// Alle Seiten mit dieser Datei ermitteln
		$pages = $this->file->getDependentObjectIds();
			
		$list = array();
		foreach( $pages as $id )
		{
			$o = new BaseObject( $id );
			$o->load();
			$list[$id] = array();
			$list[$id]['url' ] = Html::url('main','page',$id);
			$list[$id]['name'] = $o->name;
		}
		asort( $list );
		$this->setTemplateVar('pages',$list);
		$this->setTemplateVar('edit_filename',$conf['filename']['edit']);	
	}


	public function infoView()
	{
		
		global $conf;
		
		if	( $this->file->filename == $this->file->objectid )
			$this->file->filename = '';

		// Eigenschaften der Datei uebertragen
		$this->setTemplateVars( $this->file->getProperties() );

		$this->setTemplateVar('size',number_format($this->file->size/1000,0,',','.').' kB' );
		$this->setTemplateVar('full_filename',$this->file->full_filename());
		
		if	( is_file($this->file->tmpfile()))
		{
			$this->setTemplateVar('cache_filename' ,$this->file->tmpfile());
			$this->setTemplateVar('cache_filemtime',@filemtime($this->file->tmpfile()));
		}

		// Alle Seiten mit dieser Datei ermitteln
		$pages = $this->file->getDependentObjectIds();
			
		$list = array();
		foreach( $pages as $id )
		{
			$o = new BaseObject( $id );
			$o->load();
			$list[$id] = array();
			$list[$id]['url' ] = Html::url('main','page',$id);
			$list[$id]['name'] = $o->name;
		}
		asort( $list );
		$this->setTemplateVar('pages',$list);
		$this->setTemplateVar('edit_filename',$conf['filename']['edit']);	
	}


	/**
	 * Anzeigen des Inhaltes
	 */
	function editView()
	{
		global $conf;
		// MIME-Types aus Datei lesen
		$this->setTemplateVars( $this->file->getProperties() );
	}


	/**
	 * Anzeigen des Inhaltes
	 */
	function upload()
	{
	}


	/**
	 * Anzeigen des Inhaltes
	 */
	function valueView()
	{
		global $conf;
		// MIME-Types aus Datei lesen
		$this->setTemplateVars( $this->file->getProperties() );
		$this->setTemplateVar('value',$this->file->loadValue());
	}


	/**
	 * Anzeigen des Inhaltes
	 */
	function extractView()
	{
		$this->setTemplateVars( $this->file->getProperties() );
	}


	/**
	 * Anzeigen des Inhaltes
	 */
	function uncompressView()
	{
	}


	/**
	 * Anzeigen des Inhaltes
	 */
	function uncompressPost()
	{
		switch( $this->file->extension )
		{
			case 'gz':
				if	( $this->getRequestVar('replace') )
				{
					if	( strcmp(substr($this->file->loadValue(),0,2),"\x1f\x8b"))
					{
						throw new \LogicException("Not GZIP format (See RFC 1952)");
					}
					$method = ord(substr($this->file->loadValue(),2,1));
					if	( $method != 8 )
					{
						throw new \LogicException("Unknown GZIP method: $method");
					}
					$this->file->value = gzinflate( substr($this->file->loadValue(),10));
					$this->file->parse_filename( $this->file->filename );
					$this->file->save();
					$this->file->saveValue();
				}
				else
				{
					$newFile = new File();
					$newFile->name     = $this->file->name;
					$newFile->parentid = $this->file->parentid;
					$newFile->value    = gzinflate( substr($this->file->loadValue(),10));
					$newFile->parse_filename( $this->file->filename );
					$newFile->add();
				}
				
				break;

			case 'bz2':
				if	( $this->getRequestVar('replace') )
				{
					$this->file->value = bzdecompress($this->file->loadValue());
					$this->file->parse_filename( $this->file->filename );
					$this->file->save();
					$this->file->saveValue();
				}
				else
				{
					$newFile = new File();
					$newFile->name     = $this->file->name;
					$newFile->parentid = $this->file->parentid;
					$newFile->value    = bzdecompress( $this->file->loadValue() );
					$newFile->parse_filename( $this->file->filename );
					$newFile->add();
				}
				
				break;

			default:
				die( 'cannot uncompress file with extension: '.$this->file->extension );
		}

		$this->addNotice('file',$this->file->name,'DONE',OR_NOTICE_OK);
		$this->callSubAction('edit');
	}



	/**
	 * Anzeigen des Inhaltes
	 */
	function extractPost()
	{
		switch( $this->file->extension )
		{
			case 'tar':
				$folder = new Folder();
				$folder->parentid = $this->file->parentid;
				$folder->name     = $this->file->name;
				$folder->filename = $this->file->filename;
				$folder->add();
				
				$tar = new ArchiveTar();
				$tar->openTAR( $this->file->loadValue() );
				
				foreach( $tar->files as $file )
				{
					$newFile = new File();
					$newFile->name     = $file['name'];
					$newFile->parentid = $folder->objectid;
					$newFile->value    = $file['file'];
					$newFile->parse_filename( $file['name'] );
					$newFile->lastchangeDate = $file['time'];
					$newFile->add();
					
					$this->addNotice('file',$newFile->name,'ADDED');
				}
				
				unset($tar);
				
				break;

			case 'zip':
			
				$folder = new Folder();
				$folder->parentid    = $this->file->parentid;
				$folder->name        = $this->file->name;
				$folder->filename    = $this->file->filename;
				$folder->description = $this->file->fullFilename;
				$folder->add();
				
				$zip = new ArchiveUnzip();
				$zip->open( $this->file->loadValue() );

				$lista = $zip->getList();

				if(sizeof($lista)) foreach($lista as $fileName=>$trash){
					

					$newFile = new File();
					$newFile->name        = basename($fileName);
					$newFile->description = 'Extracted: '.$this->file->fullFilename.' -> '.$fileName;
					$newFile->parentid    = $folder->objectid;
					$newFile->parse_filename( basename($fileName) );

					$newFile->value       = $zip->unzip($fileName);
					$newFile->add();
					
					$this->addNotice('file',$newFile->name,'ADDED');
					unset($newFile);
				}

				$zip->close();
				unset($zip);
				
				break;

			default:
				die( 'cannot extract file with extension: '.$this->file->extension );
		}
		$this->callSubAction('edit');
	}



	/**
	 * Anzeigen des Inhaltes
	 */
	function compressView()
	{
		$formats = array();
		foreach( $this->getCompressionTypes() as $t )
			$formats[$t] = lang('compression_'.$t);

		$this->setTemplateVar('formats'       ,$formats    );
	}

	

	/**
	 * Anzeigen des Inhaltes
	 */
	function compressPost()
	{
		$format = $this->getRequestVar('format',OR_FILTER_ALPHANUM);
		
		switch( $format )
		{
			case 'gz':
				if	( $this->getRequestVar('replace',OR_FILTER_NUMBER)=='1' )
				{
					$this->file->value = gzencode( $this->file->loadValue(),1 );
					$this->file->parse_filename( $this->file->filename.'.'.$this->file->extension.'.gz',FORCE_GZIP );
					$this->file->save();
					$this->file->saveValue();
					
				}
				else
				{
					$newFile = new File();
					$newFile->name     = $this->file->name;
					$newFile->parentid = $this->file->parentid;
					$newFile->value    = gzencode( $this->file->loadValue(),1 );
					$newFile->parse_filename( $this->file->filename.'.'.$this->file->extension.'.gz',FORCE_GZIP );
					$newFile->add();
				}
				
				break;

			case 'bzip2':
				if	( $this->getRequestVar('replace')=='1' )
				{
					$this->file->value = bzcompress( $this->file->loadValue() );
					$this->file->parse_filename( $this->file->filename.'.'.$this->file->extension.'.bz2' );
					$this->file->save();
					$this->file->saveValue();
					
				}
				else
				{
					$newFile = new File();
					$newFile->name     = $this->file->name;
					$newFile->parentid = $this->file->parentid;
					$newFile->value    = bzcompress( $this->file->loadValue() );
					$newFile->parse_filename( $this->file->filename.'.'.$this->file->extension.'.bz2' );
					$newFile->add();
				}
				
				break;
			default:
				die( 'unknown compress type: '.$format );
		}

		$this->addNotice('file',$this->file->name,'DONE',OR_NOTICE_OK);
		$this->callSubAction('edit');
	}


	/**
	 * Datei veroeffentlichen
	 */
	function pubView()
	{
	}


	/**
	 * Datei veroeffentlichen
	 */
	function pubPost()
	{
		$this->file->publish();
		$this->file->publish->close();
		
		$this->addNotice('file',$this->file->fullFilename,'PUBLISHED'.($this->file->publish->ok?'':'_ERROR'),$this->file->publish->ok,array(),$this->file->publish->log);
	}



	function getCompressionTypes()
	{
		$compressionTypes = array();
		if	( function_exists('gzencode'    ) ) $compressionTypes[] = 'gz';
		//if	( function_exists('gzencode'    ) ) $compressionTypes[] = 'zip';
		if	( function_exists('bzipcompress') ) $compressionTypes[] = 'bz2';
		return $compressionTypes;
	}

	function getArchiveTypes()
	{
		$archiveTypes = array();
		$archiveTypes[] = 'tar';
		$archiveTypes[] = 'zip';
		return $archiveTypes;
	}



	function checkMenu( $name )
	{
		$archiveTypes     = $this->getArchiveTypes();
		$compressionTypes = $this->getCompressionTypes();
		
		switch( $name )
		{
			case 'uncompress':
				return !readonly() && in_array($this->file->extension,$compressionTypes);

			case 'compress':
				return !readonly() && !in_array($this->file->extension,$compressionTypes);

			case 'extract':
				return !readonly() && in_array($this->file->extension,$archiveTypes);

			case 'size':
				return !readonly() && $this->file->isImage();

			case 'editvalue':
				return !readonly() && substr($this->file->mimeType(),0,5)=='text/';

			case 'aclform':
				return !readonly();
				
			default:
				return true;
		}
	}
	
	
	
	/**
	 * Liefert die Struktur zu diesem Ordner:
	 * - Mit den übergeordneten Ordnern und
	 * - den in diesem Ordner enthaltenen Objekten
	 * 
	 * Beispiel:
	 * <pre>
	 * - A
	 *   - B
	 *     - C (dieser Ordner)
	 *       - Unterordner
	 *       - Seite
	 *       - Seite
	 *       - Datei
	 * </pre> 
	 */
	public function structureView()
	{

		$structure = array();
		$tmp = &$structure;
		$nr  = 0;
		
		$folder = new Folder( $this->file->parentid );
		$parents = $folder->parentObjectNames(false,true);
		
		foreach( $parents as $id=>$name)
		{
			unset($children);
			unset($o);
			$children = array();
			$o = array('id'=>$id,'name'=>$name,'type'=>'folder','level'=>++$nr,'children'=>&$children);
			
			$tmp[$id] = &$o;;
			
			unset($tmp);
			
			$tmp = &$children; 
		}
		
		
		
		unset($children);
		unset($id);
		unset($name);
		
		$elementChildren = array();
		
		$tmp[ $this->file->objectid ] = array('id'=>$this->file->objectid,'name'=>$this->file->name,'type'=>'file','self'=>true,'children'=>&$elementChildren);
		
		
		//Html::debug($structure);
		
		$this->setTemplateVar('outline',$structure);
	}
}

?>