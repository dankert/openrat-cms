<?php

namespace dsl\ast;

class DslReturn implements DslStatement
{
	private $value;

	public function __construct( $expressionTokens )
	{
		$this->value = new DslExpression( $expressionTokens );
	}

	public function execute( & $context ) {

		return $this->value->execute( $context );
	}

	public function parse($tokens)
	{
	}
}