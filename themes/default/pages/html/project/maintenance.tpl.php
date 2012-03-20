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
?><?php unset($a2_name,$a2_target,$a2_method,$a2_enctype,$a2_type) ?><?php $a3_title=lang('options'); ?><fieldset><?php if(isset($a3_title)) { ?><legend><?php if(isset($a3_icon)) { ?><img src="<?php echo $image_dir.'icon_'.$a3_icon.IMG_ICON_EXT ?>" align="left" border="0" /><?php } ?>&nbsp;&nbsp;<?php echo encodeHtml($a3_title) ?>&nbsp;&nbsp;</legend><?php } ?><?php unset($a3_title) ?><div><?php $a5_class='text';$a5_value='';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = $a5_escape?htmlentities($a5_value):$a5_value;
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_value,$a5_escape,$a5_cut) ?><?php $a5_readonly=false;$a5_name='type';$a5_value='check_limit';$a5_default=false;$a5_prefix='';$a5_suffix='';$a5_class='';$a5_onchange=''; ?><?php
		if ($this->isEditable() && !$this->isEditMode()) $a5_readonly=true;
		if	( isset($$a5_name)  )
			$a5_tmp_default = $$a5_name;
		elseif ( isset($a5_default) )
			$a5_tmp_default = $a5_default;
		else
			$a5_tmp_default = '';
 ?><input onclick="" class="radio" type="radio" id="id_<?php echo $a5_name.'_'.$a5_value ?>"  name="<?php echo $a5_prefix.$a5_name ?>"<?php if ( $a5_readonly ) echo ' disabled="disabled"' ?> value="<?php echo $a5_value ?>" <?php if($a5_value==$a5_tmp_default) echo 'checked="checked"' ?><?php if (in_array($a5_name,$errors)) echo ' style="borderx:2px dashed red; background-color:red;"' ?> />
<?php /* #END-IF# */ ?><?php unset($a5_readonly,$a5_name,$a5_value,$a5_default,$a5_prefix,$a5_suffix,$a5_class,$a5_onchange) ?><?php $a5_for='type_check_limit'; ?><label<?php if (isset($a5_for)) { ?> for="id_<?php echo $a5_for ?><?php if (!empty($a5_value)) echo '_'.$a5_value ?>" class="label"<?php } ?>>
<?php if (isset($a5_key)) { echo lang($a5_key); if(hasLang($a5_key.'_desc')) { ?><div class="description"><?php echo lang($a5_key.'_desc')?></div> <?php } } ?><?php unset($a5_for) ?><?php $a6_class='text';$a6_key='project_check_limit';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_key,$a6_escape,$a6_cut) ?></label></div><div><?php $a5_class='text';$a5_value='';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = $a5_escape?htmlentities($a5_value):$a5_value;
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_value,$a5_escape,$a5_cut) ?><?php $a5_readonly=false;$a5_name='type';$a5_value='check_files';$a5_default=false;$a5_prefix='';$a5_suffix='';$a5_class='';$a5_onchange=''; ?><?php
		if ($this->isEditable() && !$this->isEditMode()) $a5_readonly=true;
		if	( isset($$a5_name)  )
			$a5_tmp_default = $$a5_name;
		elseif ( isset($a5_default) )
			$a5_tmp_default = $a5_default;
		else
			$a5_tmp_default = '';
 ?><input onclick="" class="radio" type="radio" id="id_<?php echo $a5_name.'_'.$a5_value ?>"  name="<?php echo $a5_prefix.$a5_name ?>"<?php if ( $a5_readonly ) echo ' disabled="disabled"' ?> value="<?php echo $a5_value ?>" <?php if($a5_value==$a5_tmp_default) echo 'checked="checked"' ?><?php if (in_array($a5_name,$errors)) echo ' style="borderx:2px dashed red; background-color:red;"' ?> />
<?php /* #END-IF# */ ?><?php unset($a5_readonly,$a5_name,$a5_value,$a5_default,$a5_prefix,$a5_suffix,$a5_class,$a5_onchange) ?><?php $a5_for='type_check_files'; ?><label<?php if (isset($a5_for)) { ?> for="id_<?php echo $a5_for ?><?php if (!empty($a5_value)) echo '_'.$a5_value ?>" class="label"<?php } ?>>
<?php if (isset($a5_key)) { echo lang($a5_key); if(hasLang($a5_key.'_desc')) { ?><div class="description"><?php echo lang($a5_key.'_desc')?></div> <?php } } ?><?php unset($a5_for) ?><?php $a6_class='text';$a6_key='project_check_files';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_key,$a6_escape,$a6_cut) ?></label></div></fieldset></form>
