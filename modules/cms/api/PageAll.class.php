<?php

namespace cms\api;

class PageAll
{
	public int $objectId;
	public int $pageId;

	#[ArrayOf(Language::class)]
	public array $languages;

	#[ArrayOf(Element::class)]
	public array $elements;
}