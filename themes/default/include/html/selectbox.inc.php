<select size="1" id="id_<?php echo $attr_name ?>"  name="<?php echo $attr_name ?>" onchange="<?php echo $attr_onchange ?>" title="<?php echo $attr_title ?>" class="<?php echo $attr_class ?>"<?php
if (count($$attr_list)==1) echo ' disabled="disabled"'
?>><?php
		$attr_tmp_list = $$attr_list;
		if	( isset($$attr_name) && isset($attr_tmp_list[$$attr_name]) )
			$attr_tmp_default = $$attr_name;
		elseif ( isset($$attr_default) )
			$attr_tmp_default = $attr_default;
		else
			$attr_tmp_default = '';
		
		foreach( $attr_tmp_list as $box_key=>$box_value )
		{
			echo '<option class="'.$attr_class.'" value="'.$box_key.'"';
			if ($box_key==$attr_tmp_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select><?php
if (count($$attr_list)==1) echo '<input type="hidden" name="'.$attr_name.'" value="'.$box_key.'" />'
?>