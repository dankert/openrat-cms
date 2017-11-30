<!-- Compiling output/output-begin -->
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

			<fieldset class="<?php echo 1?" open":"" ?><?php echo 1?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('languages') ?></legend><div><!-- Compiling list/list-begin --><?php $a4_list='languages';$a4_extract=false;$a4_key='id';$a4_value='name'; ?><?php
	$a4_list_tmp_key   = $a4_key;
	$a4_list_tmp_value = $a4_value;
	$a4_list_extract   = $a4_extract;
	unset($a4_key);
	unset($a4_value);
	if	( !isset($$a4_list) || !is_array($$a4_list) )
		$$a4_list = array();
	foreach( $$a4_list as $$a4_list_tmp_key => $$a4_list_tmp_value )
	{
		if	( $a4_list_extract )
		{
			if	( !is_array($$a4_list_tmp_value) )
			{
				print_r($$a4_list_tmp_value);
				die( 'not an array at key: '.$$a4_list_tmp_key );
			}
			extract($$a4_list_tmp_value);
		}
?><?php unset($a4_list,$a4_extract,$a4_key,$a4_value) ?><!-- Compiling part/part-begin --><div><!-- Compiling radio/radio-begin --><?php $a6_readonly=false;$a6_name='languageid';$a6_value=$id;$a6_default=false;$a6_prefix='';$a6_suffix='';$a6_class='';$a6_onchange=''; ?><?php
		if ($this->isEditable() && !$this->isEditMode()) $a6_readonly=true;
		if	( isset($$a6_name)  )
			$a6_tmp_default = $$a6_name;
		elseif ( isset($a6_default) )
			$a6_tmp_default = $a6_default;
		else
			$a6_tmp_default = '';
 ?><input onclick="" class="radio" type="radio" id="<?php echo REQUEST_ID ?>_<?php echo $a6_name.'_'.$a6_value ?>"  name="<?php echo $a6_prefix.$a6_name ?>"<?php if ( $a6_readonly ) echo ' disabled="disabled"' ?> value="<?php echo $a6_value ?>"<?php if($a6_value==$a6_tmp_default||@$a6_checked) echo ' checked="checked"' ?> />
<?php /* #END-IF# */ ?><?php unset($a6_readonly,$a6_name,$a6_value,$a6_default,$a6_prefix,$a6_suffix,$a6_class,$a6_onchange) ?><!-- Compiling label/label-begin --><?php $a6_for='languageid';$a6_value=$id; ?><label<?php if (isset($a6_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" <?php if(hasLang(@$a6_key.'_desc')) { ?> title="<?php echo lang(@$a6_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); ?><?php if (isset($a6_text)) { echo $a6_text; } ?><?php } ?><?php unset($a6_for,$a6_value) ?><!-- Compiling text/text-begin --><?php $a7_class='text';$a7_var='name';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = isset($$a7_var)?$$a7_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_var,$a7_escape,$a7_cut) ?><!-- Compiling label/label-end --></label><!-- Compiling part/part-end --></div><!-- Compiling list/list-end --><?php } ?>
			</div></fieldset>
			<fieldset class="<?php echo 1?" open":"" ?><?php echo 1?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('models') ?></legend><div><!-- Compiling list/list-begin --><?php $a4_list='models';$a4_extract=false;$a4_key='id';$a4_value='name'; ?><?php
	$a4_list_tmp_key   = $a4_key;
	$a4_list_tmp_value = $a4_value;
	$a4_list_extract   = $a4_extract;
	unset($a4_key);
	unset($a4_value);
	if	( !isset($$a4_list) || !is_array($$a4_list) )
		$$a4_list = array();
	foreach( $$a4_list as $$a4_list_tmp_key => $$a4_list_tmp_value )
	{
		if	( $a4_list_extract )
		{
			if	( !is_array($$a4_list_tmp_value) )
			{
				print_r($$a4_list_tmp_value);
				die( 'not an array at key: '.$$a4_list_tmp_key );
			}
			extract($$a4_list_tmp_value);
		}
?><?php unset($a4_list,$a4_extract,$a4_key,$a4_value) ?><!-- Compiling part/part-begin --><div><!-- Compiling radio/radio-begin --><?php $a6_readonly=false;$a6_name='modelid';$a6_value=$id;$a6_default=false;$a6_prefix='';$a6_suffix='';$a6_class='';$a6_onchange=''; ?><?php
		if ($this->isEditable() && !$this->isEditMode()) $a6_readonly=true;
		if	( isset($$a6_name)  )
			$a6_tmp_default = $$a6_name;
		elseif ( isset($a6_default) )
			$a6_tmp_default = $a6_default;
		else
			$a6_tmp_default = '';
 ?><input onclick="" class="radio" type="radio" id="<?php echo REQUEST_ID ?>_<?php echo $a6_name.'_'.$a6_value ?>"  name="<?php echo $a6_prefix.$a6_name ?>"<?php if ( $a6_readonly ) echo ' disabled="disabled"' ?> value="<?php echo $a6_value ?>"<?php if($a6_value==$a6_tmp_default||@$a6_checked) echo ' checked="checked"' ?> />
<?php /* #END-IF# */ ?><?php unset($a6_readonly,$a6_name,$a6_value,$a6_default,$a6_prefix,$a6_suffix,$a6_class,$a6_onchange) ?><!-- Compiling label/label-begin --><?php $a6_for='modelid';$a6_value=$id; ?><label<?php if (isset($a6_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" <?php if(hasLang(@$a6_key.'_desc')) { ?> title="<?php echo lang(@$a6_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); ?><?php if (isset($a6_text)) { echo $a6_text; } ?><?php } ?><?php unset($a6_for,$a6_value) ?><!-- Compiling text/text-begin --><?php $a7_class='text';$a7_var='name';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = isset($$a7_var)?$$a7_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_var,$a7_escape,$a7_cut) ?><!-- Compiling label/label-end --></label><!-- Compiling part/part-end --></div><!-- Compiling list/list-end --><?php } ?>
			</div></fieldset>
		
<div class="bottom">
	<div class="command ">
	
		<input type="button" class="submit ok" value="OK" onclick="$(this).closest('div.sheet').find('form').submit(); " />
		
		<!-- Cancel-Button nicht anzeigen, wenn cancel==false. -->	</div>
</div>

</form>
