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
<?php unset($attr1) ?><?php unset($attr1_class) ?><?php $attr2_debug_info = 'a:4:{s:4:"name";s:0:"";s:6:"target";s:5:"_self";s:6:"method";s:4:"post";s:7:"enctype";s:33:"application/x-www-form-urlencoded";}' ?><?php $attr2 = array('name'=>'','target'=>'_self','method'=>'post','enctype'=>'application/x-www-form-urlencoded') ?><?php $attr2_name='' ?><?php $attr2_target='_self' ?><?php $attr2_method='post' ?><?php $attr2_enctype='application/x-www-form-urlencoded' ?><?php
	if	(empty($attr2_action))
		$attr2_action = $actionName;
	if	(empty($attr2_subaction))
		$attr2_subaction = $targetSubActionName;
	if	(empty($attr2_id))
		$attr2_id = $this->getRequestId();
?><form name="<?php echo $attr2_name ?>"
      target="<?php echo $attr2_target ?>"
      action="<?php echo Html::url( $attr2_action,$attr2_subaction,$attr2_id ) ?>"
      method="<?php echo $attr2_method ?>"
      enctype="<?php echo $attr2_enctype ?>" style="margin:0px;padding:0px;">
<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo $attr2_action ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo $attr2_subaction ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo $attr2_id ?>" /><?php
		if	( $conf['interface']['url_sessionid'] )
			echo '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";
?><?php unset($attr2) ?><?php unset($attr2_name) ?><?php unset($attr2_target) ?><?php unset($attr2_method) ?><?php unset($attr2_enctype) ?><?php $attr3_debug_info = 'a:3:{s:5:"width";s:3:"93%";s:10:"rowclasses";s:8:"odd,even";s:13:"columnclasses";s:5:"1,2,3";}' ?><?php $attr3 = array('width'=>'93%','rowclasses'=>'odd,even','columnclasses'=>'1,2,3') ?><?php $attr3_width='93%' ?><?php $attr3_rowclasses='odd,even' ?><?php $attr3_columnclasses='1,2,3' ?><?php
	$coloumn_widths=array();
	if	(!empty($attr3_widths))
	{
		$column_widths = explode(',',$attr3_widths);
		unset($attr3['widths']);
	}
	if	(!empty($attr3_rowclasses))
	{
		$row_classes   = explode(',',$attr3_rowclasses);
		$row_class_idx = 999;
		unset($attr3['rowclasses']);
	}
	if	(!empty($attr3_columnclasses))
	{
		$column_classes = explode(',',$attr3_columnclasses);
		unset($attr3['columnclasses']);
	}
		global $image_dir;
		if (@$conf['interface']['application_mode'] )
		{
			echo '<table class="main" cellspacing="0" cellpadding="4" width="100%" style="margin:0px;border:0px; padding:0px;" height_oo="100%">';
		}
		else
		{
			echo '<br/><br/><br/><center>';
			echo '<table class="main" cellspacing="0" cellpadding="4" width="'.$attr3_width.'">';
		}
		if (!@$conf['interface']['application_mode'] )
		{
		echo '<tr><td class="menu">';
		if	( !empty($attr3_icon) )
			echo '<img src="'.$image_dir.'icon_'.$attr3_icon.IMG_ICON_EXT.'" align="left" border="0">';
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
    <?php if (!empty($notice['log'])) { ?><pre><?php echo htmlentities(implode("\n",$notice['log'])) ?></pre><?php } ?>
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
      <table class="n" cellspacing="0" width="100%" cellpadding="4"><?php unset($attr3) ?><?php unset($attr3_width) ?><?php unset($attr3_rowclasses) ?><?php unset($attr3_columnclasses) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];
	if (empty($attr4_class))
		$attr4_class=$row_class;
	global $cell_column_nr;
	$cell_column_nr=0;
	$column_class_idx = 999;
