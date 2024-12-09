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
 * Bookmark.
 *
 * @author Jan Dankert
 */
class Bookmark extends ModelBase
{
	public $bookmarkId;
	public $userId;
	public $objectId;

	/**
	 * Get all bookmarks.
	 * @return array
	 */
	public static function getBookmarkedObjectIdsForUser( $userId )
	{
		$sql = DB::sql( <<<SQL
				SELECT {{bookmark}}.objectid
				  from {{bookmark}}
				  LEFT JOIN {{object}}
				         ON {{bookmark}}.objectid={{object}}.id
			     WHERE userid={userid}
				 ORDER BY {{object}}.lastchange_date DESC
SQL
		);
		$sql->setInt('userid',$userId );
		return $sql->getCol();
	}

	public function getName()
	{
		return '';
	}

	public function load()
	{
		$sql = DB::sql( <<<SQL
				SELECT *
				  from {{bookmark}}
			     WHERE userid={userid} AND objectid={objectid}
SQL
		);
		$sql->setInt('userid'  ,$this->userId   );
		$sql->setInt('objectid',$this->objectId );

		$result = $sql->getRow();
		if   ( $result) {
			$this->bookmarkId = $result['id'      ];
			$this->userId     = $result['userid'  ];
			$this->objectId   = $result['objectid'];
		}

	}

	protected function save()
	{
	}

	protected function add()
	{
		// New PK
		$sql = Db::sql(<<<'SQL'
			SELECT MAX(id) FROM {{bookmark}}
SQL
		);
		$this->bookmarkId = intval($sql->getOne())+1;

		// Insert new bookmark
		$sql = DB::sql( <<<SQL
				INSERT INTO {{bookmark}}
				  (id,userid,objectid) values ({bookmarkId},{userid},{objectid})
SQL
		);
		$sql->setInt('bookmarkId'  ,$this->bookmarkId );
		$sql->setInt('userid'      ,$this->userId     );
		$sql->setInt('objectid'    ,$this->objectId   );
		$sql->execute();
	}

	public function delete()
	{
		// Remove existing bookmark
		$sql = DB::sql( <<<SQL
				DELETE
				  from {{bookmark}}
			     WHERE id={bookmarkId} 
SQL
		);
		$sql->setInt('bookmarkId'  ,$this->bookmarkId );
		$sql->execute();
	}

	public function getId()
	{
		return $this->bookmarkId;
	}
}

