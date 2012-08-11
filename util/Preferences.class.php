<?php

/**
 * Hilfsmethoden fuer das Lesen von Einstellungen.
 *
 * @author Jan Dankert
 * @package openrat.util
 */
class Preferences
{
	/**
	 * Ermittelt den Zeitpunkt der letzten Änderung der Konfigurationsdatei.
	 * 
	 * @return Zeitpunkt der letzten Änderung als Unix-Timestamp
	 */
	public static function lastModificationTime()
	{
		return filemtime( Preferences::configurationFile() );
	}
	
	

	/**
	 * Ermittelt den Dateinamen der Konfigurationsdatei.
	 */
	public static function configurationFile()
	{
		// Falls Umgebungsvariable OPENRAT_CONFIG_FILE gesetzt ist,
		// dann diesen Dateinamen verwenden.
		if	( !empty($_SERVER['OPENRAT_CONFIG_FILE']) )
		{
			$config_filename = $_SERVER['OPENRAT_CONFIG_FILE'];
		}
		else
		{
			// Falls Umgebungsvariable OPENRAT_CONFIG_DIR gesetzt ist, dann
			// die Datei in diesem Ordner suchen.
			if	( !empty($_SERVER['OPENRAT_CONFIG_DIR']) )
				$dir = $_SERVER['OPENRAT_CONFIG_DIR'];
			else
				$dir = './config/';

				
			if	( !empty($_SERVER['HTTP_HOST']) )
			{
				// Falls es eine Datei config-<hostname>.ini.php gibt, dann diese
				// vor der Datei config.ini.php bevorzugen.
				$vhost_config_file = slashify($dir).'config-'.$_SERVER['HTTP_HOST'].'.ini.php';
				
				if	( is_file($vhost_config_file) )
					$config_filename = $vhost_config_file;
				else
					$config_filename = slashify($dir).'config.ini.php';
			}
			else
			{
				$config_filename = slashify($dir).'config.ini.php';
			}
		}
		
		if	( ! is_file($config_filename))
		{
			error_log('configuration file not found: '.$config_filename,0);
			Http::serverError("Configuration not found","The file does not exist: ".$config_filename);
		}

		return $config_filename;
	}
	
	
	
	/**
	 * Liest die Konfigurationsdateien im angegebenen Ordner.
	 * 
	 * @param $dir Verzeichnis, welche gelesen wird. Optional. Falls nicht gesetzt, wird
	 * das Standard-Konfigurationsverzeichnis verwendet. 
	 * @return Array
	 */
	public static function load()
	{
		// Fest eingebaute Standard-Konfiguration laden.
		require('./config/config-default.php');

		$filename = Preferences::configurationFile();
		$ini_values =  parse_ini_file( $filename,false );
		
		foreach ( $ini_values as $key=>$value )
		{
			$parts = explode('.',$key);
			if	( count($parts)==1)
				$conf[$parts[0]] = $value;
			elseif	( count($parts)==2)
				$conf[$parts[0]][$parts[1]] = $value;
			elseif	( count($parts)==3)
				$conf[$parts[0]][$parts[1]][$parts[2]] = $value;
			elseif	( count($parts)==4)
				$conf[$parts[0]][$parts[1]][$parts[2]][$parts[3]] = $value;
			elseif	( count($parts)==5)
				$conf[$parts[0]][$parts[1]][$parts[2]][$parts[3]][$parts[4]] = $value;
			elseif	( count($parts)==6)
				$conf[$parts[0]][$parts[1]][$parts[2]][$parts[3]][$parts[4]][$parts[5]] = $value;
		}

		// Den Dateinamen der Konfigurationsdatei in die Konfiguration schreiben.
		$conf['config']['filename'         ] = $filename;
		$conf['config']['last_modification'] = filemtime($filename);
		$conf['config']['file_modification'] = date('r',filemtime($filename));
		$conf['config']['read'             ] = date('r');
		return $conf;
	}
	
	
	
	
	/**
	 * Liest die Konfigurationsdateien im angegebenen Ordner.
	 * 
	 * @param $dir Verzeichnis, welche gelesen wird. Optional. Falls nicht gesetzt, wird
	 * das Standard-Konfigurationsverzeichnis verwendet. 
	 * @return Array
	 */
	public static function loadDirectory( $dir='' )
	{
		if	( !defined('QUOTE') )
			define('QUOTE','"');
		
		$values = array();
		
		// Bei erstem (nicht-rekursiven) Aufruf der Methoden das Konfigurationsverzeichnis voreinstellen 
		if	( empty($dir) )
		{
			if	( isset($_GET['config']) )
				$dir = basename( $_GET['config'] ).'/';
			else
				$dir = OR_PREFERENCES_DIR;
		}
			
		if	( !is_dir($dir) )
		{
			Http::sendStatus(501,'Internal Server Error','not a directory: '.$dir);
			exit;
		}
		
		$dateien = FileUtils::readDir($dir);
		
		foreach( $dateien as $datei )
		{
			$filename = $dir.$datei;
			
			if	( is_file($filename) && eregi('\.(ini.*|ini|conf)$',$datei) )
			{
				$nameBestandteile = explode('.',$datei);
			    $values[$nameBestandteile[0]] = parse_ini_file( $filename,true );
			}
	    }
	    
		ksort($values);

		return $values;
	}
}
?>