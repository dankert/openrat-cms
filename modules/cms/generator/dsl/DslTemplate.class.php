<?php

namespace cms\generator\dsl;

use cms\model\Template;
use dsl\context\BaseScriptableObject;

class DslTemplate extends BaseScriptableObject {

	private $template;

	public $name;

	/**
	 * @param Template $template
	 */
	public function __construct($template)
	{
		$this->template = $template;

		$this->name = $template->name;
	}


	public function elements() {
		return array_map( function($element) {
			return new DslElement( $element );
		},$this->template->getElements());
	}
}