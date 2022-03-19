<?php

namespace cms\output;

use cms\output\APIOutput;
use Exception;
use util\json\JSON;
use util\YAML;

/**
 * CSS rendering.
 */
class CssOutput extends BaseOutput
{
	public function getContentType()
	{
		return 'text/css';
	}

	protected function outputData($request, $data)
	{
		echo implode('',$data['output'] );
	}


	/**
	 * @param $text string Error Message
	 * @param $cause Exception
	 */
	protected function setError($text, $cause)
	{
		echo "/* CSS Output error */";
		echo "/* ".$cause->getMessage()." */";
	}
}
