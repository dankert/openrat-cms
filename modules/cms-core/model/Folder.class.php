<?php

namespace cms\model;

use cms\publish\Publish;
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
	}


	public function add()
	{
		parent::add();

		$db = db_connection();

		$sql = $db->sql('SELECT MAX(id) FROM {{folder}}');
		$this->folderid = intval($sql->getOne())+1;

		$sql = $db->sql('INSERT INTO {{folder}}'.
		               ' (id,objectid)'.
		               ' VALUES( {folderid},{objectid} )' );
		$sql->setInt   ('folderid'    ,$this->folderid );
		$sql->setInt   ('objectid'    ,$this->objectid );
		
		$sql->query();
	}	
	


	public function hasFilename( $filename )
	{
		$db = db_connection();

		$sql = $db->sql('SELECT COUNT(*) FROM {{object}}'.'  WHERE parentid={objectid} AND filename={filename}');

		if	( intval($this->objectid)== 0 )
			$sql->setNull('objectid');
		else
			$sql->setString('objectid', $this->objectid);

		$sql->setString('filename', $filename      );

		return( $sql->getOne() > 0 );
	}


	public function load()
	{
//		$db = db_connection();
//
//		$sql = $db->sql('SELECT * FROM {{folder}} WHERE objectid={objectid}');
//		$sql->setInt('objectid',$this->objectid);
//
//		$row = $sql->getRow( $sql );
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

		$sql = $db->sql('UPDATE {{folder}} '.
		               '  SET orderid={orderid}'.
		               '  WHERE id={folderid}');
		$sql->setInt('folderid',$this->folderid);
		$sql->setInt('orderid' ,$orderid       );

		$sql->query();
	}



