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
// Revision 1.18  2007-05-21 20:04:10  dankert
// Korrektur f?r Anzeige des Vorlagen-Quelltextes.
//
// Revision 1.17  2007-05-02 20:58:45  dankert
// Ausw?hlen von Einstellungen f?r Elemente "linkinfo" und "copy".
//
// Revision 1.16  2006/07/05 19:15:34  dankert
// Bugfix getRelatedProperties()
//
// Revision 1.15  2006/07/04 20:48:14  dankert
// Element "copy" hat nur Eigenschaft "defaultText"
//
// Revision 1.14  2006/06/16 19:45:05  dankert
// Neues Templateelement "Kopie" (intern: "copy")
//
// Revision 1.13  2006/01/29 17:26:28  dankert
// In Methode add() auch die Beschreibung speichern
//
// Revision 1.12  2005/11/07 22:34:01  dankert
// Neue Methode "getDefaultValue()"
//
// Revision 1.11  2005/04/21 19:08:44  dankert
// Vorbelegung fuer "list"-Element
//
// Revision 1.10  2005/01/04 19:58:22  dankert
// Bei Datum auch Default-Text als Eigenschaft
//
// Revision 1.9  2004/12/26 20:22:03  dankert
// Erweiterung bei setType()
//
// Revision 1.8  2004/12/26 01:06:31  dankert
// Perfomanceverbesserung Seite/Elemente
//
// Revision 1.7  2004/12/19 15:21:21  dankert
// Aenderung getDynamicParameters()
//
// Revision 1.6  2004/10/14 21:10:29  dankert
// Parameter/Listeninhalte aus $this->code separiert (als Array) zurueckgeben
//
// Revision 1.5  2004/10/06 10:38:21  dankert
// Elementtyp dynamic ist nie beschreibbar
//
// Revision 1.4  2004/10/06 09:54:19  dankert
// Neuer Elementtyp: dynamic
//
// Revision 1.3  2004/07/07 20:45:10  dankert
// Neuer Elementtyp: select
//
// Revision 1.2  2004/05/02 14:41:31  dankert
// Einf?gen package-name (@package)
//
// Revision 1.2  2004/04/30 20:36:25  dankert
// Neu: Freigabe
//
// Revision 1.1  2004/04/24 15:15:12  dankert
// Initiale Version
//
// ---------------------------------------------------------------------------

/**
 * Diese Objektklasse stellt ein Element das.
 * Ein Element ist ein Platzhalter in einem Template und kann verschiedenen
 * Typs sein, z.B. Text oder ein Bild.
 *
 * @package openrat.objects
 */
class Element
{
	/**
	 * Eindeutige ID dieses Elementes
	 * @type Integer
	 */
	var $elementid;

	/**
	 * Template-ID zu der dieses Elementes geh?rt
	 * @type Integer
	 */
	var $templateid;

	/**
	 * Typ des Elementes
	 * Folgende Typen sind moeglich:
	 * <ul>
	 * <li>text</li>
	 * <li>longtext</li>
	 * <li>select</li>
	 * <li>number</li>
	 * <li>link</li>
	 * <li>date</li>
	 * <li>list</li>
	 * <li>code</li>
	 * <li>info</li>
	 * <li>infodate</li>
	 * </ul>
	 *
	 * @type String
	 */
	var $type;

	/**
	 * Logischer Name dieses Elementes
	 * @type String
	 */
	var $name;

	/**
	 * Beschreibung zu diesem Element
	 * Zu jedem Element kann eine Beschreibung hinterlegt werden, die dem Redakteur bei der Bearbeitung
	 * der Inhalte als Bearbeitungshilfe dienen kann.
	 * @type String
	 */
	var $desc;

	/**
	 * Objekt-ID eines Ordners, aus diesem Ordner (samt Unterordner)
	 * k?nnen zu verlinkende Objekte ausgew?hlt werden 
	 * @type Integer
	 */
	var $folderobjectid = 0;
	
	/**
	 * Schalter ob dieses Element von Redakteuren bearbeiten werden kann
	 * @type Boolean
	 */
	var $writable;

	/**
	 * Schalter, ob dieses Element in allen Sprachen den gleichen Inhalt haben soll
	 * @type Boolean
	 */
	var $allLanguages;


