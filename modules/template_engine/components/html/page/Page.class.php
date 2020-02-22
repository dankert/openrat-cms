<?php

namespace template_engine\components;

use template_engine\element\Element;

class PageComponent extends Component
{
	public function createElement()
	{
		// No content.
		return new Element(null );
	}
}

