<?php

namespace dsl\ast;

use cms\generator\dsl\DslObject;
use dsl\context\Scriptable;
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

		$objectContext = [];

		if   (  is_object( $object ) ) {

			$objectContext = get_object_vars( $object );

			// copy object methods to the object context to make them callable.
			foreach( get_class_methods( $object ) as $method ) {
				$objectContext[ $method ] = function() use ($method, $object) {

					// For Security: Do not expose all available objects, they must implement a marker interface.
					if   ( ! $object instanceof Scriptable )
						throw new DslRuntimeException('security: Object '.get_class($object).' is not scriptable and therefore not available in script context');

					return call_user_func_array( array($object,$method),func_get_args() );
				};
			}
		}
		elseif   (  is_array( $object ) ) {

			$objectContext = $object;

		} else {

			throw new DslRuntimeException('not an object');
		}

		$prop = $this->property->execute( $objectContext );


		return $prop;
	}

	public function parse($tokens)
	{
	}
}