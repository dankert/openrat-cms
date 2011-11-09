<div class="header">
  <?php if ($attr_back) { ?>
  <a href="javascript:void(0);" onclick="javascript:refreshActualView(this);">
    <img src="<?php  echo $image_dir ?>icon/window/back.gif" />
    <?php echo lang('BACK') ?>
  </a>
  <?php } ?><?php if(!empty($attr_views)) { ?>
  <img src="<?php  echo $image_dir ?>icon/window/down.gif" />
  <div class="dropdown">
    <?php foreach( explode(',',$attr_views) as $attr_tmp_view ) { ?>
	<a class="entry" href="javascript:void(0);" onclick="javascript:startView(this,'<?php echo $attr_tmp_view ?>');"><?php echo lang('MENU_'.$attr_tmp_view) ?></a>
    <?php } ?>
  </div>
<?php } ?>
</div>