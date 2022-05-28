<?php

namespace dsl\ast;

use dsl\DslParserException;
use dsl\DslToken;

class DslExpression implements DslStatement
{
	private $value;

	public function __construct( $valueTokens )
	{
		$this->parse( $valueTokens );
	}

	public function execute( & $context ) {

		if   ( is_array( $this->value ) )
			foreach( $this->value as $v)
				$v->execute( $context );
		else
			return $this->value->execute( $context );
	}

	public function parse($tokens)
	{
		echo "<h5>Expression:</h5><pre>"; var_export( $tokens ); echo "</pre>";
		if   ( ! $tokens ) {
			$this->value = new DslNull();
			return;
		}

		if   ( sizeof($tokens) == 1) {
			$token = $tokens[0];
			switch( $token->type ) {
				case DslToken::T_TEXT:
					$this->value = new DslString( $token->value );
					break;
				case DslToken::T_STRING:
					$this->value = new DslVariable( $token->value );
					break;
				case DslToken::T_NUMBER:
					$this->value = new DslInteger( $token->value );
					break;
				default:
					throw new DslParserException('unknown token '.$token->type.' in expression',$token->lineNumber);
			}
			return;
		}

		$depth = 0;

		while( true ) {

			$token = array_shift( $tokens );

			if   ( $token == null ) {
				break;
			}

			if ( $token->type == DslToken::T_STRING )
			{
				$nextToken = array_shift( $tokens );
				if ( $nextToken &&  $nextToken->type == DslToken::T_BRACKET_OPEN )
				{
					$nextToken = array_shift( $tokens );
					if ( $nextToken && ( $nextToken->type == DslToken::T_TEXT  || $nextToken->type == DslToken::T_STRING || $nextToken->type == DslToken::T_NUMBER ) ) {

						echo "found function";
						$this->value = new DslFunctionCall( $token->value, [$nextToken] );
						return;
					}
				}
			}
		}
		$this->value = new DslNull();
	}
}