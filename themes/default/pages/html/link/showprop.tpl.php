<?php $attr1_debug_info = 'a:1:{s:5:"class";s:4:"main";}' ?><?php $attr1 = array('class'=>'main') ?><?php $attr1_class='main' ?><?php
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
?><?php if(!empty($root_stylesheet)) { ?>
  <link rel="stylesheet" type="text/css" href="<?php echo $root_stylesheet ?>" />
<?php } ?>
<?php if($root_stylesheet!=$user_stylesheet) { ?>
  <link rel="stylesheet" type="text/css" href="<?php echo $user_stylesheet ?>" />
<?php } ?>
</head>
<body class="<?php echo $attr1_class ?>" <?php if (@$conf['interface']['application_mode']) { ?> style="padding:0px;margin:0px;"<?php } ?> >
<?php unset($attr1) ?><?php unset($attr1_class) ?><?php $attr2_debug_info = 'a:5:{s:4:"icon";s:4:"link";s:6:"widths";s:7:"40%,60%";s:5:"width";s:3:"70%";s:10:"rowclasses";s:8:"odd,even";s:13:"columnclasses";s:5:"1,2,3";}' ?><?php $attr2 = array('icon'=>'link','widths'=>'40%,60%','width'=>'70%','rowclasses'=>'odd,even','columnclasses'=>'1,2,3') ?><?php $attr2_icon='link' ?><?php $attr2_widths='40%,60%' ?><?php $attr2_width='70%' ?><?php $attr2_rowclasses='odd,even' ?><?php $attr2_columnclasses='1,2,3' ?><?php
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
		echo '<img src="'.$image_dir.'icon_'.$actionName.IMG_ICON_EXT.'" align="left" border="0">';
		if ($this->isEditable()) { ?>
  <?php if ($this->getRequestVar('mode')=='edit') { 
  ?><a href="<?php echo Html::url($actionName,$subActionName,$this->getRequestId()                       ) ?>" accesskey="1" title="<?php echo langHtml('MODE_EDIT_DESC') ?>" class="path" style="text-align:right;font-weight:bold;font-weight:bold;"><img src="<?php echo $image_dir ?>mode-edit.png" style="vertical-align:top; " border="0" /></a> <?php } else {
  ?><a href="<?php echo Html::url($actionName,$subActionName,$this->getRequestId(),array('mode'=>'edit') ) ?>" accesskey="1" title="<?php echo langHtml('MODE_SHOW_DESC') ?>" class="path" style="text-align:right;font-weight:bold;font-weight:bold;"><img src="<?php echo $image_dir ?>readonly.png" style="vertical-align:top; " border="0" /></a> <?php }
  ?><?php }
		echo '<span class="path">'.langHtml('GLOBAL_'.$actionName).'</span>&nbsp;<strong>&raquo;</strong>&nbsp;';
		if	( !isset($path) || is_array($path) )
			$path = array();
		foreach( $path as $pathElement)
		{
			extract($pathElement);
			echo '<a href="'.$url.'" class="path">'.langHtml($name).'</a>';
			echo '&nbsp;&raquo;&nbsp;';
		}
		echo '<span class="title">'.langHtml($windowTitle).'</span>';
		?>
		</td>
		<?php
		}
		?>
