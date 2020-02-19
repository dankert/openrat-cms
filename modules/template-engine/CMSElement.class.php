<?php


namespace modules\template_engine;

use template_engine\components\ConditionalAttribute;

class CMSElement extends HtmlElement
{
	public function __construct( $name )
	{
		parent::__construct( $name );
	}

	public function addConditionalAttribute($name, $condition, $value ) {
		$this->attributes[] = new ConditionalAttribute($condition,$name,$value);
	}
}