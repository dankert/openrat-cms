<?php

namespace template_engine\components;

use template_engine\components\html\Component;
use template_engine\element\PHPBlockElement;

class ElseComponent extends Component
{

	public function createElement()
	{
		$else = new PHPBlockElement();
		$else->beforeBlock = 'if(!$if' . $this->getDepth() . ')';
		return $else;
	}
}