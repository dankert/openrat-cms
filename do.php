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
// Revision 1.3  2004-05-02 18:40:46  dankert
// Konfiguration aus /etc lesen (wenn vorhanden)
//
// Revision 1.2  2004/04/24 15:17:19  dankert
// div. Erweiterungen
//
// Revision 1.1  2004/04/16 22:58:06  dankert
// Controller
// ---------------------------------------------------------------------------

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

require_once( "db/db.class.php" );
require_once( "functions/config.inc.php" );
require_once( "serviceClasses/GlobalFunctions.class.$conf_php" );
require_once( "serviceClasses/Html.class.$conf_php" );
require_once( "serviceClasses/Upload.class.$conf_php" );
require_once( "serviceClasses/Ftp.class.$conf_php" );
require_once( "serviceClasses/Text.class.$conf_php" );
require_once( "serviceClasses/Publish.class.$conf_php" );
require_once( "serviceClasses/Api.class.$conf_php" );
require_once( "serviceClasses/Logger.class.$conf_php" );
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

// Verbindung zur Datenbank
//
if	( isset($SESS['dbid']))
	$db = db_connection();

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
require( 'actionClasses/'.$actionClassName.'.class.php' );

$do = new $actionClassName;
$do->actionName = $action;

if	( $subaction == '' )
	$subaction = $do->defaultSubAction;

if	( !method_exists($do,$subaction) )
{
	$action = new Action();
	$action->message('ERROR',"subaction $subaction not defined in class $actionClassName");
}

$do->subActionName = $subaction;
$do->$subaction();

?>