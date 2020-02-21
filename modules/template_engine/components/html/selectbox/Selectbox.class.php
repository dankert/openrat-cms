<?php

namespace template_engine\components;

use modules\template_engine\CMSElement;
use modules\template_engine\PHPBlockElement;
use modules\template_engine\Value;
use modules\template_engine\ValueExpression;

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
			$value = $this->default;
		else
			$value = '$'.$this->name;

		// Create the option list.
		$optionLoop->beforeBlock = 'foreach($'.$this->list.' as $_key=>$_value)';
		$option = (new CMSElement('option'))
			->addAttribute('value',Value::createExpression( ValueExpression::TYPE_DATA_VAR,'_key'))
			->content(Value::createExpression( ValueExpression::TYPE_DATA_VAR,'_value'))
			->addConditionalAttribute('selected','$_key=='.$value,'selected');

		$optionLoop->addChild($option);

		// Wrap into a label, if necessary.
		if   ( $this->label ) {
			$label = new CMSElement('label');
			$label->addStyleClass('or-form-row')->addStyleClass('or-form-input');
			$label->addChild( (new CMSElement('span'))->addStyleClass('or-form-label')->content($this->label));
			$label->addChild( $selectbox );
			return $label;
		}
		else {
			return $selectbox;
		}
	}
}
