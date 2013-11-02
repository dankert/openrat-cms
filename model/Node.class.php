<?php
// OpenRat Content Management System
// Copyright (C) 2012-2013 Jan Dankert, cms@jandankert.de
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

define('NODE_TYPE_ROOT'    , 1);
define('NODE_TYPE_FOLDER'  , 2);
define('NODE_TYPE_FILE'    , 3);
define('NODE_TYPE_LINK'    , 4);
define('NODE_TYPE_URL'     , 5);
define('NODE_TYPE_PAGE'    , 6);
define('NODE_TYPE_TEMPLATE', 7);
define('NODE_TYPE_ELEMENT' , 8);
define('NODE_TYPE_PROJECT' , 9);
define('NODE_TYPE_TARGET'  ,10);
define('NODE_TYPE_VALUE'   ,11);
define('NODE_TYPE_VARIANT' ,12);
define('NODE_TYPE_USER'    ,13);
define('NODE_TYPE_GROUP'   ,14);
define('NODE_TYPE_COMMENT' ,15);
define('NODE_TYPE_XMLNODE' ,16);
define('NODE_TYPE_DOCNODE' ,17);
define('NODE_TYPE_CONFIG'  ,18);
define('NODE_TYPE_UNIT'    ,19);
define('NODE_TYPE_FRAGMENT',20);

/**
 * Abstrakte Darstellung eines Baumknotens.
 * 
 * @author Jan Dankert
 * @package openrat.model
 */
class Node
{
	/** eindeutige ID dieses Objektes
	 * @see #$objectid
	 * @type Integer
	 */
	var $id;
	
	/**
	 * Linkswert.
	 * 
	 * @var Integer
	 */
	var $left;
	
	/**
	 * Rechtswert.
	 * 
	 * @var Integer
	 */
	var $right;

	/** eindeutige ID dieses Objektes
	 * @type Integer
	 */
	var $objectid;

	/** Objekt-ID des Ordners, in dem sich dieses Objekt befindet
	 * Kann "null" oder "0" sein, wenn es sich um den Wurzelordner des Projektes handelt
	 * @see #$isRoot
	 * @type Integer
	 */
	var $parentid;

	/** Physikalischer Dateiname des Objektes (bei Links nicht gef?llt)
	  * <em>enth?lt nicht die Dateinamen-Erweiterung</em>
	  * @type String
	  */
	var $filename = '';

	/** Logischer (sprachabhaengiger) Name des Objektes
	 * (wird in Tabelle <code>name</code> abgelegt)
	 * @type String
	 */
	var $name = '';

	/** Logische (sprachabhaengige) Beschreibung des Objektes
	 * (wird in Tabelle <code>name</code> abgelegt)
	 * @type String
	 */
	var $description = 'none';
	var $desc = '';

	/** Zeitpunkt der Erstellung. Die Variable beinhaltet den Unix-Timestamp.
	 * @type Integer
	 */
	var $createDate;

	/** Benutzer, welcher dieses Objekt erstellt hat.
	 * @type Integer
	 */
	var $createUser;

	/** Zeitpunkt der letzten Aenderung. Die Variable beinhaltet den Unix-Timestamp.
	 * @type Integer
	 */
	var $lastchangeDate;

	/** Benutzer, welcher dieses Objekt zuletzt geaendert hat.
	 * @type Integer
	 */
	var $lastchangeUser;


	/**
	 * Kennzeichnet den Typ dieses Objektes.
	 * Der Inhalt entspricht einer der Konstanten NODE_TYPE_*.
	 * Vorbelegung mit <code>null</code>.
	 * @type Integer
	 */
	var $type = null;
	
	/**
	 * Dateiname der temporaeren Datei
	 * @type String
	 */
	var $tmpfile;

	var $aclMask = null;

	/** <strong>Konstruktor</strong>
	  * F?llen des neuen Objektes mit Init-Werten
	  * Es werden die Standardwerte aus der Session benutzt, um
	  * Sprach-ID, Projektmodell-Id und Projekt-ID zu setzen
	  *
	  * @param Integer Objekt-ID (optional)
	  */
	function Node( $id = '')
	{
		if	( is_numeric($id) )
			$this->id = $id;
	}

	
	public function getAllChildren()
	{
		$sql = new Sql( <<<SQL
SELECT id,name FROM {t_node}
 WHERE lft > {left} and rgt < {right}
SQL
		);
		
		$sql->setInt  ( 'left' ,$this->left  );
		$sql->setInt  ( 'right',$this->right );
		
		$db = db_connection();
		return $db->getAssoc($query);		
	}

	

	/**
	 * Ermittelt die direkten Unterknoten zu diesem Knoten.
	 * @return Array<id,name>
	 */
	public function getChildren()
	{
		$sql = new Sql( <<<SQL
SELECT child.id,child.name FROM {t_node} AS child
  LEFT JOIN {t_node} AS ancestor
		 ON ancestor.lft BETWEEN {left}+1 AND {right}-1
		AND child.lft BETWEEN ancestor.lft+1 AND ancestor.rgt-1
 WHERE child.lft BETWEEN {left}+1 AND {right}-1
   AND ancestor.id IS NULL
SQL
		);
		
		$sql->setInt  ( 'left' ,$this->left  );
		$sql->setInt  ( 'right',$this->right );
		
		$db = db_connection();
		return $db->getAssoc($sql);		
	}

	

	/**
	 * Ermittelt die direkten Unterknoten zu diesem Knoten.
	 * @return Array<id,name>
	 */
	public function getChildrenOfType( $type )
	{
		$sql = new Sql( <<<SQL
SELECT child.id,child.name FROM {t_node} AS child
  LEFT JOIN {t_node} AS ancestor
		 ON ancestor.lft BETWEEN {left}+1 AND {right}-1
		AND child.lft BETWEEN ancestor.lft+1 AND ancestor.rgt-1
 WHERE child.lft BETWEEN {left}+1 AND {right}-1
   AND child.typ = {type}
   AND ancestor.id IS NULL
SQL
		);
		
		$sql->setInt  ( 'type' ,$type        );
		$sql->setInt  ( 'left' ,$this->left  );
		$sql->setInt  ( 'right',$this->right );
		
		$db = db_connection();
		return $db->getAssoc($sql);		
	}

	

