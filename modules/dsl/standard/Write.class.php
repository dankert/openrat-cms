<?php

namespace dsl\standard;

class Write
{
	public $buffer;

	public function __invoke( $text )
	{
		$this->buffer .= $text;
	}
}