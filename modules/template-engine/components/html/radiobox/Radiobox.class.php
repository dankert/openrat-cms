<?php

namespace template_engine\components;

class RadioboxComponent extends Component
{

	public $list;

	public $name;

	public $default;

	public $onchange;

	public $title;

	public $class;
	
	public function begin()
	{
		$this->include( 'radiobox/component-radio-box.php');
		
		if	( isset($this->default))
			$value = $this->value($this->default);
		else
			$value = '$'.$this->varname($this->name);
					
		echo '<?php component_radio_box('.$value.',$'.$this->varname($this->list).','.$value.') ?>';
	}
}

?>