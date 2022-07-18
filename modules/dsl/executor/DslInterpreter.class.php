<?php

namespace dsl\executor;

use dsl\DslAstParser;
use dsl\DslException;
use dsl\DslLexer;
use dsl\standard\ArrayWrapper;
use dsl\standard\NumberInstance;
use dsl\standard\NumberWrapper;
use dsl\standard\Script;
use dsl\standard\ArrayInstance;
use dsl\standard\DateWrapper;
use dsl\standard\MathWrapper;
use dsl\standard\StringInstance;
use dsl\standard\StringWrapper;
use dsl\standard\System;
use dsl\standard\Writer;
use dsl\standard\WriteWrapper;

class DslInterpreter
{
	/**
	 * Execution context.
	 *
	 * @var array
	 */
	private $context = [];

	/**
	 * Holds a reference to the write()-Function for getting the output buffer after execution.
	 * @var Writer
	 */
	private $writer;
	private $flags;

	const FLAG_SHOW_ERROR  =  1;
	const FLAG_SHOW_TRACE  =  2;
	const FLAG_THROW_ERROR =  4;
	const FLAG_DEBUG       =  8;
	const FLAG_SECURE      = 16;

	private static $secure = true;

	public function __construct( $flags = self::FLAG_SHOW_ERROR + self::FLAG_SECURE )
	{
		$this->flags = $flags;

		self::$secure = boolval($this->flags & self::FLAG_SECURE );

		// Standard-Globals
		$this->addContext( [

			// Standard JS objects
			'Math'   => new MathWrapper(),
			'Array'  => new ArrayWrapper(),
			'String' => new StringWrapper(),
			'Number' => new NumberWrapper(),
			'Date'   => new DateWrapper(),

			// Custom Scriptbox objects
			'System'  => new System(),
			'write'   => $this->writer = new Writer(),
			'writeln' => new WriteWrapper( $this->writer,"\n" ),
			'print'   => new WriteWrapper( $this->writer,'' ),
			'println' => new WriteWrapper( $this->writer,"\n" ),
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
	 * @param $code String Script-Code
	 * @throws DslException
	 * @return mixed value of last return statement (if any)
	 */
	public function runCode( $code ) {

		// Step 1: Splitting the source code into tokens (the "Lexer")
		$lexer = new DslLexer();
		$token = $lexer->tokenize( $code );

		// Step 2: Creating a syntax tree (abstract syntax tree, AST).
		try {

			$parser = new DslAstParser();
			$parser->parse( $token );

			//if   ( $this->flags & self::FLAG_DEBUG )
			// it has no security impact, so lets do it always.
				$this->addContext(
					[ 'Script' => new Script( $token,$parser->rootStatement ) ]
				);

			// Step 3: Executing the syntax tree.
			return $parser->execute( $this->context );
		} catch ( \Exception $e ) {
			if   ( $this->flags & self::FLAG_SHOW_ERROR ) {
				if   ( $this->flags & self::FLAG_SHOW_TRACE )
					$this->writer->buffer .= $e->__toString();
				else
					$this->writer->buffer .= $e->getMessage();
			}
			if   ( $this->flags & self::FLAG_THROW_ERROR )
				throw $e;
		}
	}


	/**
	 * Gets the output which was written by the code.
	 *
	 * @return mixed
	 */
	public function getOutput() {

		return $this->writer->buffer;
	}

	/**
	 * @return bool
	 */
	public static function isSecure() {
		return self::$secure;
	}
}