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
// Revision 1.2  2004-12-28 22:57:56  dankert
// Korrektur Vererbung, "api" ausgebaut
//
// Revision 1.1  2004/10/14 21:15:29  dankert
// Erzeugen und Anzeigen einer Sitemap
//
// ---------------------------------------------------------------------------



/**
 * Erstellen eines Menues
 * @author Jan Dankert
 */
class Sitemap extends Dynamic
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
	var $beforeEntry = '<li><strong>';
	var $afterEntry  = '</strong></li>';
	
	var $api;

	/**
	 * Erstellen einer Sitemap
	 */
	function execute()
	{
		// Erstellen eines Untermenues
		
		// Ermitteln der aktuellen Seite
		$thispage = new Page( $this->getObjectId() );
		$thispage->load(); // Seite laden
		
		// uebergeordneter Ordner dieser Seite
		$this->showFolder( $this->getRootObjectId() );
	}

	function showFolder( $oid )
	{
		// uebergeordneter Ordner dieser Seite
		$f = new Folder( $oid );
		
		// Schleife ueber alle Objekte im aktuellen Ordner
		foreach( $f->getObjectIds() as $id )
		{
			$o = new Object( $id );
			$o->languageid = $this->page->languageid;
			$o->load();
	
			// Ordner
			if ($o->isFolder )
			{
				$this->output( '<li><strong>'.$o->name.'</strong><br/>' );
				$this->output( '<ul>' );
				$this->showFolder( $id ); // Rekursiver Aufruf dieser Methode
				$this->output( '</ul></li>' );
			}

			// Seiten und Verkn?fpungen
			if ($o->isPage || $o->isLink )
			{
				// Wenn aktuelle Seite, dann markieren, sonst Link
				if ( $this->getObjectId() == $id )
				{
					// aktuelle Seite
					$this->output( '<li><strong>'.$o->name.'</strong></li>' );
				}
				else
				{
					// Link erzeugen
					$this->output( '<li><a href="'.$this->pathToObject($id).'">'.$o->name.'</a></li>' );
				}
			}
		}
	}
}

?>