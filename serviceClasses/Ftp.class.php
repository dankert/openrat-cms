<?php
#
#  DaCMS Content Management System
#  Copyright (C) 2002 Jan Dankert, jandankert@jandankert.de
#
#  This program is free software; you can redistribute it and/or
#  modify it under the terms of the GNU General Public License
#  as published by the Free Software Foundation; either version 2
#  of the License, or (at your option) any later version.
#
#  This program is distributed in the hope that it will be useful,
#  but WITHOUT ANY WARRANTY; without even the implied warranty of
#  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#  GNU General Public License for more details.
#
#  You should have received a copy of the GNU General Public License
#  along with this program; if not, write to the Free Software
#  Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
#

/**
 * Darstellen einer FTP-Verbindung, das beinhaltet
 * das Login, das Kopieren von Dateien sowie praktische
 * FTP-Funktionen
 *
 * @author $Author$
 * @version $Revision$
 * @package openrat.services
 */
class Ftp
{
	var $verb;
	var $url;
	var $log = array();

	var $passive = false;
	
	var $ok    = true;
	

	// Konstruktor
	function Ftp( $url )
	{
		$this->connect( $url );
	}

	
	// Aufbauen der Verbindung
	function connect( $url )
	{
		$this->url = $url;
		
		global $conf;
	
		$conf_ftp = $conf['publish']['ftp'];
		$ftp = parse_url( $this->url );
		
		// Die projektspezifischen Werte gewinnen bei �berschneidungen mit den Default-Werten
		$ftp = array_merge($conf_ftp,$ftp);
	
		// Nur FTP und FTPS (seit PHP 4.3) erlaubt
		if   ( !ereg('^ftps?$',$ftp['scheme']) )
		{
			$this->log[] = 'Unknown scheme in FTP Url: '.$ftp['scheme'];
			$this->log[] = 'Only FTP (and FTPS, if compiled in) are supported';
			$this->ok  = false;
			return;
		}
		
		if	( function_exists('ftp_ssl_connect') && $ftp['scheme'] == 'ftps' )
			$this->verb = @ftp_ssl_connect( $ftp['host'],$ftp['port'] );
		else
			$this->verb = @ftp_connect( $ftp['host'],$ftp['port'] );

		if   ( !$this->verb )
		{
			$this->log[] = 'Cannot connect to '.$ftp['scheme'].'-server: '.$ftp['host'].':'.$ftp['port'];
			$this->ok = false;
			
			Logger::error('Cannot connect to '.$ftp['host'].':'.$ftp['port']);
			return;
		}

		$this->log[] = 'Connected to FTP server '.$ftp['host'].':'.$ftp['port'];
		
		if	( empty($ftp['user']) )
		{
			$ftp['user'] = 'anonymous';
			$ftp['pass'] = 'openrat@openrat.de';
		}
			
		if	( ! ftp_login( $this->verb,$ftp['user'],$ftp['pass'] ) )
		{
			$this->log[] = 'Unable to login as user '.$ftp['user'];
			$this->ok = false;
			return;
		}
		
		$this->log[] = 'Logged in as user '.$ftp['user'];

		$pasv = (!empty($ftp['fragment']) && $ftp['fragment'] == 'passive' );
		
		$this->log[] = 'entering passive mode '.($pasv?'on':'off');
		if	( ! ftp_pasv($this->verb,true) )
		{
			$this->log[] = 'cannot switch PASV mode';
			$this->ok = false;
			return;
		}
		
		if   ( !empty($ftp['query']) )
		{
			parse_str( $ftp['query'],$ftp_var );
			
			if   ( isset( $ftp_var['site'] ) )
			{
				$site_commands = explode( ',',$ftp_var['site'] );
				foreach( $site_commands as $cmd )
				{
					$this->log .= 'executing SITE command: '.$cmd;

					if	( ! @ftp_site( $this->verb,$cmd ) )
					{
						$this->log[] = 'unable to do SITE command: '.$cmd;
						$this->ok = false;
						return;
					}
				}
			}
		}

		$this->path = ereg_replace( '\/$','',$ftp['path']);
		
		$this->log[] = 'Changing directory to '.$this->path;
		
		if	( ! @ftp_chdir( $this->verb,$this->path ) )
		{
			$this->log[] = 'unable CHDIR to directory: '.$this->path;
			$this->ok = false;
			return;
		}
	}
	

	/**
	 * Kopieren einer Datei vom lokalen System auf den FTP-Server.
	 *
	 * @param String Quelle
	 * @param String Ziel
	 * @param int FTP-Mode (BINARY oder ASCII)
	 */
	function put( $source,$dest )
	{
		if	( ! $this->ok )
			return;
			
		$ftp = parse_url( $this->url );

		$dest = $this->path.'/'.$dest;
		
		$this->log .= "Copying file: $source -&gt; $dest ...\n";
		
		$mode = FTP_BINARY;
		$p = strrpos( basename($dest),'.' ); // Letzten Punkt suchen

		if   ($p!==false) // Wennn letzten Punkt gefunden, dann dort aufteilen
		{
			$extension = substr( basename($dest),$p+1 );
			$type = config('mime-types',$extension);
			if	( substr($type,0,5) == 'text/')
				$mode = FTP_ASCII;
		}
		
		Logger::debug("FTP PUT target:$dest mode:".(($mode==FTP_ASCII)?'ascii':'binary'));

		if   ( !@ftp_put( $this->verb,$dest,$source,$mode ) )
		{
			if	( !$this->mkdirs( dirname($dest) ) )
				return; // Fehler.

			ftp_chdir( $this->verb,$this->path );

			if	( ! @ftp_put( $this->verb,$dest,$source,$mode ) )
			{
				$this->ok = false;
				$this->log[] = 'FTP PUT failed...';
				$this->log[] = 'source     : '.$source;
				$this->log[] = 'destination: '.$dest;
				return;
			}
			
		}
	}



	/**
	 * Private Methode zum rekursiven Anlegen von Verzeichnissen.
	 *
	 * @param String Pfad
	 * @return boolean true, wenn ok
	 */
	function mkdirs( $strPath )
	{
		if	( @ftp_chdir($this->verb,$strPath) )
			return true; // Verzeichnis existiert schon :)
	 
		$pStrPath = dirname($strPath);
		
		if	( !$this->mkdirs($pStrPath) )
			return false;
		
		if	( ! @ftp_mkdir($this->verb,$strPath) )
		{
			$this->ok = false;
			$this->log[] = "failed to create remote directory: $strPath";
		}
		
		return $this->ok;
	}
	
	
	
	/**
	 * Schlie�en der FTP-Verbindung.<br>
	 * Sollte unbedingt aufgerufen werden, damit keine unn�tigen Sockets aufbleiben.
	 */
	function close()
	{
		if	( !$this->ok ) // Noch alles ok?
			return;
			
		if	( ! @ftp_quit( $this->verb ) )
		{
			// Das Schlie�en der Verbindung hat nicht funktioniert.
			// Eigentlich k�nnten wir das ignorieren, aber wir sind anst�ndig und melden eine Fehler.
			$this->log[] = 'failed to close connection';
			$this->ok = false;
			return;
		}
	}
}


?>