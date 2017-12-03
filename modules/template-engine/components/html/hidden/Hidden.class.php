<?php

namespace template_engine\components;

class HiddenComponent extends Component
{

	public $name;

	public $default;

	public function begin()
	{
		echo '<input';
		echo ' type="hidden"';
		echo ' name="' . $this->htmlvalue($this->name) . '"';
		echo ' value="';
		
		if (isset($this->default))
			echo $this->htmlvalue($this->default);
		else
			echo '<?php echo $' . $this->varname($this->name) . ' ?>';
		
		echo '"';
		echo '/>';
	}
}

?>