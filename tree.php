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
// Revision 1.1  2003-09-29 18:19:48  dankert
// erste Version
//
// ---------------------------------------------------------------------------


$conf = parse_ini_file( 'config.ini.php',true );

require_once( $conf['directories']['incldir'].
              '/config.inc.'.
              $conf['global']['ext']            );

session_start();

require_once "./DB.$conf_php";
require_once( "$conf_incldir/language.inc.$conf_php" );
require_once( "$conf_incldir/theme.inc.$conf_php" );
require_once( "$conf_incldir/tree.inc.$conf_php" );
require_once( "$conf_incldir/request.inc.$conf_php" );
require_once( "$conf_incldir/db.inc.$conf_php" );


request_into_session('treeaction');

if   ( !isset($SESS['treeaction']) )
{
	$SESS['treeaction'] = $SESS['projectid'];
}

$treeaction = $SESS['treeaction'];
    
if   (!isset($SESS['tree_open']))
     $SESS['tree_open'] = array();

if   ( !is_array($SESS['tree_open'][$treeaction]) )
     $SESS['tree_open'][$treeaction] = array();


if   (isset($REQ['open']))
{
     array_push($SESS['tree_open'][$treeaction],$REQ['open']);
}


if   (isset($REQ['close']))
{
	$key = array_search( $REQ['close'],$SESS['tree_open'][$treeaction] );
	if	( !is_null($key) && $key!==false )
		unset( $SESS['tree_open'][$treeaction][$key] );
}


