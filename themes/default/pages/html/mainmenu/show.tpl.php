<?php $attr1 = array('class'=>'main','title'=>$cms_title) ?><?php $attr1_class='main' ?><?php $attr1_title=$cms_title ?><?php header('Content-Type: text/html; charset='.lang('CHARSET'))
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
  <title><?php echo $attr1_title ?></title>
  <meta http-equiv="content-type" content="text/html; charset=<?php echo lang('CHARSET') ?>" />
  <meta name="MSSmartTagsPreventParsing" content="true" />
  <meta name="robots" content="noindex,nofollow" />
<?php if (isset($windowMenu) && is_array($windowMenu)) foreach( $windowMenu as $menu )
      {
       	?>
  <link rel="section" href="<?php echo Html::url($actionName,@$menu['subaction'],$this->getRequestId() ) ?>" title="<?php echo lang($menu['text']) ?>" />
<?php
      }
?>
  <link rel="stylesheet" type="text/css" href="./themes/default/css/default.css" />
<?php if($stylesheet!='default') { ?>
  <link rel="stylesheet" type="text/css" href="<?php echo $stylesheet ?>" />
<?php } ?>
</head>

<body class="<?php echo $attr1_class ?>">

<?php unset($attr1) ?><?php unset($attr1_class) ?><?php unset($attr1_title) ?><?php $attr2 = array('width'=>'100%','space'=>'0','padding'=>'5','rowclasses'=>'a,b','columnclasses'=>'a,b') ?><?php $attr2_width='100%' ?><?php $attr2_space='0' ?><?php $attr2_padding='5' ?><?php $attr2_rowclasses='a,b' ?><?php $attr2_columnclasses='a,b' ?><?php
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
	
?><table class="<?php echo $attr2_class ?>" cellspacing="<?php echo $attr2_space ?>" width="<?php echo $attr2_width ?>" cellpadding="<?php echo $attr2_padding ?>"><?php unset($attr2) ?><?php unset($attr2_width) ?><?php unset($attr2_space) ?><?php unset($attr2_padding) ?><?php unset($attr2_rowclasses) ?><?php unset($attr2_columnclasses) ?><?php $attr3 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr3_class))
		$attr3_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr3_class ?>"><?php unset($attr3) ?><?php $attr4 = array('class'=>'menu') ?><?php $attr4_class='menu' ?><?php
//	if (empty($attr4_class))
//		$attr4['class']=$row_class;
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
		
?><td <?php foreach( $attr4 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr4) ?><?php unset($attr4_class) ?><?php $attr5 = array('align'=>'left','type'=>$type) ?><?php $attr5_align='left' ?><?php $attr5_type=$type ?><?php
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
?><img src="<?php echo $image_dir.$attr5_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr5_align ?>"><?php } ?><?php unset($attr5) ?><?php unset($attr5_align) ?><?php unset($attr5_type) ?><?php $attr5 = array('list'=>'path','extract'=>'1','key'=>'list_key','value'=>'xy') ?><?php $attr5_list='path' ?><?php $attr5_extract='1' ?><?php $attr5_key='list_key' ?><?php $attr5_value='xy' ?><?php
	$attr5_list_tmp_key   = $attr5_key;
	$attr5_list_tmp_value = $attr5_value;
	$attr5_list_extract   = ($attr5_extract==true);

	if	( !isset($$attr5_list) || !is_array($$attr5_list) )
		$$attr5_list = array();
