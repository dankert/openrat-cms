<?php

namespace template_engine\components\html\component_label;

use template_engine\components\html\Component;
use template_engine\element\CMSElement;
use template_engine\element\Value;
use template_engine\element\ValueExpression;

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