?><tr class="<?php echo $attr4_class ?>"><?php unset($attr4) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?><?php
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
?><td <?php foreach( $attr5 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr5) ?><?php $attr6_debug_info = 'a:1:{s:7:"present";s:5:"pages";}' ?><?php $attr6 = array('present'=>'pages') ?><?php $attr6_present='pages' ?><?php 
	if	( isset($attr6_true) )
	{
		if	(gettype($attr6_true) === '' && gettype($attr6_true) === '1')
			$exec = $$attr6_true == true;
		else
			$exec = $attr6_true == true;
	}
	elseif	( isset($attr6_false) )
	{
		if	(gettype($attr6_false) === '' && gettype($attr6_false) === '1')
			$exec = $$attr6_false == false;
		else
			$exec = $attr6_false == false;
	}
	elseif( isset($attr6_contains) )
		$exec = in_array($attr6_value,explode(',',$attr6_contains));
	elseif( isset($attr6_equals)&& isset($attr6_value) )
		$exec = $attr6_equals == $attr6_value;
	elseif( isset($attr6_lessthan)&& isset($attr6_value) )
		$exec = intval($attr6_lessthan) > intval($attr6_value);
	elseif( isset($attr6_greaterthan)&& isset($attr6_value) )
		$exec = intval($attr6_greaterthan) < intval($attr6_value);
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
	elseif	( isset($attr6_present) )
	{
		$exec = isset($$attr6_present);
	}
	else
	{
		trigger_error("error in IF, assume: FALSE");
		$exec = false;
	}
	if  ( !empty($attr6_invert) )
		$exec = !$exec;
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
?>
<?php unset($attr6) ?><?php unset($attr6_present) ?><?php $attr7_debug_info = 'a:1:{s:7:"present";s:7:"subdirs";}' ?><?php $attr7 = array('present'=>'subdirs') ?><?php $attr7_present='subdirs' ?><?php 
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
<?php unset($attr7) ?><?php unset($attr7_present) ?><?php $attr8_debug_info = 'a:3:{s:7:"default";s:5:"false";s:8:"readonly";s:5:"false";s:4:"name";s:5:"pages";}' ?><?php $attr8 = array('default'=>false,'readonly'=>false,'name'=>'pages') ?><?php $attr8_default=false ?><?php $attr8_readonly=false ?><?php $attr8_name='pages' ?><?php
	if	( isset($$attr8_name) )
		$checked = $$attr8_name;
	else
		$checked = $attr8_default;
