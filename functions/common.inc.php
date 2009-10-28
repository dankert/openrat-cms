<?php


/**
 * Fügt einen Slash ("/") an das Ende an, sofern nicht bereits vorhanden.
 *
 * @param String $pfad
 * @return Pfad mit angehängtem Slash.
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
 * Erzeugt für eine Zahl eine Schreibweise mit Vorzeichen.<br>
 * '-2' bleibt '-2'<br>
 * '2'  wird zu '+2'<br>
 */
function vorzeichen( $nr )
{
	return intval($nr)<0 ? $nr : '+'.$nr;
}
?>