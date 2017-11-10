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
		
		Preferences::fixConfiguration( $conf );
		
		return $conf;
	}
	
	
	public static function fixConfiguration( &$conf )
	{
		$defaultStyleConfig = array(
			'name'=>'Unnamed',
			'title_background_color'=>'grey',
			'title_text_color'=>'white',
			'text_color' => 'black',
			'background_color' => '#d9d9d9',
			'inactive_background_color' => 'silver'
		);
		
		$defaultDatabaseConfig = array(
			'enabled'       =>true,
			'description2'  =>'',
			'user'          =>'',
			'password'      => '',
			'host'          =>'localhost',
			'port'          => '',
			'database'      => '',
			'base64'        => false,
			'prefix'        => 'or_',
			'persistent'    => true,
			'charset'       => 'UTF-8',
			'connection_sql'=> '',
			'cmd'           => '',
			'prepare'       => false,
			'transaction'   => false,
			'autocommit'    => false,
			'readonly'      => false
		);
		
		$dbconfig = &$conf['database'];
		if	( is_array($dbconfig) )
			foreach( $dbconfig as &$db )
			{
				if	( is_array($db))
					$db = array_merge( $defaultDatabaseConfig,$db );
			}
		
		$styleconfig = &$conf['style'];
		if	( is_array($styleconfig) )
			foreach( $styleconfig as &$style )
			{
				if	( is_array($style))
					$style = array_merge( $defaultStyleConfig, $style );
			}
		
	}
}
?>