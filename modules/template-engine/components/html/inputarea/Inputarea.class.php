<?php

namespace template_engine\components;

class InputareaComponent extends Component
{

	public $name;

	public $rows = 10;

	public $cols = 40;

	public $value;

	public $index;

	public $onchange;

	public $prefix;

	public $class = 'inputarea';

	public $default;

	public $maxlength = 0;

	public $label;
	
	public function begin()
	{
        if   ( $this->label )
        {
            echo '<label class="or-form-row"><span class="or-form-label">'.lang($this->label).'</span><span class="or-form-input">';
        }

        echo '<div class="inputholder">';
		echo '<textarea';
		echo ' class="'.$this->htmlvalue($this->class).'"';
		echo ' name="'.$this->htmlvalue($this->name).'"';

		if (!empty($this->maxlength))
            echo ' maxlength="'.intval($this->maxlength).'"';

		echo '>';
		echo '<?php echo Text::encodeHtml(';
		if	(isset($this->default))
			echo $this->value($this->default);
		else
			echo '$'.$this->varname($this->name).'';
		echo ') ?>';
		echo '</textarea>';
		echo '</div>';

        if   ( $this->label )
        {
            echo '</span></label>';
        }
	}
}

?>