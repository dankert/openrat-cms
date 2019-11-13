<?php


namespace cms\publish\filter;


class Base64EncodeFilter extends AbstractFilter
{
	public function filter( $value )
	{
		return base64_encode( $value );
	}
}