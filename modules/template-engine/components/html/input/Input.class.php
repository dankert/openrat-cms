<?php

namespace template_engine\components;

use modules\template_engine\CMSElement;
use modules\template_engine\Value;
use modules\template_engine\ValueExpression;

class InputComponent extends FieldComponent
{
	public $default;

	public $type = 'text';

	public $index;

	public $name;

	public $prefix;

	public $value;

	public $size;

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

		if   ( $this->label ) {
			$label = new CMSElement('label');
			$label->addStyleClass('or-form-row')->addStyleClass('or-form-input');
			$label->addChild( (new CMSElement('span'))->addStyleClass('or-form-label')->content($this->label));
			$input->addWrapper($label);
		}

		$input->addAttribute('name',$this->name);
		$input->addAttribute('disabled',$this->readonly);

		if   ( $this->required )
			$input->addAttribute( 'required','required');

		if ( $this->hint )
			$input->addAttribute( 'placeholder',$this->hint );
			
		if($this->focus)
			$input->addAttribute( 'autofocus','autofocus');


		$input->addAttribute('type',$this->type);
		$input->addAttribute('maxlength',$this->maxlength);

		if   ( $this->class )
			$input->addStyleClass($this->class);
			
		if (isset($this->default))
			$input->addAttribute('value',$this->default);
		else
			$input->addAttribute('value',Value::createExpression(ValueExpression::TYPE_DATA_VAR,$this->name));

			// Unused:
			//if(isset($this->icon))
			//	echo '<img src="'.OR_THEMES_DIR.'default/images/icon_'.$this->htmlvalue($this->icon). IMG_ICON_EXT .'" width="16" height="16" />';

		return $input;
	}
}