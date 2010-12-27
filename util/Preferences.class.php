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
	function load( $dir='' )
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
			
			if	( is_file($filename) && eregi('\.(ini.*|conf)$',$datei) )
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