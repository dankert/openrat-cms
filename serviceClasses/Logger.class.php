<?php
// ---------------------------------------------------------------------------
// $Id$
// ---------------------------------------------------------------------------
// OpenRat Content Management System
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
// Revision 1.3  2004-10-04 19:57:17  dankert
// Bugfix und trace()
//
// Revision 1.2  2004/05/02 15:04:16  dankert
// Einf?gen package-name (@package)
//
// Revision 1.1  2004/04/24 17:03:28  dankert
// Initiale Version
//
// ---------------------------------------------------------------------------


define('OR_LOG_LEVEL_TRACE',1);
define('OR_LOG_LEVEL_DEBUG',2);
define('OR_LOG_LEVEL_INFO' ,3);
define('OR_LOG_LEVEL_WARN' ,4);
define('OR_LOG_LEVEL_ERROR',5);

/**
 * Schreiben eines Eintrages in die Logdatei
 *
 * @author $Author$
 * @version $Rev: $
 * @package openrat.services
 */
class Logger
{
	/**
	 * Schreiben einer Trace-Meldung in die Logdatei
	 *
	 * @param message Log-Text
	 */
	function trace( $message )
	{
		Logger::doLog( 'trace',$message );
	}


	/**
	 * Schreiben einer Debug-Meldung in die Logdatei
	 *
	 * @param message Log-Text
	 */
	function debug( $message )
	{
		Logger::doLog( 'debug',$message );
	}


	/**
	 * Schreiben einer Information in die Logdatei
	 *
	 * @param message Log-Text
	 */
	function info( $message )
	{
		Logger::doLog( 'info',$message );
	}


	/**
	 * Schreiben einer Warnung in die Logdatei
	 *
	 * @param message Log-Text
	 */
	function warn( $message )
	{
		Logger::doLog( 'warn',$message );
	}


	/**
	 * Schreiben einer normalen Fehlermeldung in die Logdatei
	 *
	 * @param message Log-Text
	 */
	function error( $message )
	{
		Logger::doLog( 'error',$message );
	}


	/**
	 * Schreiben der Meldung in die Logdatei
	 *
	 * @author $Author$
	 * @param facility Schwere dieses Logdatei-Eintrages (z.B. warning)
	 * @param message Log-Text
	 * @access private
	 */
	function doLog( $facility,$message )
	{
		global $conf;
		global $SESS;
		
		$filename = $conf['log']['file'];

		if	( $filename == '' )
			return;

		if	( ! is_writable($filename) )
			die( "logfile $filename is not writable by the server" );

		$confLevel         = strtoupper($conf['log']['level']);
		$confLevelConstant = 'OR_LOG_LEVEL_'.$confLevel;

		if	( !defined($confLevelConstant) )
			die( "unknown log level '$confLevel' in config" );

		$thisLevel         = strtoupper($facility);
		$thisLevelConstant = 'OR_LOG_LEVEL_'.$thisLevel;

		if	( !defined($thisLevelConstant) )
			die( "unknown log level '$thisLevel' in parameter" );


		// Wenn konfiguriertes Mindest-Loglevel nicht erreicht, dann Return
		if	( constant($confLevelConstant) > constant($confLevelConstant) )
			return;
		
		if	( isset($SESS['user']) )
			$username = $SESS['user']['name'];
		else	$username = 'unknown';
	
		$text = $conf['log']['format']; // Format der Logdatei lesen

		// Ersetzen von Variablen
		if   ( $conf['log']['dns_lookup'] )
			$text = str_replace( '%host',gethostbyaddr(getenv('REMOTE_ADDR')),$text );
		else	$text = str_replace( '%host',getenv('REMOTE_ADDR'),$text );
		
		if	( isset( $SESS['action'] ) )
			$action = $SESS['action'];
		else
			$action = 'n/a';
		$text = str_replace( '%user'  ,str_pad($username ,8),$text );
		$text = str_replace( '%level' ,str_pad($thisLevel,5),$text );
		$text = str_replace( '%agent' ,getenv('HTTP_USER_AGENT'),$text );
		$text = str_replace( '%action',str_pad($action,12),$text );
		$text = str_replace( '%text'  ,$message,$text );
		$text = str_replace( '%time'  ,date($conf['log']['date_format']),$text );

		// Schreiben in Logdatei
		error_log( $text."\n",3,$filename );
	}
}

?>