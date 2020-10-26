<?php

namespace cms\model;

use cms\base\DB;
use database\Database;
use util\FileUtils;
use util\Session;


/**
 * Darstellen eines Projektes
 *
 * @author Jan Dankert
 * @package openrat.objects
 */
class Project extends ModelBase
{

    const FLAG_CUT_INDEX               = 1;
    const FLAG_CONTENT_NEGOTIATION     = 2;
    const FLAG_PUBLISH_FILE_EXTENSION  = 4;
    const FLAG_PUBLISH_PAGE_EXTENSION  = 8;
    const FLAG_LINK_ABSOLUTE           = 16;

    // Eigenschaften
	public $projectid;
	public $name;
	public $target_dir;
	public $ftp_url;

    /**
     * Hostname
     * @var string
     */
	public $url;

	public $ftp_passive;
	public $cmd_after_publish;


    /**
     * @var boolean
     */
	public $content_negotiation = false;

    /**
     * @var boolean
     */
	public $cut_index = false;

    /**
     * @var boolean
     */
    public $publishFileExtension = true;

    /**
     * @var boolean
     */
    public $publishPageExtension = true;

	public $log = array();

	public $linkAbsolute;


	
	// Konstruktor
	public function  __construct( $projectid='' )
	{
		if   ( intval($projectid) != 0 )
			$this->projectid = $projectid;
	}


    private static $cache = array();

    /**
     * @param $projectid
     * @return Project
     * @throws \util\exception\ObjectNotFoundException
     */
    public static function create($projectid)
    {
        if   ( empty( Project::$cache[ $projectid ] ) )
        {
            $project = new Project( $projectid );

            Project::$cache[ $projectid ] = $project->load();
        }
        return Project::$cache[ $projectid ];
    }


    /**
	 * Stellt fest, ob die angegebene Projekt-Id existiert.
     * @param $id int Projekt-Id
     * @return boolean
     *
	 */
	public function isAvailable($id )
	{
		$db = \cms\base\DB::get();

		$sql = $db->sql('SELECT 1 FROM {{project}} '.
		               ' WHERE id={id}');
		$sql->setInt('id' ,$id  );

		return intval($sql->getOne()) == 1;
	}
	

    /**
     * Liefert alle verf?gbaren Projekte.
     * @return array
     */
    public static function getAllProjects()
	{
		$db = \cms\base\DB::get();
		$sql = $db->sql( 'SELECT id,name FROM {{project}} '.
		                '   ORDER BY name' );

		return $sql->getAssoc();
	}


    // Liefert alle verf?gbaren Projekt-Ids
    public function getAllProjectIds()
	{
		$db = \cms\base\DB::get();
		$sql = $db->sql( 'SELECT id FROM {{project}} '.
		                '   ORDER BY name' );

		return $sql->getCol();
	}


    /**
     * Liefert die Sprachen des Projektes.
     *
     * @return array Id->Name
     */
    public function getLanguages()
	{
		$db = \cms\base\DB::get();

		$sql = $db->sql( 'SELECT id,name FROM {{language}}'.
		                '  WHERE projectid={projectid} '.
		                '  ORDER BY name' );
		$sql->setInt   ('projectid',$this->projectid);

		return $sql->getAssoc();
	}


	public function getLanguageIds()
	{
		return array_keys( $this->getLanguages() );
	}


    /**
     * Liefert die Projektmodelle als Array mit ID->Name.
     *
     * @return array
     */
	public function getModels()
	{
		$db = \cms\base\DB::get();

		$sql = $db->sql( 'SELECT id,name FROM {{projectmodel}}'.
		                '  WHERE projectid= {projectid} '.
		                '  ORDER BY name' );
		$sql->setInt   ('projectid',$this->projectid);

		return $sql->getAssoc();
	}


	public function getModelIds()
	{
		return array_keys( $this->getModels() );
	}


    public function  getTemplateIds()
	{
		$db = \cms\base\DB::get();

		$sql = $db->sql( 'SELECT id FROM {{template}}'.
		                '  WHERE projectid= {projectid} ' );
		$sql->setInt   ('projectid',$this->projectid);

		return $sql->getCol();
	}


