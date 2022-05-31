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

		//echo "<h1>Token:</h1><pre>"; var_export( $tokens ); echo "</pre>";

		$this->rootStatement = new DslStatementList( $tokens );

		//echo "<h1>AST:</h1><pre>"; var_export( $this->rootStatement ); echo "</pre>";
	}


	public function execute($context)
	{
		return $this->rootStatement->execute( $context );
	}


}