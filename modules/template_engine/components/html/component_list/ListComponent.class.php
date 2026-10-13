<?php

namespace template_engine\components\html\component_list;

use template_engine\components\html\Component;
use template_engine\components\XsdComment;
use template_engine\element\PHPBlockElement;

#[XsdComment("list")]
class ListComponent extends Component
{

	#[XsdComment("list of elements to iterate over")]
	public $list;

	#[XsdComment("comma-seperated string of elements to iterate over")]
	public $items;

	#[XsdComment("boolean switch if the value should be extracted. The value must be an object or associative array")]
	public $extract = false;

	#[XsdComment("the variable name of the key, default is 'list_key'")]
	public $key = 'list_key';

	#[XsdComment("the variable name of the value, default is 'list_value'")]
	public $value = 'list_value';

	public function createElement()
	{
		$list = new PHPBlockElement();

		if   ( $this->items )
			$listValue = '['.implode(',',array_map( function($value){return "'".$value."'";},explode(',',$this->items))).']';
		else
			$listValue = $list->value($this->list);

		$list->beforeBlock = 'foreach((array)'.'@'.$listValue.' as $' . $this->key . '=>$' . $this->value . ')';

		if ($this->extract)
			$list->inBlock = 'extract($' . $this->value . ');';

		return $list;
	}

}