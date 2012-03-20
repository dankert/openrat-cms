<?php $a2_name='';$a2_back=true; ?><div class="header">
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
</div><?php unset($a2_name,$a2_back) ?><?php $a2_name='';$a2_target='_self';$a2_method='post';$a2_enctype='application/x-www-form-urlencoded';$a2_type=''; ?><?php
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
?><?php unset($a2_name,$a2_target,$a2_method,$a2_enctype,$a2_type) ?><?php $a3_class='line'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?><?php $a4_class='label'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><?php $a5_class='text';$a5_text=lang('name');$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = $langF($a5_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_text,$a5_escape,$a5_cut) ?></div><?php $a4_class='input'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><?php $a5_class='text';$a5_default='';$a5_type='text';$a5_name='name';$a5_size='';$a5_maxlength='256';$a5_onchange='';$a5_readonly=false; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a5_readonly=true;
	  if ($a5_readonly && empty($$a5_name)) $$a5_name = '- '.lang('EMPTY').' -';
      if(!isset($a5_default)) $a5_default='';
      $tmp_value = Text::encodeHtml(isset($$a5_name)?$$a5_name:$a5_default);
?><?php if (!$a5_readonly || $a5_type=='hidden') {
?><input<?php if ($a5_readonly) echo ' disabled="true"' ?> id="id_<?php echo $a5_name ?><?php if ($a5_readonly) echo '_disabled' ?>" name="<?php echo $a5_name ?><?php if ($a5_readonly) echo '_disabled' ?>" type="<?php echo $a5_type ?>" maxlength="<?php echo $a5_maxlength ?>" class="<?php echo str_replace(',',' ',$a5_class) ?>" value="<?php echo $tmp_value ?>" <?php if (in_array($a5_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php
if	($a5_readonly) {
?><input type="hidden" id="id_<?php echo $a5_name ?>" name="<?php echo $a5_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subactionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a5_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a5_class,$a5_default,$a5_type,$a5_name,$a5_size,$a5_maxlength,$a5_onchange,$a5_readonly) ?></div></div><?php $a3_title=lang('options'); ?><fieldset><?php if(isset($a3_title)) { ?><legend><?php if(isset($a3_icon)) { ?><img src="<?php echo $image_dir.'icon_'.$a3_icon.IMG_ICON_EXT ?>" align="left" border="0" /><?php } ?>&nbsp;&nbsp;<?php echo encodeHtml($a3_title) ?>&nbsp;&nbsp;</legend><?php } ?><?php unset($a3_title) ?><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_readonly=false;$a6_name='type';$a6_value='empty';$a6_default=false;$a6_prefix='';$a6_suffix='';$a6_class='';$a6_onchange=''; ?><?php
		if ($this->isEditable() && !$this->isEditMode()) $a6_readonly=true;
		if	( isset($$a6_name)  )
			$a6_tmp_default = $$a6_name;
		elseif ( isset($a6_default) )
			$a6_tmp_default = $a6_default;
		else
			$a6_tmp_default = '';
 ?><input onclick="" class="radio" type="radio" id="id_<?php echo $a6_name.'_'.$a6_value ?>"  name="<?php echo $a6_prefix.$a6_name ?>"<?php if ( $a6_readonly ) echo ' disabled="disabled"' ?> value="<?php echo $a6_value ?>" <?php if($a6_value==$a6_tmp_default) echo 'checked="checked"' ?><?php if (in_array($a6_name,$errors)) echo ' style="borderx:2px dashed red; background-color:red;"' ?> />
<?php /* #END-IF# */ ?><?php unset($a6_readonly,$a6_name,$a6_value,$a6_default,$a6_prefix,$a6_suffix,$a6_class,$a6_onchange) ?><?php $a6_for='type_empty'; ?><label<?php if (isset($a6_for)) { ?> for="id_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); if(hasLang($a6_key.'_desc')) { ?><div class="description"><?php echo lang($a6_key.'_desc')?></div> <?php } } ?><?php unset($a6_for) ?><?php $a7_class='text';$a7_key='empty';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_key,$a7_escape,$a7_cut) ?></label><?php $a6_class='input'; ?><div class="<?php echo $a6_class ?>"><?php unset($a6_class) ?><?php $a7_readonly=false;$a7_name='type';$a7_value='copy';$a7_default=false;$a7_prefix='';$a7_suffix='';$a7_class='';$a7_onchange=''; ?><?php
		if ($this->isEditable() && !$this->isEditMode()) $a7_readonly=true;
		if	( isset($$a7_name)  )
			$a7_tmp_default = $$a7_name;
		elseif ( isset($a7_default) )
			$a7_tmp_default = $a7_default;
		else
			$a7_tmp_default = '';
 ?><input onclick="" class="radio" type="radio" id="id_<?php echo $a7_name.'_'.$a7_value ?>"  name="<?php echo $a7_prefix.$a7_name ?>"<?php if ( $a7_readonly ) echo ' disabled="disabled"' ?> value="<?php echo $a7_value ?>" <?php if($a7_value==$a7_tmp_default) echo 'checked="checked"' ?><?php if (in_array($a7_name,$errors)) echo ' style="borderx:2px dashed red; background-color:red;"' ?> />
<?php /* #END-IF# */ ?><?php unset($a7_readonly,$a7_name,$a7_value,$a7_default,$a7_prefix,$a7_suffix,$a7_class,$a7_onchange) ?><?php $a7_for='type_copy'; ?><label<?php if (isset($a7_for)) { ?> for="id_<?php echo $a7_for ?><?php if (!empty($a7_value)) echo '_'.$a7_value ?>" class="label"<?php } ?>>
<?php if (isset($a7_key)) { echo lang($a7_key); if(hasLang($a7_key.'_desc')) { ?><div class="description"><?php echo lang($a7_key.'_desc')?></div> <?php } } ?><?php unset($a7_for) ?><?php $a8_class='text';$a8_key='copy';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_key,$a8_escape,$a8_cut) ?></label><?php $a7_list='projects';$a7_name='projectid';$a7_onchange='';$a7_title='';$a7_class='';$a7_addempty=false;$a7_multiple=false;$a7_size='1';$a7_lang=false; ?><?php
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
?><?php unset($a7_list,$a7_name,$a7_onchange,$a7_title,$a7_class,$a7_addempty,$a7_multiple,$a7_size,$a7_lang) ?></div></div></div></fieldset></form>
<?php $a2_field='name'; ?><script name="JavaScript" type="text/javascript"><!--
</script>
<?php unset($a2_field) ?>