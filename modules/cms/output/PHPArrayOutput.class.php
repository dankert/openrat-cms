<?php

namespace cms\output;

use cms\output\APIOutput;
use util\json\JSON;

/**
 * Rendering as PHP array.
 */
class PHPArrayOutput extends APIOutput
{
	/**
     * Renders the output in JSON Format.
     */
    protected function renderOutput( $data )
	{
		header('Content-Type: application/json; charset=UTF-8');
		return JSON::encode($data);
	}

	public function getContentType()
	{
		return 'application/php-array';
	}
}
