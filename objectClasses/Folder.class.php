<?php
// ---------------------------------------------------------------------------
// $Id$
// ---------------------------------------------------------------------------
// OpenRat Content Management System
// Copyright (C) 2002-2004 Jan Dankert, jandankert@jandankert.de
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
// Revision 1.10  2006-07-19 21:30:12  dankert
// Verbesserung "getParentObjectNames()"
//
// Revision 1.9  2005/11/07 22:34:51  dankert
// Einen Sql-Befehl in ein "here-document" ausgelagert.
//
// Revision 1.8  2005/01/04 19:58:56  dankert
// neue Methoden getFirst/LastPageOrLink()
//
// Revision 1.7  2004/12/19 15:22:17  dankert
// Anpassung Session-Funktionen
//
// Revision 1.6  2004/12/15 23:18:36  dankert
// Anpassung an Session-Funktionen
//
// Revision 1.5  2004/11/29 21:10:29  dankert
// publish() mit 3 Parametern
//
// Revision 1.4  2004/11/24 22:05:45  dankert
// Korrektur getObjects()
//
// Revision 1.3  2004/11/10 22:45:56  dankert
// *** empty log message ***
//
// Revision 1.2  2004/05/02 14:41:31  dankert
// Einf?gen package-name (@package)
//
// ---------------------------------------------------------------------------


/**
 * Darstellen eines Ordners
 *
 * @version $Revision$
 * @author $Author$
 * @package openrat.objects
 */
class Folder extends Object
{
	var $folderid;
	var $projectid;
	var $parentfolders = array();
	var $subfolders    = array();
	var $filenames     = true;
	var $name     = '';
	var $filename = '';
	var $desc     = '';
	var $publish  = null;
	

	function Folder( $objectid='' )
	{
		$this->Object( $objectid );
		$this->isFolder = true;
	}


	function add()
	{
		$this->objectAdd();

		$db = db_connection();

		$sql = new Sql('SELECT MAX(id) FROM {t_folder}');
		$this->folderid = intval($db->getOne($sql->query))+1;

		$sql = new Sql('INSERT INTO {t_folder}'.
		               ' (id,objectid)'.
		               ' VALUES( {folderid},{objectid} )' );
		$sql->setInt   ('folderid'    ,$this->folderid );
		$sql->setInt   ('objectid'    ,$this->objectid );
		
		$db->query( $sql->query );
	}	
	


	function getRootFolderId()
	{
		global $SESS;
		$db = db_connection();

		$sql = new SQL('SELECT id FROM {t_folder}'.
		               '  WHERE parentid IS NULL'.
		               '    AND projectid={projectid}' );

		// Wenn Methode statisch aufgerufen wird, ist $this nicht vorhanden
		if	( isset($this) )
			$sql->setInt('projectid',$this->projectid );
		else
		{
			$project = Session::getProject();
			$sql->setInt('projectid',$project->projectid );
		}
		
		// Datenbankabfrage ausf?hren
		return $db->getOne( $sql->query );
	}


	function hasFilename( $filename )
	{
		$db = db_connection();

		$sql = new Sql('SELECT COUNT(*) FROM {t_object}'.'  WHERE parentid={objectid} AND filename={filename}');

		if	( intval($this->objectid)== 0 )
			$sql->setNull('objectid');
		else
			$sql->setString('objectid', $this->objectid);

		$sql->setString('filename', $filename      );

		return( $db->getOne($sql->query) > 0 );
	}


	function load()
	{
//		$db = db_connection();
//
//		$sql = new Sql('SELECT * FROM {t_folder} WHERE objectid={objectid}');
//		$sql->setInt('objectid',$this->objectid);
//
//		$row = $db->getRow( $sql->query );
//
		$this->objectLoad();
		
//		$this->folderid = $row['id' ];
	}



