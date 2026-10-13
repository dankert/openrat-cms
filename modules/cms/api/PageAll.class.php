<?php

namespace cms\api;

class PageAll
{
	public function __construct(
		public int $objectId,
		public int $pageId,

		#[ArrayOf(Language::class)]
		public array $languages,

		#[ArrayOf(Element::class)]
		public array $elements,

	)
	{
	}

}