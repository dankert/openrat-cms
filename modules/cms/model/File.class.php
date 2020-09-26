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
use cms\base\DB as Db;
use cms\generator\filter\AbstractFilter;
use cms\generator\PublishPublic;
use logger\Logger;
use util\cache\FileCache;

define('OR_FILE_DEFAULT_MIMETYPE','application/octet-stream');


/**
 * Datei.
 *
 * @author Jan Dankert
 * @package openrat.objects
 */
class File extends BaseObject
{
	var $fileid;

	var $size          = 0;
	var $value         = '';
	var $extension     = '';
	var $log_filenames = array();
	var $fullFilename  = '';

	var $mime_type     = '';

	var $tmpfile;


	/**
	 * Um Probleme mit BLOB-Feldern und Datenbank-Besonderheiten zu vermeiden,
	 * kann der Binaerinhalt BASE64-kodiert gespeichert werden.
	 * @type Boolean
	 */
	var $storeValueAsBase64 = false;

    public $filterid;

    /**
	 * Konstruktor
	 *
	 * @param Objekt-Id
	 */
	function __construct( $objectid='' )
	{
		$this->storeValueAsBase64 = DB::get()->conf['base64'];

		parent::__construct( $objectid );
		$this->isFile = true;
		$this->typeid = BaseObject::TYPEID_FILE;
    }


    /**
     * @return FileCache
     */
    public function getCache() {
        $cacheKey = array('db'=>DB::get()->id,'file'=>$this->objectid,'publish'=> \util\ClassUtils::getSimpleClassName($this->publisher));

        return new FileCache( $cacheKey,function() {
            return $this->loadValueFromDatabase();
        }, $this->lastchangeDate );
    }



	/**
	  * Ermitteln aller Eigenschaften.
	  *
	  * @return array
	  */
	function getProperties()
	{
		return array_merge( parent::getProperties(),
		                    array('full_filename'=>$this->fullFilename,
		                          'extension'    =>$this->extension,
		                          'size'         =>$this->size,
		                          'filterid'     =>$this->filterid,
		                          'mimetype'     =>$this->mimetype()   ) );
	}



	/**
	 * @deprecated
	 */
	function getFileObjectIdsByExtension( $extension )
	{
		global $SESS;
		$db = \cms\base\DB::get();

		$sqlquery = 'SELECT * FROM {{object}} ';

		if   ( $extension != '' )
		{
			$sqlquery .= " WHERE extension='";

			$ext = explode(',',$extension);
			$sqlquery .= implode( "' OR extension='",$ext );
			$sqlquery .= "' AND typeid=".BaseObject::TYPEID_FILE." AND projectid={projectid}";
		}
		else
		{
			$sqlquery .= " WHERE typeid=".BaseObject::TYPEID_FILE." AND projectid={projectid}";
		}

		$sql = $db->sql( $sqlquery );
		$sql->setInt( 'projectid',$SESS['projectid'] );

		return $sql->getCol();
	}



	/**
	  * Es werden Objekte zu einer Dateierweiterung ermittelt
	  *
	  * @param String Dateierweiterung ohne fuehrenden Punkt (z.B. 'jpeg')
	  * @return array Liste der gefundenen Objekt-IDs
	  */
	public static function getObjectIdsByExtension( $extension )
	{
		$db = \cms\base\DB::get();

		$sql = $db->sql( 'SELECT {{file}}.objectid FROM {{file}} '.
		                ' LEFT JOIN {{object}} '.
		                '   ON {{object}}.id={{file}}.objectid'.
		                ' WHERE {{file}}.extension={extension}' );
		$sql->setString( 'extension',$extension       );

		return $sql->getCol();
	}



	/**
	 * Ermittelt den Mime-Type zu dieser Datei
	 *
	 * @return String Mime-Type
	 */
	public function mimeType()
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
	public function load()
	{
		$db = \cms\base\DB::get();

		$sql = $db->sql( 'SELECT id,extension,size,filterid'.
		                ' FROM {{file}}'.
		                ' WHERE objectid={objectid}' );
		$sql->setInt( 'objectid',$this->objectid );
		$row = $sql->getRow();

		if	( count($row)!=0 )
		{
			$this->fileid    = $row['id'       ];
			$this->extension = $row['extension'];
			$this->size      = $row['size'     ];
			$this->filterid  = $row['filterid' ];
		}

		$this->objectLoad();

		return $this;
	}



