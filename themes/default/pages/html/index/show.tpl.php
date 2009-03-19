<?php  ?><html>
  <head>
    <title><?php echo @$title ?> - <?php echo $cms_title ?></title>
    <link rel="shortcut icon" href="<?php echo $image_dir.'favicon.ico' ?>" />
    <?php if (isset($windowMenu) && is_array($windowMenu)) foreach( $windowMenu as $menu )
      {
       	?>
  <link rel="section" href="<?php echo Html::url($actionName,$menu['subaction'],$this->getRequestId() ) ?>" title="<?php echo lang($menu['text']) ?>" /><?php
      }
?>
    <?php if (isset($metaList) && is_array($metaList)) foreach( $metaList as $meta )
      {
       	?>
  <link rel="<?php echo $meta['name'] ?>" href="<?php echo $meta['url'] ?>" title="<?php echo lang($meta['title']) ?>" /><?php
      }
?>
    <meta name="robots" content="noindex,nofollow" />
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
	if (!isset($attr3_value))
		unset($$attr3_var);
	elseif (isset($attr3_key))
		$$attr3_var = $attr3_value[$attr3_key];
	else
		$$attr3_var = $attr3_value;
?><?php unset($attr3_var);unset($attr3_value); ?><?php  ?><?php } ?><?php  ?><?php  ?><?php if (!$attr2_tmp_last_exec) { ?>
<?php  ?><?php  $attr3_var='menuheight';  $attr3_value='54';  ?><?php
	if (!isset($attr3_value))
		unset($$attr3_var);
	elseif (isset($attr3_key))
		$$attr3_var = $attr3_value[$attr3_key];
	else
		$$attr3_var = $attr3_value;
?><?php unset($attr3_var);unset($attr3_value); ?><?php  ?><?php }
unset($attr1_tmp_last_exec) ?><?php  ?><?php  $attr2_true=@$conf['interface']['application_mode'];  ?><?php 
	if	(gettype($attr2_true) === '' && gettype($attr2_true) === '1')
		$attr2_tmp_exec = $$attr2_true == true;
	else
		$attr2_tmp_exec = $attr2_true == true;
	$attr2_tmp_last_exec = $attr2_tmp_exec;
	if	( $attr2_tmp_exec )
	{
?>
<?php unset($attr2_true); ?><?php  $attr3_rows='*';  ?><frameset
<?php echo !empty($attr3_rows)   ?' rows="'.$attr3_rows.'"':'' ?>
<?php echo !empty($attr3_columns)?' cols="'.$attr3_columns.'"':'' ?>
 border="0" frameborder="5" framespacing="0" bordercolor="#000000"><?php unset($attr3_rows); ?><?php  $attr4_columns='25%,*';  ?><frameset
<?php echo !empty($attr4_rows)   ?' rows="'.$attr4_rows.'"':'' ?>
<?php echo !empty($attr4_columns)?' cols="'.$attr4_columns.'"':'' ?>
 border="0" frameborder="5" framespacing="0" bordercolor="#000000"><?php unset($attr4_columns); ?><?php  $attr5_rows=''.$menuheight.',*';  ?><frameset
<?php echo !empty($attr5_rows)   ?' rows="'.$attr5_rows.'"':'' ?>
<?php echo !empty($attr5_columns)?' cols="'.$attr5_columns.'"':'' ?>
 border="0" frameborder="5" framespacing="0" bordercolor="#000000"><?php unset($attr5_rows); ?><?php  $attr6_file=$frame_src_tree_title;  $attr6_name='cms_treemenu';  ?><frame src="<?php echo $attr6_file ?>" name="<?php echo empty($attr6_name)?'':$attr6_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($attr6_scrolling)?'no':$attr6_scrolling ?>">
<?php unset($attr6_file);unset($attr6_name); ?><?php  $attr6_file=$frame_src_tree;  $attr6_name='cms_tree';  $attr6_scrolling='auto';  ?><frame src="<?php echo $attr6_file ?>" name="<?php echo empty($attr6_name)?'':$attr6_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($attr6_scrolling)?'no':$attr6_scrolling ?>">
<?php unset($attr6_file);unset($attr6_name);unset($attr6_scrolling); ?><?php  ?></frameset>
<?php  ?><?php  $attr5_file=$frame_src_main;  $attr5_name='cms_main';  ?><frame src="<?php echo $attr5_file ?>" name="<?php echo empty($attr5_name)?'':$attr5_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($attr5_scrolling)?'no':$attr5_scrolling ?>">
<?php unset($attr5_file);unset($attr5_name); ?><?php  ?></frameset>
<?php  ?><?php  ?></frameset>
<?php  ?><?php  ?><?php } ?><?php  ?><?php  ?><?php if (!$attr2_tmp_last_exec) { ?>
<?php  ?><?php  $attr3_rows='23,3,*';  ?><frameset
<?php echo !empty($attr3_rows)   ?' rows="'.$attr3_rows.'"':'' ?>
<?php echo !empty($attr3_columns)?' cols="'.$attr3_columns.'"':'' ?>
 border="0" frameborder="5" framespacing="0" bordercolor="#000000"><?php unset($attr3_rows); ?><?php  $attr4_file=$frame_src_title;  $attr4_name='cms_title';  ?><frame src="<?php echo $attr4_file ?>" name="<?php echo empty($attr4_name)?'':$attr4_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($attr4_scrolling)?'no':$attr4_scrolling ?>">
<?php unset($attr4_file);unset($attr4_name); ?><?php  $attr4_file=$frame_src_border;  ?><frame src="<?php echo $attr4_file ?>" name="<?php echo empty($attr4_name)?'':$attr4_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($attr4_scrolling)?'no':$attr4_scrolling ?>">
<?php unset($attr4_file); ?><?php  $attr4_true=@$conf['interface']['application_mode'];  ?><?php 
	if	(gettype($attr4_true) === '' && gettype($attr4_true) === '1')
		$attr4_tmp_exec = $$attr4_true == true;
	else
		$attr4_tmp_exec = $attr4_true == true;
	$attr4_tmp_last_exec = $attr4_tmp_exec;
	if	( $attr4_tmp_exec )
	{
?>
<?php unset($attr4_true); ?><?php  $attr5_var='menuheight';  $attr5_value='24';  ?><?php
	if (!isset($attr5_value))
		unset($$attr5_var);
	elseif (isset($attr5_key))
		$$attr5_var = $attr5_value[$attr5_key];
	else
		$$attr5_var = $attr5_value;
?><?php unset($attr5_var);unset($attr5_value); ?><?php  ?><?php } ?><?php  ?><?php  ?><?php if (!$attr4_tmp_last_exec) { ?>
<?php  ?><?php  $attr5_var='menuheight';  $attr5_value='54';  ?><?php
	if (!isset($attr5_value))
		unset($$attr5_var);
	elseif (isset($attr5_key))
		$$attr5_var = $attr5_value[$attr5_key];
	else
		$$attr5_var = $attr5_value;
?><?php unset($attr5_var);unset($attr5_value); ?><?php  ?><?php }
unset($attr3_tmp_last_exec) ?><?php  ?><?php  $attr4_columns='25%,*';  ?><frameset
<?php echo !empty($attr4_rows)   ?' rows="'.$attr4_rows.'"':'' ?>
<?php echo !empty($attr4_columns)?' cols="'.$attr4_columns.'"':'' ?>
 border="0" frameborder="5" framespacing="0" bordercolor="#000000"><?php unset($attr4_columns); ?><?php  $attr5_rows=''.$menuheight.',*';  ?><frameset
<?php echo !empty($attr5_rows)   ?' rows="'.$attr5_rows.'"':'' ?>
<?php echo !empty($attr5_columns)?' cols="'.$attr5_columns.'"':'' ?>
 border="0" frameborder="5" framespacing="0" bordercolor="#000000"><?php unset($attr5_rows); ?><?php  $attr6_file=$frame_src_tree_title;  $attr6_name='cms_treemenu';  ?><frame src="<?php echo $attr6_file ?>" name="<?php echo empty($attr6_name)?'':$attr6_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($attr6_scrolling)?'no':$attr6_scrolling ?>">
<?php unset($attr6_file);unset($attr6_name); ?><?php  $attr6_file=$frame_src_tree;  $attr6_name='cms_tree';  $attr6_scrolling='auto';  ?><frame src="<?php echo $attr6_file ?>" name="<?php echo empty($attr6_name)?'':$attr6_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($attr6_scrolling)?'no':$attr6_scrolling ?>">
<?php unset($attr6_file);unset($attr6_name);unset($attr6_scrolling); ?><?php  ?></frameset>
<?php  ?><?php  $attr5_file=$frame_src_main;  $attr5_name='cms_main';  ?><frame src="<?php echo $attr5_file ?>" name="<?php echo empty($attr5_name)?'':$attr5_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($attr5_scrolling)?'no':$attr5_scrolling ?>">
<?php unset($attr5_file);unset($attr5_name); ?><?php  ?></frameset>
<?php  ?><?php  ?></frameset>
<?php  ?><?php  ?><?php }
unset($attr1_tmp_last_exec) ?><?php  ?><?php  ?></html><?php  ?>