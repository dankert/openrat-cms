<?php

namespace template_engine\components;

use modules\template_engine\CMSElement;
use modules\template_engine\HtmlElement;
use modules\template_engine\Value;
use modules\template_engine\ValueExpression;

class PasswordComponent extends FieldComponent
{

	public $default;

	public $size = 40;

	public $maxlength = 256;

	public function createElement()
	{
		$input = (new CMSElement('input'))->addAttribute('type','password');

		$input->addAttribute('name',$this->name);
		/*echo ' id="<?php echo REQUEST_ID ?>_' . $this->htmlvalue($this->name) . '"';
		*/

		$input->addAttribute('size',$this->size);
		$input->addAttribute('maxlength',$this->maxlength);
		$input->addStyleClass($this->class);


		if ($this->default)
			$input->addAttribute('value',$this->default);
		else
			$input->addAttribute('value',Value::createExpression(ValueExpression::TYPE_DATA_VAR,$this->name));

		return (new HtmlElement('div'))->addStyleClass('inputholder')->addChild($input);
	}
}