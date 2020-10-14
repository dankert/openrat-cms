<?php

namespace template_engine\components\html\_if;

use template_engine\components\html\Component;
use template_engine\element\PHPBlockElement;

class IfComponent extends Component
{
	public $true;
	public $false;
	public $contains;
	public $value;
	public $empty;
	public $equals;
	public $lessthan;
	public $greaterthan;
	public $present;
	public $not;
	

	public function createElement()
	{
		$if = new PHPBlockElement();

		$expr = '$if'.$this->getDepth().'='.(!isset($this->not)?'':'!').'(';
		if	( $this->true )
			$expr .= $if->value($this->true);
		elseif ($this->false)
			$expr .= '!' . $if->value($this->false);
		elseif ($this->contains)
			$expr .= 'in_array('.$if->value($this->value).',explode(",",'.$if->value($this->contains).')';
		elseif ($this->equals)
			$expr .= '' . $if->value($this->value).'==\''.$if->value($this->equals).'\'';
		elseif ($this->lessthan)
			$expr .= 'intval(' . $if->value($this->lessthan).')>intval('.$if->value($this->value).')';
		elseif ($this->greaterthan)
			$expr .= 'intval(' . $if->value($this->greaterthan).')<count('.$if->value($this->value).')';
		elseif (! empty($this->present))
			$expr .= 'isset(' . '$'.$this->present.')'; // 'isset' verwenden! Nicht empty(), da false empty ist.
		elseif (! empty($this->empty))
			$expr .= '(' . $if->value($this->empty).')==FALSE';
		elseif ($this->value)
			$expr .= $if->value($this->value);
		else
			throw new \LogicException("Element 'if' has not enough parameters.");
		$expr .= ');';

		$if->beforeBlock = $expr . ' if($if'.$this->getDepth().')';

		return $if;
	}
}
