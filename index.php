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
// Revision 1.1  2003-09-29 18:17:46  dankert
// erste Version
//
// ---------------------------------------------------------------------------

session_start();

if   ( !isset($SESS['conf']) )
{
	$conf = parse_ini_file( 'config.ini.php',true );
	
	$conf_php         = $conf['global']['ext'];
	
	$conf_db          = $conf['database_1'];
	$conf_incldir     = $conf['directories']['incldir'];
	$conf_datadir     = $conf['directories']['datadir'];
	$conf_themedir    = $conf['directories']['themedir'];
	$conf_languagedir = $conf['directories']['languagedir'];
	$conf_plugindir   = $conf['directories']['languagedir'];
	$conf_tmpdir      = $conf['directories']['tmpdir'];
	
	$conf_logfile     = $conf['log']['file'];
	$conf_loglevel    = $conf['log']['level'];
	
	$SESS['conf'] = $conf;
}

require_once './DB.php';

include( "$conf_incldir/folder.inc.$conf_php"    );
include( "$conf_incldir/login.inc.$conf_php" );
include( "$conf_incldir/theme.inc.$conf_php" );
include( "$conf_incldir/language.inc.$conf_php" );
include( "$conf_incldir/project.inc.$conf_php" );
include( "$conf_incldir/request.inc.$conf_php" );
include( "$conf_incldir/db.inc.$conf_php" );

request_into_session('folderid');
request_into_session('fileid');
request_into_session('pageid');
request_into_session('dbid');
request_into_session('projectid');
request_into_session('projectmodelid');
request_into_session('languageid');
request_into_session('folderaction');
request_into_session('fileaction');
request_into_session('pageaction');



if   ($_REQUEST['action']=='logout')
{
	unset( $SESS['user'] );
}


if   ( !isset($SESS['user']) )
{
	$SESS['action'] = 'login';
}


if   ( !isset($SESS['lang']) )
{
	language_read();
}


# Authorization über HTTP
#
if   ( $conf['global']['auth'] == 'http' )
{
    if	( isset($PHP_AUTH_USER) )
    {
    	login( $PHP_AUTH_USER,$PHP_AUTH_PW,$db );
   	}
   	
   	# Falls Benutzer nicht angemeldet, dann Login-Maske präsentieren
   	#
   	if   ( !isset($sess_user) )
   	{
		header( 'WWW-Authenticate: Basic realm="Login"' );
		header( 'HTTP/1.0 401 Unauthorized' );
		echo 'Authorization Required!';
		exit;
	}
}




if   (!isset($sess_plugin_hooks))
{
//	$sess_plugin_hooks = read_plugin_hooks();
//	session_register( 'sess_plugin_hooks' );

//	$sess_global_plugins = array();
//	session_register( 'sess_global_plugins' );
//
//	$sess_project_plugins = array();
//	session_register( 'sess_project_plugins' );
}


# Ein Benutzer versucht sich anzumelden
#

if   ( isset($REQ['login_name']) && isset($REQ['login_password']) )
{
	unset( $sess_user );
	session_unregister( 'sess_user' );
	
	//plugin_global('login');
	
	if   (!isset($sess_user))
	{
		login( $REQ['login_name'],$REQ['login_password'],$REQ['dbid'] );
	}
	
	$SESS['dbid'] = $REQ['dbid'];
}


/*
# Wenn Startseite gewünscht, dann wird diese hier erzwungen.
# Nur nach dem Login ist $startpage gefüllt, sonst steht die
# Startpage nur in der Session.
#
if   ( isset($startpage) && !session_is_registered('sess_startpage') )
{
     session_register('sess_startpage');
     $sess_startpage  = $startpage;
}

if   ( session_is_registered('sess_startpage') && $menu != "login" && isset($sess_user['name']) && isset($login_name) )
{
     $menu       = "edit";
     $menuaction = "preview";
     session_register('sess_page');
     $sess_page  = $sess_startpage;
}

if   ( isset($startproject) )
{
     session_register('sess_startproject');
     $sess_startproject  = $startproject;
}

if   ( ! isset($menu      ) ) $menu       = 'login';
if   ( ! isset($menuaction) ) $menuaction = 'login';

if   ( $menu != "edit" )
{
     session_unregister('sess_page');
     unset($sess_page);
}

if   ( isset($page) )
{
     session_register('sess_page');
     $sess_page = $page;
}
if   ( isset($generate) )
{
     session_register('sess_generate');
     $sess_generate = $generate;
}

if   (asdf)
{
}

$session = session_id();

$skript  = $menuaction;

if   ( $menuaction == 'preview' )
{
     $skript   = 'generate';
     $generate = 'preview';
}

if   ( $menuaction == 'view' )
{
     $skript   = 'generate';
     $generate = 'view';
}

if   ( $menuaction == 'generate' )
{
     $skript   = 'generate';
     $generate = 'file';
}

session_register( 'sess_generate' );
session_register( 'sess_menu' );
session_register( 'sess_menuaction' );
$sess_menu = $menu;
$sess_generate = $generate;
$sess_menuaction = $menuaction;
*/

session_write_close();

/*
$u = $sess_user['name'];
$p =    $prj_project[ $sess_project ];
$m = lang( strtoupper('menu_'.$menuaction) );
if   ( isset($sess_page) )
     $s = $pagecache[$sess_page]['title'];
else $s = "";
if   ( $p == "" ) $p = "-";
if   ( $u == "" ) $u = "-";
*/


$title = 'Content Management System (Benutzer: **user**)';
$title = eregi_replace( '\*\*user\*\*',$u,$title );
$title = eregi_replace( '\*\*project\*\*',$p,$title );
$title = eregi_replace( '\*\*menu\*\*',$m,$title );
$title = eregi_replace( '\*\*page\*\*',$s,$title );


$var = array();

$title = $conf['global']['title'].' '.$conf['global']['version'];

if   (!isset($SESS['user']))
{
	$var['title'] = lang('NOT_LOGGED_IN').' - '.$title;
}
else
{
	$var['title'] = $SESS['user']['name'].' @'.$conf['database_'.$SESS['dbid']]['name'].' - '.$title;
}

$var['frame_src_title'   ] = 'title.'.$conf_php;
$var['frame_src_treemenu'] = 'treemenu.'.$conf_php;
$var['frame_src_tree'    ] = 'tree.'.$conf_php;
$var['frame_src_main'    ] = 'main.'.$conf_php;

if   (isset($SESS['user']))
	$var['tree_width'    ] = $conf['global']['tree_width'];
else $var['tree_width'    ] = '0';

if	( $conf['global']['tree_resizable'] )
	$var['border_width'    ] = '2';
else $var['border_width'    ] = '0';

output( 'frameset',$var );

?>