<?php ?>		<!--<td class="menu" style="align:right;">
    <?php if (isset($windowIcons)) foreach( $windowIcons as $icon )
          {
          	?><a href="<?php echo $icon['url'] ?>" title="<?php echo 'ICON_'.langHtml($menu['type'].'_DESC') ?>"><image border="0" src="<?php echo $image_dir.$icon['type'].IMG_ICON_EXT ?>"></a>&nbsp;<?php
          }
     ?>
    </td>-->
  </tr>
  <tr><td class="subaction">
    <?php if	( !isset($windowMenu) || !is_array($windowMenu) )
			$windowMenu = array();
    foreach( $windowMenu as $menu )
          {
          	$tmp_text = langHtml($menu['text']);
          	$tmp_key  = strtoupper(langHtml($menu['key' ]));
			$tmp_pos = strpos(strtolower($tmp_text),strtolower($tmp_key));
			if	( $tmp_pos !== false )
				$tmp_text = substr($tmp_text,0,max($tmp_pos,0)).'<span class="accesskey">'. substr($tmp_text,$tmp_pos,1).'</span>'.substr($tmp_text,$tmp_pos+1);
          	if	( isset($menu['url']) )
          	{
          		?><a href="<?php echo Html::url($actionName,$menu['subaction'],$this->getRequestId() ) ?>" accesskey="<?php echo $tmp_key ?>" title="<?php echo langHtml($menu['text'].'_DESC') ?>" class="menu<?php echo $this->subActionName==$menu['subaction']?'_highlight':'' ?>"><?php echo $tmp_text ?></a>&nbsp;&nbsp;&nbsp;<?php
          	}
          	else
          	{
          		?><span class="menu_disabled" title="<?php echo langHtml($menu['text'].'_DESC') ?>" class="menu_disabled"><?php echo $tmp_text ?></span>&nbsp;&nbsp;&nbsp;<?php
          	}
          }
          	if (@$conf['help']['enabled'] )
          	{
             ?><a href="<?php echo $conf['help']['url'].$actionName.'/'.$subActionName.@$conf['help']['suffix'] ?> " target="_new" title="<?php echo langHtml('MENU_HELP_DESC') ?>" class="menu" style="cursor:help;"><?php echo @$conf['help']['only_question_mark']?'?':langHtml('MENU_HELP') ?></a><?php
          	}
          	?></td>
  </tr>
<?php if (isset($notices) && count($notices)>0 )
      { ?>
  <tr>
    <td align="center" class="notice">
  <?php foreach( $notices as $notice_idx=>$notice ) { ?>
    	<br><table class="notice" width="80%">
  <?php if ($notice['name']!='') { ?>
  <tr>
    <td colspan="2" class="subaction" style="padding:2px; white-space:nowrap; border-bottom:1px solid black;"><img src="<?php echo $image_dir.'icon_'.$notice['type'].IMG_ICON_EXT ?>" align="left" /><?php echo $notice['name'] ?>
    </td>
  </tr>
<?php } ?>
  <tr class="notice_<?php echo $notice['status'] ?>">
    <td style="padding:10px;" width="30px"><img src="<?php echo $image_dir.'notice_'.$notice['status'].IMG_ICON_EXT ?>" style="padding:10px" /></td>
    <td style="padding:10px;padding-right:10px;padding-bottom:10px;"><?php if ($notice['status']=='error') { ?><strong><?php } ?><?php echo langHtml($notice['key'],$notice['vars']) ?><?php if ($notice['status']=='error') { ?></strong><?php } ?>
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
      <table class="n" cellspacing="0" width="100%" cellpadding="4">
<?php unset($attr2) ?><?php unset($attr2_icon) ?><?php unset($attr2_widths) ?><?php unset($attr2_width) ?><?php unset($attr2_rowclasses) ?><?php unset($attr2_columnclasses) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];
	if (empty($attr3_class))
		$attr3_class=$row_class;
	global $cell_column_nr;
	$cell_column_nr=0;
	$column_class_idx = 999;
?><tr class="<?php echo $attr3_class ?>"><?php unset($attr3) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?><?php
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
?><td <?php foreach( $attr4 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr4) ?><?php $attr5_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:11:"GLOBAL_name";s:6:"escape";s:4:"true";}' ?><?php $attr5 = array('class'=>'text','text'=>'GLOBAL_name','escape'=>true) ?><?php $attr5_class='text' ?><?php $attr5_text='GLOBAL_name' ?><?php $attr5_escape=true ?><?php
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
?></<?php echo $tmp_tag ?>><?php unset($attr5) ?><?php unset($attr5_class) ?><?php unset($attr5_text) ?><?php unset($attr5_escape) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?></td><?php unset($attr3) ?><?php $attr4_debug_info = 'a:1:{s:5:"class";s:4:"name";}' ?><?php $attr4 = array('class'=>'name') ?><?php $attr4_class='name' ?><?php
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
?><td <?php foreach( $attr4 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr4) ?><?php unset($attr4_class) ?><?php $attr5_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"var";s:4:"name";s:6:"escape";s:4:"true";}' ?><?php $attr5 = array('class'=>'text','var'=>'name','escape'=>true) ?><?php $attr5_class='text' ?><?php $attr5_var='name' ?><?php $attr5_escape=true ?><?php
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
?></<?php echo $tmp_tag ?>><?php unset($attr5) ?><?php unset($attr5_class) ?><?php unset($attr5_var) ?><?php unset($attr5_escape) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?></td><?php unset($attr3) ?><?php $attr2_debug_info = 'a:0:{}' ?><?php $attr2 = array() ?></tr><?php unset($attr2) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];
	if (empty($attr3_class))
		$attr3_class=$row_class;
	global $cell_column_nr;
	$cell_column_nr=0;
	$column_class_idx = 999;
