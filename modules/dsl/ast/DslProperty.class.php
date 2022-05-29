<?php

namespace dsl\ast;

use dsl\DslRuntimeException;

class DslProperty implements DslStatement
{
	public $variable;
	public $property;

	/**
	 * DslProperty constructor.
	 * @param $variable
	 * @param $property
	 */
	public function __construct($variable, $property)
	{
		$this->variable = $variable;
		$this->property = $property;
	}


	/**
	 * @param array $context
	 * @return mixed
	 * @throws DslRuntimeException
	 */
	public function execute( & $context ) {

		$object = $this->variable->execute( $context );

		if   ( ! is_object( $object ) )
			throw new DslRuntimeException('is no object');

		$objectContext = get_object_vars( $object );

		// copy object methods to the object context to make them callable.
		foreach( get_class_methods( $object ) as $method ) {
			$objectContext[ $method ] = function() use ($method, $object) {
				return call_user_func_array( array($object,$method),func_get_args() );
			};
		}
		$prop = $this->property->execute( $objectContext );
		return $prop;
	}

	public function parse($tokens)
	{
	}
}