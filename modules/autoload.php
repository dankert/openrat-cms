<?php
// Enable class autoloading for all classes in all modules

spl_autoload_register(

	/**
	 * Loads classes from modules.
	 *
	 * The PHP default loader is unusable, because it will always use lowercase file names.
	 *
	 * @param $className Class name
	 * @return void
	 */
	function ($className) {

		$c = __DIR__.DIRECTORY_SEPARATOR.str_replace( "\\", DIRECTORY_SEPARATOR, $className).'.class.php';

		if   ( is_file($c) )
			require($c);
	}
);