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
<?php unset($attr1) ?><?php unset($attr1_class) ?><?php $attr2_debug_info = 'a:5:{s:5:"title";s:3:"ACL";s:4:"name";s:1:"x";s:5:"width";s:3:"93%";s:10:"rowclasses";s:8:"odd,even";s:13:"columnclasses";s:5:"1,2,3";}' ?><?php $attr2 = array('title'=>'ACL','name'=>'x','width'=>'93%','rowclasses'=>'odd,even','columnclasses'=>'1,2,3') ?><?php $attr2_title='ACL' ?><?php $attr2_name='x' ?><?php $attr2_width='93%' ?><?php $attr2_rowclasses='odd,even' ?><?php $attr2_columnclasses='1,2,3' ?><?php
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
      <table class="n" cellspacing="0" width="100%" cellpadding="4"><?php unset($attr2) ?><?php unset($attr2_title) ?><?php unset($attr2_name) ?><?php unset($attr2_width) ?><?php unset($attr2_rowclasses) ?><?php unset($attr2_columnclasses) ?><?php $attr3_debug_info = 'a:4:{s:4:"list";s:8:"projects";s:7:"extract";s:4:"true";s:3:"key";s:8:"list_key";s:5:"value";s:10:"list_value";}' ?><?php $attr3 = array('list'=>'projects','extract'=>true,'key'=>'list_key','value'=>'list_value') ?><?php $attr3_list='projects' ?><?php $attr3_extract=true ?><?php $attr3_key='list_key' ?><?php $attr3_value='list_value' ?><?php
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
?><tr class="<?php echo $attr4_class ?>"><?php unset($attr4) ?><?php $attr5_debug_info = 'a:1:{s:7:"colspan";s:2:"14";}' ?><?php $attr5 = array('colspan'=>'14') ?><?php $attr5_colspan='14' ?><?php
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
?><td <?php foreach( $attr5 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr5) ?><?php unset($attr5_colspan) ?><?php $attr6_debug_info = 'a:1:{s:5:"title";s:15:"var:projectname";}' ?><?php $attr6 = array('title'=>$projectname) ?><?php $attr6_title=$projectname ?><fieldset><legend><?php echo $attr6_title ?></legend><?php unset($attr6) ?><?php unset($attr6_title) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></fieldset><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></td><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?></tr><?php unset($attr3) ?><?php $attr4_debug_info = 'a:1:{s:5:"empty";s:4:"acls";}' ?><?php $attr4 = array('empty'=>'acls') ?><?php $attr4_empty='acls' ?><?php 
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
<?php unset($attr4) ?><?php unset($attr4_empty) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];
	if (empty($attr5_class))
		$attr5_class=$row_class;
	global $cell_column_nr;
	$cell_column_nr=0;
	$column_class_idx = 999;
?><tr class="<?php echo $attr5_class ?>"><?php unset($attr5) ?><?php $attr6_debug_info = 'a:1:{s:5:"class";s:2:"fx";}' ?><?php $attr6 = array('class'=>'fx') ?><?php $attr6_class='fx' ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr6_class))
		$attr6['class']=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr6_rowspan) )
		$attr6['width']=$column_widths[$cell_column_nr-1];
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr7_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:16:"GLOBAL_NOT_FOUND";s:6:"escape";s:4:"true";}' ?><?php $attr7 = array('class'=>'text','text'=>'GLOBAL_NOT_FOUND','escape'=>true) ?><?php $attr7_class='text' ?><?php $attr7_text='GLOBAL_NOT_FOUND' ?><?php $attr7_escape=true ?><?php
	if	( isset($attr7_prefix)&& isset($attr7_key))
		$attr7_key = $attr7_prefix.$attr7_key;
	if	( isset($attr7_suffix)&& isset($attr7_key))
		$attr7_key = $attr7_key.$attr7_suffix;
	if(empty($attr7_title))
		if (!empty($attr7_key))
			$attr7_title = lang($attr7_key.'_HELP');
		else
			$attr7_title = '';
	if	(empty($attr7_type))
		$tmp_tag = 'span';
	else
		switch( $attr7_type )
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
?><<?php echo $tmp_tag ?> class="<?php echo $attr7_class ?>" title="<?php echo $attr7_title ?>"><?php
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
		$tmp_text = isset($$attr7_var)?$$attr7_var:'?'.$attr7_var.'?';	
	elseif (!empty($attr7_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr7_raw);
	elseif (!empty($attr7_value))
		$tmp_text = $attr7_value;
	else
	  $tmp_text = '&nbsp;';
	if	( $attr7_escape && empty($attr7_raw) && $tmp_text!='&nbsp;' )
		$tmp_text = htmlentities($tmp_text);
	if	( !empty($attr7_maxlength) && intval($attr7_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr7_maxlength) );
	if	(isset($attr7_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr7_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_text) ?><?php unset($attr7_escape) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php } ?><?php unset($attr3) ?><?php $attr4_debug_info = 'a:2:{s:3:"not";s:4:"true";s:5:"empty";s:4:"acls";}' ?><?php $attr4 = array('not'=>true,'empty'=>'acls') ?><?php $attr4_not=true ?><?php $attr4_empty='acls' ?><?php 
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
<?php unset($attr4) ?><?php unset($attr4_not) ?><?php unset($attr4_empty) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];
	if (empty($attr5_class))
		$attr5_class=$row_class;
	global $cell_column_nr;
	$cell_column_nr=0;
	$column_class_idx = 999;
