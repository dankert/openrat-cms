<?php $a2_name='';$a2_views='changetemplate';$a2_back=false; ?><div class="header">
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
</div><?php unset($a2_name,$a2_views,$a2_back) ?><?php $a2_name='';$a2_target='_self';$a2_method='post';$a2_enctype='application/x-www-form-urlencoded';$a2_type=''; ?><?php
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
?><span class="<?php echo $a6_class ?>"><?php echo isset($$a6_name)?$$a6_name:$a6_default ?></span><?php } ?><?php unset($a6_name,$a6_rows,$a6_cols,$a6_class,$a6_default) ?></div></div></fieldset><?php $a3_false=$mode=="edit"; ?><?php 
	if	(gettype($a3_false) === '' && gettype($a3_false) === '1')
		$a3_tmp_exec = $$a3_false == false;
	else
		$a3_tmp_exec = $a3_false == false;
	$a3_tmp_last_exec = $a3_tmp_exec;
	if	( $a3_tmp_exec )
	{
?>
<?php unset($a3_false) ?><?php $a4_title=lang('additional_info'); ?><fieldset><?php if(isset($a4_title)) { ?><legend><?php if(isset($a4_icon)) { ?><img src="<?php echo $image_dir.'icon_'.$a4_icon.IMG_ICON_EXT ?>" align="left" border="0" /><?php } ?>&nbsp;&nbsp;<?php echo encodeHtml($a4_title) ?>&nbsp;&nbsp;</legend><?php } ?><?php unset($a4_title) ?><?php $a5_class='line'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_class='label'; ?><div class="<?php echo $a6_class ?>"><?php unset($a6_class) ?><?php $a7_for='full_filename'; ?><label<?php if (isset($a7_for)) { ?> for="id_<?php echo $a7_for ?><?php if (!empty($a7_value)) echo '_'.$a7_value ?>" class="label"<?php } ?>>
<?php if (isset($a7_key)) { echo lang($a7_key); if(hasLang($a7_key.'_desc')) { ?><div class="description"><?php echo lang($a7_key.'_desc')?></div> <?php } } ?><?php unset($a7_for) ?><?php $a8_class='text';$a8_text='global_full_filename';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_text,$a8_escape,$a8_cut) ?></label></div><?php $a6_class='input'; ?><div class="<?php echo $a6_class ?>"><?php unset($a6_class) ?><?php $a7_class='filename';$a7_var='full_filename';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = isset($$a7_var)?$$a7_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_var,$a7_escape,$a7_cut) ?></div></div><?php $a5_class='line'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_class='label'; ?><div class="<?php echo $a6_class ?>"><?php unset($a6_class) ?><?php $a7_for='template_name'; ?><label<?php if (isset($a7_for)) { ?> for="id_<?php echo $a7_for ?><?php if (!empty($a7_value)) echo '_'.$a7_value ?>" class="label"<?php } ?>>
<?php if (isset($a7_key)) { echo lang($a7_key); if(hasLang($a7_key.'_desc')) { ?><div class="description"><?php echo lang($a7_key.'_desc')?></div> <?php } } ?><?php unset($a7_for) ?><?php $a8_class='text';$a8_text='global_template';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_text,$a8_escape,$a8_cut) ?></label></div><?php $a6_class='input'; ?><div class="<?php echo $a6_class ?>"><?php unset($a6_class) ?><?php $a7_present='template_url'; ?><?php 
	$a7_tmp_exec = isset($$a7_present);
	$a7_tmp_last_exec = $a7_tmp_exec;
	if	( $a7_tmp_exec )
	{
?>
<?php unset($a7_present) ?><?php $a8_title='';$a8_type='';$a8_target='cms_main';$a8_url=$template_url;$a8_class='';$a8_frame='_self'; ?><?php
	$params = array();
	$tmp_url = '';
	$params[REQ_PARAM_TARGET] = $a8_target;
	switch( $a8_type )
	{
		case 'post':
			$json = new JSON();
			$tmp_data = $json->encode( array('action'=>!empty($a8_action)?$a8_action:$this->actionName,'subaction'=>!empty($a8_subaction)?$a8_subaction:$this->subActionName,'id'=>!empty($a8_id)?$a8_id:$this->getRequestId())
		                          +array(REQ_PARAM_TOKEN=>token())
		                          +$params );
			$tmp_function_call = "submitLink(this,'".str_replace("\n",'',str_replace('"','&quot;',$tmp_data))."');";
			break;
		case 'view':
			$tmp_function_call = "startView(this,'".(!empty($a8_subaction)?$a8_subaction:$this->subActionName)."');";
			break;
		case 'url':
			$tmp_function_call = "submitUrl(this,'".($a8_url)."');";
			break;
		case 'external':
			$tmp_function_call = "location.href='".$a8_url."';";
			break;
		case 'popup':
			$tmp_function_call = "window.open('".$a8_url."', 'Popup', 'location=no,menubar=no,scrollbars=yes,toolbar=no,resizable=yes');";
			break;
		default:
			$tmp_function_call = "alert('TODO');";
	}
?><a target="<?php echo $a8_frame ?>"<?php if (isset($a8_name)) { ?> name="<?php echo $a8_name ?>"<?php }else{ ?> href="javascript:void(0);" onclick="<?php echo $tmp_function_call ?>" <?php } ?> class="<?php echo $a8_class ?>"<?php if (isset($a8_accesskey)) echo ' accesskey="'.$a8_accesskey.'"' ?>  title="<?php echo encodeHtml($a8_title) ?>"><?php unset($a8_title,$a8_type,$a8_target,$a8_url,$a8_class,$a8_frame) ?><?php $a9_icon='template';$a9_align='left'; ?><?php
	$a9_tmp_image_file = $image_dir.'icon_'.$a9_icon.IMG_ICON_EXT;
	$a9_size = '16x16';
	$a9_tmp_title = basename($a9_tmp_image_file);
?><img alt="<?php echo $a9_tmp_title; if (isset($a9_size)) { echo ' ('; list($a9_tmp_width,$a9_tmp_height)=explode('x',$a9_size);echo $a9_tmp_width.'x'.$a9_tmp_height; echo')';} ?>" src="<?php echo $a9_tmp_image_file ?>" border="0"<?php if(isset($a9_align)) echo ' align="'.$a9_align.'"' ?><?php if (isset($a9_size)) { list($a9_tmp_width,$a9_tmp_height)=explode('x',$a9_size);echo ' width="'.$a9_tmp_width.'" height="'.$a9_tmp_height.'"';} ?> /><?php unset($a9_icon,$a9_align) ?><?php $a9_class='text';$a9_var='template_name';$a9_escape=true;$a9_cut='both'; ?><?php
		$a9_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a9_class ?>" title="<?php echo $a9_title ?>"><?php
		$langF = $a9_escape?'langHtml':'lang';
		$tmp_text = isset($$a9_var)?$$a9_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a9_class,$a9_var,$a9_escape,$a9_cut) ?></a><?php } ?><?php $a7_empty='template_url'; ?><?php 
	if	( !isset($$a7_empty) )
		$a7_tmp_exec = empty($a7_empty);
	elseif	( is_array($$a7_empty) )
		$a7_tmp_exec = (count($$a7_empty)==0);
	elseif	( is_bool($$a7_empty) )
		$a7_tmp_exec = true;
	else
		$a7_tmp_exec = empty( $$a7_empty );
	$a7_tmp_last_exec = $a7_tmp_exec;
	if	( $a7_tmp_exec )
	{
?>
<?php unset($a7_empty) ?><?php $a8_file='icon_template';$a8_align='left'; ?><?php
	$a8_tmp_image_file = $image_dir.$a8_file.IMG_ICON_EXT;
	$a8_tmp_title = basename($a8_tmp_image_file);
?><img alt="<?php echo $a8_tmp_title; if (isset($a8_size)) { echo ' ('; list($a8_tmp_width,$a8_tmp_height)=explode('x',$a8_size);echo $a8_tmp_width.'x'.$a8_tmp_height; echo')';} ?>" src="<?php echo $a8_tmp_image_file ?>" border="0"<?php if(isset($a8_align)) echo ' align="'.$a8_align.'"' ?><?php if (isset($a8_size)) { list($a8_tmp_width,$a8_tmp_height)=explode('x',$a8_size);echo ' width="'.$a8_tmp_width.'" height="'.$a8_tmp_height.'"';} ?> /><?php unset($a8_file,$a8_align) ?><?php $a8_class='text';$a8_var='template_name';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = isset($$a8_var)?$$a8_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_var,$a8_escape,$a8_cut) ?><?php } ?><br/><?php $a7_false=$mode=="edit"; ?><?php 
	if	(gettype($a7_false) === '' && gettype($a7_false) === '1')
		$a7_tmp_exec = $$a7_false == false;
	else
		$a7_tmp_exec = $a7_false == false;
	$a7_tmp_last_exec = $a7_tmp_exec;
	if	( $a7_tmp_exec )
	{
?>
<?php unset($a7_false) ?><?php $a8_title='';$a8_type='';$a8_class='action';$a8_action='page';$a8_subaction='changetemplate';$a8_frame='_self'; ?><?php
	$params = array();
	$tmp_url = '';
	$a8_target = $view;
	switch( $a8_type )
	{
		case 'post':
			$json = new JSON();
			$tmp_data = $json->encode( array('action'=>!empty($a8_action)?$a8_action:$this->actionName,'subaction'=>!empty($a8_subaction)?$a8_subaction:$this->subActionName,'id'=>!empty($a8_id)?$a8_id:$this->getRequestId())
		                          +array(REQ_PARAM_TOKEN=>token())
		                          +$params );
			$tmp_function_call = "submitLink(this,'".str_replace("\n",'',str_replace('"','&quot;',$tmp_data))."');";
			break;
		case 'view':
			$tmp_function_call = "startView(this,'".(!empty($a8_subaction)?$a8_subaction:$this->subActionName)."');";
			break;
		case 'url':
			$tmp_function_call = "submitUrl(this,'".($a8_url)."');";
			break;
		case 'external':
			$tmp_function_call = "location.href='".$a8_url."';";
			break;
		case 'popup':
			$tmp_function_call = "window.open('".$a8_url."', 'Popup', 'location=no,menubar=no,scrollbars=yes,toolbar=no,resizable=yes');";
			break;
		default:
			$tmp_function_call = "alert('TODO');";
	}
?><a target="<?php echo $a8_frame ?>"<?php if (isset($a8_name)) { ?> name="<?php echo $a8_name ?>"<?php }else{ ?> href="javascript:void(0);" onclick="<?php echo $tmp_function_call ?>" <?php } ?> class="<?php echo $a8_class ?>"<?php if (isset($a8_accesskey)) echo ' accesskey="'.$a8_accesskey.'"' ?>  title="<?php echo encodeHtml($a8_title) ?>"><?php unset($a8_title,$a8_type,$a8_class,$a8_action,$a8_subaction,$a8_frame) ?><?php $a9_icon='template';$a9_align='left'; ?><?php
	$a9_tmp_image_file = $image_dir.'icon_'.$a9_icon.IMG_ICON_EXT;
	$a9_size = '16x16';
	$a9_tmp_title = basename($a9_tmp_image_file);
?><img alt="<?php echo $a9_tmp_title; if (isset($a9_size)) { echo ' ('; list($a9_tmp_width,$a9_tmp_height)=explode('x',$a9_size);echo $a9_tmp_width.'x'.$a9_tmp_height; echo')';} ?>" src="<?php echo $a9_tmp_image_file ?>" border="0"<?php if(isset($a9_align)) echo ' align="'.$a9_align.'"' ?><?php if (isset($a9_size)) { list($a9_tmp_width,$a9_tmp_height)=explode('x',$a9_size);echo ' width="'.$a9_tmp_width.'" height="'.$a9_tmp_height.'"';} ?> /><?php unset($a9_icon,$a9_align) ?><?php $a9_class='text';$a9_key='menu_page_changetemplate';$a9_escape=true;$a9_cut='both'; ?><?php
		$a9_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a9_class ?>" title="<?php echo $a9_title ?>"><?php
		$langF = $a9_escape?'langHtml':'lang';
		$tmp_text = $langF($a9_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a9_class,$a9_key,$a9_escape,$a9_cut) ?></a><?php } ?></div></div><?php $a5_class='line'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_class='label'; ?><div class="<?php echo $a6_class ?>"><?php unset($a6_class) ?><?php $a7_for='mime_type'; ?><label<?php if (isset($a7_for)) { ?> for="id_<?php echo $a7_for ?><?php if (!empty($a7_value)) echo '_'.$a7_value ?>" class="label"<?php } ?>>
