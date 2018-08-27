<?php

namespace template_engine\components;

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
	
	
	public function begin()
	{
		echo <<<'HTML'
HTML;

		echo '<?php $if'.$this->getDepth().'='.(!isset($this->not)?'':'!').'(';
		if	( !empty($this->true ))
			echo $this->value($this->true);
		elseif (! empty($this->false))
			echo '!' . $this->value($this->false);
		elseif (! empty($this->contains))
			echo 'in_array('.$this->value($this->value).',explode(",",'.$this->value($this->contains).')';
		elseif (! empty($this->equals))
			echo '' . $this->value($this->value).'=='.$this->value($this->equals);
		elseif (strlen($this->lessthan)>0)
			echo 'intval(' . $this->value($this->lessthan).')>intval('.$this->value($this->value).')';
		elseif (strlen($this->greaterthan)>0)
			echo 'intval(' . $this->value($this->greaterthan).')<intval('.$this->value($this->value).')';
		elseif (! empty($this->present))
			echo 'isset(' . $this->textasvarname($this->present).')'; // 'isset' verwenden! Nicht empty(), da false empty ist.
		elseif (! empty($this->empty))
			echo 'empty(' . $this->textasvarname($this->empty).')';
		else
			throw new \LogicException("Element 'if' has not enough parameters.");
		
		echo '); if($if'.$this->getDepth().'){?>';
	}

	public function end() {
	    echo '<?php } ?>';
	}
}

?>