<?php $a2_name='';$a2_views='el';$a2_back=false; ?><div class="header">
  <?php if ($a2_back) { ?>
  <a href="javascript:void(0);" onclick="javascript:refreshActualView(this);" class="back button">
    <img src="<?php  echo $image_dir ?>icon/window/back.gif" />
    <?php echo lang('BACK') ?>
  </a>
  <?php } ?><?php if(!empty($a2_views)) { ?>
  <img src="<?php  echo $image_dir ?>icon/window/down.gif" />
  <div class="headermenu">
    <?php foreach( explode(',',$a2_views) as $a2_tmp_view ) { ?>
	<a class="entry" href="javascript:void(0);" onclick="javascript:startView(this,'<?php echo $a2_tmp_view ?>');">
	  <img src="<?php  echo $image_dir ?>icon/<?php echo $a2_tmp_view ?>.png" /><?php echo lang('MENU_'.$a2_tmp_view) ?>
	</a>
    <?php } ?>
  </div>
<?php } ?>
</div><?php unset($a2_name,$a2_views,$a2_back) ?><?php $a2_title=lang('menu_page_show'); ?><fieldset><?php if(isset($a2_title)) { ?><legend><?php if(isset($a2_icon)) { ?><img src="<?php echo $image_dir.'icon_'.$a2_icon.IMG_ICON_EXT ?>" align="left" border="0" /><?php } ?>&nbsp;&nbsp;<?php echo encodeHtml($a2_title) ?>&nbsp;&nbsp;</legend><?php } ?><?php unset($a2_title) ?><div><?php $a4_inline=false;$a4_url=$preview_url;$a4_name='preview'; ?><iframe name="<?php echo $a4_name ?>" src="<?php echo $a4_url ?>"></iframe>
<?php unset($a4_inline,$a4_url,$a4_name) ?></div></fieldset><?php $a2_title='';$a2_type='';$a2_target='preview';$a2_class='action';$a2_action='page';$a2_subaction='preview';$a2_frame='_self'; ?><?php
	$params = array();
	$tmp_url = '';
	$params[REQ_PARAM_TARGET] = $a2_target;
	switch( $a2_type )
	{
		case 'post':
			$json = new JSON();
			$tmp_data = $json->encode( array('action'=>!empty($a2_action)?$a2_action:$this->actionName,'subaction'=>!empty($a2_subaction)?$a2_subaction:$this->subActionName,'id'=>!empty($a2_id)?$a2_id:$this->getRequestId())
		                          +array(REQ_PARAM_TOKEN=>token())
		                          +$params );
			$tmp_function_call = "submitLink(this,'".str_replace("\n",'',str_replace('"','&quot;',$tmp_data))."');";
			break;
		case 'view':
			$tmp_function_call = "startView(this,'".(!empty($a2_subaction)?$a2_subaction:$this->subActionName)."');";
			break;
		case 'url':
			$tmp_function_call = "submitUrl(this,'".($a2_url)."');";
			break;
		case 'external':
			$tmp_function_call = "location.href='".$a2_url."';";
			break;
		case 'popup':
			$tmp_function_call = "window.open('".$a2_url."', 'Popup', 'location=no,menubar=no,scrollbars=yes,toolbar=no,resizable=yes');";
			break;
		default:
			$tmp_function_call = "alert('TODO');";
	}
?><a target="<?php echo $a2_frame ?>"<?php if (isset($a2_name)) { ?> name="<?php echo $a2_name ?>"<?php }else{ ?> href="javascript:void(0);" onclick="<?php echo $tmp_function_call ?>" <?php } ?> class="<?php echo $a2_class ?>"<?php if (isset($a2_accesskey)) echo ' accesskey="'.$a2_accesskey.'"' ?>  title="<?php echo encodeHtml($a2_title) ?>"><?php unset($a2_title,$a2_type,$a2_target,$a2_class,$a2_action,$a2_subaction,$a2_frame) ?><?php $a3_icon='show';$a3_align='left'; ?><?php
	$a3_tmp_image_file = $image_dir.'icon_'.$a3_icon.IMG_ICON_EXT;
	$a3_size = '16x16';
	$a3_tmp_title = basename($a3_tmp_image_file);
?><img alt="<?php echo $a3_tmp_title; if (isset($a3_size)) { echo ' ('; list($a3_tmp_width,$a3_tmp_height)=explode('x',$a3_size);echo $a3_tmp_width.'x'.$a3_tmp_height; echo')';} ?>" src="<?php echo $a3_tmp_image_file ?>" border="0"<?php if(isset($a3_align)) echo ' align="'.$a3_align.'"' ?><?php if (isset($a3_size)) { list($a3_tmp_width,$a3_tmp_height)=explode('x',$a3_size);echo ' width="'.$a3_tmp_width.'" height="'.$a3_tmp_height.'"';} ?> /><?php unset($a3_icon,$a3_align) ?><?php $a3_class='text';$a3_key='menu_page_show';$a3_escape=true;$a3_cut='both'; ?><?php
		$a3_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a3_class ?>" title="<?php echo $a3_title ?>"><?php
		$langF = $a3_escape?'langHtml':'lang';
		$tmp_text = $langF($a3_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a3_class,$a3_key,$a3_escape,$a3_cut) ?></a><?php $a2_title='';$a2_type='';$a2_target='preview';$a2_class='action';$a2_action='page';$a2_subaction='edit';$a2_frame='_self'; ?><?php
	$params = array();
	$tmp_url = '';
	$params[REQ_PARAM_TARGET] = $a2_target;
	switch( $a2_type )
	{
		case 'post':
			$json = new JSON();
			$tmp_data = $json->encode( array('action'=>!empty($a2_action)?$a2_action:$this->actionName,'subaction'=>!empty($a2_subaction)?$a2_subaction:$this->subActionName,'id'=>!empty($a2_id)?$a2_id:$this->getRequestId())
		                          +array(REQ_PARAM_TOKEN=>token())
		                          +$params );
			$tmp_function_call = "submitLink(this,'".str_replace("\n",'',str_replace('"','&quot;',$tmp_data))."');";
			break;
		case 'view':
			$tmp_function_call = "startView(this,'".(!empty($a2_subaction)?$a2_subaction:$this->subActionName)."');";
			break;
		case 'url':
			$tmp_function_call = "submitUrl(this,'".($a2_url)."');";
			break;
		case 'external':
			$tmp_function_call = "location.href='".$a2_url."';";
			break;
		case 'popup':
			$tmp_function_call = "window.open('".$a2_url."', 'Popup', 'location=no,menubar=no,scrollbars=yes,toolbar=no,resizable=yes');";
			break;
		default:
			$tmp_function_call = "alert('TODO');";
	}
