<?php $a2_name='';$a2_views='createfolder,createlink,createpage,createfile';$a2_back=true; ?><div class="header">
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
</div><?php unset($a2_name,$a2_views,$a2_back) ?><?php $a2_name='';$a2_target='_self';$a2_method='post';$a2_enctype='multipart/form-data';$a2_type=''; ?><?php
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
?><?php unset($a2_name,$a2_target,$a2_method,$a2_enctype,$a2_type) ?><?php
	$column_idx = 0;
?>
<tr
>
<?php $a4_colspan='3';$a4_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
 colspan="3"
><?php unset($a4_colspan,$a4_header) ?><?php $a5_title=lang('folder'); ?><fieldset><?php if(isset($a5_title)) { ?><legend><?php if(isset($a5_icon)) { ?><img src="<?php echo $image_dir.'icon_'.$a5_icon.IMG_ICON_EXT ?>" align="left" border="0" /><?php } ?>&nbsp;&nbsp;<?php echo encodeHtml($a5_title) ?>&nbsp;&nbsp;</legend><?php } ?><?php unset($a5_title) ?></fieldset></td></tr><?php
	$column_idx = 0;
?>
<tr
>
<?php $a4_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a4_header) ?><?php $a5_readonly=false;$a5_name='type';$a5_value='folder';$a5_default=false;$a5_prefix='';$a5_suffix='';$a5_class='';$a5_onchange='';$a5_children='folder_name'; ?><?php
		if ($this->isEditable() && !$this->isEditMode()) $a5_readonly=true;
		if	( isset($$a5_name)  )
			$a5_tmp_default = $$a5_name;
		elseif ( isset($a5_default) )
			$a5_tmp_default = $a5_default;
		else
			$a5_tmp_default = '';
 ?><input onclick="" class="radio" type="radio" id="id_<?php echo $a5_name.'_'.$a5_value ?>"  name="<?php echo $a5_prefix.$a5_name ?>"<?php if ( $a5_readonly ) echo ' disabled="disabled"' ?> value="<?php echo $a5_value ?>" <?php if($a5_value==$a5_tmp_default) echo 'checked="checked"' ?><?php if (in_array($a5_name,$errors)) echo ' style="borderx:2px dashed red; background-color:red;"' ?> />
<?php /* #END-IF# */ ?><?php unset($a5_readonly,$a5_name,$a5_value,$a5_default,$a5_prefix,$a5_suffix,$a5_class,$a5_onchange,$a5_children) ?></td><?php $a4_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a4_header) ?><?php $a5_for='type_folder'; ?><label<?php if (isset($a5_for)) { ?> for="id_<?php echo $a5_for ?><?php if (!empty($a5_value)) echo '_'.$a5_value ?>" class="label"<?php } ?>>
<?php if (isset($a5_key)) { echo lang($a5_key); if(hasLang($a5_key.'_desc')) { ?><div class="description"><?php echo lang($a5_key.'_desc')?></div> <?php } } ?><?php unset($a5_for) ?><?php $a6_class='text';$a6_text='global_folder';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_text,$a6_escape,$a6_cut) ?></label></td><?php $a4_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a4_header) ?><?php $a5_class='name';$a5_default='';$a5_type='text';$a5_name='folder_name';$a5_size='30';$a5_maxlength='250';$a5_onchange='';$a5_readonly=false; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a5_readonly=true;
	  if ($a5_readonly && empty($$a5_name)) $$a5_name = '- '.lang('EMPTY').' -';
      if(!isset($a5_default)) $a5_default='';
      $tmp_value = Text::encodeHtml(isset($$a5_name)?$$a5_name:$a5_default);