?><tr class="<?php echo $attr5_class ?>"><?php unset($attr5) ?><?php $attr6_debug_info = 'a:1:{s:5:"class";s:4:"help";}' ?><?php $attr6 = array('class'=>'help') ?><?php $attr6_class='help' ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr6_class))
		$attr6['class']=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr6_rowspan) )
		$attr6['width']=$column_widths[$cell_column_nr-1];
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr7_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:11:"GLOBAL_USER";s:6:"escape";s:4:"true";}' ?><?php $attr7 = array('class'=>'text','text'=>'GLOBAL_USER','escape'=>true) ?><?php $attr7_class='text' ?><?php $attr7_text='GLOBAL_USER' ?><?php $attr7_escape=true ?><?php
	if	( isset($attr7_prefix)&& isset($attr7_key))
		$attr7_key = $attr7_prefix.$attr7_key;
	if	( isset($attr7_suffix)&& isset($attr7_key))
		$attr7_key = $attr7_key.$attr7_suffix;
	if(empty($attr7_title))
		if (!empty($attr7_key))
			$attr7_title = lang($attr7_key.'_HELP');
		else
			$attr7_title = '';
	if	(empty($attr7_type))
		$tmp_tag = 'span';
	else
		switch( $attr7_type )
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
?><<?php echo $tmp_tag ?> class="<?php echo $attr7_class ?>" title="<?php echo $attr7_title ?>"><?php
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
		$tmp_text = isset($$attr7_var)?$$attr7_var:'?'.$attr7_var.'?';	
	elseif (!empty($attr7_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr7_raw);
	elseif (!empty($attr7_value))
		$tmp_text = $attr7_value;
	else
	  $tmp_text = '&nbsp;';
	if	( $attr7_escape && empty($attr7_raw) && $tmp_text!='&nbsp;' )
		$tmp_text = htmlentities($tmp_text);
	if	( !empty($attr7_maxlength) && intval($attr7_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr7_maxlength) );
	if	(isset($attr7_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr7_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_text) ?><?php unset($attr7_escape) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr6_debug_info = 'a:1:{s:5:"class";s:4:"help";}' ?><?php $attr6 = array('class'=>'help') ?><?php $attr6_class='help' ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr6_class))
		$attr6['class']=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr6_rowspan) )
		$attr6['width']=$column_widths[$cell_column_nr-1];
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr7_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:11:"GLOBAL_NAME";s:6:"escape";s:4:"true";}' ?><?php $attr7 = array('class'=>'text','text'=>'GLOBAL_NAME','escape'=>true) ?><?php $attr7_class='text' ?><?php $attr7_text='GLOBAL_NAME' ?><?php $attr7_escape=true ?><?php
	if	( isset($attr7_prefix)&& isset($attr7_key))
		$attr7_key = $attr7_prefix.$attr7_key;
	if	( isset($attr7_suffix)&& isset($attr7_key))
		$attr7_key = $attr7_key.$attr7_suffix;
	if(empty($attr7_title))
		if (!empty($attr7_key))
			$attr7_title = lang($attr7_key.'_HELP');
		else
			$attr7_title = '';
	if	(empty($attr7_type))
		$tmp_tag = 'span';
	else
		switch( $attr7_type )
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
?><<?php echo $tmp_tag ?> class="<?php echo $attr7_class ?>" title="<?php echo $attr7_title ?>"><?php
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
		$tmp_text = isset($$attr7_var)?$$attr7_var:'?'.$attr7_var.'?';	
	elseif (!empty($attr7_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr7_raw);
	elseif (!empty($attr7_value))
		$tmp_text = $attr7_value;
	else
	  $tmp_text = '&nbsp;';
	if	( $attr7_escape && empty($attr7_raw) && $tmp_text!='&nbsp;' )
		$tmp_text = htmlentities($tmp_text);
	if	( !empty($attr7_maxlength) && intval($attr7_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr7_maxlength) );
	if	(isset($attr7_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr7_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_text) ?><?php unset($attr7_escape) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr6_debug_info = 'a:1:{s:5:"class";s:4:"help";}' ?><?php $attr6 = array('class'=>'help') ?><?php $attr6_class='help' ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr6_class))
		$attr6['class']=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr6_rowspan) )
		$attr6['width']=$column_widths[$cell_column_nr-1];
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr7_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:15:"GLOBAL_LANGUAGE";s:6:"escape";s:4:"true";}' ?><?php $attr7 = array('class'=>'text','text'=>'GLOBAL_LANGUAGE','escape'=>true) ?><?php $attr7_class='text' ?><?php $attr7_text='GLOBAL_LANGUAGE' ?><?php $attr7_escape=true ?><?php
	if	( isset($attr7_prefix)&& isset($attr7_key))
		$attr7_key = $attr7_prefix.$attr7_key;
	if	( isset($attr7_suffix)&& isset($attr7_key))
		$attr7_key = $attr7_key.$attr7_suffix;
	if(empty($attr7_title))
		if (!empty($attr7_key))
			$attr7_title = lang($attr7_key.'_HELP');
		else
			$attr7_title = '';
	if	(empty($attr7_type))
		$tmp_tag = 'span';
	else
		switch( $attr7_type )
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
?><<?php echo $tmp_tag ?> class="<?php echo $attr7_class ?>" title="<?php echo $attr7_title ?>"><?php
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
		$tmp_text = isset($$attr7_var)?$$attr7_var:'?'.$attr7_var.'?';	
	elseif (!empty($attr7_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr7_raw);
	elseif (!empty($attr7_value))
		$tmp_text = $attr7_value;
	else
	  $tmp_text = '&nbsp;';
	if	( $attr7_escape && empty($attr7_raw) && $tmp_text!='&nbsp;' )
		$tmp_text = htmlentities($tmp_text);
	if	( !empty($attr7_maxlength) && intval($attr7_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr7_maxlength) );
	if	(isset($attr7_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr7_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_text) ?><?php unset($attr7_escape) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr6_debug_info = 'a:4:{s:4:"list";s:4:"show";s:7:"extract";s:5:"false";s:3:"key";s:8:"list_key";s:5:"value";s:1:"t";}' ?><?php $attr6 = array('list'=>'show','extract'=>false,'key'=>'list_key','value'=>'t') ?><?php $attr6_list='show' ?><?php $attr6_extract=false ?><?php $attr6_key='list_key' ?><?php $attr6_value='t' ?><?php
	$attr6_list_tmp_key   = $attr6_key;
	$attr6_list_tmp_value = $attr6_value;
	$attr6_list_extract   = $attr6_extract;
	unset($attr6_key);
	unset($attr6_value);
	if	( !isset($$attr6_list) || !is_array($$attr6_list) )
		$$attr6_list = array();
	foreach( $$attr6_list as $$attr6_list_tmp_key => $$attr6_list_tmp_value )
	{
		if	( $attr6_list_extract )
		{
			if	( !is_array($$attr6_list_tmp_value) )
			{
				print_r($$attr6_list_tmp_value);
				die( 'not an array at key: '.$$attr6_list_tmp_key );
			}
			extract($$attr6_list_tmp_value);
		}
?><?php unset($attr6) ?><?php unset($attr6_list) ?><?php unset($attr6_extract) ?><?php unset($attr6_key) ?><?php unset($attr6_value) ?><?php $attr7_debug_info = 'a:1:{s:5:"class";s:4:"help";}' ?><?php $attr7 = array('class'=>'help') ?><?php $attr7_class='help' ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr7_class))
		$attr7['class']=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr7_rowspan) )
		$attr7['width']=$column_widths[$cell_column_nr-1];
