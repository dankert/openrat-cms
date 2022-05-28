<?php

namespace dsl\ast;

use dsl\DslRuntimeException;

class DslCreation implements DslStatement
{
	private $name;
	private $value;

	public function __construct( $name, $parameters )
	{
		$this->name = $name;
		$this->value = new DslExpression( $parameters );
	}

	public function execute( & $context ) {
		if   ( array_key_exists( $this->name, $context ) )
			throw new DslRuntimeException('variable '.$this->name.' is already initialised');

		$context[ $this->name ] = $this->value->execute( $context );
	}

	public function parse($tokens)
	{
	}
}