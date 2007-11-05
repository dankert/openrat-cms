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
// Revision 1.7  2007-11-05 20:48:31  dankert
// Erweiterung um Hinzuf?gen/Entfernen von Benutzern; Aufruf der Funktion "addValidationError(...)" bei Eingabefehlern.
//
// Revision 1.6  2007/01/20 15:21:54  dankert
// Eingabefeld f?r L?schbest?tigung umbenannt.
//
// Revision 1.5  2006/01/23 23:10:16  dankert
// Steuerung der Aktionsklassen ?ber .ini-Dateien
//
// Revision 1.4  2004/12/19 19:23:05  dankert
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



	function delete()
	{
		if   ( $this->hasRequestVar('confirm') )
		{
			$this->group->delete();
	
			$this->addNotice('group',$this->group->name,'DELETED','ok');
		}
		else
		{
			$this->addNotice('group',$this->group->name,'NOT_DELETED','ok');
		}
	}
	
	
	
	function remove()
	{
		$this->setTemplateVars( $this->group->getProperties() );
	}
	
	
	
	function save()
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


	function add()
	{
	}
	
	
	function addgroup()
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


	function addusertogroup()
	{
		// Benutzer der Gruppe hinzuf?gen
		$userid = $this->getRequestVar('userid');
		if	( is_array($userid))
		{
			foreach( $userid as $uid )
			{
				$this->group->addUser( $uid );
				$this->addNotice('group',$this->group->name,'SAVED','ok');
			}
		}
		elseif( intval($userid) > 0 )
		{
			$this->group->addUser( intval($userid) );
			$this->addNotice('group',$this->group->name,'SAVED','ok');
		}
	}


	function deluser()
	{
		$this->group->delUser( intval($this->getRequestVar('userid')) );
	
		$this->addNotice('group',$this->group->name,'DELETED','ok');
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
	}


	function edit()
	{
		$this->setTemplateVars( $this->group->getProperties() );
	}


	function memberships()
	{
	}
	
	
	
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


		// Alle hinzuf?gbaren Benutzer ermitteln
		//
		//		$this->setTemplateVar('users',$this->group->getOtherUsers());
	}
	
	function checkMenu( $menu )
	{
		switch( $menu )
		{
			case 'users':
				return count($this->group->getUsers()) > 0;
			case 'adduser':
				return count($this->group->getOtherUsers()) > 0;
			default:
				return true;
		}
	}
}