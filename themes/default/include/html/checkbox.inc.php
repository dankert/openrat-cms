<?php
	if ($this->isEditable() && $this->getRequestVar('mode')!='edit') $attr_readonly=true;
	
	if	( isset($$attr_name) )
		$checked = $$attr_name;
	else
		$checked = $attr_default;
?><input type="checkbox" id="id_<?php echo $attr_name ?>" name="<?php echo $attr_name  ?>"  <?php if ($attr_readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?><?php if (in_array($attr_name,$errors)) echo ' style="background-color:red;"' ?> /><?php

if ( $attr_readonly && $checked )
{ 
?><input type="hidden" name="<?php echo $attr_name ?>" value="1" /><?php
}
?><?php unset($attr_name); unset($attr_readonly); unset($attr_default); ?>