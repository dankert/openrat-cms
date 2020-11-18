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
 * Darstellen einer FTP-Verbindung, das beinhaltet
 * das Login, das Kopieren von Dateien sowie praktische
 * FTP-Funktionen
 *
 * @author $Author$
 * @version $Revision$
 * @package openrat.services
 */
class ScpTarget extends BaseTarget
{
	/**
	 * @var resource
	 */
	protected $sshConnection;

	// Aufbauen der Verbindung
	public function open()
	{
		$this->sshConnection = $this->createConnection();
	}



	protected function createConnection() {

		if   ( empty($this->url->port) )
			$this->url->port = 22; // Default-SSH-port

		$sshConnection = @ssh2_connect($this->url->host,$this->url->port );

		if (! $sshConnection)
			throw new PublisherException("Could not connect to ".$this->url->host.':'.$this->url->port );


		if (! @ssh2_auth_password($sshConnection, $this->url->user,$this->url->pass) )
			throw new PublisherException("Could not authenticate with user ".$this->url->user);

		$this->sshConnection = $sshConnection;

		return $sshConnection;
	}



	/**
	 * Kopieren einer Datei vom lokalen System auf den FTP-Server.
	 *
	 * @param String Quelle
	 * @param String Ziel
	 * @param int FTP-Mode (BINARY oder ASCII)
	 */
	public function put($source, $dest, $lastChangeDate)
	{
		$dest = $this->url->path . '/' . $dest;

		// ok, lets create the necessary directories on the remote side.
		$stream = ssh2_exec($this->sshConnection,'mkdir -p '.dirname($dest) );
		if   ( $stream )
			fclose($stream);
		else
			throw new PublisherException("Failed to mkdir ".dirname($dest).' on remote');

		$success = ssh2_scp_send($this->sshConnection, $source, $dest, 0644);

		if   ( !$success) {
			throw new PublisherException( 'Failed to publish '.$source.' to '.$dest );
		}
	}


	/**
	 * Schliessen der FTP-Verbindung.<br>
	 * Sollte unbedingt aufgerufen werden, damit keine unn�tigen Sockets aufbleiben.
	 */
	public function close()
	{
		ssh2_disconnect($this->sshConnection);
	}


	public static function isAvailable()
	{
		return function_exists('ssh2_connect');
	}
}


?>