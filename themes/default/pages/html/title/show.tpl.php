<?php $attr1_debug_info = 'a:1:{s:5:"class";s:5:"title";}' ?><?php $attr1 = array('class'=>'title') ?><?php $attr1_class='title' ?><?php
 if (!headers_sent()) header('Content-Type: text/html; charset='.$charset)
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
  <title><?php echo isset($attr1_title)?$attr1_title.' - ':(isset($windowTitle)?lang($windowTitle).' - ':'') ?><?php echo $cms_title ?></title>
  <meta http-equiv="content-type" content="text/html; charset=<?php echo $charset ?>" />
  <meta name="MSSmartTagsPreventParsing" content="true" />
  <meta name="robots" content="noindex,nofollow" />
<?php if (isset($windowMenu) && is_array($windowMenu)) foreach( $windowMenu as $menu )
      {
       	?>
  <link rel="section" href="<?php echo Html::url($actionName,@$menu['subaction'],$this->getRequestId() ) ?>" title="<?php echo lang($menu['text']) ?>" />
<?php
      }
?><?php if (isset($metaList) && is_array($metaList)) foreach( $metaList as $meta )
      {
       	?>
  <link rel="<?php echo $meta['name'] ?>" href="<?php echo $meta['url'] ?>" title="<?php echo lang($meta['title']) ?>" /><?php
      }
?><script type="text/javascript" src="themes/default/js/jquery.js"></script>
    <script type="text/javascript" src="themes/default/js/jquery-lightbox.js"></script>
    <link rel="stylesheet" type="text/css" href="themes/default/js/lightbox/css/jquery-lightbox.css" media="screen" />
    <script type="text/javascript">
    $(function() {
        $('a.image').lightBox();
    });
    </script>
<?php if(!empty($root_stylesheet)) { ?>
  <link rel="stylesheet" type="text/css" href="<?php echo $root_stylesheet ?>" />
<?php } ?>
<?php if($root_stylesheet!=$user_stylesheet) { ?>
  <link rel="stylesheet" type="text/css" href="<?php echo $user_stylesheet ?>" />
<?php } ?>
</head>
<body class="<?php echo $attr1_class ?>" <?php if (@$conf['interface']['application_mode']) { ?> style="padding:0px;margin:0px;"<?php } ?> >
<?php unset($attr1) ?><?php unset($attr1_class) ?><?php $attr2_debug_info = 'a:4:{s:5:"width";s:4:"100%";s:5:"space";s:1:"0";s:7:"padding";s:1:"5";s:10:"rowclasses";s:8:"odd,even";}' ?><?php $attr2 = array('width'=>'100%','space'=>'0','padding'=>'5','rowclasses'=>'odd,even') ?><?php $attr2_width='100%' ?><?php $attr2_space='0' ?><?php $attr2_padding='5' ?><?php $attr2_rowclasses='odd,even' ?><?php
	$coloumn_widths=array();
	$row_classes   = array('');
	$column_classes= array('');
	if(empty($attr2_class))
		$attr2_class='';
	if	(!empty($attr2_widths))
	{
		$column_widths = explode(',',$attr2_widths);
		unset($attr2['widths']);
	}
	if	(!empty($attr2_classes))
	{
		$row_classes   = explode(',',$attr2_rowclasses);
		$row_class_idx = 999;
		unset($attr2['rowclasses']);
	}
	if	(!empty($attr2_rowclasses))
	{
		$row_classes   = explode(',',$attr2_rowclasses);
		$row_class_idx = 999;
		unset($attr2['rowclasses']);
	}
	if	(!empty($attr2_columnclasses))
	{
		$column_classes   = explode(',',$attr2_columnclasses);
		unset($attr2['columnclasses']);
	}
?><table class="<?php echo $attr2_class ?>" cellspacing="<?php echo $attr2_space ?>" width="<?php echo $attr2_width ?>" cellpadding="<?php echo $attr2_padding ?>"><?php unset($attr2) ?><?php unset($attr2_width) ?><?php unset($attr2_space) ?><?php unset($attr2_padding) ?><?php unset($attr2_rowclasses) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];
	if (empty($attr3_class))
		$attr3_class=$row_class;
	global $cell_column_nr;
	$cell_column_nr=0;
	$column_class_idx = 999;
?><tr class="<?php echo $attr3_class ?>"><?php unset($attr3) ?><?php $attr4_debug_info = 'a:2:{s:5:"width";s:3:"30%";s:5:"class";s:5:"title";}' ?><?php $attr4 = array('width'=>'30%','class'=>'title') ?><?php $attr4_width='30%' ?><?php $attr4_class='title' ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr4_class))
		$attr4['class']=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr4_rowspan) )
		$attr4['width']=$column_widths[$cell_column_nr-1];
