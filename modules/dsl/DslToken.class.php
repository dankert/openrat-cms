<?php
namespace dsl;

class DslToken
{


	const T_NONE   = 0;
	const T_STRING = 1;
	const T_BRACKET_OPEN = 3;
	const T_BRACKET_CLOSE = 4;
	const T_BLOCK_BEGIN = 5;
	const T_BLOCK_END = 6;
	const T_TEXT = 7;
	const T_NUMBER = 8;
	const T_OPERATOR = 9;
	const T_FUNCTION = 10;
	const T_FOR = 11;
	const T_IF = 12;
	const T_ELSE = 13;
	const T_LET = 14;
	const T_RETURN = 15;
	const T_DOT = 16;
	const T_STATEMENT_END = 17;
	const T_NEGATION = 18;
	const T_COMMA = 19;
	const T_NEW = 20;
	const T_THROW = 21;

	public $lineNumber;
	public $type;
	public $value;

	/**
	 * DslToken constructor.
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

	public function __toString()
	{
		return '#'.$this->lineNumber.':'.$this->type.':"'.$this->value.'"';
	}


	/**
	 * @return bool
	 */
	public function isOperator( $value = null ) {
		if   ( ! $value )
			return $this->type == self::T_OPERATOR;

		return $this->type == self::T_OPERATOR && $this->value == $value;
	}
}