<?php

namespace dsl\ast;

use dsl\DslRuntimeException;

class DslThrow implements DslStatement
{
	private $value;

	public function __construct( $expressionTokens )
	{
		$this->value = new DslExpression( $expressionTokens );
	}

    /**
     * @throws DslRuntimeException
     */
    public function execute(& $context ) {

	    $value = $this->value->execute( $context );
	    throw new DslRuntimeException( $value );
	}

	public function parse($tokens)
	{
	}
}