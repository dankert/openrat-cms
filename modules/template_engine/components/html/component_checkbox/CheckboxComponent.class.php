<?php

namespace template_engine\components\html\component_checkbox;

use template_engine\components\html\Component;
use template_engine\element\CMSElement;
use template_engine\element\PHPBlockElement;
use template_engine\element\Value;
use template_engine\element\ValueExpression;

class CheckboxComponent extends Component
{
	
	public $default = false;
	public $name;
	public $readonly = false;
	public $required = false;
	public $label;

	public function createElement()
	{
		$checkbox = (new CMSElement('input'))
			->addAttribute('type','checkbox')
			->addStyleClass('form-checkbox');

		if ( !$this->label )
			$checkbox->addAttribute('name',$this->name);

        if	( $this->readonly )
			$checkbox->addAttribute('disabled','disabled');
		$checkbox->addAttribute('value','1');

		if   ( $this->default )
			$condition = ''.PHPBlockElement::value($this->default);
		else
			$condition = '@$'.PHPBlockElement::value($this->name);
		$checkbox->addConditionalAttribute('checked', $condition, 'checked');

		if   ( $this->required )
			$checkbox->addAttribute( 'required','required');

		if ( $this->readonly && $this->required ) {
			$hidden = (new CMSElement('input'))->addAttribute('type','hidden')->addAttribute('name',$this->name)->addAttribute('value','1');
			$checkbox->addChild( $hidden );
		}

		if   ( $this->label ) {
			$label = (new CMSElement('label'))
				//->addStyleClass('form-checkbox')
				->addChild($checkbox)
				->addChild( (new CMSElement('input'))->addAttribute('type','hidden')->addAttribute('name',$this->name)->addConditionalAttribute('value', $condition, '1') )
				->addChild( (new CMSElement('span'))
					->addStyleClass('form-label')
					->content($this->label));
			return $label;
		}

		return $checkbox;
    }
}
