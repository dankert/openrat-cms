<?php

namespace template_engine\components\html\component_set;

use template_engine\components\html\Component;
use template_engine\element\PHPBlockElement;
use template_engine\element\Value;

class SetComponent extends Component
{
	public $var;
	public $value;
	public $key;
	public $mapper;


	public function createElement()
	{
		$set = new PHPBlockElement();

		if ($this->value)
		{
			if ($this->key)
				$set->inBlock = '$'.$set->varname($this->var).'= '.$this->addMapper($set->value($this->value).'['.((new Value($this->key))->render(Value::CONTEXT_PHP)).']').';';
			else 
				$set->inBlock = '$' . $set->varname($this->var) . '= ' . $this->addMapper($set->value($this->value) ). ';';
		}
		else {
			// Unset
			$set->inBlock = 'unset($'.$set->varname($this->var).')';
		}

		return $set;
	}

	private function addMapper($code)
	{
		if   ( $this->mapper )
			return "O::map('".strtolower($this->mapper)."',".$code.")";
		else return $code;
	}
}