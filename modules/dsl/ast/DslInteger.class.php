<?php

namespace dsl\ast;

class DslInteger implements DslStatement
{
	private $number;

	/**
	 * DslInteger constructor.
	 * @param $number
	 */
	public function __construct($number)
	{
		$this->number = $number;
	}


	public function execute( & $context ) {

		return intval($this->number);
	}

	public function parse($tokens)
	{
		$firstToken = $tokens[0];
		$this->number = intval( $firstToken->value );
	}
}