<?php

namespace template_engine\components;

use modules\template_engine\CMSElement;
use modules\template_engine\Value;
use modules\template_engine\ValueExpression;

class CheckboxComponent extends Component
{
	
	public $default = false;
	public $name;
	public $readonly = false;
	public $required = false;
	public $label;

	public function createElement()
	{
		$checkbox = (new CMSElement('input'))->addAttribute('type','checkbox');

        if   ( $this->label ) {
			$label = new CMSElement('label');
			$label->addStyleClass('or-form-row')->addStyleClass('or-form-checkbox');
			$label->addChild( (new CMSElement('span'))->addStyleClass('or-form-label')->content($this->label));
			$checkbox->addWrapper($label);
		}

		$checkbox->addAttribute('name',$this->name);
        if	( $this->readonly )
			$checkbox->addAttribute('disabled','disabled');
		$checkbox->addAttribute('value','1');

		if   ( $this->default )
			$checkbox->addAttribute('checked',$this->default);
		else {
			$condition = Value::createExpression(ValueExpression::TYPE_DATA_VAR,$this->name );
			$checkbox->addConditionalAttribute('checked', $condition, '1');
		}

		if   ( $this->required )
			$checkbox->addAttribute( 'required','required');

		if ( $this->readonly && $this->required ) {
			$hidden = (new CMSElement('input'))->addAttribute('type','hidden')->addAttribute('name',$this->name)->addAttribute('value','1');
			$checkbox->addChild( $hidden );
		}

		return $checkbox;
    }
}
