<?php

namespace cms\model;

use cms\base\Configuration;
use cms\base\DB as Db;
use Exception;


/**
 * Darstellen eines Ordners.
 *
 * @author Jan Dankert
 */
class Folder extends BaseObject
{
	public $folderid;

	var $subfolders    = array();
	var $filenames     = true;


	function __construct( $objectid='' )
	{
		parent::__construct( $objectid );
		$this->isFolder = true;
		$this->typeid = BaseObject::TYPEID_FOLDER;
	}


	protected function add()
	{
		parent::add();

		$db = \cms\base\DB::get();

		$sql = $db->sql('SELECT MAX(id) FROM {{folder}}');
		$this->folderid = intval($sql->getOne())+1;

		$sql = $db->sql('INSERT INTO {{folder}}'.
		               ' (id,objectid)'.
		               ' VALUES( {folderid},{objectid} )' );
		$sql->setInt   ('folderid'    ,$this->folderid );
		$sql->setInt   ('objectid'    ,$this->objectid );
		
		$sql->execute();
	}	
	


	public function hasFilename( $filename )
	{
		$db = \cms\base\DB::get();

		$sql = $db->sql('SELECT COUNT(*) FROM {{object}}'.'  WHERE parentid={objectid} AND filename={filename}');

		if	( intval($this->objectid)== 0 )
			$sql->setNull('objectid');
		else
			$sql->setString('objectid', $this->objectid);

		$sql->setString('filename', $filename      );

		return( $sql->getOne() > 0 );
	}




	public function setOrderId( $orderid )
	{
		$db = \cms\base\DB::get();

		$sql = $db->sql('UPDATE {{folder}} '.
		               '  SET orderid={orderid}'.
		               '  WHERE id={folderid}');
		$sql->setInt('folderid',$this->folderid);
		$sql->setInt('orderid' ,$orderid       );

		$sql->execute();
	}



//	function getSubFolders()
//	{
//		global $SESS;
//		$db = \cms\base\DB::get();
//		
//		$sql = $db->sql('SELECT id FROM {{folder}}'.
//		               '  WHERE parentid={folderid}'.
//		               '    AND projectid={projectid}'.
//		               '  ORDER BY orderid ASC' );
//		$sql->setInt('folderid' ,$SESS['folderid' ]);
//		$sql->setInt('projectid',$SESS['projectid']);
//		
//		return( $sql->getCol( $sql ));
//	}

	
	// Liest alle Objekte in diesem Ordner
	function getObjectIds()
	{
		$db = \cms\base\DB::get();

		$sql = $db->sql('SELECT id FROM {{object}}'.
		               '  WHERE parentid={objectid}'.
		               '  ORDER BY orderid ASC' );
		$sql->setInt('objectid' ,$this->objectid  );
		
		return( $sql->getCol() );
	}



	/**
	 * Liest alle Objekte in diesem Ordner
     * @return array[Object] Objekte
	 */
	function getObjects()
	{
		$db = \cms\base\DB::get();

		$sql = $db->sql( <<<SQL
			SELECT {{object}}.*
		                 FROM {{object}}
		                 WHERE parentid={objectid}
		                 ORDER BY orderid ASC
SQL
		);
		$sql->setInt('objectid'  ,$this->objectid   );
		$res = $sql->getAll();

		$liste = array();
		foreach( $res as $row )
		{
			$o = new BaseObject( $row['id'] );
			$o->setDatabaseRow( $row );
			$liste[] = $o;
		}

		return $liste;
	}


	// Liest alle Objekte in diesem Ordner
	function getObjectIdsByType()
	{
		$db = \cms\base\DB::get();

		$sql = $db->sql('SELECT id FROM {{object}}'.
		               '  WHERE parentid={objectid}'.
		               '  ORDER BY typeid,orderid ASC' );
		$sql->setInt('objectid' ,$this->objectid  );
		
		return( $sql->getCol() );
	}


	// Liest alle Objekte in diesem Ordner sortiert nach dem Namen (nicht Dateinamen!)
	function getChildObjectIdsByName( $languageId )
	{
		$db = \cms\base\DB::get();

		$sql = $db->sql('SELECT {{object}}.id FROM {{object}}'.
		               '  LEFT JOIN {{name}} ON {{object}}.id={{name}}.objectid AND {{name}}.languageid={languageid} '.
                       ' WHERE parentid={objectid}'.
                       ' ORDER BY {{name}}.name,{{object}}.filename ASC');
		$sql->setInt('objectid'  , $this->objectid  );
		$sql->setInt('languageid', $languageId);
		return( $sql->getCol() );
	}