	/**
	 * Ermittelt die direkten Unterknoten zu diesem Knoten.
	 * @return Array<id,name>
	 */
	public function getChildIdByName( $name )
	{
		$sql = new Sql( <<<SQL
SELECT child.id FROM {t_node} AS child
  LEFT JOIN {t_node} AS ancestor
		 ON ancestor.lft BETWEEN {left}+1 AND {right}-1
		AND child.lft BETWEEN ancestor.lft+1 AND ancestor.rgt-1
 WHERE child.lft BETWEEN {left}+1 AND {right}-1
   AND child.name = {name}
   AND ancestor.id IS NULL
SQL
		);
		
		$sql->setString( 'name' ,$name        );
		$sql->setInt   ( 'left' ,$this->left  );
		$sql->setInt   ( 'right',$this->right );
		
		$db = db_connection();
		return $db->getOne($sql);		
	}

	

	/**
	 * Ermittelt den Pfad zu diesem Knoten.
	 * 
	 * @return Array
	 */
	public function getPath()
	{
		$sql = new Sql( <<<SQL
SELECT id,name FROM {t_node}
 WHERE lft < {left} and rgt > {right}
 ORDER BY lft ASC
SQL
		);
	
		$sql->setInt  ( 'left' ,$this->left  );
		$sql->setInt  ( 'right',$this->right );
	
		$db = db_connection();
		return $db->getAssoc($query);
	}

	
	/**
	 * Ermittelt den direkten, übergeordneten Knoten.
	 *
	 * @return Array
	 */
	public function getParentId()
	{
		$sql = new Sql( <<<SQL
SELECT id FROM {t_node}
 WHERE lft < {left} and rgt > {right}
 ORDER BY lft DESC
SQL
		);
	
		$sql->setInt  ( 'left' ,$this->left  );
		$sql->setInt  ( 'right',$this->right );
	
		$db = db_connection();
		return $db->getOne($query);
	}
	
	
	/**
	 * Lesen aller Objekte aus dem aktuellen Projekt
	 * @return Array Alle Objekt-IDs des aktuellen Projektes 
	 */
	function getAllObjectIds()
	{
		global $SESS;
		$db = db_connection();

		if	( ! isset($this->projectid) )
		{
			$project = Session::getProject();
			$projectid = $project->projectid;
		}
		else
		{
			$projectid = $this->projectid;
		}

		$sql = new Sql('SELECT id from {t_object} '.
		               '  WHERE projectid={projectid}');
		$sql->setInt('projectid', $projectid);

		return $db->getCol($sql);
	}


	// Kompletten Dateinamen des Objektes erzeugen
	function full_filename()
	{
		$path = $this->path();

		if ($path != '')
			$path.= '/';

		$path.= $this->filename();

		return $path;
	}

	/**
	 * Pr?fen einer Berechtigung zu diesem Objekt
	 */
	function checkRight( $type )
	{
		return true;
	}


	/**
	 * Pruefen einer Berechtigung zu diesem Objekt
	 */
	function hasRight( $type )
	{
		$db = db_connection();
		
		if	( is_null($this->aclMask) )
		{
			$user     = Session::getUser();
			
			$this->aclMask = 0;
				
			$sqlGroupClause = $user->getGroupClause();
			$sql = new Sql( <<<SQL
SELECT mask FROM {t_acl}
	                 WHERE node={nodeid}
	                   AND ( variant IS NULL )
	                   AND ( user={userid}
					         OR grp=(SELECT grp FROM {t_usergroup} WHERE user={userid} )
			                 OR ( user IS NULL AND grp IS NULL) )
SQL
);
	
// 			$sql->setInt  ( 'languageid'  ,$language->languageid   );
			$sql->setInt  ( 'nodeid'    ,$this->id      );
			$sql->setInt  ( 'userid'      ,$user->userid  );
	
			foreach( $db->getCol($sql) as $mask )
				$this->aclMask |= $mask;
		}
		
		if	( readonly() )
			// System ist im Nur-Lese-Zustand
			return $type == ACL_READ && $this->aclMask & $type;
		else
			// Ermittelte Maske auswerten
			return $this->aclMask & $type;
	}


	/**
	  * Typ des Objektes ermitteln.
	  *
	  * @return String der Typ des Knotens, z.B. 'folder','file','page' oder 'link'.
	  */
	public function getType()
	{
		return $this->getTypeFromId( $this->type );
	}


	/**
	  * Typ des Objektes ermitteln.
	  *
	  * @return String der Typ des Knotens, z.B. 'folder','file','page' oder 'link'.
	  */
	public static function getTypeFromId( $typeId )
	{
		switch( $typeId )
		{
			case NODE_TYPE_ROOT:      return 'database';
			case NODE_TYPE_FOLDER:    return 'folder';
			case NODE_TYPE_FILE:      return 'file';
			case NODE_TYPE_LINK:      return 'link';
			case NODE_TYPE_URL:       return 'url';
			case NODE_TYPE_PAGE:      return 'page';
			case NODE_TYPE_TEMPLATE:  return 'template';
			case NODE_TYPE_ELEMENT:   return 'element';
			case NODE_TYPE_PROJECT:   return 'project';
			case NODE_TYPE_TARGET:    return 'target';
			case NODE_TYPE_VALUE:     return 'value';
			case NODE_TYPE_VARIANT:   return 'variant';
			case NODE_TYPE_USER:      return 'user';
			case NODE_TYPE_GROUP:     return 'group';
			case NODE_TYPE_COMMENT:   return 'comment';
			case NODE_TYPE_XMLNODE:   return 'xmlnode';
			case NODE_TYPE_DOCNODE:   return 'docnode';
			case NODE_TYPE_CONFIG:    return 'config';
			case NODE_TYPE_UNIT:      return 'unit';
			default:                  return 'unknown_'.$this->type;
		}
	}


	function getProperties()
	{
		return Array( 'id'               =>$this->id,
		              'name'             =>$this->name,
		              'filename'         =>$this->name,
		              'create_date'      =>$this->createDate,
		              'create_user'      =>$this->createUser,
		              'lastchange_date'  =>$this->lastchangeDate,
		              'lastchange_user'  =>$this->lastchangeUser,
		              'type'             =>$this->getType(),
		              'type_id'          =>$this->type       );
	}


	/**
	 * Ermitteln des physikalischen Dateipfades, in dem sich das Objekt befindet
	 * @return String Pfadangabe, z.B. 'pfad/zu/objekt' 
	 */
	function path()
	{
		$folder = new Folder($this->parentid);

		return implode('/', $folder->parentObjectFileNames(false, true));
	}



