<?php

class ListComponent extends Component
{

	public $list;

	public $extract = false;

	public $key = 'list_key';

	public $value = 'list_value';

	public function begin()
	{
		echo '<?php foreach($' . $this->varname($this->list) . ' as $' . $this->varname($this->key) . '=>$' . $this->varname($this->value) . '){ ?>';
		
		if ($this->extract)
			echo '<?php extract($' . $this->varname($this->value) . ') ?>';
	}

	public function end()
	{
		echo '<?php } ?>';
	}
}

?>