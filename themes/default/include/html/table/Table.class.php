<?php

class TableComponent extends Component
{

	public $class = '';
	public $width = '100%';
	
	public function begin()
	{
		echo '<table';
		
		if	( !empty($this->class))
			echo ' class="'.$this->htmlvalue($this->class).'"';
		
		if	( !empty($this->width))
			echo ' width="'.$this->htmlvalue($this->width).'"';
		
		echo '>';
	}

	public function end()
	{
		echo '</table>';
	}
}

?>