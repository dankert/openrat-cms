<?php

namespace dsl\ast;

class DslFor implements DslStatement
{
	private $statements;

	public function __construct( $group, $block )
	{
	}

	public function execute( & $context ) {

	}

	public function parse($tokens)
	{
	}
}