<?php

namespace cms\ui\action;

use cms\action\Action;
use cms\base\Configuration;
use cms\base\DB;
use cms\base\Startup;
use cms\model\BaseObject;

use util\Session;
use util\Html;
// OpenRat Content Management System
// Copyright (C) 2002-2009 Jan Dankert, jandankert@jandankert.de
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
 * Actionklasse zum Anzeigen der Titelleiste.
 * 
 * @author Jan Dankert
 * @package openrat.actions
 */
class TitleAction extends Action
{
	public function checkAccess() {
		return true; // Allowed for all
	}

}
