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
// Revision 1.4  2004-11-28 21:28:05  dankert
// Bildbearbeitung erweitert
//
// Revision 1.3  2004/11/10 22:45:24  dankert
// *** empty log message ***
//
// Revision 1.2  2004/05/02 14:41:31  dankert
// Einf?gen package-name (@package)
//
// Revision 1.1  2004/04/24 15:15:12  dankert
// Initiale Version
//
// Revision 1.1  2003/10/27 23:21:55  dankert
// Methode(n) hinzugef?gt: savevalue(), save()
//
// ---------------------------------------------------------------------------


/**
 * Darstellen einer Datei
 *
 * @version $Revision$
 * @author $Author$
 * @package openrat.objects
 */
class File extends Object
{
	var $fileid;

	var $size  = 0;
	var $value = '';
	var $extension     = '';
	var $log_filenames = array();
	var $publish = null;
	
	/**
	 * Um Probleme mit BLOB-Feldern und Datenbank-Besonderheiten zu vermeiden,
	 * kann der Bin?rinhalt BASE64-kodiert gespeichert werden.
	 * @type Boolean
	 */
	var $storeValueAsBase64 = false;

	function File( $objectid='' )
	{
		global $conf,$SESS;
		
		$db = Session::getDatabase();
		$this->storeValueAsBase64 = $db->conf['base64'];

		$this->Object( $objectid );
		$this->isFile = true;
	}


	/**
	  * Ermitteln des Dateinamens dieser Datei
	  *
	  * @return String Kompletter Dateiname, z.B. '/pfad/datei.jpeg'
	  */
	function full_filename()
	{
		$filename = parent::full_filename();

		if	( $this->extension != '' )
		{
			$filename .= '.'.$this->extension;
		}

		return $filename;
	}


	/**
	  * Ermitteln des Dateinamens dieser Datei (ohne Pfadangabe)
	  *
	  * @return String Kompletter Dateiname, z.B. '/pfad/datei.jpeg'
	  */
	function filenameWithExtension()
	{
		if	( $this->extension != '' )
			return $this->filename.'.'.$this->extension;
		else	return $this->filename;
	}


	/**
	  * Ermitteln aller Eigenschaften
	  *
	  * @return Array
	  */
	function getProperties()
	{
		return array_merge( parent::getProperties(),
		                    Array('full_filename'=>$this->full_filename(),
		                          'extension'    =>$this->extension,
		                          'size'         =>$this->size,
		                          'mimetype'     =>$this->mimetype()   ) );
	}


	function getFileObjectIdsByExtension( $extension )
	{
		global $SESS;
		$db = db_connection();
		
		$sqlquery = 'SELECT * FROM {t_object} ';

		if   ( $extension != '' )
		{
			$sqlquery .= " WHERE extension='";

			$ext = explode(',',$extension);
			$sqlquery .= implode( "' OR extension='",$ext );
			$sqlquery .= "' AND is_file=1 AND projectid={projectid}";
		}
		else
		{
			$sqlquery .= " WHERE is_file=1 AND projectid={projectid}";
		}

		$sql = new Sql( $sqlquery );
		$sql->setInt( 'projectid',$SESS['projectid'] );
		
		return $db->getCol( $sql->query );
	}


	/**
	  * Es werden Objekte zu einer Dateierweiterung ermittelt
	  * @param String Dateierweiterung ohne f?hrenden Punkt (z.B. 'jpeg')
	  * @return Array Liste der gefundenen Objekt-IDs
	  */
	function getObjectIdsByExtension( $extension )
	{
		$db = db_connection();
		
		$sql = new Sql( 'SELECT {t_file}.objectid FROM {t_file} '.
		                ' LEFT JOIN {t_object} '.
		                '   ON {t_object}.id={t_file}.objectid'.
		                ' WHERE {t_file}.extension={extension}'.
		                '   AND {t_object}.projectid={projectid}' );
		$sql->setInt   ( 'projectid',$this->projectid );
		$sql->setString( 'extension',$extension       );
		
		return $db->getCol( $sql->query );
	}


	function mimeType()
	{
		global $conf_languagedir,$conf_php;
		$mime_types = parse_ini_file( "$conf_languagedir/mime-types.ini.$conf_php" );

		if	( isset($mime_types[ strtolower($this->extension) ]) )
			$mime = $mime_types[ strtolower($this->extension) ];
		else	$mime = 'application/octet-stream';
			
		return( $mime );
	}


