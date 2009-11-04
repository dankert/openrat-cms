<?php
// ---------------------------------------------------------------------------
// $Id$
// ---------------------------------------------------------------------------
// OpenRat Content Management System
// Copyright (C) 2002-2004 Jan Dankert, cms@jandankert.de
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


/**
 * Action-Klasse zum Bearbeiten eines Benutzers
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */
class UserAction extends Action
{
	var $user;
	var $defaultSubAction = 'edit';


	function UserAction()
	{
		if   ( !$this->userIsAdmin() )
			die('you are not an admin');

		if	( $this->getRequestId() != 0 )
		{
			$this->user = new User( $this->getRequestId() );
			$this->user->load();
			$this->setTemplateVar('userid',$this->user->userid);
		}
	}


	function save()
	{
		if	( $this->getRequestVar('name') != '' )
		{
			// Benutzer speichern
			$this->user->name     = $this->getRequestVar('name'    );
			$this->user->fullname = $this->getRequestVar('fullname');
			$this->user->isAdmin  = $this->hasRequestVar('is_admin');
			$this->user->ldap_dn  = $this->getRequestVar('ldap_dn' );
			$this->user->tel      = $this->getRequestVar('tel'     );
			$this->user->desc     = $this->getRequestVar('desc'    );
			
			global $conf;
			if	( @$conf['security']['user']['show_mail'] )
				$this->user->mail = $this->getRequestVar('mail'    );
				
			$this->user->style    = $this->getRequestVar('style'   );
	
			$this->user->save();
			$this->addNotice('user',$this->user->name,'SAVED','ok');
		}
		else
		{
			$this->addValidationError('name');
			$this->callSubAction('edit');
		}
	}



	function remove()
	{
		$this->setTemplateVars( $this->user->getProperties() );
	}
	
	
	
	function delete()
	{
		if   ( $this->hasRequestVar('confirm') )
		{
			$this->user->delete();
			$this->addNotice('user',$this->user->name,'DELETED','ok');
		}
		else
		{
			$this->addValidationError('confirm');
			$this->callSubAction('remove');
		}
	}


	function add()
	{
	}
	
	
	
	function adduser()
	{
		if	( $this->getRequestVar('name') != '' )
		{
			$this->user = new User();
			$this->user->add( $this->getRequestVar('name') );
			$this->addNotice('user',$this->user->name,'ADDED','ok');
		}
		else
		{
			$this->addValidationError('name');
			$this->callSubAction('add');
		}
	}


	function addgrouptouser()
	{
		$this->user->addGroup( $this->getRequestVar('groupid') );
	
		$this->addNotice('user',$this->user->name,'ADDED','ok');
	}


	function addgroup()
	{
		// Alle hinzufuegbaren Gruppen ermitteln
		$this->setTemplateVar('groups',$this->user->getOtherGroups());
	}


	function delgroup()
	{
		$this->user->delGroup( $this->getRequestVar('groupid') );

		$this->addNotice('user',$this->user->name,'DELETED','ok');
	}


	/**
	 * Das Kennwort wird an den Benutzer geschickt
	 *
	 * @access private
	 */
	function mailPw( $pw )
	{
		$to   = $this->user->fullname.' <'.$this->user->mail.'>';
		$mail = new Mail($to,'USER_MAIL');

		$mail->setVar('username',$this->user->name      );
		$mail->setVar('password',$pw                    );
		$mail->setVar('name'    ,$this->user->getName() );

		$mail->send();
	}


	/**
	 * Aendern des Kennwortes
	 */
	function pwchange()
	{
		global $conf;

		$pw1 = $this->getRequestVar('password1');
		$pw2 = $this->getRequestVar('password2');

		// Zufaelliges Kennwort erzeugen
		if	( $this->hasRequestVar('random') && $this->hasRequestVar('email') )
		{
			$pw1 = $this->user->createPassword();
			$pw2 = $pw1;
		}

		if ( strlen($pw1)<intval($conf['security']['password']['min_length']) )
		{
			$this->addValidationError('password1');
			$this->callSubAction('pw');
		}
		elseif	( $pw1 != $pw2 )
		{
			$this->addValidationError('password2');
			$this->callSubAction('pw');
		}
		else
		{
			// Kennwoerter identisch und lang genug
			$this->user->setPassword($pw1,!$this->hasRequestVar('timeout') ); // Kennwort setzen
			
			// E-Mail mit dem neuen Kennwort an Benutzer senden
			if	( $this->hasRequestVar('email') && !empty($this->user->mail) && $conf['mail']['enabled'] )
			{
				$this->mailPw( $pw1 );
				$this->addNotice('user',$this->user->name,'MAIL_SENT','ok');
			}

			$this->addNotice('user',$this->user->name,'SAVED','ok');
		}

	}



