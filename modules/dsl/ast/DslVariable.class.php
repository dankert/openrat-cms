<?php

namespace dsl\ast;

use dsl\DslRuntimeException;

class DslVariable implements DslStatement
{
	public $name;

	/**
	 * @param $name
	 */
	public function __construct($name)
	{
		$this->name = $name;
	}


	public function execute( & $context ) {

		if   ( ! array_key_exists( $this->name, $context ) )
			throw new DslRuntimeException('\''.$this->name.'\' does not exist');

		return $context[ $this->name ];
	}

	public function parse($tokens)
	{
	}
}