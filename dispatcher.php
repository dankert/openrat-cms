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



// Diese Datei dient als "Dispatcher" und startet den zum Request passenden Controller ("*Action")..
// Jeder Request in der Anwendung läuft durch dieses Skript.
//
// Statische Resourcen (CSS,JS,Bilder,...) gehen nicht über diesen Dispatcher, sondern werden
// direkt geladen.

require_once( 'init.php' );


// Werkzeugklassen einbinden.
require_once( OR_OBJECTCLASSES_DIR ."include.inc.".PHP_EXT );
require_once( OR_TEXTCLASSES_DIR   ."include.inc.".PHP_EXT );

// Datenbank-Funktionen einbinden.
require_once( OR_DBCLASSES_DIR."db.class.php" );
require_once( OR_DBCLASSES_DIR."postgresql.class.php" );
require_once( OR_DBCLASSES_DIR."mysql.class.php" );
if (version_compare(PHP_VERSION, '5.0.0', '>'))
	require_once( OR_DBCLASSES_DIR."mysqli.class.php" );
if (version_compare(PHP_VERSION, '5.0.0', '>'))
	require_once( OR_DBCLASSES_DIR."sqlite.class.php" );
if (version_compare(PHP_VERSION, '5.3.0', '>'))
	require_once( OR_DBCLASSES_DIR."sqlite3.class.php" );
if (version_compare(PHP_VERSION, '5.1.0', '>'))
	require_once( OR_DBCLASSES_DIR."pdo.class.php" );

// Jetzt erst die Sitzung starten (nachdem alle Klassen zur Verfügung stehen).
session_start();
require_once( OR_SERVICECLASSES_DIR."Session.class.".PHP_EXT );

// Vorhandene Konfiguration aus der Sitzung lesen.
$conf = Session::getConfig();
 
// Wenn Konfiguration noch nicht in Session vorhanden, dann
// aus Datei lesen.
if	( !is_array( $conf ) )
{
	// Da die Konfiguration neu eingelesen wird, sollten wir auch die Sitzung komplett leeren.
	session_unset();
	
	$prefs = new Preferences();
	$conf = $prefs->load();
	$conf['action'] = $prefs->load(OR_ACTIONCLASSES_DIR);
	$conf['build'] = parse_ini_file('build.ini');
	// Sprache lesen und zur Konfiguration hinzufuegen

	if	( $conf['i18n']['use_http'] )
		// Die vom Browser angeforderten Sprachen ermitteln     
		$languages = Http::getLanguages();
	else
		// Nur Default-Sprache erlauben
		$languages = array();

	if	( isset($_COOKIE['or_language']) )
		$languages = array($_COOKIE['or_language']) + $languages;
		
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

if	( config('security','use_post_token') && $_SERVER['REQUEST_METHOD'] == 'POST' && $REQ[REQ_PARAM_TOKEN]!=token() )
	Http::notAuthorized("Token mismatch");
	
define('FILE_SEP',$conf['interface']['file_separator']);

define('TEMPLATE_DIR',OR_THEMES_DIR.$conf['interface']['theme'].'/templates');
define('CSS_DIR'     ,OR_THEMES_DIR.$conf['interface']['theme'].'/css'      );
define('IMAGE_DIR'   ,OR_THEMES_DIR.$conf['interface']['theme'].'/images'   );

require_once( OR_SERVICECLASSES_DIR."Logger.class.".PHP_EXT );
require_once( "functions/config.inc.php" );
require_once( "functions/language.inc.".PHP_EXT );
require_once( "functions/db.inc.".PHP_EXT );

$charset = Session::get('charset');
$charset = !empty($charset)?$charset:'US-ASCII';

header( 'Content-Type: text/html; charset='.$charset );

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
	$db->start();
}

if	( !empty($REQ[REQ_PARAM_ACTION]) )
	$action = $REQ[REQ_PARAM_ACTION];
else
	Http::serverError("no action supplied");
	//$action = 'login';

Session::set('action',$action);

if	( !empty( $REQ[REQ_PARAM_SUBACTION] ) )
	$subaction = $REQ[REQ_PARAM_SUBACTION];
else
{
	Http::serverError("no method (subaction) supplied");
}

require( OR_ACTIONCLASSES_DIR.'/Action.class.php' );
require( OR_ACTIONCLASSES_DIR.'/ObjectAction.class.php' );


// Schritt 1:
// Zuerst die Schreibaktion durchführen, erst anschließend folgenen die Views.
// if	( $_SERVER['REQUEST_METHOD'] == 'POST' )
	
$actionClassName = ucfirst($action).'Action';

//if	( !isset($conf['action'][$actionClassName]) )
//	Http::serverError("Action '$action' is undefined.");

require_once( OR_ACTIONCLASSES_DIR.'/'.$actionClassName.'.class.php' );

$sConf = @$conf['action'][$actionClassName][$subaction];
	
// Wenn
// - *Action-Methode zum Schreiben vorhanden und POST-Request
// oder
// - Methode mit direkter Ausgabe

