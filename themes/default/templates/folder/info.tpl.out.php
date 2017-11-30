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

			<fieldset class="<?php echo 1?" open":"" ?><?php echo 1?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('GLOBAL_PROP') ?></legend><div><!-- Compiling part/part-begin --><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin --><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling label/label-begin --><?php $a6_for='name';$a6_key='global_name'; ?><label<?php if (isset($a6_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" <?php if(hasLang(@$a6_key.'_desc')) { ?> title="<?php echo lang(@$a6_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); ?><?php if (isset($a6_text)) { echo $a6_text; } ?><?php } ?><?php unset($a6_for,$a6_key) ?><!-- Compiling label/label-end --></label><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?>
						<span class="name,focus"><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
						<!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin --><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling label/label-begin --><?php $a6_for='filename';$a6_key='global_filename'; ?><label<?php if (isset($a6_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" <?php if(hasLang(@$a6_key.'_desc')) { ?> title="<?php echo lang(@$a6_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); ?><?php if (isset($a6_text)) { echo $a6_text; } ?><?php } ?><?php unset($a6_for,$a6_key) ?><!-- Compiling label/label-end --></label><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?>
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities($filename))); ?></span>
						<!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin --><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling label/label-begin --><?php $a6_for='description';$a6_key='global_description'; ?><label<?php if (isset($a6_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" <?php if(hasLang(@$a6_key.'_desc')) { ?> title="<?php echo lang(@$a6_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); ?><?php if (isset($a6_text)) { echo $a6_text; } ?><?php } ?><?php unset($a6_for,$a6_key) ?><!-- Compiling label/label-end --></label><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?>
						<span class="description"><?php echo nl2br(encodeHtml(htmlentities($description))); ?></span>
						<!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div>
			</div></fieldset>
			<fieldset class="<?php echo 1?" open":"" ?><?php echo 1?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('additional_info') ?></legend><div><!-- Compiling part/part-begin --><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin --><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling label/label-begin --><?php $a6_for='full_filename';$a6_key='FULL_FILENAME'; ?><label<?php if (isset($a6_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" <?php if(hasLang(@$a6_key.'_desc')) { ?> title="<?php echo lang(@$a6_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); ?><?php if (isset($a6_text)) { echo $a6_text; } ?><?php } ?><?php unset($a6_for,$a6_key) ?><!-- Compiling label/label-end --></label><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?>
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities($full_filename))); ?></span>
						<!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin --><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling label/label-begin --><?php $a6_for='objectid';$a6_key='id'; ?><label<?php if (isset($a6_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" <?php if(hasLang(@$a6_key.'_desc')) { ?> title="<?php echo lang(@$a6_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); ?><?php if (isset($a6_text)) { echo $a6_text; } ?><?php } ?><?php unset($a6_for,$a6_key) ?><!-- Compiling label/label-end --></label><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?>
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities($objectid))); ?></span>
						<!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div>
			</div></fieldset>
			<fieldset class="<?php echo 1?" open":"" ?><?php echo 1?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('PROP_USERINFO') ?></legend><div><!-- Compiling part/part-begin --><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin --><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling label/label-begin --><?php $a6_for='create_user';$a6_key='global_created'; ?><label<?php if (isset($a6_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" <?php if(hasLang(@$a6_key.'_desc')) { ?> title="<?php echo lang(@$a6_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); ?><?php if (isset($a6_text)) { echo $a6_text; } ?><?php } ?><?php unset($a6_for,$a6_key) ?><!-- Compiling label/label-end --></label><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?>
						<img class="image-icon image-icon--element" title="" src="./themes/default/images/icon/element/date.svg" />
						
						<?php include_once( OR_THEMES_DIR.'default/include/html/date/component-date.php') ?><?php component_date($create_date) ?>
						<!-- Compiling newline/newline-begin --><br/>
						<img class="image-icon image-icon--action" title="" src="./themes/default/images/icon/action/user.svg" />
						
						<?php include_once( OR_THEMES_DIR.'default/include/html/user/component-user.php') ?><?php component_user($create_user) ?>
						<!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin --><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling label/label-begin --><?php $a6_for='lastchange_user';$a6_key='global_lastchange'; ?><label<?php if (isset($a6_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" <?php if(hasLang(@$a6_key.'_desc')) { ?> title="<?php echo lang(@$a6_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); ?><?php if (isset($a6_text)) { echo $a6_text; } ?><?php } ?><?php unset($a6_for,$a6_key) ?><!-- Compiling label/label-end --></label><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?>
						<img class="image-icon image-icon--element" title="" src="./themes/default/images/icon/element/date.svg" />
						
						<?php include_once( OR_THEMES_DIR.'default/include/html/date/component-date.php') ?><?php component_date($lastchange_date) ?>
						<!-- Compiling newline/newline-begin --><br/>
						<img class="image-icon image-icon--action" title="" src="./themes/default/images/icon/action/user.svg" />
						
						<?php include_once( OR_THEMES_DIR.'default/include/html/user/component-user.php') ?><?php component_user($lastchange_user) ?>
						<!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div>
			</div></fieldset>
		
<div class="bottom">
	<div class="command ">
	
		<input type="button" class="submit ok" value="OK" onclick="$(this).closest('div.sheet').find('form').submit(); " />
		
		<!-- Cancel-Button nicht anzeigen, wenn cancel==false. -->	</div>
</div>

</form>
