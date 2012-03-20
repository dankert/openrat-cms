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
?><?php unset($a2_name,$a2_target,$a2_method,$a2_enctype,$a2_type) ?><?php $a3_title=lang('options'); ?><fieldset><?php if(isset($a3_title)) { ?><legend><?php if(isset($a3_icon)) { ?><img src="<?php echo $image_dir.'icon_'.$a3_icon.IMG_ICON_EXT ?>" align="left" border="0" /><?php } ?>&nbsp;&nbsp;<?php echo encodeHtml($a3_title) ?>&nbsp;&nbsp;</legend><?php } ?><?php unset($a3_title) ?><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?></div><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_default=false;$a6_readonly=false;$a6_name='files'; ?><?php
	if ($this->isEditable() && !$this->isEditMode()) $a6_readonly=true;
	if	( isset($$a6_name) )
		$checked = $$a6_name;
	else
		$checked = $a6_default;
?><input class="checkbox" type="checkbox" id="id_<?php echo $a6_name ?>" name="<?php echo $a6_name  ?>"  <?php if ($a6_readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?><?php if (in_array($a6_name,$errors)) echo ' style="background-color:red;"' ?> /><?php
if ( $a6_readonly && $checked )
{ 
?><input type="hidden" name="<?php echo $a6_name ?>" value="1" /><?php
}
?><?php unset($a6_name); unset($a6_readonly); unset($a6_default); ?><?php unset($a6_default,$a6_readonly,$a6_name) ?><?php $a6_for='files'; ?><label<?php if (isset($a6_for)) { ?> for="id_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); if(hasLang($a6_key.'_desc')) { ?><div class="description"><?php echo lang($a6_key.'_desc')?></div> <?php } } ?><?php unset($a6_for) ?><?php $a7_class='text';$a7_text='global_files';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_text,$a7_escape,$a7_cut) ?></label></div></div></fieldset></form>