?><input type="checkbox" id="id_<?php echo $attr8_name ?>" name="<?php echo $attr8_name  ?>"  <?php if ($attr8_readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?><?php if (in_array($attr8_name,$errors)) echo ' style="background-color:red;"' ?> /><?php
if ( $attr8_readonly && $checked )
{ 
?><input type="hidden" name="<?php echo $attr8_name ?>" value="1" /><?php
}
?><?php unset($attr8_name); unset($attr8_readonly); unset($attr8_default); ?><?php unset($attr8) ?><?php unset($attr8_default) ?><?php unset($attr8_readonly) ?><?php unset($attr8_name) ?><?php $attr8_debug_info = 'a:1:{s:3:"for";s:5:"pages";}' ?><?php $attr8 = array('for'=>'pages') ?><?php $attr8_for='pages' ?><label for="id_<?php echo $attr8_for ?><?php if (!empty($attr8_value)) echo '_'.$attr8_value ?>"><?php unset($attr8) ?><?php unset($attr8_for) ?><?php $attr9_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"raw";s:1:"_";s:6:"escape";s:4:"true";}' ?><?php $attr9 = array('class'=>'text','raw'=>'_','escape'=>true) ?><?php $attr9_class='text' ?><?php $attr9_raw='_' ?><?php $attr9_escape=true ?><?php
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
?></<?php echo $tmp_tag ?>><?php unset($attr9) ?><?php unset($attr9_class) ?><?php unset($attr9_raw) ?><?php unset($attr9_escape) ?><?php $attr9_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:12:"global_pages";s:6:"escape";s:4:"true";}' ?><?php $attr9 = array('class'=>'text','text'=>'global_pages','escape'=>true) ?><?php $attr9_class='text' ?><?php $attr9_text='global_pages' ?><?php $attr9_escape=true ?><?php
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
?></<?php echo $tmp_tag ?>><?php unset($attr9) ?><?php unset($attr9_class) ?><?php unset($attr9_text) ?><?php unset($attr9_escape) ?><?php $attr7_debug_info = 'a:0:{}' ?><?php $attr7 = array() ?></label><?php unset($attr7) ?><?php $attr8_debug_info = 'a:0:{}' ?><?php $attr8 = array() ?><br/><?php unset($attr8) ?><?php $attr6_debug_info = 'a:0:{}' ?><?php $attr6 = array() ?><?php } ?><?php unset($attr6) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?><?php } ?><?php unset($attr5) ?><?php $attr6_debug_info = 'a:1:{s:7:"present";s:5:"files";}' ?><?php $attr6 = array('present'=>'files') ?><?php $attr6_present='files' ?><?php 
	if	( isset($attr6_true) )
	{
		if	(gettype($attr6_true) === '' && gettype($attr6_true) === '1')
			$exec = $$attr6_true == true;
		else
			$exec = $attr6_true == true;
	}
	elseif	( isset($attr6_false) )
	{
		if	(gettype($attr6_false) === '' && gettype($attr6_false) === '1')
			$exec = $$attr6_false == false;
		else
			$exec = $attr6_false == false;
	}
	elseif( isset($attr6_contains) )
		$exec = in_array($attr6_value,explode(',',$attr6_contains));
	elseif( isset($attr6_equals)&& isset($attr6_value) )
		$exec = $attr6_equals == $attr6_value;
	elseif( isset($attr6_lessthan)&& isset($attr6_value) )
		$exec = intval($attr6_lessthan) > intval($attr6_value);
	elseif( isset($attr6_greaterthan)&& isset($attr6_value) )
		$exec = intval($attr6_greaterthan) < intval($attr6_value);
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
	elseif	( isset($attr6_present) )
	{
		$exec = isset($$attr6_present);
	}
	else
	{
		trigger_error("error in IF, assume: FALSE");
		$exec = false;
	}
	if  ( !empty($attr6_invert) )
		$exec = !$exec;
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
?>
<?php unset($attr6) ?><?php unset($attr6_present) ?><?php $attr7_debug_info = 'a:1:{s:4:"true";s:7:"subdirs";}' ?><?php $attr7 = array('true'=>'subdirs') ?><?php $attr7_true='subdirs' ?><?php 
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
<?php unset($attr7) ?><?php unset($attr7_true) ?><?php $attr8_debug_info = 'a:3:{s:7:"default";s:5:"false";s:8:"readonly";s:5:"false";s:4:"name";s:5:"files";}' ?><?php $attr8 = array('default'=>false,'readonly'=>false,'name'=>'files') ?><?php $attr8_default=false ?><?php $attr8_readonly=false ?><?php $attr8_name='files' ?><?php
	if	( isset($$attr8_name) )
		$checked = $$attr8_name;
	else
		$checked = $attr8_default;