	function save()
	{
		$this->objectSave();
	}


	
	function setOrderId( $orderid )
	{
		$db = db_connection();

		$sql = new Sql('UPDATE {t_folder} '.
		               '  SET orderid={orderid}'.
		               '  WHERE id={folderid}');
		$sql->setInt('folderid',$this->folderid);
		$sql->setInt('orderid' ,$orderid       );

		$db->query( $sql->query );
	}



//	function getSubFolders()
//	{
//		global $SESS;
//		$db = db_connection();
//		
//		$sql = new Sql('SELECT id FROM {t_folder}'.
//		               '  WHERE parentid={folderid}'.
//		               '    AND projectid={projectid}'.
//		               '  ORDER BY orderid ASC' );
//		$sql->setInt('folderid' ,$SESS['folderid' ]);
//		$sql->setInt('projectid',$SESS['projectid']);
//		
//		return( $db->getCol( $sql->query ));
//	}

	
	// Liest alle Objekte in diesem Ordner
	function getObjectIds()
	{
		$db = db_connection();

		$sql = new Sql('SELECT id FROM {t_object}'.
		               '  WHERE parentid={objectid}'.
		               '  ORDER BY orderid ASC' );
		$sql->setInt('projectid',$this->projectid );
		$sql->setInt('objectid' ,$this->objectid  );
		
		return( $db->getCol( $sql->query ) );
	}



	/**
	 * Liest alle Objekte in diesem Ordner
	 * @return Array von Objekten
	 */
	function getObjects()
	{
		$db = db_connection();

		$sql = new Sql('SELECT {t_object}.*,{t_name}.name,{t_name}.descr'.
		               '  FROM {t_object}'.
		               ' LEFT JOIN {t_name} '.
		               '   ON {t_object}.id={t_name}.objectid AND {t_name}.languageid={languageid} '.
		               '  WHERE parentid={objectid}'.
		               '  ORDER BY orderid ASC' );
		$sql->setInt('languageid',$this->languageid );
		$sql->setInt('objectid'  ,$this->objectid   );
		
		$liste = array();
		$res = $db->getAll( $sql->query );
		foreach( $res as $row )
		{
			$o = new Object( $row['id'] );
			$o->setDatabaseRow( $row );
			$liste[] = $o;
		}

		return $liste;
	}


	// Liest alle Objekte in diesem Ordner
	function getObjectIdsByType()
	{
		$db = db_connection();

		$sql = new Sql('SELECT id FROM {t_object}'.
		               '  WHERE parentid={objectid}'.
		               '  ORDER BY is_link,is_page,is_file,is_folder,orderid ASC' );
		$sql->setInt('projectid',$this->projectid );
		$sql->setInt('objectid' ,$this->objectid  );
		
		return( $db->getCol( $sql->query ) );
	}


	// Liest alle Objekte in diesem Ordner sortiert nach dem Namen (nicht Dateinamen!)
	function getObjectIdsByName()
	{
		$db = db_connection();

		$sql = new Sql('SELECT {t_object}.id FROM {t_object}'.
		               '  LEFT JOIN {t_name} ON {t_object}.id={t_name}.objectid AND {t_name}.languageid={languageid} '.
                       ' WHERE parentid={objectid}'.
                       ' ORDER BY {t_name}.name,{t_object}.filename ASC');
		$sql->setInt('objectid'  , $this->objectid  );
		$sql->setInt('languageid', $this->languageid);
		return( $db->getCol( $sql->query ) );
	}


	// Liest alle Objekte in diesem Ordner
	function getObjectIdsByLastChange()
	{
		$db = db_connection();

		$sql = new Sql('SELECT id FROM {t_object}'.
		               '  WHERE parentid={objectid}'.
		               '  ORDER BY lastchange_date,orderid ASC' );
		$sql->setInt('projectid',$this->projectid );
		$sql->setInt('objectid' ,$this->objectid  );
		
		return( $db->getCol( $sql->query ) );
	}


