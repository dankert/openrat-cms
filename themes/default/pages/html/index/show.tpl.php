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
	elseif( isset($attr2_lessthan)&& isset($attr2_value) )
		$exec = intval($attr2_lessthan) > intval($attr2_value);
	elseif( isset($attr2_greaterthan)&& isset($attr2_value) )
		$exec = intval($attr2_greaterthan) < intval($attr2_value);
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
?><?php unset($attr3) ?><?php unset($attr3_var) ?><?php unset($attr3_value) ?><?php $attr1_debug_info = 'a:0:{}' ?><?php $attr1 = array() ?><?php } ?><?php unset($attr1) ?><?php $attr2_debug_info = 'a:1:{s:4:"true";s:33:"config:interface/application_mode";}' ?><?php $attr2 = array('true'=>@$conf['interface']['application_mode']) ?><?php $attr2_true=@$conf['interface']['application_mode'] ?><?php 
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
	elseif( isset($attr2_lessthan)&& isset($attr2_value) )
		$exec = intval($attr2_lessthan) > intval($attr2_value);
	elseif( isset($attr2_greaterthan)&& isset($attr2_value) )
		$exec = intval($attr2_greaterthan) < intval($attr2_value);
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
<?php unset($attr2) ?><?php unset($attr2_true) ?><?php $attr3_debug_info = 'a:1:{s:4:"rows";s:1:"*";}' ?><?php $attr3 = array('rows'=>'*') ?><?php $attr3_rows='*' ?><frameset
<?php echo !empty($attr3_rows)   ?' rows="'.$attr3_rows.'"':'' ?>
<?php echo !empty($attr3_columns)?' cols="'.$attr3_columns.'"':'' ?>
 border="0" frameborder="5" framespacing="0" bordercolor="#000000"><?php unset($attr3) ?><?php unset($attr3_rows) ?><?php $attr4_debug_info = 'a:1:{s:7:"columns";s:5:"25%,*";}' ?><?php $attr4 = array('columns'=>'25%,*') ?><?php $attr4_columns='25%,*' ?><frameset
<?php echo !empty($attr4_rows)   ?' rows="'.$attr4_rows.'"':'' ?>
<?php echo !empty($attr4_columns)?' cols="'.$attr4_columns.'"':'' ?>
 border="0" frameborder="5" framespacing="0" bordercolor="#000000"><?php unset($attr4) ?><?php unset($attr4_columns) ?><?php $attr5_debug_info = 'a:1:{s:4:"rows";s:14:"{menuheight},*";}' ?><?php $attr5 = array('rows'=>''.$menuheight.',*') ?><?php $attr5_rows=''.$menuheight.',*' ?><frameset
<?php echo !empty($attr5_rows)   ?' rows="'.$attr5_rows.'"':'' ?>
<?php echo !empty($attr5_columns)?' cols="'.$attr5_columns.'"':'' ?>
 border="0" frameborder="5" framespacing="0" bordercolor="#000000"><?php unset($attr5) ?><?php unset($attr5_rows) ?><?php $attr6_debug_info = 'a:2:{s:4:"file";s:24:"var:frame_src_tree_title";s:4:"name";s:12:"cms_treemenu";}' ?><?php $attr6 = array('file'=>$frame_src_tree_title,'name'=>'cms_treemenu') ?><?php $attr6_file=$frame_src_tree_title ?><?php $attr6_name='cms_treemenu' ?><frame src="<?php echo $attr6_file ?>" name="<?php echo empty($attr6_name)?'':$attr6_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($attr6_scrolling)?'no':$attr6_scrolling ?>">
