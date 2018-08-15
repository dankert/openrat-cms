<?php

// PHP-Versionsunabhaengiges Array fuer die Session-Variablen ermitteln
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
	public static function get( $var )
	{
        $SESS = &$_SESSION;

        if	( isset($SESS['ors_'.$var]) )
			return $SESS['ors_'.$var];
		else
			return '';
	}

    public static function set( $var,$value )
	{
        $SESS = &$_SESSION;
        $SESS[ 'ors_'.$var ] = $value;
	}


    /**
     * @return array
     */
    public static function getConfig()
	{
		return Session::get('config');
	}

    public static function setConfig( $var )
	{
		Session::set('config',$var);
	}


    /**
     * @return User
     */
    public static function getUser()
	{
		return Session::get('userObject');
	}

    public static function setUser( $var )
	{
		Session::set('userObject',$var);
	}


    /**
     * @return \database\Database
     */
    public static function getDatabase()
	{
		return Session::get('database');
	}

    public static function setDatabase( $var )
	{
		Session::set('database',$var);
	}


	/**
	 * Schliesst die aktuelle Session
	 * 
	 * Diese Funktion sollte so schnell wie moeglich aufgerufen werden, da vorher
	 * keine andere Seite (im Frameset!) geladen werden kann
	 * Nach Aufruf dieser Methode sind keine Session-Zugriffe ueber diese Klasse mehr
	 * moeglich.
	 */
    public static function close()
	{
		session_write_close();
	}	
}

?>