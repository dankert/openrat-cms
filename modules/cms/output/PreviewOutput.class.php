<?php

namespace cms\output;

use cms\output\APIOutput;
use util\json\JSON;
use util\YAML;

/**
 * Preview rendering.
 */
class PreviewOutput extends APIOutput
{
	/**
     * Renders the output directy from the action output.
     */
    protected function renderOutput( $data )
	{
		return $data['output']['value'];
	}

	public function getContentType()
	{
		return 'text/css';
	}
}
