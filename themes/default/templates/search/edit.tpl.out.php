<!-- Compiling output/output-begin @ Wed, 29 Nov 2017 00:50:55 +0100 -->
		<form name=""
      target="_self"
      action="<?php echo OR_ACTION ?>"
      data-method="result"
      data-action="<?php echo OR_ACTION ?>"
      data-id="<?php echo OR_ID ?>"
      method="result"
      enctype="application/x-www-form-urlencoded"
      class="<?php echo OR_ACTION ?>"
      data-async=""
      data-autosave=""
      onSubmit="formSubmit( $(this) ); return false;"><input type="submit" class="invisible" />
      
<input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo OR_ACTION ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="result" />
<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
<?php
		if	( $conf['interface']['url_sessionid'] )
			echo '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";
?>
<!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:50:55 +0100 --><?php $a3_class='line'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:50:55 +0100 --><?php $a4_class='label'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling label/label-begin @ Wed, 29 Nov 2017 00:50:55 +0100 --><?php $a5_for='value'; ?><label<?php if (isset($a5_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a5_for ?><?php if (!empty($a5_value)) echo '_'.$a5_value ?>" <?php if(hasLang(@$a5_key.'_desc')) { ?> title="<?php echo lang(@$a5_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a5_key)) { echo lang($a5_key); ?><?php if (isset($a5_text)) { echo $a5_text; } ?><?php } ?><?php unset($a5_for) ?><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:50:55 +0100 --><?php $a6_class='text';$a6_key='value';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_key,$a6_escape,$a6_cut) ?><!-- Compiling label/label-end @ Wed, 29 Nov 2017 00:50:55 +0100 --></label><!-- Compiling newline/newline-begin @ Wed, 29 Nov 2017 00:50:55 +0100 --><br/><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:50:55 +0100 --></div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:50:55 +0100 --><?php $a4_class='input'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling input/input-begin @ Wed, 29 Nov 2017 00:50:55 +0100 --><?php $a5_class='text';$a5_default='';$a5_type='text';$a5_name='text';$a5_size='';$a5_maxlength='256';$a5_onchange='';$a5_readonly=false;$a5_hint=lang('search');$a5_icon=''; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a5_readonly=true;
	  if ($a5_readonly && empty($$a5_name)) $$a5_name = '- '.lang('EMPTY').' -';
      if(!isset($a5_default)) $a5_default='';
      $tmp_value = Text::encodeHtml(isset($$a5_name)?$$a5_name:$a5_default);
