<?php

namespace dsl\ast;

use dsl\DslRuntimeException;
use dsl\DslToken;
use dsl\standard\ArrayInstance;

class DslFor implements DslStatement
{
	private $name;
	private $list;
	private $statements;

	/**
	 * DslFor constructor.
	 *
	 * @param $name String
	 * @param $list DslToken[]
	 * @param $statements DslToken[]
	 */
	public function __construct($name, $list, $statements)
	{
		$this->name = $name;
		$this->list = new DslExpression( $list );
		$this->statements = new DslStatementList( $statements );
	}


	public function execute( & $context ) {

		$list = $this->list->execute( $context );

		if   ( ! $list instanceof ArrayInstance )
			throw new DslRuntimeException('for value is not an array');

		$copiedContext = $context;
		foreach( $list->getInternalValue() as $loopVar ) {

			// copy loop var to current loop context
			$copiedContext[ $this->name ] = $loopVar;

			// Execute "for" block
			$this->statements->execute( $copiedContext );
		}
	}

	public function parse($tokens)
	{
	}
}