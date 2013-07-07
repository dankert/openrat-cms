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
 * Darstellen eines Projektes
 *
 * @version $Revision$
 * @author $Author$
 * @package openrat.objects
 */
class Project
{
	// Eigenschaften
	var $projectid;
	var $name;
	var $target_dir;
	var $ftp_url;
	var $ftp_passive;
	var $cmd_after_publish;
	var $content_negotiation;
	var $cut_index;
	
	var $log = array();
	
	
	// Konstruktor
	function Project( $projectid='' )
	{
		if   ( intval($projectid) != 0 )
			$this->projectid = $projectid;
	}

	
	/**
	 * Stellt fest, ob die angegebene Id existiert.
	 */
	function available( $id )
	{
		$db = db_connection();

		
		$sql = new Sql( <<<SQL
	SELECT 1 FROM {t_node}
	 WHERE typ = {type}			
       AND id={id}
SQL
);
		$sql->setInt('type' ,NODE_TYPE_PROJECT );
		$sql->setInt('id'   ,$id               );
		
		return intval($db->getOne($sql)) == 1;
	}
	

	// Liefert alle verf?gbaren Projekte
	function getAll()
	{
		return Project::getAllProjects();
	}


	// Liefert alle verf?gbaren Projekte
	function getAllProjects()
	{
		$db = db_connection();
		$sql = new Sql( <<<SQL
 SELECT id,name FROM {t_node}
				WHERE typ={type}
		        ORDER BY lft
SQL
);
		$sql->setInt('type',NODE_TYPE_PROJECT);
		return $db->getAssoc( $sql );
	}


	// Liefert alle verf?gbaren Projekt-Ids
	function getAllProjectIds()
	{
		$db = db_connection();
		$sql = new Sql( <<<SQL
 SELECT id FROM {t_node}
				WHERE typ={type}
		        ORDER BY lft
SQL
);
		$sql->setInt('type',NODE_TYPE_PROJECT);
		
		return $db->getCol( $sql );
	}


	function getLanguages()
	{
		$db = db_connection();

		$sql = new Sql( <<<SQL
 SELECT id,name FROM {t_node}
				WHERE typ={type}
		        ORDER BY lft
SQL
		);
		$sql->setInt('type',NODE_TYPE_VARIANT);

		return $db->getAssoc( $sql );
	}


	function getLanguageIds()
	{
		return array_keys( $this->getLanguages() );
	}


	function getModels()
	{
		$db = db_connection();

		$sql = new Sql( 'SELECT id,name FROM {t_projectmodel}'.
		                '  WHERE projectid= {projectid} '.
		                '  ORDER BY name' );
		$sql->setInt   ('projectid',$this->projectid);

		return $db->getAssoc( $sql );
	}


	function getModelIds()
	{
		return array_keys( $this->getModels() );
	}


	function getTemplateIds()
	{
		$db = db_connection();

		$sql = new Sql( 'SELECT id FROM {t_template}'.
		                '  WHERE projectid= {projectid} ' );
		$sql->setInt   ('projectid',$this->projectid);

		return $db->getCol( $sql );
	}


	function getTemplates()
	{
		$db = db_connection();

		$sql = new Sql( 'SELECT id,name FROM {t_template}'.
		                '  WHERE projectid= {projectid} ' );
		$sql->setInt   ('projectid',$this->projectid);

		return $db->getAssoc( $sql );
	}


	/**
	 * Ermitteln des Wurzel-Ordners fuer dieses Projekt.
	 * 
	 * Der Wurzelordner ist der einzige Ordnerhat in diesem
	 * Projekt, der kein Elternelement besitzt.
	 * 
	 * @return Objekt-Id des Wurzelordners
	 */
	function getRootObjectId()
	{
		$db = db_connection();

		$sql = new Sql( <<<SQL
 SELECT id FROM {t_node}
				WHERE id={projectid}
SQL
		);

		$sql->setInt('projectid',$this->projectid);
		
		return( $db->getOne( $sql ) );
	}

	

