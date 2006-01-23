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
	function load( $dir='' )
	{
		$values = array();
		
		if	( empty($dir) )
			$dir = OR_PREFERENCES_DIR;
			
		if (is_dir($dir))
		{
			if	( $dh = opendir($dir) )
			{
				while( ($file = readdir($dh)) !== false )
				{
					$file = basename($file);
//					if	( substr($file,0,1) != '.' && $file != 'CVS' && is_dir($dir.$file) && is_file($dir.$file.'/prefs.ini.php') )
					if	( substr($file,0,1) != '.' && is_file($dir.$file.'/prefs.ini.php') )
					{
						$values[$file] = $this->load($dir.$file.'/');
					}
		        }
		        closedir($dh);
		    }

		    if	( !is_file($dir.'prefs.ini.php') )
				die( 'file not found: '.$dir.'prefs.ini.php');

		    $values = $values + parse_ini_file( $dir.'prefs.ini.php' );
			ksort($values);
			
			return $values;
		}
		else die('not a folder: '.$dir);
	}
}
?>