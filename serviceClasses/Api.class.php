<?php
// ---------------------------------------------------------------------------
// $Id$
// ---------------------------------------------------------------------------
// DaCMS Content Management System
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
// ---------------------------------------------------------------------------
// $Log$
// Revision 1.2  2004-05-02 15:04:16  dankert
// Einfügen package-name (@package)
//
// Revision 1.1  2004/04/24 17:03:29  dankert
// Initiale Version
//
// ---------------------------------------------------------------------------

/**
 * Service-Klasse fuer allgemeine Interface-Methoden. Insbesondere
 * in Code-Elementen kann und soll auf diese Methoden zurueckgegriffen
 * werden.
 * @author $Author$
 * @version $Revision$
 * @package openrat.services
 */
class Api
{
	var $output = '';
	
	function db()
	{
		return db_connection();
	}

	function pageid()
	{
		echo 'WARNING: pageid() deprecated!<br>';
		global $SESS;
		return $SESS['objectid'];
	}

	function getObjectId()
	{
		global $SESS;
		return $SESS['objectid'];
	}

	function getRootObjectId()
	{
		return Folder::getRootObjectId();
	}

	function folderid()
	{
		global $SESS;
		return $SESS['folderid'];
	}
	
	
	function delOutput()
	{
		$this->output = '';
	}
	
	function output( $text )
	{
		$this->output .= $text;
	}


	function getOutput()
	{
		return $this->output;
	}
}