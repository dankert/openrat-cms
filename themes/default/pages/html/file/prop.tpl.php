<?php $a2_name='';$a2_target='_self';$a2_method='post';$a2_enctype='application/x-www-form-urlencoded';$a2_type=''; ?><?php
		$a2_action = $actionName;
		$a2_subaction = $targetSubActionName;
		$a2_id = $this->getRequestId();
	if ($this->isEditable())
	{
		if	($this->isEditMode())
		{
			$a2_method    = 'POST';
		}
		else
		{
			$a2_method    = 'GET';
			$a2_subaction = $subActionName;
		}
	}
	switch( $a2_type )
	{
		case 'upload':
			$a2_tmp_submitFunction = '';
			break;
		default:
			$a2_tmp_submitFunction = 'formSubmit( $(this) ); return false;';
	}
?><form name="<?php echo $a2_name ?>"
      target="<?php echo $a2_target ?>"
      action="<?php echo Html::url( $a2_action,$a2_subaction,$a2_id ) ?>"
      method="<?php echo $a2_method ?>"
      enctype="<?php echo $a2_enctype ?>" style="margin:0px;padding:0px;"
      class="<?php echo $a2_action ?>"
      onSubmit="<?php echo $a2_tmp_submitFunction ?>"><input type="submit" class="invisible" />
<?php if ($this->isEditable() && !$this->isEditMode()) { ?>
<input type="hidden" name="mode" value="edit" />
<?php } ?>
<input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo $this->actionName ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo $this->subActionName ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo $this->getRequestId() ?>" /><?php
		if	( $conf['interface']['url_sessionid'] )
			echo '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";