<?php unset($attr6) ?><?php unset($attr6_file) ?><?php unset($attr6_name) ?><?php $attr6_debug_info = 'a:3:{s:4:"file";s:18:"var:frame_src_tree";s:4:"name";s:8:"cms_tree";s:9:"scrolling";s:4:"auto";}' ?><?php $attr6 = array('file'=>$frame_src_tree,'name'=>'cms_tree','scrolling'=>'auto') ?><?php $attr6_file=$frame_src_tree ?><?php $attr6_name='cms_tree' ?><?php $attr6_scrolling='auto' ?><frame src="<?php echo $attr6_file ?>" name="<?php echo empty($attr6_name)?'':$attr6_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($attr6_scrolling)?'no':$attr6_scrolling ?>">
<?php unset($attr6) ?><?php unset($attr6_file) ?><?php unset($attr6_name) ?><?php unset($attr6_scrolling) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></frameset>
<?php unset($attr4) ?><?php $attr5_debug_info = 'a:2:{s:4:"file";s:18:"var:frame_src_main";s:4:"name";s:8:"cms_main";}' ?><?php $attr5 = array('file'=>$frame_src_main,'name'=>'cms_main') ?><?php $attr5_file=$frame_src_main ?><?php $attr5_name='cms_main' ?><frame src="<?php echo $attr5_file ?>" name="<?php echo empty($attr5_name)?'':$attr5_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($attr5_scrolling)?'no':$attr5_scrolling ?>">
<?php unset($attr5) ?><?php unset($attr5_file) ?><?php unset($attr5_name) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?></frameset>
<?php unset($attr3) ?><?php $attr2_debug_info = 'a:0:{}' ?><?php $attr2 = array() ?></frameset>
<?php unset($attr2) ?><?php $attr1_debug_info = 'a:0:{}' ?><?php $attr1 = array() ?><?php } ?><?php unset($attr1) ?><?php $attr2_debug_info = 'a:0:{}' ?><?php $attr2 = array() ?><?php if (!$last_exec) { ?>
<?php unset($attr2) ?><?php $attr3_debug_info = 'a:1:{s:4:"rows";s:10:"23,3,*,3,5";}' ?><?php $attr3 = array('rows'=>'23,3,*,3,5') ?><?php $attr3_rows='23,3,*,3,5' ?><frameset
<?php echo !empty($attr3_rows)   ?' rows="'.$attr3_rows.'"':'' ?>
<?php echo !empty($attr3_columns)?' cols="'.$attr3_columns.'"':'' ?>
 border="0" frameborder="5" framespacing="0" bordercolor="#000000"><?php unset($attr3) ?><?php unset($attr3_rows) ?><?php $attr4_debug_info = 'a:2:{s:4:"file";s:19:"var:frame_src_title";s:4:"name";s:9:"cms_title";}' ?><?php $attr4 = array('file'=>$frame_src_title,'name'=>'cms_title') ?><?php $attr4_file=$frame_src_title ?><?php $attr4_name='cms_title' ?><frame src="<?php echo $attr4_file ?>" name="<?php echo empty($attr4_name)?'':$attr4_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($attr4_scrolling)?'no':$attr4_scrolling ?>">
<?php unset($attr4) ?><?php unset($attr4_file) ?><?php unset($attr4_name) ?><?php $attr4_debug_info = 'a:1:{s:4:"file";s:20:"var:frame_src_border";}' ?><?php $attr4 = array('file'=>$frame_src_border) ?><?php $attr4_file=$frame_src_border ?><frame src="<?php echo $attr4_file ?>" name="<?php echo empty($attr4_name)?'':$attr4_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($attr4_scrolling)?'no':$attr4_scrolling ?>">
<?php unset($attr4) ?><?php unset($attr4_file) ?><?php $attr4_debug_info = 'a:1:{s:4:"true";s:33:"config:interface/application_mode";}' ?><?php $attr4 = array('true'=>@$conf['interface']['application_mode']) ?><?php $attr4_true=@$conf['interface']['application_mode'] ?><?php 
	if	( isset($attr4_true) )
	{
		if	(gettype($attr4_true) === '' && gettype($attr4_true) === '1')
			$exec = $$attr4_true == true;
		else
			$exec = $attr4_true == true;
	}
	elseif	( isset($attr4_false) )
	{
		if	(gettype($attr4_false) === '' && gettype($attr4_false) === '1')
			$exec = $$attr4_false == false;
		else
			$exec = $attr4_false == false;
	}
	elseif( isset($attr4_contains) )
		$exec = in_array($attr4_value,explode(',',$attr4_contains));
	elseif( isset($attr4_equals)&& isset($attr4_value) )
		$exec = $attr4_equals == $attr4_value;
	elseif( isset($attr4_lessthan)&& isset($attr4_value) )
		$exec = intval($attr4_lessthan) > intval($attr4_value);
	elseif( isset($attr4_greaterthan)&& isset($attr4_value) )
		$exec = intval($attr4_greaterthan) < intval($attr4_value);
	elseif	( isset($attr4_empty) )
	{
		if	( !isset($$attr4_empty) )
			$exec = empty($attr4_empty);
		elseif	( is_array($$attr4_empty) )
			$exec = (count($$attr4_empty)==0);
		elseif	( is_bool($$attr4_empty) )
			$exec = true;
		else
			$exec = empty( $$attr4_empty );
	}
	elseif	( isset($attr4_present) )
	{
		$exec = isset($$attr4_present);
	}
	else
	{
		trigger_error("error in IF, assume: FALSE");
		$exec = false;
	}
	if  ( !empty($attr4_invert) )
		$exec = !$exec;
	if  ( !empty($attr4_not) )
		$exec = !$exec;
	unset($attr4_true);
	unset($attr4_false);
	unset($attr4_notempty);
	unset($attr4_empty);
	unset($attr4_contains);
	unset($attr4_present);
	unset($attr4_invert);
	unset($attr4_not);
	unset($attr4_value);
	unset($attr4_equals);
	$last_exec = $exec;
	if	( $exec )
	{
?>
<?php unset($attr4) ?><?php unset($attr4_true) ?><?php $attr5_debug_info = 'a:2:{s:3:"var";s:10:"menuheight";s:5:"value";s:2:"24";}' ?><?php $attr5 = array('var'=>'menuheight','value'=>'24') ?><?php $attr5_var='menuheight' ?><?php $attr5_value='24' ?><?php
	if (!isset($attr5_value))
		unset($$attr5_var);
	elseif (isset($attr5_key))
		$$attr5_var = $attr5_value[$attr5_key];
	else
		$$attr5_var = $attr5_value;
?><?php unset($attr5) ?><?php unset($attr5_var) ?><?php unset($attr5_value) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php } ?><?php unset($attr3) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?><?php if (!$last_exec) { ?>
<?php unset($attr4) ?><?php $attr5_debug_info = 'a:2:{s:3:"var";s:10:"menuheight";s:5:"value";s:2:"54";}' ?><?php $attr5 = array('var'=>'menuheight','value'=>'54') ?><?php $attr5_var='menuheight' ?><?php $attr5_value='54' ?><?php
	if (!isset($attr5_value))
		unset($$attr5_var);
	elseif (isset($attr5_key))
		$$attr5_var = $attr5_value[$attr5_key];
	else
		$$attr5_var = $attr5_value;
?><?php unset($attr5) ?><?php unset($attr5_var) ?><?php unset($attr5_value) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php } ?><?php unset($attr3) ?><?php $attr4_debug_info = 'a:1:{s:7:"columns";s:5:"25%,*";}' ?><?php $attr4 = array('columns'=>'25%,*') ?><?php $attr4_columns='25%,*' ?><frameset
<?php echo !empty($attr4_rows)   ?' rows="'.$attr4_rows.'"':'' ?>
<?php echo !empty($attr4_columns)?' cols="'.$attr4_columns.'"':'' ?>
 border="0" frameborder="5" framespacing="0" bordercolor="#000000"><?php unset($attr4) ?><?php unset($attr4_columns) ?><?php $attr5_debug_info = 'a:1:{s:4:"rows";s:14:"{menuheight},*";}' ?><?php $attr5 = array('rows'=>''.$menuheight.',*') ?><?php $attr5_rows=''.$menuheight.',*' ?><frameset
<?php echo !empty($attr5_rows)   ?' rows="'.$attr5_rows.'"':'' ?>
<?php echo !empty($attr5_columns)?' cols="'.$attr5_columns.'"':'' ?>
 border="0" frameborder="5" framespacing="0" bordercolor="#000000"><?php unset($attr5) ?><?php unset($attr5_rows) ?><?php $attr6_debug_info = 'a:2:{s:4:"file";s:24:"var:frame_src_tree_title";s:4:"name";s:12:"cms_treemenu";}' ?><?php $attr6 = array('file'=>$frame_src_tree_title,'name'=>'cms_treemenu') ?><?php $attr6_file=$frame_src_tree_title ?><?php $attr6_name='cms_treemenu' ?><frame src="<?php echo $attr6_file ?>" name="<?php echo empty($attr6_name)?'':$attr6_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($attr6_scrolling)?'no':$attr6_scrolling ?>">
<?php unset($attr6) ?><?php unset($attr6_file) ?><?php unset($attr6_name) ?><?php $attr6_debug_info = 'a:3:{s:4:"file";s:18:"var:frame_src_tree";s:4:"name";s:8:"cms_tree";s:9:"scrolling";s:4:"auto";}' ?><?php $attr6 = array('file'=>$frame_src_tree,'name'=>'cms_tree','scrolling'=>'auto') ?><?php $attr6_file=$frame_src_tree ?><?php $attr6_name='cms_tree' ?><?php $attr6_scrolling='auto' ?><frame src="<?php echo $attr6_file ?>" name="<?php echo empty($attr6_name)?'':$attr6_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($attr6_scrolling)?'no':$attr6_scrolling ?>">
<?php unset($attr6) ?><?php unset($attr6_file) ?><?php unset($attr6_name) ?><?php unset($attr6_scrolling) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></frameset>
<?php unset($attr4) ?><?php $attr5_debug_info = 'a:2:{s:4:"file";s:18:"var:frame_src_main";s:4:"name";s:8:"cms_main";}' ?><?php $attr5 = array('file'=>$frame_src_main,'name'=>'cms_main') ?><?php $attr5_file=$frame_src_main ?><?php $attr5_name='cms_main' ?><frame src="<?php echo $attr5_file ?>" name="<?php echo empty($attr5_name)?'':$attr5_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($attr5_scrolling)?'no':$attr5_scrolling ?>">
<?php unset($attr5) ?><?php unset($attr5_file) ?><?php unset($attr5_name) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?></frameset>
<?php unset($attr3) ?><?php $attr4_debug_info = 'a:1:{s:4:"file";s:20:"var:frame_src_border";}' ?><?php $attr4 = array('file'=>$frame_src_border) ?><?php $attr4_file=$frame_src_border ?><frame src="<?php echo $attr4_file ?>" name="<?php echo empty($attr4_name)?'':$attr4_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($attr4_scrolling)?'no':$attr4_scrolling ?>">
<?php unset($attr4) ?><?php unset($attr4_file) ?><?php $attr4_debug_info = 'a:1:{s:4:"file";s:24:"var:frame_src_background";}' ?><?php $attr4 = array('file'=>$frame_src_background) ?><?php $attr4_file=$frame_src_background ?><frame src="<?php echo $attr4_file ?>" name="<?php echo empty($attr4_name)?'':$attr4_name ?>" marginheight="0" marginwidth="0" scrolling="<?php echo empty($attr4_scrolling)?'no':$attr4_scrolling ?>">
<?php unset($attr4) ?><?php unset($attr4_file) ?><?php $attr2_debug_info = 'a:0:{}' ?><?php $attr2 = array() ?></frameset>
<?php unset($attr2) ?><?php $attr1_debug_info = 'a:0:{}' ?><?php $attr1 = array() ?><?php } ?><?php unset($attr1) ?><?php $attr0_debug_info = 'a:0:{}' ?><?php $attr0 = array() ?></html><?php unset($attr0) ?>