<?php


namespace cms\generator\filter;


class Base64DecodeFilter extends AbstractFilter
{
	public function filter( $value )
	{
		return base64_decode( $value );
	}
}