	function publish( $withPages,$withFiles,$subdirs = false )
	{
		if	( ! is_object($this->publish) )
			$this->publish = new Publish();

		foreach( $this->getObjectIds() as $oid )
		{
			$o = new Object( $oid );
			$o->objectLoadRaw();

			if	( $o->isPage && $withPages )
			{
				$p = new Page( $oid );
				$p->load();
				$p->publish = &$this->publish;
				$p->publish();
			}

			if	( $o->isFile && $withFiles )
			{
				$f = new File( $oid );
				$f->load();
				$f->publish = &$this->publish;
				$f->publish();
			}

			if	( $o->isFolder && $subdirs )
			{
				$f = new Folder( $oid );
				$f->load();
				$f->publish = &$this->publish;
				$f->publish( $withPages,$withFiles,true );			
			}
		}
	}


	function getObjectIdByFileName( $filename )
	{
		$db = db_connection();
		
		$sql = new Sql('SELECT id FROM {t_object}'.
		               '  WHERE parentid={objectid}'.
		               '    AND filename={filename}' );
		$sql->setInt   ('objectid' ,$this->objectid );
		$sql->setString('filename' ,$filename       );
		
		return( intval($db->getOne( $sql->query )) );
	}


	function getAllObjectIds()
	{
		global $SESS;
		$db = db_connection();
		
		$sql = new Sql('SELECT id FROM {t_object}'.
		               '  WHERE projectid={projectid}'.
		               '  ORDER BY orderid ASC' );
		$project = Session::getProject();
		$sql->setInt('projectid',$project->projectid);
		
		return( $db->getCol( $sql->query ) );
	}

	
	function dgetRootObjectId()
	{
		global $SESS;
		$db = db_connection();
		
		$sql = new Sql('SELECT id FROM {t_object}'.
		               '  WHERE parentid IS NULL'.
		               '    AND projectid={projectid}' );

		if	( isset($this->projectid) )
			$sql->setInt('projectid',$this->projectid   );
		else	$sql->setInt('projectid',$SESS['projectid'] );
		
		return( $db->getOne( $sql->query ) );
	}

	
	function getOtherFolders()
	{
		global $SESS;
		$db = db_connection();
		
		$sql = new Sql('SELECT id FROM {t_object}'.
		               '  WHERE is_folder=1'.
		               '    and id != {objectid} '.
		               '    AND projectid={projectid}' );
		$sql->setInt( 'projectid',$this->projectid );
		$sql->setInt( 'objectid' ,$this->objectid  );
		
		return( $db->getCol( $sql->query ) );
	}

	
	function getAllFolders()
	{
		global $SESS;
		$db = db_connection();
		
		$sql = new Sql('SELECT id FROM {t_object}'.
		               '  WHERE is_folder=1'.
		               '    AND projectid={projectid}' );
		               
		if	( !isset($this->projectid) )
		{
			$project = Session::getProject();
			$sql->setInt('projectid',$project->projectid);
		}
		else	$sql->setInt( 'projectid',$this->projectid   );
		
		return( $db->getCol( $sql->query ) );
	}

	
	function getPages()
	{
		$db = db_connection();

		$sql = new Sql('SELECT id FROM {t_object} '.
		               '  WHERE parentid={objectid} AND is_page=1'.
		               '  ORDER BY orderid ASC' );
		$sql->setInt( 'objectid' ,$this->objectid  );

		return $db->getCol( $sql->query );
	}

	
	function getFirstPageOrLink()
	{
		$db = db_connection();

		$sql = new Sql('SELECT id FROM {t_object} '.
		               '  WHERE parentid={objectid}'.
		               '    AND (is_page=1 OR is_link=1)'.
		               '  ORDER BY orderid ASC' );
		$sql->setInt( 'objectid' ,$this->objectid  );

		$oid = intval($db->getOne( $sql->query ));
		
		if	( $oid != 0 )
			$o = new Object($oid);
		else
			$o = null;

		return $o;
	}


