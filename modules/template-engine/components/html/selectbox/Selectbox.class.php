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
		$selectbox = (new CMSElement('input'));


		$selectbox->addAttribute('name',$this->name);
		//$selectbox->addAttribute('disabled',$this->readonly);


		if   ( $this->class )
			$selectbox->addStyleClass($this->class);

		if   ( $this->title )
			$selectbox->addAttribute('title',$this->title);

		if (isset($this->default))
			$selectbox->addAttribute('value',$this->default);
		else
			$selectbox->addAttribute('value',Value::createExpression(ValueExpression::TYPE_DATA_VAR,$this->name));

		if	( $this->multiple )
			$selectbox->addAttribute('multiple','multiple');

		$selectbox->addAttribute('size',$this->size);

		$code = new PHPBlockElement();
		$selectbox->addChild( $code );

		//if ( ! $this->addempty )
		    //$code->inBlock .= 'if (count($'.$this->varname($this->list).')<=1)'." echo ' disabled=\"disabled\"';";

		if	( isset($this->default))
			$value = $this->default;
		else
			$value = '$'.$this->name;
		
		$code->beforeBlock = $code->includeResource( 'selectbox/component-select-box.php');
		$code->inBlock .= 'component_select_option_list($'.$this->list.','.$value.','.intval(boolval($this->addempty)).','.intval(boolval($this->lang)).')';
		
		// Keine Einträge in der Liste, wir benötigen ein verstecktes Feld.
		//echo '< ? php if (count($'.$this->varname($this->list).')==0) { ? >'.'<input type="hidden" name="'.$this->htmlvalue($this->name).'" value="" />'.'<?php } ? >';
		// Nur 1 Eintrag in Liste, da die Selectbox 'disabled' ist, muss ein hidden-Feld her.
		//echo '< ? php if (count($'.$this->varname($this->list).')==1) { ? >'.'<input type="hidden" name="'.$this->htmlvalue($this->name).'" value="'.'< ? php echo array_keys($'.$this->varname($this->list).')[0] ? >'.'" />'.'< ? php } ? >';

		if   ( $this->label ) {
			$label = new CMSElement('label');
			$label->addStyleClass('or-form-row')->addStyleClass('or-form-input');
			$label->addChild( (new CMSElement('span'))->addStyleClass('or-form-label')->content($this->label));
			$selectbox->asChildOf($label);
			return $label;
		}
		else {
			return $selectbox;
		}
	}
}
