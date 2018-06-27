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
    public static function slashify($pfad)
	{
		if	( substr($pfad,-1,1) == '/')
			return $pfad;
		else
			return $pfad.'/';
	}
	
	

	/**
	 * Liefert einen Verzeichnisnamen fuer temporaere Dateien.
	 */
	public static function createTempFile()
	{
		global $conf;
		$tmpdir = @$conf['cache']['tmp_dir'];
		$tmpfile = @tempnam( $tmpdir,'openrat_tmp' );

		// 2. Versuch: Temp-Dir aus "upload_tmp_dir".
		if	( $tmpfile === FALSE )
		{
			$tmpdir = ini_get('upload_tmp_dir');
			$tmpfile = @tempnam( $tmpdir,'openrat_tmp' );
		}
		
		elseif	( $tmpfile === FALSE )
		{
			$tmpfile = @tempnam( '','openrat_tmp' );
		}
		
		return $tmpfile;
	}


	/**
	 * Liefert einen Verzeichnisnamen fuer temporaere Dateien.
	 */
	public static function getTempDir()
	{
        $tmpfile = FileUtils::createTempFile();
	    
	    $tmpdir = dirname($tmpfile);
	    @unlink($tmpfile);
	    
	    return FileUtils::slashify( $tmpdir );
	}
	
	
	
	/**
	 * Liest die Dateien aus dem angegebenen Ordner in ein Array.
	 * 
	 * @param $dir string Verzeichnis, welches gelesen werden soll
	 * @return array Liste der Dateien im Ordner
	 */
	public static function readDir($dir)
	{
		$dir = FileUtils::slashify($dir);
		$dateien = array();
		
		if	( !is_dir($dir) )
		{
            throw new RuntimeException('not a directory: '.$dir);
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
			throw new RuntimeException('unable to open directory: '.$dir);
	    }
		
	}
}

?>