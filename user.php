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
// Revision 1.1  2003-09-29 18:18:21  dankert
// erste Version
//
// ---------------------------------------------------------------------------


$conf = parse_ini_file( 'config.ini.php',true );

require_once( $conf['directories']['incldir'].
              '/config.inc.'.
              $conf['global']['ext']            );

session_start();


include( "DB.php" );

include( "$conf_incldir/language.inc.$conf_php" );
include( "$conf_incldir/theme.inc.$conf_php" );
include( "$conf_incldir/request.inc.$conf_php" );

request_into_session('useraction');
request_into_session('userid');

// Zugriff nur für Administratoren gestattet
if   ( $SESS['user']['is_admin'] != '1' )
	die('access denied');


$db = new DB( $conf['database_'.$SESS['dbid']] );

$var = array();

if   ( !isset($SESS['useraction']))
	$SESS['useraction'] = 'show';


if   ( $SESS['useraction'] == 'save' )
{
	if   ( $REQ['is_admin']!=1 )
		$REQ['is_admin'] = 0;
		
	$t_user = $conf_db_prefix.'user';
	$sql = "UPDATE $t_user ".
	       "SET ".
	       "name      ='".$REQ['name']."', ".
	       "fullname  ='".$REQ['fullname']."', ".
	       "is_admin  = ".$REQ['is_admin'].", ".
	       "ldap      ='".$REQ['ldap']."', ".
	       "mail      ='".$REQ['mail']."', ".
	       "lang      ='".$REQ['lang']."', ".
	       "style     ='".$REQ['style']."' ".
	       "WHERE id=".$SESS['userid'];
	$res = $db->query($sql);

	$SESS['useraction'] = 'show';
}

if   ( $SESS['useraction'] == 'add' )
{
	$t_user = $conf_db_prefix.'user';
	$sql = "INSERT INTO $t_user ".
	       "(name) VALUES(".
	       "'".$REQ['name']."'".
	       ")";
	echo "$sql";
	$res = $db->query($sql);

	$SESS['useraction'] = 'list';
}

if   ( $SESS['useraction'] == 'addgroup' )
{
	$t_usergroup = $conf_db_prefix.'usergroup';
	$sql = "INSERT INTO $t_usergroup ".
	       "(userid,groupid) VALUES(".
	       "'".$SESS['userid']."',".
	       "'".$REQ['groupid']."'".
	       ")";
	echo "$sql";
	$res = $db->query($sql);

	$SESS['useraction'] = 'groups';
}

if   ( $SESS['useraction'] == 'delgroup' )
{
	$t_usergroup = $conf_db_prefix.'usergroup';
	$sql = "DELETE FROM $t_usergroup ".
	       "WHERE id=".$REQ['usergroupid'];
	$res = $db->query($sql);

	$SESS['useraction'] = 'groups';
}


if   ( $SESS['useraction'] == 'pwchange' )
{
	if   ($REQ['password1'] != '' && $REQ['password1'] == $REQ['password2'])
	{
		$t_user = $conf_db_prefix.'user';
		$sql = "UPDATE $t_user ".
		       "SET password='".md5($REQ['password1'])."' ".
		       "WHERE id=".$SESS['userid'];
		echo "$sql";
		$res = $db->query($sql);
	}
	else
	{
		die("both passwords not equal or blank");
	}
	$SESS['useraction'] = 'show';
}







if   ( $SESS['useraction'] == 'list' )
{
	$t_user = $conf_db_prefix.'user';
	$sql = "SELECT * FROM $t_user ORDER BY name";
	$res = $db->query($sql);
	
	$var['action'] = 'user.'.$conf_php;
	$var['el'] = array();

	while( $row = $res->fetchRow(DB_FETCHMODE_ASSOC) )
	{
		$id = $row['id'  ];
		$var['el'][$id]         = array();
		$var['el'][$id]['url' ] = 'user.'.$conf_php.'?useraction=edit&userid='.$id;
		$var['el'][$id]['name'] = $row['name'];
	}
	$res->free();

	output('user_list',$var);
}


if   ( $SESS['useraction'] == 'edit' )
{
	// Benutzerdaten lesen
	//
	$t_user = $conf_db_prefix.'user';
	$sql = "SELECT * FROM $t_user WHERE id=".$SESS['userid'];
	$res = $db->query($sql);
	$row = $res->fetchRow(DB_FETCHMODE_ASSOC);
	
	$id = $row['id'  ];
	$var = $row;

	$res->free();

	// Styles lesen
	//
	$var['allstyles'] = array();
	$handle=opendir( $conf_themedir.'/css' ); 
	while ($file = readdir ($handle))
	{ 
		if ( eregi('\.css$',$file) )
		{ 
			$var['allstyles'][$file] = $file;
		}
	}
	closedir($handle);

	// Sprachen lesen
	//
	$var['alllanguages'][''] = array(); 
	$var['alllanguages'][''] = lang('AUTOMATIC'); 
	
	$ini_isolang = parse_ini_file( $conf_languagedir.'/lang.ini.'.$conf_php );

	foreach($ini_isolang as $l2=>$text)
	{
		if   (is_file($conf_languagedir.'/'.strtolower($l2).'.ini.'.$conf_php))
			$var['alllanguages'][ $l2 ] = $text;
	}

	output('user_edit',$var);
}


