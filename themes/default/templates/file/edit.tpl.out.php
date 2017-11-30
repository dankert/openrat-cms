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
<!-- Compiling header/header-begin --><?php $a3_name='';$a3_views='value';$a3_back=false; ?><?php if(!empty($a3_views)) { ?>
  <div class="headermenu">
    <?php foreach( explode(',',$a3_views) as $a3_tmp_view ) { ?>
  	<div class="toolbar-icon clickable">
    <a href="javascript:void(0);" data-type="dialog" data-name="<?php echo lang('MENU_'.$a3_tmp_view) ?>" data-method="<?php echo $a3_tmp_view ?>">
		  <img src="<?php  echo $image_dir ?>icon/<?php echo $a3_tmp_view ?>.png" title="<?php echo lang('MENU_'.$a3_tmp_view.'_DESC') ?>" /> <?php echo lang('MENU_'.$a3_tmp_view) ?>
		</a>
  </div>
		<?php } ?>
  </div>
<?php } ?>
<?php unset($a3_name,$a3_views,$a3_back) ?><!-- Compiling part/part-begin --><?php $a3_class='label'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a3_class='line'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?><!-- Compiling part/part-begin --><?php $a4_class='input'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling newline/newline-begin --><br/><!-- Compiling upload/upload-begin --><?php $a5_name='file';$a5_class='upload';$a5_size='40';$a5_multiple=false; ?><input size="<?php echo $a5_size ?>" id="<?php echo REQUEST_ID ?>_<?php echo $a5_name ?>" type="file" <?php if (isset($a5_maxlength))echo ' maxlength="'.$a5_maxlength.'"' ?> name="<?php echo $a5_name ?>" class="<?php echo $a5_class ?>" <?php echo ($a5_multiple=='true'?' multiple':'') ?> /><?php unset($a5_name,$a5_class,$a5_size,$a5_multiple) ?><!-- Compiling newline/newline-begin --><br/><!-- Compiling newline/newline-begin --><br/><!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div>
		
<div class="bottom">
	<div class="command ">
	
		<input type="button" class="submit ok" value="OK" onclick="$(this).closest('div.sheet').find('form').submit(); " />
		
		<!-- Cancel-Button nicht anzeigen, wenn cancel==false. -->	</div>
</div>

</form>