// Erzeugen des Menue-Baums
//
if   ( (isset($SESS['user']) && isset($REQ['treeaction'])) || !isset($SESS['tree']) || $REQ['refresh']=='1' )
{
	$db = db_connection();
	
	$SESS['tree'] = array();
	if ( $SESS['treeaction'] == 'admin' )
	{

		// Einstellungen
		//
		# "root"-element
	     $SESS['tree']['projects'] = array('text'  => lang('PROJECTS'),
	                                    'url'   => "main.$conf_php?action=project&projectaction=list",
	                                    'icon'  => 'project',
	                                    'target'=> 'cms_main' );
	                                    
		$sql = "SELECT * FROM $t_project ORDER BY name";
		$res = $db->query($sql);
		if (DB::isError($res)) die ($res->getMessage().'<br>'.$sql);
		while ($row = $res->fetchrow(DB_FETCHMODE_ASSOC) )
		{
		     $SESS['tree']['prj'.$row['id']] = array('text'  => $row['name'],
		                                         'parent'=> 'projects',
		                                         'url'   => "main.$conf_php?action=project&projectaction=edit&projectid=".$row['id'],
		                                         'icon'  => 'project',
		                                         'target'=> 'cms_main' );
		}
		$res->free();

		$SESS['tree']['global']   = array('text'  => lang('common'),
	                                   'icon'  => 'user' );

		$SESS['tree']['user']     = array('text'  => lang('USER'),
	                                   'parent'=> 'global',
	                                   'url'   => "main.$conf_php?action=user&useraction=list",
                                       'icon'  => 'user',
	                                   'target'=> 'cms_main' );

		$sql = "SELECT * FROM $t_user ORDER BY name";
		$res = $db->query($sql);
		while ($row = $res->fetchrow(DB_FETCHMODE_ASSOC) )
		{
			$SESS['tree']['user'.$row['id']] = array('text'   => $row['name'],
			                                      'url'    => "main.$conf_php?action=user&userid=".$row['id'],
			                                      'icon'   => 'user',
			                                      'parent' => "user",
			                                      'target' => 'cms_main' );
		}
		$res->free();

	     $SESS['tree']['group']    = array('text'  => lang('GROUPS'),
	                                    'parent'=> 'global',
	                                    'url'   => "main.$conf_php?action=group&groupaction=list",
                                        'icon'  => 'group',
	                                    'target'=> 'cms_main' );

		$sql = 'SELECT * FROM '.$t_group.' ORDER BY name';
		$res = $db->query($sql);
		if (DB::isError($res)) die ($res->getMessage().'<br>'.$sql);
		while ($row = $res->fetchrow(DB_FETCHMODE_ASSOC) )
		{
			$SESS['tree']['group'.$row['id']] = array('text'   => $row['name'],
			                                       'url'    => "main.$conf_php?action=group&groupid=".$row['id'],
			                                       'icon'   => 'user',
			                                       'parent' => "group",
			                                       'target' => 'cms_main' );
		}
		$res->free();

	     $SESS['tree']['logout']   = array('text'  => lang('LOGOUT'),
	                                    'url'   => "index.$conf_php?action=logout",
                                        'icon'   => 'logout',
	                                    'target'=> '_top' );
	}
	else
	{
		// Projektstruktur
		// ---------------
		
		// Projekt-ID in Session speichern
		$SESS['projectid'] = $SESS['treeaction'];
		$projectid         = $SESS['projectid'];
		
		// Ermitteln Sprache
		$sql = "SELECT id FROM $t_language WHERE projectid=$projectid AND is_default=1";
		$SESS['languageid'] = $db->getOne($sql);
	
		// Ermitteln Projectmodell
		$sql = "SELECT id FROM $t_projectmodel WHERE projectid=$projectid AND is_default=1";
		$SESS['projectmodelid'] = $db->getOne($sql);


		// Projekt-Baum
		//
		$SESS['tree']['folder'] = array('text'   => lang('FOLDER'),
		                             'url'    => "main.$conf_php?action=folder&folderid=",
		                             'icon'   => 'folder',
		                             'target' => 'cms_main' );
		
		$sql = "SELECT * FROM $t_folder WHERE projectid=$projectid AND parentid IS NULL";
		$res = $db->query($sql);
		while ($row = $res->fetchRow(DB_FETCHMODE_ASSOC) )
		{
			$SESS['tree']['f'.$row['id']] = array('text'   => $row['name'],
			                                   'desc'   => $row['desc'],
			                                   'parent' => 'folder',
			                                   'icon'   => 'folder',
			                                   'url'    => "main.$conf_php?action=folder&folderid=".$row['id'],
			                                   'target' => 'cms_main' );
			add_folder( $row['id'] );
		}
		$res->free();

		$sql = "SELECT * FROM $t_page ".
		       "WHERE projectid=$projectid AND folderid IS NULL";
		$res = $db->query($sql);
		while ($row = $res->fetchrow() )
		{
			$SESS['tree']['page'.$row['id']] = array('text'   => $row['name'],
			                                   'desc'   => $row['desc'],
			                                   'url'    => "main.$conf_php?action=page&pageid=".$row['id'],
			                                   'icon'   => 'page',
			                                   'parent' => 'folder',
			                                   'target' => 'cms_main' );
			add_page_elements( $row['id'],$row['templateid'] );
		}
		$res->free();


		$sql = "SELECT * FROM $t_file ".
		       "  WHERE projectid=$projectid AND folderid IS NULL ORDER BY filename";
		$res = $db->query($sql);
		if (DB::isError($res)) die ($res->getMessage().'<br>'.$sql);
		while ($row = $res->fetchrow(DB_FETCHMODE_ASSOC) )
		{
			$SESS['tree']['file'.$row['id']] = array('text'   => $row['name'],
			                                   'url'    => "main.$conf_php?action=file&fileid=".$row['id'],
			                                   'icon'   => 'file',
			                                   'desc'   => $row['desc'],
			                                   'name'   => 'file'.$row['id'],
			                                   'parent' => 'folder',
			                                   'target' => 'cms_main' );
		}
		$res->free();



		// Templates anzeigen
		//
		if   ( $SESS['user']['is_admin'] == '1' )
		{
			$SESS['tree']['tpl'] = array('text'   => lang('TEMPLATES'),
			                          'url'    => "main.$conf_php?action=template&tplaction=list",
			                          'icon'   => 'tpl_list',
			                          'target' => 'cms_main' );
			$sql = "SELECT * FROM $t_template WHERE projectid=".$SESS['treeaction'];
			$res = $db->query($sql);
			while ($row = $res->fetchRow(DB_FETCHMODE_ASSOC) )
			{
				$SESS['tree']['tpl'.$row['id']]       = array('text'   => $row['name'],
				                                            'url'    => "main.$conf_php?action=template&templateid=".$row['id'],
				                                            'parent' => "tpl",
	                                                        'icon'   => 'tpl',
				                                            'target' => 'cms_main' );
				// Anzeigen der Template-Elemente
				//
				$sql = "SELECT * FROM $t_element WHERE templateid=".$row['id']." ORDER BY name ASC";
				$resel = $db->query($sql);
		
				while ($rowel = $resel->fetchRow(DB_FETCHMODE_ASSOC) )
				{
					$SESS['tree']['tpl'.$row['id'].'el'.$rowel['id']] = array('text'   => $rowel['name'],
					                                                       'url'    => "main.$conf_php?action=element&templateid=".$row['id'].'&elementaction=edit&elementid='.$rowel['id'],
			                                                               'icon'   => 'el_'.$rowel['type'],
					                                                       'parent' => 'tpl'.$row['id'],
					                                                       'target' => 'cms_main' );
				}
			}
			$res->free();
		}


          // Sprachvarianten
          //
		if   ( $SESS['user']['is_admin'] == '1' )
		{
			$SESS['tree']['lang'] = array('text'   => lang('LANGUAGES'),
			                           'url'    => "main.$conf_php?action=language",
			                           'icon'   => 'lang_list',
			                           'target' => 'cms_main' );
			$sql = "SELECT * FROM $t_language".
			             " WHERE projectid=".$SESS['treeaction'].
			             " ORDER BY name";
			$res = $db->query($sql);
	     	if (DB::isError($res)) die ($res->getMessage().'<br>'.$sql);
			while ($row = $res->fetchRow(DB_FETCHMODE_ASSOC) )
			{
				$SESS['tree']['lang'.$row['id']] = array('text'   => $row['name'],
				                                      'url'    => "main.$conf_php?action=language&languageid=".$row['id'],
				                                      'parent' => 'lang',
	                                                     'icon'   => 'lang',
				                                      'target' => 'cms_main' );
			}
			$res->free();
		}


          // Projektvarianten
          //
		if   ( $SESS['user']['is_admin'] == '1' )
		{
			$SESS['tree']['pvar'] = array('text'   => lang('VARIATIONS'),
			                           'url'    => "main.$conf_php?action=projectmodel",
			                           'icon'   => 'model_list',
			                           'target' => 'cms_main' );
			$sql = "SELECT * FROM $t_projectmodel WHERE projectid=".$SESS['treeaction'];
			$res = $db->query($sql);
	     	if (DB::isError($res)) die ($res->getMessage().'<br>'.$sql);
			while ($row = $res->fetchRow(DB_FETCHMODE_ASSOC) )
			{
				$SESS['tree']['pvar'.$row['id']] = array('text'   => $row['name'],
				                                      'url'    => "main.$conf_php?action=projectmodel&projectmodelid=".$row['id'],
				                                      'parent' => "pvar",
	                                                     'icon'   => 'model',
				                                      'target' => 'cms_main' );
			}
			$res->free();
		}

		$SESS['tree']['search'] = array('text'   => lang('SEARCH'),
		                             'url'    => "main.$conf_php?action=search",
                                       'icon'   => 'search',
		                             'target' => 'cms_main' );

	}
	
	
	// Zu jedem Baumelement werden die Kinder ermittelt
	// Ziel: Performancesteigerung, schnellere Baumanzeige.
	
	// Wir benötigen eine Kopie von $SESS['tree'], weil innerhalb einer foreach()-Schleife
	// nicht das gleiche Array nochmal mit foreach() durchlaufen werden kann.
	$SESS['tree_kopie'] = $SESS['tree'];
	
	foreach( $SESS['tree'] as $idx=>$inh )
	{
		$SESS['tree'][$idx]['children'] = array();
		
		foreach( $SESS['tree_kopie'] as $name=>$val )
		{
			if   ( $val['parent'] == $idx )
			{
				$SESS['tree'][$idx]['children'][] = $name;
			}
		}
	}
	unset( $SESS['tree_kopie'] );

}




