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
// Revision 1.5  2007-11-09 00:01:44  dankert
// Bugfix: Request-Variablen k?nnen Arrays sein.
//
// Revision 1.4  2007-05-14 23:29:06  dankert
// Falls REGISTER_GLOBALS aktiviert ist, dann alle REQUEST-Variablen aus dem globalen G?ltigkeitsraum entfernen.
//
// Revision 1.3  2004/12/19 21:16:43  dankert
// Workaround, falls magic_quotes_gpc eingeschaltet ist
//
// Revision 1.2  2004/11/10 22:44:36  dankert
// *** empty log message ***
//
// Revision 1.1  2004/05/02 19:27:22  dankert
// Initiale Version
//
// ---------------------------------------------------------------------------



$REQ = array_merge($HTTP_GET_VARS,$HTTP_POST_VARS,$_GET,$_POST);

// Zur Sicherheit:
// Falls REGISTER_GLOBALS aktiviert ist, dann alle REQUEST-Variablen aus dem
// globalen Gültigkeitsraum entfernen.
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