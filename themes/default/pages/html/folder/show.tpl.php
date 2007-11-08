<?php $attr1_debug_info = 'a:1:{s:5:"class";s:4:"main";}' ?><?php $attr1 = array('class'=>'main') ?><?php $attr1_class='main' ?><?php if (!headers_sent()) header('Content-Type: text/html; charset='.lang('CHARSET'))
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
  <title><?php echo isset($attr1_title)?$attr1_title.' - ':(isset($windowTitle)?lang($windowTitle).' - ':'') ?><?php echo $cms_title ?></title>
  <meta http-equiv="content-type" content="text/html; charset=<?php echo lang('CHARSET') ?>" />
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
?>
<?php if(!empty($root_stylesheet)) { ?>
  <link rel="stylesheet" type="text/css" href="<?php echo $root_stylesheet ?>" />
<?php } ?>
<?php if($root_stylesheet!=$user_stylesheet) { ?>
  <link rel="stylesheet" type="text/css" href="<?php echo $user_stylesheet ?>" />
<?php } ?>
</head>
<body class="<?php echo $attr1_class ?>" <?php if (@$conf['interface']['application_mode']) { ?> style="padding:0px;margin:0px;"<?php } ?> >
<?php unset($attr1) ?><?php unset($attr1_class) ?><?php $attr2_debug_info = 'a:4:{s:6:"widths";s:7:"75%,25%";s:5:"width";s:3:"93%";s:10:"rowclasses";s:8:"odd,even";s:13:"columnclasses";s:5:"1,2,3";}' ?><?php $attr2 = array('widths'=>'75%,25%','width'=>'93%','rowclasses'=>'odd,even','columnclasses'=>'1,2,3') ?><?php $attr2_widths='75%,25%' ?><?php $attr2_width='93%' ?><?php $attr2_rowclasses='odd,even' ?><?php $attr2_columnclasses='1,2,3' ?><?php
	$coloumn_widths=array();
	if	(!empty($attr2_widths))
	{
		$column_widths = explode(',',$attr2_widths);
		unset($attr2['widths']);
	}
	if	(!empty($attr2_rowclasses))
	{
		$row_classes   = explode(',',$attr2_rowclasses);
		$row_class_idx = 999;
		unset($attr2['rowclasses']);
	}
	if	(!empty($attr2_columnclasses))
	{
		$column_classes = explode(',',$attr2_columnclasses);
		unset($attr2['columnclasses']);
	}
		global $image_dir;
		if (@$conf['interface']['application_mode'] )
		{
			echo '<table class="main" cellspacing="0" cellpadding="4" width="100%" style="margin:0px;border:0px; padding:0px;" height_oo="100%">';
		}
		else
		{
			echo '<br/><br/><br/><center>';
			echo '<table class="main" cellspacing="0" cellpadding="4" width="'.$attr2_width.'">';
		}
		if (!@$conf['interface']['application_mode'] )
		{
		echo '<tr><td class="menu">';
		if	( !empty($attr2_icon) )
			echo '<img src="'.$image_dir.'icon_'.$attr2_icon.IMG_ICON_EXT.'" align="left" border="0">';
		if	( !isset($path) || is_array($path) )
			$path = array();
		foreach( $path as $pathElement)
		{
			extract($pathElement);
			echo '<a href="'.$url.'" class="path">'.lang($name).'</a>';
			echo '&nbsp;&raquo;&nbsp;';
		}
		echo '<span class="title">'.lang($windowTitle).'</span>';
		?>
		</td>
		<?php
		}
		?>
