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
		$config_files = array();
		
		// Falls Umgebungsvariable OPENRAT_CONFIG_FILE gesetzt ist,
		// dann diesen Dateinamen verwenden.
		if	( !empty($_SERVER['OPENRAT_CONFIG_FILE']) )
			$config_files[] = $_SERVER['OPENRAT_CONFIG_FILE'];

		// Falls Umgebungsvariable OPENRAT_CONFIG_DIR gesetzt ist, dann
		// die Datei in diesem Ordner suchen.
		if	( !empty($_SERVER['OPENRAT_CONFIG_DIR']) )
			$dir = $_SERVER['OPENRAT_CONFIG_DIR'];
		else
			$dir = './config/';

			
		if	( !empty($_SERVER['HTTP_HOST']) )
		{
			// Falls es eine Datei config-<hostname>.yml gibt, dann diese
			// vor der Datei config.ini.php bevorzugen.
			$config_files[] = slashify($dir).'config-'.$_SERVER['HTTP_HOST'].'.yml';
		}
			
		$config_files[] = slashify($dir).'config.yml';
		$config_files[] = '/etc/openrat/config.yml';
		$config_files[] = '/etc/openrat.yml';

		// Alle Orte durchsuchen, bis die Config-Datei gefunden wird.
		foreach( $config_files as $config_filename )
		{
			if	( is_file($config_filename))
				return $config_filename; // Datei gefunden.
		}
		
		throw new LogicException('Configuration file not found. Searched locations: '.implode(',',$config_files) );
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
		require('./util/config-default.php');

		$filename = Preferences::configurationFile();
		$customConfig =  Spyc::YAMLLoad( $filename );
		
		// Besonderheit:
		// Alle Konfigurationsschlüssel mit einem Punkt ('.') im Namen zu Arrays auflösen.
		foreach ( $customConfig as $key=>$value )
		{
			$parts = explode('.',$key);
			if	( count($parts)==1 )
				; // Kein Punkt enthalten. Dieser Konfigurationsschlüssel wird nicht geändert.
			else
			{
				
				if	( count($parts)==2)
					$customConfig[$parts[0]][$parts[1]] = $value;
				elseif	( count($parts)==3)
					$customConfig[$parts[0]][$parts[1]][$parts[2]] = $value;
				elseif	( count($parts)==4)
					$customConfig[$parts[0]][$parts[1]][$parts[2]][$parts[3]] = $value;
				elseif	( count($parts)==5)
					$customConfig[$parts[0]][$parts[1]][$parts[2]][$parts[3]][$parts[4]] = $value;
				elseif	( count($parts)==6)
					$customConfig[$parts[0]][$parts[1]][$parts[2]][$parts[3]][$parts[4]][$parts[5]] = $value;
				unset( $customConfig[$key] );
			}
		}
		
		$conf = array_replace_recursive( $conf, $customConfig );

		// Den Dateinamen der Konfigurationsdatei in die Konfiguration schreiben.
		$conf['config']['filename'              ] = $filename;
		$conf['config']['last_modification_time'] = filemtime($filename);
		$conf['config']['last_modification'     ] = date('r',filemtime($filename));
		$conf['config']['read'                  ] = date('r');
		
		return $conf;
	}
}
?>