<?php

namespace dsl\ast;

use dsl\context\Scriptable;
use dsl\DslRuntimeException;
use dsl\executor\DslInterpreter;

class DslVariable implements DslStatement
{
	public $name;

	/**
	 * @param $name
	 */
	public function __construct($name)
	{
		$this->name = $name;
	}


	public function execute( & $context ) {

		if   (  is_object( $context) ) {

			// copy object methods to the object context to make them callable.
			$property = $this->name;

			if   ( property_exists( $context,$property ) ) {

				return $context->$property;
			}

			if   ( method_exists( $context,$this->name ) ) {

				return function() use ($property, $context) {

					// For Security: Do not expose all available objects, they must implement a marker interface.
					if   ( DslInterpreter::isSecure() && ! $context instanceof Scriptable )
						throw new DslRuntimeException('Object '.get_class($context).' is not marked as scriptable and therefore not available in secure mode');

					return call_user_func_array( array($context,$property),func_get_args() );
				};
			}

			throw new DslRuntimeException('method or property \''.$property.'\' does not exist' );
		}

		if   ( ! array_key_exists( $this->name, $context ) )
			throw new DslRuntimeException('variable or property \''.$this->name.'\' does not exist');

		return $context[ $this->name ];
	}

	public function parse($tokens)
	{
	}
}