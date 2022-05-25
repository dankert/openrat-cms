<?php
namespace dsl;

use dsl\ast\DslStatementList;

class DslAstParser
{
	/**
	 * @var DslStatementList
	 */
	public $statements;

	/**
	 * @throws \Exception
	 */
	public function parse($tokens ) {

		//echo "Token: <pre>"; var_dump( $tokens ); echo "</pre>";

		$this->statements = new DslStatementList();
		$this->statements->parse( $tokens );
	}


	public function execute($context) {
		$this->statements->execute( $context );
	}
}