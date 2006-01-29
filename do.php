<?php
// ---------------------------------------------------------------------------
// $Id$
// ---------------------------------------------------------------------------
// DaCMS Content Management System
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
// Revision 1.22  2006-01-29 18:59:31  dankert
// UMASK aus Konfiguration lesen und setzen.
//
// Revision 1.21  2006/01/29 17:33:56  dankert
// Bugfix: Ermitteln Subaction-Namen
//
// Revision 1.20  2006/01/23 23:03:21  dankert
// Auswerten von ini-Dateien pro Aktionsklasse
//
// Revision 1.19  2006/01/11 22:25:24  dankert
// Einzelne include-Anweisungen pro Verzeichnis, Konfiguration als Baum einlesen
//
// Revision 1.18  2005/11/02 21:16:23  dankert
// Aenderungen fuer Textauszeichnungen
//
// Revision 1.17  2005/04/16 22:28:05  dankert
// Erweiterung fuer Formularklassen (Test)
//
// Revision 1.16  2005/01/27 00:07:10  dankert
// Einbinden von transformer.class
//
// Revision 1.15  2004/12/30 21:44:37  dankert
// Speichern der Subaction
//
// Revision 1.14  2004/12/26 21:56:31  dankert
// Startzeit merken, Time-Limit setzen
//
// Revision 1.13  2004/12/25 20:50:54  dankert
// Version geaendert (Konstante)
//
// Revision 1.12  2004/12/19 15:27:51  dankert
// Korrektur Variablen fuer Mime-Types, Datumformate
//
// Revision 1.11  2004/12/18 00:34:33  dankert
// Anpassung Lesen der Konfiguration
//
// Revision 1.10  2004/12/15 23:11:41  dankert
// aufgeraeumt
//
// Revision 1.9  2004/12/13 22:55:41  dankert
// Neue Konstanten, Lesen der DB-Config aus mehreren Dateien
//
// Revision 1.8  2004/11/27 13:12:26  dankert
// Erzeugen object-Objekt wenn Parameter "objectid" vorhanden
//
// Revision 1.7  2004/11/24 21:31:44  dankert
// Wenn Subaction nicht vorhanden, dann immer default-Subaction aufrufen
//
// Revision 1.6  2004/11/10 22:52:53  dankert
// Reihenfolge beim Include von Dateien korrigiert
//
// Revision 1.5  2004/10/04 19:56:56  dankert
// trace() hinzugef?gt
//
// Revision 1.4  2004/09/07 21:10:18  dankert
// Klassendefinitionsdateien vor dem Start der Session einbinden
//
// Revision 1.3  2004/05/02 18:40:46  dankert
// Konfiguration aus /etc lesen (wenn vorhanden)
//
// Revision 1.2  2004/04/24 15:17:19  dankert
// div. Erweiterungen
//
// Revision 1.1  2004/04/16 22:58:06  dankert
// Controller
// ---------------------------------------------------------------------------

define('PHP_EXT'         ,'php'    );
define('IMG_EXT'         ,'.gif'   );
define('IMG_ICON_EXT'    ,'.png'   );
define('MAX_FOLDER_DEPTH',5        );
define('OR_CONFIG_DIR'   ,'config' );
define('OR_VERSION'      ,'0.4'    );
define('OR_TITLE'        ,'OpenRat');

define('OR_TYPE_PAGE'  ,'page'  );
define('OR_TYPE_FILE'  ,'file'  );
define('OR_TYPE_LINK'  ,'link'  );
define('OR_TYPE_FOLDER','folder');

define('OR_ACTIONCLASSES_DIR' ,'./actionClasses/'  );
define('OR_FORMCLASSES_DIR'   ,'./formClasses/'    );
define('OR_OBJECTCLASSES_DIR' ,'./objectClasses/'  );
define('OR_SERVICECLASSES_DIR','./serviceClasses/' );
define('OR_LANGUAGE_DIR'      ,'./config/language/');
define('OR_DBCLASSES_DIR'     ,'./db/'             );
define('OR_DYNAMICCLASSES_DIR','./dynamicClasses/' );
define('OR_TEXTCLASSES_DIR'   ,'./textClasses/'    );
define('OR_PREFERENCES_DIR'   ,'./config/openrat-cms/');
define('OR_THEMES_DIR'        ,'./themes/'         );
define('OR_TMP_DIR'           ,'./tmp/'            );
define('START_TIME'           ,time()              );

require_once( OR_SERVICECLASSES_DIR."include.inc.".PHP_EXT );

require_once( OR_OBJECTCLASSES_DIR."include.inc.".PHP_EXT );
require_once( OR_TEXTCLASSES_DIR."include.inc.".PHP_EXT );

require_once( OR_DBCLASSES_DIR."db.class.php" );
require_once( OR_DBCLASSES_DIR."postgresql.class.php" );
require_once( OR_DBCLASSES_DIR."mysql.class.php" );

session_start();

require_once( "functions/request.inc.php" );

require_once( OR_SERVICECLASSES_DIR."Session.class.".PHP_EXT );

$conf = Session::getConfig();
 
