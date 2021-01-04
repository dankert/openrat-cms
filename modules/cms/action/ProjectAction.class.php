<?php

namespace cms\action;

use cms\base\Configuration;
use cms\model\Permission;
use cms\model\Folder;
use cms\model\Project;
use language\Messages;

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
class ProjectAction extends BaseAction
{
	public $security = Action::SECURITY_ADMIN;

    /**
     * @var Project
     */
	protected $project;
	var $defaultSubAction = 'listing';


	function __construct()
	{
        parent::__construct();
    }


    public function init()
    {
		$this->project = new Project( $this->getRequestId() );
		$this->project->load();
	}


	/**
	 * Stellt fest, ob der angemeldete Benutzer Projekt-Admin ist.
	 * Dies ist der Fall, wenn der Benutzer PROP-Rechte im Root-Folder hat.
	 * @return bool|int
	 */
	protected function userIsProjectAdmin() {

		$rootFolder = new Folder( $this->project->getRootObjectId() );

		return $rootFolder->hasRight(Permission::ACL_PROP);
	}



	/**
	 * Make a linkable hostname
	 *
	 * @param $hostname
	 * @return string
	 */
	protected function makeAbsoluteHostnameLink( $hostname ) {
		if    ( strpos($hostname,'//') === false )
			return 'http://'.$hostname;
		return $hostname;
	}

}