<?php if (isset($a7_key)) { echo lang($a7_key); if(hasLang($a7_key.'_desc')) { ?><div class="description"><?php echo lang($a7_key.'_desc')?></div> <?php } } ?><?php unset($a7_for) ?><?php $a8_class='text';$a8_key='FILE_MIMETYPE';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_key,$a8_escape,$a8_cut) ?></label></div><?php $a6_class='input'; ?><div class="<?php echo $a6_class ?>"><?php unset($a6_class) ?><?php $a7_class='filename';$a7_var='mime_type';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = isset($$a7_var)?$$a7_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_var,$a7_escape,$a7_cut) ?></div></div><?php $a5_class='line'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_class='label'; ?><div class="<?php echo $a6_class ?>"><?php unset($a6_class) ?><?php $a7_for='objectid'; ?><label<?php if (isset($a7_for)) { ?> for="id_<?php echo $a7_for ?><?php if (!empty($a7_value)) echo '_'.$a7_value ?>" class="label"<?php } ?>>
<?php if (isset($a7_key)) { echo lang($a7_key); if(hasLang($a7_key.'_desc')) { ?><div class="description"><?php echo lang($a7_key.'_desc')?></div> <?php } } ?><?php unset($a7_for) ?><?php $a8_class='text';$a8_key='id';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_key,$a8_escape,$a8_cut) ?></label></div><?php $a6_class='input'; ?><div class="<?php echo $a6_class ?>"><?php unset($a6_class) ?><?php $a7_class='text';$a7_var='objectid';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = isset($$a7_var)?$$a7_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_var,$a7_escape,$a7_cut) ?></div></div></fieldset><?php $a4_title=lang('prop_userinfo'); ?><fieldset><?php if(isset($a4_title)) { ?><legend><?php if(isset($a4_icon)) { ?><img src="<?php echo $image_dir.'icon_'.$a4_icon.IMG_ICON_EXT ?>" align="left" border="0" /><?php } ?>&nbsp;&nbsp;<?php echo encodeHtml($a4_title) ?>&nbsp;&nbsp;</legend><?php } ?><?php unset($a4_title) ?><?php $a5_class='line'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_class='label'; ?><div class="<?php echo $a6_class ?>"><?php unset($a6_class) ?><?php $a7_for='create_date'; ?><label<?php if (isset($a7_for)) { ?> for="id_<?php echo $a7_for ?><?php if (!empty($a7_value)) echo '_'.$a7_value ?>" class="label"<?php } ?>>
<?php if (isset($a7_key)) { echo lang($a7_key); if(hasLang($a7_key.'_desc')) { ?><div class="description"><?php echo lang($a7_key.'_desc')?></div> <?php } } ?><?php unset($a7_for) ?><?php $a8_class='text';$a8_text='global_created';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_text,$a8_escape,$a8_cut) ?></label></div><?php $a6_class='input'; ?><div class="<?php echo $a6_class ?>"><?php unset($a6_class) ?><?php $a7_icon='el_date';$a7_align='left'; ?><?php
	$a7_tmp_image_file = $image_dir.'icon_'.$a7_icon.IMG_ICON_EXT;
	$a7_size = '16x16';
	$a7_tmp_title = basename($a7_tmp_image_file);
