<!-- Compiling output/output-begin --><!-- Compiling header/header-begin --><?php $a2_name='';$a2_views='pw,remove';$a2_back=false; ?><?php if(!empty($a2_views)) { ?>
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
      enctype="application/x-www-form-urlencoded"
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
<!-- Compiling part/part-begin --><?php $a3_class='line'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?><!-- Compiling part/part-begin --><?php $a4_class='label'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling label/label-begin --><?php $a5_for='name';$a5_key='user_username'; ?><label<?php if (isset($a5_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a5_for ?><?php if (!empty($a5_value)) echo '_'.$a5_value ?>" <?php if(hasLang(@$a5_key.'_desc')) { ?> title="<?php echo lang(@$a5_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a5_key)) { echo lang($a5_key); ?><?php if (isset($a5_text)) { echo $a5_text; } ?><?php } ?><?php unset($a5_for,$a5_key) ?><!-- Compiling label/label-end --></label><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a4_class='input'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling input/input-begin --><?php $a5_class='name,focus';$a5_default='';$a5_type='text';$a5_name='name';$a5_size='20';$a5_maxlength='256';$a5_onchange='';$a5_readonly=false;$a5_hint='';$a5_icon=''; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a5_readonly=true;
	  if ($a5_readonly && empty($$a5_name)) $$a5_name = '- '.lang('EMPTY').' -';
      if(!isset($a5_default)) $a5_default='';
      $tmp_value = Text::encodeHtml(isset($$a5_name)?$$a5_name:$a5_default);
?><?php if (!$a5_readonly || $a5_type=='hidden') {
?><div class="<?php echo $a5_type!='hidden'?'inputholder':'inputhidden' ?>"><input<?php if ($a5_readonly) echo ' disabled="true"' ?><?php if ($a5_hint) echo ' data-hint="'.$a5_hint.'"'; ?> id="<?php echo REQUEST_ID ?>_<?php echo $a5_name ?><?php if ($a5_readonly) echo '_disabled' ?>" name="<?php echo $a5_name ?><?php if ($a5_readonly) echo '_disabled' ?>" type="<?php echo $a5_type ?>" maxlength="<?php echo $a5_maxlength ?>" class="<?php echo str_replace(',',' ',$a5_class) ?>" value="<?php echo $tmp_value ?>" /><?php if ($a5_icon) echo '<img src="'.$image_dir.'icon_'.$a5_icon.IMG_ICON_EXT.'" width="16" height="16" />'; ?></div><?php
if	($a5_readonly) {
?><input type="hidden" id="<?php echo REQUEST_ID ?>_<?php echo $a5_name ?>" name="<?php echo $a5_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subActionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a5_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a5_class,$a5_default,$a5_type,$a5_name,$a5_size,$a5_maxlength,$a5_onchange,$a5_readonly,$a5_hint,$a5_icon) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div>
			<fieldset class="<?php echo 1?" open":"" ?><?php echo 1?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('ADDITIONAL_INFO') ?></legend><div><!-- Compiling part/part-begin --><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin --><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling label/label-begin --><?php $a6_for='fullname';$a6_key='user_fullname'; ?><label<?php if (isset($a6_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" <?php if(hasLang(@$a6_key.'_desc')) { ?> title="<?php echo lang(@$a6_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); ?><?php if (isset($a6_text)) { echo $a6_text; } ?><?php } ?><?php unset($a6_for,$a6_key) ?><!-- Compiling label/label-end --></label><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling input/input-begin --><?php $a6_class='text';$a6_default='';$a6_type='text';$a6_name='fullname';$a6_size='';$a6_maxlength='256';$a6_onchange='';$a6_readonly=false;$a6_hint='';$a6_icon=''; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a6_readonly=true;
	  if ($a6_readonly && empty($$a6_name)) $$a6_name = '- '.lang('EMPTY').' -';
      if(!isset($a6_default)) $a6_default='';
      $tmp_value = Text::encodeHtml(isset($$a6_name)?$$a6_name:$a6_default);
?><?php if (!$a6_readonly || $a6_type=='hidden') {
?><div class="<?php echo $a6_type!='hidden'?'inputholder':'inputhidden' ?>"><input<?php if ($a6_readonly) echo ' disabled="true"' ?><?php if ($a6_hint) echo ' data-hint="'.$a6_hint.'"'; ?> id="<?php echo REQUEST_ID ?>_<?php echo $a6_name ?><?php if ($a6_readonly) echo '_disabled' ?>" name="<?php echo $a6_name ?><?php if ($a6_readonly) echo '_disabled' ?>" type="<?php echo $a6_type ?>" maxlength="<?php echo $a6_maxlength ?>" class="<?php echo str_replace(',',' ',$a6_class) ?>" value="<?php echo $tmp_value ?>" /><?php if ($a6_icon) echo '<img src="'.$image_dir.'icon_'.$a6_icon.IMG_ICON_EXT.'" width="16" height="16" />'; ?></div><?php
if	($a6_readonly) {
?><input type="hidden" id="<?php echo REQUEST_ID ?>_<?php echo $a6_name ?>" name="<?php echo $a6_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subActionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a6_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a6_class,$a6_default,$a6_type,$a6_name,$a6_size,$a6_maxlength,$a6_onchange,$a6_readonly,$a6_hint,$a6_icon) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div>
				<?php $if4=(@$conf['security']['user']['show_admin_mail']); if($if4){?><!-- Compiling part/part-begin --><?php $a5_class='line'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling part/part-begin --><?php $a6_class='label'; ?><div class="<?php echo $a6_class ?>"><?php unset($a6_class) ?><!-- Compiling label/label-begin --><?php $a7_for='mail';$a7_key='user_mail'; ?><label<?php if (isset($a7_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a7_for ?><?php if (!empty($a7_value)) echo '_'.$a7_value ?>" <?php if(hasLang(@$a7_key.'_desc')) { ?> title="<?php echo lang(@$a7_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a7_key)) { echo lang($a7_key); ?><?php if (isset($a7_text)) { echo $a7_text; } ?><?php } ?><?php unset($a7_for,$a7_key) ?><!-- Compiling label/label-end --></label><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a6_class='input'; ?><div class="<?php echo $a6_class ?>"><?php unset($a6_class) ?><!-- Compiling input/input-begin --><?php $a7_class='text';$a7_default='';$a7_type='text';$a7_name='mail';$a7_size='';$a7_maxlength='256';$a7_onchange='';$a7_readonly=false;$a7_hint='';$a7_icon=''; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a7_readonly=true;
	  if ($a7_readonly && empty($$a7_name)) $$a7_name = '- '.lang('EMPTY').' -';
      if(!isset($a7_default)) $a7_default='';
      $tmp_value = Text::encodeHtml(isset($$a7_name)?$$a7_name:$a7_default);
?><?php if (!$a7_readonly || $a7_type=='hidden') {
?><div class="<?php echo $a7_type!='hidden'?'inputholder':'inputhidden' ?>"><input<?php if ($a7_readonly) echo ' disabled="true"' ?><?php if ($a7_hint) echo ' data-hint="'.$a7_hint.'"'; ?> id="<?php echo REQUEST_ID ?>_<?php echo $a7_name ?><?php if ($a7_readonly) echo '_disabled' ?>" name="<?php echo $a7_name ?><?php if ($a7_readonly) echo '_disabled' ?>" type="<?php echo $a7_type ?>" maxlength="<?php echo $a7_maxlength ?>" class="<?php echo str_replace(',',' ',$a7_class) ?>" value="<?php echo $tmp_value ?>" /><?php if ($a7_icon) echo '<img src="'.$image_dir.'icon_'.$a7_icon.IMG_ICON_EXT.'" width="16" height="16" />'; ?></div><?php
if	($a7_readonly) {
?><input type="hidden" id="<?php echo REQUEST_ID ?>_<?php echo $a7_name ?>" name="<?php echo $a7_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subActionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a7_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a7_class,$a7_default,$a7_type,$a7_name,$a7_size,$a7_maxlength,$a7_onchange,$a7_readonly,$a7_hint,$a7_icon) ?>
							<div class="qrcode" data-qrcode="<?php echo 'mailto:'.$mail.'' ?>" title="<?php echo 'mailto:'.$mail.'' ?>"></div>
							<!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div>
				<?php } ?><!-- Compiling part/part-begin --><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin --><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling label/label-begin --><?php $a6_for='desc';$a6_key='user_desc'; ?><label<?php if (isset($a6_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" <?php if(hasLang(@$a6_key.'_desc')) { ?> title="<?php echo lang(@$a6_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); ?><?php if (isset($a6_text)) { echo $a6_text; } ?><?php } ?><?php unset($a6_for,$a6_key) ?><!-- Compiling label/label-end --></label><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling input/input-begin --><?php $a6_class='text';$a6_default='';$a6_type='text';$a6_name='desc';$a6_size='';$a6_maxlength='256';$a6_onchange='';$a6_readonly=false;$a6_hint='';$a6_icon=''; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a6_readonly=true;
	  if ($a6_readonly && empty($$a6_name)) $$a6_name = '- '.lang('EMPTY').' -';
      if(!isset($a6_default)) $a6_default='';
      $tmp_value = Text::encodeHtml(isset($$a6_name)?$$a6_name:$a6_default);
?><?php if (!$a6_readonly || $a6_type=='hidden') {
?><div class="<?php echo $a6_type!='hidden'?'inputholder':'inputhidden' ?>"><input<?php if ($a6_readonly) echo ' disabled="true"' ?><?php if ($a6_hint) echo ' data-hint="'.$a6_hint.'"'; ?> id="<?php echo REQUEST_ID ?>_<?php echo $a6_name ?><?php if ($a6_readonly) echo '_disabled' ?>" name="<?php echo $a6_name ?><?php if ($a6_readonly) echo '_disabled' ?>" type="<?php echo $a6_type ?>" maxlength="<?php echo $a6_maxlength ?>" class="<?php echo str_replace(',',' ',$a6_class) ?>" value="<?php echo $tmp_value ?>" /><?php if ($a6_icon) echo '<img src="'.$image_dir.'icon_'.$a6_icon.IMG_ICON_EXT.'" width="16" height="16" />'; ?></div><?php
if	($a6_readonly) {
?><input type="hidden" id="<?php echo REQUEST_ID ?>_<?php echo $a6_name ?>" name="<?php echo $a6_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subActionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a6_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a6_class,$a6_default,$a6_type,$a6_name,$a6_size,$a6_maxlength,$a6_onchange,$a6_readonly,$a6_hint,$a6_icon) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin --><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling label/label-begin --><?php $a6_for='tel';$a6_key='user_tel'; ?><label<?php if (isset($a6_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" <?php if(hasLang(@$a6_key.'_desc')) { ?> title="<?php echo lang(@$a6_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); ?><?php if (isset($a6_text)) { echo $a6_text; } ?><?php } ?><?php unset($a6_for,$a6_key) ?><!-- Compiling label/label-end --></label><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling input/input-begin --><?php $a6_class='text';$a6_default='';$a6_type='text';$a6_name='tel';$a6_size='';$a6_maxlength='256';$a6_onchange='';$a6_readonly=false;$a6_hint='';$a6_icon=''; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a6_readonly=true;
	  if ($a6_readonly && empty($$a6_name)) $$a6_name = '- '.lang('EMPTY').' -';
      if(!isset($a6_default)) $a6_default='';
      $tmp_value = Text::encodeHtml(isset($$a6_name)?$$a6_name:$a6_default);
?><?php if (!$a6_readonly || $a6_type=='hidden') {
?><div class="<?php echo $a6_type!='hidden'?'inputholder':'inputhidden' ?>"><input<?php if ($a6_readonly) echo ' disabled="true"' ?><?php if ($a6_hint) echo ' data-hint="'.$a6_hint.'"'; ?> id="<?php echo REQUEST_ID ?>_<?php echo $a6_name ?><?php if ($a6_readonly) echo '_disabled' ?>" name="<?php echo $a6_name ?><?php if ($a6_readonly) echo '_disabled' ?>" type="<?php echo $a6_type ?>" maxlength="<?php echo $a6_maxlength ?>" class="<?php echo str_replace(',',' ',$a6_class) ?>" value="<?php echo $tmp_value ?>" /><?php if ($a6_icon) echo '<img src="'.$image_dir.'icon_'.$a6_icon.IMG_ICON_EXT.'" width="16" height="16" />'; ?></div><?php
if	($a6_readonly) {
?><input type="hidden" id="<?php echo REQUEST_ID ?>_<?php echo $a6_name ?>" name="<?php echo $a6_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subActionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a6_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a6_class,$a6_default,$a6_type,$a6_name,$a6_size,$a6_maxlength,$a6_onchange,$a6_readonly,$a6_hint,$a6_icon) ?>
						<div class="qrcode" data-qrcode="<?php echo 'tel:'.$tel.'' ?>" title="<?php echo 'tel:'.$tel.'' ?>"></div>
						<!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin --><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling label/label-begin --><?php $a6_for='timezone_offset'; ?><label<?php if (isset($a6_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" <?php if(hasLang(@$a6_key.'_desc')) { ?> title="<?php echo lang(@$a6_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); ?><?php if (isset($a6_text)) { echo $a6_text; } ?><?php } ?><?php unset($a6_for) ?><!-- Compiling text/text-begin --><?php $a7_class='text';$a7_key='timezone';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_key,$a7_escape,$a7_cut) ?><!-- Compiling label/label-end --></label><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling selectbox/selectbox-begin --><?php $a6_list='timezone_list';$a6_name='timezone';$a6_onchange='';$a6_title='';$a6_class='';$a6_addempty=true;$a6_multiple=false;$a6_size='1';$a6_lang=false; ?><?php
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
?><?php unset($a6_list,$a6_name,$a6_onchange,$a6_title,$a6_class,$a6_addempty,$a6_multiple,$a6_size,$a6_lang) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin --><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling label/label-begin --><?php $a6_for=''; ?><label<?php if (isset($a6_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" <?php if(hasLang(@$a6_key.'_desc')) { ?> title="<?php echo lang(@$a6_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); ?><?php if (isset($a6_text)) { echo $a6_text; } ?><?php } ?><?php unset($a6_for) ?><!-- Compiling text/text-begin --><?php $a7_class='text';$a7_key='language';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_key,$a7_escape,$a7_cut) ?><!-- Compiling label/label-end --></label><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling selectbox/selectbox-begin --><?php $a6_list='language_list';$a6_name='language';$a6_onchange='';$a6_title='';$a6_class='';$a6_addempty=true;$a6_multiple=false;$a6_size='1';$a6_lang=false; ?><?php
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
?><?php unset($a6_list,$a6_name,$a6_onchange,$a6_title,$a6_class,$a6_addempty,$a6_multiple,$a6_size,$a6_lang) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div>
			</div></fieldset>
			<fieldset class="<?php echo 1?" open":"" ?><?php echo 1?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('options') ?></legend><div><!-- Compiling part/part-begin --><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin --><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?>
						<?php { $tmpname     = 'is_admin';$default  = '';$readonly = '';		
		if	( isset($$tmpname) )
			$checked = $$tmpname;
		else
			$checked = $default;

		?><input class="checkbox" type="checkbox" id="<?php echo REQUEST_ID ?>_<?php echo $tmpname ?>" name="<?php echo $tmpname  ?>"  <?php if ($readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?> /><?php

		if ( $readonly && $checked )
		{ 
		?><input type="hidden" name="<?php echo $tmpname ?>" value="1" /><?php
		}
		} ?>
						<!-- Compiling label/label-begin --><?php $a6_for='is_admin';$a6_key='user_admin'; ?><label<?php if (isset($a6_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" <?php if(hasLang(@$a6_key.'_desc')) { ?> title="<?php echo lang(@$a6_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); ?><?php if (isset($a6_text)) { echo $a6_text; } ?><?php } ?><?php unset($a6_for,$a6_key) ?><!-- Compiling label/label-end --></label><!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin --><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling label/label-begin --><?php $a6_for='ldap_dn';$a6_key='user_ldapdn'; ?><label<?php if (isset($a6_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" <?php if(hasLang(@$a6_key.'_desc')) { ?> title="<?php echo lang(@$a6_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); ?><?php if (isset($a6_text)) { echo $a6_text; } ?><?php } ?><?php unset($a6_for,$a6_key) ?><!-- Compiling label/label-end --></label><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling input/input-begin --><?php $a6_class='text';$a6_default='';$a6_type='text';$a6_name='ldap_dn';$a6_size='';$a6_maxlength='256';$a6_onchange='';$a6_readonly=false;$a6_hint='';$a6_icon=''; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a6_readonly=true;
	  if ($a6_readonly && empty($$a6_name)) $$a6_name = '- '.lang('EMPTY').' -';
      if(!isset($a6_default)) $a6_default='';
      $tmp_value = Text::encodeHtml(isset($$a6_name)?$$a6_name:$a6_default);
?><?php if (!$a6_readonly || $a6_type=='hidden') {
?><div class="<?php echo $a6_type!='hidden'?'inputholder':'inputhidden' ?>"><input<?php if ($a6_readonly) echo ' disabled="true"' ?><?php if ($a6_hint) echo ' data-hint="'.$a6_hint.'"'; ?> id="<?php echo REQUEST_ID ?>_<?php echo $a6_name ?><?php if ($a6_readonly) echo '_disabled' ?>" name="<?php echo $a6_name ?><?php if ($a6_readonly) echo '_disabled' ?>" type="<?php echo $a6_type ?>" maxlength="<?php echo $a6_maxlength ?>" class="<?php echo str_replace(',',' ',$a6_class) ?>" value="<?php echo $tmp_value ?>" /><?php if ($a6_icon) echo '<img src="'.$image_dir.'icon_'.$a6_icon.IMG_ICON_EXT.'" width="16" height="16" />'; ?></div><?php
if	($a6_readonly) {
?><input type="hidden" id="<?php echo REQUEST_ID ?>_<?php echo $a6_name ?>" name="<?php echo $a6_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subActionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a6_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a6_class,$a6_default,$a6_type,$a6_name,$a6_size,$a6_maxlength,$a6_onchange,$a6_readonly,$a6_hint,$a6_icon) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin --><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling label/label-begin --><?php $a6_for='style';$a6_key='user_style'; ?><label<?php if (isset($a6_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" <?php if(hasLang(@$a6_key.'_desc')) { ?> title="<?php echo lang(@$a6_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); ?><?php if (isset($a6_text)) { echo $a6_text; } ?><?php } ?><?php unset($a6_for,$a6_key) ?><!-- Compiling label/label-end --></label><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling selectbox/selectbox-begin --><?php $a6_list='allstyles';$a6_name='style';$a6_default=@$conf['interface']['style']['default'];$a6_onchange='';$a6_title='';$a6_class='';$a6_addempty=false;$a6_multiple=false;$a6_size='1';$a6_lang=false; ?><?php
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
?><?php unset($a6_list,$a6_name,$a6_default,$a6_onchange,$a6_title,$a6_class,$a6_addempty,$a6_multiple,$a6_size,$a6_lang) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div>
			</div></fieldset>
			<fieldset class="<?php echo 1?" open":"" ?><?php echo 1?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('security') ?></legend><div><!-- Compiling part/part-begin --><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin --><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling text/text-begin --><?php $a6_class='text';$a6_text=lang('user_password_expires');$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_text,$a6_escape,$a6_cut) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?>
						<?php include_once( OR_THEMES_DIR.'default/include/html/date/component-date.php') ?><?php component_date($passwordExpires) ?>
						<!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin --><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling text/text-begin --><?php $a6_class='text';$a6_text=lang('user_last_login');$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_text,$a6_escape,$a6_cut) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?>
						<?php include_once( OR_THEMES_DIR.'default/include/html/date/component-date.php') ?><?php component_date($lastLogin) ?>
						<!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin --><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling text/text-begin --><?php $a6_class='text';$a6_text=lang('token');$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_text,$a6_escape,$a6_cut) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling text/text-begin --><?php $a6_class='text';$a6_value=$totpToken;$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $a6_escape?htmlentities($a6_value):$a6_value;
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_value,$a6_escape,$a6_cut) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin --><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling label/label-begin --><?php $a6_for='otpsecret';$a6_key='user_totp'; ?><label<?php if (isset($a6_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" <?php if(hasLang(@$a6_key.'_desc')) { ?> title="<?php echo lang(@$a6_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); ?><?php if (isset($a6_text)) { echo $a6_text; } ?><?php } ?><?php unset($a6_for,$a6_key) ?><!-- Compiling label/label-end --></label><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?>
						<?php { $tmpname     = 'totp';$default  = '';$readonly = '';		
		if	( isset($$tmpname) )
			$checked = $$tmpname;
		else
			$checked = $default;

		?><input class="checkbox" type="checkbox" id="<?php echo REQUEST_ID ?>_<?php echo $tmpname ?>" name="<?php echo $tmpname  ?>"  <?php if ($readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?> /><?php

		if ( $readonly && $checked )
		{ 
		?><input type="hidden" name="<?php echo $tmpname ?>" value="1" /><?php
		}
		} ?>
						<!-- Compiling label/label-begin --><?php $a6_for='totp';$a6_key='user_totp'; ?><label<?php if (isset($a6_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" <?php if(hasLang(@$a6_key.'_desc')) { ?> title="<?php echo lang(@$a6_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); ?><?php if (isset($a6_text)) { echo $a6_text; } ?><?php } ?><?php unset($a6_for,$a6_key) ?><!-- Compiling label/label-end --></label><!-- Compiling text/text-begin --><?php $a6_class='text';$a6_var='otpSecret';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = isset($$a6_var)?$$a6_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_var,$a6_escape,$a6_cut) ?>
						<div class="qrcode" data-qrcode="<?php echo $totpSecretUrl ?>" title="<?php echo $totpSecretUrl ?>"></div>
						<!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin --><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling label/label-begin --><?php $a6_for='otpsecret';$a6_key='user_hotp'; ?><label<?php if (isset($a6_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" <?php if(hasLang(@$a6_key.'_desc')) { ?> title="<?php echo lang(@$a6_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); ?><?php if (isset($a6_text)) { echo $a6_text; } ?><?php } ?><?php unset($a6_for,$a6_key) ?><!-- Compiling label/label-end --></label><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?>
						<?php { $tmpname     = 'hotp';$default  = '';$readonly = '';		
		if	( isset($$tmpname) )
			$checked = $$tmpname;
		else
			$checked = $default;

		?><input class="checkbox" type="checkbox" id="<?php echo REQUEST_ID ?>_<?php echo $tmpname ?>" name="<?php echo $tmpname  ?>"  <?php if ($readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?> /><?php

		if ( $readonly && $checked )
		{ 
		?><input type="hidden" name="<?php echo $tmpname ?>" value="1" /><?php
		}
		} ?>
						<!-- Compiling label/label-begin --><?php $a6_for='hotp';$a6_key='user_hotp'; ?><label<?php if (isset($a6_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" <?php if(hasLang(@$a6_key.'_desc')) { ?> title="<?php echo lang(@$a6_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); ?><?php if (isset($a6_text)) { echo $a6_text; } ?><?php } ?><?php unset($a6_for,$a6_key) ?><!-- Compiling label/label-end --></label>
						<div class="qrcode" data-qrcode="<?php echo $hotpSecretUrl ?>" title="<?php echo $hotpSecretUrl ?>"></div>
						<!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div>
			</div></fieldset>
		
<div class="bottom">
	<div class="command ">
	
		<input type="button" class="submit ok" value="OK" onclick="$(this).closest('div.sheet').find('form').submit(); " />
		
		<!-- Cancel-Button nicht anzeigen, wenn cancel==false. -->	</div>
</div>

</form>