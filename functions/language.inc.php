<?php

#
#  DaCMS Content Management System
#  Copyright (C) 2002,2003 Jan Dankert, cms@jandankert.de
#
#  This program is free software; you can redistribute it and/or
#  modify it under the terms of the GNU General Public License
#  as published by the Free Software Foundation; either version 2
#  of the License, or (at your option) any later version.
#
#  This program is distributed in the hope that it will be useful,
#  but WITHOUT ANY WARRANTY; without even the implied warranty of
#  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#  GNU General Public License for more details.
#
#  You should have received a copy of the GNU General Public License
#  along with this program; if not, write to the Free Software
#  Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
#


/**
 * Diese Funktion stellt ein Wort in der eingestellten
 * Sprache zur Verfuegung.
 *
 * @package openrat.functions
 */
function lang( $text )
{
	global $conf;
	$lang = $conf['language'];

	$text = strtoupper($text);

     if   ( isset( $lang[$text] ) )
          return $lang[$text];
     else
          return( '?'.$text.'?' );
}



/**
 * Diese Funktion prueft, ob ein Sprachelement vorhanden ist
 *
 * @package openrat.functions
 */
function hasLang( $text )
{
	$text = strtoupper($text);

	global $conf;
	$lang = $conf['language'];
	return isset( $lang[$text] );
}


?>