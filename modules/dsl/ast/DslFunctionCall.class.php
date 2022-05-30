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
		//echo "name:";var_export( $name );
		//echo "params:";var_export( $parameters );

		// Parameterless function calls are not correctly detected by the AST parser
		if   ( $name==null) {
			$name = $parameters;
			$parameters = null;
		}
		$this->name       = $name;
		$this->parameters = $parameters;
	}


	/**
	 * @throws DslRuntimeException
	 */
	public function execute(& $context ) {

		//var_export($this->name);
		$function = $this->name->execute( $context );


		//echo "name is $name";
		//if   ( ! array_key_exists( $name, $context ) )
		//	throw new DslRuntimeException('function \''.$this->name.'\' does not exist.');
//
//		$function = $context[$name];

		if   ( $this->parameters == null )
			$parameterValues = []; // parameterless functions.
		else
			$parameterValues = $this->parameters->execute( $context );

		// if there is only 1 parameter it must be converted to an array.
		// if there are more than 1 parameter, it is already a sequence
		if   ( ! is_array($parameterValues)) $parameterValues = array($parameterValues);


		if   ( $function instanceof \dsl\context\DslFunction ) {
			// call "external" native function

			return call_user_func_array(array($function,'execute'),$parameterValues );
		}
		elseif   ( $function instanceof DslFunction ) {

			$parameters = $function->parameters;
			//var_export( $function->parameters);

			if   ( sizeof($parameters) != sizeof($parameterValues) )
				throw new DslRuntimeException('function call has '.sizeof($parameterValues).' parameters but the function has '.sizeof($parameters).' parameters');

			// Put all function parameters to the function context.
			$parameterContext = array_combine( $parameters, $parameterValues );
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