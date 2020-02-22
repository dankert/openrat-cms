<?php

namespace template_engine\components;

use template_engine\element\CMSElement;
use template_engine\element\PHPBlockElement;
use template_engine\element\Value;
use template_engine\element\ValueExpression;

class RadioboxComponent extends Component
{

	public $list;

	public $name;

	public $default;

	/**
	 * @deprecated
	 */
	public $onchange;

	public $title;

	public $class;


	public function createElement()
	{
		$radiobox = new PHPBlockElement();

		$radiobox->beforeBlock = 'foreach( $'.$this->list.' as $_key=>$_value)';
		
		if	( $this->default )
			$value = $this->default;
		else
			$value = '$'.$this->name;

		$label = (new CMSElement('label'))->asChildOf( $radiobox );

		(new CMSElement('input'))
			->addAttribute('type','radio')->addAttribute('name',$this->name)
			->addAttribute('value',Value::createExpression(ValueExpression::TYPE_DATA_VAR,'_key'))
			->addConditionalAttribute('checked','$_key=='.$value,'checked')
			->asChildOf($label);

		(new CMSElement('span'))
			->content( Value::createExpression(ValueExpression::TYPE_DATA_VAR,'_value'))
			->asChildOf( $label );
		(new CMSElement('br'))
			->asChildOf( $radiobox );

		return $radiobox;
	}
}