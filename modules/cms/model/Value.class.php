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

class Value extends ModelBase
{
	/**
	 * ID dieser Inhaltes
	 * @type Integer
	 */
	var $valueid=0;

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
	 * Kennzeichen, ob der Inhalt mit dem Inhalt einer anderern Seite verkn�pft wird.
	 * @type BaseObject
	 */
	var $isLink = false;
	
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
	 * Schalter, ob dieser Inhalt der aktive Inhalt ist
	 * @type Boolean
	 */
	var $active;
	
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
	 * Konstruktor
	 */
	function __construct()
	{
		$this->lastchangeUserId    = 0;
		$this->lastchangeTimeStamp = 0;

	}

	

	/**
	 * Laden des aktuellen Inhaltes aus der Datenbank
	 */
	function loadForPublic()
	{
		$stmt = Db::sql( <<<SQL
			SELECT * FROM {{value}}
			 WHERE elementid ={elementid}
			   AND pageid    ={pageid}
			   AND languageid={languageid}
			   AND publish   =1
SQL
		);
		$stmt->setInt( 'elementid' ,$this->elementid );
		$stmt->setInt( 'pageid'    ,$this->pageid    );
		$stmt->setInt( 'languageid',$this->languageid);
		$row = $stmt->getRow();
		
		if	( count($row) > 0 ) // Wenn Inhalt gefunden
		{
			$this->text           = $row['text'  ];
			$this->format         = $row['format'];
			$this->valueid        = intval($row['id']          );
			$this->linkToObjectId = intval($row['linkobjectid']);
			$this->number         = intval($row['number'      ]);
			$this->date           = intval($row['date'        ]);
	
			$this->active         = ( $row['active' ]=='1' );
			$this->publish        = ( $row['publish']=='1' );
	
			$this->lastchangeTimeStamp = intval($row['lastchange_date'  ]);
			$this->lastchangeUserId    = intval($row['lastchange_userid']);
		}
	}

	/**
	 * Laden des aktuellen Inhaltes aus der Datenbank
	 */
	function load()
	{
		$stmt = Db::sql( <<<SQL
			SELECT * FROM {{value}}
			 WHERE elementid ={elementid}
			   AND pageid    ={pageid}
			   AND languageid={languageid}
			   AND active=1
SQL
		);
		$stmt->setInt( 'elementid' ,$this->elementid );
		$stmt->setInt( 'pageid'    ,$this->pageid    );
		$stmt->setInt( 'languageid',$this->languageid);
		$row = $stmt->getRow();

		if	( count($row) > 0 ) // Wenn Inhalt gefunden
		{
			$this->text           = $row['text'  ];
			$this->format         = $row['format'];
			$this->valueid        = intval($row['id']          );
			$this->linkToObjectId = intval($row['linkobjectid']);
			$this->number         = intval($row['number'      ]);
			$this->date           = intval($row['date'        ]);

			$this->active         = ( $row['active' ]=='1' );
			$this->publish        = ( $row['publish']=='1' );

			$this->lastchangeTimeStamp = intval($row['lastchange_date'  ]);
			$this->lastchangeUserId    = intval($row['lastchange_userid']);
		}
	}


	/**
	 * Laden eines bestimmten Inhaltes aus der Datenbank
	 */
	function loadWithId( $valueid = null )
	{
		if	( $valueid )
			$this->valueid = $valueid;

		$sql = DB::sql( <<<SQL
 	SELECT {{value}}.*,{{user}}.name as lastchange_username
	  FROM {{value}}
	    LEFT JOIN {{user}} ON {{user}}.id={{value}}.lastchange_userid
	        WHERE {{value}}.id={valueid}
SQL
		);
		$sql->setInt( 'valueid',$this->valueid);
		$row = $sql->getRow();
		
		$this->text           =        $row['text'        ];
        $this->format         =        $row['format'      ];
		$this->pageid         = intval($row['pageid'      ]);
		$this->elementid      = intval($row['elementid'   ]);
		$this->languageid     = intval($row['languageid'  ]);
		$this->valueid        = intval($row['id'          ]);
		$this->linkToObjectId = intval($row['linkobjectid']);
		$this->number         = intval($row['number'      ]);
		$this->date           = intval($row['date'        ]);

		$this->active         = ( $row['active' ]=='1' );
		$this->publish        = ( $row['publish']=='1' );

		$this->lastchangeTimeStamp = intval($row['lastchange_date'    ]);
		$this->lastchangeUserId    = intval($row['lastchange_userid'  ]);
		$this->lastchangeUserName  =        $row['lastchange_username'];
	}


