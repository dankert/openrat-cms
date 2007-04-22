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
// Revision 1.14  2007-04-22 00:17:30  dankert
// Neue Methode "export()" - fertiggestellt :)
//
// Revision 1.13  2007-04-21 11:53:09  dankert
// Neue Methode "export()" - in Arbeit, TODO!
//
// Revision 1.12  2007-04-06 01:37:49  dankert
// Verhindern einer Warnung bei modernen PHP-Versionen.
//
// Revision 1.11  2007/02/26 22:05:08  dankert
// Neue Methode "loadByName()"
//
// Revision 1.10  2006/07/19 21:30:32  dankert
// Beim Speichern auch ?ndern des Root-Folders
//
// Revision 1.9  2006/06/01 20:58:11  dankert
// Projektwartung: Suche nach verlorenen Dateien.
//
// Revision 1.8  2004/12/29 20:18:20  dankert
// Konstruktor geaendert
//
// Revision 1.7  2004/12/19 15:23:56  dankert
// Anpassung Session-Funktionen
//
// Revision 1.6  2004/12/15 23:16:58  dankert
// Anpassung an Session-Funktionen
//
// Revision 1.5  2004/11/10 22:47:57  dankert
// Methoden zum Lesen von Standardmodell, Standardsprache dieses Projektes
//
// Revision 1.4  2004/10/14 21:13:56  dankert
// *** empty log message ***
//
// Revision 1.3  2004/05/02 14:41:31  dankert
// Einf?gen package-name (@package)
//
// ---------------------------------------------------------------------------


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
	
	// Konstruktor
	function Project( $projectid='' )
	{
		if   ( intval($projectid) != 0 )
			$this->projectid = $projectid;
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
		$sql = new Sql( 'SELECT id,name FROM {t_project} '.
		                '   ORDER BY name' );

		return $db->getAssoc( $sql->query );
	}


	// Liefert alle verf?gbaren Projekt-Ids
	function getAllProjectIds()
	{
		$db = db_connection();
		$sql = new Sql( 'SELECT id FROM {t_project} '.
		                '   ORDER BY name' );

		return $db->getCol( $sql->query );
	}


	function getLanguageIds()
	{
		$db = db_connection();

		$sql = new Sql( 'SELECT id FROM {t_language}'.
		                '  WHERE projectid={projectid} '.
		                '  ORDER BY name' );
		$sql->setInt   ('projectid',$this->projectid);

		return $db->getCol( $sql->query );
	}


	function getModelIds()
	{
		$db = db_connection();

		$sql = new Sql( 'SELECT id FROM {t_projectmodel}'.
		                '  WHERE projectid= {projectid} '.
		                '  ORDER BY name' );
		$sql->setInt   ('projectid',$this->projectid);

		return $db->getCol( $sql->query );
	}


	function getTemplateIds()
	{
		$db = db_connection();

		$sql = new Sql( 'SELECT id FROM {t_template}'.
		                '  WHERE projectid= {projectid} ' );
		$sql->setInt   ('projectid',$this->projectid);

		return $db->getCol( $sql->query );
	}


	/**
	 * Ermitteln des Root-Ordners zu diesem Projekt
	 */
	function getRootObjectId()
	{
		$db = db_connection();
		
		$sql = new Sql('SELECT id FROM {t_object}'.
		               '  WHERE parentid IS NULL'.
		               '    AND projectid={projectid}' );

		$sql->setInt('projectid',$this->projectid);
		
		return( $db->getOne( $sql->query ) );
	}

	

	// Laden
	function load()
	{
		$db = db_connection();

		$sql = new Sql( 'SELECT * FROM {t_project} '.
		                '   WHERE id={projectid}' );
		$sql->setInt( 'projectid',$this->projectid );

		$row = $db->getRow( $sql->query );

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

		$sql = new Sql( 'SELECT * FROM {t_project} '.
		                '   WHERE name={projectname}' );
		$sql->setString( 'projectname',$this->name );

		$row = $db->getRow( $sql->query );

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

		$sql = new Sql( 'UPDATE {t_project}'.
		                '  SET name                = {name},'.
		                '      target_dir          = {target_dir},'.
		                '      ftp_url             = {ftp_url}, '.
		                '      ftp_passive         = {ftp_passive}, '.
		                '      cut_index           = {cut_index}, '.
		                '      content_negotiation = {content_negotiation}, '.
		                '      cmd_after_publish   = {cmd_after_publish} '.
		                'WHERE id= {projectid} ' );

		$sql->setString('name'               ,$this->name );
		$sql->setString('target_dir'         ,$this->target_dir );
		$sql->setString('ftp_url'            ,$this->ftp_url );
		$sql->setInt   ('ftp_passive'        ,$this->ftp_passive );
		$sql->setString('cmd_after_publish'  ,$this->cmd_after_publish );
		$sql->setInt   ('content_negotiation',$this->content_negotiation );
		$sql->setInt   ('cut_index'          ,$this->cut_index );
		$sql->setInt   ('projectid'          ,$this->projectid );

		$db->query( $sql->query );
		
		$rootFolder = new Folder( $this->getRootObjectId() );
		$rootFolder->load();
		$rootFolder->filename = $this->name;
		$rootFolder->save();
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
		$this->projectid = intval($db->getOne($sql->query))+1;


		// Projekt hinzuf?gen
		$sql = new Sql( 'INSERT INTO {t_project} (id,name,target_dir,ftp_url,ftp_passive,cmd_after_publish,content_negotiation,cut_index) '.
		                "  VALUES( {projectid},{name},'','',0,'',0,0 ) " );
		$sql->setString('name'     ,$this->name );
		$sql->setInt   ('projectid',$this->projectid );

		$db->query( $sql->query );

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
		$template->src        = '<html><body>...</body></html>';
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
		$db->query( $sql->query );
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
		
		return $db->getOne( $sql->query );
	}


	function getDefaultModelId()
	{
		$db = Session::getDatabase();

		// ORDER BY deswegen, damit immer mind. eine Sprache
		// gelesen wird
		$sql = new Sql( 'SELECT id FROM {t_model} '.
		                '  WHERE projectid={projectid}'.
		                '   ORDER BY is_default DESC' );
		$sql->setInt('projectid',$this->projectid );
		
		return $db->getOne( $sql->query );
	}
	
	
	function checkLostFiles()
	{
		$db = &Session::getDatabase();
		
		$sql = new Sql( <<<EOF
SELECT thistab.id FROM {t_object} AS thistab
 LEFT JOIN {t_object} AS parenttab
        ON parenttab.id = thistab.parentid
  WHERE thistab.projectid={projectid} AND thistab.parentid IS NOT NULL AND parenttab.id IS NULL
EOF
);
		$sql->setInt('projectid',$this->projectid);

		$lostAndFoundFolder = new Folder();
		$lostAndFoundFolder->projectid = $this->projectid;
		$lostAndFoundFolder->languageid = $this->getDefaultLanguageId();
		$lostAndFoundFolder->filename = "lostandfound";
		$lostAndFoundFolder->name     = 'Lost+found';
		$lostAndFoundFolder->parentid = $this->getRootObjectId();
		$lostAndFoundFolder->add();

		foreach( $db->getCol($sql->query) as $id )
		{
			echo 'Lost file! moving '.$id.' to lost+found.';
			$obj = new Object( $id );
			$obj->setParentId( $lostAndFoundFolder->objectid );
		}
	}
	
	
	/**
	 * Kopiert ein Projekt von einer Datenbank zu einer anderen.<br>
	 * <br>
	 * Alle Projektinhalte werden kopiert, die Fremdschlüsselbeziehungen werden entsprechend angepasst.<br>
	 * <br>
	 * Alle Beziehungen zu Benutzern, z.B. "Zuletzt geändert von", "angelegt von" sowie<br>
	 * alle Berechtigungsinformationen gehen verloren!<br>
	 */
	function export( $dbid_destination )
	{
		global $conf;
		$zeit = date('Y-m-d\TH:i:sO');
		
		$db_src  = db_connection();
		$db_dest = new DB( $conf['database'][$dbid_destination] );
		
//		$aa = 5000; // Bisher nicht erreichte ID in der Zieldatenbank

		// -------------------------------------------------------
//		$prefix = 'a24_';
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
		foreach( $ids as $tabelle=>$data )
		{
//			Html::debug($tabelle,"Tabelle");
			
			$mapping[$tabelle] = array();
			$idcolumn = $data['primary_key'];

			// Nächste freie Id in der Zieltabelle ermitteln.
			$sql = new Sql( 'SELECT MAX('.$idcolumn.') FROM {t_'.$tabelle.'}',$dbid_destination);
			$maxid = intval($db_dest->getOne($sql->query));
			$nextid = $maxid;

			// Zu übertragende IDs ermitteln.
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

			foreach( $db_src->getCol($sql->query) as $srcid )
			{
				$mapping[$tabelle][$srcid] = ++$nextid;

//				Html::debug($mapping,"Mapping");
				
				$sql = new Sql( 'SELECT * FROM {t_'.$tabelle.'} WHERE id={id}');
				$sql->setInt('id',$srcid);
				$row = $db_src->getRow( $sql->query );

				// Wert des Primärschlüssels ändern.
				$row[$idcolumn] = $mapping[$tabelle][$srcid];

				// Fremdschlüsselbeziehungen auf neue IDn korrigieren.
				foreach( $data['foreign_keys'] as $fkey_column=>$target_tabelle)
				{
					if	( intval($row[$fkey_column]) != 0 )
						$row[$fkey_column] = $mapping[$target_tabelle][$row[$fkey_column]];
//					if	( !isset($mapping[$target_tabelle][$row[$fkey_column]]))
//						Html::debug('Fehler: T='.$target_tabelle.', Column='.$fkey_column);
						
				}
				
				foreach( array_keys($row) as $key )
				{
					if	( isset($data['unique_idx']) && $key == $data['unique_idx'] )
					{
						// Nachschauen, ob es einen UNIQUE-Key in der Zieltabelle schon gibt.
						$sql = new Sql( 'SELECT 1 FROM {t_'.$tabelle.'} WHERE '.$key."='".$row[$key]."'",$dbid_destination);
//						Html::debug($sql->query);
						
						if	( intval($db_dest->getOne( $sql->query )) == 1 )
							$row[$key] = $row[$key].$zeit;

					}

					if	( isset($data['erase']) && in_array($key,$data['erase']) )
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
				
//				Html::debug($row,'Zeile');
				
				// Daten in Zieltabelle einfügen.
				$sql = new Sql( 'INSERT INTO {t_'.$tabelle.'} ('.join(array_keys($row),',').') VALUES({'.join(array_keys($row),'},{').'})',$dbid_destination);
				foreach( $row as $key=>$value )
				{
					if	( isset($data['erase']) && in_array($key,$data['erase']) )
						$sql->setNull($key);
					else
						$sql->setVar($key,$value);
				}
				//$sql = new Sql( 'INSERT INTO {t_'.$tabelle.'} ('.join(array_keys($row),',').') VALUES('.join($row,',').')',$dbid_destination);
				$db_dest->query( $sql->query );
			}

			if	( isset($data['self_key']) )
			{
				foreach( $mapping[$tabelle] as $oldid=>$newid )
				{
					$sql = new Sql( 'UPDATE {t_'.$tabelle.'} SET '.$data['self_key'].'='.$newid.' WHERE '.$data['self_key'].'='.($oldid+$maxid),$dbid_destination );
					$db_dest->query( $sql->query );
				}
			}
		}
	}
}

?>