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
use cms\model\Folder;
use cms\model\BaseObject;


/**
 * Creates a list of links.
 *
 * @author Jan Dankert
 */
class LinkList extends Macro
{
	/**
	 * Bitte immer eine Beschreibung benutzen, dies ist fuer den Web-Developer hilfreich.
	 * @type String
	 */
	public $description = 'Creates a list of links';

	public $folderid;


	function execute()
	{
		echo '<ul>';

		//
		if   ( ! $this->folderid )
		$this->folderid = $this->getRootObjectId();

		$folder = new Folder( $this->folderid );

		// Schleife ueber alle Inhalte des Ordners
		foreach( $folder->getObjectIds() as $id )
		{
			$o = new BaseObject( $id );
			$o->languageid = $this->page->languageid;
			$o->load();

			// Nur Seiten und Verknuepfungen anzeigen
			if (!$o->isPage && !$o->isLink && !$o->isUrl )
				continue;

			// Wenn aktuelle Seite, dann markieren, sonst Link
			$class = ($this->getObjectId() == $id )?'actual':'';

			echo '<li class="'.$class.'"><a href="'.$this->page->path_to_object($id).'">'.$o->name.'</a></li>';
		}

		echo '</ul>';
	}
}