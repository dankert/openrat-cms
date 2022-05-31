<?php

namespace dsl\ast;

class DslIf implements DslStatement
{

	/**
	 * Expression for the condition
	 * @var DslExpression
	 */
	private $condition;

	/**
	 * @var DslStatementList
	 */
	private $pos;

	/**
	 * @var DslStatementList
	 */
	private $neg;

	public function execute( & $context ) {

		$conditionValue = $this->condition->execute( $context );

		if   ( $conditionValue )
			return $this->pos->execute( $context );
		else
			return $this->neg->execute( $context );
	}

	public function __construct( $condition, $positive,$negative ) {
		$this->condition = new DslExpression( $condition );
		$this->pos = new DslStatementList( $positive );
		$this->neg = new DslStatementList( $negative );
	}

	public function parse($tokens)
	{
	}
}