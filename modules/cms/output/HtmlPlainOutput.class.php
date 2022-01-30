<?php

namespace cms\output;

use cms\output\APIOutput;
use util\json\JSON;

/**
 * JSON Rendering.
 */
class HtmlPlainOutput extends APIOutput
{
	/**
     * Renders the output in JSON Format.
     */
    protected function renderOutput( $data )
	{
		$output  = '<html><body><h1>API response:</h1><hr /><pre>';
		$output .= print_r($data,true);
		$output .= '</pre></body></html>';

		return $output;
	}

	public function getContentType()
	{
		return 'text/html';
	}
}