	/**
	 * Ueberpruft einen Dateinamen auf Gueltigkeit. 
	 */
	function goodFilename( $filename )
	{
		// Dateiname muss gueltig sein,
		// ungueltige Zeichen werden entfernt
		$gueltig = 'abcdefghijklmnopqrstuvwxyz0123456789.-_';
		$tmp = strtr($filename, $gueltig, str_repeat('#', strlen($gueltig)));
		return( str_replace('-','',strtr($this->filename, $tmp, str_repeat('-', strlen($tmp)))) );
	}



	/**
	 * Ermitteln des Dateinamens und Rueckgabe desselben
	 * @return String Dateiname
	 */
	function filename()
	{

		global $conf;

		if	( $conf['filename']['edit'] && $this->filename != '' && $this->filename != $this->objectid )
		{
			$this->filename = $this->goodFilename(trim(strtolower($this->name)));
			return $this->filename;
		}

		if	( $this->type == OR_TYPE_FOLDER )
		{
			$this->filename = $this->objectid;
		}
		elseif	( $this->orderid == 1              &&
			  !empty($conf['filename']['default']) &&
			  !$conf['filename']['edit']              )
		{
			$this->filename = $conf['filename']['default'];
		}
		else
		{
			switch( $conf['filename']['style'] )
			{
			 	case 'longid':
			 		// Eine etwas laengere ID als Dateinamen benutzen
					$this->filename = base_convert(str_pad($this->objectid,6,'a'),11,10);
					break;

				case 'id':
					// Einfach die Objekt-Id als Dateinamen verwenden.
					$this->filename = $this->objectid;
					break;

				case 'short':
					// So kurz wie moeglich: Erhoehen der Basis vom 10 auf 36.
					// Beispiele:
					// 1  -> 1
					// 10 -> a
					$this->filename = base_convert($this->objectid,10,36);
					break;

				case 'md5':
					// MD5-Summe als Dateinamen verwenden
					// Achtung: Kollisionen sind unwahrscheinlich, aber theoretisch möglich.
					$this->filename = md5(md5($this->objectid));
					break;
					
				case  'ss':
					// Imitieren von "StoryServer" URLs. Wers braucht.
					$this->filename = '0,'.
					                  base_convert(str_pad($this->parentid,3,'a'),11,10).
					                  ','.
					                  base_convert(str_pad($this->objectid,7,'a'),11,10).
					                  ',00';
					break;
					
				case  'title':
					// Achtung: Kollisionen sind möglich.
					$this->filename = $this->goodFilename(trim(strtolower($this->name)));
					break;

				default:
					// Als Fallback die Objekt-Id als Dateinamen verwenden.
					$this->filename = $this->objectid;
			}
		}

		return $this->filename;
	}



	/**
	 * Stellt fest, ob das Objekt mit der angegebenen Id existiert.
	 */
	function available( $objectid )
	{
		$db = db_connection();

		// Vielleicht k�nnen wir uns den DB-Zugriff auch ganz sparen.
		if	( !is_numeric($objectid) || $objectid <= 0 )
			return false; // Objekt-Id ung�ltig.
			
		$sql = new Sql('SELECT 1 FROM {t_object} '.
		               ' WHERE id={objectid}');
		$sql->setInt('objectid'  , $objectid  );

		return intval($db->getOne($sql)) == 1;
	}
	
	
	/**
	 * Lesen der Eigenschaften aus der Datenbank
	 * Es werden
	 * - die sprachunabh?ngigen Daten wie Dateiname, Typ sowie Erstellungs- und ?nderungsdatum geladen 
	 * - die sprachabh?ngigen Daten wie Name und Beschreibung geladen
	 */
	function nodeLoad()
	{
		global $SESS;
		$db = db_connection();
		
		$sql = new Sql( <<<SQL
SELECT * FROM {t_node}
 WHERE id={id}
SQL
				);
		$sql->setInt('id', $this->id);
		
		$row = $db->getRow($sql);
		
		if (count($row) == 0)
			throw new ObjectNotFoundException('object '.$this->objectid.' not found');
		
		$this->setDatabaseRow( $row );
		
	}


	/**
	 * Lesen der Eigenschaften aus der Datenbank
	 * Es werden
	 * - die sprachunabhaengigen Daten wie Dateiname, Typ sowie Erstellungs- und Aenderungsdatum geladen 
	 */
	function objectLoadRaw()
	{
		global $SESS;
		$db = db_connection();

		$sql = new Sql('SELECT * FROM {t_object}'.
                       ' WHERE {t_object}.id={objectid}');
		$sql->setInt('objectid'  , $this->objectid  );
		$row = $db->getRow($sql);

		if (count($row) == 0)
			die('fatal: Object::objectLoadRaw(): objectid not found: '.$this->objectid.', SQL='.$sql->raw);

		$this->parentid  = $row['parentid' ];
		$this->filename  = $row['filename' ];
		$this->projectid = $row['projectid'];
		
		if	( intval($this->parentid) == 0 )
			$this->isRoot = true;
		else
			$this->isRoot = false;

		$this->name = 'n/a';

		$this->create_date       = $row['create_date'];
		$this->create_userid     = $row['create_userid'];
		$this->lastchange_date   = $row['lastchange_date'];
		$this->lastchange_userid = $row['lastchange_userid'];


		$this->isFolder = ( $row['is_folder'] == '1' );
		$this->isFile   = ( $row['is_file'  ] == '1' );
		$this->isPage   = ( $row['is_page'  ] == '1' );
		$this->isLink   = ( $row['is_link'  ] == '1' );
	}


	/**
	 * Setzt die Eigenschaften des Objektes mit einer Datenbank-Ergebniszeile
	 *
	 * @param row Ergebniszeile aus Datenbanktabelle
	 */
	function setDatabaseRow( $row )
	{
		if	( count($row)==0 )
			die('setDatabaseRow() got empty array, oid='.$this->objectid);

		$this->id    = $row['id'  ];
		$this->name  = $row['name'];
		$this->left  = $row['lft' ];
		$this->right = $row['rgt' ];
		$this->type  = $row['typ' ];
		
		$this->isRoot = intval($this->left) == 1;

		$this->createDate     = strtotime( $row['creation'    ] );
		$this->lastchangeDate = strtotime( $row['lastmodified'] );

		$this->createUser = new User();
		$this->createUser->userid       = $row['creation_user'          ];
		if	( !empty($row['create_username']) )
		{
			$this->createUser->name         = $row['create_username'        ];
			$this->createUser->fullname     = $row['create_userfullname'    ];
			$this->createUser->mail         = $row['create_usermail'        ];
		}

		$this->lastchangeUser = new User();
		$this->lastchangeUser->userid   = $row['lastmodified_user' ];
		
		if	( !empty($row['lastchange_username']) )
		{
			$this->lastchangeUser->name     = $row['lastchange_username'    ];
			$this->lastchangeUser->fullname = $row['lastchange_userfullname'];
			$this->lastchangeUser->mail     = $row['lastchange_usermail'    ];
		}

// 		if	( $this->isRoot )
// 		{
// 			$project = Session::getProject();
// 			$this->name        = $project->name;
// 			$this->desc        = '';
// 			$this->description = '';
// 		}
// 		else
// 		{
// 			$this->name        = $row['name' ];
// 			$this->desc        = $row['descr'];
// 			$this->description = $row['descr'];
// 		}

		$this->checkName();
	}