?><input type="checkbox" id="id_<?php echo $attr8_name ?>" name="<?php echo $attr8_name  ?>"  <?php if ($attr8_readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?><?php if (in_array($attr8_name,$errors)) echo ' style="background-color:red;"' ?> /><?php
if ( $attr8_readonly && $checked )
{ 
?><input type="hidden" name="<?php echo $attr8_name ?>" value="1" /><?php
}
?><?php unset($attr8_name); unset($attr8_readonly); unset($attr8_default); ?><?php unset($attr8) ?><?php unset($attr8_default) ?><?php unset($attr8_readonly) ?><?php unset($attr8_name) ?><?php $attr8_debug_info = 'a:1:{s:3:"for";s:5:"files";}' ?><?php $attr8 = array('for'=>'files') ?><?php $attr8_for='files' ?><label for="id_<?php echo $attr8_for ?><?php if (!empty($attr8_value)) echo '_'.$attr8_value ?>"><?php unset($attr8) ?><?php unset($attr8_for) ?><?php $attr9_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"raw";s:1:"_";s:6:"escape";s:4:"true";}' ?><?php $attr9 = array('class'=>'text','raw'=>'_','escape'=>true) ?><?php $attr9_class='text' ?><?php $attr9_raw='_' ?><?php $attr9_escape=true ?><?php
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
?></<?php echo $tmp_tag ?>><?php unset($attr9) ?><?php unset($attr9_class) ?><?php unset($attr9_raw) ?><?php unset($attr9_escape) ?><?php $attr9_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:12:"global_files";s:6:"escape";s:4:"true";}' ?><?php $attr9 = array('class'=>'text','text'=>'global_files','escape'=>true) ?><?php $attr9_class='text' ?><?php $attr9_text='global_files' ?><?php $attr9_escape=true ?><?php
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
?></<?php echo $tmp_tag ?>><?php unset($attr9) ?><?php unset($attr9_class) ?><?php unset($attr9_text) ?><?php unset($attr9_escape) ?><?php $attr7_debug_info = 'a:0:{}' ?><?php $attr7 = array() ?></label><?php unset($attr7) ?><?php $attr8_debug_info = 'a:0:{}' ?><?php $attr8 = array() ?><br/><?php unset($attr8) ?><?php $attr6_debug_info = 'a:0:{}' ?><?php $attr6 = array() ?><?php } ?><?php unset($attr6) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?><?php } ?><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></td><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?></tr><?php unset($attr3) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];
	if (empty($attr4_class))
		$attr4_class=$row_class;
	global $cell_column_nr;
	$cell_column_nr=0;
	$column_class_idx = 999;
?><tr class="<?php echo $attr4_class ?>"><?php unset($attr4) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?><?php
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
?><td <?php foreach( $attr5 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr5) ?><?php $attr6_debug_info = 'a:1:{s:5:"title";s:15:"message:options";}' ?><?php $attr6 = array('title'=>lang('options')) ?><?php $attr6_title=lang('options') ?><fieldset><?php if(isset($attr6_title)) { ?><legend><?php echo $attr6_title ?></legend><?php } ?><?php unset($attr6) ?><?php unset($attr6_title) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></fieldset><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></td><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?></tr><?php unset($attr3) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];
	if (empty($attr4_class))
		$attr4_class=$row_class;
	global $cell_column_nr;
	$cell_column_nr=0;
	$column_class_idx = 999;
?><tr class="<?php echo $attr4_class ?>"><?php unset($attr4) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?><?php
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
?><td <?php foreach( $attr5 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr5) ?><?php $attr6_debug_info = 'a:1:{s:7:"present";s:7:"subdirs";}' ?><?php $attr6 = array('present'=>'subdirs') ?><?php $attr6_present='subdirs' ?><?php 
	if	( isset($attr6_true) )
	{
		if	(gettype($attr6_true) === '' && gettype($attr6_true) === '1')
			$exec = $$attr6_true == true;
		else
			$exec = $attr6_true == true;
	}
	elseif	( isset($attr6_false) )
	{
		if	(gettype($attr6_false) === '' && gettype($attr6_false) === '1')
			$exec = $$attr6_false == false;
		else
			$exec = $attr6_false == false;
	}
	elseif( isset($attr6_contains) )
		$exec = in_array($attr6_value,explode(',',$attr6_contains));
	elseif( isset($attr6_equals)&& isset($attr6_value) )
		$exec = $attr6_equals == $attr6_value;
	elseif( isset($attr6_lessthan)&& isset($attr6_value) )
		$exec = intval($attr6_lessthan) > intval($attr6_value);
	elseif( isset($attr6_greaterthan)&& isset($attr6_value) )
		$exec = intval($attr6_greaterthan) < intval($attr6_value);
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
	elseif	( isset($attr6_present) )
	{
		$exec = isset($$attr6_present);
	}
	else
	{
		trigger_error("error in IF, assume: FALSE");
		$exec = false;
	}
	if  ( !empty($attr6_invert) )
		$exec = !$exec;
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
?>
<?php unset($attr6) ?><?php unset($attr6_present) ?><?php $attr7_debug_info = 'a:3:{s:7:"default";s:5:"false";s:8:"readonly";s:5:"false";s:4:"name";s:7:"subdirs";}' ?><?php $attr7 = array('default'=>false,'readonly'=>false,'name'=>'subdirs') ?><?php $attr7_default=false ?><?php $attr7_readonly=false ?><?php $attr7_name='subdirs' ?><?php
	if	( isset($$attr7_name) )
		$checked = $$attr7_name;
	else
		$checked = $attr7_default;