	/**
	 * Alle Versionen des aktuellen Inhaltes werden ermittelt
	 * @return array
	 */
	function getVersionList()
	{
		$stmt = DB::sql( <<<SQL
		   SELECT {{value}}.*,{{user}}.name as lastchange_username
		                  FROM {{value}}
		                  LEFT JOIN {{user}} ON {{user}}.id={{value}}.lastchange_userid
		                  WHERE elementid ={elementid}
		                    AND pageid    ={pageid}
		                    AND languageid={languageid}
		                  ORDER BY lastchange_date
SQL
		);
		$stmt->setInt( 'elementid' ,$this->element->elementid );
		$stmt->setInt( 'pageid'    ,$this->pageid    );
		$stmt->setInt( 'languageid',$this->languageid);

		$list = array();
		foreach($stmt->getAll() as $row )
		{
			$val = new Value();
			$val->valueid = $row['id'];
			
			$val->text           = $row['text'];
            $val->format         = $row['format'];
			$val->valueid        = intval($row['id']          );
			$val->linkToObjectId = intval($row['linkobjectid']);
			$val->number         = intval($row['number'      ]);
			$val->date           = intval($row['date'        ]);
			$val->element        = $this->element;
			$val->elementid      = $this->elementid;
			$val->languageid     = $this->languageid;

			$val->active         = ( $row['active' ]=='1' );
			$val->publish        = ( $row['publish']=='1' );
	
			$val->lastchangeTimeStamp = intval($row['lastchange_date'    ]);
			$val->lastchangeUserId    = intval($row['lastchange_userid'  ]);
			$val->lastchangeUserName  = $row['lastchange_username'];

			$list[] = $val;
		}
		return $list;
	}


	/**
	 * Die Anzahl der Versionen des aktuellen Inhaltes wird ermittelt
	 * @return array
	 */
	function getCountVersions()
	{
		$sql = DB::sql( <<<SQL
SELECT COUNT(*) FROM {{value}}
		                  WHERE elementid ={elementid}
		                    AND pageid    ={pageid}
		                    AND languageid={languageid}
SQL
		);
		$sql->setInt( 'elementid' ,$this->element->elementid );
		$sql->setInt( 'pageid'    ,$this->pageid    );
		$sql->setInt( 'languageid',$this->languageid);

		return $sql->getOne();
	}


