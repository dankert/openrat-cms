<?php

namespace dsl\standard;

use dsl\context\DslFunction;

class Write implements DslFunction
{
	public $buffer;

	public function execute( $text )
	{
		$this->buffer .= $text;
	}
}