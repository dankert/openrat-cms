<?php

namespace template_engine\components;

use template_engine\components\html\Component;
use template_engine\element\Element;

class DummyComponent extends Component
{
	public function createElement()
	{
		return new Element(null);
	}
}