?><tr class="<?php echo $attr3_class ?>"><?php unset($attr3) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?><?php
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
?><td <?php foreach( $attr4 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr4) ?><?php $attr5_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:18:"GLOBAL_description";s:6:"escape";s:4:"true";}' ?><?php $attr5 = array('class'=>'text','text'=>'GLOBAL_description','escape'=>true) ?><?php $attr5_class='text' ?><?php $attr5_text='GLOBAL_description' ?><?php $attr5_escape=true ?><?php
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
?></<?php echo $tmp_tag ?>><?php unset($attr5) ?><?php unset($attr5_class) ?><?php unset($attr5_text) ?><?php unset($attr5_escape) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?></td><?php unset($attr3) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?><?php
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
?><td <?php foreach( $attr4 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr4) ?><?php $attr5_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"var";s:11:"description";s:6:"escape";s:4:"true";}' ?><?php $attr5 = array('class'=>'text','var'=>'description','escape'=>true) ?><?php $attr5_class='text' ?><?php $attr5_var='description' ?><?php $attr5_escape=true ?><?php
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
?></<?php echo $tmp_tag ?>><?php unset($attr5) ?><?php unset($attr5_class) ?><?php unset($attr5_var) ?><?php unset($attr5_escape) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?></td><?php unset($attr3) ?><?php $attr2_debug_info = 'a:0:{}' ?><?php $attr2 = array() ?></tr><?php unset($attr2) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];
	if (empty($attr3_class))
		$attr3_class=$row_class;
	global $cell_column_nr;
	$cell_column_nr=0;
	$column_class_idx = 999;
?><tr class="<?php echo $attr3_class ?>"><?php unset($attr3) ?><?php $attr4_debug_info = 'a:1:{s:7:"colspan";s:1:"2";}' ?><?php $attr4 = array('colspan'=>'2') ?><?php $attr4_colspan='2' ?><?php
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
?><td <?php foreach( $attr4 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr4) ?><?php unset($attr4_colspan) ?><?php $attr5_debug_info = 'a:1:{s:5:"title";s:23:"message:additional_info";}' ?><?php $attr5 = array('title'=>lang('additional_info')) ?><?php $attr5_title=lang('additional_info') ?><fieldset><?php if(isset($attr5_title)) { ?><legend><?php echo encodeHtml($attr5_title) ?></legend><?php } ?><?php unset($attr5) ?><?php unset($attr5_title) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></fieldset><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?></td><?php unset($attr3) ?><?php $attr2_debug_info = 'a:0:{}' ?><?php $attr2 = array() ?></tr><?php unset($attr2) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];
	if (empty($attr3_class))
		$attr3_class=$row_class;
	global $cell_column_nr;
	$cell_column_nr=0;
	$column_class_idx = 999;
