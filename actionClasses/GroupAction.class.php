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
// $Log$
// Revision 1.4  2004-12-19 19:23:05  dankert
// Ausgeben von "Notices"
//
// Revision 1.3  2004/12/15 23:23:11  dankert
// Anpassung an Session-Funktionen
//
// Revision 1.2  2004/05/02 14:49:37  dankert
// Einf?gen package-name (@package)
//
// Revision 1.1  2004/04/24 15:14:52  dankert
// Initiale Version
//
// ---------------------------------------------------------------------------


/**
 * Action-Klasse zum Bearbeiten einer Benutzergruppe
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


	function save()
	{
		if   ( $this->hasRequestVar('delete') )
		{
			$this->group->delete();

			$this->addNotice('group',$this->group->name,'DELETED','ok');
		}
		else
		{
			$this->group->name = $this->getRequestVar('name');
			$this->group->save();

			$this->addNotice('group',$this->group->name,'SAVED','ok');
		}
		$this->callSubAction('listing');
	}


	function add()
	{
		$this->group = new Group();
		$this->group->name = $this->getRequestVar('name');
		$this->group->add();
	
		$this->addNotice('group',$this->group->name,'ADDED','ok');
		$this->callSubAction('listing');
	}


	function adduser()
	{
		// Benutzer der Gruppe hinzuf?gen
		$this->group->addUser( $this->getRequestVar('userid') );

		$this->addNotice('group',$this->group->name,'SAVED','ok');
	
		$this->callSubAction('users');
	}


	function deluser()
	{
		$this->group->delUser( intval($this->getRequestVar('userid')) );
	
		$this->addNotice('group',$this->group->name,'DELETED','ok');
		$this->callSubAction('users');
	}


//	function delright()
//	{
//
//		$this->group->addRight( $REQ['aclid'] );
//
//		// Berechtigungen anzeigen
//		$SESS['groupaction'] = 'rights';
//
//	}
//
//
//	function addright()
//	{
//		$this->group->addRight( $REQ );
//	
//		// Berechtigungen anzeigen
//		$SESS['groupaction'] = 'rights';
//	}
//
//

	function listing()
	{
		$list = array();

		foreach( Group::getAll() as $id=>$name )
		{
			$list[$id]         = array();
			$list[$id]['url' ] = Html::url('main','group',$id);
			$list[$id]['name'] = $name;
		}

		$this->setTemplateVar('el',	$list);
	
		$this->forward('group_list');
	}


	function edit()
	{
		$this->setTemplateVars( $this->group->getProperties() );

		$this->forward('group_edit');
	}


	function users()
	{
		// Mitgliedschaften ermitteln
		//
		$this->setTemplateVar('memberships',$this->group->getUsers());


		// Alle hinzuf?gbaren Benutzer ermitteln
		//
		$this->setTemplateVar('users',$this->group->getOtherUsers());

		$this->forward('group_users');
		
	}


	function rights()
	{
		$this->setTemplateVar('projects',$this->group->getRights());
		
		$this->forward('group_rights');
		
	}
}