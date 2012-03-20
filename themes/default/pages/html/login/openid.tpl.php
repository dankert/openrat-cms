<?php $a2_name='';$a2_views='password';$a2_back=false; ?><div class="header">
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
</div><?php unset($a2_name,$a2_views,$a2_back) ?><?php $a2_action='login';$a2_subaction='login';$a2_name='';$a2_target='_top';$a2_method='post';$a2_enctype='application/x-www-form-urlencoded';$a2_type=''; ?><?php
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
?><?php unset($a2_action,$a2_subaction,$a2_name,$a2_target,$a2_method,$a2_enctype,$a2_type) ?><?php $a3_true=@$conf['security']['openid']['enable']; ?><?php 
	if	(gettype($a3_true) === '' && gettype($a3_true) === '1')
		$a3_tmp_exec = $$a3_true == true;
	else
		$a3_tmp_exec = $a3_true == true;
	$a3_tmp_last_exec = $a3_tmp_exec;
	if	( $a3_tmp_exec )
	{
?>
<?php unset($a3_true) ?><?php $a4_title=lang('OPENID'); ?><fieldset><?php if(isset($a4_title)) { ?><legend><?php if(isset($a4_icon)) { ?><img src="<?php echo $image_dir.'icon_'.$a4_icon.IMG_ICON_EXT ?>" align="left" border="0" /><?php } ?>&nbsp;&nbsp;<?php echo encodeHtml($a4_title) ?>&nbsp;&nbsp;</legend><?php } ?><?php unset($a4_title) ?><?php $a5_class='line'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_class='label'; ?><div class="<?php echo $a6_class ?>"><?php unset($a6_class) ?><?php $a7_class='text';$a7_key='openid_user';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_key,$a7_escape,$a7_cut) ?><?php $a7_not=true;$a7_empty=@$conf['security']['openid']['logo_url']; ?><?php 
	if	( !isset($$a7_empty) )
		$a7_tmp_exec = empty($a7_empty);
	elseif	( is_array($$a7_empty) )
		$a7_tmp_exec = (count($$a7_empty)==0);
	elseif	( is_bool($$a7_empty) )
		$a7_tmp_exec = true;
	else
		$a7_tmp_exec = empty( $$a7_empty );
	$a7_tmp_exec = !$a7_tmp_exec;
	$a7_tmp_last_exec = $a7_tmp_exec;
	if	( $a7_tmp_exec )
	{
?>
<?php unset($a7_not,$a7_empty) ?><?php $a8_url=@$conf['security']['openid']['logo_url'];$a8_align='left'; ?><?php
	$a8_tmp_image_file = $a8_url;
	$a8_tmp_title = basename($a8_tmp_image_file);
?><img alt="<?php echo $a8_tmp_title; if (isset($a8_size)) { echo ' ('; list($a8_tmp_width,$a8_tmp_height)=explode('x',$a8_size);echo $a8_tmp_width.'x'.$a8_tmp_height; echo')';} ?>" src="<?php echo $a8_tmp_image_file ?>" border="0"<?php if(isset($a8_align)) echo ' align="'.$a8_align.'"' ?><?php if (isset($a8_size)) { list($a8_tmp_width,$a8_tmp_height)=explode('x',$a8_size);echo ' width="'.$a8_tmp_width.'" height="'.$a8_tmp_height.'"';} ?> /><?php unset($a8_url,$a8_align) ?><?php } ?></div><?php $a6_class='input'; ?><div class="<?php echo $a6_class ?>"><?php unset($a6_class) ?><?php $a7_list='openid_providers';$a7_name='openid_provider';$a7_onchange='';$a7_title='';$a7_class=''; ?><?php $a7_tmp_list = $$a7_list;
		if	( isset($$a7_name) && isset($a7_tmp_list[$$a7_name]) )
			$a7_tmp_default = $$a7_name;
		elseif ( isset($a7_default) )
			$a7_tmp_default = $a7_default;
		else
			$a7_tmp_default = '';
		foreach( $a7_tmp_list as $box_key=>$box_value )
		{
			$box_value = is_array($box_value)?(isset($box_value['lang'])?langHtml($box_value['lang']):$box_value['value']):$box_value;
			$id = 'id_'.$a7_name.'_'.$box_key;
			echo '<input id="'.$id.'" name="'.$a7_name.'" type="radio" class="'.$a7_class.'" value="'.$box_key.'"';
			if ($box_key==$a7_tmp_default)
				echo ' checked="checked"';
			echo ' />&nbsp;<label for="'.$id.'">'.$box_value.'</label><br />';
		}
