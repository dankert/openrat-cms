<?php
// OpenRat Content Management System
// Copyright (C) 2002-2009 Jan Dankert, cms@jandankert.de
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; version 2.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.

namespace cms\base;

use ErrorException;
use logger\Logger;
use util\exception\ValidationException;

class Startup {

	private static $START_TIME;

	const MIN_VERSION = '5.4'; // minimum required PHP version.

	const IMG_EXT      = '.gif';
	const IMG_ICON_EXT = '.png';

	const HTML_MODULES_DIR = './modules/';
	const THEMES_DIR       = './modules/cms/ui/themes/';
	const CSS_PREFIX       = 'or-';

	const TITLE   = 'OpenRat CMS';
	const VERSION = Version::VERSION;
	const DATE    = Version::DATE;

	/**
	 * Initialize.
	 */
	public static function initialize()
	{
		self::checkPHPVersion();
		self::securityCheck();
		self::setErrorHandler();
		self::setStartTime();
		self::checkDatabaseDriver();
		self::checkMultibyteSupport();

		// in some situations we want to know, if the CMS is really started up.
		define('APP_STARTED','1');
	}

	protected static function checkPHPVersion()
	{
		if (version_compare(phpversion(), self::MIN_VERSION, "<"))
			throw new ErrorException('This version of PHP ' . phpversion() . ' is not supported any more. Minimum required: ' . self::MIN_VERSION);
	}


	protected static function checkDatabaseDriver() {
		if (!defined('PDO::ATTR_DRIVER_NAME')) {
			throw new ErrorException('PDO is not available');
		}
	}


	protected static function checkMultibyteSupport() {

		if   ( function_exists('mb_substr'          ) &&
			   function_exists('mb_convert_encoding')    )
			; // ok, Multibyte is available
		else
			throw new ErrorException('Multibyte functions are not available');
	}

	public static function getStartTime() {
		return self::$START_TIME;
	}


	protected static function setStartTime() {

		self::$START_TIME = time();
	}


	protected static function setErrorHandler() {

		/**
		 * Wandelt jeden Fehler in eine ErrorException um.
		 */
		$exceptionErrorHandler = function ($severity, $message, $file, $line) {
			if	( !(error_reporting() & $severity) )
			{
				// Dieser Fehlercode ist nicht in error_reporting enthalten
				return;
			}
			throw new ErrorException($message, 0, $severity, $file, $line);
		};

		set_error_handler($exceptionErrorHandler);


		/**
		 * Ermöglicht das Loggen von Fatal-Errors.
		 */
		$fatalHandler = function() {

			$error = error_get_last();

			if( !is_null($error) )
			{
				$errno   = $error["type"];
				$errfile = $error["file"];
				$errline = $error["line"];
				$errstr  = $error["message"];

				$message = 'Error '.$errno .' '. $errstr.' in '. $errfile.':'. $errline;
				if(class_exists('logger\Logger'))
					Logger::error( $message);
				else
				{
					error_log($message);
				}

				// It is not possibile to throw an exception out of a shutdown function!
				// PHP will exit the request directly after executing this method, so a
				// Exception would never reach a caller.
			}

		};

		register_shutdown_function( $fatalHandler );

	}


	/**
	 * Check for some stupid security impacts.
	 */
	protected static function securityCheck()
	{
		// REGISTER_GLOBALS
		// This feature has been DEPRECATED as of PHP 5.3.0 and REMOVED as of PHP 5.4.0.

		// MAGIC_QUOTES
		// This feature has been DEPRECATED as of PHP 5.3.0 and REMOVED as of PHP 5.4.0.
	}



	/**
	 * Stellt fest, ob das System in einem schreibgeschuetzten Zustand ist.
	 *
	 * @return boolean true, falls schreibgeschuetzt, sonst false
	 */
	public static function readonly() {

		// Gesamtes CMS ist readonly.
		if (Configuration::config('security', 'readonly'))
			return true;

		// Aktuelle Datenbankverbindung ist readonly.
		$db = DB::get();
		if (isset($db->conf['readonly']) && $db->conf['readonly'])
			return true;

		return false;
	}


	/**
	 * Ermittelt die aktuelle Systemzeit als Unix-Timestamp.<br>
	 * Unix-Timestamp ist immer bezogen auf GMT.
	 * -
	 * @return Unix-Timestamp der aktuellen Zeit
	 */
	public static function now()
	{
		return time();
	}


}
