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
		define('QUOTE','"');
		
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
				
				if	( is_file($filename) && eregi('\.(ini.*|conf)$',$verzEintrag) )
				{
					$nameBestandteile = explode('.',$verzEintrag);
					
				    $values[$nameBestandteile[0]] = parse_ini_file( $filename,true );
				}
	        }
	        closedir($dh);
	    }

		ksort($values);

		return $values;
	}
}
?>