function add_folder( $parentid )
{
	global $db,
	
	$SESS,
	
	$conf_php,
	       $t_templatemodel,
	       $t_template,
	       $t_folder,
	       $t_file,
	       $t_page;
	$sql = "SELECT * FROM $t_folder ".
	       "WHERE projectid=".$SESS['treeaction'].
	       "  AND parentid=$parentid";
	$res = $db->query($sql);
	if (DB::isError($res)) die ($res->getMessage().'<br>'.$sql);
	while ($row = $res->fetchrow(DB_FETCHMODE_ASSOC) )
	{
		$SESS['tree']['f'.$row['id']] = array('text'   => $row['name'],
		                                   'desc'   => $row['desc'],
		                                   'url'    => "main.$conf_php?action=folder&folderid=".$row['id'],
		                                   'icon'   => 'folder',
		                                   'parent' => "f$parentid",
		                                   'target' => 'cms_main' );
		add_folder( $row['id'] );
	}
	$res->free();

	$sql = "SELECT * FROM $t_page ".
            //"LEFT JOIN $t_templatemodel ON $t_page.templateid=$t_templatemodel.id ".
	       "WHERE folderid=$parentid";
	$res = $db->query($sql);
	while ($row = $res->fetchrow() )
	{
		$SESS['tree']['page'.$row['id']] = array('text'   => $row['name'],
		                                   'url'    => "main.$conf_php?action=page&pageid=".$row['id'],
		                                   'icon'   => 'page',
		                                   'desc'   => $row['desc'],
		                                   'parent' => "f$parentid",
		                                   'target' => 'cms_main' );

		add_page_elements( $row['id'],$row['templateid'] );
	}
	$res->free();
	
	$sql = "SELECT * FROM $t_file WHERE folderid=$parentid ORDER BY filename";
	$res = $db->query($sql);
	if (DB::isError($res)) die ($res->getMessage().'<br>'.$sql);
	while ($row = $res->fetchrow(DB_FETCHMODE_ASSOC) )
	{
		$SESS['tree']['file'.$row['id']] = array('text'   => $row['name'],
		                                   'url'    => "main.$conf_php?action=file&fileid=".$row['id'],
		                                   'icon'   => 'file',
		                                   'desc'   => $row['desc'],
		                                   'name'   => 'file'.$row['id'],
		                                   'parent' => "f$parentid",
		                                   'target' => 'cms_main' );
	}
	$res->free();
}

