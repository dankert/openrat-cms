<?php

namespace template_engine\components;

use modules\template_engine\PHPBlockElement;

class SetComponent extends Component
{
	public $var;
	public $value;
	public $key;


	public function createElement()
	{
		$set = new PHPBlockElement();

		if ($this->value)
		{
			if ($this->key)
				$set->inBlock = '$'.$set->varname($this->var).'= '.$set->value($this->value).'['.$set->value($this->key).'];';
			else 
				$set->inBlock = '$'.$set->varname($this->var).'= '.$set->value($this->value).';';
		}
		else {
			// Unset
			$set->inBlock = 'unset($'.$set->varname($this->var).')';
		}

		return $set;
	}
}