?><td <?php foreach( $attr7 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr7) ?><?php unset($attr7_class) ?><?php $attr8_debug_info = 'a:5:{s:5:"class";s:4:"text";s:3:"key";s:5:"var:t";s:6:"suffix";s:7:"_abbrev";s:6:"prefix";s:4:"acl_";s:6:"escape";s:4:"true";}' ?><?php $attr8 = array('class'=>'text','key'=>$t,'suffix'=>'_abbrev','prefix'=>'acl_','escape'=>true) ?><?php $attr8_class='text' ?><?php $attr8_key=$t ?><?php $attr8_suffix='_abbrev' ?><?php $attr8_prefix='acl_' ?><?php $attr8_escape=true ?><?php
	if	( isset($attr8_prefix)&& isset($attr8_key))
		$attr8_key = $attr8_prefix.$attr8_key;
	if	( isset($attr8_suffix)&& isset($attr8_key))
		$attr8_key = $attr8_key.$attr8_suffix;
	if(empty($attr8_title))
		if (!empty($attr8_key))
			$attr8_title = lang($attr8_key.'_HELP');
		else
			$attr8_title = '';
	if	(empty($attr8_type))
		$tmp_tag = 'span';
	else
		switch( $attr8_type )
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
?><<?php echo $tmp_tag ?> class="<?php echo $attr8_class ?>" title="<?php echo $attr8_title ?>"><?php
	$attr8_title = '';
	if (!empty($attr8_array))
	{
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
		$tmp_text = isset($$attr8_var)?$$attr8_var:'?'.$attr8_var.'?';	
	elseif (!empty($attr8_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr8_raw);
	elseif (!empty($attr8_value))
		$tmp_text = $attr8_value;
	else
	  $tmp_text = '&nbsp;';
	if	( $attr8_escape && empty($attr8_raw) && $tmp_text!='&nbsp;' )
		$tmp_text = htmlentities($tmp_text);
	if	( !empty($attr8_maxlength) && intval($attr8_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr8_maxlength) );
	if	(isset($attr8_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr8_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_key) ?><?php unset($attr8_suffix) ?><?php unset($attr8_prefix) ?><?php unset($attr8_escape) ?><?php $attr6_debug_info = 'a:0:{}' ?><?php $attr6 = array() ?></td><?php unset($attr6) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?><?php } ?><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php } ?><?php unset($attr3) ?><?php $attr4_debug_info = 'a:4:{s:4:"list";s:6:"rights";s:7:"extract";s:4:"true";s:3:"key";s:5:"aclid";s:5:"value";s:3:"acl";}' ?><?php $attr4 = array('list'=>'rights','extract'=>true,'key'=>'aclid','value'=>'acl') ?><?php $attr4_list='rights' ?><?php $attr4_extract=true ?><?php $attr4_key='aclid' ?><?php $attr4_value='acl' ?><?php
	$attr4_list_tmp_key   = $attr4_key;
	$attr4_list_tmp_value = $attr4_value;
	$attr4_list_extract   = $attr4_extract;
	unset($attr4_key);
	unset($attr4_value);
	if	( !isset($$attr4_list) || !is_array($$attr4_list) )
		$$attr4_list = array();
	foreach( $$attr4_list as $$attr4_list_tmp_key => $$attr4_list_tmp_value )
	{
		if	( $attr4_list_extract )
		{
			if	( !is_array($$attr4_list_tmp_value) )
			{
				print_r($$attr4_list_tmp_value);
				die( 'not an array at key: '.$$attr4_list_tmp_key );
			}
			extract($$attr4_list_tmp_value);
		}
?><?php unset($attr4) ?><?php unset($attr4_list) ?><?php unset($attr4_extract) ?><?php unset($attr4_key) ?><?php unset($attr4_value) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];
	if (empty($attr5_class))
		$attr5_class=$row_class;
	global $cell_column_nr;
	$cell_column_nr=0;
	$column_class_idx = 999;
?><tr class="<?php echo $attr5_class ?>"><?php unset($attr5) ?><?php $attr6_debug_info = 'a:0:{}' ?><?php $attr6 = array() ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr6_class))
		$attr6['class']=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr6_rowspan) )
		$attr6['width']=$column_widths[$cell_column_nr-1];
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php $attr7_debug_info = 'a:1:{s:7:"present";s:8:"username";}' ?><?php $attr7 = array('present'=>'username') ?><?php $attr7_present='username' ?><?php 
	if	( isset($attr7_true) )
	{
		if	(gettype($attr7_true) === '' && gettype($attr7_true) === '1')
			$exec = $$attr7_true == true;
		else
			$exec = $attr7_true == true;
	}
	elseif	( isset($attr7_false) )
	{
		if	(gettype($attr7_false) === '' && gettype($attr7_false) === '1')
			$exec = $$attr7_false == false;
		else
			$exec = $attr7_false == false;
	}
	elseif( isset($attr7_contains) )
		$exec = in_array($attr7_value,explode(',',$attr7_contains));
	elseif( isset($attr7_equals)&& isset($attr7_value) )
		$exec = $attr7_equals == $attr7_value;
	elseif( isset($attr7_lessthan)&& isset($attr7_value) )
		$exec = intval($attr7_lessthan) > intval($attr7_value);
	elseif( isset($attr7_greaterthan)&& isset($attr7_value) )
		$exec = intval($attr7_greaterthan) < intval($attr7_value);
	elseif	( isset($attr7_empty) )
	{
		if	( !isset($$attr7_empty) )
			$exec = empty($attr7_empty);
		elseif	( is_array($$attr7_empty) )
			$exec = (count($$attr7_empty)==0);
		elseif	( is_bool($$attr7_empty) )
			$exec = true;
		else
			$exec = empty( $$attr7_empty );
	}
	elseif	( isset($attr7_present) )
	{
		$exec = isset($$attr7_present);
	}
	else
	{
		trigger_error("error in IF, assume: FALSE");
		$exec = false;
	}
	if  ( !empty($attr7_invert) )
		$exec = !$exec;
	if  ( !empty($attr7_not) )
		$exec = !$exec;
	unset($attr7_true);
	unset($attr7_false);
	unset($attr7_notempty);
	unset($attr7_empty);
	unset($attr7_contains);
	unset($attr7_present);
	unset($attr7_invert);
	unset($attr7_not);
	unset($attr7_value);
	unset($attr7_equals);
	$last_exec = $exec;
	if	( $exec )
	{
?>
<?php unset($attr7) ?><?php unset($attr7_present) ?><?php $attr8_debug_info = 'a:2:{s:5:"align";s:4:"left";s:4:"type";s:4:"user";}' ?><?php $attr8 = array('align'=>'left','type'=>'user') ?><?php $attr8_align='left' ?><?php $attr8_type='user' ?><?php
if (isset($attr8_elementtype)) {
?><img src="<?php echo $image_dir.'icon_el_'.$attr8_elementtype.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr8_align ?>"><?php
} elseif (isset($attr8_type)) {
?><img src="<?php echo $image_dir.'icon_'.$attr8_type.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr8_align ?>"><?php
} elseif (isset($attr8_icon)) {
?><img src="<?php echo $image_dir.'icon_'.$attr8_icon.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr8_align ?>"><?php
} elseif (isset($attr8_url)) {
?><img src="<?php echo $attr8_url ?>" border="0" align="<?php echo $attr8_align ?>"><?php
} elseif (isset($attr8_fileext)) {
?><img src="<?php echo $image_dir.$attr8_fileext ?>" border="0" align="<?php echo $attr8_align ?>"><?php
} elseif (isset($attr8_file)) {
?><img src="<?php echo $image_dir.$attr8_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr8_align ?>"><?php } ?><?php unset($attr8) ?><?php unset($attr8_align) ?><?php unset($attr8_type) ?><?php $attr8_debug_info = 'a:4:{s:5:"class";s:4:"text";s:4:"text";s:12:"var:username";s:9:"maxlength";s:2:"20";s:6:"escape";s:4:"true";}' ?><?php $attr8 = array('class'=>'text','text'=>$username,'maxlength'=>'20','escape'=>true) ?><?php $attr8_class='text' ?><?php $attr8_text=$username ?><?php $attr8_maxlength='20' ?><?php $attr8_escape=true ?><?php
	if	( isset($attr8_prefix)&& isset($attr8_key))
		$attr8_key = $attr8_prefix.$attr8_key;
	if	( isset($attr8_suffix)&& isset($attr8_key))
		$attr8_key = $attr8_key.$attr8_suffix;
	if(empty($attr8_title))
		if (!empty($attr8_key))
			$attr8_title = lang($attr8_key.'_HELP');
		else
			$attr8_title = '';
	if	(empty($attr8_type))
		$tmp_tag = 'span';
	else
		switch( $attr8_type )
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
?><<?php echo $tmp_tag ?> class="<?php echo $attr8_class ?>" title="<?php echo $attr8_title ?>"><?php
	$attr8_title = '';
	if (!empty($attr8_array))
	{
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
		$tmp_text = isset($$attr8_var)?$$attr8_var:'?'.$attr8_var.'?';	
	elseif (!empty($attr8_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr8_raw);
	elseif (!empty($attr8_value))
		$tmp_text = $attr8_value;
	else
	  $tmp_text = '&nbsp;';
	if	( $attr8_escape && empty($attr8_raw) && $tmp_text!='&nbsp;' )
		$tmp_text = htmlentities($tmp_text);
	if	( !empty($attr8_maxlength) && intval($attr8_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr8_maxlength) );
	if	(isset($attr8_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr8_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_text) ?><?php unset($attr8_maxlength) ?><?php unset($attr8_escape) ?><?php $attr6_debug_info = 'a:0:{}' ?><?php $attr6 = array() ?><?php } ?><?php unset($attr6) ?><?php $attr7_debug_info = 'a:1:{s:7:"present";s:9:"groupname";}' ?><?php $attr7 = array('present'=>'groupname') ?><?php $attr7_present='groupname' ?><?php 
	if	( isset($attr7_true) )
	{
		if	(gettype($attr7_true) === '' && gettype($attr7_true) === '1')
			$exec = $$attr7_true == true;
		else
			$exec = $attr7_true == true;
	}
	elseif	( isset($attr7_false) )
	{
		if	(gettype($attr7_false) === '' && gettype($attr7_false) === '1')
			$exec = $$attr7_false == false;
		else
			$exec = $attr7_false == false;
	}
	elseif( isset($attr7_contains) )
		$exec = in_array($attr7_value,explode(',',$attr7_contains));
	elseif( isset($attr7_equals)&& isset($attr7_value) )
		$exec = $attr7_equals == $attr7_value;
	elseif( isset($attr7_lessthan)&& isset($attr7_value) )
		$exec = intval($attr7_lessthan) > intval($attr7_value);
	elseif( isset($attr7_greaterthan)&& isset($attr7_value) )
		$exec = intval($attr7_greaterthan) < intval($attr7_value);
	elseif	( isset($attr7_empty) )
	{
		if	( !isset($$attr7_empty) )
			$exec = empty($attr7_empty);
		elseif	( is_array($$attr7_empty) )
			$exec = (count($$attr7_empty)==0);
		elseif	( is_bool($$attr7_empty) )
			$exec = true;
		else
			$exec = empty( $$attr7_empty );
	}
	elseif	( isset($attr7_present) )
	{
		$exec = isset($$attr7_present);
	}
	else
	{
		trigger_error("error in IF, assume: FALSE");
		$exec = false;
	}
	if  ( !empty($attr7_invert) )
		$exec = !$exec;
	if  ( !empty($attr7_not) )
		$exec = !$exec;
	unset($attr7_true);
	unset($attr7_false);
	unset($attr7_notempty);
	unset($attr7_empty);
	unset($attr7_contains);
	unset($attr7_present);
	unset($attr7_invert);
	unset($attr7_not);
	unset($attr7_value);
	unset($attr7_equals);
	$last_exec = $exec;
	if	( $exec )
	{
?>
<?php unset($attr7) ?><?php unset($attr7_present) ?><?php $attr8_debug_info = 'a:2:{s:5:"align";s:4:"left";s:4:"type";s:5:"group";}' ?><?php $attr8 = array('align'=>'left','type'=>'group') ?><?php $attr8_align='left' ?><?php $attr8_type='group' ?><?php
if (isset($attr8_elementtype)) {
?><img src="<?php echo $image_dir.'icon_el_'.$attr8_elementtype.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr8_align ?>"><?php
} elseif (isset($attr8_type)) {
?><img src="<?php echo $image_dir.'icon_'.$attr8_type.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr8_align ?>"><?php
} elseif (isset($attr8_icon)) {
?><img src="<?php echo $image_dir.'icon_'.$attr8_icon.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr8_align ?>"><?php
} elseif (isset($attr8_url)) {
?><img src="<?php echo $attr8_url ?>" border="0" align="<?php echo $attr8_align ?>"><?php
} elseif (isset($attr8_fileext)) {
?><img src="<?php echo $image_dir.$attr8_fileext ?>" border="0" align="<?php echo $attr8_align ?>"><?php
} elseif (isset($attr8_file)) {
?><img src="<?php echo $image_dir.$attr8_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr8_align ?>"><?php } ?><?php unset($attr8) ?><?php unset($attr8_align) ?><?php unset($attr8_type) ?><?php $attr8_debug_info = 'a:4:{s:5:"class";s:4:"text";s:4:"text";s:13:"var:groupname";s:9:"maxlength";s:2:"20";s:6:"escape";s:4:"true";}' ?><?php $attr8 = array('class'=>'text','text'=>$groupname,'maxlength'=>'20','escape'=>true) ?><?php $attr8_class='text' ?><?php $attr8_text=$groupname ?><?php $attr8_maxlength='20' ?><?php $attr8_escape=true ?><?php
	if	( isset($attr8_prefix)&& isset($attr8_key))
		$attr8_key = $attr8_prefix.$attr8_key;
	if	( isset($attr8_suffix)&& isset($attr8_key))
		$attr8_key = $attr8_key.$attr8_suffix;
	if(empty($attr8_title))
		if (!empty($attr8_key))
			$attr8_title = lang($attr8_key.'_HELP');
		else
			$attr8_title = '';
	if	(empty($attr8_type))
		$tmp_tag = 'span';
	else
		switch( $attr8_type )
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
?><<?php echo $tmp_tag ?> class="<?php echo $attr8_class ?>" title="<?php echo $attr8_title ?>"><?php
	$attr8_title = '';
	if (!empty($attr8_array))
	{
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
		$tmp_text = isset($$attr8_var)?$$attr8_var:'?'.$attr8_var.'?';	
	elseif (!empty($attr8_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr8_raw);
	elseif (!empty($attr8_value))
		$tmp_text = $attr8_value;
	else
	  $tmp_text = '&nbsp;';
	if	( $attr8_escape && empty($attr8_raw) && $tmp_text!='&nbsp;' )
		$tmp_text = htmlentities($tmp_text);
	if	( !empty($attr8_maxlength) && intval($attr8_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr8_maxlength) );
	if	(isset($attr8_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr8_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_text) ?><?php unset($attr8_maxlength) ?><?php unset($attr8_escape) ?><?php $attr6_debug_info = 'a:0:{}' ?><?php $attr6 = array() ?><?php } ?><?php unset($attr6) ?><?php $attr7_debug_info = 'a:2:{s:3:"not";s:4:"true";s:7:"present";s:8:"username";}' ?><?php $attr7 = array('not'=>true,'present'=>'username') ?><?php $attr7_not=true ?><?php $attr7_present='username' ?><?php 
	if	( isset($attr7_true) )
	{
		if	(gettype($attr7_true) === '' && gettype($attr7_true) === '1')
			$exec = $$attr7_true == true;
		else
			$exec = $attr7_true == true;
	}
	elseif	( isset($attr7_false) )
	{
		if	(gettype($attr7_false) === '' && gettype($attr7_false) === '1')
			$exec = $$attr7_false == false;
		else
			$exec = $attr7_false == false;
	}
	elseif( isset($attr7_contains) )
		$exec = in_array($attr7_value,explode(',',$attr7_contains));
	elseif( isset($attr7_equals)&& isset($attr7_value) )
		$exec = $attr7_equals == $attr7_value;
	elseif( isset($attr7_lessthan)&& isset($attr7_value) )
		$exec = intval($attr7_lessthan) > intval($attr7_value);
	elseif( isset($attr7_greaterthan)&& isset($attr7_value) )
		$exec = intval($attr7_greaterthan) < intval($attr7_value);
	elseif	( isset($attr7_empty) )
	{
		if	( !isset($$attr7_empty) )
			$exec = empty($attr7_empty);
		elseif	( is_array($$attr7_empty) )
			$exec = (count($$attr7_empty)==0);
		elseif	( is_bool($$attr7_empty) )
			$exec = true;
		else
			$exec = empty( $$attr7_empty );
	}
	elseif	( isset($attr7_present) )
	{
		$exec = isset($$attr7_present);
	}
	else
	{
		trigger_error("error in IF, assume: FALSE");
		$exec = false;
	}
	if  ( !empty($attr7_invert) )
		$exec = !$exec;
	if  ( !empty($attr7_not) )
		$exec = !$exec;
	unset($attr7_true);
	unset($attr7_false);
	unset($attr7_notempty);
	unset($attr7_empty);
	unset($attr7_contains);
	unset($attr7_present);
	unset($attr7_invert);
	unset($attr7_not);
	unset($attr7_value);
	unset($attr7_equals);
	$last_exec = $exec;
	if	( $exec )
	{
?>
<?php unset($attr7) ?><?php unset($attr7_not) ?><?php unset($attr7_present) ?><?php $attr8_debug_info = 'a:2:{s:3:"not";s:4:"true";s:7:"present";s:9:"groupname";}' ?><?php $attr8 = array('not'=>true,'present'=>'groupname') ?><?php $attr8_not=true ?><?php $attr8_present='groupname' ?><?php 
	if	( isset($attr8_true) )
	{
		if	(gettype($attr8_true) === '' && gettype($attr8_true) === '1')
			$exec = $$attr8_true == true;
		else
			$exec = $attr8_true == true;
	}
	elseif	( isset($attr8_false) )
	{
		if	(gettype($attr8_false) === '' && gettype($attr8_false) === '1')
			$exec = $$attr8_false == false;
		else
			$exec = $attr8_false == false;
	}
	elseif( isset($attr8_contains) )
		$exec = in_array($attr8_value,explode(',',$attr8_contains));
	elseif( isset($attr8_equals)&& isset($attr8_value) )
		$exec = $attr8_equals == $attr8_value;
	elseif( isset($attr8_lessthan)&& isset($attr8_value) )
		$exec = intval($attr8_lessthan) > intval($attr8_value);
	elseif( isset($attr8_greaterthan)&& isset($attr8_value) )
		$exec = intval($attr8_greaterthan) < intval($attr8_value);
	elseif	( isset($attr8_empty) )
	{
		if	( !isset($$attr8_empty) )
			$exec = empty($attr8_empty);
		elseif	( is_array($$attr8_empty) )
			$exec = (count($$attr8_empty)==0);
		elseif	( is_bool($$attr8_empty) )
			$exec = true;
		else
			$exec = empty( $$attr8_empty );
	}
	elseif	( isset($attr8_present) )
	{
		$exec = isset($$attr8_present);
	}
	else
	{
		trigger_error("error in IF, assume: FALSE");
		$exec = false;
	}
	if  ( !empty($attr8_invert) )
		$exec = !$exec;
	if  ( !empty($attr8_not) )
		$exec = !$exec;
	unset($attr8_true);
	unset($attr8_false);
	unset($attr8_notempty);
	unset($attr8_empty);
	unset($attr8_contains);
	unset($attr8_present);
	unset($attr8_invert);
	unset($attr8_not);
	unset($attr8_value);
	unset($attr8_equals);
	$last_exec = $exec;
	if	( $exec )
	{
?>
<?php unset($attr8) ?><?php unset($attr8_not) ?><?php unset($attr8_present) ?><?php $attr9_debug_info = 'a:2:{s:5:"align";s:4:"left";s:4:"type";s:5:"group";}' ?><?php $attr9 = array('align'=>'left','type'=>'group') ?><?php $attr9_align='left' ?><?php $attr9_type='group' ?><?php
if (isset($attr9_elementtype)) {
?><img src="<?php echo $image_dir.'icon_el_'.$attr9_elementtype.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_type)) {
?><img src="<?php echo $image_dir.'icon_'.$attr9_type.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_icon)) {
?><img src="<?php echo $image_dir.'icon_'.$attr9_icon.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_url)) {
?><img src="<?php echo $attr9_url ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_fileext)) {
?><img src="<?php echo $image_dir.$attr9_fileext ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_file)) {
?><img src="<?php echo $image_dir.$attr9_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr9_align ?>"><?php } ?><?php unset($attr9) ?><?php unset($attr9_align) ?><?php unset($attr9_type) ?><?php $attr9_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"key";s:10:"global_all";s:6:"escape";s:4:"true";}' ?><?php $attr9 = array('class'=>'text','key'=>'global_all','escape'=>true) ?><?php $attr9_class='text' ?><?php $attr9_key='global_all' ?><?php $attr9_escape=true ?><?php
	if	( isset($attr9_prefix)&& isset($attr9_key))
		$attr9_key = $attr9_prefix.$attr9_key;
	if	( isset($attr9_suffix)&& isset($attr9_key))
		$attr9_key = $attr9_key.$attr9_suffix;
	if(empty($attr9_title))
		if (!empty($attr9_key))
			$attr9_title = lang($attr9_key.'_HELP');
		else
			$attr9_title = '';
	if	(empty($attr9_type))
		$tmp_tag = 'span';
	else
		switch( $attr9_type )
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
?><<?php echo $tmp_tag ?> class="<?php echo $attr9_class ?>" title="<?php echo $attr9_title ?>"><?php
	$attr9_title = '';
	if (!empty($attr9_array))
	{
		$tmpArray = $$attr9_array;
		if (!empty($attr9_var))
			$tmp_text = $tmpArray[$attr9_var];
		else
			$tmp_text = lang($tmpArray[$attr9_text]);
	}
	elseif (!empty($attr9_text))
		if	( isset($$attr9_text))
			$tmp_text = lang($$attr9_text);
		else
			$tmp_text = lang($attr9_text);
	elseif (!empty($attr9_textvar))
		$tmp_text = lang($$attr9_textvar);
	elseif (!empty($attr9_key))
		$tmp_text = lang($attr9_key);
	elseif (!empty($attr9_var))
		$tmp_text = isset($$attr9_var)?$$attr9_var:'?'.$attr9_var.'?';	
	elseif (!empty($attr9_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr9_raw);
	elseif (!empty($attr9_value))
		$tmp_text = $attr9_value;
	else
	  $tmp_text = '&nbsp;';
	if	( $attr9_escape && empty($attr9_raw) && $tmp_text!='&nbsp;' )
		$tmp_text = htmlentities($tmp_text);
	if	( !empty($attr9_maxlength) && intval($attr9_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr9_maxlength) );
	if	(isset($attr9_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr9_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr9) ?><?php unset($attr9_class) ?><?php unset($attr9_key) ?><?php unset($attr9_escape) ?><?php $attr7_debug_info = 'a:0:{}' ?><?php $attr7 = array() ?><?php } ?><?php unset($attr7) ?><?php $attr6_debug_info = 'a:0:{}' ?><?php $attr6 = array() ?><?php } ?><?php unset($attr6) ?><?php $attr7_debug_info = 'a:1:{s:3:"var";s:8:"username";}' ?><?php $attr7 = array('var'=>'username') ?><?php $attr7_var='username' ?><?php
	if (!isset($attr7_value))
		unset($$attr7_var);
	elseif (isset($attr7_key))
		$$attr7_var = $attr7_value[$attr7_key];
	else
		$$attr7_var = $attr7_value;
?><?php unset($attr7) ?><?php unset($attr7_var) ?><?php $attr7_debug_info = 'a:1:{s:3:"var";s:9:"groupname";}' ?><?php $attr7 = array('var'=>'groupname') ?><?php $attr7_var='groupname' ?><?php
	if (!isset($attr7_value))
		unset($$attr7_var);
	elseif (isset($attr7_key))
		$$attr7_var = $attr7_value[$attr7_key];
	else
		$$attr7_var = $attr7_value;
?><?php unset($attr7) ?><?php unset($attr7_var) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr6_debug_info = 'a:0:{}' ?><?php $attr6 = array() ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr6_class))
		$attr6['class']=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr6_rowspan) )
		$attr6['width']=$column_widths[$cell_column_nr-1];
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php $attr7_debug_info = 'a:2:{s:5:"align";s:4:"left";s:4:"type";s:14:"var:objecttype";}' ?><?php $attr7 = array('align'=>'left','type'=>$objecttype) ?><?php $attr7_align='left' ?><?php $attr7_type=$objecttype ?><?php
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
?><img src="<?php echo $image_dir.$attr7_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr7_align ?>"><?php } ?><?php unset($attr7) ?><?php unset($attr7_align) ?><?php unset($attr7_type) ?><?php $attr7_debug_info = 'a:6:{s:5:"title";s:0:"";s:6:"target";s:4:"_top";s:5:"class";s:0:"";s:6:"action";s:5:"index";s:9:"subaction";s:6:"object";s:2:"id";s:12:"var:objectid";}' ?><?php $attr7 = array('title'=>'','target'=>'_top','class'=>'','action'=>'index','subaction'=>'object','id'=>$objectid) ?><?php $attr7_title='' ?><?php $attr7_target='_top' ?><?php $attr7_class='' ?><?php $attr7_action='index' ?><?php $attr7_subaction='object' ?><?php $attr7_id=$objectid ?><?php
	$params = array();
	if (!empty($attr7_var1) && isset($attr7_value1))
		$params[$attr7_var1]=$attr7_value1;
	if (!empty($attr7_var2) && isset($attr7_value2))
		$params[$attr7_var2]=$attr7_value2;
	if (!empty($attr7_var3) && isset($attr7_value3))
		$params[$attr7_var3]=$attr7_value3;
	if (!empty($attr7_var4) && isset($attr7_value4))
		$params[$attr7_var4]=$attr7_value4;
	if (!empty($attr7_var5) && isset($attr7_value5))
		$params[$attr7_var5]=$attr7_value5;
	if(empty($attr7_class))
		$attr7_class='';
	if(empty($attr7_title))
		$attr7_title = '';
	if(!empty($attr7_url))
		$tmp_url = $attr7_url;
	else
		$tmp_url = Html::url($attr7_action,$attr7_subaction,!empty($attr7_id)?$attr7_id:$this->getRequestId(),$params);
?><a href="<?php echo $tmp_url ?>" class="<?php echo $attr7_class ?>" target="<?php echo $attr7_target ?>"<?php if (isset($attr7_accesskey)) echo ' accesskey="'.$attr7_accesskey.'"' ?>  title="<?php echo $attr7_title ?>"><?php unset($attr7) ?><?php unset($attr7_title) ?><?php unset($attr7_target) ?><?php unset($attr7_class) ?><?php unset($attr7_action) ?><?php unset($attr7_subaction) ?><?php unset($attr7_id) ?><?php $attr8_debug_info = 'a:4:{s:5:"class";s:4:"text";s:3:"var";s:10:"objectname";s:9:"maxlength";s:2:"20";s:6:"escape";s:4:"true";}' ?><?php $attr8 = array('class'=>'text','var'=>'objectname','maxlength'=>'20','escape'=>true) ?><?php $attr8_class='text' ?><?php $attr8_var='objectname' ?><?php $attr8_maxlength='20' ?><?php $attr8_escape=true ?><?php
	if	( isset($attr8_prefix)&& isset($attr8_key))
		$attr8_key = $attr8_prefix.$attr8_key;
	if	( isset($attr8_suffix)&& isset($attr8_key))
		$attr8_key = $attr8_key.$attr8_suffix;
	if(empty($attr8_title))
		if (!empty($attr8_key))
			$attr8_title = lang($attr8_key.'_HELP');
		else
			$attr8_title = '';
	if	(empty($attr8_type))
		$tmp_tag = 'span';
	else
		switch( $attr8_type )
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
?><<?php echo $tmp_tag ?> class="<?php echo $attr8_class ?>" title="<?php echo $attr8_title ?>"><?php
	$attr8_title = '';
	if (!empty($attr8_array))
	{
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
		$tmp_text = isset($$attr8_var)?$$attr8_var:'?'.$attr8_var.'?';	
	elseif (!empty($attr8_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr8_raw);
	elseif (!empty($attr8_value))
		$tmp_text = $attr8_value;
	else
	  $tmp_text = '&nbsp;';
	if	( $attr8_escape && empty($attr8_raw) && $tmp_text!='&nbsp;' )
		$tmp_text = htmlentities($tmp_text);
	if	( !empty($attr8_maxlength) && intval($attr8_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr8_maxlength) );
	if	(isset($attr8_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr8_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_var) ?><?php unset($attr8_maxlength) ?><?php unset($attr8_escape) ?><?php $attr6_debug_info = 'a:0:{}' ?><?php $attr6 = array() ?></a><?php unset($attr6) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr6_debug_info = 'a:0:{}' ?><?php $attr6 = array() ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr6_class))
		$attr6['class']=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr6_rowspan) )
		$attr6['width']=$column_widths[$cell_column_nr-1];
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php $attr7_debug_info = 'a:4:{s:5:"class";s:4:"text";s:4:"text";s:16:"var:languagename";s:9:"maxlength";s:2:"20";s:6:"escape";s:4:"true";}' ?><?php $attr7 = array('class'=>'text','text'=>$languagename,'maxlength'=>'20','escape'=>true) ?><?php $attr7_class='text' ?><?php $attr7_text=$languagename ?><?php $attr7_maxlength='20' ?><?php $attr7_escape=true ?><?php
	if	( isset($attr7_prefix)&& isset($attr7_key))
		$attr7_key = $attr7_prefix.$attr7_key;
	if	( isset($attr7_suffix)&& isset($attr7_key))
		$attr7_key = $attr7_key.$attr7_suffix;
	if(empty($attr7_title))
		if (!empty($attr7_key))
			$attr7_title = lang($attr7_key.'_HELP');
		else
			$attr7_title = '';
	if	(empty($attr7_type))
		$tmp_tag = 'span';
	else
		switch( $attr7_type )
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
?><<?php echo $tmp_tag ?> class="<?php echo $attr7_class ?>" title="<?php echo $attr7_title ?>"><?php
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
		$tmp_text = isset($$attr7_var)?$$attr7_var:'?'.$attr7_var.'?';	
	elseif (!empty($attr7_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr7_raw);
	elseif (!empty($attr7_value))
		$tmp_text = $attr7_value;
	else
	  $tmp_text = '&nbsp;';
	if	( $attr7_escape && empty($attr7_raw) && $tmp_text!='&nbsp;' )
		$tmp_text = htmlentities($tmp_text);
	if	( !empty($attr7_maxlength) && intval($attr7_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr7_maxlength) );
	if	(isset($attr7_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr7_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_text) ?><?php unset($attr7_maxlength) ?><?php unset($attr7_escape) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr6_debug_info = 'a:4:{s:4:"list";s:4:"show";s:7:"extract";s:5:"false";s:3:"key";s:8:"list_key";s:5:"value";s:10:"list_value";}' ?><?php $attr6 = array('list'=>'show','extract'=>false,'key'=>'list_key','value'=>'list_value') ?><?php $attr6_list='show' ?><?php $attr6_extract=false ?><?php $attr6_key='list_key' ?><?php $attr6_value='list_value' ?><?php
	$attr6_list_tmp_key   = $attr6_key;
	$attr6_list_tmp_value = $attr6_value;
	$attr6_list_extract   = $attr6_extract;
	unset($attr6_key);
	unset($attr6_value);
	if	( !isset($$attr6_list) || !is_array($$attr6_list) )
		$$attr6_list = array();
	foreach( $$attr6_list as $$attr6_list_tmp_key => $$attr6_list_tmp_value )
	{
		if	( $attr6_list_extract )
		{
			if	( !is_array($$attr6_list_tmp_value) )
			{
				print_r($$attr6_list_tmp_value);
				die( 'not an array at key: '.$$attr6_list_tmp_key );
			}
			extract($$attr6_list_tmp_value);
		}
?><?php unset($attr6) ?><?php unset($attr6_list) ?><?php unset($attr6_extract) ?><?php unset($attr6_key) ?><?php unset($attr6_value) ?><?php $attr7_debug_info = 'a:0:{}' ?><?php $attr7 = array() ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr7_class))
		$attr7['class']=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr7_rowspan) )
		$attr7['width']=$column_widths[$cell_column_nr-1];
