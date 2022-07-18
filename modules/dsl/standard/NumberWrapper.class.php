<?php


namespace dsl\standard;


use dsl\context\BaseScriptableObject;

class NumberWrapper extends BaseScriptableObject
{
	public $MAX_SAFE_INTEGER = PHP_INT_MAX;
	public $MIN_SAFE_INTEGER = PHP_INT_MIN;

	public function __toString()
	{
		return "Number";
	}


	public function __invoke( $value )
	{
		return new NumberInstance( $value );
	}

	public function parseFloat( $num )
	{
		return floatval($num );
	}

	public function parseInt( $num )
	{
		return intval($num);
	}

	public function valueOf( $val )
	{
		return new NumberInstance( $val );
	}
}