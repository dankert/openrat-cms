<?php
#
#  DaCMS Content Management System
#  Copyright (C) 2002 Jan Dankert, jandankert@jandankert.de
#
#  This program is free software; you can redistribute it and/or
#  modify it under the terms of the GNU General Public License
#  as published by the Free Software Foundation; either version 2
#  of the License, or (at your option) any later version.
#
#  This program is distributed in the hope that it will be useful,
#  but WITHOUT ANY WARRANTY; without even the implied warranty of
#  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#  GNU General Public License for more details.
#
#  You should have received a copy of the GNU General Public License
#  along with this program; if not, write to the Free Software
#  Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
#


// Namen der Datenbanktabellen in Variablen schreiben
//
require( 'serviceClasses/Sql.class.php');

/**
 * Liefert alle Tabellennamen zur aktuellen Datenbankverbindung.
 * 
 * @param int $dbid
 * @return Array Schlüssel=log. Tabellenname, Werte=Phys. Tabellennamen 
 */
function table_names( $dbid )
{
	$t = array();
	global $conf;
	global $SESS;

	if	( empty($dbid) )
	{
		$db = Session::getDatabase();
		if	( is_object( $db ) )
		{
			$conf_db_prefix = $db->conf['prefix'];
			if	( isset($db->conf['suffix']))
				$conf_db_suffix = $db->conf['suffix'];
			else
				$conf_db_suffix = '';
		}
		else
		{
			$conf_db_prefix = '';
			$conf_db_suffix = '';
		}
	}
	else
	{
		$conf_db_prefix = $config('database',$dbid,'prefix');
		$conf_db_suffix = $config('database',$dbid,'suffix');
	}

	foreach( array(
	'element',
	'template',
	'templatemodel',
	'projectmodel',
	'page',
	'language',
	'value',
	'user',
	'usergroup',
	'project',
	'group',
	'folder',
	'file',
	'acl',
	'object',
	'name',
	'link'
	) as $tname )
		$t['t_'.$tname] = $conf_db_prefix.$tname.$conf_db_suffix;
	
	return $t;
}



/**
 * Liefert die Datenbankverbindung fuer die aktuelle Sitzung.
 * 
 * @return Db
 */
function db_connection()
{

	return Session::getDatabase();
}

 
?>