	// Laden
	function load()
	{
		$db = db_connection();

		$sql = new Sql( 'SELECT * FROM {t_project} '.
		                '   WHERE id={projectid}' );
		$sql->setInt( 'projectid',$this->projectid );

		$row = $db->getRow( $sql );

		if	( empty($row) )
			throw new ObjectNotFoundException('project '.$this->projectid.' not found');
			
		$this->name                = $row['name'               ];
		$this->target_dir          = $row['target_dir'         ];
		$this->ftp_url             = $row['ftp_url'            ];
		$this->ftp_passive         = $row['ftp_passive'        ];
		$this->cmd_after_publish   = $row['cmd_after_publish'  ];
		$this->content_negotiation = $row['content_negotiation'];
		$this->cut_index           = $row['cut_index'          ];
	}


	// Laden
	function loadByName()
	{
		$db = db_connection();

		$sql = new Sql( <<<SQL
 SELECT id,name FROM {t_node}
				WHERE typ={type}
				  AND name={name}
		        ORDER BY lft
SQL
		);
		$sql->setInt   ( 'type',NODE_TYPE_PROJECT);
		$sql->setString( 'name',$this->name      );

		$row = $db->getRow( $sql );

		$this->projectid           = $row['id'                 ];
		$this->target_dir          = $row['target_dir'         ];
		$this->ftp_url             = $row['ftp_url'            ];
		$this->ftp_passive         = $row['ftp_passive'        ];
		$this->cmd_after_publish   = $row['cmd_after_publish'  ];
		$this->content_negotiation = $row['content_negotiation'];
		$this->cut_index           = $row['cut_index'          ];
	}


	// Speichern
	function save()
	{
		$db = db_connection();

		$sql = new Sql( <<<SQL
				UPDATE {t_project}
                  SET name                = {name},
                      target_dir          = {target_dir},
                      ftp_url             = {ftp_url}, 
                      ftp_passive         = {ftp_passive}, 
                      cut_index           = {cut_index}, 
                      content_negotiation = {content_negotiation}, 
                      cmd_after_publish   = {cmd_after_publish} 
                WHERE id= {projectid}
SQL
);

		$sql->setString('ftp_url'            ,$this->ftp_url );
		$sql->setString('name'               ,$this->name );
		$sql->setString('target_dir'         ,$this->target_dir );
		$sql->setInt   ('ftp_passive'        ,$this->ftp_passive );
		$sql->setString('cmd_after_publish'  ,$this->cmd_after_publish );
		$sql->setInt   ('content_negotiation',$this->content_negotiation );
		$sql->setInt   ('cut_index'          ,$this->cut_index );
		$sql->setInt   ('projectid'          ,$this->projectid );

		$db->query( $sql );

		try
		{
			$rootFolder = new Folder( $this->getRootObjectId() );
			$rootFolder->load();
			$rootFolder->filename = $this->name;
			$rootFolder->save();
		}
		catch( Exception $e )
		{
			Logger::warn('Project '.$this->projectid.' has not a root folder'."\n".$e->getTraceAsString());
		}
	}


	// Speichern
	function getProperties()
	{
		return Array( 'name'               =>$this->name,
		              'target_dir'         =>$this->target_dir,
		              'ftp_url'            =>$this->ftp_url,
		              'ftp_passive'        =>$this->ftp_passive,
		              'cmd_after_publish'  =>$this->cmd_after_publish,
		              'content_negotiation'=>$this->content_negotiation,
		              'cut_index'          =>$this->cut_index,
		              'projectid'          =>$this->projectid );
	}


