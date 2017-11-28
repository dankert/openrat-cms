<!-- Compiling output/output-begin @ Wed, 29 Nov 2017 00:26:44 +0100 --><!-- Compiling header/header-begin @ Wed, 29 Nov 2017 00:26:44 +0100 --><?php $a2_name='';$a2_views='projecttimeline,userprojecttimeline';$a2_back=false; ?><?php if(!empty($a2_views)) { ?>
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
<?php unset($a2_name,$a2_views,$a2_back) ?><!-- Compiling insert/insert-begin @ Wed, 29 Nov 2017 00:26:44 +0100 --><?php $a2_inline=false;$a2_function='loadTree'; ?><iframe
></iframe>
Hallo!
<script type="text/javascript" name="JavaScript"><?php echo $a2_function?>();</script>
<?php unset($a2_inline,$a2_function) ?>