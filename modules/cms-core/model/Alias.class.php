<?php
namespace cms\model;


/**
 * Alias. Ein Alias kann auf alle anderen Objekte zeigen.
 *
 * @author Jan Dankert
 */
class Alias extends BaseObject
{
	public $aliasid;
	public $languageid;
	public $linkedObjectId;

	public function __construct( $objectid='' )
	{
		parent::__construct( $objectid );
	}



    /**
     * Lesen der Verknuepfung aus der Datenbank
     * @throws \ObjectNotFoundException
     */
    public function load()
	{
		$sql = db()->sql( 'SELECT *'.
		                ' FROM {{alias}}'.
		                ' WHERE objectid={objectid}' );
		$sql->setInt( 'objectid',$this->objectid );
		$row = $sql->getRow();

		if	( count($row ) != 0 )
		{
			$this->linkedObjectId = $row['link_objectid'];
			$this->languageid     = $row['languageid   '];
		}

		$this->objectLoad();
	}


    /**
     * Delete.
     */
    public function delete()
	{
		$sql = db()->sql( 'DELETE FROM {{alias}} '.
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
		$sql = db()->sql('UPDATE {{alias}} SET '.
		               '  link_objectid = {linkobjectid}'.
		               '  languageid    = {languageid}'.
		                ' WHERE objectid={objectid}' );
		$sql->setInt ('objectid'    ,$this->objectid       );
		$sql->setInt ('linkobjectid',$this->linkedObjectId );
		$sql->setInt ('languageid'  ,$this->languageid     );

		$sql->query();

		parent::save();
	}


	public function getProperties()
	{
		return array_merge( parent::getProperties(),
		                    get_object_vars($this)   );
	}


    /**
     * Add a new link.
     */
    public function add()
	{
		parent::add();

		$stmt = db()->sql('SELECT MAX(id) FROM {{alias}}');
		$this->aliasid = intval($stmt->getOne())+1;

		$stmt = db()->sql( <<<SQL
            INSERT INTO {{alias}}
		                (id,objectid,link_objectid,languageid)
		                VALUES( {linkid},{objectid},{linkobjectid},{languageid} )
SQL
        );
		$stmt->setInt ('id'          ,$this->aliasid        );
		$stmt->setInt ('objectid'    ,$this->objectid       );

        $stmt->setInt ('linkobjectid',$this->linkedObjectId );
        $stmt->setInt ('languageid'  ,$this->languageid     );

		$stmt->query();
	}	
}
