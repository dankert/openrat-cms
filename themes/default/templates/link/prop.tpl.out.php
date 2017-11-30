<!-- Compiling output/output-begin @ Wed, 29 Nov 2017 01:27:31 +0100 -->
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

			<fieldset class="<?php echo 1?" open":"" ?><?php echo 1?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('global_prop') ?></legend><div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 01:27:31 +0100 --><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 01:27:31 +0100 --><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling label/label-begin @ Wed, 29 Nov 2017 01:27:31 +0100 --><?php $a6_for='name'; ?><label<?php if (isset($a6_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" <?php if(hasLang(@$a6_key.'_desc')) { ?> title="<?php echo lang(@$a6_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); ?><?php if (isset($a6_text)) { echo $a6_text; } ?><?php } ?><?php unset($a6_for) ?><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 01:27:31 +0100 --><?php $a7_class='text';$a7_text='GLOBAL_name';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_text,$a7_escape,$a7_cut) ?><!-- Compiling label/label-end @ Wed, 29 Nov 2017 01:27:31 +0100 --></label><!-- Compiling part/part-end @ Wed, 29 Nov 2017 01:27:31 +0100 --></div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 01:27:31 +0100 --><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling input/input-begin @ Wed, 29 Nov 2017 01:27:31 +0100 --><?php $a6_class='name,focus';$a6_default='';$a6_type='text';$a6_name='name';$a6_size='';$a6_maxlength='256';$a6_onchange='';$a6_readonly=false;$a6_hint='';$a6_icon=''; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a6_readonly=true;
	  if ($a6_readonly && empty($$a6_name)) $$a6_name = '- '.lang('EMPTY').' -';
      if(!isset($a6_default)) $a6_default='';
      $tmp_value = Text::encodeHtml(isset($$a6_name)?$$a6_name:$a6_default);
?><?php if (!$a6_readonly || $a6_type=='hidden') {
?><div class="<?php echo $a6_type!='hidden'?'inputholder':'inputhidden' ?>"><input<?php if ($a6_readonly) echo ' disabled="true"' ?><?php if ($a6_hint) echo ' data-hint="'.$a6_hint.'"'; ?> id="<?php echo REQUEST_ID ?>_<?php echo $a6_name ?><?php if ($a6_readonly) echo '_disabled' ?>" name="<?php echo $a6_name ?><?php if ($a6_readonly) echo '_disabled' ?>" type="<?php echo $a6_type ?>" maxlength="<?php echo $a6_maxlength ?>" class="<?php echo str_replace(',',' ',$a6_class) ?>" value="<?php echo $tmp_value ?>" /><?php if ($a6_icon) echo '<img src="'.$image_dir.'icon_'.$a6_icon.IMG_ICON_EXT.'" width="16" height="16" />'; ?></div><?php
if	($a6_readonly) {
?><input type="hidden" id="<?php echo REQUEST_ID ?>_<?php echo $a6_name ?>" name="<?php echo $a6_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subActionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a6_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a6_class,$a6_default,$a6_type,$a6_name,$a6_size,$a6_maxlength,$a6_onchange,$a6_readonly,$a6_hint,$a6_icon) ?><!-- Compiling part/part-end @ Wed, 29 Nov 2017 01:27:31 +0100 --></div><!-- Compiling part/part-end @ Wed, 29 Nov 2017 01:27:31 +0100 --></div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 01:27:31 +0100 --><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 01:27:31 +0100 --><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling label/label-begin @ Wed, 29 Nov 2017 01:27:31 +0100 --><?php $a6_for='description'; ?><label<?php if (isset($a6_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" <?php if(hasLang(@$a6_key.'_desc')) { ?> title="<?php echo lang(@$a6_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); ?><?php if (isset($a6_text)) { echo $a6_text; } ?><?php } ?><?php unset($a6_for) ?><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 01:27:31 +0100 --><?php $a7_class='text';$a7_text='GLOBAL_description';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_text,$a7_escape,$a7_cut) ?><!-- Compiling label/label-end @ Wed, 29 Nov 2017 01:27:31 +0100 --></label><!-- Compiling part/part-end @ Wed, 29 Nov 2017 01:27:31 +0100 --></div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 01:27:31 +0100 --><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling inputarea/inputarea-begin @ Wed, 29 Nov 2017 01:27:31 +0100 --><?php $a6_name='description';$a6_rows='10';$a6_cols='40';$a6_class='description';$a6_default=''; ?><div class="inputholder"><textarea class="<?php echo $a6_class ?>" name="<?php echo $a6_name ?>" ><?php echo Text::encodeHtml(isset($$a6_name)?$$a6_name:$a6_default) ?></textarea></div><?php unset($a6_name,$a6_rows,$a6_cols,$a6_class,$a6_default) ?><!-- Compiling part/part-end @ Wed, 29 Nov 2017 01:27:31 +0100 --></div><!-- Compiling part/part-end @ Wed, 29 Nov 2017 01:27:31 +0100 --></div>
			</div></fieldset>
		
<div class="bottom">
	<div class="command ">
	
		<input type="button" class="submit ok" value="OK" onclick="$(this).closest('div.sheet').find('form').submit(); " />
		
		<!-- Cancel-Button nicht anzeigen, wenn cancel==false. -->	</div>
</div>

</form>
