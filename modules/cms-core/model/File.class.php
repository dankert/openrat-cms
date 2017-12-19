<?php
namespace cms\model;
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


// Standard Mime-Type 
define('OR_FILE_DEFAULT_MIMETYPE','application/octet-stream');


/**
 * Datei.
 *
 * @author Jan Dankert
 * @package openrat.objects
 */
class File extends Object
{
	var $fileid;

	var $size          = 0;
	var $value         = '';
	var $extension     = '';
	var $log_filenames = array();
	var $fullFilename  = '';
	var $publish       = null;
	var $mime_type     = '';
	
	var $tmpfile;
	
	var $content_negotiation = false;



	/**
	 * Um Probleme mit BLOB-Feldern und Datenbank-Besonderheiten zu vermeiden,
	 * kann der Binaerinhalt BASE64-kodiert gespeichert werden.
	 * @type Boolean
	 */
	var $storeValueAsBase64 = false;



	/**
	 * Konstruktor
	 *
	 * @param Objekt-Id
	 */
	function __construct( $objectid='' )
	{
		global $conf;
		
		$db = \Session::getDatabase();
		$this->storeValueAsBase64 = $db->conf['base64'];

		parent::__construct( $objectid );
		$this->isFile = true;
	}



	/**
	  * Ermitteln des Dateinamens dieser Datei
	  *
	  * @return String Kompletter Dateiname, z.B. '/pfad/datei.jpeg'
	  */
	function full_filename()
	{
		if	( !empty($this->fullFilename) )
			return $this->fullFilename;

		$filename = parent::full_filename();

		if	( $this->content_negotiation && config('publish','negotiation','file_negotiate_type' ) )
		{
			// Link auf Datei: Extension bleibt aufgrund Content-Negotiation leer 
		}
		else
		{
			if	( !empty($this->extension) )
				$filename .= '.'.$this->extension;
		}

		$this->fullFilename = $filename;
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
		                    array('full_filename'=>$this->fullFilename,
		                          'extension'    =>$this->extension,
		                          'size'         =>$this->size,
		                          'mimetype'     =>$this->mimetype()   ) );
	}



	/**
	 * @deprecated
	 */
	function getFileObjectIdsByExtension( $extension )
	{
		global $SESS;
		$db = db_connection();
		
		$sqlquery = 'SELECT * FROM {{object}} ';

		if   ( $extension != '' )
		{
			$sqlquery .= " WHERE extension='";

			$ext = explode(',',$extension);
			$sqlquery .= implode( "' OR extension='",$ext );
			$sqlquery .= "' AND typeid=".OR_TYPEID_FILE." AND projectid={projectid}";
		}
		else
		{
			$sqlquery .= " WHERE typeid=".OR_TYPEID_FILE." AND projectid={projectid}";
		}

		$sql = $db->sql( $sqlquery );
		$sql->setInt( 'projectid',$SESS['projectid'] );
		
		return $sql->getCol();
	}



	/**
	  * Es werden Objekte zu einer Dateierweiterung ermittelt
	  *
	  * @param String Dateierweiterung ohne fuehrenden Punkt (z.B. 'jpeg')
	  * @return Array Liste der gefundenen Objekt-IDs
	  */
	function getObjectIdsByExtension( $extension )
	{
		$db = db_connection();
		
		$sql = $db->sql( 'SELECT {{file}}.objectid FROM {{file}} '.
		                ' LEFT JOIN {{object}} '.
		                '   ON {{object}}.id={{file}}.objectid'.
		                ' WHERE {{file}}.extension={extension}'.
		                '   AND {{object}}.projectid={projectid}' );
		$sql->setInt   ( 'projectid',$this->projectid );
		$sql->setString( 'extension',$extension       );
		
		return $sql->getCol();
	}



	/**
	 * Ermittelt den Mime-Type zu dieser Datei
	 *
	 * @return String Mime-Type  
	 */
	function mimeType()
	{
		if	( !empty( $this->mime_type ) )
			return $this->mime_type;

		global $conf;
		$mime_types = $conf['mime-types'];
		

		
		$ext = strtolower( $this->getRealExtension() );

		if	( !empty($mime_types[$ext]) )
			$this->mime_type = $mime_types[$ext];
		else
			// Wenn kein Mime-Type gefunden, dann Standartwert setzen
			$this->mime_type = OR_FILE_DEFAULT_MIMETYPE;
			
		return( $this->mime_type );
	}


	/**
	 * Lesen der Datei aus der Datenbank.
	 * 
	 * Es werden nur die Meta-Daten (Erweiterung, Gr��e) gelesen. Zum Lesen des
	 * Datei-Inhaltes muss #loadValue() aufgerufen werden.
	 */
	function load()
	{
		$db = db_connection();

		$sql = $db->sql( 'SELECT id,extension,size'.
		                ' FROM {{file}}'.
		                ' WHERE objectid={objectid}' );
		$sql->setInt( 'objectid',$this->objectid );
		$row = $sql->getRow();
		
		if	( count($row)!=0 )
		{
			$this->fileid    = $row['id'       ];
			$this->extension = $row['extension'];
			$this->size      = $row['size'     ];
		}
		
		$this->objectLoad();
	}



	/**
	 * Unwiderrufliches L�schen der Datei aus der Datenbank.
	 */
	function delete()
	{
		$db = db_connection();

		// Datei l?schen
		$sql = $db->sql( 'DELETE FROM {{file}} '.
		                '  WHERE objectid={objectid}' );
		$sql->setInt( 'objectid',$this->objectid );
		$sql->query();
		
		$this->objectDelete();
	}


	
	/**
	 * Stellt anhand der Dateiendung fest, ob es sich bei dieser Datei um ein Bild handelt
	 */
	function isImage()
	{
		return substr($this->mimeType(),0,6)=='image/';
	}

	

	/**
	 * Ermittelt die Datei-Endung.
	 * 
	 * @return String Datei-Endung
	 */
	function extension()
	{
		if ($this->extension != '')
			return $this->extension;

		$this->load();
		return $this->extension;
	}


	/**
	 * Einen Dateinamen in Dateiname und Extension aufteilen.
	 * @param filename Dateiname 
	 */
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


	/**
	 * Speichert die Datei-Informationen in der Datenbank.
	 */
	function save()
	{
		global $SESS;
		$db = db_connection();
		
		$sql = $db->sql( <<<EOF
UPDATE {{file}} SET
  size      = {size},
  extension = {extension}
  WHERE objectid={objectid}
EOF
);
		$sql->setString('size'     ,$this->size      );
		$sql->setString('extension',$this->extension );
		$sql->setString('objectid' ,$this->objectid  );
		$sql->query();
		
		$this->objectSave();
	}


	/**
	 * Kopieren des Inhaltes von einer anderen Datei
	 * @param ID der Datei, von der der Inhalt kopiert werden soll
	 */
	function copyValueFromFile( $otherfileid )
	{
		$of = new File( $otherfileid );
		$this->value = $of->loadValue();
		$this->saveValue();
	}


	/**
	 * Lesen des Inhaltes der Datei aus der Datenbank.
	 * 
	 * @return String Inhalt der Datei
	 */
	function loadValue()
	{
		if	( is_file($this->tmpfile()))
			return implode('',file($this->tmpfile())); // From cache

		$db = db_connection();

		$sql = $db->sql( 'SELECT size,value'.
		                ' FROM {{file}}'.
		                ' WHERE objectid={objectid}' );
		$sql->setInt( 'objectid',$this->objectid );
		$row = $sql->getRow();
		
		if	( count($row) != 0 )
		{
			$this->value = $row['value'];
			$this->size  = $row['size' ];
		}

		if	( $this->storeValueAsBase64 )
			$this->value = base64_decode( $this->value );

		// Store in cache.
		$f = fopen( $this->tmpfile(),'w' );
		fwrite( $f,$this->value );
		fclose( $f );
		
		return $this->value;
	}


	/**
	 * Speichert den Inhalt in der Datenbank.
	 */
	function saveValue( $value = '' )
	{
		if	( is_file($this->tmpfile()) )
			@unlink( $this->tmpfile() );

		$db = db_connection();

		$sql = $db->sql( 'UPDATE {{file}}'.
		                ' SET value={value}, '.
		                '      size={size}   '.
		                ' WHERE objectid={objectid}' );
		$sql->setString( 'objectid' ,$this->objectid      );
		$sql->setInt   ( 'size'     ,strlen($this->value) );
		
		if	( $this->storeValueAsBase64 )
			$sql->setString( 'value',base64_encode($this->value) );
		else
			$sql->setString( 'value',$this->value );

		$sql->query();
	}


	/**
	 * Lesen der Datei aus der Datenbank und schreiben in temporaere Datei
	 */
	function write()
	{
		if	( !is_file($this->tmpfile()) )
			$this->loadValue();
	}


	/**
	 * F�gt die Datei der Datenbank hinzu.
	 */
	function add()
	{
		$db = db_connection();

		$this->objectAdd();
		
		$sql = $db->sql('SELECT MAX(id) FROM {{file}}');
		$this->fileid = intval($sql->getOne())+1;

		$sql = $db->sql('INSERT INTO {{file}}'.
		               ' (id,objectid,extension,size,value)'.
		               " VALUES( {fileid},{objectid},{extension},0,'' )" );
		$sql->setInt   ('fileid'   ,$this->fileid        );
		$sql->setInt   ('objectid' ,$this->objectid      );
		$sql->setString('extension',$this->extension     );

		$sql->query();
		
		$this->saveValue();
	}	


	function publish()
	{
		if	( ! is_object($this->publish) )
			$this->publish = new \Publish();

		$this->write();
		$this->publish->copy( $this->tmpfile(),$this->full_filename(),$this->lastchangeDate );
		
		$this->publish->publishedObjects[] = $this->getProperties();
	}
	

	/**
	 * Ermittelt einen tempor�ren Dateinamen f�r diese Datei.
	 */
	function tmpfile()
	{
		if	( $this->tmpfile == '' )
		{
			$db = db_connection();
			$this->tmpfile = $this->getTempFileName( array('db'=>$db->id,'o'.$this->objectid) );
		}
		return $this->tmpfile;
	}

	
	/**
	 * Setzt den Zeitstempel der Datei auf die aktuelle Zeit.
	 * 
	 * @see objectClasses/Object#setTimestamp()
	 */
	
	function setTimestamp()
	{
		@unlink( $this->tmpfile() );
		
		parent::setTimestamp();
	}
	

	
	/**
	 * Ermittelt die wirksame Datei-Endung. Diese kann sich
	 * in der Extra-Dateiendung, aber auch direkt im Dateiname
	 * befinden.
	 * 
	 * @return Dateiendung
	 */
	function getRealExtension() 
	{
		if	( !empty($this->extension))
		{
			return $this->extension;
		}
		else
		{
			$pos = strrpos($this->filename,'.');
			if	( $pos === false )
				return '';
			else
				return substr($this->filename,$pos+1);
		}
	}
}

?>