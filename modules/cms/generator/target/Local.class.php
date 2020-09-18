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
class Local extends  Target
{
	/**
	 * @var string
	 */
	private $localDestinationDirectory;

	public static function acceptsSchemes() {
		return ['file',''];
	}


	/**
	 * @param $url Url
	 */
	public function open()
	{
		$confPublish = config('publish');

		$targetDir = rtrim( $this->url->path,'/' );

		if	( FileUtils::isAbsolutePath($targetDir) && $confPublish['filesystem']['per_project'] )
		{
			$this->localDestinationDirectory = FileUtils::toAbsolutePath([$targetDir]); // Projekteinstellung verwenden.
		}
		else
		{
			// Konfiguriertes Verzeichnis verwenden.
			$this->localDestinationDirectory = FileUtils::toAbsolutePath([$confPublish['filesystem']['directory'],$targetDir]);
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
	 */
	public function put($source, $dest, $lastChangeDate)
	{
		global $conf;

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
			if  ( $conf['publish']['set_modification_date'] )
				if	( ! is_null($lastChangeDate) )
					@touch( $dest,$lastChangeDate );

			Logger::debug("published: $dest");
		}

		if	(!empty($conf['security']['chmod']))
		{
			// CHMOD auf der Datei ausfuehren.
			if	( ! @chmod($dest,octdec($conf['security']['chmod'])) )
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
		global $conf;

		if	( is_dir($path) )
			return;  // Path exists

		$parentPath = dirname($path);

		$this->mkdirs($parentPath);

		//
		if	( ! @mkdir($path) )
			throw new PublisherException( 'Cannot create directory: ' . $path);

		// CHMOD auf dem Verzeichnis ausgef�hren.
		if	(!empty($conf['security']['chmod_dir']))
		{
			if	( ! @chmod($path,octdec($conf['security']['chmod_dir'])) )
				throw new PublisherException('Unable to CHMOD directory: ' . $path);
		}
	}

}