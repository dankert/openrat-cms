<?php

namespace template_engine\components;

class InputComponent extends FieldComponent
{
	public $default;

	public $type = 'text';

	public $index;

	public $name;

	public $prefix;

	public $value;

	public $size;

	public $maxlength = 256;

	public $onchange;

	public $hint;

	public $icon;

	public $required = false;

	public $focus = false;

	public $label;

	public function begin()
	{
	    if   ( $this->label )
        {
            echo '<label class="or-form-row"><span class="or-form-label">'.lang($this->label).'</span><span class="or-form-input">';
        }

		if(!$this->type == 'hidden')
		{
			// Verstecktes Feld.
			$this->outputHiddenField();
		}
		else 
		{
			echo '<div class="inputholder">';
			echo '<input';
			if($this->readonly)
				echo '<?php if ('.$this->value($this->readonly).') '."echo ' disabled=\"true\"' ?>";
			if (!empty($this->hint))
				echo ' placeholder="'.$this->htmlvalue($this->hint).'"';
			
			echo ' id="'.'<?php echo REQUEST_ID ?>_'.$this->htmlvalue($this->name).'"';
			
			// Output Attribute name="..."
            echo $this->outputNameAttribute();

            if($this->required)
                echo ' required="required"';
            if($this->focus)
                echo ' autofocus="autofocus"';


            echo ' type="'.$this->htmlvalue($this->type).'"';
			echo ' maxlength="'.$this->htmlvalue($this->maxlength).'"';
			echo ' class="'.$this->htmlvalue($this->class).'"';
			
			echo ' value="<?php echo Text::encodeHtml(';
			if (isset($this->default))
				echo $this->value($this->default);
			else
				echo '@$'.$this->varname($this->name);
			echo ') ?>"';
			
			echo ' />';

			if(isset($this->readonly))
			{
				echo '<?php if ('.$this->value($this->readonly).') { ?>';
				$this->outputHiddenField();
				echo '<?php } ?>';
			}
				
				
			if(isset($this->icon))
				echo '<img src="'.OR_THEMES_DIR.'default/images/icon_'.$this->htmlvalue($this->icon). IMG_ICON_EXT .'" width="16" height="16" />';
			
			echo '</div>';
		}


        if   ( $this->label )
        {
            echo '</span></label>';
        }
	}

	private function outputHiddenField()
	{
		echo '<input';
		echo ' type="hidden"';
		echo ' name="'.$this->htmlvalue($this->name).'"';

		echo ' value="<?php ';

		if(isset($this->default))
			echo $this->value($this->default);
		else
			echo '$'.$this->varname($this->name);

		echo ' ?>"';
		echo '/>';

	}
}

?>