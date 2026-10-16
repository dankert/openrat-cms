<?php

namespace cms\output;

use cms\output\APIOutput;
use util\json\JSON;
use util\YAML;

/**
 * Plain text rendering.
 */
class PlainOutput extends APIOutput
{
	/**
     * Renders the output as plain text.
     */
    protected function renderOutput(array $data ): string
	{
		//return YAML::dump($data);
		return print_r($data);
	}

	public function getContentType(): string
    {
		return 'text/plain';
	}
}
