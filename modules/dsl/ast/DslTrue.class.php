<?php

namespace dsl\ast;

use dsl\DslParserException;
use dsl\DslToken;

class DslTrue implements DslStatement
{
	public function execute( & $context)
	{
		return true;
	}


	public function parse($tokens)
	{
	}
}