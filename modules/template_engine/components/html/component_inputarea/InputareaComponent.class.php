<?php

namespace template_engine\components\html\component_inputarea;

use template_engine\components\html\FieldComponent;
use template_engine\element\CMSElement;
use template_engine\element\Value;
use template_engine\element\ValueExpression;

class InputareaComponent extends FieldComponent
{

	public $rows = 10;

	public $cols = 40;

	public $value;

	public $index;

	public $onchange;

	public $prefix;

	public $class = 'inputarea';

	public $required = false;

	public $default;

	public $maxlength = 0;

	public $label;


	public function createElement()
	{
		$textarea = (new CMSElement('textarea'));
		$textarea->addStyleClass('input');

		$textarea->addAttribute('name',$this->name);
		if   ( $this->readonly )
			$textarea->addAttribute('disabled','disabled');

		if   ( $this->maxlength )
			$textarea->addAttribute('maxlength',$this->maxlength);

		if   ( $this->required )
			$textarea->addAttribute( 'required','required');

		if ( $this->readonly && $this->required ) {
			$hidden = (new CMSElement('input'))->addAttribute('type','hidden')->addAttribute('name',$this->name)->addAttribute('value','1');
			$textarea->addChild( $hidden );
		}

		if   ($this->class )
			$textarea->addStyleClass($this->class);



		if (isset($this->default))
			$textarea->content($this->default);
		else
			$textarea->content(Value::createExpression(ValueExpression::TYPE_DATA_VAR,$this->name));


		if   ( $this->label ) {
			$label = new CMSElement('label');
			$label->addStyleClass('form-row')->addStyleClass('form-checkbox');
			$label->addChild( (new CMSElement('span'))->addStyleClass('form-label')->content($this->label));

			$textarea->asChildOf($label);
			return $label;
		}

		return $textarea;
	}
}