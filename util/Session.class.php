<?php
// ---------------------------------------------------------------------------
// $Id$
// ---------------------------------------------------------------------------
// OpenRat Content Management System
// Copyright (C) 2002-2004 Jan Dankert, cms@jandankert.de
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
	function get( $var )
	{
		global $SESS;
		if	( isset($SESS['ors_'.$var]) )
			return $SESS['ors_'.$var];
		else
			return '';
	}
	
	function set( $var,$value )
	{
		global $SESS;
		$SESS[ 'ors_'.$var ] = $value;
	}	



	function getConfig()
	{
		return Session::get('config');
	}
	
	function setConfig( $var )
	{
		Session::set('config',$var);
	}	



	function getProjectModel()
	{
		return Session::get('project_model');
	}
	
	function setProjectModel( $var )
	{
		Session::set('project_model',$var);
	}	



	function getProjectLanguage()
	{
		return Session::get('project_language');
	}
	
	function setProjectLanguage( $var )
	{
		Session::set('project_language',$var);
	}	



	function getObject()
	{
		return Session::get('object');
	}
	
	function setObject( $var )
	{
		Session::set('object',$var);
	}	



	function getFolder()
	{
		return Session::get('folder');
	}
	
	function setFolder( $var )
	{
		Session::set('folder',$var);
	}	



	function getTree()
	{
		return Session::get('tree');
	}
	
	function setTree( $var )
	{
		Session::set('tree',$var);
	}	



	function getElement()
	{
		return Session::get('element');
	}
	
	function setElement( $var )
	{
		Session::set('element',$var);
	}	



	function getProject()
	{
		return Session::get('project');
	}
	
	function setProject( $var )
	{
		Session::set('project',$var);
	}	



	function getUser()
	{
		return Session::get('userObject');
	}

	function setUser( $var )
	{
		Session::set('userObject',$var);
	}
	
	
	function getDatabase()
	{
		return Session::get('database');
	}

	function setDatabase( $var )
	{
		Session::set('database',$var);
	}
	
	
	function getSubaction()
	{
		return Session::get('subaction');
	}

	function setSubaction( $var )
	{
		Session::set('subaction',$var);
	}
	
	
	function getClipboard()
	{
		return Session::get('clipboard');
	}

	function setClipboard( $var )
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
	function close()
	{
		session_write_close();
	}	
}

?>