// Wenn Konfiguration noch nicht in Session vorhanden, dann
// aus Datei lesen.
if	( !is_array( $conf ) )
{
	$prefs = new Preferences();
	$conf = $prefs->load();
	
	// Sprache lesen und zur Konfiguration hinzufuegen

	if	( $conf['i18n']['use_http'] )
		// Die vom Browser angeforderten Sprachen ermitteln     
		$languages = Http::getLanguages();
	else
		// Nur Default-Sprache erlauben
		$languages = array();

	// Default-Sprache hinzufuegen.
	// Wird dann verwendet, wenn die vom Browser angeforderten Sprachen
	// nicht vorhanden sind
	$languages[] = $conf['i18n']['default'];

	foreach( $languages as $l )
	{
//		$l = substr($l,0,2);

		// Pruefen, ob Sprache vorhanden ist.
		$langFile = OR_LANGUAGE_DIR.$l.'.ini.'.PHP_EXT;

		if	( file_exists( $langFile ) )
		{
			$conf['language'] = parse_ini_file( $langFile );
			break;
		}
	}
	
	$langDefaultFile = OR_LANGUAGE_DIR.$conf['i18n']['complete_from'].'.ini.'.PHP_EXT;
	if	( file_exists( $langDefaultFile ) )
	{
		$conf['language'] = array_merge( parse_ini_file( $langDefaultFile ),$conf['language']);
	}
	

	if	( !isset($conf['language']) )
		die( 'no language found! (languages='.implode(',',$languages).')' );
	
	Session::setConfig( $conf );
}

umask( $conf['security']['umask'] );

if	( !empty($conf['interface']['timeout']) )
	set_time_limit( intval($conf['interface']['timeout']) );

define('FILE_SEP',$conf['interface']['file_separator']);

define('REQ_PARAM_ACTION'       ,'action'       );
define('REQ_PARAM_SUBACTION'    ,'subaction'    );
define('REQ_PARAM_ID'           ,'id'           );

define('TEMPLATE_DIR',OR_THEMES_DIR.$conf['interface']['theme'].'/templates');
define('CSS_DIR'     ,OR_THEMES_DIR.$conf['interface']['theme'].'/css'      );
define('IMAGE_DIR'   ,OR_THEMES_DIR.$conf['interface']['theme'].'/images'   );

require_once( OR_SERVICECLASSES_DIR."Logger.class.".PHP_EXT );
require_once( "functions/config.inc.php" );
require_once( "functions/language.inc.".PHP_EXT );
require_once( "functions/theme.inc.".PHP_EXT );
require_once( "functions/db.inc.".PHP_EXT );

// Request-Variablen in Session speichern
//request_into_session('action'    );
//request_into_session('subaction' );
//request_into_session('objectid'  );
//request_into_session('templateid');
//request_into_session('elementid' );
//request_into_session('projectid' );
//request_into_session('modelid'   );
//request_into_session('userid'    );
//request_into_session('groupid'   );
//request_into_session('languageid');

//if	( isset($REQ['objectid']) )
//{
//	$o = new Object( $REQ['objectid'] );
//	Session::setObject($o);
//}

// Verbindung zur Datenbank
//
$db = Session::getDatabase();
if	( is_object( $db ) )
{
	$db->connect();
	Session::setDatabase( $db );
}
	
if	( !empty($REQ[REQ_PARAM_ACTION]) )
	$action = $REQ[REQ_PARAM_ACTION];
else	$action = 'index';

if	( !empty( $REQ[REQ_PARAM_SUBACTION] ) )
	$subaction = $REQ[REQ_PARAM_SUBACTION];
else
{
	if	( in_array($action,array('page','file','link','folder')))
		$subaction = Session::getSubaction();
	else
		$subaction = '';
}

$actionClassName = strtoupper(substr($action,0,1)).substr($action,1).'Action';

require( OR_ACTIONCLASSES_DIR.'/Action.class.php' );
require( OR_ACTIONCLASSES_DIR.'/ObjectAction.class.php' );
require( OR_ACTIONCLASSES_DIR.'/'.$actionClassName.'.class.php' );

$do = new $actionClassName;
$do->actionClassName = $actionClassName; 
$do->actionName      = $action;

$do->actionConfig = parse_ini_file( OR_ACTIONCLASSES_DIR.$actionClassName.'.ini.php',true);

if	( $subaction == '' )
	$subaction = $do->actionConfig['default']['goto'];

if	( !isset($do->actionConfig[$subaction]) )
	die( "Action $action has no configured method named $subaction");
	
Logger::trace("controller is calling subaction '$subaction'");

if	( in_array($action,array('page','file','link','folder')) )
	Session::setSubaction( $subaction );

$do->subActionName = $subaction;
$do->$subaction();

if	( isset($do->actionConfig[$do->subActionName]['goto']) )
{
	$subActionName     = $do->actionConfig[$do->subActionName]['goto'];
	$do->subActionName = $subActionName;
	Logger::trace("controller is calling next subaction '$subActionName'");
	$do->$subActionName();
}

$do->setMenu();
$do->forward();

?>