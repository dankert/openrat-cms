<?php
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
// $Id$
// ---------------------------------------------------------------------------
// $Log$
// Revision 1.1  2004-05-02 19:27:22  dankert
// Initiale Version
//
// ---------------------------------------------------------------------------

//$conf = parse_ini_file( 'config.ini.php',true );

$conf_php         = $conf['global']['ext'];
define('CONF_PHP',$conf['global']['ext']);
//define('CONF_ADDSLASHES',$conf['global']['addslashes']);

//$conf_db          = $conf['database_1'];
$conf_incldir     = $conf['directories']['incldir'];
$conf_datadir     = $conf['directories']['datadir'];
$conf_themedir    = $conf['directories']['themedir'];
$conf_languagedir = $conf['directories']['languagedir'];
define('CONF_LANGUAGEDIR',$conf['directories']['languagedir']);
$conf_plugindir   = $conf['directories']['languagedir'];
$conf_tmpdir      = $conf['directories']['tmpdir'];

$conf_logfile     = $conf['log']['file'];
$conf_loglevel    = $conf['log']['level'];

?>