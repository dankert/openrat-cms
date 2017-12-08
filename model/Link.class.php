<?php
namespace cms\model;


/**
 * Darstellen einer Verkn�pfung. Eine Verkn�pfung kann auf eine Objekt oder auf
 * eine beliebige Url zeigen
 *
 * @version $Revision$
 * @author $Author$
 * @package openrat.objects
 */
class Link extends Object
{
	var $linkid;
	var $linkedObjectId = 0;
	var $url            = '';

	public function __construct( $objectid='' )
	{
		parent::__construct( $objectid );
		$this->isLink = true;
	}



    /**
     * Lesen der Verknuepfung aus der Datenbank
     * @throws \ObjectNotFoundException
     */
    public function load()
	{
		$db = db_connection();

		$sql = $db->sql( 'SELECT *'.
		                ' FROM {{link}}'.
		                ' WHERE objectid={objectid}' );
		$sql->setInt( 'objectid',$this->objectid );
		$row = $sql->getRow();

		if	( count($row ) != 0 )
		{
			$this->linkedObjectId = $row['link_objectid'];
		}

		$this->objectLoad();
	}


    /**
     *
     */
    public function delete()
	{
		$db = db_connection();

		// Verkn�pfung l�schen
		$sql = $db->sql( 'DELETE FROM {{link}} '.
		                ' WHERE objectid={objectid}' );
		$sql->setInt( 'objectid',$this->objectid );

		$sql->query();

		$this->objectDelete();
	}


    /**
     *
     */
    public function save()
	{
		global $SESS;
		$db = db_connection();
		
		$sql = $db->sql('UPDATE {{link}} SET '.
		               '  link_objectid = {linkobjectid}'.
		                ' WHERE objectid={objectid}' );
		$sql->setInt   ('objectid'    ,$this->objectid );
		$sql->setInt ('linkobjectid',$this->linkedObjectId );

		$sql->query();

		$this->objectSave();
	}


	public function getProperties()
	{
		return array_merge( parent::getProperties(),
		                    array( 'objectid'       =>$this->objectid,
		                           'linkobjectid'   =>$this->linkedObjectId
                            ));
	}


	public function getType()
	{
		return 'link';
	}


    /**
     * Add a new link.
     */
    public function add()
	{
		$this->objectAdd();

		$db = db_connection();

		$stmt = $db->sql('SELECT MAX(id) FROM {{link}}');
		$this->linkid = intval($stmt->getOne())+1;

		$stmt = $db->sql('INSERT INTO {{link}}'.
		               ' (id,objectid,link_objectid)'.
		               ' VALUES( {linkid},{objectid},{linkobjectid} )' );
		$stmt->setInt   ('linkid'      ,$this->linkid         );
		$stmt->setInt   ('objectid'    ,$this->objectid       );

		if ($this->linkedObjectId == 0)
            $stmt->setNull('linkobjectid');
		else
            $stmt->setInt ('linkobjectid',$this->linkedObjectId );

		$stmt->query();
	}	
}

?>