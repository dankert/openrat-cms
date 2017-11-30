<!-- Compiling output/output-begin --><!-- Compiling header/header-begin --><?php $a2_name='';$a2_views='createfolder,createlink,createpage,createfile';$a2_back=true; ?><?php if(!empty($a2_views)) { ?>
  <div class="headermenu">
    <?php foreach( explode(',',$a2_views) as $a2_tmp_view ) { ?>
  	<div class="toolbar-icon clickable">
    <a href="javascript:void(0);" data-type="dialog" data-name="<?php echo lang('MENU_'.$a2_tmp_view) ?>" data-method="<?php echo $a2_tmp_view ?>">
		  <img src="<?php  echo $image_dir ?>icon/<?php echo $a2_tmp_view ?>.png" title="<?php echo lang('MENU_'.$a2_tmp_view.'_DESC') ?>" /> <?php echo lang('MENU_'.$a2_tmp_view) ?>
		</a>
  </div>
		<?php } ?>
  </div>
<?php } ?>
<?php unset($a2_name,$a2_views,$a2_back) ?>
		<form name=""
      target="_self"
      action="<?php echo OR_ACTION ?>"
      data-method="<?php echo OR_METHOD ?>"
      data-action="<?php echo OR_ACTION ?>"
      data-id="<?php echo OR_ID ?>"
      method="<?php echo OR_METHOD ?>"
      enctype="multipart/form-data"
      class="<?php echo OR_ACTION ?>"
      data-async=""
      data-autosave=""
      onSubmit="formSubmit( $(this) ); return false;"><input type="submit" class="invisible" />
      
<input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo OR_ACTION ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo OR_METHOD ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
<?php
		if	( $conf['interface']['url_sessionid'] )
			echo '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";
?>

			<fieldset class="<?php echo 1?" open":"" ?><?php echo 1?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('folder') ?></legend><div><!-- Compiling part/part-begin --><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin --><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling radio/radio-begin --><?php $a6_readonly=false;$a6_name='type';$a6_value='folder';$a6_default=false;$a6_prefix='';$a6_suffix='';$a6_class='';$a6_onchange='';$a6_children='folder_name'; ?><?php
		if ($this->isEditable() && !$this->isEditMode()) $a6_readonly=true;
		if	( isset($$a6_name)  )
			$a6_tmp_default = $$a6_name;
		elseif ( isset($a6_default) )
			$a6_tmp_default = $a6_default;
		else
			$a6_tmp_default = '';
 ?><input onclick="" class="radio" type="radio" id="<?php echo REQUEST_ID ?>_<?php echo $a6_name.'_'.$a6_value ?>"  name="<?php echo $a6_prefix.$a6_name ?>"<?php if ( $a6_readonly ) echo ' disabled="disabled"' ?> value="<?php echo $a6_value ?>"<?php if($a6_value==$a6_tmp_default||@$a6_checked) echo ' checked="checked"' ?> />
<?php /* #END-IF# */ ?><?php unset($a6_readonly,$a6_name,$a6_value,$a6_default,$a6_prefix,$a6_suffix,$a6_class,$a6_onchange,$a6_children) ?><!-- Compiling label/label-begin --><?php $a6_for='type_folder'; ?><label<?php if (isset($a6_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" <?php if(hasLang(@$a6_key.'_desc')) { ?> title="<?php echo lang(@$a6_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); ?><?php if (isset($a6_text)) { echo $a6_text; } ?><?php } ?><?php unset($a6_for) ?><!-- Compiling text/text-begin --><?php $a7_class='text';$a7_text='global_folder';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_text,$a7_escape,$a7_cut) ?><!-- Compiling label/label-end --></label><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling input/input-begin --><?php $a6_class='name';$a6_default='';$a6_type='text';$a6_name='folder_name';$a6_size='30';$a6_maxlength='250';$a6_onchange='';$a6_readonly=false;$a6_hint='';$a6_icon=''; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a6_readonly=true;
	  if ($a6_readonly && empty($$a6_name)) $$a6_name = '- '.lang('EMPTY').' -';
      if(!isset($a6_default)) $a6_default='';
      $tmp_value = Text::encodeHtml(isset($$a6_name)?$$a6_name:$a6_default);
