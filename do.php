<?php
// ---------------------------------------------------------------------------
// $Id$
// ---------------------------------------------------------------------------
// OpenRat Content Management System
// Copyright (C) 2002-2004 Jan Dankert, cms@jandankert.de
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
// ---------------------------------------------------------------------------

// "Single Entry Point"
// Diese Datei dient als "Dispatcher" und startet den zum Request passenden Controller ("*Action")..
// Jeder Request in der Anwendung läuft durch dieses Skript.
//
// Statische Resourcen (CSS,JS,Bilder,...) gehen nicht über diesen Dispatcher, sondern werden
// direkt geladen.


define('PHP_EXT'         ,'php'    );
require_once( "functions/common.inc.".PHP_EXT );

define('IMG_EXT'         ,'.gif'   );
define('IMG_ICON_EXT'    ,'.png'   );
define('MAX_FOLDER_DEPTH',5        );

define('OR_VERSION'      ,'0.9-3'  );
define('OR_TITLE'        ,'OpenRat CMS');

define('OR_TYPE_PAGE'  ,'page'  );
define('OR_TYPE_FILE'  ,'file'  );
define('OR_TYPE_LINK'  ,'link'  );
define('OR_TYPE_FOLDER','folder');

define('OR_ACTIONCLASSES_DIR' ,'./actionClasses/'  );
define('OR_FORMCLASSES_DIR'   ,'./formClasses/'    );
define('OR_OBJECTCLASSES_DIR' ,'./objectClasses/'  );
define('OR_SERVICECLASSES_DIR','./serviceClasses/' );
define('OR_LANGUAGE_DIR'      ,'./language/'       );
define('OR_DBCLASSES_DIR'     ,'./db/'             );
define('OR_DYNAMICCLASSES_DIR','./dynamicClasses/' );
define('OR_TEXTCLASSES_DIR'   ,'./textClasses/'    );
define('OR_PREFERENCES_DIR'   ,defined('OR_EXT_CONFIG_DIR')?OR_EXT_CONFIG_DIR:'./config/');
define('OR_CONFIG_DIR'        ,OR_PREFERENCES_DIR  );
define('OR_THEMES_DIR'        ,'./themes/'         );
define('OR_THEMES_EXT_DIR'    ,defined('OR_BASE_URL')?slashify(OR_BASE_URL).'themes/':OR_THEMES_DIR);
define('OR_TMP_DIR'           ,'./tmp/'            );
define('OR_CONTROLLER_FILE'   ,defined('OR_EXT_CONTROLLER_FILE')?OR_EXT_CONTROLLER_FILE:'do');
define('START_TIME'           ,time()              );

define('REQ_PARAM_ACTION'         ,'action'         );
define('REQ_PARAM_SUBACTION'      ,'subaction'      );
define('REQ_PARAM_TARGETSUBACTION','targetSubAction');
define('REQ_PARAM_ID'             ,'id'             );
define('REQ_PARAM_OBJECT_ID'      ,'objectid'       );
define('REQ_PARAM_LANGUAGE_ID'    ,'languageid'     );
define('REQ_PARAM_MODEL_ID'       ,'modelid'        );
define('REQ_PARAM_PROJECT_ID'     ,'projectid'      );
define('REQ_PARAM_ELEMENT_ID'     ,'elementid'      );
define('REQ_PARAM_TEMPLATE_ID'    ,'templateid'     );
define('REQ_PARAM_DATABASE_ID'    ,'dbid'           );

require_once( "functions/request.inc.php" );

// Werkzeugklassen einbinden.
require_once( OR_SERVICECLASSES_DIR."include.inc.".PHP_EXT );
require_once( OR_OBJECTCLASSES_DIR ."include.inc.".PHP_EXT );
require_once( OR_TEXTCLASSES_DIR   ."include.inc.".PHP_EXT );

// Datenbank-Funktionen einbinden.
require_once( OR_DBCLASSES_DIR."db.class.php" );
require_once( OR_DBCLASSES_DIR."postgresql.class.php" );
require_once( OR_DBCLASSES_DIR."mysql.class.php" );
require_once( OR_DBCLASSES_DIR."mysqli.class.php" );
require_once( OR_DBCLASSES_DIR."sqlite.class.php" );
require_once( OR_DBCLASSES_DIR."sqlite3.class.php" );
require_once( OR_DBCLASSES_DIR."pdo.class.php" );

// Jetzt erst die Sitzung starten (nachdem alle Klassen zur Verfügung stehen).
session_start();
require_once( OR_SERVICECLASSES_DIR."Session.class.".PHP_EXT );


// Vorhandene Konfiguration aus der Sitzung lesen.
$conf = Session::getConfig();
 
// Wenn Konfiguration noch nicht in Session vorhanden, dann
// aus Datei lesen.
if	( !is_array( $conf ) || isset($REQ['reload']) )
{
	// Da die Konfiguration neu eingelesen wird, sollten wir auch die Sitzung komplett leeren.
	session_unset();
	
	$prefs = new Preferences();
	$conf = $prefs->load();
	$conf['action'] = $prefs->load(OR_ACTIONCLASSES_DIR);
	
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
	$available = explode(',',$conf['i18n']['available']);

	foreach( $languages as $l )
	{
		if	( !in_array($l,$available) )
			continue;

		// Pruefen, ob Sprache vorhanden ist.
		$langFile = OR_LANGUAGE_DIR.$l.'.ini.'.PHP_EXT;

		if	( !file_exists( $langFile ) )
			Http::serverError("File does not exist: ".$langFile);

		$conf['language'] = parse_ini_file( $langFile );
		$conf['language']['language_code'] = $l;
		break;
	}


	if	( !isset($conf['language']) )
		Http::serverError('no language found! (languages='.implode(',',$languages).')' );
	
	// Schreibt die Konfiguration in die Sitzung. Diese wird anschliessend nicht
	// mehr veraendert.
	Session::setConfig( $conf );
}