?><a target="<?php echo $a2_frame ?>"<?php if (isset($a2_name)) { ?> name="<?php echo $a2_name ?>"<?php }else{ ?> href="javascript:void(0);" onclick="<?php echo $tmp_function_call ?>" <?php } ?> class="<?php echo $a2_class ?>"<?php if (isset($a2_accesskey)) echo ' accesskey="'.$a2_accesskey.'"' ?>  title="<?php echo encodeHtml($a2_title) ?>"><?php unset($a2_title,$a2_type,$a2_target,$a2_class,$a2_action,$a2_subaction,$a2_frame) ?><?php $a3_icon='show';$a3_align='left'; ?><?php
	$a3_tmp_image_file = $image_dir.'icon_'.$a3_icon.IMG_ICON_EXT;
	$a3_size = '16x16';
	$a3_tmp_title = basename($a3_tmp_image_file);
?><img alt="<?php echo $a3_tmp_title; if (isset($a3_size)) { echo ' ('; list($a3_tmp_width,$a3_tmp_height)=explode('x',$a3_size);echo $a3_tmp_width.'x'.$a3_tmp_height; echo')';} ?>" src="<?php echo $a3_tmp_image_file ?>" border="0"<?php if(isset($a3_align)) echo ' align="'.$a3_align.'"' ?><?php if (isset($a3_size)) { list($a3_tmp_width,$a3_tmp_height)=explode('x',$a3_size);echo ' width="'.$a3_tmp_width.'" height="'.$a3_tmp_height.'"';} ?> /><?php unset($a3_icon,$a3_align) ?><?php $a3_class='text';$a3_key='menu_page_edit';$a3_escape=true;$a3_cut='both'; ?><?php
		$a3_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a3_class ?>" title="<?php echo $a3_title ?>"><?php
		$langF = $a3_escape?'langHtml':'lang';
		$tmp_text = $langF($a3_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a3_class,$a3_key,$a3_escape,$a3_cut) ?></a><?php $a2_title='';$a2_type='popup';$a2_url=$preview_url;$a2_class='action';$a2_frame='_self'; ?><?php
	$params = array();
	$tmp_url = '';
	$a2_target = $view;
	switch( $a2_type )
	{
		case 'post':
			$json = new JSON();
			$tmp_data = $json->encode( array('action'=>!empty($a2_action)?$a2_action:$this->actionName,'subaction'=>!empty($a2_subaction)?$a2_subaction:$this->subActionName,'id'=>!empty($a2_id)?$a2_id:$this->getRequestId())
		                          +array(REQ_PARAM_TOKEN=>token())
		                          +$params );
			$tmp_function_call = "submitLink(this,'".str_replace("\n",'',str_replace('"','&quot;',$tmp_data))."');";
			break;
		case 'view':
			$tmp_function_call = "startView(this,'".(!empty($a2_subaction)?$a2_subaction:$this->subActionName)."');";
			break;
		case 'url':
			$tmp_function_call = "submitUrl(this,'".($a2_url)."');";
			break;
		case 'external':
			$tmp_function_call = "location.href='".$a2_url."';";
			break;
		case 'popup':
			$tmp_function_call = "window.open('".$a2_url."', 'Popup', 'location=no,menubar=no,scrollbars=yes,toolbar=no,resizable=yes');";
			break;
		default:
			$tmp_function_call = "alert('TODO');";
	}
?><a target="<?php echo $a2_frame ?>"<?php if (isset($a2_name)) { ?> name="<?php echo $a2_name ?>"<?php }else{ ?> href="javascript:void(0);" onclick="<?php echo $tmp_function_call ?>" <?php } ?> class="<?php echo $a2_class ?>"<?php if (isset($a2_accesskey)) echo ' accesskey="'.$a2_accesskey.'"' ?>  title="<?php echo encodeHtml($a2_title) ?>"><?php unset($a2_title,$a2_type,$a2_url,$a2_class,$a2_frame) ?><?php $a3_class='text';$a3_key='link_open_in_new_window';$a3_escape=true;$a3_cut='both'; ?><?php
		$a3_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a3_class ?>" title="<?php echo $a3_title ?>"><?php
		$langF = $a3_escape?'langHtml':'lang';
		$tmp_text = $langF($a3_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a3_class,$a3_key,$a3_escape,$a3_cut) ?></a>