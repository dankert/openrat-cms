<!-- Compiling output/output-begin --><!-- Compiling header/header-begin --><?php $a2_name='';$a2_back=false; ?><?php if(!empty($a2_views)) { ?>
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
<!-- Compiling part/part-begin --><?php $a3_class='line'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?><!-- Compiling part/part-begin --><?php $a4_class='label'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling label/label-begin --><?php $a5_for='name';$a5_key='global_name'; ?><label<?php if (isset($a5_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a5_for ?><?php if (!empty($a5_value)) echo '_'.$a5_value ?>" <?php if(hasLang(@$a5_key.'_desc')) { ?> title="<?php echo lang(@$a5_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a5_key)) { echo lang($a5_key); ?><?php if (isset($a5_text)) { echo $a5_text; } ?><?php } ?><?php unset($a5_for,$a5_key) ?><!-- Compiling label/label-end --></label><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a4_class='input'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling input/input-begin --><?php $a5_class='name,focus';$a5_default='';$a5_type='text';$a5_name='name';$a5_size='';$a5_maxlength='256';$a5_onchange='';$a5_readonly=false;$a5_hint='';$a5_icon=''; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a5_readonly=true;
	  if ($a5_readonly && empty($$a5_name)) $$a5_name = '- '.lang('EMPTY').' -';
      if(!isset($a5_default)) $a5_default='';
      $tmp_value = Text::encodeHtml(isset($$a5_name)?$$a5_name:$a5_default);
?><?php if (!$a5_readonly || $a5_type=='hidden') {
?><div class="<?php echo $a5_type!='hidden'?'inputholder':'inputhidden' ?>"><input<?php if ($a5_readonly) echo ' disabled="true"' ?><?php if ($a5_hint) echo ' data-hint="'.$a5_hint.'"'; ?> id="<?php echo REQUEST_ID ?>_<?php echo $a5_name ?><?php if ($a5_readonly) echo '_disabled' ?>" name="<?php echo $a5_name ?><?php if ($a5_readonly) echo '_disabled' ?>" type="<?php echo $a5_type ?>" maxlength="<?php echo $a5_maxlength ?>" class="<?php echo str_replace(',',' ',$a5_class) ?>" value="<?php echo $tmp_value ?>" /><?php if ($a5_icon) echo '<img src="'.$image_dir.'icon_'.$a5_icon.IMG_ICON_EXT.'" width="16" height="16" />'; ?></div><?php
if	($a5_readonly) {
?><input type="hidden" id="<?php echo REQUEST_ID ?>_<?php echo $a5_name ?>" name="<?php echo $a5_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subActionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a5_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a5_class,$a5_default,$a5_type,$a5_name,$a5_size,$a5_maxlength,$a5_onchange,$a5_readonly,$a5_hint,$a5_icon) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a3_class='line'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?><!-- Compiling part/part-begin --><?php $a4_class='label'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling label/label-begin --><?php $a5_for='filename';$a5_key='global_filename'; ?><label<?php if (isset($a5_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a5_for ?><?php if (!empty($a5_value)) echo '_'.$a5_value ?>" <?php if(hasLang(@$a5_key.'_desc')) { ?> title="<?php echo lang(@$a5_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a5_key)) { echo lang($a5_key); ?><?php if (isset($a5_text)) { echo $a5_text; } ?><?php } ?><?php unset($a5_for,$a5_key) ?><!-- Compiling label/label-end --></label><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a4_class='input'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling input/input-begin --><?php $a5_class='filename';$a5_default='';$a5_type='text';$a5_name='filename';$a5_size='';$a5_maxlength='256';$a5_onchange='';$a5_readonly=false;$a5_hint='';$a5_icon=''; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a5_readonly=true;
	  if ($a5_readonly && empty($$a5_name)) $$a5_name = '- '.lang('EMPTY').' -';
      if(!isset($a5_default)) $a5_default='';
      $tmp_value = Text::encodeHtml(isset($$a5_name)?$$a5_name:$a5_default);
?><?php if (!$a5_readonly || $a5_type=='hidden') {
?><div class="<?php echo $a5_type!='hidden'?'inputholder':'inputhidden' ?>"><input<?php if ($a5_readonly) echo ' disabled="true"' ?><?php if ($a5_hint) echo ' data-hint="'.$a5_hint.'"'; ?> id="<?php echo REQUEST_ID ?>_<?php echo $a5_name ?><?php if ($a5_readonly) echo '_disabled' ?>" name="<?php echo $a5_name ?><?php if ($a5_readonly) echo '_disabled' ?>" type="<?php echo $a5_type ?>" maxlength="<?php echo $a5_maxlength ?>" class="<?php echo str_replace(',',' ',$a5_class) ?>" value="<?php echo $tmp_value ?>" /><?php if ($a5_icon) echo '<img src="'.$image_dir.'icon_'.$a5_icon.IMG_ICON_EXT.'" width="16" height="16" />'; ?></div><?php
if	($a5_readonly) {
?><input type="hidden" id="<?php echo REQUEST_ID ?>_<?php echo $a5_name ?>" name="<?php echo $a5_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subActionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a5_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a5_class,$a5_default,$a5_type,$a5_name,$a5_size,$a5_maxlength,$a5_onchange,$a5_readonly,$a5_hint,$a5_icon) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a3_class='line'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?><!-- Compiling part/part-begin --><?php $a4_class='label'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling label/label-begin --><?php $a5_for='description';$a5_key='global_description'; ?><label<?php if (isset($a5_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a5_for ?><?php if (!empty($a5_value)) echo '_'.$a5_value ?>" <?php if(hasLang(@$a5_key.'_desc')) { ?> title="<?php echo lang(@$a5_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a5_key)) { echo lang($a5_key); ?><?php if (isset($a5_text)) { echo $a5_text; } ?><?php } ?><?php unset($a5_for,$a5_key) ?><!-- Compiling label/label-end --></label><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a4_class='input'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling inputarea/inputarea-begin --><?php $a5_name='description';$a5_rows='10';$a5_cols='40';$a5_class='description';$a5_default=''; ?><div class="inputholder"><textarea class="<?php echo $a5_class ?>" name="<?php echo $a5_name ?>" ><?php echo Text::encodeHtml(isset($$a5_name)?$$a5_name:$a5_default) ?></textarea></div><?php unset($a5_name,$a5_rows,$a5_cols,$a5_class,$a5_default) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div>
		
<div class="bottom">
	<div class="command ">
	
		<input type="button" class="submit ok" value="<?php echo lang('global_save') ?>" onclick="$(this).closest('div.sheet').find('form').submit(); " />
		
		<!-- Cancel-Button nicht anzeigen, wenn cancel==false. -->	</div>
</div>

</form>
