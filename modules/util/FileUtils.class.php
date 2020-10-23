<?php

namespace util;
use cms\base\Configuration;
use Pfad;
use RuntimeException;

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
		if (substr($pfad, -1, 1) == '/')
			return $pfad;
		else
			return $pfad . '/';
	}


	/**
	 * Liefert einen Verzeichnisnamen fuer temporaere Dateien.
	 */
	public static function createTempFile()
	{
		$tmpdir  = Configuration::subset('cache')->get('tmp_dir','');
		$tmpfile = @tempnam($tmpdir, 'openrat_tmp');

		// 2. Versuch: Temp-Dir aus "upload_tmp_dir".
		if ($tmpfile === FALSE) {
			$tmpdir = ini_get('upload_tmp_dir');
			$tmpfile = @tempnam($tmpdir, 'openrat_tmp');
		} elseif ($tmpfile === FALSE) {
			$tmpfile = @tempnam('', 'openrat_tmp');
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

		return FileUtils::slashify($tmpdir);
	}


	/**
	 * @param array $attr
	 * @return string
	 * @deprecated use \Cache
	 */
	public static function getTempFileName($attr = array())
	{
		$filename = FileUtils::getTempDir() . '/openrat';
		foreach ($attr as $a => $w)
			$filename .= '_' . $a . $w;

		$filename .= '.tmp';
		return $filename;
	}


	/**
	 * Gets all files from a directory.
	 *
	 * @param $dir string directory to read
	 * @param null $extension only files with this extension (default: all files)
	 * @return array List of all files in this directory
	 */
	public static function readDir($dir,$extension=null)
	{
		$dir = FileUtils::slashify($dir);
		$dateien = array();

		if (!is_dir($dir)) {
			throw new RuntimeException('not a directory: ' . $dir);
		}

		if ($dh = opendir($dir)) {
			while (($verzEintrag = readdir($dh)) !== false) {
				if (substr($verzEintrag, 0, 1) != '.') {
					if   ( !$extension || substr($verzEintrag,(strlen($extension)+1)*-1) == '.'.$extension ) {
						$dateien[] = $verzEintrag;
					}
				}
			}
			closedir($dh);

			return $dateien;
		} else {
			throw new RuntimeException('unable to open directory: ' . $dir);
		}

	}


	public static function isAbsolutePath($path)
	{
		return @$path[0] == '/';
	}


	public static function toAbsolutePath($pathElements)
	{
		$pathElements = array_map(function ($path) {
			return trim($path, '/');
		}, $pathElements);
		return array_reduce($pathElements, function ($path, $item) {
			return $path . ($item ? '/' . $item : '');
		}, '');
	}


	public static function toRelativePath($pathElements)
	{
		return '.' . self::toAbsolutePath($pathElements);
	}
}
