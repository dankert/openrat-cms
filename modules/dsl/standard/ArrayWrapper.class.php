<?php
namespace dsl\standard;

use dsl\context\BaseScriptableObject;

class ArrayWrapper extends BaseScriptableObject
{
	public function of() {

		return func_get_args();
	}


	public function __toString()
	{
		return 'Array';
	}


	public function fill( $value,$start,$count)
	{
		return array_fill( $value,$start,$count );
	}


	public function isArray( $val )
	{
		return is_array( $val );
	}


}