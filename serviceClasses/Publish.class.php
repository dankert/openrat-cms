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
		global $SESS;

		$db = db_connection();
		
		// Projektdaten ermitteln
		$sql = new Sql( 'SELECT * FROM {t_project}'.
		                ' WHERE id={projectid}' );
		$sql->setInt( 'projectid',$SESS['projectid'] );
		$row = $db->getRow( $sql->query );
	
		if   ( $row['ftp_url'] != '' )
		{
			$this->ftp = new Ftp( $row['ftp_url'] );
			$this->with_ftp = true;

			if   ( $row['ftp_passive'] == '1' )
				$this->ftp->passive = true;
		}
		
		$this->local_destdir = ereg_replace( '\/$','',$row['target_dir']);

		// Sofort prüfen, ob das Zielverzeichnis überhaupt beschreibbar ist.
		if   ( $this->local_destdir != '' )
		{
			if   ( !is_writeable( $this->local_destdir ) )
			{
				message('ERROR','ERROR_DESTDIR_NOT_WRITEABLE','not writable: '.$this->local_destdir );
			}

			$this->with_local = true;
		}
		
		if   ( $row['content_negotiation'] == '1' )
			$this->content_negotiation = true; 

		if   ( $row['cut_index'] == '1' )
			$this->cut_index = true;

		$this->cms_after_publish = $row['cmd_after_publish'];
	}

	function copy( $tmp_filename,$dest_filename )
	{	
		$source = $tmp_filename;

		if   ( $this->with_local )
		{
			$dest   = $this->local_destdir.'/'.$dest_filename; 
			//echo "$source &gt; $dest<br>";
			if   (!copy( $source,$dest ));
			{
				$this->mkdirs( dirname($dest) );
		
				if   (!copy( $source,$dest ))
				{
					//echo "$source &gt; $dest<br>";
					error('ERROR','ERROR_DESTDIR_NOT_WRITEABLE','cannot write file '.$dest);
				}
			}
		}
		
		if   ( $this->with_ftp )
		{
			$dest = $dest_filename;
			$this->ftp->put( $source,$dest,FTP_ASCII );
		}
		
		$this->publishedObjects[] = Array( 'filename'=>$dest_filename );
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
	}	
}

?>