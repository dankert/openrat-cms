<?php

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
 * Darstellen eines Elementes in einer Baumstruktur
 * @author $Author$
 * @version $Revision$
 * @package openrat.services
 */
class TreeElement
{
	/**
	 * @type Integer
	 */
	var $id;
	
	var $extraId = array();
	
	var $internalId = 0;

	/**
	 * Text des Baumelementes
	 * @type String
	 */
	var $text = "";
	
	/**
	 * Beschreibung
	 * @type String
	 */
	var $description = "";
	var $url         = "";
	var $icon        = "";
	var $target      = "";
	var $action      = "";
	
	/**
	 * Unterelemente
	 * Ein Array von Ids
	 * @type Array
	 */
	var $subElementIds = array();
	
	/**
	 * Typ des Elementes
	 * In der Tree-Klasse muss es eine Methode mit diesem Namen geben, die das
	 * Element laedt.
	 * @type String
	 */
	var $type = "";
	
	
	// Konstruktor
	function TreeElement()
	{
	}
}

?>