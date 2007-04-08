<?php
	if	( isset($$attr_name) )
		$checked = $$attr_name;
	else
		$checked = $attr_default;
?><input type="checkbox" id="id_<?php echo $attr_name ?>" name="<?php echo $attr_name  ?>"  <?php if ($attr_readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?> /><?php unset($attr_name); unset($attr_readonly); unset($attr_default); ?>