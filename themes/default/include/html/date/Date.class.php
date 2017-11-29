<?php

class DateComponent extends Component
{
	public $date;
	
	protected function begin()
	{
		$date = $this->date;
		
		$this->include( 'date/component-date.php');
		echo '<?php component_date('.$this->value($this->date).') ?>';
	}
}


?>