<?php ?>		<!--<td class="menu" style="align:right;">
    <?php if (isset($windowIcons)) foreach( $windowIcons as $icon )
          {
          	?><a href="<?php echo $icon['url'] ?>" title="<?php echo 'ICON_'.lang($menu['type'].'_DESC') ?>"><image border="0" src="<?php echo $image_dir.$icon['type'].IMG_ICON_EXT ?>"></a>&nbsp;<?php
          }
     ?>
    </td>-->
  </tr>
  <tr><td class="subaction">
    <?php if	( !isset($windowMenu) || !is_array($windowMenu) )
			$windowMenu = array();
    foreach( $windowMenu as $menu )
          {
          	$tmp_text = lang($menu['text']);
          	$tmp_key  = strtoupper(lang($menu['key' ]));
			$tmp_pos = strpos(strtolower($tmp_text),strtolower($tmp_key));
			if	( $tmp_pos !== false )
				$tmp_text = substr($tmp_text,0,max($tmp_pos,0)).'<span class="accesskey">'. substr($tmp_text,$tmp_pos,1).'</span>'.substr($tmp_text,$tmp_pos+1);
          	if	( isset($menu['url']) )
          	{
          		?><a href="<?php echo Html::url($actionName,$menu['subaction'],$this->getRequestId() ) ?>" accesskey="<?php echo $tmp_key ?>" title="<?php echo lang($menu['text'].'_DESC') ?>" class="menu<?php echo $this->subActionName==$menu['subaction']?'_highlight':'' ?>"><?php echo $tmp_text ?></a>&nbsp;&nbsp;&nbsp;<?php
          	}
          	else
          	{
          		?><span class="menu_disabled" title="<?php echo lang($menu['text'].'_DESC') ?>" class="menu_disabled"><?php echo $tmp_text ?></span>&nbsp;&nbsp;&nbsp;<?php
          	}
          }
          	if (@$conf['help']['enabled'] )
          	{
             ?><a href="<?php echo $conf['help']['url'].$actionName.'/'.$subActionName.@$conf['help']['suffix'] ?> " target="_new" title="<?php echo lang('MENU_HELP_DESC') ?>" class="menu" style="cursor:help;"><?php echo @$conf['help']['only_question_mark']?'?':lang('MENU_HELP') ?></a><?php
          	}
          	?></td>
  </tr>
<?php if (isset($notices) && count($notices)>0 )
      { ?>
  <tr>
    <td align="center" style="margin-top:10px; margin-bottom:10px;padding:5px; text-align:center;">
  <?php foreach( $notices as $notice_idx=>$notice ) { ?>
    	<br><table class="notice" width="100%">
  <?php if ($notice['name']!='') { ?>
  <tr>
    <td colspan="2" class="subaction" style="padding:2px; white-space:nowrap; border-bottom:1px solid black;"><img src="<?php echo $image_dir.'icon_'.$notice['type'].IMG_ICON_EXT ?>" align="left" /><?php echo $notice['name'] ?>
    </td>
  </tr>
<?php } ?>
  <tr class="notice_<?php echo $notice['status'] ?>">
    <td style="padding:10px;" width="30px"><img src="<?php echo $image_dir.'notice_'.$notice['status'].IMG_ICON_EXT ?>" style="padding:10px" /></td>
    <td style="padding:10px;padding-right:10px;padding-bottom:10px;"><?php if ($notice['status']=='error') { ?><strong><?php } ?><?php echo $notice['text'] ?><?php if ($notice['status']=='error') { ?></strong><?php } ?>
    <?php if (!empty($notice['log'])) { ?><pre><?php echo nl2br(htmlentities(implode("\nasdf",$notice['log']))) ?></pre><?php } ?>
    </td>
  </tr>
    </table>
  <?php } ?>
    </td>
  </tr>
  <tr>
  <td colspan="2"><fieldset></fieldset></td>
  </tr>
<?php } ?>
  <tr>
    <td>
      <table class="n" cellspacing="0" width="100%" cellpadding="4"><?php unset($attr2) ?><?php unset($attr2_widths) ?><?php unset($attr2_width) ?><?php unset($attr2_rowclasses) ?><?php unset($attr2_columnclasses) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];
	if (empty($attr3_class))
		$attr3_class=$row_class;
	global $cell_column_nr;
	$cell_column_nr=0;
	$column_class_idx = 999;