?><img alt="<?php echo $a7_tmp_title; if (isset($a7_size)) { echo ' ('; list($a7_tmp_width,$a7_tmp_height)=explode('x',$a7_size);echo $a7_tmp_width.'x'.$a7_tmp_height; echo')';} ?>" src="<?php echo $a7_tmp_image_file ?>" border="0"<?php if(isset($a7_align)) echo ' align="'.$a7_align.'"' ?><?php if (isset($a7_size)) { list($a7_tmp_width,$a7_tmp_height)=explode('x',$a7_size);echo ' width="'.$a7_tmp_width.'" height="'.$a7_tmp_height.'"';} ?> /><?php unset($a7_icon,$a7_align) ?><?php $a7_date=$create_date; ?><?php	
    global $conf;
	$time = $a7_date;
	if	( isset($_COOKIE['or_timezone_offset']) )
	{
		$time -= (int)date('Z');
		$time += ((int)$_COOKIE['or_timezone_offset']*60);
	}
	if	( $time==0)
		echo lang('GLOBAL_UNKNOWN');
	elseif ( !$conf['interface']['human_date_format'] )
	{
		echo '<span title="';
		$dl = date(lang('DATE_FORMAT_LONG'),$time);
		$dl = str_replace('{weekday}',lang('DATE_WEEKDAY'.strval(date('w',$time))),$dl);
		$dl = str_replace('{month}'  ,lang('DATE_MONTH'  .strval(date('n',$time))),$dl);
		echo $dl;
		unset($dl);
		echo '">';
		echo date(lang('DATE_FORMAT'),$time);
		echo '</span>';
	}
	else
	{
		$sekunden = time()-$time;
		$minuten = intval($sekunden/60);
		$stunden = intval($minuten /60);
		$tage    = intval($stunden /24);
		$monate  = intval($tage    /30);
		$jahre   = intval($monate  /12);
		echo '<span title="'.date(lang('DATE_FORMAT'),$time).'"">';
		if	( $time==0)
			echo lang('GLOBAL_UNKNOWN');
		elseif ( !$conf['interface']['human_date_format'] )
			echo date(lang('DATE_FORMAT'),$time);
		elseif	( $sekunden == 1 )
			echo $sekunden.' '.lang('GLOBAL_SECOND');
		elseif	( $sekunden < 60 )
			echo $sekunden.' '.lang('GLOBAL_SECONDS');
		elseif	( $minuten == 1 )
			echo $minuten.' '.lang('GLOBAL_MINUTE');
		elseif	( $minuten < 60 )
			echo $minuten.' '.lang('GLOBAL_MINUTES');
		elseif	( $stunden == 1 )
			echo $stunden.' '.lang('GLOBAL_HOUR');
		elseif	( $stunden < 60 )
			echo $stunden.' '.lang('GLOBAL_HOURS');
		elseif	( $tage == 1 )
			echo $tage.' '.lang('GLOBAL_DAY');
		elseif	( $tage < 60 )
			echo $tage.' '.lang('GLOBAL_DAYS');
		elseif	( $monate == 1 )
			echo $monate.' '.lang('GLOBAL_MONTH');
		elseif	( $monate < 12 )
			echo $monate.' '.lang('GLOBAL_MONTHS');
		elseif	( $jahre == 1 )
			echo $jahre.' '.lang('GLOBAL_YEAR');
		else
			echo $jahre.' '.lang('GLOBAL_YEARS');
		echo '</span>';
	}
