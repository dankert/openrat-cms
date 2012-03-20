<?php
 if (!headers_sent()) header('Content-Type: text/html; charset='.$charset)
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Frameset//EN">
<html>
  <head>
    <title><?php echo @$title ?> - <?php echo $cms_title ?></title>
    <link rel="shortcut icon" href="<?php echo $image_dir.'favicon.ico' ?>" >
    <?php if (isset($windowMenu) && is_array($windowMenu)) foreach( $windowMenu as $menu )
      {
       	?>
  <link rel="section" href="<?php echo Html::url($actionName,$menu['subaction'],$this->getRequestId() ) ?>" title="<?php echo lang($menu['text']) ?>" ><?php
      }
?>
    <?php if (isset($metaList) && is_array($metaList)) foreach( $metaList as $meta )
      {
       	?>
  <link rel="<?php echo $meta['name'] ?>" href="<?php echo $meta['url'] ?>" title="<?php echo $meta['title'] ?>" ><?php
      }
?>
    <meta name="robots" content="noindex,nofollow" >
  </head>
<?php $a3_true=@$conf['interface']['application_mode']; ?><?php 
	if	(gettype($a3_true) === '' && gettype($a3_true) === '1')
		$a3_tmp_exec = $$a3_true == true;
	else
		$a3_tmp_exec = $a3_true == true;
	$a3_tmp_last_exec = $a3_tmp_exec;
	if	( $a3_tmp_exec )
	{
?>
<?php unset($a3_true) ?><?php $a4_var='menuheight';$a4_value='30'; ?><?php
	if (isset($a4_key))
		$$a4_var = $a4_value[$a4_key];
	else
		$$a4_var = $a4_value;
?><?php unset($a4_var,$a4_value) ?><?php } ?><?php if (!$a3_tmp_last_exec) { ?>
<?php $a4_var='menuheight';$a4_value='60'; ?><?php
	if (isset($a4_key))
		$$a4_var = $a4_value[$a4_key];
	else
		$$a4_var = $a4_value;
?><?php unset($a4_var,$a4_value) ?><?php }
unset($a2_tmp_last_exec) ?><?php $a3_true=@$conf['interface']['application_mode']; ?><?php 
	if	(gettype($a3_true) === '' && gettype($a3_true) === '1')
		$a3_tmp_exec = $$a3_true == true;
	else
		$a3_tmp_exec = $a3_true == true;
	$a3_tmp_last_exec = $a3_tmp_exec;
	if	( $a3_tmp_exec )
	{
?>
<?php unset($a3_true) ?><?php $a4_rows='*'; ?><frameset
<?php echo ' rows="'.$a4_rows.'"' ?>
 border="0" frameborder="5" framespacing="0" bordercolor="#000000"><?php unset($a4_rows) ?><?php $a5_columns='25%,*'; ?><frameset
<?php echo ' cols="'.$a5_columns.'"' ?>
 border="0" frameborder="5" framespacing="0" bordercolor="#000000"><?php unset($a5_columns) ?><?php $a6_rows=''.$menuheight.',*'; ?><frameset
<?php echo ' rows="'.$a6_rows.'"' ?>
 border="0" frameborder="5" framespacing="0" bordercolor="#000000"><?php unset($a6_rows) ?><?php $a7_file=$frame_src_tree_title;$a7_name='cms_treemenu'; ?><frame src="<?php echo $a7_file ?>" name="<?php echo empty($a7_name)?'':$a7_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($a7_scrolling)?'no':$a7_scrolling ?>">
<?php unset($a7_file,$a7_name) ?><?php $a7_file=$frame_src_tree;$a7_name='cms_tree';$a7_scrolling='auto'; ?><frame src="<?php echo $a7_file ?>" name="<?php echo empty($a7_name)?'':$a7_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($a7_scrolling)?'no':$a7_scrolling ?>">
<?php unset($a7_file,$a7_name,$a7_scrolling) ?></frameset>
<?php $a6_file=$frame_src_main;$a6_name='cms_main'; ?><frame src="<?php echo $a6_file ?>" name="<?php echo empty($a6_name)?'':$a6_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($a6_scrolling)?'no':$a6_scrolling ?>">
<?php unset($a6_file,$a6_name) ?></frameset>
</frameset>
<?php } ?><?php if (!$a3_tmp_last_exec) { ?>
<?php $a4_rows='23,*'; ?><frameset
<?php echo ' rows="'.$a4_rows.'"' ?>
 border="0" frameborder="5" framespacing="0" bordercolor="#000000"><?php unset($a4_rows) ?><?php $a5_file=$frame_src_title;$a5_name='cms_title'; ?><frame src="<?php echo $a5_file ?>" name="<?php echo empty($a5_name)?'':$a5_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($a5_scrolling)?'no':$a5_scrolling ?>">
<?php unset($a5_file,$a5_name) ?><?php $a5_columns='25%,*'; ?><frameset
<?php echo ' cols="'.$a5_columns.'"' ?>
 border="0" frameborder="5" framespacing="0" bordercolor="#000000"><?php unset($a5_columns) ?><?php $a6_rows=''.$menuheight.',*'; ?><frameset
<?php echo ' rows="'.$a6_rows.'"' ?>
 border="0" frameborder="5" framespacing="0" bordercolor="#000000"><?php unset($a6_rows) ?><?php $a7_file=$frame_src_tree_title;$a7_name='cms_treemenu'; ?><frame src="<?php echo $a7_file ?>" name="<?php echo empty($a7_name)?'':$a7_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($a7_scrolling)?'no':$a7_scrolling ?>">
<?php unset($a7_file,$a7_name) ?><?php $a7_file=$frame_src_tree;$a7_name='cms_tree';$a7_scrolling='auto'; ?><frame src="<?php echo $a7_file ?>" name="<?php echo empty($a7_name)?'':$a7_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($a7_scrolling)?'no':$a7_scrolling ?>">
<?php unset($a7_file,$a7_name,$a7_scrolling) ?></frameset>
<?php $a6_file=$frame_src_main;$a6_name='cms_main'; ?><frame src="<?php echo $a6_file ?>" name="<?php echo empty($a6_name)?'':$a6_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($a6_scrolling)?'no':$a6_scrolling ?>">
<?php unset($a6_file,$a6_name) ?></frameset>
</frameset>
<?php }
unset($a2_tmp_last_exec) ?></html>