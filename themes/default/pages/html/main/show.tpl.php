<?php  ?><?php
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
<?php  ?><?php  $attr2_true=@$conf['interface']['application_mode'];  ?><?php 
	if	(gettype($attr2_true) === '' && gettype($attr2_true) === '1')
		$attr2_tmp_exec = $$attr2_true == true;
	else
		$attr2_tmp_exec = $attr2_true == true;
	$attr2_tmp_last_exec = $attr2_tmp_exec;
	if	( $attr2_tmp_exec )
	{
?>
<?php unset($attr2_true); ?><?php  $attr3_var='menuheight';  $attr3_value='24';  ?><?php
	if (isset($attr3_key))
		$$attr3_var = $attr3_value[$attr3_key];
	else
		$$attr3_var = $attr3_value;
?><?php unset($attr3_var);unset($attr3_value); ?><?php  ?><?php } ?><?php  ?><?php  ?><?php if (!$attr2_tmp_last_exec) { ?>
<?php  ?><?php  $attr3_var='menuheight';  $attr3_value='54';  ?><?php
	if (isset($attr3_key))
		$$attr3_var = $attr3_value[$attr3_key];
	else
		$$attr3_var = $attr3_value;
?><?php unset($attr3_var);unset($attr3_value); ?><?php  ?><?php }
unset($attr1_tmp_last_exec) ?><?php  ?><?php  $attr2_rows=''.$menuheight.',*';  ?><frameset
<?php echo ' rows="'.$attr2_rows.'"' ?>
 border="0" frameborder="5" framespacing="0" bordercolor="#000000"><?php unset($attr2_rows); ?><?php  $attr3_file=$frame_src_main_menu;  $attr3_name='cms_main_menu';  ?><frame src="<?php echo $attr3_file ?>" name="<?php echo empty($attr3_name)?'':$attr3_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($attr3_scrolling)?'no':$attr3_scrolling ?>">
<?php unset($attr3_file);unset($attr3_name); ?><?php  $attr3_file=$frame_src_main_main;  $attr3_name='cms_main_main';  $attr3_scrolling='auto';  ?><frame src="<?php echo $attr3_file ?>" name="<?php echo empty($attr3_name)?'':$attr3_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($attr3_scrolling)?'no':$attr3_scrolling ?>">
<?php unset($attr3_file);unset($attr3_name);unset($attr3_scrolling); ?><?php  ?></frameset>
<?php  ?><?php  ?></html><?php  ?>