?><tr class="<?php echo $attr3_class ?>"><?php unset($attr3) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?><?php
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
?><td <?php foreach( $attr4 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr4) ?><?php $attr5_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"key";s:2:"id";s:6:"escape";s:4:"true";}' ?><?php $attr5 = array('class'=>'text','key'=>'id','escape'=>true) ?><?php $attr5_class='text' ?><?php $attr5_key='id' ?><?php $attr5_escape=true ?><?php
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
?></<?php echo $tmp_tag ?>><?php unset($attr5) ?><?php unset($attr5_class) ?><?php unset($attr5_key) ?><?php unset($attr5_escape) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?></td><?php unset($attr3) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?><?php
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
?><td <?php foreach( $attr4 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr4) ?><?php $attr5_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"var";s:8:"objectid";s:6:"escape";s:4:"true";}' ?><?php $attr5 = array('class'=>'text','var'=>'objectid','escape'=>true) ?><?php $attr5_class='text' ?><?php $attr5_var='objectid' ?><?php $attr5_escape=true ?><?php
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
?></<?php echo $tmp_tag ?>><?php unset($attr5) ?><?php unset($attr5_class) ?><?php unset($attr5_var) ?><?php unset($attr5_escape) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?></td><?php unset($attr3) ?><?php $attr2_debug_info = 'a:0:{}' ?><?php $attr2 = array() ?></tr><?php unset($attr2) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];
	if (empty($attr3_class))
		$attr3_class=$row_class;
	global $cell_column_nr;
	$cell_column_nr=0;
	$column_class_idx = 999;
?><tr class="<?php echo $attr3_class ?>"><?php unset($attr3) ?><?php $attr4_debug_info = 'a:1:{s:7:"colspan";s:1:"2";}' ?><?php $attr4 = array('colspan'=>'2') ?><?php $attr4_colspan='2' ?><?php
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
?><td <?php foreach( $attr4 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr4) ?><?php unset($attr4_colspan) ?><?php $attr5_debug_info = 'a:1:{s:5:"title";s:21:"message:prop_userinfo";}' ?><?php $attr5 = array('title'=>lang('prop_userinfo')) ?><?php $attr5_title=lang('prop_userinfo') ?><fieldset><?php if(isset($attr5_title)) { ?><legend><?php echo encodeHtml($attr5_title) ?></legend><?php } ?><?php unset($attr5) ?><?php unset($attr5_title) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></fieldset><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?></td><?php unset($attr3) ?><?php $attr2_debug_info = 'a:0:{}' ?><?php $attr2 = array() ?></tr><?php unset($attr2) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];
	if (empty($attr3_class))
		$attr3_class=$row_class;
	global $cell_column_nr;
	$cell_column_nr=0;
	$column_class_idx = 999;
?><tr class="<?php echo $attr3_class ?>"><?php unset($attr3) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?><?php
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
?><td <?php foreach( $attr4 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr4) ?><?php $attr5_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:14:"global_created";s:6:"escape";s:4:"true";}' ?><?php $attr5 = array('class'=>'text','text'=>'global_created','escape'=>true) ?><?php $attr5_class='text' ?><?php $attr5_text='global_created' ?><?php $attr5_escape=true ?><?php
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
?></<?php echo $tmp_tag ?>><?php unset($attr5) ?><?php unset($attr5_class) ?><?php unset($attr5_text) ?><?php unset($attr5_escape) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?></td><?php unset($attr3) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?><?php
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
?><td <?php foreach( $attr4 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr4) ?><?php $attr5_debug_info = 'a:4:{s:5:"width";s:4:"100%";s:5:"space";s:3:"0px";s:7:"padding";s:3:"0px";s:10:"rowclasses";s:8:"odd,even";}' ?><?php $attr5 = array('width'=>'100%','space'=>'0px','padding'=>'0px','rowclasses'=>'odd,even') ?><?php $attr5_width='100%' ?><?php $attr5_space='0px' ?><?php $attr5_padding='0px' ?><?php $attr5_rowclasses='odd,even' ?><?php
	$coloumn_widths=array();
	$row_classes   = array('');
	$column_classes= array('');
	if(empty($attr5_class))
		$attr5_class='';
	if	(!empty($attr5_widths))
	{
		$column_widths = explode(',',$attr5_widths);
		unset($attr5['widths']);
	}
	if	(!empty($attr5_classes))
	{
		$row_classes   = explode(',',$attr5_rowclasses);
		$row_class_idx = 999;
		unset($attr5['rowclasses']);
	}
	if	(!empty($attr5_rowclasses))
	{
		$row_classes   = explode(',',$attr5_rowclasses);
		$row_class_idx = 999;
		unset($attr5['rowclasses']);
	}
	if	(!empty($attr5_columnclasses))
	{
		$column_classes   = explode(',',$attr5_columnclasses);
		unset($attr5['columnclasses']);
	}
