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
 * @var String Name der Sprachvariablen
 * @var Array Liste (Assoziatives Array) von Variablen
 *
 * @package openrat.functions
 */
function lang( $textVar,$vars = array() )
{
	global $conf;
	$lang = $conf['language'];

	$text = strtoupper($textVar);

	// Abfrage, ob Textvariable vorhanden ist
	if   ( !isset( $lang[$text] ) && substr($text,0,9)=='GLOBAL_' )
		$text = substr($text,7);

	// Abfrage, ob Textvariable vorhanden ist
	if   ( !isset( $lang[$text] ))
		$text = 'GLOBAL_'.$text;
	
	// Abfrage, ob Textvariable vorhanden ist
	if   ( isset( $lang[$text] ) )
	{
		$text = $lang[$text];
     	
		// Fuellen der Variablen im Text
		foreach( $vars as $var=>$value )
			$text = str_replace('{'.$var.'}',$value,$text);

		str_replace("''",'"',$text);
			
		return $text;
	}
	
	// Wenn Textvariable nicht vorhanden ist, dann als letzten Ausweg nur den Variablennamen zurueckgeben
	return( '?'.$textVar.'?' );
}




/**
 * Diese Funktion stellt ein Wort in der eingestellten
 * Sprache zur Verfuegung. Sonderzeichen werden als HTML maskiert.
 *
 * @var String Name der Sprachvariablen
 * @var Array Liste (Assoziatives Array) von Variablen
 *
 * @package openrat.functions
 * @param $key
 * @return unknown_type
 */
function langHtml( $key,$vars = array() ) {

	return encodeHtml( lang($key,$vars) );
}

/**
 * Ersetzt alle Zeichen mit dem Ordinalwert > 127 mit einer HTML-Maskierung.
 *
 * @return String
 */
function encodeHtml($text)
{
	$charset = lang('CHARSET');
	if	( in_array( $charset, array('ISO-8859-1','ISO-8859-15','UTF-8')) )
	{
		return htmlentities($text,ENT_QUOTES,$charset );
	}
	else
	{
		return $text;
		// TODO: Was tun mit ISO-8859-5 (kyryllisch)?
		
		$t2 = '';
		
		for	( $i=0;$i<strlen($text);$i++)
		{
			$o = ord($text[$i]);
			if	( $o <= 127 )
				$t2 .= $text[$i];
			else
				$t2 .= '&#'.$o.';';
		}
		
		return $t2;
	}
}


/**
 * Diese Funktion prueft, ob ein Sprachelement vorhanden ist
 *
 * @var String Name der Sprachvariablen
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