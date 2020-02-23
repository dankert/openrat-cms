<?php
namespace cms\model;

/**
 * Darstellen einer URL. An URL points to an string-based URL.
 *
 * @author Jan Dankert
 * @package openrat.objects
 */
class Url extends BaseObject
{
	public $urlid;
	public $url    = '';

	function __construct( $objectid='' )
	{
		parent::__construct( $objectid );
		$this->isUrl = true;
		$this->typeid = BaseObject::TYPEID_URL;
	}
	

	// Lesen der Verkn�pfung aus der Datenbank
	function load()
	{
		$db = db_connection();

		$sql = $db->sql( 'SELECT *'.
		                ' FROM {{url}}'.
		                ' WHERE objectid={objectid}' );
		$sql->setInt( 'objectid',$this->objectid );
		$row = $sql->getRow();

		if	( count($row ) != 0 )
		{
			$this->url            = $row['url'];
		}
		
		$this->objectLoad();
	}


    /**
     * Löschen.
     */
    function delete()
	{
		$db = db_connection();

		$sql = $db->sql( 'DELETE FROM {{url}} '.
		                ' WHERE objectid={objectid}' );
		$sql->setInt( 'objectid',$this->objectid );
		
		$sql->query();

		$this->objectDelete();
	}



	public function save()
	{
		global $SESS;
		$db = db_connection();
		
		$sql = $db->sql('UPDATE {{url}} SET '.
		               '  url           = {url}'.
		                ' WHERE objectid={objectid}' );
		$sql->setInt   ('objectid'    ,$this->objectid );
        $sql->setString('url',$this->url );

		$sql->query();

		$this->objectSave();
	}


	function getProperties()
	{
		return array_merge( parent::getProperties(),
		                    Array( 'objectid'       =>$this->objectid,
		                           'url'            =>$this->url
                            ) );
	}


	function getType()
	{
		return 'url';
	}


	function add()
	{
		parent::add();

		$sql = db()->sql('SELECT MAX(id) FROM {{url}}');
		$this->urlid = intval($sql->getOne())+1;

		$sql = db()->sql('INSERT INTO {{url}}'.
		               ' (id,objectid,url)'.
		               ' VALUES( {urlid},{objectid},{url} )' );
		$sql->setInt   ('urlid'      ,$this->urlid         );
		$sql->setInt   ('objectid'    ,$this->objectid       );

		$sql->setString('url',$this->url );

		$sql->query();
	}	
}

?>