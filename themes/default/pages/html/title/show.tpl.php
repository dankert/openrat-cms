<?php $a2_class='title'; ?><div class="<?php echo $a2_class ?>"><?php unset($a2_class) ?><?php $a3_icon='database';$a3_align='left'; ?><?php
	$a3_tmp_image_file = $image_dir.'icon_'.$a3_icon.IMG_ICON_EXT;
	$a3_size = '16x16';
	$a3_tmp_title = basename($a3_tmp_image_file);
?><img alt="<?php echo $a3_tmp_title; if (isset($a3_size)) { echo ' ('; list($a3_tmp_width,$a3_tmp_height)=explode('x',$a3_size);echo $a3_tmp_width.'x'.$a3_tmp_height; echo')';} ?>" src="<?php echo $a3_tmp_image_file ?>" border="0"<?php if(isset($a3_align)) echo ' align="'.$a3_align.'"' ?><?php if (isset($a3_size)) { list($a3_tmp_width,$a3_tmp_height)=explode('x',$a3_size);echo ' width="'.$a3_tmp_width.'" height="'.$a3_tmp_height.'"';} ?> /><?php unset($a3_icon,$a3_align) ?><?php $a3_present='dbname'; ?><?php 
	$a3_tmp_exec = isset($$a3_present);
	$a3_tmp_last_exec = $a3_tmp_exec;
	if	( $a3_tmp_exec )
	{
?>
<?php unset($a3_present) ?><?php $a4_title=lang('database');$a4_class='titletext';$a4_var='dbname';$a4_maxlength='25';$a4_escape=true;$a4_cut='both'; ?><?php
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a4_class ?>" title="<?php echo $a4_title ?>"><?php
		$langF = $a4_escape?'langHtml':'lang';
		$tmp_text = isset($$a4_var)?$$a4_var:$langF('UNKNOWN');
		$tmp_text = Text::maxLength( $tmp_text,intval($a4_maxlength),'..',constant('STR_PAD_'.strtoupper($a4_cut)) );
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a4_title,$a4_class,$a4_var,$a4_maxlength,$a4_escape,$a4_cut) ?><?php $a4_class='titletext';$a4_raw=' - ';$a4_escape=true;$a4_cut='both'; ?><?php
		$a4_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a4_class ?>" title="<?php echo $a4_title ?>"><?php
		$langF = $a4_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a4_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a4_class,$a4_raw,$a4_escape,$a4_cut) ?><?php } ?><?php $a3_title=$buildinfo;$a3_class='titletext';$a3_var='cms_title';$a3_escape=true;$a3_cut='both'; ?><?php
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a3_class ?>" title="<?php echo $a3_title ?>"><?php
		$langF = $a3_escape?'langHtml':'lang';
		$tmp_text = isset($$a3_var)?$$a3_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a3_title,$a3_class,$a3_var,$a3_escape,$a3_cut) ?></div><?php $a2_class='search'; ?><div class="<?php echo $a2_class ?>"><?php unset($a2_class) ?><?php $a3_class='text';$a3_default='';$a3_type='text';$a3_name='text';$a3_size='';$a3_maxlength='256';$a3_onchange='';$a3_readonly=false;$a3_hint=lang('search');$a3_icon='search'; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a3_readonly=true;
	  if ($a3_readonly && empty($$a3_name)) $$a3_name = '- '.lang('EMPTY').' -';
      if(!isset($a3_default)) $a3_default='';
      $tmp_value = Text::encodeHtml(isset($$a3_name)?$$a3_name:$a3_default);
