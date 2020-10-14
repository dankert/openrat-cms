<?php

namespace template_engine\components;

use template_engine\components\html\Component;
use template_engine\element\CMSElement;
use template_engine\element\PHPBlockElement;
use template_engine\element\Value;
use template_engine\element\ValueExpression;

class SelectboxComponent extends Component
{

	public $list;

	public $name;

	public $default;

	/**
	 * Titel
	 * @var unknown
	 */
	public $title;

	/**
	 * Style-Klasse
	 */
	public $class;

	/**
	 * Leere Auswahlmöglichkeit hinzufügen.
	 * @var string
	 */
	public $addempty = false;

	/**
	 * Mehrfachauswahl möglich?
	 * @var string
	 */
	public $multiple = false;

	/**
	 * Größe des Eingabefeldes
	 * @var integer
	 */
	public $size = 1;

	/**
	 * Ob es sich bei den Option-Werten um Sprachschlüssel handelt.
	 * @var string
	 */
	public $lang = false;


	public $label;



	public function createElement()
	{
		$selectbox = (new CMSElement('select'));


		$selectbox->addAttribute('name',$this->name);
		//$selectbox->addAttribute('disabled',$this->readonly);


		if   ( $this->class )
			$selectbox->addStyleClass($this->class);

		if   ( $this->title )
			$selectbox->addAttribute('title',$this->title);

		if	( $this->multiple )
			$selectbox->addAttribute('multiple','multiple');

		$selectbox->addAttribute('size',$this->size);

		if ( $this->addempty )
			$selectbox->addChild( (new CMSElement('option'))->addAttribute('value','')->content( Value::createExpression(ValueExpression::TYPE_MESSAGE,'LIST_ENTRY_EMPTY')));

		$optionLoop = (new PHPBlockElement())->asChildOf($selectbox);

		if	( $this->default )
			$value = $optionLoop->value($this->default);
		elseif	( isset($this->default) )
			$value = '\'\'';
		else
			$value = '$'.$this->name;

		// Create the option list.
		$optionLoop->beforeBlock = 'foreach($'.$this->list.' as $_key=>$_value)';
		$option = (new CMSElement('option'))
			->addAttribute('value',Value::createExpression( ValueExpression::TYPE_DATA_VAR,'_key'))
			->content(Value::createExpression( ValueExpression::TYPE_DATA_VAR,'_value'))
			->addConditionalAttribute('selected','$_key=='.$value,'selected');

		$optionLoop->addChild($option);

		$selectbox->addStyleClass('input');

		// Wrap into a label, if necessary.
		if   ( $this->label ) {
			$label = new CMSElement('label');
			$label->addStyleClass('form-row')->addStyleClass('form-input');
			$label->addChild( (new CMSElement('span'))->addStyleClass('form-label')->content($this->label));
			$label->addChild( $selectbox );
			return $label;
		}
		else {
			return $selectbox;
		}
	}
}