?><tr class="<?php echo $attr3_class ?>"><?php unset($attr3) ?><?php $attr4_debug_info = 'a:2:{s:5:"class";s:4:"help";s:7:"colspan";s:1:"7";}' ?><?php $attr4 = array('class'=>'help','colspan'=>'7') ?><?php $attr4_class='help' ?><?php $attr4_colspan='7' ?><?php
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
?><td <?php foreach( $attr4 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr4) ?><?php unset($attr4_class) ?><?php unset($attr4_colspan) ?><?php $attr5_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:18:"GLOBAL_FOLDER_DESC";s:6:"escape";s:4:"true";}' ?><?php $attr5 = array('class'=>'text','text'=>'GLOBAL_FOLDER_DESC','escape'=>true) ?><?php $attr5_class='text' ?><?php $attr5_text='GLOBAL_FOLDER_DESC' ?><?php $attr5_escape=true ?><?php
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
?></span><?php unset($attr5) ?><?php unset($attr5_class) ?><?php unset($attr5_text) ?><?php unset($attr5_escape) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?></td><?php unset($attr3) ?><?php $attr2_debug_info = 'a:0:{}' ?><?php $attr2 = array() ?></tr><?php unset($attr2) ?><?php $attr3_debug_info = 'a:1:{s:7:"present";s:6:"up_url";}' ?><?php $attr3 = array('present'=>'up_url') ?><?php $attr3_present='up_url' ?><?php 
	if	( isset($attr3_true) )
	{
		if	(gettype($attr3_true) === '' && gettype($attr3_true) === '1')
			$exec = $$attr3_true == true;
		else
			$exec = $attr3_true == true;
	}
	elseif	( isset($attr3_false) )
	{
		if	(gettype($attr3_false) === '' && gettype($attr3_false) === '1')
			$exec = $$attr3_false == false;
		else
			$exec = $attr3_false == false;
	}
	elseif( isset($attr3_contains) )
		$exec = in_array($attr3_value,explode(',',$attr3_contains));
	elseif( isset($attr3_equals)&& isset($attr3_value) )
		$exec = $attr3_equals == $attr3_value;
	elseif( isset($attr3_lessthan)&& isset($attr3_value) )
		$exec = intval($attr3_lessthan) > intval($attr3_value);
	elseif( isset($attr3_greaterthan)&& isset($attr3_value) )
		$exec = intval($attr3_greaterthan) < intval($attr3_value);
	elseif	( isset($attr3_empty) )
	{
		if	( !isset($$attr3_empty) )
			$exec = empty($attr3_empty);
		elseif	( is_array($$attr3_empty) )
			$exec = (count($$attr3_empty)==0);
		elseif	( is_bool($$attr3_empty) )
			$exec = true;
		else
			$exec = empty( $$attr3_empty );
	}
	elseif	( isset($attr3_present) )
	{
		$exec = isset($$attr3_present);
	}
	else
	{
		trigger_error("error in IF, assume: FALSE");
		$exec = false;
	}
	if  ( !empty($attr3_invert) )
		$exec = !$exec;
	if  ( !empty($attr3_not) )
		$exec = !$exec;
	unset($attr3_true);
	unset($attr3_false);
	unset($attr3_notempty);
	unset($attr3_empty);
	unset($attr3_contains);
	unset($attr3_present);
	unset($attr3_invert);
	unset($attr3_not);
	unset($attr3_value);
	unset($attr3_equals);
	$last_exec = $exec;
	if	( $exec )
	{
?>
<?php unset($attr3) ?><?php unset($attr3_present) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];
	if (empty($attr4_class))
		$attr4_class=$row_class;
	global $cell_column_nr;
	$cell_column_nr=0;
	$column_class_idx = 999;
?><tr class="<?php echo $attr4_class ?>"><?php unset($attr4) ?><?php $attr5_debug_info = 'a:3:{s:5:"width";s:3:"50%";s:5:"class";s:2:"fx";s:7:"colspan";s:1:"8";}' ?><?php $attr5 = array('width'=>'50%','class'=>'fx','colspan'=>'8') ?><?php $attr5_width='50%' ?><?php $attr5_class='fx' ?><?php $attr5_colspan='8' ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr5_class))
		$attr5['class']=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr5_rowspan) )
		$attr5['width']=$column_widths[$cell_column_nr-1];
