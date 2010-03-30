<?php


/**
 * F�gt einen Slash ("/") an das Ende an, sofern nicht bereits vorhanden.
 *
 * @param String $pfad
 * @return Pfad mit angeh�ngtem Slash.
 */
function slashify($pfad)
{
	if	( substr($pfad,-1,1) == '/')
		return $pfad;
	else
		return $pfad.'/';
}

function convertToXmlAttribute( $value )
{
	return utf8_encode( htmlspecialchars( $value ) ) ;
}


/**
 * Ermittelt die aktuelle Systemzeit als Unix-Timestamp.<br>
 * Unix-Timestamp ist immer bezogen auf GMT.
 * - 
 * @return Unix-Timestamp der aktuellen Zeit
 */
function now()
{
	return time();
}



/**
 * Erzeugt f�r eine Zahl eine Schreibweise mit Vorzeichen.<br>
 * '-2' bleibt '-2'<br>
 * '2'  wird zu '+2'<br>
 */
function vorzeichen( $nr )
{
	return intval($nr)<0 ? $nr : '+'.$nr;
}



/**
 * Stellt fest, ob das System in einem schreibgeschuetzten Zustand ist.
 * 
 * @return boolean true, falls schreibgeschuetzt, sonst false
 */
function readonly()
{
	global $conf;
	
	// Gesamtes CMS ist readonly.
	if	( config('security','readonly') )
		return true;
		
	// Aktuelle Datenbankverbindung ist readonly.
	$db = Session::getDatabase();
	if	( isset($db->conf['readonly']) && $db->conf['readonly'] )
		return true;
		
	return false;
}



/*
 * Liest einen Schluessel aus der Konfiguration
 * 
 * @return String, leer falls Schluessel nicht vorhanden
 */
function config( $part1,$part2,$part3=null )
{
	global $conf;
	
	if	( $part3 == null)
		if	( isset($conf[$part1][$part2]))
			return $conf[$part1][$part2];
		else
			return '';
	else
		if	( isset($conf[$part1][$part2][$part3]))
			return $conf[$part1][$part2][$part3];
		else
			return '';
}


/**
 * Generiert aus der Session-Id einen Token.
 * @return Token
 */
function token()
{
	return substr(session_id(),-10);
}


/**
 * Ermittelt, ob der Wert 'true' oder 'false' entspricht.
 * 
 * Anders als beim PHP-Cast auf boolean wird hier auch die
 * Zeichenkette 'true' als wahr betrachtet.
 * 
 * @param val mixed
 * @return boolean 
 */
function istrue( $val )
{
	if	( is_bool($val) )
		return $val;
	elseif( is_numeric($val) )
		return $val != 0;
	elseif( is_string($val) )
		return $val == 'true' || $val == 'yes' || $val == '1';
	else
		return false;
}

/**
 * Liefert den für die Ausgabe zu verwendenden Zeichensatz.
 * Falls konfiguriert, wird das Charset aus der DB-Konfiguration
 * genommen. Sonst das Charset aus der Sprachdatei.
 * 
 * @return Zeichensatz, z.B. "UTF-8", "ISO-8859-1".
 */
function charset()
{
	$db = db_connection();
	
	if	( isset($db->conf['charset']) )
		return $db->conf['charset'];
	else
		return lang('CHARSET');
}
?>