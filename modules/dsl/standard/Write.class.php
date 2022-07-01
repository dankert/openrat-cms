<?php

namespace dsl\standard;

class Write
{
	public $buffer;

	public function __invoke( $text )
	{
		if   ( is_object($text ) && !method_exists($text, '__toString') )
			// Workaround for external objects, that do not implement __toString()
			$this->buffer .= get_class($text);
		else
			$this->buffer .= $text;
	}
}