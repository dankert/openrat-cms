<?php
	if(empty($attr_title)) $attr_title = $attr_text;
?><span class="<?php echo $attr_class ?>"><?php
	if (!empty($attr_url))
		echo "<a href=\"".$$attr_url."\" title=\"$attr_title\">";
	if (!empty($attr_array))
	{
		//geht nicht:
		//echo $$attr_array[$attr_var].'%';
		$tmpArray = $$attr_array;
		if (!empty($attr_var))
			echo $tmpArray[$attr_var];
		else
			echo lang($tmpArray[$attr_text]);
	}
	elseif (!empty($attr_text))
		echo lang($attr_text);
	elseif (!empty($attr_var))
		echo $$attr_var;	
	elseif (!empty($attr_raw))
		echo str_replace('_',' ',$attr_raw);
	else echo 'text error';
	
	if (!empty($attr_url))
		echo '</a';
?></span>