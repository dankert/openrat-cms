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
namespace cms\generator\target;

use cms\base\Configuration;
use cms\base\Startup;
use logger\Logger;
use util\exception\PublisherException;
use util\exception\UIException;
use util\FileUtils;
use util\Url;


/**
 * Publishing to the local filesystem.
 *
 * @author Jan Dankert
 */
class LocalTarget extends  BaseTarget
{
	/**
	 * @var string
	 */
	private $localDestinationDirectory;

	/**
	 * @param $url Url
	 */
	public function open()
	{
		$fileSystemConfig = Configuration::subset(['publish','filesystem']);

		$targetDir = rtrim( $this->url->path,'/' );

		if	( FileUtils::isAbsolutePath($targetDir) && $fileSystemConfig->is('per_project',true ))
		{
			$this->localDestinationDirectory = FileUtils::toAbsolutePath([$targetDir]); // Projekteinstellung verwenden.
		}
		else
		{
			// Konfiguriertes Verzeichnis verwenden.
			$this->localDestinationDirectory = FileUtils::toAbsolutePath([$fileSystemConfig->get('directory','/var/www'),$targetDir]);
		}

		// Sofort pruefen, ob das Zielverzeichnis ueberhaupt beschreibbar ist.
		if   ( $this->localDestinationDirectory && $this->localDestinationDirectory[0] == '#')
			$this->localDestinationDirectory = '';

	}

	/**
	 * Copying a file to local filesystem.
	 *
	 * @param String Quelle
	 * @param String Ziel
	 * @throws PublisherException
	 */
	public function put($source, $dest, $lastChangeDate)
	{
		// Is the output directory existent?
		if   ( !is_dir( $this->localDestinationDirectory ) )
			if   ( ! @mkdir( $this->localDestinationDirectory ) )
				throw new PublisherException('cannot create directory: ' . $this->localDestinationDirectory);

		// Is the output directory writable?
		if   ( !is_writeable( $this->localDestinationDirectory ) )
			throw new PublisherException('directory not writable: ' . $this->localDestinationDirectory);


		$dest   = $this->localDestinationDirectory.'/'.$dest;


		// Is the destination writable?
		if   ( is_file($dest) && !is_writeable( $dest ) )
			throw new PublisherException('file not writable: ' . $dest);

		// Copy file to destination
		if   (!@copy( $source,$dest ));
		{
			// Create directories, if necessary.
			$this->mkdirs( dirname($dest) );

			if   (!@copy( $source,$dest ))
				throw new PublisherException( 'failed copying local file:' . "\n" .
					'source     : ' . $source . "\n" .
					'destination: ' . $dest);

			// Das Änderungsdatum der Datei auch in der Zieldatei setzen.
			if  ( Configuration::subset('publish')->is('set_modification_date',false ) )
				if	( ! is_null($lastChangeDate) )
					@touch( $dest,$lastChangeDate );

			Logger::debug("published: $dest");
		}

		$chmod = Configuration::subset('security')->get('chmod','');

		if	( $chmod  )
		{
			// CHMOD auf der Datei ausfuehren.
			if	( ! @chmod($dest,octdec($chmod) ) )
				throw new PublisherException('Unable to CHMOD file ' . $dest);
		}

	}



	/**
	 * Rekursives Anlagen von Verzeichnisse
	 * Nett gemacht.
	 * Quelle: http://de3.php.net/manual/de/function.mkdir.php
	 * Thx to acroyear at io dot com
	 *
	 * @param String Verzeichnis
	 * @return boolean
	 */
	private function mkdirs($path )
	{
		if	( is_dir($path) )
			return;  // Path exists

		$parentPath = dirname($path);

		$this->mkdirs($parentPath);

		//
		if	( ! @mkdir($path) )
			throw new PublisherException( 'Cannot create directory: ' . $path);

		// CHMOD auf dem Verzeichnis ausgef�hren.
		$chmod = Configuration::subset('security')->get('chmod_dir','');

		if	( $chmod  )
		{
			if	( ! @chmod($path,octdec($chmod) ) )
				throw new PublisherException('Unable to CHMOD directory ' . $path);
		}
	}






	/**
	 * Aufraeumen des Zielverzeichnisses.<br><br>
	 * Es wird der komplette Zielordner samt Unterverzeichnissen durchsucht. Jede
	 * Datei, die laenger existiert als der aktuelle Request alt ist, wird geloescht.<br>
	 * Natuerlich darf diese Funktion nur nach einem Gesamt-Veroeffentlichen ausgefuehrt werden.
	 */
	public function clean()
	{
		if	( !empty($this->localDestinationDirectory) )
			$this->cleanFolder($this->localDestinationDirectory);
	}



	/**
	 * Aufr�umen eines Verzeichnisses.<br><br>
	 * Dateien, die l�nger existieren als der aktuelle Request alt ist, werden gel�scht.<br>
	 *
	 * @param String Verzeichnis
	 */
	private function cleanFolder( $folderName )
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
					filemtime($fullpath) < Startup::getStartTime()  )
					unlink($fullpath);

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