?><td <?php foreach( $attr5 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr5) ?><?php unset($attr5_width) ?><?php unset($attr5_class) ?><?php unset($attr5_colspan) ?><?php $attr6_debug_info = 'a:4:{s:5:"title";s:0:"";s:6:"target";s:8:"cms_main";s:3:"url";s:10:"var:up_url";s:5:"class";s:0:"";}' ?><?php $attr6 = array('title'=>'','target'=>'cms_main','url'=>$up_url,'class'=>'') ?><?php $attr6_title='' ?><?php $attr6_target='cms_main' ?><?php $attr6_url=$up_url ?><?php $attr6_class='' ?><?php
	$params = array();
	if (!empty($attr6_var1) && isset($attr6_value1))
		$params[$attr6_var1]=$attr6_value1;
	if (!empty($attr6_var2) && isset($attr6_value2))
		$params[$attr6_var2]=$attr6_value2;
	if (!empty($attr6_var3) && isset($attr6_value3))
		$params[$attr6_var3]=$attr6_value3;
	if (!empty($attr6_var4) && isset($attr6_value4))
		$params[$attr6_var4]=$attr6_value4;
	if (!empty($attr6_var5) && isset($attr6_value5))
		$params[$attr6_var5]=$attr6_value5;
	if(empty($attr6_class))
		$attr6_class='';
	if(empty($attr6_title))
		$attr6_title = '';
	if(!empty($attr6_url))
		$tmp_url = $attr6_url;
	else
		$tmp_url = Html::url($attr6_action,$attr6_subaction,!empty($attr6_id)?$attr6_id:$this->getRequestId(),$params);
?><a href="<?php echo $tmp_url ?>" class="<?php echo $attr6_class ?>" target="<?php echo $attr6_target ?>"<?php if (isset($attr6_accesskey)) echo ' accesskey="'.$attr6_accesskey.'"' ?>  title="<?php echo $attr6_title ?>"><?php unset($attr6) ?><?php unset($attr6_title) ?><?php unset($attr6_target) ?><?php unset($attr6_url) ?><?php unset($attr6_class) ?><?php $attr7_debug_info = 'a:2:{s:5:"align";s:4:"left";s:4:"type";s:6:"folder";}' ?><?php $attr7 = array('align'=>'left','type'=>'folder') ?><?php $attr7_align='left' ?><?php $attr7_type='folder' ?><?php
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
?><img src="<?php echo $image_dir.$attr7_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr7_align ?>"><?php } ?><?php unset($attr7) ?><?php unset($attr7_align) ?><?php unset($attr7_type) ?><?php $attr7_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"raw";s:4:"_...";s:6:"escape";s:4:"true";}' ?><?php $attr7 = array('class'=>'text','raw'=>'_...','escape'=>true) ?><?php $attr7_class='text' ?><?php $attr7_raw='_...' ?><?php $attr7_escape=true ?><?php
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
		$tmp_text = isset($$attr7_var)?($attr7_escape?htmlentities($$attr7_var):$$attr7_var):'?'.$attr7_var.'?';	
	elseif (!empty($attr7_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr7_raw);
	elseif (!empty($attr7_value))
		$tmp_text = $attr7_value;
	else
	{
	  $tmp_text = '&nbsp;';
	}
	if	( !empty($attr7_maxlength) && intval($attr7_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr7_maxlength) );
	if	(isset($attr7_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr7_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
?></span><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_raw) ?><?php unset($attr7_escape) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></a><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></td><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?></tr><?php unset($attr3) ?><?php $attr2_debug_info = 'a:0:{}' ?><?php $attr2 = array() ?><?php } ?><?php unset($attr2) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];
	if (empty($attr3_class))
		$attr3_class=$row_class;
	global $cell_column_nr;
	$cell_column_nr=0;
	$column_class_idx = 999;
