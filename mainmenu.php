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
// Revision 1.1  2003-10-02 21:43:35  dankert
// erste Version
//
// ---------------------------------------------------------------------------

$conf = parse_ini_file( 'config.ini.php',true );

require_once( $conf['directories']['incldir'].
              '/config.inc.'.
              $conf['global']['ext']            );

session_start();

include( "$conf_incldir/language.inc.$conf_php" );
include( "$conf_incldir/theme.inc.$conf_php"    );
include( "$conf_incldir/request.inc.$conf_php"    );
include( "$conf_incldir/page.inc.$conf_php"    );
include( "$conf_incldir/db.inc.$conf_php"    );
include( "DB.$conf_php" );

$action = $SESS['action'];

$var = array();

$var['subaction'] = array();
$var['css_body_class'] = 'menu';

$var['type'] = lang( $SESS['action'] );



switch( $action )
{
	case 'login':
		$var['action'] = 'login.'.$conf_php;
		$var['name']   = 'loginaction';

		$var['subaction']['login'] = lang('LOGIN');
		
		break;


		
	case 'template':
	case 'element':

		$var['action'] = 'template.'.$conf_php;
	
		// Ermitteln Projectmodell
		$db  = db_connection();
		$sql = "SELECT name FROM $t_projectmodel WHERE id=".$SESS['projectmodelid'];
		$var['projectmodel_name'] = $db->getOne($sql);
		
		$var['name']   = 'tplaction';
		$var['id']     = 'tpl'.$SESS['templateid'];
	
		$var['subaction']['list'] = lang('LIST');
		
		if   ( isset($SESS['templateid']) )
		{
			$var['subaction']['show'] = lang('SHOW');
			$var['subaction']['el'  ] = lang('ELEMENTS');
			$var['subaction']['src' ] = lang('SOURCE');
			$var['subaction']['prop'] = lang('PROP');
			$var['subaction']['del' ] = lang('DELETE');
		}
		break;



	case 'page':
	case 'pageelement':
		$var['type'] = lang( 'PAGE' ).' (ID '.$var['id'] = $SESS['pageid'].')';
	
		// Ermitteln Sprache
		$db  = db_connection();
		$sql = "SELECT name FROM $t_language WHERE id=".$SESS['languageid'];
		$var['language_name']   = $db->getOne($sql);
	
		// Ermitteln Projectmodell
		$sql = "SELECT name FROM $t_projectmodel WHERE id=".$SESS['projectmodelid'];
		$var['projectmodel_name']   = $db->getOne($sql);
	
		$var['folder'] = page_get_folder( $SESS['pageid'],false );
	
		$var['action'] = 'page.'.$conf_php;
	
		// Ermitteln Namen der Seite
		$sql = "SELECT name FROM $t_page WHERE id=".$SESS['pageid'];
		$var['text']   = $db->getOne($sql);
	
		$var['name']   = 'pageaction';
		$var['id']   = 'page'.$SESS['pageid'];
	
		$var['subaction']['show'] = lang('SHOW');
		$var['subaction']['edit'] = lang('EDIT');
		$var['subaction']['el'  ] = lang('ELEMENTS');
		$var['subaction']['pub' ] = lang('PUBLISH');
		$var['subaction']['prop'] = lang('PROP');
		$var['subaction']['src' ] = lang('SOURCE');
		//$var['subaction']['info'] = lang('INFO');
		$var['subaction']['del' ] = lang('DELETE');
		//$var['subaction']['lang'] = lang('LANGUAGES');

		break;



	case 'user':
		$var['action'] = 'user.'.$conf_php;
		
		$var['name']     = 'useraction';
	
		$var['subaction']['show']   = lang('SHOW');
		$var['subaction']['edit']   = lang('EDIT');
		$var['subaction']['groups'] = lang('MEMBERSHIPS');
		$var['subaction']['acls']   = lang('RIGHTS');
		$var['subaction']['pw']     = lang('PASSWORD');

		break;



	case 'group':
		$var['action'] = 'group.'.$conf_php;
		
		$var['name']     = 'groupaction';
	
		$var['subaction']['show' ] = lang('SHOW');
		$var['subaction']['edit' ] = lang('EDIT');
		$var['subaction']['users'] = lang('MEMBERSHIPS');
		$var['subaction']['acls' ] = lang('RIGHTS');

		break;



	case  'file':
		$var['action'] = 'file.'.$conf_php;
		
		$var['name']     = 'fileaction';
		$var['id']   = 'file'.$SESS['fileid'];
	
		$var['subaction']['show'] = lang('SHOW');
		$var['subaction']['edit'] = lang('EDIT');
		$var['subaction']['pub' ] = lang('PUBLISH');
		$var['subaction']['del' ] = lang('DELETE');

		break;



	case 'folder':
		$var['action'] = 'folder.'.$conf_php;
		
		$var['name']     = 'folderaction';
		$var['id']   = 'f'.$SESS['folderid'];
	
		$var['subaction']['show'] = lang('SHOW');
		
		if   ( $SESS['folderid'] != '' && $SESS['folderid'] != 'null'  )
			$var['subaction']['edit'] = lang('EDIT');
	
		if   ( $SESS['user']['is_admin'] == '1' )
			$var['subaction']['rights'] = lang('RIGHTS');

		break;



	case 'project':
		$var['action'] = 'project.'.$conf_php;
		
		$var['name']     = 'projectaction';
		$var['subaction']['list'] = lang('LIST');
	
		if   (isset($SESS['projectid']))
			$var['subaction']['edit'] = lang('EDIT');

		break;



	case 'language':
		$var['action'] = 'language.'.$conf_php;
		
		$var['name']     = 'languageaction';
		$var['id'] = 'lang';
	
		$var['subaction']['list'   ] = lang('LIST');
		//$var['subaction']['edit'   ] = lang('EDIT');
		//$var['subaction']['remove' ] = lang('REMOVE');

		break;



	case 'projectmodel':
		$var['action'] = 'projectmodel.'.$conf_php;
		
		$var['name']     = 'projectmodelaction';
		$var['id']   = 'pvar';
	
		$var['subaction']['list'   ] = lang('LIST');
		//$var['subaction']['show'   ] = lang('SHOW');
		//$var['subaction']['edit'   ] = lang('EDIT');
		//$var['subaction']['remove' ] = lang('REMOVE');

		break;



	case 'search':
		$var['action'] = 'search.'.$conf_php;
		
		$var['name']     = 'searchaction';
	
		$var['subaction']['file'    ] = lang('SEARCH_FILE'    );
		$var['subaction']['page'    ] = lang('SEARCH_PAGE'    );
		$var['subaction']['template'] = lang('SEARCH_TEMPLATE');

		break;
}

output( 'main_menu',$var );

?>