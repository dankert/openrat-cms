<?php


namespace dsl\standard;


use dsl\context\BaseScriptableObject;

class BooleanWrapper extends BaseScriptableObject
{
	public function __toString()
	{
		return "Boolean";
	}


	public function __invoke( $value )
	{
		return new BooleanInstance( $value );
	}
}