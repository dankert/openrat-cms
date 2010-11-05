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
<?php $a2_true=@$conf['interface']['application_mode']; ?><?php 
	if	(gettype($a2_true) === '' && gettype($a2_true) === '1')
		$a2_tmp_exec = $$a2_true == true;
	else
		$a2_tmp_exec = $a2_true == true;
	$a2_tmp_last_exec = $a2_tmp_exec;
	if	( $a2_tmp_exec )
	{
?>
<?php unset($a2_true) ?><?php $a3_var='menuheight';$a3_value='30'; ?><?php
	if (isset($a3_key))
		$$a3_var = $a3_value[$a3_key];
	else
		$$a3_var = $a3_value;
?><?php unset($a3_var,$a3_value) ?><?php } ?><?php if (!$a2_tmp_last_exec) { ?>
<?php $a3_var='menuheight';$a3_value='60'; ?><?php
	if (isset($a3_key))
		$$a3_var = $a3_value[$a3_key];
	else
		$$a3_var = $a3_value;
?><?php unset($a3_var,$a3_value) ?><?php }
unset($a1_tmp_last_exec) ?><?php $a2_true=@$conf['interface']['application_mode']; ?><?php 
	if	(gettype($a2_true) === '' && gettype($a2_true) === '1')
		$a2_tmp_exec = $$a2_true == true;
	else
		$a2_tmp_exec = $a2_true == true;
	$a2_tmp_last_exec = $a2_tmp_exec;
	if	( $a2_tmp_exec )
	{
?>
<?php unset($a2_true) ?><?php $a3_rows='*'; ?><frameset
<?php echo ' rows="'.$a3_rows.'"' ?>
 border="0" frameborder="5" framespacing="0" bordercolor="#000000"><?php unset($a3_rows) ?><?php $a4_columns='25%,*'; ?><frameset
<?php echo ' cols="'.$a4_columns.'"' ?>
 border="0" frameborder="5" framespacing="0" bordercolor="#000000"><?php unset($a4_columns) ?><?php $a5_rows=''.$menuheight.',*'; ?><frameset
<?php echo ' rows="'.$a5_rows.'"' ?>
 border="0" frameborder="5" framespacing="0" bordercolor="#000000"><?php unset($a5_rows) ?><?php $a6_file=$frame_src_tree_title;$a6_name='cms_treemenu'; ?><frame src="<?php echo $a6_file ?>" name="<?php echo empty($a6_name)?'':$a6_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($a6_scrolling)?'no':$a6_scrolling ?>">
<?php unset($a6_file,$a6_name) ?><?php $a6_file=$frame_src_tree;$a6_name='cms_tree';$a6_scrolling='auto'; ?><frame src="<?php echo $a6_file ?>" name="<?php echo empty($a6_name)?'':$a6_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($a6_scrolling)?'no':$a6_scrolling ?>">
<?php unset($a6_file,$a6_name,$a6_scrolling) ?></frameset>
<?php $a5_file=$frame_src_main;$a5_name='cms_main'; ?><frame src="<?php echo $a5_file ?>" name="<?php echo empty($a5_name)?'':$a5_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($a5_scrolling)?'no':$a5_scrolling ?>">
<?php unset($a5_file,$a5_name) ?></frameset>
</frameset>
<?php } ?><?php if (!$a2_tmp_last_exec) { ?>
<?php $a3_rows='23,*'; ?><frameset
<?php echo ' rows="'.$a3_rows.'"' ?>
 border="0" frameborder="5" framespacing="0" bordercolor="#000000"><?php unset($a3_rows) ?><?php $a4_file=$frame_src_title;$a4_name='cms_title'; ?><frame src="<?php echo $a4_file ?>" name="<?php echo empty($a4_name)?'':$a4_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($a4_scrolling)?'no':$a4_scrolling ?>">
<?php unset($a4_file,$a4_name) ?><?php $a4_columns='25%,*'; ?><frameset
<?php echo ' cols="'.$a4_columns.'"' ?>
 border="0" frameborder="5" framespacing="0" bordercolor="#000000"><?php unset($a4_columns) ?><?php $a5_rows=''.$menuheight.',*'; ?><frameset
<?php echo ' rows="'.$a5_rows.'"' ?>
 border="0" frameborder="5" framespacing="0" bordercolor="#000000"><?php unset($a5_rows) ?><?php $a6_file=$frame_src_tree_title;$a6_name='cms_treemenu'; ?><frame src="<?php echo $a6_file ?>" name="<?php echo empty($a6_name)?'':$a6_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($a6_scrolling)?'no':$a6_scrolling ?>">
<?php unset($a6_file,$a6_name) ?><?php $a6_file=$frame_src_tree;$a6_name='cms_tree';$a6_scrolling='auto'; ?><frame src="<?php echo $a6_file ?>" name="<?php echo empty($a6_name)?'':$a6_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($a6_scrolling)?'no':$a6_scrolling ?>">
<?php unset($a6_file,$a6_name,$a6_scrolling) ?></frameset>
<?php $a5_file=$frame_src_main;$a5_name='cms_main'; ?><frame src="<?php echo $a5_file ?>" name="<?php echo empty($a5_name)?'':$a5_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($a5_scrolling)?'no':$a5_scrolling ?>">
<?php unset($a5_file,$a5_name) ?></frameset>
</frameset>
<?php }
unset($a1_tmp_last_exec) ?></html>