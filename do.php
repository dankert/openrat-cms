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
// Revision 1.1  2004-04-16 22:58:06  dankert
// Controller
//
// Revision 1.1  2004/04/03 22:55:00  dankert
// Neuer Controller
//
// ---------------------------------------------------------------------------

$conf = parse_ini_file( 'config.ini.php',true );

require_once( $conf['directories']['incldir'].
              '/config.inc.'.
              $conf['global']['ext']            );

session_start();

require_once( "./DB.php" );

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
require_once( "$conf_incldir/language.inc.$conf_php" );
require_once( "$conf_incldir/theme.inc.$conf_php" );
require_once( "$conf_incldir/db.inc.$conf_php" );
require_once( "$conf_incldir/request.inc.$conf_php" );

request_into_session('action');
request_into_session('subaction');
request_into_session('folderaction');
request_into_session('objectid');
request_into_session('action');
request_into_session('tplaction');
request_into_session('templateid');
request_into_session('elementaction');
request_into_session('elementid');
request_into_session('folderaction');
request_into_session('fileaction');
request_into_session('pageaction');
request_into_session('projectaction');
request_into_session('projectid');
request_into_session('modelaction');
request_into_session('modelid');
request_into_session('useraction');
request_into_session('userid');
request_into_session('groupaction');
request_into_session('groupid');
request_into_session('languageaction');
request_into_session('languageid');
request_into_session('searchaction');

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

$do->$subaction();

?>