?><tr class="<?php echo $attr3_class ?>"><?php unset($attr3) ?><?php $attr4_debug_info = 'a:1:{s:5:"class";s:4:"help";}' ?><?php $attr4 = array('class'=>'help') ?><?php $attr4_class='help' ?><?php
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
?><td <?php foreach( $attr4 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr4) ?><?php unset($attr4_class) ?><?php $attr5_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:11:"GLOBAL_TYPE";s:6:"escape";s:4:"true";}' ?><?php $attr5 = array('class'=>'text','text'=>'GLOBAL_TYPE','escape'=>true) ?><?php $attr5_class='text' ?><?php $attr5_text='GLOBAL_TYPE' ?><?php $attr5_escape=true ?><?php
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
?></span><?php unset($attr5) ?><?php unset($attr5_class) ?><?php unset($attr5_text) ?><?php unset($attr5_escape) ?><?php $attr5_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"raw";s:3:"_/_";s:6:"escape";s:4:"true";}' ?><?php $attr5 = array('class'=>'text','raw'=>'_/_','escape'=>true) ?><?php $attr5_class='text' ?><?php $attr5_raw='_/_' ?><?php $attr5_escape=true ?><?php
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
?></span><?php unset($attr5) ?><?php unset($attr5_class) ?><?php unset($attr5_raw) ?><?php unset($attr5_escape) ?><?php $attr5_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:11:"GLOBAL_NAME";s:6:"escape";s:4:"true";}' ?><?php $attr5 = array('class'=>'text','text'=>'GLOBAL_NAME','escape'=>true) ?><?php $attr5_class='text' ?><?php $attr5_text='GLOBAL_NAME' ?><?php $attr5_escape=true ?><?php
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
?></span><?php unset($attr5) ?><?php unset($attr5_class) ?><?php unset($attr5_text) ?><?php unset($attr5_escape) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?></td><?php unset($attr3) ?><?php $attr4_debug_info = 'a:1:{s:5:"class";s:4:"help";}' ?><?php $attr4 = array('class'=>'help') ?><?php $attr4_class='help' ?><?php
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
?><td <?php foreach( $attr4 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr4) ?><?php unset($attr4_class) ?><?php $attr5_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:17:"GLOBAL_LASTCHANGE";s:6:"escape";s:4:"true";}' ?><?php $attr5 = array('class'=>'text','text'=>'GLOBAL_LASTCHANGE','escape'=>true) ?><?php $attr5_class='text' ?><?php $attr5_text='GLOBAL_LASTCHANGE' ?><?php $attr5_escape=true ?><?php
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
?></span><?php unset($attr5) ?><?php unset($attr5_class) ?><?php unset($attr5_text) ?><?php unset($attr5_escape) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?></td><?php unset($attr3) ?><?php $attr2_debug_info = 'a:0:{}' ?><?php $attr2 = array() ?></tr><?php unset($attr2) ?><?php $attr3_debug_info = 'a:4:{s:4:"list";s:6:"object";s:7:"extract";s:4:"true";s:3:"key";s:8:"list_key";s:5:"value";s:10:"list_value";}' ?><?php $attr3 = array('list'=>'object','extract'=>true,'key'=>'list_key','value'=>'list_value') ?><?php $attr3_list='object' ?><?php $attr3_extract=true ?><?php $attr3_key='list_key' ?><?php $attr3_value='list_value' ?><?php
	$attr3_list_tmp_key   = $attr3_key;
	$attr3_list_tmp_value = $attr3_value;
	$attr3_list_extract   = $attr3_extract;
	unset($attr3_key);
	unset($attr3_value);
	if	( !isset($$attr3_list) || !is_array($$attr3_list) )
		$$attr3_list = array();
	foreach( $$attr3_list as $$attr3_list_tmp_key => $$attr3_list_tmp_value )
	{
		if	( $attr3_list_extract )
		{
			if	( !is_array($$attr3_list_tmp_value) )
			{
				print_r($$attr3_list_tmp_value);
				die( 'not an array at key: '.$$attr3_list_tmp_key );
			}
			extract($$attr3_list_tmp_value);
		}
?><?php unset($attr3) ?><?php unset($attr3_list) ?><?php unset($attr3_extract) ?><?php unset($attr3_key) ?><?php unset($attr3_value) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];
	if (empty($attr4_class))
		$attr4_class=$row_class;
	global $cell_column_nr;
	$cell_column_nr=0;
	$column_class_idx = 999;