	/**
	 * Laden des Objektes
	 * @deprecated bitte objectLoad() benutzen
	 */
	function load()
	{
		$this->nodeLoad();
	}

	/**
	 * Lesen von logischem Namen und Beschreibung
	 * Diese Eigenschaften sind sprachabhaengig und stehen deswegen in einer
	 * separaten Tabelle
	 * @access private
	 */
	function objectLoadName()
	{
		die();
		global $SESS;
		$db = db_connection();

		$sql = new Sql('SELECT *'.' FROM {t_name}'.' WHERE objectid={objectid}'.'   AND languageid={languageid}');
		$sql->setInt('objectid'  , $this->objectid  );
		$sql->setInt('languageid', $this->languageid);
		$res = $db->query($sql);

		if ($res->numRows() == 0)
		{
			// Wenn Name in dieser Sprache nicht vorhanden, dann irgendeinen Namen lesen
			$sql->setQuery('SELECT *'.' FROM {t_name}'.' WHERE objectid={objectid}'.'   AND name != {blank}');
			$sql->setString('blank', '');
			$res = $db->query($sql);
		}
		$row = $res->fetchRow();

		$this->name = $row['name'];
		$this->desc = $row['description'];

		// Falls leer, id<objectnr> als Dateinamen verwenden
		if ($this->name == '')
			$this->name = $this->filename;
	}

	/**
	 * Eigenschaften des Objektes in Datenbank speichern
	 */
	function objectSave( $withName = true )
	{
		global $SESS;
		$db = db_connection();

		$this->checkFilename();

		$sql = new Sql( <<<SQL
UPDATE {t_object} SET 
                      parentid          = {parentid},
		              lastchange_date   = {time}    ,
		              lastchange_userid = {userid}  ,
		              filename          = {filename}
 WHERE id={objectid}
SQL
);
		

		if	( $this->isRoot )
			$sql->setNull('parentid');
		else	$sql->setInt ('parentid',$this->parentid );


		$user = Session::getUser();
		$this->lastchangeUser = $user;
		$this->lastchangeDate = now();
		$sql->setInt   ('time'    ,$this->lastchangeDate          );
		$sql->setInt   ('userid'  ,$this->lastchangeUser->userid  );
		$sql->setString('filename', $this->filename);
		$sql->setInt   ('objectid', $this->objectid);


		$db->query($sql);

		// Nur wenn nicht Wurzelordner
		if	( !$this->isRoot && $withName )
		{
			if	( $this->name == '' )
				$this->name = $this->filename;

			$this->objectSaveName();
		}
	}


	
	
	function save()
	{
		$this->nodeSave();
	}
	
	
	/**
	 * Eigenschaften des Objektes in Datenbank speichern
	 */
	function nodeSave()
	{
		$db = db_connection();
	
// 		$this->checkFilename(); // TODO!
	
		$sql = new Sql( <<<SQL
UPDATE {t_node} SET
		        name = {name} ,
				lft  = {left} ,
				rgt  = {right},
    lastmodified      = {lastmodified},
    lastmodified_user = {lastmodified_user}
 WHERE id={id}
SQL
		);
	
		$user = Session::getUser();
		$this->lastchangeUser = $user;
		$this->lastchangeDate = now();

		$sql->setString('name' ,$this->name  );
		$sql->setInt   ('left' ,$this->left  );
		$sql->setInt   ('right',$this->right );
		
		$sql->setDate  ('lastmodified'     ,$this->lastchangeDate          );
		$sql->setInt   ('lastmodified_user',$this->lastchangeUser->userid  );
	
		$db->query( $sql );
	
	}	

	
	
	/**
	 * Eigenschaften des Objektes in Datenbank speichern
	 */
	function add()
	{
		$db = db_connection();
	
		// 		$this->checkFilename(); // TODO!
	
		$sql = new Sql( <<<SQL
INSERT INTO {t_node} ( id  ,typ    ,name   ,lft    ,rgt    ,hash  ,lastmodified  ,lastmodified_user  ,creation  ,creation_user  )
	           VALUES( {id},{type} ,{name} ,{left} ,{right},{hash},{lastmodified},{lastmodified_user},{creation},{creation_user});
SQL
		);
	
		$user = Session::getUser();
		$this->lastchangeUser = $user;
		$this->lastchangeDate = now();
	
		$sql->setInt   ('id'   ,$this->id    );
		$sql->setInt   ('type' ,$this->type  );
		$sql->setString('name' ,$this->name  );
		$sql->setInt   ('left' ,$this->left  );
		$sql->setInt   ('right',$this->right );
		$sql->setString('hash' ,uniqid(md5(rand()), true) );
		
		$sql->setDate  ('lastmodified'     ,$this->lastchangeDate          );
		$sql->setInt   ('lastmodified_user',$this->lastchangeUser->userid  );
		$sql->setDate  ('creation'     ,$this->createDate );
		$sql->setInt   ('creation_user',$this->createUser->userid );
	
	
		$db->query( $sql );
	
	}
	
	/**
	 * Aenderungsdatum auf Systemzeit setzen
	 */
	function setTimestamp()
	{
		$db = db_connection();

		$sql = new Sql('UPDATE {t_object} SET '.
		               '  lastchange_date   = {time}  ,'.
		               '  lastchange_userid = {userid} '.
		               ' WHERE id={objectid}');

		$user = Session::getUser();
		$this->lastchangeUser = $user;
		$this->lastchangeDate = now();
		
		$sql->setInt   ('userid'  ,$this->lastchangeUser->userid  );
		$sql->setInt   ('objectid',$this->objectid                );
		$sql->setInt   ('time'    ,$this->lastchangeDate          );

		$db->query( $sql );
		
	}



