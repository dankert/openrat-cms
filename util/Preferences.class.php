<?php

/**
 * Bereitstellen von Methoden fuer das Lesen von Einstellungen
 *
 * @author $Author$
 * @version $Revision$
 * @package openrat.services
 */
class Preferences
{
	/**
	 * Liest die Konfigurationsdateien im angegebenen Ordner.
	 * 
	 * @param $dir Verzeichnis, welche gelesen wird. Optional. Falls nicht gesetzt, wird
	 * das Standard-Konfigurationsverzeichnis verwendet. 
	 * @return Array
	 */
	public static function load()
	{
		if	( !empty($_SERVER['OPENRAT_CONFIG_FILE']) )
		{
			$config_filename = $_SERVER['OPENRAT_CONFIG_FILE'];
		}
		else
		{
			if	( !empty($_SERVER['OPENRAT_CONFIG_DIR']) )
				$dir = $_SERVER['OPENRAT_CONFIG_DIR'];
			else
				$dir = './config/';
			
			if	( !empty($_SERVER['HTTP_HOST']) )
			{
				$vhost_config_file = slashify($dir).'config-'.$_SERVER['HTTP_HOST'].'.ini.php';
				
				if	( is_file($vhost_config_file) )
					$config_filename = $vhost_config_file;
				else
					$config_filename = slashify($dir).'config.ini.php';
			}
		}
		
		require('./config/config-default.php');
		//echo "default: "; print_r($conf);
		
		if	( ! is_file($config_filename))
			Http::serverError("Configuration not found","The file does not exist: ".$config_filename);
		
		$ini_values =  parse_ini_file( $config_filename,false );
		
		//echo "loading ".$config_filename;
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