?><?php if (!$a6_readonly || $a6_type=='hidden') {
?><div class="<?php echo $a6_type!='hidden'?'inputholder':'inputhidden' ?>"><input<?php if ($a6_readonly) echo ' disabled="true"' ?><?php if ($a6_hint) echo ' data-hint="'.$a6_hint.'"'; ?> id="<?php echo REQUEST_ID ?>_<?php echo $a6_name ?><?php if ($a6_readonly) echo '_disabled' ?>" name="<?php echo $a6_name ?><?php if ($a6_readonly) echo '_disabled' ?>" type="<?php echo $a6_type ?>" maxlength="<?php echo $a6_maxlength ?>" class="<?php echo str_replace(',',' ',$a6_class) ?>" value="<?php echo $tmp_value ?>" /><?php if ($a6_icon) echo '<img src="'.$image_dir.'icon_'.$a6_icon.IMG_ICON_EXT.'" width="16" height="16" />'; ?></div><?php
if	($a6_readonly) {
?><input type="hidden" id="<?php echo REQUEST_ID ?>_<?php echo $a6_name ?>" name="<?php echo $a6_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subActionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a6_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a6_class,$a6_default,$a6_type,$a6_name,$a6_size,$a6_maxlength,$a6_onchange,$a6_readonly,$a6_hint,$a6_icon) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div>
			</div></fieldset>
			<fieldset class="<?php echo 1?" open":"" ?><?php echo 1?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('file') ?></legend><div><!-- Compiling part/part-begin --><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin --><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling radio/radio-begin --><?php $a6_readonly=false;$a6_name='type';$a6_value='file';$a6_default=false;$a6_prefix='';$a6_suffix='';$a6_class='';$a6_onchange='';$a6_children='file'; ?><?php
		if ($this->isEditable() && !$this->isEditMode()) $a6_readonly=true;
		if	( isset($$a6_name)  )
			$a6_tmp_default = $$a6_name;
		elseif ( isset($a6_default) )
			$a6_tmp_default = $a6_default;
		else
			$a6_tmp_default = '';
 ?><input onclick="" class="radio" type="radio" id="<?php echo REQUEST_ID ?>_<?php echo $a6_name.'_'.$a6_value ?>"  name="<?php echo $a6_prefix.$a6_name ?>"<?php if ( $a6_readonly ) echo ' disabled="disabled"' ?> value="<?php echo $a6_value ?>"<?php if($a6_value==$a6_tmp_default||@$a6_checked) echo ' checked="checked"' ?> />
<?php /* #END-IF# */ ?><?php unset($a6_readonly,$a6_name,$a6_value,$a6_default,$a6_prefix,$a6_suffix,$a6_class,$a6_onchange,$a6_children) ?><!-- Compiling label/label-begin --><?php $a6_for='type_file'; ?><label<?php if (isset($a6_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" <?php if(hasLang(@$a6_key.'_desc')) { ?> title="<?php echo lang(@$a6_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); ?><?php if (isset($a6_text)) { echo $a6_text; } ?><?php } ?><?php unset($a6_for) ?><!-- Compiling text/text-begin --><?php $a7_class='text';$a7_text='global_FILE';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_text,$a7_escape,$a7_cut) ?><!-- Compiling label/label-end --></label><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?>
						<input size="30" id="req1511991655129390138_file" type="file" maxlength="<?php echo $maxlength ?>" name="file" class=""  />
						<!-- Compiling newline/newline-begin --><br/><!-- Compiling text/text-begin --><?php $a6_class='help';$a6_key='file_max_size';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_key,$a6_escape,$a6_cut) ?><!-- Compiling text/text-begin --><?php $a6_class='text';$a6_raw='_';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a6_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_raw,$a6_escape,$a6_cut) ?><!-- Compiling text/text-begin --><?php $a6_class='text';$a6_var='max_size';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = isset($$a6_var)?$$a6_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_var,$a6_escape,$a6_cut) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div>
			</div></fieldset>
			<fieldset class="<?php echo 1?" open":"" ?><?php echo 1?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('page') ?></legend><div><!-- Compiling part/part-begin --><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin --><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling radio/radio-begin --><?php $a6_readonly=false;$a6_name='type';$a6_value='page';$a6_default=false;$a6_prefix='';$a6_suffix='';$a6_class='';$a6_onchange='';$a6_children='page_templateid,page_name'; ?><?php
		if ($this->isEditable() && !$this->isEditMode()) $a6_readonly=true;
		if	( isset($$a6_name)  )
			$a6_tmp_default = $$a6_name;
		elseif ( isset($a6_default) )
			$a6_tmp_default = $a6_default;
		else
			$a6_tmp_default = '';
 ?><input onclick="" class="radio" type="radio" id="<?php echo REQUEST_ID ?>_<?php echo $a6_name.'_'.$a6_value ?>"  name="<?php echo $a6_prefix.$a6_name ?>"<?php if ( $a6_readonly ) echo ' disabled="disabled"' ?> value="<?php echo $a6_value ?>"<?php if($a6_value==$a6_tmp_default||@$a6_checked) echo ' checked="checked"' ?> />
