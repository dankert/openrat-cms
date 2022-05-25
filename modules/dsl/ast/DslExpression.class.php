<?php

namespace dsl\ast;

use dsl\DslToken;

class DslExpression implements DslStatement
{
	private $value  = [];

	public function execute( $context ) {

		//echo "ausführen expression: "; var_dump($this->value);
		foreach( $this->value as $v)
			$v->execute( $context );
	}

	public function parse($tokens)
	{
		$depth = 0;

		//echo "<h2>Expression</h2><pre>"; var_dump( $tokens ); echo "</pre>";
		while( true ) {

			$token = array_pop( $tokens );

			if   ( $token == null ) {
				break;
			}

			if ( $token->type == DslToken::T_STRING )
			{
				$nextToken = array_pop( $tokens );
				if ( $nextToken->type == DslToken::T_BRACKET_OPEN )
				{
					$nextToken = array_pop( $tokens );
					if ( $nextToken->type == DslToken::T_TEXT ) {

						$functionCall = new DslFunctionCall();
						$functionCall->name = $token->value;
						$functionCall->parse( $nextToken );
						$this->value[] = $functionCall;
					}
				}
			}
		}
	}
}