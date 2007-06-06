<?php $attr1 = array('class'=>'title','title'=>$cms_title) ?><?php $attr1_class='title' ?><?php $attr1_title=$cms_title ?><?php header('Content-Type: text/html; charset='.lang('CHARSET'))
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
<?php if(!empty($root_stylesheet)) { ?>
  <link rel="stylesheet" type="text/css" href="<?php echo $root_stylesheet ?>" />
<?php } ?>
<?php if($root_stylesheet!=$user_stylesheet) { ?>
  <link rel="stylesheet" type="text/css" href="<?php echo $user_stylesheet ?>" />
<?php } ?>
</head>

<body class="<?php echo $attr1_class ?>">

<?php unset($attr1) ?><?php unset($attr1_class) ?><?php unset($attr1_title) ?><?php $attr2 = array('width'=>'100%','space'=>'0','padding'=>'5','rowclasses'=>'odd,even') ?><?php $attr2_width='100%' ?><?php $attr2_space='0' ?><?php $attr2_padding='5' ?><?php $attr2_rowclasses='odd,even' ?><?php
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
	
?><table class="<?php echo $attr2_class ?>" cellspacing="<?php echo $attr2_space ?>" width="<?php echo $attr2_width ?>" cellpadding="<?php echo $attr2_padding ?>"><?php unset($attr2) ?><?php unset($attr2_width) ?><?php unset($attr2_space) ?><?php unset($attr2_padding) ?><?php unset($attr2_rowclasses) ?><?php $attr3 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr3_class))
		$attr3_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr3_class ?>"><?php unset($attr3) ?><?php $attr4 = array('width'=>'40%','class'=>'title') ?><?php $attr4_width='40%' ?><?php $attr4_class='title' ?><?php
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
		
