<?php

namespace dsl\ast;

use dsl\DslToken;

interface DslStatement
{
	public function parse($tokens);

	public function execute($context);

}
