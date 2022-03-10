<?php
namespace cms\model;
use cms\base\Configuration;
use cms\base\DB;
use cms\base\Startup;
use util\ArrayUtils;
use cms\generator\Publish;
use cms\macros\MacroRunner;
use \util\exception\ObjectNotFoundException;
use logger\Logger;
use util\exception\GeneratorException;
use util\Text;
use util\Html;
use util\Http;
use util\Transformer;
use util\Code;
use util\cache\FileCache;

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



/**
 * Darstellen einer Inhaltes
 *
 * @version $Revision$
 * @author $Author$
 * @package openrat.objects
 */

class Content extends ModelBase
{
	/**
	 * Content ID.
	 * @type Integer
	 */
	private $id;

	/**
	 * Seiten-Objekt der ?bergeordneten Seite
	 * @type Page
	 */
	var $page;

	/**
	 * Seiten-Id der uebergeordneten Seite
	 * @type Integer
	 */
	var $pageid;

	/**
	 * Objekt-ID, auf die verlinkt wird
	 * @type Integer
	 */
	var $linkToObjectId=0;

	/**
	 * Text-Inhalt
	 * @type String
	 */
	var $text='';

	/**
	 * Zahl. Auch Flie?kommazahlen werden als Ganzzahl gespeichert
	 * @type Integer
	 */
	var $number=0;


	/**
	 * Datum als Unix-Timestamp
	 * @type Integer
	 */
	var $date=0;

	/**
	 * Element-Objekt
	 * @type Element
	 */
	var $element;

	/**
	 * Element-Id
	 * @type Integer
	 */
	var $elementid;

	/**
	 * Der eigentliche Inhalt des Elementes
	 * @type String
	 */
	var $value;

	/**
	 * TimeStamp der letzten Aenderung
	 * @type Integer
	 */
	var $lastchangeTimeStamp;

	/**
	 * Benutzer-ID der letzten Aenderung
	 * @type Integer
	 */
	var $lastchangeUserId;

	/**
	 * Benutzername der letzten Aenderung
	 * @type Integer
	 */
	var $lastchangeUserName;

	/**
	 * Active content.
	 *
	 * Do NOT set this attribute, it should be used readonly.
	 *
	 * @type bool
	 */
	public $active;

	/**
	 * @type Publish
	 */
	public $publisher;

	/**
	 * @type boolean
	 */
	var $publish = false;

    /**
     * @type Boolean
     * @deprecated
     */
	public $simple;


    /**
     * Sprach-Id.
     * @var int
     */
    public $languageid;

    /**
     * Format
     *
     * @var int
     */
    public $format = null;

    /**
	 * constructor
	 */
	function __construct( $id = null )
	{
		$this->id = $id;
	}


	public function load()
	{
		// TODO: Implement load() method.
	}

	/**
	 * Gets the IDs of all versions of this content.
	 * @return array
	 */
	function getVersionList()
	{
		$stmt = DB::sql( <<<SQL
		                    SELECT {{value}}.id
		                      FROM {{value}}
		                     WHERE contentid ={contentid}
		                  ORDER BY lastchange_date
SQL
		);
		$stmt->setInt( 'contentid' ,$this->id );

		return $stmt->getCol();
	}


	/**
	 * returns the count of all versions.
	 * @return integer
	 */
	function getCountVersions()
	{
		$sql = DB::sql( <<<SQL
    SELECT COUNT(*) FROM {{value}}
	 WHERE contentid ={contentid}
SQL
		);
		$sql->setInt( 'contentid' ,$this->id );

		return $sql->getOne();
	}


	/**
	 * @return String|null
	 */
	public function getLastChangeTime()
	{
		$sql = DB::sql( <<<SQL
			SELECT lastchange_date FROM {{value}}
             WHERE contentid ={contentid}
		     ORDER BY id DESC
SQL
		);
		$sql->setInt( 'contentid' ,$this->id );

		return $sql->getOne();
	}


	/**
	 * Gets the last change date by another user since a specific date.
	 * @param $date
	 * @param $userid
	 * @return String
	 */
	public function getLastChangeSinceByAnotherUser( $date, $userid )
	{
		$sql = Db::sql( <<<SQL
            SELECT lastchange_date
              FROM {{value}}
             WHERE contentid = {contentid}
               AND lastchange_date > {date}
               AND lastchange_userid != {userid}
          ORDER BY id DESC
SQL
		);
		$sql->setInt( 'contentid' ,$this->id );
		$sql->setInt( 'date'      ,$date     );
		$sql->setInt( 'userid'    ,$userid   );

		return $sql->getOne();
	}



	/**
	 * Inhalt freigeben
	 */
	function release()
	{
		$sql = DB::sql( <<<SQL
			UPDATE {{value}}
		                  SET publish = 0
                          WHERE contentid = {contentid}
SQL
		);
		$sql->setInt( 'contentid' ,$this->id );

		$sql->execute();

		$sql = Db::sql( <<<SQL
			UPDATE {{value}}
		                  SET publish = 1
		                  WHERE active    = 1
                            AND contentid = {contentid}
SQL
		);
		$sql->setInt( 'contentid' ,$this->id );

		$sql->execute();
	}


