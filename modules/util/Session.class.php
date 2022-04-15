<?php

// PHP-Versionsunabhaengiges Array fuer die Session-Variablen ermitteln
namespace util;

use cms\model\User;
use security\Password;


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
	const KEY_OIDC_PROVIDER = 'oidc_provider';
	const KEY_DBID = 'dbid';
	const KEY_DB = 'database';
	const KEY_USER = 'userObject';
	const KEY_CONFIG = 'config';
	const KEY_PASSWORD_COMMIT_CODE = 'password_commit_code';
	const KEY_PASSWORD_COMMIT_NAME = 'password_commit_name';
	const KEY_REGISTER_CODE = 'register_code';
	const KEY_REGISTER_MAIL = 'register_mail';
	const KEY_MAIL_CHANGE_CODE = 'mail_change_code';
	const KEY_MAIL_CHANGE_MAIL = 'mail_change_mail';
	const KEY_TOKEN            = 'token';

	const PRAEFIX = 'ors_';

	private static $sessionStarted;

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
		self::$sessionStarted = false;
	}


	public static function token() {
		return self::get( self::KEY_TOKEN );
	}


    public static function start()
    {
		// Start the session.
		session_name(getenv('CMS_SESSION_NAME') ?: 'or_sid');
		session_start();

		if   ( ! self::token() )
			self::set( self::KEY_TOKEN,Password::randomHexString(15 ) );

		self::$sessionStarted = true;
	}
}

