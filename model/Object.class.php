<?php
namespace cms\model;
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
 * Superklasse fuer Objekte im Projektbaum.
 * 
 * Dieses Objekt ist die Oberklasse fuer die 4 Klassen Ordner, Datei,
 * Link oder Seite dar.
 *
 * @author Jan Dankert
 * @package openrat.objects
 */
class Object
{
	/** eindeutige ID dieses Objektes
	 * @see #$objectid
	 * @type Integer
	 */
	var $id;

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

	/** Zeitpunkt der letzten Aenderung. Die Variable beinhaltet den Unix-Timestamp.
	 * @type Integer
	 */
	var $lastchangeDate;

	/** Benutzer, welcher dieses Objekt erstellt hat.
	 * @type Integer
	 */
	var $createUser;

	/** Benutzer, welcher dieses Objekt zuletzt geaendert hat.
	 * @type Integer
	 */
	var $lastchangeUser;

	/**
	 * Kennzeichen, ob Objekt ein Ordner ist
	 * @type Boolean
	 */
	var $isFolder = false;

	/**
	 * Kennzeichen, ob Objekt eine binaere Datei ist
	 * @type Boolean
	 */
	var $isFile = false;

	/**
	 * Kennzeichen, ob Objekt eine Seite ist
	 * @type Boolean
	 */
	var $isPage = false;

	/**
	 * Kennzeichen, ob Objekt eine Verknuepfung (Link) ist
	 * @type Boolean
	 */
	var $isLink = false;

	/**
	 * Kennzeichnet den Typ dieses Objektes.
	 * Muss den Inhalt OR_FILE, OR_FOLDER, OR_PAGE oder OR_LINK haben.
	 * Vorbelegung mit <code>null</code>.
	 * @type Integer
	 */
	var $type = null;
	
	/** Kennzeichen ob Objekt den Wurzelordner des Projektes darstellt (parentid ist dann NULL)
	 * @type Boolean
	 */
	var $isRoot = false;

	/** Sprach-ID
	 * @see Language
	 * @type Integer
	 */
	var $languageid;
	
	/**
	 * Projektmodell-ID
	 * @see Projectmodel
	 * @type Integer
	 */
	var $modelid;
	
	/**
	 * Projekt-ID
	 * @see Project
	 * @type Integer
	 */
	var $projectid;

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
	function __construct($objectid = '')
	{
		global $SESS;

		if	( is_numeric($objectid) )
		{
			$this->objectid = $objectid;
			$this->id       = $objectid;
		}


		$language = \Session::getProjectLanguage();
			if	( is_object($language) )
		$this->languageid = $language->languageid;

		$model = \Session::getProjectModel();
		if	( is_object($model) )
			$this->modelid = $model->modelid;

		$project = \Session::getProject();
		if	( is_object($project) )
			$this->projectid = $project->projectid;
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
			$project = \Session::getProject();
			$projectid = $project->projectid;
		}
		else
		{
			$projectid = $this->projectid;
		}

		$sql = $db->sql('SELECT id from {{object}} '.
		               '  WHERE projectid={projectid}');
		$sql->setInt('projectid', $projectid);

		return $sql->getCol($sql);
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
		if	( is_null($this->aclMask) )
		{
			$project  = \Session::getProject();
			$language = \Session::getProjectLanguage();
			$user     = \Session::getUser();
			
			if	( $user->isAdmin )
			{
				// Administratoren erhalten eine Maske mit allen Rechten
				$this->aclMask = ACL_READ +
				                 ACL_WRITE +
				                 ACL_PROP +
				                 ACL_DELETE +
				                 ACL_RELEASE +
				                 ACL_PUBLISH +
				                 ACL_CREATE_FOLDER +
				                 ACL_CREATE_FILE +
				                 ACL_CREATE_LINK +
				                 ACL_CREATE_PAGE +
				                 ACL_GRANT +
				                 ACL_TRANSMIT;
			}
			else
			{
				$this->aclMask = 0;
				
				$sqlGroupClause = $user->getGroupClause();
				$sql = $db->sql( <<<SQL
SELECT {{acl}}.* FROM {{acl}}
	                 LEFT JOIN {{object}}
	                        ON {{object}}.id={{acl}}.objectid
	                 WHERE objectid={objectid}
	                   AND ( languageid={languageid} OR languageid IS NULL )
	                   AND ( {{acl}}.userid={userid} OR $sqlGroupClause
			                                         OR ({{acl}}.userid IS NULL AND {{acl}}.groupid IS NULL) )
SQL
);
	
				$sql->setInt  ( 'languageid'  ,$language->languageid   );
				$sql->setInt  ( 'objectid'    ,$this->objectid         );
				$sql->setInt  ( 'userid'      ,$user->userid           );
		
				$db = db_connection();
				foreach( $sql->getAll( $sql ) as $row )
				{
					$acl = new Acl();
					$acl->setDatabaseRow( $row );
					
					$this->aclMask |= $acl->getMask();
				}
			}
		}
		
