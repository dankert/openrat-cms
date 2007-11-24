<?php
if (isset($$attr_name))
	$attr_tmp_value = $$attr_name;
elseif ( isset($attr_default) )
	$attr_tmp_value = $attr_default;
else
	$attr_tmp_value = "";
?><input type="hidden" name="<?php echo $attr_name ?>" value="<?php echo $attr_tmp_value ?>" />