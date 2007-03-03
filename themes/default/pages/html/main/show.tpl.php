<?php $attr1 = array() ?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Frameset//EN">
<html>
<!-- $Id$ -->
  <head>
    <title><?php echo $title ?> - <?php echo $cms_title ?></title>
    <link rel="shortcut icon" href="<?php echo $image_dir.'favicon.ico' ?>" />
    <link rel="top" title="Start" href="./" />
    <link rel="author" title="Homepage" href="http://www.openrat.de" />

    <?php if (is_array($windowMenu)) foreach( $windowMenu as $menu )
      {
       	?>
  <link rel="section" href="<?php echo Html::url($actionName,$menu['subaction'],$this->getRequestId() ) ?>" title="<?php echo lang($menu['text']) ?>" /><?php
      }
?>
    <meta name="robots" content="noindex,nofollow" />
  </head>
<?php unset($attr1) ?><?php $attr2 = array('rows'=>'54,*') ?><?php $attr2_rows='54,*' ?><frameset
<?php echo !empty($attr2_rows)   ?' rows="'.$attr2_rows.'"':'' ?>
<?php echo !empty($attr2_columns)?' cols="'.$attr2_columns.'"':'' ?>
 border="0" frameborder="5" framespacing="0" bordercolor="#000000"><?php unset($attr2) ?><?php unset($attr2_rows) ?><?php $attr3 = array('file'=>$frame_src_main_menu,'name'=>'cms_main_menu') ?><?php $attr3_file=$frame_src_main_menu ?><?php $attr3_name='cms_main_menu' ?><frame src="<?php echo $attr3_file ?>" name="<?php echo empty($attr3_name)?'':$attr3_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($attr3_scrolling)?'no':$attr3_scrolling ?>">
<?php unset($attr3) ?><?php unset($attr3_file) ?><?php unset($attr3_name) ?><?php $attr3 = array('file'=>$frame_src_main_main,'name'=>'cms_main_main','scrolling'=>'auto') ?><?php $attr3_file=$frame_src_main_main ?><?php $attr3_name='cms_main_main' ?><?php $attr3_scrolling='auto' ?><frame src="<?php echo $attr3_file ?>" name="<?php echo empty($attr3_name)?'':$attr3_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($attr3_scrolling)?'no':$attr3_scrolling ?>">
<?php unset($attr3) ?><?php unset($attr3_file) ?><?php unset($attr3_name) ?><?php unset($attr3_scrolling) ?><?php $attr1 = array() ?></frameset>
<?php unset($attr1) ?><?php $attr0 = array() ?>
</html><?php unset($attr0) ?>