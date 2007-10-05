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
 * Diese Klasse stellt stellt einige Eigenschaften des Projektes dar, welche fuer
 * das Veroeffentlichen von Objekten nuetzlich sind
 * @author $Author$
 * @version $Revision$
 * @package openrat.services
 */
class Publish
{
	var $ftp;
	var $with_local          = false;
	var $with_ftp            = false;
	var $local_destdir       = '';
	var $content_negotiation = false;
	var $cut_index           = false;
	var $cmd_after_publish   = '';
	var $publishedObjects    = array();
	var $log                 = array();
	var $ok                  = true;
	
	// Konstruktor
	function Publish()
	{
		global $conf;
		$conf_project = $conf['publish']['project']; 
		
		$project = Session::getProject();

		if   ( !empty($project->ftp_url) || isset($conf['publish']['ftp']['host']) )
		{
			$this->with_ftp = true;
			$this->ftp = new Ftp( $project->ftp_url );
			
			if	( ! $this->ftp->ok )
			{
				$this->ok = false;
				$this->log = $this->ftp->log;
				return;
			}

			$this->ftp->passive = ( $project->ftp_passive == '1' );
		}
		
		$localDir = ereg_replace( '\/$','',$project->target_dir);
		if	( empty( $localDir))
			$localDir = $project->name;
			
		if	( $conf_project['override_publish_dir'] && $localDir != basename($localDir) )
			$this->local_destdir = $localDir;
		else
			$this->local_destdir = $conf_project['publish_dir'].$localDir;
			

		// Sofort pruefen, ob das Zielverzeichnis ueberhaupt beschreibbar ist.
		if   ( $this->local_destdir != '' )
		{
			if   ( !is_writeable( $this->local_destdir ) )
			{
				$this->ok = false;
				$this->log[] = 'directory not writable: '.$this->local_destdir;
				$this->log[] = 'please correct the file permissions.';
				return;
			}

			$this->with_local = true;
		}
		
		$this->content_negotiation = ( $project->content_negotiation == '1' );
		$this->cut_index           = ( $project->cut_index == '1' );

		$this->cmd_after_publish   = $project->cmd_after_publish;
		// Variablen ersetzen
		str_replace('{name}'   ,$project->name                ,$this->cmd_after_publish);
		str_replace('{dir}'    ,$this->local_destdir          ,$this->cmd_after_publish);
		str_replace('{dirbase}',basename($this->local_destdir),$this->cmd_after_publish);
	}

	
	
	/**
	 * Kopieren einer Datei aus dem temporären Verzeichnis in das Zielverzeichnis.<br>
	 * Falls notwenig, wird ein Hochladen per FTP ausgeführt.
	 *
	 * @param String $tmp_filename
	 * @param String $dest_filename
	 */
	function copy( $tmp_filename,$dest_filename )
	{
		if	( !$this->ok)
			return;
				
		global $conf;
		$source = $tmp_filename;

		if   ( $this->with_local )
		{
			$dest   = $this->local_destdir.'/'.$dest_filename;
			 
			if   (!@copy( $source,$dest ));
			{
				if	( ! $this->mkdirs( dirname($dest) ) )
					return;
		
				if   (!@copy( $source,$dest ))
				{
					$this->ok = false;
					$this->log[] = 'failed copying local file:';
					$this->log[] = 'source     : '.$source;
					$this->log[] = 'destination: '.$dest;
					return;
				}
			}
			
			// CHMOD auf der Datei ausgeführen.
			if	(!empty($conf['security']['chmod']))
			{
				if	( ! @chmod($dest,octdec($conf['security']['chmod'])) )
				{
					$this->ok = false;
					$this->log[] = 'Unable to CHMOD file '.$dest;
					return;
				}
			}
		}
		
		if   ( $this->with_ftp ) // Falls FTP aktiviert
		{
			$dest = $dest_filename;
			$this->ftp->put( $source,$dest,FTP_ASCII );

			if	( ! $this->ftp->ok )
			{
				$this->ok = false;
				$this->log[] = $this->ftp->log;
			}
		}
	}
	
	

	/**
	 * Rekursives Anlagen von Verzeichnisse
	 * Nett gemacht.
	 * Quelle: http://de3.php.net/manual/de/function.mkdir.php
	 * Thx to acroyear at io dot com
	 *
	 * @param String Verzeichnis
	 * @return boolean
	 */
	function mkdirs( $strPath )
	{
		global $conf;
		
		if	( is_dir($strPath) )
			return true;
	 
		$pStrPath = dirname($strPath);
		if	( !$this->mkdirs($pStrPath) )
			return false;
		
		if	( ! @mkdir($strPath,0777) )
		{
			$this->ok = false;
			$this->log[] = 'Cannot create directory: '.$strPath;
			return false;
		}

		// CHMOD auf dem Verzeichnis ausgeführen.
		if	(!empty($conf['security']['chmod_dir']))
		{
			if	( ! @chmod($strPath,octdec($conf['security']['chmod_dir'])) )
			{
				$this->ok = false;
				$this->log[] = 'Unable to CHMOD directory: '.$strPath;
				return false;
			}
		}
		
		
		return $this->ok;
	}



	/**
	 * Beenden des Veröffentlichungs-Vorganges.<br>
	 * Eine vorhandene FTP-Verbindung wird geschlossen.<br>
	 * Falls entsprechend konfiguriert, wird ein Systemkommando ausgeführt.
	 */
	function close()
	{
		if   ( $this->with_ftp )
		{
			$this->ftp->close();
		}

		// Ausführen des Systemkommandos.
		if	( !empty($this->cmd_after_publish) && $this->ok )
		{
			$ausgabe = array();
			$rc      = false;
			exec( $this->cmd_after_publish,$ausgabe,$rc );
			
			if	( $rc != 0 )
			{
				$this->log = $ausgabe; 
				$this->ok = false;
			}
		}
	}
	
	
	
	/**
	 * Aufräumen des Zielverzeichnisses.<br><br>
	 * Es wird der komplette Zielordner samt Unterverzeichnissen durchsucht. Jede
	 * Datei, die länger existiert als der aktuelle Request alt ist, wird gelöscht.<br>
	 * Natürlich darf diese Funktion nur nach einem Gesamt-Veröffentlichen ausgeführt werden.
	 */
	function clean()
	{
		if	( $this->ok )
			return;
			
		if	( !empty($this->local_destdir) )
			$this->cleanFolder($this->local_destdir);
	} 

	

	/**
	 * Aufräumen eines Verzeichnisses.<br><br>
	 * Dateien, die länger existieren als der aktuelle Request alt ist, werden gelöscht.<br>
	 *
	 * @param String Verzeichnis
	 */
	function cleanFolder( $folderName )
	{
		$dh = opendir( $folderName );

		while( $file = readdir($dh) )
		{
			if	( $file != '.' && $file != '..')
			{
				$fullpath = $folderName.'/'.$file;

				// Wenn eine Datei beschreibbar und entsprechend alt
				// ist, dann entfernen
				if	( is_file($fullpath)     &&
					  is_writable($fullpath) &&
					  filemtime($fullpath) < START_TIME  )
					unlink($fullpath);

				if	( is_file($fullpath)     &&
					  is_writable($fullpath) &&
					  filemtime($fullpath) < START_TIME  )
					  echo( $fullpath ).'<br/>';

				// Bei Ordnern rekursiv absteigen				
				if	( is_dir( $fullpath) )
				{
					$this->cleanFolder($fullpath);
					@rmdir($fullpath);
				}
			}
		}
	}

}

?>