//		die('not an array in list,var='.$attr5_list);
//		Html::debug($$attr5_list);
	
	foreach( $$attr5_list as $$attr5_list_tmp_key => $$attr5_list_tmp_value )
	{
		if	( $attr5_list_extract )
		{
			if	( !is_array($$attr5_list_tmp_value) )
			{
				print_r($$attr5_list_tmp_value);
				die( 'not an array at key: '.$$attr5_list_tmp_key );
			}
			extract($$attr5_list_tmp_value);
		}
?><?php unset($attr5) ?><?php unset($attr5_list) ?><?php unset($attr5_extract) ?><?php unset($attr5_key) ?><?php unset($attr5_value) ?><?php $attr6 = array('title'=>$title,'target'=>'cms_main','url'=>$url,'class'=>'path') ?><?php $attr6_title=$title ?><?php $attr6_target='cms_main' ?><?php $attr6_url=$url ?><?php $attr6_class='path' ?><?php
	if(empty($attr6_class))
		$attr6_class='';
	if(empty($attr6_title))
		$attr6_title = '';
		
	if(!empty($attr6_url))
		$tmp_url = $attr6_url;
	else
		$tmp_url = Html::url($attr6_action,$attr6_subaction,!empty($$attr6_id)?$$attr6_id:$this->getRequestId(),array(!empty($var1)?$var1:'asdf'=>!empty($value1)?$$value1:''));
?><a href="<?php echo $tmp_url ?>" class="<?php echo $attr6_class ?>" target="<?php echo $attr6_target ?>" title="<?php echo $attr6_title ?>"><?php unset($attr6) ?><?php unset($attr6_title) ?><?php unset($attr6_target) ?><?php unset($attr6_url) ?><?php unset($attr6_class) ?><?php $attr7 = array('class'=>'text','maxlength'=>'20','value'=>$name) ?><?php $attr7_class='text' ?><?php $attr7_maxlength='20' ?><?php $attr7_value=$name ?><?php
	if	( isset($attr7_prefix)&& isset($attr7_key))
		$attr7_key = $attr7_prefix.$attr7_key;
	if	( isset($attr7_suffix)&& isset($attr7_key))
		$attr7_key = $attr7_key.$attr7_suffix;
		
	if(empty($attr7_title))
		if (!empty($attr7_key))
			$attr7_title = lang($attr7_key.'_HELP');
		else
			$attr7_title = '';

?><span class="<?php echo $attr7_class ?>" title="<?php echo $attr7_title ?>"><?php
	$attr7_title = '';

	if (!empty($attr7_array))
	{
		//geht nicht:
		//echo $$attr7_array[$attr7_var].'%';
		$tmpArray = $$attr7_array;
		if (!empty($attr7_var))
			$tmp_text = $tmpArray[$attr7_var];
		else
			$tmp_text = lang($tmpArray[$attr7_text]);
	}
	elseif (!empty($attr7_text))
		if	( isset($$attr7_text))
			$tmp_text = lang($$attr7_text);
		else
			$tmp_text = lang($attr7_text);
	elseif (!empty($attr7_textvar))
		$tmp_text = lang($$attr7_textvar);
	elseif (!empty($attr7_key))
		$tmp_text = lang($attr7_key);
	elseif (!empty($attr7_var))
		$tmp_text = isset($$attr7_var)?htmlentities($$attr7_var):'error: variable '.$attr7_var.' not present';	
	elseif (!empty($attr7_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr7_raw);
	elseif (!empty($attr7_value))
		$tmp_text = $attr7_value;
	else
	{
	  $tmp_text = '&nbsp;';
	  //Html::debug($attr7);echo 'text error';
	}
	
	if	( !empty($attr7_maxlength) && intval($attr7_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr7_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_maxlength) ?><?php unset($attr7_value) ?><?php $attr5 = array() ?></a><?php unset($attr5) ?><?php $attr6 = array('type'=>'filesep') ?><?php $attr6_type='filesep' ?><?php
	if ($attr6_type=='filesep')
		echo '&nbsp;<strong>&raquo;</strong>&nbsp;';
	else
		echo "char error";
?><?php unset($attr6) ?><?php unset($attr6_type) ?><?php $attr4 = array() ?><?php } ?><?php unset($attr4) ?><?php $attr5 = array('title'=>$text,'class'=>'title','text'=>$text) ?><?php $attr5_title=$text ?><?php $attr5_class='title' ?><?php $attr5_text=$text ?><?php
	if	( isset($attr5_prefix)&& isset($attr5_key))
		$attr5_key = $attr5_prefix.$attr5_key;
	if	( isset($attr5_suffix)&& isset($attr5_key))
		$attr5_key = $attr5_key.$attr5_suffix;
		
	if(empty($attr5_title))
		if (!empty($attr5_key))
			$attr5_title = lang($attr5_key.'_HELP');
		else
			$attr5_title = '';

?><span class="<?php echo $attr5_class ?>" title="<?php echo $attr5_title ?>"><?php
	$attr5_title = '';

	if (!empty($attr5_array))
	{
		//geht nicht:
		//echo $$attr5_array[$attr5_var].'%';
		$tmpArray = $$attr5_array;
		if (!empty($attr5_var))
			$tmp_text = $tmpArray[$attr5_var];
		else
			$tmp_text = lang($tmpArray[$attr5_text]);
	}
	elseif (!empty($attr5_text))
		if	( isset($$attr5_text))
			$tmp_text = lang($$attr5_text);
		else
			$tmp_text = lang($attr5_text);
	elseif (!empty($attr5_textvar))
		$tmp_text = lang($$attr5_textvar);
	elseif (!empty($attr5_key))
		$tmp_text = lang($attr5_key);
	elseif (!empty($attr5_var))
		$tmp_text = isset($$attr5_var)?htmlentities($$attr5_var):'error: variable '.$attr5_var.' not present';	
	elseif (!empty($attr5_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr5_raw);
	elseif (!empty($attr5_value))
		$tmp_text = $attr5_value;
	else
	{
	  $tmp_text = '&nbsp;';
	  //Html::debug($attr5);echo 'text error';
	}
	
	if	( !empty($attr5_maxlength) && intval($attr5_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr5_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr5) ?><?php unset($attr5_title) ?><?php unset($attr5_class) ?><?php unset($attr5_text) ?><?php $attr3 = array() ?></td><?php unset($attr3) ?><?php $attr4 = array('style'=>'text-align:right;','class'=>'menu') ?><?php $attr4_style='text-align:right;' ?><?php $attr4_class='menu' ?><?php
//	if (empty($attr4_class))
//		$attr4['class']=$row_class;
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
		
?><td <?php foreach( $attr4 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr4) ?><?php unset($attr4_style) ?><?php unset($attr4_class) ?><?php $attr5 = array('list'=>'windowIcons','extract'=>'1','key'=>'list_key','value'=>'list_value') ?><?php $attr5_list='windowIcons' ?><?php $attr5_extract='1' ?><?php $attr5_key='list_key' ?><?php $attr5_value='list_value' ?><?php
	$attr5_list_tmp_key   = $attr5_key;
	$attr5_list_tmp_value = $attr5_value;
	$attr5_list_extract   = ($attr5_extract==true);

	if	( !isset($$attr5_list) || !is_array($$attr5_list) )
		$$attr5_list = array();
//		die('not an array in list,var='.$attr5_list);
//		Html::debug($$attr5_list);
	
	foreach( $$attr5_list as $$attr5_list_tmp_key => $$attr5_list_tmp_value )
	{
		if	( $attr5_list_extract )
		{
			if	( !is_array($$attr5_list_tmp_value) )
			{
				print_r($$attr5_list_tmp_value);
				die( 'not an array at key: '.$$attr5_list_tmp_key );
			}
			extract($$attr5_list_tmp_value);
		}
?><?php unset($attr5) ?><?php unset($attr5_list) ?><?php unset($attr5_extract) ?><?php unset($attr5_key) ?><?php unset($attr5_value) ?><?php $attr6 = array('target'=>'_top','url'=>$url) ?><?php $attr6_target='_top' ?><?php $attr6_url=$url ?><?php
	if(empty($attr6_class))
		$attr6_class='';
	if(empty($attr6_title))
		$attr6_title = '';
		
	if(!empty($attr6_url))
		$tmp_url = $attr6_url;
	else
		$tmp_url = Html::url($attr6_action,$attr6_subaction,!empty($$attr6_id)?$$attr6_id:$this->getRequestId(),array(!empty($var1)?$var1:'asdf'=>!empty($value1)?$$value1:''));
?><a href="<?php echo $tmp_url ?>" class="<?php echo $attr6_class ?>" target="<?php echo $attr6_target ?>" title="<?php echo $attr6_title ?>"><?php unset($attr6) ?><?php unset($attr6_target) ?><?php unset($attr6_url) ?><?php $attr7 = array('align'=>'middle','type'=>$type) ?><?php $attr7_align='middle' ?><?php $attr7_type=$type ?><?php
if (isset($attr7_elementtype)) {
?><img src="<?php echo $image_dir.'icon_el_'.$attr7_elementtype.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr7_align ?>"><?php
} elseif (isset($attr7_type)) {
?><img src="<?php echo $image_dir.'icon_'.$attr7_type.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr7_align ?>"><?php
} elseif (isset($attr7_icon)) {
?><img src="<?php echo $image_dir.'icon_'.$attr7_icon.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr7_align ?>"><?php
} elseif (isset($attr7_url)) {
?><img src="<?php echo $attr7_url ?>" border="0" align="<?php echo $attr7_align ?>"><?php
} elseif (isset($attr7_fileext)) {
?><img src="<?php echo $image_dir.$attr7_fileext ?>" border="0" align="<?php echo $attr7_align ?>"><?php
} elseif (isset($attr7_file)) {
?><img src="<?php echo $image_dir.$attr7_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr7_align ?>"><?php } ?><?php unset($attr7) ?><?php unset($attr7_align) ?><?php unset($attr7_type) ?><?php $attr5 = array() ?></a><?php unset($attr5) ?><?php $attr4 = array() ?><?php } ?><?php unset($attr4) ?><?php $attr3 = array() ?></td><?php unset($attr3) ?><?php $attr2 = array() ?></tr><?php unset($attr2) ?><?php $attr3 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr3_class))
		$attr3_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr3_class ?>"><?php unset($attr3) ?><?php $attr4 = array('class'=>'subaction','colspan'=>'2') ?><?php $attr4_class='subaction' ?><?php $attr4_colspan='2' ?><?php
//	if (empty($attr4_class))
//		$attr4['class']=$row_class;
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
		
?><td <?php foreach( $attr4 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr4) ?><?php unset($attr4_class) ?><?php unset($attr4_colspan) ?><?php $attr5 = array('list'=>'windowMenu','extract'=>'1','key'=>'list_key','value'=>'xy') ?><?php $attr5_list='windowMenu' ?><?php $attr5_extract='1' ?><?php $attr5_key='list_key' ?><?php $attr5_value='xy' ?><?php
	$attr5_list_tmp_key   = $attr5_key;
	$attr5_list_tmp_value = $attr5_value;
	$attr5_list_extract   = ($attr5_extract==true);

	if	( !isset($$attr5_list) || !is_array($$attr5_list) )
		$$attr5_list = array();
//		die('not an array in list,var='.$attr5_list);
//		Html::debug($$attr5_list);
	
	foreach( $$attr5_list as $$attr5_list_tmp_key => $$attr5_list_tmp_value )
	{
		if	( $attr5_list_extract )
		{
			if	( !is_array($$attr5_list_tmp_value) )
			{
				print_r($$attr5_list_tmp_value);
				die( 'not an array at key: '.$$attr5_list_tmp_key );
			}
			extract($$attr5_list_tmp_value);
		}
?><?php unset($attr5) ?><?php unset($attr5_list) ?><?php unset($attr5_extract) ?><?php unset($attr5_key) ?><?php unset($attr5_value) ?><?php $attr6 = array('not'=>'1','empty'=>'url') ?><?php $attr6_not='1' ?><?php $attr6_empty='url' ?><?php 

	// Wahr-Vergleich
//	Html::debug($attr6);
	
	if	( isset($attr6_true) )
	{
		if	(gettype($attr6_true) === '' && gettype($attr6_true) === '1')
			$exec = $$attr6_true == true;
		else
			$exec = $attr6_true == true;
	}

	// Falsch-Vergleich
	elseif	( isset($attr6_false) )
	{
		if	(gettype($attr6_false) === '' && gettype($attr6_false) === '1')
			$exec = $$attr6_false == false;
		else
			$exec = $attr6_false == false;
	}
	// Inhalt-Vergleich mit Wertliste
	elseif( isset($attr6_contains) )
		$exec = in_array($attr6_value,explode(',',$attr6_contains));
				
	// Inhalt-Vergleich
	elseif( isset($attr6_equals)&& isset($attr6_value) )
		$exec = $attr6_equals == $attr6_value;

	// Vergleich auf leer
	elseif	( isset($attr6_empty) )
	{
		if	( !isset($$attr6_empty) )
			$exec = empty($attr6_empty);
		elseif	( is_array($$attr6_empty) )
			$exec = (count($$attr6_empty)==0);
		elseif	( is_bool($$attr6_empty) )
			$exec = true;
		else
			$exec = empty( $$attr6_empty );
	}

	// Vergleich auf Vorhandensein
	elseif	( isset($attr6_present) )
	{
		$exec = isset($$attr6_present);
//		if	( !isset($$attr6_present) )
//			$exec = false;
//		elseif	( is_array($$attr6_present) )
//			$exec = (count($$attr6_present)>0);
//		elseif	( is_bool($$attr6_present) )
//			$exec = $$attr6_present;
//		elseif	( is_numeric($$attr6_present) )
//			$exec = $$attr6_present>=0;
//		else
//			$exec = true;
	}

	else
	{
		Html::debug( $attr6 );
		echo("error in IF line ".__LINE__);
		echo("assume: FALSE");
		$exec = false;
	}

	// Ergebnis umdrehen
	// TODO: Bald ausbauen, stattdessen "not" verwenden.
	if  ( !empty($attr6_invert) )
		$exec = !$exec;

	// Ergebnis umdrehen
	if  ( !empty($attr6_not) )
		$exec = !$exec;

	unset($attr6_true);
	unset($attr6_false);
	unset($attr6_notempty);
	unset($attr6_empty);
	unset($attr6_contains);
	unset($attr6_present);
	unset($attr6_invert);
	unset($attr6_not);
	unset($attr6_value);
	unset($attr6_equals);

	$last_exec = $exec;
	
	if	( $exec )
	{
?><?php unset($attr6) ?><?php unset($attr6_not) ?><?php unset($attr6_empty) ?><?php $attr7 = array('title'=>'title','target'=>'cms_main_main','url'=>$url) ?><?php $attr7_title='title' ?><?php $attr7_target='cms_main_main' ?><?php $attr7_url=$url ?><?php
	if(empty($attr7_class))
		$attr7_class='';
	if(empty($attr7_title))
		$attr7_title = '';
		
	if(!empty($attr7_url))
		$tmp_url = $attr7_url;
	else
		$tmp_url = Html::url($attr7_action,$attr7_subaction,!empty($$attr7_id)?$$attr7_id:$this->getRequestId(),array(!empty($var1)?$var1:'asdf'=>!empty($value1)?$$value1:''));
?><a href="<?php echo $tmp_url ?>" class="<?php echo $attr7_class ?>" target="<?php echo $attr7_target ?>" title="<?php echo $attr7_title ?>"><?php unset($attr7) ?><?php unset($attr7_title) ?><?php unset($attr7_target) ?><?php unset($attr7_url) ?><?php $attr8 = array('class'=>'text','var'=>'text') ?><?php $attr8_class='text' ?><?php $attr8_var='text' ?><?php
	if	( isset($attr8_prefix)&& isset($attr8_key))
		$attr8_key = $attr8_prefix.$attr8_key;
	if	( isset($attr8_suffix)&& isset($attr8_key))
		$attr8_key = $attr8_key.$attr8_suffix;
		
	if(empty($attr8_title))
		if (!empty($attr8_key))
			$attr8_title = lang($attr8_key.'_HELP');
		else
			$attr8_title = '';

?><span class="<?php echo $attr8_class ?>" title="<?php echo $attr8_title ?>"><?php
	$attr8_title = '';

	if (!empty($attr8_array))
	{
		//geht nicht:
		//echo $$attr8_array[$attr8_var].'%';
		$tmpArray = $$attr8_array;
		if (!empty($attr8_var))
			$tmp_text = $tmpArray[$attr8_var];
		else
			$tmp_text = lang($tmpArray[$attr8_text]);
	}
	elseif (!empty($attr8_text))
		if	( isset($$attr8_text))
			$tmp_text = lang($$attr8_text);
		else
			$tmp_text = lang($attr8_text);
	elseif (!empty($attr8_textvar))
		$tmp_text = lang($$attr8_textvar);
	elseif (!empty($attr8_key))
		$tmp_text = lang($attr8_key);
	elseif (!empty($attr8_var))
		$tmp_text = isset($$attr8_var)?htmlentities($$attr8_var):'error: variable '.$attr8_var.' not present';	
	elseif (!empty($attr8_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr8_raw);
	elseif (!empty($attr8_value))
		$tmp_text = $attr8_value;
	else
	{
	  $tmp_text = '&nbsp;';
	  //Html::debug($attr8);echo 'text error';
	}
	
	if	( !empty($attr8_maxlength) && intval($attr8_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr8_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_var) ?><?php $attr6 = array() ?></a><?php unset($attr6) ?><?php $attr5 = array() ?><?php
	}
	
?><?php unset($attr5) ?><?php $attr6 = array('empty'=>'url') ?><?php $attr6_empty='url' ?><?php 

	// Wahr-Vergleich
//	Html::debug($attr6);
	
	if	( isset($attr6_true) )
	{
		if	(gettype($attr6_true) === '' && gettype($attr6_true) === '1')
			$exec = $$attr6_true == true;
		else
			$exec = $attr6_true == true;
	}

	// Falsch-Vergleich
	elseif	( isset($attr6_false) )
	{
		if	(gettype($attr6_false) === '' && gettype($attr6_false) === '1')
			$exec = $$attr6_false == false;
		else
			$exec = $attr6_false == false;
	}
	// Inhalt-Vergleich mit Wertliste
	elseif( isset($attr6_contains) )
		$exec = in_array($attr6_value,explode(',',$attr6_contains));
				
	// Inhalt-Vergleich
	elseif( isset($attr6_equals)&& isset($attr6_value) )
		$exec = $attr6_equals == $attr6_value;

	// Vergleich auf leer
	elseif	( isset($attr6_empty) )
	{
		if	( !isset($$attr6_empty) )
			$exec = empty($attr6_empty);
		elseif	( is_array($$attr6_empty) )
			$exec = (count($$attr6_empty)==0);
		elseif	( is_bool($$attr6_empty) )
			$exec = true;
		else
			$exec = empty( $$attr6_empty );
	}

	// Vergleich auf Vorhandensein
	elseif	( isset($attr6_present) )
	{
		$exec = isset($$attr6_present);
//		if	( !isset($$attr6_present) )
//			$exec = false;
//		elseif	( is_array($$attr6_present) )
//			$exec = (count($$attr6_present)>0);
//		elseif	( is_bool($$attr6_present) )
//			$exec = $$attr6_present;
//		elseif	( is_numeric($$attr6_present) )
//			$exec = $$attr6_present>=0;
//		else
//			$exec = true;
	}

	else
	{
		Html::debug( $attr6 );
		echo("error in IF line ".__LINE__);
		echo("assume: FALSE");
		$exec = false;
	}

	// Ergebnis umdrehen
	// TODO: Bald ausbauen, stattdessen "not" verwenden.
	if  ( !empty($attr6_invert) )
		$exec = !$exec;

	// Ergebnis umdrehen
	if  ( !empty($attr6_not) )
		$exec = !$exec;

	unset($attr6_true);
	unset($attr6_false);
	unset($attr6_notempty);
	unset($attr6_empty);
	unset($attr6_contains);
	unset($attr6_present);
	unset($attr6_invert);
	unset($attr6_not);
	unset($attr6_value);
	unset($attr6_equals);

	$last_exec = $exec;
	
	if	( $exec )
	{
?><?php unset($attr6) ?><?php unset($attr6_empty) ?><?php $attr7 = array('class'=>'inactive','var'=>'text') ?><?php $attr7_class='inactive' ?><?php $attr7_var='text' ?><?php
	if	( isset($attr7_prefix)&& isset($attr7_key))
		$attr7_key = $attr7_prefix.$attr7_key;
	if	( isset($attr7_suffix)&& isset($attr7_key))
		$attr7_key = $attr7_key.$attr7_suffix;
		
	if(empty($attr7_title))
		if (!empty($attr7_key))
			$attr7_title = lang($attr7_key.'_HELP');
		else
			$attr7_title = '';

?><span class="<?php echo $attr7_class ?>" title="<?php echo $attr7_title ?>"><?php
	$attr7_title = '';

	if (!empty($attr7_array))
	{
		//geht nicht:
		//echo $$attr7_array[$attr7_var].'%';
		$tmpArray = $$attr7_array;
		if (!empty($attr7_var))
			$tmp_text = $tmpArray[$attr7_var];
		else
			$tmp_text = lang($tmpArray[$attr7_text]);
	}
	elseif (!empty($attr7_text))
		if	( isset($$attr7_text))
			$tmp_text = lang($$attr7_text);
		else
			$tmp_text = lang($attr7_text);
	elseif (!empty($attr7_textvar))
		$tmp_text = lang($$attr7_textvar);
	elseif (!empty($attr7_key))
		$tmp_text = lang($attr7_key);
	elseif (!empty($attr7_var))
		$tmp_text = isset($$attr7_var)?htmlentities($$attr7_var):'error: variable '.$attr7_var.' not present';	
	elseif (!empty($attr7_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr7_raw);
	elseif (!empty($attr7_value))
		$tmp_text = $attr7_value;
	else
	{
	  $tmp_text = '&nbsp;';
	  //Html::debug($attr7);echo 'text error';
	}
	
	if	( !empty($attr7_maxlength) && intval($attr7_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr7_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_var) ?><?php $attr5 = array() ?><?php
	}
	
?><?php unset($attr5) ?><?php $attr6 = array('class'=>'text','raw'=>'__') ?><?php $attr6_class='text' ?><?php $attr6_raw='__' ?><?php
	if	( isset($attr6_prefix)&& isset($attr6_key))
		$attr6_key = $attr6_prefix.$attr6_key;
	if	( isset($attr6_suffix)&& isset($attr6_key))
		$attr6_key = $attr6_key.$attr6_suffix;
		
	if(empty($attr6_title))
		if (!empty($attr6_key))
			$attr6_title = lang($attr6_key.'_HELP');
		else
			$attr6_title = '';

?><span class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
	$attr6_title = '';

	if (!empty($attr6_array))
	{
		//geht nicht:
		//echo $$attr6_array[$attr6_var].'%';
		$tmpArray = $$attr6_array;
		if (!empty($attr6_var))
			$tmp_text = $tmpArray[$attr6_var];
		else
			$tmp_text = lang($tmpArray[$attr6_text]);
	}
	elseif (!empty($attr6_text))
		if	( isset($$attr6_text))
			$tmp_text = lang($$attr6_text);
		else
			$tmp_text = lang($attr6_text);
	elseif (!empty($attr6_textvar))
		$tmp_text = lang($$attr6_textvar);
	elseif (!empty($attr6_key))
		$tmp_text = lang($attr6_key);
	elseif (!empty($attr6_var))
		$tmp_text = isset($$attr6_var)?htmlentities($$attr6_var):'error: variable '.$attr6_var.' not present';	
	elseif (!empty($attr6_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr6_raw);
	elseif (!empty($attr6_value))
		$tmp_text = $attr6_value;
	else
	{
	  $tmp_text = '&nbsp;';
	  //Html::debug($attr6);echo 'text error';
	}
	
	if	( !empty($attr6_maxlength) && intval($attr6_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr6_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_raw) ?><!--
//<?php
//			if	( hasLang('MENU_'.$act.'_KEY' ) )
//			{
//				$attrAccesskey = ' accesskey="'.lang('MENU_'.$act.'_KEY').'"';
//				$title.=' ('.lang('GLOBAL_KEY').': ALT+'.lang('MENU_'.$act.'_KEY').')';
//			}
//			else
//				$attrAccesskey = '';
// ?>
-->
<?php $attr4 = array() ?><?php } ?><?php unset($attr4) ?><?php $attr3 = array() ?></td><?php unset($attr3) ?><?php $attr2 = array() ?></tr><?php unset($attr2) ?><?php $attr1 = array() ?></table><?php unset($attr1) ?><?php $attr0 = array() ?>
<!-- $Id$ -->

<?php if ($showDuration) { ?>
<br/>
<small>&nbsp;
<?php $dur = time()-START_TIME;
//      echo floor($dur/60).':'.str_pad($dur%60,2,'0',STR_PAD_LEFT); ?></small>
<?php } ?>

</body>
</html><?php unset($attr0) ?>