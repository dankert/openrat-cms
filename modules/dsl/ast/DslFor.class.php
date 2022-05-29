<?php

namespace dsl\ast;

use dsl\DslRuntimeException;
use dsl\DslToken;

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

		if   ( !is_array( $list ) )
			throw new DslRuntimeException('for value is not a list');

		$copiedContext = $context;
		foreach( $list as $loopVar ) {
			$copiedContext[ $this->name ] = $loopVar;
			$this->statements->execute( $copiedContext );
		}
	}

	public function parse($tokens)
	{
	}
}