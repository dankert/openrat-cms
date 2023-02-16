<?php

namespace cms\action;

use cms\base\Configuration;
use cms\model\Permission;
use cms\model\Folder;
use cms\model\Project;
use language\Messages;
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
 * Action-Klasse zum Bearbeiten eines Projektes
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */
class TagAction extends BaseAction
{
    /**
     * @var Project
     */
	protected $project;


	function __construct()
	{
        parent::__construct();
    }


    public function init()
    {
		$this->project = new Project( $this->request->getId() );
		$this->project->load();

		if   ( ! $this->userMayReadProject() ) {
			throw new SecurityException();
		}
	}



	/**
	 * Stellt fest, ob der angemeldete Benutzer Projekt-Admin ist.
	 * Dies ist der Fall, wenn der Benutzer PROP-Rechte im Root-Folder hat.
	 * @return bool|int
	 */
	protected function userMayReadProject() {

		$rootFolder = new Folder( $this->project->getRootObjectId() );

		return $rootFolder->hasRight(Permission::ACL_READ);
	}





	/**
	 * User must be an administrator.
	 */
	public function checkAccess() {
		if   ( ! $this->userMayReadProject() )
			throw new SecurityException();
	}

}