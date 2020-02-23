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
// $Log$
// Revision 1.1  2005-01-04 20:31:52  dankert
// Neues Menue
//
// Revision 1.1  2005/01/04 20:00:12  dankert
// Darstellung eines DHTML-Menues
//
// Revision 1.2  2004/12/28 22:57:56  dankert
// Korrektur Vererbung, "api" ausgebaut
//
// Revision 1.1  2004/10/14 21:15:29  dankert
// Erzeugen und Anzeigen einer Sitemap
//
// ---------------------------------------------------------------------------
use cms\model\File;
use cms\model\Folder;
use cms\model\Page;
use util\Macro;


/**
 * Erstellen eines DHTML-Menues (DoiMenu)
 *
 * Diese Klasse erzeugt Javascript-Code fuer das DoiMenu
 *
 * @see http://doimenu.sf.net for details
 * @author Jan Dankert
 */
class DoiMenu extends Macro
{
	/**
	 * Bitte immer eine Beschreibung benutzen, dies ist fuer den Web-Developer hilfreich.
	 * @type String
	 */
	var $description = 'You *have to* include doiMenuDOM.js in the page!<br/>Put the code below in head section:<br/><tt>&lt;script type="text/javascript" src="{{your-elementname}}.js"&gt;&lt;/script&gt;</tt><br/>The file is distributed with OpenRat';


	/**
	 * Parameter mit Objekt-Id
	 * Die Datei mit dieser Id enthaelt Parameter fuer das Menu
	 */
	var $parameterFileId = 0;
	
	/**
	 * Ausrichtung des Menues.
	 * available value : 'horizontal','vertical'.
	 */
	var $direction = 'horizontal';

	
	/**
	 * Erstellen des DHTML-Menues
	 */
	function execute()
	{
		// Erstellen eines Untermenues
		
		// Ermitteln der aktuellen Seite
		$thispage = new Page( $this->getObjectId() );
		$thispage->load(); // Seite laden
		
		$this->outputLn('<script name="javascript" type="text/javascript">');

		$this->outputLn("  var menu = new TMainMenu('menu','".$this->direction."');");

		$ro = new Folder($this->getRootObjectId());
		$this->showFolder( $ro );

		if	( intval( $this->parameterFileId ) != 0 )
		{
			$f = new File( intval($this->parameterFileId) );
			$this->outputLn( $f->loadValue() );
		}
		
		$this->outputLn( '  menu.Build()' );
		$this->outputLn( '</script');
	}
	
	
	function showFolder( $fo )
	{
		if	( $fo->objectid == intval($this->getRootObjectId()) )
			$parentMenu = 'menu';
		else
			$parentMenu = 'menu'.$fo->objectid;

		foreach( $fo->getObjects() as $o )
		{
			$menu = 'menu'.$o->objectid;

			if	( $o->isFolder )
			{	$nf = new Folder($o->objectid);
				$pl = $nf->getFirstPageOrLink();
				if	( is_object($pl) )
				{
					$this->outputLn(" var $menu = new TPopMenu('".$o->name."','','a','".$this->pathToObject($pl->objectid)."','".$o->desc."');");
					$this->outputLn(" $parentMenu.Add(menu".$o->objectid.");");
					$this->showFolder( $nf );
				}
			}

			if	( $o->isPage || $o->isPage )
			{
				$this->outputLn(" var $menu = new TPopMenu('".$o->name."','','a','".$this->pathToObject($o->objectid)."','".$o->desc."');");
				$this->outputLn(" $parentMenu.Add(menu".$o->objectid.");");
			}
		}
	}

}

?>