	function getLastPageOrLink()
	{
		$db = db_connection();

		$sql = new Sql('SELECT id FROM {t_object} '.
		               '  WHERE parentid={objectid}'.
		               '    AND (is_page=1 OR is_link=1)'.
		               '  ORDER BY orderid DESC' );
		$sql->setInt( 'objectid' ,$this->objectid  );

		$oid = intval($db->getOne( $sql->query ));
		
		if	( $oid != 0 )
			$o = new Object($oid);
		else
			$o = null;

		return $o;
	}

	
	function getFiles()
	{
		$db = db_connection();

		$sql = new Sql('SELECT id FROM {t_object} '.
		               '  WHERE parentid={objectid} AND is_file=1'.
		               '  ORDER BY orderid ASC' );
		$sql->setInt( 'objectid' ,$this->objectid  );

		return $db->getCol( $sql->query );
	}

	
	function getLinks()
	{
		$db = db_connection();

		$sql = new Sql('SELECT id FROM {t_object} '.
		               '  WHERE parentid={objectid} AND is_link=1'.
		               '  ORDER BY orderid ASC' );
		$sql->setInt( 'objectid' ,$this->objectid  );

		return $db->getCol( $sql->query );
	}

	
	// Rechte f?r diesen Ordner hinzuf?gen
	function addrights( $rights,$inherit = true )
	{
		global $SESS;

		$SESS['rights'][$rights['projectid']][$this->folderid]['show'] = true;

		if   ($rights['read'] == '1')
			$SESS['rights'][$rights['projectid']][$this->folderid]['read'] = 1;
		if   ($rights['write'] == '1')
			$SESS['rights'][$rights['projectid']][$this->folderid]['write'] = 1;
		if   ($rights['create'] == '1')
			$SESS['rights'][$rights['projectid']][$this->folderid]['create'] = 1;
		if   ($rights['delete'] == '1')
			$SESS['rights'][$rights['projectid']][$this->folderid]['delete'] = 1;
		if   ($rights['publish'] == '1')
			$SESS['rights'][$rights['projectid']][$this->folderid]['publish'] = 1;
		
		// Rechte auf Unterordner vererben
		// sowie f?r ?bergeordnete Ordner die Anzeige erzwingen 	
		if   ( $inherit )
		{
			// ?bergeordnete Ordner ermitteln
			$parentfolder = $this->parentObjectIds();

			// ?bergeordnete Ordner immer anzeigen (Schalter 'show'=true)
			foreach( $parentfolder as $folderid=>$name )
			{
				$f = new Folder( $folderid );
				$f->projectid = $this->projectid;
				$f->addrights( array('projectid'=>$rights['projectid']),false );
				unset($f);
			}

			$f = new Folder( 'null' );
			$f->projectid = $this->projectid;
			$f->addrights( array('projectid'=>$rights['projectid']),false );
			unset($f);


			// Unterordner ermitteln
			//echo "Kurz vor subfolderberechnung, folderid ist ".$this->folderid.'<br>';
			$subfolder = $this->subfolder();

			// Rechte weitergeben
			foreach( $subfolder as $folderid=>$name )
			{
				$f = new Folder( $folderid );
				$f->projectid = $this->projectid;
				$f->addrights( $rights,false );
				unset($f);
			}
		}
	}


	// Ermitteln aller ?bergeordneten Ordner
	//
	function parentfolder_bak( $with_root = false, $with_self = false )
	{
		$db = db_connection();
		$this->parentfolders = array();
		
		// ?bergeordneten Ordner lesen
		$sql = new Sql('SELECT parentid FROM {t_folder} WHERE id={folderid}');

		$sql->setInt('folderid',$this->folderid);
		$parentid = $db->getOne( $sql->query );

		// Ordner ist bereits h?chster Ordner
		if   ( !is_numeric($parentid))
		{
			// Falls Anzeige h?chster oder aktueller Ordner
			if   ( $with_root && $with_self )
			{
				if   ( $this->filenames )
					$this->parentfolders[ $this->folderid ] = $this->filename;
				else	$this->parentfolders[ $this->folderid ] = $this->name;
			}

			return $this->parentfolders;
		}

		// Aktuellen Ordner hinzuf?gen
		if   ( $with_self )
		{
			if   ( $this->filenames )
				$this->parentfolders[ $this->folderid ] = $this->filename;
			else	$this->parentfolders[ $this->folderid ] = $this->name;
		}

		// Schleife ?ber alle ?bergeordneten Ordner
		while( is_numeric($parentid) )
		{
			$sql = new Sql('SELECT * FROM {t_folder} WHERE id={folderid}');
			$sql->setInt('folderid',$parentid);

			$row_folder = $db->getRow( $sql->query );

			if   (is_numeric($row_folder['parentid']) || $with_root)
			{
				if   ( $this->filenames )
					$this->parentfolders[ $parentid ] = $row_folder['filename'];
				else	$this->parentfolders[ $parentid ] = $row_folder['name'];
			}
			
			$parentid = $row_folder['parentid'];
		}

	
		// Reihenfolge umdrehen
		$this->parentfolders = array_reverse($this->parentfolders,true);
		
		return $this->parentfolders;
	}


