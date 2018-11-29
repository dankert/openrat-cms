<?php

namespace template_engine\components;

class CheckboxComponent extends Component
{
	
	public $default = false;
	public $name;
	public $readonly = false;
	public $required = false;
	public $label;

	protected function begin(){

        if   ( $this->label )
            echo '<label class="or-form-row"><span class="or-form-label"></span><span class="or-form-input">';


        echo '<?php { ';
		echo '$tmpname     = '.$this->value($this->name).';';
		echo '$default  = '.$this->value($this->default).';';
		echo '$readonly = '.$this->value($this->readonly).';';
		echo '$required = '.$this->value($this->required).';';

		echo <<<'HTML'
		
		if	( isset($$tmpname) )
			$checked = $$tmpname;
		else
			$checked = $default;

		?><input class="checkbox" type="checkbox" id="<?php echo REQUEST_ID ?>_<?php echo $tmpname ?>" name="<?php echo $tmpname  ?>"  <?php if ($readonly) echo ' disabled="disabled"' ?> value="1"<?php if( $checked ) echo ' checked="checked"' ?><?php if( $required ) echo ' required="required"' ?> /><?php

		if ( $readonly && $checked )
		{ 
		?><input type="hidden" name="<?php echo $tmpname ?>" value="1" /><?php
		}
		} ?>
HTML;

        if   ( $this->label )
            echo '&nbsp;'.lang($this->label).' </span></label>';

    }
}


?>