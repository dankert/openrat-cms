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

function table_names()
{
	$t = array();
	global $conf;
	global $SESS;

	$db = Session::getDatabase();
	if	( is_object( $db ) )
		$conf_db_prefix = $db->conf['prefix'];
	else $conf_db_prefix = '';

	$t['t_include']         = $conf_db_prefix.'include';
	$t['t_element']         = $conf_db_prefix.'element';
	$t['t_template']        = $conf_db_prefix.'template';
	$t['t_templatemodel']   = $conf_db_prefix.'templatemodel';
	$t['t_projectmodel']    = $conf_db_prefix.'projectmodel';
	$t['t_model']           = $conf_db_prefix.'projectmodel';
	$t['t_page']            = $conf_db_prefix.'page';
	$t['t_language']        = $conf_db_prefix.'language';
	$t['t_value']           = $conf_db_prefix.'value';
	$t['t_user']            = $conf_db_prefix.'user';
	$t['t_usergroup']       = $conf_db_prefix.'usergroup';
	$t['t_project']         = $conf_db_prefix.'project';
	$t['t_group']           = $conf_db_prefix.'group';
	$t['t_folder']          = $conf_db_prefix.'folder';
	$t['t_file']            = $conf_db_prefix.'file';
	$t['t_acl']             = $conf_db_prefix.'acl';
	$t['t_object']          = $conf_db_prefix.'object';
	$t['t_name']            = $conf_db_prefix.'name';
	$t['t_link']            = $conf_db_prefix.'link';
	
	return $t;
}



function db_connection()
{

	return Session::getDatabase();
}

//extract( table_names() );



 
?>