<?php

namespace dsl;


class DslException extends \Exception
{
	/**
	 * DslParserException constructor.
	 * @param $message
	 * @param $lineNumber
	 */
	public function __construct($message, $lineNumber=null,$previous=null)
	{
		parent::__construct( $message . ($lineNumber?' on line ' . $lineNumber:''),0,$previous );
	}
}