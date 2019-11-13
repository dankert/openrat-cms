<?php


namespace cms\publish\filter;


class Base64DecodeFilter extends AbstractFilter
{
	public function filter( $value )
	{
		return base64_decode( $value );
	}
}