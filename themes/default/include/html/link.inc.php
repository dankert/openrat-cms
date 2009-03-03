<?php
	$params = array();
	if (!empty($attr_var1) && isset($attr_value1))
		$params[$attr_var1]=$attr_value1;
	if (!empty($attr_var2) && isset($attr_value2))
		$params[$attr_var2]=$attr_value2;
	if (!empty($attr_var3) && isset($attr_value3))
		$params[$attr_var3]=$attr_value3;
	if (!empty($attr_var4) && isset($attr_value4))
		$params[$attr_var4]=$attr_value4;
	if (!empty($attr_var5) && isset($attr_value5))
		$params[$attr_var5]=$attr_value5;
	
	if(empty($attr_class))
		$attr_class='';
	if(empty($attr_title))
		$attr_title = '';
	if(!empty($attr_url))
		$tmp_url = $attr_url;
	else
		$tmp_url = Html::url($attr_action,$attr_subaction,!empty($attr_id)?$attr_id:$this->getRequestId(),$params);

	
?><a<?php if (isset($attr_name)) echo ' name="'.$attr_name.'"'; else echo ' href="'.$tmp_url.($attr_anchor?'#'.$attr_anchor:'').'"' ?> class="<?php echo $attr_class ?>" target="<?php echo $attr_target ?>"<?php if (isset($attr_accesskey)) echo ' accesskey="'.$attr_accesskey.'"' ?>  title="<?php echo encodeHtml($attr_title) ?>">