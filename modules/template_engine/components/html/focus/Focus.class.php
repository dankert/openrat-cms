<?php

namespace template_engine\components;

use template_engine\element\Element;

class FocusComponent extends Component
{

	public function createElement()
	{
		return new Element(null);
	}
}