	function addParentFolder( $id,$name,$filename='' )
	{
		if  ( empty($name) )
			$name = $filename;
			
		if  ( empty($name) )
			$name = "($id)";
			
		if	( intval($id) != 0 )
			$this->parentfolders[ $id ] = $name;
	}


	function checkParentFolders( $with_root, $with_self )
	{
		// Reihenfolge umdrehen
		$this->parentfolders = array_reverse($this->parentfolders,true);

		// Ordner ist bereits hoechster Ordner
//		if   ( count($this->parentfolders) == 2 && $this->isRoot && $with_root && $with_self )
//		{
//			array_pop  ( $this->parentfolders );
//			return;
//		}


		if   ( !$with_root )
		{
			$keys = array_keys( $this->parentfolders );
			unset( $this->parentfolders[$keys[0]] );
		}

		if   ( !$with_self )
		{
			$keys = array_keys( $this->parentfolders );
			unset( $this->parentfolders[$keys[count($keys)-1]] );
		}
	}


	// Ermitteln aller ?bergeordneten Ordner
	//
	function parentObjectIds( $with_root = false, $with_self = false )
	{
		$db = Session::getDatabase();
		$this->parentfolders = array();
		
		// ?bergeordneten Ordner lesen
		//$sql = new Sql('SELECT parentid FROM {t_object} WHERE id={objectid}');
		$sql = new Sql('SELECT F0.id AS f0id,'.
		               '       F1.id AS f1id,'.
		               '       F2.id AS f2id,'.
		               '       F3.id AS f3id,'.
		               '       F4.id AS f4id,'.
		               '       F5.id AS f5id '.
		               '  FROM {t_object} AS F0'.
		               ' LEFT JOIN {t_object} AS F1 on F0.parentid=F1.id '.
		               ' LEFT JOIN {t_object} AS F2 on F1.parentid=F2.id '.
		               ' LEFT JOIN {t_object} AS F3 on F2.parentid=F3.id '.
		               ' LEFT JOIN {t_object} AS F4 on F3.parentid=F4.id '.
		               ' LEFT JOIN {t_object} AS F5 on F4.parentid=F5.id '.
		               ' WHERE F0.id={objectid}');

//		               ' LEFT JOIN {t_name} '.
//		               '   ON {t_object}.id={t_name}.objectid AND {t_name}.languageid={languageid} '.

		$sql->setInt('objectid',$this->objectid);

		$row = $db->getRow( $sql->query );

		$this->parentfolders = array();
		$this->addParentfolder( $row['f0id'],$row['f0id'] );
		$this->addParentfolder( $row['f1id'],$row['f1id'] );
		$this->addParentfolder( $row['f2id'],$row['f2id'] );
		$this->addParentfolder( $row['f3id'],$row['f3id'] );
		$this->addParentfolder( $row['f4id'],$row['f4id'] );
		$this->addParentfolder( $row['f5id'],$row['f5id'] );

		$this->checkParentFolders($with_root,$with_self);
	
		return $this->parentfolders;
	}


