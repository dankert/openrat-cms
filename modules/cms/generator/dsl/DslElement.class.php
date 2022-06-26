<?php

namespace cms\generator\dsl;

use cms\model\Element;
use dsl\context\BaseScriptableObject;

class DslElement extends BaseScriptableObject
{
	private $element;

	public $name;
	public $label;
	public $type;

	/**
	 * @param Element $element
	 */
	public function __construct($element)
	{
		$this->element = $element;

		$this->name    = $element->name;
		$this->label   = $element->label;
		$this->type    = $element->getTypeName();
	}


}