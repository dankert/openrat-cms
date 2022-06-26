<?php

namespace cms\generator\dsl;

use dsl\context\BaseScriptableObject;
use util\json\JSON;

class DslJson  extends BaseScriptableObject
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