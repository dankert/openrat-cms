<?php
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
namespace util;

use cms\model\Folder;
use cms\model\Project;


/**
 * Service-Klasse fuer allgemeine Interface-Methoden. Insbesondere
 * in Code-Elementen kann und soll auf diese Methoden zurueckgegriffen
 * werden.
 * @deprecated use Macro methods.
 */
class Api
{
	var $output = '';
	var $objectid = 0;
	var $page;

	function db()
	{
		return \cms\base\DB::get();
	}

	function pageid()
	{
		throw new \LogicException( 'WARNING: pageid() deprecated!');
	}

	function getObjectId()
	{
		return $this->objectid;
	}

	function setObjectId($objectid)
	{
		$this->objectid = $objectid;
	}

	function getRootObjectId()
	{
		$project = new Project($this->page->projectid);
		return $project::getRootObjectId();
	}


	function folderid()
	{
		throw new \LogicException('folderid() impossible to call, information does not exist');
	}


	function delOutput()
	{
		$this->output = '';
	}

	function output($text)
	{
		$this->output .= $text;
	}


	function getOutput()
	{
		return $this->output;
	}
}