//	function getSubFolders()
//	{
//		global $SESS;
//		$db = db_connection();
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
		$db = db_connection();

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
		$db = db_connection();

		$sql = $db->sql('SELECT {{object}}.*,{{name}}.name,{{name}}.descr'.
		               '  FROM {{object}}'.
		               ' LEFT JOIN {{name}} '.
		               '   ON {{object}}.id={{name}}.objectid AND {{name}}.languageid={languageid} '.
		               '  WHERE parentid={objectid}'.
		               '  ORDER BY orderid ASC' );
		$sql->setInt('languageid',$this->languageid );
		$sql->setInt('objectid'  ,$this->objectid   );
		
		$liste = array();
		$res = $sql->getAll();
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
		$db = db_connection();

		$sql = $db->sql('SELECT id FROM {{object}}'.
		               '  WHERE parentid={objectid}'.
		               '  ORDER BY typeid,orderid ASC' );
		$sql->setInt('projectid',$this->projectid );
		$sql->setInt('objectid' ,$this->objectid  );
		
		return( $sql->getCol() );
	}


	// Liest alle Objekte in diesem Ordner sortiert nach dem Namen (nicht Dateinamen!)
	function getChildObjectIdsByName()
	{
		$db = db_connection();

		$sql = $db->sql('SELECT {{object}}.id FROM {{object}}'.
		               '  LEFT JOIN {{name}} ON {{object}}.id={{name}}.objectid AND {{name}}.languageid={languageid} '.
                       ' WHERE parentid={objectid}'.
                       ' ORDER BY {{name}}.name,{{object}}.filename ASC');
		$sql->setInt('objectid'  , $this->objectid  );
		$sql->setInt('languageid', $this->languageid);
		return( $sql->getCol() );
	}


	// Liest alle Objekte in diesem Ordner
	function getObjectIdsByLastChange()
	{
		$db = db_connection();

		$sql = $db->sql('SELECT id FROM {{object}}'.
		               '  WHERE parentid={objectid}'.
		               '  ORDER BY lastchange_date,orderid ASC' );
		$sql->setInt('projectid',$this->projectid );
		$sql->setInt('objectid' ,$this->objectid  );
		
		return( $sql->getCol() );
	}


	public function publish( $withPages,$withFiles,$subdirs = false )
	{
		set_time_limit(300);

		foreach( $this->getObjectIds() as $oid )
		{
		    try {
                $o = new BaseObject($oid);
                $o->objectLoadRaw();

                if ($o->isPage && $withPages) {
                    $p = new Page($oid);
                    $p->load();
                    $p->publisher = &$this->publisher;
                    $p->publish();
                }

                if ($o->isFile && $withFiles) {
                    $f = new File($oid);
                    $f->load();
                    $f->publisher = &$this->publisher;
                    $f->publish();
                }

                if ($o->isImage && $withFiles) {
                    $f = new Image($oid);
                    $f->load();
                    $f->publisher = &$this->publisher;
                    $f->publish();
                }

                if ($o->isText && $withFiles) {
                    $f = new Text($oid);
                    $f->load();
                    $f->publisher = &$this->publisher;
                    $f->publish();
                }

                if ($o->isFolder && $subdirs) {
                    $f = new Folder($oid);
                    $f->load();
                    $f->publisher = &$this->publisher;
                    $f->publish($withPages, $withFiles, true);
                }
            }
            catch( Exception $e)
            {
                // Maybe it is possible to start on with the next one?
                // But we have to throw an exception here to inform the UI...

                // Lets wrap it.
                throw new \LogicException("Could not publish ".$o->__toString().": ".$e->getMessage(),$e->getCode(),$e);
            }
		}
	}


	function getObjectIdByFileName( $filename )
	{
		$db = db_connection();
		
		$sql = $db->sql('SELECT id FROM {{object}}'.
		               '  WHERE parentid={objectid}'.
		               '    AND filename={filename}' );
		$sql->setInt   ('objectid' ,$this->objectid );
		$sql->setString('filename' ,$filename       );
		
		return( intval($sql->getOne()) );
	}


	
	public function getPages()
	{
		$db = db_connection();

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
		$db = db_connection();

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
		$db = db_connection();

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
		$db = db_connection();

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

	
	function getFiles()
	{
		$db = db_connection();

		$sql = $db->sql('SELECT id FROM {{object}} '.
		               '  WHERE parentid={objectid} AND typeid='.BaseObject::TYPEID_FILE.
		               '  ORDER BY orderid ASC' );
		$sql->setInt( 'objectid' ,$this->objectid  );

		return $sql->getCol();
	}


	
	/**
	 * Liefert eine Liste von allen Dateien in diesem Ordner.
	 *
	 * @return Array Schl�ssel=Objekt-Id, Wert=Dateiname
	 */
	function getFileFilenames()
	{
		$db = db_connection();

		$sql = $db->sql('SELECT id,filename FROM {{object}} '.
		               '  WHERE parentid={objectid} AND typeid='.BaseObject::TYPEID_FILE.
		               '  ORDER BY orderid ASC' );
		$sql->setInt( 'objectid' ,$this->objectid  );

		return $sql->getAssoc();
	}

	
	function getLinks()
	{
		$db = db_connection();

		$sql = $db->sql('SELECT id FROM {{object}} '.
		               '  WHERE parentid={objectid} AND typeid='.BaseObject::TYPEID_LINK.
		               '  ORDER BY orderid ASC' );
		$sql->setInt( 'objectid' ,$this->objectid  );

		return $sql->getCol();
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


    /**
     * Ermitteln des Dateinamens.
     * @return String Dateiname
     */
    public function filename()
    {
        $filenameConfig = config('filename');

        if	( $filenameConfig['edit'] )
        {
            if   ( $this->filename == '' )
                // Filename ist eigentlich ein Pflichtfeld, daher kann dies nahezu nie auftreten.
                // Rein technisch kann der Filename aber leer sein.
                return $this->objectid;
            else
                return BaseObject::urlify($this->name);
        }
        else
        {
            // Filename is not edited, so we are generating a pleasant filename.
            switch( $filenameConfig['style'] )
            {
                case 'longid':
                    // Eine etwas laengere ID als Dateinamen benutzen
                    return base_convert(str_pad($this->objectid,6,'a'),11,10);

                case 'short':
                    // So kurz wie moeglich: Erhoehen der Basis vom 10 auf 36.
                    // Beispiele:
                    // 1  -> 1
                    // 10 -> a
                    return base_convert($this->objectid,10,36);

                case 'md5':
                    // MD5-Summe als Dateinamen verwenden
                    // Achtung: Kollisionen sind unwahrscheinlich, aber theoretisch möglich.
                    return  md5(md5($this->objectid));

                case  'ss':
                    // Imitieren von "StoryServer" URLs. Wers braucht.
                    return $this->objectid;

                case  'title':
                    // Achtung: Kollisionen sind möglich.
                    // COLLISION ALARM! THIS IS NOT A GOOD IDEA!
                    return  BaseObject::urlify($this->name);

                case 'id':
                default:
                    // Einfach die Objekt-Id als Dateinamen verwenden.
                    return $this->objectid;

            }
        }
    }




	// Ermitteln aller Unterordner
	//
	public function subfolder()
	{
		$stmt = db()->sql(<<<SQL

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
		$stmt = db()->sql(<<<SQL
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
		$db = db_connection();

		// Nur loeschen, wenn es keine Unterelemente gibt
		if	( count( $this->getObjectIds() ) == 0 )
		{
			$sql = $db->sql( 'UPDATE {{element}} '.
			                '  SET folderobjectid=NULL '.
			                '  WHERE folderobjectid={objectid}' );
			$sql->setInt('objectid',$this->objectid);
			$sql->query();
	
			$sql = $db->sql( 'DELETE FROM {{folder}} '.
			                '  WHERE objectid={objectid}' );
			$sql->setInt('objectid',$this->objectid);
			$sql->query();
	
			$this->objectDelete();
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
	 * @return Array[Objektid]=Array())
	 */
	public function getLastChanges()
	{
	
		$db = db_connection();
	
		$sql = $db->sql( <<<SQL
		SELECT {{object}}.id       as objectid,
		       {{object}}.lastchange_date as lastchange_date,
		       {{object}}.filename as filename,
		       {{object}}.typeid   as typeid,
		       {{name}}.name       as name,
		       {{user}}.name       as username,
		       {{user}}.id         as userid,
		       {{user}}.mail       as usermail,
		       {{user}}.fullname   as userfullname
		  FROM {{object}}
		  LEFT JOIN {{name}}
		         ON {{name}}.objectid = {{object}}.id
				AND {{name}}.languageid = {languageid}
		  LEFT JOIN {{user}}
		         ON {{user}}.id = {{object}}.lastchange_userid
			  WHERE {{object}}.parentid = {folderid}
		   ORDER BY {{object}}.lastchange_date DESC
SQL
		);
	
		// Variablen setzen.
		$sql->setInt( 'folderid', $this->objectid );
	
		$sql->setInt( 'languageid', $this->languageid );
	
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

