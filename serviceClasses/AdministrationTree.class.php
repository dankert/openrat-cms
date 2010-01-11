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

/**
 * Darstellen einer Baumstruktur mit Administrationfunktionen
 * @author $Author$
 * @version $Revision$
 * @package openrat.services
 */
class AdministrationTree extends AbstractTree
{
	/**
	 * Alle Elemente des Baumes
	 */
	var $elements;
	var $confCache = array();
	
	function root()
	{
		if	( !$this->userIsAdmin )
			Http::notAuthorized('Administration-Tree is only visible for admins.');
			
		$treeElement = new TreeElement();
		$treeElement->text        = lang('GLOBAL_ADMINISTRATION');
		$treeElement->description = lang('GLOBAL_ADMINISTRATION');
		$treeElement->type        = 'administration';
		$treeElement->icon        = 'administration';
		
		$this->addTreeElement( $treeElement );
		$this->autoOpen[] = 2;
	}



	function administration()
	{
		global $conf;
		$conf_config = $conf['interface']['config'];

		$treeElement = new TreeElement();
		$treeElement->text        = lang('GLOBAL_PROJECTS');
		$treeElement->description = lang('GLOBAL_PROJECTS');
		$treeElement->url         = Html::url('main','project','',array(REQ_PARAM_TARGETSUBACTION=>'listing'));
		$treeElement->icon        = 'project';
		$treeElement->type        = 'projects';
		$treeElement->target      = 'cms_main';
		
		$this->addTreeElement( $treeElement );


		$treeElement = new TreeElement();
		$treeElement->text        = lang('USER_AND_GROUPS');
		$treeElement->description = lang('USER_AND_GROUPS');
		$treeElement->icon        = 'group';
		$treeElement->type        = 'userandgroups';
		
		$this->addTreeElement( $treeElement );
//		$this->userandgroups(0);;

		if	( $conf_config['enable'] )
		{
			$treeElement = new TreeElement();
			$treeElement->text        = lang('PREFERENCES');
			$treeElement->description = lang('PREFERENCES');
			$treeElement->icon        = 'config_folder';
			$treeElement->type        = 'prefs';
			
			$this->addTreeElement( $treeElement );
		}

		// Wechseln zu: Projekte...
		/*
		foreach( Project::getAll() as $id=>$name )
		{
			$treeElement = new TreeElement();
			
			$treeElement->text         = lang('PROJECT').' '.$name;
			$treeElement->url          = Html::url(array('action'    =>'tree',
		                                                  'subaction' =>'reload',
			                                             'projectid' =>$id       ));
			$treeElement->icon         = 'project';
			$treeElement->description  = '';
			$treeElement->target       = 'cms_tree';

			$this->addTreeElement( $treeElement );
		}
		*/
	}



	function userandgroups( $id )
	{
		$treeElement = new TreeElement();
		$treeElement->text        = lang('GLOBAL_USER');
		$treeElement->description = lang('GLOBAL_USER');
		$treeElement->url         = Html::url('main','user','',array(REQ_PARAM_TARGETSUBACTION=>'listing'));
		$treeElement->icon        = 'user';
		$treeElement->target      = 'cms_main';
		$treeElement->type        = 'users';
		
		$this->addTreeElement( $treeElement );

		$treeElement = new TreeElement();
		$treeElement->text        = lang('GLOBAL_GROUPS');
		$treeElement->description = lang('GLOBAL_GROUPS');
		$treeElement->url         = Html::url('main','group','',array(REQ_PARAM_TARGETSUBACTION=>'listing'));
		$treeElement->icon        = 'group';
		$treeElement->target      = 'cms_main';
		$treeElement->type        = 'groups';

		$this->addTreeElement( $treeElement );
	}


	function projects( $id )
	{
		// Schleife ueber alle Projekte
		foreach( Project::getAll() as $id=>$name )
		{
			$treeElement = new TreeElement();
			
			$treeElement->internalId   = $id;
			$treeElement->text         = $name;
			$treeElement->url          = Html::url('main','project',$id,
			                                       array(REQ_PARAM_TARGETSUBACTION=>'edit') );
			$treeElement->icon         = 'project';
			$treeElement->description  = '';
			$treeElement->target       = 'cms_main';

			$this->addTreeElement( $treeElement );
		}
	}



