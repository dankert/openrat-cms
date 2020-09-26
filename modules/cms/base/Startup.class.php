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

	const MIN_VERSION = '5.4';

	/**
	 * Initialize.
	 */
	public static function initialize()
	{
		self::checkPHPVersion();
		self::securityCheck();
		self::setErrorHandler();
		self::setConstants();
		self::createRequest();

		//require __DIR__.'/Language.class.php';
		require __DIR__.'/Configuration.class.php';
		Language::registerFunctions();
		\Configuration::registerFunctions();
	}

	public static function checkPHPVersion()
	{
		if (version_compare(phpversion(), self::MIN_VERSION, "<"))
			throw new ErrorException('This version of PHP ' . phpversion() . ' is not supported any more. Minimum required: ' . self::MIN_VERSION);
	}


	public static function setConstants() {

		define('PHP_EXT', 'php');

		define('IMG_EXT', '.gif');
		define('IMG_ICON_EXT', '.png');

		require(__DIR__ . '/version.php');
		define('OR_TITLE', 'OpenRat CMS');

		define('CMS_ROOT_DIR', __DIR__ . '/../../../');

		define('OR_MODULES_DIR', __DIR__ . '/../../');
		define('OR_DYNAMICCLASSES_DIR', OR_MODULES_DIR . 'cms/macros/macro/');
		define('OR_SERVICECLASSES_DIR', OR_MODULES_DIR . 'util/');
		define('OR_AUTHCLASSES_DIR', OR_MODULES_DIR . 'cms/auth/');
		define('OR_TMP_DIR', CMS_ROOT_DIR . 'tmp/');

		define('START_TIME', time());
		define('REQUEST_ID', 'req0'); // Nicht mehr notwendig, kann entfallen.

// Must be relative to HTML-Path!
		define('OR_HTML_MODULES_DIR', './modules/');
		define('OR_THEMES_DIR', OR_HTML_MODULES_DIR . 'cms/ui/themes/');
	}


	public static function setErrorHandler() {

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


	public static function securityCheck()
	{
		// REGISTER_GLOBALS
		// This feature has been DEPRECATED as of PHP 5.3.0 and REMOVED as of PHP 5.4.0.
		if (ini_get('register_globals'))
			Logger::warn("REGISTER_GLOBALS is active. For security reasons: DO NOT USE THIS!");

		// MAGIC_QUOTES
		// This feature has been DEPRECATED as of PHP 5.3.0 and REMOVED as of PHP 5.4.0.
		// always returns FALSE as of PHP 5.4.0.
		if (get_magic_quotes_gpc() == 1)
			Logger::warn("MAGIC_QUOTES is active. For security reasons: DO NOT USE THIS!");
	}


	public static function createRequest()
	{
		// TODO: We should use $_REQUEST everywhere.
		global $REQ;
		$REQ = array_merge($_GET, $_POST);
	}


	/**
	 * Stellt fest, ob das System in einem schreibgeschuetzten Zustand ist.
	 *
	 * @return boolean true, falls schreibgeschuetzt, sonst false
	 */
	public static function readonly() {

		// Gesamtes CMS ist readonly.
		if (config('security', 'readonly'))
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
	function now()
	{
		return time();
	}


}