?><td <?php foreach( $attr4 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr4) ?><?php unset($attr4_width) ?><?php unset($attr4_class) ?><?php $attr5_debug_info = 'a:2:{s:4:"icon";s:8:"database";s:5:"align";s:4:"left";}' ?><?php $attr5 = array('icon'=>'database','align'=>'left') ?><?php $attr5_icon='database' ?><?php $attr5_align='left' ?><?php
if (isset($attr5_elementtype)) {
?><img src="<?php echo $image_dir.'icon_el_'.$attr5_elementtype.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr5_align ?>"><?php
} elseif (isset($attr5_type)) {
?><img src="<?php echo $image_dir.'icon_'.$attr5_type.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr5_align ?>"><?php
} elseif (isset($attr5_icon)) {
?><img src="<?php echo $image_dir.'icon_'.$attr5_icon.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr5_align ?>"><?php
} elseif (isset($attr5_url)) {
?><img src="<?php echo $attr5_url ?>" border="0" align="<?php echo $attr5_align ?>"><?php
} elseif (isset($attr5_fileext)) {
?><img src="<?php echo $image_dir.$attr5_fileext ?>" border="0" align="<?php echo $attr5_align ?>"><?php
} elseif (isset($attr5_file)) {
?><img src="<?php echo $image_dir.$attr5_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr5_align ?>"><?php } ?><?php unset($attr5) ?><?php unset($attr5_icon) ?><?php unset($attr5_align) ?><?php $attr5_debug_info = 'a:4:{s:5:"title";s:16:"message:database";s:5:"class";s:4:"text";s:3:"var";s:6:"dbname";s:6:"escape";s:4:"true";}' ?><?php $attr5 = array('title'=>lang('database'),'class'=>'text','var'=>'dbname','escape'=>true) ?><?php $attr5_title=lang('database') ?><?php $attr5_class='text' ?><?php $attr5_var='dbname' ?><?php $attr5_escape=true ?><?php
	if	( isset($attr5_prefix)&& isset($attr5_key))
		$attr5_key = $attr5_prefix.$attr5_key;
	if	( isset($attr5_suffix)&& isset($attr5_key))
		$attr5_key = $attr5_key.$attr5_suffix;
	if(empty($attr5_title))
			$attr5_title = '';
	if	(empty($attr5_type))
		$tmp_tag = 'span';
	else
		switch( $attr5_type )
		{
			case 'emphatic':
			case 'italic':
				$tmp_tag = 'em';
				break;
			case 'strong':
			case 'bold':
				$tmp_tag = 'strong';
				break;
			case 'tt':
			case 'teletype':
				$tmp_tag = 'tt';
				break;
			default:
				$tmp_tag = 'span';
		}
?><<?php echo $tmp_tag ?> class="<?php echo $attr5_class ?>" title="<?php echo $attr5_title ?>"><?php
	$attr5_title = '';
	if	( $attr5_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr5_array))
	{
		$tmpArray = $$attr5_array;
		if (!empty($attr5_var))
			$tmp_text = $tmpArray[$attr5_var];
		else
			$tmp_text = $langF($tmpArray[$attr5_text]);
	}
	elseif (!empty($attr5_text))
		$tmp_text = $langF($attr5_text);
	elseif (!empty($attr5_textvar))
		$tmp_text = $langF($$attr5_textvar);
	elseif (!empty($attr5_key))
		$tmp_text = $langF($attr5_key);
	elseif (!empty($attr5_var))
		$tmp_text = isset($$attr5_var)?$$attr5_var:'?unset:'.$attr5_var.'?';	
	elseif (!empty($attr5_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr5_raw);
	elseif (!empty($attr5_value))
		$tmp_text = $attr5_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr5_maxlength) && intval($attr5_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr5_maxlength) );
	if	(isset($attr5_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr5_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr5) ?><?php unset($attr5_title) ?><?php unset($attr5_class) ?><?php unset($attr5_var) ?><?php unset($attr5_escape) ?><?php $attr5_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"raw";s:3:"_-_";s:6:"escape";s:4:"true";}' ?><?php $attr5 = array('class'=>'text','raw'=>'_-_','escape'=>true) ?><?php $attr5_class='text' ?><?php $attr5_raw='_-_' ?><?php $attr5_escape=true ?><?php
	if	( isset($attr5_prefix)&& isset($attr5_key))
		$attr5_key = $attr5_prefix.$attr5_key;
	if	( isset($attr5_suffix)&& isset($attr5_key))
		$attr5_key = $attr5_key.$attr5_suffix;
	if(empty($attr5_title))
			$attr5_title = '';
	if	(empty($attr5_type))
		$tmp_tag = 'span';
	else
		switch( $attr5_type )
		{
			case 'emphatic':
			case 'italic':
				$tmp_tag = 'em';
				break;
			case 'strong':
			case 'bold':
				$tmp_tag = 'strong';
				break;
			case 'tt':
			case 'teletype':
				$tmp_tag = 'tt';
				break;
			default:
				$tmp_tag = 'span';
		}
?><<?php echo $tmp_tag ?> class="<?php echo $attr5_class ?>" title="<?php echo $attr5_title ?>"><?php
	$attr5_title = '';
	if	( $attr5_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr5_array))
	{
		$tmpArray = $$attr5_array;
		if (!empty($attr5_var))
			$tmp_text = $tmpArray[$attr5_var];
		else
			$tmp_text = $langF($tmpArray[$attr5_text]);
	}
	elseif (!empty($attr5_text))
		$tmp_text = $langF($attr5_text);
	elseif (!empty($attr5_textvar))
		$tmp_text = $langF($$attr5_textvar);
	elseif (!empty($attr5_key))
		$tmp_text = $langF($attr5_key);
	elseif (!empty($attr5_var))
		$tmp_text = isset($$attr5_var)?$$attr5_var:'?unset:'.$attr5_var.'?';	
	elseif (!empty($attr5_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr5_raw);
	elseif (!empty($attr5_value))
		$tmp_text = $attr5_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr5_maxlength) && intval($attr5_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr5_maxlength) );
	if	(isset($attr5_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr5_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr5) ?><?php unset($attr5_class) ?><?php unset($attr5_raw) ?><?php unset($attr5_escape) ?><?php $attr5_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"var";s:9:"cms_title";s:6:"escape";s:4:"true";}' ?><?php $attr5 = array('class'=>'text','var'=>'cms_title','escape'=>true) ?><?php $attr5_class='text' ?><?php $attr5_var='cms_title' ?><?php $attr5_escape=true ?><?php
	if	( isset($attr5_prefix)&& isset($attr5_key))
		$attr5_key = $attr5_prefix.$attr5_key;
	if	( isset($attr5_suffix)&& isset($attr5_key))
		$attr5_key = $attr5_key.$attr5_suffix;
	if(empty($attr5_title))
			$attr5_title = '';
	if	(empty($attr5_type))
		$tmp_tag = 'span';
	else
		switch( $attr5_type )
		{
			case 'emphatic':
			case 'italic':
				$tmp_tag = 'em';
				break;
			case 'strong':
			case 'bold':
				$tmp_tag = 'strong';
				break;
			case 'tt':
			case 'teletype':
				$tmp_tag = 'tt';
				break;
			default:
				$tmp_tag = 'span';
		}
