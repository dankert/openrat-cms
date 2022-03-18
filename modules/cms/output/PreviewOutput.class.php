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
     * Renders the output directly from the action output.
     */
    protected function renderOutput( $data )
	{
		// HTTP Spec:
		// "Applications SHOULD use this field to indicate the transfer-length of the
		//  message-body, unless this is prohibited by the rules in section 4.4."
		//
		// And the overhead of 'Transfer-Encoding: chunked' is eliminated...
		header('Content-Length: ' . strlen($data['output']['value']));

		return $data['output']['value'];
	}

	public function getContentType()
	{
		return null; // 'null' because the actions are setting their Content-Type.
	}
}
