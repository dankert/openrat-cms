<?php
//--
	$attr_list_tmp_key   = $attr_key;
	$attr_list_tmp_value = $attr_value;
	$attr_list_extract   = $attr_extract;
	unset($attr_key);
	unset($attr_value);

	if	( !isset($$attr_list) || !is_array($$attr_list) )
		$$attr_list = array();
	
	foreach( $$attr_list as $$attr_list_tmp_key => $$attr_list_tmp_value )
	{
		if	( $attr_list_extract )
		{
			if	( !is_array($$attr_list_tmp_value) )
			{
				print_r($$attr_list_tmp_value);
				die( 'not an array at key: '.$$attr_list_tmp_key );
			}
			extract($$attr_list_tmp_value);
		}
		
	/* Diese Zeile wird ignoriert */ }
?>