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

$conf = parse_ini_file( 'config.ini.php',true );

require_once( $conf['directories']['incldir'].
              '/config.inc.'.
              $conf['global']['ext']            );

session_start();


include( "DB.php" );

include( "$conf_incldir/language.inc.$conf_php" );
include( "$conf_incldir/db.inc.$conf_php" );
include( "$conf_incldir/theme.inc.$conf_php" );
include( "$conf_incldir/request.inc.$conf_php" );

request_into_session('groupaction');
request_into_session('groupid');

$db = db_connection();

// Zugriff nur für Administratoren gestattet
if   ( $SESS['user']['is_admin'] != '1' )
	die('access denied');

$var = array();

if   ( !isset($SESS['groupaction']))
	$SESS['groupaction'] = 'show';

if   ( $SESS['groupaction'] == 'save' )
{
	if   ( $REQ['delete'] == '1' )
	{
		// Alle Gruppenzugehörigkeiten zu dieser Gruppe löschen
		$sql = new Sql( 'DELETE FROM {t_usergroup} '.
		                'WHERE groupid={groupid}' );
		$sql->setInt   ('groupid',$SESS['groupid'] );
		$res = $db->query($sql->query);

		// Gruppe löschen
		$sql = new Sql( 'DELETE FROM {t_group} '.
		                'WHERE id={groupid}' );
		$sql->setInt   ('groupid',$SESS['groupid'] );
		$res = $db->query($sql->query);

		unset( $SESS['groupid'] );
		$SESS['groupaction'] = 'list';
		
		$var['tree_refresh'] = true;
	}
	else
	{
		// Gruppe speichern		
		$sql = new Sql( 'UPDATE {t_group} '.
		                'SET name = {name} '.
		                'WHERE id={groupid}' );
		$sql->setString('name'   ,$REQ['name']     );
		$sql->setInt   ('groupid',$SESS['groupid'] );
		$res = $db->query($sql->query);

		$SESS['groupaction'] = 'edit';
	}

}

if   ( $SESS['groupaction'] == 'add' )
{
	// Gruppe hinzufügen
	$sql = new Sql( 'INSERT INTO {t_group} '.
	                '(name) VALUES( {name} )');
	$sql->setString('name'   ,$REQ['name']     );
	$res = $db->query($sql->query);

	$var['tree_refresh'] = true;

	$SESS['groupaction'] = 'list';
}

if   ( $SESS['groupaction'] == 'adduser' )
{
	// Benutzer der Gruppe hinzufügen
	$t_usergroup = $conf_db_prefix.'usergroup';
	$sql = "INSERT INTO $t_usergroup ".
	       "(userid,groupid) VALUES(".
	       "'".$REQ['userid']."',".
	       "'".$SESS['groupid']."'".
	       ")";
	echo "$sql";
	$res = $db->query($sql);

	$SESS['groupaction'] = 'users';
}

if   ( $SESS['groupaction'] == 'deluser' )
{
	// Benutzer aus Gruppe entfernen
	$t_usergroup = $conf_db_prefix.'usergroup';
	$sql = "DELETE FROM $t_usergroup ".
	       "WHERE id=".$REQ['usergroupid'];
	$res = $db->query($sql);

	$SESS['groupaction'] = 'users';
}





if   ( $SESS['groupaction'] == 'list' )
{
	$t_group = $conf_db_prefix.'group';
	$sql = 'SELECT * FROM `'.$t_group.'` ORDER BY name';
	$res = $db->query($sql);
	
	$var['action'] = 'group.'.$conf_php;
	$var['el'] = array();

	while( $row = $res->fetchRow(DB_FETCHMODE_ASSOC) )
	{
		$id = $row['id'  ];
		$var['el'][$id]         = array();
		$var['el'][$id]['url' ] = 'group.'.$conf_php.'?groupaction=edit&groupid='.$id;
		$var['el'][$id]['name'] = $row['name'];
	}
	$res->free();

	output('group_list',$var);
}


if   ( $SESS['groupaction'] == 'edit' )
{
	$t_group = $conf_db_prefix.'group';
	$sql = "SELECT * FROM `$t_group` WHERE id=".$SESS['groupid'];
	$res = $db->query($sql);
	//echo $sql;
	$row = $res->fetchRow(DB_FETCHMODE_ASSOC);
	
	$id = $row['id'  ];
	$var['id']         = $row['id'];
	$var['name']       = $row['name'];

	$res->free();

	output('group_edit',$var);
}

if   ( $SESS['groupaction'] == 'acls' )
{
	$t_group = $conf_db_prefix.'group';
	$sql = "SELECT * FROM `$t_group` WHERE id=".$SESS['groupid'];
	$res = $db->query($sql);
	//echo $sql;
	$row = $res->fetchRow(DB_FETCHMODE_ASSOC);
	
	$id = $row['id'  ];
	$var['id']         = $row['id'];
	$var['name']       = $row['name'];

	$res->free();

	output('group_acls',$var);
}

if   ( $SESS['groupaction'] == 'users' )
{
	// Alle Benutzer ermitteln
	//
	$var['users'] = array();
	$t_user = $conf_db_prefix.'user';
	$sql = "SELECT * FROM `$t_user`";
	$res = $db->query($sql);
	while( $row = $res->fetchRow(DB_FETCHMODE_ASSOC) )
	{
		$var['users'][$row['id']] = $row['name'];
	}

	// Mitgliedschaften ermitteln
	//
	$var['memberships'] = array();
	$t_usergroup = $conf_db_prefix.'usergroup';
	$sql = "SELECT * FROM $t_usergroup ".
	       "WHERE groupid=".$SESS['groupid'];
	$res = $db->query($sql);
	while( $row = $res->fetchRow(DB_FETCHMODE_ASSOC) )
	{
		$var['memberships'][$row['id']] = $var['users'][$row['userid']];
	}

	output('group_users',$var);
}

if   ( $SESS['groupaction'] == 'show' )
{
	$t_group = $conf_db_prefix.'group';
	$sql = "SELECT * FROM `$t_group` WHERE id=".$SESS['groupid'];
	$res = $db->query($sql);
	//echo $sql;
	$row = $res->fetchRow(DB_FETCHMODE_ASSOC);
	
	$id = $row['id'  ];
	$var['id']         = $row['id'];
	$var['name']       = $row['name'];

	$res->free();

	output('group_show',$var);
}