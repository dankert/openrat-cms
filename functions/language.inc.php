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
 * Sprache zur Verf?gung.
 * @package openrat.functions
 */
function lang( $text )
{
     global $SESS;
	$text = strtoupper($text);

     if   ( isset( $SESS['lang'][$text] ) )
     {
          return $SESS['lang'][$text];
     }
     else
     {
          return( '?'.$text.'?' );
     }
}



# Spracheinstellungen laden

function language_from_http()
{
	global $SESS,
	       $HTTP_SERVER_VARS,
	       $conf_php,
	       $conf;

	$languages = $HTTP_SERVER_VARS['HTTP_ACCEPT_LANGUAGE'];
	$languages = explode(',',$languages);
	foreach( $languages as $l )
	{
		$l = substr($l,0,2);
		if   ( file_exists("./language/$l.ini.$conf_php") )
			return( $l );
	}

	// Keine passende Sprache im HTTP-Header gefunden 			
	return $conf['global']['default_language'];
}


function language_read( $l='' )
{
	global $SESS,
	       $HTTP_SERVER_VARS,
	       $conf_php;
     
	$l = language_from_http();
	Logger::debug( 'reading language file: '.$l );
	$SESS['lang'] = parse_ini_file( "./language/$l.ini.$conf_php" );
}

?>