	function prefs_system( $id )
	{
		$system = array( 'time'   => date('r'),
		                 'os'     => php_uname('s'),
		                 'host'   => php_uname('n'),
		                 'release'=> php_uname('r'),
		                 'machine'=> php_uname('m'),
		                 'owner'  => get_current_user(),
		                 'pid'    => getmypid()          );
		
		foreach( $system as $key=>$value )
		{
			$treeElement = new TreeElement();
			$treeElement->text = $key.'='.$value;
			$treeElement->icon   = 'config_property';
			$this->addTreeElement( $treeElement );
		}

		if	( function_exists('getrusage') ) // Funktion existiert auf WIN32 nicht.
		{
			foreach( getrusage() as $name=>$value );
			{
				$treeElement = new TreeElement();
				$treeElement->text = $name.':'.$value;
				$treeElement->icon   = 'config_property';
				$this->addTreeElement( $treeElement );
			}
		}
	}
	
	


	function prefs_php( $id )
	{
		$php_prefs = array( 'version'             => phpversion(),
		                    'SAPI'                => php_sapi_name(),
		                    'session-name'        => session_name(),
		                    'magic_quotes_gpc'    => get_magic_quotes_gpc(),
		                    'magic_quotes_runtime'=> get_magic_quotes_runtime() );

		foreach( array('upload_max_filesize',
		               'file_uploads',
		               'memory_limit',
		               'max_execution_time',
		               'post_max_size',
		               'display_errors',
		               'register_globals'
		               ) as $iniName )
			$php_prefs[ $iniName ] = ini_get( $iniName );
			
		foreach( $php_prefs as $key=>$value )
		{
			$treeElement = new TreeElement();
			$treeElement->text = $key.'='.$value;
			$treeElement->icon   = 'config_property';
			$this->addTreeElement( $treeElement );
		}
	}
		

	
	function prefs_extensions( $id )
	{
		$extensions = get_loaded_extensions();
		asort( $extensions );
		 
		foreach( $extensions as $id=>$extensionName )
		{
			$treeElement = new TreeElement();
			$treeElement->text       = $extensionName;
			$treeElement->icon       = 'config_property';
			$treeElement->internalId = $id;
			$this->addTreeElement( $treeElement );
		}
	}
	
		
	
	function prefs_extension( $id )
	{
		$extensions = get_loaded_extensions();
		$functions = get_extension_funcs( $extensions[$id] );
		asort( $functions );

		foreach( $functions as $functionName )
		{
			$treeElement = new TreeElement();
			$treeElement->text = $functionName;
			$treeElement->icon   = 'config_property';
			$this->addTreeElement( $treeElement );
		}
	}
	
		
	
	function prefs( $id )
	{
		global $conf;
		
		if	( !@$conf['security']['show_system_info'] )
			return;
		
		$conf_config = $conf['interface']['config'];


		$treeElement = new TreeElement();
		
		$treeElement->internalId  = 0;
		$treeElement->text        = 'OpenRat';
		$treeElement->icon        = 'config_folder';

		if	( !empty($conf_config['file_manager_url']) )
			$treeElement->url         = $conf_config['file_manager_url'];
		$treeElement->target      = '_blank';
		$treeElement->description = '';
		$treeElement->type        = 'prefs_cms';
		$this->addTreeElement( $treeElement );



		if	( !empty($conf_config['show_system']) )
		{
			$treeElement = new TreeElement();
			
			$treeElement->internalId  = 0;
			$treeElement->text        = lang('GLOBAL_SYSTEM');
			$treeElement->icon        = 'config_folder';
			
			$treeElement->description = '';
			$treeElement->target      = 'cms_main';
			$treeElement->type        = 'prefs_system';
			$this->addTreeElement( $treeElement );
		}


		if	( !empty($conf_config['show_interpreter']) )
		{
			$treeElement = new TreeElement();
			
			$treeElement->internalId  = 0;
			$treeElement->text        = lang('GLOBAL_PHP');
			$treeElement->icon        = 'config_folder';
			
			$treeElement->description = '';
			$treeElement->target      = 'cms_main';
			$treeElement->type        = 'prefs_php';
			$this->addTreeElement( $treeElement );
		}


		if	( !empty($conf_config['show_extensions']) )
		{
			$treeElement = new TreeElement();
			
			$treeElement->internalId  = 0;
			$treeElement->text        = lang('GLOBAL_EXTENSIONS');
			$treeElement->icon        = 'config_folder';
			
			$treeElement->description = '';
			$treeElement->target      = 'cms_main';
			$treeElement->type        = 'prefs_extensions';
			$this->addTreeElement( $treeElement );
		}
	}


