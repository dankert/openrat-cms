<?php
// ---------------------------------------------------------------------------
// $Id$
// ---------------------------------------------------------------------------
// OpenRat Content Management System
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
// Revision 1.3  2004-11-10 22:36:45  dankert
// Laden von Projektklassen und Lesen/Schreiben von/nach Session
//
// Revision 1.2  2004/05/02 14:49:37  dankert
// Einf?gen package-name (@package)
//
// Revision 1.1  2004/04/24 15:14:52  dankert
// Initiale Version
//
// ---------------------------------------------------------------------------


/**
 * Action-Klasse fuer die Start-Action
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */

class IndexAction extends Action
{
	var $defaultSubAction = 'show';


	function checkForDb()
	{
		global $conf;
		$dbid = $this->getRequestVar('dbid'); 

		if	( $dbid != '' )
		{
			$db = new DB( $conf['database_'.$dbid] );
			$db->id = $dbid;
			$db->setFetchMode( DB_FETCHMODE_ASSOC );
			Session::setDatabase( $db );
		}
	}



	function checkLogin( $name,$pw )
	{
		Logger::debug( "login user $name" );
	
		global $conf;
		global $SESS;
	
		unset( $SESS['user'] );	
	
		
		$db = db_connection();
		
		$ip = getenv("REMOTE_ADDR");
	
		$user = new User();
		$user->name = $name;
		
		$ok = $user->checkPassword( $pw );
		
		// Falls Login erfolgreich
		if  ( $ok )
		{
			// Login war erfolgreich!
			$user->load();
			$user->loadProjects();
			//$user->loadRights();
			$user->setCurrent();
			Session::setUser( $user );
			Logger::info( 'login successful' );

			return true;
		}
		else
		{
			Logger::info( "login for user $name failed" );
			$SESS['loginmessage'] = lang('LOGIN_FAILED');

			return false;
		}
	}


	function showlogin()
	{
		global $conf;


		$databases = explode(',',$conf['database']['databases']);
		$dbids = array();
		
		foreach( $databases as $db )
		{
			if   ( !isset($conf['database_'.$db]) )
				$this->message( '',"configuration for 'database_$db' not defined in config.ini.php");
		
			$dbids[$db] = $conf['database_'.$db]['comment'];
		}

		$this->setTemplateVar( 'dbids',$dbids );
		
		if	( $this->getSessionVar('dbid') != '' )
			$this->setTemplateVar('actdbid',$this->getSessionVar('dbid'));
			$this->setTemplateVar('actdbid',$conf['database']['default']);

		$this->setTemplateVar('loginmessage',$this->getSessionVar('loginmessage'));
		$this->setSessionVar('loginmessage','');

		$this->forward('login');
	}

	function showmenu()
	{
		$user     = Session::getUser();
		$projects = $user->projects;

		// Administrator sieht Administrationsbereich
		if   ( $user->isAdmin )
			$projects = array("-1"=>lang('ADMINISTRATION')) +  $projects;

		// Projekte ermitteln

		$list = array();
		foreach( $projects as $id=>$name )
		{
			$list[$id]         = array();
			$list[$id]['url' ] = Html::url(array('action'=>'index','subaction'=>'show','projectid'=>$id));
			$list[$id]['name'] = $name;
		}
		$this->setTemplateVar('el',$list);
	
		$this->forward('project_select');
	}

	function login()
	{
		global $SESS;
		global $conf;
		# Ein Benutzer versucht sich anzumelden
		#
		$this->checkForDb();
		unset( $SESS['user'] );
		Session::setUser('');

		$this->checkLogin( $this->getRequestVar('login_name'    ),
		                   $this->getRequestVar('login_password')  );
		
		$this->callSubAction('show');
	}


	function logout()
	{
		global $SESS;
		unset( $SESS['user'] );
		Session::setUser('');
		
		$this->callSubAction('show');
	}


