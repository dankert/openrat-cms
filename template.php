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
// Revision 1.1  2003-10-02 21:44:44  dankert
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
include( "$conf_incldir/db.inc.$conf_php" );

request_into_session('tplaction');
request_into_session('elementaction');
request_into_session('templateid');
request_into_session('templatemodelid');

$var = array();

$db = db_connection();

// Zugriff nur für Administratoren gestattet
if   ( $SESS['user']['is_admin'] != '1' )
	die('access denied');

// Speichern des Quelltextes
//
if   ( $SESS['tplaction'] == 'srcsave' )
{
	$text = $REQ['src'];
	
	$sql = "SELECT * FROM $t_element WHERE templateid=".$SESS['templateid'];
	$res = $db->query($sql);

	if   ($res->numRows() > 0)
	{
		while( $el = $res->fetchRow() )
		{
			// Falls dieses Element hinzugefügt werden soll
			if   ($REQ['addelement']=='1' && $REQ['elementid']==$el['id'])
			{
				$text .= "\n".'{{'.$el['id'].'}}';
			}

			if   ($REQ['addicon']=='1' && $REQ['iconid']==$el['id'])
			{
				$text .= "\n".'{{->'.$el['id'].'}}';
			}
		
			$text = str_replace('%%'.$el['name'].'%%'  ,'{{'.$el['id'].'}}',$text );
			$text = str_replace('%%->'.$el['name'].'%%','{{->'.$el['id'].'}}',$text );
		}
	}
	$res->free();

	// Speichern des Quelltextes
	//
	$sql = "UPDATE $t_templatemodel ".
	       "SET text='".$text."' ".
	       "WHERE id=".$REQ['templatemodelid'];
	$res = $db->query($sql);
	//echo "$sql";
	if (DB::isError($db)) die ($db->getMessage());


	// Wenn Element hinzugefügt wurde, dann bleibt es beim Quelltext-Modus.
	// Sonst wird zur Anzeige umgeschaltet

	if   ($REQ['addelement']=='1' || $REQ['addicon']=='1')
	{
		$SESS['tplaction'] = 'src';
	}
	else
	{
		$SESS['tplaction'] = 'show';
	}
}


// Speichern des Namens
//
if   ( $SESS['tplaction'] == 'propsave' )
{
	if   ( $REQ['name'] != '' )
	{
		$sql = "UPDATE $t_template ".
		       "SET name='".$REQ['name']."' ".
		       "WHERE id=".$SESS['templateid'];
		$res = $db->query($sql);
	}

	$var['tree_refresh'] = true;
	$SESS['tplaction'] = 'show';
}


// Speichern der Dateiendung
//
if   ( $SESS['tplaction'] == 'extensionsave' )
{
	if   ( $REQ['extension'] != '' )
	{
		$sql = "UPDATE $t_templatemodel ".
		       "   SET   extension='".$REQ['extension']."' ".
		       "   WHERE templateid=".$SESS['templateid'].
		       "     AND projectmodelid=".$SESS['projectmodelid'];
		$res = $db->query($sql);
	}

	$SESS['tplaction'] = 'show';
}


if   ( !isset($SESS['tplaction']))
	$SESS['tplaction'] = 'show';


if   ( $SESS['tplaction'] != 'list' )
{
	$sql = "SELECT * FROM $t_templatemodel ".
	       "   WHERE templateid=".$SESS['templateid'].
	       "     AND projectmodelid=".$SESS['projectmodelid'];
	$res = $db->query( $sql );
	
	// Wenn Templatevariante nicht vorhanden, diese anlegen
	if   ( $res->numRows() == 0 )
	{
		$sql = "INSERT INTO $t_templatemodel ".
		       "   (templateid,projectmodelid,text)".
		       "   VALUES(".$SESS['templateid'].",".$SESS['projectmodelid'].",'<html>\n</html>')";
		$res = $db->query( $sql );
	
		$sql = "SELECT * FROM $t_templatemodel ".
		       "   WHERE templateid=".$SESS['templateid'].
		       "     AND projectmodelid=".$SESS['projectmodelid'];
		$res = $db->query( $sql );
	}
	
	$row = $res->fetchRow();
}



