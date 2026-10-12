<?php

namespace cms\output;

use cms\output\APIOutput;
use Exception;
use language\Messages;
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
		if   ( DEVELOPMENT )
			echo "/* CSS Output\n\n".json_encode($data['output'],JSON_PRETTY_PRINT)."\n*/\n";
		echo $this->renderCSSToString($data['output']);
	}


	/**
	 * @param $text string Error Message
	 * @param $cause Exception
	 */
	protected function setError($text, $cause)
	{
		echo '/* CSS Output error: '.$cause->getMessage().' */';
	}

	private function renderCSSToString($output,$i=0)
	{
		$iChar = DEVELOPMENT?' ':'';
		$out   = '';
		$pad = str_repeat($iChar,$i*2);
		foreach ($output as $key=>$value) {
			if   ( is_string($value) || is_numeric($value) )
				$out .= $pad.$key.':'.$iChar.$value.';'.(DEVELOPMENT?"\n":'');
			elseif (is_array($value))
				$out .= $pad.$key.$iChar.'{'.(DEVELOPMENT?"\n":'').$this->renderCSSToString($value,$i+1).$pad.'}'.(DEVELOPMENT?"\n":'');
			else
				throw new \LogicException("CSS value is of invalid type: ".gettype($value));
		}
		return $out;
	}
}
