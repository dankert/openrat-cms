<?php

namespace cms\generator\dsl;

use dsl\context\DslFunction;

class DslWrite implements DslFunction
{

	public function execute( $text )
	{
		echo $text;
	}
}