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
		if   ( $this->hasRequestVar('delete') )
		{
			$this->user->delete();
			$this->addNotice('user',$this->user->name,'DELETED','ok');
		}
		else
		{
			// Benutzer speichern
			$this->user->name     = $this->getRequestVar('name'    );
			$this->user->fullname = $this->getRequestVar('fullname');
			$this->user->isAdmin  = $this->hasRequestVar('is_admin');
			$this->user->ldap_dn  = $this->getRequestVar('ldap_dn' );
			$this->user->tel      = $this->getRequestVar('tel'     );
			$this->user->desc     = $this->getRequestVar('desc'    );
			$this->user->mail     = $this->getRequestVar('mail'    );
			$this->user->style    = $this->getRequestVar('style'   );

			$this->user->save();
			$this->addNotice('user',$this->user->name,'SAVED','ok');
		}

		$this->callSubAction('listing');
	}


	function add()
	{
		$this->user = new User();
		$this->user->add( $this->getRequestVar('name') );
		$this->addNotice('user',$this->user->name,'ADDED','ok');
	
		$this->callSubAction('listing');
	}


	function addgroup()
	{
		$this->user->addGroup( $this->getRequestVar('groupid') );
	
		$this->addNotice('user',$this->user->name,'ADDED','ok');
		$this->callSubAction('groups');
	}


	function delgroup()
	{
		$this->user->delGroup( $this->getRequestVar('groupid') );

		$this->addNotice('user',$this->user->name,'DELETED','ok');
		$this->callSubAction('groups');
	}


	function pwchange()
	{
		if	( $this->getRequestVar('password1') != '' &&
			  $this->getRequestVar('password1') == $this->getRequestVar('password2') )
		{
			$this->user->setPassword( $this->getRequestVar('password1') );
			
			// E-Mail mit dem neuen Kennwort an Benutzer senden
			if	( $this->hasRequestVar('mail') && !empty($this->user->mail) )
			{
				// Text der E-Mail zusammenfuegen
				$text = wordwrap(lang('USER_MAIL_PREFIX'),70,"\n")."\n\n".$this->getRequestVar('password1')."\n\n".wordwrap(lang('USER_MAIL_SUFFFIX'),70,"\n");

				// Mail versenden
				mail($this->user->mail,lang('USER_MAIL_SUBJECT'),$text);
			}

			$this->addNotice('user',$this->user->name,'SAVED','ok');
		}

		$this->callSubAction('edit');
	}

//	function delright()
//	{
//		if   ($SESS['user']['is_admin'] != '1') die('weah');
//
//		$user->delRight( $this->getRequestVar('aclid') );
//	
//		// Berechtigungen anzeigen
//		$this->callSubAction('rights');
//	}
//
//
//	function addright()
//	{
//		global $REQ;
//		if   ($SESS['user']['is_admin'] != '1') die('go away hacker');
//		
//		$user->addRight( $REQ );
//
//		// Berechtigungen anzeigen
//		$this->callSubAction('rights');
//	}


	function listing()
	{
		$list = array();

		foreach( User::listAll() as $userid=>$name )
		{
			$list[$userid]         = array();
			$list[$userid]['url' ] = Html::url('main','user',$userid);
			$list[$userid]['name'] = $name;
		}
		$this->setTemplateVar('el',$list);

		$this->forward('user_list');
	}	
		

	/**
	 * Eigenschaften des Benutzers anzeigen
	 */
	function edit()
	{
		$this->setTemplateVars( $this->user->getProperties() );

		$this->setTemplateVar( 'allstyles',$this->user->getAvailableStyles() );

		$this->forward( 'user_edit' );
	}


	function groups()
	{
		// Alle hinzufuegbaren Gruppen ermitteln
		$this->setTemplateVar('groups',$this->user->getOtherGroups());
	
		// Mitgliedschaften
		$this->setTemplateVar('memberships',$this->user->getGroups());
		
		$this->forward('user_groups');
	}


	/**
	 * Aendern des Kennwortes
	 */
	function pw()
	{
		$this->forward('user_pw');
	}


	/**
	 * Anzeigen der Benutzerrechte
	 */
	function rights()
	{
		$rights = $this->user->getAllAcls();

		$rightList  = array();
		$objectList = array();
		
		foreach( $rights as $acl )
		{
			if	( !isset($rightList[$acl->projectid]) )
				$rightList[$acl->projectid]=array();
			$rightList[$acl->projectid][$acl->objectid] = $acl->getProperties();
			
			$o = new Object($acl->objectid);
			$o->objectLoadRaw();
			$objectList[$o->objectid] = $o->getProperties();
		}
		$o = new Object();
		$o->isFolder = true;
		$show = $o->getRelatedAclTypes();
		
		$this->setTemplateVar('projects',$this->user->getReadableProjects() );
		$this->setTemplateVar('rights'  ,$rightList                         );
		$this->setTemplateVar('objects' ,$objectList                        );
		$this->setTemplateVar('show'    ,$show                              );

		$this->forward('user_rights');
	}
}