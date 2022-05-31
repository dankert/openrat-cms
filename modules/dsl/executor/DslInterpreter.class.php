<?php

namespace dsl\executor;

use dsl\DslAstParser;
use dsl\DslException;
use dsl\DslLexer;
use dsl\DslParserException;
use dsl\standard\StandardArray;
use dsl\standard\StandardDate;
use dsl\standard\StandardMath;

class DslInterpreter
{
	private $context = [];

	public function __construct()
	{
		// Standard-Globals
		$this->addContext( [
			'Math'  => new StandardMath(),
			'Array' => new StandardArray(),
			'Date'  => new StandardDate(),
		] );
	}

	/**
	 * adds an external context to the interpreter environment.
	 *
	 * @param $context []
	 */
	public function addContext($context ) {
		$this->context = array_merge( $this->context, $context );
	}


	/**
	 * Parses and runs the DSL code.
	 *
	 * @throws DslException
	 */
	public function runCode( $code ) {
		$lexer = new DslLexer();
		$token = $lexer->tokenize( $code );

		$parser = new DslAstParser();
		$parser->parse( $token );

		return $parser->execute( $this->context );
	}
}