<?php

namespace dsl\standard;

class WriteWrapper
{
	/**
	 * @var Writer
	 */
	private $writer;
	private $prefix;

	/**
	 * WriteWrapper constructor.
	 * @param Writer $writer
	 * @param string $prefix Prefix
	 */
	public function __construct( $writer,$prefix )
	{
		$this->writer = $writer;
		$this->prefix = $prefix;
	}

	/**
	 * Write something to an output queue.
	 *
	 * @param $text
	 */
	public function __invoke( $text )
	{
		call_user_func($this->writer,$text         );
		call_user_func($this->writer,$this->prefix );
	}
}