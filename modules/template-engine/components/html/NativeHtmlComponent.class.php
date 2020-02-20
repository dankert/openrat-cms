<?php

namespace template_engine\components;

use modules\template_engine\HtmlElement;

class NativeHtmlComponent extends HtmlComponent
{
	public $attributes;
	public $tag;

	public function createElement()
	{
		$html = new HtmlElement( $this->tag );

		foreach ($this->attributes as $attribute)
			$html->addAttribute( $attribute->name,$attribute->value );

		return $html;
	}
}
