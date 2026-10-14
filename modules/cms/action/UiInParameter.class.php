<?php

namespace cms\action;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class UiInParameter
{
	public function __construct(
		public string $name,
	)
	{
	}
}