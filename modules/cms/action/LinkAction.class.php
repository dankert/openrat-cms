<?php

namespace cms\action;

use cms\model\BaseObject;
use cms\model\Link;
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
 * Action-Klasse f?r Verkn?pfungen
 * @version $Id$
 * @author $Author$
 * @package openrat.actions
 */
class LinkAction extends ObjectAction
{
    /**
     * @var Link
     */
	protected $link;

	/**
	 * Konstruktor
	 */
	function __construct()
	{
        parent::__construct();

    }


    public function init()
    {
		$link = new Link( $this->request->getId() );
		$link->load();

		$this->setBaseObject( $link );
	}


	protected function setBaseObject( $link ) {

		$this->link = $link;

		parent::setBaseObject( $link );
	}
}
