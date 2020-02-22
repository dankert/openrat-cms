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

namespace util;
use InvalidArgumentException;
use Request;

/**
 * Methoden fuer den Upload einer Datei
 *
 * @author $Author$
 * @version $Revision$
 * @package openrat.services
 */
class Upload
{
	public $filename;
	public $extension;
	public $value;
	public $size;
	public $mimeType;

	public $parameterName;

	public static $DEFAULT_PARAM_NAME = 'file';


	/**
	 * Bearbeitet den Upload einer Datei.<br>
	 *
	 * @return Upload
	 */
	function __construct($name = 'file') // Konstruktor
	{
		$this->parameterName = $name;
	}

	/**
	 * Provision of an uploaded file.
	 */
	public function processUpload()
	{
		$name = $this->parameterName;

		if (!$this->isAvailable())
			throw new InvalidArgumentException('No file received under the key "' . $name . '"');

		$uFile = $_FILES[$name];

		if (!isset($uFile['tmp_name']))
			throw new InvalidArgumentException('No temporary filename found for uploaded file key "' . $name . '"');

		if (!is_file($uFile['tmp_name']))
			throw new InvalidArgumentException('Not a file: ' . $uFile['tmp_name']);

		switch ($uFile['error']) {
			case UPLOAD_ERR_OK:
				break;

			case UPLOAD_ERR_INI_SIZE:
				throw new InvalidArgumentException('Uploaded file is bigger than allowed in server configuration');

			case UPLOAD_ERR_FORM_SIZE:
				throw new InvalidArgumentException('Uploaded file is bigger than allowed in form');

			default:
				throw new InvalidArgumentException('Error code while uploading file: ' . $uFile['error']);
		}

		$this->mimeType = $uFile['type'];

		$this->size = filesize($uFile['tmp_name']);

		$fh = fopen($uFile['tmp_name'], 'r');

		$this->value = fread($fh, $this->size);
		fclose($fh);

		$this->filename = $uFile['name'];
		$this->extension = '';

		$p = strrpos($this->filename, '.'); // Letzten Punkt suchen

		if ($p !== false) // Wennn letzten Punkt gefunden, dann dort aufteilen
		{
			$this->extension = substr($this->filename, $p + 1);
			$this->filename = substr($this->filename, 0, $p);
		}
	}

	/**
	 * Is this upload available?
	 * @param $name Request variable name
	 * @return bool <code>true</code> if upload is available
	 */
	public function isAvailable()
	{
		$name = $this->parameterName;

		return isset($_FILES[$name]) && is_array($_FILES[$name]);
	}
}

?>