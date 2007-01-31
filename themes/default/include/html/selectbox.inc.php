<select size="1" id="id<?php echo $attr_name ?>"  name="<?php echo $attr_name ?>" onchange="<?php echo $attr_onchange ?>" title="<?php echo $attr_title ?>" class="<?php echo $attr_class ?>"<?php
if (count($$attr_list)==1) echo ' disabled="disabled"'
?>><?php
		foreach( $$attr_list as $box_key=>$box_value )
		{
			echo '<option class="'.$attr_class.'" value="'.$box_key.'"';
			if (isset($$attr_name)&&$box_key==$$attr_name || isset($attr_default)&&$box_key == $attr_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select><?php
if (count($$attr_list)==1) echo '<input type="hidden" name="'.$attr_name.'" value="'.$box_key.'" />'
?>