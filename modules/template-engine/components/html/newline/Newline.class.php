<?php

namespace template_engine\components;

use modules\template_engine\Element;

class NewlineComponent extends Component
{

	public function createElement()
	{
		return (new Element('br'));
	}
}