	/**
	 * Im Konstruktor wird die Element-Id gesetzt
	 * @param Integer Element-Id
	 */
	function Element( $elementid=0 )
	{
		if	( intval($elementid)!=0 )
			$this->elementid = $elementid;
	}


	/**
	 * Hinzuf?gen eines Elementes
	 * Das aktuelle Element wird in die Datenbank geschrieben.
	 */
	function add()
	{
		$db = db_connection();

		$sql = new Sql('SELECT MAX(id) FROM {t_element}');
		$this->elementid = intval($db->getOne($sql->query))+1;

		$sql = new Sql( 'INSERT INTO {t_element}'.
		                ' (id,templateid,name,descr,type,writable) '.
		                " VALUES ( {elementid},{templateid},{name},{description},{type},{writable} ) " );

		$sql->setInt    ( 'elementid'  ,$this->elementid  );
		$sql->setString ( 'name'       ,$this->name       );
		$sql->setString ( 'type'       ,$this->type       );
		$sql->setInt    ( 'templateid' ,$this->templateid );
		$sql->setBoolean( 'writable'   ,$this->writable   );
		$sql->setString ( 'description',$this->desc       );

		$db->query( $sql->query );
	}



//	function path_to_page( $pageid )
//	{
//		return $this->page->path_to_object( $pageid );
//	}
//	function path_to_object( $pageid )
//	{
//		return $this->path_to_page( $pageid );
//	}


	/**
	 * Lesen des Elementes aus der Datenbank
	 * Alle Eigenschaften des Elementes werden aus der Datenbank gelesen
	 */
	function load()
	{
		$db = db_connection();

		if	( intval($this->elementid) != 0 )
		{		
			$sql = new Sql( 'SELECT * FROM {t_element}'.
			                ' WHERE id={elementid}'      );
			$sql->setInt( 'elementid',$this->elementid );
		}
		else
		{
			$sql = new Sql( 'SELECT * FROM {t_element}'.
			                ' WHERE name={name}'      );
			$sql->setString( 'name',$this->name );
		}

		$this->setDatabaseRow( $db->getRow( $sql->query ) );
	}


	function setDatabaseRow( $prop )
	{
		$this->elementid      = $prop['id'        ];
		$this->templateid     = $prop['templateid'];
		$this->name           = $prop['name'      ];
		$this->desc           = $prop['descr'     ];
		$this->type           = $prop['type'      ];
		$this->subtype        = $prop['subtype'   ];

		$this->dateformat     = $prop['dateformat'];
		$this->wiki           = ( $prop['wiki'         ] == '1' );
		$this->withIcon       = ( $prop['with_icon'    ] == '1' );
		$this->html           = ( $prop['html'         ] == '1' );
		$this->allLanguages   = ( $prop['all_languages'] == '1' );
		$this->writable       = ( $prop['writable'     ] == '1' );

		if	( !$this->writable)
			$this->withIcon = false;

		$this->decimals         = intval( $prop['decimals'        ] );
		$this->decPoint         = strval( $prop['dec_point'       ] );
		$this->thousandSep      = strval( $prop['thousand_sep'    ] );
		$this->code             = strval( $prop['code'            ] );
		$this->defaultText      = strval( $prop['default_text'    ] );
		$this->folderObjectId   = intval( $prop['folderobjectid'  ] );
		$this->defaultObjectId  = intval( $prop['default_objectid'] );
	}


