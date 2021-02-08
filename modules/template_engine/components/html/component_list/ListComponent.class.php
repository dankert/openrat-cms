<?php

namespace template_engine\components\html\component_list;

use template_engine\components\html\Component;
use template_engine\element\PHPBlockElement;

class ListComponent extends Component
{

	public $list;

	public $items;

	public $extract = false;

	public $key = 'list_key';

	public $value = 'list_value';

	public function createElement()
	{
		$list = new PHPBlockElement();

		if   ( $this->items )
			$listValue = '['.implode(',',array_map( function($value){return "'".$value."'";},explode(',',$this->items))).']';
		else
			$listValue = $list->value($this->list);

		$list->beforeBlock = 'foreach((array)'.$listValue.' as $' . $this->key . '=>$' . $this->value . ')';

		if ($this->extract)
			$list->inBlock = 'extract($' . $this->value . ');';

		return $list;
	}

}