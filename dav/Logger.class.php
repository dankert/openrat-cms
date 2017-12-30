<?php
// OpenRat Content Management System
// Copyright (C) 2002-2012 Jan Dankert, cms@jandankert.de
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


define('DAV_LOG_LEVEL_TRACE',5 );
define('DAV_LOG_LEVEL_DEBUG',4  );
define('DAV_LOG_LEVEL_INFO' ,3  );
define('DAV_LOG_LEVEL_WARN' ,2  );
define('DAV_LOG_LEVEL_ERROR',1  );

define('DAV_LOG_LEVEL', constant('DAV_LOG_LEVEL_'.strtoupper($config['log.level'])));


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
		if	( DAV_LOG_LEVEL >= DAV_LOG_LEVEL_TRACE )
			Logger::doLog( 'trace',$message );
	}


	/**
	 * Schreiben einer Debug-Meldung in die Logdatei
	 *
	 * @param message Log-Text
	 */
	function debug( $message )
	{
		if	( DAV_LOG_LEVEL >= DAV_LOG_LEVEL_DEBUG )
			Logger::doLog( 'debug',$message );
	}


	/**
	 * Schreiben einer Information in die Logdatei
	 *
	 * @param message Log-Text
	 */
	function info( $message )
	{
		if	( DAV_LOG_LEVEL >= DAV_LOG_LEVEL_INFO )
			Logger::doLog( 'info',$message );
	}


	/**
	 * Schreiben einer Warnung in die Logdatei
	 *
	 * @param message Log-Text
	 */
	function warn( $message )
	{
		if	( DAV_LOG_LEVEL >= DAV_LOG_LEVEL_WARN )
			Logger::doLog( 'warn',$message );
	}


	/**
	 * Schreiben einer normalen Fehlermeldung in die Logdatei
	 *
	 * @param message Log-Text
	 */
	function error( $message )
	{
		if	( DAV_LOG_LEVEL >= DAV_LOG_LEVEL_ERROR )
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
		global $config;
		
		$filename = $config['log.file'];

		if	( empty($filename) )
			return;

		if	( ! is_writable($filename) )
			throw new \LogicException( "logfile $filename is not writable by the server" );

		$thisLevel = strtoupper($facility);
		
		$text = "%time %level %host %action %text"; // Format der Logdatei

		// Ersetzen von Variablen
		$text = str_replace( '%host',getenv('REMOTE_ADDR'),$text );
		
		$action = strtoupper($_SERVER['REQUEST_METHOD']);
			
		$text = str_replace( '%level' ,str_pad($thisLevel,5),$text );
		$text = str_replace( '%agent' ,getenv('HTTP_USER_AGENT'),$text );
		$text = str_replace( '%action',str_pad($action,12),$text );
		$text = str_replace( '%text'  ,$message,$text );
		$text = str_replace( '%time'  ,date('M j H:i:s'),$text );
		$text = str_replace( "\n"     ,"\n ",$text );
		
		// Schreiben in Logdatei
		error_log( $text."\n",3,$filename );
	}
}

?>