	function parentObjectFileNames(  $with_root = false, $with_self = false  )
	{
		$db = Session::getDatabase();

		$sql = new Sql( <<<EOF
SELECT F0.id       AS f0id,
      F0.filename AS f0filename,
      F1.id       AS f1id,
      F1.filename AS f1filename,
      F2.id       AS f2id,
      F2.filename AS f2filename,
      F3.id       AS f3id,
      F3.filename AS f3filename,
      F4.id       AS f4id,
      F4.filename AS f4filename,
      F5.id       AS f5id,
      F5.filename AS f5filename
 FROM {t_object} AS F0
LEFT JOIN {t_object} AS F1 on F0.parentid=F1.id 
LEFT JOIN {t_object} AS F2 on F1.parentid=F2.id 
LEFT JOIN {t_object} AS F3 on F2.parentid=F3.id 
LEFT JOIN {t_object} AS F4 on F3.parentid=F4.id 
LEFT JOIN {t_object} AS F5 on F4.parentid=F5.id 
WHERE F0.id={objectid}
EOF
 );

		$sql->setInt('objectid'  ,$this->objectid  );
		$sql->setInt('languageid',$this->languageid);

		$row = $db->getRow( $sql->query );

		$this->addParentfolder( $row['f0id'],$row['f0filename'] );
		$this->addParentfolder( $row['f1id'],$row['f1filename'] );
		$this->addParentfolder( $row['f2id'],$row['f2filename'] );
		$this->addParentfolder( $row['f3id'],$row['f3filename'] );
		$this->addParentfolder( $row['f4id'],$row['f4filename'] );
		$this->addParentfolder( $row['f5id'],$row['f5filename'] );

		$this->checkParentFolders($with_root,$with_self);
		
		return $this->parentfolders;
	}

	function parentObjectNames( $with_root = false, $with_self = false )
	{
		$db = Session::getDatabase();

		$sql = new Sql( <<<EOF
SELECT F0.id       AS f0id,
      F0.filename AS f0filename,
      F1.filename AS f1filename,
      F2.filename AS f2filename,
      F3.filename AS f3filename,
      F4.filename AS f4filename,
      F5.filename AS f5filename,
      	                      F0NAME.name AS f0name,
		                      F1.id       AS f1id,
		                      F1NAME.name AS f1name,
		                      F2.id       AS f2id,
		                      F2NAME.name AS f2name,
		                      F3.id       AS f3id,
		                      F3NAME.name AS f3name,
		                      F4.id       AS f4id,
		                      F4NAME.name AS f4name,
		                      F5.id       AS f5id, 
		                      F5NAME.name AS f5name
		                 FROM {t_object} AS F0
		                LEFT JOIN {t_name}   AS F0NAME ON F0NAME.objectid=F0.id AND F0NAME.languageid={languageid} 
		                LEFT JOIN {t_object} AS F1 on F0.parentid=F1.id 
		                LEFT JOIN {t_name}   AS F1NAME ON F1NAME.objectid=F1.id AND F1NAME.languageid={languageid} 
		                LEFT JOIN {t_object} AS F2 on F1.parentid=F2.id 
		                LEFT JOIN {t_name}   AS F2NAME ON F2NAME.objectid=F2.id AND F2NAME.languageid={languageid} 
		                LEFT JOIN {t_object} AS F3 on F2.parentid=F3.id 
		                LEFT JOIN {t_name}   AS F3NAME ON F3NAME.objectid=F3.id AND F3NAME.languageid={languageid} 
		                LEFT JOIN {t_object} AS F4 on F3.parentid=F4.id 
		                LEFT JOIN {t_name}   AS F4NAME ON F4NAME.objectid=F4.id AND F4NAME.languageid={languageid} 
		                LEFT JOIN {t_object} AS F5 on F4.parentid=F5.id 
		                LEFT JOIN {t_name}   AS F5NAME ON F5NAME.objectid=F5.id AND F5NAME.languageid={languageid} 
		                WHERE F0.id={objectid}
EOF
 );
		$sql->setInt('objectid'  ,$this->objectid  );
		$sql->setInt('languageid',$this->languageid);

		$row = $db->getRow( $sql->query );

		$this->addParentfolder( $row['f0id'],$row['f0name'],$row['f0filename'] );
		$this->addParentfolder( $row['f1id'],$row['f1name'],$row['f1filename'] );
		$this->addParentfolder( $row['f2id'],$row['f2name'],$row['f2filename'] );
		$this->addParentfolder( $row['f3id'],$row['f3name'],$row['f3filename'] );
		$this->addParentfolder( $row['f4id'],$row['f4name'],$row['f4filename'] );
		$this->addParentfolder( $row['f5id'],$row['f5name'],$row['f5filename'] );

		$this->checkParentFolders($with_root,$with_self);
		
		return $this->parentfolders;
	}


