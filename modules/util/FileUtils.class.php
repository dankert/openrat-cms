<?php

namespace util;
use cms\base\Configuration;
use LogicException;
use Pfad;
use RuntimeException;

/**
 * Werkzeugklasse f�r Datei-Operationen.
 *
 */
class FileUtils
{
	/**
	 * Adds a trailing slash ('/') if not existing.
	 *
	 * @param String $pfad path
	 * @return string path with trailing slash.
	 */
	public static function slashify($pfad)
	{
		if (substr($pfad, -1, 1) == '/')
			return $pfad;
		else
			return $pfad . '/';
	}


	/**
	 * Gets a directory for temporary files.
	 */
	public static function getTempDir()
	{
		$cacheConfig = Configuration::subset('cache');

		$tmpdirs = [
			$cacheConfig->get('tmp_dir',''), // temporary cache dir from configuration
			sys_get_temp_dir(),
			// do not try /var/cache here as it is mostly not writable
			'/var/tmp', // FHS, survives restarts
			'/tmp',     // FHS
			null
		];

		foreach( $tmpdirs as $tmpdir ) {
			if   ( $tmpdir && @is_dir($tmpdir) && is_writable($tmpdir) )
				break;
		}

		if   ( ! $tmpdir )
			throw new LogicException('Could not find a directory for temporary files. Hint: You may config this with cache/tmp_dir');

		$tmpdir = FileUtils::slashify($tmpdir).$cacheConfig->get('name','openrat-cache');
		$tmpdir = FileUtils::slashify($tmpdir);

		if   ( ! is_dir($tmpdir ) ) {
			mkdir( $tmpdir );

			file_put_contents($tmpdir.'CACHEDIR.TAG', <<<CACHETAG
Signature: 8a477f597d28d172789f06886806bc55
# This file is a cache directory tag created by OpenRat CMS.
# For information about cache directory tags, see:
#	http://www.brynosaurus.com/cachedir/
CACHETAG
			);

		}

		return $tmpdir;
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

			// Sorting the files, because the order should be identically on all platforms.
			sort($dateien );

			return $dateien;
		} else {
			throw new RuntimeException('unable to open directory: ' . $dir);
		}

	}


	/**
	 * Is the given path an absolute path?
	 *
	 * @param $path
	 * @return bool
	 */
	public static function isAbsolutePath($path)
	{
		return $path &&
			@$path[0] == '/'                        || // beginning with '/' (absolute file path)
			substr($path,0,4)=='php:' || // beginning with 'php:' (PHP-Streams)
			strpos($path,'://') !== FALSE;     // containing '://' (URLs)
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


	/**
	 * @param $path
	 * @return bool
	 */
	public static function isRelativePath($path ) {
		return ! self::isAbsolutePath($path);
	}
}
