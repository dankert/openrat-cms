<?php
// ---------------------------------------------------------------------------
// $Id$
// ---------------------------------------------------------------------------
// DaCMS Content Management System
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
// Revision 1.4  2005-04-16 22:26:15  dankert
// Erweiterung Methode maxLength()
//
// Revision 1.3  2005/02/17 21:22:22  dankert
// Weitere Funktionen f?r HTML und BB-Code
//
// Revision 1.2  2004/05/02 15:04:16  dankert
// Einfügen package-name (@package)
//
// Revision 1.1  2004/04/24 17:03:28  dankert
// Initiale Version
//
// ---------------------------------------------------------------------------


/**
 * Nuetzliche Funktionen fuer das Bearbeiten von Texten/Zeichenketten
 * @author $Author$
 * @version $Revision$
 * @package openrat.services
 */
class Text
{
	/**
	 * Alias fuer Methode maxLength()
	 *
	 * @deprecated use maxlength() !
	 */
	function maxLaenge( $laenge,$text )
	{
		return Text::maxLength($text,$laenge);
	}


	/**
	 * Einen Text auf eine bestimmte Laenge begrenzen.
	 *
	 * Ist der Text zu lang, so wird abgeschnitten und
	 * eine Zeichenkette angehaengt.
	 *
	 * @param String Text, der zu begrenzen ist
	 * @param Integer maximale Laenge des Textes (optional)
	 * @param Text, der an gekuerzten Text angehangen wird (optional)
	 */
	function maxLength( $text,$laenge=20,$append='...',$where=STR_PAD_RIGHT )
	{
		if	( strlen($text) > $laenge )
		{
			if	( $where == STR_PAD_RIGHT )
				$text = substr($text,0,$laenge).$append;
			elseif	( $where == STR_PAD_BOTH )
				$text = substr($text,0,$laenge/2).$append.substr($text,strlen($text)-($laenge/2));
		}

		return $text;
	}


	/**
	 * Umwandeln von BB-Code in Wiki-Textauszeichnungen
	 *
	 * @param text zu bearbeitender Text
	 *
	 * @return String Ausgabe
	 */
	function bbCode2Wiki( $inhalt )
	{
		$inhalt = eregi_replace('\[b\]([^\[]*)\[\/b\]'       , '*\\1*' ,$inhalt);
		$inhalt = eregi_replace('\[i\]([^\[]*)\[\/i\]'       , '_\\1_' ,$inhalt);
		$inhalt = eregi_replace('\[code\]([^\[]*)\[\/code\]' , '=\\1=' ,$inhalt);

		$inhalt = eregi_replace('\[url\]([^\[]*)[\/url\]'          ,'"\\1"->"\\1"' ,$inhalt);
		$inhalt = eregi_replace('\[url=([^\[]*)\]([^\[]*)\[\/url\]','"\\2"->"\\1"' ,$inhalt);

		return $inhalt;
	}


	/**
	 * Umwandeln von einfachen HTML-Befehlen in Wiki-Textauszeichnungen
	 *
	 * @param text zu bearbeitender Text
	 *
	 * @return String Ausgabe
	 */
	function Html2Wiki( $inhalt )
	{
		$inhalt = eregi_replace('<b(.*)>(.*)</b>','*\\2*' ,$inhalt);
		$inhalt = eregi_replace('<i(.*)>(.*)</i>','_\\2_' ,$inhalt);
		$inhalt = eregi_replace('<a(.*)href="(.*)">(.*)</a>','"\\3"->"\\2"' ,$inhalt);

		return $inhalt;
	}


	/**
	 * HTML-Entitaeten fuer HTML-Tags verwenden
	 *
	 * @param String Text, in dem HTML-Tags umgewandelt werden sollen
	 * @return String Ausgabe
	 */
	function encodeHtml( $inhalt )
	{
		$inhalt = str_replace('&','&amp;',$inhalt);
		$inhalt = str_replace('<','&lt;' ,$inhalt);
		$inhalt = str_replace('>','&gt;' ,$inhalt);

		return $inhalt;
	}

}

 
?>