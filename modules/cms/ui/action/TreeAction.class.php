<?php

namespace cms\ui\action;

use cms\action\Action;
use cms\action\BaseAction;
use cms\action\RequestParams;
use cms\model\BaseObject;
use cms\model\Element;
use cms\model\Folder;
use cms\model\Group;
use cms\model\ModelFactory;
use cms\model\Page;
use cms\model\Project;
use cms\model\Template;
use cms\model\User;
use cms\model\Value;
use util\json\JSON;
use util\Tree;
use cms\model\Language;
use cms\model\Model;

use util\Session;

// OpenRat Content Management System
// Copyright (C) 2002 Jan Dankert, jandankert@jandankert.de
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
 * Action-Klasse zum Laden/Anzeigen des Navigations-Baumes
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */

class TreeAction extends BaseAction
{
	public $security = Action::SECURITY_GUEST;
	
	public function __construct()
    {
        parent::__construct();
    }

}
