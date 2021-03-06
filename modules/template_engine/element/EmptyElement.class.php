<?php


namespace template_engine\element;


use template_engine\element\attribute\SimpleAttribute;


/**
 * An empty element.
 *
 * 'empty' means, the element has no tag and no text content. But it may (and should) contain child elements.
 *
 * @package modules\template_engine
 */
class EmptyElement extends Element
{
	public function __construct()
	{
		parent::__construct(null);
	}
}
