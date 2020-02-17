<?php

namespace template_engine\components;

use modules\template_engine\Element;

class DummyComponent extends Component
{
	public function createElement()
	{
		return new Element(null);
	}
}