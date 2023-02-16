<?php

namespace cms\model;

use cms\base\DB;
use database\Database;
use logger\Logger;
use util\exception\ObjectNotFoundException;
use util\FileUtils;
use util\Request;
use util\Session;


/**
 * Tag.
 *
 * @author Jan Dankert
 */
class Tag extends ModelBase
{
	public $tagid;

	public $name;

	public $objects;

	public $projectid;

	// Konstruktor
	public function  __construct( $tagid='' )
	{
		if   ( $tagid )
			$this->tagid = $tagid;
	}



	/**
	 * Reads all objects with this tag
	 *
	 * @return BaseObject[] objects
	 */
	function getObjects()
	{
		$db = DB::get();

		$sql = $db->sql( <<<SQL
			SELECT {{object}}.*
		                 FROM {{object}}
		                 WHERE id IN (
		                     SELECT objectid FROM {{tag_object}} WHERE tagid = {tagid}
		                 )
SQL
		);
		$sql->setInt('tagid'  ,$this->tagid );

		return array_map( function($row) {
			// converting the result row into an baseObject.
			$baseObject = new BaseObject( $row['id'] );
			$baseObject->setDatabaseRow( $row );
			return $baseObject;

		},$sql->getAll() );
	}



	// Laden

    /**
     * @throws \util\exception\ObjectNotFoundException
     */
    public function load()
	{
		$sql = Db::sql( <<<SQL
		    SELECT * FROM {{tag}}
			 WHERE id={tagid}
SQL
		);
		$sql->setInt( 'tagid',$this->tagid );

		$row = $sql->getRow();

		if	( empty($row) )
			throw new ObjectNotFoundException('tag '.$this->tagid.' not found');
			
		$this->name      = $row['name'     ];
		$this->projectid = $row['projectid'];

        return $this;
	}


	/**
	 * Save.
	 * @return void
	 */
	public function save()
	{
		$stmt = DB::sql( <<<SQL
				UPDATE {{tag}}
                  SET name = {name}
                WHERE id= {tagid}
SQL
);
		$stmt->setString('name' ,$this->name  );
		$stmt->setInt   ('tagid',$this->tagid );

		$stmt->execute();
	}


    /**
     * Add a project to the database.
     */
    public function add()
	{
		$sql = DB::sql('SELECT MAX(id) FROM {{tag}}');
		$this->tagid = intval($sql->getOne())+1;

		$sql = DB::sql( <<<SQL
		    INSERT INTO {{tag}}
		                ( id     ,projectid  ,name   )
		         VALUES ( {tagid},{projectid},{name} )
SQL
		);
		$sql->setInt   ('tagid'    ,$this->tagid     );
		$sql->setInt   ('projectid',$this->projectid );
		$sql->setString('name'     ,$this->name      );

		$sql->execute();
	}


	/**
	 * Remove tag
	 * @return void
	 */
	public function delete()
	{
		// Deleting the tag objects
		$sql = DB::sql( 'DELETE FROM {{tag_object}}'.
		                '  WHERE tagid= {tagid} ' );
		$sql->setInt( 'tagid',$this->tagid );
		$sql->execute();

		// Deleting the tag itself
		$sql = DB::sql( 'DELETE FROM {{tag}}'.
		                '  WHERE id= {tagid} ' );
		$sql->setInt( 'tagid',$this->tagid );
		$sql->execute();
	}

    public function getName()
    {
        return $this->name;
    }


	public function getId()
	{
		return $this->tagid;
	}

	public function addObject(float $objectid)
	{
		$sql = DB::sql('SELECT MAX(id) FROM {{tag_object}}');
		$id  = intval($sql->getOne())+1;

		$sql = DB::sql( <<<SQL
		    INSERT INTO {{tag_object}}
		                ( id  ,tagid  ,objectid   )
		         VALUES ( {id},{tagid},{objectid} )
SQL
		);
		$sql->setInt   ('id'      ,$id          );
		$sql->setInt   ('tagid'   ,$this->tagid );
		$sql->setString('objectid',$objectid    );

		$sql->execute();

	}


	public function removeObject(float $objectid)
	{
		$sql = DB::sql( <<<SQL
		    DELETE FROM {{tag_object}}
		          WHERE tagid={tagid}
		            AND objectid={objectid}
SQL
		);
		$sql->setInt   ('tagid'   ,$this->tagid );
		$sql->setString('objectid',$objectid    );

		$sql->execute();
	}

}

