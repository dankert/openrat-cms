<?php

	#IF-ATTR prefix#
		$attr_key = $attr_prefix.$attr_key;
	#END-IF#

	#IF-ATTR suffix#
		$attr_key = $attr_key.$attr_suffix;
	#END-IF#

	#IF-ATTR title#
	#ELSE#
		$attr_title = '';
	#END-IF#

	#IF-ATTR type#
	#ELSE#
		// Attribut "type" nicht vorhanden, also Default-Tag "<span>..." verwenden.
		$tmp_tag = 'span';
	#END-IF#

	#IF-ATTR-VALUE type:emphatic#
		$tmp_tag = 'em';
	#END-IF#
	#IF-ATTR-VALUE type:italic#
		$tmp_tag = 'em';
	#END-IF#
	#IF-ATTR-VALUE type:strong#
		$tmp_tag = 'strong';
	#END-IF#
	#IF-ATTR-VALUE type:bold#
		$tmp_tag = 'strong';
	#IF-ATTR-VALUE type:tt#
		$tmp_tag = 'tt';
	#END-IF#
	#IF-ATTR-VALUE type:teletype#
		$tmp_tag = 'tt';
	#END-IF#
	#IF-ATTR-VALUE type:preformatted#
		$tmp_tag = 'pre';
	#END-IF#
	#IF-ATTR-VALUE type:code#
		$tmp_tag = 'code';
	#END-IF#

?><<?php echo $tmp_tag ?> class="<?php echo $attr_class ?>" title="<?php echo $attr_title ?>"><?php
		$langF = $attr_escape?'langHtml':'lang';

	#IF-ATTR array#
		//geht nicht:
		//echo $$attr_array[$attr_var].'%';
		$tmpArray = $$attr_array;
		if (!empty($attr_var))
			$tmp_text = $tmpArray[$attr_var];
		else
			$tmp_text = $langF($tmpArray[$attr_text]);
	#END-IF
	
	#IF-ATTR textvar#
		$tmp_text = $langF($$attr_textvar);
	#END-IF

	#IF-ATTR text#
		$tmp_text = $langF($attr_text);
	#END-IF
		
	#IF-ATTR key#
		$tmp_text = $langF($attr_key);
	#END-IF
		
	#IF-ATTR var#
		$tmp_text = isset($$attr_var)?$$attr_var:$langF('UNKNOWN');
	#END-IF
		
	#IF-ATTR raw#
		$tmp_text = str_replace('_','&nbsp;',$attr_raw);
	#END-IF
		
	#IF-ATTR value#
		$tmp_text = $attr_escape?htmlentities($attr_value):$attr_value;
	#END-IF
		
	#IF-ATTR maxlength#
		$tmp_text = Text::maxLength( $tmp_text,intval($attr_maxlength),'..',constant('STR_PAD_'.strtoupper($attr_cut)) );
	#END-IF
		
	#IF-ATTR accesskey#
		$pos = strpos(strtolower($tmp_text),strtolower($attr_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	#END-IF
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	
	unset($tmp_text);
?></<?php echo $tmp_tag ?>>