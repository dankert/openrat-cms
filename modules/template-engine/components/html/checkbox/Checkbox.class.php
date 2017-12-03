<?php

namespace template_engine\components;

class CheckboxComponent extends Component
{
	
	public $default = false;
	public $name;
	public $readonly = false;
	
	protected function begin(){
	
		echo '<?php { ';
		echo '$tmpname     = '.$this->value($this->name).';';
		echo '$default  = '.$this->value($this->default).';';
		echo '$readonly = '.$this->value($this->readonly).';';

		echo <<<'HTML'
		
		if	( isset($$tmpname) )
			$checked = $$tmpname;
		else
			$checked = $default;

		?><input class="checkbox" type="checkbox" id="<?php echo REQUEST_ID ?>_<?php echo $tmpname ?>" name="<?php echo $tmpname  ?>"  <?php if ($readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?> /><?php

		if ( $readonly && $checked )
		{ 
		?><input type="hidden" name="<?php echo $tmpname ?>" value="1" /><?php
		}
		} ?>
HTML;
	}
}


?>