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
// Revision 1.3  2007-11-29 22:09:06  dankert
// Das Men? in der Sprache der zu ver?ffentlichenden Seite erzeugen.
//
// Revision 1.2  2005/01/04 21:01:24  dankert
// Benutzen von CSS-Klassen
//
// Revision 1.1  2005/01/04 19:59:55  dankert
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
	 * Beschreibung dieser Klasse
	 * @type String
	 */
	var $description = 'This is a dynamic Menue which contains all pages. Folders are opened when useful. Nice standard menu :-)';


	/**
	 * Zeichenkette, die vor einem aktiven Menuepunkt gezeigt wird 
	 */
	var $beforeEntry = '<li><strong>';
	var $afterEntry  = '</strong></li>';
	var $csspraefix  = 'menu';
	var $onlySameTemplate = true;
	

	// Erstellen des Hauptmenues
	function execute()
	{
		$rootId = $this->getRootObjectId();
		// Erstellen eines Untermenues

		$f = new Folder( $this->page->parentid );
		$this->parentFolders = $f->parentObjectFileNames(false,true);
		
		$this->showFolder( $rootId,0 );
	}

	function showFolder( $oid,$level )
	{
		$this->outputLn('<ul class="'.$this->csspraefix.$level.'">');
		$f = new Folder( $oid );

		// Schleife ueber alle Objekte im aktuellen Ordner
		foreach( $f->getObjects() as $o )
		{
			$o->languageid = $this->page->languageid;
			$o->load();
			
			// Ordner anzeigen
			if ($o->isFolder )
			{
				$nf = new Folder($o->objectid);
				$fp = $nf->getFirstPageOrLink();
				
				if	( is_object($fp) )
				{
	
					// Wenn aktuelle Seite, dann markieren, sonst Link
					if ( $this->page->objectid == $fp->objectid )
						// aktuelle Seite
						$this->outputLn( '<li class="'.$this->csspraefix.$level.'"><strong class="'.$this->csspraefix.$level.'">'.$o->name.'</strong><br/>' );
					else
						// Link erzeugen
						$this->outputLn( '<li class="'.$this->csspraefix.$level.'"><a class="'.$this->csspraefix.$level.'" href="'.$this->pathToObject($fp->objectid).'">'.$o->name.'</a><br/>' );

					if	( in_array($o->objectid,array_keys($this->parentFolders)) )
					{
						$this->showFolder($o->objectid,$level+1);
					}

					$this->outputLn( '</li>' );
				}
			}

			if ($o->isPage)
			{
				$page = new Page($o->objectid);
				$page->load();
				if	( $page->templateid != $this->page->templateid && $this->onlySameTemplate )
					continue;
			}
			
			// Seiten und Verknuepfungen anzeigen
			if ($o->isPage ||  $o->isLink )
			{
				// Wenn aktuelle Seite, dann markieren, sonst Link
				if ( $this->getObjectId() == $o->objectid)
					// aktuelle Seite
					$this->output( '<li class="'.$this->csspraefix.$level.'"><strong class="'.$this->csspraefix.$level.'">'.$o->name.'</strong></li>' );
				else
					// Link erzeugen
					$this->output( '<li class="'.$this->csspraefix.$level.'"><a class="'.$this->csspraefix.$level.'" href="'.$this->pathToObject($o->objectid).'">'.$o->name.'</a></li>' );
			}
		}
		$this->output('</ul>');
	}

}