?><input type="checkbox" id="id_<?php echo $attr7_name ?>" name="<?php echo $attr7_name  ?>"  <?php if ($attr7_readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?><?php if (in_array($attr7_name,$errors)) echo ' style="background-color:red;"' ?> /><?php
if ( $attr7_readonly && $checked )
{ 
?><input type="hidden" name="<?php echo $attr7_name ?>" value="1" /><?php
}
?><?php unset($attr7_name); unset($attr7_readonly); unset($attr7_default); ?><?php unset($attr7) ?><?php unset($attr7_default) ?><?php unset($attr7_readonly) ?><?php unset($attr7_name) ?><?php $attr7_debug_info = 'a:1:{s:3:"for";s:7:"subdirs";}' ?><?php $attr7 = array('for'=>'subdirs') ?><?php $attr7_for='subdirs' ?><label for="id_<?php echo $attr7_for ?><?php if (!empty($attr7_value)) echo '_'.$attr7_value ?>"><?php unset($attr7) ?><?php unset($attr7_for) ?><?php $attr8_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"raw";s:1:"_";s:6:"escape";s:4:"true";}' ?><?php $attr8 = array('class'=>'text','raw'=>'_','escape'=>true) ?><?php $attr8_class='text' ?><?php $attr8_raw='_' ?><?php $attr8_escape=true ?><?php
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
?></<?php echo $tmp_tag ?>><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_raw) ?><?php unset($attr8_escape) ?><?php $attr8_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:27:"GLOBAL_PUBLISH_WITH_SUBDIRS";s:6:"escape";s:4:"true";}' ?><?php $attr8 = array('class'=>'text','text'=>'GLOBAL_PUBLISH_WITH_SUBDIRS','escape'=>true) ?><?php $attr8_class='text' ?><?php $attr8_text='GLOBAL_PUBLISH_WITH_SUBDIRS' ?><?php $attr8_escape=true ?><?php
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
?></<?php echo $tmp_tag ?>><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_text) ?><?php unset($attr8_escape) ?><?php $attr6_debug_info = 'a:0:{}' ?><?php $attr6 = array() ?></label><?php unset($attr6) ?><?php $attr7_debug_info = 'a:0:{}' ?><?php $attr7 = array() ?><br/><?php unset($attr7) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?><?php } ?><?php unset($attr5) ?><?php $attr6_debug_info = 'a:1:{s:7:"present";s:5:"clean";}' ?><?php $attr6 = array('present'=>'clean') ?><?php $attr6_present='clean' ?><?php 
	if	( isset($attr6_true) )
	{
		if	(gettype($attr6_true) === '' && gettype($attr6_true) === '1')
			$exec = $$attr6_true == true;
		else
			$exec = $attr6_true == true;
	}
	elseif	( isset($attr6_false) )
	{
		if	(gettype($attr6_false) === '' && gettype($attr6_false) === '1')
			$exec = $$attr6_false == false;
		else
			$exec = $attr6_false == false;
	}
	elseif( isset($attr6_contains) )
		$exec = in_array($attr6_value,explode(',',$attr6_contains));
	elseif( isset($attr6_equals)&& isset($attr6_value) )
		$exec = $attr6_equals == $attr6_value;
	elseif( isset($attr6_lessthan)&& isset($attr6_value) )
		$exec = intval($attr6_lessthan) > intval($attr6_value);
	elseif( isset($attr6_greaterthan)&& isset($attr6_value) )
		$exec = intval($attr6_greaterthan) < intval($attr6_value);
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
	elseif	( isset($attr6_present) )
	{
		$exec = isset($$attr6_present);
	}
	else
	{
		trigger_error("error in IF, assume: FALSE");
		$exec = false;
	}
	if  ( !empty($attr6_invert) )
		$exec = !$exec;
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
?>
<?php unset($attr6) ?><?php unset($attr6_present) ?><?php $attr7_debug_info = 'a:3:{s:7:"default";s:5:"false";s:8:"readonly";s:5:"false";s:4:"name";s:5:"clean";}' ?><?php $attr7 = array('default'=>false,'readonly'=>false,'name'=>'clean') ?><?php $attr7_default=false ?><?php $attr7_readonly=false ?><?php $attr7_name='clean' ?><?php
	if	( isset($$attr7_name) )
		$checked = $$attr7_name;
	else
		$checked = $attr7_default;
