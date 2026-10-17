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

		/**
		 * elements of the template.
		 * @var array
		 */
		#[ArrayOf(Element::class)]
		public array $elements,

		/**
		 * templatemodels of the template.
		 * @var array
		 */
		#[ArrayOf(TemplateModel::class)]
		public array $templateModels,

	)
	{
	}

}
