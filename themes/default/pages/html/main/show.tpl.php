<?php $attr = array() ?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Frameset//EN">
<html>
<!-- $Id$ -->
  <head>
    <title><?php echo $title ?> - <?php echo $cms_title ?></title>
    <link rel="shortcut icon" href="<?php echo $image_dir.'favicon.ico' ?>" />
    <meta name="robots" content="noindex,nofollow" />
  </head>
<?php unset($attr) ?><?php $attr = array('rows'=>'3,54,*,3','columns'=>'') ?><?php $attr_rows='3,54,*,3' ?><?php $attr_columns='' ?><frameset
<?php echo !empty($attr_rows)   ?' rows="'.$attr_rows.'"':'' ?>
<?php echo !empty($attr_columns)?' cols="'.$attr_columns.'"':'' ?>
 border="0" frameborder="5" framespacing="0" bordercolor="#000000"><?php unset($attr) ?><?php unset($attr_rows) ?><?php unset($attr_columns) ?><?php $attr = array('file'=>'frame_src_border','name'=>'','scrolling'=>'') ?><?php $attr_file='frame_src_border' ?><?php $attr_name='' ?><?php $attr_scrolling='' ?><frame src="<?php echo $$attr_file ?>" name="<?php echo empty($attr_name)?'':$attr_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($attr_scrolling)?'no':$attr_scrolling ?>">
<?php unset($attr) ?><?php unset($attr_file) ?><?php unset($attr_name) ?><?php unset($attr_scrolling) ?><?php $attr = array('file'=>'frame_src_main_menu','name'=>'cms_main_menu','scrolling'=>'') ?><?php $attr_file='frame_src_main_menu' ?><?php $attr_name='cms_main_menu' ?><?php $attr_scrolling='' ?><frame src="<?php echo $$attr_file ?>" name="<?php echo empty($attr_name)?'':$attr_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($attr_scrolling)?'no':$attr_scrolling ?>">
<?php unset($attr) ?><?php unset($attr_file) ?><?php unset($attr_name) ?><?php unset($attr_scrolling) ?><?php $attr = array('file'=>'frame_src_main_main','name'=>'cms_main_main','scrolling'=>'auto') ?><?php $attr_file='frame_src_main_main' ?><?php $attr_name='cms_main_main' ?><?php $attr_scrolling='auto' ?><frame src="<?php echo $$attr_file ?>" name="<?php echo empty($attr_name)?'':$attr_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($attr_scrolling)?'no':$attr_scrolling ?>">
<?php unset($attr) ?><?php unset($attr_file) ?><?php unset($attr_name) ?><?php unset($attr_scrolling) ?><?php $attr = array('file'=>'frame_src_border','name'=>'','scrolling'=>'') ?><?php $attr_file='frame_src_border' ?><?php $attr_name='' ?><?php $attr_scrolling='' ?><frame src="<?php echo $$attr_file ?>" name="<?php echo empty($attr_name)?'':$attr_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($attr_scrolling)?'no':$attr_scrolling ?>">
<?php unset($attr) ?><?php unset($attr_file) ?><?php unset($attr_name) ?><?php unset($attr_scrolling) ?><?php $attr = array() ?></frameset>
<?php unset($attr) ?><?php $attr = array() ?>
</html><?php unset($attr) ?>