<?php
// ---------------------------------------------------------------------------
// $Id$
// ---------------------------------------------------------------------------
// DaCMS Content Management System
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
// Revision 1.1  2004-04-24 15:15:12  dankert
// Initiale Version
//
// Revision 1.1  2004/03/13 23:09:48  dankert
// *** empty log message ***
//
// ---------------------------------------------------------------------------


class Element
{
	/**
	 * ID dieses Elementes
	 * @type Integer
	 */
	var $elementid;

	/**
	 * Template-ID zu der dieses Elementes gehört
	 * @type Integer
	 */
	var $templateid;

	/**
	 * Sprachen-ID dieses Elementes
	 * @type Integer
	 */
	var $languageid;

	/**
	 * Typ des Elementes
	 * @type String
	 */
	var $type;

	/**
	 * Name dieses Elementes
	 * @type String
	 */
	var $name;

	/**
	 * Beschreibung zu diesem Element
	 * @type String
	 */
	var $desc;

	/**
	 * ID dieses Elementes
	 * @type String
	 */
	var $value;

	/**
	 * Objekt-ID eines Ordners, aus diesem Ordner (samt Unterordner)
	 * können zu verlinkende Objekte ausgewählt werden 
	 * @type Integer
	 */
	var $folderobjectid = 0;
	
	/**
	 * Schalter ob dieses Element von Redakteuren bearbeiten werden kann
	 * @type Boolean
	 */
	var $writable;

	/**
	 * Schalter ob dieses Element in allen Sprachen den gleichen Inhalt hat
	 * @type Boolean
	 */
	var $allLanguages;

	function Element( $elementid=0 )
	{
		global $SESS;

		if	( intval($elementid)!=0 )
			$this->elementid = $elementid;
	}


	function add()
	{
		$db = db_connection();

		$sql = new Sql('SELECT MAX(id) FROM {t_element}');
		$this->elementid = intval($db->getOne($sql->query))+1;

		$sql = new Sql( 'INSERT INTO {t_element}'.
		                ' (id,templateid,name,descr,type,writable) '.
		                " VALUES ( {elementid},{templateid},{name},'',{type},{writable} ) " );

		$sql->setInt    ( 'elementid' ,$this->elementid  );
		$sql->setString ( 'name'      ,$this->name       );
		$sql->setString ( 'type'      ,$this->type       );
		$sql->setInt    ( 'templateid',$this->templateid );
		$sql->setBoolean( 'writable'  ,$this->writable   );

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



	function load()
	{
		$db = db_connection();
		
		$sql = new Sql( 'SELECT * FROM {t_element}'.
		                ' WHERE id={elementid}'      );
		$sql->setInt( 'elementid',$this->elementid );
		$prop = $db->getRow( $sql->query );
		
		$this->templateid     = $prop['templateid'];
		$this->name           = $prop['name'];
		$this->desc           = $prop['descr'];
		$this->type           = $prop['type'];
		$this->subtype        = $prop['subtype'];

		$this->dateformat     = $prop['dateformat'];
		$this->wiki           = ( $prop['wiki'         ] == '1' );
		$this->withIcon       = ( $prop['with_icon'    ] == '1' );
		$this->html           = ( $prop['html'         ] == '1' );
		$this->allLanguages   = ( $prop['all_languages'] == '1' );
		$this->writable       = ( $prop['writable'     ] == '1' );

		if	( !$this->writable)
			$this->withIcon = false;
  
		$this->decimals         = $prop['decimals'];
		$this->decPoint         = $prop['dec_point'];
		$this->thousandSep      = $prop['thousand_sep'];
		$this->code             = $prop['code'];
		$this->defaultText      = $prop['default_text'];
		$this->folderObjectId   = intval($prop['folderobjectid' ]);
		$this->defaultObjectId  = intval($prop['default_objectid']);
	}



	// Element speichern
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



	// Element speichern
	function setType( $type )
	{
		$db = db_connection();
		
		$sql = new Sql( 'UPDATE {t_element}'.
		                ' SET type            = {type}'.
		                ' WHERE id={elementid}'         );

		$sql->setInt    ( 'elementid',$this->elementid );
		$sql->setString ( 'type'     ,$type            );

		$db->query( $sql->query );
	}


	/**
	 * Löschen des Elementes und aller Inhalte
	 */
	function delete()
	{
		$db = db_connection();

		// Inhalte löschen
		$this->deleteValues();

		// Element löschen
		$sql = new Sql('DELETE FROM {t_element} '.
		               '  WHERE id={elementid}'   );
		$sql->setInt( 'elementid',$this->elementid );

		$db->query( $sql->query );
	}


	/**
	 * Löschen aller Seiteninhalte mit diesem Element
	 */
	function deleteValues()
	{
		$db = db_connection();

		// Alle Inhalte mit diesem Element löschen
		$sql = new Sql('DELETE FROM {t_value} '.
		               '  WHERE elementid={elementid}'   );
		$sql->setInt( 'elementid',$this->elementid );
		$db->query( $sql->query );
	}


	/**
	 * Abhängig vom Element-Typ werden die zur Darstellung notwendigen Eigenschaften ermittelt
	 * @return Array()
	 */
	function getRelatedProperties()
	{
		$typeprop = Array('text'    =>Array('withIcon','allLanguages','writable','html','wiki','defaultText'),
		                  'longtext'=>Array('withIcon','allLanguages','writable','html','wiki','defaultText'),
		                  'number'  =>Array('withIcon','allLanguages','writable','decPoint','decimals','thousandSep','defaultText'),
		                  'link'    =>Array('withIcon','allLanguages','writable','folderObjectId','defaultObjectId'),
		                  'date'    =>Array('withIcon','allLanguages','writable','dateformat'),
		                  'list'    =>Array('withIcon','allLanguages','writable','folderObjectId'),
		                  'code'    =>Array('code'),
		                  'info'    =>Array('subtype'),
		                  'infodate'=>Array('subtype','dateformat') );
		                  
		return $typeprop[ $this->type ];
	}


	/**
	 * Ermitteln aller benutzbaren Elementtypen
	 * @return Array
	 */
	function getAvailableTypes()
	{
		return array('text',
		             'longtext',
		             'number',
		             'link',
		             'date',
		             'list',
		             'code',
		             'info',
		             'infodate');
	}


	function isWritable()
	{
		if	( in_array($this->type,Array('info','infodate','code')) )
			return false;

		return $this->writable;
	}
}