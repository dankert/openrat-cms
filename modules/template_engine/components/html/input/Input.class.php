<?php

namespace template_engine\components;

use template_engine\components\html\FieldComponent;
use template_engine\element\CMSElement;
use template_engine\element\HtmlElement;
use template_engine\element\Value;
use template_engine\element\ValueExpression;

class InputComponent extends FieldComponent
{
	public $default;

	public $type = 'text';

	public $index;

	public $name;

	public $prefix;

	public $value;

	public $size;

	public $minlength = 0;
	public $maxlength = 256;

	public $onchange;

	public $hint;

	public $icon;

	public $required = false;

	public $focus = false;

	public $label;



	public function createElement()
	{
		$input = (new CMSElement('input'));

		$input->addAttribute('name',$this->name);
		if   ( $this->readonly )
			$input->addAttribute('disabled','disabled');

		if   ( $this->required )
			$input->addAttribute( 'required','required');

		if ( $this->hint )
			$input->addAttribute( 'placeholder',$this->hint );
			
		if($this->focus)
			$input->addAttribute( 'autofocus','autofocus');


		$input->addAttribute('type',$this->type);
		$input->addAttribute('maxlength',$this->maxlength);

		if   ( $this->minlength )
			$input->addAttribute('minlength',$this->minlength);

		if   ( $this->class )
			$input->addStyleClass($this->class);
			
		if (isset($this->default))
			$input->addAttribute('value',$this->default);
		else
			$input->addAttribute('value',Value::createExpression(ValueExpression::TYPE_DATA_VAR,$this->name));

		$input->addStyleClass('input');

		if   ( $this->label ) {
			$label = new CMSElement('label');
			$label->addStyleClass('form-row')->addStyleClass('form-input');
			$label->addChild( (new CMSElement('span'))->addStyleClass('form-label')->content($this->label));
			$input->asChildOf($label);
			return $label;
		}

		return $input;
	}
}