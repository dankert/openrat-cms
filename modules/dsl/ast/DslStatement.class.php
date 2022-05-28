<?php

namespace dsl\ast;

use dsl\DslToken;

interface DslStatement
{
	/**
	 * Parses a list of tokens.
	 * @param $tokens DslToken[] List of tokens
	 */
	public function parse( $tokens );


	/**
	 * Executes this statement.
	 *
	 * @param $context array Context of execution.
	 * @return mixed
	 */
	public function execute( & $context );

}
