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
// Revision 1.2  2004-05-02 15:04:16  dankert
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
	// Einen Text auf eine maximale Laenge beschränken.
	//
	// Falls Text zu lang ist wird mit '...' abgekürzt
	//
	function maxLaenge( $laenge,$text )
	{
		if   ( strlen($text) > $laenge )
			$text = substr($text,0,$laenge).'...';

		return $text;
	}
}

 
?>