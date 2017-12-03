<?php

class RowComponent extends Component
{

	public $class = '';

	public $id = '';

	public function begin()
	{
		echo '<tr';
		
		if (! empty($this->class))
			echo ' class="' . $this->htmlvalue($this->class) . '"';
		
		if (! empty($this->id))
			echo ' data-id="' . $this->htmlvalue($this->id) . '"';
		echo '>';
	}

	public function end()
	{
		echo '</tr>';
	}
}
?>
