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
use util\Macro;


/**
 * Bindet eine Google-Maps-Karte ein.
 * 
 * @author Jan Dankert
 */
class GoogleMaps extends Macro
{
	/**
	 * Bitte immer alle Parameter in dieses Array schreiben, dies ist fuer den Web-Developer hilfreich.
	 * @type String
	 */
	var $parameters  = Array(
		'lat'  => 'Latitude',
		'long' => 'Longitude',
		'zoom' => 'Zoom'
	);

	/**
	 * Bitte immer eine Beschreibung benutzen, dies ist fuer den Web-Developer hilfreich.
	 * @type String
	 */
	var $description = 'Includes a Google Map.';
	
	var $long   = 10;    // Default: Hamburg
	var $lat    = 53.55; // Default: Hamburg
	var $zoom   = 10;
	var $width  = 425;
	var $height = 350;

	/**
	 */
	function execute()
	{
		$this->output('<iframe width="'.$this->width.'" height="'.$this->height.'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.de/?ie=UTF8&amp;ll='.$this->lat.','.$this->long.'&amp;z='.$this->zoom.'&amp;output=embed"></iframe>');
	}

}

?>