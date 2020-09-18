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
namespace cms\generator\target;

use logger\Logger;
use util\exception\PublisherException;
use util\exception\UIException;


/**
 * Publishing via FTPS.
 *
 * @author Jan Dankert
 */
class Ftps extends Ftp
{
	public static function acceptsSchemes() {
		return ['ftps'];
	}

	/**
	 * Creates a new connection.
	 *
	 * @param $ftp
	 * @return false|resource
	 */
	protected function createConnection()
	{
		return ftp_ssl_connect($this->url->host, $this->url->port);
	}


	public static function isAvailable()
	{
		return function_exists('ftp_ssl_connect');

	}
}