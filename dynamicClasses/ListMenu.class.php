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
// Revision 1.1  2005-01-28 23:06:10  dankert
// Neues Menue in Listenform (HTML-Listen), aehnlich "BlockMenu"
//
// Revision 1.2  2004/12/25 21:05:14  dankert
// erbt von Klasse Dynamic
//
// Revision 1.1  2004/10/14 21:16:12  dankert
// Erzeugen eines Menues in Bloecken
//
// ---------------------------------------------------------------------------



/**
 * Erstellen eines Hauptmenues
 * @author Jan Dankert
 */
class ListMenu extends Dynamic
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
	var $api;

	// Erstellen des Hauptmenues
	function execute()
	{
		// Erstellen des Hauptmenues

		// Lesen des Root-Ordners
		$folder = new Folder( $this->getRootObjectId() );
		
		// Schleife ueber alle Inhalte des Root-Ordners
		foreach( $folder->getObjectIds() as $id )
		{
			$o = new Object( $id );
			$o->languageid = $this->page->languageid;
			$o->load();
			if ( $o->isFolder ) // Nur wenn Ordner
			{
				$f = new Folder( $id );
				$f->load();
				
				// Ermitteln eines Objektes mit dem Dateinamen index
//				$oid = $f->getObjectIdByFileName('index');
				
				if	( count($f->getLinks())+count($f->getPages()) > 0 )
				{
					$this->output( '<h1 class="title">'.$o->name.'</h1><ul>');
					// Untermenue
					// Schleife ber alle Objekte im aktuellen Ordner
					foreach( $f->getObjectIds() as $xid )
				    {
						$o = new Object( $xid );
						$o->languageid = $this->page->languageid;
						$o->load();
				
						// Nur Seiten und Verknuepfungen anzeigen
						if (!$o->isPage && !$o->isLink ) continue;
						
						// Wenn aktuelle Seite, dann markieren, sonst Link
						if ( $this->getObjectId() == $xid )
						{
							// aktuelle Seite
							$this->output( '<li class="menu">'.$o->name.'</li>' );
						}
						else
						{
							$this->output( '<li class="menu"><a class="menu" href="'.$this->page->path_to_object($xid).'">'.$o->name.'</a></li>' );
						}
					}
			
					$this->output( '</ul><br />' );
				}
			}
		}
	}
}