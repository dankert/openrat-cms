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
use util\Url;


/**
 * Publishing a file over WebDAV.
 *
 * @author Jan Dankert
 */
class Dav extends Target
{
	/**
	 * @var false|resource
	 */
	private $fp;

	public function checkConnection()
	{
		$content  = "HEAD / HTTP/1.1\r\n";
		$content .= "Host: ".$this->url->host."\r\n";
		$content .= "Connection: Close\r\n";
		$content .= "\r\n";

		fwrite($this->fp, $content );
	}


	public function put($source, $dest, $time)
	{
		$content  = "PUT $dest HTTP/1.1\r\n";
		$content .= "Host: ".$this->url->host."\r\n";
		$content .= "Connection: Close\r\n";
		$content .= "\r\n";

		fwrite($this->fp, $content);
		fwrite($this->fp, file_get_contents($source));
	}


	public function mkcol( $dir ) {
		$content = "MKCOL $dir HTTP/1.1\r\n";
		$content .= "Host: ".$this->url->host."\r\n";
		$content .= "Connection: Close\r\n";
		$content .= "\r\n";
		fwrite($this->fp, $content);
	}

	public function close()
	{
		fclose($this->fp);
	}

	protected static function acceptsSchemes()
	{
		return ['dav'];
	}

	public function open()
	{
		$this->fp = fsockopen($this->url->host, empty($this->url->port)?80:$this->url->port, $errno, $errstr, 5);

		if(!$this->fp)
			throw new PublisherException("cannot connect to DAV server: $errno -> $errstr");

		$this->checkConnection();
	}
}