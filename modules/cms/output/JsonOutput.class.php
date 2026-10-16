<?php

namespace cms\output;

use util\json\JSON;

/**
 * JSON Rendering.
 */
class JsonOutput extends APIOutput
{
	/**
     * Renders the output in JSON Format.
     */
    protected function renderOutput(array $data ): string
	{
		return JSON::encode($data);
	}

	public function getContentType(): string
	{
		return 'application/json';
	}
}
