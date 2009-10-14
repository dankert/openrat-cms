<?php
// ---------------------------------------------------------------------------
// $Id$
// ---------------------------------------------------------------------------
// DaCMS Content Management System
// Copyright (C) 2002 Jan Dankert, jandankert@jandankert.de
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
// ---------------------------------------------------------------------------
// $Log$
// Revision 1.32  2009-03-19 04:36:12  dankert
// Beim Anlegen eines Objektes sofort Standard-Rechte vergeben.
//
// Revision 1.31  2009-03-17 01:39:43  dankert
// Funktionsfähigkeit bei enable_cache=false
//
// Revision 1.30  2009-03-17 01:27:28  dankert
// Überarbeitung der temporären Dateinamen.
//
// Revision 1.29  2009-03-02 21:20:02  dankert
// Korrektur in "getTempDir()"
//
// Revision 1.28  2007-12-11 00:22:31  dankert
// Cache von Dateien und Seiten zur Performancesteigerung beim Ver?ffentlichen.
//
// Revision 1.27  2007-12-01 17:49:37  dankert
// Methode "available()" ergibt sofort "false", wenn Objekt-Id ung?ltig (Performance)
//
// Revision 1.26  2007-06-08 23:05:44  dankert
// Als tempor?res Verzeichnis das "upload_tmp_dir" aus der PHP-Konfiguration verwenden.
//
// Revision 1.25  2007-06-04 22:17:51  dankert
// Suchergebnisse absteigend nach ?nderungsdatum sortieren.
//
// Revision 1.24  2007-04-22 00:16:44  dankert
// Fehlermeldung vermeiden, wenn eine Objekt-Id nicht in der Datenbank vorhanden ist.
//
// Revision 1.23  2007-04-08 15:25:35  dankert
// Eigenschaft "type" erg?nzt.
//
// Revision 1.22  2007-04-06 01:38:52  dankert
// Namen nicht speichern, wenn leer.
//
// Revision 1.21  2007/02/14 22:10:57  dankert
// TODO f?r tmpfile-Erzeugung
//
// Revision 1.20  2006/01/29 17:26:55  dankert
// Neben "desc" auch "description" f?llen.
//
// Revision 1.19  2005/11/07 22:36:40  dankert
// Flexibere Ermittlung des Dateinamen anhand neuer Konfigurationseigenschaften.
//
// Revision 1.18  2004/12/27 23:19:47  dankert
// ungueltige Zeichen im Dateinamen mit Punkt ersetzen
//
// Revision 1.17  2004/12/20 23:04:15  dankert
// Korrektur Timestamp setzen
//
// Revision 1.16  2004/12/20 22:42:03  dankert
// Kl. Korrekturen
//
// Revision 1.15  2004/12/20 22:03:45  dankert
// Lesen des Benutzers und speichern als Objekt
//
// Revision 1.14  2004/12/20 20:01:20  dankert
// Benutzen von switch() in filename()
//
// Revision 1.13  2004/12/19 15:23:56  dankert
// Anpassung Session-Funktionen
//
// Revision 1.12  2004/12/15 23:18:09  dankert
// Anpassung an Session-Funktionen
//
// Revision 1.11  2004/11/29 23:54:36  dankert
// Korrektur Vorversion
//
// Revision 1.10  2004/11/29 23:34:39  dankert
// neue Methode setTimestamp()
//
// Revision 1.9  2004/11/29 23:24:36  dankert
// Korrektur Veroeffentlichung
//
// Revision 1.8  2004/11/29 00:02:41  dankert
// Bei L?schen von Objekten alle Referenzen in Tabelle or_link entfernen
//
// Revision 1.7  2004/11/28 22:32:52  dankert
// in getProperties() auch den Typ zurueckgeben
//
// Revision 1.6  2004/11/28 16:56:04  dankert
// in hasRight() auch Abfrage des Parent-Ordners
//
// Revision 1.5  2004/11/24 22:06:24  dankert
// Neu: setDatabaseRow() zur Performancesteigerung
//
// Revision 1.4  2004/11/15 21:34:44  dankert
// Aenderung methode hasRight()
//
// Revision 1.3  2004/11/10 22:46:52  dankert
// Neue Methoden checkFilename(), objectLoadRaw()
//
// Revision 1.2  2004/05/02 14:41:31  dankert
// Einf?gen package-name (@package)
//
// Revision 1.1  2004/04/24 15:15:12  dankert
// Initiale Version
//
// Revision 1.2  2004/03/20 14:15:07  dankert
// Kommentare
//
// Revision 1.1  2004/03/20 01:47:33  dankert
// *** empty log message ***
//
// ---------------------------------------------------------------------------

