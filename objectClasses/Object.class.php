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
// Revision 1.1  2004-04-24 15:15:12  dankert
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

	/** Physikalischer Dateiname des Objektes (bei Links nicht gef�llt)
	  * <em>enth�lt nicht die Dateinamen-Erweiterung</em>
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
	var $desc = '';

	/** Zeitpunkt der Erstellung. Die Variable beinhaltet den Unix-Timestamp.
	 * @type Integer
	 */
	var $create_date;

	/** Benutzer-ID welche dieses Objekt erstellt hat.
	 * @type Integer
	 */
	var $create_userid;

	/** Zeitpunkt der letzten Aenderung. Die Variable beinhaltet den Unix-Timestamp.
	 * @type Integer
	 */
	var $lastchange_date;

	/** Benutzer-ID welche dieses Objekt zuletzt geaendert hat.
	 * @type Integer
	 */
	var $lastchange_userid;

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


	/** <strong>Konstruktor</strong>
	  * F�llen des neuen Objektes mit Init-Werten
	  * Es werden die Standardwerte aus der Session benutzt, um
	  * Sprach-ID, Projektmodell-Id und Projekt-ID zu setzen
	  *
	  * @param Integer Objekt-ID (optional)
	  */
	function Object($objectid = '')
	{
		global $SESS;

		if (is_numeric($objectid))
		{
			$this->objectid = $objectid;
			$this->id = $objectid;
		}

		if	( isset($SESS['languageid']) )
			$this->languageid = $SESS['languageid'];
		else	$this->languageid = 0;

		if	( isset($SESS['modelid']) )
			$this->modelid = $SESS['modelid'];
		else	$this->modelid = 0;

		if	( isset($SESS['projectid']) )
			$this->projectid  = $SESS['projectid'];
	}


	/**
	 * Lesen aller Objekte aus dem aktuellen Projekt
	 * @return Array Alle Objekt-IDs des aktuellen Projektes 
	 */
	function getAllObjectIds()
	{
		global $SESS;
		$db = db_connection();

		if	( !isset($this->projectid) )
			$projectid = $SESS['projectid'];
		else	$projectid = $this->projectid;

		$sql = new Sql('SELECT id from {t_object} '.
		               '  WHERE projectid={projectid}');
		$sql->setInt('projectid', $projectid);

		return $db->getCol($sql->query);
	}


	// Kompletten Dateinamen des Objektes erzeugen
	function full_filename()
	{
		$path = $this->path();

		if ($path != '')
			$path.= '/';

		$path.= $this->filename();

//		if ($this->extension() != '')
//			$path.= '.'.$this->extension();

		return $path;
	}

	/**
	 * Pr�fen einer Berechtigung zu diesem Objekt
	 */
	function checkRight( $type )
	{
		return true;
	}


	/**
	 * Pr�fen einer Berechtigung zu diesem Objekt
	 */
	function hasRight( $type )
	{
		global $SESS;

		// Administratoren d�rfen alles
		if ($SESS['user']['is_admin'] == '1')
			return true;
			
		$user = new user( $SESS['user']['id'] );
		$groups = $user->getGroupIds();

		foreach( array_merge($this->getAclIds(),$this->getInheritedAclIds()) as $aclid )
		{
			$acl = new Acl( $aclid );
			$acl->load();
			
			if	( $user->userid == $acl->userid  || 
			       in_array( $acl->groupid,$groups ) )
			{
				if	( $acl->$type )
					return true;
			}
		}

		return false;
	}


	/**
	  * Typ des Objektes ermitteln
	  *
	  * @return String der Typ des Objektes entweder 'folder','file','page' oder 'link'
	  */
	function getType()
	{
		if ($this->isFolder)
			return 'folder';
		if ($this->isFile)
			return 'file';
		if ($this->isPage)
			return 'page';
		if ($this->isLink)
			return 'link';

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
		              'create_date'      =>$this->create_date,
		              'create_userid'    =>$this->create_userid,
		              'lastchange_date'  =>$this->lastchange_date,
		              'lastchange_userid'=>$this->lastchange_userid,
		              'isFolder'         =>$this->isFolder,
		              'isFile'           =>$this->isFile,
		              'isLink'           =>$this->isLink,
		              'isPage'           =>$this->isPage,
		              'isRoot'           =>$this->isRoot,
		              'languageid'       =>$this->languageid,
		              'modelid'          =>$this->modelid,
		              'projectid'        =>$this->projectid );
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
	 * Ermitteln des Dateinamens und Rueckgabe desselben
	 * @return String Dateiname
	 */
	function filename()
	{
		if ($this->filename != '')
			return $this->filename;

		$this->load();

		return $this->filename;
	}

	/**
	 * Lesen der Eigenschaften aus der Datenbank
	 * Es werden
	 * - die sprachunabh�ngigen Daten wie Dateiname, Typ sowie Erstellungs- und �nderungsdatum geladen 
	 * - die sprachabh�ngigen Daten wie Name und Beschreibung geladen
	 */
	function objectLoad()
	{
		global $SESS;
		$db = db_connection();

		$sql = new Sql('SELECT {t_object}.*,{t_name}.name,{t_name}.descr'.' FROM {t_object}'.' LEFT JOIN {t_name} ON {t_object}.id={t_name}.objectid AND {t_name}.languageid={languageid} '.' WHERE {t_object}.id={objectid}');
		$sql->setInt('objectid'  , $this->objectid  );
		$sql->setInt('languageid', $this->languageid);
		$row = $db->getRow($sql->query);

		if (count($row) == 0)
			die('fatal: objectid not found: '.$this->objectid);

		$this->parentid = $row['parentid'];
		
		if	( intval($this->parentid) == 0 )
			$this->isRoot = true;
		else	$this->isroot = false;

		$this->filename = trim(strtolower($row['filename']));

		// Dateiname muss gueltig sein,
		// ungueltige Zeichen werden entfernt
		$gueltig = 'abcdefghijklmnopqrstuvwxyz0123456789-_.';
		$tmp = strtr($this->filename, $gueltig, str_repeat('#', strlen($gueltig)));
		$this->filename = strtr($this->filename, $tmp, str_repeat('_', strlen($tmp)));

		// Falls leer, id<objectnr> als Dateinamen verwenden
		if ($this->filename == '')
			$this->filename = $this->objectid;

		$this->create_date       = $row['create_date'];
		$this->create_userid     = $row['create_userid'];
		$this->lastchange_date   = $row['lastchange_date'];
		$this->lastchange_userid = $row['lastchange_userid'];

		$this->isFolder = false;
		$this->isFile   = false;
		$this->isPage   = false;
		$this->isLink   = false;

		$this->projectid = $row['projectid'];

		if ($row['is_folder'] == '1')
			$this->isFolder = true;

		if ($row['is_file'] == '1')
			$this->isFile = true;

		if ($row['is_page'] == '1')
			$this->isPage = true;

		if ($row['is_link'] == '1')
			$this->isLink = true;

		if	( $this->isRoot )
		{
			$project = new Project( $this->projectid );
			$project->load();
			$this->name = $project->name;
			$this->desc = '';
		}
		else
		{
			$this->name = $row['name' ];
			$this->desc = $row['descr'];
		}


		// Falls leer, id<objectnr> als Dateinamen verwenden
		if ($this->name == '')
			$this->name = $this->filename;
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
		$res = $db->query($sql->query);

		if ($res->numRows() == 0)
		{
			// Wenn Name in dieser Sprache nicht vorhanden, dann irgendeinen Namen lesen
			$sql->setQuery('SELECT *'.' FROM {t_name}'.' WHERE objectid={objectid}'.'   AND name != {blank}');
			$sql->setString('blank', '');
			$res = $db->query($sql->query);
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
	function objectSave()
	{
		global $SESS;
		$db = db_connection();

		$sql = new Sql('UPDATE {t_object} SET '.
		               '  parentid={parentid},'.
		               '  lastchange_date   = {time}  ,'.
		               '  lastchange_userid = {userid},'.
		               '  filename  = {filename}'.
		               ' WHERE id={objectid}');

		if	( $this->isRoot )
			$sql->setNull('parentid');
		else	$sql->setInt ('parentid',$this->parentid );

		$sql->setInt   ('objectid', $this->objectid);
		$sql->setString('filename', $this->filename);
		$sql->setInt   ('time'    , time());
		$sql->setInt   ('userid'  , $SESS['user']['id']);

		$db->query($sql->query);

		// Nur wenn nicht Wurzelordner
		if	( !$this->isroot )
		{
			if	( $this->name == '' )
				$this->name = $this->filename;

			$this->objectSaveName();
		}
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

		$sql = new Sql('SELECT COUNT(*) FROM {t_name} '.' WHERE objectid  ={objectid}'.'   AND languageid={languageid}');
		$sql->setInt('objectid'  , $this->objectid    );
		$sql->setInt('languageid', $SESS['languageid']);
		$count = $db->getOne($sql->query);

		if ($count > 0)
		{
			$sql->setQuery('UPDATE {t_name} SET '.
			               '  name  = {name},'.
			               '  descr = {desc} '.
			               ' WHERE objectid  ={objectid}'.
			               '   AND languageid={languageid}');
			$sql->setString('name', $this->name);
			$sql->setString('desc', $this->desc);
			$db->query($sql->query);
		}
		else
		{
			$sql = new Sql('SELECT MAX(id) FROM {t_name}');
			$nameid = intval($db->getOne($sql->query))+1;

			$sql->setQuery('INSERT INTO {t_name}'.'  (id,objectid,languageid,name,descr)'.' VALUES( {nameid},{objectid},{languageid},{name},{desc} )');
			$sql->setInt   ('objectid'  , $this->objectid    );
			$sql->setInt   ('languageid', $this->languageid  );
			$sql->setInt   ('nameid', $nameid    );
			$sql->setString('name'  , $this->name);
			$sql->setString('desc'  , $this->desc);
			$db->query($sql->query);
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
		$db->query( $sql->query );

		$sql = new Sql( 'UPDATE {t_value} '.
		                '  SET linkobjectid=NULL '.
		                '  WHERE linkobjectid={objectid}' );
		$sql->setInt('objectid',$this->objectid);
		$db->query( $sql->query );


		// Objekt-Namen l�schen
		$sql = new Sql('DELETE FROM {t_name} WHERE objectid={objectid}');
		$sql->setInt('objectid', $this->objectid);
		$db->query($sql->query);

		// Objekt l�schen
		$sql = new Sql('DELETE FROM {t_object} WHERE id={objectid}');
		$sql->setInt('objectid', $this->objectid);
		$db->query($sql->query);

		$this->deleteAllACLs();
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
		$this->objectid = intval($db->getOne($sql->query))+1;

		if	( $this->filename == '' )
			$this->filename = $this->objectid;

		$sql = new Sql('SELECT COUNT(*) FROM {t_object}'.'  WHERE parentid={parentid} AND filename={filename}');
		$sql->setString('filename', $this->filename);

		if	( $this->isRoot )
			$sql->setNull('parentid');
		else	$sql->setInt ('parentid',$this->parentid );

		// Falls Objekt mit diesem Dateinamen bereits existiert, dann Dateinamen aendern
		if ($db->getOne($sql->query) > 0)
		{
			$this->filename .= md5(microtime());
		}

		$sql = new Sql('INSERT INTO {t_object}'.
		               ' (id,parentid,projectid,filename,orderid,create_date,create_userid,lastchange_date,lastchange_userid,is_folder,is_file,is_page,is_link)'.
		               ' VALUES( {objectid},{parentid},{projectid},{filename},{orderid},{time},{userid},{time},{userid},{is_folder},{is_file},{is_page},{is_link} )');

		if	( $this->isRoot )
			$sql->setNull('parentid');
		else	$sql->setInt ('parentid',$this->parentid );

		$sql->setInt   ('objectid' , $this->objectid );
		$sql->setString('filename' , $this->filename );
		$sql->setString('projectid', $this->projectid);
		$sql->setInt   ('orderid'  , 99999  );
		$sql->setInt   ('time'     , time() );
		$sql->setInt   ('userid'   , $SESS['user']['id']);

		$sql->setBoolean('is_folder',$this->isFolder);
		$sql->setBoolean('is_file',  $this->isFile);
		$sql->setBoolean('is_page',  $this->isPage);
		$sql->setBoolean('is_link',  $this->isLink);

		$db->query($sql->query);

		$this->objectSaveName();
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

		return $db->getCol( $sql->query );
	}


	function getAllAclIds()
	{
		$db = db_connection();
		
		$sql = new Sql( 'SELECT id FROM {t_acl} '.
		                '  WHERE objectid={objectid}'.
		                '  ORDER BY userid,groupid ASC' );
		$sql->setInt('objectid'  ,$this->objectid);

		return $db->getCol( $sql->query );
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
		
		foreach( $folder->parentObjectIds(true,true) as $oid )
		{
			$sql = new Sql( 'SELECT id FROM {t_acl} '.
			                '  WHERE objectid={objectid}'.
			                '    AND is_transmit = 1'.
			                '    AND ( languageid IS NULL OR '.
			                '          languageid = {languageid} )'.
			                '  ORDER BY userid,groupid ASC' );
			$sql->setInt('objectid'  ,$oid);
			$sql->setInt('languageid',$this->languageid);
			$acls = array_merge( $acls,$db->getCol( $sql->query ) );
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
		
		foreach( $folder->parentObjectIds(true,true) as $oid )
		{
			$sql = new Sql( 'SELECT id FROM {t_acl} '.
			                '  WHERE objectid={objectid}'.
			                '    AND is_transmit = 1'.
			                '  ORDER BY userid,groupid ASC' );
			$sql->setInt('objectid'  ,$oid);
			$acls = array_merge( $acls,$db->getCol( $sql->query ) );
		}

		return $acls;
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
			$acl->delete();
		}
	}


	/**
	 * Dateinamen der temporaeren Datei bestimmen
	 */
	function tmpfile()
	{
		global $conf_tmpdir;

		$this->tmpfile = $conf_tmpdir.'/tmp_file'.$this->objectid.'.tmp';
		//$this->tmpfile = $conf_tmpdir.'/'.md5('f'.$this->fileid).'.tmp';

		return $this->tmpfile;
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

		$db->query($sql->query);
	}


	/**
	 * �bergeordnete Objekt-ID dieses Objektes neu speichern
	 * die Nr. wird sofort in der Datenbank gespeichert.
	 *
	 * @param Integer �bergeordnete Objekt-ID
	 */
	function setParentId( $parentid )
	{
		$db = db_connection();

		$sql = new Sql('UPDATE {t_object} '.'  SET parentid={parentid}'.'  WHERE id={objectid}');
		$sql->setInt('objectid', $this->objectid);
		$sql->setInt('parentid', $parentid);

		$db->query($sql->query);
	}


	function getDependentObjectIds()
	{
		$db = db_connection();

		$sql = new Sql( 'SELECT {t_page}.objectid FROM {t_value}'.
		                '  LEFT JOIN {t_page} '.
		                '    ON {t_value}.pageid = {t_page}.id '.
		                '  WHERE linkobjectid={objectid}' );
		$sql->setInt( 'objectid',$this->objectid );

		return $db->getCol( $sql->query );
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
		                '   AND projectid={projectid}' );
		$sql->setInt   ( 'projectid',$this->projectid );
		$sql->setString( 'filename','%'.$text.'%' );
		
		return $db->getCol( $sql->query );
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
		                '   AND {t_object}.projectid={projectid}' );
		$sql->setInt   ( 'projectid' ,$this->projectid );
		$sql->setInt   ( 'languageid',$this->languageid );
		$sql->setString( 'name'      ,'%'.$text.'%' );
		
		return $db->getCol( $sql->query );
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
		                '   AND {t_object}.projectid={projectid}' );
		$sql->setInt   ( 'projectid' ,$this->projectid );
		$sql->setInt   ( 'languageid',$this->languageid );
		$sql->setString( 'desc'      ,'%'.$text.'%' );
		
		return $db->getCol( $sql->query );
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
		                '   AND projectid={projectid}' );
		$sql->setInt   ( 'projectid',$this->projectid );
		$sql->setInt   ( 'userid'   ,$userid          );
		
		return $db->getCol( $sql->query );
	}


	/**
	  * Es werden Objekte mit einer UserId ermittelt
	  * @param Integer Benutzer-Id der letzten �nderung
	  * @return Array Liste der gefundenen Objekt-IDs
	  */
	function getObjectIdsByLastChangeUserId( $userid )
	{
		$db = db_connection();
		
		$sql = new Sql( 'SELECT id FROM {t_object} '.
		                ' WHERE lastchange_userid={userid}'.
		                '   AND projectid={projectid}' );
		$sql->setInt   ( 'projectid',$this->projectid );
		$sql->setInt   ( 'userid'   ,$userid          );
		
		return $db->getCol( $sql->query );
	}


	/**
	  * Gibt true zur�ck, wenn die angegebene Objekt-ID existiert
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

		return ($db->getOne($sql->query) == intval($id) );
	}



}

?>