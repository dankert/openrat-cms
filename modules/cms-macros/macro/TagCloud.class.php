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


/**
 * Erstellt eine Tagcloud.
 * @author Jan Dankert
 */
class TagCloud extends Macro
{
	/**
	 * Beschreibung dieser Klasse
	 * @type String
	 */
	var $description = '';


	public $keywordFolderId = 0;
	

	// Erstellen des Hauptmenues
	function execute()
	{
		if	( intval($this->keywordFolderId) == 0 )
		{
			$this->output('param keywordfolderid not set');
			return;
		}
		
		$f = new Folder( $this->keywordFolderId );
		
		foreach( $f->getChildObjectIdsByName() as $fid )
		{
			$tf = new Folder($fid);
			if	( !$tf->isFolder)
				continue;
			$tf->load();
			
			$target = $tf->getFirstPage();
			
			if	( $target == null)
				continue;
			$target->load();
				
			// Link zum Tag erzeugen
			$this->output( '<div class="tag" style="font-size:'.(0.5+(sizeof($tf->getObjectIds())*0.1)).'em"><a href="'.$this->pathToObject($target->objectid).'">'.$tf->name.'</a></div>' );			
		}
	}

}