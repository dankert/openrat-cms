<?php

namespace template_engine\components;

use modules\template_engine\CMSElement;
use modules\template_engine\Value;
use modules\template_engine\ValueExpression;

class HiddenComponent extends FieldComponent
{
	public $default;

	public function createElement()
	{
		$input = (new CMSElement('input'))->addAttribute('type','hidden');
		$input->addAttribute('name',$this->name);

		if ($this->default)
			$input->addAttribute('value',$this->default);
		else
			$input->addAttribute('value',Value::createExpression(ValueExpression::TYPE_DATA_VAR,$this->name));

		//$input->addWrapper( (new HtmlElement('div'))->addStyleClass('inputholder'));

		return $input;
	}
}