	// Projekt hinzufuegen
	function add()
	{
		$db = db_connection();
		
		$sql = new Sql('SELECT MAX(id) FROM {t_project}');
		$this->projectid = intval($db->getOne($sql))+1;


		// Projekt hinzuf?gen
		$sql = new Sql( 'INSERT INTO {t_project} (id,name,target_dir,ftp_url,ftp_passive,cmd_after_publish,content_negotiation,cut_index) '.
		                "  VALUES( {projectid},{name},'','',0,'',0,0 ) " );
		$sql->setInt   ('projectid',$this->projectid );
		$sql->setString('name'     ,$this->name      );

		$db->query( $sql );

		// Modell anlegen
		$model = new Model();
		$model->projectid = $this->projectid;
		$model->name = 'html';
		$model->add();
		
		// Sprache anlegen
		$language = new Language();
		$language->projectid = $this->projectid;
		$language->isoCode = 'en';
		$language->name    = 'english';
		$language->add();
		
		// Haupt-Ordner anlegen
		$folder = new Folder();
		$folder->isRoot     = true;
		$folder->projectid  = $this->projectid;
		$folder->languageid = $language->languageid;
		$folder->filename   = $this->name;
		$folder->name       = $this->name;
		$folder->isRoot     = true;
		$folder->add();

		// Template anlegen
		$template = new Template();
		$template->projectid  = $this->projectid;
		$template->name       = '';
		$template->modelid    = $model->modelid;
		$template->languageid = $language->languageid;
		$template->extension  = 'html';
		$template->src        = '<html><body><h1>Hello world</h1><hr><p>Hello, World.</p></body></html>';
		$template->add();
		$template->save();

		// Beispiel-Seite anlegen
		$page = new Page();
		$page->parentid   = $folder->objectid;
		$page->projectid  = $this->projectid;
		$page->languageid = $language->languageid;
		$page->templateid = $template->templateid;
		$page->filename   = '';
		$page->name       = 'OpenRat';
		$page->add();
	}


	// Projekt aus Datenbank entfernen
	function delete()
	{
		$db = db_connection();

		// Root-Ordner rekursiv samt Inhalten loeschen
		$folder = new Folder( $this->getRootObjectId() );
		$folder->deleteAll();


		foreach( $this->getLanguageIds() as $languageid )
		{
			$language = new Language( $languageid );
			$language->delete();
		}
		

		foreach( $this->getTemplateIds() as $templateid )
		{
			$template = new Template( $templateid );
			$template->delete();
		}
		

		foreach( $this->getModelIds() as $modelid )
		{
			$model = new Model( $modelid );
			$model->delete();
		}
		

		// Projekt l?schen
		$sql = new Sql( 'DELETE FROM {t_project}'.
		                '  WHERE id= {projectid} ' );
		$sql->setInt( 'projectid',$this->projectid );
		$db->query( $sql );
	}
	
	function getDefaultLanguageId()
	{
		$db = Session::getDatabase();

		// ORDER BY deswegen, damit immer mind. eine Sprache
		// gelesen wird
		$sql = new Sql( 'SELECT id FROM {t_language} '.
		                '  WHERE projectid={projectid}'.
		                '   ORDER BY is_default DESC' );

		$sql->setInt('projectid',$this->projectid );
		
		return $db->getOne( $sql );
	}


	function getDefaultModelId()
	{
		$db = Session::getDatabase();

		// ORDER BY deswegen, damit immer mind. eine Sprache
		// gelesen wird
		$sql = new Sql( 'SELECT id FROM {t_projectmodel} '.
		                '  WHERE projectid={projectid}'.
		                '   ORDER BY is_default DESC' );
		$sql->setInt('projectid',$this->projectid );
		
		return $db->getOne( $sql );
	}

	
	
	/**
	 * Entfernt nicht mehr notwendige Inhalte aus dem Archiv.
	 */
	function checkLimit()
	{
		$root = new Folder( $this->getRootObjectId() );
		$root->projectid = $this->projectid;
		
		$pages = $root->getAllObjectIds( array('page') );
		$languages = $this->getLanguageIds();
		
		foreach( $pages as $objectid )
		{
			$page = new Page( $objectid );
			$page->load();
			foreach( $page->getElementIds() as $eid )
			{
				foreach( $languages as $lid )
				{
					$value = new Value();
					$value->element    = new Element($eid);
					$value->pageid     = $page->pageid;
					$value->languageid = $lid;
					
					$value->checkLimit();
				}
			}
		}
		
	}

	

