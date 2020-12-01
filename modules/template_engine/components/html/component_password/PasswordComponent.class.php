<?php

namespace template_engine\components\html\component_password;

use template_engine\components\html\FieldComponent;
use template_engine\element\CMSElement;
use template_engine\element\HtmlElement;
use template_engine\element\Value;
use template_engine\element\ValueExpression;

class PasswordComponent extends FieldComponent
{

	public $default;

	public $size = 40;

	public $maxlength = 256;

	public $minlength;
	public $required = false;
	public $hint;

	public function createElement()
	{
		$input = (new CMSElement('input'))->addAttribute('type','password');

		$input->addAttribute('name',$this->name);

		$input->addAttribute('size',$this->size);
		$input->addAttribute('maxlength',$this->maxlength);
		$input->addStyleClass($this->class);

		if   ( $this->required )
			$input->addAttribute( 'required','required');

		if ( $this->hint )
			$input->addAttribute( 'placeholder',$this->hint );

		if   ( $this->minlength )
			$input->addAttribute('minlength',$this->minlength);

		if ($this->default)
			$input->addAttribute('value',$this->default);
		else
			$input->addAttribute('value',Value::createExpression(ValueExpression::TYPE_DATA_VAR,$this->name));

		$input->addStyleClass('input')->addStyleClass('input--password');

		$makeVisible = (new CMSElement('i'))->addStyleClass(['image-icon','image-icon--visible','act-make-visible','btn']);

		return (new CMSElement('span'))->addStyleClass([])->addChild($input)->addChild($makeVisible);
	}
}