?><<?php echo $tmp_tag ?> class="<?php echo $attr5_class ?>" title="<?php echo $attr5_title ?>"><?php
	$attr5_title = '';
	if	( $attr5_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr5_array))
	{
		$tmpArray = $$attr5_array;
		if (!empty($attr5_var))
			$tmp_text = $tmpArray[$attr5_var];
		else
			$tmp_text = $langF($tmpArray[$attr5_text]);
	}
	elseif (!empty($attr5_text))
		$tmp_text = $langF($attr5_text);
	elseif (!empty($attr5_textvar))
		$tmp_text = $langF($$attr5_textvar);
	elseif (!empty($attr5_key))
		$tmp_text = $langF($attr5_key);
	elseif (!empty($attr5_var))
		$tmp_text = isset($$attr5_var)?$$attr5_var:'?unset:'.$attr5_var.'?';	
	elseif (!empty($attr5_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr5_raw);
	elseif (!empty($attr5_value))
		$tmp_text = $attr5_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr5_maxlength) && intval($attr5_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr5_maxlength) );
	if	(isset($attr5_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr5_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr5) ?><?php unset($attr5_class) ?><?php unset($attr5_var) ?><?php unset($attr5_escape) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?></td><?php unset($attr3) ?><?php $attr4_debug_info = 'a:3:{s:5:"width";s:3:"40%";s:5:"style";s:19:":text-align:center;";s:5:"class";s:5:"title";}' ?><?php $attr4 = array('width'=>'40%','style'=>'text-align:center;','class'=>'title') ?><?php $attr4_width='40%' ?><?php $attr4_style='text-align:center;' ?><?php $attr4_class='title' ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr4_class))
		$attr4['class']=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr4_rowspan) )
		$attr4['width']=$column_widths[$cell_column_nr-1];
