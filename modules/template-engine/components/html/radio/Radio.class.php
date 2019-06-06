<?php

namespace template_engine\components;

class RadioComponent extends FieldComponent
{

	// Bisher nicht in Benutzung.
	public $readonly = false;

	public $value;

	public $prefix='';

	public $suffix='';

	public $class = '';

	public $onchange;

	public $children;

	public $checked;

	public $label = '';

	public function begin()
	{
        if   ( $this->label )
            echo '<label class="or-form-row"><span class="or-form-label"></span><span class="or-form-input">';


		echo '<input ';
        echo ' class="'.$this->htmlvalue($this->class).'"';
		echo ' type="radio"';
		echo ' id="<?php echo REQUEST_ID ?>_'.$this->htmlvalue($this->name).'_'.$this->htmlvalue($this->value).'"';

		echo parent::outputNameAttribute();
		//"<? php if ( $attr_readonly ) echo ' disabled="disabled"' ? >
		echo ' value="'.$this->htmlvalue($this->value).'"';

        echo '<?php if(';
		echo ''.''.$this->value($this->value).'==@$'.$this->varname($this->name);
		if(isset($this->checked))
			echo '||'.$this->value($this->checked);
		echo ")echo ' checked=\"checked\"'".' ?>';

		echo ' />';

        if   ( $this->label )
            echo '&nbsp;'.lang($this->label).' </span></label>';

    }
}

?>