	/**
	 * Logischen Namen und Beschreibung des Objektes in Datenbank speichern
	 * (wird von objectSave() automatisch aufgerufen)
	 *
	 * @access private
	 */
	function ObjectSaveName()
	{
		global $SESS;
		$db = db_connection();

		$sql = new Sql(<<<SQL
SELECT COUNT(*) FROM {t_name}  WHERE objectid  ={objectid} AND languageid={languageid}
SQL
);
		$sql->setInt( 'objectid'  , $this->objectid   );
		$sql->setInt( 'languageid', $this->languageid );
		$count = $db->getOne($sql);

		if ($count > 0)
		{
			$sql = new Sql( <<<SQL
			UPDATE {t_name} SET 
			                 name  = {name},
			                 descr = {desc}
			                WHERE objectid  ={objectid}
			                  AND languageid={languageid}
SQL
);
			$sql->setString('name', $this->name);
			$sql->setString('desc', $this->desc);
			$sql->setInt( 'objectid'  , $this->objectid   );
			$sql->setInt( 'languageid', $this->languageid );
			$db->query($sql);
		}
		else
		{
			$sql = new Sql('SELECT MAX(id) FROM {t_name}');
			$nameid = intval($db->getOne($sql))+1;

			$sql->setQuery('INSERT INTO {t_name}'.'  (id,objectid,languageid,name,descr)'.' VALUES( {nameid},{objectid},{languageid},{name},{desc} )');
			$sql->setInt   ('objectid'  , $this->objectid    );
			$sql->setInt   ('languageid', $this->languageid  );
			$sql->setInt   ('nameid', $nameid    );
			$sql->setString('name'  , $this->name);
			$sql->setString('desc'  , $this->desc);
			$db->query($sql);
		}
	}

	/**
	 * Objekt loeschen. Es muss sichergestellt sein, dass auch das Unterobjekt geloeschet wird.
	 * Diese Methode wird daher normalerweise nur vom Unterobjekt augerufen
	 * @access protected
	 */
	function objectDelete()
	{
		$db = db_connection();

		$sql = new Sql( 'UPDATE {t_element} '.
		                '  SET default_objectid=NULL '.
		                '  WHERE default_objectid={objectid}' );
		$sql->setInt('objectid',$this->objectid);
		$db->query( $sql );

		$sql = new Sql( 'UPDATE {t_value} '.
		                '  SET linkobjectid=NULL '.
		                '  WHERE linkobjectid={objectid}' );
		$sql->setInt('objectid',$this->objectid);
		$db->query( $sql );

		$sql = new Sql( 'UPDATE {t_link} '.
		                '  SET link_objectid=NULL '.
		                '  WHERE link_objectid={objectid}' );
		$sql->setInt('objectid',$this->objectid);
		$db->query( $sql );


		// Objekt-Namen l?schen
		$sql = new Sql('DELETE FROM {t_name} WHERE objectid={objectid}');
		$sql->setInt('objectid', $this->objectid);
		$db->query($sql);

		// ACLs loeschen
		$this->deleteAllACLs();

		// Objekt l?schen
		$sql = new Sql('DELETE FROM {t_object} WHERE id={objectid}');
		$sql->setInt('objectid', $this->objectid);
		$db->query($sql);
	}


	/**
	 * Objekt hinzufuegen
	 */
	function objectAdd()
	{
		global $SESS;
		$db = db_connection();

		// Neue Objekt-Id bestimmen
		$sql = new Sql('SELECT MAX(id) FROM {t_object}');
		$this->objectid = intval($db->getOne($sql))+1;

		$this->checkFilename();
		$sql = new Sql('INSERT INTO {t_object}'.
		               ' (id,parentid,projectid,filename,orderid,create_date,create_userid,lastchange_date,lastchange_userid,is_folder,is_file,is_page,is_link)'.
		               ' VALUES( {objectid},{parentid},{projectid},{filename},{orderid},{time},{userid},{time},{userid},{is_folder},{is_file},{is_page},{is_link} )');

		if	( $this->isRoot )
			$sql->setNull('parentid');
		else	$sql->setInt ('parentid',$this->parentid );

		$sql->setInt   ('objectid' , $this->objectid );
		$sql->setString('filename' , $this->filename );
		$sql->setString('projectid', $this->projectid);
		$sql->setInt   ('orderid'  , 99999           );
		$sql->setInt   ('time'     , now()           );
		$user = Session::getUser();
		$sql->setInt   ('userid'   , $user->userid   );

		$sql->setBoolean('is_folder',$this->isFolder);
		$sql->setBoolean('is_file',  $this->isFile);
		$sql->setBoolean('is_page',  $this->isPage);
		$sql->setBoolean('is_link',  $this->isLink);

		$db->query($sql);

		if	( !empty($this->name) )
			$this->objectSaveName();
			
		// Standard-Rechte fuer dieses neue Objekt setzen.
		// Der angemeldete Benutzer erhaelt Lese- und Schreibrechte auf
		// das neue Objekt.
		$acl = new Acl();
		$acl->userid = $user->userid;
		$acl->objectid = $this->objectid;
		
		$acl->read   = true;
		$acl->write  = true;
		$acl->prop   = true;
		$acl->delete = true;
		$acl->grant = true;
		if	( $this->isFolder )
		{
			$acl->create_file   = true;
			$acl->create_page   = true;
			$acl->create_folder = true;
			$acl->create_link   = true;
		}
		$acl->add();

		// Aus dem Eltern-Ordner vererbbare Berechtigungen uebernehmen.
		$folder = new Folder( $this->parentid );
		foreach( $folder->getAclIds() as $aclid )
		{
			$acl = new Acl( $aclid );
			$acl->load();
			
			if	( $acl->transmit ) // ACL is vererbbar, also kopieren.
			{
				$acl->objectid = $this->objectid;
				$acl->add(); // ... und hinzufuegen.
			}
		}
	}


	/**
	 * Pruefung auf Gueltigkeit des Dateinamens
	 */
	function checkFilename()
	{
		if	( empty($this->filename) )
			$this->filename = $this->objectid;

//		$this->filename = trim(strtolower($this->filename));

//		$this->filename = $this->goodFilename( $this->filename);

		if	( $this->isRoot )
			return;

		if	( !$this->filenameIsUnique( $this->filename ) )
		{
//			$this->filename = $this->objectid;
//
//			if	( !$this->filenameIsUnique( $this->filename ) )
				$this->filename = $this->filename.'.'.md5(microtime());
		}
	}