	// Liest alle Objekte in diesem Ordner
	function getObjectIdsByLastChange()
	{
		$db = \cms\base\DB::get();

		$sql = $db->sql('SELECT id FROM {{object}}'.
		               '  WHERE parentid={objectid}'.
		               '  ORDER BY lastchange_date,orderid ASC' );
		$sql->setInt('projectid',$this->projectid );
		$sql->setInt('objectid' ,$this->objectid  );
		
		return( $sql->getCol() );
	}


	function getObjectIdByFileName( $filename )
	{
		$db = \cms\base\DB::get();
		
		$sql = $db->sql('SELECT id FROM {{object}}'.
		               '  WHERE parentid={objectid}'.
		               '    AND filename={filename}' );
		$sql->setInt   ('objectid' ,$this->objectid );
		$sql->setString('filename' ,$filename       );
		
		return( intval($sql->getOne()) );
	}


	
	public function getPages()
	{
		$db = \cms\base\DB::get();

		$sql = $db->sql('SELECT id FROM {{object}} '.
		               '  WHERE parentid={objectid} AND typeid='.BaseObject::TYPEID_PAGE.
		               '  ORDER BY orderid ASC' );
		$sql->setInt( 'objectid' ,$this->objectid  );

		return $sql->getCol();
	}

	
	/**
	 * Ermittelt die erste Seite oder Verkn�pfung in diesem Ordner.
	 *
	 * @return BaseObject Objekt
	 */
	public function getFirstPage()
	{
		$db = \cms\base\DB::get();

		$sql = $db->sql('SELECT id FROM {{object}} '.
		               '  WHERE parentid={objectid}'.
		               '    AND (typeid='.BaseObject::TYPEID_PAGE.')'.
		               '  ORDER BY orderid ASC' );
		$sql->setInt( 'objectid' ,$this->objectid  );

		$oid = intval($sql->getOne());
		
		if	( $oid != 0 )
			$o = new BaseObject($oid);
		else
			$o = null;

		return $o;
	}


	/**
	 * Ermittelt die erste Seite oder Verkn�pfung in diesem Ordner.
	 *
	 * @return BaseObject Objekt
	 */
	function getFirstPageOrLink()
	{
		$db = \cms\base\DB::get();

		$sql = $db->sql('SELECT id FROM {{object}} '.
		               '  WHERE parentid={objectid}'.
		               '    AND (typeid='.BaseObject::TYPEID_PAGE.' OR typeid='.BaseObject::TYPEID_LINK.')'.
		               '  ORDER BY orderid ASC' );
		$sql->setInt( 'objectid' ,$this->objectid  );

		$oid = intval($sql->getOne());
		
		if	( $oid != 0 )
			$o = new BaseObject($oid);
		else
			$o = null;

		return $o;
	}


	function getLastPageOrLink()
	{
		$db = \cms\base\DB::get();

		$sql = $db->sql('SELECT id FROM {{object}} '.
		               '  WHERE parentid={objectid}'.
		               '    AND (typeid='.BaseObject::TYPEID_PAGE.' OR typeid='.BaseObject::TYPEID_LINK.')'.
		               '  ORDER BY orderid DESC' );
		$sql->setInt( 'objectid' ,$this->objectid  );

		$oid = intval($sql->getOne());
		
		if	( $oid != 0 )
			$o = new BaseObject($oid);
		else
			$o = null;

		return $o;
	}


	/**
	 * Returns a list of files.
	 * @return array
	 */
	public function getFiles()
	{
		$sql = DB::sql( <<<SQL
			SELECT id FROM {{object}} 
		              WHERE parentid={objectid}
			            AND typeid IN ( {typefile},{typeimage},{typetext} )
		              ORDER BY orderid ASC
SQL
		);
		$sql->setInt( 'objectid' ,$this->objectid );
		$sql->setInt( 'typefile'  ,BaseObject::TYPEID_FILE  );
		$sql->setInt( 'typeimage' ,BaseObject::TYPEID_IMAGE );
		$sql->setInt( 'typetext'  ,BaseObject::TYPEID_TEXT  );

		return $sql->getCol();
	}


	
	/**
	 * Liefert eine Liste von allen Dateien in diesem Ordner.
	 *
	 * @return array Schl�ssel=Objekt-Id, Wert=Dateiname
	 */
	function getFileFilenames()
	{
		$db = \cms\base\DB::get();

		$sql = $db->sql('SELECT id,filename FROM {{object}} '.
		               '  WHERE parentid={objectid} AND typeid='.BaseObject::TYPEID_FILE.
		               '  ORDER BY orderid ASC' );
		$sql->setInt( 'objectid' ,$this->objectid  );

		return $sql->getAssoc();
	}

	
	function getLinks()
	{
		$db = \cms\base\DB::get();

		$sql = $db->sql('SELECT id FROM {{object}} '.
		               '  WHERE parentid={objectid} AND typeid='.BaseObject::TYPEID_LINK.
		               '  ORDER BY orderid ASC' );
		$sql->setInt( 'objectid' ,$this->objectid  );

		return $sql->getCol();
	}

	