?><?php unset($a7_date) ?><br/><?php $a7_icon='user';$a7_align='left'; ?><?php
	$a7_tmp_image_file = $image_dir.'icon_'.$a7_icon.IMG_ICON_EXT;
	$a7_size = '16x16';
	$a7_tmp_title = basename($a7_tmp_image_file);
?><img alt="<?php echo $a7_tmp_title; if (isset($a7_size)) { echo ' ('; list($a7_tmp_width,$a7_tmp_height)=explode('x',$a7_size);echo $a7_tmp_width.'x'.$a7_tmp_height; echo')';} ?>" src="<?php echo $a7_tmp_image_file ?>" border="0"<?php if(isset($a7_align)) echo ' align="'.$a7_align.'"' ?><?php if (isset($a7_size)) { list($a7_tmp_width,$a7_tmp_height)=explode('x',$a7_size);echo ' width="'.$a7_tmp_width.'" height="'.$a7_tmp_height.'"';} ?> /><?php unset($a7_icon,$a7_align) ?><?php $a7_user=$create_user; ?><?php
		if	( is_object($a7_user) )
			$user = $a7_user;
		else
			$user = $$a7_user;
		if	( empty($user->name) )
			$user->name = lang('GLOBAL_UNKNOWN');
		if	( empty($user->fullname) )
			$user->fullname = lang('GLOBAL_NO_DESCRIPTION_AVAILABLE');
		if	( !empty($user->mail) && $conf['security']['user']['show_mail'] )
			echo '<a href="mailto:'.$user->mail.'" title="'.$user->fullname.'">'.$user->name.'</a>';
		else
			echo '<span title="'.$user->fullname.'">'.$user->name.'</span>';