/**
 * Darstellung eines Objektes im Projektbaum.
 * Dieses Objekt stellt eines der 4 Unterobjekte Ordner,Datei,Link oder Seite dar.
 *
 * @version $Revision$
 * @author $Author$
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
	function Object($objectid = '')
	{
		global $SESS;

		if	( is_numeric($objectid) )
		{
			$this->objectid = $objectid;
			$this->id       = $objectid;
		}


		$language = Session::getProjectLanguage();
		$this->languageid = $language->languageid;

		$model = Session::getProjectModel();
		$this->modelid = $model->modelid;

		$project = Session::getProject();
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
	 * Pr?fen einer Berechtigung zu diesem Objekt
	 */
	function hasRight( $type )
	{
//		$user = Session::getUser();
//		return $user->hasRight( $this->objectid,$type ) || (isset($this->parentid)&&$user->hasRight($this->parentid,$type)&&$user->hasRight($this->parentid,ACL_TRANSMIT));
		
		if	( is_null($this->aclMask) )
		{
			$this->aclMask = 0;
			
			$project  = Session::getProject();
			$language = Session::getProjectLanguage();
			$user     = Session::getUser();
			
			if	( $user->isAdmin && !$conf['security']['readonly'] )
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

			if	( $user->isAdmin && $type & ACL_READ )
				return true;
	
			$sqlGroupClause = $user->getGroupClause();
			$sql = new Sql( <<<SQL
SELECT {t_acl}.* FROM {t_acl}
	                 LEFT JOIN {t_object}
	                        ON {t_object}.id={t_acl}.objectid
	                 WHERE objectid={objectid}
	                   AND ( languageid={languageid} OR languageid IS NULL )
	                   AND ( {t_acl}.userid={userid} OR $sqlGroupClause
			                                         OR ({t_acl}.userid IS NULL AND {t_acl}.groupid IS NULL) )
SQL
);

			$sql->setInt  ( 'languageid'  ,$language->languageid   );
			$sql->setInt  ( 'objectid'    ,$this->objectid         );
			$sql->setInt  ( 'userid'      ,$user->userid           );
	
			$db = db_connection();
			foreach( $db->getAll( $sql ) as $row )
			{
				$acl = new Acl();
				$acl->setDatabaseRow( $row );
				#Html::debug($acl,"ACL");
				
				$this->aclMask |= $acl->getMask();
			}
		}
		
//		Html::debug($type,"Anfrage");
//		Html::debug($this->aclMask,"Maske fuer Objekt ".$this->objectid);
//		Html::debug($this->aclMask & $type,"Ergebnis");
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
		              'create_user'      =>$this->createUser,
		              'lastchange_date'  =>$this->lastchangeDate,
		              'lastchange_user'  =>$this->lastchangeUser,
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

//					case 'md5':
//						$this->filename = md5(md5($this->objectid));
//						break;
				case  'ss':
					// Imitieren von "StoryServer" URLs. Wers braucht.
					$this->filename = '0,'.
					                  base_convert(str_pad($this->parentid,3,'a'),11,10).
					                  ','.
					                  base_convert(str_pad($this->objectid,7,'a'),11,10).
					                  ',00';
					break;
//					case  'title':
//						$this->filename = $this->goodFilename(trim(strtolower($this->name)));
//						break;

				default:
					die('Unknown filename style: '.$conf['filename']['style'] );
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
	function objectLoad()
	{
		global $SESS;
		$db = db_connection();

		$sql = new Sql('SELECT {t_object}.*,' .
		               '       {t_name}.name,{t_name}.descr,'.
		               '       lastchangeuser.name     as lastchange_username,     '.
		               '       lastchangeuser.fullname as lastchange_userfullname, '.
		               '       lastchangeuser.mail     as lastchange_usermail,     '.
		               '       createuser.name         as create_username,     '.
		               '       createuser.fullname     as create_userfullname, '.
		               '       createuser.mail         as create_usermail,     '.
		               '       {t_name}.name,{t_name}.descr'.
		               ' FROM {t_object}'.
		               ' LEFT JOIN {t_name} '.
		               '        ON {t_object}.id={t_name}.objectid AND {t_name}.languageid={languageid} '.
		               ' LEFT JOIN {t_user} as lastchangeuser '.
		               '        ON {t_object}.lastchange_userid=lastchangeuser.id '.
		               ' LEFT JOIN {t_user} as createuser '.
		               '        ON {t_object}.create_userid=createuser.id '.
		               ' WHERE {t_object}.id={objectid}');
		$sql->setInt('languageid', $this->languageid);
		$sql->setInt('objectid'  , $this->objectid  );

		$row = $db->getRow($sql);
		
		if	( count($row)==0 )
			die('cannot load object '.$this->objectid );

		$this->setDatabaseRow( $row );

		if (count($row) == 0)
			die('fatal: Object::objectLoad(): objectid not found: '.$this->objectid.', SQL='.$sql );

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
			die('fatal: Object::objectLoadRaw(): objectid not found: '.$this->objectid.', SQL='.$sql);

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
			$project = Session::getProject();
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
		$this->lastchangeDate = time();
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
		$this->lastchangeDate = time();

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
		$db->start();

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
		
		$db->commit();
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
		$sql->setInt   ('time'     , time()          );
		$user = Session::getUser();
		$sql->setInt   ('userid'   , $user->userid   );

		$sql->setBoolean('is_folder',$this->isFolder);
		$sql->setBoolean('is_file',  $this->isFile);
		$sql->setBoolean('is_page',  $this->isPage);
		$sql->setBoolean('is_link',  $this->isLink);

		$db->query($sql);

		if	( !empty($this->name) )
			$this->objectSaveName();
			
		$acl = new Acl();
		$acl->userid = $user->userid;
		$acl->objectid = $this->objectid;
		
		// Standard-Rechte fuer dieses neue Objekt setzen.
		// Der Benutzer hat Lese- und Schreibrechte auf das Objekt.
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

		// Aus dem Eltern-Ordner vererbbare Berechtigungen übernehmen.
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
		                '  WHERE objectid={objectid}'.
		                '  ORDER BY userid,groupid ASC' );
		$sql->setInt('objectid'  ,$this->objectid);

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
	 * Dateinamen der temporaeren Datei bestimmen
	 */
	function tmpfileYYYYYY()
	{
		if	( isset($this->tmpfile) && $this->tmpfile != '' )
			return $this->tmpfile; // Tempor�rer Dateiname bereits vorhanden.

		global $conf;
		
		// 1. Versuch: Temp-Dir aus Konfiguration.
		$tmpdir = @$conf['cache']['tmp_dir'];
		if	( $this->tmpfile === FALSE )
			$this->tmpfile = @tempnam( $tmpdir,'openrat_tmp' );

		// 2. Versuch: Temp-Dir aus "upload_tmp_dir".
		if	( $this->tmpfile === FALSE )
		{
			Html::debug($this->tmpfile,"nochmal");
			$tmpdir = ini_get('upload_tmp_dir');
			$this->tmpfile = @tempnam( $tmpdir,'openrat_tmp' );
		}
		
		elseif	( $this->tmpfile === FALSE )
		{
		Html::debug($this->tmpfile,"nochmal");
			$this->tmpfile = @tempnam( '','openrat_tmp' );
		}
			
		Html::debug($this->tmpfile,"tmpfile in objekt");
		Logger::debug( 'creating temporary file: '.$this->tmpfile );

		return $this->tmpfile;
	}


	/**
	 * Liefert einen Verzeichnisnamen fuer temporaere Dateien.
	 */
	function getTempDir()
	{
		global $conf;
		$tmpdir = @$conf['cache']['tmp_dir'];
		$tmpfile = @tempnam( $tmpdir,'openrat_tmp' );

		// 2. Versuch: Temp-Dir aus "upload_tmp_dir".
		if	( $tmpfile === FALSE )
		{
			$tmpdir = ini_get('upload_tmp_dir');
			$tmpfile = @tempnam( $tmpdir,'openrat_tmp' );
		}
		
		elseif	( $tmpfile === FALSE )
		{
			$tmpfile = @tempnam( '','openrat_tmp' );
		}
		
		$tmpdir = dirname($tmpfile);
		@unlink($tmpfile);
			
		return $tmpdir;
	}

	
	
	/**
	 * Liefert einen temporären Dateinamen.
	 * @param $attr Attribute fuer den Dateinamen, um diesen eindeutig zu gestalten.
	 * @return unknown_type
	 */
	function getTempFileName( $attr = array() )
	{
		global $conf;
		
//		if	( $conf['cache']['enable_cache'] )
//		{
			$filename = Object::getTempDir().'/openrat';
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
	function getTempFile()
	{
		return tmpfile();
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
	function isObjectId( $id )
	{
		$db = db_connection();
		
		$sql = new Sql( 'SELECT id FROM {t_object} '.
		                ' WHERE id={objectid}'.
		                '   AND projectid={projectid}' );
		$sql->setInt   ( 'projectid' ,$this->projectid );
		$sql->setInt   ( 'objectid'  ,$id              );

		return ($db->getOne($sql) == intval($id) );
	}



}

?>