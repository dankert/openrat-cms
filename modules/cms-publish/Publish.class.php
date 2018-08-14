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
use cms\model\Project;

/**
 * Diese Klasse kapselt das Veroeffentlichen von Dateien.<br>
 * <br>
 * Hier werden<br>
 * - Dateien in das Zielverzeichnis kopiert<br>
 * - Dateien per FTP veroeffentlicht<br>
 * - Zielverzeichnisse aufgeraeumt<br>
 * - Systembefehle ausgefuehrt.
 * 
 * @author Jan Dankert
 * @package openrat.services
 */
class Publish
{
	/**
	 * Enthaelt bei Bedarf das FTP-Objekt. N�mlich dann, wenn
	 * zu einem FTP-Server veroeffentlicht werden soll.
	 * @var Object
	 */
	var $ftp;
	
	/**
	 * Flag, ob in das lokale Dateisystem veroeffentlicht werden soll.
	 * @var boolean
	 */
	var $with_local          = false;
	
	/**
	 * Flag, ob zu einem FTP-Server ver�ffentlicht werden soll.
	 * @var boolean
	 */
	var $with_ftp            = false;
	
	var $local_destdir       = '';
	
	/**
	 * Enthaelt die gleichnamige Einstellung aus dem Projekt.
	 * @var boolean
	 */
	var $content_negotiation = false;
	
	/**
	 * Enthaelt die gleichnamige Einstellung aus dem Projekt.
	 * @var boolean
	 */
	var $cut_index           = false;
	
	/**
	 * Enthaelt die gleichnamige Einstellung aus dem Projekt.
	 * @var String
	 */
	var $cmd_after_publish   = '';
	
	/**
	 * Enthaelt am Ende der Ver�ffentlichung ein Array mit den ver�ffentlichten Objekten.
	 * @var Array
	 */
	var $publishedObjects    = array();
	
	/**
	 * Enthaelt im Fehlerfall (wenn 'ok' auf 'false' steht) eine
	 * Fehlermeldung.
	 * 
	 * @var String
	 */
	var $log                 = array();
	
	/**
	 * Stellt nach der Ver�ffentlichung fest, ob der Vorgang erfolgreich ist.
	 * Falls nicht, enth�lt die Variable 'log' eine Fehlermeldung. 
	 * @var boolean
	 */
	var $ok                  = true;

	/**
	 * Konstruktor.<br>
	 * <br>
	 * Oeffnet ggf. Verbindungen.
	 *
	 * @return Publish
	 */
	function __construct( $projectid )
	{
		$confPublish = config('publish');
		
		if	( config('security','nopublish') )
		{
			$this->ok = false;
			$this->log[] = 'publishing is disabled.';
			return;
		}
		
		$project = new Project( $projectid );
		$project->load();

		// Feststellen, ob FTP benutzt wird.
		// Dazu muss FTP aktiviert sein (enable=true) und eine URL vorhanden sein.
		$ftpUrl = '';
		if   ( $confPublish['ftp']['enable'] )
		{
			if	( $confPublish['ftp']['per_project'] && !empty($project->ftp_url) )
				$ftpUrl = $project->ftp_url;
			elseif ( !empty($confPublish['ftp']['host']) )
				$ftpUrl = $project->ftp_url;
		}
		
		if	( ! empty($ftpUrl) )
		{
			$this->with_ftp = true;
			$this->ftp = new Ftp( $project->ftp_url ); // Aufbauen einer FTP-Verbindung
			
			if	( ! $this->ftp->ok ) // FTP-Verbindung ok?
			{
				$this->ok = false;
				$this->log = $this->ftp->log;
				return; // Ende. Ohne FTP brauchen wir nicht weitermachen.
			}

			$this->ftp->passive = ( $project->ftp_passive == '1' );
		}
		
		$localDir = rtrim( $project->target_dir,'/' );
			
		if	( $confPublish['filesystem']['per_project'] && (!empty($localDir)) )
		{
			$this->local_destdir = $localDir; // Projekteinstellung verwenden.
		}
		else
		{
			if	( empty( $localDir))
				$localDir = $project->name;
			// Konfiguriertes Verzeichnis verwenden.
			$this->local_destdir = $confPublish['filesystem']['directory'].$localDir;
		}
			

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
		$this->cut_index           = ( $project->cut_index           == '1' );

		if	( $confPublish['command']['enable'] )
		{
			if	( $confPublish['command']['per_project'] && !empty($project->cmd_after_publish) )
				$this->cmd_after_publish   = $project->cmd_after_publish;
			else
				$this->cmd_after_publish   = @$confPublish['command']['command'];
		}
		
		// Im Systemkommando Variablen ersetzen
		$this->cmd_after_publish = str_replace('{name}'   ,$project->name                ,$this->cmd_after_publish);
		$this->cmd_after_publish = str_replace('{dir}'    ,$this->local_destdir          ,$this->cmd_after_publish);
		$this->cmd_after_publish = str_replace('{dirbase}',basename($this->local_destdir),$this->cmd_after_publish);
	}

	
	
