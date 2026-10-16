<?php

namespace cms\output;

use cms\output\APIOutput;
use util\json\JSON;
use util\YAML;

/**
 * YAML Rendering.
 */
class YamlOutput extends APIOutput
{
	/**
     * Renders the output in YAML Format.
     */
    protected function renderOutput(array $data ): string
	{
		return YAML::dump($data);
	}

	public function getContentType(): string
    {
		return 'application/yaml';
	}
}
