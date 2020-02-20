<?php

namespace template_engine\components;

use modules\template_engine\CMSElement;
use modules\template_engine\Value;
use modules\template_engine\ValueExpression;

class RadioComponent extends FieldComponent
{

	// Bisher nicht in Benutzung.
	public $readonly = false;

	public $value;

	public $prefix='';

	public $suffix='';

	public $class = '';

	public $onchange;

	public $children;

	public $checked;

	public $label = '';



	public function createElement()
	{

		$radio = (new CMSElement('input'))->addAttribute('type','radio');


		$radio->addAttribute('name',$this->name);
		$radio->addAttribute('disabled',$this->readonly);
		$radio->addAttribute('value',$this->value);
		$radio->addAttribute('checked',Value::createExpression(ValueExpression::TYPE_DATA_VAR,$this->name));

		if ( $this->readonly && $this->required ) {
			$hidden = (new CMSElement('input'))->addAttribute('type','hidden')->addAttribute('name',$this->name)->addAttribute('value','1');
			$radio->addChild( $hidden );
		}

		if   ( $this->class )
			$radio->addStyleClass($this->class);

		if   ( $this->label ) {
			$label = new CMSElement('label');
			$label->addStyleClass('or-form-row')->addStyleClass('or-form-radio');
			$label->addChild( (new CMSElement('span'))->addStyleClass('or-form-label')->content($this->label));
			$radio->asChildOf($label);
			return $label;
		}

		return $radio;
    }
}
