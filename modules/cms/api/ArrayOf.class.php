<?php

namespace cms\api;

use Attribute;

#[Attribute(Attribute::TARGET_PARAMETER)] // Darf nur an Eigenschaften genutzt werden
class ArrayOf
{
	// Im Konstruktor definierst du, welche Daten das Attribut aufnehmen soll
	public function __construct(
		public string $className
	)
	{
	}
}