if   ( $SESS['useraction'] == 'groups' )
{
	// Alle Gruppen ermitteln
	//
	$var['groups'] = array();
	$t_group = $conf_db_prefix.'group';
	$sql = "SELECT * FROM `$t_group`";
	$res = $db->query($sql);
	while( $row = $res->fetchRow(DB_FETCHMODE_ASSOC) )
	{
		$var['groups'][$row['id']] = $row['name'];
	}

	// Mitgliedschaften ermitteln
	//
	$var['memberships'] = array();
	$t_usergroup = $conf_db_prefix.'usergroup';
	$sql = "SELECT * FROM $t_usergroup ".
	       "WHERE userid=".$SESS['userid'];
	$res = $db->query($sql);
	while( $row = $res->fetchRow(DB_FETCHMODE_ASSOC) )
	{
		$var['memberships'][$row['id']] = $var['groups'][$row['groupid']];
	}
	
	output('user_groups',$var);
}


if   ( $SESS['useraction'] == 'pw' )
{
	output('user_pw',$var);
}


if   ( $SESS['useraction'] == 'show' )
{
	// Benutzerdaten lesen
	//
	$t_user = $conf_db_prefix.'user';
	$sql = "SELECT * FROM $t_user WHERE id=".$SESS['userid'];
	$res = $db->query($sql);
	$row = $res->fetchRow(DB_FETCHMODE_ASSOC);
	
	$id = $row['id'  ];
	$var = $row;

	$res->free();

	// Alle Gruppen ermitteln
	//
	$var['groups'] = array();
	$t_group = $conf_db_prefix.'group';
	$sql = "SELECT * FROM `$t_group`";
	$res = $db->query($sql);
	while( $row = $res->fetchRow(DB_FETCHMODE_ASSOC) )
	{
		$var['groups'][$row['id']] = $row['name'];
	}

	// Mitgliedschaften ermitteln
	//
	$var['memberships'] = array();
	$t_usergroup = $conf_db_prefix.'usergroup';
	$sql = "SELECT * FROM $t_usergroup ".
	       "WHERE userid=".$SESS['userid'];
	$res = $db->query($sql);
	while( $row = $res->fetchRow(DB_FETCHMODE_ASSOC) )
	{
		$var['memberships'][$row['id']] = $var['groups'][$row['groupid']];
	}
	
	output('user_show',$var);
}



















exit;


include( "./config.inc" );
include( "./functions$phpext" );

head();
?>
<body style="margin:0pt;">
<br>
<?php

$dateiname = $datadir.'/'.$userfile;

$file = file( $dateiname );

# Sortieren, damit die Benutzer alphabetisch
# angezeigt werden
#
natcasesort( $file );

$nr   = 0;

# Einlesen der Benutzer
#
echo "<center><table cellpadding=\"5\" cellspacing=\"0\" width=\"200\">\n";

# Der aktuelle Buchstabe
$buchstabe = "";

echo '<tr><td class="ben" colspan="2"><a href="useredit'.$phpext.'?session='.$session.'&useraction=new" title=" '.lang('user_new_description').' ">'.lang('user_new_description').'</a></td></tr>'."\n";

foreach( $file as $zeile )
{
     if   ( ! is_integer(strpos( $zeile,'<user ' )) )
          continue;

     $nr ++;
     $flag = xmlzeile( $zeile );
     $buchstabe_neu = substr(strtoupper($flag['name']),0,1);
     if   ( $buchstabe != $buchstabe_neu )
     {
          $buchstabe = $buchstabe_neu;
          echo '<tr><td colspan="2" class="buchstabe"><br>'.$buchstabe.'</td></tr>'."\n";
     }
     echo '<tr><td class="ben"><a href="useredit'.$phpext.'?session='.$session.'&useraction=edit&user_name='.$flag['name'].'" title=" '.lang('user_edit').' ">'.$flag['name'].'</a></td>'."\n";
     echo '<td class="ben">'.$flag['description'].'</td>'."\n";
     echo "</tr>\n";
     
}

echo "</table><center><br><br>\n";


?>

<?php fusszeile(); ?>
</body>
</html>