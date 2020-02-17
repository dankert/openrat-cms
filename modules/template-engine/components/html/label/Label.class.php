<?php

namespace template_engine\components;

use modules\template_engine\CMSElement;
use modules\template_engine\Value;
use modules\template_engine\ValueExpression;

class LabelComponent extends Component
{

	/**
	 * @deprecated
	 * @var
	 */
	public $for;

	/**
	 * @deprecated
	 * @var
	 */
	public $value;

	public $key;

	public $text;

	public function createElement()
	{
		$label = new CMSElement('label');
		$label->addStyleClass('label');

		if ( $this->key )
			$label->content(Value::createExpression(ValueExpression::TYPE_MESSAGE,$this->key));
		
		if ($this->text)
			$label->content($this->text);

		return $label;
	}

}