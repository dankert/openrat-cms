<?php
namespace cms\macros\macro;
// ---------------------------------------------------------------------------
// $Id$
// ---------------------------------------------------------------------------
// OpenRat Content Management System
// Copyright (C) 2012 Tobias Schöne tobias@schoenesnetz.de
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

use cms\model\Language;
use cms\model\Page;
use cms\model\Project;
use util\Macro;

/**
 * Erstellen einer Liste von Language-Links auf die selbe Seite.
 *
 * @author Tobias Schoene
 */
class LanguageLinksForPage extends Macro
{
	/**
	 * Bitte immer eine Beschreibung benutzen, dies ist fuer den Web-Developer hilfreich.
	 * @type String
	 */
	var $description = 'Creates language links to the page.';

	// Build the navigation links to other languages
	function execute()
	{
		// current language
		$languageId = $this->page->languageid;

		$project = new Project( $this->page->projectid );
		// Schleife ueber alle Inhalte des Root-Ordners
		echo '<ul>';
		foreach( $project->getLanguages() as $lid=>$lname)
		{
			
			$language = new Language( $lid );
            $language->load();

            $targetPage = new Page( $this->page->objectid );
            $targetPage->publisher  = $this->page->publisher;
            $targetPage->languageid = $lid;
            $targetPage->modelid    = $this->page->modelid;
            $targetPage->load();

            $link = $this->page->publisher->linkToObject( $this->page, $targetPage );
			echo '<li><a hreflang="'.$language->isoCode.'" href="'.$link.'">'.strtolower($language->isoCode).'</a></li>';
			
		}
		$this->page->languageid = $languageId;
		echo '</ul>';
	}
}
?>