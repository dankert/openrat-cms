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
// ---------------------------------------------------------------------------


/**
 * Action-Klasse zum Bearbeiten einer Benutzergruppe.
 * 
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */

class GroupAction extends Action
{
	var $group;
	var $defaultSubAction = 'edit';


	function GroupAction()
	{
		if   ( !$this->userIsAdmin() )
			die('you are not an admin');

		if	( $this->getRequestId() != 0 )
		{
			$this->group = new Group( $this->getRequestId() );
			$this->group->load();
			$this->setTemplateVar( 'groupid',$this->group->groupid );
		}
	}



	function removeAction()
	{
		if   ( $this->hasRequestVar('confirm') )
		{
			$this->group->delete();
	
			$this->addNotice('group',$this->group->name,'DELETED',OR_NOTICE_OK);
		}
		else
		{
			$this->addNotice('group',$this->group->name,'NOTHING_DONE',OR_NOTICE_WARN);
		}
	}
	
	
	
	function removeView()
	{
		$this->setTemplateVars( $this->group->getProperties() );
	}
	
	
	
	function editAction()
	{
		if	( $this->getRequestVar('name') != '' )
		{
			$this->group->name = $this->getRequestVar('name');
			
			$this->group->save();
	
			$this->addNotice('group',$this->group->name,'SAVED','ok');
		}
		else
		{
			$this->addValidationError('name');
			$this->callSubAction('edit');
		}
	}


	function addView()
	{
	}
	
	
	function addAction()
	{
		if	( $this->getRequestVar('name') != '')
		{
			$this->group = new Group();
			$this->group->name = $this->getRequestVar('name');
			$this->group->add();
			$this->addNotice('group',$this->group->name,'ADDED','ok');
			$this->callSubAction('listing');
		}
		else
		{
			$this->addValidationError('name');
			$this->callSubAction('add');
		}
	}


	function adduser()
	{
		$this->setTemplateVar('users',$this->group->getOtherUsers());
	}


	/**
	 * Benutzer zur Gruppe hinzuf�gen.<br>
	 * Es kann eine Liste oder eine einzelne Person zur Gruppe hinzugef�gt werden.
	 */
	function addusertogroup()
	{
		$userid = $this->getRequestVar('userid');

		if	( is_array($userid))
		{
			// Im Request steht eine Liste von User-Ids.
			foreach( $userid as $uid )
			{
				$this->group->addUser( $uid );
			}
			$this->addNotice('group',$this->group->name,'USER_ADDED_TO_GROUP',OR_NOTICE_OK,array('count'=>count($userid)));
		}
		elseif( intval($userid) > 0 )
		{
			// Nur 1 Benutzer hinzuf�gen.
			$this->group->addUser( intval($userid) );
			$this->addNotice('group',$this->group->name,'USER_ADDED_TO_GROUP',OK_NOTICE_OK,array('count'=>'1'));
		}
		else
		{
			// Es wurde kein Benutzer ausgew�hlt.
			$this->addNotice('group',$this->group->name,'NOTHING_DONE',OR_NOTICE_WARN);
		}
	}


	
	/**
	 * Einen Benutzer aus der Gruppe entfernen.
	 */
	function deluser()
	{
		$this->group->delUser( intval($this->getRequestVar('userid')) );
	
		$this->addNotice('group',$this->group->name,'DELETED',OR_NOTICE_OK);
	}



	/**
	 * Liste aller Gruppen.
	 */
	function listing()
	{
		$list = array();

		foreach( Group::getAll() as $id=>$name )
		{
			$list[$id]         = array();
			$list[$id]['url' ] = Html::url('main','group',$id,array(REQ_PARAM_TARGETSUBACTION=>'edit'));
			$list[$id]['name'] = $name;
		}

		$this->setTemplateVar('el',	$list);
	}


	function editView()
	{
		$this->setTemplateVars( $this->group->getProperties() );
	}


	
	/**
	 * Dummy-Funktion.
	 */
	function memberships()
	{
	}
	
	
	
	/**
	 * Liste aller Benutzer in dieser Gruppe.
	 *
	 */
	function users()
	{
		// Mitgliedschaften ermitteln
		//
		$userliste = array();
		
		foreach( $this->group->getUsers() as $userid=>$name )
		{
			$userliste[$userid] = array('name'       => $name,
			                            'delete_url' => Html::url('group','deluser',$this->getRequestId(),array('userid'=>$userid)));
		}
		$this->setTemplateVar('memberships',$userliste);
	}

	
	
	

	/**
	 * Anzeigen der Benutzerrechte
	 */
	function rights()
	{
		$rights = $this->group->getAllAcls();

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
			
			if	( $acl->groupid > 0 )
			{
				$group = new Group($acl->groupid);
				$group->load();
				$right['groupname'] = $group->name;
			}
			else
			{
				// Berechtigung f�r "alle".
			}

			$right['bits'] = $acl->getProperties();
			
			$projects[$acl->projectid]['rights'][] = $right;
		}
		
		$this->setTemplateVar('projects'    ,$projects );
		
		$this->setTemplateVar('show',Acl::getAvailableRights() );
	}
	
	
	
	/**
	 * Men�.
	 *
	 * @param String $menu Men�eintrag.
	 * @return boolean TRUE, wenn Men�eintrag aktiv ist.
	 */
	function checkMenu( $menu )
	{
		switch( $menu )
		{
			case 'remove':
			case 'add':
				return !readonly();
					
			case 'users':
				// Benutzerliste nur anzeigen, wenn welche vorhanden.
				return !readonly() && count($this->group->getUsers()) > 0;
			case 'adduser':
				// Benutzer k�nnen nur hinzugef�gt werden, wenn noch nicht alle
				// in der Gruppe sind.
				return !readonly() && count($this->group->getOtherUsers()) > 0;
			default:
				return true;
		}
	}
}