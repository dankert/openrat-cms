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
// Revision 1.1  2004-04-24 15:14:52  dankert
// Initiale Version
//
// ---------------------------------------------------------------------------


class IndexAction extends Action
{
	var $defaultSubAction = 'show';


	function checkLogin( $name,$pw,$db )
	{
		Logger::debug( "user $name wants to log in at database $db" );
	
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
			$user->setCurrent();
			
//			// Gruppen lesen
//			$sql = new Sql('SELECT groupid FROM {t_usergroup} '.
//			               'WHERE userid={userid}');
//			$sql->setInt('userid',$SESS['user']['id']);
//			$groups = $db->getCol( $sql->query );
//	
//			$SESS['user']['projects'] = array();
//			
//			
//			// Alle ACLs zum Benutzer (und seinen Gruppen) werden gelesen und
//			// dem Benutzer in der aktuellen Session hinzugefügt.
//			foreach( Acl::getACLsFromUserId($user->userid) as $aclid )
//			{
//				$user->addACL( $aclid );
//			}
//	
//			foreach( $user->getGroupIds() as $groupid )
//			{
//				foreach( Acl::getACLsFromGroupId($groupid) as $aclid )
//				{
//					$user->addACL( $aclid );
//				}
//			}
	
	//		print_r( $SESS['user']['rights'] );
	
	//		$SESS['rights'] = array();
	
	//		$sql = new Sql('SELECT * FROM {t_acl} WHERE userid={userid}');
	//		$sql->setInt('userid',$SESS['user']['id']);
	//		$res = $db->query( $sql->query );
	//		
	//		while( $row = $res->fetchRow() )
	//		{
	//			$f = new Folder( $row['folderid'] );
	//			$f->projectid = $row['projectid'];
	//			$f->addrights( $row );
	//			unset( $f );
	//		}
			
	//		foreach( $groups as $groupid )
	//		{
	//			$sql = new Sql('SELECT * FROM {t_acl} WHERE groupid={groupid}');
	//			$sql->setInt('groupid',$groupid);
	//			$res = $db->query( $sql->query );
	//
	//			while( $row = $res->fetchRow() )
	//			{
	//				$f = new Folder( $row['folderid'] );
	//				$f->projectid = $row['projectid'];
	//				$f->addrights( $row );
	//				unset( $f );
	//			}
	//		}
	
			// Wenn keine Berechtigung vorhanden, dann kein Login möglich
//			if   ( count($SESS['user']) == 0 && $SESS['user']['is_admin']!='1' )
//			{
//				unset($SESS['user']);
//			}
//			else
//			{
//				if	( $SESS['user']['is_admin']=='1' )
//				{
//					// Für Administratoren einfach das 1.vorhandene Projekt auswählen
//					$sql = new SQL('SELECT id FROM {t_project} ORDER BY name');
//					$SESS['projectid'] = $db->getOne( $sql->query );
//					//echo "fuck, verdammt".$SESS['projectid'];
//				}
//				else
//				{
//					// Wenn noch kein Projekt in der Session vorhanden, dann
//					// das erste Projekt starten
//					if   ( !is_numeric($SESS['projectid']) )
//					{
//						$projects = array_keys( $SESS['rights'] );
//						$SESS['projectid'] = $projects[0];
//					}
//				}
//			}
		}
	
		if   ( isset($SESS['user']) )
		{
			Logger::info( 'login successful' );
		}
		else
		{
			Logger::info( "login for user $name failed" );
			
			$SESS['loginmessage'] = lang('LOGIN_FAILED');
		}
	}


	function login()
	{
		global $SESS;
		# Ein Benutzer versucht sich anzumelden
		#
		unset( $SESS['user'] );
		
		$SESS['dbid'] = $this->getRequestVar('dbid');

		$this->checkLogin( $this->getRequestVar('login_name'    ),
		                   $this->getRequestVar('login_password'),
		                   $this->getRequestVar('dbid'          )  );
		
		
		$this->callSubAction('show');
	}


	function logout()
	{
		global $SESS;
		unset( $SESS['user'] );
		
		$this->callSubAction('show');
	}


	function show()
	{
		global $SESS,$conf;

		if   ( !isset($SESS['lang']) )
		{
			language_read();
		}
		
		
		// Authorization über HTTP
		//
		if   ( $conf['auth']['type'] == 'http' )
		{
		    if	( isset($PHP_AUTH_USER) )
		    {
		    	login( $PHP_AUTH_USER,$PHP_AUTH_PW,$db );
		   	}
		   	
		   	# Falls Benutzer nicht angemeldet, dann Login-Maske präsentieren
		   	#
		   	if   ( !isset($sess_user) )
		   	{
				header( 'WWW-Authenticate: Basic realm="Login"' );
				header( 'HTTP/1.0 401 Unauthorized' );
				echo 'Authorization Required!';
				exit;
			}
		}


		$title = $conf['global']['title'].' '.$conf['global']['version'];
		
		if   (!isset($SESS['user']))
		{
			$this->setTemplateVar( 'title',lang('NOT_LOGGED_IN').' - '.$title );
			$this->setTemplateVar( 'frame_src_main',Html::url( array('action'=>'main',
			                                                     'callAction'=>'login',
			                                                  'callSubaction'=>'login' )) );
		}
		else
		{
			$this->setTemplateVar( 'title',$SESS['user']['name'].' @'.$conf['database_'.$SESS['dbid']]['comment'].' - '.$title );

			if	( $this->getSessionVar('objectid') != '' )
			{
				$object = new Object( $this->getSessionVar('objectid') );
				$object->load();
				$this->setSessionVar('projectid',$object->projectid);

				$this->setTemplateVar( 'frame_src_main'    ,Html::url( array('action'=>'main',
				                                                         'callAction'=>$object->getType() )) );
			}
			else
			{
				if	( $this->getSessionVar('projectid') != '' )
				{
					$project = new Project( $this->getSessionVar('projectid') );
					$objectid = $project->getRootObjectId();
					$this->setSessionVar('objectid',$objectid);

					$this->setTemplateVar( 'frame_src_main'    ,Html::url( array('action'=>'main',
					                                                         'callAction'=>'folder' )) );
				}
				else
				{
					$this->setTemplateVar( 'frame_src_main'    ,Html::url( array('action'=>'main',
					                                                         'callAction'=>'login',
					                                                         'callSubaction'=>'blank' )) );
				}
			}
		}
		
		$this->setTemplateVar( 'frame_src_title'   ,Html::url( array('action'=>'title'   )) );
		$this->setTemplateVar( 'frame_src_treemenu',Html::url( array('action'=>'treemenu')) );
		$this->setTemplateVar( 'frame_src_tree'    ,Html::url( array('action'=>'tree',
		                                                             'subaction'=>'reload')) );

		// Breite des Baums ermitteln
		if   (isset($SESS['user']))
			$this->setTemplateVar( 'tree_width',$conf['global']['tree_width'] );
		else $this->setTemplateVar( 'tree_width','0' );
		
		$this->forward( 'frameset' );
	}
}

?>