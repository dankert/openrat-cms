<?php $attr_tmp_disabled = count($$attr_list)==1;
		$attr_tmp_list = $$attr_list;
		if	( isset($$attr_name) && isset($attr_tmp_list[$$attr_name]) )
			$attr_tmp_default = $$attr_name;
		elseif ( isset($$attr_default) )
			$attr_tmp_default = $attr_default;
		else
			$attr_tmp_default = '';
		
		foreach( $attr_tmp_list as $box_key=>$box_value )
		{
			$id = 'id_'.$attr_name.'_'.$box_key;
			echo '<input id="'.$id.'" name="'.$attr_name.'" type="radio" class="'.$attr_class.'" value="'.$box_key.'"';
			if ($box_key==$attr_tmp_default)
				echo ' checked="checked"';
			echo '>&nbsp;<label for="'.$id.'">'.$box_value.'</label><br>';
		}
?>