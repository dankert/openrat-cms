<?php
// ---------------------------------------------------------------------------
// $Id$
// ---------------------------------------------------------------------------
// OpenRat Content Management System
// Copyright (C) 2002 Jan Dankert, jandankert@jandankert.de
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
// Revision 1.4  2004-09-30 20:20:54  dankert
// Beim Speichern Sicherstellen, dass ein Name vorhanden ist
//
// Revision 1.3  2004/05/02 14:41:31  dankert
// Einf?gen package-name (@package)
//
// Revision 1.2  2004/04/25 17:31:46  dankert
// Bei L?schen auch Elemente entfernen
//
// Revision 1.1  2004/04/24 15:15:12  dankert
// Initiale Version
//
// ---------------------------------------------------------------------------


/**
 * Logische Darstellung eines Templates
 *
 * @author: $Author$
 * @version: $Revision$
 * @package openrat.objects
 */ 
class Template
{
	/**
	 * ID dieses Templates
	 * @type Integer
	 */
	var $templateid = 0;

	/**
	 * Projekt-ID des aktuell ausgew?hlten Projektes
	 * @type Integer
	 */
	var $projectid;

	/**
	 * Logischer Name
	 * @type String
	 */
	var $name;
	
	/**
	 * ID der Projektvariante
	 * @type Integer
	 */
	var $modelid;

	/**
	 * Dateierweiterung dieses Templates (abh?ngig von der Projektvariante)
	 * @type String
	 */
	var $extension;

	/**
	 * Inhalt des Templates (abh?ngig von der Projektvariante)
	 * @type String
	 */
	var $src;
	
	// Konstruktor
	function Template( $templateid='' )
	{
		global $SESS;
		$this->modelid   = $SESS['modelid'];
		$this->projectid = $SESS['projectid'];

		if   ( is_numeric($templateid) )
			$this->templateid = $templateid;
	}


	/**
 	 * Ermitteln aller Templates in dem aktuellen Projekt
 	 * @return Array
 	 */
	function getAll()
	{
		global $SESS;
		$db = db_connection();

		$sql = new Sql( 'SELECT id,name FROM {t_template}'.
		                ' WHERE projectid={projectid}'.
		                ' ORDER BY name ASC '  );
		if	( isset($this->projectid) )
			$sql->setInt( 'projectid',$this->projectid   );
		else	$sql->setInt( 'projectid',$SESS['projectid'] );

		return $db->getAssoc( $sql->query );
	}


	/**
 	 * Laden des Templates aus der Datenbank und f?llen der Objekteigenschaften
 	 */
	function load()
	{
		global $SESS;
		$db = db_connection();

		$sql = new Sql( 'SELECT * FROM {t_template}'.
		                ' WHERE id={templateid}' );
		$sql->setInt( 'templateid',$this->templateid );
		$row = $db->getRow( $sql->query );

		$this->name      = $row['name'     ];
		$this->projectid = $row['projectid'];

		$sql = new Sql( 'SELECT * FROM {t_templatemodel}'.
		                ' WHERE templateid={templateid}'.
		                '   AND projectmodelid={modelid}' );
		$sql->setInt( 'templateid',$this->templateid );
		$sql->setInt( 'modelid'   ,$this->modelid    );
		$row = $db->getRow( $sql->query );

		$this->extension = $row['extension'];
		$this->src       = $row['text'];
	}


	/**
 	 * Abspeichern des Templates in der Datenbank
 	 */
	function save()
	{
		if	( $this->name == "" )
			$this->name = lang('TEMPLATE').' #'.$this->templateid;

		$db = db_connection();

		$sql = new Sql( 'UPDATE {t_template}'.
		                '  SET name={name}'.
		                '  WHERE id={templateid}' );
		$sql->setString( 'name'      ,$this->name       );
		$sql->setInt   ( 'templateid',$this->templateid );
		$row = $db->getRow( $sql->query );

		$sql = new Sql( 'SELECT COUNT(*) FROM {t_templatemodel}'.
		                ' WHERE templateid={templateid}'.
		                '   AND projectmodelid={modelid}' );
		$sql->setInt   ( 'templateid'    ,$this->templateid     );
		$sql->setInt   ( 'modelid'       ,$this->modelid );

		if	( intval($db->getOne($sql->query)) > 0 )
		{		
			$sql = new Sql( 'UPDATE {t_templatemodel}'.
			                '  SET extension={extension},'.
			                '      text={src} '.
			                ' WHERE templateid={templateid}'.
			                '   AND projectmodelid={modelid}' );
		}
		else
		{
			$sql = new Sql('SELECT MAX(id) FROM {t_templatemodel}');
			$nextid = intval($db->getOne($sql->query))+1;
			$sql = new Sql( 'INSERT INTO {t_templatemodel}'.
			                '        (id,templateid,projectmodelid,extension,text) '.
			                ' VALUES ({id},{templateid},{modelid},{extension},{src}) ');
			$sql->setInt   ( 'id',$nextid         );
		}

		$sql->setString( 'extension'     ,$this->extension      );
		$sql->setString( 'src'           ,$this->src            );
		$sql->setInt   ( 'templateid'    ,$this->templateid     );
		$sql->setInt   ( 'modelid'       ,$this->modelid );
		
		$db->query( $sql->query );
	}