	function getLastChangeTime()
	{
		$sql = DB::sql( <<<SQL
			SELECT lastchange_date FROM {{value}}
		     WHERE elementid ={elementid}
		       AND pageid    ={pageid}
		       AND languageid={languageid}
		     ORDER BY id DESC
SQL
		);
		$sql->setInt( 'elementid' ,$this->element->elementid );
		$sql->setInt( 'pageid'    ,$this->pageid    );
		$sql->setInt( 'languageid',$this->languageid);

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
	SELECT lastchange_date FROM {{value}}
		WHERE elementid ={elementid}
		  AND pageid    ={pageid}
		  AND languageid={languageid}
		  AND lastchange_date > {date}
		  AND lastchange_userid != {userid}
		  ORDER BY id DESC
SQL
		);
		$sql->setInt( 'elementid' ,$this->element->elementid );
		$sql->setInt( 'pageid'    ,$this->pageid    );
		$sql->setInt( 'languageid',$this->languageid);
		$sql->setInt( 'date'      ,$date  );
		$sql->setInt( 'userid'    ,$userid);

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
		                  WHERE elementid ={elementid}
		                    AND pageid    ={pageid}
		                    AND languageid={languageid}
SQL
		);
		$sql->setInt( 'elementid' ,$this->elementid );
		$sql->setInt( 'pageid'    ,$this->pageid    );
		$sql->setInt( 'languageid',$this->languageid);

		$sql->query();

		$sql = Db::sql( <<<SQL
			UPDATE {{value}}
		                  SET publish = 1
		                  WHERE active    = 1
		                    AND elementid ={elementid}
		                    AND pageid    ={pageid}
		                    AND languageid={languageid}
SQL
		);
		$sql->setInt( 'elementid' ,$this->elementid );
		$sql->setInt( 'pageid'    ,$this->pageid    );
		$sql->setInt( 'languageid',$this->languageid);

		$sql->query();
	}


	/**
	 * No function, values are NOT updated, values are only added.
	 * @return name|void
	 */
	protected function save()
	{
		// not implemented, values are only added ("copy on write")
	}

	/**
	 * Inhalt speichern
	 */
	public function add()
	{
		$stmt = Db::sql( <<<SQL
			UPDATE {{value}}
		                  SET active=0
		                  WHERE elementid ={elementid}
		                    AND pageid    ={pageid}
		                    AND languageid={languageid}
SQL
		);
		$stmt->setInt( 'elementid' ,$this->element->elementid );
		$stmt->setInt( 'pageid'    ,$this->pageid    );
		$stmt->setInt( 'languageid',$this->languageid);

		$stmt->query();

		if	( $this->publish )
		{
			// Wenn Inhalt sofort veroeffentlicht werden kann, dann
			// alle anderen Inhalte auf nicht-veroeffentlichen stellen 
			$stmt = DB::sql( <<<SQL
 					UPDATE {{value}}
			                  SET publish=0
			                  WHERE elementid ={elementid}
			                    AND pageid    ={pageid}
			                    AND languageid={languageid}
SQL
			);
			$stmt->setInt( 'elementid' ,$this->element->elementid );
			$stmt->setInt( 'pageid'    ,$this->pageid    );
			$stmt->setInt( 'languageid',$this->languageid);

			$stmt->query();
		}

		// Naechste ID aus Datenbank besorgen
		$stmt = DB::sql('SELECT MAX(id) FROM {{value}}');
		$this->valueid = intval($stmt->getOne())+1;

		$stmt = DB::sql( <<<SQL
INSERT INTO {{value}}
            (id       ,linkobjectid  ,text  ,number  ,date  ,elementid  ,format  ,pageid  ,languageid  ,active,publish  ,lastchange_date  ,lastchange_userid  )
     VALUES ({valueid},{linkobjectid},{text},{number},{date},{elementid},{format},{pageid},{languageid},1     ,{publish},{lastchange_date},{lastchange_userid})
SQL
		);
		$stmt->setInt( 'valueid'   ,$this->valueid            );
		$stmt->setInt( 'format'    ,$this->format             );
		$stmt->setInt( 'elementid' ,$this->element->elementid );
		$stmt->setInt( 'pageid'    ,$this->pageid             );
		$stmt->setInt( 'languageid',$this->languageid         );

		if	( intval($this->linkToObjectId)==0)
			$stmt->setNull  ( 'linkobjectid' );
		else	$stmt->setInt   ( 'linkobjectid',$this->linkToObjectId   );

		if	( $this->text == '' )
			$stmt->setNull  ( 'text' );
		else	$stmt->setString( 'text',$this->text );

		if	( intval($this->number)==0)
			$stmt->setNull  ( 'number' );
		else	$stmt->setInt   ( 'number',$this->number );

		if	( intval($this->date)==0)
			$stmt->setNull  ( 'date' );
		else	$stmt->setInt   ( 'date',$this->date );

		$stmt->setBoolean( 'publish'          ,$this->publish );
		$stmt->setInt    ( 'lastchange_date'  ,Startup::now()         );
		$user = \util\Session::getUser();
		$stmt->setInt    ( 'lastchange_userid',$user->userid  );

		$stmt->query();
		
		// Nur ausfuehren, wenn in Konfiguration aktiviert.
		$limit = Configuration::subset(['content','revision-limit'] );
		if	( $limit->is('enabled',false) )
			$this->checkLimit();
	}

	
	/**
	 * Pruefen, ob maximale Anzahl von Versionen erreicht.
	 * In diesem Fall die zu alten Versionen l�schen.
	 */
	function checkLimit()
	{
		$limitConfig = Configuration::subset(['content','revision-limit']);

		$sql = DB::sql( <<<SQL
		             SELECT id FROM {{value}}
			                  WHERE elementid  = {elementid}
			                    AND pageid     = {pageid}
			                    AND languageid = {languageid}
			                    AND active     = 0
			                    AND publish    = 0
			                   ORDER BY id
SQL
		);
		$sql->setInt( 'elementid' ,$this->element->elementid );
		$sql->setInt( 'pageid'    ,$this->pageid             );
		$sql->setInt( 'languageid',$this->languageid         );
		$values = $sql->getCol();
		
		if	( count($values) > $limitConfig->get('min-revisions',3) )
		{
			$sql = DB::sql( <<<SQL
			DELETE FROM {{value}}
				                  WHERE elementid  = {elementid}
				                    AND pageid     = {pageid}
				                    AND languageid = {languageid}
				                    AND active     = 0
				                    AND publish    = 0
				                    AND lastchange_date < {min_date}
				                    AND id              < {min_id}
SQL
			);
			$sql->setInt( 'elementid' ,$this->element->elementid );
			$sql->setInt( 'pageid'    ,$this->pageid             );
			$sql->setInt( 'languageid',$this->languageid         );
			$sql->setInt( 'min_date'  ,$limitConfig['max-age']*24*60*60);
			$sql->setInt( 'min_id'    ,$values[count($values)-$limitConfig['min-revisions']]);
			$sql->query();
		}
		
		if	( count($values) > $limitConfig->get('max-revisions',100 ) )
		{
			$sql = Db::sql( <<<SQL
			DELETE FROM {{value}}
				                  WHERE elementid  = {elementid}
				                    AND pageid     = {pageid}
				                    AND languageid = {languageid}
				                    AND active     = 0
				                    AND publish    = 0
				                    AND lastchange_date < {min_date}
				                    AND id              < {min_id}
SQL
			);
			$sql->setInt( 'elementid' ,$this->element->elementid );
			$sql->setInt( 'pageid'    ,$this->pageid             );
			$sql->setInt( 'languageid',$this->languageid         );
			$sql->setInt( 'min_date'  ,$limitConfig['min-age']*24*60*60);
			$sql->setInt( 'min_id'    ,$values[count($values)-$limitConfig['max-revisions']]);
			$sql->query();
		}
	}

	
	
	/**
	 * Diesen Inhalt loeschen
	 */
	function delete()
	{
		$stmt = DB::sql( <<<SQL
		               DELETE * FROM {{value}}
		                  WHERE elementid ={elementid}
		                    AND pageid    ={pageid}
		                    AND languageid={languageid}
SQL
		);
		$stmt->setInt( 'elementid' ,$this->element->elementid );
		$stmt->setInt( 'pageid'    ,$this->pageid    );
		$stmt->setInt( 'languageid',$this->languageid);

		$stmt->execute();
	}



	/**
	  * Es werden Objekte mit einem Inhalt gesucht.
	  * @param String Suchbegriff
	  * @return array Liste der gefundenen Objekt-IDs
	  */
	function getObjectIdsByValue( $text )
	{
		$sql = DB::sql( <<<SQL
                 SELECT {{object}}.id FROM {{value}}
		                 LEFT JOIN {{page}}
		                   ON {{page}}.id={{value}}.pageid
		                 LEFT JOIN {{object}}
		                   ON {{object}}.id={{page}}.objectid
		                 WHERE {{value}}.text LIKE {text}
		                   AND {{value}}.languageid={languageid}
		                  ORDER BY {{object}}.lastchange_date DESC
SQL
	    );
		                
		$sql->setInt   ( 'languageid',$this->languageid );
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
		                   AND {{value}}.languageid={languageid}
		                  ORDER BY {{object}}.lastchange_date DESC
SQL
		);
		$sql->setInt   ( 'languageid',$this->languageid );
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
	
	
	/**
	 * Ermittelt einen tempor�ren Dateinamen f�r diesen Inhalt. 
	 */
	function tmpfile()
	{
		$filename = \util\FileUtils::getTempFileName(  );
		return $filename;
	}
	
	
	
	/**
	 * Ermittelt den unbearbeiteten, "rohen" Inhalt.
	 * 
	 * @return mixed Inhalt
	 */
	public function getRawValue()
	{
		switch( $this->element->typeid )
		{
			case Element::ELEMENT_TYPE_LINK:
				return $this->linkToObjectId;
				
			case Element::ELEMENT_TYPE_DATE;
				return $this->date;
				
			default:
				return $this->text;
		}
	}


    public function getName()
    {
        return $this->element->label;
    }


    public function __toString()
	{
		return "Value: ".print_r($this,true);
	}



	public function getId()
	{
		return $this->valueid;
	}


}