	/**
	 * Testet die Integrität der Datenbank.
	 */
	public function checkLostFiles()
	{
		$this->log = array();
		
		$db = &Session::getDatabase();

		// Ordnerstruktur prüfen.
		$sql = new Sql( <<<EOF
SELECT thistab.id FROM {t_object} AS thistab
 LEFT JOIN {t_object} AS parenttab
        ON parenttab.id = thistab.parentid
  WHERE thistab.projectid={projectid} AND thistab.parentid IS NOT NULL AND parenttab.id IS NULL
EOF
);
		$sql->setInt('projectid',$this->projectid);

		$idList = $db->getCol($sql);
		
		if	( count( $idList ) > 0 )
		{
			$lostAndFoundFolder = new Folder();
			$lostAndFoundFolder->projectid = $this->projectid;
			$lostAndFoundFolder->languageid = $this->getDefaultLanguageId();
			$lostAndFoundFolder->filename = "lostandfound";
			$lostAndFoundFolder->name     = 'Lost+found';
			$lostAndFoundFolder->parentid = $this->getRootObjectId();
			$lostAndFoundFolder->add();
			
			foreach( $idList as $id )
			{
				$this->log[] = 'Lost file! Moving '.$id.' to lost+found.';
				$obj = new Object( $id );
				$obj->setParentId( $lostAndFoundFolder->objectid );
			}
		}

		
		// Prüfe, ob die Verbindung Projekt->Template->Templatemodell->Projectmodell->Projekt konsistent ist. 
		$sql = new Sql( <<<EOF
SELECT DISTINCT projectid FROM {t_projectmodel} WHERE id IN (SELECT projectmodelid from {t_templatemodel} WHERE templateid in (SELECT id from {t_template} WHERE projectid={projectid}))
EOF
);
		$sql->setInt('projectid',$this->projectid);

		$idList = $db->getCol($sql);
		
		if	( count( $idList ) > 1 )
		{
			Logger::warn('Inconsistence found: Reference circle project<->template<->templatemodel<->projectmodel<->project is not consistent.');
			$this->log[] = 'Inconsistence found: Reference circle project<->template<->templatemodel<->projectmodel<->project is not consistent.';
		}

	}
	
	
	/**
	 * Synchronisation des Projektinhaltes mit dem Dateisystem.
	 */
	public function sync()
	{
		global $conf;
		$syncConf = $conf['sync'];
		
		if	( ! $syncConf['enabled'] )
			return;
		
		$syncDir = slashify($syncConf['directory']).$this->name;
		
	}
	
