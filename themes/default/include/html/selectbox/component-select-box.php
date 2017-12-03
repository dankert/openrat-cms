<?php

/**
 * Create Option List for a HTML select box.
 * @param unknown $values
 * @param unknown $value
 * @param unknown $addEmptyOption
 * @param unknown $valuesAreLanguageKeys
 */
function component_select_option_list($values, $value, $addEmptyOption, $valuesAreLanguageKeys)
{
	if ($addEmptyOption)
		$values = array(
			'' => lang('LIST_ENTRY_EMPTY')
		) + $values;
	
	foreach ($values as $box_key => $box_value)
	{
		if (is_array($box_value))
		{
			$box_key = $box_value['key'];
			$box_title = $box_value['title'];
			$box_value = $box_value['value'];
		}
		elseif ($valuesAreLanguageKeys)
		{
			$box_title = lang($box_value . '_DESC');
			$box_value = lang($box_value);
		}
		else
		{
			$box_title = '';
		}
		echo '<option value="' . $box_key . '" title="' . $box_title . '"';
		
		if ((string) $box_key == $value)
			echo ' selected="selected"';
		
		echo '>' . $box_value . '</option>';
	}
}

?>