?><td <?php foreach( $attr4 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr4) ?><?php unset($attr4_width) ?><?php unset($attr4_style) ?><?php unset($attr4_class) ?><?php $attr5_debug_info = 'a:1:{s:7:"present";s:11:"projectname";}' ?><?php $attr5 = array('present'=>'projectname') ?><?php $attr5_present='projectname' ?><?php 
	if	( isset($attr5_true) )
	{
		if	(gettype($attr5_true) === '' && gettype($attr5_true) === '1')
			$exec = $$attr5_true == true;
		else
			$exec = $attr5_true == true;
	}
	elseif	( isset($attr5_false) )
	{
		if	(gettype($attr5_false) === '' && gettype($attr5_false) === '1')
			$exec = $$attr5_false == false;
		else
			$exec = $attr5_false == false;
	}
	elseif( isset($attr5_contains) )
		$exec = in_array($attr5_value,explode(',',$attr5_contains));
	elseif( isset($attr5_equals)&& isset($attr5_value) )
		$exec = $attr5_equals == $attr5_value;
	elseif( isset($attr5_lessthan)&& isset($attr5_value) )
		$exec = intval($attr5_lessthan) > intval($attr5_value);
	elseif( isset($attr5_greaterthan)&& isset($attr5_value) )
		$exec = intval($attr5_greaterthan) < intval($attr5_value);
	elseif	( isset($attr5_empty) )
	{
		if	( !isset($$attr5_empty) )
			$exec = empty($attr5_empty);
		elseif	( is_array($$attr5_empty) )
			$exec = (count($$attr5_empty)==0);
		elseif	( is_bool($$attr5_empty) )
			$exec = true;
		else
			$exec = empty( $$attr5_empty );
	}
	elseif	( isset($attr5_present) )
	{
		$exec = isset($$attr5_present);
	}
	else
	{
		trigger_error("error in IF, assume: FALSE");
		$exec = false;
	}
	if  ( !empty($attr5_invert) )
		$exec = !$exec;
	if  ( !empty($attr5_not) )
		$exec = !$exec;
	unset($attr5_true);
	unset($attr5_false);
	unset($attr5_notempty);
	unset($attr5_empty);
	unset($attr5_contains);
	unset($attr5_present);
	unset($attr5_invert);
	unset($attr5_not);
	unset($attr5_value);
	unset($attr5_equals);
	$last_exec = $exec;
	if	( $exec )
	{
?>
<?php unset($attr5) ?><?php unset($attr5_present) ?><?php $attr6_debug_info = 'a:4:{s:5:"title";s:15:"message:project";s:5:"class";s:4:"text";s:3:"var";s:11:"projectname";s:6:"escape";s:4:"true";}' ?><?php $attr6 = array('title'=>lang('project'),'class'=>'text','var'=>'projectname','escape'=>true) ?><?php $attr6_title=lang('project') ?><?php $attr6_class='text' ?><?php $attr6_var='projectname' ?><?php $attr6_escape=true ?><?php
	if	( isset($attr6_prefix)&& isset($attr6_key))
		$attr6_key = $attr6_prefix.$attr6_key;
	if	( isset($attr6_suffix)&& isset($attr6_key))
		$attr6_key = $attr6_key.$attr6_suffix;
	if(empty($attr6_title))
			$attr6_title = '';
	if	(empty($attr6_type))
		$tmp_tag = 'span';
	else
		switch( $attr6_type )
		{
			case 'emphatic':
			case 'italic':
				$tmp_tag = 'em';
				break;
			case 'strong':
			case 'bold':
				$tmp_tag = 'strong';
				break;
			case 'tt':
			case 'teletype':
				$tmp_tag = 'tt';
				break;
			default:
				$tmp_tag = 'span';
		}
?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
	$attr6_title = '';
	if	( $attr6_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr6_array))
	{
		$tmpArray = $$attr6_array;
		if (!empty($attr6_var))
			$tmp_text = $tmpArray[$attr6_var];
		else
			$tmp_text = $langF($tmpArray[$attr6_text]);
	}
	elseif (!empty($attr6_text))
		$tmp_text = $langF($attr6_text);
	elseif (!empty($attr6_textvar))
		$tmp_text = $langF($$attr6_textvar);
	elseif (!empty($attr6_key))
		$tmp_text = $langF($attr6_key);
	elseif (!empty($attr6_var))
		$tmp_text = isset($$attr6_var)?$$attr6_var:'?unset:'.$attr6_var.'?';	
	elseif (!empty($attr6_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr6_raw);
	elseif (!empty($attr6_value))
		$tmp_text = $attr6_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr6_maxlength) && intval($attr6_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr6_maxlength) );
	if	(isset($attr6_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr6_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr6) ?><?php unset($attr6_title) ?><?php unset($attr6_class) ?><?php unset($attr6_var) ?><?php unset($attr6_escape) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?><?php } ?><?php unset($attr4) ?><?php $attr5_debug_info = 'a:1:{s:7:"present";s:9:"modelname";}' ?><?php $attr5 = array('present'=>'modelname') ?><?php $attr5_present='modelname' ?><?php 
	if	( isset($attr5_true) )
	{
		if	(gettype($attr5_true) === '' && gettype($attr5_true) === '1')
			$exec = $$attr5_true == true;
		else
			$exec = $attr5_true == true;
	}
	elseif	( isset($attr5_false) )
	{
		if	(gettype($attr5_false) === '' && gettype($attr5_false) === '1')
			$exec = $$attr5_false == false;
		else
			$exec = $attr5_false == false;
	}
	elseif( isset($attr5_contains) )
		$exec = in_array($attr5_value,explode(',',$attr5_contains));
	elseif( isset($attr5_equals)&& isset($attr5_value) )
		$exec = $attr5_equals == $attr5_value;
	elseif( isset($attr5_lessthan)&& isset($attr5_value) )
		$exec = intval($attr5_lessthan) > intval($attr5_value);
	elseif( isset($attr5_greaterthan)&& isset($attr5_value) )
		$exec = intval($attr5_greaterthan) < intval($attr5_value);
	elseif	( isset($attr5_empty) )
	{
		if	( !isset($$attr5_empty) )
			$exec = empty($attr5_empty);
		elseif	( is_array($$attr5_empty) )
			$exec = (count($$attr5_empty)==0);
		elseif	( is_bool($$attr5_empty) )
			$exec = true;
		else
			$exec = empty( $$attr5_empty );
	}
	elseif	( isset($attr5_present) )
	{
		$exec = isset($$attr5_present);
	}
	else
	{
		trigger_error("error in IF, assume: FALSE");
		$exec = false;
	}
	if  ( !empty($attr5_invert) )
		$exec = !$exec;
	if  ( !empty($attr5_not) )
		$exec = !$exec;
	unset($attr5_true);
	unset($attr5_false);
	unset($attr5_notempty);
	unset($attr5_empty);
	unset($attr5_contains);
	unset($attr5_present);
	unset($attr5_invert);
	unset($attr5_not);
	unset($attr5_value);
	unset($attr5_equals);
	$last_exec = $exec;
	if	( $exec )
	{
?>
<?php unset($attr5) ?><?php unset($attr5_present) ?><?php $attr6_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"raw";s:2:"_(";s:6:"escape";s:4:"true";}' ?><?php $attr6 = array('class'=>'text','raw'=>'_(','escape'=>true) ?><?php $attr6_class='text' ?><?php $attr6_raw='_(' ?><?php $attr6_escape=true ?><?php
	if	( isset($attr6_prefix)&& isset($attr6_key))
		$attr6_key = $attr6_prefix.$attr6_key;
	if	( isset($attr6_suffix)&& isset($attr6_key))
		$attr6_key = $attr6_key.$attr6_suffix;
	if(empty($attr6_title))
			$attr6_title = '';
	if	(empty($attr6_type))
		$tmp_tag = 'span';
	else
		switch( $attr6_type )
		{
			case 'emphatic':
			case 'italic':
				$tmp_tag = 'em';
				break;
			case 'strong':
			case 'bold':
				$tmp_tag = 'strong';
				break;
			case 'tt':
			case 'teletype':
				$tmp_tag = 'tt';
				break;
			default:
				$tmp_tag = 'span';
		}
?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
	$attr6_title = '';
	if	( $attr6_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr6_array))
	{
		$tmpArray = $$attr6_array;
		if (!empty($attr6_var))
			$tmp_text = $tmpArray[$attr6_var];
		else
			$tmp_text = $langF($tmpArray[$attr6_text]);
	}
	elseif (!empty($attr6_text))
		$tmp_text = $langF($attr6_text);
	elseif (!empty($attr6_textvar))
		$tmp_text = $langF($$attr6_textvar);
	elseif (!empty($attr6_key))
		$tmp_text = $langF($attr6_key);
	elseif (!empty($attr6_var))
		$tmp_text = isset($$attr6_var)?$$attr6_var:'?unset:'.$attr6_var.'?';	
	elseif (!empty($attr6_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr6_raw);
	elseif (!empty($attr6_value))
		$tmp_text = $attr6_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr6_maxlength) && intval($attr6_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr6_maxlength) );
	if	(isset($attr6_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr6_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_raw) ?><?php unset($attr6_escape) ?><?php $attr6_debug_info = 'a:4:{s:5:"title";s:13:"message:model";s:5:"class";s:4:"text";s:3:"var";s:9:"modelname";s:6:"escape";s:4:"true";}' ?><?php $attr6 = array('title'=>lang('model'),'class'=>'text','var'=>'modelname','escape'=>true) ?><?php $attr6_title=lang('model') ?><?php $attr6_class='text' ?><?php $attr6_var='modelname' ?><?php $attr6_escape=true ?><?php
	if	( isset($attr6_prefix)&& isset($attr6_key))
		$attr6_key = $attr6_prefix.$attr6_key;
	if	( isset($attr6_suffix)&& isset($attr6_key))
		$attr6_key = $attr6_key.$attr6_suffix;
	if(empty($attr6_title))
			$attr6_title = '';
	if	(empty($attr6_type))
		$tmp_tag = 'span';
	else
		switch( $attr6_type )
		{
			case 'emphatic':
			case 'italic':
				$tmp_tag = 'em';
				break;
			case 'strong':
			case 'bold':
				$tmp_tag = 'strong';
				break;
			case 'tt':
			case 'teletype':
				$tmp_tag = 'tt';
				break;
			default:
				$tmp_tag = 'span';
		}
?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
	$attr6_title = '';
	if	( $attr6_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr6_array))
	{
		$tmpArray = $$attr6_array;
		if (!empty($attr6_var))
			$tmp_text = $tmpArray[$attr6_var];
		else
			$tmp_text = $langF($tmpArray[$attr6_text]);
	}
	elseif (!empty($attr6_text))
		$tmp_text = $langF($attr6_text);
	elseif (!empty($attr6_textvar))
		$tmp_text = $langF($$attr6_textvar);
	elseif (!empty($attr6_key))
		$tmp_text = $langF($attr6_key);
	elseif (!empty($attr6_var))
		$tmp_text = isset($$attr6_var)?$$attr6_var:'?unset:'.$attr6_var.'?';	
	elseif (!empty($attr6_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr6_raw);
	elseif (!empty($attr6_value))
		$tmp_text = $attr6_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr6_maxlength) && intval($attr6_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr6_maxlength) );
	if	(isset($attr6_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr6_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr6) ?><?php unset($attr6_title) ?><?php unset($attr6_class) ?><?php unset($attr6_var) ?><?php unset($attr6_escape) ?><?php $attr6_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"raw";s:1:",";s:6:"escape";s:4:"true";}' ?><?php $attr6 = array('class'=>'text','raw'=>',','escape'=>true) ?><?php $attr6_class='text' ?><?php $attr6_raw=',' ?><?php $attr6_escape=true ?><?php
	if	( isset($attr6_prefix)&& isset($attr6_key))
		$attr6_key = $attr6_prefix.$attr6_key;
	if	( isset($attr6_suffix)&& isset($attr6_key))
		$attr6_key = $attr6_key.$attr6_suffix;
	if(empty($attr6_title))
			$attr6_title = '';
	if	(empty($attr6_type))
		$tmp_tag = 'span';
	else
		switch( $attr6_type )
		{
			case 'emphatic':
			case 'italic':
				$tmp_tag = 'em';
				break;
			case 'strong':
			case 'bold':
				$tmp_tag = 'strong';
				break;
			case 'tt':
			case 'teletype':
				$tmp_tag = 'tt';
				break;
			default:
				$tmp_tag = 'span';
		}