// Erzeugen der Action-Klasse
$do = new $actionClassName;

// TODO: ActionConfig entfernen.
$do->actionConfig = @$conf['action'][$actionClassName];
//$do->actionConfig = array();

$do->actionClassName = $actionClassName; 
$do->actionName      = $action;
if	( $subaction == '' )
	$subaction = $do->actionConfig['default']['goto'];
	
$do->subActionName   = $subaction;


$do->init(); 

if	( !isset($do->actionConfig[$subaction]) && false )
{
	Logger::warn( "Action $action has no configured method named $subaction");
	Http::serverError("Action '$action' has no accessable method '$subaction'.");
	exit;
}


$subactionConfig = @$do->actionConfig[$subaction];


// Eine Subaktion ohne "guest=true" verlangt einen angemeldeten Benutzer.
if	( !isset($subactionConfig['guest']) || !$subactionConfig['guest'] )
	if	( !is_object($do->currentUser) )
	{
		Logger::debug('No session and no guest action occured, maybe session expired');
		Http::notAuthorized( lang('SESSION_EXPIRED'),'login required' );
		$do->templateVars['error'] = 'not logged in';
		exit;
	}

// Eine Aktion mit "admin=true" verlangt einen Administrator als Benutzer.
if	( isset($do->actionConfig['admin']) && $do->actionConfig['admin'] )
	if	( !$do->currentUser->isAdmin )
	{
		Logger::debug('Admin action, but user '.$do->currentUser->name.' is not an admin');
		Http::notAuthorized( lang('SESSION_EXPIRED'),'intrusion detection' );
		$do->templateVars['error'] = 'no admin';
		exit;
				}


// Aktuelle Subaction in Sitzung merken
if	( isset($do->actionConfig[$subaction]['menu']) )
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
}


$isAction = $_SERVER['REQUEST_METHOD'] == 'POST' || (isset($sConf['write']) && $sConf['write']=='get');
//      || @$sConf['call']
//      || isset($conf['action'][$actionClassName][$subaction]['direct'] ) );
     


if	( $isAction )
	$subactionMethodName = $subaction.'Post';
else
	$subactionMethodName = $subaction.'View';
	
Logger::debug("Executing $actionClassName::$subactionMethodName");

if	( ! method_exists($do,$subactionMethodName) )
{
	Http::sendStatus(404,"Method not found","Method '".$subactionMethodName."' does not exist in this context" );
	
}

$do->$subactionMethodName();

if	( isset($do->actionConfig[$do->subActionName]['direct']) )
	exit;

	
if	( isset($do->actionConfig[$do->subActionName]['async' ]) || $isAction )
{
	$json = new JSON();
	header('Content-Type: application/json; charset=UTF-8');
	echo $json->encode( $do->templateVars );
	exit;
}
	
if	( $conf['interface']['redirect'] )
{
	// Wenn Validierungsfehler aufgetrete sind, auf keinen Fall einen Redirect machen, da sonst
	// im nächste Request die Eingabedaten fehlen.
	if	( empty($do->templateVars['errors']) )
	{
		header( 'HTTP/1.0 303 See other');
		// Absoluten Pfad kann auch der Client erg�nzen.
		header( 'Location: '.Html::url($action,$subaction,$do->getRequestId()) );
		exit;
	}
}