	// Ermitteln aller Unterordner
	//
	function subfolder()
	{
		$db = db_connection();

		$sql = new Sql('SELECT id FROM {t_object} '.
		               '  WHERE parentid={objectid} AND is_folder=1'.
		               '  ORDER BY orderid ASC' );
		$sql->setInt( 'objectid' ,$this->objectid  );

		$this->subfolders = $db->getCol( $sql->query );

		return $this->subfolders;
	}
	
	
	// Ermitteln aller Unterordner (rekursives Absteigen)
	//
	function getAllSubFolderIds()
	{
		global $SESS;

		$ids = array();

		foreach( $this->getSubFolderIds() as $id )
		{
//			echo "durchlaufe $id";
			$ids[] = $id;

			$f = new Folder( $id );
			if	( !empty($this->projectid) )
				$f->projectid = $this->projectid;

			foreach( $f->getAllSubFolderIds() as $xid )
			{
				$ids[] = $xid;
			}
		}

//		print_r( $ids );
		return $ids;
	}


	/**
	 * Loeschen dieses Ordners.
	 * Der Ordner wird nur geloescht, wenn er keine Unterelemente mehr enth?lt.
	 * Zum Loeschen inklusive Unterelemente dient die Methode deleteAll()
	 */
	function delete()
	{
		$db = db_connection();

		// Nur loeschen, wenn es keine Unterelemente gibt
		if	( count( $this->getObjectIds() ) == 0 )
		{
			$sql = new Sql( 'UPDATE {t_element} '.
			                '  SET folderobjectid=NULL '.
			                '  WHERE folderobjectid={objectid}' );
			$sql->setInt('objectid',$this->objectid);
			$db->query( $sql->query );
	
			$sql = new Sql( 'DELETE FROM {t_folder} '.
			                '  WHERE objectid={objectid}' );
			$sql->setInt('objectid',$this->objectid);
			$db->query( $sql->query );
	
			$this->objectDelete();
		}
	}

	
	/**
	 * Rekursives loeschen aller Inhalte
	 *
	 * Loeschen aller Inhalte dieses Ordners
	 * inclusive aller Unterelemente
	 */
	function deleteAll()
	{
		$db = db_connection();

		// L?schen aller Unterordner
		foreach( $this->subfolder() as $folderid )
		{
			$folder = new Folder( $folderid );
			{
				$folder->deleteAll();
			}
		}
		
		// L?schen aller Seiten,Verknuepfungen und Dateien in
		// diesem Ordner
		foreach( $this->getObjectIds() as $oid )
		{
			$object = new Object( $oid );
			{
				$object->load();

				if	( $object->isPage )
				{
					$page = new Page( $oid );
					$page->load();
					$page->delete();
				}

				if	( $object->isLink )
				{
					$link = new Link( $oid );
					$link->load();
					$link->delete();
				}

				if	( $object->isFile )
				{
					$file = new File( $oid );
					$file->load();
					$file->delete();
				}
			}
		}

		// Zum Abschluss den aktuellen Ordner loeschen
		$this->delete();
	}

	
	function getSubFolderIds()
	{
		return $this->subfolder();
	}
}


?>