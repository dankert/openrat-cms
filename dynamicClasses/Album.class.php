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



/**
 * Erzeugt eine Bilder-Liste.
 * 
 * @author Jan Dankert
 */
class Album extends Dynamic
{
	/**
	 * Bitte immer alle Parameter in dieses Array schreiben, dies ist fuer den Web-Developer hilfreich.
	 * @type String
	 */
	var $parameters  = Array(
		);

	/**
	 * Bitte immer eine Beschreibung benutzen, dies ist fuer den Web-Developer hilfreich.
	 * @type String
	 */
	var $description = 'Creates an album.';
	
	/**
	 */
	function execute()
	{
		$folderid = $this->page->parentid;
		$f      = new Folder($folderid);
		
		$files = $f->getFiles();
		
		foreach( $files as $fileid )
		{
			$file = new File($fileid);
			$file->load();
			
			$img = '<img src="'.$this->pathToObject($fileid).'" alt="" />';
			$this->output($img.'<p>'.$file->desc.'</p><br/><br/>');
		}
	}

}

?>