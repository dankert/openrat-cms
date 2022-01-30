<?php

namespace cms\output;

use cms\output\APIOutput;
use util\json\JSON;

/**
 * JSON Rendering.
 */
class JsonOutput extends APIOutput
{
	/**
     * Renders the output in JSON Format.
     */
    protected function renderOutput( $data )
	{
		return JSON::encode($data);
	}

	public function getContentType()
	{
		return 'application/json';
	}
}