		if	( readonly() )
			// System ist im Nur-Lese-Zustand
			return $type == ACL_READ && $this->aclMask & $type;
		else
			// Ermittelte Maske auswerten
			return $this->aclMask & $type;
	}


	/**
	  * Typ des Objektes ermitteln
	  *
	  * @return String der Typ des Objektes entweder 'folder','file','page' oder 'link'
	  */
	function getType()
	{
		if ($this->isFolder)
			return OR_TYPE_FOLDER;
		if ($this->isFile)
			return OR_TYPE_FILE;
		if ($this->isPage)
			return OR_TYPE_PAGE;
		if ($this->isLink)
			return OR_TYPE_LINK;

		return 'unknown';
	}


	function getProperties()
	{
		return Array( 'id'               =>$this->objectid,
		              'objectid'         =>$this->objectid,
		              'parentid'         =>$this->parentid,
		              'filename'         =>$this->filename,
		              'name'             =>$this->name,
		              'desc'             =>$this->desc,
		              'description'      =>$this->desc,
		              'create_date'      =>$this->createDate,
		              'create_user'      =>$this->createUser->getProperties(),
		              'lastchange_date'  =>$this->lastchangeDate,
		              'lastchange_user'  =>$this->lastchangeUser->getProperties(),
		              'isFolder'         =>$this->isFolder,
		              'isFile'           =>$this->isFile,
		              'isLink'           =>$this->isLink,
		              'isPage'           =>$this->isPage,
		              'isRoot'           =>$this->isRoot,
		              'languageid'       =>$this->languageid,
		              'modelid'          =>$this->modelid,
		              'projectid'        =>$this->projectid,
		              'type'             =>$this->getType()  );
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
		return( strtr($this->filename, $tmp, str_repeat('-', strlen($tmp))) );
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
			
		$sql = $db->sql('SELECT 1 FROM {{object}} '.
		               ' WHERE id={objectid}');
		$sql->setInt('objectid'  , $objectid  );

		return intval($sql->getOne($sql)) == 1;
	}
	
	
	/**
	 * Lesen der Eigenschaften aus der Datenbank
	 * Es werden
	 * - die sprachunabh?ngigen Daten wie Dateiname, Typ sowie Erstellungs- und ?nderungsdatum geladen 
	 * - die sprachabh?ngigen Daten wie Name und Beschreibung geladen
	 */
	function objectLoad()
	{
		global $SESS;
		$db = db_connection();

		$sql = $db->sql('SELECT {{object}}.*,' .
		               '       {{name}}.name,{{name}}.descr,'.
		               '       lastchangeuser.name     as lastchange_username,     '.
		               '       lastchangeuser.fullname as lastchange_userfullname, '.
		               '       lastchangeuser.mail     as lastchange_usermail,     '.
		               '       createuser.name         as create_username,     '.
		               '       createuser.fullname     as create_userfullname, '.
		               '       createuser.mail         as create_usermail      '.
		               ' FROM {{object}}'.
		               ' LEFT JOIN {{name}} '.
		               '        ON {{object}}.id={{name}}.objectid AND {{name}}.languageid={languageid} '.
		               ' LEFT JOIN {{user}} as lastchangeuser '.
		               '        ON {{object}}.lastchange_userid=lastchangeuser.id '.
		               ' LEFT JOIN {{user}} as createuser '.
		               '        ON {{object}}.create_userid=createuser.id '.
		               ' WHERE {{object}}.id={objectid}');
		$sql->setInt('languageid', $this->languageid);
		$sql->setInt('objectid'  , $this->objectid  );

		$row = $sql->getRow($sql);
		
		if (count($row) == 0)
			throw new \ObjectNotFoundException('object '.$this->objectid.' not found');

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

		$sql = $db->sql('SELECT * FROM {{object}}'.
                       ' WHERE {{object}}.id={objectid}');
		$sql->setInt('objectid'  , $this->objectid  );
		$row = $sql->getRow($sql);

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

		$this->parentid  = $row['parentid' ];
		$this->projectid = $row['projectid'];
		$this->filename  = $row['filename' ];
		$this->orderid   = $row['orderid'  ];
		
		if	( intval($this->parentid) == 0 )
			$this->isRoot = true;
		else	$this->isRoot = false;

		$this->createDate     = $row['create_date'    ];
		$this->lastchangeDate = $row['lastchange_date'];

		$this->createUser = new User();
		$this->createUser->userid       = $row['create_userid'          ];
		if	( !empty($row['create_username']) )
		{
			$this->createUser->name         = $row['create_username'        ];
			$this->createUser->fullname     = $row['create_userfullname'    ];
			$this->createUser->mail         = $row['create_usermail'        ];
		}

		$this->lastchangeUser = new User();
		$this->lastchangeUser->userid   = $row['lastchange_userid'      ];
		
		if	( !empty($row['lastchange_username']) )
		{
			$this->lastchangeUser->name     = $row['lastchange_username'    ];
			$this->lastchangeUser->fullname = $row['lastchange_userfullname'];
			$this->lastchangeUser->mail     = $row['lastchange_usermail'    ];
		}

		$this->isFolder = ( $row['is_folder'] == '1' );
		$this->isFile   = ( $row['is_file'  ] == '1' );
		$this->isPage   = ( $row['is_page'  ] == '1' );
		$this->isLink   = ( $row['is_link'  ] == '1' );

		if	( $this->isRoot )
		{
			$project = \Session::getProject();
			$this->name        = $project->name;
			$this->desc        = '';
			$this->description = '';
		}
		else
		{
			$this->name        = $row['name' ];
			$this->desc        = $row['descr'];
			$this->description = $row['descr'];
		}

		$this->checkName();
	}



	/**
	 * Laden des Objektes
	 * @deprecated bitte objectLoad() benutzen
	 */
	function load()
	{
		$this->objectLoad();
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

		$sql = $db->sql('SELECT *'.' FROM {{name}}'.' WHERE objectid={objectid}'.'   AND languageid={languageid}');
		$sql->setInt('objectid'  , $this->objectid  );
		$sql->setInt('languageid', $this->languageid);
		$res = $sql->query($sql);

		if ($res->numRows() == 0)
		{
			// Wenn Name in dieser Sprache nicht vorhanden, dann irgendeinen Namen lesen
			$sql = $db->sql('SELECT *'.' FROM {{name}}'.' WHERE objectid={objectid}'.'   AND name != {blank}');
			$sql->setInt   ('objectid'  , $this->objectid  );
			$sql->setInt   ('languageid', $this->languageid);
			$sql->setString('blank'     , ''               );
			
			$res = $sql->execute();
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
		
		$sql = $db->sql( <<<SQL
UPDATE {{object}} SET 
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


		$user = \Session::getUser();
		$this->lastchangeUser = $user;
		$this->lastchangeDate = now();
		$sql->setInt   ('time'    ,$this->lastchangeDate          );
		$sql->setInt   ('userid'  ,$this->lastchangeUser->userid  );
		$sql->setString('filename', $this->filename);
		$sql->setInt   ('objectid', $this->objectid);


		$sql->query($sql);

		// Nur wenn nicht Wurzelordner
		if	( !$this->isRoot && $withName )
		{
			if	( $this->name == '' )
				$this->name = $this->filename;

			$this->objectSaveName();
		}
	}



	/**
	 * Aenderungsdatum auf Systemzeit setzen
	 */
	function setTimestamp()
	{
		$db = db_connection();

		$sql = $db->sql('UPDATE {{object}} SET '.
		               '  lastchange_date   = {time}  ,'.
		               '  lastchange_userid = {userid} '.
		               ' WHERE id={objectid}');

		$user = \Session::getUser();
		$this->lastchangeUser = $user;
		$this->lastchangeDate = now();
		
		$sql->setInt   ('userid'  ,$this->lastchangeUser->userid  );
		$sql->setInt   ('objectid',$this->objectid                );
		$sql->setInt   ('time'    ,$this->lastchangeDate          );

		$sql->query( $sql );
		
	}


	public function setCreationTimestamp()
	{
		$db = db_connection();
		
		$sql = $db->sql('UPDATE {{object}} SET '.
				'  create_date   = {time}  '.
				' WHERE id={objectid}');
		
		$sql->setInt   ('objectid',$this->objectid   );
		$sql->setInt   ('time'    ,$this->createDate );
		
		$sql->query( $sql );
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

		$sql = $db->sql(<<<SQL
SELECT COUNT(*) FROM {{name}}  WHERE objectid  ={objectid} AND languageid={languageid}
SQL
);
		$sql->setInt( 'objectid'  , $this->objectid   );
		$sql->setInt( 'languageid', $this->languageid );
		$count = $sql->getOne($sql);

		if ($count > 0)
		{
			$sql = $db->sql( <<<SQL
			UPDATE {{name}} SET 
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
			$sql->query($sql);
		}
		else
		{
			$sql = $db->sql('SELECT MAX(id) FROM {{name}}');
			$nameid = intval($sql->getOne($sql))+1;

			$sql = $db->sql('INSERT INTO {{name}}'.'  (id,objectid,languageid,name,descr)'.' VALUES( {nameid},{objectid},{languageid},{name},{desc} )');
			$sql->setInt   ('objectid'  , $this->objectid    );
			$sql->setInt   ('languageid', $this->languageid  );
			$sql->setInt   ('nameid', $nameid    );
			$sql->setString('name'  , $this->name);
			$sql->setString('desc'  , $this->desc);
			$sql->query($sql);
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

		$sql = $db->sql( 'UPDATE {{element}} '.
		                '  SET default_objectid=NULL '.
		                '  WHERE default_objectid={objectid}' );
		$sql->setInt('objectid',$this->objectid);
		$sql->query( $sql );

		$sql = $db->sql( 'UPDATE {{value}} '.
		                '  SET linkobjectid=NULL '.
		                '  WHERE linkobjectid={objectid}' );
		$sql->setInt('objectid',$this->objectid);
		$sql->query( $sql );

		$sql = $db->sql( 'UPDATE {{link}} '.
		                '  SET link_objectid=NULL '.
		                '  WHERE link_objectid={objectid}' );
		$sql->setInt('objectid',$this->objectid);
		$sql->query( $sql );


		// Objekt-Namen l?schen
		$sql = $db->sql('DELETE FROM {{name}} WHERE objectid={objectid}');
		$sql->setInt('objectid', $this->objectid);
		$sql->query($sql);

		// ACLs loeschen
		$this->deleteAllACLs();

		// Objekt l?schen
		$sql = $db->sql('DELETE FROM {{object}} WHERE id={objectid}');
		$sql->setInt('objectid', $this->objectid);
		$sql->query($sql);
	}


	/**
	 * Objekt hinzufuegen
	 */
	function objectAdd()
	{
		global $SESS;
		$db = db_connection();

		// Neue Objekt-Id bestimmen
		$sql = $db->sql('SELECT MAX(id) FROM {{object}}');
		$this->objectid = intval($sql->getOne($sql))+1;

		$this->checkFilename();
		$sql = $db->sql('INSERT INTO {{object}}'.
		               ' (id,parentid,projectid,filename,orderid,create_date,create_userid,lastchange_date,lastchange_userid,is_folder,is_file,is_page,is_link)'.
		               ' VALUES( {objectid},{parentid},{projectid},{filename},{orderid},{time},{createuserid},{createtime},{userid},{is_folder},{is_file},{is_page},{is_link} )');

		if	( $this->isRoot )
			$sql->setNull('parentid');
		else	$sql->setInt ('parentid',$this->parentid );

		$sql->setInt   ('objectid' , $this->objectid );
		$sql->setString('filename' , $this->filename );
		$sql->setString('projectid', $this->projectid);
		$sql->setInt   ('orderid'  , 99999           );
		$sql->setInt   ('time'     , now()           );
		$user = \Session::getUser();
		$sql->setInt   ('createuserid'   , $user->userid   );
		$sql->setInt   ('createtime'     , now()           );
		$user = \Session::getUser();
		$sql->setInt   ('userid'   , $user->userid   );
		
		$sql->setBoolean('is_folder',$this->isFolder);
		$sql->setBoolean('is_file',  $this->isFile);
		$sql->setBoolean('is_page',  $this->isPage);
		$sql->setBoolean('is_link',  $this->isLink);

		$sql->query($sql);

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

		$sql = $db->sql( <<<SQL
SELECT COUNT(*) FROM {{object}}
 WHERE parentid={parentid} AND filename={filename}
   AND NOT id = {objectid}
SQL
);

		$sql->setString('parentid', $this->parentid);
		$sql->setString('filename', $filename      );
		$sql->setString('objectid', $this->objectid);


		return( intval($sql->getOne($sql)) == 0 );
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
		
		$sql = $db->sql( 'SELECT id FROM {{acl}} '.
		                '  WHERE objectid={objectid}'.
		                '    AND ( languageid IS NULL OR '.
		                '          languageid = {languageid} )'.
		                '  ORDER BY userid,groupid ASC' );
		$sql->setInt('languageid',$this->languageid);
		$sql->setInt('objectid'  ,$this->objectid);

		return $sql->getCol( $sql );
	}


	function getAllAclIds()
	{
		$db = db_connection();
		
		$sql = $db->sql( 'SELECT id FROM {{acl}} '.
		                '  WHERE objectid={objectid}'.
		                '  ORDER BY userid,groupid ASC' );
		$sql->setInt('objectid'  ,$this->objectid);

		return $sql->getCol( $sql );
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
			$sql = $db->sql( 'SELECT id FROM {{acl}} '.
			                '  WHERE objectid={objectid}'.
			                '    AND is_transmit = 1'.
			                '    AND ( languageid IS NULL OR '.
			                '          languageid = {languageid} )'.
			                '  ORDER BY userid,groupid ASC' );
			$sql->setInt('objectid'  ,$oid);
			$sql->setInt('languageid',$this->languageid);
			$acls = array_merge( $acls,$sql->getCol( $sql ) );
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
			$sql = $db->sql( 'SELECT id FROM {{acl}} '.
			                '  WHERE objectid={objectid}'.
			                '    AND is_transmit = 1'.
			                '  ORDER BY userid,groupid ASC' );
			$sql->setInt('objectid'  ,$oid);
			$acls = array_merge( $acls,$sql->getCol( $sql ) );
		}

		return $acls;
	}


	/**
	 * Ermitteln aller Berechtigungsstufen, die fuer diesen Objekttyp wichtig sind
	 */
	function getRelatedAclTypes()
	{
		if	( $this->isFolder )
			return( array('read','write','delete','prop','release','publish','create_folder','create_file','create_page','create_link','grant','transmit') );
		if	( $this->isFile )
			return( array('read','write','delete','prop','release','publish','grant') );
		if	( $this->isPage )
			return( array('read','write','delete','prop','release','publish','grant') );
		if	( $this->isLink )
			return( array('read','write','delete','prop','grant') );
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
			$filename = \FileUtils::getTempDir().'/openrat';
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
		\FileUtils::getTempDir();
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

		$sql = $db->sql('UPDATE {{object}} '.'  SET orderid={orderid}'.'  WHERE id={objectid}');
		$sql->setInt('objectid', $this->objectid);
		$sql->setInt('orderid', $orderid);

		$sql->query($sql);
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

		$sql = $db->sql('UPDATE {{object}} '.'  SET parentid={parentid}'.'  WHERE id={objectid}');
		$sql->setInt('objectid', $this->objectid);
		$sql->setInt('parentid', $parentid);

		$sql->query($sql);
	}


	function getDependentObjectIds()
	{
		$db = db_connection();

		$sql = $db->sql( 'SELECT {{page}}.objectid FROM {{value}}'.
		                '  LEFT JOIN {{page}} '.
		                '    ON {{value}}.pageid = {{page}}.id '.
		                '  WHERE linkobjectid={objectid}' );
		$sql->setInt( 'objectid',$this->objectid );

		return $sql->getCol( $sql );
	}


	/**
	  * Es werden Objekte mit einem bestimmten Namen ermittelt
	  * @param String Suchbegriff
	  * @return Array Liste der gefundenen Objekt-IDs
	  */
	function getObjectIdsByFileName( $text )
	{
		$db = db_connection();
		
		$sql = $db->sql( 'SELECT id FROM {{object}} '.
		                ' WHERE filename LIKE {filename}'.
		                '   AND projectid={projectid}'.
		                '  ORDER BY lastchange_date DESC' );
		$sql->setInt   ( 'projectid',$this->projectid );
		$sql->setString( 'filename','%'.$text.'%' );
		
		return $sql->getCol( $sql );
	}


	/**
	  * Es werden Objekte mit einem Namen ermittelt
	  * @param String Suchbegriff
	  * @return Array Liste der gefundenen Objekt-IDs
	  */
	function getObjectIdsByName( $text )
	{
		$db = db_connection();
		
		$sql = $db->sql( 'SELECT {{object}}.id FROM {{object}} '.
		                ' LEFT JOIN {{name}} '.
		                '   ON {{object}}.id={{name}}.objectid'.
		                ' WHERE {{name}}.name LIKE {name}'.
		                '   AND {{name}}.languageid={languageid}'.
		                '   AND {{object}}.projectid={projectid}'.
		                '  ORDER BY lastchange_date DESC' );
		$sql->setInt   ( 'projectid' ,$this->projectid );
		$sql->setInt   ( 'languageid',$this->languageid );
		$sql->setString( 'name'      ,'%'.$text.'%' );
		
		return $sql->getCol( $sql );
	}


	/**
	  * Es werden Objekte mit einer Beschreibung ermittelt
	  * @param String Suchbegriff
	  * @return Array Liste der gefundenen Objekt-IDs
	  */
	function getObjectIdsByDescription( $text )
	{
		$db = db_connection();
		
		$sql = $db->sql( 'SELECT {{object}}.id FROM {{object}} '.
		                ' LEFT JOIN {{name}} '.
		                '   ON {{object}}.id={{name}}.objectid'.
		                ' WHERE {{name}}.descr LIKE {desc}'.
		                '   AND {{name}}.languageid={languageid}'.
		                '   AND {{object}}.projectid={projectid}'.
		                '  ORDER BY lastchange_date DESC' );
		$sql->setInt   ( 'projectid' ,$this->projectid );
		$sql->setInt   ( 'languageid',$this->languageid );
		$sql->setString( 'desc'      ,'%'.$text.'%' );
		
		return $sql->getCol( $sql );
	}


	/**
	  * Es werden Objekte mit einer UserId ermittelt
	  * @param Integer Benutzer-Id der Erstellung
	  * @return Array Liste der gefundenen Objekt-IDs
	  */
	function getObjectIdsByCreateUserId( $userid )
	{
		$db = db_connection();
		
		$sql = $db->sql( 'SELECT id FROM {{object}} '.
		                ' WHERE create_userid={userid}'.
		                '   AND projectid={projectid}'.
		                '  ORDER BY lastchange_date DESC' );
		$sql->setInt   ( 'projectid',$this->projectid );
		$sql->setInt   ( 'userid'   ,$userid          );
		
		return $sql->getCol( $sql );
	}


	/**
	  * Es werden Objekte mit einer UserId ermittelt
	  * @param Integer Benutzer-Id der letzten ?nderung
	  * @return Array Liste der gefundenen Objekt-IDs
	  */
	function getObjectIdsByLastChangeUserId( $userid )
	{
		$db = db_connection();
		
		$sql = $db->sql( 'SELECT id FROM {{object}} '.
		                ' WHERE lastchange_userid={userid}'.
		                '   AND projectid={projectid}'.
		                '  ORDER BY lastchange_date DESC' );
		$sql->setInt   ( 'projectid',$this->projectid );
		$sql->setInt   ( 'userid'   ,$userid          );
		
		return $sql->getCol( $sql );
	}


	/**
	  * Gibt true zur?ck, wenn die angegebene Objekt-ID existiert
	  * @param Integer Objekt-ID
	  * @return Boolean
	  */
	function isObjectId( $id )
	{
		$db = db_connection();
		
		$sql = $db->sql( 'SELECT id FROM {{object}} '.
		                ' WHERE id={objectid}'.
		                '   AND projectid={projectid}' );
		$sql->setInt   ( 'projectid' ,$this->projectid );
		$sql->setInt   ( 'objectid'  ,$id              );

		return ($sql->getOne($sql) == intval($id) );
	}


	
	/**
	 * Liefert die Link-Ids, die auf das aktuelle Objekt verweisen.
	 * @return Array Liste der gefundenen Objekt-IDs
	 */
	public function getLinksToMe()
	{
		$db = db_connection();
	
		$sql = $db->sql( 'SELECT objectid FROM {{link}} '.
				' WHERE link_objectid={myid}' );
		$sql->setInt   ( 'myid'   ,$this->objectid );
	
		return $sql->getCol( $sql );
	}
	
	
	

}

?>