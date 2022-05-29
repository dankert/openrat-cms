<?php

namespace dsl\ast;

define('LEFT', 0);
define('RIGHT', 1);

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

	/**
	 * @param DslToken[] $tokens
	 * @throws DslParserException
	 */
	public function parse($tokens)
	{
		//echo "<h5>Expression:</h5><pre>"; var_export( $tokens ); echo "</pre>";
		if   ( ! $tokens ) {
			$this->value = new DslNull();
			return;
		}

		$this->parseExpression( $tokens );
		// Groups
	}


	/**
	 * Parsing an expression using the shunting yard algorithm.
	 *
	 *  Precedences see https://developer.mozilla.org/de/docs/Web/JavaScript/Reference/Operators/Operator_Precedence#assoziativit%C3%A4t
	 * @param DslToken[] $tokens
	 * @throws DslParserException
	 */
	private function parseExpression( $tokens )
	{
		$precedence = [
			','  =>  2,
			'='  =>  3,
			'+=' =>  3,
			'-=' =>  3,
			'||' =>  5,
			'&&' =>  6,
			'==' => 10,
			'!=' => 10,
			'<'  => 11,
			'<=' => 11,
			'>'  => 11,
			'>=' => 11,
			'+'  => 13,
			'-'  => 13,
			'/'  => 14,
			'*'  => 14,
			'%'  => 14,
			'**' => 15,
			'!'  => 16,
			'$'  => 19, // function call, provided by the lexer
			'.'  => 19,
		];

		$assoc = [
			','   => LEFT,
			'='   => RIGHT,
			'-='  => RIGHT,
			'+='  => RIGHT,
			'||'  => LEFT,
			'&&'  => LEFT,
			'=='  => LEFT,
			'!='  => LEFT,
			'<'   => LEFT,
			'<='  => LEFT,
			'> '  => LEFT,
			'>='  => LEFT,
			'+'   => LEFT,
			'-'   => LEFT,
			'/'   => LEFT,
			'*'   => LEFT,
			'%'   => LEFT,
			'^'   => RIGHT,
			'!'   => RIGHT,
			'**'  => RIGHT,
			'.'   => RIGHT,
			'$'   => LEFT,
		];


		// for the purpose of comparing only; it's forced to top priority explicitly
		$precedence['('] = 0;
		$precedence[')'] = 0;

		$output_queue   = array();
		$operator_stack = array();

		if   ( $tokens instanceof DslStatement ) {

			$this->value = $tokens;
			return;
		}

		if   ( $tokens instanceof DslToken )
			$tokens = [$tokens];

		if   ( ! is_array($tokens)) echo "tokens ist kein array, aber ".get_class($tokens);

		// while there are tokens to be read:
		while ($tokens) {
			// read a token.
			$token = array_shift($tokens);

			if ($token->type == DslToken::T_OPERATOR) {

				// while there is an operator at the top of the operator stack with
				// greater than or equal to precedence:
				while ($operator_stack &&
					$precedence[end($operator_stack)->value] >= $precedence[$token->value] + $assoc[$token->value]) {
					// pop operators from the operator stack, onto the output queue.

					$left  = array_pop( $output_queue );
					$right = array_pop( $output_queue );
					$output_queue[] = $this->createNode( array_pop($operator_stack),$left,$right );
				}
				// push the read operator onto the operator stack.
				$operator_stack[] = $token;

				// if the token is a left bracket (i.e. "("), then:
			} elseif ($token->value === '(') {
				// push it onto the operator stack.
				$operator_stack[] = $token;

				// if the token is a right bracket (i.e. ")"), then:
			} elseif ($token->value === ')') {
				// while the operator at the top of the operator stack is not a left bracket:
				while (end($operator_stack)->value !== '(') {
					// pop operators from the operator stack onto the output queue.
					$left  = array_pop( $output_queue );
					$right = array_pop( $output_queue );
					$output_queue[] = $this->createNode( array_pop($operator_stack),$left,$right );

					// /* if the stack runs out without finding a left bracket, then there are
					// mismatched parentheses. */
					if (!$operator_stack) {
						throw new DslParserException("Mismatched parentheses!");
					}
				}

				// pop the left bracket from the stack.
				array_pop($operator_stack);

			}
			elseif		// if the token is a number, then push it to the output queue.
				    (true) {
					$output_queue[] = $this->tokenToStatement( $token );

					// if the token is an operator, then:
			} else {
				throw new DslParserException( 'Unexpected token '.$token->value, $token->lineNumber);
			}
		} // if there are no more tokens to read:

		// while there are still operator tokens on the stack:
		while ($operator_stack) {
			$token = array_pop($operator_stack);

			// if the operator token on the top of the stack is a bracket, then
			// there are mismatched parentheses.
			if ($token->type == DslToken::T_OPERATOR && $token->value == '(') {
				throw new DslParserException( "Mismatched parentheses");
			}
			// pop the operator onto the output queue.
			$left  = array_pop( $output_queue );
			$right = array_pop( $output_queue );
			$output_queue[] = $this->createNode( $token,$left,$right );
		}


		//echo "<h5>Output queue:</h5><pre>"; var_export( $output_queue ); echo "</pre>";
		$this->value = $output_queue[0];
	}

	/**
	 * @param $op DslToken
	 * @param $left
	 * @param $right
	 * @throws DslParserException
	 */
	private function createNode($op, $left, $right)
	{
		if   ( $op->value == '=' )
			return new DslAssignment( $right,$left );
		if   ( $op->value == ',' )
			return new DslSequence( $right,$left );
		if   ( $op->value == '.' )
			return new DslProperty( $right, $left );
		if   ( $op->value == '$' )
			return new DslFunctionCall( $right, $left );
		else
			return new DslOperation( $op->value,$right,$left );
	}

	/**
	 * @param $token DslToken
	 */
	private function tokenToStatement($token)
	{
		switch( $token->type ) {
			case DslToken::T_NUMBER:
				return new DslInteger( $token->value );
			case DslToken::T_TEXT:
				return new DslString( $token->value );
			case DslToken::T_STRING:
				return new DslVariable( $token->value );
			case DslToken::T_DOT:
				return new DslProperty( $token->value );
			default:
				throw new DslParserException('Unknown token '.$token->value,$token->lineNumber);
		}
	}
}