<?php

namespace dsl\ast;

use dsl\DslRuntimeException;
use dsl\DslToken;
use dsl\executor\DslInterpreter;
use dsl\standard\NumberInstance;
use dsl\standard\ArrayInstance;
use dsl\standard\StringInstance;

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

		if   ( $this->parameters == null )
			$parameterValues = []; // parameterless functions.
		else
			$parameterValues = $this->parameters->execute( $context );

		// if there is only 1 parameter it must be converted to an array.
		// if there are more than 1 parameter, it is already a sequence
		if   ( ! is_array($parameterValues)) $parameterValues = array($parameterValues);


		if   ( $function instanceof DslFunction ) {
			// inscript custom function
			$parameters = $function->parameters;

			if   ( sizeof($parameters) > sizeof($parameterValues) )
				throw new DslRuntimeException('function call has '.sizeof($parameterValues).' parameters but the function has '.sizeof($parameters).' parameters');

			// Put all function parameters to the function context.
			$parameterContext = array_combine( $parameters, array_slice($parameterValues,0,sizeof($parameters)) );
			$subContext = array_merge( $context,$parameterContext );

			return $function->execute( $subContext );

		}
		elseif   ( is_callable($function) ) {

			return DslExpression::convertValueToStandardObject( call_user_func_array( $function, $this->toPrimitiveValues($parameterValues)) );
		}
		else
			throw new DslRuntimeException('function is not callable'.var_export($function));
	}

	public function parse($tokens)
	{
		$this->statements[] = $tokens;
	}


	/**
	 * Converts variables to its primitives, because external objects in applications will not be able to handle things like "StandardString".
	 * @param $parameterValues
	 * @return array
	 */
	private function toPrimitiveValues( $parameterValues )
	{
		return array_map( function( $val ) {
			if   ( $val instanceof ArrayInstance )
				return $val->getInternalValue();
			if   ( $val instanceof NumberInstance )
				return $val->toNumber();
			if   ( $val instanceof StringInstance )
				return (string)$val;

			return $val;

		},$parameterValues );
	}
}