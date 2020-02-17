<?php

namespace template_engine\components;

use modules\template_engine\Element;

class FocusComponent extends Component
{

	public function createElement()
	{
		return new Element(null);
	}
}