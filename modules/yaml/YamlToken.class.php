<?php
namespace yaml;

class YamlToken
{
	const T_NULL     = 0;
	const T_KEY      = 1;
	const T_COLON    = 3;
	const T_TEXT     = 4;
	const T_ENTRY    = 5;
	const T_NUMBER   = 6;
	const T_OPERATOR = 7;

	public $lineNumber;
	public $type;
	public $value;

	/**
	 * @param $lineNumber
	 * @param $type
	 * @param $value
	 */
	public function __construct($lineNumber, $type, $value)
	{
		$this->lineNumber = $lineNumber;
		$this->type = $type;
		$this->value = $value;
	}

}