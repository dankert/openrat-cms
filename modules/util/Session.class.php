<?php

// PHP-Versionsunabhaengiges Array fuer die Session-Variablen ermitteln
namespace util;

use cms\model\User;


/**
 * Session-Funktionen zum Lesen/Schreiben in/von HTTP-Session
 * In der Session werden folgende Daten abgelegt
 * - Angemeldeter Benutzer
 * - Datenbankobjekt
 * - Konfiguration
 * Die Methoden dieser Klassen koennen statisch aufgerufen werden.
 *
 * @author $Author$
 * @version $Revision$
 * @package openrat.service
 */
class Session
{
	const KEY_DBID = 'dbid';
	const KEY_DB = 'database';
	const KEY_USER = 'userObject';
	const KEY_CONFIG = 'config';
	const PRAEFIX = 'ors_';

	public static function get($var)
	{
		$SESS = &$_SESSION;

		if (isset($SESS[self::PRAEFIX . $var]))
			return $SESS[self::PRAEFIX . $var];
		else
			return '';
	}

	public static function set($var, $value)
	{
		$SESS = &$_SESSION;
		$SESS[self::PRAEFIX . $var] = $value;
	}


	/**
	 * @return array
	 */
	public static function getConfig()
	{
		return Session::get(self::KEY_CONFIG);
	}

	public static function setConfig($var)
	{
		Session::set(self::KEY_CONFIG, $var);
	}


	/**
	 * Liefert den Benutzer aus der Sitzung oder <code>null</code>, wenn kein Benutze angemeldet ist.
	 *
	 * @return User
	 */
	public static function getUser()
	{
		return Session::get(self::KEY_USER);
	}

	public static function setUser($var)
	{
		Session::set(self::KEY_USER, $var);
	}


	/**
	 * @return \database\Database
	 */
	public static function getDatabase()
	{
		return Session::get(self::KEY_DB);
	}

	public static function setDatabase($var)
	{
		Session::set(self::KEY_DB, $var);
	}


	/**
	 * @return String DB-Id
	 */
	public static function getDatabaseId()
	{
		return Session::get(self::KEY_DBID);
	}

	public static function setDatabaseId($var)
	{
		Session::set(self::KEY_DBID, $var);
	}


	/**
	 * Schliesst die aktuelle Session
	 *
	 * Diese Funktion sollte so schnell wie moeglich aufgerufen werden, da vorher
	 * keine andere Seite (im Frameset oder parallele AJAX-Requests) geladen werden kann
	 * Nach Aufruf dieser Methode sind keine Session-Zugriffe ueber diese Klasse mehr
	 * moeglich.
	 */
	public static function close()
	{
		session_write_close();
	}
}

?>