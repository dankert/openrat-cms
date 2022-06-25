<?php

namespace cms\generator\dsl;

use cms\model\BaseObject;
use cms\model\Element;
use cms\model\Folder;
use cms\model\Page;
use cms\model\Template;
use dsl\context\DslObject as DslContextObject;

class DslElement implements DslContextObject
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