    public function  getTemplates()
	{
		$sql = Db::sql( 'SELECT id,name FROM {{template}}'.
		                '  WHERE projectid= {projectid} ' );
		$sql->setInt   ('projectid',$this->projectid);

		return $sql->getAssoc();
	}


	/**
	 * Ermitteln des Wurzel-Ordners fuer dieses Projekt.
	 * 
	 * Der Wurzelordner ist der einzige Ordnerhat in diesem
	 * Projekt, der kein Elternelement besitzt.
	 * 
	 * @return Objekt-Id des Wurzelordners
	 */
    public function  getRootObjectId()
	{
		$db = \cms\base\DB::get();
		
		$sql = $db->sql('SELECT id FROM {{object}}'.
		               '  WHERE parentid IS NULL'.
		               '    AND projectid={projectid}' );

		$sql->setInt('projectid',$this->projectid);
		
		return( $sql->getOne() );
	}

	

	// Laden

    /**
     * @throws \util\exception\ObjectNotFoundException
     */
    public function load()
	{
		$sql = Db::sql( 'SELECT * FROM {{project}} '.
		                '   WHERE id={projectid}' );
		$sql->setInt( 'projectid',$this->projectid );

		$row = $sql->getRow();

		if	( empty($row) )
			throw new \util\exception\ObjectNotFoundException('project '.$this->projectid.' not found');
			
		$this->name                = $row['name'               ];
		$this->url                 = $row['url'                ];
		$this->target_dir          = $row['target_dir'         ];
		$this->ftp_url             = $row['ftp_url'            ];
		$this->ftp_passive         = $row['ftp_passive'        ];
		$this->cmd_after_publish   = $row['cmd_after_publish'  ];
        $this->cut_index           = $row['flags']&self::FLAG_CUT_INDEX;
        $this->content_negotiation = $row['flags']&self::FLAG_CONTENT_NEGOTIATION;
        $this->publishFileExtension = $row['flags']&self::FLAG_PUBLISH_FILE_EXTENSION;
        $this->publishPageExtension = $row['flags']&self::FLAG_PUBLISH_PAGE_EXTENSION;
        $this->linkAbsolute         = $row['flags']&self::FLAG_LINK_ABSOLUTE;

        return $this;
	}



	// Speichern
	public function save()
	{
		$stmt = DB::sql( <<<SQL
				UPDATE {{project}}
                  SET name                = {name},
                      target_dir          = {target_dir},
                      ftp_url             = {ftp_url}, 
                      ftp_passive         = {ftp_passive}, 
                      url                 = {url}, 
                      flags               = {flags}, 
                      cmd_after_publish   = {cmd_after_publish} 
                WHERE id= {projectid}
SQL
);

		$stmt->setString('ftp_url'            ,$this->ftp_url );
		$stmt->setString('url'                ,$this->url );
		$stmt->setString('name'               ,$this->name );
		$stmt->setString('target_dir'         ,$this->target_dir );
		$stmt->setInt   ('ftp_passive'        ,$this->ftp_passive );
		$stmt->setString('cmd_after_publish'  ,$this->cmd_after_publish );

        $flags = 0;
        if( $this->cut_index           ) $flags |= self::FLAG_CUT_INDEX;
        if( $this->content_negotiation ) $flags |= self::FLAG_CONTENT_NEGOTIATION;
        if( $this->publishFileExtension) $flags |= self::FLAG_PUBLISH_FILE_EXTENSION;
        if( $this->publishPageExtension) $flags |= self::FLAG_PUBLISH_PAGE_EXTENSION;
        if( $this->linkAbsolute        ) $flags |= self::FLAG_LINK_ABSOLUTE;

        $stmt->setInt   ('flags'              ,$flags );
		$stmt->setInt   ('projectid'          ,$this->projectid );

		$stmt->query();

		try
		{
			$rootFolder = new Folder( $this->getRootObjectId() );
			$rootFolder->load();
			$rootFolder->filename = $this->name;
			$rootFolder->save();
		}
		catch( \Exception $e )
		{
			\logger\Logger::warn('Project '.$this->projectid.' has not a root folder'."\n".$e->getTraceAsString());
		}
	}


	/**
     * Liefert alle Eigenschaften des Projektes.
	*/
	public function getProperties()
	{
		return parent::getProperties();
	}


