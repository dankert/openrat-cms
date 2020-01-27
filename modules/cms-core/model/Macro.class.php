<?php
namespace cms\model;


/**
 * Macro.
 *
 * @author Jan Dankert
 */
class Macro extends BaseObject
{
	public $macroid;

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
            $sql = db()->sql( 'SELECT *'.
                ' FROM {{macro}}'.
                ' WHERE objectid={objectid}' );
            $sql->setInt( 'objectid',$this->objectid );
        }

        $row = $sql->getRow();

		if	( count($row ) != 0 )
		{
			$this->macroid        = $row['id'           ];
			$this->objectid       = $row['objectid'     ];

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

		$sql = db()->sql( 'DELETE FROM {{macro}} '.
		                ' WHERE id={macroid}' );
		$sql->setInt( 'macroid',$this->macroid );

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

		$sql = db()->sql('UPDATE {{macro}} SET '.
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

		$stmt = db()->sql('SELECT MAX(id) FROM {{macro}}');
		$this->aliasid = intval($stmt->getOne())+1;

		$stmt = db()->sql( <<<SQL
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
