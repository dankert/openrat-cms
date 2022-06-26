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
		$this->parameters = $parameters;
	}


	/**
	 * @throws DslRuntimeException
	 */
	public function execute(& $context ) {

		$function = $this->name->execute( $context );


		//if   ( ! array_key_exists( $name, $context ) )
		//	throw new DslRuntimeException('function \''.$this->name.'\' does not exist.');

		if   ( $this->parameters == null )
			$parameterValues = []; // parameterless functions.
		else
			$parameterValues = $this->parameters->execute( $context );

		// if there is only 1 parameter it must be converted to an array.
		// if there are more than 1 parameter, it is already a sequence
		if   ( ! is_array($parameterValues)) $parameterValues = array($parameterValues);


		if   ( $function instanceof DslFunction ) {

			$parameters = $function->parameters;

			if   ( sizeof($parameters) > sizeof($parameterValues) )
				throw new DslRuntimeException('function call has '.sizeof($parameterValues).' parameters but the function has '.sizeof($parameters).' parameters');

			// Put all function parameters to the function context.
			$parameterContext = array_combine( $parameters, array_slice($parameterValues,0,sizeof($parameters)) );
			$subContext = array_merge( $context,$parameterContext );

			return $function->execute( $subContext );

		}
		elseif   ( is_callable($function) ) {

			//var_export( call_user_func_array( $function, $parameterValues) );
			return call_user_func_array( $function, $parameterValues);
		}
		else
			throw new DslRuntimeException('function is not callable'.var_export($function));
	}

	public function parse($tokens)
	{
		$this->statements[] = $tokens;
	}
}