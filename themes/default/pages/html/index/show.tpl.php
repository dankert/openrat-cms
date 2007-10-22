<?php $attr1_debug_info = 'a:0:{}' ?><?php $attr1 = array() ?><html>
  <head>
    <title><?php echo @$title ?> - <?php echo $cms_title ?></title>
    <link rel="shortcut icon" href="<?php echo $image_dir.'favicon.ico' ?>" />
    <link rel="top" title="Start" href="./" />
    <link rel="author" title="Homepage" href="http://www.openrat.de" />
    <?php if (isset($windowMenu) && is_array($windowMenu)) foreach( $windowMenu as $menu )
      {
       	?>
  <link rel="section" href="<?php echo Html::url($actionName,$menu['subaction'],$this->getRequestId() ) ?>" title="<?php echo lang($menu['text']) ?>" /><?php
      }
?>
    <meta name="robots" content="noindex,nofollow" />
  </head>
<?php unset($attr1) ?><?php $attr2_debug_info = 'a:1:{s:4:"rows";s:10:"23,3,*,3,5";}' ?><?php $attr2 = array('rows'=>'23,3,*,3,5') ?><?php $attr2_rows='23,3,*,3,5' ?><frameset
<?php echo !empty($attr2_rows)   ?' rows="'.$attr2_rows.'"':'' ?>
<?php echo !empty($attr2_columns)?' cols="'.$attr2_columns.'"':'' ?>
 border="0" frameborder="5" framespacing="0" bordercolor="#000000"><?php unset($attr2) ?><?php unset($attr2_rows) ?><?php $attr3_debug_info = 'a:2:{s:4:"file";s:19:"var:frame_src_title";s:4:"name";s:9:"cms_title";}' ?><?php $attr3 = array('file'=>$frame_src_title,'name'=>'cms_title') ?><?php $attr3_file=$frame_src_title ?><?php $attr3_name='cms_title' ?><frame src="<?php echo $attr3_file ?>" name="<?php echo empty($attr3_name)?'':$attr3_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($attr3_scrolling)?'no':$attr3_scrolling ?>">
<?php unset($attr3) ?><?php unset($attr3_file) ?><?php unset($attr3_name) ?><?php $attr3_debug_info = 'a:1:{s:4:"file";s:20:"var:frame_src_border";}' ?><?php $attr3 = array('file'=>$frame_src_border) ?><?php $attr3_file=$frame_src_border ?><frame src="<?php echo $attr3_file ?>" name="<?php echo empty($attr3_name)?'':$attr3_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($attr3_scrolling)?'no':$attr3_scrolling ?>">
<?php unset($attr3) ?><?php unset($attr3_file) ?><?php $attr3_debug_info = 'a:1:{s:7:"columns";s:5:"25%,*";}' ?><?php $attr3 = array('columns'=>'25%,*') ?><?php $attr3_columns='25%,*' ?><frameset
<?php echo !empty($attr3_rows)   ?' rows="'.$attr3_rows.'"':'' ?>
<?php echo !empty($attr3_columns)?' cols="'.$attr3_columns.'"':'' ?>
 border="0" frameborder="5" framespacing="0" bordercolor="#000000"><?php unset($attr3) ?><?php unset($attr3_columns) ?><?php $attr4_debug_info = 'a:1:{s:4:"rows";s:4:"54,*";}' ?><?php $attr4 = array('rows'=>'54,*') ?><?php $attr4_rows='54,*' ?><frameset
<?php echo !empty($attr4_rows)   ?' rows="'.$attr4_rows.'"':'' ?>
<?php echo !empty($attr4_columns)?' cols="'.$attr4_columns.'"':'' ?>
 border="0" frameborder="5" framespacing="0" bordercolor="#000000"><?php unset($attr4) ?><?php unset($attr4_rows) ?><?php $attr5_debug_info = 'a:2:{s:4:"file";s:24:"var:frame_src_tree_title";s:4:"name";s:12:"cms_treemenu";}' ?><?php $attr5 = array('file'=>$frame_src_tree_title,'name'=>'cms_treemenu') ?><?php $attr5_file=$frame_src_tree_title ?><?php $attr5_name='cms_treemenu' ?><frame src="<?php echo $attr5_file ?>" name="<?php echo empty($attr5_name)?'':$attr5_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($attr5_scrolling)?'no':$attr5_scrolling ?>">
<?php unset($attr5) ?><?php unset($attr5_file) ?><?php unset($attr5_name) ?><?php $attr5_debug_info = 'a:3:{s:4:"file";s:18:"var:frame_src_tree";s:4:"name";s:8:"cms_tree";s:9:"scrolling";s:4:"auto";}' ?><?php $attr5 = array('file'=>$frame_src_tree,'name'=>'cms_tree','scrolling'=>'auto') ?><?php $attr5_file=$frame_src_tree ?><?php $attr5_name='cms_tree' ?><?php $attr5_scrolling='auto' ?><frame src="<?php echo $attr5_file ?>" name="<?php echo empty($attr5_name)?'':$attr5_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($attr5_scrolling)?'no':$attr5_scrolling ?>">
<?php unset($attr5) ?><?php unset($attr5_file) ?><?php unset($attr5_name) ?><?php unset($attr5_scrolling) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?></frameset>
<?php unset($attr3) ?><?php $attr4_debug_info = 'a:2:{s:4:"file";s:18:"var:frame_src_main";s:4:"name";s:8:"cms_main";}' ?><?php $attr4 = array('file'=>$frame_src_main,'name'=>'cms_main') ?><?php $attr4_file=$frame_src_main ?><?php $attr4_name='cms_main' ?><frame src="<?php echo $attr4_file ?>" name="<?php echo empty($attr4_name)?'':$attr4_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($attr4_scrolling)?'no':$attr4_scrolling ?>">
<?php unset($attr4) ?><?php unset($attr4_file) ?><?php unset($attr4_name) ?><?php $attr2_debug_info = 'a:0:{}' ?><?php $attr2 = array() ?></frameset>
<?php unset($attr2) ?><?php $attr3_debug_info = 'a:1:{s:4:"file";s:20:"var:frame_src_border";}' ?><?php $attr3 = array('file'=>$frame_src_border) ?><?php $attr3_file=$frame_src_border ?><frame src="<?php echo $attr3_file ?>" name="<?php echo empty($attr3_name)?'':$attr3_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($attr3_scrolling)?'no':$attr3_scrolling ?>">
<?php unset($attr3) ?><?php unset($attr3_file) ?><?php $attr3_debug_info = 'a:1:{s:4:"file";s:24:"var:frame_src_background";}' ?><?php $attr3 = array('file'=>$frame_src_background) ?><?php $attr3_file=$frame_src_background ?><frame src="<?php echo $attr3_file ?>" name="<?php echo empty($attr3_name)?'':$attr3_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($attr3_scrolling)?'no':$attr3_scrolling ?>">
<?php unset($attr3) ?><?php unset($attr3_file) ?><?php $attr1_debug_info = 'a:0:{}' ?><?php $attr1 = array() ?></frameset>
<?php unset($attr1) ?><?php $attr0_debug_info = 'a:0:{}' ?><?php $attr0 = array() ?></html><?php unset($attr0) ?>