	/**
	 * Kopiert ein Projekt von einer Datenbank zu einer anderen.<br>
	 * <br>
	 * Alle Projektinhalte werden kopiert, die Fremdschluesselbeziehungen werden entsprechend angepasst.<br>
	 * <br>
	 * Alle Beziehungen zu Benutzern, z.B. "Zuletzt geaendert von", "angelegt von" sowie<br>
	 * alle Berechtigungsinformationen gehen verloren!<br>
	 * 
	 * @param dbid_destination ID der Ziel-Datenbank
	 */
	function copy( $dbid_destination,$name='' )
	{
		Logger::debug( 'Copying project '.$this->name.' to database '.$dbid_destination );
		
		global $conf;
		$zeit = date('Y-m-d\TH:i:sO');
		
		$db_src  = db_connection();
		$db_dest = new DB( $conf['database'][$dbid_destination] );
		$db_dest->id = $dbid_destination;
		$db_dest->start();
		
		$sameDB = ( $db_dest->id == $db_src->id );
		
		// -------------------------------------------------------
		$mapping = array();
		$ids = array('project'      => array('foreign_keys'=>array(),
		                                     'primary_key' =>'id',
		                                     'unique_idx'  =>'name',
		                                     'erase'       =>array()
		                                    ),
		             'language'     => array('foreign_keys'=>array('projectid'=>'project'),
		                                     'primary_key' =>'id'
		                                    ),
		             'projectmodel' => array('foreign_keys'=>array('projectid'=>'project'),
		                                     'primary_key' =>'id'
		                                    ),
		             'template'     => array('foreign_keys'=>array('projectid'=>'project'),
		                                     'primary_key' =>'id'
		                                     ),
		             'object'       => array('foreign_keys'=>array('projectid'  =>'project' ),
		                                     'self_key'    =>'parentid',
		                                     'primary_key' =>'id',
		                                     'erase'       =>array('create_userid','lastchange_userid')
		                                     ),
		             'element'      => array('foreign_keys'=>array('templateid'      =>'template',
			                                                       'folderobjectid'  =>'object',
		                                                           'default_objectid'=>'object'   ),
		                                     'primary_key' =>'id'
		                                     ),
		             'templatemodel'=> array('foreign_keys'=>array('projectmodelid'=>'projectmodel',
		                                                           'templateid'    =>'template'     ),
		                                     'primary_key' =>'id',
		                                     'replace'     =>array('text'=>'element')
		                                     ),
		             'name'         => array('foreign_keys'=>array('objectid'  =>'object',
		                                                           'languageid'=>'language'   ),
		                                     'primary_key' =>'id'
		                                     ),
		             'page'         => array('foreign_keys'=>array('objectid'  =>'object',
		                                                           'templateid'=>'template' ),
		                                     'primary_key' =>'id'
		                                     ),
		             'value'         => array('foreign_keys'=>array('pageid'   =>'page',
		                                                           'languageid'=>'language',
		                                                           'elementid'=>'element',
		                                                           'linkobjectid'=>'object'  ),
		                                     'erase'       =>array('lastchange_userid'),
		                                     'replace'     =>array('text'=>'object'),
		                                     'primary_key' =>'id'
		                                     ),
		             'link'         => array('foreign_keys'=>array('objectid'     =>'object',
		                                                           'link_objectid'=>'object'   ),
		                                     'primary_key' =>'id'
		                                     ),
		             'folder'         => array('foreign_keys'=>array('objectid'  =>'object' ),
		                                     'primary_key' =>'id'
		                                     ),
		             'file'         => array('foreign_keys'=>array('objectid'  =>'object'   ),
		                                     'primary_key' =>'id',
		                                     'binary'      =>'value'
		                                     ),
		             
		);
		
		if	( $sameDB )
			$ids['acl'] = array('foreign_keys'=>array('objectid'   => 'object',
		                                              'languageid' => 'language' ),
		                        'primary_key' =>'id'
		                        );
			 
		foreach( $ids as $tabelle=>$data )
		{
			Logger::debug( 'Copying table '.$tabelle.' ...' );
			$mapping[$tabelle] = array();
			$idcolumn = $data['primary_key'];

			// Naechste freie Id in der Zieltabelle ermitteln.
			$sql = new Sql( 'SELECT MAX('.$idcolumn.') FROM {t_'.$tabelle.'}',$dbid_destination);
			$maxid = intval($db_dest->getOne($sql));
			$nextid = $maxid;

			// Zu �bertragende IDs ermitteln.
			if	( count($data['foreign_keys'])==0 )
			{
				$where = ' WHERE id='.$this->projectid;
			}
			else
			{
				foreach( $data['foreign_keys'] as $fkey_column=>$target_tabelle )
				{
					$where = ' WHERE '.$fkey_column.' IN ('.join(array_keys($mapping[$target_tabelle]),',').')';
					break;
				}
			}
			$sql = new Sql( 'SELECT '.$idcolumn.' FROM {t_'.$tabelle.'} '.$where);

			foreach( $db_src->getCol($sql) as $srcid )
			{
				Logger::debug('Id '.$srcid.' of table '.$tabelle);
				$mapping[$tabelle][$srcid] = ++$nextid;

				$sql = new Sql( 'SELECT * FROM {t_'.$tabelle.'} WHERE id={id}');
				$sql->setInt('id',$srcid);
				$row = $db_src->getRow( $sql );

				// Wert des Prim�rschl�ssels �ndern.
				$row[$idcolumn] = $mapping[$tabelle][$srcid];

				// Fremdschl�sselbeziehungen auf neue IDn korrigieren.
				foreach( $data['foreign_keys'] as $fkey_column=>$target_tabelle)
				{
					Logger::debug($fkey_column.' '.$target_tabelle.' '.$row[$fkey_column]);
					
					if	( intval($row[$fkey_column]) != 0 )
						$row[$fkey_column] = $mapping[$target_tabelle][$row[$fkey_column]];
				}
				
				foreach( array_keys($row) as $key )
				{
					if	( isset($data['unique_idx']) && $key == $data['unique_idx'] )
					{
						// Nachschauen, ob es einen UNIQUE-Key in der Zieltabelle schon gibt.
						$sql = new Sql( 'SELECT 1 FROM {t_'.$tabelle.'} WHERE '.$key."='".$row[$key]."'",$dbid_destination);
						
						if	( intval($db_dest->getOne( $sql )) == 1 )
							$row[$key] = $row[$key].$zeit;

					}

					if	( !$sameDB && isset($data['erase']) && in_array($key,$data['erase']) )
						$row[$key] = null;

					if	( isset($data['self_key']) && $key == $data['self_key'] && intval($row[$key]) > 0 )
						$row[$key] = $row[$key]+$maxid;
				}
				
				if	( isset($data['replace']) )
				{
					foreach( $data['replace'] as $repl_column=>$repl_tabelle)
						foreach( $mapping[$repl_tabelle] as $oldid=>$newid)
						{
							$row[$repl_column] = str_replace('{'.$oldid.'}','{'.$newid.'}'  ,$row[$repl_column]);
							$row[$repl_column] = str_replace('"'.$oldid.'"','"'.$newid.'"'  ,$row[$repl_column]);
							$row[$repl_column] = str_replace('->'.$oldid   ,'->"'.$newid.'"',$row[$repl_column]);
						}
				}
				
				if	( isset($data['binary']) )
				{
					if	( !$db_src->conf['base64'] && $db_dest->conf['base64'] )
						$row[$data['binary']] = base64_encode($row[$data['binary']]);
					elseif	( $db_src->conf['base64'] && !$db_dest->conf['base64'] )
						$row[$data['binary']] = base64_decode($row[$data['binary']]);
				}
				
				// Daten in Zieltabelle einf�gen.
				$sql = new Sql( 'INSERT INTO {t_'.$tabelle.'} ('.join(array_keys($row),',').') VALUES({'.join(array_keys($row),'},{').'})',$dbid_destination);
				foreach( $row as $key=>$value )
				{
					if	( !$sameDB && isset($data['erase']) && in_array($key,$data['erase']) )
						$sql->setNull($key);
					else
						$sql->setVar($key,$value);
				}
				//$sql = new Sql( 'INSERT INTO {t_'.$tabelle.'} ('.join(array_keys($row),',').') VALUES('.join($row,',').')',$dbid_destination);
				$db_dest->query( $sql );
			}

			if	( isset($data['self_key']) )
			{
				foreach( $mapping[$tabelle] as $oldid=>$newid )
				{
					$sql = new Sql( 'UPDATE {t_'.$tabelle.'} SET '.$data['self_key'].'='.$newid.' WHERE '.$data['self_key'].'='.($oldid+$maxid),$dbid_destination );
					$db_dest->query( $sql );
				}
			}
		}
		
		Logger::debug( 'Finished copying project' );
		
		$db_dest->commit();
	}

	

