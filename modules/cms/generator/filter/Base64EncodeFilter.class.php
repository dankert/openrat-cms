<?php


namespace cms\generator\filter;


class Base64EncodeFilter extends AbstractFilter
{
	public function filter( $value )
	{
		return base64_encode( $value );
	}
}