// Element hinzufügen
//
if   ( $SESS['tplaction'] == 'addelement' )
{
	if  ( $REQ['name'] != '' )
	{
		$sql = new Sql('INSERT INTO {t_element} (templateid,name,type) '.
		               'VALUES ({templateid},{name},{type})');
		$sql->setInt   ( 'templateid',$SESS['templateid'] );
		$sql->setString( 'name'      ,$REQ['name']        );
		$sql->setString( 'type'      ,'text'              );
		
		$res = $db->query( $sql->query );
	}

	$var['tree_refresh'] = true;
	$SESS['tplaction'] = 'el';
}


if   ( $REQ['elementaction'] == 'rename' )
{
	if   ($REQ['delete'] == '1')
	{
		// Alle Inhalte mit diesem Element löschen
		$sql = new Sql('DELETE FROM {t_value} '.
		               '  WHERE elementid={elementid}'   );
		$sql->setInt( 'elementid',$SESS['elementid'] );
		$db->query($sql->query);

		// Element löschen
		$sql = new Sql('DELETE FROM {t_element} '.
		               '  WHERE id={elementid}'   );
		$sql->setInt( 'elementid',$SESS['elementid'] );
		$db->query($sql->query);


		$SESS['tplaction'] = 'el';
	}
	else
	{ 
		$t_element = $conf_db_prefix.'element';
		$sql = "UPDATE $t_element ".
		       "SET name='".$REQ['name']."',`desc`='".$REQ['desc']."' ".
		       "WHERE id=".$SESS['elementid'];
		$res = $db->query($sql);
	}

	$var['tree_refresh'] = true;
	$SESS['tplaction'] = 'el';
}


if   ( $REQ['elementaction'] == 'save' )
{
	$ini_date_format = parse_ini_file( $conf_languagedir.'/dateformat.ini.'.$conf_php );
	$dateformat   = (isset($REQ['dateformat']))   ? "'".addslashes($ini_date_format[$REQ['dateformat']])."'" : 'null';
	$width        = (isset($REQ['width']))        ? "'".intval($REQ['width'])."'"        : 'null';
	$height       = (isset($REQ['height']))       ? "'".intval($REQ['height'])."'"       : 'null';
	$subtype      = (isset($REQ['subtype']))      ? "'".$REQ['subtype']."'"      : 'null';
	$default_text = (isset($REQ['default_text'])) ? "'".$REQ['default_text']."'" : 'null';
	$wiki         = (isset($REQ['wiki']))         ? '1'                          : 'null';
	$html         = (isset($REQ['html']))         ? '1'                          : 'null';
	$decimals     = (isset($REQ['decimals']))     ? intval($REQ['decimals'])     : 'null';
	$dec_point    = (isset($REQ['dec_point']))    ? "'".$REQ['dec_point'   ]."'" : 'null';
	$thousand_sep = (isset($REQ['thousand_sep'])) ? "'".$REQ['thousand_sep']."'" : 'null';
	$extension    = (isset($REQ['extension'   ])) ? "'".$REQ['extension'   ]."'" : 'null';
	$folderid     = (isset($REQ['folderid'    ])) ? "'".$REQ['folderid'    ]."'" : 'null';
	$code         = (isset($REQ['code'        ])) ? "'".$REQ['code'        ]."'" : 'null';
	
	$sql = "UPDATE $t_element ".
	       "  SET dateformat=$dateformat,".
	       "      width=$width,".
	       "      height=$height,".
	       "      wiki=$wiki,".
	       "      html=$html,".
	       "      subtype=$subtype,".
	       "      default_text=$default_text,".
	       "      decimals=$decimals,".
	       "      dec_point=$dec_point,".
	       "      thousand_sep=$thousand_sep,".
	       "      extension=$extension,".
	       "      folderid=$folderid,".
	       "      code=$code".
	       "  WHERE id=".$SESS['elementid'];
	$res = $db->query($sql);
	//echo "$sql";
	$SESS['tplaction'] = 'el';
}


