<?php
	if (!isset($attr_value))
		unset($$attr_var);
	elseif (isset($attr_key))
		$$attr_var = $attr_value[$attr_key];
	else
		$$attr_var = $attr_value;
?>