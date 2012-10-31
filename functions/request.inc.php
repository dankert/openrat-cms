<?php
// OpenRat Content Management System
// Copyright (C) 2002-2012 Jan Dankert, cms@jandankert.de
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

$REQ = array_merge($_GET,$_POST);

// Zur Sicherheit:
// Falls REGISTER_GLOBALS aktiviert ist, dann alle REQUEST-Variablen aus dem
// globalen G�ltigkeitsraum entfernen.
if	( ini_get('register_globals') )
{
	foreach( $REQ as $reqVar=>$reqValue )
		unset( $$reqVar );
}

if	( get_magic_quotes_gpc() == 1 )
{
	foreach( $REQ as $p=>$v )
		if	( !is_array($v) )
			$REQ[$p] = stripslashes($v);
}

function request_into_session( $name )
{
	global $REQ,$SESS;
	
	if   (isset($REQ[$name]))
	{
		$SESS[$name]      = $REQ[$name];
	}
}

?>