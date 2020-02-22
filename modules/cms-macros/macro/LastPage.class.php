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
// Revision 1.2  2005-01-04 19:59:55  dankert
// Allgemeine Korrekturen, Erben von "Dynamic"-klasse
//
// Revision 1.1  2004/11/10 22:43:35  dankert
// Beispiele fuer dynamische Templateelemente
//
// ---------------------------------------------------------------------------
use cms\model\Folder;
use util\Macro;


/**
 * Erstellen eines Links zur Seite davor
 * @author Jan Dankert
 */
class LastPage extends Macro
{
	/**
	 * Bitte immer alle Parameter in dieses Array schreiben, dies ist fuer den Web-Developer hilfreich.
	 * @type String
	 */
	var $parameters  = Array(
		'arrowChar'=>'String between menu entries, default: "&middot;"'
		);


	var $arrowChar = ' &middot; ';

	/**
	 * Bitte immer eine Beschreibung benutzen, dies ist fuer den Web-Developer hilfreich.
	 * @type String
	 */
	var $description = 'Creates a main menu.';
	var $version     = '$Id$';


	function execute()
	{
		$folder = new Folder( $this->page->parentid );

		$lastObject = null;
 
		// Schleife ueber alle Inhalte des Ordners
		foreach( $folder->getObjects() as $o )
		{
			if ( $o->isPage || $o->isLink )
			{
				if	( is_object($lastObject) && $o->objectid == $this->page->objectid )
				{
					$this->output( '<a href="'.$this->pathToObject($lastObject->objectid).' class="next">'.$lastObject->name.'</a>' );
					break;
				}

				$lastObject = $o->objectid; 
			}
		}
	}
}