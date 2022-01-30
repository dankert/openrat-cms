<?php

namespace cms\output;

use cms\output\APIOutput;
use util\json\JSON;
use util\XML;

/**
 * XML Rendering.
 */
class XmlOutput extends APIOutput
{
	/**
     * Renders the output in JSON Format.
     */
    protected function renderOutput( $data )
	{
		$xml = new XML();
		$xml->root = 'server'; // Name des XML-root-Elementes
		return $xml->encode($data);

	}

	public function getContentType()
	{
		return 'application/xml';
	}
}