?><td <?php foreach( $attr4 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr4) ?><?php unset($attr4_width) ?><?php unset($attr4_class) ?><?php $attr5 = array('icon'=>'database','align'=>'left') ?><?php $attr5_icon='database' ?><?php $attr5_align='left' ?><?php
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
?><img src="<?php echo $image_dir.$attr5_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr5_align ?>"><?php } ?><?php unset($attr5) ?><?php unset($attr5_icon) ?><?php unset($attr5_align) ?><?php $attr5 = array('title'=>$dbid,'class'=>'text','text'=>$dbname,'escape'=>true) ?><?php $attr5_title=$dbid ?><?php $attr5_class='text' ?><?php $attr5_text=$dbname ?><?php $attr5_escape=true ?><?php
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
		$tmp_text = isset($$attr5_var)?($attr5_escape?htmlentities($$attr5_var):$$attr5_var):'?'.$attr5_var.'?';	
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

	if	(isset($attr5_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr5_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
			
	echo $tmp_text;
?></span><?php unset($attr5) ?><?php unset($attr5_title) ?><?php unset($attr5_class) ?><?php unset($attr5_text) ?><?php unset($attr5_escape) ?><?php $attr3 = array() ?></td><?php unset($attr3) ?><?php $attr4 = array('width'=>'20%','style'=>'text-align:center;','class'=>'title') ?><?php $attr4_width='20%' ?><?php $attr4_style='text-align:center;' ?><?php $attr4_class='title' ?><?php
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
		
?><td <?php foreach( $attr4 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr4) ?><?php unset($attr4_width) ?><?php unset($attr4_style) ?><?php unset($attr4_class) ?><?php $attr5 = array('class'=>'text','var'=>'cms_title','escape'=>true) ?><?php $attr5_class='text' ?><?php $attr5_var='cms_title' ?><?php $attr5_escape=true ?><?php
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
		$tmp_text = isset($$attr5_var)?($attr5_escape?htmlentities($$attr5_var):$$attr5_var):'?'.$attr5_var.'?';	
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

	if	(isset($attr5_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr5_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
			
	echo $tmp_text;
?></span><?php unset($attr5) ?><?php unset($attr5_class) ?><?php unset($attr5_var) ?><?php unset($attr5_escape) ?><?php $attr3 = array() ?></td><?php unset($attr3) ?><?php $attr4 = array('width'=>'40%','style'=>'text-align:right;','class'=>'title') ?><?php $attr4_width='40%' ?><?php $attr4_style='text-align:right;' ?><?php $attr4_class='title' ?><?php
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
		
?><td <?php foreach( $attr4 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr4) ?><?php unset($attr4_width) ?><?php unset($attr4_style) ?><?php unset($attr4_class) ?><?php $attr5 = array('icon'=>'user','align'=>'right') ?><?php $attr5_icon='user' ?><?php $attr5_align='right' ?><?php
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
?><img src="<?php echo $image_dir.$attr5_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr5_align ?>"><?php } ?><?php unset($attr5) ?><?php unset($attr5_icon) ?><?php unset($attr5_align) ?><?php $attr5 = array('title'=>'USER_LOGOUT_DESC','target'=>'_top','url'=>$logout_url,'class'=>'') ?><?php $attr5_title='USER_LOGOUT_DESC' ?><?php $attr5_target='_top' ?><?php $attr5_url=$logout_url ?><?php $attr5_class='' ?><?php
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
?><a href="<?php echo $tmp_url ?>" class="<?php echo $attr5_class ?>" target="<?php echo $attr5_target ?>"<?php if (isset($attr5_accesskey)) echo ' accesskey="'.$attr5_accesskey.'"' ?>  title="<?php echo $attr5_title ?>"><?php unset($attr5) ?><?php unset($attr5_title) ?><?php unset($attr5_target) ?><?php unset($attr5_url) ?><?php unset($attr5_class) ?><?php $attr6 = array('class'=>'text','text'=>'USER_LOGOUT','escape'=>true) ?><?php $attr6_class='text' ?><?php $attr6_text='USER_LOGOUT' ?><?php $attr6_escape=true ?><?php
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
		$tmp_text = isset($$attr6_var)?($attr6_escape?htmlentities($$attr6_var):$$attr6_var):'?'.$attr6_var.'?';	
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

	if	(isset($attr6_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr6_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
			
	echo $tmp_text;
?></span><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_text) ?><?php unset($attr6_escape) ?><?php $attr4 = array() ?></a><?php unset($attr4) ?><?php $attr5 = array('class'=>'text','raw'=>'_(','escape'=>true) ?><?php $attr5_class='text' ?><?php $attr5_raw='_(' ?><?php $attr5_escape=true ?><?php
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
		$tmp_text = isset($$attr5_var)?($attr5_escape?htmlentities($$attr5_var):$$attr5_var):'?'.$attr5_var.'?';	
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

	if	(isset($attr5_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr5_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
			
	echo $tmp_text;
?></span><?php unset($attr5) ?><?php unset($attr5_class) ?><?php unset($attr5_raw) ?><?php unset($attr5_escape) ?><?php $attr5 = array('title'=>'USER_PROFILE_DESC','target'=>'cms_main_main','url'=>$profile_url,'class'=>'') ?><?php $attr5_title='USER_PROFILE_DESC' ?><?php $attr5_target='cms_main_main' ?><?php $attr5_url=$profile_url ?><?php $attr5_class='' ?><?php
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
?><a href="<?php echo $tmp_url ?>" class="<?php echo $attr5_class ?>" target="<?php echo $attr5_target ?>"<?php if (isset($attr5_accesskey)) echo ' accesskey="'.$attr5_accesskey.'"' ?>  title="<?php echo $attr5_title ?>"><?php unset($attr5) ?><?php unset($attr5_title) ?><?php unset($attr5_target) ?><?php unset($attr5_url) ?><?php unset($attr5_class) ?><?php $attr6 = array('class'=>'text','text'=>'userfullname','escape'=>true) ?><?php $attr6_class='text' ?><?php $attr6_text='userfullname' ?><?php $attr6_escape=true ?><?php
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
		$tmp_text = isset($$attr6_var)?($attr6_escape?htmlentities($$attr6_var):$$attr6_var):'?'.$attr6_var.'?';	
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

	if	(isset($attr6_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr6_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
			
	echo $tmp_text;
?></span><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_text) ?><?php unset($attr6_escape) ?><?php $attr6 = array('class'=>'text','raw'=>')','escape'=>true) ?><?php $attr6_class='text' ?><?php $attr6_raw=')' ?><?php $attr6_escape=true ?><?php
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
		$tmp_text = isset($$attr6_var)?($attr6_escape?htmlentities($$attr6_var):$$attr6_var):'?'.$attr6_var.'?';	
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

	if	(isset($attr6_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr6_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
			
	echo $tmp_text;
?></span><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_raw) ?><?php unset($attr6_escape) ?><?php $attr4 = array() ?></a><?php unset($attr4) ?><?php $attr3 = array() ?></td><?php unset($attr3) ?><?php $attr2 = array() ?></tr><?php unset($attr2) ?><?php $attr1 = array() ?></table><?php unset($attr1) ?><?php $attr0 = array() ?>
<!-- $Id$ -->

<?php if ($showDuration) { ?>
<br/>
<small>&nbsp;
<?php $dur = time()-START_TIME;
//      echo floor($dur/60).':'.str_pad($dur%60,2,'0',STR_PAD_LEFT); ?></small>
<?php } ?>

</body>
</html><?php unset($attr0) ?>