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
use cms\model\Folder;
use cms\model\Page;
use util\Macro;


/**
 * Erstellen eines Menues
 * @author Jan Dankert
 */
class ClassicMenu extends Macro
{
	/**
	 * Beschreibung dieser Klasse
	 * @type String
	 */
	var $description = 'This is a dynamic Menue which contains all pages. Folders are opened when useful. Nice standard menu :-)';


	/**
	 * Zeichenkette, die vor einem aktiven Menuepunkt gezeigt wird 
	 */
	var $css_class  = 'macro-classicmenu';
	var $onlySameTemplate = true;
	

	// Erstellen des Hauptmenues
	public function execute()
	{
		$rootId = $this->getRootObjectId();
		// Erstellen eines Untermenues

		$f = new Folder( $this->page->parentid );
		$this->parentFolders = $f->parentObjectFileNames(false,true);
		
		$this->showFolder( $rootId );
	}

	private function showFolder( $oid )
	{
		$this->outputLn('<ul class="'.$this->css_class.'">');
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
						$this->outputLn( '<li class="active">'.$o->name.'' );
					else
						// Link erzeugen
						$this->outputLn( '<li><a href="'.$this->pathToObject($fp->objectid).'">'.$o->name.'</a>' );

					if	( in_array($o->objectid,array_keys($this->parentFolders)) )
					{
						$this->showFolder($o->objectid);
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
					$this->output( '<li class="active">'.$o->name.'</li>' );
				elseif	( $o->isLink )
					// Link mit HTML-Sonderzeichenumwandlung erzeugen
					$this->output( '<li><a href="'.htmlspecialchars($this->pathToObject($o->objectid)).'">'.$o->name.'</a></li>' );
				else
					// Link erzeugen
					$this->output( '<li><a href="'.$this->pathToObject($o->objectid).'">'.$o->name.'</a></li>' );
			}
		}
		$this->output('</ul>');
	}

}