?><?php if (!$a5_readonly || $a5_type=='hidden') {
?><input<?php if ($a5_readonly) echo ' disabled="true"' ?> id="id_<?php echo $a5_name ?><?php if ($a5_readonly) echo '_disabled' ?>" name="<?php echo $a5_name ?><?php if ($a5_readonly) echo '_disabled' ?>" type="<?php echo $a5_type ?>" maxlength="<?php echo $a5_maxlength ?>" class="<?php echo str_replace(',',' ',$a5_class) ?>" value="<?php echo $tmp_value ?>" <?php if (in_array($a5_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php
if	($a5_readonly) {
?><input type="hidden" id="id_<?php echo $a5_name ?>" name="<?php echo $a5_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subactionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a5_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a5_class,$a5_default,$a5_type,$a5_name,$a5_size,$a5_maxlength,$a5_onchange,$a5_readonly) ?></td></tr><?php
	$column_idx = 0;
?>
<tr
>
<?php $a4_colspan='3';$a4_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
 colspan="3"
><?php unset($a4_colspan,$a4_header) ?><?php $a5_title=lang('file'); ?><fieldset><?php if(isset($a5_title)) { ?><legend><?php if(isset($a5_icon)) { ?><img src="<?php echo $image_dir.'icon_'.$a5_icon.IMG_ICON_EXT ?>" align="left" border="0" /><?php } ?>&nbsp;&nbsp;<?php echo encodeHtml($a5_title) ?>&nbsp;&nbsp;</legend><?php } ?><?php unset($a5_title) ?></fieldset></td></tr><?php
	$column_idx = 0;
?>
<tr
>
<?php $a4_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a4_header) ?><?php $a5_readonly=false;$a5_name='type';$a5_value='file';$a5_default=false;$a5_prefix='';$a5_suffix='';$a5_class='';$a5_onchange='';$a5_children='file'; ?><?php
		if ($this->isEditable() && !$this->isEditMode()) $a5_readonly=true;
		if	( isset($$a5_name)  )
			$a5_tmp_default = $$a5_name;
		elseif ( isset($a5_default) )
			$a5_tmp_default = $a5_default;
		else
			$a5_tmp_default = '';
 ?><input onclick="" class="radio" type="radio" id="id_<?php echo $a5_name.'_'.$a5_value ?>"  name="<?php echo $a5_prefix.$a5_name ?>"<?php if ( $a5_readonly ) echo ' disabled="disabled"' ?> value="<?php echo $a5_value ?>" <?php if($a5_value==$a5_tmp_default) echo 'checked="checked"' ?><?php if (in_array($a5_name,$errors)) echo ' style="borderx:2px dashed red; background-color:red;"' ?> />
<?php /* #END-IF# */ ?><?php unset($a5_readonly,$a5_name,$a5_value,$a5_default,$a5_prefix,$a5_suffix,$a5_class,$a5_onchange,$a5_children) ?></td><?php $a4_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a4_header) ?><?php $a5_for='type_file'; ?><label<?php if (isset($a5_for)) { ?> for="id_<?php echo $a5_for ?><?php if (!empty($a5_value)) echo '_'.$a5_value ?>" class="label"<?php } ?>>
<?php if (isset($a5_key)) { echo lang($a5_key); if(hasLang($a5_key.'_desc')) { ?><div class="description"><?php echo lang($a5_key.'_desc')?></div> <?php } } ?><?php unset($a5_for) ?><?php $a6_class='text';$a6_text='global_FILE';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_text,$a6_escape,$a6_cut) ?></label></td><?php $a4_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a4_header) ?><?php $a5_name='file';$a5_class='upload';$a5_maxlength=$maxlength;$a5_size='30'; ?><input size="<?php echo $a5_size ?>" id="id_<?php echo $a5_name ?>" type="file" <?php if (isset($a5_maxlength))echo ' maxlength="'.$a5_maxlength.'"' ?> name="<?php echo $a5_name ?>" class="<?php echo $a5_class ?>" <?php if (in_array($a5_name,$errors)) echo 'style="border-rightx:10px solid red; background-colorx:yellow; border:2px dashed red;"' ?> /><?php unset($a5_name,$a5_class,$a5_maxlength,$a5_size) ?><br/><?php $a5_class='help';$a5_key='file_max_size';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = $langF($a5_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_key,$a5_escape,$a5_cut) ?><?php $a5_class='text';$a5_raw='_';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a5_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_raw,$a5_escape,$a5_cut) ?><?php $a5_class='text';$a5_var='max_size';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = isset($$a5_var)?$$a5_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_var,$a5_escape,$a5_cut) ?></td></tr><?php
	$column_idx = 0;
?>
<tr
>
<?php $a4_colspan='3';$a4_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
 colspan="3"
><?php unset($a4_colspan,$a4_header) ?><?php $a5_title=lang('page'); ?><fieldset><?php if(isset($a5_title)) { ?><legend><?php if(isset($a5_icon)) { ?><img src="<?php echo $image_dir.'icon_'.$a5_icon.IMG_ICON_EXT ?>" align="left" border="0" /><?php } ?>&nbsp;&nbsp;<?php echo encodeHtml($a5_title) ?>&nbsp;&nbsp;</legend><?php } ?><?php unset($a5_title) ?></fieldset></td></tr><?php
	$column_idx = 0;
?>
<tr
>
<?php $a4_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a4_header) ?><?php $a5_readonly=false;$a5_name='type';$a5_value='page';$a5_default=false;$a5_prefix='';$a5_suffix='';$a5_class='';$a5_onchange='';$a5_children='page_templateid,page_name'; ?><?php
		if ($this->isEditable() && !$this->isEditMode()) $a5_readonly=true;
		if	( isset($$a5_name)  )
			$a5_tmp_default = $$a5_name;
		elseif ( isset($a5_default) )
			$a5_tmp_default = $a5_default;
		else
			$a5_tmp_default = '';
 ?><input onclick="" class="radio" type="radio" id="id_<?php echo $a5_name.'_'.$a5_value ?>"  name="<?php echo $a5_prefix.$a5_name ?>"<?php if ( $a5_readonly ) echo ' disabled="disabled"' ?> value="<?php echo $a5_value ?>" <?php if($a5_value==$a5_tmp_default) echo 'checked="checked"' ?><?php if (in_array($a5_name,$errors)) echo ' style="borderx:2px dashed red; background-color:red;"' ?> />
