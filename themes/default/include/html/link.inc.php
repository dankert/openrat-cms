<?php
	$params = array();
	#IF-ATTR var1#
		$params[$attr_var1]=$attr_value1;
	#END-IF	
	#IF-ATTR var2#
		$params[$attr_var2]=$attr_value2;
	#END-IF	
	#IF-ATTR var3#
		$params[$attr_var3]=$attr_value3;
	#END-IF	
	#IF-ATTR var4#
		$params[$attr_var4]=$attr_value4;
	#END-IF	
	#IF-ATTR var5#
		$params[$attr_var5]=$attr_value5;
	#END-IF
	
	#IF-ATTR class#
	#ELSE
		$attr_class='';
	#END-IF	
		
	#IF-ATTR title#
	#ELSE
		$attr_title = '';
	#END-IF	

	$tmp_url = '';
	
	#IF-ATTR target#
	$params[REQ_PARAM_TARGET] = $attr_target;
	#ELSE
	$attr_target = $view;
	#END-IF	
	
		//$tmp_url = Html::url($attr_action,$attr_subaction,!empty($attr_id)?$attr_id:$this->getRequestId(),$params);
		                          
	switch( $attr_type )
	{
		case 'post':
			$json = new JSON();
			$tmp_data = $json->encode( array('action'=>!empty($attr_action)?$attr_action:$this->actionName,'subaction'=>!empty($attr_subaction)?$attr_subaction:$this->subActionName,'id'=>!empty($attr_id)?$attr_id:$this->getRequestId())
		                          +array(REQ_PARAM_TOKEN=>token())
		                          +$params );
			$tmp_function_call = "submitLink(this,'".str_replace("\n",'',str_replace('"','&quot;',$tmp_data))."');";
			break;
			
		case 'view':
			$tmp_function_call = "startView(this,'".(!empty($attr_subaction)?$attr_subaction:$this->subActionName)."');";
			break;
			
		case 'url':
			$tmp_function_call = "submitUrl(this,'".($attr_url)."');";
			break;
			
		case 'external':
			$tmp_function_call = "location.href='".$attr_url."';";
			break;
			
		case 'popup':
			$tmp_function_call = "window.open('".$attr_url."', 'Popup', 'location=no,menubar=no,scrollbars=yes,toolbar=no,resizable=yes');";
			break;
			
		default:
			$tmp_function_call = "alert('Link-attribute type required');";
	}

//	if	( substr($tmp_url,0,10) != 'javascript' )
//		$tmp_url = "javascript:loadViewByName('".$attr_target."','".$tmp_url.(isset($attr_anchor)?'#'.$attr_anchor:'')."'); return false;";
	
?><a target="<?php echo $attr_frame ?>"<?php if (isset($attr_name)) { ?> name="<?php echo $attr_name ?>"<?php }else{ ?> href="javascript:void(0);" onclick="<?php echo $tmp_function_call ?>" <?php } ?> class="<?php echo $attr_class ?>"<?php if (isset($attr_accesskey)) echo ' accesskey="'.$attr_accesskey.'"' ?>  title="<?php echo encodeHtml($attr_title) ?>">