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
// Revision 1.3  2007-11-30 23:25:25  dankert
// Das Men? in der Sprache der zu ver?ffentlichenden Seite erzeugen.
//
// Revision 1.2  2005/01/04 19:59:55  dankert
// Allgemeine Korrekturen, Erben von "Dynamic"-klasse
//
// Revision 1.1  2004/11/10 22:43:35  dankert
// Beispiele fuer dynamische Templateelemente
//
// ---------------------------------------------------------------------------



/**
 * Erstellen einer sog. Brotkruemel-Navigation
 * @author Jan Dankert
 */
class BreadCrumb extends Dynamic
{
	/**
	 * Bitte immer alle Parameter in dieses Array schreiben, dies ist fuer den Web-Developer hilfreich.
	 * @type String
	 */
	var $parameters  = Array(
		'beforeEntry'=>'Chars before an active menu entry'
		);

	/**
	 * Bitte immer eine Beschreibung benutzen, dies ist fuer den Web-Developer hilfreich.
	 * @type String
	 */
	var $description = 'Creates a main menu.';


	/**
	 * Zeichenkette, die vor einem aktiven Menuepunkt gezeigt wird 
	 */
	var $beforeEntry = '&raquo;';
	
	var $api;

	/**
	 * Erstellen einer BreadCrumb-Navigation.
	 */
	function execute()
	{
		// Erstellen eines Untermenues
		
		// Ermitteln der aktuellen Seite
		$f = new Folder($this->page->parentid);
		$parentIds = $f->parentObjectFileNames(false,true);
		$lastoid = 0;

		foreach( $parentIds as $oid=>$filename )
		{
			$of = new Folder($oid);
			$of->languageid = $this->page->languageid;
			$of->load();
			$pl = $of->getFirstPageOrLink();
			
			$this->output( $this->beforeEntry );

			if	( is_object($pl) && $pl->objectid != $this->page->objectid )
				$this->output('<a href="'.$this->pathToObject($pl->objectid).'" class="breadcrumb">'.$of->name.'</a>' );
			else
				$this->output('<span class="breadcrumb">'.$of->name.'</span>' );

			if	( is_object($pl) )
				$lastoid = $pl->objectid;
		}

		if	( $lastoid != $this->page->objectid )
		{
			$this->output( $this->beforeEntry );
			$this->output('<span class="breadcrumb">'.$this->page->name.'</span>' );
		}
			
	}
}

?>