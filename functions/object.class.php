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
// Revision 1.1  2004-03-20 01:47:33  dankert
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

	/** Physikalischer Dateiname des Objektes (bei Links nicht gefüllt)
	  * <em>enthält nicht die Dateinamen-Erweiterung</em>
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

	// Datum/Benutzer Erstellung
	var $create_date;
	var $create_userid;

	// Datum/Benutzer letzte Aenderung
	var $lastchange_date;
	var $lastchange_userid;

	// Flags für den Objekttyp
	var $isFolder = false;
	var $isFile = false;
	var $isPage = false;
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
	
	/** Projektmodell-ID
	 *  @see Projectmodel
	 *  @type Integer
	 */
	var $modelid;
	
	/** Projekt-ID
	 * @see Project
	 * @type Integer
	 */
	var $projectid;

	/** Dateiname der temporaeren Datei
	 * @type String
	 */
	var $tmpfile;

	/** Füllen des neuen Objektes mit Init-Werten
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

		$this->languageid = $SESS['languageid'];
		$this->modelid    = $SESS['projectmodelid'];
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

		$sql = new Sql('SELECT id from {t_object} '.
		               '  WHERE projectid={projectid}');
		$sql->setInt('projectid', $this->projectid);

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

	function checkRight($type)
	{
		return true;
		global $SESS;

		if ($SESS['user']['is_admin'] == '1')
			return true;

		if ($SESS['rights'][$this->projectid][$this->objectid][$type] == '1')
			return true;

		return false;
	}

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

	function path()
	{
		$folder = new Folder($this->parentid);

		return implode('/', $folder->parentObjectFileNames(false, true));
	}

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
	 * - die sprachunabhängigen Daten wie Dateiname, Typ sowie Erstellungs- und Änderungsdatum geladen 
	 * - die sprachabhängigen Daten wie Name und Beschreibung geladen
	 */
	function objectLoad()
	{
		global $SESS;
		$db = db_connection();

		$sql = new Sql('SELECT {t_object}.*,{t_name}.name,{t_name}.description'.' FROM {t_object}'.' LEFT JOIN {t_name} ON {t_object}.id={t_name}.objectid AND {t_name}.languageid={languageid} '.' WHERE {t_object}.id={objectid}');
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
			$this->name = $row['name'];
			$this->desc = $row['description'];
		}


		// Falls leer, id<objectnr> als Dateinamen verwenden
		if ($this->name == '')
			$this->name = $this->filename;
	}

	function load()
	{
		$this->objectLoad();
	}

	// Lesen von logischem Namen und Beschreibung
	//
	// Diese Eigenschaften sind sprachabhaengig und stehen deswegen in einer
	// separaten Tabelle
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

	// Eigenschaften in Datenbank speichern
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

		$sql->setInt('objectid', $this->objectid);
		$sql->setString('filename', $this->filename);
		$sql->setInt('time', time());
		$sql->setInt('userid', $SESS['user']['id']);

		$db->query($sql->query);

		$this->objectSaveName();
	}

	function ObjectSaveName()
	{
		global $SESS;
		$db = db_connection();

		$sql = new Sql('SELECT COUNT(*) FROM {t_name} '.' WHERE objectid  ={objectid}'.'   AND languageid={languageid}');
		$sql->setInt('objectid', $this->objectid);
		$sql->setInt('languageid', $SESS['languageid']);
		$count = $db->getOne($sql->query);

		if ($count > 0)
		{
			$sql->setQuery('UPDATE {t_name} SET '.'  name        = {name}     ,'.'  description = {desc}      '.' WHERE objectid  ={objectid}'.'   AND languageid={languageid}');
			$sql->setString('name', $this->name);
			$sql->setString('desc', $this->desc);
			$db->query($sql->query);
		}
		else
		{
			$sql->setQuery('INSERT INTO {t_name}'.'  (objectid,languageid,name,description)'.' VALUES( {objectid},{languageid},{name},{desc} )');
			$sql->setString('name', $this->name);
			$sql->setString('desc', $this->desc);
			$db->query($sql->query);
		}
	}

	function objectDelete()
	{
		$db = db_connection();

		// Objekt-Namen löschen
		$sql = new Sql('DELETE FROM {t_name} WHERE objectid={objectid}');
		$sql->setInt('objectid', $this->objectid);
		$db->query($sql->query);

		// Objekt löschen
		$sql = new Sql('DELETE FROM {t_object} WHERE id={objectid}');
		$sql->setInt('objectid', $this->objectid);
		$db->query($sql->query);

	}

	function objectAdd()
	{
		global $SESS;
		$db = db_connection();

		$sql = new Sql('SELECT COUNT(*) FROM {t_object}'.'  WHERE parentid={parentid} AND filename={filename}');
		$sql->setString('filename', $this->filename);
		$sql->setInt('parentid', $this->parentid);

		// Falls Objekt mit diesem Dateinamen bereits existiert, dann Dateinamen aendern
		if ($db->getOne($sql->query) > 0)
		{
			$this->filename .= time();
		}

		$sql = new Sql('INSERT INTO {t_object}'.
		               ' (parentid,projectid,filename,orderid,create_date,create_userid,lastchange_date,lastchange_userid,is_folder,is_file,is_page,is_link)'.
		               ' VALUES( {parentid},{projectid},{filename},{orderid},{time},{userid},{time},{userid},{is_folder},{is_file},{is_page},{is_link} )');

		if	( $this->isRoot )
			$sql->setNull('parentid');
		else	$sql->setInt ('parentid',$this->parentid );

		$sql->setString('filename', $this->filename);
		$sql->setString('projectid',$this->projectid);
		$sql->setInt('orderid', 99999  );
		$sql->setInt('time'   , time() );
		$sql->setInt('userid' , $SESS['user']['id']);

		$sql->setBoolean('is_folder',$this->isFolder);
		$sql->setBoolean('is_file',  $this->isFile);
		$sql->setBoolean('is_page',  $this->isPage);
		$sql->setBoolean('is_link',  $this->isLink);

		$db->query($sql->query);

		// Hinzugefügte Objekt-ID bestimmen
		if	( $this->isRoot )
			$sql->setQuery('SELECT id FROM {t_object}'.'  WHERE parentid IS NULL    AND filename={filename}');
		else	$sql->setQuery('SELECT id FROM {t_object}'.'  WHERE parentid={parentid} AND filename={filename}');

		$this->objectid = $db->getOne($sql->query);

		$this->objectSaveName();
	}

	function tmpfile()
	{
		global $conf_tmpdir;

		$this->tmpfile = $conf_tmpdir.'/tmp_file'.$this->fileid.'.tmp';
		//$this->tmpfile = $conf_tmpdir.'/'.md5('f'.$this->fileid).'.tmp';

		return $this->tmpfile;
	}

	function setOrderId($orderid)
	{
		$db = db_connection();

		$sql = new Sql('UPDATE {t_object} '.'  SET orderid={orderid}'.'  WHERE id={objectid}');
		$sql->setInt('objectid', $this->objectid);
		$sql->setInt('orderid', $orderid);

		$db->query($sql->query);
	}
}

?>