	/**
	 * Abspeichern des Elementes
	 * Das aktuelle Element wird in der Datenbank gespeichert
	 */
	function save()
	{
		$db = db_connection();
		
		$sql = new Sql( 'UPDATE {t_element}'.
		                ' SET templateid      = {templateid},'.
		                '     name            = {name},'.
		                '     descr           = {desc},'.
		                '     type            = {type},'.
		                '     subtype         = {subtype},'.
		                '     with_icon       = {withIcon},'.
		                '     dateformat      = {dateformat},'.
		                '     wiki            = {wiki},'.
		                '     html            = {html},'.
		                '     all_languages   = {allLanguages},'.
		                '     writable        = {writable},'.
		                '     decimals        = {decimals},'.
		                '     dec_point       = {decPoint},'.
		                '     thousand_sep    = {thousandSep},'.
		                '     code            = {code},'.
		                '     default_text    = {defaultText},'.
		                '     folderobjectid  = {folderObjectId},'.
		                '     default_objectid= {defaultObjectId}'.
		                ' WHERE id={elementid}'      );

		$sql->setInt    ( 'elementid'       ,$this->elementid        );
		$sql->setInt    ( 'templateid'      ,$this->templateid       );
		$sql->setString ( 'name'            ,$this->name             );
		$sql->setString ( 'desc'            ,$this->desc             );
		$sql->setString ( 'type'            ,$this->type             );
		$sql->setString ( 'subtype'         ,$this->subtype          );
		$sql->setBoolean( 'withIcon'        ,$this->withIcon         );
		$sql->setString ( 'dateformat'      ,$this->dateformat       );
		$sql->setBoolean( 'wiki'            ,$this->wiki             );
		$sql->setBoolean( 'html'            ,$this->html             );
		$sql->setBoolean( 'writable'        ,$this->writable         );
		$sql->setBoolean( 'allLanguages'    ,$this->allLanguages     );
		$sql->setInt    ( 'decimals'        ,$this->decimals         );
		$sql->setString ( 'decPoint'        ,$this->decPoint         );
		$sql->setString ( 'thousandSep'     ,$this->thousandSep      );
		$sql->setString ( 'code'            ,$this->code             );
		$sql->setString ( 'defaultText'     ,$this->defaultText      );
		
		if	( intval($this->folderObjectId)==0 )
			$sql->setNull( 'folderObjectId' );
		else	$sql->setInt ( 'folderObjectId'  ,$this->folderObjectId   );

		if	( intval($this->defaultObjectId)==0 )
			$sql->setNull( 'defaultObjectId' );
		else	$sql->setInt ( 'defaultObjectId' ,$this->defaultObjectId  );
		
		$db->query( $sql->query );
	}



	/**
	 * Setzt den Typ des Elementes und schreibt diesen sofort in die Datenbank.
	 * 
	 * @param String Der neue Typ, siehe getAvailableTypes() f?r m?gliche Typen
	 * @see #type
	 */
	function setType( $type )
	{
		$this->type = $type;
		$db = db_connection();
		
		$sql = new Sql( 'UPDATE {t_element}'.
		                ' SET type            = {type}'.
		                ' WHERE id={elementid}'         );

		$sql->setInt    ( 'elementid',$this->elementid );
		$sql->setString ( 'type'     ,$this->type      );

		$db->query( $sql->query );
	}


	/**
	 * Setzt ein Prefix vor den Elementnamen.
	 * @param String Prefix
	 */
	function setPrefix( $prefix )
	{
		@list( $oldprefix,$name ) = explode('%',$this->name);
		
		if	( is_null($name) )
			$name = $oldprefix;
		
		$this->name = $prefix.'%'.$name;
	}


	/**
	 * Loeschen des Elementes und aller Inhalte
	 */
	function delete()
	{
		$db = db_connection();

		// Inhalte l?schen
		$this->deleteValues();

		// Element l?schen
		$sql = new Sql('DELETE FROM {t_element} '.
		               '  WHERE id={elementid}'   );
		$sql->setInt( 'elementid',$this->elementid );

		$db->query( $sql->query );
	}


	/**
	 * L?schen aller Seiteninhalte mit diesem Element
	 * Das Element wird nicht gel?scht.
	 */
	function deleteValues()
	{
		$db = db_connection();

		// Alle Inhalte mit diesem Element l?schen
		$sql = new Sql('DELETE FROM {t_value} '.
		               '  WHERE elementid={elementid}'   );
		$sql->setInt( 'elementid',$this->elementid );
		$db->query( $sql->query );
	}


