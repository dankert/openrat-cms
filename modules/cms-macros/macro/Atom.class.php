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
use cms\model\Folder;
use cms\model\BaseObject;
use cms\model\Page;


/**
 * Erstellen eines ATOM-Feeds
 * @author Jan Dankert
 */
class Atom extends Macro
{
	/**
	 * Bitte immer alle Parameter in dieses Array schreiben, dies ist fuer den Web-Developer hilfreich.
	 * @type String
	 */
	var $parameters  = Array(
		'folderid'        =>'Id of the folder whose pages should go into the Atom-Feed, default: the root folder',
		'feed_url'        =>'Url of the feed, default: blank',
		'feed_title'      =>'Title of the feed, default: Name of folder',
		'feed_description'=>'Description of the feed, default: Description of folder'
		);

	var $folderid     = 0;

	/**
	 * Bitte immer eine Beschreibung benutzen, dies ist fuer den Web-Developer hilfreich.
	 * @type String
	 */
	var $description      = 'Creates an Atom-Feed of pages in a folder';
	var $api;

	var $feed_url         = '';
	var $feed_title       = '';
	var $feed_description = '';

	// Erstellen des Hauptmenues
	function execute()
	{
		$feed = array();

		// Lesen des Root-Ordners
		if	( intval($this->folderid) == 0 )
			$folder = new Folder( $this->getRootObjectId() );
		else
			$folder = new Folder( intval($this->folderid) );

		$folder->load();

		if	( $this->feed_title == '' )
			$this->feed_title = $folder->name;

		if	( $this->feed_description == '' )
			$this->feed_description = $folder->desc;

		$feed['title'      ] = $this->feed_title;			
		$feed['description'] = $this->feed_description;			
		$feed['url'        ] = $this->feed_url;			
		$feed['items'      ] = array();			
		// Schleife ueber alle Inhalte des Root-Ordners
		foreach( $folder->getObjectIds() as $id )
		{
			if	( $id == $this->getObjectId() )
				continue;
			$o = new BaseObject( $id );
			$o->languageid = $this->page->languageid;
			$o->load();
			if ( $o->isPage ) // Nur wenn Seite
			{
				$p = new Page( $id );
				$p->load();

				$item = array();
				$item['title'      ] = $p->name;
				$item['description'] = $p->desc;
				$item['date'       ] = $p->lastchangeDate;
				if	( empty($this->feed_url) )
					$item['link'       ] = $this->pathToObject($id);
				else
					$item['link'       ] = $this->feed_url;
				
				$feed['items'][] = $item;
			}
		}
		
		$feed = $this->atomFeed($feed);

		$this->output( $feed );
	}
	
	
	function atomFeed($input, $stylesheet='')
	{
		$input["encoding"]  = (empty($input["encoding"] ))?"UTF-8":$input["encoding"];
		$input["language"]  = (empty($input["language"] ))?"en-us":$input["language"];
		
		if	( empty($input['title'      ])) $input['title'      ] = ''; 
		if	( empty($input['description'])) $input['description'] = ''; 
		if	( empty($input['link'       ])) $input['link'       ] = ''; 
		$feed = '<?xml version="1.0" encoding="'.$input["encoding"].'"?>';
		$feed .= (!empty($stylesheet))?"\n".'<?xml-stylesheet type="text/xsl" href="'.$stylesheet.'"?>':"";
		$feed .= <<<__RSS__
		
		<feed xmlns="http://www.w3.org/2005/Atom">
  		<title>{$input["title"]}</title>
		
__RSS__;
		    foreach($input["items"] as $item)
		    {
				if	( empty($item['title'      ])) $item['title'      ] = ''; 
				if	( empty($item['description'])) $item['description'] = ''; 
		        $feed .= "\n<entry>\n<title>".$item["title"]."</title>";
		        $feed .= "\n<summary><![CDATA[".$item["description"]."]]></summary>";
	            $feed .= "\n<updated>".date('Y-m-d\TH:i:s\Z', $item["date"])."</updated>";
	            $feed .= "\n<link href=\"".$item["link"]."\" />";
		        $feed .= "\n</entry>\n";
		    }
			$feed .= "\n</feed>";
		return $feed;
	}
}