?><table class="<?php echo $attr5_class ?>" cellspacing="<?php echo $attr5_space ?>" width="<?php echo $attr5_width ?>" cellpadding="<?php echo $attr5_padding ?>"><?php unset($attr5) ?><?php unset($attr5_width) ?><?php unset($attr5_space) ?><?php unset($attr5_padding) ?><?php unset($attr5_rowclasses) ?><?php $attr6_debug_info = 'a:0:{}' ?><?php $attr6 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];
	if (empty($attr6_class))
		$attr6_class=$row_class;
	global $cell_column_nr;
	$cell_column_nr=0;
	$column_class_idx = 999;
?><tr class="<?php echo $attr6_class ?>"><?php unset($attr6) ?><?php $attr7_debug_info = 'a:0:{}' ?><?php $attr7 = array() ?><?php
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
?><td <?php foreach( $attr7 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr7) ?><?php $attr8_debug_info = 'a:2:{s:4:"icon";s:7:"el_date";s:5:"align";s:4:"left";}' ?><?php $attr8 = array('icon'=>'el_date','align'=>'left') ?><?php $attr8_icon='el_date' ?><?php $attr8_align='left' ?><?php
if (isset($attr8_elementtype)) {
?><img src="<?php echo $image_dir.'icon_el_'.$attr8_elementtype.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr8_align ?>"><?php
} elseif (isset($attr8_type)) {
?><img src="<?php echo $image_dir.'icon_'.$attr8_type.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr8_align ?>"><?php
} elseif (isset($attr8_icon)) {
?><img src="<?php echo $image_dir.'icon_'.$attr8_icon.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr8_align ?>"><?php
} elseif (isset($attr8_tree)) {
?><img src="<?php echo $image_dir.'tree_'.$attr8_tree.IMG_EXT ?>" border="0" align="<?php echo $attr8_align ?>"><?php
} elseif (isset($attr8_url)) {
?><img src="<?php echo $attr8_url ?>" border="0" align="<?php echo $attr8_align ?>"><?php
} elseif (isset($attr8_fileext)) {
?><img src="<?php echo $image_dir.$attr8_fileext ?>" border="0" align="<?php echo $attr8_align ?>"><?php
} elseif (isset($attr8_file)) {
?><img src="<?php echo $image_dir.$attr8_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr8_align ?>"><?php } ?><?php unset($attr8) ?><?php unset($attr8_icon) ?><?php unset($attr8_align) ?><?php $attr8_debug_info = 'a:1:{s:4:"date";s:15:"var:create_date";}' ?><?php $attr8 = array('date'=>$create_date) ?><?php $attr8_date=$create_date ?><?php	
    global $conf;
	$time = $attr8_date;
	if	( $time==0)
		echo lang('GLOBAL_UNKNOWN');
	elseif ( !$conf['interface']['human_date_format'] )
	{
		echo '<span title="';
		$dl = date(lang('DATE_FORMAT_LONG'),$time);
		$dl = str_replace('{weekday}',lang('DATE_WEEKDAY'.strval(date('w',$time))),$dl);
		$dl = str_replace('{month}'  ,lang('DATE_MONTH'  .strval(date('n',$time))),$dl);
		echo $dl;
		unset($dl);
		echo '">';
		echo date(lang('DATE_FORMAT'),$time);
		echo '</span>';
	}
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
?><?php unset($attr8) ?><?php unset($attr8_date) ?><?php $attr6_debug_info = 'a:0:{}' ?><?php $attr6 = array() ?></td><?php unset($attr6) ?><?php $attr7_debug_info = 'a:0:{}' ?><?php $attr7 = array() ?><?php
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
?><td <?php foreach( $attr7 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr7) ?><?php $attr8_debug_info = 'a:2:{s:4:"icon";s:4:"user";s:5:"align";s:4:"left";}' ?><?php $attr8 = array('icon'=>'user','align'=>'left') ?><?php $attr8_icon='user' ?><?php $attr8_align='left' ?><?php
if (isset($attr8_elementtype)) {
?><img src="<?php echo $image_dir.'icon_el_'.$attr8_elementtype.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr8_align ?>"><?php
} elseif (isset($attr8_type)) {
?><img src="<?php echo $image_dir.'icon_'.$attr8_type.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr8_align ?>"><?php
} elseif (isset($attr8_icon)) {
?><img src="<?php echo $image_dir.'icon_'.$attr8_icon.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr8_align ?>"><?php
} elseif (isset($attr8_tree)) {
?><img src="<?php echo $image_dir.'tree_'.$attr8_tree.IMG_EXT ?>" border="0" align="<?php echo $attr8_align ?>"><?php
} elseif (isset($attr8_url)) {
?><img src="<?php echo $attr8_url ?>" border="0" align="<?php echo $attr8_align ?>"><?php
} elseif (isset($attr8_fileext)) {
?><img src="<?php echo $image_dir.$attr8_fileext ?>" border="0" align="<?php echo $attr8_align ?>"><?php
} elseif (isset($attr8_file)) {
?><img src="<?php echo $image_dir.$attr8_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr8_align ?>"><?php } ?><?php unset($attr8) ?><?php unset($attr8_icon) ?><?php unset($attr8_align) ?><?php $attr8_debug_info = 'a:1:{s:4:"user";s:15:"var:create_user";}' ?><?php $attr8 = array('user'=>$create_user) ?><?php $attr8_user=$create_user ?><?php
		if	( is_object($attr8_user) )
			$user = $attr8_user;
		else
			$user = $$attr8_user;
		if	( empty($user->name) )
			$user->name = lang('GLOBAL_UNKNOWN');
		if	( empty($user->fullname) )
			$user->fullname = lang('GLOBAL_NO_DESCRIPTION_AVAILABLE');
		if	( !empty($user->mail) && $conf['security']['user']['show_mail'] )
			echo '<a href="mailto:'.$user->mail.'" title="'.$user->fullname.'">'.$user->name.'</a>';
		else
			echo '<span title="'.$user->fullname.'">'.$user->name.'</span>';
