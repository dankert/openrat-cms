<?php
	if	( isset($attr_prefix)&& isset($attr_key))
		$attr_key = $attr_prefix.$attr_key;
	if	( isset($attr_suffix)&& isset($attr_key))
		$attr_key = $attr_key.$attr_suffix;
		
	if(empty($attr_title))
//		if (!empty($attr_key))
//			$attr_title = lang($attr_key.'_HELP');
//		else
			$attr_title = '';
	if	(empty($attr_type))
		$tmp_tag = 'span';
	else
		switch( $attr_type )
		{
			case 'emphatic':
			case 'italic':
				$tmp_tag = 'em';
				break;
			case 'strong':
			case 'bold':
				$tmp_tag = 'strong';
				break;
			case 'tt':
			case 'teletype':
				$tmp_tag = 'tt';
				break;
			case 'preformatted';
				$tmp_tag = 'pre';
				break;
			case 'code';
				$tmp_tag = 'code';
				break;
			default:
				$tmp_tag = 'span';
		}

?><<?php echo $tmp_tag ?> class="<?php echo $attr_class ?>" title="<?php echo $attr_title ?>"><?php
	$attr_title = '';
	if	( $attr_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	
	if (!empty($attr_array))
	{
		//geht nicht:
		//echo $$attr_array[$attr_var].'%';
		$tmpArray = $$attr_array;
		if (!empty($attr_var))
			$tmp_text = $tmpArray[$attr_var];
		else
			$tmp_text = $langF($tmpArray[$attr_text]);
	}
	elseif (!empty($attr_text))
		$tmp_text = $langF($attr_text);
	elseif (!empty($attr_textvar))
		$tmp_text = $langF($$attr_textvar);
	elseif (!empty($attr_key))
		$tmp_text = $langF($attr_key);
	elseif (!empty($attr_var))
		$tmp_text = isset($$attr_var)?$$attr_var:'?unset:'.$attr_var.'?';	
	elseif (!empty($attr_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr_raw);
	elseif (!empty($attr_value))
		$tmp_text = $attr_value;
	else
	  $tmp_text = '&nbsp;';
	
//	if	( $attr_escape && empty($attr_raw) && $tmp_text!='&nbsp;' )
//	{
//		$tmp_text = htmlentities($tmp_text,ENT_QUOTES,lang('CHARSET') );
//	}
		
	if	( !empty($attr_maxlength) && intval($attr_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr_maxlength) );

	if	(isset($attr_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
			
	echo $tmp_text;
	
	unset($tmp_text);
?></<?php echo $tmp_tag ?>>