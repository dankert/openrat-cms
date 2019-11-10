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
// Revision 1.2  2004-12-19 15:18:50  dankert
// Speichern des RSS-Feeds in Session (Performance)
//
// Revision 1.1  2004/10/14 21:15:13  dankert
// Lesen eines RSS-Feeds und erzeugen eines HTML-Abschnittes dafuer
//
// ---------------------------------------------------------------------------



/**
 * @author Jan Dankert
 */
class RSSReader extends Macro
{
	/**
	 * Bitte immer alle Parameter in dieses Array schreiben, dies ist fuer den Web-Developer hilfreich.
	 * @type String
	 */
	var $parameters  = Array(
		'url'=>'URL from which the RSS is fetched'
		);

	/**
	 * Bitte immer eine Beschreibung benutzen, dies ist fuer den Web-Developer hilfreich.
	 * @type String
	 */
	var $description = 'Reads a RSS-Feed and displays its content as a html list';

	var $url       = 'http://www.heise.de/newsticker/heise.rdf';



	function execute()
	{
	    // TODO: Caching of macro output should be done by the CMS.

        // Sessionvariable mit CRC verschluesseln, falls es mehrere RSS-Feeds im Projekt gibt
		$sessVar = 'RSSReader_'.crc32($this->url);
		$cache = $this->getSessionVar( $sessVar );
		
		if	( !empty($cache) )
		{
			// Wenn Cache vorhanden, dann diesen ausgeben
			$this->output( $cache );
		}
		else
		{
			// Wenn Cache leer, dann RSS erzeugen und in Session speichern

            ob_start();
            $this->create();

            $output = ob_get_contents();
            ob_end_clean();

            $this->setSessionVar( $sessVar,$output );
            echo $output;
		} 
	}



	// Erzeugt den Text des RSS-Feeds
	function create()
	{
		$rss = $this->parse( implode('',file($this->url)) );
		$out = array();
		
		$this->output('<ul>');

		// Schleife ueber alle Inhalte des RSS-Feeds
		foreach( $rss['items'] as $item )
		{
			$this->output('<li>');
			$this->output('<a href="'.$item['link'].'">'.$item['title'].'</a><br/>'.$item['description']);
			$this->output('</li>');
		}

		$this->output('</ul>');
	}



	function parse( $feed )
	{
		// Parses the RSS feed into the array
		$arr = array();
		// Determine encoding
		preg_match('/<\?xml version="1\.0" encoding="(.*)"\?>/i', $feed, $sarr);
		if	( !empty($sarr[1]))
			$arr["encoding"] = $sarr[1];
		// Determine title
		preg_match('/<title>(.*)<\/title>/i', $feed, $sarr);
		if	( !empty($sarr[1]))
			$arr["title"] = $sarr[1];
		// Determine title
		preg_match('/<title>(.*)<\/title>/i', $feed, $sarr);
		if	( !empty($sarr[1]))
			$arr["title"] = $sarr[1];
		// Determine description
		preg_match('/<description>(.*)<\/description>/i', $feed, $sarr);
		if	( !empty($sarr[1]))
			$arr["description"] = $sarr[1];
		// Determine link
		preg_match('/<link>(.*)<\/link>/i', $feed, $sarr);
		if	( !empty($sarr[1]))
			$arr["link"] = $sarr[1];
		// Determine language
		preg_match('/<language>(.*)<\/language>/i', $feed, $sarr);
		if	( !empty($sarr[1]))
			$arr["language"] = $sarr[1];
		// Determine generator
		preg_match('/<generator>(.*)<\/generator>/i', $feed, $sarr);
		if	( !empty($sarr[1]))
			$arr["generator"] = $sarr[1];
		// Strip items
		$parts = explode("<item>", $feed);
		foreach($parts as $part)
		{
			$item = substr($part, 0, strpos($part, "</item>"));
			if	( !empty($item) )
				$items[] = $item;
		}
		// Fill the channel array
		$arr["items"] = array();
		foreach($items as $item)
		{
			$i = array();
			
			// Determine title
			preg_match('/<title>(.*)<\/title>/i', $item, $title);
			if	( !empty($title[1]))
				$i['title'] = $title[1];
			else
				$i['title'] = '';

			// Determine pubdate
			preg_match('/<pubDate>(.*)<\/pubDate>/i', $item, $pubdate);
			if	( !empty($pubdate[1]))
				$i['pubDate'] = strtotime($pubdate[1]);
			else
				$i['pubDate'] = '';

			// Determine link
			preg_match('/<link>(.*)<\/link>/i', $item, $link);
			if	( !empty($link[1]))
				$i['link'] = $link[1];
			else
				$i['link'] = '';

			// Determine description
			if(stristr($item, '<![CDATA['))
				preg_match('/<description><!\[CDATA\[(.*)\]\]><\/description>/is', $item, $description);
			else
				preg_match('/<description>(.*)<\/description>/is', $item, $description);

			if	( !empty($description[1]))
				$i['description'] = $description[1];
			else
				$i['description'] = '';

			$arr["items"][] = $i;
		}
		return $arr;
	}
}