?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
	$attr6_title = '';
	if	( $attr6_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr6_array))
	{
		$tmpArray = $$attr6_array;
		if (!empty($attr6_var))
			$tmp_text = $tmpArray[$attr6_var];
		else
			$tmp_text = $langF($tmpArray[$attr6_text]);
	}
	elseif (!empty($attr6_text))
		$tmp_text = $langF($attr6_text);
	elseif (!empty($attr6_textvar))
		$tmp_text = $langF($$attr6_textvar);
	elseif (!empty($attr6_key))
		$tmp_text = $langF($attr6_key);
	elseif (!empty($attr6_var))
		$tmp_text = isset($$attr6_var)?$$attr6_var:'?unset:'.$attr6_var.'?';	
	elseif (!empty($attr6_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr6_raw);
	elseif (!empty($attr6_value))
		$tmp_text = $attr6_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr6_maxlength) && intval($attr6_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr6_maxlength) );
	if	(isset($attr6_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr6_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_raw) ?><?php unset($attr6_escape) ?><?php $attr6_debug_info = 'a:4:{s:5:"title";s:16:"message:language";s:5:"class";s:4:"text";s:3:"var";s:12:"languagename";s:6:"escape";s:4:"true";}' ?><?php $attr6 = array('title'=>lang('language'),'class'=>'text','var'=>'languagename','escape'=>true) ?><?php $attr6_title=lang('language') ?><?php $attr6_class='text' ?><?php $attr6_var='languagename' ?><?php $attr6_escape=true ?><?php
	if	( isset($attr6_prefix)&& isset($attr6_key))
		$attr6_key = $attr6_prefix.$attr6_key;
	if	( isset($attr6_suffix)&& isset($attr6_key))
		$attr6_key = $attr6_key.$attr6_suffix;
	if(empty($attr6_title))
			$attr6_title = '';
	if	(empty($attr6_type))
		$tmp_tag = 'span';
	else
		switch( $attr6_type )
		{
			case 'emphatic':
			case 'italic':
				$tmp_tag = 'em';
				break;
			case 'strong':
			case 'bold':
				$tmp_tag = 'strong';
				break;
			case 'tt':
			case 'teletype':
				$tmp_tag = 'tt';
				break;
			default:
				$tmp_tag = 'span';
		}
?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
	$attr6_title = '';
	if	( $attr6_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr6_array))
	{
		$tmpArray = $$attr6_array;
		if (!empty($attr6_var))
			$tmp_text = $tmpArray[$attr6_var];
		else
			$tmp_text = $langF($tmpArray[$attr6_text]);
	}
	elseif (!empty($attr6_text))
		$tmp_text = $langF($attr6_text);
	elseif (!empty($attr6_textvar))
		$tmp_text = $langF($$attr6_textvar);
	elseif (!empty($attr6_key))
		$tmp_text = $langF($attr6_key);
	elseif (!empty($attr6_var))
		$tmp_text = isset($$attr6_var)?$$attr6_var:'?unset:'.$attr6_var.'?';	
	elseif (!empty($attr6_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr6_raw);
	elseif (!empty($attr6_value))
		$tmp_text = $attr6_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr6_maxlength) && intval($attr6_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr6_maxlength) );
	if	(isset($attr6_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr6_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr6) ?><?php unset($attr6_title) ?><?php unset($attr6_class) ?><?php unset($attr6_var) ?><?php unset($attr6_escape) ?><?php $attr6_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"raw";s:1:")";s:6:"escape";s:4:"true";}' ?><?php $attr6 = array('class'=>'text','raw'=>')','escape'=>true) ?><?php $attr6_class='text' ?><?php $attr6_raw=')' ?><?php $attr6_escape=true ?><?php
	if	( isset($attr6_prefix)&& isset($attr6_key))
		$attr6_key = $attr6_prefix.$attr6_key;
	if	( isset($attr6_suffix)&& isset($attr6_key))
		$attr6_key = $attr6_key.$attr6_suffix;
	if(empty($attr6_title))
			$attr6_title = '';
	if	(empty($attr6_type))
		$tmp_tag = 'span';
	else
		switch( $attr6_type )
		{
			case 'emphatic':
			case 'italic':
				$tmp_tag = 'em';
				break;
			case 'strong':
			case 'bold':
				$tmp_tag = 'strong';
				break;
			case 'tt':
			case 'teletype':
				$tmp_tag = 'tt';
				break;
			default:
				$tmp_tag = 'span';
		}
