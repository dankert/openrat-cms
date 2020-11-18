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
class DavTarget extends BaseTarget
{
	/**
	 * @var false|resource
	 */
	//private $socket;

	public function checkConnection()
	{
		$dest = $this->url->path;

		$content  = "HEAD /$dest HTTP/1.1\r\n";
		$content .= "Host: ".$this->url->host."\r\n";
		$content .= "Connection: Close\r\n";
		$content .= "\r\n";

		fwrite($this->createSocket(), $content );
	}


	public function put($source, $dest, $time)
	{
		$dest = $this->url->path . '/' . $dest;

		$this->mkdirs( dirname($dest) ); // Try MKCOL

		$content  = "PUT $dest HTTP/1.1\r\n";
		$content .= "Host: ".$this->url->host."\r\n";
		$content .= "Content-Length: ".filesize($source)."\r\n";
		$content .= "Connection: Close\r\n";
		$content .= "\r\n";

		fwrite($this->createSocket(), $content.file_get_contents($source));
	}


	/**
	 * resursive make the directory on DAV server.
	 *
	 * @param String path
	 */
	private function mkdirs($strPath)
	{
		$pStrPath = dirname($strPath);
		if   ( $pStrPath && $pStrPath != '.' && $pStrPath != '/' )
			$this->mkdirs($pStrPath);

		$this->mkcol( $strPath );
	}


	public function mkcol( $dir ) {
		$content = "MKCOL $dir HTTP/1.1\r\n";
		$content .= "Host: ".$this->url->host."\r\n";
		$content .= "Connection: Close\r\n";
		$content .= "\r\n";
		fwrite($this->createSocket(), $content);
	}

	public function close()
	{
		//fclose($this->socket);
	}

	public function open()
	{
		$this->checkConnection();
	}

	/**
	 * @return false|resource
	 */
	protected function createSocket()
	{
		$socket = fsockopen($this->url->host, empty($this->url->port) ? 80 : $this->url->port, $errno, $errstr, 5);

		if(!$socket)
			throw new PublisherException("cannot connect to DAV server: $errno -> $errstr");

		return $socket;

	}
}