?><?php unset($attr8) ?><?php unset($attr8_user) ?><?php $attr6_debug_info = 'a:0:{}' ?><?php $attr6 = array() ?></td><?php unset($attr6) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></tr><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></table><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?></td><?php unset($attr3) ?><?php $attr2_debug_info = 'a:0:{}' ?><?php $attr2 = array() ?></tr><?php unset($attr2) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];
	if (empty($attr3_class))
		$attr3_class=$row_class;
	global $cell_column_nr;
	$cell_column_nr=0;
	$column_class_idx = 999;
?><tr class="<?php echo $attr3_class ?>"><?php unset($attr3) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?><?php
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
?><td <?php foreach( $attr4 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr4) ?><?php $attr5_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:17:"global_lastchange";s:6:"escape";s:4:"true";}' ?><?php $attr5 = array('class'=>'text','text'=>'global_lastchange','escape'=>true) ?><?php $attr5_class='text' ?><?php $attr5_text='global_lastchange' ?><?php $attr5_escape=true ?><?php
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
?></<?php echo $tmp_tag ?>><?php unset($attr5) ?><?php unset($attr5_class) ?><?php unset($attr5_text) ?><?php unset($attr5_escape) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?></td><?php unset($attr3) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?><?php
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
?><td <?php foreach( $attr4 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr4) ?><?php $attr5_debug_info = 'a:4:{s:5:"width";s:4:"100%";s:5:"space";s:3:"0px";s:7:"padding";s:3:"0px";s:10:"rowclasses";s:8:"odd,even";}' ?><?php $attr5 = array('width'=>'100%','space'=>'0px','padding'=>'0px','rowclasses'=>'odd,even') ?><?php $attr5_width='100%' ?><?php $attr5_space='0px' ?><?php $attr5_padding='0px' ?><?php $attr5_rowclasses='odd,even' ?><?php
	$coloumn_widths=array();
	$row_classes   = array('');
	$column_classes= array('');
	if(empty($attr5_class))
		$attr5_class='';
	if	(!empty($attr5_widths))
	{
		$column_widths = explode(',',$attr5_widths);
		unset($attr5['widths']);
	}
	if	(!empty($attr5_classes))
	{
		$row_classes   = explode(',',$attr5_rowclasses);
		$row_class_idx = 999;
		unset($attr5['rowclasses']);
	}
	if	(!empty($attr5_rowclasses))
	{
		$row_classes   = explode(',',$attr5_rowclasses);
		$row_class_idx = 999;
		unset($attr5['rowclasses']);
	}
	if	(!empty($attr5_columnclasses))
	{
		$column_classes   = explode(',',$attr5_columnclasses);
		unset($attr5['columnclasses']);
	}
