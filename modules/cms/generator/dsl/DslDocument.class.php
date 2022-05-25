<?php

namespace cms\generator\dsl;

use dsl\context\DslObject;

class DslDocument implements DslObject
{
	public function write( $text ) {
		echo $text;
	}
}