session_write_close();


// Löschen des Templates
//
if   ( $SESS['tplaction'] == 'confirmdel' )
{
	$var['extension'] = $row['extension']; 
	$sql = "SELECT name FROM $t_template WHERE id=".$SESS['templateid'];
	$var['name']      = $db->getOne( $sql );
	 
	// von diesem Template abhängige Seiten ermitteln
	//
	$sql = "SELECT * FROM $t_page WHERE templateid=".$SESS['templateid'];
	$res = $db->query($sql);

	$var['templateid'] = $SESS['templateid'];

	output('template_confirmdel',$var);
}


// Löschen des Templates
//
if   ( $SESS['tplaction'] == 'del' )
{
	$var['extension'] = $row['extension']; 
	$sql = "SELECT name FROM $t_template WHERE id=".$SESS['templateid'];
	$var['name']      = $db->getOne( $sql );
	 
	// von diesem Template abhängige Seiten ermitteln
	//
	$sql = "SELECT * FROM $t_page WHERE templateid=".$SESS['templateid'];
	$res = $db->query($sql);
	if   ( $res->numRows() > 0 )
		$var['confirm'   ] = false;
	else $var['confirm'   ] = true;

	$var['templateid'] = $SESS['templateid'];

	output('template_del',$var);
}


// Anzeige der Template-Eigenschaften
//
if   ( $SESS['tplaction'] == 'prop' )
{
	$var['extension'] = $row['extension']; 
	$sql = "SELECT name FROM $t_template WHERE id=".$SESS['templateid'];
	$var['name']      = $db->getOne( $sql );
	 
	// von diesem Template abhängige Seiten ermitteln
	//
	$sql = "SELECT * FROM $t_page WHERE templateid=".$SESS['templateid'];
	$res = $db->query($sql);

	$var['pages'] = array();
	while( $row = $res->fetchRow(DB_FETCHMODE_ASSOC) )
	{
		$pageid = $row['id'];
		$var['pages'][$pageid]         = array();
		$var['pages'][$pageid]['name'] = $row['name'];
		$var['pages'][$pageid]['url' ] = 'main.'.$conf_php.'?action=page&pageid='.$pageid;
	}
	$res->free();

	output('template_prop',$var);
}


// Bearbeiten
//
if   ( $SESS['tplaction'] == 'show' )
{
	$c = array( 'include' =>'lime',
	            'longtext'=>'lime',
	            'date'    =>'blue',
	            'info'    =>'white',
	            'infodate'=>'white',
	            'text'    =>'lime',
	            'link'    =>'fuchsia',
	            'number'  =>'lime',
	            'file'    =>'red',
	            'resize'  =>'red',
	            'icon'    =>'yellow' );
	
	$sql = "SELECT * FROM $t_element WHERE templateid=".$SESS['templateid'];
	$res = $db->query($sql);

	$row['text'] = htmlentities($row['text']);
	$row['text'] = str_replace("\n",'<br>',$row['text']);

	$elinh = array();
	
	if   ($res->numRows() > 0)
	{
		while( $el = $res->fetchRow() )
		{
			$row['text'] = str_replace('{{'.$el['id'].'}}',
			                           '<a href="element.'.$conf_php.'?elementaction=edit'.
			                           '&elementid='.$el['id'].
			                           '&elementaction=edit&'.session_name().'='.session_id().'" style="background-color:'.
			                           $c[$el['type']].'" target="cms_main_main">%%'.
			                           $el['name'].'%%</a>',
			                           $row['text'] );
			$row['text'] = str_replace('{{-&gt;'.$el['id'].'}}',
			                           '<a href="element.'.$conf_php.'?elementaction=edit'.
			                           '&elementid='.$el['id'].
			                           '&elementaction=edit&'.session_name().'='.session_id().'" style="background-color:'.
			                           $c[$el['type']].'" target="cms_main_main">%%->'.
			                           $el['name'].'%%</a>',
			                           $row['text'] );
		}
	}
	$res->free();


	//$row['text'] = str_replace('&lt;','<strong>&lt;</strong>',$row['text']);
	//$row['text'] = str_replace('&gt;','<strong>&gt;</strong>',$row['text']);

	$var['form_action'] = $PHP_SELF;
	$var['text']        = $row['text'];
	
	output('template_show',$var);
}


