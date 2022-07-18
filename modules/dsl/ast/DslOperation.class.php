<?php

namespace dsl\ast;

use dsl\DslParserException;
use dsl\DslRuntimeException;
use dsl\DslToken;
use dsl\standard\NumberInstance;
use dsl\standard\ArrayInstance;
use dsl\standard\StringInstance;

class DslOperation implements DslStatement
{
	private $operator;
	private $left;
	private $right;

	/**
	 * DslOperation constructor.
	 * @param $operator
	 * @param $left
	 * @param $right
	 */
	public function __construct($operator, $left, $right)
	{
		$this->operator = $operator;
		$this->left  = new DslExpression(  $left );
		$this->right = new DslExpression( $right );
	}


	/**
	 * @throws DslRuntimeException
	 */
	public function execute(& $context ) {

		$left  = $this->left->execute( $context );
		$right = $this->right->execute( $context );

		switch( $this->operator ) {
			case '+':
				if   ( is_string($left)  )
					return $left . (string)$right;
				if   ($left instanceof ArrayInstance)
					return $left->concat( $right );
				if   ($left instanceof StringInstance)
					return $left->__toString() . (string)$right;
				if   ($left instanceof NumberInstance)
					return $left->toNumber() + intval($right);
				else
					return intval($left) + intval($right);

			case '-':
				return intval($left) - intval($right);

			case '*':
				return $left * $right;

			case '/':
				return $left / $right;

			case '==':
				return $left == $right;
			case '!=':
				return $left != $right;
			case '<':
				return $left < $right;
			case '<=':
				return $left <= $right;
			case '>':
				return $left > $right;
			case '>=':
				return $left >= $right;

			case '||':
				return $left || $right;
			case '&&':
				return $left && $right;

			case '%':
				return $left % $right;

			case '!':
				return ! $left;

			default:
				throw new DslRuntimeException('Unknown operator \''.$this->operator.'\'');
		}

	}


	public function parse($tokens)
	{
	}
}