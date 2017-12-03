<?php

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
	
	
	public function begin()
	{
		$this->include( 'selectbox/component-select-box.php');
		
		echo '<div class="inputholder">';
		echo '<select ';
		echo ' id="'.'<?php echo REQUEST_ID ?>_'.$this->htmlvalue($this->name).'"';
		echo ' name="'.$this->htmlvalue($this->name).($this->multiple?'[]':'').'"';
		echo ' title="'.$this->htmlvalue($this->title).'"';
		echo ' class="'.$this->htmlvalue($this->class).'"';

		echo '<?php if (count($'.$this->varname($this->list).')<=1)'." echo ' disabled=\"disabled\"'; ?>";
	
		
		if($this->multiple)
		echo ' multiple="multiple"';
		
		echo ' size='.$this->htmlvalue($this->size).'"';
		echo '>';
		
		if	( isset($this->default))
			$value = $this->value($this->default);
		else
			$value = '$'.$this->varname($this->name);
		
		echo '<?php component_select_option_list($'.$this->varname($this->list).','.$value.','.intval(boolval($this->addempty)).','.intval(boolval($this->lang)).') ?>';
		
		// Keine Einträge in der Liste, wir benötigen ein verstecktes Feld.
		echo '<?php if (count($'.$this->varname($this->list).')==0) { ?>'.'<input type="hidden" name="'.$this->htmlvalue($this->name).'" value="" />'.'<?php } ?>';
		// Nur 1 Eintrag in Liste, da die Selectbox 'disabled' ist, muss ein hidden-Feld her.
		echo '<?php if (count($'.$this->varname($this->list).')==1) { ?>'.'<input type="hidden" name="'.$this->htmlvalue($this->name).'" value="'.'<?php echo array_keys($'.$this->varname($this->list).')[0] ?>'.'" />'.'<?php } ?>';
	}
	
	public function end()
	{
		echo '</select>';
		echo '</div>';
	}
}

?>