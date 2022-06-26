<?php

namespace dsl\ast;

use dsl\DslParserException;
use dsl\DslRuntimeException;
use dsl\DslToken;

class DslFunction extends DslElement implements DslStatement
{
	/**
	 * @var String[]
	 */
	public $parameters;

	/**
	 * @var DslStatementList
	 */
	public $body;

	/**
	 * creates the function.
	 *
	 * @param array $context
	 * @return mixed|void
	 * @throws DslRuntimeException
	 */
	public function execute( & $context ) {

		$clonedContext = $context;
		return $this->body->execute( $context );
	}

	/**
	 * DslFunction constructor.
	 *
	 * @param $functionParameter DslToken[]
	 * @param $functionBody DslStatement
	 * @throws DslParserException
	 */
	public function __construct( $functionParameter, $functionBody )
	{
		$this->parameters = [];
		foreach( $this->splitByComma( $functionParameter ) as $parameter ) {
			if   ( sizeof($parameter) != 1 )
				throw new DslParserException('function parameter must be a single name');
			$nameToken = $parameter[0];
			if   ( $nameToken->type == DslToken::T_NONE ) // no parameter
				continue;
			if   ( $nameToken->type != DslToken::T_STRING )
				throw new DslParserException('function parameter must be a name');

			$this->parameters[] = $nameToken->value;
		}

		$this->body = new DslStatementList( $functionBody );
	}

	public function parse($tokens)
	{
	}

}