	function imageResize( $newWidth,$newHeight,$format,$jpegquality )
	{
		global $conf;

		// Schalter, ob GD in Version 2 verfuegbar ist
		$gd2 = $conf['gd']['version2'];
		
		$this->write(); // Datei schreiben
		
		// Bildinformationen ermitteln
		$size = getimagesize( $this->tmpfile() );

		// Breite und Hoehe des aktuellen Bildes	 
		$oldWidth  = $size[0]; 
		$oldHeight = $size[1];
		$aspectRatio = $oldHeight / $oldWidth; // Seitenverhaeltnis

		// Wenn Breite und Hoehe fehlen, dann Bildgroesse beibehalten
		if	( $newWidth == 0 && $newHeight == 0)
		{
			$newWidth  = $oldWidth; 
			$newHeight = $oldHeight;
			$resizing = false;
		}
		else
		{
			$resizing = true;
		}

		// Wenn nur Breite oder Hoehe angegeben ist, dann
		// das Seitenverhaeltnis beibehalten
		if	( $newWidth == 0 )
			$newWidth = $newHeight / $aspectRatio; 
		
		if	( $newHeight == 0 )
			$newHeight = $newWidth * $aspectRatio; 


		switch( strtolower($this->extension) )
		{
			case 'gif': // GIF

				$oldImage = ImageCreateFromGIF( $this->tmpfile ); 
				break;

			case 'jpg':
			case 'jpeg': // JPEG

				$oldImage = ImageCreateFromJPEG($this->tmpfile);
				break;

			case 'png': // PNG

				$oldImage = imagecreatefrompng($this->tmpfile);
				break;

			default:
				die('unsupported image format "'.$this->extension.'", cannot load image. resize failed');
		}


		switch( $format )
		{
			case 'gif': // GIF

				if	( $resizing )
				{
					$newImage = ImageCreate($newWidth,$newHeight); 
					ImageCopyResized($newImage,$oldImage,0,0,0,0,$newWidth,
						$newHeight,$oldWidth,$oldHeight); 
				}
				else
				{
					$newImage = $oldImage;
				} 

				ImageGIF($newImage, $this->tmpfile() );
				$this->extension = 'gif';

				break;

			case 'jpg':
			case 'jpeg': // JPEG

				if	( !$resizing )
				{
					$newImage = $oldImage;
				} 
				elseif   ( $gd2 )
				{
					// Verwende TrueColor
					$newImage = imageCreateTrueColor( $newWidth,$newHeight );
	
					ImageCopyResampled($newImage,$oldImage,0,0,0,0,$newWidth,
					$newHeight,$oldWidth,$oldHeight);
				}
				else
				{
					// GD Version 1.x unterstuetzt kein TrueColor
					$newImage = ImageCreate($newWidth,$newHeight);
	
					ImageCopyResized($newImage,$oldImage,0,0,0,0,$newWidth,
					$newHeight,$oldWidth,$oldHeight);
				}
	
				ImageJPEG($newImage, $this->tmpfile,$jpegquality ); 
				$this->extension = 'jpeg';

				break;

			case 'png': // PNG

				if	( !$resizing )
				{
					$newImage = $oldImage;
				} 
				elseif   ( $gd2 )
				{
					// Verwende TrueColor
					$newImage = imageCreateTrueColor( $newWidth,$newHeight );
		
					ImageCopyResampled($newImage,$oldImage,0,0,0,0,$newWidth,
					$newHeight,$oldWidth,$oldHeight); 
				}
				else
				{
					// GD Version 1.x unterstuetzt kein TrueColor
					$newImage = ImageCreate($newWidth,$newHeight);
		
					ImageCopyResized($newImage,$oldImage,0,0,0,0,$newWidth,
					$newHeight,$oldWidth,$oldHeight); 
				}
		
				imagepng( $newImage,$this->tmpfile() );
				$this->extension = 'png';
				
				break;
				
			default:
				die('unsupported image format "'.$format.'", cannot resize');
		} 

		$f = fopen( $this->tmpfile(), "r" );
		$this->value = fread( $f,filesize($this->tmpfile()) );
		fclose( $f );
	}


	// Lesen der Datei aus der Datenbank
	function load()
	{
		$db = db_connection();

		$sql = new Sql( 'SELECT id,extension,size'.
		                ' FROM {t_file}'.
		                ' WHERE objectid={objectid}' );
		$sql->setInt( 'objectid',$this->objectid );
		$row = $db->getRow( $sql->query );

		$this->fileid    = $row['id'       ];
		$this->extension = $row['extension'];
		$this->size      = $row['size'     ];
		
		$this->objectLoad();
	}