	/**
	 * Abhaengig vom Element-Typ werden die zur Darstellung notwendigen Eigenschaften ermittelt.
	 * @return Array()
	 */
	function getRelatedProperties()
	{
		$prp = array('text'    =>array('withIcon','allLanguages','writable','htmlwiki','defaultText'),
		             'longtext'=>array('withIcon','allLanguages','writable','htmlwiki','defaultText'),
		             'select'  =>array('withIcon','allLanguages','writable','defaultText','code'),
		             'number'  =>array('withIcon','allLanguages','writable','decPoint','decimals','thousandSep'),
		             'link'    =>array('subtype','withIcon','allLanguages','writable','linktype','folderObjectId','defaultObjectId'),
		             'date'    =>array('withIcon','allLanguages','writable','dateformat','defaultText'),
		             'list'    =>array('subtype','withIcon','allLanguages','writable','folderObjectId','defaultObjectId'),
		             'copy'    =>array('prefix','name','defaultText'),
		             'linkinfo'=>array('prefix','subtype','defaultText'),
		             'code'    =>array('code'),
		             'dynamic' =>array('subtype','code'),
		             'info'    =>array('subtype'),
		             'infodate'=>array('subtype','dateformat') );
		return $prp[ $this->type ];
	}



	function getDefaultValue()
	{
		switch(  $this->type )
		{
			case 'text':
			case 'longtext':
				return $this->defaultText;
				
			case 'number';
				return '0';
		
			default:
		}
		
		return lang('EL_TYPE_'.$this->type);
		
	}

	/**
	 * Ermitteln aller benutzbaren Elementtypen
	 * @return Array
	 */
	function getAvailableTypes()
	{
		return array('text',
		             'longtext',
		             'select',
		             'number',
		             'link',
		             'date',
		             'list',
		             'copy',
		             'linkinfo',
		             'code',
		             'dynamic',
		             'info',
		             'infodate');
	}


	/**
	 * Ermittelt die Klasse des Element-Typs.<br>
	 * Entweder "info", "text" oder "dynamic".
	 * 
	 * @return String
	 */
	function getTypeClass()
	{
		switch( $this->type )
		{
			case 'text':
			case 'longtext':
			case 'select':
			case 'number':
			case 'link':
			case 'date':
			case 'list':
				return 'text';

			case 'code':
			case 'dynamic':
				return 'dynamic';

			case 'copy':
			case 'info':
			case 'infodate':
			case 'linkinfo':
				return 'info';
		}
	}


	function getSelectItems()
	{
		$parameters = explode( "\n",$this->code );
		$items      = array();
	
		foreach( $parameters as $it )
		{
			$paar        = explode( ":",$it,2 );
			$param_name  = trim($paar[0]);

			if	( count($paar) > 1 )
				$param_value = trim($paar[1]);
			else
				$param_value = trim($paar[0]);

			// Wenn Inhalt mit "'" beginnt und mit "'" aufhoert, dann diese Zeichen abschneiden
			if	( substr($param_value,0,1) == "'" && substr($param_value,strlen($param_value)-1,1) == "'" ) 
				$param_value = substr($param_value,1,strlen($param_value)-2); 
			
			$items[$param_name] = $param_value;
		}
		return $items;
	}
	

	function getDynamicParameters()
	{
		$parameters = explode( "\n",$this->code );
		$items      = array();
	
		foreach( $parameters as $it )
		{
			$paar = explode( ":",$it,2 );
			if	( count($paar) > 1 )
			{
				$param_name  = trim($paar[0]);
				$param_value = trim($paar[1]);

//				// Wenn Inhalt mit "'" beginnt und mit "'" aufhoert, dann diese Zeichen abschneiden
//				if	( substr($param_value,0,1) == "'" && substr($param_value,strlen($param_value)-1,1) == "'" ) 
//					$param_value = substr($param_value,1,strlen($param_value)-2); 

				if	( !empty($param_value) )				
					$items[$param_name] = $param_value;
			}
		}
		return $items;
	}
	

	/**
	 * Ermittelt, ob das Element beschreibbar ist.
	 * Bestimmte Typen (z.B. Info-Felder) sind nie beschreibbar, dann wird immer false zur?ckgegeben.
	 * Ansonsten wird ermittelt, ob dieses Element als beschreibbar markiert ist.
	 */
	function isWritable()
	{
		// Bei bestimmten Feldern immer false zurueckgeben
		if	( in_array($this->type,Array('copy','linkinfo','info','infodate','code','dynamic')) )
			return false;

		return $this->writable;
	}
}

?>