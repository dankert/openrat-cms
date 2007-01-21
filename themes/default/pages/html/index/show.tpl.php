<?php $attr = array() ?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Frameset//EN">
<html>
<!-- $Id$ -->
  <head>
    <title><?php echo $title ?> - <?php echo $cms_title ?></title>
    <link rel="shortcut icon" href="<?php echo $image_dir.'favicon.ico' ?>" />
    <meta name="robots" content="noindex,nofollow" />
  </head>
<?php unset($attr) ?><?php $attr = array('rows'=>'23,3,*,3,5') ?><?php $attr_rows='23,3,*,3,5' ?><frameset
<?php echo !empty($attr_rows)   ?' rows="'.$attr_rows.'"':'' ?>
<?php echo !empty($attr_columns)?' cols="'.$attr_columns.'"':'' ?>
 border="0" frameborder="5" framespacing="0" bordercolor="#000000"><?php unset($attr) ?><?php unset($attr_rows) ?><?php $attr = array('file'=>$frame_src_title,'name'=>'cms_title') ?><?php $attr_file=$frame_src_title ?><?php $attr_name='cms_title' ?><frame src="<?php echo $attr_file ?>" name="<?php echo empty($attr_name)?'':$attr_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($attr_scrolling)?'no':$attr_scrolling ?>">
<?php unset($attr) ?><?php unset($attr_file) ?><?php unset($attr_name) ?><?php $attr = array('file'=>$frame_src_border) ?><?php $attr_file=$frame_src_border ?><frame src="<?php echo $attr_file ?>" name="<?php echo empty($attr_name)?'':$attr_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($attr_scrolling)?'no':$attr_scrolling ?>">
<?php unset($attr) ?><?php unset($attr_file) ?><?php $attr = array('columns'=>'25%,*') ?><?php $attr_columns='25%,*' ?><frameset
<?php echo !empty($attr_rows)   ?' rows="'.$attr_rows.'"':'' ?>
<?php echo !empty($attr_columns)?' cols="'.$attr_columns.'"':'' ?>
 border="0" frameborder="5" framespacing="0" bordercolor="#000000"><?php unset($attr) ?><?php unset($attr_columns) ?><?php $attr = array('rows'=>'54,*') ?><?php $attr_rows='54,*' ?><frameset
<?php echo !empty($attr_rows)   ?' rows="'.$attr_rows.'"':'' ?>
<?php echo !empty($attr_columns)?' cols="'.$attr_columns.'"':'' ?>
 border="0" frameborder="5" framespacing="0" bordercolor="#000000"><?php unset($attr) ?><?php unset($attr_rows) ?><?php $attr = array('file'=>$frame_src_tree_title,'name'=>'cms_treemenu') ?><?php $attr_file=$frame_src_tree_title ?><?php $attr_name='cms_treemenu' ?><frame src="<?php echo $attr_file ?>" name="<?php echo empty($attr_name)?'':$attr_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($attr_scrolling)?'no':$attr_scrolling ?>">
<?php unset($attr) ?><?php unset($attr_file) ?><?php unset($attr_name) ?><?php $attr = array('file'=>$frame_src_tree,'name'=>'cms_tree','scrolling'=>'auto') ?><?php $attr_file=$frame_src_tree ?><?php $attr_name='cms_tree' ?><?php $attr_scrolling='auto' ?><frame src="<?php echo $attr_file ?>" name="<?php echo empty($attr_name)?'':$attr_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($attr_scrolling)?'no':$attr_scrolling ?>">
<?php unset($attr) ?><?php unset($attr_file) ?><?php unset($attr_name) ?><?php unset($attr_scrolling) ?><?php $attr = array() ?></frameset>
<?php unset($attr) ?><?php $attr = array('file'=>$frame_src_main,'name'=>'cms_main') ?><?php $attr_file=$frame_src_main ?><?php $attr_name='cms_main' ?><frame src="<?php echo $attr_file ?>" name="<?php echo empty($attr_name)?'':$attr_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($attr_scrolling)?'no':$attr_scrolling ?>">
<?php unset($attr) ?><?php unset($attr_file) ?><?php unset($attr_name) ?><?php $attr = array() ?></frameset>
<?php unset($attr) ?><?php $attr = array('file'=>$frame_src_border) ?><?php $attr_file=$frame_src_border ?><frame src="<?php echo $attr_file ?>" name="<?php echo empty($attr_name)?'':$attr_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($attr_scrolling)?'no':$attr_scrolling ?>">
<?php unset($attr) ?><?php unset($attr_file) ?><?php $attr = array('file'=>$frame_src_background) ?><?php $attr_file=$frame_src_background ?><frame src="<?php echo $attr_file ?>" name="<?php echo empty($attr_name)?'':$attr_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($attr_scrolling)?'no':$attr_scrolling ?>">
<?php unset($attr) ?><?php unset($attr_file) ?><?php $attr = array() ?></frameset>
<?php unset($attr) ?><?php $attr = array() ?>
</html><?php unset($attr) ?>