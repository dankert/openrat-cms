<!-- Compiling output/output-begin --><!-- Compiling header/header-begin --><?php $a2_name='';$a2_back=true; ?><?php if(!empty($a2_views)) { ?>
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
<?php unset($a2_name,$a2_back) ?>
		<form name=""
      target="upload"
      action="<?php echo OR_ACTION ?>"
      data-method="<?php echo OR_METHOD ?>"
      data-action="<?php echo OR_ACTION ?>"
      data-id="<?php echo OR_ID ?>"
      method="<?php echo OR_METHOD ?>"
      enctype="multipart/form-data"
      class="<?php echo OR_ACTION ?>"
      data-async=""
      data-autosave=""
      onSubmit=""><input type="submit" class="invisible" />
      
<input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo OR_ACTION ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo OR_METHOD ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
<?php
		if	( $conf['interface']['url_sessionid'] )
			echo '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";
?>
<!-- Compiling hidden/hidden-begin --><?php $a3_name='type';$a3_default='file'; ?><?php
if (isset($$a3_name))
	$a3_tmp_value = $$a3_name;
elseif ( isset($a3_default) )
	$a3_tmp_value = $a3_default;
else
	$a3_tmp_value = "";
?><input type="hidden" name="<?php echo $a3_name ?>" value="<?php echo $a3_tmp_value ?>" /><?php unset($a3_name,$a3_default) ?><!-- Compiling part/part-begin --><?php $a3_class='line'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?><!-- Compiling part/part-begin --><?php $a4_class='label'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling label/label-begin --><?php $a5_for='name'; ?><label<?php if (isset($a5_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a5_for ?><?php if (!empty($a5_value)) echo '_'.$a5_value ?>" <?php if(hasLang(@$a5_key.'_desc')) { ?> title="<?php echo lang(@$a5_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a5_key)) { echo lang($a5_key); ?><?php if (isset($a5_text)) { echo $a5_text; } ?><?php } ?><?php unset($a5_for) ?><!-- Compiling text/text-begin --><?php $a6_class='text';$a6_text='global_FILE';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_text,$a6_escape,$a6_cut) ?><!-- Compiling label/label-end --></label><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a4_class='input'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?>
					<input size="" id="req1511991658588812600_file" type="file" maxlength="<?php echo $maxlength ?>" name="file" class=""  multiple="multiple" />
					<!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a3_class='line filedropzone'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?><!-- Compiling part/part-begin --><?php $a4_class='label'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a4_class='input'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a3_class='line'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?><!-- Compiling part/part-begin --><?php $a4_class='label'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling text/text-begin --><?php $a5_class='help';$a5_key='file_max_size';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = $langF($a5_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_key,$a5_escape,$a5_cut) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a4_class='input'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling text/text-begin --><?php $a5_class='text';$a5_var='max_size';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = isset($$a5_var)?$$a5_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_var,$a5_escape,$a5_cut) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a3_class='line'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?><!-- Compiling part/part-begin --><?php $a4_class='label'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling text/text-begin --><?php $a5_class='text';$a5_key='HTTP_URL';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = $langF($a5_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_key,$a5_escape,$a5_cut) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a4_class='input'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling input/input-begin --><?php $a5_class='text';$a5_default='';$a5_type='text';$a5_name='url';$a5_size='50';$a5_maxlength='256';$a5_onchange='';$a5_readonly=false;$a5_hint='';$a5_icon=''; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a5_readonly=true;
	  if ($a5_readonly && empty($$a5_name)) $$a5_name = '- '.lang('EMPTY').' -';
      if(!isset($a5_default)) $a5_default='';
      $tmp_value = Text::encodeHtml(isset($$a5_name)?$$a5_name:$a5_default);
