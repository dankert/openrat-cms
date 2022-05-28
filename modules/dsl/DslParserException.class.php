<?php

namespace dsl;


class DslParserException extends DslException
{
	/**
	 * DslParserException constructor.
	 * @param $message
	 * @param $lineNumber
	 */
	public function __construct($message, $lineNumber=null)
	{
		parent::__construct( $message . ($lineNumber?' on line ' . $lineNumber:'') );
	}
}