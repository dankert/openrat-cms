<?php

namespace cms\api;

class Value
{
	public function __construct(

		public int $elementId,
		public string|null $elementName,

		public int $languageId,
		public string|null $languageName,

		public string $value,
		public int|null $date,
	){
	}
}