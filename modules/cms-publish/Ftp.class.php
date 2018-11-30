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

    private $path;


    // Konstruktor
	public function __construct( $url )
	{
		$this->connect( $url );
	}

	
	// Aufbauen der Verbindung
	private function connect( $url )
	{
		$this->url = $url;
		
		global $conf;
	
		$conf_ftp = $conf['publish']['ftp'];
		$ftp = parse_url( $this->url );
		
		// Die projektspezifischen Werte gewinnen bei �berschneidungen mit den Default-Werten
		$ftp = array_merge($conf_ftp,$ftp);
	
		// Nur FTP und FTPS (seit PHP 4.3) erlaubt
		if   ( !in_array(@$ftp['scheme'],array('ftp','ftps')) )
		{
			throw new OpenRatException( 'ERROR_PUBLISH','Unknown scheme in FTP Url: '.@$ftp['scheme'].
			'. Only FTP (and FTPS, if compiled in) are supported');
		}
		
		if	( function_exists('ftp_ssl_connect') && $ftp['scheme'] == 'ftps' )
			$this->verb = @ftp_ssl_connect( $ftp['host'],$ftp['port'] );
		else
			$this->verb = @ftp_connect( $ftp['host'],$ftp['port'] );

		if   ( !$this->verb )
		{
            Logger::error('Cannot connect to '.$ftp['host'].':'.$ftp['port']);
            throw new OpenRatException('ERROR_PUBLISH','Cannot connect to '.$ftp['scheme'].'-server: '.$ftp['host'].':'.$ftp['port']);
		}

		$this->log[] = 'Connected to FTP server '.$ftp['host'].':'.$ftp['port'];
		
		if	( empty($ftp['user']) )
		{
			$ftp['user'] = 'anonymous';
			$ftp['pass'] = 'openrat@openrat.de';
		}
			
		if	( ! ftp_login( $this->verb,$ftp['user'],$ftp['pass'] ) )
			throw new OpenRatException('ERROR_PUBLISH','Unable to login as user '.$ftp['user']);

		$this->log[] = 'Logged in as user '.$ftp['user'];

		$pasv = (!empty($ftp['fragment']) && $ftp['fragment'] == 'passive' );
		
		$this->log[] = 'entering passive mode '.($pasv?'on':'off');
		if	( ! ftp_pasv($this->verb,true) )
			throw new OpenRatException('ERROR_PUBLISH','Cannot switch to FTP PASV mode');

		if   ( !empty($ftp['query']) )
		{
			parse_str( $ftp['query'],$ftp_var );
			
			if   ( isset( $ftp_var['site'] ) )
			{
				$site_commands = explode( ',',$ftp_var['site'] );
				foreach( $site_commands as $cmd )
				{
					if	( ! @ftp_site( $this->verb,$cmd ) )
                        throw new OpenRatException('ERROR_PUBLISH','unable to do SITE command: '.$cmd);
				}
			}
		}

		$this->path = rtrim( $ftp['path'],'/' );
		
		$this->log[] = 'Changing directory to '.$this->path;
		
		if	( ! @ftp_chdir( $this->verb,$this->path ) )
            throw new OpenRatException('ERROR_PUBLISH','unable CHDIR to directory: '.$this->path);
	}
	

	/**
	 * Kopieren einer Datei vom lokalen System auf den FTP-Server.
	 *
	 * @param String Quelle
	 * @param String Ziel
	 * @param int FTP-Mode (BINARY oder ASCII)
	 */
	public function put( $source,$dest )
	{
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
                throw new OpenRatException('ERROR_PUBLISH',
                    "FTP PUT failed.\n".
				    "source     : $source\n".
				    "destination: $dest");

		}
	}



	/**
	 * Private Methode zum rekursiven Anlegen von Verzeichnissen.
	 *
	 * @param String Pfad
	 * @return boolean true, wenn ok
	 */
	private function mkdirs( $strPath )
	{
		if	( @ftp_chdir($this->verb,$strPath) )
			return true; // Verzeichnis existiert schon :)
	 
		$pStrPath = dirname($strPath);
		
		if	( !$this->mkdirs($pStrPath) )
			return false;
		
		if	( ! @ftp_mkdir($this->verb,$strPath) )
            throw new OpenRatException('ERROR_PUBLISH',"failed to create remote directory: $strPath");

		return true;
	}
	
	
	
	/**
	 * Schliessen der FTP-Verbindung.<br>
	 * Sollte unbedingt aufgerufen werden, damit keine unn�tigen Sockets aufbleiben.
	 */
	public function close()
	{
		if	( ! @ftp_quit( $this->verb ) )
		{
			// Closing not possible.
			// Only logging. Maybe we could throw an Exception here?
			Logger::warn('Failed to close FTP connection. Continueing...');
			return;
		}
	}
}


?>