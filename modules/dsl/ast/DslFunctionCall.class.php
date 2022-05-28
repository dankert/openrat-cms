<?php

namespace dsl\ast;

use dsl\DslRuntimeException;
use dsl\DslToken;

class DslFunctionCall implements DslStatement
{
	public $name;
	private $parameters;

	/**
	 * DslFunctionCall constructor.
	 * @param $name
	 * @param $parameters DslToken[][]
	 */
	public function __construct($name, $parameters)
	{
		$this->name       = $name;

		$this->parameters = [];

		foreach( $parameters as $parameter )
			$this->parameters[] = new DslExpression( $parameter );
	}


	/**
	 * @throws DslRuntimeException
	 */
	public function execute(& $context ) {

		if   ( ! array_key_exists( $this->name, $context ) )
			throw new DslRuntimeException('function \''.$this->name.'\' does not exist.');

		$function = $context[$this->name];

		if   ( $function instanceof \dsl\context\DslFunction ) {
			// call "external" native function
			$parameterValues = array_map( function( $parameter ) use ($context) {
				return $parameter->execute( $context );
			}, $this->parameters );

			return call_user_func_array(array($function,'execute'),$parameterValues );
		}
		elseif   ( $function instanceof DslFunction ) {
			// call DSL function
			if   ( sizeof( $function->parameters ) != sizeof($this->parameters) )
				throw new DslRuntimeException('function call parameter count must match the function declaration');

			// Put all function parameters to the function context.
			$parameters = array_combine( $function->parameters, $this->parameters );

			$cloneContext = $context;
			foreach( $parameters as $name=>$parameter ) {
				$cloneContext[ $name ] = $parameter->execute( $context );
			}
			return $function->execute( $cloneContext );

		}
		else
			throw new DslRuntimeException('function \''.$this->name.'\' is not callable.');
	}

	public function parse($tokens)
	{
		$this->statements[] = $tokens;
	}
}