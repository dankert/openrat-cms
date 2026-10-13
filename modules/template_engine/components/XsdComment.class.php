<?php
namespace template_engine\components;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY|Attribute::TARGET_CLASS)]
class XsdComment
{
	// Im Konstruktor definierst du, welche Daten das Attribut aufnehmen soll
	public function __construct(
		public string $comment
	)
	{
	}

}