?><tr class="<?php echo $attr4_class ?>"><?php unset($attr4) ?><?php $attr5_debug_info = 'a:1:{s:5:"class";s:2:"fx";}' ?><?php $attr5 = array('class'=>'fx') ?><?php $attr5_class='fx' ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr5_class))
		$attr5['class']=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr5_rowspan) )
		$attr5['width']=$column_widths[$cell_column_nr-1];
?><td <?php foreach( $attr5 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr5) ?><?php unset($attr5_class) ?><?php $attr6_debug_info = 'a:4:{s:5:"title";s:4:"desc";s:6:"target";s:8:"cms_main";s:3:"url";s:7:"var:url";s:5:"class";s:0:"";}' ?><?php $attr6 = array('title'=>'desc','target'=>'cms_main','url'=>$url,'class'=>'') ?><?php $attr6_title='desc' ?><?php $attr6_target='cms_main' ?><?php $attr6_url=$url ?><?php $attr6_class='' ?><?php
	$params = array();
	if (!empty($attr6_var1) && isset($attr6_value1))
		$params[$attr6_var1]=$attr6_value1;
	if (!empty($attr6_var2) && isset($attr6_value2))
		$params[$attr6_var2]=$attr6_value2;
	if (!empty($attr6_var3) && isset($attr6_value3))
		$params[$attr6_var3]=$attr6_value3;
	if (!empty($attr6_var4) && isset($attr6_value4))
		$params[$attr6_var4]=$attr6_value4;
	if (!empty($attr6_var5) && isset($attr6_value5))
		$params[$attr6_var5]=$attr6_value5;
	if(empty($attr6_class))
		$attr6_class='';
	if(empty($attr6_title))
		$attr6_title = '';
	if(!empty($attr6_url))
		$tmp_url = $attr6_url;
	else
		$tmp_url = Html::url($attr6_action,$attr6_subaction,!empty($attr6_id)?$attr6_id:$this->getRequestId(),$params);
?><a href="<?php echo $tmp_url ?>" class="<?php echo $attr6_class ?>" target="<?php echo $attr6_target ?>"<?php if (isset($attr6_accesskey)) echo ' accesskey="'.$attr6_accesskey.'"' ?>  title="<?php echo $attr6_title ?>"><?php unset($attr6) ?><?php unset($attr6_title) ?><?php unset($attr6_target) ?><?php unset($attr6_url) ?><?php unset($attr6_class) ?><?php $attr7_debug_info = 'a:2:{s:5:"align";s:4:"left";s:4:"type";s:8:"var:icon";}' ?><?php $attr7 = array('align'=>'left','type'=>$icon) ?><?php $attr7_align='left' ?><?php $attr7_type=$icon ?><?php
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
?><img src="<?php echo $image_dir.$attr7_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr7_align ?>"><?php } ?><?php unset($attr7) ?><?php unset($attr7_align) ?><?php unset($attr7_type) ?><?php $attr7_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"var";s:4:"name";s:6:"escape";s:4:"true";}' ?><?php $attr7 = array('class'=>'text','var'=>'name','escape'=>true) ?><?php $attr7_class='text' ?><?php $attr7_var='name' ?><?php $attr7_escape=true ?><?php
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
		$tmp_text = isset($$attr7_var)?($attr7_escape?htmlentities($$attr7_var):$$attr7_var):'?'.$attr7_var.'?';	
	elseif (!empty($attr7_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr7_raw);
	elseif (!empty($attr7_value))
		$tmp_text = $attr7_value;
	else
	{
	  $tmp_text = '&nbsp;';
	}
	if	( !empty($attr7_maxlength) && intval($attr7_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr7_maxlength) );
	if	(isset($attr7_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr7_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
?></span><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_var) ?><?php unset($attr7_escape) ?><?php $attr7_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"raw";s:1:"_";s:6:"escape";s:4:"true";}' ?><?php $attr7 = array('class'=>'text','raw'=>'_','escape'=>true) ?><?php $attr7_class='text' ?><?php $attr7_raw='_' ?><?php $attr7_escape=true ?><?php
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
		$tmp_text = isset($$attr7_var)?($attr7_escape?htmlentities($$attr7_var):$$attr7_var):'?'.$attr7_var.'?';	
	elseif (!empty($attr7_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr7_raw);
	elseif (!empty($attr7_value))
		$tmp_text = $attr7_value;
	else
	{
	  $tmp_text = '&nbsp;';
	}
	if	( !empty($attr7_maxlength) && intval($attr7_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr7_maxlength) );
	if	(isset($attr7_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr7_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
?></span><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_raw) ?><?php unset($attr7_escape) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></a><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></td><?php unset($attr4) ?><?php $attr5_debug_info = 'a:1:{s:5:"class";s:2:"fx";}' ?><?php $attr5 = array('class'=>'fx') ?><?php $attr5_class='fx' ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr5_class))
		$attr5['class']=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr5_rowspan) )
		$attr5['width']=$column_widths[$cell_column_nr-1];
