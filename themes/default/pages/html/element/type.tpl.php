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
?><?php unset($a2_name,$a2_target,$a2_method,$a2_enctype,$a2_type) ?><fieldset><?php if(isset($a3_title)) { ?><legend><?php if(isset($a3_icon)) { ?><img src="<?php echo $image_dir.'icon_'.$a3_icon.IMG_ICON_EXT ?>" align="left" border="0" /><?php } ?>&nbsp;&nbsp;<?php echo encodeHtml($a3_title) ?>&nbsp;&nbsp;</legend><?php } ?><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_class='text';$a6_text='ELEMENT_TYPE';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_text,$a6_escape,$a6_cut) ?></div><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_list='types';$a6_name='type';$a6_onchange='';$a6_title='';$a6_class='';$a6_addempty=false;$a6_multiple=false;$a6_size='1';$a6_lang=true; ?><?php
$a6_readonly=false;
$a6_tmp_list = $$a6_list;
if ($this->isEditable() && !$this->isEditMode())
{
	echo empty($$a6_name)?'- '.lang('EMPTY').' -':$a6_tmp_list[$$a6_name];
}
else
{
if ( $a6_addempty!==FALSE  )
{
	if ($a6_addempty===TRUE)
		$a6_tmp_list = array(''=>lang('LIST_ENTRY_EMPTY'))+$a6_tmp_list;
	else
		$a6_tmp_list = array(''=>'- '.lang($a6_addempty).' -')+$a6_tmp_list;
}
?><select<?php if ($a6_readonly) echo ' disabled="disabled"' ?> id="id_<?php echo $a6_name ?>"  name="<?php echo $a6_name; if ($a6_multiple) echo '[]'; ?>" onchange="<?php echo $a6_onchange ?>" title="<?php echo $a6_title ?>" class="<?php echo $a6_class ?>"<?php
if (count($$a6_list)<=1) echo ' disabled="disabled"';
if	($a6_multiple) echo ' multiple="multiple"';
if (in_array($a6_name,$errors)) echo ' style="background-color:red; border:2px dashed red;"';
echo ' size="'.intval($a6_size).'"';
?>><?php
		if	( isset($$a6_name) && isset($a6_tmp_list[$$a6_name]) )
			$a6_tmp_default = $$a6_name;
		elseif ( isset($a6_default) )
			$a6_tmp_default = $a6_default;
		else
			$a6_tmp_default = '';
		foreach( $a6_tmp_list as $box_key=>$box_value )
		{
			if	( is_array($box_value) )
			{
				$box_key   = $box_value['key'  ];
				$box_title = $box_value['title'];
				$box_value = $box_value['value'];
			}
			elseif( $a6_lang )
			{
				$box_title = lang( $box_value.'_DESC');
				$box_value = lang( $box_value        );
			}
			else
			{
				$box_title = '';
			}
			echo '<option class="'.$a6_class.'" value="'.$box_key.'" title="'.$box_title.'"';
			if ((string)$box_key==$a6_tmp_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select><?php
if (count($$a6_list)==0) echo '<input type="hidden" name="'.$a6_name.'" value="" />';
if (count($$a6_list)==1) echo '<input type="hidden" name="'.$a6_name.'" value="'.$box_key.'" />';
}
?><?php unset($a6_list,$a6_name,$a6_onchange,$a6_title,$a6_class,$a6_addempty,$a6_multiple,$a6_size,$a6_lang) ?></div></div></fieldset></form>
