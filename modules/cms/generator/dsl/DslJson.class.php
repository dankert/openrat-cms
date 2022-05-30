<?php

namespace cms\generator\dsl;

use dsl\context\DslObject;
use util\json\JSON;

class DslJson implements DslObject
{

	public function parse( $text )
	{
		return JSON::decode( $text );
	}

	public function stringify( $text )
	{
		return JSON::encode( $text );
	}
}