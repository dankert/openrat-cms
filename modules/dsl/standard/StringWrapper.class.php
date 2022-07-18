<?php


namespace dsl\standard;


use dsl\context\BaseScriptableObject;

class StringWrapper extends BaseScriptableObject
{
	public function __toString()
	{
		return 'String';
	}


	public function __invoke( $value )
	{
		return new StringInstance( $value );
	}

	public function valueOf( $val ) {
		return new StringInstance( $val );
	}
}