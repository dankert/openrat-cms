<?php

class DateComponent extends Component
{
	public $date;
	
	protected function begin()
	{
		$date = $this->date;
		
		include_once( OR_THEMES_DIR.'default/include/html/date/date.inc.php');
		echo '<?php component_date('.$this->value($this->date).') ?>';
	}
}


?>