?><td <?php foreach( $attr5 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr5) ?><?php unset($attr5_class) ?><?php $attr6_debug_info = 'a:1:{s:4:"date";s:8:"var:date";}' ?><?php $attr6 = array('date'=>$date) ?><?php $attr6_date=$date ?><?php	
    global $conf;
	$time = $attr6_date;
	if	( $time==0)
		echo lang('GLOBAL_UNKNOWN');
	elseif ( !$conf['interface']['human_date_format'] )
		echo date(lang('DATE_FORMAT'),$time);
	else
	{
		$sekunden = time()-$time;
		$minuten = intval($sekunden/60);
		$stunden = intval($minuten /60);
		$tage    = intval($stunden /24);
		$monate  = intval($tage    /30);
		$jahre   = intval($monate  /12);
		echo '<span title="'.date(lang('DATE_FORMAT'),$time).'"">';
		if	( $time==0)
			echo lang('GLOBAL_UNKNOWN');
		elseif ( !$conf['interface']['human_date_format'] )
			echo date(lang('DATE_FORMAT'),$time);
		elseif	( $sekunden == 1 )
			echo $sekunden.' '.lang('GLOBAL_SECOND');
		elseif	( $sekunden < 60 )
			echo $sekunden.' '.lang('GLOBAL_SECONDS');
		elseif	( $minuten == 1 )
			echo $minuten.' '.lang('GLOBAL_MINUTE');
		elseif	( $minuten < 60 )
			echo $minuten.' '.lang('GLOBAL_MINUTES');
		elseif	( $stunden == 1 )
			echo $stunden.' '.lang('GLOBAL_HOUR');
		elseif	( $stunden < 60 )
			echo $stunden.' '.lang('GLOBAL_HOURS');
		elseif	( $tage == 1 )
			echo $tage.' '.lang('GLOBAL_DAY');
		elseif	( $tage < 60 )
			echo $tage.' '.lang('GLOBAL_DAYS');
		elseif	( $monate == 1 )
			echo $monate.' '.lang('GLOBAL_MONTH');
		elseif	( $monate < 12 )
			echo $monate.' '.lang('GLOBAL_MONTHS');
		elseif	( $jahre == 1 )
			echo $jahre.' '.lang('GLOBAL_YEAR');
		else
			echo $jahre.' '.lang('GLOBAL_YEARS');
		echo '</span>';
	}