	function delete()
	{
		$db = db_connection();

		// Datei l?schen
		$sql = new Sql( 'DELETE FROM {t_file} '.
		                '  WHERE objectid={objectid}' );
		$sql->setInt( 'objectid',$this->objectid );
		$db->query( $sql->query );
		
		$this->objectDelete();
	}


	/**
	 * Stellt anhand der Dateiendung fest, ob es sich bei dieser Datei um ein Bild handelt
	 */
	function isImage()
	{
		//return eregi('jpe?g|png|gif',$this->extension);
		return substring($this->mimeType(),0,6)=='image/';
	}


	function extension()
	{
		if ($this->extension != '')
			return $this->extension;

		$this->load();
		return $this->extension;
	}


	// Einen Dateinamen in Dateiname und Extension aufteilen
	function parse_filename($filename)
	{
		$filename = basename($filename);

		$p = strrpos($filename, '.');
		if ($p !== false)
		{
			$this->extension = substr($filename, $p +1);
			$this->filename = substr($filename, 0, $p);
		}
		else
		{
			$this->extension = '';
			$this->filename = $filename;
		}
	}


	function save()
	{
		global $SESS;
		$db = db_connection();
		
		$sql = new Sql('UPDATE {t_file} SET '.
		               '  size      = {size},'.
		               '  extension = {extension}'.
		               ' WHERE objectid={objectid}' );
		$sql->setString('size'     ,$this->size      );
		$sql->setString('extension',$this->extension );
		$sql->setString('objectid' ,$this->objectid  );
		$db->query( $sql->query );
		
		$this->objectSave();
	}


	/**
	 * Kopieren des Inhaltes von einer anderen Datei
	 * @param ID der Datei, von der der Inhalt kopiert werden soll
	 */
	function copyValueFromFile( $otherfileid )
	{
		$of = new File( $otherfileid );
		$this->value = &$of->loadValue();
		$this->saveValue();
	}


	// Lesen der Datei aus der Datenbank
	function loadValue()
	{
		$db = db_connection();

		$sql = new Sql( 'SELECT size,value'.
		                ' FROM {t_file}'.
		                ' WHERE objectid={objectid}' );
		$sql->setInt( 'objectid',$this->objectid );
		$row = $db->getRow( $sql->query );
		
		$this->value = $row['value'];
		$this->size  = $row['size' ];

		if	( $this->storeValueAsBase64 )
			$this->value = base64_decode( $this->value );
		
		return( $this->value );
	}


	// Lesen der Datei aus der Datenbank
	function saveValue( $value = '' )
	{
		$db = db_connection();

		$sql = new Sql( 'UPDATE {t_file}'.
		                ' SET value={value}, '.
		                '      size={size}   '.
		                ' WHERE objectid={objectid}' );
		$sql->setString( 'objectid' ,$this->objectid      );
		$sql->setInt   ( 'size'     ,strlen($this->value) );
		
		if	( $this->storeValueAsBase64 )
			$sql->setString( 'value'    ,base64_encode($this->value) );
		else $sql->setString( 'value'    ,$this->value );

		$db->query( $sql->query );
	}


	// Lesen der Datei aus der Datenbank und schreiben in temporaere Datei
	function write()
	{
		$f = fopen( $this->tmpfile(),'w' );
		fwrite( $f,$this->loadValue() );
		fclose( $f );
	}


	function add()
	{
		$db = db_connection();

		$this->objectAdd();
		
		$sql = new Sql('SELECT MAX(id) FROM {t_file}');
		$this->fileid = intval($db->getOne($sql->query))+1;

		$sql = new Sql('INSERT INTO {t_file}'.
		               ' (id,objectid,extension,size,value)'.
		               " VALUES( {fileid},{objectid},{extension},0,'' )" );
		$sql->setInt   ('fileid'   ,$this->fileid        );
		$sql->setInt   ('objectid' ,$this->objectid      );
		$sql->setString('extension',$this->extension     );

		$db->query( $sql->query );
		
		$this->saveValue();
	}	


	function publish()
	{
		if	( ! is_object($this->publish) )
			$this->publish = new Publish();

		$this->write();
		$this->publish->copy( $this->tmpfile(),$this->full_filename() );

//		$this->log_filenames = $this->publish->log_filenames;
	}
}

?>