	/**
	 * Rechte f?r diesen Ordner hinzuf?gen.
	 * @param $rights
	 * @param bool $inherit
	 * @deprecated unused? bad code.
	 */
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




	// Ermitteln aller Unterordner
	//
	public function subfolder()
	{
		$stmt = Db::sql(<<<SQL

SELECT id FROM {{object}}
		                 WHERE parentid={objectid} AND typeid={typeid}
		                 ORDER BY orderid ASC
SQL
        );

		$stmt->setInt( 'objectid' ,$this->objectid        );
		$stmt->setInt( 'typeid'   ,BaseObject::TYPEID_FOLDER );

		$this->subfolders = $stmt->getCol();

		return $this->subfolders;
	}

	
	
	public function getSubfolderFilenames()
	{
		$stmt = Db::sql(<<<SQL
SELECT id,filename FROM {{object}}
		                 WHERE parentid={objectid} AND typeid={typeid}
		                 ORDER BY orderid ASC
SQL
        );

		$stmt->setInt( 'objectid' ,$this->objectid        );
        $stmt->setInt( 'typeid'   ,BaseObject::TYPEID_FOLDER );

		return $stmt->getAssoc();
	}

	
	
	/**
	 * Ermitteln aller Unterordner (rekursives Absteigen).
	 * 
	 */
	function getAllSubFolderIds()
	{
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
     *
     * @throws \Exception if folder contains elements
	 */
	function delete()
	{
		$db = \cms\base\DB::get();

		// Nur loeschen, wenn es keine Unterelemente gibt
		if	( count( $this->getObjectIds() ) == 0 )
		{
			$sql = $db->sql( 'UPDATE {{element}} '.
			                '  SET folderobjectid=NULL '.
			                '  WHERE folderobjectid={objectid}' );
			$sql->setInt('objectid',$this->objectid);
			$sql->execute();
	
			$sql = $db->sql( 'DELETE FROM {{folder}} '.
			                '  WHERE objectid={objectid}' );
			$sql->setInt('objectid',$this->objectid);
			$sql->execute();

			parent::delete();
		}
		else {
		    throw new \RuntimeException('There are children in the folder '.$this->objectid.'.');
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
		$db = \cms\base\DB::get();

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
			$object = new BaseObject( $oid );
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

				if	( $object->isUrl )
				{
					$url = new Url( $oid );
                    $url->load();
                    $url->delete();
				}

				if	( $object->isFile )
				{
					$file = new File( $oid );
					$file->load();
					$file->delete();
				}
				if	( $object->isImage )
				{
					$file = new Image( $oid );
					$file->load();
					$file->delete();
				}
				if	( $object->isText )
				{
					$file = new Text( $oid );
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
	
	
	
	/**
	 * Ermittelt die letzten Änderung in diesem Ordner.
	 * @return array[Objektid]=Array())
	 */
	public function getLastChanges()
	{
		$sql = DB::sql( <<<SQL
		SELECT {{object}}.id       as objectid,
		       {{object}}.lastchange_date as lastchange_date,
		       {{object}}.filename as filename,
		       {{object}}.typeid   as typeid,
		       {{user}}.name       as username,
		       {{user}}.id         as userid,
		       {{user}}.mail       as usermail,
		       {{user}}.fullname   as userfullname
		  FROM {{object}}
		  LEFT JOIN {{user}}
		         ON {{user}}.id = {{object}}.lastchange_userid
			  WHERE {{object}}.parentid = {folderid}
		   ORDER BY {{object}}.lastchange_date DESC
SQL
		);
	
		// Variablen setzen.
		$sql->setInt( 'folderid', $this->objectid );

		return $sql->getAll();
	}


    /**
     * Stellt fest, ob der Ordner Unterelemente besitzt.
     * @return bool
     */
	public function hasChildren()
    {
        return count($this->getObjectIds()) > 0;
    }

}