?><?php unset($attr6) ?><?php unset($attr6_date) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></td><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?></tr><?php unset($attr3) ?><?php $attr2_debug_info = 'a:0:{}' ?><?php $attr2 = array() ?><?php } ?><?php unset($attr2) ?><?php $attr3_debug_info = 'a:1:{s:5:"empty";s:6:"object";}' ?><?php $attr3 = array('empty'=>'object') ?><?php $attr3_empty='object' ?><?php 
	if	( isset($attr3_true) )
	{
		if	(gettype($attr3_true) === '' && gettype($attr3_true) === '1')
			$exec = $$attr3_true == true;
		else
			$exec = $attr3_true == true;
	}
	elseif	( isset($attr3_false) )
	{
		if	(gettype($attr3_false) === '' && gettype($attr3_false) === '1')
			$exec = $$attr3_false == false;
		else
			$exec = $attr3_false == false;
	}
	elseif( isset($attr3_contains) )
		$exec = in_array($attr3_value,explode(',',$attr3_contains));
	elseif( isset($attr3_equals)&& isset($attr3_value) )
		$exec = $attr3_equals == $attr3_value;
	elseif( isset($attr3_lessthan)&& isset($attr3_value) )
		$exec = intval($attr3_lessthan) > intval($attr3_value);
	elseif( isset($attr3_greaterthan)&& isset($attr3_value) )
		$exec = intval($attr3_greaterthan) < intval($attr3_value);
	elseif	( isset($attr3_empty) )
	{
		if	( !isset($$attr3_empty) )
			$exec = empty($attr3_empty);
		elseif	( is_array($$attr3_empty) )
			$exec = (count($$attr3_empty)==0);
		elseif	( is_bool($$attr3_empty) )
			$exec = true;
		else
			$exec = empty( $$attr3_empty );
	}
	elseif	( isset($attr3_present) )
	{
		$exec = isset($$attr3_present);
	}
	else
	{
		trigger_error("error in IF, assume: FALSE");
		$exec = false;
	}
	if  ( !empty($attr3_invert) )
		$exec = !$exec;
	if  ( !empty($attr3_not) )
		$exec = !$exec;
	unset($attr3_true);
	unset($attr3_false);
	unset($attr3_notempty);
	unset($attr3_empty);
	unset($attr3_contains);
	unset($attr3_present);
	unset($attr3_invert);
	unset($attr3_not);
	unset($attr3_value);
	unset($attr3_equals);
	$last_exec = $exec;
	if	( $exec )
	{
?>
<?php unset($attr3) ?><?php unset($attr3_empty) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];
	if (empty($attr4_class))
		$attr4_class=$row_class;
	global $cell_column_nr;
	$cell_column_nr=0;
	$column_class_idx = 999;
?><tr class="<?php echo $attr4_class ?>"><?php unset($attr4) ?><?php $attr5_debug_info = 'a:2:{s:5:"class";s:2:"fx";s:7:"colspan";s:1:"2";}' ?><?php $attr5 = array('class'=>'fx','colspan'=>'2') ?><?php $attr5_class='fx' ?><?php $attr5_colspan='2' ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr5_class))
		$attr5['class']=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr5_rowspan) )
		$attr5['width']=$column_widths[$cell_column_nr-1];
?><td <?php foreach( $attr5 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr5) ?><?php unset($attr5_class) ?><?php unset($attr5_colspan) ?><?php $attr6_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:16:"GLOBAL_NOT_FOUND";s:6:"escape";s:4:"true";}' ?><?php $attr6 = array('class'=>'text','text'=>'GLOBAL_NOT_FOUND','escape'=>true) ?><?php $attr6_class='text' ?><?php $attr6_text='GLOBAL_NOT_FOUND' ?><?php $attr6_escape=true ?><?php
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
?></span><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_text) ?><?php unset($attr6_escape) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></td><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?></tr><?php unset($attr3) ?><?php $attr2_debug_info = 'a:0:{}' ?><?php $attr2 = array() ?><?php } ?><?php unset($attr2) ?><?php $attr1_debug_info = 'a:0:{}' ?><?php $attr1 = array() ?>      </table>
	</td>
  </tr>
</table>
</center>
<?php if ($showDuration)
      { ?>
<br/>
<center><small>&nbsp;
<?php $dur = time()-START_TIME;
      echo floor($dur/60).':'.str_pad($dur%60,2,'0',STR_PAD_LEFT); ?></small></center>
<?php } ?>
<?php unset($attr1) ?><?php $attr0_debug_info = 'a:0:{}' ?><?php $attr0 = array() ?></body>
</html><?php unset($attr0) ?>