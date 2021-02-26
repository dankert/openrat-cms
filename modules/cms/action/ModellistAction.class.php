<?php

namespace cms\action;

use cms\model\Model;
use cms\model\Project;
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
 * Action-Klasse zum Bearbeiten eines Projetmodells
 * 
 * @author Jan Dankert
 * @package openrat.actions
 */
class ModellistAction extends BaseAction
{
    /**
     * @var Project
     */
    protected $project;

	public $security = Action::SECURITY_USER;


    function __construct()
	{
        parent::__construct();
    }


    public function init()
    {

        $this->project = new Project( $this->request->getId());
    }



}