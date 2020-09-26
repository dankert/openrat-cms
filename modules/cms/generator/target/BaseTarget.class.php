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

use util\Url;


/**
 * Superclass for publication targets.
 *
 * @author Jan Dankert
 */
abstract class BaseTarget implements Target
{
	/**
	 * @var Url
	 */
	protected $url;

	public function __construct( $targetUrl ) {
		$this->url = new Url( $targetUrl );
	}


	public static function accepts( $scheme ) {
		return in_array( $scheme, static::acceptsSchemes() );
	}


	/**
	 * For which types this target is reponsible?
	 *
	 * @return array
	 */
	protected abstract static function acceptsSchemes();


	public function open() {

	}


	public abstract function put($source, $dest, $timestamp);


	/**
	 * Closes the connection.
	 */
	public function close() {

	}


	public static function isAvailable() {

		return true;
	}

}
