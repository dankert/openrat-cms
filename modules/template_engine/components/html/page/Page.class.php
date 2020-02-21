<?php

namespace template_engine\components;

use modules\template_engine\Element;

class PageComponent extends Component
{
	public function createElement()
	{
		// No content.
		return new Element(null );
	}
}

