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
// Revision 1.8  2004-11-27 13:12:26  dankert
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

$conf_php = 'php';

require_once( "serviceClasses/GlobalFunctions.class.$conf_php" );
require_once( "serviceClasses/Html.class.$conf_php" );
require_once( "serviceClasses/Upload.class.$conf_php" );
require_once( "serviceClasses/Ftp.class.$conf_php" );
require_once( "serviceClasses/Text.class.$conf_php" );
require_once( "serviceClasses/Publish.class.$conf_php" );
require_once( "serviceClasses/Api.class.$conf_php" );
require_once( "serviceClasses/TreeElement.class.$conf_php" );
require_once( "serviceClasses/AbstractTree.class.$conf_php" );
require_once( "serviceClasses/AdministrationTree.class.$conf_php" );
require_once( "serviceClasses/ProjectTree.class.$conf_php" );
require_once( "objectClasses/Value.class.$conf_php" );
require_once( "objectClasses/Acl.class.$conf_php" );
require_once( "objectClasses/Template.class.$conf_php" );
require_once( "objectClasses/Object.class.$conf_php" );
require_once( "objectClasses/Folder.class.$conf_php" );
require_once( "objectClasses/Link.class.$conf_php" );
require_once( "objectClasses/File.class.$conf_php" );
require_once( "objectClasses/User.class.$conf_php" );
require_once( "objectClasses/Group.class.$conf_php" );
require_once( "objectClasses/Project.class.$conf_php" );
require_once( "objectClasses/Page.class.$conf_php" );
require_once( "objectClasses/Language.class.$conf_php" );
require_once( "objectClasses/Model.class.$conf_php" );
require_once( "objectClasses/Element.class.$conf_php" );
require_once( "db/db.class.php" );
require_once( "db/postgresql.class.php" );
require_once( "db/mysql.class.php" );

session_start();

require_once( "functions/request.inc.php" );

// Wenn Konfiguration noch nicht in Session vorhanden, dann
// aus Datei lesen.
if	( !isset( $SESS['conf'] ))
{
	// Falls Konfigurationsdatei unter /etc
	// vorhanden ist, diese benutzen.
	if	( is_file('/etc/openrat/config.ini.php') )
		$conf_filename = '/etc/openrat/config.ini.php';
	else	$conf_filename = './config.ini.php';

	// Datei lesen, parsen und in Session schreiben
	$conf = parse_ini_file( $conf_filename,true );
	$SESS['conf'] = $conf;
}
else
{
	// bereits gelesene und in Session vorhandene Konfiguration benutzen
	$conf = $SESS['conf'];
}

define('PHP_EXT' ,$conf_php );
define('FILE_SEP',$conf['interface']['file_separator']);

define('REQ_PARAM_ACTION'       ,'action');
define('REQ_PARAM_SUBACTION'    ,'subaction');
define('REQ_PARAM_CALLACTION'   ,'callAction');
define('REQ_PARAM_CALLSUBACTION','callSubaction');


require_once( "serviceClasses/Logger.class.$conf_php" );
require_once( "serviceClasses/Session.class.$conf_php" );
require_once( "functions/config.inc.php" );
require_once( "functions/language.inc.$conf_php" );
require_once( "functions/theme.inc.$conf_php" );
require_once( "functions/db.inc.$conf_php" );

// Request-Variablen in Session speichern
request_into_session('action'    );
request_into_session('subaction' );
request_into_session('objectid'  );
request_into_session('templateid');
request_into_session('elementid' );
request_into_session('projectid' );
request_into_session('modelid'   );
request_into_session('userid'    );
request_into_session('groupid'   );
request_into_session('languageid');

if   (isset($REQ['objectid']))
{
	$o = new Object( $REQ['objectid'] );
	Session::setObject($o);
}

// Verbindung zur Datenbank
//
$db = Session::getDatabase();
if	( is_object( $db ) )
{
	$db->connect();
	Session::setDatabase( $db );
}
	
//if	( isset($SESS['dbid']))
//	$db = db_connection();

if	( isset( $SESS['action'] ) )
	$action = $SESS['action'];
else	$action = 'index';

if	( isset( $REQ['subaction'] ) )
	$SESS[ $action.'action' ] = $REQ['subaction'];

if	( isset($SESS[ $action.'action']) )
	$subaction = $SESS[ $action.'action'];
else $subaction = '';

$actionClassName = strtoupper(substr($action,0,1)).substr($action,1).'Action';

require( 'actionClasses/Action.class.php' );
require( 'actionClasses/ObjectAction.class.php' );
require( 'actionClasses/'.$actionClassName.'.class.php' );

$do = new $actionClassName;
$do->actionName = $action;

if	( $subaction == '' )
	$subaction = $do->defaultSubAction;

if	( !method_exists($do,$subaction) )
	$subaction = $do->defaultSubAction;
	
Logger::trace("controller is calling subaction '$subaction'");

$do->subActionName = $subaction;
$do->$subaction();

?>