	/**
	 * Ermittelt die Anzahl aller Objekte in diesem Projekt.
	 * @return int Anzahl
	 */
	function countObjects()
	{
		$db = db_connection();
		$sql = new Sql( 'SELECT COUNT(*) FROM {t_object} '.
		                '   WHERE projectid = {projectid}' );
		$sql->setInt( 'projectid', $this->projectid );

		return $db->getOne( $sql );
		
	}

	
	
	/**
	 * Ermittelt die Gr��e aller Dateien in diesem Projekt.
	 * @return int Summe aller Dateigroessen
	 */
	function size()
	{
		$db = db_connection();
		
		$sql = new Sql( <<<SQL
		SELECT SUM(size) FROM {t_file}
		  LEFT JOIN {t_object}
		         ON {t_file}.objectid = {t_object}.id
		      WHERE projectid = {projectid}
SQL
);
		$sql->setInt( 'projectid', $this->projectid );

		return $db->getOne( $sql );
	}
	
	
	
	/**
	 * Liefert alle verf?gbaren Projekt-Ids
	 */
	function info()
	{
		$info = array();
		
		$info['count_objects'] = $this->countObjects();
		$info['sum_filesize' ] = $this->size();
		
		
		return $info;
	}
	
	
	/**
	 * Ermittelt projektübergreifend die letzten Änderungen des angemeldeten Benutzers.
	 *  
	 * @return Ambigous <string, unknown>
	 */
	public static function getMyAllLastChanges()
	{
		$db = db_connection();
		
		$sql = new Sql( <<<SQL
		SELECT {t_object}.id       as objectid,
		       {t_object}.filename as filename,
		       {t_object}.lastchange_date as lastchange_date,
		       {t_project}.id      as projectid,
			   {t_project}.name    as projectname
		  FROM {t_object}
		LEFT JOIN {t_project}
		       ON {t_object}.projectid = {t_project}.id
		   WHERE {t_object}.lastchange_userid = {userid}
		ORDER BY {t_object}.lastchange_date DESC
SQL
		);
		
		$user = Session::getUser();
		$sql->setInt( 'userid', $user->userid );
		
		return $db->getAll( $sql );
		
	}
	

