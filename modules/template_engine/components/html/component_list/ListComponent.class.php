<?php

namespace template_engine\components;

use template_engine\components\html\Component;
use template_engine\element\PHPBlockElement;

class ListComponent extends Component
{

	public $list;

	public $extract = false;

	public $key = 'list_key';

	public $value = 'list_value';

	public function createElement()
	{
		$list = new PHPBlockElement();
		$list->beforeBlock = 'foreach((array)'.$list->value($this->list).' as $' . $this->key . '=>$' . $this->value . ')';

		if ($this->extract)
			$list->inBlock = 'extract($' . $this->value . ');';

		return $list;
	}

}