if	( !empty($conf['security']['umask']) )
	umask( octdec($conf['security']['umask']) );

if	( !empty($conf['interface']['timeout']) )
	set_time_limit( intval($conf['interface']['timeout']) );

define('FILE_SEP',$conf['interface']['file_separator']);

define('TEMPLATE_DIR',OR_THEMES_DIR.$conf['interface']['theme'].'/templates');
define('CSS_DIR'     ,OR_THEMES_DIR.$conf['interface']['theme'].'/css'      );
define('IMAGE_DIR'   ,OR_THEMES_DIR.$conf['interface']['theme'].'/images'   );

require_once( OR_SERVICECLASSES_DIR."Logger.class.".PHP_EXT );
require_once( "functions/config.inc.php" );
require_once( "functions/language.inc.".PHP_EXT );
require_once( "functions/theme.inc.".PHP_EXT );
require_once( "functions/db.inc.".PHP_EXT );

header( 'Content-Type: text/html; charset='.lang('CHARSET') );

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
	$ok = $db->connect();
	if	( !$ok )
		Http::sendStatus('503','Service Unavailable','Database is not available: '.$db->error);

	Session::setDatabase( $db );
}
	
if	( !empty($REQ[REQ_PARAM_ACTION]) )
	$action = $REQ[REQ_PARAM_ACTION];
else	$action = 'index';

Session::set('action',$action);

if	( !empty( $REQ[REQ_PARAM_SUBACTION] ) )
	$subaction = $REQ[REQ_PARAM_SUBACTION];
else
{
	$sl = Session::getSubaction();
	if	( is_array($sl) && isset($sl[$action]) )
		$subaction = $sl[$action];
	else
		$subaction = '';
}

$actionClassName = strtoupper(substr($action,0,1)).substr($action,1).'Action';

if	( !isset($conf['action'][$actionClassName]) )
	Http::serverError("Action '$action' is undefined.");

require( OR_ACTIONCLASSES_DIR.'/Action.class.php' );
require( OR_ACTIONCLASSES_DIR.'/ObjectAction.class.php' );
require( OR_ACTIONCLASSES_DIR.'/'.$actionClassName.'.class.php' );

// Erzeugen der Action-Klasse
$do = new $actionClassName;
$do->actionConfig = $conf['action'][$actionClassName];
$do->actionClassName = $actionClassName; 
$do->actionName      = $action;

if	( $subaction == '' )
	$subaction = $do->actionConfig['default']['goto'];
	
$do->subActionName   = $subaction;

$do->init();


if	( !isset($do->actionConfig[$subaction]) )
{
	Logger::warn( "Action $action has no configured method named $subaction");
	Http::serverError("Action '$action' has no accessable method '$subaction'.");
	exit;
}
	
$subactionConfig = $do->actionConfig[$subaction];
//Logger::trace("controller is calling subaction '$subaction'");

// Eine Subaktion ohne "guest=true" verlangt einen angemeldeten Benutzer.
if	( !isset($subactionConfig['guest']) || !$subactionConfig['guest'] )
	if	( !is_object($do->currentUser) )
	{
		Http::notAuthorized( lang('SESSION_EXPIRED') );
		exit;
	}

// Eine Aktion mit "admin=true" verlangt einen Administrator als Benutzer.
if	( isset($do->actionConfig['admin']) && $do->actionConfig['admin'] )
	if	( !$do->currentUser->isAdmin )
	{
		Http::notAuthorized( lang('SESSION_EXPIRED') );
		exit;
	}


// Aktuelle Subaction in Sitzung merken
if	( isset($do->actionConfig[$subaction]['menu']) || isset($do->actionConfig[$subaction]['direct']) )
{
	$sl = Session::getSubaction();
	if	( !is_array($sl))
		$sl = array();
	$sl[$action] = $subaction;
	Session::setSubaction( $sl );
}


// Alias-Methode aufrufen.
if	( isset($do->actionConfig[$do->subActionName]['alias']) )
{
	$subaction = $do->actionConfig[$do->subActionName]['alias'];
//    $do->subActionName = $subaction;
}


// Aufruf der Subaction
$do->$subaction();

// Aufruf der n�chsten Subaction (falls vorhanden)
if	( isset($do->actionConfig[$do->subActionName]['goto']) )
{
	if	( $conf['interface']['redirect'] )
	{
		$subActionName     = $do->actionConfig[$do->subActionName]['goto'];
		header( 'HTTP/1.0 303 See other');
		// Absoluten Pfad kann auch der Client erg�nzen.
		header( 'Location: '.Html::url($action,$do->actionConfig[$do->subActionName]['goto'],$do->getRequestId()) );
		exit;
	}
	
	$subActionName     = $do->actionConfig[$do->subActionName]['goto'];
	$do->subActionName = $subActionName;
	$subaction = $subActionName;

	// Auf Alias pr�fen.
	if	( isset($do->actionConfig[$do->subActionName]['alias']) )
	{
		$subaction = $do->actionConfig[$do->subActionName]['alias'];
	}
	
	Logger::trace("controller is calling next subaction '$subaction'");
	$do->$subaction();
}

$do->setMenu(); // Menue erzeugen
$do->forward(); // Anzeige rendern

// fertig :)
?>