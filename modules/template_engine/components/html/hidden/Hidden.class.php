<?php

namespace template_engine\components;

use template_engine\components\html\FieldComponent;
use template_engine\element\CMSElement;
use template_engine\element\Value;
use template_engine\element\ValueExpression;

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