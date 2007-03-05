<?php
	$attr_default  = ( $attr_default  == true );
	
	if	( isset($$attr_name) )
		$checked = $$attr_name == true;
//		$checked = isset($$$attr_name)&& $$$attr_name==true;
	else
		$checked = $attr_default == true;
?><input type="checkbox" id="id_<?php echo $attr_name  ?>" name="<?php echo $attr_name  ?>"  <?php if ($attr_readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?> /><?php unset($attr_name); unset($attr_readonly); unset($attr_default); ?>