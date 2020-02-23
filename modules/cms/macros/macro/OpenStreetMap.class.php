<?php
namespace cms\macros\macro;
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
use util\Macro;


/**
 * Bindet die OpenStreetMap ein.
 * 
 * @author Jan Dankert
 */
class OpenStreetMap extends Macro
{
	/**
	 * Bitte immer alle Parameter in dieses Array schreiben, dies ist fuer den Web-Developer hilfreich.
	 * @type String
	 */
	var $parameters  = Array(
		'box'    => 'coordinates',
		'layer'  => 'mapnik',
		'width'  => 'Width of iframe',
		'height' => 'Height of iframe',
	);

	/**
	 * Bitte immer eine Beschreibung benutzen, dies ist fuer den Web-Developer hilfreich.
	 * @type String
	 */
	var $description = 'Includes the OpenStreetMap.';
	
	var $box    = '9.9396,53.4821,10.184,53.643'; // default: Hamburg
	var $layer  = 'mapnik';
	var $width  = 425;
	var $height = 350;

	/**
	 */
	function execute()
	{
		$this->output('<iframe width="'.$this->width.'" height="'.$this->height.'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://www.openstreetmap.org/export/embed.html?bbox='.$this->box.'&layer='.$this->layer.'" style="border: 1px solid black"></iframe>');
	}

}

?>