	/**
	 * Kopieren einer Datei aus dem tempor�ren Verzeichnis in das Zielverzeichnis.<br>
	 * Falls notwenig, wird ein Hochladen per FTP ausgef�hrt.
	 *
	 * @param String $tmp_filename
	 * @param String $dest_filename
	 */
	function copy( $tmp_filename,$dest_filename,$lastChangeDate=null )
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
					return;  // Fehler bei Verzeichniserstellung, also abbrechen.
		
				if   (!@copy( $source,$dest ))
				{
					$this->ok = false;
					$this->log[] = 'failed copying local file:';
					$this->log[] = 'source     : '.$source;
					$this->log[] = 'destination: '.$dest;
					return; // Fehler beim Kopieren, also abbrechen.
				}
				if	( ! is_null($lastChangeDate) )
					@touch( $dest,$lastChangeDate );
				
				Logger::debug("published: $dest");
			}
			
			if	(!empty($conf['security']['chmod']))
			{
				// CHMOD auf der Datei ausfuehren.
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
			$this->ftp->put( $source,$dest );

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

		// CHMOD auf dem Verzeichnis ausgef�hren.
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
	 * Beenden des Ver�ffentlichungs-Vorganges.<br>
	 * Eine vorhandene FTP-Verbindung wird geschlossen.<br>
	 * Falls entsprechend konfiguriert, wird ein Systemkommando ausgef�hrt.
	 */
	public function close()
	{
		if   ( $this->with_ftp )
		{
			Logger::debug('Closing FTP connection' );
			$this->ftp->close();
		}

		// Ausfuehren des Systemkommandos.
		if	( !empty($this->cmd_after_publish) && $this->ok )
		{
			$ausgabe = array();
			$rc      = false;
			Logger::debug('Executing system command: '.$this->cmd_after_publish );
			$user = Session::getUser();
			putenv("CMS_USER_NAME=".$user->name  );
			putenv("CMS_USER_ID="  .$user->userid);
			putenv("CMS_USER_MAIL=".$user->mail  );
			exec( $this->cmd_after_publish,$ausgabe,$rc );
			
			if	( $rc != 0 ) // Wenn Returncode ungleich 0, dann Ausgabe ins Log schreiben und Fehler melden.
			{
				$this->log   = $ausgabe; 
				$this->log[] = 'OpenRat: System command failed - returncode is '.$rc; 
				$this->ok = false;
				
				Logger::warn('System command '.$this->cmd_after_publish.' failed with status '.$rc );
				
			}
			else
			{
				Logger::debug('System command successful' );
			}
				
		}
	}
	
	
	
	/**
	 * Aufraeumen des Zielverzeichnisses.<br><br>
	 * Es wird der komplette Zielordner samt Unterverzeichnissen durchsucht. Jede
	 * Datei, die laenger existiert als der aktuelle Request alt ist, wird geloescht.<br>
	 * Natuerlich darf diese Funktion nur nach einem Gesamt-Veroeffentlichen ausgefuehrt werden.
	 */
	function clean()
	{
		if	( $this->ok )
			return;
			
		if	( !empty($this->local_destdir) )
			$this->cleanFolder($this->local_destdir);
	} 

	

	/**
	 * Aufr�umen eines Verzeichnisses.<br><br>
	 * Dateien, die l�nger existieren als der aktuelle Request alt ist, werden gel�scht.<br>
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