	function listing()
	{
		$list = array();

		foreach( User::getAllUsers() as $user )
		{
			$list[$user->userid]         = $user->getProperties();
			$list[$user->userid]['url' ] = Html::url('main','user',$user->userid,
			                                         array(REQ_PARAM_TARGETSUBACTION=>'edit') );
		}
		$this->setTemplateVar('el',$list);
	}	
		

	/**
	 * Eigenschaften des Benutzers anzeigen
	 */
	function edit()
	{
		$this->setTemplateVars( $this->user->getProperties() );

		$this->setTemplateVar( 'allstyles',$this->user->getAvailableStyles() );
	}


	function memberships()
	{
		
	}

	
	function groups()
	{
		// Mitgliedschaften
//		$this->setTemplateVar('memberships',$this->user->getGroups());
		
		$gruppenListe = array();
		
		$allGroups  = Group::getAll();
		$userGroups = $this->user->getGroups();
		
		foreach( $allGroups as $id=>$name )
		{
			
			$hasGroup = array_key_exists($id,$userGroups);
			$varName  = 'group'.$id;
			$gruppenListe[$id] = array('name'       =>$name,
			                           'id'         =>$id,
			                           'var'        =>$varName,
			                           'member'     =>$hasGroup
			                          );
			$this->setTemplateVar($varName,$hasGroup);
		}
		$this->setTemplateVar('memberships',$gruppenListe);
		
		global $conf;
		if	($conf['security']['authorize']['type']=='ldap')
			$this->addNotice('user',$this->user->name,'GROUPS_MAY_CONFLICT_WITH_LDAP',OR_NOTICE_WARN);
	}


	function savegroups()
	{
		$allGroups  = Group::getAll();
		$userGroups = $this->user->getGroups();
		
		foreach( $allGroups as $id=>$name )
		{
			$hasGroup = array_key_exists($id,$userGroups);
			
			if	( !$hasGroup && $this->hasRequestVar('group'.$id) )
			{
				$this->user->addGroup($id);
				$this->addNotice('group',$name,'ADDED');
			}

			if	( $hasGroup && !$this->hasRequestVar('group'.$id) )
			{
				$this->user->delGroup($id);
				$this->addNotice('group',$name,'DELETED');
			}
		}
	}


	/**
	 * Aendern des Kennwortes
	 */
	function pw()
	{
		$this->setTemplateVars( $this->user->getProperties() );
	}


	/**
	 * Anzeigen der Benutzerrechte
	 */
	function rights()
	{
		$rights = $this->user->getAllAcls();

		$projects = array();
		
		foreach( $rights as $acl )
		{
			if	( !isset($projects[$acl->projectid]))
			{
				$projects[$acl->projectid] = array();
				$p = new Project($acl->projectid);
				$p->load();
				$projects[$acl->projectid]['projectname'] = $p->name;
				$projects[$acl->projectid]['rights'     ] = array();
			}

			$right = array();
			
			if	( $acl->languageid > 0 )
			{
				$language = new Language($acl->languageid);
				$language->load();
				$right['languagename'] = $language->name;
			}
			else
			{
				$right['languagename'] = lang('ALL_LANGUAGES');
			}
			
			
			$o = new Object($acl->objectid);
			$o->objectLoad();
			$right['objectname'] = $o->name;
			$right['objectid'  ] = $o->objectid;
			$right['objecttype'] = $o->getType();
			
			if	( $acl->userid > 0 )
			{
				$user = new User($acl->userid);
				$user->load();
				$right['username'] = $user->name;
			}
			elseif	( $acl->groupid > 0 )
			{
				$group = new Group($acl->groupid);
				$group->load();
				$right['groupname'] = $group->name;
			}
			else
			{
				// Berechtigung f�r "alle".
			}

//			$show = array();
//			foreach( $acl->getProperties() as $p=>$set)
//				$show[$p] = $set;
//				
//			$right['show'] = $show;
			$right['bits'] = $acl->getProperties();
			
			$projects[$acl->projectid]['rights'][] = $right;
		}
		
		$this->setTemplateVar('projects'    ,$projects );
		
		$this->setTemplateVar('show',Acl::getAvailableRights() );
		
		if	( $this->user->isAdmin )
			$this->addNotice('user',$this->user->name,'ADMIN_NEEDS_NO_RIGHTS',OR_NOTICE_WARN);
	}
	
	
	/**
	 * @param String $name Men�punkt
	 * @return boolean
	 */
	function checkMenu( $menu )
	{
		global $conf;

		switch( $menu )
		{
			case 'add':
			case 'remove':
				return !readonly();
					
			case 'addgroup':
				return !readonly() && count($this->user->getOtherGroups()) > 0;

			case 'groups':
				return !readonly() && count($this->user->getGroups()) > 0;
	
			case 'pw':
				return    !readonly()
					   && @$conf['security']['auth']['type'] == 'database'
				       && !@$conf['security']['auth']['userdn'];
		}
		
		return true;
	}
	
				
}