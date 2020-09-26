<?php
namespace cms\model;


use cms\base\DB as Db;

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
	    $this->isAlias = true;
		parent::__construct( $objectid );
	}



    /**
     * Lesen der Verknuepfung aus der Datenbank
     * @throws \ObjectNotFoundException
     */
    public function load()
	{
	    if  ( $this->objectid != null )
        {
            $sql = Db::sql( 'SELECT *'.
                ' FROM {{alias}}'.
                ' WHERE objectid={objectid}' );
            $sql->setInt( 'objectid',$this->objectid );
        }
        elseif  ( $this->linkedObjectId != null && intval($this->languageid) != 0 )
        {
            $sql = Db::sql( 'SELECT *'.
                ' FROM {{alias}}'.
                ' WHERE link_objectid={objectid}'.
                '   AND languageid={languageid}' );
            $sql->setInt( 'objectid'  ,$this->linkedObjectId );
            $sql->setInt( 'languageid',$this->languageid     );
        }
        elseif  ( $this->linkedObjectId != null )
        {
            $sql = Db::sql( 'SELECT *'.
                ' FROM {{alias}}'.
                ' WHERE link_objectid={objectid}'.
                '   AND languageid IS NULL' );
            $sql->setInt( 'objectid'  ,$this->linkedObjectId );
        }
        else{
            return;
        }

        $row = $sql->getRow();

		if	( count($row ) != 0 )
		{
			$this->aliasid        = $row['id'           ];
			$this->objectid       = $row['objectid'     ];
			$this->linkedObjectId = $row['link_objectid'];
			$this->languageid     = $row['languageid'   ];

            $this->objectLoad();
        }
    }


    /**
     * Delete.
     */
    public function delete()
	{
	    if   ( ! $this->isPersistent() )
	        return;

		$sql = Db::sql( 'DELETE FROM {{alias}} '.
		                ' WHERE id={aliasid}' );
		$sql->setInt( 'aliasid',$this->aliasid );

		$sql->query();

		$this->objectDelete();
	}


    /**
     *
     */
    public function save()
	{
	    if   ( ! $this->isPersistent() )
	        $this->add();

		$sql = Db::sql('UPDATE {{alias}} SET '.
		               '  link_objectid = {linkobjectid},'.
		               '  languageid    = {languageid}'.
		                ' WHERE objectid={objectid}' );
		$sql->setInt ('objectid'    ,$this->objectid       );
		$sql->setInt ('linkobjectid',$this->linkedObjectId );
		$sql->setIntOrNull('languageid'  ,$this->languageid     );

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

		$stmt = Db::sql('SELECT MAX(id) FROM {{alias}}');
		$this->aliasid = intval($stmt->getOne())+1;

		$stmt = Db::sql( <<<SQL
            INSERT INTO {{alias}}
		                (id,objectid,link_objectid,languageid)
		                VALUES( {linkid},{objectid},{linkobjectid},{languageid} )
SQL
        );
		$stmt->setInt ('linkid'      ,$this->aliasid        );
		$stmt->setInt ('objectid'    ,$this->objectid       );

        $stmt->setInt ('linkobjectid',$this->linkedObjectId );
        $stmt->setIntOrNull('languageid'  ,$this->languageid     );

		$stmt->query();
	}	
}
