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
// Revision 1.1  2003-09-25 20:26:25  dankert
// *** empty log message ***
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
include( "$conf_incldir/db.inc.$conf_php" );
include( "$conf_incldir/page.inc.$conf_php" );
include( "$conf_incldir/request.inc.$conf_php" );

request_into_session('elementid');
request_into_session('elementaction');

session_write_close();

$var = array();

// Datenbank Verbindung
$db = db_connection();


// Ändern des Element-Typs
//
if   ($REQ['elementaction'] == 'changetype')
{
	// SQL-Befehl
	$sql = "UPDATE $t_element ".
	       "SET type='".$REQ['type']."' ".
	       "WHERE id=".$SESS['elementid'];
	echo $sql;
	$res = $db->query($sql);
	#if ($res->isError()) die ('fehler');
	#$res->free();

	$elementaction = 'edit';
}



if   ($elementaction == 'edit')
{
	$sql = "SELECT * FROM $t_element WHERE id=".$SESS['elementid'];
	$res = $db->query($sql);
	$row = $res->fetchRow(DB_FETCHMODE_ASSOC);
	$res->free();

	$var['action']     = 'template.'.$conf_php;
	$var['self'  ]     = 'element.'.$conf_php;
	$var['name']       = $row['name'];
	$var['desc']       = $row['desc'];
	
	$var['type'] = array();
	$var['type']['include']   = '';
	$var['type']['date']      = '';
	$var['type']['text']      = '';
	$var['type']['longtext']  = '';
	$var['type']['number']    = '';
	$var['type']['link']      = '';
	$var['type']['file']      = '';
	$var['type']['resize']    = '';
	$var['type']['code']      = '';
	$var['type']['info']      = '';
	$var['type']['infodate']  = '';
	$var['type']['code']      = '';
	
	foreach( $var['type'] as $k=>$t )
	{
		$var['type'][ $k ] = lang('EL_'.$k);
	}
	
	$var['default_type'] = $row['type'];


	// Eigenschaften Info-Datum
	if   ($row['type'] == 'infodate' )
	{
		$var['subtype'] = array();
		$var['subtype']['date_published'] = '';
		$var['subtype']['date_saved'    ] = '';
		foreach( $var['subtype'] as $k=>$t )
		{
			$var['subtype'][ $k ] = lang($k);

			if   ( $k == $row['subtype'] )
				$var['act_subtype'] = $k;
		}
	}


	// Eigenschaften allg. Info-Element
	if   ($row['type'] == 'info' )
	{
		$var['subtype'] = array();
		$var['subtype']['id_db'] = '';
		$var['subtype']['id_project'] = '';
		$var['subtype']['id_page'] = '';
		$var['subtype']['id_user'] = '';
		$var['subtype']['id_pageuser'] = '';
		$var['subtype']['id_projectmodel'] = '';
		$var['subtype']['id_language'] = '';
		$var['subtype']['name_db'] = '';
		$var['subtype']['name_project'] = '';
		$var['subtype']['name_page'] = '';
		$var['subtype']['name_user'] = '';
		$var['subtype']['fullname_user'] = '';
		$var['subtype']['mail_user'] = '';
		$var['subtype']['name_pageuser'] = '';
		foreach( $var['subtype'] as $k=>$t )
		{
			$var['subtype'][ $k ] = lang($k);

			if   ( $k == $row['subtype'] )
				$var['act_subtype'] = $k;
		}
	}


	// Eigenschaften Info-Datum und allg. Datum
	if   ($row['type'] == 'infodate' || $row['type'] == 'date')
	{
		$ini_date_format = parse_ini_file( $conf_languagedir.'/dateformat.ini.'.$conf_php );
		$var['dateformat'] = array();
		foreach($ini_date_format as $idx=>$d)
		{
			$var['dateformat'][$idx] = date($d);
			
			if   ( $d == $row['dateformat'] )
				$var['act_dateformat'] = $idx;
		}

	}


	// Eigenschaften verkleinertes Bild
	if   ($row['type'] == 'resize')
	{
		// Alle Ordner ermitteln
		$var['folder'] = array();
		$var['folder']['null'] = '&lt;'.lang('ROOT_DIRECTORY').'&gt;';
		
		$sql = "SELECT * FROM $t_folder ".
		       "WHERE projectid=".$SESS['projectid'];
		$res_f = $db->Query($sql);
		while( $row_f = $res_f->fetchRow() )
		{
			$var['folder'][$row_f['id']] = implode('/',folder_path($row_f['id'],false));
		}
		asort( $var['folder'] );

		$var['act_folderid'] =  isset($row['folderid' ]) ? $row['folderid']  : '';

		$var['width']  = isset($row['width'])  ? $row['width']   : '';
		$var['height'] = isset($row['height']) ? $row['height']  : '';
	}


	// Eigenschaften Datei
	if   ($row['type'] == 'file')
	{
		// Alle Ordner ermitteln
		$var['folder'] = array();
		$var['folder']['null'] = '&lt;'.lang('ROOT_DIRECTORY').'&gt;';
		
		$sql = "SELECT * FROM $t_folder ".
		       "WHERE projectid=".$SESS['projectid'];
		$res_f = $db->Query($sql);
		while( $row_f = $res_f->fetchRow() )
		{
			$var['folder'][$row_f['id']] = implode('/',folder_path($row_f['id'],false));
		}
		asort( $var['folder'] );

		$var['act_folderid'] =  isset($row['folderid' ]) ? $row['folderid']  : '';
		$var['extension']    =  isset($row['extension']) ? $row['extension'] : '';
	}


	// Eigenschaften Text und Text-Absatz
	if   ($row['type'] == 'text' )
	{
		$var['default_text'] = isset($row['default_text']) ? $row['default_text'] : '';
		$var['wiki']         = isset($row['wiki'        ]) ? $row['wiki'        ] : '';
		$var['html']         = isset($row['html'        ]) ? $row['html'        ] : '';
	}


	// Eigenschaften PHP-Code
	if   ($row['type'] == 'code' )
	{
		$var['code']         = isset($row['code']) ? $row['code'] : '';
	}


	// Eigenschaften Text und Text-Absatz
	if   ($row['type'] == 'longtext')
	{
		$var['default_longtext'] = isset($row['default_text']) ? $row['default_text'] : '';
		$var['wiki']             = isset($row['wiki'        ]) ? $row['wiki'        ] : '';
		$var['html']             = isset($row['html'        ]) ? $row['html'        ] : '';
	}



	// Eigenschaften Zahl
	if   ($row['type'] == 'number')
	{
		$var['decimals']     = isset($row['decimals'    ]) ? $row['decimals'    ] : '';
		$var['dec_point']    = isset($row['dec_point'   ]) ? $row['dec_point'   ] : '';
		$var['thousand_sep'] = isset($row['thousand_sep']) ? $row['thousand_sep'] : '';
	}


	// Eigenschaften Link auf Seite
	if   ($row['type'] == 'link')
	{
		$var['default_link']  = $row['default_link'];
	}

	//print_r($var);
	output('element',$var);
}


?>