?><?php unset($a7_user) ?></div></div><?php $a5_class='line'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_class='label'; ?><div class="<?php echo $a6_class ?>"><?php unset($a6_class) ?><?php $a7_for='lastchange_date'; ?><label<?php if (isset($a7_for)) { ?> for="id_<?php echo $a7_for ?><?php if (!empty($a7_value)) echo '_'.$a7_value ?>" class="label"<?php } ?>>
<?php if (isset($a7_key)) { echo lang($a7_key); if(hasLang($a7_key.'_desc')) { ?><div class="description"><?php echo lang($a7_key.'_desc')?></div> <?php } } ?><?php unset($a7_for) ?><?php $a8_class='text';$a8_text='global_lastchange';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_text,$a8_escape,$a8_cut) ?></label></div><?php $a6_class='input'; ?><div class="<?php echo $a6_class ?>"><?php unset($a6_class) ?><?php $a7_icon='el_date';$a7_align='left'; ?><?php
	$a7_tmp_image_file = $image_dir.'icon_'.$a7_icon.IMG_ICON_EXT;
	$a7_size = '16x16';
	$a7_tmp_title = basename($a7_tmp_image_file);
?><img alt="<?php echo $a7_tmp_title; if (isset($a7_size)) { echo ' ('; list($a7_tmp_width,$a7_tmp_height)=explode('x',$a7_size);echo $a7_tmp_width.'x'.$a7_tmp_height; echo')';} ?>" src="<?php echo $a7_tmp_image_file ?>" border="0"<?php if(isset($a7_align)) echo ' align="'.$a7_align.'"' ?><?php if (isset($a7_size)) { list($a7_tmp_width,$a7_tmp_height)=explode('x',$a7_size);echo ' width="'.$a7_tmp_width.'" height="'.$a7_tmp_height.'"';} ?> /><?php unset($a7_icon,$a7_align) ?><?php $a7_date=$lastchange_date; ?><?php	
    global $conf;
	$time = $a7_date;
	if	( isset($_COOKIE['or_timezone_offset']) )
	{
		$time -= (int)date('Z');
		$time += ((int)$_COOKIE['or_timezone_offset']*60);
	}
	if	( $time==0)
		echo lang('GLOBAL_UNKNOWN');
	elseif ( !$conf['interface']['human_date_format'] )
	{
		echo '<span title="';
		$dl = date(lang('DATE_FORMAT_LONG'),$time);
		$dl = str_replace('{weekday}',lang('DATE_WEEKDAY'.strval(date('w',$time))),$dl);
		$dl = str_replace('{month}'  ,lang('DATE_MONTH'  .strval(date('n',$time))),$dl);
		echo $dl;
		unset($dl);
		echo '">';
		echo date(lang('DATE_FORMAT'),$time);
		echo '</span>';
	}
	else
	{
		$sekunden = time()-$time;
		$minuten = intval($sekunden/60);
		$stunden = intval($minuten /60);
		$tage    = intval($stunden /24);
		$monate  = intval($tage    /30);
		$jahre   = intval($monate  /12);
		echo '<span title="'.date(lang('DATE_FORMAT'),$time).'"">';
		if	( $time==0)
			echo lang('GLOBAL_UNKNOWN');
		elseif ( !$conf['interface']['human_date_format'] )
			echo date(lang('DATE_FORMAT'),$time);
		elseif	( $sekunden == 1 )
			echo $sekunden.' '.lang('GLOBAL_SECOND');
		elseif	( $sekunden < 60 )
			echo $sekunden.' '.lang('GLOBAL_SECONDS');
		elseif	( $minuten == 1 )
			echo $minuten.' '.lang('GLOBAL_MINUTE');
		elseif	( $minuten < 60 )
			echo $minuten.' '.lang('GLOBAL_MINUTES');
		elseif	( $stunden == 1 )
			echo $stunden.' '.lang('GLOBAL_HOUR');
		elseif	( $stunden < 60 )
			echo $stunden.' '.lang('GLOBAL_HOURS');
		elseif	( $tage == 1 )
			echo $tage.' '.lang('GLOBAL_DAY');
		elseif	( $tage < 60 )
			echo $tage.' '.lang('GLOBAL_DAYS');
		elseif	( $monate == 1 )
			echo $monate.' '.lang('GLOBAL_MONTH');
		elseif	( $monate < 12 )
			echo $monate.' '.lang('GLOBAL_MONTHS');
		elseif	( $jahre == 1 )
			echo $jahre.' '.lang('GLOBAL_YEAR');
		else
			echo $jahre.' '.lang('GLOBAL_YEARS');
		echo '</span>';
	}
