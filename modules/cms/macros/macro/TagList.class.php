<?php
namespace cms\macros\macro;
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
use cms\model\Link;
use util\Macro;


/**
 * Erstellt eine Tagcloud.
 * @author Jan Dankert
 */
class TagList extends Macro
{
	/**
	 * Beschreibung dieser Klasse
	 * @type String
	 */
	var $description = '';

	function execute()
	{
		$page = $this->getPage();
		$linkIds = $page->getLinksToMe();
		
		foreach( $linkIds as $linkid )
		{
			$l = new Link( $linkid );
			$l->load();
			$f = new Folder( $l->parentid );
			$f->load();
			
			$target = $f->getFirstPage();
			if	( $target==null) continue;
			$target->load();
			
			// Link erzeugen
			$this->output( '<div class="tag"><a href="'.$this->pathToObject($target->objectid).'">'.$f->getNameForLanguage( $this->pageContext->languageId )->name.'</a></div>' );
		}
	}

}