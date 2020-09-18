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
class SFtp extends Scp
{
	/**
	 * @var resource
	 */
	protected $sftpConnection;


	public static function acceptsSchemes() {
		return ['sftp'];
	}

	// Aufbauen der Verbindung
	public function open()
	{
		global $conf;

		//$conf_ftp = $conf['publish']['sftp'];

		// Die projektspezifischen Werte gewinnen bei �berschneidungen mit den Default-Werten
		//$sftp = array_merge($conf_ftp, $sftp);


		$this->createConnection();

		$this->sftpConnection = @ssh2_sftp($this->sshConnection);

		if (! $this->sftpConnection)
			throw new PublisherException("Could not initialize SFTP subsystem.");

	}


	/**
	 * Kopieren einer Datei vom lokalen System auf den SFTP-Server.
	 *
	 * @param String Quelle
	 * @param String Ziel
	 * @param int time)
	 */
	public function put($source, $dest, $lastChangeDate)
	{
		$dest = $this->url->path . '/' . $dest;

		$sftp = $this->sftpConnection;

		$stream = @fopen("ssh2.sftp://$sftp$dest", 'w');

		if (! $stream)
			throw new PublisherException("Could not create SFTP-Stream on file: $dest");

		$data_to_send = @file_get_contents($source);

		if ($data_to_send === false)
			throw new PublisherException("Could not open local file: $source");

		if (@fwrite($stream, $data_to_send) === false)
			throw new PublisherException("Could not send data from file: $source.");

		@fclose($stream);
	}


	/**
	 * Schliessen der FTP-Verbindung.<br>
	 * Sollte unbedingt aufgerufen werden, damit keine unn�tigen Sockets aufbleiben.
	 */
	public function close()
	{
		parent::close();
	}


	public static function isAvailable()
	{
		return parent::isAvailable() && function_exists('ssh2_sftp');
	}
}

