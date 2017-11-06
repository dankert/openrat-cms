<?php
	#IF-ATTR value#
	if (isset($attr_key))
		$$attr_var = $attr_value[$attr_key];
	else
		$$attr_var = $attr_value;
	#ELSE#
	if (!isset($attr_value))
		unset($$attr_var);
	#END-IF#
?>