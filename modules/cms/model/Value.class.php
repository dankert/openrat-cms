<?php
namespace cms\model;
use cms\base\DB;
use util\ArrayUtils;
use cms\generator\Publish;
use cms\macros\MacroRunner;
use \ObjectNotFoundException;
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
		$stmt = Db::sql( 'SELECT * FROM {{value}}'.
			                '  WHERE elementid ={elementid}'.
			                '    AND pageid    ={pageid}'.
			                '    AND languageid={languageid}'.
			                '    AND publish=1' );
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
		$stmt = Db::sql( 'SELECT * FROM {{value}}'.
			             '  WHERE elementid ={elementid}'.
			             '    AND pageid    ={pageid}'.
			             '    AND languageid={languageid}'.
			             '    AND active=1' );
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
	function loadWithId( $valueid=0 )
	{
		if	( $valueid != 0 )
			$this->valueid = $valueid;

		$db = \cms\base\DB::get();

		$sql = $db->sql( 'SELECT {{value}}.*,{{user}}.name as lastchange_username'.
		                ' FROM {{value}}'.
		                ' LEFT JOIN {{user}} ON {{user}}.id={{value}}.lastchange_userid'.
		                '  WHERE {{value}}.id={valueid}' );
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
	 * @return Array
	 */
	function getVersionList()
	{
		$db = \cms\base\DB::get();

		$sql = $db->sql( 'SELECT {{value}}.*,{{user}}.name as lastchange_username'.
		                '  FROM {{value}}'.
		                '  LEFT JOIN {{user}} ON {{user}}.id={{value}}.lastchange_userid'.
		                '  WHERE elementid ={elementid}'.
		                '    AND pageid    ={pageid}'.
		                '    AND languageid={languageid}'.
		                '  ORDER BY lastchange_date' );
		$sql->setInt( 'elementid' ,$this->element->elementid );
		$sql->setInt( 'pageid'    ,$this->pageid    );
		$sql->setInt( 'languageid',$this->languageid);

		$list = array();
		foreach($sql->getAll() as $row )
		{
			$val = new Value();
			$val->valueid = $row['id'];
			
			$val->text           = $row['text'];
            $val->format         = $row['format'];
			$val->valueid        = intval($row['id']          );
			$val->linkToObjectId = intval($row['linkobjectid']);
			$val->number         = intval($row['number'      ]);
			$val->date           = intval($row['date'        ]);
	
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
	 * @return Array
	 */
	function getCountVersions()
	{
		$db = \cms\base\DB::get();

		$sql = $db->sql( 'SELECT COUNT(*) FROM {{value}}'.
		                '  WHERE elementid ={elementid}'.
		                '    AND pageid    ={pageid}'.
		                '    AND languageid={languageid}' );
		$sql->setInt( 'elementid' ,$this->element->elementid );
		$sql->setInt( 'pageid'    ,$this->pageid    );
		$sql->setInt( 'languageid',$this->languageid);

		return $sql->getOne();
	}


	function getLastChangeTime()
	{
		$db = \cms\base\DB::get();

		$sql = $db->sql( 
<<<SQL
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
	 * Inhalt freigeben
	 */
	function release()
	{
		$db = \cms\base\DB::get();

		$sql = $db->sql( 'UPDATE {{value}}'.
		                '  SET publish=0'.
		                '  WHERE elementid ={elementid}'.
		                '    AND pageid    ={pageid}'.
		                '    AND languageid={languageid}' );
		$sql->setInt( 'elementid' ,$this->elementid );
		$sql->setInt( 'pageid'    ,$this->pageid    );
		$sql->setInt( 'languageid',$this->languageid);

		$sql->query();

		$sql = $db->sql( 'UPDATE {{value}}'.
		                '  SET publish=1'.
		                '  WHERE active    = 1'.
		                '    AND elementid ={elementid}'.
		                '    AND pageid    ={pageid}'.
		                '    AND languageid={languageid}' );
		$sql->setInt( 'elementid' ,$this->elementid );
		$sql->setInt( 'pageid'    ,$this->pageid    );
		$sql->setInt( 'languageid',$this->languageid);

		$sql->query();
	}

	/**
	 * Inhalt speichern
	 */
	function save()
	{
		$db = \cms\base\DB::get();

		$sql = $db->sql( 'UPDATE {{value}}'.
		                '  SET active=0'.
		                '  WHERE elementid ={elementid}'.
		                '    AND pageid    ={pageid}'.
		                '    AND languageid={languageid}' );
		$sql->setInt( 'elementid' ,$this->element->elementid );
		$sql->setInt( 'pageid'    ,$this->pageid    );
		$sql->setInt( 'languageid',$this->languageid);

		$sql->query();

		if	( $this->publish )
		{
			// Wenn Inhalt sofort veroeffentlicht werden kann, dann
			// alle anderen Inhalte auf nicht-veroeffentlichen stellen 
			$sql = $db->sql( 'UPDATE {{value}}'.
			                '  SET publish=0'.
			                '  WHERE elementid ={elementid}'.
			                '    AND pageid    ={pageid}'.
			                '    AND languageid={languageid}' );
			$sql->setInt( 'elementid' ,$this->element->elementid );
			$sql->setInt( 'pageid'    ,$this->pageid    );
			$sql->setInt( 'languageid',$this->languageid);

			$sql->query();
		}

		// Naechste ID aus Datenbank besorgen
		$sql = $db->sql('SELECT MAX(id) FROM {{value}}');
		$this->valueid = intval($sql->getOne())+1;

		$sql = $db->sql( <<<SQL
INSERT INTO {{value}}
            (id       ,linkobjectid  ,text  ,number  ,date  ,elementid  ,format  ,pageid  ,languageid  ,active,publish  ,lastchange_date  ,lastchange_userid  )
     VALUES ({valueid},{linkobjectid},{text},{number},{date},{elementid},{format},{pageid},{languageid},1     ,{publish},{lastchange_date},{lastchange_userid})
SQL
		);
		$sql->setInt( 'valueid'   ,$this->valueid            );
		$sql->setInt( 'format'    ,$this->format             );
		$sql->setInt( 'elementid' ,$this->element->elementid );
		$sql->setInt( 'pageid'    ,$this->pageid             );
		$sql->setInt( 'languageid',$this->languageid         );

		if	( intval($this->linkToObjectId)==0)
			$sql->setNull  ( 'linkobjectid' );
		else	$sql->setInt   ( 'linkobjectid',$this->linkToObjectId   );

		if	( $this->text == '' )
			$sql->setNull  ( 'text' );
		else	$sql->setString( 'text',$this->text );

		if	( intval($this->number)==0)
			$sql->setNull  ( 'number' );
		else	$sql->setInt   ( 'number',$this->number );

		if	( intval($this->date)==0)
			$sql->setNull  ( 'date' );
		else	$sql->setInt   ( 'date',$this->date );

		$sql->setBoolean( 'publish'          ,$this->publish );
		$sql->setInt    ( 'lastchange_date'  ,now()         );
		$user = \util\Session::getUser();
		$sql->setInt    ( 'lastchange_userid',$user->userid  );

		$sql->query();
		
		// Nur ausfuehren, wenn in Konfiguration aktiviert.
		$limit = config('content','revision-limit');
		if	( isset($limit['enabled']) && $limit['enabled'] )
			$this->checkLimit();
	}

	
	/**
	 * Pruefen, ob maximale Anzahl von Versionen erreicht.
	 * In diesem Fall die zu alten Versionen l�schen.
	 */
	function checkLimit()
	{
		$limit = config('content','revision-limit');

		$db = \cms\base\DB::get();

		$sql = $db->sql( <<<SQL
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
		
		if	( count($values) > $limit['min-revisions'] )
		{
			$sql = $db->sql( <<<SQL
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
			$sql->setInt( 'min_date'  ,$limit['max-age']*24*60*60);
			$sql->setInt( 'min_id'    ,$values[count($values)-$limit['min-revisions']]);
			$sql->query();
		}
		
		if	( count($values) > $limit['max-revisions'] )
		{
			$sql = $db->sql( <<<SQL
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
			$sql->setInt( 'min_date'  ,$limit['min-age']*24*60*60);
			$sql->setInt( 'min_id'    ,$values[count($values)-$limit['max-revisions']]);
			$sql->query();
		}
	}

	
	
	/**
	 * Diesen Inhalt loeschen
	 */
	function delete()
	{
		$db = \cms\base\DB::get();
		$sql = $db->sql( 'DELETE * FROM {{value}}'.
		                '  WHERE elementid ={elementid}'.
		                '    AND pageid    ={pageid}'.
		                '    AND languageid={languageid}' );
		$sql->setInt( 'elementid' ,$this->element->elementid );
		$sql->setInt( 'pageid'    ,$this->pageid    );
		$sql->setInt( 'languageid',$this->languageid);
		$row = $sql->getRow();
	}



	/**
	  * Es werden Objekte mit einem Inhalt gesucht.
	  * @param String Suchbegriff
	  * @return Array Liste der gefundenen Objekt-IDs
	  */
	function getObjectIdsByValue( $text )
	{
		$db = \cms\base\DB::get();
		
		$sql = $db->sql( 'SELECT {{object}}.id FROM {{value}} '.
		                ' LEFT JOIN {{page}} '.
		                '   ON {{page}}.id={{value}}.pageid '.
		                ' LEFT JOIN {{object}} '.
		                '   ON {{object}}.id={{page}}.objectid '.
		                ' WHERE {{value}}.text LIKE {text}'.
		                '   AND {{value}}.languageid={languageid}'.
		                '  ORDER BY {{object}}.lastchange_date DESC' );
		                
		$sql->setInt   ( 'languageid',$this->languageid );
		$sql->setString( 'text'      ,'%'.$text.'%'     );
		return $sql->getCol();
	}


	/**
	  * Es werden Objekte mit einer UserId ermittelt
	  * @param Integer Benutzer-Id der letzten ?nderung
	  * @return Array Liste der gefundenen Objekt-IDs
	  */
	function getObjectIdsByLastChangeUserId( $userid )
	{

		$db = \cms\base\DB::get();
		
		$sql = $db->sql( 'SELECT {{object}}.id FROM {{value}} '.
		                ' LEFT JOIN {{page}} '.
		                '   ON {{page}}.id={{value}}.pageid '.
		                ' LEFT JOIN {{object}} '.
		                '   ON {{object}}.id={{page}}.objectid '.
		                ' WHERE {{value}}.lastchange_userid={userid}'.
		                '   AND {{value}}.languageid={languageid}'.
		                '  ORDER BY {{object}}.lastchange_date DESC' );
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
		$db = \cms\base\DB::get();
		
		$sql = $db->sql( <<<SQL
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
		$db = \cms\base\DB::get();
		
		$sql = $db->sql( <<<SQL
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
		$db = \cms\base\DB::get();
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
}