<?php

namespace template_engine\components;

use modules\template_engine\PHPBlockElement;

class DateComponent extends Component
{
	public $date;

	public function createElement()
	{
		$date = new PHPBlockElement();
		$date->beforeBlock = $date->includeResource( 'date/component-date.php');
		$date->inBlock = 'component_date('.$date->value($this->date).');';

		return $date;
	}
}