	/**
	 * Unwiderrufliches L�schen der Datei aus der Datenbank.
	 */
	function delete()
	{
		$db = \cms\base\DB::get();

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
	public function save()
	{
		$db = \cms\base\DB::get();

		$sql = $db->sql( <<<EOF
UPDATE {{file}} SET
  size      = {size},
  filterid  = {filterid},
  extension = {extension}
  WHERE objectid={objectid}
EOF
);
		$sql->setString('size'     ,$this->size      );
		$sql->setString('extension',$this->extension );
		$sql->setString('objectid' ,$this->objectid  );
		$sql->setInt   ('filterid' ,$this->filterid  );
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


    public function loadValue()
    {
        if	( is_file( $this->getCache()->getFilename() ) && filemtime($this->getCache()->getFilename() < $this->lastchangeDate))
            $this->getCache()->invalidate();

        return $this->getCache()->get();
    }


        /**
	 * Lesen des Inhaltes der Datei aus der Datenbank.
	 *
	 * @return String Inhalt der Datei
	 */
	private function loadValueFromDatabase()
	{
	    // Read from cache, if cache exist and is not too old.

		$settings    = $this->getSettings();
		$proxyFileId = @$settings['proxy-file-id'];

		if   ( $proxyFileId )
			$objectid = $proxyFileId; // This is a proxy for another file.
		else
			$objectid = $this->objectid;

		$sql = Db::sql( 'SELECT size,value'.
		                ' FROM {{file}}'.
		                ' WHERE objectid={objectid}' );
		$sql->setInt( 'objectid', $objectid);
		$row = $sql->getRow();

		if	( count($row) != 0 )
		{
			$this->value = $row['value'];
			$this->size  = $row['size' ];
		}

		if	( $this->storeValueAsBase64 )
			$this->value = base64_decode( $this->value );

        $this->filterValue();

		return $this->value;
	}


	/**
	 * Speichert den Inhalt in der Datenbank.
	 */
	function saveValue( $value = '' )
	{
		$this->getCache()->invalidate();

		$db = \cms\base\DB::get();

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
	    $this->getCache()->load();
	}


	/**
	 * F�gt die Datei der Datenbank hinzu.
	 */
	function add()
	{
		parent::add();

		$sql = Db::sql('SELECT MAX(id) FROM {{file}}');
		$this->fileid = intval($sql->getOne())+1;

		$sql = Db::sql('INSERT INTO {{file}}'.
		               ' (id,objectid,extension,size,value)'.
		               " VALUES( {fileid},{objectid},{extension},0,'' )" );
		$sql->setInt   ('fileid'   ,$this->fileid        );
		$sql->setInt   ('objectid' ,$this->objectid      );
		$sql->setString('extension',$this->extension     );

		$sql->query();

		$this->saveValue();
	}


	/**
	 * Setzt den Zeitstempel der Datei auf die aktuelle Zeit.
	 *
	 * @see objectClasses/Object#setTimestamp()
	 */

	function setTimestamp()
	{
        $this->getCache()->invalidate();

		parent::setTimestamp();
	}




	/**
	 * Change type.
	 *
	 * This is only allowed for files, because it is only allowed to switch between the following types: file,image,text.
	 */
	public function updateType()
	{

		$stmt = Db::sql(<<<SQL
UPDATE {{object}} SET 
      typeid = {typeid}
WHERE id={objectid}
SQL
		);

		$stmt->setInt('typeid'  , $this->typeid  );
		$stmt->setInt('objectid', $this->objectid);
		$stmt->query();
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
		if	( $this->extension )
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

    private function filterValue()
    {
        $publishType = strtolower(substr(\util\ClassUtils::getSimpleClassName($this->publisher),7));

        foreach(\util\ArrayUtils::getSubArray($this->getTotalSettings(), array( 'filter')) as $filterEntry )
        {
        	$filterName = @$filterEntry['name'];
        	$extension  = @$filterEntry['extension'];

			if   ( $extension && strtolower($extension) != strtolower($this->getRealExtension()) )
        		continue; // File extension does not match

        	$onPublish = (array) @$filterEntry['on'];
        	if ( ! $onPublish || in_array('all',$onPublish ) )
        		$onPublish = ['edit','public','preview','show'];

        	if   ( $onPublish && ! in_array($publishType,$onPublish))
        		continue; // Publish type does not match

        	$parameter = (array) @$filterEntry['parameter'];

			$filterClassNameWithNS = 'cms\\publish\\filter\\' . $filterName.'Filter';

			if   ( !class_exists( $filterClassNameWithNS ) ) {
				Logger::warn("Filter '$filterName' does not exist.");
				continue;
			}

			/** @var AbstractFilter $filter */
			$filter = new $filterClassNameWithNS();

			// Copy filter configuration to filter instance.
			foreach( $parameter as $name=>$value) {
				if   ( property_exists($filter,$name))
					$filter->$name = $value;
			}


			// Execute the filter.
			Logger::debug("Filtering '$this->filename' with filter '$filterName'.");

			try {

				$this->value = $filter->filter( $this->value );
			} catch( \Exception $e ) {
				// Filter has some undefined error.
				Logger::warn( $e->getTraceAsString() );
				if   ( $this->publisher instanceof PublishPublic )
					return ''; // Do not show errors on public publishing.
				else
					return $e->getMessage()."\n".$e->getTraceAsString();
			}
        }

        // Store in cache.
        $this->getCache()->invalidate();
    }



    public function getSize()
	{
		return $this->size;
	}
}

?>