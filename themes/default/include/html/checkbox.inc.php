<?php
	$attr_name    = !empty($$attr_name)?$$attr_name:$attr_name;
	$attr_readonly = ( $attr_readonly == 'true' );
	$attr_default  = ( $attr_default  == 'true' );
	
	if	( isset($$attr_name) )
		$checked = isset($$$attr_name)&& $$$attr_name==true;
	else
		$checked = $attr_default;
?><input type="checkbox" name="<?php echo $attr_name  ?>" <?php if ($attr_readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?> />