	function filenameIsUnique( $filename )
	{
		$db = db_connection();

		$sql = new Sql( <<<SQL
SELECT COUNT(*) FROM {t_object}
 WHERE parentid={parentid} AND filename={filename}
   AND NOT id = {objectid}
SQL
);

		$sql->setString('parentid', $this->parentid);
		$sql->setString('filename', $filename      );
		$sql->setString('objectid', $this->objectid);


		return( intval($db->getOne($sql)) == 0 );
	}


	/**
	 * Pruefung auf Gueltigkeit des logischen Namens
	 */
	function checkName()
	{
		if	( empty($this->name) )
			$this->name = $this->filename;

		if	( empty($this->name) )
			$this->name = $this->objectid;
	}


	function getAclIds()
	{
		$db = db_connection();
		
		$sql = new Sql( 'SELECT id FROM {t_acl} '.
		                '  WHERE objectid={objectid}'.
		                '    AND ( languageid IS NULL OR '.
		                '          languageid = {languageid} )'.
		                '  ORDER BY userid,groupid ASC' );
		$sql->setInt('languageid',$this->languageid);
		$sql->setInt('objectid'  ,$this->objectid);

		return $db->getCol( $sql );
	}


	function getAllAclIds()
	{
		$db = db_connection();
		
		$sql = new Sql( 'SELECT id FROM {t_acl} '.
		                '  WHERE node={nodeid}'.
		                '  ORDER BY userid,groupid ASC' );
		$sql->setInt('nodeid'  ,$this->id);

		return $db->getCol( $sql );
	}


	function getInheritedAclIds()
	{
		$acls = array();
		
		if	( $this->getType() == 'unknown' )
			$this->load();

		// Root-Ordner erhaelt keine Vererbungen
		if	( $this->isRoot )
			return $acls;
		
		$db = db_connection();
		$folder = new Folder( $this->parentid );
		
		foreach( $folder->parentObjectFileNames(true,true) as $oid=>$filename )
		{
			$sql = new Sql( 'SELECT id FROM {t_acl} '.
			                '  WHERE objectid={objectid}'.
			                '    AND is_transmit = 1'.
			                '    AND ( languageid IS NULL OR '.
			                '          languageid = {languageid} )'.
			                '  ORDER BY userid,groupid ASC' );
			$sql->setInt('objectid'  ,$oid);
			$sql->setInt('languageid',$this->languageid);
			$acls = array_merge( $acls,$db->getCol( $sql ) );
		}

		return $acls;
	}


	function getAllInheritedAclIds()
	{
		$acls = array();
		
		if	( $this->getType() == 'unknown' )
			$this->load();

		// Root-Ordner erhaelt keine Vererbungen
		if	( $this->isRoot )
			return $acls;
		
		$db = db_connection();
		$folder = new Folder( $this->parentid );
		
		foreach( $folder->parentObjectFileNames(true,true) as $oid=>$filename )
		{
			$sql = new Sql( 'SELECT id FROM {t_acl} '.
			                '  WHERE objectid={objectid}'.
			                '    AND is_transmit = 1'.
			                '  ORDER BY userid,groupid ASC' );
			$sql->setInt('objectid'  ,$oid);
			$acls = array_merge( $acls,$db->getCol( $sql ) );
		}

		return $acls;
	}


	/**
	 * Ermitteln aller Berechtigungsstufen, die fuer diesen Objekttyp wichtig sind
	 */
	function getRelatedAclTypes()
	{
		switch( $this->type )
		{
			case NODE_TYPE_FOLDER: return array('read','write','delete','prop','release','publish','create_folder','create_file','create_page','create_link','grant','transmit');
			case NODE_TYPE_FILE:   return array('read','write','delete','prop','release','publish','grant');
			case NODE_TYPE_PAGE:   return array('read','write','delete','prop','release','publish','grant');
			case NODE_TYPE_LINK:   return array('read','write','delete','prop','grant');
			default:               return array();
		}
	}


	/**
	 * Ermitteln aller Berechtigungsstufen, die fuer diesen Objekttyp wichtig sind
	 */
	function getAssocRelatedAclTypes()
	{
		$rights = array('read','write','delete','prop','release','publish','create_folder','create_file','create_page','create_link','grant','transmit');
		$types  = array();
		foreach( $rights as $r )
			$types[$r] = false;

		foreach( $this->getRelatedAclTypes() as $t )
			$types[$t] = true;

		return $types;
	}

	/**
	 * Entfernen aller ACLs zu diesem Objekt
	 * @access private
	 */
	function deleteAllACLs()
	{
		foreach( $this->getAllAclIds() as $aclid )
		{
			$acl = new Acl( $aclid );
			$acl->load();
			$acl->delete();
		}
	}

	
	
	/**
	 * Liefert einen temporären Dateinamen.
	 * @param $attr Attribute fuer den Dateinamen, um diesen eindeutig zu gestalten.
	 * @return unknown_type
	 */
	public function getTempFileName( $attr = array() )
	{
		global $conf;
		
//		if	( $conf['cache']['enable_cache'] )
//		{
			$filename = FileUtils::getTempDir().'/openrat';
			foreach( $attr as $a=>$w )
				$filename .= '_'.$a.$w;
				
			$filename .= '.tmp';
			return $filename;
//		}
//		else
//		{
//			$tmpdir = @$conf['cache']['tmp_dir'];
//			$tmpfile = tempnam( $tmpdir,'openrat_tmp' );
//			
//			return $tmpfile;
//		}
	}



	/**
	 * Gibt ein fertiges Dateihandle fuer eine temporaere Datei zurück.
	 * @return Resource
	 */
	protected function getTempFile()
	{
		return tmpfile();
	}


	public function getTempDir()
	{
		FileUtils::getTempDir();
	}

	/**
	 * Reihenfolge-Sequenznr. dieses Objektes neu speichern
	 * die Nr. wird sofort in der Datenbank gespeichert.
	 *
	 * @param Integer neue Sequenz-Nr.
	 */
	function setOrderId( $orderid )
	{
		$db = db_connection();

		$sql = new Sql('UPDATE {t_object} '.'  SET orderid={orderid}'.'  WHERE id={objectid}');
		$sql->setInt('objectid', $this->objectid);
		$sql->setInt('orderid', $orderid);

		$db->query($sql);
	}


