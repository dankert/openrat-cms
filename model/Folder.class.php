<?php
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
 * Darstellen eines Ordners
 *
 * @version $Revision$
 * @author $Author$
 * @package openrat.objects
 */
class Folder extends Node
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
		$this->Node( $objectid );
	}


	/**
	 * 
	 * @see Node::add()
	 */
	function add()
	{
		// Folder haben keine eigene Tabelle, also reicht es, den Knoten zu erzeugen.
		parent::add();
	}	
	


	/**
	 * Liefert den höchsten Knoten.
	 * 
	 * Das Ergebnis ist die Id des höchsten Knotens. Achtung: Dieser ist aber vermutlich nicht vom Typ 'Folder'.
	 * 
	 * @return Ambigous <number, string, unknown>
	 */
	public function getRootFolderId()
	{
		return Node::getRootNodeId();
	}


	/**
	 * Stellt fest, ob es in diesem Ordner einen Knoten mit einem bestimmten Namen gibt. 
	 */
	public function hasFilename( $filename )
	{
		$id = parent::getChildIdByName( $filename );

		return intval($id) > 0;
	}


	public function load()
	{
		parent::load();
	}



	function save()
	{
		parent::save();
	}


	
	function setOrderId( $orderid )
	{
	}



	// Liest alle Objekte in diesem Ordner
	function getObjectIds()
	{
		return array_keys( parent::getChildren() );
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
		
		return( $db->getCol( $sql ) );
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
		return( $db->getCol( $sql ) );
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
		
		return( $db->getCol( $sql ) );
	}


	function publish( $withPages,$withFiles,$subdirs = false )
	{
		set_time_limit(30);
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


	/**
	 * 
	 * @param unknown_type $filename
	 * @return Ambigous <Array<id,name>, string, unknown>
	 * @deprecated use Node::getChildByName($name)
	 */
	function getObjectIdByFileName( $filename )
	{
		return parent::getChildIdByName($filename);
	}


	
	/**
	 * Ermittelt alle Objekte vom gew�nschten Typ, die sic in
	 * diesem Projekt befinden.
	 * 
	 * @see objectClasses/Object#getAllObjectIds()
	 * @param types Array
	 * @return Liste von Object-Ids
	 */
	function getAllObjectIds( $types=array('folder','page','link','file') )
	{
//		Html::debug($types,'Typen');
		global $SESS;
		$db = db_connection();
		
		$sql = new Sql('SELECT id FROM {t_object}'.
		               '  WHERE projectid={projectid}'.
		               '    AND (    is_folder={is_folder}' .
		               '          OR is_file  ={is_file}' .
		               '          OR is_page  ={is_page}' .
		               '          OR is_link  ={is_link} )' .
		               '  ORDER BY orderid ASC' );
		
		if	(isset($this->projectid))
		{
			$projectid = $this->projectid;
		}
		else
		{
			$project = Session::getProject();
			$projectid = $project->projectid;
		}
		
		$sql->setInt('projectid',$projectid);
		$sql->setInt('is_folder',in_array('folder',$types)?1:2);
		$sql->setInt('is_file'  ,in_array('file'  ,$types)?1:2);
		$sql->setInt('is_page'  ,in_array('page'  ,$types)?1:2);
		$sql->setInt('is_link'  ,in_array('link'  ,$types)?1:2);
		
		return( $db->getCol( $sql ) );
	}

	
	function getRootObjectId()
	{
		return parent::getRootNodeId();
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
		
		return( $db->getCol( $sql ) );
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
		
		return( $db->getCol( $sql ) );
	}

	
	function getPages()
	{
		return parent::getChildrenOfType( NODE_TYPE_PAGE );
	}

	
	/**
	 * Ermittelt die erste Seite oder Verkn�pfung in diesem Ordner.
	 *
	 * @return Object Objekt
	 */
	function getFirstPageOrLink()
	{
		$db = db_connection();

		$sql = new Sql('SELECT id FROM {t_object} '.
		               '  WHERE parentid={objectid}'.
		               '    AND (is_page=1 OR is_link=1)'.
		               '  ORDER BY orderid ASC' );
		$sql->setInt( 'objectid' ,$this->objectid  );

		$oid = intval($db->getOne( $sql ));
		
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

		$oid = intval($db->getOne( $sql ));
		
		if	( $oid != 0 )
			$o = new Object($oid);
		else
			$o = null;

		return $o;
	}

	
	function getFiles()
	{
		return parent::getChildrenOfType( NODE_TYPE_FILE );
	}


	
	/**
	 * Liefert eine Liste von allen Dateien in diesem Ordner.
	 *
	 * @return Array Schl�ssel=Objekt-Id, Wert=Dateiname
	 */
	function getFileFilenames()
	{
		return parent::getChildrenOfType( NODE_TYPE_FILE );
	}

	
	function getLinks()
	{
		return parent::getChildrenOfType( NODE_TYPE_LINK );
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
			$parentfolder = $this->parentObjectFileNames();

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


	function parentObjectFileNames(  $with_root = false, $with_self = false  )
	{
		$db = Session::getDatabase();
		
		$foid = $this->id;
		$idCache = array();
		
 		while( intval($foid)!=0 )
 		{
			$sql = new Sql( <<<SQL
			
SELECT parentid,id,filename
  FROM {t_object}
 WHERE {t_object}.id={parentid}

SQL
 );
	 		$sql->setInt('parentid'  ,$foid            );
	
			$row = $db->getRow( $sql );
			
	 		if	( in_array($row['id'],$idCache))
	 			Http::serverError('fatal: parent-rekursion in object-id: '.$this->objectid.', double-parent-id: '.$row['id']);
	 		else
	 			$idCache[] = $row['id'];
	 			
	 		$this->addParentfolder( $row['id'],$row['filename'] );
	 		$foid = $row['parentid'];
 		}
		
		
		$this->checkParentFolders($with_root,$with_self);
		
		return $this->parentfolders;
	}

	function parentObjectNames( $with_root = false, $with_self = false )
	{
		$db = Session::getDatabase();
		
		$foid = $this->id;
		$idCache = array();
		
 		while( intval($foid)!=0 )
 		{
			$sql = new Sql( <<<SQL
			
SELECT {t_object}.parentid,{t_object}.id,{t_object}.filename,{t_name}.name FROM {t_object}
  LEFT JOIN {t_name}
         ON {t_object}.id = {t_name}.objectid
        AND {t_name}.languageid = {languageid}  
 WHERE {t_object}.id={parentid}

SQL
 );
			$sql->setInt('languageid',$this->languageid);
	 		$sql->setInt('parentid'  ,$foid            );
	
			$row = $db->getRow( $sql );
			
	 		if	( in_array($row['id'],$idCache))
	 			Http::serverError('fatal: parent-rekursion in object-id: '.$this->objectid.', double-parent-id: '.$row['id']);
	 		else
	 			$idCache[] = $row['id'];
	 			
	 		$this->addParentfolder( $row['id'],$row['name'],$row['filename'] );
	 		$foid = $row['parentid'];
 		}
 	
		$this->checkParentFolders($with_root,$with_self);
		
		return $this->parentfolders;
	}


	// Ermitteln aller Unterordner
	//
	public function subfolder()
	{
		return array_keys( parent::getChildrenOfType( NODE_TYPE_FOLDER ) );
		
	}

	
	
	public function getSubfolderFilenames()
	{
		return parent::getChildrenOfType( NODE_TYPE_FOLDER );
	}

	
	
	/**
	 * Ermitteln aller Unterordner (rekursives Absteigen).
	 * 
	 */
	function getAllSubFolderIds()
	{
		global $SESS;

		$ids = array();

		foreach( $this->getSubFolderIds() as $id )
		{
			$ids[] = $id;

			$f = new Folder( $id );
			if	( !empty($this->projectid) )
				$f->projectid = $this->projectid;

			// Rekursiver Aufruf für alle Unterordner
			foreach( $f->getAllSubFolderIds() as $xid )
			{
				$ids[] = $xid;
			}
		}

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
			$db->query( $sql );
	
			$sql = new Sql( 'DELETE FROM {t_folder} '.
			                '  WHERE objectid={objectid}' );
			$sql->setInt('objectid',$this->objectid);
			$db->query( $sql );
	
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