?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
	$attr6_title = '';
	if	( $attr6_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr6_array))
	{
		$tmpArray = $$attr6_array;
		if (!empty($attr6_var))
			$tmp_text = $tmpArray[$attr6_var];
		else
			$tmp_text = $langF($tmpArray[$attr6_text]);
	}
	elseif (!empty($attr6_text))
		$tmp_text = $langF($attr6_text);
	elseif (!empty($attr6_textvar))
		$tmp_text = $langF($$attr6_textvar);
	elseif (!empty($attr6_key))
		$tmp_text = $langF($attr6_key);
	elseif (!empty($attr6_var))
		$tmp_text = isset($$attr6_var)?$$attr6_var:'?unset:'.$attr6_var.'?';	
	elseif (!empty($attr6_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr6_raw);
	elseif (!empty($attr6_value))
		$tmp_text = $attr6_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr6_maxlength) && intval($attr6_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr6_maxlength) );
	if	(isset($attr6_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr6_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_raw) ?><?php unset($attr6_escape) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?><?php } ?><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?></td><?php unset($attr3) ?><?php $attr4_debug_info = 'a:3:{s:5:"width";s:3:"30%";s:5:"style";s:18:":text-align:right;";s:5:"class";s:5:"title";}' ?><?php $attr4 = array('width'=>'30%','style'=>'text-align:right;','class'=>'title') ?><?php $attr4_width='30%' ?><?php $attr4_style='text-align:right;' ?><?php $attr4_class='title' ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr4_class))
		$attr4['class']=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr4_rowspan) )
		$attr4['width']=$column_widths[$cell_column_nr-1];
?><td <?php foreach( $attr4 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr4) ?><?php unset($attr4_width) ?><?php unset($attr4_style) ?><?php unset($attr4_class) ?><?php $attr5_debug_info = 'a:2:{s:4:"icon";s:4:"user";s:5:"align";s:5:"right";}' ?><?php $attr5 = array('icon'=>'user','align'=>'right') ?><?php $attr5_icon='user' ?><?php $attr5_align='right' ?><?php
if (isset($attr5_elementtype)) {
?><img src="<?php echo $image_dir.'icon_el_'.$attr5_elementtype.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr5_align ?>"><?php
} elseif (isset($attr5_type)) {
?><img src="<?php echo $image_dir.'icon_'.$attr5_type.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr5_align ?>"><?php
} elseif (isset($attr5_icon)) {
?><img src="<?php echo $image_dir.'icon_'.$attr5_icon.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr5_align ?>"><?php
} elseif (isset($attr5_url)) {
?><img src="<?php echo $attr5_url ?>" border="0" align="<?php echo $attr5_align ?>"><?php
} elseif (isset($attr5_fileext)) {
?><img src="<?php echo $image_dir.$attr5_fileext ?>" border="0" align="<?php echo $attr5_align ?>"><?php
} elseif (isset($attr5_file)) {
?><img src="<?php echo $image_dir.$attr5_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr5_align ?>"><?php } ?><?php unset($attr5) ?><?php unset($attr5_icon) ?><?php unset($attr5_align) ?><?php $attr5_debug_info = 'a:4:{s:5:"title";s:24:"message:USER_LOGOUT_DESC";s:6:"target";s:4:"_top";s:3:"url";s:14:"var:logout_url";s:5:"class";s:0:"";}' ?><?php $attr5 = array('title'=>lang('USER_LOGOUT_DESC'),'target'=>'_top','url'=>$logout_url,'class'=>'') ?><?php $attr5_title=lang('USER_LOGOUT_DESC') ?><?php $attr5_target='_top' ?><?php $attr5_url=$logout_url ?><?php $attr5_class='' ?><?php
	$params = array();
	if (!empty($attr5_var1) && isset($attr5_value1))
		$params[$attr5_var1]=$attr5_value1;
	if (!empty($attr5_var2) && isset($attr5_value2))
		$params[$attr5_var2]=$attr5_value2;
	if (!empty($attr5_var3) && isset($attr5_value3))
		$params[$attr5_var3]=$attr5_value3;
	if (!empty($attr5_var4) && isset($attr5_value4))
		$params[$attr5_var4]=$attr5_value4;
	if (!empty($attr5_var5) && isset($attr5_value5))
		$params[$attr5_var5]=$attr5_value5;
	if(empty($attr5_class))
		$attr5_class='';
	if(empty($attr5_title))
		$attr5_title = '';
	if(!empty($attr5_url))
		$tmp_url = $attr5_url;
	else
		$tmp_url = Html::url($attr5_action,$attr5_subaction,!empty($attr5_id)?$attr5_id:$this->getRequestId(),$params);