<?php /* #END-IF# */ ?><?php unset($a6_readonly,$a6_name,$a6_value,$a6_default,$a6_prefix,$a6_suffix,$a6_class,$a6_onchange,$a6_children) ?><!-- Compiling label/label-begin --><?php $a6_for='type_page'; ?><label<?php if (isset($a6_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" <?php if(hasLang(@$a6_key.'_desc')) { ?> title="<?php echo lang(@$a6_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); ?><?php if (isset($a6_text)) { echo $a6_text; } ?><?php } ?><?php unset($a6_for) ?><!-- Compiling text/text-begin --><?php $a7_class='text';$a7_text='global_TEMPLATE';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_text,$a7_escape,$a7_cut) ?><!-- Compiling label/label-end --></label><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling selectbox/selectbox-begin --><?php $a6_list='templates';$a6_name='page_templateid';$a6_onchange='';$a6_title='';$a6_class='';$a6_addempty=false;$a6_multiple=false;$a6_size='1';$a6_lang=false; ?><?php
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
?><div class="inputholder"><select<?php if ($a6_readonly) echo ' disabled="disabled"' ?> id="<?php echo REQUEST_ID ?>_<?php echo $a6_name ?>"  name="<?php echo $a6_name; if ($a6_multiple) echo '[]'; ?>" onchange="<?php echo $a6_onchange ?>" title="<?php echo $a6_title ?>" class="<?php echo $a6_class ?>"<?php
if (count($$a6_list)<=1) echo ' disabled="disabled"';
if	($a6_multiple) echo ' multiple="multiple"';
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
?></select></div><?php
if (count($$a6_list)==0) echo '<input type="hidden" name="'.$a6_name.'" value="" />';
if (count($$a6_list)==1) echo '<input type="hidden" name="'.$a6_name.'" value="'.$box_key.'" />';
}
?><?php unset($a6_list,$a6_name,$a6_onchange,$a6_title,$a6_class,$a6_addempty,$a6_multiple,$a6_size,$a6_lang) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin --><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling label/label-begin --><?php $a6_for='type_page'; ?><label<?php if (isset($a6_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" <?php if(hasLang(@$a6_key.'_desc')) { ?> title="<?php echo lang(@$a6_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); ?><?php if (isset($a6_text)) { echo $a6_text; } ?><?php } ?><?php unset($a6_for) ?><!-- Compiling text/text-begin --><?php $a7_class='text';$a7_text='global_NAME';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_text,$a7_escape,$a7_cut) ?><!-- Compiling label/label-end --></label><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling input/input-begin --><?php $a6_class='name';$a6_default='';$a6_type='text';$a6_name='page_name';$a6_size='30';$a6_maxlength='250';$a6_onchange='';$a6_readonly=false;$a6_hint='';$a6_icon=''; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a6_readonly=true;
	  if ($a6_readonly && empty($$a6_name)) $$a6_name = '- '.lang('EMPTY').' -';
      if(!isset($a6_default)) $a6_default='';
      $tmp_value = Text::encodeHtml(isset($$a6_name)?$$a6_name:$a6_default);
