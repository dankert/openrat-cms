<?php

/**
 * 
 * @param unknown $name
 * @param unknown $values
 * @param unknown $value
 */
function component_radio_box($name, $values, $value)
{
	foreach ($values as $box_key => $box_value)
	{
		if (is_array($box_value) && isset($box_value['lang']))
		{
			$box_value = '<?php echo lang(\''.$box_value['lang'].'\') ?>';
            $box_title = '';
		}
		elseif (is_array($box_value))
		{
			$box_key = $box_value['key'];
			$box_title = $box_value['title'];
			$box_value = $box_value['value'];
		}
		else
		{
			$box_title = '';
		}
		
		$id = REQUEST_ID.'_'.$name.'_'.$box_key;
		echo '<input type="radio" id="'.$id.'" name="'.$name.'" value="' . $box_key . '" title="' . $box_title . '"';
		
		if ((string) $box_key == $value)
			echo ' checked="checked"';
		
		echo ' />&nbsp;<label for="'.$id.'">'.$box_value.'</label><br />';
	}
}

?>