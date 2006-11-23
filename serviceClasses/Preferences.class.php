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
	/*

	function loadOLDxxxxxxxxxxxxxxx( $dir='' )
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
	
	*/
	
	
	
	function load( $dir='' )
	{
//		echo "x:$dir<br>";
		$values = array();
		
		// Bei erstem (nicht-rekursiven) Aufruf der Methoden das Konfigurationsverzeichnis voreinstellen 
		if	( empty($dir) )
			$dir = OR_PREFERENCES_DIR;
			
		if	( !is_dir($dir) )
			die('not a directory: '.$dir);
		
		if	( $dh = opendir($dir) )
		{
			while( ($verzEintrag = readdir($dh)) !== false )
			{
				$filename = $dir.$verzEintrag;
				
//				echo "....-$filename-....<br>";
//				if	( is_dir($filename) && substr($verzEintrag,0,1)!='.' && substr($verzEintrag,0,3)!='CVS' )
//				{
////					echo " ist ein DIR<br>";
//					if	( !isset($values[$verzEintrag]) )
//						$values[$verzEintrag] = array();
//					$values[$verzEintrag] += $this->load($filename.'/');
//				}
//else
				if	( is_file($filename) && eregi('\.(ini.*|conf)$',$verzEintrag) )
				{
//					echo " ist ein FILE<br>";
					$nameBestandteile = explode('.',$verzEintrag);
//					if	( !isset($values[$nameBestandteile[0]]) )
//						$values[$nameBestandteile[0]] = array();
					
				    $values[$nameBestandteile[0]] = parse_ini_file( $filename,true );
				}
//				else
//					echo " ist GARNIX<br>";
	        }
	        closedir($dh);
	    }

		ksort($values);

//echo"<pre>";
//print_r($values);		
//echo"</pre>";
		return $values;
	}
}
?>