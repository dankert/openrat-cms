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
    protected function renderOutput(array $data ): string
	{
		return var_export($data, true);
	}

	public function getContentType(): string
    {
		return 'application/php-array';
	}
}
