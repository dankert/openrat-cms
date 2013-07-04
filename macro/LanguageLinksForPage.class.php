<?php
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
// $Log$
// ---------------------------------------------------------------------------
/**
 * Erstellen einer Liste von Language-Links auf die selbe Seite
 * @author Tobias Schoene
 */
class LanguageLinksForPage extends Macro
{
	/**
	 * Bitte immer alle Parameter in dieses Array schreiben, dies ist fuer den Web-Developer hilfreich.
	 * @type String
	 */
	var $parameters  = Array(
		'arrowChar'=>'String between entries'
		);


	var $arrowChar = ' &middot; ';

	/**
	 * Bitte immer eine Beschreibung benutzen, dies ist fuer den Web-Developer hilfreich.
	 * @type String
	 */
	var $description = 'Creates language links to the page.';
	var $version     = '$Id$';
	var $api;

	// Build the navigation links to other languages
	function execute()
	{
		// current language
		$languageId = $this->page->languageid;
	 
		// Schleife ueber alle Inhalte des Root-Ordners
		foreach( Language::getAll() as $lid=>$lname)
		{
			
			$l = new Language( $lid );
                        $l->load();
                        $this->page->languageid = $l->languageid;
                        $filename = $this->page->full_filename();
			$filename = str_replace($this->page->path(),".",$filename);
			$this->output( '<li><a href="'.$filename.'">'.strtolower($l->isoCode).'</a></li>' );
			
		}
		$this->page->languageid = $languageId;
	}
}
?>