?><table class="<?php echo $attr5_class ?>" cellspacing="<?php echo $attr5_space ?>" width="<?php echo $attr5_width ?>" cellpadding="<?php echo $attr5_padding ?>"><?php unset($attr5) ?><?php unset($attr5_width) ?><?php unset($attr5_space) ?><?php unset($attr5_padding) ?><?php unset($attr5_rowclasses) ?><?php $attr6_debug_info = 'a:0:{}' ?><?php $attr6 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];
	if (empty($attr6_class))
		$attr6_class=$row_class;
	global $cell_column_nr;
	$cell_column_nr=0;
	$column_class_idx = 999;
?><tr class="<?php echo $attr6_class ?>"><?php unset($attr6) ?><?php $attr7_debug_info = 'a:0:{}' ?><?php $attr7 = array() ?><?php
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
?><td <?php foreach( $attr7 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr7) ?><?php $attr8_debug_info = 'a:2:{s:4:"icon";s:7:"el_date";s:5:"align";s:4:"left";}' ?><?php $attr8 = array('icon'=>'el_date','align'=>'left') ?><?php $attr8_icon='el_date' ?><?php $attr8_align='left' ?><?php
if (isset($attr8_elementtype)) {
?><img src="<?php echo $image_dir.'icon_el_'.$attr8_elementtype.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr8_align ?>"><?php
} elseif (isset($attr8_type)) {
?><img src="<?php echo $image_dir.'icon_'.$attr8_type.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr8_align ?>"><?php
} elseif (isset($attr8_icon)) {
?><img src="<?php echo $image_dir.'icon_'.$attr8_icon.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr8_align ?>"><?php
} elseif (isset($attr8_tree)) {
?><img src="<?php echo $image_dir.'tree_'.$attr8_tree.IMG_EXT ?>" border="0" align="<?php echo $attr8_align ?>"><?php
} elseif (isset($attr8_url)) {
?><img src="<?php echo $attr8_url ?>" border="0" align="<?php echo $attr8_align ?>"><?php
} elseif (isset($attr8_fileext)) {
?><img src="<?php echo $image_dir.$attr8_fileext ?>" border="0" align="<?php echo $attr8_align ?>"><?php
} elseif (isset($attr8_file)) {
?><img src="<?php echo $image_dir.$attr8_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr8_align ?>"><?php } ?><?php unset($attr8) ?><?php unset($attr8_icon) ?><?php unset($attr8_align) ?><?php $attr8_debug_info = 'a:1:{s:4:"date";s:19:"var:lastchange_date";}' ?><?php $attr8 = array('date'=>$lastchange_date) ?><?php $attr8_date=$lastchange_date ?><?php	
    global $conf;
	$time = $attr8_date;
	if	( $time==0)
		echo lang('GLOBAL_UNKNOWN');
	elseif ( !$conf['interface']['human_date_format'] )
	{
		echo '<span title="';
		$dl = date(lang('DATE_FORMAT_LONG'),$time);
		$dl = str_replace('{weekday}',lang('DATE_WEEKDAY'.strval(date('w',$time))),$dl);
		$dl = str_replace('{month}'  ,lang('DATE_MONTH'  .strval(date('n',$time))),$dl);
		echo $dl;
		unset($dl);
		echo '">';
		echo date(lang('DATE_FORMAT'),$time);
		echo '</span>';
	}
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
?><?php unset($attr8) ?><?php unset($attr8_date) ?><?php $attr6_debug_info = 'a:0:{}' ?><?php $attr6 = array() ?></td><?php unset($attr6) ?><?php $attr7_debug_info = 'a:0:{}' ?><?php $attr7 = array() ?><?php
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
?><td <?php foreach( $attr7 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr7) ?><?php $attr8_debug_info = 'a:2:{s:4:"icon";s:4:"user";s:5:"align";s:4:"left";}' ?><?php $attr8 = array('icon'=>'user','align'=>'left') ?><?php $attr8_icon='user' ?><?php $attr8_align='left' ?><?php
if (isset($attr8_elementtype)) {
?><img src="<?php echo $image_dir.'icon_el_'.$attr8_elementtype.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr8_align ?>"><?php
} elseif (isset($attr8_type)) {
?><img src="<?php echo $image_dir.'icon_'.$attr8_type.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr8_align ?>"><?php
} elseif (isset($attr8_icon)) {
?><img src="<?php echo $image_dir.'icon_'.$attr8_icon.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr8_align ?>"><?php
} elseif (isset($attr8_tree)) {
?><img src="<?php echo $image_dir.'tree_'.$attr8_tree.IMG_EXT ?>" border="0" align="<?php echo $attr8_align ?>"><?php
} elseif (isset($attr8_url)) {
?><img src="<?php echo $attr8_url ?>" border="0" align="<?php echo $attr8_align ?>"><?php
} elseif (isset($attr8_fileext)) {
?><img src="<?php echo $image_dir.$attr8_fileext ?>" border="0" align="<?php echo $attr8_align ?>"><?php
} elseif (isset($attr8_file)) {
?><img src="<?php echo $image_dir.$attr8_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr8_align ?>"><?php } ?><?php unset($attr8) ?><?php unset($attr8_icon) ?><?php unset($attr8_align) ?><?php $attr8_debug_info = 'a:1:{s:4:"user";s:19:"var:lastchange_user";}' ?><?php $attr8 = array('user'=>$lastchange_user) ?><?php $attr8_user=$lastchange_user ?><?php
		if	( is_object($attr8_user) )
			$user = $attr8_user;
		else
			$user = $$attr8_user;
		if	( empty($user->name) )
			$user->name = lang('GLOBAL_UNKNOWN');
		if	( empty($user->fullname) )
			$user->fullname = lang('GLOBAL_NO_DESCRIPTION_AVAILABLE');
		if	( !empty($user->mail) && $conf['security']['user']['show_mail'] )
			echo '<a href="mailto:'.$user->mail.'" title="'.$user->fullname.'">'.$user->name.'</a>';
		else
			echo '<span title="'.$user->fullname.'">'.$user->name.'</span>';
?><?php unset($attr8) ?><?php unset($attr8_user) ?><?php $attr6_debug_info = 'a:0:{}' ?><?php $attr6 = array() ?></td><?php unset($attr6) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></tr><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></table><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?></td><?php unset($attr3) ?><?php $attr2_debug_info = 'a:0:{}' ?><?php $attr2 = array() ?></tr><?php unset($attr2) ?><?php $attr1_debug_info = 'a:0:{}' ?><?php $attr1 = array() ?>      </table>
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