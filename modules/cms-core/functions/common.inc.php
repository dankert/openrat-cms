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
	// Gesamtes CMS ist readonly.
	if	( config('security','readonly') )
		return true;
		
	// Aktuelle Datenbankverbindung ist readonly.
	$db = db();
	if	( isset($db->conf['readonly']) && $db->conf['readonly'] )
		return true;
		
	return false;
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
 * Erzeugt einen Link auf die OpenRat-lokale CSS-Datei
 * @param $name Name der Style-Konfiguration. Default: 'default'.
 */
function css_link( $name='default' )
{
	global $conf;
	
	// Falls Style-Konfiguration unbekannt, dann Fallback auf default.
	if	( ! isset($conf['style'][$name]))
		$name = $conf['interface']['style']['default'];

	
	return encode_array($conf['style'][$name]);
}


/**
 * Encodiert ein Array für eine URL.
 * 
 * @param $args URL-Parameter
 */
function encode_array( $args )
{
	if	( !is_array($args) )
		return '';
		
	$out = array();
	
  	foreach( $args as $name => $value )
		$out[] = $name.'='.urlencode($value);
		
	return implode('&',$out);
}


function not($var) {
	return !$var;
}

/**
 * Liefert die Datenbankverbindung fuer die aktuelle Sitzung.
 *
 * @return \database\Database
 * @deprecated use db()
 */
function db_connection()
{

    return db();
}

/**
 * Liefert die Datenbankverbindung fuer die aktuelle Sitzung.
 *
 * @return \database\Database
 */
function db()
{

    $db = Session::getDatabase();

    if   ( ! is_object($db))
        throw new RuntimeException('no database available');

    return $db;
}




?>