function add_page_elements( $pageid,$templateid )
{
	global $db,$SESS,$conf_php,$t_element;

	$sql = "SELECT * FROM $t_element ".
	       "  WHERE templateid=$templateid ".
	       "    AND $t_element.type!='infodate' AND $t_element.type!='info'".
	       "  ORDER BY name ASC";
	$res = $db->query($sql);
	if (DB::isError($res)) die ($res->getMessage().'<br>'.$sql);
	while ($row = $res->fetchrow(DB_FETCHMODE_ASSOC) )
	{
		$SESS['tree']['page'.$pageid.'el'.$row['id'] ] = array('text'   => $row['name'],
		                                   'url'    => "main.$conf_php?action=pageelement&pageid=".$pageid.'&elementid='.$row['id'],
		                                   'icon'   => 'el_'.$row['type'],
		                                   'parent' => "page$pageid",
		                                   'target' => 'cms_main' );
	}
	$res->free();
}


// Füllen der Ausgabevariablen
//
$var = array();

// Erzeugen des Baumes. Die Ausgabe erfolgt in die Variable $var
tree_show( &$var );

// Link zum Aktualisieren
$var['refresh_url'] = $PHP_SELF.'?treeaction='.$SESS['treeaction'];

// Ausgabe des Templates
//
output('tree',$var);

?>