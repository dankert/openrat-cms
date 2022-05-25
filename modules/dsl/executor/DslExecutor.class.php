<?php

namespace dsl\executor;

use dsl\DslAstParser;
use dsl\DslLexer;

class DslExecutor
{
	private $context = [];

	public function setContext( $context ) {
		$this->context = $context;
	}


	public function run( $ast ) {
		$ast->execute( $this->context );
	}

	/**
	 * @throws \Exception
	 */
	public function runCode($code ) {
		$lexer = new DslLexer();
		$token = $lexer->tokenize( $code );

		$parser = new DslAstParser();
		$parser->parse( $token );

		$parser->execute( $this->context );
	}
}