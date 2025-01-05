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
     * Renders the output as machine-readable PHP array format.
     */
    protected function renderOutput( $data )
	{
		return var_export($data, true);
	}

	public function getContentType()
	{
		return 'application/php-array';
	}
}
