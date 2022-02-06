<?php

namespace cms\output;

use cms\output\APIOutput;
use util\json\JSON;
use util\YAML;

/**
 * CSS rendering.
 */
class CssOutput extends APIOutput
{
	/**
     * Renders the output as CSS.
     */
    protected function renderOutput( $data )
	{
		return implode('',$data['output']);
	}

	public function getContentType()
	{
		return 'text/css';
	}
}