	/**
	 * ?bergeordnete Objekt-ID dieses Objektes neu speichern
	 * die Nr. wird sofort in der Datenbank gespeichert.
	 *
	 * @param Integer ?bergeordnete Objekt-ID
	 */
	function setParentId( $parentid )
	{
		$db = db_connection();

		$sql = new Sql('UPDATE {t_object} '.'  SET parentid={parentid}'.'  WHERE id={objectid}');
		$sql->setInt('objectid', $this->objectid);
		$sql->setInt('parentid', $parentid);

		$db->query($sql);
	}


	function getDependentObjectIds()
	{
		$db = db_connection();

		$sql = new Sql( 'SELECT {t_page}.objectid FROM {t_value}'.
		                '  LEFT JOIN {t_page} '.
		                '    ON {t_value}.pageid = {t_page}.id '.
		                '  WHERE linkobjectid={objectid}' );
		$sql->setInt( 'objectid',$this->objectid );

		return $db->getCol( $sql );
	}


	/**
	  * Es werden Objekte mit einem bestimmten Namen ermittelt
	  * @param String Suchbegriff
	  * @return Array Liste der gefundenen Objekt-IDs
	  */
	function getObjectIdsByFileName( $text )
	{
		$db = db_connection();
		
		$sql = new Sql( 'SELECT id FROM {t_object} '.
		                ' WHERE filename LIKE {filename}'.
		                '   AND projectid={projectid}'.
		                '  ORDER BY lastchange_date DESC' );
		$sql->setInt   ( 'projectid',$this->projectid );
		$sql->setString( 'filename','%'.$text.'%' );
		
		return $db->getCol( $sql );
	}


	/**
	  * Es werden Objekte mit einem Namen ermittelt
	  * @param String Suchbegriff
	  * @return Array Liste der gefundenen Objekt-IDs
	  */
	function getObjectIdsByName( $text )
	{
		$db = db_connection();
		
		$sql = new Sql( 'SELECT {t_object}.id FROM {t_object} '.
		                ' LEFT JOIN {t_name} '.
		                '   ON {t_object}.id={t_name}.objectid'.
		                ' WHERE {t_name}.name LIKE {name}'.
		                '   AND {t_name}.languageid={languageid}'.
		                '   AND {t_object}.projectid={projectid}'.
		                '  ORDER BY lastchange_date DESC' );
		$sql->setInt   ( 'projectid' ,$this->projectid );
		$sql->setInt   ( 'languageid',$this->languageid );
		$sql->setString( 'name'      ,'%'.$text.'%' );
		
		return $db->getCol( $sql );
	}


	/**
	  * Es werden Objekte mit einer Beschreibung ermittelt
	  * @param String Suchbegriff
	  * @return Array Liste der gefundenen Objekt-IDs
	  */
	function getObjectIdsByDescription( $text )
	{
		$db = db_connection();
		
		$sql = new Sql( 'SELECT {t_object}.id FROM {t_object} '.
		                ' LEFT JOIN {t_name} '.
		                '   ON {t_object}.id={t_name}.objectid'.
		                ' WHERE {t_name}.descr LIKE {desc}'.
		                '   AND {t_name}.languageid={languageid}'.
		                '   AND {t_object}.projectid={projectid}'.
		                '  ORDER BY lastchange_date DESC' );
		$sql->setInt   ( 'projectid' ,$this->projectid );
		$sql->setInt   ( 'languageid',$this->languageid );
		$sql->setString( 'desc'      ,'%'.$text.'%' );
		
		return $db->getCol( $sql );
	}


	/**
	  * Es werden Objekte mit einer UserId ermittelt
	  * @param Integer Benutzer-Id der Erstellung
	  * @return Array Liste der gefundenen Objekt-IDs
	  */
	function getObjectIdsByCreateUserId( $userid )
	{
		$db = db_connection();
		
		$sql = new Sql( 'SELECT id FROM {t_object} '.
		                ' WHERE create_userid={userid}'.
		                '   AND projectid={projectid}'.
		                '  ORDER BY lastchange_date DESC' );
		$sql->setInt   ( 'projectid',$this->projectid );
		$sql->setInt   ( 'userid'   ,$userid          );
		
		return $db->getCol( $sql );
	}


	/**
	  * Es werden Objekte mit einer UserId ermittelt
	  * @param Integer Benutzer-Id der letzten ?nderung
	  * @return Array Liste der gefundenen Objekt-IDs
	  */
	function getObjectIdsByLastChangeUserId( $userid )
	{
		$db = db_connection();
		
		$sql = new Sql( 'SELECT id FROM {t_object} '.
		                ' WHERE lastchange_userid={userid}'.
		                '   AND projectid={projectid}'.
		                '  ORDER BY lastchange_date DESC' );
		$sql->setInt   ( 'projectid',$this->projectid );
		$sql->setInt   ( 'userid'   ,$userid          );
		
		return $db->getCol( $sql );
	}


	/**
	  * Gibt true zur?ck, wenn die angegebene Objekt-ID existiert
	  * @param Integer Objekt-ID
	  * @return Boolean
	  */
	public static function nodeExists( $id )
	{
		$db = db_connection();
		
		$sql = new Sql( <<<SQL
SELECT id FROM {t_node}
 WHERE id={id}
SQL
		);
		$sql->setInt( 'id'  ,$id );

		return ($db->getOne($sql) == intval($id) );
	}


	
	/**
	 * Ermittelt die Id des Root-Knotens.
	 * @return Integer
	 */
	public static function getRootNodeId()
	{
		$db = db_connection();
		
		$sql = new Sql( <<<SQL
SELECT id FROM {t_node}
 WHERE lft=1
SQL
		);
		
		return $db->getOne( $sql );
	}

	
	
