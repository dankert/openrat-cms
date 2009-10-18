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
 * Es wird konfigurationsgesteuert entweder die lokale Zeit oder
 * die GMT-Zeit (UTC) zurückgegeben.<br>
 * Konfigurationsschalter ist 'date/database/utc'.
 * - 
 * @return Unix-Timestamp der aktuellen Zeit
 */
function now()
{
	global $conf;
	
	if	( @$conf['date']['database']['utc'] )
		return gmdate('U');
	else
		return time();
}
?>