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
// Revision 1.5  2007-11-08 21:32:06  dankert
// Aktion-Name mitloggen.
//
// Revision 1.4  2004/11/10 22:50:37  dankert
// Benutzen von Konstanten zur Performancesteigerung
//
// Revision 1.3  2004/10/04 19:57:17  dankert
// Bugfix und trace()
//
// Revision 1.2  2004/05/02 15:04:16  dankert
// Einf?gen package-name (@package)
//
// Revision 1.1  2004/04/24 17:03:28  dankert
// Initiale Version
//
// ---------------------------------------------------------------------------


switch( strtolower($conf['log']['level']) )
{
	case 'trace':
		define('OR_LOG_LEVEL_TRACE',true );

	case 'debug':
		define('OR_LOG_LEVEL_DEBUG',true );

	case 'info':
		define('OR_LOG_LEVEL_INFO' ,true );

	case 'warn':
		define('OR_LOG_LEVEL_WARN' ,true );

	case 'error':
		define('OR_LOG_LEVEL_ERROR',true );
}

if	( !defined('OR_LOG_LEVEL_TRACE') ) define('OR_LOG_LEVEL_TRACE',false );
if	( !defined('OR_LOG_LEVEL_DEBUG') ) define('OR_LOG_LEVEL_DEBUG',false );
if	( !defined('OR_LOG_LEVEL_INFO' ) ) define('OR_LOG_LEVEL_INFO' ,false );
if	( !defined('OR_LOG_LEVEL_WARN' ) ) define('OR_LOG_LEVEL_WARN' ,false );
if	( !defined('OR_LOG_LEVEL_ERROR') ) define('OR_LOG_LEVEL_ERROR',false );



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
		if	( OR_LOG_LEVEL_TRACE )
			Logger::doLog( 'trace',$message );
	}


	/**
	 * Schreiben einer Debug-Meldung in die Logdatei
	 *
	 * @param message Log-Text
	 */
	function debug( $message )
	{
		if	( OR_LOG_LEVEL_DEBUG )
			Logger::doLog( 'debug',$message );
	}


	/**
	 * Schreiben einer Information in die Logdatei
	 *
	 * @param message Log-Text
	 */
	function info( $message )
	{
		if	( OR_LOG_LEVEL_INFO )
			Logger::doLog( 'info',$message );
	}


	/**
	 * Schreiben einer Warnung in die Logdatei
	 *
	 * @param message Log-Text
	 */
	function warn( $message )
	{
		if	( OR_LOG_LEVEL_WARN )
			Logger::doLog( 'warn',$message );
	}


	/**
	 * Schreiben einer normalen Fehlermeldung in die Logdatei
	 *
	 * @param message Log-Text
	 */
	function error( $message )
	{
		if	( OR_LOG_LEVEL_ERROR )
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
			Http::serverError( "logfile $filename is not writable by the server" );

		$thisLevel = strtoupper($facility);
		
		$user = Session::getUser();
		if	( is_object($user) )
			$username = $user->name;
		else
			$username = '-';
	
		$text = $conf['log']['format']; // Format der Logdatei lesen

		// Ersetzen von Variablen
		if   ( $conf['log']['dns_lookup'] )
			$text = str_replace( '%host',gethostbyaddr(getenv('REMOTE_ADDR')),$text );
		else
			$text = str_replace( '%host',getenv('REMOTE_ADDR'),$text );
		
		$action = Session::get('action');
		if	( empty($action) )
			$action = '-';

		$action = Session::get('action');
		if	( empty($action) )
			$action = '-';
			
		$text = str_replace( '%user'  ,str_pad($username ,8),$text );
		$text = str_replace( '%level' ,str_pad($thisLevel,5),$text );
		$text = str_replace( '%agent' ,getenv('HTTP_USER_AGENT'),$text );
		$text = str_replace( '%action',str_pad($action,12),$text );
		$text = str_replace( '%text'  ,$message,$text );
		$text = str_replace( '%time'  ,date($conf['log']['date_format']),$text );
		$text = str_replace( "\n"     ,"\n ",$text );
		
		// Schreiben in Logdatei
		error_log( $text."\n",3,$filename );
	}
}

?>