<?php /* #END-IF# */ ?><?php unset($a5_readonly,$a5_name,$a5_value,$a5_default,$a5_prefix,$a5_suffix,$a5_class,$a5_onchange,$a5_children) ?></td><?php $a4_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a4_header) ?><?php $a5_for='type_page'; ?><label<?php if (isset($a5_for)) { ?> for="id_<?php echo $a5_for ?><?php if (!empty($a5_value)) echo '_'.$a5_value ?>" class="label"<?php } ?>>
<?php if (isset($a5_key)) { echo lang($a5_key); if(hasLang($a5_key.'_desc')) { ?><div class="description"><?php echo lang($a5_key.'_desc')?></div> <?php } } ?><?php unset($a5_for) ?><?php $a6_class='text';$a6_text='global_TEMPLATE';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_text,$a6_escape,$a6_cut) ?></label></td><?php $a4_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a4_header) ?><?php $a5_list='templates';$a5_name='page_templateid';$a5_onchange='';$a5_title='';$a5_class='';$a5_addempty=false;$a5_multiple=false;$a5_size='1';$a5_lang=false; ?><?php
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
?><?php unset($a5_list,$a5_name,$a5_onchange,$a5_title,$a5_class,$a5_addempty,$a5_multiple,$a5_size,$a5_lang) ?></td></tr><?php
	$column_idx = 0;
?>
<tr
>
<?php $a4_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a4_header) ?></td><?php $a4_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a4_header) ?><?php $a5_for='type_page'; ?><label<?php if (isset($a5_for)) { ?> for="id_<?php echo $a5_for ?><?php if (!empty($a5_value)) echo '_'.$a5_value ?>" class="label"<?php } ?>>
<?php if (isset($a5_key)) { echo lang($a5_key); if(hasLang($a5_key.'_desc')) { ?><div class="description"><?php echo lang($a5_key.'_desc')?></div> <?php } } ?><?php unset($a5_for) ?><?php $a6_class='text';$a6_text='global_NAME';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_text,$a6_escape,$a6_cut) ?></label></td><?php $a4_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a4_header) ?><?php $a5_class='name';$a5_default='';$a5_type='text';$a5_name='page_name';$a5_size='30';$a5_maxlength='250';$a5_onchange='';$a5_readonly=false; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a5_readonly=true;
	  if ($a5_readonly && empty($$a5_name)) $$a5_name = '- '.lang('EMPTY').' -';
      if(!isset($a5_default)) $a5_default='';
      $tmp_value = Text::encodeHtml(isset($$a5_name)?$$a5_name:$a5_default);