    /**
     * Add a project to the database.
     */
    public function add()
	{
		$db = \cms\base\DB::get();

		$sql = $db->sql('SELECT MAX(id) FROM {{project}}');
		$this->projectid = intval($sql->getOne())+1;


		// Projekt hinzuf?gen
		$sql = $db->sql( 'INSERT INTO {{project}} (id,name,target_dir,ftp_url,ftp_passive,cmd_after_publish,flags) '.
		                "  VALUES( {projectid},{name},'','',0,'',0 ) " );
		$sql->setInt   ('projectid',$this->projectid );
		$sql->setString('name'     ,$this->name      );

		$sql->query();

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
		$template->name       = '#1';
		$template->add();
		$template->save();

		// Template anlegen
		$templateModel = $template->loadTemplateModelFor( $model->modelid );
		$templateModel->extension  = 'html';
		$templateModel->src        = '<html><body><h1>Hello world</h1><hr><p>Hello, World.</p></body></html>';
		$templateModel->save();

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
	public function delete()
	{
		$db = \cms\base\DB::get();

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
		

		// Deleting the project
		$sql = $db->sql( 'DELETE FROM {{project}}'.
		                '  WHERE id= {projectid} ' );
		$sql->setInt( 'projectid',$this->projectid );
		$sql->query();
	}


    /**
     * Liefert die Standard-Sprach-Id. If there is no default language, the first language-id will be used.
     * @return String
     */
	public function getDefaultLanguageId()
	{
		// ORDER BY deswegen, damit immer mind. eine Sprache
		// gelesen wird
		$sql = \cms\base\Db::sql( 'SELECT id FROM {{language}} '.
		                '  WHERE projectid={projectid}'.
		                '   ORDER BY is_default DESC, name ASC' );

		$sql->setInt('projectid',$this->projectid );
		
		return $sql->getOne();
	}


	public function getDefaultModelId()
	{
		// ORDER BY deswegen, damit immer mind. eine Sprache
		// gelesen wird
		$sql = \cms\base\Db::sql( 'SELECT id FROM {{projectmodel}} '.
		                '  WHERE projectid={projectid}'.
		                '   ORDER BY is_default DESC' );
		$sql->setInt('projectid',$this->projectid );
		
		return $sql->getOne();
	}

	
	
	/**
	 * Entfernt nicht mehr notwendige Inhalte aus dem Archiv.
	 */
	public function checkLimit()
	{
		$root = new Folder( $this->getRootObjectId() );
		$root->projectid = $this->projectid;
		
		$pages = $this->getAllObjectIds( array('page') );
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
		
		// Ordnerstruktur prüfen.
		$stmt = \cms\base\Db::sql( <<<EOF
SELECT thistab.id FROM {{object}} AS thistab
 LEFT JOIN {{object}} AS parenttab
        ON parenttab.id = thistab.parentid
  WHERE thistab.projectid={projectid} AND thistab.parentid IS NOT NULL AND parenttab.id IS NULL
EOF
);
		$stmt->setInt('projectid',$this->projectid);

		$idList = $stmt->getCol();
		
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
				$obj = new BaseObject( $id );
				$obj->setParentId( $lostAndFoundFolder->objectid );
			}
		}

		
		// Prüfe, ob die Verbindung Projekt->Template->Templatemodell->Projectmodell->Projekt konsistent ist. 
		$stmt = \cms\base\Db::sql( <<<EOF
SELECT DISTINCT projectid FROM {{projectmodel}} WHERE id IN (SELECT projectmodelid from {{templatemodel}} WHERE templateid in (SELECT id from {{template}} WHERE projectid={projectid}))
EOF
);
		$stmt->setInt('projectid',$this->projectid);

		$idList = $stmt->getCol();
		
