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
// Revision 1.1  2003-09-29 18:18:48  dankert
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
include( "$conf_incldir/theme.inc.$conf_php"   );
include( "$conf_incldir/db.inc.$conf_php"   );
include( "$conf_incldir/request.inc.$conf_php" );

$var = array();

$var['css_body_class'] = 'menu';

if   (isset($SESS['user']))
{
	$var['form_method'] = 'get';
	$var['form_target'] = 'cms_tree';
	$var['form_action'] = 'tree.'.$conf_php;
	
	$var['form_select_name']     = 'treeaction';
	$var['form_select_onchange'] = 'submit();';
	$var['form_select_value']    = array();


	// Lesen der verfügbaren Projekte
	$db  = db_connection();
	$sql = new Sql( 'SELECT id,name from {t_project} ORDER BY name ASC' );
	$projekte = $db->getAssoc( $sql->query );

	// Unterscheidung Administrator/Benutzer
	if   ( $SESS['user']['is_admin'] == '1' )
	{
		// Administrator sieht Administrationsbereich
		$var['form_select_value']['admin'] = lang('ADMINISTRATION');
		
		// Administrator sieht alle Projekte
		foreach( $projekte as $projectid=>$name )
		{
			$var['form_select_value'][$projectid] = $name;
		}
	}
	else
	{
		// Bereitstellen der Projekte, für die der Benutzer berechtigt ist
		//print_r($SESS['rights']);	
		foreach( $projekte as $projectid=>$name )
		{
			if   ( isset( $SESS['rights'][$projectid]) )
				$var['form_select_value'][$projectid] = $name;
		}
	}

	$var['form_select_default'] = $SESS['projectid'];
}

// Ausgabe des Templates
output('tree_menu',$var);

?>