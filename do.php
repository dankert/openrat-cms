<?php
// ---------------------------------------------------------------------------
// $Id$
// ---------------------------------------------------------------------------
// DaCMS Content Management System
// Copyright (C) 2002 Jan Dankert, jandankert@jandankert.de
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

define('PHP_EXT'         ,'php'    );
define('IMG_EXT'         ,'.gif'   );
define('IMG_ICON_EXT'    ,'.png'   );
define('MAX_FOLDER_DEPTH',5        );
define('OR_CONFIG_DIR'   ,'config' );

define('OR_VERSION'      ,'0.6-beta1'  );
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
define('OR_PREFERENCES_DIR'   ,'./config/'         );
define('OR_THEMES_DIR'        ,'./themes/'         );
define('OR_TMP_DIR'           ,'./tmp/'            );
define('OR_CONTROLLER_FILE'   ,'do'                );
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
	
//	Html::debug($languages);

	foreach( $languages as $l )
	{
		// Pruefen, ob Sprache vorhanden ist.
		$langFile = OR_LANGUAGE_DIR.$l.'.ini.'.PHP_EXT;

		if	( file_exists( $langFile ) )
		{
//			Html::debug($langFile);
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

define('REQ_PARAM_ACTION'         ,'action'         );
define('REQ_PARAM_SUBACTION'      ,'subaction'      );
define('REQ_PARAM_TARGETSUBACTION','targetSubAction');
define('REQ_PARAM_ID'             ,'id'             );

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

if	( isset($do->actionConfig[$do->subActionName]['alias']) )
{
	$subaction = $do->actionConfig[$do->subActionName]['alias'];
//    $do->subActionName = $subaction;
}

$do->$subaction();

if	( isset($do->actionConfig[$do->subActionName]['goto']) )
{
	if	( $conf['interface']['redirect'] )
	{
		$subActionName     = $do->actionConfig[$do->subActionName]['goto'];
		header( 'HTTP/1.0 303 See other');
		// Absoluten Pfad kann auch der Client ergänzen.
		header( 'Location: '.Html::url($action,$do->actionConfig[$do->subActionName]['goto'],$do->getRequestId()) );
		exit;
	}
	
	$subActionName     = $do->actionConfig[$do->subActionName]['goto'];
	$do->subActionName = $subActionName;
	$subaction = $subActionName;
	
	if	( isset($do->actionConfig[$do->subActionName]['alias']) )
	{
		$subaction = $do->actionConfig[$do->subActionName]['alias'];
	}
	
	Logger::trace("controller is calling next subaction '$subaction'");
	$do->$subaction();
}

$do->setMenu();
$do->forward();

?>