	/**
	  * Es werden Templates mit einem Inhalt gesucht
	  * @param String Suchbegriff
	  * @return Array Liste der gefundenen Template-IDs
	  */
	function getTemplateIdsByValue( $text )
	{
		$db = db_connection();

		$sql = new Sql( 'SELECT templateid FROM {t_templatemodel}'.
		                ' WHERE text LIKE {text} '.
		                '   AND projectmodelid={modelid}' );

		$sql->setInt   ( 'modelid',$this->modelid );
		$sql->setString( 'text'   ,'%'.$text.'%'  );
		
		return $db->getCol( $sql->query );
	}


	/**
 	 * Ermitteln aller Elemente zu diesem Template
 	 * Es wird eine Liste nur mit den Element-IDs ermittelt und zur?ckgegeben
 	 * @return Array
 	 */
	function getElementIds()
	{
		$db = db_connection();

		$sql = new Sql( 'SELECT id FROM {t_element}'.
		                '  WHERE templateid={templateid}'.
		                '  ORDER BY name ASC' );
		$sql->setInt( 'templateid',$this->templateid );

		return $db->getCol( $sql->query );
	}



	/**
 	 * Ermitteln aller Elemente zu diesem Template
 	 * Es wird eine Liste mit den Element-Namen zur?ckgegeben
 	 * @return Array
 	 */
	function getElementNames()
	{
		$db = db_connection();

		$sql = new Sql( 'SELECT id,name FROM {t_element}'.
		                '  WHERE templateid={templateid}'.
		                '  ORDER BY name ASC' );
		$sql->setInt( 'templateid',$this->templateid );

		return $db->getAssoc( $sql->query );
	}


	/**
 	 * Hinzuf?gen eines Elementes
 	 * @param String Name des Elementes
 	 */
	function addElement( $name )
	{
		$element = new Element();
		$element->name       = $name;
		$element->type       = 'text';
		$element->templateid = $this->templateid;
		$element->wiki       = true;
		$element->writable   = true;
		$element->add();
	}


	/**
 	 * Hinzuf?gen eines Templates
 	 * @param String Name des Templates
 	 */
	function add( $name )
	{
		global $SESS;
		$db = db_connection();

		$sql = new Sql('SELECT MAX(id) FROM {t_template}');
		$this->templateid = intval($db->getOne($sql->query))+1;

		$sql = new Sql( 'INSERT INTO {t_template}'.
		                ' (id,name,projectid)'.
		                ' VALUES({templateid},{name},{projectid})' );
		$sql->setInt   ('templateid',$this->templateid );
		$sql->setString('name'      ,$name             );
		$sql->setInt   ('projectid' ,$SESS['projectid']);
		$db->query( $sql->query );
	}


	/**
 	 * Ermitteln alles Objekte (=Seiten), welche auf diesem Template basieren
 	 * @return Array Liste von Objekt-IDs
 	 */
	function getDependentObjectIds()
	{
		$db = db_connection();

		$sql = new Sql( 'SELECT objectid FROM {t_page}'.
		                '  WHERE templateid={templateid}' );
		$sql->setInt( 'templateid',$this->templateid );

		return $db->getCol( $sql->query );
	}


	/**
 	 * Loeschen des Templates
 	 *
 	 * Entfernen alle Templateinhalte und des Templates selber
 	 */
	function delete()
	{
		$db = db_connection();
		
		foreach( $this->getElementIds() as $elementid )
		{
			$element = new Element( $elementid );
			$element->delete();
		}

		$sql = new Sql( 'DELETE FROM {t_templatemodel}'.
		                ' WHERE templateid={templateid}' );
		$sql->setInt( 'templateid',$this->templateid );
		$db->query( $sql->query );

		$sql = new Sql( 'DELETE FROM {t_template}'.
		                ' WHERE id={templateid}' );
		$sql->setInt( 'templateid',$this->templateid );
		$db->query( $sql->query );
	}
}

?>