	/**
	 * No function, values are NOT updated, values are only added.
	 * @return name|void
	 */
	protected function save()
	{
		// not implemented, values are only added ("copy on write")
	}


	protected function add()
	{
		// Naechste ID aus Datenbank besorgen
		$stmt = DB::sql('SELECT MAX(id) FROM {{content}}');
		$this->id = intval($stmt->getOne())+1;

		$stmt = DB::sql( <<<SQL
INSERT INTO {{content}}
            (id         )
     VALUES ({contentid})
SQL
		);
		$stmt->setInt( 'contentid' ,$this->id );
		$stmt->execute();
	}


	/**
	 * Delete this content.
	 *
	 * If a object (page, file, ...) is deleted, then all referenced contents must be deleted too.
	 */
	public function delete()
	{
		// Delete all values
		$stmt = DB::sql( <<<SQL
		               DELETE FROM {{value}}
                          WHERE contentid = {contentid}
SQL
		);
		$stmt->setInt( 'contentid' ,$this->id );
		$stmt->execute();

		// Delete the content
		$stmt = DB::sql( <<<SQL
		               DELETE FROM {{content}}
                          WHERE id = {contentid}
SQL
		);
		$stmt->setInt( 'contentid' ,$this->id );
		$stmt->execute();
	}



	/**
	  * Es werden Objekte mit einem Inhalt gesucht.
	  * @param String Suchbegriff
	  * @return array Liste der gefundenen Objekt-IDs
	  */
	public static function getObjectIdsByValue( $text )
	{
		$sql = DB::sql( <<<SQL
                 SELECT {{object}}.id FROM {{object}}
		                 LEFT JOIN {{page}}
		                   ON {{object}}.id={{page}}.objectid
		                 LEFT JOIN {{pagecontent}}
		                   ON {{page}}.id={{pagecontent}}.pageid
		                 LEFT JOIN {{content}}
		                   ON {{pagecontent}}.contentid={{content}}.id
		                 LEFT JOIN {{value}}
		                   ON {{content}}.id={{value}}.contentid
		                 WHERE {{value}}.text LIKE {text}
		                  ORDER BY {{object}}.lastchange_date DESC
SQL
	    );
		                
		$sql->setString( 'text'      ,'%'.$text.'%'     );

		return $sql->getCol();
	}


	/**
	  * Es werden Objekte mit einer UserId ermittelt
	  * @param Integer Benutzer-Id der letzten ?nderung
	  * @return array Liste der gefundenen Objekt-IDs
	  */
	function getObjectIdsByLastChangeUserId( $userid )
	{
		$sql = DB::sql( <<<SQL
                  SELECT {{object}}.id FROM {{value}}
		                 LEFT JOIN {{page}}
		                   ON {{page}}.id={{value}}.pageid
		                 LEFT JOIN {{object}}
		                   ON {{object}}.id={{page}}.objectid
		                 WHERE {{value}}.lastchange_userid={userid}
		                  ORDER BY {{object}}.lastchange_date DESC
SQL
		);
		$sql->setInt   ( 'userid'    ,$userid           );

		return $sql->getCol();
	}

	

	/**
	  * Es wird das Objekt ermittelt, welches der Benutzer zuletzt ge�ndert hat.
	  * 
	  * @return Integer Objekt-Id
	  */
	public static function getLastChangedObjectByUserId( $userid )
	{
		$sql = DB::sql( <<<SQL
SELECT {{object}}.id
  FROM {{value}} 
  LEFT JOIN {{page}} 
    ON {{page}}.id={{value}}.pageid 
  LEFT JOIN {{object}} 
    ON {{object}}.id={{page}}.objectid 
 WHERE {{value}}.lastchange_userid={userid}
 ORDER BY {{value}}.lastchange_date DESC
SQL
);
		$sql->setInt   ( 'userid'    ,$userid           );
		return $sql->getOne();
	}
	
	
	/**
	  * Es wird das Objekt ermittelt, welches der Benutzer zuletzt ge�ndert hat.
	  * 
	  * @return Integer Objekt-Id
	  */
	public static function getLastChangedObjectInProjectByUserId( $projectid, $userid )
	{
		$sql = DB::sql( <<<SQL
SELECT {{object}}.id
  FROM {{value}} 
  LEFT JOIN {{page}} 
    ON {{page}}.id={{value}}.pageid 
  LEFT JOIN {{object}} 
    ON {{object}}.id={{page}}.objectid 
 WHERE {{value}}.lastchange_userid={userid}
   AND {{object}}.projectid = {projectid}
 ORDER BY {{value}}.lastchange_date DESC
SQL
);
		$sql->setInt   ( 'userid'    ,$userid     );
		$sql->setInt   ( 'projectid' ,$projectid  );
		return $sql->getOne();
	}
	
	

    public function getName()
    {
        return 'Content#'.$this->id;
    }


    public function __toString()
	{
		return "Content: ".print_r($this,true);
	}



	public function getId()
	{
		return $this->id;
	}


}