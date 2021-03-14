<?php

namespace cms\action;

use cms\base\Configuration;
use cms\model\Folder;
use cms\model\Language;
use cms\model\Permission;
use cms\model\Project;
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
 * Action-Klasse f?r die Bearbeitung einer Sprache
 * @version $Id$
 * @author  $Author$
 * @package openrat.actions
 */
class LanguageAction extends BaseAction
{
	/**
	 * Zu bearbeitende Sprache, wird im Kontruktor instanziiert
	 * @type Language
	 */
	protected $language;


	/**
	 * Konstruktor
	 */
	public function __construct()
	{
        parent::__construct();

    }


    public function init()
    {
		$this->language = new Language( $this->request->getId() );
		$this->language->load();
	}


	/**
	 * User must be an project administrator.
	 */
	public function checkAccess() {
		$project      = new Project( $this->language->projectid );
		$rootFolderId = $project->getRootObjectId();

		$rootFolder = new Folder( $rootFolderId );
		$rootFolder->load();

		if   ( ! $rootFolder->hasRight( Permission::ACL_PROP )  )
			throw new SecurityException();
	}

}