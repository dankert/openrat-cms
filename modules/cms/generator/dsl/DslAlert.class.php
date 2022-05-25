<?php

namespace cms\generator\dsl;

use dsl\context\DslFunction;

class DslAlert implements DslFunction
{

	public function execute( $text )
	{
		echo 'alert: !'.$text.'!';
	}
}