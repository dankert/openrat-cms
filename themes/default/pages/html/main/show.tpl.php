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
<?php unset($a2_true) ?><?php $a3_var='menuheight';$a3_value='24'; ?><?php
	if (isset($a3_key))
		$$a3_var = $a3_value[$a3_key];
	else
		$$a3_var = $a3_value;
?><?php unset($a3_var,$a3_value) ?><?php } ?><?php if (!$a2_tmp_last_exec) { ?>
<?php $a3_var='menuheight';$a3_value='54'; ?><?php
	if (isset($a3_key))
		$$a3_var = $a3_value[$a3_key];
	else
		$$a3_var = $a3_value;
?><?php unset($a3_var,$a3_value) ?><?php }
unset($a1_tmp_last_exec) ?><?php $a2_rows=''.$menuheight.',*'; ?><frameset
<?php echo ' rows="'.$a2_rows.'"' ?>
 border="0" frameborder="5" framespacing="0" bordercolor="#000000"><?php unset($a2_rows) ?><?php $a3_file=$frame_src_main_menu;$a3_name='cms_main_menu'; ?><frame src="<?php echo $a3_file ?>" name="<?php echo empty($a3_name)?'':$a3_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($a3_scrolling)?'no':$a3_scrolling ?>">
<?php unset($a3_file,$a3_name) ?><?php $a3_file=$frame_src_main_main;$a3_name='cms_main_main';$a3_scrolling='auto'; ?><frame src="<?php echo $a3_file ?>" name="<?php echo empty($a3_name)?'':$a3_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($a3_scrolling)?'no':$a3_scrolling ?>">
<?php unset($a3_file,$a3_name,$a3_scrolling) ?></frameset>
</html>