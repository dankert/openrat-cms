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
// Revision 1.4  2004-12-15 23:18:36  dankert
// Anpassung an Session-Funktionen
//
// Revision 1.3  2004/11/10 22:46:27  dankert
// *** empty log message ***
//
// Revision 1.2  2004/04/25 12:58:24  dankert
// Spalte "selflink" entfernt
//
// ---------------------------------------------------------------------------

/**
 * Diese Klasse stellt ein Projektmodell dar. Ein Projektmodell ist eine Darstellungsart
 * der Inhalte. Zu jedem Projektmodell gibt es einen anderen Templatequelltext.
 * Beispiel: Neben HTML gibt es ein Projektmodell fuer WML oder XML. Die Inhalte sind gleich,
 * aber die Art der Ausgabe ist jeweils anders.
 *
 * @package openrat.objects
 * @author $Author$
 * @version $Rev: $
 */
class Model
{
	var $modelid = 0;
	var $error      = '';
	var $projectid;

	var $name      = '';
	var $isDefault = false;


	/**
	 * Konstruktor
	 */
	function Model( $modelid='' )
	{
		if   ( is_numeric($modelid) )
			$this->modelid = $modelid;
	}


	/**
	 * Lesen aller Projektmodelle aus der Datenbank
	 */
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


	/**
	 * Lesen aus der Datenbank
	 */
	function load()
	{
		$db = db_connection();

		$sql = new Sql( 'SELECT * FROM {t_model}'.
		                ' WHERE id={modelid}' );
		$sql->setInt( 'modelid',$this->modelid );

		$row = $db->getRow( $sql->query );

		$this->name      = $row['name'     ];
		$this->projectid = $row['projectid'];
	
		if	( $row['is_default'] == '1' )
			$this->isDefault = true;
		else $this->isDefault = false;
	}


	/**
	 * Speichern des Projektmodells
	 */
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


	/**
	 * Alle notwendigen Eigenschaften dieses Projektmodells
	 * werden als Array zurueckgegeben
	 *
	 * @return Array
	 */
	function getProperties()
	{
		return Array( 'modelid'  =>$this->modelid,
		              'projectid'=>$this->projectid,
		              'isDefault'=>$this->isDefault,
		              'name'     =>$this->name );
	}


	/**
	 * Modell hinzufuegen
	 * @param String Name des Modells (optional)
	 */
	function add( $name = '' )
	{
		if	( $name != '' )
			$this->name = $name;
		
		$db = db_connection();

		$sql = new Sql('SELECT MAX(id) FROM {t_model}');
		$this->modelid = intval($db->getOne($sql->query))+1;

		// Modell hinzuf?gen
		$sql = new Sql( 'INSERT INTO {t_model} '.
		                "(id,projectid,name,extension,is_default) VALUES( {modelid},{projectid},{name},'',0 )");

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
		else
		{
			$project = Session::getProject();
			$sql->setInt('projectid',$project->projectid);
		}
		
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
	
		// Jetzt die gew?nschte Sprachvariante auf Standard setzen
		$sql = new Sql( 'UPDATE {t_model} '.
		                '  SET is_default = 1 '.
		                '  WHERE id={modelid}' );
		$sql->setInt('modelid',$this->modelid );
		$db->query( $sql->query );
	}


	/**
	 * Entfernen des Projektmodells aus der Datenbank
	 * Es wird dabei nicht geprueft, ob noch ein anders Projektmodell
	 * vorhanden ist.
	 */
	function delete()
	{
		$db = db_connection();

		// Modell l?schen
		$sql = new Sql( 'DELETE FROM {t_model} WHERE id={modelid}' );
		$sql->setInt( 'modelid',$this->modelid );
		$db->query( $sql->query );

		// Anderes Modell auf "Default" setzen (sofern vorhanden)
		$sql = new Sql( 'SELECT id FROM {t_model} WHERE projectid={projectid}' );
		$sql->setInt( 'projectid',$this->projectid );
		$new_default_modelid = $db->getOne( $sql->query );

		$sql = new Sql( 'UPDATE {t_model} SET is_default=1 WHERE id={modelid}' );
		$sql->setInt( 'modelid',$new_default_modelid );
		$db->query( $sql->query );
	}
}

?>