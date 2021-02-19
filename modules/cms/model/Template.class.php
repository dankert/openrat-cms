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
use cms\base\DB;
use language\Messages;
use util\exception\ObjectNotFoundException;


/**
 * Logische Darstellung eines Templates
 *
 * @author: $Author$
 * @version: $Revision$
 * @package openrat.objects
 */ 
class Template extends ModelBase
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
		$stmt = Db::sql( 'SELECT * FROM {{template}}'.
		                ' WHERE id={templateid}' );
		$stmt->setInt( 'templateid',$this->templateid );
		$row = $stmt->getRow();
		
		if	( empty($row) )
			throw new ObjectNotFoundException("Template not found: ".$this->templateid);

		$this->name      = $row['name'     ];
		$this->projectid = $row['projectid'];
	}


	public function loadTemplateModelFor( $modelid ) {

		$templateModel = new TemplateModel( $this->templateid, $modelid );
		$templateModel->load();

		return $templateModel;
	}

	/**
 	 * Abspeichern des Templates in der Datenbank
 	 */
	function save()
	{
		if	( $this->name == "" )
			$this->name = \cms\base\Language::lang(Messages::TEMPLATE).' #'.$this->templateid;

		$stmt = Db::sql( 'UPDATE {{template}}'.
		                '  SET name={name}'.
		                '  WHERE id={templateid}' );
		$stmt->setString( 'name'      ,$this->name       );
		$stmt->setInt   ( 'templateid',$this->templateid );
		$stmt->query();
	}


	/**
	  * Es werden Templates mit einem Inhalt gesucht
	  * @param String Suchbegriff
	  * @return array Liste der gefundenen Template-IDs
	  */
	public static function getTemplateIdsByValue( $text )
	{
		$db = \cms\base\DB::get();

		$stmt = $db->sql( 'SELECT templateid FROM {{templatemodel}}'.
		                ' WHERE text LIKE {text} ' );

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
		$db = \cms\base\DB::get();

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
		$db = \cms\base\DB::get();

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
		
		$db = \cms\base\DB::get();

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
 	 * @return array
 	 */
	public function getElementNames()
	{
		$db = \cms\base\DB::get();

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
	public function addElement($name, $description='', $typeid=Element::ELEMENT_TYPE_TEXT )
	{
		$element = new Element();
		$element->name       = $name;
		$element->label      = $name;
		$element->desc       = $description;
		$element->typeid     = $typeid;
		$element->templateid = $this->templateid;
		$element->format     = Element::ELEMENT_FORMAT_TEXT;
		$element->writable   = true;
		$element->persist();

		return $element;
	}


	/**
 	 * Hinzufuegen eines Templates
 	 * @param String Name des Templates (optional)
 	 */
	function add()
	{
		$db = \cms\base\DB::get();

		$sql = $db->sql('SELECT MAX(id) FROM {{template}}');
		$this->templateid = intval($sql->getOne())+1;

		$sql = $db->sql( 'INSERT INTO {{template}}'.
		                ' (id,name,projectid)'.
		                ' VALUES({templateid},{name},{projectid})' );
		$sql->setInt   ('templateid',$this->templateid   );
		$sql->setString('name'      ,$this->name         );

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
		$db = \cms\base\DB::get();

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
		$db = \cms\base\DB::get();
		
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

		$this->templateid = 0;
	}
	
	
    public function getName()
    {
        return $this->name;
    }

	public function getId()
	{
		return $this->templateid;
	}


}