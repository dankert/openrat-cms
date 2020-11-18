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

use cms\base\Configuration;
use logger\Logger;
use util\exception\PublisherException;
use util\exception\UIException;


/**
 * FTP-BaseTarget.
 *
 * @author Jan Dankert
 */
class FtpTarget extends BaseTarget
{
	private $connection;

	// Aufbauen der Verbindung
	public function open()
	{
		//$conf = \cms\base\Configuration::rawConfig();
		//$conf_ftp = $conf['publish']['ftp'];
		$ftp = $this->url;

		// Die projektspezifischen Werte gewinnen bei �berschneidungen mit den Default-Werten
		//$ftp = array_merge($conf_ftp, $ftp);

		$this->connection = $this->createConnection();

		if (!$this->connection) {
			Logger::error('Cannot connect to ' . $this->url->host . ':' . $this->url->port);
			throw new PublisherException('Cannot connect to ' . $this->url->scheme . '-server: ' . $this->url->host . ':' . $this->url->port);
		}

		if (empty($this->url->user)) {
			$ftp['user'] = 'anonymous';
			$ftp['pass'] = 'openrat@openrat.de';
		}

		if (!ftp_login($this->connection, $this->url->user, $this->url->pass))
			throw new PublisherException('Unable to login as user ' . $this->url->user);

		$pasv = $this->url->fragment == 'passive';

		if  ( $pasv )
			if (!ftp_pasv($this->connection, true))
				throw new PublisherException('Cannot switch to FTP PASV mode');

		if ( $this->url->query ) {
			parse_str($this->url->query, $ftp_var);

			if (isset($ftp_var['site'])) {
				$site_commands = explode(',', $ftp_var['site']);
				foreach ($site_commands as $cmd) {
					if (!@ftp_site($this->connection, $cmd))
						throw new PublisherException('unable to do SITE command: ' . $cmd);
				}
			}
		}

		$path = rtrim($this->url->path, '/');

		if (!@ftp_chdir($this->connection, $path))
			throw new PublisherException('unable CHDIR to directory: ' . $path);
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

		//$this->log .= "Copying file: $source -&gt; $dest ...\n";

		$mode = FTP_BINARY;
		$p = strrpos(basename($dest), '.'); // Letzten Punkt suchen

		if ($p !== false) // Wennn letzten Punkt gefunden, dann dort aufteilen
		{
			$extension = substr(basename($dest), $p + 1);
			$type = Configuration::subset('mime-types')->get( $extension,'application/download');
			if (substr($type, 0, 5) == 'text/')
				$mode = FTP_ASCII;
		}

		Logger::debug("FTP PUT target:$dest mode:" . (($mode == FTP_ASCII) ? 'ascii' : 'binary'));

		if (!@ftp_put($this->connection, $dest, $source, $mode)) {
			if (!$this->mkdirs(dirname($dest)))
				return; // Fehler.

			ftp_chdir($this->connection, $this->url->path);

			if (!@ftp_put($this->connection, $dest, $source, $mode))
				throw new PublisherException("FTP PUT failed.\n" .
					"source     : $source\n" .
					"destination: $dest");

		}
	}


	/**
	 * Private Methode zum rekursiven Anlegen von Verzeichnissen.
	 *
	 * @param String Pfad
	 * @return boolean true, wenn ok
	 */
	private function mkdirs($strPath)
	{
		if (@ftp_chdir($this->connection, $strPath))
			return true; // Verzeichnis existiert schon :)

		$pStrPath = dirname($strPath);

		if (!$this->mkdirs($pStrPath))
			return false;

		if (!@ftp_mkdir($this->connection, $strPath))
			throw new PublisherException("failed to create remote directory: $strPath");

		return true;
	}


	/**
	 * Schliessen der FTP-Verbindung.<br>
	 * Sollte unbedingt aufgerufen werden, damit keine unn�tigen Sockets aufbleiben.
	 */
	public function close()
	{
		if (!@ftp_quit($this->connection)) {
			// Closing not possible.
			// Only logging. Maybe we could throw an Exception here?
			Logger::warn('Failed to close FTP connection. Continueing...');
			return;
		}
	}

	protected function createConnection()
	{
		return ftp_connect($this->url->host, $this->url->port);
	}

	public static function isAvailable()
	{
		return function_exists('ftp_connect');
	}
}


?>