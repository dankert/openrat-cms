<?php
#
#  DaCMS Content Management System
#  Copyright (C) 2002 Jan Dankert, jandankert@jandankert.de
#
#  This program is free software; you can redistribute it and/or
#  modify it under the terms of the GNU General Public License
#  as published by the Free Software Foundation; either version 2
#  of the License, or (at your option) any later version.
#
#  This program is distributed in the hope that it will be useful,
#  but WITHOUT ANY WARRANTY; without even the implied warranty of
#  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#  GNU General Public License for more details.
#
#  You should have received a copy of the GNU General Public License
#  along with this program; if not, write to the Free Software
#  Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
#


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
		global $SESS;

		if   ( intval($projectid)>0 )
			$this->projectid = $projectid;
		else	$this->projectid = $SESS['projectid'];
	}


	// Liefert alle verfügbaren Projekte
	function getAll()
	{
		$db = db_connection();
		$sql = new Sql( 'SELECT id,name FROM {t_project} '.
		                '   ORDER BY name' );

		return $db->getAssoc( $sql->query );
	}


	function getLanguageIds()
	{
		$db = db_connection();

		$sql = new Sql( 'SELECT id FROM {t_language}'.
		                '  WHERE projectid={projectid} ' );
		$sql->setInt   ('projectid',$this->projectid);

		return $db->getCol( $sql->query );
	}


	function getModelIds()
	{
		$db = db_connection();

		$sql = new Sql( 'SELECT id FROM {t_projectmodel}'.
		                '  WHERE projectid= {projectid} ' );
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

		$this->name                = $row['name'];
		$this->target_dir          = $row['target_dir'];
		$this->ftp_url             = $row['ftp_url'];
		$this->ftp_passive         = $row['ftp_passive'];
		$this->cmd_after_publish   = $row['cmd_after_publish'];
		$this->content_negotiation = $row['content_negotiation'];
		$this->cut_index           = $row['cut_index'];
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


		// Projekt hinzufügen
		$sql = new Sql( 'INSERT INTO {t_project} (id,name,target_dir,ftp_url,ftp_passive,cmd_after_publish,content_negotiation,cut_index) '.
		                "  VALUES( {projectid},{name},'','',0,'',0,0 ) " );
		$sql->setString('name'     ,$this->name );
		$sql->setInt   ('projectid',$this->projectid );

		$db->query( $sql->query );
		
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

		// Modell anlegen
		$model = new Model();
		$model->projectid = $this->projectid;
		$model->name = 'html';
		$model->add();
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
		

		// Projekt löschen
		$sql = new Sql( 'DELETE FROM {t_project}'.
		                '  WHERE id= {projectid} ' );
		$sql->setInt( 'projectid',$this->projectid );
		$db->query( $sql->query );
	}
}

?>