?><td <?php foreach( $attr7 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr7) ?><?php $attr8_debug_info = 'a:3:{s:3:"var";s:14:"var:list_value";s:5:"value";s:8:"var:bits";s:3:"key";s:14:"var:list_value";}' ?><?php $attr8 = array('var'=>$list_value,'value'=>$bits,'key'=>$list_value) ?><?php $attr8_var=$list_value ?><?php $attr8_value=$bits ?><?php $attr8_key=$list_value ?><?php
	if (!isset($attr8_value))
		unset($$attr8_var);
	elseif (isset($attr8_key))
		$$attr8_var = $attr8_value[$attr8_key];
	else
		$$attr8_var = $attr8_value;
?><?php unset($attr8) ?><?php unset($attr8_var) ?><?php unset($attr8_value) ?><?php unset($attr8_key) ?><?php $attr8_debug_info = 'a:3:{s:7:"default";s:5:"false";s:8:"readonly";s:4:"true";s:4:"name";s:14:"var:list_value";}' ?><?php $attr8 = array('default'=>false,'readonly'=>true,'name'=>$list_value) ?><?php $attr8_default=false ?><?php $attr8_readonly=true ?><?php $attr8_name=$list_value ?><?php
	if	( isset($$attr8_name) )
		$checked = $$attr8_name;
	else
		$checked = $attr8_default;
?><input type="checkbox" id="id_<?php echo $attr8_name ?>" name="<?php echo $attr8_name  ?>"  <?php if ($attr8_readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?><?php if (in_array($attr8_name,$errors)) echo ' style="background-color:red;"' ?> /><?php
if ( $attr8_readonly && $checked )
{ 
?><input type="hidden" name="<?php echo $attr8_name ?>" value="1" /><?php
}
?><?php unset($attr8_name); unset($attr8_readonly); unset($attr8_default); ?><?php unset($attr8) ?><?php unset($attr8_default) ?><?php unset($attr8_readonly) ?><?php unset($attr8_name) ?><?php $attr6_debug_info = 'a:0:{}' ?><?php $attr6 = array() ?></td><?php unset($attr6) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?><?php } ?><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php } ?><?php unset($attr3) ?><?php $attr2_debug_info = 'a:0:{}' ?><?php $attr2 = array() ?><?php } ?><?php unset($attr2) ?><?php $attr1_debug_info = 'a:0:{}' ?><?php $attr1 = array() ?>      </table>
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