?><a href="<?php echo $tmp_url ?>" class="<?php echo $attr5_class ?>" target="<?php echo $attr5_target ?>"<?php if (isset($attr5_accesskey)) echo ' accesskey="'.$attr5_accesskey.'"' ?>  title="<?php echo encodeHtml($attr5_title) ?>"><?php unset($attr5) ?><?php unset($attr5_title) ?><?php unset($attr5_target) ?><?php unset($attr5_url) ?><?php unset($attr5_class) ?><?php $attr6_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"key";s:11:"USER_LOGOUT";s:6:"escape";s:4:"true";}' ?><?php $attr6 = array('class'=>'text','key'=>'USER_LOGOUT','escape'=>true) ?><?php $attr6_class='text' ?><?php $attr6_key='USER_LOGOUT' ?><?php $attr6_escape=true ?><?php
	if	( isset($attr6_prefix)&& isset($attr6_key))
		$attr6_key = $attr6_prefix.$attr6_key;
	if	( isset($attr6_suffix)&& isset($attr6_key))
		$attr6_key = $attr6_key.$attr6_suffix;
	if(empty($attr6_title))
			$attr6_title = '';
	if	(empty($attr6_type))
		$tmp_tag = 'span';
	else
		switch( $attr6_type )
		{
			case 'emphatic':
			case 'italic':
				$tmp_tag = 'em';
				break;
			case 'strong':
			case 'bold':
				$tmp_tag = 'strong';
				break;
			case 'tt':
			case 'teletype':
				$tmp_tag = 'tt';
				break;
			default:
				$tmp_tag = 'span';
		}
?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
	$attr6_title = '';
	if	( $attr6_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr6_array))
	{
		$tmpArray = $$attr6_array;
		if (!empty($attr6_var))
			$tmp_text = $tmpArray[$attr6_var];
		else
			$tmp_text = $langF($tmpArray[$attr6_text]);
	}
	elseif (!empty($attr6_text))
		$tmp_text = $langF($attr6_text);
	elseif (!empty($attr6_textvar))
		$tmp_text = $langF($$attr6_textvar);
	elseif (!empty($attr6_key))
		$tmp_text = $langF($attr6_key);
	elseif (!empty($attr6_var))
		$tmp_text = isset($$attr6_var)?$$attr6_var:'?unset:'.$attr6_var.'?';	
	elseif (!empty($attr6_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr6_raw);
	elseif (!empty($attr6_value))
		$tmp_text = $attr6_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr6_maxlength) && intval($attr6_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr6_maxlength) );
	if	(isset($attr6_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr6_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_key) ?><?php unset($attr6_escape) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></a><?php unset($attr4) ?><?php $attr5_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"raw";s:2:"_(";s:6:"escape";s:4:"true";}' ?><?php $attr5 = array('class'=>'text','raw'=>'_(','escape'=>true) ?><?php $attr5_class='text' ?><?php $attr5_raw='_(' ?><?php $attr5_escape=true ?><?php
	if	( isset($attr5_prefix)&& isset($attr5_key))
		$attr5_key = $attr5_prefix.$attr5_key;
	if	( isset($attr5_suffix)&& isset($attr5_key))
		$attr5_key = $attr5_key.$attr5_suffix;
	if(empty($attr5_title))
			$attr5_title = '';
	if	(empty($attr5_type))
		$tmp_tag = 'span';
	else
		switch( $attr5_type )
		{
			case 'emphatic':
			case 'italic':
				$tmp_tag = 'em';
				break;
			case 'strong':
			case 'bold':
				$tmp_tag = 'strong';
				break;
			case 'tt':
			case 'teletype':
				$tmp_tag = 'tt';
				break;
			default:
				$tmp_tag = 'span';
		}
?><<?php echo $tmp_tag ?> class="<?php echo $attr5_class ?>" title="<?php echo $attr5_title ?>"><?php
	$attr5_title = '';
	if	( $attr5_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr5_array))
	{
		$tmpArray = $$attr5_array;
		if (!empty($attr5_var))
			$tmp_text = $tmpArray[$attr5_var];
		else
			$tmp_text = $langF($tmpArray[$attr5_text]);
	}
	elseif (!empty($attr5_text))
		$tmp_text = $langF($attr5_text);
	elseif (!empty($attr5_textvar))
		$tmp_text = $langF($$attr5_textvar);
	elseif (!empty($attr5_key))
		$tmp_text = $langF($attr5_key);
	elseif (!empty($attr5_var))
		$tmp_text = isset($$attr5_var)?$$attr5_var:'?unset:'.$attr5_var.'?';	
	elseif (!empty($attr5_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr5_raw);
	elseif (!empty($attr5_value))
		$tmp_text = $attr5_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr5_maxlength) && intval($attr5_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr5_maxlength) );
	if	(isset($attr5_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr5_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr5) ?><?php unset($attr5_class) ?><?php unset($attr5_raw) ?><?php unset($attr5_escape) ?><?php $attr5_debug_info = 'a:4:{s:5:"title";s:25:"message:USER_PROFILE_DESC";s:6:"target";s:13:"cms_main_main";s:3:"url";s:15:"var:profile_url";s:5:"class";s:0:"";}' ?><?php $attr5 = array('title'=>lang('USER_PROFILE_DESC'),'target'=>'cms_main_main','url'=>$profile_url,'class'=>'') ?><?php $attr5_title=lang('USER_PROFILE_DESC') ?><?php $attr5_target='cms_main_main' ?><?php $attr5_url=$profile_url ?><?php $attr5_class='' ?><?php
	$params = array();
	if (!empty($attr5_var1) && isset($attr5_value1))
		$params[$attr5_var1]=$attr5_value1;
	if (!empty($attr5_var2) && isset($attr5_value2))
		$params[$attr5_var2]=$attr5_value2;
	if (!empty($attr5_var3) && isset($attr5_value3))
		$params[$attr5_var3]=$attr5_value3;
	if (!empty($attr5_var4) && isset($attr5_value4))
		$params[$attr5_var4]=$attr5_value4;
	if (!empty($attr5_var5) && isset($attr5_value5))
		$params[$attr5_var5]=$attr5_value5;
	if(empty($attr5_class))
		$attr5_class='';
	if(empty($attr5_title))
		$attr5_title = '';
	if(!empty($attr5_url))
		$tmp_url = $attr5_url;
	else
		$tmp_url = Html::url($attr5_action,$attr5_subaction,!empty($attr5_id)?$attr5_id:$this->getRequestId(),$params);
?><a href="<?php echo $tmp_url ?>" class="<?php echo $attr5_class ?>" target="<?php echo $attr5_target ?>"<?php if (isset($attr5_accesskey)) echo ' accesskey="'.$attr5_accesskey.'"' ?>  title="<?php echo encodeHtml($attr5_title) ?>"><?php unset($attr5) ?><?php unset($attr5_title) ?><?php unset($attr5_target) ?><?php unset($attr5_url) ?><?php unset($attr5_class) ?><?php $attr6_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"var";s:12:"userfullname";s:6:"escape";s:4:"true";}' ?><?php $attr6 = array('class'=>'text','var'=>'userfullname','escape'=>true) ?><?php $attr6_class='text' ?><?php $attr6_var='userfullname' ?><?php $attr6_escape=true ?><?php
	if	( isset($attr6_prefix)&& isset($attr6_key))
		$attr6_key = $attr6_prefix.$attr6_key;
	if	( isset($attr6_suffix)&& isset($attr6_key))
		$attr6_key = $attr6_key.$attr6_suffix;
	if(empty($attr6_title))
			$attr6_title = '';
	if	(empty($attr6_type))
		$tmp_tag = 'span';
	else
		switch( $attr6_type )
		{
			case 'emphatic':
			case 'italic':
				$tmp_tag = 'em';
				break;
			case 'strong':
			case 'bold':
				$tmp_tag = 'strong';
				break;
			case 'tt':
			case 'teletype':
				$tmp_tag = 'tt';
				break;
			default:
				$tmp_tag = 'span';
		}
