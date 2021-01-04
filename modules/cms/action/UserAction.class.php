<?php

namespace cms\action;

use cms\base\Configuration;
use cms\base\Startup;
use cms\model\Permission;
use cms\model\BaseObject;
use cms\model\Group;
use cms\model\Language;
use cms\model\Project;
use cms\model\User;
use language\Messages;
use security\Base2n;
use security\Password;
use util\exception\ValidationException;
use util\Mail;
use util\Session;


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
 * Action-Klasse zum Bearbeiten eines Benutzers
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */
class UserAction extends BaseAction
{
	public $security = Action::SECURITY_ADMIN;

    /**
     * @var User
     */
	protected $user;


    /**
     * UserAction constructor.
     * @throws \util\exception\ObjectNotFoundException
     */
    function __construct() {
        parent::__construct();
    }


    public function init() {
		$this->user = new User( $this->getRequestId() );
		$this->user->load();
		$this->setTemplateVar('userid',$this->user->userid);
	}
}