?><?php if (!$a5_readonly || $a5_type=='hidden') {
?><div class="<?php echo $a5_type!='hidden'?'inputholder':'inputhidden' ?>"><input<?php if ($a5_readonly) echo ' disabled="true"' ?><?php if ($a5_hint) echo ' data-hint="'.$a5_hint.'"'; ?> id="<?php echo REQUEST_ID ?>_<?php echo $a5_name ?><?php if ($a5_readonly) echo '_disabled' ?>" name="<?php echo $a5_name ?><?php if ($a5_readonly) echo '_disabled' ?>" type="<?php echo $a5_type ?>" maxlength="<?php echo $a5_maxlength ?>" class="<?php echo str_replace(',',' ',$a5_class) ?>" value="<?php echo $tmp_value ?>" /><?php if ($a5_icon) echo '<img src="'.$image_dir.'icon_'.$a5_icon.IMG_ICON_EXT.'" width="16" height="16" />'; ?></div><?php
if	($a5_readonly) {
?><input type="hidden" id="<?php echo REQUEST_ID ?>_<?php echo $a5_name ?>" name="<?php echo $a5_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subActionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a5_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a5_class,$a5_default,$a5_type,$a5_name,$a5_size,$a5_maxlength,$a5_onchange,$a5_readonly,$a5_hint,$a5_icon) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div>
			<fieldset class="<?php echo 1?" open":"" ?><?php echo 1?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('description') ?></legend><div>
			</div></fieldset><!-- Compiling part/part-begin --><?php $a3_class='line'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?><!-- Compiling part/part-begin --><?php $a4_class='label'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling text/text-begin --><?php $a5_class='text';$a5_text='global_NAME';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = $langF($a5_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_text,$a5_escape,$a5_cut) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a4_class='input'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling input/input-begin --><?php $a5_class='text';$a5_default='';$a5_type='text';$a5_name='name';$a5_size='50';$a5_maxlength='256';$a5_onchange='';$a5_readonly=false;$a5_hint='';$a5_icon=''; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a5_readonly=true;
	  if ($a5_readonly && empty($$a5_name)) $$a5_name = '- '.lang('EMPTY').' -';
      if(!isset($a5_default)) $a5_default='';
      $tmp_value = Text::encodeHtml(isset($$a5_name)?$$a5_name:$a5_default);
?><?php if (!$a5_readonly || $a5_type=='hidden') {
?><div class="<?php echo $a5_type!='hidden'?'inputholder':'inputhidden' ?>"><input<?php if ($a5_readonly) echo ' disabled="true"' ?><?php if ($a5_hint) echo ' data-hint="'.$a5_hint.'"'; ?> id="<?php echo REQUEST_ID ?>_<?php echo $a5_name ?><?php if ($a5_readonly) echo '_disabled' ?>" name="<?php echo $a5_name ?><?php if ($a5_readonly) echo '_disabled' ?>" type="<?php echo $a5_type ?>" maxlength="<?php echo $a5_maxlength ?>" class="<?php echo str_replace(',',' ',$a5_class) ?>" value="<?php echo $tmp_value ?>" /><?php if ($a5_icon) echo '<img src="'.$image_dir.'icon_'.$a5_icon.IMG_ICON_EXT.'" width="16" height="16" />'; ?></div><?php
if	($a5_readonly) {
?><input type="hidden" id="<?php echo REQUEST_ID ?>_<?php echo $a5_name ?>" name="<?php echo $a5_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subActionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a5_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a5_class,$a5_default,$a5_type,$a5_name,$a5_size,$a5_maxlength,$a5_onchange,$a5_readonly,$a5_hint,$a5_icon) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a3_class='line'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?><!-- Compiling part/part-begin --><?php $a4_class='label'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling text/text-begin --><?php $a5_class='text';$a5_text='global_DESCRIPTION';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = $langF($a5_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_text,$a5_escape,$a5_cut) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a4_class='input'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling inputarea/inputarea-begin --><?php $a5_name='description';$a5_rows='5';$a5_cols='50';$a5_class='inputarea';$a5_default=''; ?><div class="inputholder"><textarea class="<?php echo $a5_class ?>" name="<?php echo $a5_name ?>" ><?php echo Text::encodeHtml(isset($$a5_name)?$$a5_name:$a5_default) ?></textarea></div><?php unset($a5_name,$a5_rows,$a5_cols,$a5_class,$a5_default) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div>
		
<div class="bottom">
	<div class="command true">
	
		<input type="button" class="submit ok" value="OK" onclick="$(this).closest('div.sheet').find('form').submit(); " />
		
		<!-- Cancel-Button nicht anzeigen, wenn cancel==false. -->	</div>
</div>

</form>

		
		