<?php

namespace cms\action;

use cms\base\Configuration;
use cms\model\Permission;
use cms\model\Folder;

/**
 * Action-Klasse zum Bearbeiten eines Ordners.
 *
 * @author Jan Dankert
 */

class FolderAction extends ObjectAction
{
    /**
     * @var Folder
     */
	protected $folder;

    public function __construct()
	{
        parent::__construct();
    }


    public function init()
    {
		$folder = new Folder( $this->request->getId() );
		$folder->load();

		$this->lastModified( $folder->lastchangeDate);

		$this->setBaseObject($folder);
	}


	protected function setBaseObject($folder ) {

		$this->folder = $folder;

		parent::setBaseObject( $folder );
	}





	/**
	 * Ermittelt die maximale Gr��e einer hochzuladenden Datei.<br>
	 * Der Wert wird aus der PHP- und OpenRat-Konfiguration ermittelt.<br>
	 *
	 * @return Integer maximale Dateigroesse in Bytes
	 */
	protected function maxFileSize()
	{
		// When querying memory size values:
		// Many ini memory size values, such as upload_max_filesize,
		// are stored in the php.ini file in shorthand notation.
		// ini_get() will return the exact string stored in the php.ini file
		// and NOT its integer equivalent.

		$_10GB = 10 * 1024 * 1024 * 1024; // 10GB
		$sizes = [];

		foreach( ['upload_max_filesize','post_max_size','memory_limit'] as $setting )
		{
			$memLimit = $this->stringToBytes(ini_get($setting));

			if	($memLimit )
				$sizes[] = $memLimit;
		}

		$confMaxSize = Configuration::subset(['content','file'])->get('max_file_size',$_10GB) * 1024;

		if	( $confMaxSize )
			$sizes[] = $confMaxSize;

		return min($sizes); // Using the minimum of all sizes.
	}

	/**
	 * Umwandlung von abgek�rzten Bytewerten ("Shorthand Notation") wie
	 * "4M" oder "500K" in eine ganzzahlige Byteanzahl.<br>
	 * <br>
	 * Quelle: http://de.php.net/manual/de/function.ini-get.php
	 *
	 * @param String Abgek�rzter Bytewert
	 * @return Integer Byteanzahl
	 */
	protected function stringToBytes($val)
	{
		$val  = trim($val);
		$last = strtolower($val[strlen($val)-1]);
		$val  = intval($val);
		// Achtung: Der Trick ist das "Fallthrough", kein "break" vorhanden!
		switch($last)
		{
			case 'g':
				$val *= 1024;
			case 'm':
				$val *= 1024;
			case 'k':
				$val *= 1024;
		}

     	return intval($val);
	}


	/**
	 * Is it allowed to add a new object?
	 * @return bool
	 */
	protected function hasPermissionToAddAnyObject() {

		return
			$this->folder->hasRight( Permission::ACL_CREATE_FILE   ) ||
			$this->folder->hasRight( Permission::ACL_CREATE_FOLDER ) ||
			$this->folder->hasRight( Permission::ACL_CREATE_LINK   ) ||
			$this->folder->hasRight( Permission::ACL_CREATE_PAGE   );
	}
}