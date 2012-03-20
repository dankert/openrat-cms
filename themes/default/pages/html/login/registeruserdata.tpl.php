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
?><?php unset($a2_name,$a2_target,$a2_method,$a2_enctype,$a2_type) ?><?php $a3_name='register'; ?><img src="<?php echo $image_dir.'logo_'.$a3_name.IMG_ICON_EXT ?>" border="0" align="left" /><h2 class="logo"><?php echo langHtml('logo_'.$a3_name) ?></h2><p class="logo"><?php echo langHtml('logo_'.$a3_name.'_text') ?></p><?php unset($a3_name) ?><?php $a3_class='line'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?><?php $a4_class='label'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><?php $a5_class='text';$a5_text='USER_REGISTER_CODE';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = $langF($a5_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_text,$a5_escape,$a5_cut) ?></div><?php $a4_class='input'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><?php $a5_class='focus';$a5_default='';$a5_type='text';$a5_name='code';$a5_size='25';$a5_maxlength='256';$a5_onchange='';$a5_readonly=false; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a5_readonly=true;
	  if ($a5_readonly && empty($$a5_name)) $$a5_name = '- '.lang('EMPTY').' -';
      if(!isset($a5_default)) $a5_default='';
      $tmp_value = Text::encodeHtml(isset($$a5_name)?$$a5_name:$a5_default);