?><?php if (!$a5_readonly || $a5_type=='hidden') {
?><input<?php if ($a5_readonly) echo ' disabled="true"' ?> id="id_<?php echo $a5_name ?><?php if ($a5_readonly) echo '_disabled' ?>" name="<?php echo $a5_name ?><?php if ($a5_readonly) echo '_disabled' ?>" type="<?php echo $a5_type ?>" maxlength="<?php echo $a5_maxlength ?>" class="<?php echo str_replace(',',' ',$a5_class) ?>" value="<?php echo $tmp_value ?>" <?php if (in_array($a5_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php
if	($a5_readonly) {
?><input type="hidden" id="id_<?php echo $a5_name ?>" name="<?php echo $a5_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subactionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a5_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a5_class,$a5_default,$a5_type,$a5_name,$a5_size,$a5_maxlength,$a5_onchange,$a5_readonly) ?></td></tr><?php
	$column_idx = 0;
?>
<tr
>
<?php $a4_colspan='3';$a4_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
 colspan="3"
><?php unset($a4_colspan,$a4_header) ?><?php $a5_title=lang('link'); ?><fieldset><?php if(isset($a5_title)) { ?><legend><?php if(isset($a5_icon)) { ?><img src="<?php echo $image_dir.'icon_'.$a5_icon.IMG_ICON_EXT ?>" align="left" border="0" /><?php } ?>&nbsp;&nbsp;<?php echo encodeHtml($a5_title) ?>&nbsp;&nbsp;</legend><?php } ?><?php unset($a5_title) ?></fieldset></td></tr><?php
	$column_idx = 0;
?>
<tr
>
<?php $a4_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a4_header) ?><?php $a5_readonly=false;$a5_name='type';$a5_value='link';$a5_default=false;$a5_prefix='';$a5_suffix='';$a5_class='';$a5_onchange='';$a5_children='link_name'; ?><?php
		if ($this->isEditable() && !$this->isEditMode()) $a5_readonly=true;
		if	( isset($$a5_name)  )
			$a5_tmp_default = $$a5_name;
		elseif ( isset($a5_default) )
			$a5_tmp_default = $a5_default;
		else
			$a5_tmp_default = '';
 ?><input onclick="" class="radio" type="radio" id="id_<?php echo $a5_name.'_'.$a5_value ?>"  name="<?php echo $a5_prefix.$a5_name ?>"<?php if ( $a5_readonly ) echo ' disabled="disabled"' ?> value="<?php echo $a5_value ?>" <?php if($a5_value==$a5_tmp_default) echo 'checked="checked"' ?><?php if (in_array($a5_name,$errors)) echo ' style="borderx:2px dashed red; background-color:red;"' ?> />
<?php /* #END-IF# */ ?><?php unset($a5_readonly,$a5_name,$a5_value,$a5_default,$a5_prefix,$a5_suffix,$a5_class,$a5_onchange,$a5_children) ?></td><?php $a4_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a4_header) ?><?php $a5_for='type_link'; ?><label<?php if (isset($a5_for)) { ?> for="id_<?php echo $a5_for ?><?php if (!empty($a5_value)) echo '_'.$a5_value ?>" class="label"<?php } ?>>
<?php if (isset($a5_key)) { echo lang($a5_key); if(hasLang($a5_key.'_desc')) { ?><div class="description"><?php echo lang($a5_key.'_desc')?></div> <?php } } ?><?php unset($a5_for) ?><?php $a6_class='text';$a6_text='global_NAME';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_text,$a6_escape,$a6_cut) ?></label></td><?php $a4_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a4_header) ?><?php $a5_class='name';$a5_default='';$a5_type='text';$a5_name='link_name';$a5_size='30';$a5_maxlength='250';$a5_onchange='';$a5_readonly=false; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a5_readonly=true;
	  if ($a5_readonly && empty($$a5_name)) $$a5_name = '- '.lang('EMPTY').' -';
      if(!isset($a5_default)) $a5_default='';
      $tmp_value = Text::encodeHtml(isset($$a5_name)?$$a5_name:$a5_default);
?><?php if (!$a5_readonly || $a5_type=='hidden') {
?><input<?php if ($a5_readonly) echo ' disabled="true"' ?> id="id_<?php echo $a5_name ?><?php if ($a5_readonly) echo '_disabled' ?>" name="<?php echo $a5_name ?><?php if ($a5_readonly) echo '_disabled' ?>" type="<?php echo $a5_type ?>" maxlength="<?php echo $a5_maxlength ?>" class="<?php echo str_replace(',',' ',$a5_class) ?>" value="<?php echo $tmp_value ?>" <?php if (in_array($a5_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php
if	($a5_readonly) {
?><input type="hidden" id="id_<?php echo $a5_name ?>" name="<?php echo $a5_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subactionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a5_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a5_class,$a5_default,$a5_type,$a5_name,$a5_size,$a5_maxlength,$a5_onchange,$a5_readonly) ?></td></tr><?php
	$column_idx = 0;
?>
<tr
>
<?php $a4_class='act';$a4_colspan='3';$a4_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="act"
 colspan="3"
><?php unset($a4_class,$a4_colspan,$a4_header) ?><?php $a5_type='ok';$a5_class='ok';$a5_value='ok';$a5_text='button_ok'; ?><div class="invisible">
<?php
		if ($this->isEditable() && !$this->isEditMode() && !readonly() )
		{
			$a5_type = ''; // Knopf nicht anzeigen
			?><a class="action" href="<?php echo Html::url($actionName,$subactionName,0,array('mode'=>'edit')) ?>"><span title="<?php echo lang('MODE_EDIT_DESC') ?>"><?php echo langHtml('MODE_EDIT') ?></span></a><?php
		} else
		{
			$a5_type = 'submit';
		}
		$a5_tmp_src  = '';
	if	( !empty($a5_type)) { 
?>
<input type="<?php echo $a5_type ?>"<?php if(isset($a5_src)) { ?> src="<?php $a5_tmp_src ?>"<?php } ?> name="<?php echo $a5_value ?>" class="ok" title="<?php echo lang($a5_text.'_DESC') ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo langHtml($a5_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($a5_src); ?>
<?php }
		if ($this->isEditable() && $this->isEditMode() )
		{
			?><a class="action" href="<?php echo Html::url($actionName,$subactionName,0,array('mode'=>'')) ?>"><span title="<?php echo lang('CANCEL_DESC') ?>"><?php echo langHtml('CANCEL') ?></span></a><?php
		}
?>
</div><?php unset($a5_type,$a5_class,$a5_value,$a5_text) ?></td></tr></form>
