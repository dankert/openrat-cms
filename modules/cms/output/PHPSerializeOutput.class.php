<?php

namespace cms\output;

use cms\output\APIOutput;
use util\json\JSON;

/**
 * JSON Rendering.
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
