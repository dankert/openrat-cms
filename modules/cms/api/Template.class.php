<?php

namespace cms\api;


class Template {

	public function __construct(
		public int $id,

		#[ArrayOf(Element::class)]
		public array $elements,

		#[ArrayOf(TemplateModel::class)]
		public array $templateModels,

	)
	{
	}

}
