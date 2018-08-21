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
	var $projectid = 0;

	/**
	 * Logischer Name
	 * @type String
	 */
	var $name = 'unnamed';
	
	/**
	 * ID der Projektvariante
	 * @type Integer
	 */
	var $modelid = 0;

	/**
	 * Dateierweiterung dieses Templates (abh?ngig von der Projektvariante)
	 * @type String
	 */
	var $extension='';

	/**
	 * Inhalt des Templates (abh?ngig von der Projektvariante)
	 * @type String
	 */
	var $src='';
	
	// Konstruktor
	function __construct( $templateid='' )
	{
		if   ( is_numeric($templateid) )
			$this->templateid = $templateid;
	}


	/**
 	 * Laden des Templates aus der Datenbank und f?llen der Objekteigenschaften
 	 */
	function load()
	{
		$db = db_connection();

		$stmt = $db->sql( 'SELECT * FROM {{template}}'.
		                ' WHERE id={templateid}' );
		$stmt->setInt( 'templateid',$this->templateid );
		$row = $stmt->getRow();
		
		if	( empty($row) )
			throw new \ObjectNotFoundException("Template not found: ".$this->templateid);

		$this->name      = $row['name'     ];
		$this->projectid = $row['projectid'];

		$stmt = $db->sql( 'SELECT * FROM {{templatemodel}}'.
		                ' WHERE templateid={templateid}'.
		                '   AND projectmodelid={modelid}' );
		$stmt->setInt( 'templateid',$this->templateid );
		$stmt->setInt( 'modelid'   ,$this->modelid    );
		$row = $stmt->getRow();

		if	( isset($row['extension']) )
		{
			$this->extension = $row['extension'];
			$this->src       = $row['text'];
		}
		else
		{
			$this->extension = null;
			$this->src       = null;
		}
		
	}


	/**
 	 * Abspeichern des Templates in der Datenbank
 	 */
	function save()
	{
		if	( $this->name == "" )
			$this->name = lang('GLOBAL_TEMPLATE').' #'.$this->templateid;

		$db = db_connection();

		$stmt = $db->sql( 'UPDATE {{template}}'.
		                '  SET name={name}'.
		                '  WHERE id={templateid}' );
		$stmt->setString( 'name'      ,$this->name       );
		$stmt->setInt   ( 'templateid',$this->templateid );
		$stmt->query();

		$stmt = $db->sql( 'SELECT COUNT(*) FROM {{templatemodel}}'.
		                ' WHERE templateid={templateid}'.
		                '   AND projectmodelid={modelid}' );
		$stmt->setInt   ( 'templateid'    ,$this->templateid     );
		$stmt->setInt   ( 'modelid'       ,$this->modelid );

		if	( intval($stmt->getOne()) > 0 )
		{
			// Vorlagen-Quelltext existiert für diese Varianten schon.
			$stmt = $db->sql( 'UPDATE {{templatemodel}}'.
			                '  SET extension={extension},'.
			                '      text={src} '.
			                ' WHERE templateid={templateid}'.
			                '   AND projectmodelid={modelid}' );
		}
		else
		{
			// Vorlagen-Quelltext wird für diese Varianten neu angelegt.
			$stmt = $db->sql('SELECT MAX(id) FROM {{templatemodel}}');
			$nextid = intval($stmt->getOne())+1;

			$stmt = $db->sql( 'INSERT INTO {{templatemodel}}'.
			                '        (id,templateid,projectmodelid,extension,text) '.
			                ' VALUES ({id},{templateid},{modelid},{extension},{src}) ');
			$stmt->setInt   ( 'id',$nextid         );
		}

		$stmt->setString( 'extension'     ,$this->extension      );
		$stmt->setString( 'src'           ,$this->src            );
		$stmt->setInt   ( 'templateid'    ,$this->templateid     );
		$stmt->setInt   ( 'modelid'       ,$this->modelid        );
		
		$stmt->query();
	}


	/**
	  * Es werden Templates mit einem Inhalt gesucht
	  * @param String Suchbegriff
	  * @return Array Liste der gefundenen Template-IDs
	  */
	function getTemplateIdsByValue( $text )
	{
		$db = db_connection();

		$stmt = $db->sql( 'SELECT templateid FROM {{templatemodel}}'.
		                ' WHERE text LIKE {text} '.
		                '   AND projectmodelid={modelid}' );

		$stmt->setInt   ( 'modelid',$this->modelid );
		$stmt->setString( 'text'   ,'%'.$text.'%'  );
		
		return $stmt->getCol();
	}


	/**
 	 * Ermitteln aller Elemente zu diesem Template
 	 * Es wird eine Liste nur mit den Element-IDs ermittelt und zur?ckgegeben
 	 * @return Array
 	 */
	function getElementIds()
	{
		$db = db_connection();

		$stmt = $db->sql( 'SELECT id FROM {{element}}'.
		                '  WHERE templateid={templateid}'.
		                '  ORDER BY name ASC' );
		$stmt->setInt( 'templateid',$this->templateid );
		return $stmt->getCol();
	}



	/**
 	 * Ermitteln aller Elemente zu diesem Template
 	 * Es wird eine Liste mit den kompletten Elementen ermittelt und zurueckgegeben
 	 * @return Array
 	 */
	function getElements()
	{
		$list = array();
		$db = db_connection();

		$sql = $db->sql( 'SELECT * FROM {{element}}'.
		                '  WHERE templateid={templateid}'.
		                '  ORDER BY name ASC' );
		$sql->setInt( 'templateid',$this->templateid );
		foreach($sql->getAll() as $row )
		{
			$e = new Element( $row['id'] );
			$e->setDatabaseRow( $row );
			
			$list[$e->elementid] = $e;
			unset($e);
		}
		return $list;
	}



	/**
 	 * Ermitteln aller Elemente zu diesem Template
 	 * Es wird eine Liste mit den kompletten Elementen ermittelt und zurueckgegeben
 	 * @return Array
 	 */
	function getWritableElements()
	{
		$list = array();
		$e = new Element();
		$readonlyList = implode(',',Element::$readonlyElementTypeIds);
		
		$db = db_connection();

		$sql = $db->sql( <<<SQL
SELECT * FROM {{element}}
  WHERE templateid={templateid}
    AND typeid NOT IN ($readonlyList)
  ORDER BY name ASC
SQL
);
		$sql->setInt       ( 'templateid'  ,$this->templateid        );
		foreach($sql->getAll() as $row )
		{
			$e = new Element( $row['id'] );
			$e->setDatabaseRow( $row );

			if (!$e->writable)
			    continue;
			
			$list[$e->elementid] = $e;
			unset($e);
		}
		return $list;
	}



	/**
 	 * Ermitteln aller Elemente zu diesem Template
 	 * Es wird eine Liste mit den Element-Namen zur?ckgegeben
 	 * @return Array
 	 */
	function getElementNames()
	{
		$db = db_connection();

		$sql = $db->sql( 'SELECT id,name FROM {{element}}'.
		                '  WHERE templateid={templateid}'.
		                '  ORDER BY name ASC' );
		$sql->setInt( 'templateid',$this->templateid );

		return $sql->getAssoc();
	}


	/**
 	 * Hinzuf?gen eines Elementes
 	 * @param String Name des Elementes
 	 */
	public function addElement($name, $description='', $typeid=ELEMENT_TYPE_TEXT )
	{
		$element = new Element();
		$element->name       = $name;
		$element->desc       = $description;
		$element->typeid     = $typeid;
		$element->templateid = $this->templateid;
		$element->format     = ELEMENT_FORMAT_TEXT;
		$element->writable   = true;
		$element->add();

		return $element;
	}


	/**
 	 * Hinzufuegen eines Templates
 	 * @param String Name des Templates (optional)
 	 */
	function add( $name='' )
	{
		if	( !empty($name) )
			$this->name = $name;

		$db = db_connection();

		$sql = $db->sql('SELECT MAX(id) FROM {{template}}');
		$this->templateid = intval($sql->getOne())+1;

		$sql = $db->sql( 'INSERT INTO {{template}}'.
		                ' (id,name,projectid)'.
		                ' VALUES({templateid},{name},{projectid})' );
		$sql->setInt   ('templateid',$this->templateid   );
		$sql->setString('name'      ,$name               );

		$sql->setInt   ('projectid' ,$this->projectid );

		$sql->query();
	}


	/**
 	 * Ermitteln alles Objekte (=Seiten), welche auf diesem Template basieren.
 	 * 
 	 * @return Array Liste von Objekt-IDs
 	 */
	function getDependentObjectIds()
	{
		$db = db_connection();

		$sql = $db->sql( 'SELECT objectid FROM {{page}}'.
		                '  WHERE templateid={templateid}' );
		$sql->setInt( 'templateid',$this->templateid );

		return $sql->getCol();
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

		$stmt = $db->sql( 'DELETE FROM {{templatemodel}}'.
		                ' WHERE templateid={templateid}' );
		$stmt->setInt( 'templateid',$this->templateid );
		$stmt->query();

		$stmt = $db->sql( 'DELETE FROM {{template}}'.
		                ' WHERE id={templateid}' );
		$stmt->setInt( 'templateid',$this->templateid );
		$stmt->query();
	}
	
	
	/**
	 * Ermittelt den Mime-Type zu diesem Template.
	 * 
	 * Es wird die Extension des Templates betrachtet und dann mit Hilfe der
	 * Konfigurationsdatei 'mime-types.ini' der Mime-Type bestimmt. 
	 *
	 * @return String Mime-Type  
	 */
	function mimeType()
	{
		global $conf;
		$mime_types = $conf['mime-types'];

		// Nur den letzten Teil der Extension auswerten:
		// Aus 'mobile.html' wird nur 'html' verwendet.
		$parts = explode('.',$this->extension);
		$extension = strtolower(array_pop($parts));

		if	( !empty($mime_types[$extension]) )
			$this->mime_type = $mime_types[$extension];
		else
			// Wenn kein Mime-Type gefunden, dann Standardwert setzen
			$this->mime_type = 'application/octet-stream';
			
		return( $this->mime_type );
	}
	
}

?>