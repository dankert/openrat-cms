<?php

namespace cms\action;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class UiOutClass
{
	// Im Konstruktor definierst du, welche Daten das Attribut aufnehmen soll
	public function __construct(
		public string $className
	)
	{
	}
}