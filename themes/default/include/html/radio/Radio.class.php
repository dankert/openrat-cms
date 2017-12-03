<?php

class RadioComponent extends Component
{

	// Bisher nicht in Benutzung.
	public $readonly = false;

	public $name;

	public $value;

	public $prefix='';

	public $suffix='';

	public $class;

	public $onchange;

	public $children;

	public $checked;
	
	public function begin()
	{
		echo '<input ';
		echo ' class="radio"';
		echo ' type="radio"';
		echo ' id="<?php echo REQUEST_ID ?>_'.$this->htmlvalue($this->name).'_'.$this->htmlvalue($this->value).'"';
		echo ' name="'.$this->htmlvalue($this->prefix).$this->htmlvalue($this->name).'"';
		//"<? php if ( $attr_readonly ) echo ' disabled="disabled"' ? >
		echo ' value="'.$this->htmlvalue($this->value).'"';
		echo '<?php if(';
		echo ''.''.$this->value($this->value).'==@$'.$this->varname($this->name);
		if(isset($this->checked))
			echo '||'.$this->value($this->checked);
		echo ")echo ' checked=\"checked\"'".' ?>';

		echo ' />';
	}
}

?>