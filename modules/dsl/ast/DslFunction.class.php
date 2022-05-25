<?php

namespace dsl\ast;

use dsl\DslToken;

class DslFunction implements DslStatement
{
	private $statements;

	public function execute( $context ) {

	}

	public function parse($tokens)
	{
		$functionName = array_pop( $tokens );
		if   ( $functionName->type != DslToken::T_STRING )
			throw new \Exception('function must be named' );
		$bracketOpen  = array_pop( $tokens );
		$bracketClose = array_pop( $tokens );
		$blockBegin   = array_pop( $tokens );
		if   ( $blockBegin->type != DslToken::T_BLOCK_BEGIN )
			throw new \Exception('function must be followed by a block' );
	}
}