	/**
	 * Liest alle Objekte in diesem Ordner
	 * @return Array von Objekten
	 */
	public function getChildNodes()
	{
		$children = $this->getChildren();
		$liste    = array();
	
		foreach( $children as $id=>$name )
		{
			$n = new Node( $id );
			$n->load();
			$liste[] = $n;
		}
	
		return $liste;
	}
	
	
	
	
	/**
	 * Legt fest, zu welchen Knoten es welche Unterknoten geben darf.
	 * @return multitype:string |multitype:
	 */
	public function getPossibleChildTypeIds()
	{
		switch( $this->type )
		{
			case NODE_TYPE_ROOT:      return array(NODE_TYPE_COMMENT,NODE_TYPE_PROJECT,NODE_TYPE_UNIT,NODE_TYPE_USER,NODE_TYPE_GROUP);
			case NODE_TYPE_FOLDER:    return array(NODE_TYPE_COMMENT,NODE_TYPE_FOLDER,NODE_TYPE_FILE,NODE_TYPE_PAGE,NODE_TYPE_LINK,NODE_TYPE_URL);
			case NODE_TYPE_FILE:      return array();
			case NODE_TYPE_LINK:      return array();
			case NODE_TYPE_URL:       return array();
			case NODE_TYPE_PAGE:      return array();
			case NODE_TYPE_TEMPLATE:  return array(NODE_TYPE_COMMENT,NODE_TYPE_XMLNODE,NODE_TYPE_ELEMENT);
			case NODE_TYPE_ELEMENT:   return array();
			case NODE_TYPE_PROJECT:   return array(NODE_TYPE_COMMENT,NODE_TYPE_FOLDER,NODE_TYPE_USER,NODE_TYPE_GROUP,NODE_TYPE_TEMPLATE,NODE_TYPE_CONFIG,NODE_TYPE_TARGET);
			case NODE_TYPE_TARGET:    return array();
			case NODE_TYPE_VALUE:     return array(NODE_TYPE_DOCNODE,NODE_TYPE_FRAGMENT);
			case NODE_TYPE_VARIANT:   return array();
			case NODE_TYPE_USER:      return array();
			case NODE_TYPE_GROUP:     return array();
			case NODE_TYPE_COMMENT:   return array();
			case NODE_TYPE_XMLNODE:   return array(NODE_TYPE_XMLNODE,NODE_TYPE_COMMENT);
			case NODE_TYPE_DOCNODE:   return array(NODE_TYPE_DOCNODE,NODE_TYPE_COMMENT);
			case NODE_TYPE_CONFIG:    return array();
			case NODE_TYPE_UNIT:      return array(NODE_TYPE_PROJECT,NODE_TYPE_USER,NODE_TYPE_GROUP);
			case NODE_TYPE_FRAGMENT:  return array(NODE_TYPE_VALUE);
				
			default:                  return array();
		}
	}
	
	
	/**
	 * 
	 * @return multitype:string
	 */
	public function getPossibleChildTypes()
	{
		$typeNames = array();
		foreach( $this->getPossibleChildTypeIds() as $typeId )
		{
			$typeNames[$typeId] = $this->getTypeFromId($typeId);
		}
		return $typeNames;
	}
	
	
	/**
	 * Es wird ein neuer Unterknoten in diesen Knoten eingefügt. Der neue Kindknoten hat anschließend (noch) keine Kinder.
	 * @param Node $childNode
	 */
	public function addNewChild( $childNode )
	{
		$user = Session::getUser();
		$childNode->createUser = $user;
		$childNode->createDate = time();
		
		$db = db_connection();
		$sql = new Sql(<<<SQL
 SELECT MAX(id)
   FROM {t_node}
SQL
);
		$childNode->id = intval($db->getOne($sql))+1;

		// Rechtswerte erhöhen, um Platz zu schaffen
		$sql = new Sql( <<<SQL
UPDATE {t_node} SET RGT=RGT+2 WHERE RGT >= {right}
SQL
);
		$sql->setInt('right', $this->right);
		$db->query($sql);
			
		// Und auch noch die Linkswerte.
		$sql = new Sql( <<<SQL
UPDATE {t_node} SET LFT=LFT+2 WHERE LFT >= {right}
SQL
);
		$sql->setInt('right', $this->right);
		$db->query($sql);
				
		$this->load(); // Nochmal laden, damit der neue Rechts-Wert geladen wird.
		
		// Jetzt ist Platz für den neuen Knoten.
		$childNode->left  = $this->right-2;
		$childNode->right = $this->right-1;
		$childNode->add();
	}

	
	
	/**
	 * Knoten in diesen Knoten verschieben.
	 * 
	 * Ein existierender Knoten wird am Ende dieses Knotens ergänzt.
	 * 
	 * An der ursprünglichen Position wird er entfernt.
	 * Der Knoten kann auch aus einem anderen Knoten hierher verschoben werden.
	 *  
	 * @param Node $node
	 */
	public function appendExistantChild( $movedNode )
	{
		$origLeft  = $movedNode->left;
		$origRight = $movedNode->right;
		
		$node = new Node( $this->id );
		$node->load();
		
		$width = $movedNode->right - $movedNode->left + 1;
		
		// Rechtswerte erhöhen, um Platz zu schaffen
		$sql = new Sql( <<<SQL
UPDATE {t_node} SET RGT=RGT+{width} WHERE RGT >= {right}
SQL
		);
		$sql->setInt('right', $this->right);
		$sql->setInt('width', $width      );
		$db->query($sql);
			
		// Und auch noch die Linkswerte.
		$sql = new Sql( <<<SQL
UPDATE {t_node} SET LFT=LFT+{width} WHERE LFT >= {right}
SQL
		);
		$sql->setInt('right', $this->right);
		$sql->setInt('width', $width      );
		$db->query($sql);
		
		$node->load(); // Nochmal laden, damit der neue Rechts-Wert geladen wird.
		
		// Jetzt ist Platz für den neuen Knoten.
		$movedNode->left  = $node->right-$width;
		$movedNode->right = $node->right-1;
		$movedNode->save();
		
		// Nun den alten Platz wieder verfüllen
		
		// Rechtswerte verkleinern...
		$sql = new Sql( <<<SQL
UPDATE {t_node} SET RGT=RGT-{width} WHERE RGT > {right}
SQL
		);
		$sql->setInt('right', $origRight);
		$sql->setInt('width', $width    );
		$db->query($sql);
			
		// ... und auch noch die Linkswerte verkleiner.
		$sql = new Sql( <<<SQL
UPDATE {t_node} SET LFT=LFT-{width} WHERE LFT > {right}
SQL
		);
		$sql->setInt('right', $origRight );
		$sql->setInt('width', $width     );
		$db->query($sql);
		
	}
	
	/**
	 * Ändern der Reihenfolge der Kinderknoten.
	 */
	public function order( $idListe )
	{
		$user = Session::getUser();
		
		$node = new Node( $this->id );
		$node->load();
		
		$childIds = array_keys( $this->getChildren() );
		$orderIds = explode(',',$idListe);
		
		foreach( $orderIds as $id )
		{
			// Sicherstellen, dass alle zu ordnenden Knoten auch unter dem aktuellen Knoten hängen.
			if	( in_array($id,$childIds) )
			{
				$movedNode = new Node( $id );
				$movedNode->load();
				
				$node->appendExistantChild($movedNode);
			}
		}
	}
}

?>