?><?php unset($a7_list,$a7_name,$a7_onchange,$a7_title,$a7_class) ?><?php $a7_true=$openid_user_identity; ?><?php 
	if	(gettype($a7_true) === '' && gettype($a7_true) === '1')
		$a7_tmp_exec = $$a7_true == true;
	else
		$a7_tmp_exec = $a7_true == true;
	$a7_tmp_last_exec = $a7_tmp_exec;
	if	( $a7_tmp_exec )
	{
?>
<?php unset($a7_true) ?><?php $a8_readonly=false;$a8_name='openid_provider';$a8_value='identity';$a8_default=false;$a8_prefix='';$a8_suffix='';$a8_class='';$a8_onchange=''; ?><?php
		if ($this->isEditable() && !$this->isEditMode()) $a8_readonly=true;
		if	( isset($$a8_name)  )
			$a8_tmp_default = $$a8_name;
		elseif ( isset($a8_default) )
			$a8_tmp_default = $a8_default;
		else
			$a8_tmp_default = '';
 ?><input onclick="" class="radio" type="radio" id="id_<?php echo $a8_name.'_'.$a8_value ?>"  name="<?php echo $a8_prefix.$a8_name ?>"<?php if ( $a8_readonly ) echo ' disabled="disabled"' ?> value="<?php echo $a8_value ?>" <?php if($a8_value==$a8_tmp_default) echo 'checked="checked"' ?><?php if (in_array($a8_name,$errors)) echo ' style="borderx:2px dashed red; background-color:red;"' ?> />
<?php /* #END-IF# */ ?><?php unset($a8_readonly,$a8_name,$a8_value,$a8_default,$a8_prefix,$a8_suffix,$a8_class,$a8_onchange) ?><?php $a8_class='name';$a8_default='';$a8_type='text';$a8_name='openid_url';$a8_size='20';$a8_maxlength='256';$a8_onchange='';$a8_readonly=false; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a8_readonly=true;
	  if ($a8_readonly && empty($$a8_name)) $$a8_name = '- '.lang('EMPTY').' -';
      if(!isset($a8_default)) $a8_default='';
      $tmp_value = Text::encodeHtml(isset($$a8_name)?$$a8_name:$a8_default);
?><?php if (!$a8_readonly || $a8_type=='hidden') {
?><input<?php if ($a8_readonly) echo ' disabled="true"' ?> id="id_<?php echo $a8_name ?><?php if ($a8_readonly) echo '_disabled' ?>" name="<?php echo $a8_name ?><?php if ($a8_readonly) echo '_disabled' ?>" type="<?php echo $a8_type ?>" maxlength="<?php echo $a8_maxlength ?>" class="<?php echo str_replace(',',' ',$a8_class) ?>" value="<?php echo $tmp_value ?>" <?php if (in_array($a8_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php
if	($a8_readonly) {
?><input type="hidden" id="id_<?php echo $a8_name ?>" name="<?php echo $a8_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subactionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a8_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a8_class,$a8_default,$a8_type,$a8_name,$a8_size,$a8_maxlength,$a8_onchange,$a8_readonly) ?><?php } ?></div></div></fieldset><?php } ?><?php $a3_value=@count($dbids);$a3_greaterthan='1'; ?><?php 
	$a3_tmp_exec = intval($a3_greaterthan) < intval($a3_value);
	$a3_tmp_last_exec = $a3_tmp_exec;
	if	( $a3_tmp_exec )
	{
?>
<?php unset($a3_value,$a3_greaterthan) ?><?php $a4_title=lang('DATABASE');$a4_icon='database'; ?><fieldset><?php if(isset($a4_title)) { ?><legend><?php if(isset($a4_icon)) { ?><img src="<?php echo $image_dir.'icon_'.$a4_icon.IMG_ICON_EXT ?>" align="left" border="0" /><?php } ?>&nbsp;&nbsp;<?php echo encodeHtml($a4_title) ?>&nbsp;&nbsp;</legend><?php } ?><?php unset($a4_title,$a4_icon) ?><?php $a5_class='line'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_class='label'; ?><div class="<?php echo $a6_class ?>"><?php unset($a6_class) ?><?php $a7_for='dbid'; ?><label<?php if (isset($a7_for)) { ?> for="id_<?php echo $a7_for ?><?php if (!empty($a7_value)) echo '_'.$a7_value ?>" class="label"<?php } ?>>
<?php if (isset($a7_key)) { echo lang($a7_key); if(hasLang($a7_key.'_desc')) { ?><div class="description"><?php echo lang($a7_key.'_desc')?></div> <?php } } ?><?php unset($a7_for) ?><?php $a8_class='text';$a8_key='DATABASE';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_key,$a8_escape,$a8_cut) ?></label></div><?php $a6_class='input'; ?><div class="<?php echo $a6_class ?>"><?php unset($a6_class) ?><?php $a7_list='dbids';$a7_name='dbid';$a7_default=$actdbid;$a7_onchange='';$a7_title='';$a7_class='';$a7_addempty=false;$a7_multiple=false;$a7_size='1';$a7_lang=false; ?><?php
$a7_readonly=false;
$a7_tmp_list = $$a7_list;
if ($this->isEditable() && !$this->isEditMode())
{
	echo empty($$a7_name)?'- '.lang('EMPTY').' -':$a7_tmp_list[$$a7_name];
}
else
{
if ( $a7_addempty!==FALSE  )
{
	if ($a7_addempty===TRUE)
		$a7_tmp_list = array(''=>lang('LIST_ENTRY_EMPTY'))+$a7_tmp_list;
	else
		$a7_tmp_list = array(''=>'- '.lang($a7_addempty).' -')+$a7_tmp_list;
}
?><select<?php if ($a7_readonly) echo ' disabled="disabled"' ?> id="id_<?php echo $a7_name ?>"  name="<?php echo $a7_name; if ($a7_multiple) echo '[]'; ?>" onchange="<?php echo $a7_onchange ?>" title="<?php echo $a7_title ?>" class="<?php echo $a7_class ?>"<?php
if (count($$a7_list)<=1) echo ' disabled="disabled"';
if	($a7_multiple) echo ' multiple="multiple"';
if (in_array($a7_name,$errors)) echo ' style="background-color:red; border:2px dashed red;"';
echo ' size="'.intval($a7_size).'"';
?>><?php
		if	( isset($$a7_name) && isset($a7_tmp_list[$$a7_name]) )
			$a7_tmp_default = $$a7_name;
		elseif ( isset($a7_default) )
			$a7_tmp_default = $a7_default;
		else
			$a7_tmp_default = '';
		foreach( $a7_tmp_list as $box_key=>$box_value )
		{
			if	( is_array($box_value) )
			{
				$box_key   = $box_value['key'  ];
				$box_title = $box_value['title'];
				$box_value = $box_value['value'];
			}
			elseif( $a7_lang )
			{
				$box_title = lang( $box_value.'_DESC');
				$box_value = lang( $box_value        );
			}
			else
			{
				$box_title = '';
			}
			echo '<option class="'.$a7_class.'" value="'.$box_key.'" title="'.$box_title.'"';
			if ((string)$box_key==$a7_tmp_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select><?php
if (count($$a7_list)==0) echo '<input type="hidden" name="'.$a7_name.'" value="" />';
if (count($$a7_list)==1) echo '<input type="hidden" name="'.$a7_name.'" value="'.$box_key.'" />';
}
?><?php unset($a7_list,$a7_name,$a7_default,$a7_onchange,$a7_title,$a7_class,$a7_addempty,$a7_multiple,$a7_size,$a7_lang) ?><?php $a7_name='screenwidth';$a7_default='9999'; ?><?php
if (isset($$a7_name))
	$a7_tmp_value = $$a7_name;
elseif ( isset($a7_default) )
	$a7_tmp_value = $a7_default;
else
	$a7_tmp_value = "";
?><input type="hidden" name="<?php echo $a7_name ?>" value="<?php echo $a7_tmp_value ?>" /><?php unset($a7_name,$a7_default) ?></div></div></fieldset><?php } ?><?php if (!$a3_tmp_last_exec) { ?>
<?php $a4_name='dbid';$a4_default=$actdbid; ?><?php
if (isset($$a4_name))
	$a4_tmp_value = $$a4_name;
elseif ( isset($a4_default) )
	$a4_tmp_value = $a4_default;
else
	$a4_tmp_value = "";
?><input type="hidden" name="<?php echo $a4_name ?>" value="<?php echo $a4_tmp_value ?>" /><?php unset($a4_name,$a4_default) ?><?php }
unset($a2_tmp_last_exec) ?><?php $a3_name='objectid'; ?><?php
if (isset($$a3_name))
	$a3_tmp_value = $$a3_name;
elseif ( isset($a3_default) )
	$a3_tmp_value = $a3_default;
else
	$a3_tmp_value = "";
?><input type="hidden" name="<?php echo $a3_name ?>" value="<?php echo $a3_tmp_value ?>" /><?php unset($a3_name) ?><?php $a3_name='modelid'; ?><?php
if (isset($$a3_name))
	$a3_tmp_value = $$a3_name;
elseif ( isset($a3_default) )
	$a3_tmp_value = $a3_default;
else
	$a3_tmp_value = "";
?><input type="hidden" name="<?php echo $a3_name ?>" value="<?php echo $a3_tmp_value ?>" /><?php unset($a3_name) ?><?php $a3_name='projectid'; ?><?php
if (isset($$a3_name))
	$a3_tmp_value = $$a3_name;
elseif ( isset($a3_default) )
	$a3_tmp_value = $a3_default;
else
	$a3_tmp_value = "";
?><input type="hidden" name="<?php echo $a3_name ?>" value="<?php echo $a3_tmp_value ?>" /><?php unset($a3_name) ?><?php $a3_name='languageid'; ?><?php
if (isset($$a3_name))
	$a3_tmp_value = $$a3_name;
elseif ( isset($a3_default) )
	$a3_tmp_value = $a3_default;
else
	$a3_tmp_value = "";
?><input type="hidden" name="<?php echo $a3_name ?>" value="<?php echo $a3_tmp_value ?>" /><?php unset($a3_name) ?></form>
<br/><br/><?php $a2_title='';$a2_type='';$a2_target='_top';$a2_url=@$conf['login']['gpl']['url'];$a2_class='copyright';$a2_frame='_self'; ?><?php
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
?><a target="<?php echo $a2_frame ?>"<?php if (isset($a2_name)) { ?> name="<?php echo $a2_name ?>"<?php }else{ ?> href="javascript:void(0);" onclick="<?php echo $tmp_function_call ?>" <?php } ?> class="<?php echo $a2_class ?>"<?php if (isset($a2_accesskey)) echo ' accesskey="'.$a2_accesskey.'"' ?>  title="<?php echo encodeHtml($a2_title) ?>"><?php unset($a2_title,$a2_type,$a2_target,$a2_url,$a2_class,$a2_frame) ?><?php $a3_class='text';$a3_key='GPL';$a3_escape=true;$a3_cut='both'; ?><?php
		$a3_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a3_class ?>" title="<?php echo $a3_title ?>"><?php
		$langF = $a3_escape?'langHtml':'lang';
		$tmp_text = $langF($a3_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a3_class,$a3_key,$a3_escape,$a3_cut) ?></a>