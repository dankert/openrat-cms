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
					if	( substr($file,0,1) != '.' && is_dir($dir.$file) )
					{
						$values[$file] = $this->load($dir.$file.'/');
					}
		        }
		        closedir($dh);
		    }
		    
		    if	( is_file($dir.'prefs.ini.php') )
				$values = $values + parse_ini_file( $dir.'prefs.ini.php' );
				
			ksort($values);
			
			return $values;
		}
		else die('not a folder: '.$dir);
	}
}
?>