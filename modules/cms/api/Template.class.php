<?php

namespace cms\api;


/**
 * Template.
 */
class Template {

	public function __construct(
		/**
		 * The ID of the template.
		 */
		public int $id,

		#[ArrayOf(Element::class)]
		public array $elements,

		#[ArrayOf(TemplateModel::class)]
		public array $templateModels,

	)
	{
	}

}
