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
 * @package openrat.functions
 */
function lang( $text )
{
	$lang = &Session::getLanguage();
	$text = strtoupper($text);

     if   ( isset( $lang[$text] ) )
          return $lang[$text];
     else
          return( '?'.$text.'?' );
}



/**
 * Diese Funktion prueft, ob ein Sprachelement vorhanden ist
 * @package openrat.functions
 */
function hasLang( $text )
{
	$text = strtoupper($text);
	$lang = &Session::getLanguage();
	return isset( $lang[$text] );
}








function language_read()
{
	global $conf;

	if	( $conf['interface']['use_browser_language'] )
		// Die vom Browser angeforderten Sprachen ermitteln     
		$languages = Http::getLanguages();
	else
		// Nur Default-Sprache erlauben
		$languages = array();

	// Default-Sprache hinzufuegen.
	// Wird verwendet, wenn die vom Browser angeforderten Sprachen
	// nicht vorhanden sind
	$languages[] = $conf['interface']['language'];

	foreach( $languages as $l )
	{
		$l = substr($l,0,2);

		// Pruefen, ob Sprache vorhanden ist.
		if   ( file_exists( OR_LANGUAGE_DIR.$l.'.ini.'.PHP_EXT) )
			break;
	}

	Logger::debug( 'reading language file: '.$l );
	Session::setLanguage( parse_ini_file( OR_LANGUAGE_DIR.$l.'.ini.'.PHP_EXT ) );
}

?>