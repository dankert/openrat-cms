<?php
namespace dsl;

use dsl\ast\DslStatementList;

/**
 * Creates and interprets an abstract syntax tree (AST).
 */
class DslAstParser
{
	/**
	 * @var DslStatementList
	 */
	public $rootStatement;

	/**
	 * @throws DslParserException
	 */
	public function parse($tokens ) {

		$this->rootStatement = new DslStatementList( $tokens );
	}


	public function execute($context)
	{
		return $this->rootStatement->execute( $context );
	}


}