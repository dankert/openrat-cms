<?php
namespace cms\model;


use cms\base\DB as Db;

/**
 * Darstellen einer Verkn�pfung. Eine Verkn�pfung kann auf eine Objekt oder auf
 * eine beliebige Url zeigen
 *
 * @version $Revision$
 * @author $Author$
 * @package openrat.objects
 */
class Link extends BaseObject
{
	var $linkid;
	var $linkedObjectId = 0;
	var $url            = '';

	public function __construct( $objectid='' )
	{
		parent::__construct( $objectid );
		$this->isLink = true;
		$this->typeid = BaseObject::TYPEID_LINK;
	}



    /**
     * Lesen der Verknuepfung aus der Datenbank
     * @throws \ObjectNotFoundException
     */
    public function load()
	{
		$db = \cms\base\DB::get();

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
		$db = \cms\base\DB::get();

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
		$db = \cms\base\DB::get();
		
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
		parent::add();

		$stmt = Db::sql('SELECT MAX(id) FROM {{link}}');
		$this->linkid = intval($stmt->getOne())+1;

		$stmt = Db::sql('INSERT INTO {{link}}'.
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