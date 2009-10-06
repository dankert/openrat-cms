<?php
// ---------------------------------------------------------------------------
// $Id$
// ---------------------------------------------------------------------------
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
 * Action-Klasse fuer die Start-Action
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */

class ClipboardAction extends Action
{
	var $defaultSubAction = 'show';


	function show()
	{
		global $conf;
		$o = Session::getClipboard();
		if	( is_object($o))
		{
			$o->load();
			$this->setTemplateVar('object',$o);
		}
	}


	function set()
	{
		global $conf;
		$o = new Object( $this->getRequestId() );
		Session::setClipboard( $o );
		$this->callSubAction( 'show' );

	}
}

?>