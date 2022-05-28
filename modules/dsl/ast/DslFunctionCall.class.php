<?php

namespace dsl\ast;

use dsl\DslRuntimeException;

class DslFunctionCall implements DslStatement
{
	public $name;
	private $parameters;

	/**
	 * DslFunctionCall constructor.
	 * @param $name
	 * @param $parameters
	 */
	public function __construct($name, $parameters)
	{
		$this->name       = $name;
		$this->parameters = new DslExpression($parameters);
	}


	/**
	 * @throws DslRuntimeException
	 */
	public function execute(& $context ) {

		if   ( ! array_key_exists( $this->name, $context ) )
			throw new DslRuntimeException('function \''.$this->name.'\' does not exist.');

		$function = $context[$this->name];
		if   ( $function instanceof \dsl\context\DslFunction )
			return $function->execute( $this->parameters->execute( $context ) );
		elseif   ( $function instanceof DslFunction )
			return $function->execute( $context );
		else
			throw new DslRuntimeException('function \''.$this->name.'\' is not callable.');
	}

	public function parse($tokens)
	{
		$this->statements[] = $tokens;
	}
}