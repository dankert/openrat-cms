<?php

namespace dsl\ast;

use dsl\DslParserException;
use dsl\DslToken;

class DslFalse implements DslStatement
{
	public function execute( & $context)
	{
		return false;
	}


	public function parse($tokens)
	{
	}
}