		if	( count( $idList ) > 1 )
		{
			\logger\Logger::warn('Inconsistence found: Reference circle project<->template<->templatemodel<->projectmodel<->project is not consistent.');
			$this->log[] = 'Inconsistence found: Reference circle project<->template<->templatemodel<->projectmodel<->project is not consistent.';
		}

	}
	
	
	/**
	 * Synchronisation des Projektinhaltes mit dem Dateisystem.
	 */
	public function  sync()
	{
		$conf = \cms\base\Configuration::rawConfig();
		$syncConf = $conf['sync'];
		
		if	( ! $syncConf['enabled'] )
			return;
		
		$syncDir = FileUtils::slashify($syncConf['directory']).$this->name;
		
	}

    /**
     * Kopiert ein Projekt von einer Datenbank zu einer anderen.<br>
     * <br>
     * Alle Projektinhalte werden kopiert, die Fremdschluesselbeziehungen werden entsprechend angepasst.<br>
     * <br>
     * Alle Beziehungen zu Benutzern, z.B. "Zuletzt geaendert von", "angelegt von" sowie<br>
     * alle Berechtigungsinformationen gehen verloren!<br>
     *
     * @param string $dbid_destination ID der Ziel-Datenbank
     * @param string $name
     */
	public function copy( $dbid_destination,$name='' )
	{
		\logger\Logger::debug( 'Copying project '.$this->name.' to database '.$dbid_destination );
		
		$conf = \cms\base\Configuration::rawConfig();
		$zeit = date('Y-m-d\TH:i:sO');
		
		$db_src  = \cms\base\DB::get();
		$db_dest = new Database( $conf['database'][$dbid_destination] );
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
			\logger\Logger::debug( 'Copying table '.$tabelle.' ...' );
			$mapping[$tabelle] = array();
			$idcolumn = $data['primary_key'];

			// Naechste freie Id in der Zieltabelle ermitteln.
			$stmt = $db_dest->sql( 'SELECT MAX('.$idcolumn.') FROM {t_'.$tabelle.'}');
			$maxid = intval($stmt->getOne());
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
			$stmt = $db_src->sql( 'SELECT '.$idcolumn.' FROM {t_'.$tabelle.'} '.$where);

			foreach( $stmt->getCol() as $srcid )
			{
				\logger\Logger::debug('Id '.$srcid.' of table '.$tabelle);
				$mapping[$tabelle][$srcid] = ++$nextid;

				$stmt = $db_src->sql( 'SELECT * FROM {t_'.$tabelle.'} WHERE id={id}');
				$stmt->setInt('id',$srcid);
				$row = $stmt->getRow();

				// Wert des Prim�rschl�ssels �ndern.
				$row[$idcolumn] = $mapping[$tabelle][$srcid];

				// Fremdschl�sselbeziehungen auf neue IDn korrigieren.
				foreach( $data['foreign_keys'] as $fkey_column=>$target_tabelle)
				{
					\logger\Logger::debug($fkey_column.' '.$target_tabelle.' '.$row[$fkey_column]);
					
					if	( intval($row[$fkey_column]) != 0 )
						$row[$fkey_column] = $mapping[$target_tabelle][$row[$fkey_column]];
				}
				
				foreach( array_keys($row) as $key )
				{
					if	( isset($data['unique_idx']) && $key == $data['unique_idx'] )
					{
						// Nachschauen, ob es einen UNIQUE-Key in der Zieltabelle schon gibt.
						$stmt = $db_dest->sql( 'SELECT 1 FROM {t_'.$tabelle.'} WHERE '.$key."='".$row[$key]."'");
						
						if	( intval($stmt->getOne()) == 1 )
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
				$stmt = $db_dest->sql( 'INSERT INTO {t_'.$tabelle.'} ('.join(array_keys($row),',').') VALUES({'.join(array_keys($row),'},{').'})',$dbid_destination);
				foreach( $row as $key=>$value )
				{
					if	( !$sameDB && isset($data['erase']) && in_array($key,$data['erase']) )
						$stmt->setNull($key);
					else
                    {
                        if(is_bool($value))
                            $stmt->setBoolean($key,$value);
                        elseif(is_int($value))
                            $stmt->setInt($key,$value);
                        elseif(is_string($value))
                            $stmt->setString($key,$value);
                    }
				}
				//$sql = $db->sql( 'INSERT INTO {t_'.$tabelle.'} ('.join(array_keys($row),',').') VALUES('.join($row,',').')',$dbid_destination);
                $stmt->query();
			}

			if	( isset($data['self_key']) )
			{
				foreach( $mapping[$tabelle] as $oldid=>$newid )
				{
					$stmt = $db_dest->sql( 'UPDATE {t_'.$tabelle.'} SET '.$data['self_key'].'='.$newid.' WHERE '.$data['self_key'].'='.($oldid+$maxid),$dbid_destination );
					$stmt->query();
				}
			}
		}
		
		\logger\Logger::debug( 'Finished copying project' );
		
		$db_dest->commit();
	}

	

	/**
	 * Ermittelt die Anzahl aller Objekte in diesem Projekt.
	 * @return int Anzahl
	 */
	public function countObjects()
	{
		$db = \cms\base\DB::get();
		$sql = $db->sql( 'SELECT COUNT(*) FROM {{object}} '.
		                '   WHERE projectid = {projectid}' );
		$sql->setInt( 'projectid', $this->projectid );

		return $sql->getOne();
		
	}

	
	
	/**
	 * Ermittelt die Gr��e aller Dateien in diesem Projekt.
	 * @return int Summe aller Dateigroessen
	 */
	public function size()
	{
		$db = \cms\base\DB::get();
		
		$sql = $db->sql( <<<SQL
		SELECT SUM(size) FROM {{file}}
		  LEFT JOIN {{object}}
		         ON {{file}}.objectid = {{object}}.id
		      WHERE projectid = {projectid}
SQL
);
		$sql->setInt( 'projectid', $this->projectid );

		return $sql->getOne();
	}
	
	
	
	/**
	 * Liefert alle verf?gbaren Projekt-Ids
	 */
	public function info()
	{
		$info = array();
		
		$info['count_objects'] = $this->countObjects();
		$info['sum_filesize' ] = $this->size();
		
		
		return $info;
	}
	
	
	

	/**
	 * Ermittelt projektübergreifend die letzten Änderungen des angemeldeten Benutzers.
	 *  
	 * @return array <string, unknown>
	 */
	public function getMyLastChanges()
	{
		
		$db = \cms\base\DB::get();


		$sql = $db->sql( <<<SQL
		SELECT {{object}}.id    as objectid,
		       {{object}}.filename as filename,
		       {{object}}.typeid as typeid,
		       {{object}}.lastchange_date as lastchange_date,			
		       {{name}}.name as name				
		  FROM {{object}}
		  LEFT JOIN {{name}}
		         ON {{name}}.objectid = {{object}}.id
				AND {{name}}.languageid = {languageid}
		  LEFT JOIN {{project}}
		         ON {{object}}.projectid = {{project}}.id
			  WHERE {{object}}.projectid         = {projectid}
				AND {{object}}.lastchange_userid = {userid}
		   ORDER BY {{object}}.lastchange_date DESC;
SQL
		);
		
		// Variablen setzen.
		$sql->setInt( 'projectid', $this->projectid );
		
		$sql->setInt( 'languageid', 0 );
		
		$user = Session::getUser();
		$sql->setInt( 'userid', $user->userid );
		
		return $sql->getAll();
	}
	

	/**
	 * Ermittelt projektübergreifend die letzten Änderungen.
	 *  
	 * @return array
	 */
	public static function getAllLastChanges()
	{
		$db = \cms\base\DB::get();

		$sql = $db->sql( <<<SQL
		SELECT {{object}}.id    as objectid,
		       {{object}}.lastchange_date as lastchange_date,
		       {{object}}.filename as filename,
		       {{project}}.id   as projectid,
			   {{project}}.name as projectname,
		       {{user}}.name       as username,
		       {{user}}.id         as userid,
		       {{user}}.mail       as usermail,
		       {{user}}.fullname   as userfullname
		  FROM {{object}}
		  LEFT JOIN {{project}}
		         ON {{object}}.projectid = {{project}}.id
		  LEFT JOIN {{user}}
		         ON {{user}}.id = {{object}}.lastchange_userid
		  ORDER BY {{object}}.lastchange_date DESC
		  LIMIT 50
SQL
		);
		
		return $sql->getAll();
	}
	


	/**
	 * Ermittelt die letzten Änderung im Projekt.
	 * @return array
	 */
	public function  getLastChanges()
	{
		
		$db = \cms\base\DB::get();
		
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
			  WHERE {{object}}.projectid = {projectid}
		   ORDER BY {{object}}.lastchange_date DESC
SQL
		);
		
		// Variablen setzen.
		$sql->setInt( 'projectid', $this->projectid );
		
		$languageid = $this->getDefaultLanguageId();
		$sql->setInt( 'languageid', $languageid );
		
		return $sql->getAll();
	}

    /**
     * Ermittelt alle Objekte vom gew�nschten Typ, die sic in
     * diesem Projekt befinden.
     *
     * @see objectClasses/Object#getAllObjectIds()
     * @param types Array
     * @return Liste von Object-Ids
     */
    public function getAllObjectIds( $types=array('folder','page','link','file','image','url','text') )
    {
        $stmt = \cms\base\Db::sql( <<<SQL
          SELECT id FROM {{object}}
              WHERE projectid={projectid}
                AND (    typeid  ={is_folder}
                      OR typeid  ={is_file}
                      OR typeid  ={is_image}
                      OR typeid  ={is_text}
                      OR typeid  ={is_page}
                      OR typeid  ={is_link}
                      OR typeid  ={is_url} )
             ORDER BY orderid ASC
SQL
        );

        $stmt->setInt('projectid',$this->projectid );
        $stmt->setInt('is_folder',in_array('folder',$types)?BaseObject::TYPEID_FOLDER:0);
        $stmt->setInt('is_file'  ,in_array('file'  ,$types)?BaseObject::TYPEID_FILE  :0);
        $stmt->setInt('is_image' ,in_array('image' ,$types)?BaseObject::TYPEID_IMAGE :0);
        $stmt->setInt('is_text'  ,in_array('text'  ,$types)?BaseObject::TYPEID_TEXT  :0);
        $stmt->setInt('is_page'  ,in_array('page'  ,$types)?BaseObject::TYPEID_PAGE  :0);
        $stmt->setInt('is_link'  ,in_array('link'  ,$types)?BaseObject::TYPEID_LINK  :0);
        $stmt->setInt('is_url'   ,in_array('url'   ,$types)?BaseObject::TYPEID_URL   :0);

        return( $stmt->getCol() );
    }


    /**
     * Liefert die Ids aller Ordner in diesem Projekt.
     *
     * @return array
     */
    public function getAllFolders()
    {
        $stmt = DB::sql( <<<SQL
			SELECT id FROM {{object}}
              WHERE typeid={typeid}
                AND projectid={projectid}
SQL
		);
        $stmt->setInt( 'typeid'   ,BaseObject::TYPEID_FOLDER );
        $stmt->setInt( 'projectid',$this->projectid                 );

        return( $stmt->getCol() );
    }


    /**
     * @return array
     */
    public function getAllFlatFolders() {

        $folders = array();

        foreach( $this->getAllFolders() as $id )
        {
            $o = new BaseObject( $id );
            $o->load();

            $folders[ $id ] = '';
            if	( !$o->isRoot )
            {
                $f = new Folder( $o->parentid );
                $f->load();
                $names = $f->parentObjectNames(true,true);
                foreach( $names as $fid=>$name )
                    $names[$fid] = \util\Text::maxLength($name,15,'..',STR_PAD_BOTH);
                $folders[ $id ] = implode( \util\Text::FILE_SEP,$names );
                $folders[ $id ] .= \util\Text::FILE_SEP;
            }
            $folders[ $id ] .= $o->getName();
        }

        asort( $folders ); // Sortieren

        return $folders;
    }

    public function getName()
    {
        return $this->name;
    }


	/**
	 * Cleans up the target url.
	 */
	public function getCleanTarget()
	{
		$target = parse_url( $this->target_dir );

		$scheme   = isset($target['scheme']) ? $target['scheme'] . '://' : '';
		if   ( empty($scheme) )
			$scheme = 'file:/';

		$host     = isset($target['host']) ? $target['host'] : '';
		$port     = isset($target['port']) ? ':' . $target['port'] : '';
		$user     = isset($target['user']) ? $target['user'] : '';
		$pass     = isset($target['pass']) ? ':' . $target['pass']  : '';
		$pass     = ($user || $pass) ? "$pass@" : '';
		$path     = isset($target['path']) ? $target['path'] : '';
		$query    = isset($target['query']) ? '?' . $target['query'] : '';
		$fragment = isset($target['fragment']) ? '#' . $target['fragment'] : '';

		return "$scheme$user$pass$host$port$path$query$fragment";
	}



	public function getId()
	{
		return $this->projectid;
	}


}

