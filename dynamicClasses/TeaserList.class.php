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
// Revision 1.2  2005-01-04 19:59:55  dankert
// Allgemeine Korrekturen, Erben von "Dynamic"-klasse
//
// Revision 1.1  2004/10/14 21:15:43  dankert
// Anzeige einer Nachrichtenliste
//
// ---------------------------------------------------------------------------



/**
 * Erstellen einer Teaser-Liste
 * @author Jan Dankert
 */
class TeaserList extends Dynamic
{
	/**
	 * Bitte immer alle Parameter in dieses Array schreiben, dies ist fuer den Web-Developer hilfreich.
	 * @type String
	 */
	var $parameters  = Array(
		'folderid'             =>'Id of the folder whose pages should go into the list, default: the root folder',
		'forward_text'         =>'Link text, default: "read more..."',
		'title_html_tag'       =>'HTML-Tag for the titles, default: "h2"',
		'title_css_class'      =>'CSS-Class to use for title, default: ""',
		'description_css_class'=>'CSS-Class to use for description, default: ""',
		'link_css_class'       =>'CSS-Class to use for the forward link, default: ""'
		);

	var $folderid              = 0;
	var $forward_text          = 'read more ...';
	var $title_html_tag        = 'h2';
	var $title_css_class       = '';
	var $description_css_class = '';
	var $link_css_class        = '';

	/**
	 * Bitte immer eine Beschreibung benutzen, dies ist fuer den Web-Developer hilfreich.
	 * @type String
	 */
	var $description = 'Creates a teaser list of pages in a folder';
	var $api;

	// Erstellen des Hauptmenues
	function execute()
	{
		$feed = array();

		if	( !empty($this->title_css_class) )
			$this->title_css_class       = ' class="'.$this->title_css_class.'"';

		if	( !empty($this->description_css_class) )
			$this->description_css_class = ' class="'.$this->description_css_class.'"';

		if	( !empty($this->link_css_class) )
			$this->link_css_class        = ' class="'.$this->link_css_class.'"';

		// Lesen des Root-Ordners
		if	( intval($this->folderid) == 0 )
			$folder = new Folder( $this->getRootObjectId() );
		else
			$folder = new Folder( intval($this->folderid) );

		$folder->load();

		// Schleife ueber alle Inhalte des Root-Ordners
		foreach( $folder->getObjects() as $o )
		{
			if ( $o->isPage ) // Nur wenn Ordner
			{
				$p = new Page( $id );
				$p->load();

				$this->output( '<'.$this->title_html_tag.$this->title_css_class.'>'.$p->name.'</'.$this->title_html_tag.'>' );
				$this->output( '<p'.$this->description_css_class.'>'.$p->desc.'</p>' );
				$this->output( '<p><a href="'.$this->pathToObject($o->objectid).'"'.$this->link_css_class.'>'.$this->forward_text.'</a></p>' );
			}
		}
	}
}