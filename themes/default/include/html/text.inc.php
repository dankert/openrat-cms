<?php
	if(empty($attr_title)) $attr_title = $attr_text;
?><span class="<?php echo $attr_class ?>"><?php
	if (!empty($attr_array))
	{
		//geht nicht:
		//echo $$attr_array[$attr_var].'%';
		$tmpArray = $$attr_array;
		if (!empty($attr_var))
			$tmp_text = $tmpArray[$attr_var];
		else
			$tmp_text = lang($tmpArray[$attr_text]);
	}
	elseif (!empty($attr_text))
		$tmp_text = lang($attr_text);
	elseif (!empty($attr_var))
		$tmp_text = isset($$attr_var)?$$attr_var:'error: variable '.$attr_var.' not present';	
	elseif (!empty($attr_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr_raw);
	else echo 'text error';
	
	if	( !empty($attr_maxlength) && intval($attr_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr_maxlength) );
		
	echo $tmp_text;
?></span>