<!-- Compiling output/output-begin @ Wed, 29 Nov 2017 01:10:08 +0100 -->
		<?php $if2=(@$conf['security']['nopublish']); if($if2){?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 01:10:08 +0100 --><?php $a3_class='message warn'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 01:10:08 +0100 --><?php $a4_class='help';$a4_key='GLOBAL_NOPUBLISH_DESC';$a4_escape=true;$a4_cut='both'; ?><?php
		$a4_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a4_class ?>" title="<?php echo $a4_title ?>"><?php
		$langF = $a4_escape?'langHtml':'lang';
		$tmp_text = $langF($a4_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a4_class,$a4_key,$a4_escape,$a4_cut) ?><!-- Compiling part/part-end @ Wed, 29 Nov 2017 01:10:08 +0100 --></div>
		<?php } ?>
		<form name=""
      target="_self"
      action="<?php echo OR_ACTION ?>"
      data-method="<?php echo OR_METHOD ?>"
      data-action="<?php echo OR_ACTION ?>"
      data-id="<?php echo OR_ID ?>"
      method="<?php echo OR_METHOD ?>"
      enctype="application/x-www-form-urlencoded"
      class="<?php echo OR_ACTION ?>"
      data-async="true"
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

			<?php $if3=(!empty('pages')); if($if3){?>
				<?php $if4=(!empty('subdirs')); if($if4){?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 01:10:08 +0100 --><?php $a5_class='line'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 01:10:08 +0100 --><?php $a6_class='label'; ?><div class="<?php echo $a6_class ?>"><?php unset($a6_class) ?><!-- Compiling part/part-end @ Wed, 29 Nov 2017 01:10:08 +0100 --></div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 01:10:08 +0100 --><?php $a6_class='input'; ?><div class="<?php echo $a6_class ?>"><?php unset($a6_class) ?>
							<?php { $tmpname     = 'pages';$default  = '';$readonly = '';		
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
							<!-- Compiling label/label-begin @ Wed, 29 Nov 2017 01:10:08 +0100 --><?php $a7_for='pages'; ?><label<?php if (isset($a7_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a7_for ?><?php if (!empty($a7_value)) echo '_'.$a7_value ?>" <?php if(hasLang(@$a7_key.'_desc')) { ?> title="<?php echo lang(@$a7_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a7_key)) { echo lang($a7_key); ?><?php if (isset($a7_text)) { echo $a7_text; } ?><?php } ?><?php unset($a7_for) ?><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 01:10:08 +0100 --><?php $a8_class='text';$a8_raw='_';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a8_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_raw,$a8_escape,$a8_cut) ?><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 01:10:08 +0100 --><?php $a8_class='text';$a8_text='global_pages';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_text,$a8_escape,$a8_cut) ?><!-- Compiling label/label-end @ Wed, 29 Nov 2017 01:10:08 +0100 --></label><!-- Compiling part/part-end @ Wed, 29 Nov 2017 01:10:08 +0100 --></div><!-- Compiling part/part-end @ Wed, 29 Nov 2017 01:10:08 +0100 --></div>
				<?php } ?>
			<?php } ?>
			<?php $if3=(!empty('files')); if($if3){?>
				<?php $if4=('subdirs'); if($if4){?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 01:10:08 +0100 --><?php $a5_class='line'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 01:10:08 +0100 --><?php $a6_class='label'; ?><div class="<?php echo $a6_class ?>"><?php unset($a6_class) ?><!-- Compiling part/part-end @ Wed, 29 Nov 2017 01:10:08 +0100 --></div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 01:10:08 +0100 --><?php $a6_class='input'; ?><div class="<?php echo $a6_class ?>"><?php unset($a6_class) ?>
							<?php { $tmpname     = 'files';$default  = '';$readonly = '';		
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
							<!-- Compiling label/label-begin @ Wed, 29 Nov 2017 01:10:08 +0100 --><?php $a7_for='files'; ?><label<?php if (isset($a7_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a7_for ?><?php if (!empty($a7_value)) echo '_'.$a7_value ?>" <?php if(hasLang(@$a7_key.'_desc')) { ?> title="<?php echo lang(@$a7_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a7_key)) { echo lang($a7_key); ?><?php if (isset($a7_text)) { echo $a7_text; } ?><?php } ?><?php unset($a7_for) ?><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 01:10:08 +0100 --><?php $a8_class='text';$a8_raw='_';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a8_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_raw,$a8_escape,$a8_cut) ?><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 01:10:08 +0100 --><?php $a8_class='text';$a8_text='global_files';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_text,$a8_escape,$a8_cut) ?><!-- Compiling label/label-end @ Wed, 29 Nov 2017 01:10:08 +0100 --></label><!-- Compiling part/part-end @ Wed, 29 Nov 2017 01:10:08 +0100 --></div><!-- Compiling part/part-end @ Wed, 29 Nov 2017 01:10:08 +0100 --></div>
				<?php } ?>
			<?php } ?>
			<fieldset class="<?php echo 1?" open":"" ?><?php echo 1?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('options') ?></legend><div>
				<?php $if4=(!empty('subdirs')); if($if4){?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 01:10:08 +0100 --><?php $a5_class='line'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 01:10:08 +0100 --><?php $a6_class='label'; ?><div class="<?php echo $a6_class ?>"><?php unset($a6_class) ?><!-- Compiling part/part-end @ Wed, 29 Nov 2017 01:10:08 +0100 --></div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 01:10:08 +0100 --><?php $a6_class='input'; ?><div class="<?php echo $a6_class ?>"><?php unset($a6_class) ?>
							<?php { $tmpname     = 'subdirs';$default  = '';$readonly = '';		
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
							<!-- Compiling label/label-begin @ Wed, 29 Nov 2017 01:10:08 +0100 --><?php $a7_for='subdirs'; ?><label<?php if (isset($a7_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a7_for ?><?php if (!empty($a7_value)) echo '_'.$a7_value ?>" <?php if(hasLang(@$a7_key.'_desc')) { ?> title="<?php echo lang(@$a7_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a7_key)) { echo lang($a7_key); ?><?php if (isset($a7_text)) { echo $a7_text; } ?><?php } ?><?php unset($a7_for) ?><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 01:10:08 +0100 --><?php $a8_class='text';$a8_raw='_';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a8_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_raw,$a8_escape,$a8_cut) ?><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 01:10:08 +0100 --><?php $a8_class='text';$a8_text='GLOBAL_PUBLISH_WITH_SUBDIRS';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_text,$a8_escape,$a8_cut) ?><!-- Compiling label/label-end @ Wed, 29 Nov 2017 01:10:08 +0100 --></label><!-- Compiling part/part-end @ Wed, 29 Nov 2017 01:10:08 +0100 --></div><!-- Compiling part/part-end @ Wed, 29 Nov 2017 01:10:08 +0100 --></div>
				<?php } ?>
				<?php $if4=(!empty('clean')); if($if4){?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 01:10:08 +0100 --><?php $a5_class='line'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 01:10:08 +0100 --><?php $a6_class='label'; ?><div class="<?php echo $a6_class ?>"><?php unset($a6_class) ?><!-- Compiling part/part-end @ Wed, 29 Nov 2017 01:10:08 +0100 --></div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 01:10:08 +0100 --><?php $a6_class='input'; ?><div class="<?php echo $a6_class ?>"><?php unset($a6_class) ?>
							<?php { $tmpname     = 'clean';$default  = '';$readonly = '';		
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
							<!-- Compiling label/label-begin @ Wed, 29 Nov 2017 01:10:08 +0100 --><?php $a7_for='clean'; ?><label<?php if (isset($a7_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a7_for ?><?php if (!empty($a7_value)) echo '_'.$a7_value ?>" <?php if(hasLang(@$a7_key.'_desc')) { ?> title="<?php echo lang(@$a7_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a7_key)) { echo lang($a7_key); ?><?php if (isset($a7_text)) { echo $a7_text; } ?><?php } ?><?php unset($a7_for) ?><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 01:10:08 +0100 --><?php $a8_class='text';$a8_raw='_';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a8_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_raw,$a8_escape,$a8_cut) ?><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 01:10:08 +0100 --><?php $a8_class='text';$a8_text='global_CLEAN_AFTER_PUBLISH';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_text,$a8_escape,$a8_cut) ?><!-- Compiling label/label-end @ Wed, 29 Nov 2017 01:10:08 +0100 --></label><!-- Compiling part/part-end @ Wed, 29 Nov 2017 01:10:08 +0100 --></div><!-- Compiling part/part-end @ Wed, 29 Nov 2017 01:10:08 +0100 --></div>
				<?php } ?>
			</div></fieldset>
		
<div class="bottom">
	<div class="command true">
	
		<input type="button" class="submit ok" value="<?php echo lang('publish') ?>" onclick="$(this).closest('div.sheet').find('form').submit(); " />
		
		<!-- Cancel-Button nicht anzeigen, wenn cancel==false. --><input type="button" class="submit cancel" value="<?php echo lang("CANCEL") ?>" onclick="$(div#dialog').hide(); $('div#filler').fadeOut(500); $(this).closest('div.panel').find('ul.views > li.active').click();" />	</div>
</div>

</form>