	function show()
	{
		global $conf;

		if   ( Session::getLanguage() === '' )
			language_read();

		$user = Session::getUser();
		if   ( ! is_object($user) )
		{
			// Authorization ueber HTTP
			//
			if   ( $conf['auth']['type'] == 'http' )
			{
			    if	( isset($PHP_AUTH_USER) )
			    {
					$this->checkLogin( $PHP_AUTH_USER,$PHP_AUTH_PW );
			   	}
			   	else
				{				
					header( 'WWW-Authenticate: Basic realm="OpenRat Content Management System - Login"' );
					header( 'HTTP/1.0 401 Unauthorized' );
					echo 'Authorization Required!';
					exit;
				}
			}

			// Benutzer ist nicht angemeldet
			$this->callSubAction( 'showlogin' ); // Anzeigen der Login-Maske
		}

		$title = $conf['global']['title'].' '.$conf['global']['version'];


		$projectid  = intval( $this->getRequestVar('projectid' ) );
		$languageid = intval( $this->getRequestVar('languageid') );
		$objectid   = intval( $this->getRequestVar('objectid'  ) );

		if	( $objectid > 0 )
		{
			$objectid = new Object( $objectid );
			$object->objectLoadRaw();
			Session::setObject( $object );

			$project = new Project( $object->projectid );
			$project->load();
			Session::setProject( $project );
			
			$language = new Language( $project->getDefaultLanguageId() );
			$language->load();
			Session::setProjectLanguage( $language );

			$model = new Model( $project->getDefaultModelId() );
			$model->load();
			Session::setProjectModel( $model );
			
			$user->loadRights( $project->projectid,$language->languageid );
			Session::setUser( $user );
		}
		elseif	( $languageid > 0 )
		{
			$language = new Language( $languageid );
			$language->load();
			Session::setProjectLanguage( $language );

			$project = new Project( $language->projectid );
			$project->load();
			Session::setProject( $project );

			$model = new Model( $project->getDefaultModelId() );
			$model->load();
			Session::setProjectModel( $model );

			$object = new Object( $project->getRootObjectId() );
			$object->objectLoadRaw();
			Session::setObject( $object );

			$user->loadRights( $project->projectid,$language->languageid );
			Session::setUser( $user );
		}
		elseif	( $projectid > 0 )
		{
			$project = new Project( $projectid );
			$project->load();
			Session::setProject( $project );
			
			$language = new Language( $project->getDefaultLanguageId() );
			$language->load();
			Session::setProjectLanguage( $language );

			$model = new Model( $project->getDefaultModelId() );
			$model->load();
			Session::setProjectModel( $model );

			$object = new Object( $project->getRootObjectId() );
			$object->objectLoadRaw();
			Session::setObject( $object );

			$user->loadRights( $project->projectid,$language->languageid );
			Session::setUser( $user );
		}


		$db = Session::getDatabase();
		$this->setTemplateVar( 'title',$user->name.' @'.$db->conf['comment'].' - '.$title );

		$object  = Session::getObject();
		$project = Session::getProject();

		if	( is_object($object) )
		{
			$this->setTemplateVar( 'frame_src_main'    ,Html::url( array('action'    =>'main',
			                                                             'callAction'=>$object->getType() )) );
		}
		elseif	( is_object($project) )
		{

			$this->setTemplateVar( 'frame_src_main'    ,Html::url( array('action'=>'main',
			                                                         'callAction'=>'folder' )) );
		}
		else
		{
			$this->callSubAction( 'showmenu' );
		}
		
		$this->setTemplateVar( 'frame_src_title'   ,Html::url( array('action'=>'title'   )) );
		$this->setTemplateVar( 'frame_src_treemenu',Html::url( array('action'=>'treemenu')) );
		$this->setTemplateVar( 'frame_src_tree'    ,Html::url( array('action'=>'tree',
		                                                             'subaction'=>'load')) );

		$this->setTemplateVar( 'tree_width',$conf['global']['tree_width'] );
		
		$this->forward( 'frameset' );
	}
}

?>