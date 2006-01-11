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
		if	( isset($SESS[$var]) )
			return $SESS[$var];
		else
			return '';
	}
	
	function set( $var,$value )
	{
		global $SESS;
		$SESS[ $var ] = $value;
	}	



	function getConfig()
	{
		global $SESS;
		if	( isset($SESS['config']) )
			return $SESS['config'];
		else
			return '';
	}
	
	function setConfig( $var )
	{
		global $SESS;
		$SESS['config'] = $var;
	}	



	function getProjectModel()
	{
		global $SESS;
		if	( isset($SESS['project_model']) )
			return $SESS['project_model'];
		else
			return '';
	}
	
	function setProjectModel( $var )
	{
		global $SESS;
		$SESS['project_model'] = $var;
	}	



	function getProjectLanguage()
	{
		global $SESS;
		if	( isset($SESS['project_language']) )
			return $SESS['project_language'];
		else
			return '';
	}
	
	function setProjectLanguage( $var )
	{
		global $SESS;
		$SESS['project_language'] = $var;
	}	



	function getObject()
	{
		global $SESS;
		if	( isset($SESS['object']) )
			return $SESS['object'];
		else
			return '';
	}
	
	function setObject( $var )
	{
		global $SESS;
		$SESS['object'] = $var;
	}	



	function getFolder()
	{
		global $SESS;
		if	( isset($SESS['folder']) )
			return $SESS['folder'];
		else
			return '';
	}
	
	function setFolder( $var )
	{
		global $SESS;
		$SESS['folder'] = $var;
	}	



	function getTree()
	{
		global $SESS;
		if	( isset($SESS['tree']) )
			return $SESS['tree'];
		else
			return '';
	}
	
	function setTree( $var )
	{
		global $SESS;
		$SESS['tree'] = $var;
	}	



	function getElement()
	{
		global $SESS;
		if	( isset($SESS['element']) )
			return $SESS['element'];
		else
			return '';
	}
	
	function setElement( $var )
	{
		global $SESS;
		$SESS['element'] = $var;
	}	



	function getProject()
	{
		global $SESS;
		if	( isset($SESS['project']) )
			return $SESS['project'];
		else
			return '';
	}
	
	function setProject( $var )
	{
		global $SESS;
		$SESS['project'] = $var;
	}	



	function getUser()
	{
		global $SESS;
		if	( isset($SESS['userObject']) )
			return $SESS['userObject'];
		else
			return '';
	}

	function setUser( $var )
	{
		global $SESS;
		$SESS['userObject'] = $var;
	}
	
	
	function getDatabase()
	{
		global $SESS;
		if	( isset($SESS['database']) )
			return $SESS['database'];
		else
			return '';
	}

	function setDatabase( $var )
	{
		global $SESS;
		$SESS['database'] = $var;
	}
	
	
	function getSubaction()
	{
		global $SESS;
		if	( isset($SESS['subaction']) )
			return $SESS['subaction'];
		else
			return '';
	}

	function setSubaction( $var )
	{
		global $SESS;
		$SESS['subaction'] = $var;
	}
	
	
	function getClipboard()
	{
		global $SESS;
		if	( isset($SESS['clipboard']) )
			return $SESS['clipboard'];
		else
			return '';
	}

	function setClipboard( $var )
	{
		global $SESS;
		$SESS['clipboard'] = $var;
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