	/**
	 * Ermittelt projektübergreifend die letzten Änderungen des angemeldeten Benutzers.
	 *  
	 * @return Ambigous <string, unknown>
	 */
	public function getMyLastChanges()
	{
		
		$db = db_connection();


		$sql = new Sql( <<<SQL
		SELECT {t_object}.id    as objectid,
		       {t_object}.filename as filename,
		       {t_object}.is_folder as is_folder,
		       {t_object}.is_file  as is_file,
		       {t_object}.is_link  as is_link,
		       {t_object}.is_page  as is_page,
		       {t_object}.lastchange_date as lastchange_date,			
		       {t_name}.name as name				
		  FROM {t_object}
		  LEFT JOIN {t_name}
		         ON {t_name}.objectid = {t_object}.id
				AND {t_name}.languageid = {languageid}
		  LEFT JOIN {t_project}
		         ON {t_object}.projectid = {t_project}.id
			  WHERE {t_object}.projectid         = {projectid}
				AND {t_object}.lastchange_userid = {userid}
		   ORDER BY {t_object}.lastchange_date DESC;
SQL
		);
		
		// Variablen setzen.
		$sql->setInt( 'projectid', $this->projectid );
		
		$language = Session::getProjectLanguage();
		$sql->setInt( 'languageid', $language->languageid );
		
		$user = Session::getUser();
		$sql->setInt( 'userid', $user->userid );
		
		return $db->getAll( $sql );		
	}
	

	/**
	 * Ermittelt projektübergreifend die letzten Änderungen.
	 *  
	 * @return Ambigous <string, unknown>
	 */
	public static function getAllLastChanges()
	{
		$db = db_connection();

		$sql = new Sql( <<<SQL
		SELECT {t_object}.id    as objectid,
		       {t_object}.lastchange_date as lastchange_date,
		       {t_object}.filename as filename,
		       {t_project}.id   as projectid,
			   {t_project}.name as projectname,
		       {t_user}.name       as username,
		       {t_user}.id         as userid,
		       {t_user}.mail       as usermail,
		       {t_user}.fullname   as userfullname
		  FROM {t_object}
		  LEFT JOIN {t_project}
		         ON {t_object}.projectid = {t_project}.id
		  LEFT JOIN {t_user}
		         ON {t_user}.id = {t_object}.lastchange_userid
		  ORDER BY {t_object}.lastchange_date DESC
		  LIMIT 50
SQL
		);
		
		return $db->getAll( $sql );
	}
	


	/**
	 * Ermittelt die letzten Änderung im Projekt.
	 * @return Array[Objektid]=Array())
	 */
	public function getLastChanges()
	{
		
		$db = db_connection();
		
		$sql = new Sql( <<<SQL
		SELECT {t_object}.id       as objectid,
		       {t_object}.lastchange_date as lastchange_date,
		       {t_object}.filename as filename,
		       {t_object}.is_folder as is_folder,
		       {t_object}.is_file  as is_file,
		       {t_object}.is_link  as is_link,
		       {t_object}.is_page  as is_page,
		       {t_name}.name       as name,
		       {t_user}.name       as username,
		       {t_user}.id         as userid,
		       {t_user}.mail       as usermail,
		       {t_user}.fullname   as userfullname
		  FROM {t_object}
		  LEFT JOIN {t_name}
		         ON {t_name}.objectid = {t_object}.id
				AND {t_name}.languageid = {languageid}
		  LEFT JOIN {t_user}
		         ON {t_user}.id = {t_object}.lastchange_userid
			  WHERE {t_object}.projectid = {projectid}
		   ORDER BY {t_object}.lastchange_date DESC
SQL
		);
		
		// Variablen setzen.
		$sql->setInt( 'projectid', $this->projectid );
		
		$language = Session::getProjectLanguage();
		$sql->setInt( 'languageid', $language->languageid );
		
		return $db->getAll( $sql );
	}
}

?>