?><?php unset($a7_date) ?><br/><?php $a7_icon='user';$a7_align='left'; ?><?php
	$a7_tmp_image_file = $image_dir.'icon_'.$a7_icon.IMG_ICON_EXT;
	$a7_size = '16x16';
	$a7_tmp_title = basename($a7_tmp_image_file);
?><img alt="<?php echo $a7_tmp_title; if (isset($a7_size)) { echo ' ('; list($a7_tmp_width,$a7_tmp_height)=explode('x',$a7_size);echo $a7_tmp_width.'x'.$a7_tmp_height; echo')';} ?>" src="<?php echo $a7_tmp_image_file ?>" border="0"<?php if(isset($a7_align)) echo ' align="'.$a7_align.'"' ?><?php if (isset($a7_size)) { list($a7_tmp_width,$a7_tmp_height)=explode('x',$a7_size);echo ' width="'.$a7_tmp_width.'" height="'.$a7_tmp_height.'"';} ?> /><?php unset($a7_icon,$a7_align) ?><?php $a7_user=$lastchange_user; ?><?php
		if	( is_object($a7_user) )
			$user = $a7_user;
		else
			$user = $$a7_user;
		if	( empty($user->name) )
			$user->name = lang('GLOBAL_UNKNOWN');
		if	( empty($user->fullname) )
			$user->fullname = lang('GLOBAL_NO_DESCRIPTION_AVAILABLE');
		if	( !empty($user->mail) && $conf['security']['user']['show_mail'] )
			echo '<a href="mailto:'.$user->mail.'" title="'.$user->fullname.'">'.$user->name.'</a>';
		else
			echo '<span title="'.$user->fullname.'">'.$user->name.'</span>';
?><?php unset($a7_user) ?></div></div></fieldset><?php } ?></form>
