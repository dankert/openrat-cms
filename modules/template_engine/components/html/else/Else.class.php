<?php

namespace template_engine\components;

use modules\template_engine\PHPBlockElement;

class ElseComponent extends Component
{

	public function createElement()
	{
		$else = new PHPBlockElement();
		$else->beforeBlock = 'if(!$if' . $this->getDepth() . ')';
		return $else;
	}
}