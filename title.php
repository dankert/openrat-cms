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
// Revision 1.1  2003-09-29 18:20:09  dankert
// erste Version
//
// ---------------------------------------------------------------------------

$conf = parse_ini_file( 'config.ini.php',true );

require_once( $conf['directories']['incldir'].
              '/config.inc.'.
              $conf['global']['ext']            );

session_start();


include( "./$conf_incldir/theme.inc.$conf_php" );
include( "./$conf_incldir/language.inc.$conf_php" );
include( "./$conf_incldir/request.inc.$conf_php" );

$var = array();
$var['css_body_class'] = 'title';
if  ( isset($SESS['dbid']) ) $var['db'] = $conf['database_'.$SESS['dbid']]['name'];
if  ( isset($SESS['user']) )       $var['user'    ] = $SESS['user']['name'];

$var['project'    ] = $SESS['db'];
$var['logout_url' ] = 'index.'.$conf_php.'?action=logout';
output( 'title',$var );

?>