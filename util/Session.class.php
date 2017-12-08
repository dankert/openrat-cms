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


// PHP-Versionsunabhaengiges Array fuer die Session-Variablen ermitteln
use cms\model\User;

if	(isset($_SESSION))
	$SESS = &$_SESSION;
else $SESS = &$HTTP_SESSION_VARS;

if	( isset($_FILES) )
	$FILES = &$_FILES;
else $FILES = &$HTTP_POST_FILES;


/**
 * Session-Funktionen zum Lesen/Schreiben in/von HTTP-Session
 * In der Session werden folgende Daten abgelegt
 * - Ausgewaehltes Projekt
 * - Ausgewaehlte Projectsprache
 * - Ausgewaehlte Projektvariante
 * - Angemeldeter Benutzer
 * - Auswahlbaum
 * - Geladene Sprachelemente
 * - Ausgewaehlter Ordner
 * - Ausgewaehltes Objekt
 * - Datenbankobjekt
 * Die Methoden dieser Klassen koennen statisch aufgerufen werden
 *
 * @author $Author$
 * @version $Revision$
 * @package openrat.service
 */

class Session
{
	public static function get( $var )
	{
		global $SESS;
		if	( isset($SESS['ors_'.$var]) )
			return $SESS['ors_'.$var];
		else
			return '';
	}

    public static function set( $var,$value )
	{
		global $SESS;
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
     * @return \cms\model\Model
     */
    public static function getProjectModel()
	{
		return Session::get('project_model');
	}

    public static function setProjectModel( $var )
	{
		Session::set('project_model',$var);
	}


    /**
     * @return \cms\model\Language
     */
    public static function getProjectLanguage()
	{
		return Session::get('project_language');
	}

    public static function setProjectLanguage( $var )
	{
		Session::set('project_language',$var);
	}



    public static function getObject()
	{
		return Session::get('object');
	}

    public static function setObject( $var )
	{
		Session::set('object',$var);
	}


    /**
     * @return \cms\model\Folder
     */
    public static function getFolder()
	{
		return Session::get('folder');
	}

    public static function setFolder( $var )
	{
		Session::set('folder',$var);
	}



    public static function getTree()
	{
		return Session::get('tree');
	}

    public static function setTree( $var )
	{
		Session::set('tree',$var);
	}	



	public static function getElement()
	{
		return Session::get('element');
	}

    public static function setElement( $var )
	{
		Session::set('element',$var);
	}


    /**
     * @return \cms\model\Project
     */
    public static function getProject()
	{
		return Session::get('project');
	}

    public static function setProject( $var )
	{
		Session::set('project',$var);
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
     * @return string
     */
    public static function getSubaction()
	{
		return Session::get('subaction');
	}

    public static function setSubaction( $var )
	{
		Session::set('subaction',$var);
	}


    public static function getClipboard()
	{
		return Session::get('clipboard');
	}

    public static function setClipboard( $var )
	{
		Session::set('clipboard',$var);
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