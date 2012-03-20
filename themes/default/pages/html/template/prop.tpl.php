<?php $a2_name='';$a2_views='name,extension,pages';$a2_back=false; ?><div class="header">
  <?php if ($a2_back) { ?>
  <a href="javascript:void(0);" onclick="javascript:refreshActualView(this);" class="back button">
    <img src="<?php  echo $image_dir ?>icon/window/back.gif" />
    <?php echo lang('BACK') ?>
  </a>
  <?php } ?><?php if(!empty($a2_views)) { ?>
  <img src="<?php  echo $image_dir ?>icon/window/down.gif" />
  <div class="headermenu">
    <?php foreach( explode(',',$a2_views) as $a2_tmp_view ) { ?>
	<a class="entry" href="javascript:void(0);" onclick="javascript:startView(this,'<?php echo $a2_tmp_view ?>');">
	  <img src="<?php  echo $image_dir ?>icon/<?php echo $a2_tmp_view ?>.png" /><?php echo lang('MENU_'.$a2_tmp_view) ?>
	</a>
    <?php } ?>
  </div>
<?php } ?>
</div><?php unset($a2_name,$a2_views,$a2_back) ?>