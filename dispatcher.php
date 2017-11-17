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

try
{
    require_once( 'init.php' );
    
    
    // Werkzeugklassen einbinden.
    require_once( OR_OBJECTCLASSES_DIR ."include.inc.".PHP_EXT );
    require_once( OR_TEXTCLASSES_DIR   ."include.inc.".PHP_EXT );
    
    // Datenbank-Funktionen einbinden.
    require_once( OR_DBCLASSES_DIR."include.inc.".PHP_EXT );
    
    // Jetzt erst die Sitzung starten (nachdem alle Klassen zur Verfügung stehen).
    session_start();
    require_once( OR_SERVICECLASSES_DIR."Session.class.".PHP_EXT );
    
    // Vorhandene Konfiguration aus der Sitzung lesen.
    $conf = Session::getConfig();
     
    // Konfiguration lesen.
    // Wenn Konfiguration noch nicht in Session vorhanden oder die Konfiguration geändert wurde (erkennbar anhand des Datei-Datums)
    // dann die Konfiguration neu einlesen.
    if	( !is_array( $conf ) || $conf['config']['auto_reload'] && Preferences::lastModificationTime()>$conf['config']['last_modification'] )
    {
    	// Da die Konfiguration neu eingelesen wird, sollten wir auch die Sitzung komplett leeren.
    	if	( is_array($conf) && $conf['config']['session_destroy_on_config_reload'] ) 
    		session_unset();
    	
    	$conf = Preferences::load();
    	
    	$conf['build']   = parse_ini_file('build.ini'  );
    	$conf['version'] = parse_ini_file('version.ini');
    	// Sprache lesen
    
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
    
    // Nachdem die Konfiguration gelesen wurde, kann nun der Logger benutzt werden.
    require_once( OR_SERVICECLASSES_DIR."Logger.class.".PHP_EXT );
    
    if	( !empty($conf['security']['umask']) )
    	umask( octdec($conf['security']['umask']) );
    
    if	( !empty($conf['interface']['timeout']) )
    	set_time_limit( intval($conf['interface']['timeout']) );
    
    if	( config('security','use_post_token') && $_SERVER['REQUEST_METHOD'] == 'POST' && @$REQ[REQ_PARAM_TOKEN]!=token() )
    {
    	Logger::error('Token mismatch: Needed '.token().' but got '.@$REQ[REQ_PARAM_TOKEN].'. Maybe an attacker?');
    	Http::notAuthorized("Token mismatch","Token mismatch");
    }
    
    	
    define('FILE_SEP',$conf['interface']['file_separator']);
    
    define('TEMPLATE_DIR',OR_THEMES_DIR.$conf['interface']['theme'].'/templates');
    define('CSS_DIR'     ,OR_THEMES_DIR.$conf['interface']['theme'].'/css'      );
    define('IMAGE_DIR'   ,OR_THEMES_DIR.$conf['interface']['theme'].'/images'   );
    
    define('PRODUCTION'  ,$conf['production']);
    define('DEVELOPMENT' ,!PRODUCTION);
    
    require_once( "functions/config.inc.php" );
    require_once( "functions/language.inc.".PHP_EXT );
    require_once( "functions/db.inc.".PHP_EXT );
    
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
    
    if	( !empty( $REQ[REQ_PARAM_SUBACTION] ) )
    	$subaction = $REQ[REQ_PARAM_SUBACTION];
    else
    {
    	Http::serverError("no method (subaction) supplied");
    }
    
    require( OR_ACTIONCLASSES_DIR.'/Action.class.php' );
    require( OR_ACTIONCLASSES_DIR.'/ObjectAction.class.php' );
    
    	
    $actionClassName = ucfirst($action).'Action';
    
    require_once( OR_ACTIONCLASSES_DIR.'/'.$actionClassName.'.class.php' );
    
    // Erzeugen der Action-Klasse
    try
    {
    	$do = new $actionClassName;
    }
    catch( ObjectNotFoundException $e )
    {
    	Logger::debug( "Object not found: ".$e->__toString() );
    	Http::noContent();
    }
    
    $do->actionClassName = $actionClassName; 
    $do->actionName      = $action;
    $do->subActionName   = $subaction;
    
    define('OR_ACTION',$action);
    define('OR_METHOD',$subaction);
    define('OR_ID'    ,$REQ[REQ_PARAM_ID]);
    
    $do->init(); 
    
    
    switch( @$do->security )
    {
    	case SECURITY_GUEST:
    		// Ok.
    		break;
    	case SECURITY_USER:
    		if	( !is_object($do->currentUser) )
    		    throw new SecurityException('No user logged in, but this action requires a valid user');
    		break;
    	case SECURITY_ADMIN:
    		if	( !is_object($do->currentUser) || !$do->currentUser->isAdmin )
    		    throw new SecurityException('This action requires administration privileges, but user '.$do->currentUser->name.' is not an admin');
    		break;
    	default:
    }
    
    
    
    $isAction = $_SERVER['REQUEST_METHOD'] == 'POST';
    
    if	( $isAction )
    {
    	// POST-Request => ...Post() wird aufgerufen.
    	$subactionMethodName = $subaction.'Post';
    }
    else
    {
    	// GET-Request => ...View() wird aufgerufen.
    	$subactionMethodName = $subaction.'View';
    	// Daten werden nur angezeigt, die Sitzung kann also schon geschlossen werden.
    	if	( $action != 'index' ) // In Index wird die Perspektive manipuliert.
    		Session::close();
    }
    	
    Logger::debug("Executing $action/$subaction/".@$REQ[REQ_PARAM_ID]);
    
    if	( ! method_exists($do,$subactionMethodName) )
    	Http::noContent();
    	
    // Jetzt wird die Aktion aus der Actionklasse aufgerufen.
   	$result = $do->$subactionMethodName();
   	$do->handleResult($result);
   	
    $do->forward();
}
catch( ObjectNotFoundException $e )
{
	Logger::warn( "Object not found: ".$e->__toString() ); // Nur Debug, da dies bei gelöschten Objekten vorkommen kann.
	Http::noContent();
}
catch( OpenRatException $e )
{
	Http::serverError( lang($e->key),$e->__toString());
}
catch( SecurityException $e )
{
    Http::notAuthorized("You are not allowed to execute this action.");
}
catch( Exception $e )
{
	Http::serverError( "Internal CMS error",$e->__toString() );
}

// fertig :)
?>