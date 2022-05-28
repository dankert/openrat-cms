<?php

namespace dsl\ast;

use dsl\DslParserException;
use dsl\DslToken;

class DslExpression extends DslElement implements DslStatement
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


		// Split the expression on operators
		foreach ( array_reverse(['*','/','-','+','!','||','&&','>','>=','<=','<']) as $tokenValue ) {
			list( $left,$right ) = $this->splitTokenOnOperator( $tokens, $tokenValue );
			if   ( sizeof($right ) > 0 ) {
				$this->value = new DslOperation( $tokenValue,$left,$right );
				return;
			}
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
					array_unshift( $tokens,$nextToken );

					$parameterGroup = $this->getGroup( $tokens );
					$splittedParameters = $this->splitByComma( $parameterGroup );

					$this->value = new DslFunctionCall( $token->value,$splittedParameters  );
					return;
				}
			}
		}
		$this->value = new DslNull();
	}


	private function splitTokenOnOperator( $tokens, $operatorValue ) {
		// Split the expression on operators
		$leftToken  = [];

		while( true ) {
			$token = array_shift($tokens);
			if   ( $token == null )
				return [ $leftToken,[] ];
			if   ( $token->type == DslToken::T_OPERATOR && $token->value == $operatorValue )
				return [ $leftToken,$tokens ];
			$leftToken[] = $token;
		}
	}
}