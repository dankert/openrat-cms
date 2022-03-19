<?php

namespace cms\output;

use cms\output\APIOutput;
use util\json\JSON;
use util\YAML;

/**
 * Preview rendering.
 */
class PreviewOutput extends UIOutput
{
	protected function outputData($request, $data)
	{
		// HTTP Spec:
		// "Applications SHOULD use this field to indicate the transfer-length of the
		//  message-body, unless this is prohibited by the rules in section 4.4."
		//
		// And the overhead of 'Transfer-Encoding: chunked' is eliminated...
		header('Content-Length: ' . strlen($data['output']['value']));

		echo $data['output']['value'];
	}

	public function getContentType()
	{
		return null; // the content type is set by the action itself.
	}
}
