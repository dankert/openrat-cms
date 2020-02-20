<?php

namespace template_engine\components;

use modules\template_engine\Element;
use modules\template_engine\HtmlElement;

/**
 * Newline-Component
 */
class NewlineComponent extends Component
{

	public function createElement()
	{
		return (new HtmlElement('br'));
	}
}

