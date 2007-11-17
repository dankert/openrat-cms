<?php

/**
 * Werkzeugklasse für Datei-Operationen.
 *
 */
class FileUtils
{
	/**
	 * Fügt einen Slash ("/") an das Ende an, sofern nicht bereits vorhanden.
	 *
	 * @param String $pfad
	 * @return Pfad mit angehängtem Slash.
	 */
	function slashify($pfad)
	{
		if	( substr($pfad,-1,1) == '/')
			return $pfad;
		else
			return $pfad.'/';
	}
	
	
	/**
	 * Ermittelt das temporäre Verzeichnis.
	 *
	 * @return String
	 */
	function getTempDir()
	{
		$tmpFilename = tempnam(ini_get('upload_tmp_dir'),"bla");
		@unlink($tmpFilename);
		return FileUtils::slashify( dirname($tmpFilename) );
	}
}

?>