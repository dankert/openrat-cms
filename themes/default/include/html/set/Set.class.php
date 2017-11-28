<?php

class SetComponent extends Component
{
	public $var;
	public $value;
	public $key;
	
	protected function begin()
	{
		if (!empty($this->value))
		{
			if (!empty($this->key))
				echo '<?php $'.$this->varname($this->var).'= '.$this->value($this->value).'['.$this->value($this->key).']; ?>';
			else 
				echo '<?php $'.$this->varname($this->var).'= '.$this->value($this->value).'; ?>';
		}
		else {
			// Unset
			echo '<?php unset($'.$this->varname($this->var).') ?>';
		}
	}
}


?>