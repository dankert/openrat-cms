<?php

namespace cms\action;

use cms\base\Configuration;
use cms\model\Language;
use cms\model\Project;
use language\Messages;
use util\Html;


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
class LanguagelistAction extends BaseAction
{
	public $security = Action::SECURITY_USER;

    /**
     * @var Project
     */
    protected $project;


    /**
	 * Konstruktor
	 */
	function __construct()
	{
        parent::__construct();

    }


    public function init()
    {

        $this->project = new Project( $this->request->getId());
	}
}