<?php

namespace cms\action;

use cms\model\Group;
// OpenRat Content Management System
// Copyright (C) 2002-2012 Jan Dankert, cms@jandankert.de
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
 * Action-Klasse zum Bearbeiten einer Benutzergruppe.
 *
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */

class GrouplistAction extends BaseAction
{
	public $security = Action::SECURITY_ADMIN;
	
	function __construct()
	{
        parent::__construct();
	}


	/**
	 * Liste aller Gruppen.
	 */
	function showView()
	{
		$list = array();

		foreach( Group::getAll() as $id=>$name )
		{
			$list[$id]         = array();
			$list[$id]['id'  ] = $id;
			$list[$id]['name'] = $name;
		}

		$this->setTemplateVar('el',	$list);
	}


	function editView()
	{
		$this->nextSubAction('show');
	}



	function addView()
	{
	}


	function addPost()
	{
		if	( $this->getRequestVar('name') != '')
		{
			$this->group = new Group();
			$this->group->name = $this->getRequestVar('name');
			$this->group->add();
			$this->addNotice('group', 0, $this->group->name, 'ADDED', 'ok');
			$this->callSubAction('listing');
		}
		else
		{
			$this->addValidationError('name');
			$this->callSubAction('add');
		}
	}




}