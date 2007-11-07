<?php $attr1_debug_info = 'a:0:{}' ?><?php $attr1 = array() ?><html>
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
<?php unset($attr1) ?><?php $attr2_debug_info = 'a:1:{s:4:"true";s:33:"config:interface/application_mode";}' ?><?php $attr2 = array('true'=>@$conf['interface']['application_mode']) ?><?php $attr2_true=@$conf['interface']['application_mode'] ?><?php 
	if	( isset($attr2_true) )
	{
		if	(gettype($attr2_true) === '' && gettype($attr2_true) === '1')
			$exec = $$attr2_true == true;
		else
			$exec = $attr2_true == true;
	}
	elseif	( isset($attr2_false) )
	{
		if	(gettype($attr2_false) === '' && gettype($attr2_false) === '1')
			$exec = $$attr2_false == false;
		else
			$exec = $attr2_false == false;
	}
	elseif( isset($attr2_contains) )
		$exec = in_array($attr2_value,explode(',',$attr2_contains));
	elseif( isset($attr2_equals)&& isset($attr2_value) )
		$exec = $attr2_equals == $attr2_value;
	elseif	( isset($attr2_empty) )
	{
		if	( !isset($$attr2_empty) )
			$exec = empty($attr2_empty);
		elseif	( is_array($$attr2_empty) )
			$exec = (count($$attr2_empty)==0);
		elseif	( is_bool($$attr2_empty) )
			$exec = true;
		else
			$exec = empty( $$attr2_empty );
	}
	elseif	( isset($attr2_present) )
	{
		$exec = isset($$attr2_present);
	}
	else
	{
		trigger_error("error in IF, assume: FALSE");
		$exec = false;
	}
	if  ( !empty($attr2_invert) )
		$exec = !$exec;
	if  ( !empty($attr2_not) )
		$exec = !$exec;
	unset($attr2_true);
	unset($attr2_false);
	unset($attr2_notempty);
	unset($attr2_empty);
	unset($attr2_contains);
	unset($attr2_present);
	unset($attr2_invert);
	unset($attr2_not);
	unset($attr2_value);
	unset($attr2_equals);
	$last_exec = $exec;
	if	( $exec )
	{
?>
<?php unset($attr2) ?><?php unset($attr2_true) ?><?php $attr3_debug_info = 'a:2:{s:3:"var";s:10:"menuheight";s:5:"value";s:2:"24";}' ?><?php $attr3 = array('var'=>'menuheight','value'=>'24') ?><?php $attr3_var='menuheight' ?><?php $attr3_value='24' ?><?php
	if (!isset($attr3_value))
		unset($$attr3_var);
	elseif (isset($attr3_key))
		$$attr3_var = $attr3_value[$attr3_key];
	else
		$$attr3_var = $attr3_value;
?><?php unset($attr3) ?><?php unset($attr3_var) ?><?php unset($attr3_value) ?><?php $attr1_debug_info = 'a:0:{}' ?><?php $attr1 = array() ?><?php } ?><?php unset($attr1) ?><?php $attr2_debug_info = 'a:0:{}' ?><?php $attr2 = array() ?><?php if (!$last_exec) { ?>
<?php unset($attr2) ?><?php $attr3_debug_info = 'a:2:{s:3:"var";s:10:"menuheight";s:5:"value";s:2:"54";}' ?><?php $attr3 = array('var'=>'menuheight','value'=>'54') ?><?php $attr3_var='menuheight' ?><?php $attr3_value='54' ?><?php
	if (!isset($attr3_value))
		unset($$attr3_var);
	elseif (isset($attr3_key))
		$$attr3_var = $attr3_value[$attr3_key];
	else
		$$attr3_var = $attr3_value;
?><?php unset($attr3) ?><?php unset($attr3_var) ?><?php unset($attr3_value) ?><?php $attr1_debug_info = 'a:0:{}' ?><?php $attr1 = array() ?><?php } ?><?php unset($attr1) ?><?php $attr2_debug_info = 'a:1:{s:4:"rows";s:14:"{menuheight},*";}' ?><?php $attr2 = array('rows'=>''.$menuheight.',*') ?><?php $attr2_rows=''.$menuheight.',*' ?><frameset
<?php echo !empty($attr2_rows)   ?' rows="'.$attr2_rows.'"':'' ?>
<?php echo !empty($attr2_columns)?' cols="'.$attr2_columns.'"':'' ?>
 border="0" frameborder="5" framespacing="0" bordercolor="#000000"><?php unset($attr2) ?><?php unset($attr2_rows) ?><?php $attr3_debug_info = 'a:2:{s:4:"file";s:23:"var:frame_src_main_menu";s:4:"name";s:13:"cms_main_menu";}' ?><?php $attr3 = array('file'=>$frame_src_main_menu,'name'=>'cms_main_menu') ?><?php $attr3_file=$frame_src_main_menu ?><?php $attr3_name='cms_main_menu' ?><frame src="<?php echo $attr3_file ?>" name="<?php echo empty($attr3_name)?'':$attr3_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($attr3_scrolling)?'no':$attr3_scrolling ?>">
<?php unset($attr3) ?><?php unset($attr3_file) ?><?php unset($attr3_name) ?><?php $attr3_debug_info = 'a:3:{s:4:"file";s:23:"var:frame_src_main_main";s:4:"name";s:13:"cms_main_main";s:9:"scrolling";s:4:"auto";}' ?><?php $attr3 = array('file'=>$frame_src_main_main,'name'=>'cms_main_main','scrolling'=>'auto') ?><?php $attr3_file=$frame_src_main_main ?><?php $attr3_name='cms_main_main' ?><?php $attr3_scrolling='auto' ?><frame src="<?php echo $attr3_file ?>" name="<?php echo empty($attr3_name)?'':$attr3_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($attr3_scrolling)?'no':$attr3_scrolling ?>">
<?php unset($attr3) ?><?php unset($attr3_file) ?><?php unset($attr3_name) ?><?php unset($attr3_scrolling) ?><?php $attr1_debug_info = 'a:0:{}' ?><?php $attr1 = array() ?></frameset>
<?php unset($attr1) ?><?php $attr0_debug_info = 'a:0:{}' ?><?php $attr0 = array() ?></html><?php unset($attr0) ?>