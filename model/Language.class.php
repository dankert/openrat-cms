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
 * Darstellen einer Sprache. Jeder Seiteninhalt wird einer Sprache zugeordnet.
 *
 * @version $Revision$
 * @author $Author$
 * @package openrat.objects
 */
class Language
{
	var $languageid = 0;
	var $error      = '';
	var $projectid;

	var $name      = '';
	var $isoCode   = '';
	var $isDefault = false;


	// Konstruktor
	function __construct( $languageid='' )
	{
		global $SESS;

		if   ( is_numeric($languageid) )
			$this->languageid = $languageid;

//		$this->projectid = $SESS['projectid'];
	}

	
	
	/**
	 * Stellt fest, ob die angegebene Id existiert.
	 */
	function available( $id )
	{
		$db = db_connection();

		$sql = $db->sql('SELECT 1 FROM {{language}} '.
		               ' WHERE id={id}');
		$sql->setInt('id' ,$id  );

		return intval($sql->getOne($sql)) == 1;
	}

	

	// Lesen aller Sprachen aus der Datenbank
	function getAll()
	{
		global $SESS;
		$db = db_connection();

		$sql = $db->sql( "SELECT id,name FROM {{language}} ".
		                "   WHERE projectid = {projectid} ".
		                "   ORDER BY name" );

		if	( !empty($this) && !empty($this->projectid) )
			$sql->setInt('projectid',$this->projectid );
		else
		{
			$project = \Session::getProject();
			$sql->setInt('projectid',$project->projectid);
		}

		return $sql->getAssoc( $sql );
	}


	/**
	 * Ermittelt die Anzahl aller Sprachen zum aktuellen Projekt.
	 */
	function count()
	{
		global $SESS;
		$db = db_connection();

		$sql = $db->sql( <<<SQL
			SELECT count(*) FROM {{language}} 
	         WHERE projectid = {projectid}
SQL
);

		if	( !empty($this) && !empty($this->projectid) )
			$sql->setInt('projectid',$this->projectid );
		else
		{
			$project = \Session::getProject();
			$sql->setInt('projectid',$project->projectid);
		}

		return $sql->getOne( $sql );
	}


	// Lesen aus der Datenbank
	function load()
	{
		$db = \Session::getDatabase();

		$sql = $db->sql( 'SELECT * FROM {{language}}'.
		                ' WHERE id={languageid}' );
		$sql->setInt( 'languageid',$this->languageid );

		$row = $sql->getRow( $sql );
		
		if	( count($row) > 0 )
		{
			$this->name      =         $row['name'     ];
			$this->isoCode   =         $row['isocode'  ];
			$this->projectid = intval( $row['projectid'] );
			
			$this->isDefault = ( $row['is_default'] == '1' );
		}
	}


	// Speichern der Sprache in der Datenbank
	function save()
	{
		$db = db_connection();

		// Gruppe speichern		
		$sql = $db->sql( 'UPDATE {{language}} '.
		                'SET name      = {name}, '.
		                '    isocode   = {isocode} '.
		                'WHERE id={languageid}' );
		$sql->setString( 'name'     ,$this->name    );
		$sql->setString( 'isocode'  ,$this->isoCode );

		$sql->setInt( 'languageid',$this->languageid );

		// Datenbankabfrage ausfuehren
		$sql->query( $sql );
	}


	/**
	 * Ermitteln aller Eigenschaften dieser Sprache
	 * @return Array
	 */
	function getProperties()
	{
		return Array( 'name'   =>$this->name,
		              'isocode'=>$this->isoCode );
	}


	/**
	 * Neue Sprache hinzuf?gen
	 */
	function add( $isocode='' )
	{
		global $SESS;
		global $iso;
		$db = db_connection();

		if	( $isocode != '' )
		{
			// Kleiner Trick, damit "no" (Norwegen) in der .ini-Datei stehen kann
			$isocode = str_replace('_','',$isocode);
			
			$this->isocode = $isocode;
			$codes = \GlobalFunctions::getIsoCodes();
			$this->name    = $codes[ $isocode ];
		}

		$sql = $db->sql('SELECT MAX(id) FROM {{language}}');
		$this->languageid = intval($sql->getOne($sql))+1;

		// Sprache hinzuf?gen
		$sql = $db->sql( 'INSERT INTO {{language}} '.
		                '(id,projectid,name,isocode,is_default) VALUES( {languageid},{projectid},{name},{isocode},0 )');
		$sql->setInt   ('languageid',$this->languageid );
		$sql->setInt   ('projectid' ,$this->projectid  );
		$sql->setString('name'      ,$this->name       );
		$sql->setString('isocode'   ,$this->isoCode    );

		// Datenbankbefehl ausfuehren
		$sql->query( $sql );
	}


	// Diese Sprache als 'default' markieren.
	function setDefault()
	{
		global $SESS;
		$db = db_connection();

		// Zuerst alle auf nicht-Standard setzen
		$sql = $db->sql( 'UPDATE {{language}} '.
		                '  SET is_default = 0 '.
		                '  WHERE projectid={projectid}' );
		$sql->setInt('projectid',$this->projectid );
		$sql->query( $sql );
	
		// Jetzt die gew?nschte Sprachvariante auf Standard setzen
		$sql = $db->sql( 'UPDATE {{language}} '.
		                '  SET is_default = 1 '.
		                '  WHERE id={languageid}' );
		$sql->setInt('languageid',$this->languageid );
		$sql->query( $sql );
	}


	function getDefaultId()
	{
		global $SESS;
		$db = db_connection();

		$sql = $db->sql( 'SELECT id FROM {{language}} '.
		                '  WHERE projectid={projectid}'.
		                '   ORDER BY is_default DESC' );

		if	( isset($this->projectid) )
			$sql->setInt('projectid',$this->projectid );
		else
		{
			$project = \Session::getProject();
			$sql->setInt('projectid',$project->projectid);
		}
		
		return $sql->getOne( $sql );
	}


	// Sprache entfernen
	function delete()
	{
		$db = db_connection();

		// Sprache l?schen
//		$sql = $db->sql( 'SELECT COUNT(*) FROM {{language}} WHERE projectid={projectid}' );
//		$sql->setInt( 'projectid',$this->projectid );
//		$count = $sql->getOne( $sql );
//		
//		// Nur l?schen, wenn es mindestens 2 Sprachen gibt
//		if   ( $count >= 2 )
//		{
			// Inhalte mit dieser Sprache l?schen
			$sql = $db->sql( 'DELETE FROM {{value}} WHERE languageid={languageid}' );
			$sql->setInt( 'languageid',$this->languageid );
			$sql->query( $sql );

			// Inhalte mit dieser Sprache l?schen
			$sql = $db->sql( 'DELETE FROM {{name}} WHERE languageid={languageid}' );
			$sql->setInt( 'languageid',$this->languageid );
			$sql->query( $sql );

			// Sprache l?schen
			$sql = $db->sql( 'DELETE FROM {{language}} WHERE id={languageid}' );
			$sql->setInt( 'languageid',$this->languageid );
			$sql->query( $sql );

			// Andere Sprache auf "Default" setzen
			$sql = $db->sql( 'SELECT id FROM {{language}} WHERE projectid={projectid}' );
			$sql->setInt( 'projectid',$this->projectid );
			$new_default_languageid = $sql->getOne( $sql );

			$sql = $db->sql( 'UPDATE {{language}} SET is_default=1 WHERE id={languageid}' );
			$sql->setInt( 'languageid',$new_default_languageid );
			$sql->query( $sql );
//		}
	}
}

?>