// Anzeigen der Template-Elemente
//
if   ( $SESS['tplaction'] == 'el' )
{
	$sql = "SELECT * FROM $t_element WHERE templateid=".$SESS['templateid'].' ORDER BY name ASC';
	$res = $db->query($sql);
	
	$var['action'] = 'template.'.$conf_php;
	$var['el'] = array();

	while( $row = $res->fetchRow(DB_FETCHMODE_ASSOC) )
	{
		$id = $row['id'  ];
		$var['el'][$id]         = array();
		$var['el'][$id]['url' ] = 'element.'.$conf_php.'?elementaction=edit&elementid='.$id;
		$var['el'][$id]['name'] = $row['name'];
		$var['el'][$id]['desc'] = $row['desc'];
		$var['el'][$id]['type'] = $row['type'];
	}
	$res->free();

	output('template_el',$var);
}



// Anzeigen des Template-Quellcodes
//
if   ( $SESS['tplaction'] == 'src' )
{
	$sql = "SELECT * FROM $t_element".
	       "   WHERE templateid=".$SESS['templateid'].
	       "   ORDER BY name";
	$res = $db->query($sql);

	$var['elements'] = array();

	if   ($res->numRows() > 0)
	{
		while( $el = $res->fetchRow() )
		{
			$var['elements'][$el['id']] = $el['name'];

			if   ( $el['type'] != 'info'     &&
			       $el['type'] != 'infodate' &&
			       $el['type'] != 'code'        )
				$var['icon_elements'][$el['id']] = lang('icon').' '.$el['name'];
			
			$row['text'] = str_replace('{{'.$el['id'].'}}',
			                           '%%'.$el['name'].'%%',
			                           $row['text'] );
			$row['text'] = str_replace('{{->'.$el['id'].'}}',
			                           '%%->'.$el['name'].'%%',
			                           $row['text'] );
		}
	}
	$res->free();
	
	$var['form_action'] = $PHP_SELF;
	$var['templatemodelid'] = htmlentities($row['id']);
	$var['text'] = htmlentities($row['text']);

	output('template_src',$var);
}


// Hinzufügen eines Templates
if   ( $SESS['tplaction'] == 'add' )
{
	if   ( $REQ['name'] != '' )
	{
		$sql = "INSERT INTO $t_template".
		       "   (name,projectid) VALUES('".$REQ['name']."',".$SESS['projectid'].")";
		$res = $db->query($sql);
	}
	$var['tree_refresh'] = true;

	$SESS['tplaction'] = 'list';
}



// Anzeigen des Template-Quellcodes
//
if   ( $SESS['tplaction'] == 'list' )
{
	$sql = new SQL( "SELECT * FROM {t_template}".
	                "   WHERE projectid={projectid} ".
	                "   ORDER BY name" );
	$sql->setVar( 'projectid',$SESS['projectid'] );
	$res = $db->query( $sql->query );

	$var['templates'] = array();

	if   ($res->numRows() > 0)
	{
		while( $tpl = $res->fetchRow() )
		{
			$var['templates'][$tpl['id']] = array();
			$var['templates'][$tpl['id']]['name'] = $tpl['name'];
			$var['templates'][$tpl['id']]['url']  = 'main.'.$conf_php.'?action=template&tplaction=show&templateid='.$tpl['id'];
		}
	}
	$res->free();
	
	$var['form_action'] = $PHP_SELF;
	$var['templatemodelid'] = htmlentities($row['id']);
	$var['text'] = htmlentities($row['text']);

	output('template_list',$var);
}

?>