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
use cms\base\Configuration;
use cms\base\DB as Db;
use cms\generator\filter\AbstractFilter;
use logger\Logger;
use util\cache\FileCache;


/**
 * File.
 *
 * @author Jan Dankert
 */
class File extends BaseObject
{
	const DEFAULT_MIMETYPE = 'application/octet-stream';

	public $fileid;

	public $size          = 0;
	public $value         = '';
	public $extension     = '';
	public $log_filenames = array();
	public $fullFilename  = '';

	public $mime_type     = '';

	public $tmpfile;


	public static $MIME_TYPES = [
		'ez' => 'application/andrew-inset',
		'csm' => 'application/cu-seeme',
		'cu' => 'application/cu-seeme',
		'tsp' => 'application/dsptype',
		'spl' => 'application/x-futuresplash ',
		'cpt' => 'image/x-corelphotopaint',
		'hqx' => 'application/mac-binhex40',
		'nb' => 'application/mathematica',
		'mdb' => 'application/msaccess',
		'doc' => 'application/msword',
		'dot' => 'application/msword',
		'bin' => 'application/octet-stream',
		'oda' => 'application/oda',
		'pdf' => 'application/pdf',
		'pgp' => 'application/pgp-signature',
		'ps' => 'application/postscript',
		'ai' => 'application/postscript',
		'eps' => 'application/postscript',
		'rtf' => 'text/rtf',
		'smi' => 'application/smil',
		'smil' => 'application/smil',
		'xls' => 'application/vnd.ms-excel',
		'xlb' => 'application/vnd.ms-excel',
		'ppt' => 'application/vnd.ms-powerpoint',
		'pps' => 'application/vnd.ms-powerpoint',
		'pot' => 'application/vnd.ms-powerpoint',
		'sdw' => 'application/vnd.stardivision.writer',
		'sgl' => 'application/vnd.stardivision.writer-global',
		'vor' => 'application/vnd.stardivision.writer',
		'sdc' => 'application/vnd.stardivision.calc',
		'sda' => 'application/vnd.stardivision.draw',
		'sdd' => 'application/vnd.stardivision.impress',
		'sdp' => 'application/vnd.stardivision.impress-packed',
		'smf' => 'application/vnd.stardivision.math',
		'sds' => 'application/vnd.stardivision.chart',
		'smd' => 'application/vnd.stardivision.mail',
		'wbxml' => 'application/vnd.wap.wbxml ',
		'wmlc' => 'application/vnd.wap.wmlc',
		'wmlsc' => 'application/vnd.wap.wmlscriptc',
		'wp5' => 'application/wordperfect5.1',
		'zip' => 'application/zip',
		'wk' => 'application/x-123',
		'bcpio' => 'application/x-bcpio',
		'vcd' => 'application/x-cdlink ',
		'pgn' => 'application/x-chess-pgn',
		'cpio' => 'application/x-cpio',
		'csh' => 'text/x-csh',
		'deb' => 'application/x-debian-package',
		'dcr' => 'application/x-director',
		'dir' => 'application/x-director',
		'dxr' => 'application/x-director',
		'wad' => 'application/x-doom',
		'dms' => 'application/x-dms',
		'dvi' => 'application/x-dvi',
		'pfa' => 'application/x-font',
		'pfb' => 'application/x-font',
		'gsf' => 'application/x-font',
		'pcf' => 'application/x-font',
		'gnumeric' => 'application/x-gnumeric',
		'gtar' => 'application/x-gtar',
		'tgz' => 'application/x-gtar',
		'taz' => 'application/x-gtar',
		'hdf' => 'application/x-hdf',
		'phtml' => 'text/html',
		'pht' => 'text/html',
		'php' => 'text/html',
		'phps' => 'text/html',
		'php3' => 'text/html',
		'php3p' => 'text/html ',
		'php4' => 'text/html',
		'docbook' => 'application/docbook+xml',
		'ica' => 'application/x-ica',
		'jar' => 'application/x-java-archive',
		'jnlp' => 'application/x-java-jnlp-file',
		'ser' => 'application/x-java-serialized-object',
		'class' => 'application/x-java-vm',
		'js' => 'application/x-javascript',
		'chrt' => 'application/x-kchart',
		'kil' => 'application/x-killustrator',
		'kpr' => 'application/x-kpresenter',
		'kpt' => 'application/x-kpresenter',
		'skp' => 'application/x-koan ',
		'skd' => 'application/x-koan ',
		'skt' => 'application/x-koan ',
		'skm' => 'application/x-koan ',
		'ksp' => 'application/x-kspread',
		'kwd' => 'application/x-kword',
		' kwt' => 'application/x-kword',
		'latex' => 'application/x-latex',
		'lha' => 'application/x-lha',
		'lzh' => 'application/x-lzh',
		'lzx' => 'application/x-lzx',
		'frm' => 'fbdocapplication/x-maker',
		'maker' => 'fbdocapplication/x-maker',
		'frame' => 'fbdocapplication/x-maker',
		'fm' => 'fbdocapplication/x-maker',
		'fb' => 'fbdocapplication/x-maker',
		'book' => 'fbdocapplication/x-maker',
		'mif' => 'application/x-mif',
		'com' => 'application/x-msdos-program',
		'exe' => 'application/x-msdos-program',
		'bat' => 'application/x-msdos-program',
		'dll' => 'application/x-msdos-program',
		'msi' => 'application/x-msi',
		'nc' => 'application/x-netcdf',
		'cdf' => 'application/x-netcdf',
		'pac' => 'application/x-ns-proxy-autoconfig',
		'o' => 'application/x-object',
		'ogg' => 'application/x-ogg',
		'oza' => 'application/x-oz-application',
		'pl' => 'application/x-perl',
		'pm' => 'application/x-perl',
		'crl' => 'application/x-pkcs7-crl',
		'rpm' => 'audio/x-pn-realaudio-plugin ',
		'shar' => 'application/x-shar',
		'swf' => 'application/x-shockwave-flash',
		'swfl' => 'application/x-shockwave-flash',
		'sh' => 'text/x-sh',
		'sit' => 'application/x-stuffit',
		'sv4cpio' => 'application/x-sv4cpio',
		'sv4crc' => 'application/x-sv4crc',
		'tar' => 'application/x-tar',
		'tcl' => 'text/x-tcl',
		'tex' => 'text/x-tex',
		'gf' => 'application/x-tex-gf',
		'pk' => 'application/x-tex-pk',
		'texinfo' => 'application/x-texinfo',
		'texi' => 'application/x-texinfo',
		'; "~"' => 'application/x-trash',
		';"%"' => 'application/x-trash',
		'bak' => 'application/x-trash',
		'old' => 'application/x-trash',
		'sik' => 'application/x-trash',
		't' => 'application/x-troff',
		'tr' => 'application/x-troff',
		'roff' => 'application/x-troff',
		'man' => 'application/x-troff-man',
		'me' => 'application/x-troff-me',
		'ms' => 'application/x-troff-ms',
		'ustar' => 'application/x-ustar',
		'src' => 'application/x-wais-source',
		'wz' => 'application/x-wingz',
		'crt' => 'application/x-x509-ca-cert',
		'fig' => 'application/x-xfig',
		'au' => 'audio/basic',
		'snd' => 'audio/basic',
		'mid' => 'audio/midi',
		'midi' => 'audio/midi',
		'kar' => 'audio/midi',
		'mpga' => 'audio/mpeg',
		'mpega' => 'audio/mpeg',
		'mp2' => 'audio/mpeg',
		'mp3' => 'audio/mpeg',
		'm3u' => 'audio/x-mpegurl',
		'sid' => 'audio/prs.sid',
		'aif' => 'audio/x-aiff',
		'aiff' => 'audio/x-aiff',
		'aifc' => 'audio/x-aiff',
		'gsm' => 'audio/x-gsm',
		'ra' => 'audio/x-realaudio ',
		'rm' => 'audio/x-pn-realaudio',
		'ram' => 'audio/x-pn-realaudio',
		'pls' => 'audio/x-scpls',
		'wav' => 'audio/x-wav',
		'pdb' => 'chemical/x-pdb',
		'xyz' => 'chemical/x-xyz ',
		'bmp' => 'image/x-ms-bmp',
		'gif' => 'image/gif',
		'ief' => 'image/ief',
		'jpeg' => 'image/jpeg',
		'jpg' => 'image/jpeg',
		'jpe' => 'image/jpeg',
		'pcx' => 'image/pcx',
		'png' => 'image/png',
		'svg' => 'image/svg+xml',
		'svgz' => 'image/svg+xml',
		'tiff' => 'image/tiff',
		'tif' => 'image/tiff',
		'wbmp' => 'image/vnd.wap.wbmp',
		'ras' => 'image/x-cmu-raster',
		'cdr' => 'image/x-coreldraw',
		'pat' => 'image/x-coreldrawpattern',
		'cdt' => 'image/x-coreldrawtemplate',
		'djvu' => 'image/x-djvu',
		'djv' => 'image/x-djvu',
		'jng' => 'image/x-jng',
		'pnm' => 'image/x-portable-anymap',
		'pbm' => 'image/x-portable-bitmap',
		'pgm' => 'image/x-portable-graymap',
		'ppm' => 'image/x-portable-pixmap',
		'rgb' => 'image/x-rgb',
		'xbm' => 'image/x-xbitmap',
		'xpm' => 'image/x-xpixmap',
		'xwd' => 'image/x-xwindowdump',
		'igs' => 'model/iges',
		'iges' => 'model/iges',
		'msh' => 'model/mesh',
		'mesh' => 'model/mesh',
		'silo' => 'model/mesh',
		'wrl' => 'x-world/x-vrml',
		'vrml' => 'x-world/x-vrml',
		'csv' => 'text/comma-separated-values',
		'css' => 'text/css',
		'htm' => 'text/html',
		'html' => 'text/html',
		'xhtml' => 'text/html',
		'mml' => 'text/mathml',
		'asc' => 'text/plain',
		'txt' => 'text/plain',
		'text' => 'text/plain',
		'diff' => 'text/plain',
		'rtx' => 'text/richtext',
		'tsv' => 'text/tab-separated-values',
		'wml' => 'text/vnd.wap.wml',
		'wmls' => 'text/vnd.wap.wmlscript',
		'xml' => 'text/xml',
		'xsl' => 'text/xml',
		'hpp' => 'text/x-c++hdr',
		'hxx' => 'text/x-c++hdr',
		'hh' => 'text/x-c++hdr',
		'cpp' => 'text/x-c++src',
		'cxx' => 'text/x-c++src',
		'cc' => 'text/x-c++src',
		'h' => 'text/x-chdr',
		'c' => 'text/x-csrc',
		'java' => 'text/x-java',
		'moc' => 'text/x-moc',
		'p' => 'text/x-pascal',
		'pas' => 'text/x-pascal',
		'etx' => 'text/x-setext',
		'tk' => 'text/x-tcl',
		'ltx' => 'text/x-tex',
		'sty' => 'text/x-tex',
		'cls' => 'text/x-tex',
		'vcs' => 'text/x-vcalendar',
		'vcf' => 'text/x-vcard',
		'dl' => 'video/dl',
		'fli' => 'video/fli',
		'gl' => 'video/gl',
		'mpeg' => 'video/mpeg',
		'mpg' => 'video/mpeg',
		'mpe' => 'video/mpeg',
		'qt' => 'video/quicktime',
		'mov' => 'video/quicktime',
		'mxu' => 'video/vnd.mpegurl',
		'mng' => 'video/x-mng',
		'asf' => 'video/x-ms-asf',
		'asx' => 'video/x-ms-asf',
		'avi' => 'video/x-msvideo',
		'movie' => 'video/x-sgi-movie',
		'ice' => 'x-conference/x-cooltalk',
		'vrm' => 'x-world/x-vrml',
	];

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
		                          'filterid'     =>$this->filterid ) );
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
	 * @deprecated use FileGenerator for this.
	 */
	public function mimeType()
	{
		if	( $this->mime_type )
			return $this->mime_type;

		$ext = strtolower( $this->getRealExtension() );

		$this->mime_type = self::getMimeType( $ext );

		return( $this->mime_type );
	}



	public static function getMimeType( $extension ) {

		$mime_types = Configuration::subset('mime_types')->getConfig() + self::$MIME_TYPES;

		$mimeType = @$mime_types[$extension];

		if   ( $mimeType )
			return $mimeType;
		else
			// Fallback to default mime type
			return self::DEFAULT_MIMETYPE;
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

		parent::delete();
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
	 * @param string filename Dateiname
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

		parent::save();
	}


	/**
	 * Kopieren des Inhaltes von einer anderen Datei
	 * @param int ID der Datei, von der der Inhalt kopiert werden soll
	 */
	function copyValueFromFile( $otherfileid )
	{
		$of = new File( $otherfileid );
		$this->value = $of->loadValue();
		$this->saveValue();
	}


    public function loadValue()
    {
        return $this->loadValueFromDatabase();
    }


        /**
	 * Lesen des Inhaltes der Datei aus der Datenbank.
	 *
	 * @return String Inhalt der Datei
	 */
	private function loadValueFromDatabase()
	{
		$sql = Db::sql( 'SELECT size,value'.
		                ' FROM {{file}}'.
		                ' WHERE objectid={objectid}' );
		$sql->setInt( 'objectid', $this->objectid);
		$row = $sql->getRow();

		if	( count($row) != 0 )
		{
			$this->value = $row['value'];
			$this->size  = $row['size' ];
		}

		if	( $this->storeValueAsBase64 )
			$this->value = base64_decode( $this->value );

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




    public function getSize()
	{
		return $this->size;
	}

}

?>