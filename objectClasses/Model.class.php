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


class Model
{
	var $modelid = 0;
	var $error      = '';
	var $projectid;

	var $name      = '';
	var $isDefault = false;


	// Konstruktor
	function Model( $modelid='' )
	{
		global $SESS;

		if   ( is_numeric($modelid) )
			$this->modelid = $modelid;

		$this->projectid = $SESS['projectid'];
	}


	// Lesen aller Projektmodelle aus der Datenbank
	function getAll()
	{
		global $SESS;
		$db = db_connection();

		$sql = new Sql( "SELECT id,name FROM {t_model} ".
		                "   WHERE projectid = {projectid} ".
		                "   ORDER BY name" );

		if	( isset($this) )
			$sql->setInt('projectid',$this->projectid );
		else	$sql->setInt('projectid',$SESS['projectid'] );

		return $db->getAssoc( $sql->query );
	}


	// Lesen aus der Datenbank
	function load()
	{
		$db = db_connection();

		$sql = new Sql( 'SELECT * FROM {t_model}'.
		                ' WHERE id={modelid}' );
		$sql->setInt( 'modelid',$this->modelid );

		$row = $db->getRow( $sql->query );

		$this->name     = $row['name'];
	
		if	( $row['is_default'] == '1' )
			$this->isDefault = true;
		else $this->isDefault = false;
	}


	// Speichern der Sprache in der Datenbank
	function save()
	{
		$db = db_connection();

		// Gruppe speichern		
		$sql = new Sql( 'UPDATE {t_model} '.
		                '  SET name      = {name} '.
		                '  WHERE id={modelid}' );
		$sql->setString( 'name'     ,$this->name    );

		$sql->setInt( 'modelid',$this->modelid );

		// Datenbankabfrage ausfuehren
		$db->query( $sql->query );
	}


	function getProperties()
	{
		return Array( 'name'=>$this->name );
	}


	// Modell hinzufuegen
	function add( $name = '' )
	{
		if	( $name != '' )
			$this->name = $name;
		
		$db = db_connection();

		$sql = new Sql('SELECT MAX(id) FROM {t_model}');
		$this->modelid = intval($db->getOne($sql->query))+1;

		// Modell hinzufügen
		$sql = new Sql( 'INSERT INTO {t_model} '.
		                "(id,projectid,name,extension,selflink,is_default) VALUES( {modelid},{projectid},{name},'',0,0 )");

		$sql->setInt   ('modelid'  ,$this->modelid   );
		$sql->setInt   ('projectid',$this->projectid );
		$sql->setString('name'     ,$this->name      );

		// Datenbankbefehl ausfuehren
		$db->query( $sql->query );
	}


	function getDefaultId()
	{
		global $SESS;
		$db = db_connection();

		$sql = new Sql( 'SELECT id FROM {t_model} '.
		                '  WHERE projectid={projectid}'.
		                '   ORDER BY is_default DESC' );
		if	( isset($this->projectid) )
			$sql->setInt('projectid',$this->projectid );
		else	$sql->setInt('projectid',$SESS['projectid'] );
		
		return $db->getOne( $sql->query );
	}



	// Diese Sprache als 'default' markieren.
	function setDefault()
	{
		global $SESS;
		$db = db_connection();

		// Zuerst alle auf nicht-Standard setzen
		$sql = new Sql( 'UPDATE {t_model} '.
		                '  SET is_default = 0 '.
		                '  WHERE projectid={projectid}' );
		$sql->setInt('projectid',$this->projectid );
		$db->query( $sql->query );
	
		// Jetzt die gewünschte Sprachvariante auf Standard setzen
		$sql = new Sql( 'UPDATE {t_model} '.
		                '  SET is_default = 1 '.
		                '  WHERE id={modelid}' );
		$sql->setInt('modelid',$this->modelid );
		$db->query( $sql->query );
	}


	// Modell entfernen
	function delete()
	{
		$db = db_connection();

//		$sql = new Sql( 'SELECT COUNT(*) FROM {t_model} WHERE projectid={projectid}' );
//		$sql->setInt( 'projectid',$this->projectid );
//		$count = $db->getOne( $sql->query );
//		
//		// Nur löschen, wenn es mindestens 2 Modelle gibt
//		if   ( $count >= 2 )
//		{
			// Modell löschen
			$sql = new Sql( 'DELETE FROM {t_model} WHERE id={modelid}' );
			$sql->setInt( 'modelid',$this->modelid );
			$db->query( $sql->query );

			// Anderes Modell auf "Default" setzen
			$sql = new Sql( 'SELECT id FROM {t_model} WHERE projectid={projectid}' );
			$sql->setInt( 'projectid',$this->projectid );
			$new_default_modelid = $db->getOne( $sql->query );

			$sql = new Sql( 'UPDATE {t_model} SET is_default=1 WHERE id={modelid}' );
			$sql->setInt( 'modelid',$new_default_modelid );
			$db->query( $sql->query );
//		}
	}
}

?>