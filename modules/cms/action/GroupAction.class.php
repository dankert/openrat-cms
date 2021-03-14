<?php

namespace cms\action;

use cms\model\Permission;
use cms\model\BaseObject;
use cms\model\Group;
use cms\model\Language;
use cms\model\Project;
use cms\model\User;
use util\exception\SecurityException;

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
 * @author Jan Dankert
 */

class GroupAction extends BaseAction
{
    /**
     * @var Group
     */
	protected $group;


	function __construct()
	{
        parent::__construct();

    }


    public function init()
    {
        $this->group = new Group( $this->request->getId() );
		$this->group->load();
		$this->setTemplateVar( 'groupid',$this->group->groupid );
	}


	/**
	 * User must be an administration.
	 */
	public function checkAccess() {
		if   ( ! $this->userIsAdmin() )
			throw new SecurityException();
	}


}