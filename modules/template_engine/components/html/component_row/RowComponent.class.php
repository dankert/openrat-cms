<?php

namespace template_engine\components\html\component_row;

use template_engine\components\html\Component;
use template_engine\element\CMSElement;

class RowComponent extends Component
{

	public $class = '';

	public $header = false;

	public $id = '';

	public function createElement()
	{
		$row = new CMSElement('tr' );
		
		if ($this->class)
			$row->addStyleClass($this->class);
		
		if ($this->header)
			$row->addStyleClass('table-header');

		if ($this->id)
			$row->addAttribute('data-id',$this->id);

		return $row;
	}
}
