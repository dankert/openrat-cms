<?php

namespace dsl\standard;

class Writer
{
	public $buffer;

	/**
	 * Write something to an output queue.
	 *
	 * @param $text
	 */
	public function __invoke( $text )
	{
		if   ( is_object($text ) && !method_exists($text, '__toString') )
			// Workaround for external objects, that do not implement __toString()
			$this->buffer .= get_class($text);
		elseif   ( is_array($text)  )
			$this->buffer .= '['.implode(',',$text).']';
		else
			$this->buffer .= $text;
	}
}