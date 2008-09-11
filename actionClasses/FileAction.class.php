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
class FileAction extends ObjectAction
{
	var $file;
	var $defaultSubAction = 'show';

	/**
	 * Konstruktor
	 */
	function FileAction()
	{
		if	( $this->getRequestId() != 0  )
		{
			$this->file = new File( $this->getRequestId() );
			$this->file->load();
			Session::setObject( $this->file );
		}
		else
		{
			$this->file = Session::getObject();
		}

		$this->lastModified( $this->file->lastchangeDate );
	}


	/**
	 * Ersetzt den Inhalt mit einer anderen Datei
	 */
	function replace()
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


	function savevalue()
	{
		$this->file->value = $this->getRequestVar('value');
		$this->file->saveValue();
	
		$this->addNotice($this->file->getType(),$this->file->name,'VALUE_SAVED','ok');
		$this->file->setTimestamp();
	}


	/**
	 * Abspeichern der Eigenschaften zu dieser Datei.
	 *
	 */
	function saveprop()
	{
		// Eigenschaften speichern
		$this->file->filename  = $this->getRequestVar('filename'   );
		$this->file->name      = $this->getRequestVar('name'       );
		$this->file->extension = $this->getRequestVar('extension'  );
		$this->file->desc      = $this->getRequestVar('description');
		
		$this->file->save();
		$this->file->setTimestamp();
		$this->addNotice($this->file->getType(),$this->file->name,'PROP_SAVED','ok');
	}


	/**
	 * Anzeigen des Inhaltes, der Inhalt wird samt Header direkt
	 * auf die Standardausgabe geschrieben
	 */
	function show()
	{
		// Angabe Content-Type
		header('Content-Type: '.$this->file->mimeType() );
		header('X-File-Id: '.$this->file->fileid );

		// Angabe Content-Disposition
		// - Bild soll "inline" gezeigt werden
		// - Dateiname wird benutzt, wenn der Browser das Bild speichern moechte
		header('Content-Disposition: inline; filename='.$this->file->filenameWithExtension() );
		header('Content-Transfer-Encoding: binary' );
		header('Content-Description: '.$this->file->name );

		$this->file->write(); // Bild aus Datenbank laden

		// Groesse des Bildes in Bytes
		// Der Browser hat so die Moeglichkeit, einen Fortschrittsbalken zu zeigen
		header('Content-Length: '.filesize($this->file->tmpfile()) );
		
		
		readfile( $this->file->tmpfile() );
		exit;
	}


	function imageFormat()
	{
		if	( ! function_exists( 'imagetypes' ) )
			return 0;

		$ext      = strtolower($this->file->extension);
		$types    = imagetypes();
		$formats  = array( 'gif' =>IMG_GIF,
		                   'jpg' =>IMG_JPG,
		                   'jpeg'=>IMG_JPG,
		                   'png' =>IMG_PNG );
		
		if	( !isset($formats[$ext]) )
			return 0;

		if	( $types & $formats[$ext] )
			return $formats[$ext];

		return 0;
	}



	function imageExt()
	{
		switch( $this->imageFormat() )
		{
			case IMG_GIF:
				return 'GIF';
			case IMG_JPG:
				return 'JPEG';
			case IMG_PNG:
				return 'PNG';
		}
	}



	function imageFormats()
	{
		if	( ! function_exists( 'imagetypes' ) )
			return array();

		$types    = imagetypes();
		$formats  = array( IMG_GIF => 'gif',
		                   IMG_JPG => 'jpeg',
		                   IMG_PNG => 'png' );
		$formats2 = $formats;		

		foreach( $formats as $b=>$f )
			if	( !($types & $b) )
				unset( $formats2[$b] );

		return $formats2;
	}


	/**
	 * Bildgroesse eines Bildes aendern
	 */
	function resize()
	{
		$width           = intval($this->getRequestVar('width'           ));
		$height          = intval($this->getRequestVar('height'          ));
		$jpegcompression =        $this->getRequestVar('jpeg_compression') ;
		$format          =        $this->getRequestVar('format'          ) ;
		$factor          =        $this->getRequestVar('factor'          ) ;
		
		if	( $this->getRequestVar('type') == 'input' &&
			  ! $this->hasRequestVar('width' )      &&
			  ! $this->hasRequestVar('height') )
		{
			$this->addValidationError('width','INPUT_NEW_IMAGE_SIZE' );
			$this->addValidationError('height','');
			$this->callSubAction('size');
			return;
		}
		
		if	( $this->hasRequestVar('copy') )
		{
			// Datei neu anlegen.
			$imageFile = new File($this->file->objectid);
			$imageFile->load();
			$imageFile->name       = lang('copy_of').' '.$imageFile->name;
			$imageFile->desription = lang('copy_of').' '.$imageFile->description;
			$imageFile->filename   = $imageFile->filename.'_resized_'.time();
			$imageFile->add();
			$imageFile->copyValueFromFile( $this->file->objectid );
		}
		else
		{
			$imageFile = $this->file;
		}
		
		if	( $this->getRequestVar('type') == 'factor')
		{
			$width  = 0;
			$height = 0;
		}
		else
		{
			$factor = 1;
		}

		$imageFile->write();
		
		$imageFile->imageResize( intval($width),intval($height),$factor,$this->imageFormat(),$format,$jpegcompression );
		$imageFile->setTimestamp();
		$imageFile->save();      // Um z.B. Groesse abzuspeichern
		$imageFile->saveValue();

		$this->addNotice($imageFile->getType(),$imageFile->name,'IMAGE_RESIZED','ok');
	}


