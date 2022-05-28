<?php

namespace dsl\ast;

use dsl\DslParserException;
use dsl\DslToken;

class DslNull implements DslStatement
{
	public function execute( & $context)
	{
		return null;
	}


	public function parse($tokens)
	{
		// TODO: Implement parse() method.
	}
}