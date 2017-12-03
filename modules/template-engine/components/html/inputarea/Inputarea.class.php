<?php

class InputareaComponent extends Component
{

	public $name;

	public $rows = 10;

	public $cols = 40;

	public $value;

	public $index;

	public $onchange;

	public $prefix;

	public $class = 'inputarea';

	public $default;
	
	public function begin()
	{
		echo '<div class="inputholder">';
		echo '<textarea';
		echo ' class="'.$this->htmlvalue($this->class).'"';
		echo ' name="'.$this->htmlvalue($this->name).'"';
		echo '>';
		echo '<?php echo Text::encodeHtml(';
		if	(isset($this->default))
			echo $this->value($this->default);
		else
			echo '$'.$this->varname($this->name).'';
		echo ') ?>';
		echo '</textarea>';
		echo '</div>';
	}
}

?>