/*		
// Schritt 2:
// Alle Views durchlaufen
foreach( $views as $view=>$viewConfig )
{
	if	( $viewConfig == null )
		continue;
		
	$action    = $viewConfig['action'];
	$subaction = $viewConfig['subaction'];

	if	( isset($viewCache[$view]) && $view != @$REQ[REQ_PARAM_TARGET] )
	{
		$viewCache[$view]['source'] = 'cache';
		continue;
	}
		
	$actionClassName = ucfirst($action).'Action';

	if	( !isset($conf['action'][$actionClassName]) )
		Http::serverError("Action '$action' is undefined.");
	
	require_once( OR_ACTIONCLASSES_DIR.'/'.$actionClassName.'.class.php' );
	
	// Erzeugen der Action-Klasse
	$do = new $actionClassName;
	$do->actionConfig = $conf['action'][$actionClassName];
	$do->actionClassName = $actionClassName; 
	$do->actionName      = $action;
	if	( $subaction == '' )
		$subaction = $do->actionConfig['default']['goto'];
		
	$do->subActionName   = $subaction;
	
	
	
	if	( !isset($do->actionConfig[$subaction]) )
	{
		Logger::warn( "Action $action has no configured method named $subaction");
		Http::serverError("Action '$action' has no accessable method '$subaction'.");
		exit;
	}
		

	
		// Alias-Methode aufrufen.
	if	( isset($do->actionConfig[$do->subActionName]['alias']) )
	{
		$subaction = $do->actionConfig[$do->subActionName]['alias'];
	}
	// GOTO-Methode aufrufen.
	elseif	( isset($do->actionConfig[$do->subActionName]['goto']) )
	{
		$subaction = $do->actionConfig[$do->subActionName]['goto'];
		$do->subActionName = $subaction;
	}
	
	$do->init();
	
	if	( isset($actionTemplateVars))
	{
		//unset( $actionTemplateVars['mode'] );
		$do->templateVars = $actionTemplateVars;
	}
	
	$subactionConfig = $do->actionConfig[$subaction];
	//Logger::trace("controller is calling subaction '$subaction'");
	
	// Eine Subaktion ohne "guest=true" verlangt einen angemeldeten Benutzer.
	if	( !isset($subactionConfig['guest']) || !$subactionConfig['guest'] )
		if	( !is_object($do->currentUser) )
		{
			Logger::debug('No session and no guest action occured, maybe session expired');
			//Http::notAuthorized( lang('SESSION_EXPIRED') );
			
			$viewCache[$view] = array('error'=>'not logged in');
			continue;
		}
	
	// Eine Aktion mit "admin=true" verlangt einen Administrator als Benutzer.
	if	( isset($do->actionConfig['admin']) && $do->actionConfig['admin'] )
		if	( !$do->currentUser->isAdmin )
		{
			Logger::debug('Admin action, but user '.$do->currentUser->name.' is not an admin');
			//Http::notAuthorized( lang('SESSION_EXPIRED') );
			$viewCache[$view] = array('error'=>'no admin');
			continue;
		}
	
	
	// Aktuelle Subaction in Sitzung merken
	if	( isset($do->actionConfig[$subaction]['menu']) )
	{
		$sl = Session::getSubaction();
		if	( !is_array($sl))
			$sl = array();
		$sl[$action] = $subaction;
		Session::setSubaction( $sl );
	}
	
	
	

	if	( isset($do->actionConfig[$do->subActionName]['write']) )
		$subactionMethodName = $subaction.'View';
	else
		$subactionMethodName = $subaction;
		 
	Logger::debug("Executing $actionClassName::$subactionMethodName");
	
	$do->$subactionMethodName(); // Aufruf der Subaction
	
	$views[$view]['subaction'] = $subaction;
	

	// Aufruf der n�chsten Subaction (falls vorhanden)
	
	if	( false && isset($do->actionConfig[$do->subActionName]['goto']) )
	{
		// Achtung: Redirect fuehrt zu Problemen beim Login sowie der Anzeige von Notices
		if	( $conf['interface']['redirect'] )
		{
			// Wenn Validierungsfehler aufgetrete sind, auf keinen Fall einen Redirect machen, da sonst
			// im naechsten Request die Eingabedaten fehlen.
			if	( empty($do->templateVars['errors']) )
			{
				$subActionName     = $do->actionConfig[$do->subActionName]['goto'];
				header( 'HTTP/1.0 303 See other');
				// Absoluten Pfad kann auch der Client ergaenzen.
				header( 'Location: '.Html::url($action,$do->actionConfig[$do->subActionName]['goto'],$do->getRequestId()) );
				exit;
			}
		}
		
		$subActionName     = $do->actionConfig[$do->subActionName]['goto'];
		$views[$view]['subaction'] = $subActionName;
			
		$do->subActionName = $subActionName;
		$subaction = $subActionName;
	
		// Auf Alias pr�fen.
		if	( isset($do->actionConfig[$do->subActionName]['alias']) )
		{
			$subaction = $do->actionConfig[$do->subActionName]['alias'];
		}
		
		Logger::debug("Executing $actionClassName::$subaction (following GOTO)");
		// Alias-Methode aufrufen.
		if	( isset($do->actionConfig[$subActionName]['write']) )
		{
			$subActionView = $subActionName.'View';
			$do->$subActionView();
		}
		else
		{
			$do->$subaction();
		}
	}
	$do->setMenu(); // Menue erzeugen
	
	// Anzeigedaten in den Cache schreiben.
	$viewCache[$view] = $do->templateVars;
	$viewCache[$view]['source'] = 'request';
	
	// $do->forward(); // Anzeige rendern
}
*/


// Erst jetzt die Views wegschreiben (könnten sich durch ein "GOTO" verändert haben).

//Html::debug($views,'VIEWS am Ende');

// TODO: Globle Variablen für den Seitenkopf.
/*
$root_stylesheet = OR_THEMES_EXT_DIR.$conf['interface']['theme'].'/css/layout.css';
$sessionStyle = Session::get('style');
$user_stylesheet = OR_THEMES_EXT_DIR.$conf['interface']['theme'].'/css/user/'.(!empty($sessionStyle)?$sessionStyle:$conf['interface']['style']['default']).'.css';
//$self = $HTTP_SERVER_VARS['PHP_SELF'];
if	( !empty($conf['interface']['override_title']) )
	$cms_title = $conf['interface']['override_title'];
else
	$cms_title = OR_TITLE.' '.OR_VERSION;
$showDuration = $conf['interface']['show_duration'];
*/

/*
 * 
	$viewConfig = $views[$view];
	
	if	( $viewConfig == null )
		return; // View ist leer.
 */
	
	$do->forward();

// fertig :)
?>