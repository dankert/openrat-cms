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



	function remove()
	{
		$this->setTemplateVars( $this->user->getProperties() );
	}
	
	
	
	function delete()
	{
		if   ( $this->hasRequestVar('delete') )
		{
			$this->user->delete();
			$this->addNotice('user',$this->user->name,'DELETED','ok');
		}
	}


	function add()
	{
	}
	
	
	
	function adduser()
	{
		$this->user = new User();
		$this->user->add( $this->getRequestVar('name') );
		$this->addNotice('user',$this->user->name,'ADDED','ok');
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
		global $conf;
		
		$nl = "\r\n";

		// Header der E-Mail ermitteln
		$header = 'X-Mailer: '.OR_TITLE.' '.OR_VERSION;
		if	( !empty($conf['mail']['from']) )
			$header .= $nl.'From: '.$conf['mail']['from'];

		$to      = $this->user->fullname.' <'.$this->user->mail.'>';
		$subject = lang('USER_MAIL_SUBJECT');

		// Text der E-Mail zusammenfuegen
		$text  = $nl;
		$text .= wordwrap(str_replace(';',$nl,lang('USER_MAIL_TEXT_PREFIX')),70,$nl).$nl.$nl;
		$text .= lang('USER_USERNAME').': '.$this->user->name.$nl;
		$text .= lang('USER_PASSWORD').': '.$pw.$nl.$nl;
		$text .= wordwrap(str_replace(';',$nl,lang('USER_MAIL_TEXT_SUFFIX')),70,$nl);

		// Signatur anhaengen (sofern konfiguriert)
		if	( !empty($conf['mail']['signature']) )
		{
			$text .= $nl.$nl.'-- '.$nl;
			$text .= str_replace(';',$nl,$conf['mail']['signature']);
		}

		// Mail versenden
		mail($to,$subject,$text,$header);
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
		if	( $this->hasRequestVar('random') && $this->hasRequestVar('mail') )
		{
			$pw1 = substr( md5(microtime().session_id()),0,intval($conf['security']['password']['random_length']) );
			$pw2 = $pw1;
		}


		// Wenn Kennwoerter identisch und lang genug
		if	( $pw1 == $pw2 &&
			  strlen($pw1)>=intval($conf['security']['password']['min_length'])  )
		{
			$this->user->setPassword($pw1); // Kennwort setzen
			
			// E-Mail mit dem neuen Kennwort an Benutzer senden
			if	( $this->hasRequestVar('mail') && !empty($this->user->mail) && $conf['mail']['enabled'] )
			{
				$this->mailPw( $pw1 );
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
			$list[$user->userid]['url' ] = Html::url('main','user',$user->userid);
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


	function groups()
	{
		// Mitgliedschaften
		$this->setTemplateVar('memberships',$this->user->getGroups());
		
		$gruppenListe = array();
		
		foreach( $this->user->getGroups() as $id=>$name )
		{
			$gruppenListe[$id] = array('name'       =>$name,
			                           'delgroupurl'=>Html::url($this->actionName,'delgroup',$this->getRequestId(),array('groupid'=>$id)) );
		}
		$this->setTemplateVar('memberships',$gruppenListe);
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
	}
	
	
	function checkMenu( $menu )
	{
		switch( $menu )
		{
			case 'addgroup':
				return count($this->user->getOtherGroups()) > 0;

			case 'groups':
				return count($this->user->getGroups()) > 0;
		}
		
		return true;
	}
}