	function prop()
	{
		global $conf;
		
		if	( $this->file->filename == $this->file->objectid )
			$this->file->filename = '';

		// Eigenschaften der Datei uebertragen
		$this->setTemplateVars( $this->file->getProperties() );
	}


	function showprop()
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
			$o = new Object( $id );
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
	function edit()
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
	function editvalue()
	{
		global $conf;
		// MIME-Types aus Datei lesen
		$this->setTemplateVars( $this->file->getProperties() );
		$this->setTemplateVar('value',$this->file->loadValue());
	}


	/**
	 * Anzeigen des Inhaltes
	 */
	function size()
	{
		$this->setTemplateVars( $this->file->getProperties() );
		
		$format = $this->imageFormat();

		if	( $format != 0 )
			$formats = $this->imageFormats();
		else
			$formats = array();

		$sizes = array();
		foreach( array(10,25,50,75,100,125,150,175,200,250,300,350,400,500,600,800) as $s )
			$sizes[strval($s/100)] = $s.'%';
			
		$jpeglist = array();
		for ($i=10; $i<=95; $i+=5)
			$jpeglist[$i]=$i.'%';

		$this->setTemplateVar('factors'       ,$sizes      );
		$this->setTemplateVar('jpeglist'      ,$jpeglist   );
		$this->setTemplateVar('formats'       ,$formats    );
		$this->setTemplateVar('format'        ,$format     );
		$this->setTemplateVar('factor'        ,1           );
		
		$this->file->getImageSize();
		$this->setTemplateVar('width' ,$this->file->width  );
		$this->setTemplateVar('height',$this->file->height );
		$this->setTemplateVar('type'  ,'input'             );
	}


	/**
	 * Anzeigen des Inhaltes
	 */
	function extract()
	{
		$this->setTemplateVars( $this->file->getProperties() );
		
		$imageFormat = $this->imageFormat();
	}


	/**
	 * Anzeigen des Inhaltes
	 */
	function uncompress()
	{
	}


	/**
	 * Anzeigen des Inhaltes
	 */
	function compress()
	{
		$formats = array();
		foreach( $this->getCompressionTypes() as $t )
			$formats[$t] = lang('compression_'.$t);

		$this->setTemplateVar('formats'       ,$formats    );
	}


	/**
	 * Anzeigen des Inhaltes
	 */
	function douncompress()
	{
		switch( $this->file->extension )
		{
			case 'gz':
				if	( $this->getRequestVar('replace') )
				{
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
				die( 'cannot extract file with extension: '.$this->file->extension );
		}
		$this->callSubAction('edit');
	}



	/**
	 * Anzeigen des Inhaltes
	 */
	function doextract()
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
	function docompress()
	{
		$format = $this->getRequestVar('format');
		
		switch( $format )
		{
			case 'gz':
				if	( $this->getRequestVar('replace') )
				{
					$this->file->value = gzencode( $this->file->loadValue() );
					$this->file->parse_filename( $this->file->filename.'.'.$this->file->extension.'.gz' );
					$this->file->save();
					$this->file->saveValue();
					
				}
				else
				{
					$newFile = new File();
					$newFile->name     = $this->file->name;
					$newFile->parentid = $this->file->parentid;
					$newFile->value    = gzencode( $this->file->loadValue() );
					$newFile->parse_filename( $this->file->filename.'.'.$this->file->extension.'.gz' );
					$newFile->add();
				}
				
				break;

			case 'bzip2':
				if	( $this->getRequestVar('replace') )
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
				die( 'unknown extract type: '.$format );
		}
		
		$this->callSubAction('edit');
	}


	/**
	 * Datei ver?ffentlichen
	 */
	function pub()
	{
		$this->forward('file_pub');
	}


	/**
	 * Datei ver?ffentlichen
	 */
	function pubnow()
	{
		$this->file->publish();
		$this->file->publish->close();
		$this->addNotice('file',$this->file->fullFilename,'PUBLISHED'.($this->file->publish->ok?'':'_ERROR'),$this->file->publish->ok,array(),$this->file->publish->log);
		
		$this->callSubaction('pub');
	}



	function getCompressionTypes()
	{
		$compressionTypes = array();
		if	( function_exists('gzencode'    ) ) $compressionTypes[] = 'gz';
		if	( function_exists('gzencode'    ) ) $compressionTypes[] = 'zip';
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
				return in_array($this->file->extension,$compressionTypes);

			case 'compress':
				return !in_array($this->file->extension,$compressionTypes);

			case 'extract':
				return in_array($this->file->extension,$archiveTypes);

			case 'size':
				return $this->file->isImage();

			case 'editvalue':
				return substr($this->file->mimeType(),0,5)=='text/';
				
			default:
				return true;
		}
	}
}

?>