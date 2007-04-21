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
		$db_src  = db_connection();
		$db_dest = new DB( $conf['database'][$dbid_destination] );
		
		$aa = 5000; // Bisher nicht erreichte ID in der Zieldatenbank

		// -------------------------------------------------------
		$prefix = 'a24_';
		$mapping = array();
		$ids = array('project.id'=>array('object.projectid','projectmodel.projectid','template.projectid','language.projectid'),
		             'object.id' =>array('object.parentid','name.objectid','link.objectid','file.objectid','folder.objectid','page.objectid','element.default_objectid','element.folderobjectid','value.linkobjectid'),
		             'language.id'=>array('value.languageid','name.languageid'),
		             'projectmodel.id'=>array('templatemodel.projectmodelid'),
		             'template.id'=>array('templatemodel.templateid','page.templateid','element.templateid'),
		             'templatemodel.id'=>array(),
		             'element.id'=>array('value.elementid'),
		             'name.id'=>array(),
		             'page.id'=>array('value.pageid'),
		             'value.id'=>array(),
		             'link.id'=>array(),
		             'folder.id'=>array(),
		             'file.id'=>array()
		             
		);
		foreach( $ids as $id=>$fields )
		{
			list($tabelle,$idcolumn) = explode('.',$id);

			$sql = new Sql( 'SELECT MAX(id) FROM {t_'.$tabelle.'}');
			$nextid = intval($db_dest->getOne($sql->query));

			$sql = new Sql( 'SELECT '.$idcolumn.' FROM {t_'.$tabelle.'} WHERE id={projectid}');
			$sql->setInt('projectid',$this->projectid);

			foreach( $db_src->getRow($sql->query) as $id )
			{
				$mapping[$tabelle] = array();
				$mapping[$tabelle][$id] = ++$nextid;
				
				$sql = new Sql( 'SELECT * FROM {t_'.$tabelle.'} WHERE id={id}');
				$sql->setInt('id',$id);
				$row = $db_src->getRow( $sql->query );
				$row[$idcolumn] = $mapping[$tabelle][$mapping[$tabelle][$id]];

				$sql = new Sql( 'INSERT INTO {t_'.$tabelle.'} ('.join(array_keys($row),',').') VALUES('.join($row,',').')');
				$sql->setInt('id',$id);
				$row = $db_src->getRow( $sql->query );
			}
			
			
			continue;
		
			$x_id = explode('.',$id);
			$x_id[0] = $prefix.$x_id[0];
			$sql = 'SELECT '.$x_id[1].' FROM '.$x_id[0];
			echo "$sql<br>";
			$res = mysql_query( $sql );
			if	( mysql_errno()!=0) die( mysql_error() );
			echo mysql_error();
		
			while( $row = mysql_fetch_assoc($res) )
			{
				$oldid = $row[ $x_id[1] ];
				$newid = $oldid+$aa;
				$sql = 'UPDATE '.$x_id[0].' SET '.$x_id[1]."=$newid where ".$x_id[1]."=$oldid";
				echo "$sql<br>";
				mysql_query( $sql );
				if	( mysql_errno()!=0) die( mysql_error() );
				
				foreach( $fields as $field )
				{
					$x_field = explode('.',$field);
					$x_field[0] = $prefix.$x_field[0];
					$sql = "UPDATE ".$x_field[0]." SET ".$x_field[1]."=$newid WHERE ".$x_field[1]."=$oldid";
					echo "$sql<br>";
					mysql_query( $sql );
					if	( mysql_errno()!=0) die( mysql_error() );
				}
			}
			
		}
		
		return;
		
		
		$sql = 'UPDATE '.$prefix.'object SET create_userid = NULL';
		echo "$sql<br>";
		mysql_query( $sql );
		
		$sql = 'UPDATE '.$prefix.'object SET lastchange_userid = NULL';
		echo "$sql<br>";
		mysql_query( $sql );
		
		$sql = 'UPDATE '.$prefix.'value SET lastchange_userid = NULL';
		echo "$sql<br>";
		mysql_query( $sql );

	}
}

?>