?><input type="checkbox" id="id_<?php echo $attr7_name ?>" name="<?php echo $attr7_name  ?>"  <?php if ($attr7_readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?><?php if (in_array($attr7_name,$errors)) echo ' style="background-color:red;"' ?> /><?php
if ( $attr7_readonly && $checked )
{ 
?><input type="hidden" name="<?php echo $attr7_name ?>" value="1" /><?php
}
?><?php unset($attr7_name); unset($attr7_readonly); unset($attr7_default); ?><?php unset($attr7) ?><?php unset($attr7_default) ?><?php unset($attr7_readonly) ?><?php unset($attr7_name) ?><?php $attr7_debug_info = 'a:1:{s:3:"for";s:5:"clean";}' ?><?php $attr7 = array('for'=>'clean') ?><?php $attr7_for='clean' ?><label for="id_<?php echo $attr7_for ?><?php if (!empty($attr7_value)) echo '_'.$attr7_value ?>"><?php unset($attr7) ?><?php unset($attr7_for) ?><?php $attr8_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"raw";s:1:"_";s:6:"escape";s:4:"true";}' ?><?php $attr8 = array('class'=>'text','raw'=>'_','escape'=>true) ?><?php $attr8_class='text' ?><?php $attr8_raw='_' ?><?php $attr8_escape=true ?><?php
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
?></<?php echo $tmp_tag ?>><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_raw) ?><?php unset($attr8_escape) ?><?php $attr8_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:26:"global_CLEAN_AFTER_PUBLISH";s:6:"escape";s:4:"true";}' ?><?php $attr8 = array('class'=>'text','text'=>'global_CLEAN_AFTER_PUBLISH','escape'=>true) ?><?php $attr8_class='text' ?><?php $attr8_text='global_CLEAN_AFTER_PUBLISH' ?><?php $attr8_escape=true ?><?php
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
?></<?php echo $tmp_tag ?>><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_text) ?><?php unset($attr8_escape) ?><?php $attr6_debug_info = 'a:0:{}' ?><?php $attr6 = array() ?></label><?php unset($attr6) ?><?php $attr7_debug_info = 'a:0:{}' ?><?php $attr7 = array() ?><br/><?php unset($attr7) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?><?php } ?><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></td><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?></tr><?php unset($attr3) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];
	if (empty($attr4_class))
		$attr4_class=$row_class;
	global $cell_column_nr;
	$cell_column_nr=0;
	$column_class_idx = 999;
