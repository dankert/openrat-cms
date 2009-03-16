<?php

/**
 * Werkzeugklasse f�r Datei-Operationen.
 *
 */
class FileUtils
{
	/**
	 * Fuegt einen Slash ("/") an das Ende an, sofern nicht bereits vorhanden.
	 *
	 * @param String $pfad
	 * @return Pfad mit angeh�ngtem Slash.
	 */
	function slashify($pfad)
	{
		if	( substr($pfad,-1,1) == '/')
			return $pfad;
		else
			return $pfad.'/';
	}
	
	
	/**
	 * Ermittelt das tempor�re Verzeichnis.
	 *
	 * @return String
	 */
	function getTempDir()
	{
		$tmpFilename = tempnam(ini_get('upload_tmp_dir'),"bla");
		@unlink($tmpFilename);
		return FileUtils::slashify( dirname($tmpFilename) );
	}
	
	
	
	/**
	 * Liest die Dateien aus dem angegebenen Ordner in ein Array.
	 * 
	 * @param $dir Verzeichnis, welches gelesen werden soll
	 * @return Array Liste der Dateien im Ordner
	 */
	function readDir($dir)
	{
		$dir = FileUtils::slashify($dir);
		$dateien = array();
		
		if	( !is_dir($dir) )
		{
			return false;
		}
		
		if	( $dh = opendir($dir) )
		{
			while( ($verzEintrag = readdir($dh)) !== false )
			{
				if	( substr($verzEintrag,0,1) != '.' )
				{
					$dateien[] = $verzEintrag;
				}
	        }
	        closedir($dh);
	        
	        return $dateien;
	    }
	    else
	    {
			die('unable to open directory: '.$dir);
	    }
		
	}
}

?>