?><?php if (!$a3_readonly || $a3_type=='hidden') {
?><div class="inputholder"><input<?php if ($a3_readonly) echo ' disabled="true"' ?><?php if ($a3_hint) echo ' data-hint="'.$a3_hint.'"'; ?> id="id_<?php echo $a3_name ?><?php if ($a3_readonly) echo '_disabled' ?>" name="<?php echo $a3_name ?><?php if ($a3_readonly) echo '_disabled' ?>" type="<?php echo $a3_type ?>" maxlength="<?php echo $a3_maxlength ?>" class="<?php echo str_replace(',',' ',$a3_class) ?>" value="<?php echo $tmp_value ?>" <?php if (in_array($a3_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php if ($a3_icon) echo '<img class="icon" src="'.$image_dir.'icon_'.$a3_icon.IMG_ICON_EXT.'" width="16" height="16" />'; ?></div><?php
if	($a3_readonly) {
?><input type="hidden" id="id_<?php echo $a3_name ?>" name="<?php echo $a3_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subactionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a3_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a3_class,$a3_default,$a3_type,$a3_name,$a3_size,$a3_maxlength,$a3_onchange,$a3_readonly,$a3_hint,$a3_icon) ?><?php $a3_class='dropdown'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?><?php $a4_class='text';$a4_raw='';$a4_escape=true;$a4_cut='both'; ?><?php
		$a4_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a4_class ?>" title="<?php echo $a4_title ?>"><?php
		$langF = $a4_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a4_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a4_class,$a4_raw,$a4_escape,$a4_cut) ?></div></div><?php $a2_class='user'; ?><div class="<?php echo $a2_class ?>"><?php unset($a2_class) ?><?php $a3_icon='user';$a3_align='left'; ?><?php
	$a3_tmp_image_file = $image_dir.'icon_'.$a3_icon.IMG_ICON_EXT;
	$a3_size = '16x16';
	$a3_tmp_title = basename($a3_tmp_image_file);
?><img alt="<?php echo $a3_tmp_title; if (isset($a3_size)) { echo ' ('; list($a3_tmp_width,$a3_tmp_height)=explode('x',$a3_size);echo $a3_tmp_width.'x'.$a3_tmp_height; echo')';} ?>" src="<?php echo $a3_tmp_image_file ?>" border="0"<?php if(isset($a3_align)) echo ' align="'.$a3_align.'"' ?><?php if (isset($a3_size)) { list($a3_tmp_width,$a3_tmp_height)=explode('x',$a3_size);echo ' width="'.$a3_tmp_width.'" height="'.$a3_tmp_height.'"';} ?> /><?php unset($a3_icon,$a3_align) ?><?php $a3_class='titletext';$a3_var='userfullname';$a3_maxlength='25';$a3_escape=true;$a3_cut='both'; ?><?php
		$a3_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a3_class ?>" title="<?php echo $a3_title ?>"><?php
		$langF = $a3_escape?'langHtml':'lang';
		$tmp_text = isset($$a3_var)?$$a3_var:$langF('UNKNOWN');
		$tmp_text = Text::maxLength( $tmp_text,intval($a3_maxlength),'..',constant('STR_PAD_'.strtoupper($a3_cut)) );
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a3_class,$a3_var,$a3_maxlength,$a3_escape,$a3_cut) ?><?php $a3_class='dropdown'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?><?php $a4_title=lang('USER_PROFILE_DESC');$a4_type='post';$a4_class='';$a4_action='start';$a4_subaction='profile';$a4_frame='_self';$a4_modal=false; ?><?php
	$params = array();
	$tmp_url = '';
	$a4_target = $view;
	switch( $a4_type )
	{
		case 'post':
			$json = new JSON();
			$tmp_data = $json->encode( array('action'=>!empty($a4_action)?$a4_action:$this->actionName,'subaction'=>!empty($a4_subaction)?$a4_subaction:$this->subActionName,'id'=>!empty($a4_id)?$a4_id:$this->getRequestId())
		                          +array(REQ_PARAM_TOKEN=>token())
		                          +$params );
			$tmp_function_call = "submitLink(this,'".str_replace("\n",'',str_replace('"','&quot;',$tmp_data))."');";
			break;
		case 'view':
			$tmp_function_call = "startView(this,'".(!empty($a4_subaction)?$a4_subaction:$this->subActionName)."');";
			break;
		case 'modal':
			$tmp_function_call = "modalView(this,'".(!empty($a4_subaction)?$a4_subaction:$this->subActionName)."');";
			break;
			case 'url':
			$tmp_function_call = "submitUrl(this,'".($a4_url)."');";
			break;
		case 'external':
			$tmp_function_call = "location.href='".$a4_url."';";
			break;
		case 'popup':
			$tmp_function_call = "window.open('".$a4_url."', 'Popup', 'location=no,menubar=no,scrollbars=yes,toolbar=no,resizable=yes');";
			break;
		default:
			$tmp_function_call = "alert('Link-attribute type required');";
	}
?><a target="<?php echo $a4_frame ?>"<?php if (isset($a4_name)) { ?> name="<?php echo $a4_name ?>"<?php }else{ ?> href="javascript:void(0);" onclick="<?php echo $tmp_function_call ?>" <?php } ?> class="<?php echo $a4_class ?>"<?php if (isset($a4_accesskey)) echo ' accesskey="'.$a4_accesskey.'"' ?>  title="<?php echo encodeHtml($a4_title) ?>"><?php unset($a4_title,$a4_type,$a4_class,$a4_action,$a4_subaction,$a4_frame,$a4_modal) ?><?php $a5_icon='user';$a5_align='left'; ?><?php
	$a5_tmp_image_file = $image_dir.'icon_'.$a5_icon.IMG_ICON_EXT;
	$a5_size = '16x16';
	$a5_tmp_title = basename($a5_tmp_image_file);
?><img alt="<?php echo $a5_tmp_title; if (isset($a5_size)) { echo ' ('; list($a5_tmp_width,$a5_tmp_height)=explode('x',$a5_size);echo $a5_tmp_width.'x'.$a5_tmp_height; echo')';} ?>" src="<?php echo $a5_tmp_image_file ?>" border="0"<?php if(isset($a5_align)) echo ' align="'.$a5_align.'"' ?><?php if (isset($a5_size)) { list($a5_tmp_width,$a5_tmp_height)=explode('x',$a5_size);echo ' width="'.$a5_tmp_width.'" height="'.$a5_tmp_height.'"';} ?> /><?php unset($a5_icon,$a5_align) ?><?php $a5_class='text';$a5_key='profile';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = $langF($a5_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_key,$a5_escape,$a5_cut) ?></a><?php $a4_title=lang('start');$a4_type='post';$a4_class='';$a4_action='start';$a4_subaction='start';$a4_frame='_self';$a4_modal=false; ?><?php
	$params = array();
	$tmp_url = '';
	$a4_target = $view;
	switch( $a4_type )
	{
		case 'post':
			$json = new JSON();
			$tmp_data = $json->encode( array('action'=>!empty($a4_action)?$a4_action:$this->actionName,'subaction'=>!empty($a4_subaction)?$a4_subaction:$this->subActionName,'id'=>!empty($a4_id)?$a4_id:$this->getRequestId())
		                          +array(REQ_PARAM_TOKEN=>token())
		                          +$params );
			$tmp_function_call = "submitLink(this,'".str_replace("\n",'',str_replace('"','&quot;',$tmp_data))."');";
			break;
		case 'view':
			$tmp_function_call = "startView(this,'".(!empty($a4_subaction)?$a4_subaction:$this->subActionName)."');";
			break;
		case 'modal':
			$tmp_function_call = "modalView(this,'".(!empty($a4_subaction)?$a4_subaction:$this->subActionName)."');";
			break;
			case 'url':
			$tmp_function_call = "submitUrl(this,'".($a4_url)."');";
			break;
		case 'external':
			$tmp_function_call = "location.href='".$a4_url."';";
			break;
		case 'popup':
			$tmp_function_call = "window.open('".$a4_url."', 'Popup', 'location=no,menubar=no,scrollbars=yes,toolbar=no,resizable=yes');";
			break;
		default:
			$tmp_function_call = "alert('Link-attribute type required');";
	}
?><a target="<?php echo $a4_frame ?>"<?php if (isset($a4_name)) { ?> name="<?php echo $a4_name ?>"<?php }else{ ?> href="javascript:void(0);" onclick="<?php echo $tmp_function_call ?>" <?php } ?> class="<?php echo $a4_class ?>"<?php if (isset($a4_accesskey)) echo ' accesskey="'.$a4_accesskey.'"' ?>  title="<?php echo encodeHtml($a4_title) ?>"><?php unset($a4_title,$a4_type,$a4_class,$a4_action,$a4_subaction,$a4_frame,$a4_modal) ?><?php $a5_icon='start';$a5_align='left'; ?><?php
	$a5_tmp_image_file = $image_dir.'icon_'.$a5_icon.IMG_ICON_EXT;
	$a5_size = '16x16';
	$a5_tmp_title = basename($a5_tmp_image_file);
?><img alt="<?php echo $a5_tmp_title; if (isset($a5_size)) { echo ' ('; list($a5_tmp_width,$a5_tmp_height)=explode('x',$a5_size);echo $a5_tmp_width.'x'.$a5_tmp_height; echo')';} ?>" src="<?php echo $a5_tmp_image_file ?>" border="0"<?php if(isset($a5_align)) echo ' align="'.$a5_align.'"' ?><?php if (isset($a5_size)) { list($a5_tmp_width,$a5_tmp_height)=explode('x',$a5_size);echo ' width="'.$a5_tmp_width.'" height="'.$a5_tmp_height.'"';} ?> /><?php unset($a5_icon,$a5_align) ?><?php $a5_class='text';$a5_key='start';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = $langF($a5_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_key,$a5_escape,$a5_cut) ?></a><?php $a4_true=$this->userIsAdmin(); ?><?php 
	if	(gettype($a4_true) === '' && gettype($a4_true) === '1')
		$a4_tmp_exec = $$a4_true == true;
	else
		$a4_tmp_exec = $a4_true == true;
	$a4_tmp_last_exec = $a4_tmp_exec;
	if	( $a4_tmp_exec )
	{
?>
<?php unset($a4_true) ?><?php $a5_title='';$a5_type='post';$a5_target='tree';$a5_class='entry';$a5_action='start';$a5_subaction='administration';$a5_id='-1';$a5_frame='_self';$a5_modal=false; ?><?php
	$params = array();
	$tmp_url = '';
	$params[REQ_PARAM_TARGET] = $a5_target;
	switch( $a5_type )
	{
		case 'post':
			$json = new JSON();
			$tmp_data = $json->encode( array('action'=>!empty($a5_action)?$a5_action:$this->actionName,'subaction'=>!empty($a5_subaction)?$a5_subaction:$this->subActionName,'id'=>!empty($a5_id)?$a5_id:$this->getRequestId())
		                          +array(REQ_PARAM_TOKEN=>token())
		                          +$params );
			$tmp_function_call = "submitLink(this,'".str_replace("\n",'',str_replace('"','&quot;',$tmp_data))."');";
			break;
		case 'view':
			$tmp_function_call = "startView(this,'".(!empty($a5_subaction)?$a5_subaction:$this->subActionName)."');";
			break;
		case 'modal':
			$tmp_function_call = "modalView(this,'".(!empty($a5_subaction)?$a5_subaction:$this->subActionName)."');";
			break;
			case 'url':
			$tmp_function_call = "submitUrl(this,'".($a5_url)."');";
			break;
		case 'external':
			$tmp_function_call = "location.href='".$a5_url."';";
			break;
		case 'popup':
			$tmp_function_call = "window.open('".$a5_url."', 'Popup', 'location=no,menubar=no,scrollbars=yes,toolbar=no,resizable=yes');";
			break;
		default:
			$tmp_function_call = "alert('Link-attribute type required');";
	}
?><a target="<?php echo $a5_frame ?>"<?php if (isset($a5_name)) { ?> name="<?php echo $a5_name ?>"<?php }else{ ?> href="javascript:void(0);" onclick="<?php echo $tmp_function_call ?>" <?php } ?> class="<?php echo $a5_class ?>"<?php if (isset($a5_accesskey)) echo ' accesskey="'.$a5_accesskey.'"' ?>  title="<?php echo encodeHtml($a5_title) ?>"><?php unset($a5_title,$a5_type,$a5_target,$a5_class,$a5_action,$a5_subaction,$a5_id,$a5_frame,$a5_modal) ?><?php $a6_icon='administration';$a6_align='left'; ?><?php
	$a6_tmp_image_file = $image_dir.'icon_'.$a6_icon.IMG_ICON_EXT;
	$a6_size = '16x16';
	$a6_tmp_title = basename($a6_tmp_image_file);
?><img alt="<?php echo $a6_tmp_title; if (isset($a6_size)) { echo ' ('; list($a6_tmp_width,$a6_tmp_height)=explode('x',$a6_size);echo $a6_tmp_width.'x'.$a6_tmp_height; echo')';} ?>" src="<?php echo $a6_tmp_image_file ?>" border="0"<?php if(isset($a6_align)) echo ' align="'.$a6_align.'"' ?><?php if (isset($a6_size)) { list($a6_tmp_width,$a6_tmp_height)=explode('x',$a6_size);echo ' width="'.$a6_tmp_width.'" height="'.$a6_tmp_height.'"';} ?> /><?php unset($a6_icon,$a6_align) ?><?php $a6_class='text';$a6_key='administration';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_key,$a6_escape,$a6_cut) ?></a><?php } ?><?php $a4_title=lang('USER_LOGOUT_DESC');$a4_type='post';$a4_class='entry';$a4_action='login';$a4_subaction='logout';$a4_frame='_self';$a4_modal=false; ?><?php
	$params = array();
	$tmp_url = '';
	$a4_target = $view;
	switch( $a4_type )
	{
		case 'post':
			$json = new JSON();
			$tmp_data = $json->encode( array('action'=>!empty($a4_action)?$a4_action:$this->actionName,'subaction'=>!empty($a4_subaction)?$a4_subaction:$this->subActionName,'id'=>!empty($a4_id)?$a4_id:$this->getRequestId())
		                          +array(REQ_PARAM_TOKEN=>token())
		                          +$params );
			$tmp_function_call = "submitLink(this,'".str_replace("\n",'',str_replace('"','&quot;',$tmp_data))."');";
			break;
		case 'view':
			$tmp_function_call = "startView(this,'".(!empty($a4_subaction)?$a4_subaction:$this->subActionName)."');";
			break;
		case 'modal':
			$tmp_function_call = "modalView(this,'".(!empty($a4_subaction)?$a4_subaction:$this->subActionName)."');";
			break;
			case 'url':
			$tmp_function_call = "submitUrl(this,'".($a4_url)."');";
			break;
		case 'external':
			$tmp_function_call = "location.href='".$a4_url."';";
			break;
		case 'popup':
			$tmp_function_call = "window.open('".$a4_url."', 'Popup', 'location=no,menubar=no,scrollbars=yes,toolbar=no,resizable=yes');";
			break;
		default:
			$tmp_function_call = "alert('Link-attribute type required');";
	}
?><a target="<?php echo $a4_frame ?>"<?php if (isset($a4_name)) { ?> name="<?php echo $a4_name ?>"<?php }else{ ?> href="javascript:void(0);" onclick="<?php echo $tmp_function_call ?>" <?php } ?> class="<?php echo $a4_class ?>"<?php if (isset($a4_accesskey)) echo ' accesskey="'.$a4_accesskey.'"' ?>  title="<?php echo encodeHtml($a4_title) ?>"><?php unset($a4_title,$a4_type,$a4_class,$a4_action,$a4_subaction,$a4_frame,$a4_modal) ?><?php $a5_icon='close';$a5_align='left'; ?><?php
	$a5_tmp_image_file = $image_dir.'icon_'.$a5_icon.IMG_ICON_EXT;
	$a5_size = '16x16';
	$a5_tmp_title = basename($a5_tmp_image_file);
?><img alt="<?php echo $a5_tmp_title; if (isset($a5_size)) { echo ' ('; list($a5_tmp_width,$a5_tmp_height)=explode('x',$a5_size);echo $a5_tmp_width.'x'.$a5_tmp_height; echo')';} ?>" src="<?php echo $a5_tmp_image_file ?>" border="0"<?php if(isset($a5_align)) echo ' align="'.$a5_align.'"' ?><?php if (isset($a5_size)) { list($a5_tmp_width,$a5_tmp_height)=explode('x',$a5_size);echo ' width="'.$a5_tmp_width.'" height="'.$a5_tmp_height.'"';} ?> /><?php unset($a5_icon,$a5_align) ?><?php $a5_class='text';$a5_key='USER_LOGOUT';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = $langF($a5_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_key,$a5_escape,$a5_cut) ?></a></div></div><?php $a2_class='projects'; ?><div class="<?php echo $a2_class ?>"><?php unset($a2_class) ?><?php $a3_icon='project';$a3_align='left'; ?><?php
	$a3_tmp_image_file = $image_dir.'icon_'.$a3_icon.IMG_ICON_EXT;
	$a3_size = '16x16';
	$a3_tmp_title = basename($a3_tmp_image_file);
?><img alt="<?php echo $a3_tmp_title; if (isset($a3_size)) { echo ' ('; list($a3_tmp_width,$a3_tmp_height)=explode('x',$a3_size);echo $a3_tmp_width.'x'.$a3_tmp_height; echo')';} ?>" src="<?php echo $a3_tmp_image_file ?>" border="0"<?php if(isset($a3_align)) echo ' align="'.$a3_align.'"' ?><?php if (isset($a3_size)) { list($a3_tmp_width,$a3_tmp_height)=explode('x',$a3_size);echo ' width="'.$a3_tmp_width.'" height="'.$a3_tmp_height.'"';} ?> /><?php unset($a3_icon,$a3_align) ?><?php $a3_class='titletext';$a3_key='GLOBAL_CHANGE_TO';$a3_escape=true;$a3_cut='both'; ?><?php
		$a3_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a3_class ?>" title="<?php echo $a3_title ?>"><?php
		$langF = $a3_escape?'langHtml':'lang';
		$tmp_text = $langF($a3_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a3_class,$a3_key,$a3_escape,$a3_cut) ?><?php $a3_class='dropdown'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?><?php $a4_list='projects';$a4_extract=false;$a4_key='id';$a4_value='name'; ?><?php
	$a4_list_tmp_key   = $a4_key;
	$a4_list_tmp_value = $a4_value;
	$a4_list_extract   = $a4_extract;
	unset($a4_key);
	unset($a4_value);
	if	( !isset($$a4_list) || !is_array($$a4_list) )
		$$a4_list = array();
	foreach( $$a4_list as $$a4_list_tmp_key => $$a4_list_tmp_value )
	{
		if	( $a4_list_extract )
		{
			if	( !is_array($$a4_list_tmp_value) )
			{
				print_r($$a4_list_tmp_value);
				die( 'not an array at key: '.$$a4_list_tmp_key );
			}
			extract($$a4_list_tmp_value);
		}
?><?php unset($a4_list,$a4_extract,$a4_key,$a4_value) ?><?php $a5_icon='project';$a5_align='left'; ?><?php
	$a5_tmp_image_file = $image_dir.'icon_'.$a5_icon.IMG_ICON_EXT;
	$a5_size = '16x16';
	$a5_tmp_title = basename($a5_tmp_image_file);
?><img alt="<?php echo $a5_tmp_title; if (isset($a5_size)) { echo ' ('; list($a5_tmp_width,$a5_tmp_height)=explode('x',$a5_size);echo $a5_tmp_width.'x'.$a5_tmp_height; echo')';} ?>" src="<?php echo $a5_tmp_image_file ?>" border="0"<?php if(isset($a5_align)) echo ' align="'.$a5_align.'"' ?><?php if (isset($a5_size)) { list($a5_tmp_width,$a5_tmp_height)=explode('x',$a5_size);echo ' width="'.$a5_tmp_width.'" height="'.$a5_tmp_height.'"';} ?> /><?php unset($a5_icon,$a5_align) ?><?php $a5_title='';$a5_type='post';$a5_class='entry';$a5_action='start';$a5_subaction='projectmenu';$a5_id=$id;$a5_frame='_self';$a5_modal=false; ?><?php
	$params = array();
	$tmp_url = '';
	$a5_target = $view;
	switch( $a5_type )
	{
		case 'post':
			$json = new JSON();
			$tmp_data = $json->encode( array('action'=>!empty($a5_action)?$a5_action:$this->actionName,'subaction'=>!empty($a5_subaction)?$a5_subaction:$this->subActionName,'id'=>!empty($a5_id)?$a5_id:$this->getRequestId())
		                          +array(REQ_PARAM_TOKEN=>token())
		                          +$params );
			$tmp_function_call = "submitLink(this,'".str_replace("\n",'',str_replace('"','&quot;',$tmp_data))."');";
			break;
		case 'view':
			$tmp_function_call = "startView(this,'".(!empty($a5_subaction)?$a5_subaction:$this->subActionName)."');";
			break;
		case 'modal':
			$tmp_function_call = "modalView(this,'".(!empty($a5_subaction)?$a5_subaction:$this->subActionName)."');";
			break;
			case 'url':
			$tmp_function_call = "submitUrl(this,'".($a5_url)."');";
			break;
		case 'external':
			$tmp_function_call = "location.href='".$a5_url."';";
			break;
		case 'popup':
			$tmp_function_call = "window.open('".$a5_url."', 'Popup', 'location=no,menubar=no,scrollbars=yes,toolbar=no,resizable=yes');";
			break;
		default:
			$tmp_function_call = "alert('Link-attribute type required');";
	}
?><a target="<?php echo $a5_frame ?>"<?php if (isset($a5_name)) { ?> name="<?php echo $a5_name ?>"<?php }else{ ?> href="javascript:void(0);" onclick="<?php echo $tmp_function_call ?>" <?php } ?> class="<?php echo $a5_class ?>"<?php if (isset($a5_accesskey)) echo ' accesskey="'.$a5_accesskey.'"' ?>  title="<?php echo encodeHtml($a5_title) ?>"><?php unset($a5_title,$a5_type,$a5_class,$a5_action,$a5_subaction,$a5_id,$a5_frame,$a5_modal) ?><?php $a6_class='text';$a6_var='name';$a6_maxlength='45';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = isset($$a6_var)?$$a6_var:$langF('UNKNOWN');
		$tmp_text = Text::maxLength( $tmp_text,intval($a6_maxlength),'..',constant('STR_PAD_'.strtoupper($a6_cut)) );
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_var,$a6_maxlength,$a6_escape,$a6_cut) ?></a><?php } ?></div></div>