?><?php if (!$a6_readonly || $a6_type=='hidden') {
?><div class="<?php echo $a6_type!='hidden'?'inputholder':'inputhidden' ?>"><input<?php if ($a6_readonly) echo ' disabled="true"' ?><?php if ($a6_hint) echo ' data-hint="'.$a6_hint.'"'; ?> id="<?php echo REQUEST_ID ?>_<?php echo $a6_name ?><?php if ($a6_readonly) echo '_disabled' ?>" name="<?php echo $a6_name ?><?php if ($a6_readonly) echo '_disabled' ?>" type="<?php echo $a6_type ?>" maxlength="<?php echo $a6_maxlength ?>" class="<?php echo str_replace(',',' ',$a6_class) ?>" value="<?php echo $tmp_value ?>" /><?php if ($a6_icon) echo '<img src="'.$image_dir.'icon_'.$a6_icon.IMG_ICON_EXT.'" width="16" height="16" />'; ?></div><?php
if	($a6_readonly) {
?><input type="hidden" id="<?php echo REQUEST_ID ?>_<?php echo $a6_name ?>" name="<?php echo $a6_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subActionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a6_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a6_class,$a6_default,$a6_type,$a6_name,$a6_size,$a6_maxlength,$a6_onchange,$a6_readonly,$a6_hint,$a6_icon) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div>
			</div></fieldset>
			<fieldset class="<?php echo 1?" open":"" ?><?php echo 1?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('link') ?></legend><div><!-- Compiling part/part-begin --><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin --><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling radio/radio-begin --><?php $a6_readonly=false;$a6_name='type';$a6_value='link';$a6_default=false;$a6_prefix='';$a6_suffix='';$a6_class='';$a6_onchange='';$a6_children='link_name'; ?><?php
		if ($this->isEditable() && !$this->isEditMode()) $a6_readonly=true;
		if	( isset($$a6_name)  )
			$a6_tmp_default = $$a6_name;
		elseif ( isset($a6_default) )
			$a6_tmp_default = $a6_default;
		else
			$a6_tmp_default = '';
 ?><input onclick="" class="radio" type="radio" id="<?php echo REQUEST_ID ?>_<?php echo $a6_name.'_'.$a6_value ?>"  name="<?php echo $a6_prefix.$a6_name ?>"<?php if ( $a6_readonly ) echo ' disabled="disabled"' ?> value="<?php echo $a6_value ?>"<?php if($a6_value==$a6_tmp_default||@$a6_checked) echo ' checked="checked"' ?> />
<?php /* #END-IF# */ ?><?php unset($a6_readonly,$a6_name,$a6_value,$a6_default,$a6_prefix,$a6_suffix,$a6_class,$a6_onchange,$a6_children) ?><!-- Compiling label/label-begin --><?php $a6_for='type_link'; ?><label<?php if (isset($a6_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" <?php if(hasLang(@$a6_key.'_desc')) { ?> title="<?php echo lang(@$a6_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); ?><?php if (isset($a6_text)) { echo $a6_text; } ?><?php } ?><?php unset($a6_for) ?><!-- Compiling text/text-begin --><?php $a7_class='text';$a7_text='global_NAME';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_text,$a7_escape,$a7_cut) ?><!-- Compiling label/label-end --></label><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling input/input-begin --><?php $a6_class='name';$a6_default='';$a6_type='text';$a6_name='link_name';$a6_size='30';$a6_maxlength='250';$a6_onchange='';$a6_readonly=false;$a6_hint='';$a6_icon=''; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a6_readonly=true;
	  if ($a6_readonly && empty($$a6_name)) $$a6_name = '- '.lang('EMPTY').' -';
      if(!isset($a6_default)) $a6_default='';
      $tmp_value = Text::encodeHtml(isset($$a6_name)?$$a6_name:$a6_default);
?><?php if (!$a6_readonly || $a6_type=='hidden') {
?><div class="<?php echo $a6_type!='hidden'?'inputholder':'inputhidden' ?>"><input<?php if ($a6_readonly) echo ' disabled="true"' ?><?php if ($a6_hint) echo ' data-hint="'.$a6_hint.'"'; ?> id="<?php echo REQUEST_ID ?>_<?php echo $a6_name ?><?php if ($a6_readonly) echo '_disabled' ?>" name="<?php echo $a6_name ?><?php if ($a6_readonly) echo '_disabled' ?>" type="<?php echo $a6_type ?>" maxlength="<?php echo $a6_maxlength ?>" class="<?php echo str_replace(',',' ',$a6_class) ?>" value="<?php echo $tmp_value ?>" /><?php if ($a6_icon) echo '<img src="'.$image_dir.'icon_'.$a6_icon.IMG_ICON_EXT.'" width="16" height="16" />'; ?></div><?php
if	($a6_readonly) {
?><input type="hidden" id="<?php echo REQUEST_ID ?>_<?php echo $a6_name ?>" name="<?php echo $a6_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subActionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a6_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a6_class,$a6_default,$a6_type,$a6_name,$a6_size,$a6_maxlength,$a6_onchange,$a6_readonly,$a6_hint,$a6_icon) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div>
			</div></fieldset>
		
<div class="bottom">
	<div class="command ">
	
		<input type="button" class="submit ok" value="OK" onclick="$(this).closest('div.sheet').find('form').submit(); " />
		
		<!-- Cancel-Button nicht anzeigen, wenn cancel==false. -->	</div>
</div>

</form>