?><?php unset($a2_name,$a2_target,$a2_method,$a2_enctype,$a2_type) ?><fieldset><?php if(isset($a3_title)) { ?><legend><?php if(isset($a3_icon)) { ?><img src="<?php echo $image_dir.'icon_'.$a3_icon.IMG_ICON_EXT ?>" align="left" border="0" /><?php } ?>&nbsp;&nbsp;<?php echo encodeHtml($a3_title) ?>&nbsp;&nbsp;</legend><?php } ?><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_for='name'; ?><label<?php if (isset($a6_for)) { ?> for="id_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); if(hasLang($a6_key.'_desc')) { ?><div class="description"><?php echo lang($a6_key.'_desc')?></div> <?php } } ?><?php unset($a6_for) ?><?php $a7_class='text';$a7_text='global_name';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_text,$a7_escape,$a7_cut) ?></label></div><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_class='name';$a6_default='';$a6_type='text';$a6_name='name';$a6_size='50';$a6_maxlength='256';$a6_onchange='';$a6_readonly=false; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a6_readonly=true;
	  if ($a6_readonly && empty($$a6_name)) $$a6_name = '- '.lang('EMPTY').' -';
      if(!isset($a6_default)) $a6_default='';
      $tmp_value = Text::encodeHtml(isset($$a6_name)?$$a6_name:$a6_default);
?><?php if (!$a6_readonly || $a6_type=='hidden') {
?><input<?php if ($a6_readonly) echo ' disabled="true"' ?> id="id_<?php echo $a6_name ?><?php if ($a6_readonly) echo '_disabled' ?>" name="<?php echo $a6_name ?><?php if ($a6_readonly) echo '_disabled' ?>" type="<?php echo $a6_type ?>" maxlength="<?php echo $a6_maxlength ?>" class="<?php echo str_replace(',',' ',$a6_class) ?>" value="<?php echo $tmp_value ?>" <?php if (in_array($a6_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php
if	($a6_readonly) {
?><input type="hidden" id="id_<?php echo $a6_name ?>" name="<?php echo $a6_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subactionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a6_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a6_class,$a6_default,$a6_type,$a6_name,$a6_size,$a6_maxlength,$a6_onchange,$a6_readonly) ?></div></div><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_for='filename'; ?><label<?php if (isset($a6_for)) { ?> for="id_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); if(hasLang($a6_key.'_desc')) { ?><div class="description"><?php echo lang($a6_key.'_desc')?></div> <?php } } ?><?php unset($a6_for) ?><?php $a7_class='text';$a7_text='global_filename';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_text,$a7_escape,$a7_cut) ?></label></div><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_class='filename';$a6_default='';$a6_type='text';$a6_name='filename';$a6_size='';$a6_maxlength='256';$a6_onchange='';$a6_readonly=false; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a6_readonly=true;
	  if ($a6_readonly && empty($$a6_name)) $$a6_name = '- '.lang('EMPTY').' -';
      if(!isset($a6_default)) $a6_default='';
      $tmp_value = Text::encodeHtml(isset($$a6_name)?$$a6_name:$a6_default);
?><?php if (!$a6_readonly || $a6_type=='hidden') {
?><input<?php if ($a6_readonly) echo ' disabled="true"' ?> id="id_<?php echo $a6_name ?><?php if ($a6_readonly) echo '_disabled' ?>" name="<?php echo $a6_name ?><?php if ($a6_readonly) echo '_disabled' ?>" type="<?php echo $a6_type ?>" maxlength="<?php echo $a6_maxlength ?>" class="<?php echo str_replace(',',' ',$a6_class) ?>" value="<?php echo $tmp_value ?>" <?php if (in_array($a6_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php
if	($a6_readonly) {
?><input type="hidden" id="id_<?php echo $a6_name ?>" name="<?php echo $a6_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subactionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a6_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a6_class,$a6_default,$a6_type,$a6_name,$a6_size,$a6_maxlength,$a6_onchange,$a6_readonly) ?></div></div><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_for='extension'; ?><label<?php if (isset($a6_for)) { ?> for="id_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); if(hasLang($a6_key.'_desc')) { ?><div class="description"><?php echo lang($a6_key.'_desc')?></div> <?php } } ?><?php unset($a6_for) ?><?php $a7_class='text';$a7_text='file_extension';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_text,$a7_escape,$a7_cut) ?></label></div><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_class='extension';$a6_default='';$a6_type='text';$a6_name='extension';$a6_size='10';$a6_maxlength='256';$a6_onchange='';$a6_readonly=false; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a6_readonly=true;
	  if ($a6_readonly && empty($$a6_name)) $$a6_name = '- '.lang('EMPTY').' -';
      if(!isset($a6_default)) $a6_default='';
      $tmp_value = Text::encodeHtml(isset($$a6_name)?$$a6_name:$a6_default);
?><?php if (!$a6_readonly || $a6_type=='hidden') {
?><input<?php if ($a6_readonly) echo ' disabled="true"' ?> id="id_<?php echo $a6_name ?><?php if ($a6_readonly) echo '_disabled' ?>" name="<?php echo $a6_name ?><?php if ($a6_readonly) echo '_disabled' ?>" type="<?php echo $a6_type ?>" maxlength="<?php echo $a6_maxlength ?>" class="<?php echo str_replace(',',' ',$a6_class) ?>" value="<?php echo $tmp_value ?>" <?php if (in_array($a6_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php
if	($a6_readonly) {
?><input type="hidden" id="id_<?php echo $a6_name ?>" name="<?php echo $a6_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subactionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a6_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a6_class,$a6_default,$a6_type,$a6_name,$a6_size,$a6_maxlength,$a6_onchange,$a6_readonly) ?></div></div><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_for='description'; ?><label<?php if (isset($a6_for)) { ?> for="id_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); if(hasLang($a6_key.'_desc')) { ?><div class="description"><?php echo lang($a6_key.'_desc')?></div> <?php } } ?><?php unset($a6_for) ?><?php $a7_class='text';$a7_text='global_description';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_text,$a7_escape,$a7_cut) ?></label></div><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_name='description';$a6_rows='10';$a6_cols='40';$a6_class='description';$a6_default=''; ?><?php if ($this->isEditMode()) {
?><textarea class="<?php echo $a6_class ?>" name="<?php echo $a6_name ?>" rows="<?php echo $a6_rows ?>" cols="<?php echo $a6_cols ?>"><?php echo htmlentities(isset($$a6_name)?$$a6_name:$a6_default) ?></textarea><?php
 } else {
?><span class="<?php echo $a6_class ?>"><?php echo isset($$a6_name)?$$a6_name:$a6_default ?></span><?php } ?><?php unset($a6_name,$a6_rows,$a6_cols,$a6_class,$a6_default) ?></div></div></fieldset><?php $a3_title='';$a3_type='';$a3_class='action';$a3_action='file';$a3_subaction='compress';$a3_frame='_self'; ?><?php
	$params = array();
	$tmp_url = '';
	$a3_target = $view;
	switch( $a3_type )
	{
		case 'post':
			$json = new JSON();
			$tmp_data = $json->encode( array('action'=>!empty($a3_action)?$a3_action:$this->actionName,'subaction'=>!empty($a3_subaction)?$a3_subaction:$this->subActionName,'id'=>!empty($a3_id)?$a3_id:$this->getRequestId())
		                          +array(REQ_PARAM_TOKEN=>token())
		                          +$params );
			$tmp_function_call = "submitLink(this,'".str_replace("\n",'',str_replace('"','&quot;',$tmp_data))."');";
			break;
		case 'view':
			$tmp_function_call = "startView(this,'".(!empty($a3_subaction)?$a3_subaction:$this->subActionName)."');";
			break;
		case 'url':
			$tmp_function_call = "submitUrl(this,'".($a3_url)."');";
			break;
		case 'external':
			$tmp_function_call = "location.href='".$a3_url."';";
			break;
		case 'popup':
			$tmp_function_call = "window.open('".$a3_url."', 'Popup', 'location=no,menubar=no,scrollbars=yes,toolbar=no,resizable=yes');";
			break;
		default:
			$tmp_function_call = "alert('TODO');";
	}
?><a target="<?php echo $a3_frame ?>"<?php if (isset($a3_name)) { ?> name="<?php echo $a3_name ?>"<?php }else{ ?> href="javascript:void(0);" onclick="<?php echo $tmp_function_call ?>" <?php } ?> class="<?php echo $a3_class ?>"<?php if (isset($a3_accesskey)) echo ' accesskey="'.$a3_accesskey.'"' ?>  title="<?php echo encodeHtml($a3_title) ?>"><?php unset($a3_title,$a3_type,$a3_class,$a3_action,$a3_subaction,$a3_frame) ?><?php $a4_file='icon/compress';$a4_align='left'; ?><?php
	$a4_tmp_image_file = $image_dir.$a4_file.IMG_ICON_EXT;
	$a4_tmp_title = basename($a4_tmp_image_file);
?><img alt="<?php echo $a4_tmp_title; if (isset($a4_size)) { echo ' ('; list($a4_tmp_width,$a4_tmp_height)=explode('x',$a4_size);echo $a4_tmp_width.'x'.$a4_tmp_height; echo')';} ?>" src="<?php echo $a4_tmp_image_file ?>" border="0"<?php if(isset($a4_align)) echo ' align="'.$a4_align.'"' ?><?php if (isset($a4_size)) { list($a4_tmp_width,$a4_tmp_height)=explode('x',$a4_size);echo ' width="'.$a4_tmp_width.'" height="'.$a4_tmp_height.'"';} ?> /><?php unset($a4_file,$a4_align) ?><?php $a4_class='text';$a4_key='menu_file_compress';$a4_escape=true;$a4_cut='both'; ?><?php
		$a4_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a4_class ?>" title="<?php echo $a4_title ?>"><?php
		$langF = $a4_escape?'langHtml':'lang';
		$tmp_text = $langF($a4_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a4_class,$a4_key,$a4_escape,$a4_cut) ?></a><?php $a3_title='';$a3_type='';$a3_class='action';$a3_action='file';$a3_subaction='uncompress';$a3_frame='_self'; ?><?php
	$params = array();
	$tmp_url = '';
	$a3_target = $view;
	switch( $a3_type )
	{
		case 'post':
			$json = new JSON();
			$tmp_data = $json->encode( array('action'=>!empty($a3_action)?$a3_action:$this->actionName,'subaction'=>!empty($a3_subaction)?$a3_subaction:$this->subActionName,'id'=>!empty($a3_id)?$a3_id:$this->getRequestId())
		                          +array(REQ_PARAM_TOKEN=>token())
		                          +$params );
			$tmp_function_call = "submitLink(this,'".str_replace("\n",'',str_replace('"','&quot;',$tmp_data))."');";
			break;
		case 'view':
			$tmp_function_call = "startView(this,'".(!empty($a3_subaction)?$a3_subaction:$this->subActionName)."');";
			break;
		case 'url':
			$tmp_function_call = "submitUrl(this,'".($a3_url)."');";
			break;
		case 'external':
			$tmp_function_call = "location.href='".$a3_url."';";
			break;
		case 'popup':
			$tmp_function_call = "window.open('".$a3_url."', 'Popup', 'location=no,menubar=no,scrollbars=yes,toolbar=no,resizable=yes');";
			break;
		default:
			$tmp_function_call = "alert('TODO');";
	}
?><a target="<?php echo $a3_frame ?>"<?php if (isset($a3_name)) { ?> name="<?php echo $a3_name ?>"<?php }else{ ?> href="javascript:void(0);" onclick="<?php echo $tmp_function_call ?>" <?php } ?> class="<?php echo $a3_class ?>"<?php if (isset($a3_accesskey)) echo ' accesskey="'.$a3_accesskey.'"' ?>  title="<?php echo encodeHtml($a3_title) ?>"><?php unset($a3_title,$a3_type,$a3_class,$a3_action,$a3_subaction,$a3_frame) ?><?php $a4_file='icon/uncompress';$a4_align='left'; ?><?php
	$a4_tmp_image_file = $image_dir.$a4_file.IMG_ICON_EXT;
	$a4_tmp_title = basename($a4_tmp_image_file);
?><img alt="<?php echo $a4_tmp_title; if (isset($a4_size)) { echo ' ('; list($a4_tmp_width,$a4_tmp_height)=explode('x',$a4_size);echo $a4_tmp_width.'x'.$a4_tmp_height; echo')';} ?>" src="<?php echo $a4_tmp_image_file ?>" border="0"<?php if(isset($a4_align)) echo ' align="'.$a4_align.'"' ?><?php if (isset($a4_size)) { list($a4_tmp_width,$a4_tmp_height)=explode('x',$a4_size);echo ' width="'.$a4_tmp_width.'" height="'.$a4_tmp_height.'"';} ?> /><?php unset($a4_file,$a4_align) ?><?php $a4_class='text';$a4_key='menu_file_uncompress';$a4_escape=true;$a4_cut='both'; ?><?php
		$a4_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a4_class ?>" title="<?php echo $a4_title ?>"><?php
		$langF = $a4_escape?'langHtml':'lang';
		$tmp_text = $langF($a4_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a4_class,$a4_key,$a4_escape,$a4_cut) ?></a><?php $a3_title='';$a3_type='';$a3_class='action';$a3_action='file';$a3_subaction='extract';$a3_frame='_self'; ?><?php
	$params = array();
	$tmp_url = '';
	$a3_target = $view;
	switch( $a3_type )
	{
		case 'post':
			$json = new JSON();
			$tmp_data = $json->encode( array('action'=>!empty($a3_action)?$a3_action:$this->actionName,'subaction'=>!empty($a3_subaction)?$a3_subaction:$this->subActionName,'id'=>!empty($a3_id)?$a3_id:$this->getRequestId())
		                          +array(REQ_PARAM_TOKEN=>token())
		                          +$params );
			$tmp_function_call = "submitLink(this,'".str_replace("\n",'',str_replace('"','&quot;',$tmp_data))."');";
			break;
		case 'view':
			$tmp_function_call = "startView(this,'".(!empty($a3_subaction)?$a3_subaction:$this->subActionName)."');";
			break;
		case 'url':
			$tmp_function_call = "submitUrl(this,'".($a3_url)."');";
			break;
		case 'external':
			$tmp_function_call = "location.href='".$a3_url."';";
			break;
		case 'popup':
			$tmp_function_call = "window.open('".$a3_url."', 'Popup', 'location=no,menubar=no,scrollbars=yes,toolbar=no,resizable=yes');";
			break;
		default:
			$tmp_function_call = "alert('TODO');";
	}
?><a target="<?php echo $a3_frame ?>"<?php if (isset($a3_name)) { ?> name="<?php echo $a3_name ?>"<?php }else{ ?> href="javascript:void(0);" onclick="<?php echo $tmp_function_call ?>" <?php } ?> class="<?php echo $a3_class ?>"<?php if (isset($a3_accesskey)) echo ' accesskey="'.$a3_accesskey.'"' ?>  title="<?php echo encodeHtml($a3_title) ?>"><?php unset($a3_title,$a3_type,$a3_class,$a3_action,$a3_subaction,$a3_frame) ?><?php $a4_file='icon/extract';$a4_align='left'; ?><?php
	$a4_tmp_image_file = $image_dir.$a4_file.IMG_ICON_EXT;
	$a4_tmp_title = basename($a4_tmp_image_file);
?><img alt="<?php echo $a4_tmp_title; if (isset($a4_size)) { echo ' ('; list($a4_tmp_width,$a4_tmp_height)=explode('x',$a4_size);echo $a4_tmp_width.'x'.$a4_tmp_height; echo')';} ?>" src="<?php echo $a4_tmp_image_file ?>" border="0"<?php if(isset($a4_align)) echo ' align="'.$a4_align.'"' ?><?php if (isset($a4_size)) { list($a4_tmp_width,$a4_tmp_height)=explode('x',$a4_size);echo ' width="'.$a4_tmp_width.'" height="'.$a4_tmp_height.'"';} ?> /><?php unset($a4_file,$a4_align) ?><?php $a4_class='text';$a4_key='menu_file_extract';$a4_escape=true;$a4_cut='both'; ?><?php
		$a4_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a4_class ?>" title="<?php echo $a4_title ?>"><?php
		$langF = $a4_escape?'langHtml':'lang';
		$tmp_text = $langF($a4_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a4_class,$a4_key,$a4_escape,$a4_cut) ?></a></form>
