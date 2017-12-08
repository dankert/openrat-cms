<?php
namespace cms\model;
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
	function __construct( $modelid='' )
	{
		if   ( is_numeric($modelid) )
			$this->modelid = $modelid;
	}

	
	/**
	 * Stellt fest, ob die angegebene Id existiert.
	 */
	function available( $id )
	{
		$db = db_connection();

		$sql = $db->sql('SELECT 1 FROM {{projectmodel}} '.
		               ' WHERE id={id}');
		$sql->setInt('id' ,$id  );

		return intval($sql->getOne()) == 1;
	}
	

	

	/**
	 * Lesen aller Projektmodelle aus der Datenbank
	 */
	function getAll()
	{
		global $SESS;
		$db = db_connection();

		$sql = $db->sql( "SELECT id,name FROM {{projectmodel}} ".
		                "   WHERE projectid = {projectid} ".
		                "   ORDER BY name" );

		if	( !empty($this) && !empty($this->projectid) )
			$sql->setInt('projectid',$this->projectid );
		else
		{
			$project = \Session::getProject();
			$sql->setInt('projectid',$project->projectid);
		}

		return $sql->getAssoc();
	}

	
	
	/**
	 * Bestimmt die Anzahl aller Varianten fuer das aktuelle Projekt.
	 */
	function count()
	{
		global $SESS;
		$db = db_connection();

		$sql = $db->sql( <<<SQL
		SELECT count(*) FROM {{projectmodel}} 
		                   WHERE projectid = {projectid} 
SQL
);
		if	( isset($this) )
			$sql->setInt('projectid',$this->projectid );
		else	$sql->setInt('projectid',$SESS['projectid'] );

		return $sql->getOne();
	}
	

	/**
	 * Lesen aus der Datenbank
	 */
	function load()
	{
		$db = db_connection();

		$sql = $db->sql( 'SELECT * FROM {{projectmodel}}'.
		                ' WHERE id={modelid}' );
		$sql->setInt( 'modelid',$this->modelid );

		$row = $sql->getRow();

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
		$sql = $db->sql( 'UPDATE {{projectmodel}} '.
		                '  SET name      = {name} '.
		                '  WHERE id={modelid}' );
		$sql->setString( 'name'     ,$this->name    );

		$sql->setInt( 'modelid',$this->modelid );

		// Datenbankabfrage ausfuehren
		$sql->query();
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

		$sql = $db->sql('SELECT MAX(id) FROM {{projectmodel}}');
		$this->modelid = intval($sql->getOne())+1;

		// Modell hinzuf?gen
		$sql = $db->sql( 'INSERT INTO {{projectmodel}} '.
		                "(id,projectid,name,extension,is_default) VALUES( {modelid},{projectid},{name},'',0 )");

		$sql->setInt   ('modelid'  ,$this->modelid   );
		$sql->setInt   ('projectid',$this->projectid );
		$sql->setString('name'     ,$this->name      );

		// Datenbankbefehl ausfuehren
		$sql->query();
	}


	function getDefaultId()
	{
		global $SESS;
		$db = db_connection();

		$sql = $db->sql( 'SELECT id FROM {{projectmodel}} '.
		                '  WHERE projectid={projectid}'.
		                '   ORDER BY is_default DESC' );
		if	( isset($this->projectid) )
			$sql->setInt('projectid',$this->projectid );
		else
		{
			$project = \Session::getProject();
			$sql->setInt('projectid',$project->projectid);
		}
		
		return $sql->getOne();
	}



	// Diese Sprache als 'default' markieren.
	function setDefault()
	{
		global $SESS;
		$db = db_connection();

		// Zuerst alle auf nicht-Standard setzen
		$sql = $db->sql( 'UPDATE {{projectmodel}} '.
		                '  SET is_default = 0 '.
		                '  WHERE projectid={projectid}' );
		$sql->setInt('projectid',$this->projectid );
		$sql->query();
	
		// Jetzt die gew?nschte Sprachvariante auf Standard setzen
		$sql = $db->sql( 'UPDATE {{projectmodel}} '.
		                '  SET is_default = 1 '.
		                '  WHERE id={modelid}' );
		$sql->setInt('modelid',$this->modelid );
		$sql->query();
	}


	/**
	 * Entfernen des Projektmodells aus der Datenbank
	 * Es wird dabei nicht geprueft, ob noch ein anders Projektmodell
	 * vorhanden ist.
	 */
	function delete()
	{
		$db = db_connection();

		// Vorlagen zu dieseem Modell loeschen
		$sql = $db->sql( <<<SQL
	DELETE FROM {{templatemodel}}
	 WHERE projectmodelid = {modelid}
SQL
);
		$sql->setInt( 'modelid',$this->modelid );
		$sql->query();
		
		// Dieses Modell löschen
		$sql = $db->sql( <<<SQL
	DELETE FROM {{projectmodel}}
	 WHERE id={modelid}
SQL
);
		$sql->setInt( 'modelid',$this->modelid );
		$sql->query();

		// Anderes Modell auf "Default" setzen (sofern vorhanden)
		if	( $this->isDefault )
		{
			$sql = $db->sql( 'SELECT id FROM {{projectmodel}} WHERE projectid={projectid}' );
			$sql->setInt( 'projectid',$this->projectid );
			$new_default_modelid = $sql->getOne();
	
			$sql = $db->sql( 'UPDATE {{projectmodel}} SET is_default=1 WHERE id={modelid}' );
			$sql->setInt( 'modelid',$new_default_modelid );
			$sql->query();
		}
	}
}

?>