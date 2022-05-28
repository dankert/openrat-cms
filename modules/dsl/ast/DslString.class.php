<?php

namespace dsl\ast;

class DslString implements DslStatement
{
	private $string;

	/**
	 * DslString constructor.
	 * @param $string
	 */
	public function __construct($string)
	{
		$this->string = $string;
	}


	public function execute( & $context ) {

		return $this->string;
	}

	public function parse($tokens)
	{
	}
}