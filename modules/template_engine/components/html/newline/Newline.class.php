<?php

namespace template_engine\components;

use template_engine\element\Element;
use template_engine\element\HtmlElement;

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

