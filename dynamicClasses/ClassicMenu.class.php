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
// Revision 1.1  2005-01-04 19:59:55  dankert
// Allgemeine Korrekturen, Erben von "Dynamic"-klasse
//
// Revision 1.3  2004/12/19 22:35:23  dankert
// Parameter -Angabe
//
// Revision 1.2  2004/12/19 15:19:29  dankert
// Klasse erbt von "Dynamic"
//
// Revision 1.1  2004/11/10 22:43:35  dankert
// Beispiele fuer dynamische Templateelemente
//
// ---------------------------------------------------------------------------



/**
 * Erstellen eines Menues
 * @author Jan Dankert
 */
class ClassicMenu extends Dynamic
{
	/**
	 * Bitte immer alle Parameter in dieses Array schreiben, dies ist fuer den Web-Developer hilfreich.
	 * @type String
	 */
	var $parameters  = Array(
		'beforeEntry'=>'Chars before an active menu entry',
		'afterEntry' =>'Chars after an active menu entry'
		);

	/**
	 * Bitte immer eine Beschreibung benutzen, dies ist fuer den Web-Developer hilfreich.
	 * @type String
	 */
	var $description = 'This is a dynamic Menue which contains all pages. Folders are opened when useful. Nice standard menu :-)';


	/**
	 * Zeichenkette, die vor einem aktiven Menuepunkt gezeigt wird 
	 */
	var $beforeEntry = '<li><strong>';
	var $afterEntry  = '</strong></li>';
	

	// Erstellen des Hauptmenues
	function execute()
	{
		$rootId = $this->getRootObjectId();
		// Erstellen eines Untermenues

		$f = new Folder( $this->page->parentid );
		$this->parentFolders = $f->parentObjectIds(false,true);
		
		$this->showFolder( $rootId );
	}

	function showFolder( $oid )
	{
		$this->output('<ul>');
		$f = new Folder( $oid );

		// Schleife ueber alle Objekte im aktuellen Ordner
		foreach( $f->getObjects() as $o )
		{
			// Nur Seiten anzeigen
			if ($o->isFolder )
			{
				$nf = new Folder($o->objectid);
				$fp = $nf->getFirstPageOrLink();
				
				if	( is_object($fp) )
				{
	
					// Wenn aktuelle Seite, dann markieren, sonst Link
					if ( $this->page->objectid == $fp->objectid )
						// aktuelle Seite
						$this->output( '<li><strong>'.$o->name.'</strong><br/>' );
					else
						// Link erzeugen
						$this->output( '<li><a href="'.$this->pathToObject($fp->objectid).'">'.$o->name.'</a><br/>' );

					if	( in_array($o->objectid,$this->parentFolders) )
					{
						$this->showFolder($o->objectid);
					}

					$this->output( '</li>' );
				}
			}

			// Nur Seiten anzeigen
			if ($o->isPage ||  $o->isLink )
			{
				// Wenn aktuelle Seite, dann markieren, sonst Link
				if ( $this->getObjectId() == $o->objectid)
					// aktuelle Seite
					$this->output( '<li><strong>'.$o->name.'</strong></li>' );
				else
					// Link erzeugen
					$this->output( '<li><a href="'.$this->page->path_to_object($o->objectid).'">'.$o->name.'</a></li>' );
			}
		}
		$this->output('</ul>');
	}

}