	function prefs_cms( $id )
	{
		global $conf;
		
		if	( $id == 0 )
		{
			$tmpConf = $conf;
		}
		else
			$tmpConf = $this->confCache[$id];
		
		foreach( $tmpConf as $key=>$value )
		{
			if	( is_array($value) )
			{
				$this->confCache[crc32($key)] = $value;

				$treeElement = new TreeElement();
				
				$treeElement->internalId  = crc32($key);
				$treeElement->text        = $key;
//				if	( $id == 0 )
//					$treeElement->url         = Html::url('main','prefs',0,array('conf'=>$key));
				$treeElement->icon        = 'config_folder';
				
				$treeElement->description = count($value).' '.lang('SETTINGS');
				$treeElement->target      = 'cms_main';
				$treeElement->type        = 'prefs_cms';
				$this->addTreeElement( $treeElement );
			}
			else
			{
				if	( $value=='' )
					// Anzeige 'Leer'
					$value = lang('EMPTY');
				elseif	( $value=='0' )
					// Anzeige 'Nein'
					$value = $value.' ('.lang('IS_NO').')';
				elseif	( $value=='1' )
					// Anzeige 'Ja'
					$value = '+'.$value.' ('.lang('IS_YES').')';
				elseif	( is_numeric($value) )
					// Anzeige numerische Werte
					$value = ($value>0?'+':'').$value;
				else
					// Anzeige von Zeichenketten
					$value = $value;
					
				$this->confCache[crc32($key)] = $value;

				if	( strpos($key,'pass') !== FALSE )
					$value = '***'; // Kennwörter nicht anzeigen
				
				$treeElement = new TreeElement();
				$treeElement->text        = $key.': '.$value;
				$treeElement->icon        = 'config_property';
				$treeElement->description = lang('SETTING')." '".$key."'".(!empty($value)?': '.$value:'');
					
				$this->addTreeElement( $treeElement );
			}
		}
	}


	function users( $id )
	{	
		foreach( User::getAllUsers() as $user )
		{
			$treeElement = new TreeElement();
			
			$treeElement->internalId  = $user->userid;
			$treeElement->text        = $user->name;
			$treeElement->url         = Html::url('main','user',
			                                      $user->userid,array(REQ_PARAM_TARGETSUBACTION=>'edit') );
			$treeElement->icon        = 'user';
			
			$desc =  $user->fullname;

			if	( $user->isAdmin )
				$desc .= ' ('.lang('USER_ADMIN').') ';
			if	( $user->desc == "" )
				$desc .= ' - '.lang('GLOBAL_NO_DESCRIPTION_AVAILABLE');
			else
				$desc .= ' - '.$user->desc;

			$treeElement->description = $desc;
			$treeElement->target      = 'cms_main';

			$this->addTreeElement( $treeElement );
		}
	}


	function groups( $id )
	{

		foreach( Group::getAll() as $id=>$name )
		{
			$treeElement = new TreeElement();
			
			$g = new Group( $id );
			$g->load();

			$treeElement->internalId  = $id;
			$treeElement->text        = $g->name;
			$treeElement->url         = Html::url('main','group',$id,
			                                      array(REQ_PARAM_TARGETSUBACTION=>'edit') );
			$treeElement->icon        = 'group';
	     	$treeElement->description = lang('GLOBAL_GROUP').' '.$g->name.': '.implode(', ',$g->getUsers());
			$treeElement->target      = 'cms_main';
			$treeElement->type        = 'userofgroup';

			$this->addTreeElement( $treeElement );
		}
	}


	function userofgroup( $id )
	{
		$g = new Group( $id );

		foreach( $g->getUsers() as $id=>$name )
		{
			$treeElement = new TreeElement();
			
			$u = new User( $id );
			$u->load();
			$treeElement->text        = $u->name;
			$treeElement->url         = Html::url('main','user',$id);
			$treeElement->icon        = 'user';
			$treeElement->description = $u->fullname;
			$treeElement->target      = 'cms_main';

			$this->addTreeElement( $treeElement );
		}
	}
}

?>