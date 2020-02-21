<?php

namespace template_engine\components;

use modules\template_engine\CMSElement;

class RowComponent extends Component
{

	public $class = '';

	public $id = '';

	public function createElement()
	{
		$row = new CMSElement('tr' );
		
		if ($this->class)
			$row->addStyleClass($this->class);
		
		if ($this->id)
			$row->addAttribute('data-id',$this->id);

		return $row;
	}
}
