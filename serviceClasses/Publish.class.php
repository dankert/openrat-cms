<?php
#
#  DaCMS Content Management System
#  Copyright (C) 2002 Jan Dankert, jandankert@jandankert.de
#
#  This program is free software; you can redistribute it and/or
#  modify it under the terms of the GNU General Public License
#  as published by the Free Software Foundation; either version 2
#  of the License, or (at your option) any later version.
#
#  This program is distributed in the hope that it will be useful,
#  but WITHOUT ANY WARRANTY; without even the implied warranty of
#  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#  GNU General Public License for more details.
#
#  You should have received a copy of the GNU General Public License
#  along with this program; if not, write to the Free Software
#  Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
#

/**
 * Diese Klasse stellt stellt einige Eigenschaften des Projektes dar, welche fuer
 * das Veroeffentlichen von Objekten nuetzlich sind
 * @author $Author$
 * @version $Revision$
 * @package openrat.services
 */
class Publish
{
	var $ftp;
	var $with_local          = false;
	var $with_ftp            = false;
	var $local_destdir       = '';
	var $content_negotiation = false;
	var $cut_index           = false;
	var $cmd_after_publish   = '';
	var $publishedObjects    = array();
	
	// Konstruktor
	function Publish()
	{
		$project = Session::getProject();

		if   ( !empty($project->ftp_url) )
		{
			$this->ftp = new Ftp( $project->ftp_url );
			$this->with_ftp = true;

			$this->ftp->passive = ( $project->ftp_passive == '1' );
		}
		
		$this->local_destdir = ereg_replace( '\/$','',$project->target_dir);

		// Sofort pruefen, ob das Zielverzeichnis ueberhaupt beschreibbar ist.
		if   ( $this->local_destdir != '' )
		{
			if   ( !is_writeable( $this->local_destdir ) )
			{
				die( 'directory not writable: '.$this->local_destdir );
			}

			$this->with_local = true;
		}
		
		$this->content_negotiation = ( $project->content_negotiation == '1' );
		$this->cut_index           = ( $project->cut_index == '1' );

		$this->cmd_after_publish   = $project->cmd_after_publish;
	}

	function copy( $tmp_filename,$dest_filename )
	{	
		global $conf;
		$source = $tmp_filename;

		if   ( $this->with_local )
		{
			$dest   = $this->local_destdir.'/'.$dest_filename; 
			//echo "$source &gt; $dest<br>";
			if   (!@copy( $source,$dest ));
			{
				$this->mkdirs( dirname($dest) );
		
				if   (!copy( $source,$dest ))
				{
					die('failed writing file: '.$dest);
				}
			}
			
			
			if	(!empty($conf['security']['chmod']))
				chmod($dest,octdec($conf['security']['chmod']));
		}
		
		if   ( $this->with_ftp )
		{
			$dest = $dest_filename;
			$this->ftp->put( $source,$dest,FTP_ASCII );
		}
	}
	
	
	// Rekursives Anlagen von Verzeichnisse
	// Nett gemacht.
	// Quelle: http://de3.php.net/manual/de/function.mkdir.php
	// Thx to acroyear at io dot com
	function mkdirs( $strPath )
	{
		if	( is_dir($strPath) )
			return true;
	 
		$pStrPath = dirname($strPath);
		if	( !$this->mkdirs($pStrPath) )
			return false;
		
		//echo "lege an: $strPath<br>";
		return @mkdir($strPath,0755);
	}



	function close()
	{
		if   ( $this->with_ftp )
		{
			$this->ftp->close();
		}
		
		if	( !empty($this->cmd_after_publish) )
			exec( $this->cmd_after_publish );
	}
	
	
	function clean()
	{
		if	( !empty($this->local_destdir) )
			$this->cleanFolder($this->local_destdir);
	} 


	function cleanFolder( $folderName )
	{
		$dh = opendir( $folderName );

		while( $file = readdir($dh) )
		{
			if	( $file != '.' && $file != '..')
			{
				$fullpath = $folderName.'/'.$file;

				// Wenn eine Datei beschreibbar und entsprechend alt
				// ist, dann entfernen
				if	( is_file($fullpath)     &&
					  is_writable($fullpath) &&
					  filemtime($fullpath) < START_TIME  )
					unlink($fullpath);

				if	( is_file($fullpath)     &&
					  is_writable($fullpath) &&
					  filemtime($fullpath) < START_TIME  )
					  echo( $fullpath ).'<br/>';

				// Bei Ordnern rekursiv absteigen				
				if	( is_dir( $fullpath) )
				{
					$this->cleanFolder($fullpath);
					@rmdir($fullpath);
				}
			}
		}
	}

}

?>