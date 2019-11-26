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
// Revision 1.2  2004-12-19 15:19:16  dankert
// Klasse erbt von "Dynamic"
//
// Revision 1.1  2004/10/14 21:15:57  dankert
// Erzeugen eines Hauptmenues
//
// ---------------------------------------------------------------------------
use cms\model\Folder;
use cms\model\BaseObject;


/**
 * Erstellen eines Hauptmenues
 * @author Jan Dankert
 */
class MainMenu extends Macro
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

	// Erstellen des Hauptmenues
	function execute()
	{
		// Lesen des Root-Ordners
		$folder = new Folder( $this->getRootObjectId() );
		
		// Schleife ueber alle Inhalte des Root-Ordners
		foreach( $folder->getObjectIds() as $id )
		{
			$o = new BaseObject( $id );
			$o->languageid = $this->page->languageid;
			$o->load();
			if ( $o->isFolder ) // Nur wenn Ordner
			{
				$f = new Folder( $id );
				
				// Ermitteln eines Objektes mit dem Dateinamen index
				$oid = $f->getObjectIdByFileName('index');
				if ( is_numeric($oid) && $oid!=0 )
					$this->output( $this->arrowChar.'<a href="'.$this->pathToObject($oid).'" title="'.$o->desc.'">'.$o->name.'</a>' );
			}
		}
	}
}