?><?php if (!$a5_readonly || $a5_type=='hidden') {
?><input<?php if ($a5_readonly) echo ' disabled="true"' ?> id="id_<?php echo $a5_name ?><?php if ($a5_readonly) echo '_disabled' ?>" name="<?php echo $a5_name ?><?php if ($a5_readonly) echo '_disabled' ?>" type="<?php echo $a5_type ?>" maxlength="<?php echo $a5_maxlength ?>" class="<?php echo str_replace(',',' ',$a5_class) ?>" value="<?php echo $tmp_value ?>" <?php if (in_array($a5_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php
if	($a5_readonly) {
?><input type="hidden" id="id_<?php echo $a5_name ?>" name="<?php echo $a5_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subactionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a5_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a5_class,$a5_default,$a5_type,$a5_name,$a5_size,$a5_maxlength,$a5_onchange,$a5_readonly) ?></div></div><?php $a3_class='line'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?><?php $a4_class='label'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><?php $a5_class='text';$a5_text='USER_USERNAME';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = $langF($a5_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_text,$a5_escape,$a5_cut) ?></div><?php $a4_class='input'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><?php $a5_class='text';$a5_default='';$a5_type='text';$a5_name='username';$a5_value='';$a5_size='25';$a5_maxlength='256';$a5_onchange='';$a5_readonly=false; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a5_readonly=true;
	  if ($a5_readonly && empty($$a5_name)) $$a5_name = '- '.lang('EMPTY').' -';
      if(!isset($a5_default)) $a5_default='';
      $tmp_value = Text::encodeHtml(isset($$a5_name)?$$a5_name:$a5_default);
?><?php if (!$a5_readonly || $a5_type=='hidden') {
?><input<?php if ($a5_readonly) echo ' disabled="true"' ?> id="id_<?php echo $a5_name ?><?php if ($a5_readonly) echo '_disabled' ?>" name="<?php echo $a5_name ?><?php if ($a5_readonly) echo '_disabled' ?>" type="<?php echo $a5_type ?>" maxlength="<?php echo $a5_maxlength ?>" class="<?php echo str_replace(',',' ',$a5_class) ?>" value="<?php echo $tmp_value ?>" <?php if (in_array($a5_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php
if	($a5_readonly) {
?><input type="hidden" id="id_<?php echo $a5_name ?>" name="<?php echo $a5_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subactionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a5_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a5_class,$a5_default,$a5_type,$a5_name,$a5_value,$a5_size,$a5_maxlength,$a5_onchange,$a5_readonly) ?></div></div><?php $a3_class='line'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?><?php $a4_class='label'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><?php $a5_class='text';$a5_text='USER_PASSWORD';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = $langF($a5_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_text,$a5_escape,$a5_cut) ?></div><?php $a4_class='input'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><?php $a5_name='password';$a5_default='';$a5_class='';$a5_size='25';$a5_maxlength='256'; ?><input type="password" name="<?php echo $a5_name ?>"  id="id_<?php echo $a5_name ?>" size="<?php echo $a5_size ?>" maxlength="<?php echo $a5_maxlength ?>" class="<?php echo $a5_class ?>" value="<?php if (count($errors)==0) echo isset($$a5_name)?$$a5_name:$a5_default ?>" <?php if (in_array($a5_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php unset($a5_name,$a5_default,$a5_class,$a5_size,$a5_maxlength) ?></div></div><?php $a3_class='line'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?><?php $a4_class='label'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><?php $a5_class='text';$a5_text='GLOBAL_DATABASE';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = $langF($a5_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_text,$a5_escape,$a5_cut) ?></div><?php $a4_class='input'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><?php $a5_list='dbids';$a5_name='dbid';$a5_default='actdbid';$a5_onchange='';$a5_title='';$a5_class='';$a5_addempty=false;$a5_multiple=false;$a5_size='1';$a5_lang=false; ?><?php
$a5_readonly=false;
$a5_tmp_list = $$a5_list;
if ($this->isEditable() && !$this->isEditMode())
{
	echo empty($$a5_name)?'- '.lang('EMPTY').' -':$a5_tmp_list[$$a5_name];
}
else
{
if ( $a5_addempty!==FALSE  )
{
	if ($a5_addempty===TRUE)
		$a5_tmp_list = array(''=>lang('LIST_ENTRY_EMPTY'))+$a5_tmp_list;
	else
		$a5_tmp_list = array(''=>'- '.lang($a5_addempty).' -')+$a5_tmp_list;
}
?><select<?php if ($a5_readonly) echo ' disabled="disabled"' ?> id="id_<?php echo $a5_name ?>"  name="<?php echo $a5_name; if ($a5_multiple) echo '[]'; ?>" onchange="<?php echo $a5_onchange ?>" title="<?php echo $a5_title ?>" class="<?php echo $a5_class ?>"<?php
if (count($$a5_list)<=1) echo ' disabled="disabled"';
if	($a5_multiple) echo ' multiple="multiple"';
if (in_array($a5_name,$errors)) echo ' style="background-color:red; border:2px dashed red;"';
echo ' size="'.intval($a5_size).'"';
?>><?php
		if	( isset($$a5_name) && isset($a5_tmp_list[$$a5_name]) )
			$a5_tmp_default = $$a5_name;
		elseif ( isset($a5_default) )
			$a5_tmp_default = $a5_default;
		else
			$a5_tmp_default = '';
		foreach( $a5_tmp_list as $box_key=>$box_value )
		{
			if	( is_array($box_value) )
			{
				$box_key   = $box_value['key'  ];
				$box_title = $box_value['title'];
				$box_value = $box_value['value'];
			}
			elseif( $a5_lang )
			{
				$box_title = lang( $box_value.'_DESC');
				$box_value = lang( $box_value        );
			}
			else
			{
				$box_title = '';
			}
			echo '<option class="'.$a5_class.'" value="'.$box_key.'" title="'.$box_title.'"';
			if ((string)$box_key==$a5_tmp_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select><?php
if (count($$a5_list)==0) echo '<input type="hidden" name="'.$a5_name.'" value="" />';
if (count($$a5_list)==1) echo '<input type="hidden" name="'.$a5_name.'" value="'.$box_key.'" />';
}
?><?php unset($a5_list,$a5_name,$a5_default,$a5_onchange,$a5_title,$a5_class,$a5_addempty,$a5_multiple,$a5_size,$a5_lang) ?></div></div></form>
