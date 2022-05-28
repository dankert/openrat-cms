<?php

namespace dsl\ast;

use dsl\DslParserException;
use dsl\DslToken;

class DslFunction implements DslStatement
{
	private $name;

	/**
	 * @var String[]
	 */
	private $parameters;

	/**
	 * @var DslStatementList
	 */
	private $body;

	public function execute( & $context ) {

	}

	/**
	 * DslFunction constructor.
	 *
	 * @param $functionParameter DslToken[]
	 * @param $functionBody DslToken[]
	 * @throws DslParserException
	 */
	public function __construct( $name,$functionParameter, $functionBody )
	{
		$this->name = $name;
		
		foreach ( $functionParameter as $token ) {

			if   ( $token->type == DslToken::T_COMMA )
				continue;

			if   ( $token->type == DslToken::T_STRING )
				$this->parameters[] = $token->value;
			else
				throw new DslParserException("Unknown token in function parameter",$token->lineNumber );

		}

		$this->body = new DslStatementList( $functionBody );
	}

	public function parse($tokens)
	{
	}
}