<?php

namespace template_engine\components;

use template_engine\components\html\Component;
use template_engine\element\Element;

class OutputComponent extends Component
{
	public function createElement()
	{
		// No content.
		return new Element(null );
	}
}