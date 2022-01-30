<?php

namespace cms\output;

use cms\output\APIOutput;
use util\json\JSON;

/**
 * Renders as a internal serialized PHP array.
 * A PHP powered client may simply unserialize it.
 */
class PHPSerializeOutput extends APIOutput
{
	/**
     * Renders the output in JSON Format.
     */
    protected function renderOutput( $data )
	{
		header('Content-Type: application/json; charset=UTF-8');
		return serialize($data);
	}

	public function getContentType()
	{
		return 'application/php-serialized';
	}
}