?><?php if (!$a5_readonly || $a5_type=='hidden') {
?><div class="<?php echo $a5_type!='hidden'?'inputholder':'inputhidden' ?>"><input<?php if ($a5_readonly) echo ' disabled="true"' ?><?php if ($a5_hint) echo ' data-hint="'.$a5_hint.'"'; ?> id="<?php echo REQUEST_ID ?>_<?php echo $a5_name ?><?php if ($a5_readonly) echo '_disabled' ?>" name="<?php echo $a5_name ?><?php if ($a5_readonly) echo '_disabled' ?>" type="<?php echo $a5_type ?>" maxlength="<?php echo $a5_maxlength ?>" class="<?php echo str_replace(',',' ',$a5_class) ?>" value="<?php echo $tmp_value ?>" /><?php if ($a5_icon) echo '<img src="'.$image_dir.'icon_'.$a5_icon.IMG_ICON_EXT.'" width="16" height="16" />'; ?></div><?php
if	($a5_readonly) {
?><input type="hidden" id="<?php echo REQUEST_ID ?>_<?php echo $a5_name ?>" name="<?php echo $a5_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subActionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a5_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a5_class,$a5_default,$a5_type,$a5_name,$a5_size,$a5_maxlength,$a5_onchange,$a5_readonly,$a5_hint,$a5_icon) ?><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:50:55 +0100 --></div><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:50:55 +0100 --></div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:50:55 +0100 --><?php $a3_class='line'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:50:55 +0100 --><?php $a4_class='label'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling label/label-begin @ Wed, 29 Nov 2017 00:50:55 +0100 --><?php $a5_for='value'; ?><label<?php if (isset($a5_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a5_for ?><?php if (!empty($a5_value)) echo '_'.$a5_value ?>" <?php if(hasLang(@$a5_key.'_desc')) { ?> title="<?php echo lang(@$a5_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a5_key)) { echo lang($a5_key); ?><?php if (isset($a5_text)) { echo $a5_text; } ?><?php } ?><?php unset($a5_for) ?><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:50:55 +0100 --><?php $a6_class='text';$a6_key='filter';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_key,$a6_escape,$a6_cut) ?><!-- Compiling label/label-end @ Wed, 29 Nov 2017 00:50:55 +0100 --></label><!-- Compiling newline/newline-begin @ Wed, 29 Nov 2017 00:50:55 +0100 --><br/><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:50:55 +0100 --></div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:50:55 +0100 --><?php $a4_class='input'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?>
					<?php { $tmpname     = 'id';$default  = @$conf['search']['quicksearch']['flag']['id'];$readonly = '';		
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
					<!-- Compiling label/label-begin @ Wed, 29 Nov 2017 00:50:55 +0100 --><?php $a5_for='id'; ?><label<?php if (isset($a5_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a5_for ?><?php if (!empty($a5_value)) echo '_'.$a5_value ?>" <?php if(hasLang(@$a5_key.'_desc')) { ?> title="<?php echo lang(@$a5_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a5_key)) { echo lang($a5_key); ?><?php if (isset($a5_text)) { echo $a5_text; } ?><?php } ?><?php unset($a5_for) ?><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:50:55 +0100 --><?php $a6_class='text';$a6_key='id';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_key,$a6_escape,$a6_cut) ?><!-- Compiling label/label-end @ Wed, 29 Nov 2017 00:50:55 +0100 --></label><!-- Compiling newline/newline-begin @ Wed, 29 Nov 2017 00:50:55 +0100 --><br/>
					<?php { $tmpname     = 'name';$default  = @$conf['search']['quicksearch']['flag']['name'];$readonly = '';		
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
					<!-- Compiling label/label-begin @ Wed, 29 Nov 2017 00:50:55 +0100 --><?php $a5_for='name'; ?><label<?php if (isset($a5_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a5_for ?><?php if (!empty($a5_value)) echo '_'.$a5_value ?>" <?php if(hasLang(@$a5_key.'_desc')) { ?> title="<?php echo lang(@$a5_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a5_key)) { echo lang($a5_key); ?><?php if (isset($a5_text)) { echo $a5_text; } ?><?php } ?><?php unset($a5_for) ?><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:50:55 +0100 --><?php $a6_class='text';$a6_key='name';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_key,$a6_escape,$a6_cut) ?><!-- Compiling label/label-end @ Wed, 29 Nov 2017 00:50:55 +0100 --></label><!-- Compiling newline/newline-begin @ Wed, 29 Nov 2017 00:50:55 +0100 --><br/>
					<?php { $tmpname     = 'filename';$default  = @$conf['search']['quicksearch']['flag']['filename'];$readonly = '';		
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
					<!-- Compiling label/label-begin @ Wed, 29 Nov 2017 00:50:55 +0100 --><?php $a5_for='filename'; ?><label<?php if (isset($a5_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a5_for ?><?php if (!empty($a5_value)) echo '_'.$a5_value ?>" <?php if(hasLang(@$a5_key.'_desc')) { ?> title="<?php echo lang(@$a5_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a5_key)) { echo lang($a5_key); ?><?php if (isset($a5_text)) { echo $a5_text; } ?><?php } ?><?php unset($a5_for) ?><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:50:55 +0100 --><?php $a6_class='text';$a6_key='filename';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_key,$a6_escape,$a6_cut) ?><!-- Compiling label/label-end @ Wed, 29 Nov 2017 00:50:55 +0100 --></label><!-- Compiling newline/newline-begin @ Wed, 29 Nov 2017 00:50:55 +0100 --><br/>
					<?php { $tmpname     = 'description';$default  = @$conf['search']['quicksearch']['flag']['description'];$readonly = '';		
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
					<!-- Compiling label/label-begin @ Wed, 29 Nov 2017 00:50:55 +0100 --><?php $a5_for='description'; ?><label<?php if (isset($a5_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a5_for ?><?php if (!empty($a5_value)) echo '_'.$a5_value ?>" <?php if(hasLang(@$a5_key.'_desc')) { ?> title="<?php echo lang(@$a5_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a5_key)) { echo lang($a5_key); ?><?php if (isset($a5_text)) { echo $a5_text; } ?><?php } ?><?php unset($a5_for) ?><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:50:55 +0100 --><?php $a6_class='text';$a6_key='description';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_key,$a6_escape,$a6_cut) ?><!-- Compiling label/label-end @ Wed, 29 Nov 2017 00:50:55 +0100 --></label><!-- Compiling newline/newline-begin @ Wed, 29 Nov 2017 00:50:55 +0100 --><br/>
					<?php { $tmpname     = 'content';$default  = @$conf['search']['quicksearch']['flag']['content'];$readonly = '';		
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
					<!-- Compiling label/label-begin @ Wed, 29 Nov 2017 00:50:55 +0100 --><?php $a5_for='content'; ?><label<?php if (isset($a5_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a5_for ?><?php if (!empty($a5_value)) echo '_'.$a5_value ?>" <?php if(hasLang(@$a5_key.'_desc')) { ?> title="<?php echo lang(@$a5_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a5_key)) { echo lang($a5_key); ?><?php if (isset($a5_text)) { echo $a5_text; } ?><?php } ?><?php unset($a5_for) ?><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:50:55 +0100 --><?php $a6_class='text';$a6_key='content';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_key,$a6_escape,$a6_cut) ?><!-- Compiling label/label-end @ Wed, 29 Nov 2017 00:50:55 +0100 --></label><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:50:55 +0100 --></div><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:50:55 +0100 --></div>
		
<div class="bottom">
	<div class="command ">
	
		<input type="button" class="submit ok" value="OK" onclick="$(this).closest('div.sheet').find('form').submit(); " />
		
		<!-- Cancel-Button nicht anzeigen, wenn cancel==false. -->	</div>
</div>

</form>