?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
	$attr6_title = '';
	if	( $attr6_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr6_array))
	{
		$tmpArray = $$attr6_array;
		if (!empty($attr6_var))
			$tmp_text = $tmpArray[$attr6_var];
		else
			$tmp_text = $langF($tmpArray[$attr6_text]);
	}
	elseif (!empty($attr6_text))
		$tmp_text = $langF($attr6_text);
	elseif (!empty($attr6_textvar))
		$tmp_text = $langF($$attr6_textvar);
	elseif (!empty($attr6_key))
		$tmp_text = $langF($attr6_key);
	elseif (!empty($attr6_var))
		$tmp_text = isset($$attr6_var)?$$attr6_var:'?unset:'.$attr6_var.'?';	
	elseif (!empty($attr6_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr6_raw);
	elseif (!empty($attr6_value))
		$tmp_text = $attr6_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr6_maxlength) && intval($attr6_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr6_maxlength) );
	if	(isset($attr6_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr6_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_var) ?><?php unset($attr6_escape) ?><?php $attr6_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"raw";s:1:")";s:6:"escape";s:4:"true";}' ?><?php $attr6 = array('class'=>'text','raw'=>')','escape'=>true) ?><?php $attr6_class='text' ?><?php $attr6_raw=')' ?><?php $attr6_escape=true ?><?php
	if	( isset($attr6_prefix)&& isset($attr6_key))
		$attr6_key = $attr6_prefix.$attr6_key;
	if	( isset($attr6_suffix)&& isset($attr6_key))
		$attr6_key = $attr6_key.$attr6_suffix;
	if(empty($attr6_title))
			$attr6_title = '';
	if	(empty($attr6_type))
		$tmp_tag = 'span';
	else
		switch( $attr6_type )
		{
			case 'emphatic':
			case 'italic':
				$tmp_tag = 'em';
				break;
			case 'strong':
			case 'bold':
				$tmp_tag = 'strong';
				break;
			case 'tt':
			case 'teletype':
				$tmp_tag = 'tt';
				break;
			default:
				$tmp_tag = 'span';
		}
?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
	$attr6_title = '';
	if	( $attr6_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr6_array))
	{
		$tmpArray = $$attr6_array;
		if (!empty($attr6_var))
			$tmp_text = $tmpArray[$attr6_var];
		else
			$tmp_text = $langF($tmpArray[$attr6_text]);
	}
	elseif (!empty($attr6_text))
		$tmp_text = $langF($attr6_text);
	elseif (!empty($attr6_textvar))
		$tmp_text = $langF($$attr6_textvar);
	elseif (!empty($attr6_key))
		$tmp_text = $langF($attr6_key);
	elseif (!empty($attr6_var))
		$tmp_text = isset($$attr6_var)?$$attr6_var:'?unset:'.$attr6_var.'?';	
	elseif (!empty($attr6_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr6_raw);
	elseif (!empty($attr6_value))
		$tmp_text = $attr6_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr6_maxlength) && intval($attr6_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr6_maxlength) );
	if	(isset($attr6_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr6_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_raw) ?><?php unset($attr6_escape) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></a><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?></td><?php unset($attr3) ?><?php $attr2_debug_info = 'a:0:{}' ?><?php $attr2 = array() ?></tr><?php unset($attr2) ?><?php $attr1_debug_info = 'a:0:{}' ?><?php $attr1 = array() ?></table><?php unset($attr1) ?><?php $attr0_debug_info = 'a:0:{}' ?><?php $attr0 = array() ?></body>
</html><?php unset($attr0) ?>