?><tr class="<?php echo $attr4_class ?>"><?php unset($attr4) ?><?php $attr5_debug_info = 'a:1:{s:5:"class";s:4:"help";}' ?><?php $attr5 = array('class'=>'help') ?><?php $attr5_class='help' ?><?php
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
?><td <?php foreach( $attr5 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr5) ?><?php unset($attr5_class) ?><?php $attr6_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:16:"GLOBAL_MUCH_TIME";s:6:"escape";s:4:"true";}' ?><?php $attr6 = array('class'=>'text','text'=>'GLOBAL_MUCH_TIME','escape'=>true) ?><?php $attr6_class='text' ?><?php $attr6_text='GLOBAL_MUCH_TIME' ?><?php $attr6_escape=true ?><?php
	if	( isset($attr6_prefix)&& isset($attr6_key))
		$attr6_key = $attr6_prefix.$attr6_key;
	if	( isset($attr6_suffix)&& isset($attr6_key))
		$attr6_key = $attr6_key.$attr6_suffix;
	if(empty($attr6_title))
		if (!empty($attr6_key))
			$attr6_title = lang($attr6_key.'_HELP');
		else
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
		$tmp_text = isset($$attr6_var)?$$attr6_var:'?'.$attr6_var.'?';	
	elseif (!empty($attr6_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr6_raw);
	elseif (!empty($attr6_value))
		$tmp_text = $attr6_value;
	else
	  $tmp_text = '&nbsp;';
	if	( $attr6_escape && empty($attr6_raw) && $tmp_text!='&nbsp;' )
		$tmp_text = htmlentities($tmp_text);
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
?></<?php echo $tmp_tag ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_text) ?><?php unset($attr6_escape) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></td><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?></tr><?php unset($attr3) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];
	if (empty($attr4_class))
		$attr4_class=$row_class;
	global $cell_column_nr;
	$cell_column_nr=0;
	$column_class_idx = 999;
?><tr class="<?php echo $attr4_class ?>"><?php unset($attr4) ?><?php $attr5_debug_info = 'a:1:{s:5:"class";s:3:"act";}' ?><?php $attr5 = array('class'=>'act') ?><?php $attr5_class='act' ?><?php
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
?><td <?php foreach( $attr5 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr5) ?><?php unset($attr5_class) ?><?php $attr6_debug_info = 'a:4:{s:4:"type";s:2:"ok";s:5:"class";s:2:"ok";s:5:"value";s:2:"ok";s:4:"text";s:9:"button_ok";}' ?><?php $attr6 = array('type'=>'ok','class'=>'ok','value'=>'ok','text'=>'button_ok') ?><?php $attr6_type='ok' ?><?php $attr6_class='ok' ?><?php $attr6_value='ok' ?><?php $attr6_text='button_ok' ?><?php
	if ($attr6_type=='ok')
		$attr6_type  = 'submit';
	if (isset($attr6_src))
		$attr6_type  = 'image';
	else
		$attr6_src  = '';
?><input type="<?php echo $attr6_type ?>"<?php if(isset($attr6_src)) { ?> src="<?php echo $image_dir.'icon_'.$attr6_src.IMG_ICON_EXT ?>"<?php } ?> name="<?php echo $attr6_value ?>" class="<?php echo $attr6_class ?>" title="<?php echo lang($attr6_text.'_DESC') ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo lang($attr6_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($attr6_src) ?><?php unset($attr6) ?><?php unset($attr6_type) ?><?php unset($attr6_class) ?><?php unset($attr6_value) ?><?php unset($attr6_text) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></td><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?></tr><?php unset($attr3) ?><?php $attr2_debug_info = 'a:0:{}' ?><?php $attr2 = array() ?>      </table>
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
<?php unset($attr2) ?><?php $attr1_debug_info = 'a:0:{}' ?><?php $attr1 = array() ?></form>
<?php unset($attr1) ?><?php $attr0_debug_info = 'a:0:{}' ?><?php $attr0 = array() ?></body>
</html><?php unset($attr0) ?>