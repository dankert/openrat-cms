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
	var $log = '';
	var $mode=FTP_ASCII;
	var $passive = false;
	

	// Konstruktor
	function Ftp( $url )
	{
		$this->connect( $url );
	}

	
	// Aufbauen der Verbindung
	function connect( $url )
	{
		$this->url = $url;
		
		global $db,
		       $SESS,
		       $t_project;
	
		$ftp = parse_url( $this->url );
		
		// Wenn kein Port vorgegeben, dann Port 21 verwenden
		if   ( empty($ftp['port']) )
			$ftp['port'] = '21';
	
		// Nur FTP und FTPS (seit PHP 4.3) erlaubt
		if   ( !ereg('^ftps?$',$ftp['scheme']) )
			die( 'unknown scheme in FTP Url: '.$ftp['scheme'] );
		
		$this->verb = ftp_connect( $ftp['host'],$ftp['port'] );

		if   ( !$this->verb )
		{
			error('ERROR_FTP','ERROR_FTP_CANNOT_CONNECT_TO_SERVER','Cannot connect to '.$ftp['host'].':'.$ftp['port']);
		}

		$this->log .= 'connecting ...'."\n";
		$this->log .= 'host: '.$ftp['host']."\n";
		$this->log .= 'port: '.$ftp['port']."\n";
		
		$erg = ftp_login( $this->verb,$ftp['user'],$ftp['pass'] );

		if   ( !$erg )
		{
			error('ERROR_FTP','ERROR_FTP_CANNOT_LOGIN','cannot login user: '.$ftp['user']);
		}
		
		$this->log .= 'ok'."\n";
		$this->log .= 'login  ...'."\n";
		$this->log .= 'user: '.$ftp['user']."\n";
		$this->log .= 'ok'."\n";

		if   ( !empty($ftp['fragment']) && $ftp['fragment'] == 'passive' )
		{
			$this->log .= 'entering passive mode'."\n";
			$erg = ftp_pasv( $this->verb,true  );

			if   ( !$erg )
			{
				error('ERROR_FTP','ERROR_FTP_CANNOT_PASV_ON');
			}
		}
		else
		{
			$this->log .= 'no passive mode'."\n";
			$erg = ftp_pasv( $this->verb,false );
			
			if   ( !$erg )
			{
				error('ERROR_FTP','ERROR_FTP_CANNOT_PASV_OFF');
			}
		}
		
		if   ( !empty($ftp['query']) )
		{
			parse_str( $ftp['query'],$ftp_var );
			
			if   ( isset( $ftp_var['site'] ) )
			{
				$site_commands = explode( ',',$ftp_var['site'] );
				foreach( $site_commands as $cmd )
				{
					$this->log .= 'exec SITE command: '.$cmd."\n";
					ftp_site( $this->verb,$cmd );
				}
			}
		}

		$this->path = ereg_replace( '\/$','',$ftp['path']);
		
		$this->log .= 'Change directory to '.$this->path.'...'."\n";
		$erg = ftp_chdir( $this->verb,$this->path );

				
		if   ( !$erg )
		{
			error('ERROR_FTP','ERROR_FTP_UNABLE_TO_CHDIR','could not CHDIR to '.$this->path );
		}
		$this->log .= 'ok'."\n";

		
		//echo "pwd ist".ftp_pwd( $this->verb );
	}
	

	function put( $source,$dest,$mode=FTP_BINARY )
	{
		$ftp = parse_url( $this->url );

		$dest = $this->path.'/'.$dest;
		
		$this->log .= "Copying file: $source -&gt; $dest ...\n";
		if   ( !@ftp_put( $this->verb,$dest,$source,$this->mode ) )
		{
			$this->log .= "Copying FAILED, checking path: ".dirname($dest)."\n";

			$erg = $this->mkdirs( dirname($dest) );

			if   ( !$erg )
			{
				error('ERROR_FTP','ERROR_FTP_UNABLE_TO_MKDIR','cannot create directoriy '.$ftp['path'].'/'.dirname($dest) );
			}

			ftp_chdir( $this->verb,$this->path );

			$erg = ftp_put( $this->verb,$dest,$source,$mode );
			
			if   ( !$erg )
			{
				error('ERROR_FTP','ERROR_FTP_UNABLE_TO_COPY','put failed from '.$source.' to '.$dest );
			}
			
		}
	}



	// Rekursives Anlagen von Verzeichnisse
	function mkdirs( $strPath )
	{
		echo $strPath.'<br>';
		if	( @ftp_chdir($this->verb,$strPath) )
			return true;
	 
		$pStrPath = dirname($strPath);
		if	( !$this->mkdirs($pStrPath) )
			return false;
		
		$this->log .= "Creating directory: $strPath ...\n";
		//echo "lege an $strPath ...<br>";
		return ftp_mkdir($this->verb,$strPath);
	}
	
	
	function close()
	{
		ftp_quit( $this->verb );
	}
}


?>