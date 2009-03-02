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
<?php unset($attr1) ?><?php unset($attr1_class) ?><?php $attr2_debug_info = 'a:4:{s:4:"name";s:0:"";s:6:"target";s:5:"_self";s:6:"method";s:4:"post";s:7:"enctype";s:33:"application/x-www-form-urlencoded";}' ?><?php $attr2 = array('name'=>'','target'=>'_self','method'=>'post','enctype'=>'application/x-www-form-urlencoded') ?><?php $attr2_name='' ?><?php $attr2_target='_self' ?><?php $attr2_method='post' ?><?php $attr2_enctype='application/x-www-form-urlencoded' ?><?php
	if	(empty($attr2_action))
		$attr2_action = $actionName;
	if	(empty($attr2_subaction))
		$attr2_subaction = $targetSubActionName;
	if	(empty($attr2_id))
		$attr2_id = $this->getRequestId();
	if ($this->isEditable() && $this->getRequestVar('mode')!='edit')
		$attr2_subaction = $subActionName;
?><form name="<?php echo $attr2_name ?>"
      target="<?php echo $attr2_target ?>"
      action="<?php echo Html::url( $attr2_action,$attr2_subaction,$attr2_id ) ?>"
      method="<?php echo $attr2_method ?>"
      enctype="<?php echo $attr2_enctype ?>" style="margin:0px;padding:0px;">
<?php if ($this->isEditable() && $this->getRequestVar('mode')!='edit') { ?>
<input type="hidden" name="mode" value="edit" />
<?php } ?>
<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo $attr2_action ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo $attr2_subaction ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo $attr2_id ?>" /><?php
		if	( $conf['interface']['url_sessionid'] )
			echo '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";
?><?php unset($attr2) ?><?php unset($attr2_name) ?><?php unset($attr2_target) ?><?php unset($attr2_method) ?><?php unset($attr2_enctype) ?><?php $attr3_debug_info = 'a:8:{s:5:"class";s:0:"";s:7:"default";s:0:"";s:4:"type";s:6:"hidden";s:4:"name";s:9:"elementid";s:4:"size";s:2:"40";s:9:"maxlength";s:3:"256";s:8:"onchange";s:0:"";s:8:"readonly";s:5:"false";}' ?><?php $attr3 = array('class'=>'','default'=>'','type'=>'hidden','name'=>'elementid','size'=>'40','maxlength'=>'256','onchange'=>'','readonly'=>false) ?><?php $attr3_class='' ?><?php $attr3_default='' ?><?php $attr3_type='hidden' ?><?php $attr3_name='elementid' ?><?php $attr3_size='40' ?><?php $attr3_maxlength='256' ?><?php $attr3_onchange='' ?><?php $attr3_readonly=false ?><?php if ($this->isEditable() && $this->getRequestVar('mode')!='edit') $attr3_readonly=true;
	  if ($attr3_readonly && empty($$attr3_name)) $$attr3_name = '- '.lang('EMPTY').' -';
      if(!isset($attr3_default)) $attr3_default='';
?><?php if (!$attr3_readonly || $attr3_type=='hidden') {
?><input<?php if ($attr3_readonly) echo ' disabled="true"' ?> id="id_<?php echo $attr3_name ?><?php if ($attr3_readonly) echo '_disabled' ?>" name="<?php echo $attr3_name ?><?php if ($attr3_readonly) echo '_disabled' ?>" type="<?php echo $attr3_type ?>" size="<?php echo $attr3_size ?>" maxlength="<?php echo $attr3_maxlength ?>" class="<?php echo $attr3_class ?>" value="<?php echo isset($$attr3_name)?$$attr3_name:$attr3_default ?>" <?php if (in_array($attr3_name,$errors)) echo 'style="border-rightx:10px solid red; background-colorx:yellow; border:2px dashed red;"' ?> /><?php
if	($attr3_readonly) {
?><input type="hidden" id="id_<?php echo $attr3_name ?>" name="<?php echo $attr3_name ?>" value="<?php echo isset($$attr3_name)?$$attr3_name:$attr3_default ?>" /><?php
 } } else { ?><span class="<?php echo $attr3_class ?>"><?php echo isset($$attr3_name)?$$attr3_name:$attr3_default ?></span><?php } ?><?php unset($attr3) ?><?php unset($attr3_class) ?><?php unset($attr3_default) ?><?php unset($attr3_type) ?><?php unset($attr3_name) ?><?php unset($attr3_size) ?><?php unset($attr3_maxlength) ?><?php unset($attr3_onchange) ?><?php unset($attr3_readonly) ?><?php $attr3_debug_info = 'a:4:{s:4:"name";s:7:"element";s:5:"width";s:3:"93%";s:10:"rowclasses";s:8:"odd,even";s:13:"columnclasses";s:5:"1,2,3";}' ?><?php $attr3 = array('name'=>'element','width'=>'93%','rowclasses'=>'odd,even','columnclasses'=>'1,2,3') ?><?php $attr3_name='element' ?><?php $attr3_width='93%' ?><?php $attr3_rowclasses='odd,even' ?><?php $attr3_columnclasses='1,2,3' ?><?php
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
		echo '<img src="'.$image_dir.'icon_'.$actionName.IMG_ICON_EXT.'" align="left" border="0">';
		if ($this->isEditable()) { ?>
  <?php if ($this->getRequestVar('mode')=='edit') { 
  ?><a href="<?php echo Html::url($actionName,$subActionName,$this->getRequestId()                       ) ?>" accesskey="1" title="<?php echo langHtml('MODE_EDIT_DESC') ?>" class="path" style="text-align:right;font-weight:bold;font-weight:bold;"><img src="themes/default/images/mode-edit.png" style="vertical-align:top; " border="0" /></a> <?php } else {
  ?><a href="<?php echo Html::url($actionName,$subActionName,$this->getRequestId(),array('mode'=>'edit') ) ?>" accesskey="1" title="<?php echo langHtml('MODE_SHOW_DESC') ?>" class="path" style="text-align:right;font-weight:bold;font-weight:bold;"><img src="themes/default/images/readonly.png" style="vertical-align:top; " border="0" /></a> <?php }
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
<?php unset($attr3) ?><?php unset($attr3_name) ?><?php unset($attr3_width) ?><?php unset($attr3_rowclasses) ?><?php unset($attr3_columnclasses) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];
	if (empty($attr4_class))
		$attr4_class=$row_class;
	global $cell_column_nr;
	$cell_column_nr=0;
	$column_class_idx = 999;
?><tr class="<?php echo $attr4_class ?>"><?php unset($attr4) ?><?php $attr5_debug_info = 'a:2:{s:5:"class";s:4:"help";s:7:"colspan";s:1:"2";}' ?><?php $attr5 = array('class'=>'help','colspan'=>'2') ?><?php $attr5_class='help' ?><?php $attr5_colspan='2' ?><?php
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
?><td <?php foreach( $attr5 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr5) ?><?php unset($attr5_class) ?><?php unset($attr5_colspan) ?><?php $attr6_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"var";s:4:"desc";s:6:"escape";s:4:"true";}' ?><?php $attr6 = array('class'=>'text','var'=>'desc','escape'=>true) ?><?php $attr6_class='text' ?><?php $attr6_var='desc' ?><?php $attr6_escape=true ?><?php
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
?></<?php echo $tmp_tag ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_var) ?><?php unset($attr6_escape) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></td><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?></tr><?php unset($attr3) ?><?php $attr4_debug_info = 'a:2:{s:6:"equals";s:4:"date";s:5:"value";s:8:"var:type";}' ?><?php $attr4 = array('equals'=>'date','value'=>$type) ?><?php $attr4_equals='date' ?><?php $attr4_value=$type ?><?php 
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
<?php unset($attr4) ?><?php unset($attr4_equals) ?><?php unset($attr4_value) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];
	if (empty($attr5_class))
		$attr5_class=$row_class;
	global $cell_column_nr;
	$cell_column_nr=0;
	$column_class_idx = 999;
?><tr class="<?php echo $attr5_class ?>"><?php unset($attr5) ?><?php $attr6_debug_info = 'a:2:{s:5:"class";s:2:"fx";s:7:"colspan";s:1:"2";}' ?><?php $attr6 = array('class'=>'fx','colspan'=>'2') ?><?php $attr6_class='fx' ?><?php $attr6_colspan='2' ?><?php
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_colspan) ?><?php $attr7_debug_info = 'a:8:{s:5:"class";s:8:"ansidate";s:7:"default";s:0:"";s:4:"type";s:4:"text";s:4:"name";s:8:"ansidate";s:4:"size";s:2:"25";s:9:"maxlength";s:2:"25";s:8:"onchange";s:0:"";s:8:"readonly";s:5:"false";}' ?><?php $attr7 = array('class'=>'ansidate','default'=>'','type'=>'text','name'=>'ansidate','size'=>'25','maxlength'=>'25','onchange'=>'','readonly'=>false) ?><?php $attr7_class='ansidate' ?><?php $attr7_default='' ?><?php $attr7_type='text' ?><?php $attr7_name='ansidate' ?><?php $attr7_size='25' ?><?php $attr7_maxlength='25' ?><?php $attr7_onchange='' ?><?php $attr7_readonly=false ?><?php if ($this->isEditable() && $this->getRequestVar('mode')!='edit') $attr7_readonly=true;
	  if ($attr7_readonly && empty($$attr7_name)) $$attr7_name = '- '.lang('EMPTY').' -';
      if(!isset($attr7_default)) $attr7_default='';
?><?php if (!$attr7_readonly || $attr7_type=='hidden') {
?><input<?php if ($attr7_readonly) echo ' disabled="true"' ?> id="id_<?php echo $attr7_name ?><?php if ($attr7_readonly) echo '_disabled' ?>" name="<?php echo $attr7_name ?><?php if ($attr7_readonly) echo '_disabled' ?>" type="<?php echo $attr7_type ?>" size="<?php echo $attr7_size ?>" maxlength="<?php echo $attr7_maxlength ?>" class="<?php echo $attr7_class ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" <?php if (in_array($attr7_name,$errors)) echo 'style="border-rightx:10px solid red; background-colorx:yellow; border:2px dashed red;"' ?> /><?php
if	($attr7_readonly) {
?><input type="hidden" id="id_<?php echo $attr7_name ?>" name="<?php echo $attr7_name ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" /><?php
 } } else { ?><span class="<?php echo $attr7_class ?>"><?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?></span><?php } ?><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_default) ?><?php unset($attr7_type) ?><?php unset($attr7_name) ?><?php unset($attr7_size) ?><?php unset($attr7_maxlength) ?><?php unset($attr7_onchange) ?><?php unset($attr7_readonly) ?><?php $attr7_debug_info = 'a:1:{s:5:"field";s:8:"ansidate";}' ?><?php $attr7 = array('field'=>'ansidate') ?><?php $attr7_field='ansidate' ?><?php
if (isset($errors[0])) $attr7_field = $errors[0];
?><script name="JavaScript" type="text/javascript"><!--
document.forms[0].<?php echo $attr7_field ?>.focus();
document.forms[0].<?php echo $attr7_field ?>.select();
</script>
<?php unset($attr7) ?><?php unset($attr7_field) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php } ?><?php unset($attr3) ?><?php $attr4_debug_info = 'a:2:{s:6:"equals";s:4:"text";s:5:"value";s:8:"var:type";}' ?><?php $attr4 = array('equals'=>'text','value'=>$type) ?><?php $attr4_equals='text' ?><?php $attr4_value=$type ?><?php 
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
<?php unset($attr4) ?><?php unset($attr4_equals) ?><?php unset($attr4_value) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];
	if (empty($attr5_class))
		$attr5_class=$row_class;
	global $cell_column_nr;
	$cell_column_nr=0;
	$column_class_idx = 999;
?><tr class="<?php echo $attr5_class ?>"><?php unset($attr5) ?><?php $attr6_debug_info = 'a:2:{s:5:"class";s:2:"fx";s:7:"colspan";s:1:"2";}' ?><?php $attr6 = array('class'=>'fx','colspan'=>'2') ?><?php $attr6_class='fx' ?><?php $attr6_colspan='2' ?><?php
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_colspan) ?><?php $attr7_debug_info = 'a:8:{s:5:"class";s:4:"text";s:7:"default";s:0:"";s:4:"type";s:4:"text";s:4:"name";s:4:"text";s:4:"size";s:2:"50";s:9:"maxlength";s:3:"255";s:8:"onchange";s:0:"";s:8:"readonly";s:5:"false";}' ?><?php $attr7 = array('class'=>'text','default'=>'','type'=>'text','name'=>'text','size'=>'50','maxlength'=>'255','onchange'=>'','readonly'=>false) ?><?php $attr7_class='text' ?><?php $attr7_default='' ?><?php $attr7_type='text' ?><?php $attr7_name='text' ?><?php $attr7_size='50' ?><?php $attr7_maxlength='255' ?><?php $attr7_onchange='' ?><?php $attr7_readonly=false ?><?php if ($this->isEditable() && $this->getRequestVar('mode')!='edit') $attr7_readonly=true;
	  if ($attr7_readonly && empty($$attr7_name)) $$attr7_name = '- '.lang('EMPTY').' -';
      if(!isset($attr7_default)) $attr7_default='';
?><?php if (!$attr7_readonly || $attr7_type=='hidden') {
?><input<?php if ($attr7_readonly) echo ' disabled="true"' ?> id="id_<?php echo $attr7_name ?><?php if ($attr7_readonly) echo '_disabled' ?>" name="<?php echo $attr7_name ?><?php if ($attr7_readonly) echo '_disabled' ?>" type="<?php echo $attr7_type ?>" size="<?php echo $attr7_size ?>" maxlength="<?php echo $attr7_maxlength ?>" class="<?php echo $attr7_class ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" <?php if (in_array($attr7_name,$errors)) echo 'style="border-rightx:10px solid red; background-colorx:yellow; border:2px dashed red;"' ?> /><?php
if	($attr7_readonly) {
?><input type="hidden" id="id_<?php echo $attr7_name ?>" name="<?php echo $attr7_name ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" /><?php
 } } else { ?><span class="<?php echo $attr7_class ?>"><?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?></span><?php } ?><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_default) ?><?php unset($attr7_type) ?><?php unset($attr7_name) ?><?php unset($attr7_size) ?><?php unset($attr7_maxlength) ?><?php unset($attr7_onchange) ?><?php unset($attr7_readonly) ?><?php $attr7_debug_info = 'a:1:{s:5:"field";s:4:"text";}' ?><?php $attr7 = array('field'=>'text') ?><?php $attr7_field='text' ?><?php
if (isset($errors[0])) $attr7_field = $errors[0];
?><script name="JavaScript" type="text/javascript"><!--
document.forms[0].<?php echo $attr7_field ?>.focus();
document.forms[0].<?php echo $attr7_field ?>.select();
</script>
<?php unset($attr7) ?><?php unset($attr7_field) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php } ?><?php unset($attr3) ?><?php $attr4_debug_info = 'a:2:{s:6:"equals";s:8:"longtext";s:5:"value";s:8:"var:type";}' ?><?php $attr4 = array('equals'=>'longtext','value'=>$type) ?><?php $attr4_equals='longtext' ?><?php $attr4_value=$type ?><?php 
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
<?php unset($attr4) ?><?php unset($attr4_equals) ?><?php unset($attr4_value) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];
	if (empty($attr5_class))
		$attr5_class=$row_class;
	global $cell_column_nr;
	$cell_column_nr=0;
	$column_class_idx = 999;
?><tr class="<?php echo $attr5_class ?>"><?php unset($attr5) ?><?php $attr6_debug_info = 'a:2:{s:5:"class";s:2:"fx";s:7:"colspan";s:1:"2";}' ?><?php $attr6 = array('class'=>'fx','colspan'=>'2') ?><?php $attr6_class='fx' ?><?php $attr6_colspan='2' ?><?php
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_colspan) ?><?php $attr7_debug_info = 'a:5:{s:4:"name";s:4:"text";s:4:"rows";s:2:"25";s:4:"cols";s:2:"70";s:5:"class";s:8:"longtext";s:7:"default";s:0:"";}' ?><?php $attr7 = array('name'=>'text','rows'=>'25','cols'=>'70','class'=>'longtext','default'=>'') ?><?php $attr7_name='text' ?><?php $attr7_rows='25' ?><?php $attr7_cols='70' ?><?php $attr7_class='longtext' ?><?php $attr7_default='' ?><?php if ($this->isEditable() && $this->getRequestVar('mode')!='edit') $attr7_readonly=true;
      if ( !$attr7_readonly) {
?><textarea <?php if ($attr7_readonly) echo ' disabled="true"' ?> class="<?php echo $attr7_class ?>" name="<?php echo $attr7_name ?>" rows="<?php echo $attr7_rows ?>" cols="<?php echo $attr7_cols ?>"><?php echo htmlentities(isset($$attr7_name)?$$attr7_name:$attr7_default) ?></textarea><?php
 } else {
?><span class="<?php echo $attr7_class ?>"><?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?></span><?php } ?><?php unset($attr7) ?><?php unset($attr7_name) ?><?php unset($attr7_rows) ?><?php unset($attr7_cols) ?><?php unset($attr7_class) ?><?php unset($attr7_default) ?><?php $attr7_debug_info = 'a:1:{s:4:"true";s:9:"mode:edit";}' ?><?php $attr7 = array('true'=>$this->getRequestVar("mode")=="edit") ?><?php $attr7_true=$this->getRequestVar("mode")=="edit" ?><?php 
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
<?php unset($attr7) ?><?php unset($attr7_true) ?><?php $attr8_debug_info = 'a:1:{s:5:"title";s:12:"message:help";}' ?><?php $attr8 = array('title'=>lang('help')) ?><?php $attr8_title=lang('help') ?><fieldset><?php if(isset($attr8_title)) { ?><legend><?php echo encodeHtml($attr8_title) ?></legend><?php } ?><?php unset($attr8) ?><?php unset($attr8_title) ?><?php $attr7_debug_info = 'a:0:{}' ?><?php $attr7 = array() ?></fieldset><?php unset($attr7) ?><?php $attr8_debug_info = 'a:4:{s:5:"width";s:4:"100%";s:5:"space";s:3:"0px";s:7:"padding";s:3:"0px";s:10:"rowclasses";s:8:"odd,even";}' ?><?php $attr8 = array('width'=>'100%','space'=>'0px','padding'=>'0px','rowclasses'=>'odd,even') ?><?php $attr8_width='100%' ?><?php $attr8_space='0px' ?><?php $attr8_padding='0px' ?><?php $attr8_rowclasses='odd,even' ?><?php
	$coloumn_widths=array();
	$row_classes   = array('');
	$column_classes= array('');
	if(empty($attr8_class))
		$attr8_class='';
	if	(!empty($attr8_widths))
	{
		$column_widths = explode(',',$attr8_widths);
		unset($attr8['widths']);
	}
	if	(!empty($attr8_classes))
	{
		$row_classes   = explode(',',$attr8_rowclasses);
		$row_class_idx = 999;
		unset($attr8['rowclasses']);
	}
	if	(!empty($attr8_rowclasses))
	{
		$row_classes   = explode(',',$attr8_rowclasses);
		$row_class_idx = 999;
		unset($attr8['rowclasses']);
	}
	if	(!empty($attr8_columnclasses))
	{
		$column_classes   = explode(',',$attr8_columnclasses);
		unset($attr8['columnclasses']);
	}
?><table class="<?php echo $attr8_class ?>" cellspacing="<?php echo $attr8_space ?>" width="<?php echo $attr8_width ?>" cellpadding="<?php echo $attr8_padding ?>"><?php unset($attr8) ?><?php unset($attr8_width) ?><?php unset($attr8_space) ?><?php unset($attr8_padding) ?><?php unset($attr8_rowclasses) ?><?php $attr9_debug_info = 'a:0:{}' ?><?php $attr9 = array() ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr9_class))
		$attr9['class']=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr9_rowspan) )
		$attr9['width']=$column_widths[$cell_column_nr-1];
?><td <?php foreach( $attr9 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr9) ?><?php $attr10_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:38:"config:editor/text-markup/strong-begin";s:6:"escape";s:4:"true";}' ?><?php $attr10 = array('class'=>'text','text'=>@$conf['editor']['text-markup']['strong-begin'],'escape'=>true) ?><?php $attr10_class='text' ?><?php $attr10_text=@$conf['editor']['text-markup']['strong-begin'] ?><?php $attr10_escape=true ?><?php
	if	( isset($attr10_prefix)&& isset($attr10_key))
		$attr10_key = $attr10_prefix.$attr10_key;
	if	( isset($attr10_suffix)&& isset($attr10_key))
		$attr10_key = $attr10_key.$attr10_suffix;
	if(empty($attr10_title))
			$attr10_title = '';
	if	(empty($attr10_type))
		$tmp_tag = 'span';
	else
		switch( $attr10_type )
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
?><<?php echo $tmp_tag ?> class="<?php echo $attr10_class ?>" title="<?php echo $attr10_title ?>"><?php
	$attr10_title = '';
	if	( $attr10_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr10_array))
	{
		$tmpArray = $$attr10_array;
		if (!empty($attr10_var))
			$tmp_text = $tmpArray[$attr10_var];
		else
			$tmp_text = $langF($tmpArray[$attr10_text]);
	}
	elseif (!empty($attr10_text))
		$tmp_text = $langF($attr10_text);
	elseif (!empty($attr10_textvar))
		$tmp_text = $langF($$attr10_textvar);
	elseif (!empty($attr10_key))
		$tmp_text = $langF($attr10_key);
	elseif (!empty($attr10_var))
		$tmp_text = isset($$attr10_var)?$$attr10_var:'?unset:'.$attr10_var.'?';	
	elseif (!empty($attr10_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr10_raw);
	elseif (!empty($attr10_value))
		$tmp_text = $attr10_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr10_maxlength) && intval($attr10_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr10_maxlength) );
	if	(isset($attr10_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr10_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr10) ?><?php unset($attr10_class) ?><?php unset($attr10_text) ?><?php unset($attr10_escape) ?><?php $attr10_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:26:"message:text_markup_strong";s:6:"escape";s:4:"true";}' ?><?php $attr10 = array('class'=>'text','text'=>lang('text_markup_strong'),'escape'=>true) ?><?php $attr10_class='text' ?><?php $attr10_text=lang('text_markup_strong') ?><?php $attr10_escape=true ?><?php
	if	( isset($attr10_prefix)&& isset($attr10_key))
		$attr10_key = $attr10_prefix.$attr10_key;
	if	( isset($attr10_suffix)&& isset($attr10_key))
		$attr10_key = $attr10_key.$attr10_suffix;
	if(empty($attr10_title))
			$attr10_title = '';
	if	(empty($attr10_type))
		$tmp_tag = 'span';
	else
		switch( $attr10_type )
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
?><<?php echo $tmp_tag ?> class="<?php echo $attr10_class ?>" title="<?php echo $attr10_title ?>"><?php
	$attr10_title = '';
	if	( $attr10_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr10_array))
	{
		$tmpArray = $$attr10_array;
		if (!empty($attr10_var))
			$tmp_text = $tmpArray[$attr10_var];
		else
			$tmp_text = $langF($tmpArray[$attr10_text]);
	}
	elseif (!empty($attr10_text))
		$tmp_text = $langF($attr10_text);
	elseif (!empty($attr10_textvar))
		$tmp_text = $langF($$attr10_textvar);
	elseif (!empty($attr10_key))
		$tmp_text = $langF($attr10_key);
	elseif (!empty($attr10_var))
		$tmp_text = isset($$attr10_var)?$$attr10_var:'?unset:'.$attr10_var.'?';	
	elseif (!empty($attr10_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr10_raw);
	elseif (!empty($attr10_value))
		$tmp_text = $attr10_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr10_maxlength) && intval($attr10_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr10_maxlength) );
	if	(isset($attr10_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr10_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr10) ?><?php unset($attr10_class) ?><?php unset($attr10_text) ?><?php unset($attr10_escape) ?><?php $attr10_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:36:"config:editor/text-markup/strong-end";s:6:"escape";s:4:"true";}' ?><?php $attr10 = array('class'=>'text','text'=>@$conf['editor']['text-markup']['strong-end'],'escape'=>true) ?><?php $attr10_class='text' ?><?php $attr10_text=@$conf['editor']['text-markup']['strong-end'] ?><?php $attr10_escape=true ?><?php
	if	( isset($attr10_prefix)&& isset($attr10_key))
		$attr10_key = $attr10_prefix.$attr10_key;
	if	( isset($attr10_suffix)&& isset($attr10_key))
		$attr10_key = $attr10_key.$attr10_suffix;
	if(empty($attr10_title))
			$attr10_title = '';
	if	(empty($attr10_type))
		$tmp_tag = 'span';
	else
		switch( $attr10_type )
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
?><<?php echo $tmp_tag ?> class="<?php echo $attr10_class ?>" title="<?php echo $attr10_title ?>"><?php
	$attr10_title = '';
	if	( $attr10_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr10_array))
	{
		$tmpArray = $$attr10_array;
		if (!empty($attr10_var))
			$tmp_text = $tmpArray[$attr10_var];
		else
			$tmp_text = $langF($tmpArray[$attr10_text]);
	}
	elseif (!empty($attr10_text))
		$tmp_text = $langF($attr10_text);
	elseif (!empty($attr10_textvar))
		$tmp_text = $langF($$attr10_textvar);
	elseif (!empty($attr10_key))
		$tmp_text = $langF($attr10_key);
	elseif (!empty($attr10_var))
		$tmp_text = isset($$attr10_var)?$$attr10_var:'?unset:'.$attr10_var.'?';	
	elseif (!empty($attr10_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr10_raw);
	elseif (!empty($attr10_value))
		$tmp_text = $attr10_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr10_maxlength) && intval($attr10_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr10_maxlength) );
	if	(isset($attr10_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr10_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr10) ?><?php unset($attr10_class) ?><?php unset($attr10_text) ?><?php unset($attr10_escape) ?><?php $attr10_debug_info = 'a:0:{}' ?><?php $attr10 = array() ?><br/><?php unset($attr10) ?><?php $attr10_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:40:"config:editor/text-markup/emphatic-begin";s:6:"escape";s:4:"true";}' ?><?php $attr10 = array('class'=>'text','text'=>@$conf['editor']['text-markup']['emphatic-begin'],'escape'=>true) ?><?php $attr10_class='text' ?><?php $attr10_text=@$conf['editor']['text-markup']['emphatic-begin'] ?><?php $attr10_escape=true ?><?php
	if	( isset($attr10_prefix)&& isset($attr10_key))
		$attr10_key = $attr10_prefix.$attr10_key;
	if	( isset($attr10_suffix)&& isset($attr10_key))
		$attr10_key = $attr10_key.$attr10_suffix;
	if(empty($attr10_title))
			$attr10_title = '';
	if	(empty($attr10_type))
		$tmp_tag = 'span';
	else
		switch( $attr10_type )
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
?><<?php echo $tmp_tag ?> class="<?php echo $attr10_class ?>" title="<?php echo $attr10_title ?>"><?php
	$attr10_title = '';
	if	( $attr10_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr10_array))
	{
		$tmpArray = $$attr10_array;
		if (!empty($attr10_var))
			$tmp_text = $tmpArray[$attr10_var];
		else
			$tmp_text = $langF($tmpArray[$attr10_text]);
	}
	elseif (!empty($attr10_text))
		$tmp_text = $langF($attr10_text);
	elseif (!empty($attr10_textvar))
		$tmp_text = $langF($$attr10_textvar);
	elseif (!empty($attr10_key))
		$tmp_text = $langF($attr10_key);
	elseif (!empty($attr10_var))
		$tmp_text = isset($$attr10_var)?$$attr10_var:'?unset:'.$attr10_var.'?';	
	elseif (!empty($attr10_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr10_raw);
	elseif (!empty($attr10_value))
		$tmp_text = $attr10_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr10_maxlength) && intval($attr10_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr10_maxlength) );
	if	(isset($attr10_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr10_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr10) ?><?php unset($attr10_class) ?><?php unset($attr10_text) ?><?php unset($attr10_escape) ?><?php $attr10_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:28:"message:text_markup_emphatic";s:6:"escape";s:4:"true";}' ?><?php $attr10 = array('class'=>'text','text'=>lang('text_markup_emphatic'),'escape'=>true) ?><?php $attr10_class='text' ?><?php $attr10_text=lang('text_markup_emphatic') ?><?php $attr10_escape=true ?><?php
	if	( isset($attr10_prefix)&& isset($attr10_key))
		$attr10_key = $attr10_prefix.$attr10_key;
	if	( isset($attr10_suffix)&& isset($attr10_key))
		$attr10_key = $attr10_key.$attr10_suffix;
	if(empty($attr10_title))
			$attr10_title = '';
	if	(empty($attr10_type))
		$tmp_tag = 'span';
	else
		switch( $attr10_type )
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
?><<?php echo $tmp_tag ?> class="<?php echo $attr10_class ?>" title="<?php echo $attr10_title ?>"><?php
	$attr10_title = '';
	if	( $attr10_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr10_array))
	{
		$tmpArray = $$attr10_array;
		if (!empty($attr10_var))
			$tmp_text = $tmpArray[$attr10_var];
		else
			$tmp_text = $langF($tmpArray[$attr10_text]);
	}
	elseif (!empty($attr10_text))
		$tmp_text = $langF($attr10_text);
	elseif (!empty($attr10_textvar))
		$tmp_text = $langF($$attr10_textvar);
	elseif (!empty($attr10_key))
		$tmp_text = $langF($attr10_key);
	elseif (!empty($attr10_var))
		$tmp_text = isset($$attr10_var)?$$attr10_var:'?unset:'.$attr10_var.'?';	
	elseif (!empty($attr10_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr10_raw);
	elseif (!empty($attr10_value))
		$tmp_text = $attr10_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr10_maxlength) && intval($attr10_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr10_maxlength) );
	if	(isset($attr10_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr10_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr10) ?><?php unset($attr10_class) ?><?php unset($attr10_text) ?><?php unset($attr10_escape) ?><?php $attr10_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:38:"config:editor/text-markup/emphatic-end";s:6:"escape";s:4:"true";}' ?><?php $attr10 = array('class'=>'text','text'=>@$conf['editor']['text-markup']['emphatic-end'],'escape'=>true) ?><?php $attr10_class='text' ?><?php $attr10_text=@$conf['editor']['text-markup']['emphatic-end'] ?><?php $attr10_escape=true ?><?php
	if	( isset($attr10_prefix)&& isset($attr10_key))
		$attr10_key = $attr10_prefix.$attr10_key;
	if	( isset($attr10_suffix)&& isset($attr10_key))
		$attr10_key = $attr10_key.$attr10_suffix;
	if(empty($attr10_title))
			$attr10_title = '';
	if	(empty($attr10_type))
		$tmp_tag = 'span';
	else
		switch( $attr10_type )
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
?><<?php echo $tmp_tag ?> class="<?php echo $attr10_class ?>" title="<?php echo $attr10_title ?>"><?php
	$attr10_title = '';
	if	( $attr10_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr10_array))
	{
		$tmpArray = $$attr10_array;
		if (!empty($attr10_var))
			$tmp_text = $tmpArray[$attr10_var];
		else
			$tmp_text = $langF($tmpArray[$attr10_text]);
	}
	elseif (!empty($attr10_text))
		$tmp_text = $langF($attr10_text);
	elseif (!empty($attr10_textvar))
		$tmp_text = $langF($$attr10_textvar);
	elseif (!empty($attr10_key))
		$tmp_text = $langF($attr10_key);
	elseif (!empty($attr10_var))
		$tmp_text = isset($$attr10_var)?$$attr10_var:'?unset:'.$attr10_var.'?';	
	elseif (!empty($attr10_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr10_raw);
	elseif (!empty($attr10_value))
		$tmp_text = $attr10_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr10_maxlength) && intval($attr10_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr10_maxlength) );
	if	(isset($attr10_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr10_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr10) ?><?php unset($attr10_class) ?><?php unset($attr10_text) ?><?php unset($attr10_escape) ?><?php $attr8_debug_info = 'a:0:{}' ?><?php $attr8 = array() ?></td><?php unset($attr8) ?><?php $attr9_debug_info = 'a:0:{}' ?><?php $attr9 = array() ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr9_class))
		$attr9['class']=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr9_rowspan) )
		$attr9['width']=$column_widths[$cell_column_nr-1];
?><td <?php foreach( $attr9 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr9) ?><?php $attr10_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:39:"config:editor/text-markup/list-numbered";s:6:"escape";s:4:"true";}' ?><?php $attr10 = array('class'=>'text','text'=>@$conf['editor']['text-markup']['list-numbered'],'escape'=>true) ?><?php $attr10_class='text' ?><?php $attr10_text=@$conf['editor']['text-markup']['list-numbered'] ?><?php $attr10_escape=true ?><?php
	if	( isset($attr10_prefix)&& isset($attr10_key))
		$attr10_key = $attr10_prefix.$attr10_key;
	if	( isset($attr10_suffix)&& isset($attr10_key))
		$attr10_key = $attr10_key.$attr10_suffix;
	if(empty($attr10_title))
			$attr10_title = '';
	if	(empty($attr10_type))
		$tmp_tag = 'span';
	else
		switch( $attr10_type )
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
?><<?php echo $tmp_tag ?> class="<?php echo $attr10_class ?>" title="<?php echo $attr10_title ?>"><?php
	$attr10_title = '';
	if	( $attr10_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr10_array))
	{
		$tmpArray = $$attr10_array;
		if (!empty($attr10_var))
			$tmp_text = $tmpArray[$attr10_var];
		else
			$tmp_text = $langF($tmpArray[$attr10_text]);
	}
	elseif (!empty($attr10_text))
		$tmp_text = $langF($attr10_text);
	elseif (!empty($attr10_textvar))
		$tmp_text = $langF($$attr10_textvar);
	elseif (!empty($attr10_key))
		$tmp_text = $langF($attr10_key);
	elseif (!empty($attr10_var))
		$tmp_text = isset($$attr10_var)?$$attr10_var:'?unset:'.$attr10_var.'?';	
	elseif (!empty($attr10_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr10_raw);
	elseif (!empty($attr10_value))
		$tmp_text = $attr10_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr10_maxlength) && intval($attr10_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr10_maxlength) );
	if	(isset($attr10_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr10_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr10) ?><?php unset($attr10_class) ?><?php unset($attr10_text) ?><?php unset($attr10_escape) ?><?php $attr10_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:33:"message:text_markup_numbered_list";s:6:"escape";s:4:"true";}' ?><?php $attr10 = array('class'=>'text','text'=>lang('text_markup_numbered_list'),'escape'=>true) ?><?php $attr10_class='text' ?><?php $attr10_text=lang('text_markup_numbered_list') ?><?php $attr10_escape=true ?><?php
	if	( isset($attr10_prefix)&& isset($attr10_key))
		$attr10_key = $attr10_prefix.$attr10_key;
	if	( isset($attr10_suffix)&& isset($attr10_key))
		$attr10_key = $attr10_key.$attr10_suffix;
	if(empty($attr10_title))
			$attr10_title = '';
	if	(empty($attr10_type))
		$tmp_tag = 'span';
	else
		switch( $attr10_type )
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
?><<?php echo $tmp_tag ?> class="<?php echo $attr10_class ?>" title="<?php echo $attr10_title ?>"><?php
	$attr10_title = '';
	if	( $attr10_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr10_array))
	{
		$tmpArray = $$attr10_array;
		if (!empty($attr10_var))
			$tmp_text = $tmpArray[$attr10_var];
		else
			$tmp_text = $langF($tmpArray[$attr10_text]);
	}
	elseif (!empty($attr10_text))
		$tmp_text = $langF($attr10_text);
	elseif (!empty($attr10_textvar))
		$tmp_text = $langF($$attr10_textvar);
	elseif (!empty($attr10_key))
		$tmp_text = $langF($attr10_key);
	elseif (!empty($attr10_var))
		$tmp_text = isset($$attr10_var)?$$attr10_var:'?unset:'.$attr10_var.'?';	
	elseif (!empty($attr10_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr10_raw);
	elseif (!empty($attr10_value))
		$tmp_text = $attr10_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr10_maxlength) && intval($attr10_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr10_maxlength) );
	if	(isset($attr10_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr10_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr10) ?><?php unset($attr10_class) ?><?php unset($attr10_text) ?><?php unset($attr10_escape) ?><?php $attr10_debug_info = 'a:0:{}' ?><?php $attr10 = array() ?><br/><?php unset($attr10) ?><?php $attr10_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:39:"config:editor/text-markup/list-numbered";s:6:"escape";s:4:"true";}' ?><?php $attr10 = array('class'=>'text','text'=>@$conf['editor']['text-markup']['list-numbered'],'escape'=>true) ?><?php $attr10_class='text' ?><?php $attr10_text=@$conf['editor']['text-markup']['list-numbered'] ?><?php $attr10_escape=true ?><?php
	if	( isset($attr10_prefix)&& isset($attr10_key))
		$attr10_key = $attr10_prefix.$attr10_key;
	if	( isset($attr10_suffix)&& isset($attr10_key))
		$attr10_key = $attr10_key.$attr10_suffix;
	if(empty($attr10_title))
			$attr10_title = '';
	if	(empty($attr10_type))
		$tmp_tag = 'span';
	else
		switch( $attr10_type )
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
?><<?php echo $tmp_tag ?> class="<?php echo $attr10_class ?>" title="<?php echo $attr10_title ?>"><?php
	$attr10_title = '';
	if	( $attr10_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr10_array))
	{
		$tmpArray = $$attr10_array;
		if (!empty($attr10_var))
			$tmp_text = $tmpArray[$attr10_var];
		else
			$tmp_text = $langF($tmpArray[$attr10_text]);
	}
	elseif (!empty($attr10_text))
		$tmp_text = $langF($attr10_text);
	elseif (!empty($attr10_textvar))
		$tmp_text = $langF($$attr10_textvar);
	elseif (!empty($attr10_key))
		$tmp_text = $langF($attr10_key);
	elseif (!empty($attr10_var))
		$tmp_text = isset($$attr10_var)?$$attr10_var:'?unset:'.$attr10_var.'?';	
	elseif (!empty($attr10_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr10_raw);
	elseif (!empty($attr10_value))
		$tmp_text = $attr10_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr10_maxlength) && intval($attr10_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr10_maxlength) );
	if	(isset($attr10_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr10_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr10) ?><?php unset($attr10_class) ?><?php unset($attr10_text) ?><?php unset($attr10_escape) ?><?php $attr10_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:4:":...";s:6:"escape";s:4:"true";}' ?><?php $attr10 = array('class'=>'text','text'=>'...','escape'=>true) ?><?php $attr10_class='text' ?><?php $attr10_text='...' ?><?php $attr10_escape=true ?><?php
	if	( isset($attr10_prefix)&& isset($attr10_key))
		$attr10_key = $attr10_prefix.$attr10_key;
	if	( isset($attr10_suffix)&& isset($attr10_key))
		$attr10_key = $attr10_key.$attr10_suffix;
	if(empty($attr10_title))
			$attr10_title = '';
	if	(empty($attr10_type))
		$tmp_tag = 'span';
	else
		switch( $attr10_type )
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
?><<?php echo $tmp_tag ?> class="<?php echo $attr10_class ?>" title="<?php echo $attr10_title ?>"><?php
	$attr10_title = '';
	if	( $attr10_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr10_array))
	{
		$tmpArray = $$attr10_array;
		if (!empty($attr10_var))
			$tmp_text = $tmpArray[$attr10_var];
		else
			$tmp_text = $langF($tmpArray[$attr10_text]);
	}
	elseif (!empty($attr10_text))
		$tmp_text = $langF($attr10_text);
	elseif (!empty($attr10_textvar))
		$tmp_text = $langF($$attr10_textvar);
	elseif (!empty($attr10_key))
		$tmp_text = $langF($attr10_key);
	elseif (!empty($attr10_var))
		$tmp_text = isset($$attr10_var)?$$attr10_var:'?unset:'.$attr10_var.'?';	
	elseif (!empty($attr10_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr10_raw);
	elseif (!empty($attr10_value))
		$tmp_text = $attr10_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr10_maxlength) && intval($attr10_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr10_maxlength) );
	if	(isset($attr10_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr10_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr10) ?><?php unset($attr10_class) ?><?php unset($attr10_text) ?><?php unset($attr10_escape) ?><?php $attr10_debug_info = 'a:0:{}' ?><?php $attr10 = array() ?><br/><?php unset($attr10) ?><?php $attr8_debug_info = 'a:0:{}' ?><?php $attr8 = array() ?></td><?php unset($attr8) ?><?php $attr9_debug_info = 'a:0:{}' ?><?php $attr9 = array() ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr9_class))
		$attr9['class']=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr9_rowspan) )
		$attr9['width']=$column_widths[$cell_column_nr-1];
?><td <?php foreach( $attr9 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr9) ?><?php $attr10_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:41:"config:editor/text-markup/list-unnumbered";s:6:"escape";s:4:"true";}' ?><?php $attr10 = array('class'=>'text','text'=>@$conf['editor']['text-markup']['list-unnumbered'],'escape'=>true) ?><?php $attr10_class='text' ?><?php $attr10_text=@$conf['editor']['text-markup']['list-unnumbered'] ?><?php $attr10_escape=true ?><?php
	if	( isset($attr10_prefix)&& isset($attr10_key))
		$attr10_key = $attr10_prefix.$attr10_key;
	if	( isset($attr10_suffix)&& isset($attr10_key))
		$attr10_key = $attr10_key.$attr10_suffix;
	if(empty($attr10_title))
			$attr10_title = '';
	if	(empty($attr10_type))
		$tmp_tag = 'span';
	else
		switch( $attr10_type )
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
?><<?php echo $tmp_tag ?> class="<?php echo $attr10_class ?>" title="<?php echo $attr10_title ?>"><?php
	$attr10_title = '';
	if	( $attr10_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr10_array))
	{
		$tmpArray = $$attr10_array;
		if (!empty($attr10_var))
			$tmp_text = $tmpArray[$attr10_var];
		else
			$tmp_text = $langF($tmpArray[$attr10_text]);
	}
	elseif (!empty($attr10_text))
		$tmp_text = $langF($attr10_text);
	elseif (!empty($attr10_textvar))
		$tmp_text = $langF($$attr10_textvar);
	elseif (!empty($attr10_key))
		$tmp_text = $langF($attr10_key);
	elseif (!empty($attr10_var))
		$tmp_text = isset($$attr10_var)?$$attr10_var:'?unset:'.$attr10_var.'?';	
	elseif (!empty($attr10_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr10_raw);
	elseif (!empty($attr10_value))
		$tmp_text = $attr10_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr10_maxlength) && intval($attr10_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr10_maxlength) );
	if	(isset($attr10_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr10_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr10) ?><?php unset($attr10_class) ?><?php unset($attr10_text) ?><?php unset($attr10_escape) ?><?php $attr10_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:35:"message:text_markup_unnumbered_list";s:6:"escape";s:4:"true";}' ?><?php $attr10 = array('class'=>'text','text'=>lang('text_markup_unnumbered_list'),'escape'=>true) ?><?php $attr10_class='text' ?><?php $attr10_text=lang('text_markup_unnumbered_list') ?><?php $attr10_escape=true ?><?php
	if	( isset($attr10_prefix)&& isset($attr10_key))
		$attr10_key = $attr10_prefix.$attr10_key;
	if	( isset($attr10_suffix)&& isset($attr10_key))
		$attr10_key = $attr10_key.$attr10_suffix;
	if(empty($attr10_title))
			$attr10_title = '';
	if	(empty($attr10_type))
		$tmp_tag = 'span';
	else
		switch( $attr10_type )
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
?><<?php echo $tmp_tag ?> class="<?php echo $attr10_class ?>" title="<?php echo $attr10_title ?>"><?php
	$attr10_title = '';
	if	( $attr10_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr10_array))
	{
		$tmpArray = $$attr10_array;
		if (!empty($attr10_var))
			$tmp_text = $tmpArray[$attr10_var];
		else
			$tmp_text = $langF($tmpArray[$attr10_text]);
	}
	elseif (!empty($attr10_text))
		$tmp_text = $langF($attr10_text);
	elseif (!empty($attr10_textvar))
		$tmp_text = $langF($$attr10_textvar);
	elseif (!empty($attr10_key))
		$tmp_text = $langF($attr10_key);
	elseif (!empty($attr10_var))
		$tmp_text = isset($$attr10_var)?$$attr10_var:'?unset:'.$attr10_var.'?';	
	elseif (!empty($attr10_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr10_raw);
	elseif (!empty($attr10_value))
		$tmp_text = $attr10_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr10_maxlength) && intval($attr10_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr10_maxlength) );
	if	(isset($attr10_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr10_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr10) ?><?php unset($attr10_class) ?><?php unset($attr10_text) ?><?php unset($attr10_escape) ?><?php $attr10_debug_info = 'a:0:{}' ?><?php $attr10 = array() ?><br/><?php unset($attr10) ?><?php $attr10_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:41:"config:editor/text-markup/list-unnumbered";s:6:"escape";s:4:"true";}' ?><?php $attr10 = array('class'=>'text','text'=>@$conf['editor']['text-markup']['list-unnumbered'],'escape'=>true) ?><?php $attr10_class='text' ?><?php $attr10_text=@$conf['editor']['text-markup']['list-unnumbered'] ?><?php $attr10_escape=true ?><?php
	if	( isset($attr10_prefix)&& isset($attr10_key))
		$attr10_key = $attr10_prefix.$attr10_key;
	if	( isset($attr10_suffix)&& isset($attr10_key))
		$attr10_key = $attr10_key.$attr10_suffix;
	if(empty($attr10_title))
			$attr10_title = '';
	if	(empty($attr10_type))
		$tmp_tag = 'span';
	else
		switch( $attr10_type )
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
?><<?php echo $tmp_tag ?> class="<?php echo $attr10_class ?>" title="<?php echo $attr10_title ?>"><?php
	$attr10_title = '';
	if	( $attr10_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr10_array))
	{
		$tmpArray = $$attr10_array;
		if (!empty($attr10_var))
			$tmp_text = $tmpArray[$attr10_var];
		else
			$tmp_text = $langF($tmpArray[$attr10_text]);
	}
	elseif (!empty($attr10_text))
		$tmp_text = $langF($attr10_text);
	elseif (!empty($attr10_textvar))
		$tmp_text = $langF($$attr10_textvar);
	elseif (!empty($attr10_key))
		$tmp_text = $langF($attr10_key);
	elseif (!empty($attr10_var))
		$tmp_text = isset($$attr10_var)?$$attr10_var:'?unset:'.$attr10_var.'?';	
	elseif (!empty($attr10_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr10_raw);
	elseif (!empty($attr10_value))
		$tmp_text = $attr10_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr10_maxlength) && intval($attr10_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr10_maxlength) );
	if	(isset($attr10_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr10_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr10) ?><?php unset($attr10_class) ?><?php unset($attr10_text) ?><?php unset($attr10_escape) ?><?php $attr10_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:4:":...";s:6:"escape";s:4:"true";}' ?><?php $attr10 = array('class'=>'text','text'=>'...','escape'=>true) ?><?php $attr10_class='text' ?><?php $attr10_text='...' ?><?php $attr10_escape=true ?><?php
	if	( isset($attr10_prefix)&& isset($attr10_key))
		$attr10_key = $attr10_prefix.$attr10_key;
	if	( isset($attr10_suffix)&& isset($attr10_key))
		$attr10_key = $attr10_key.$attr10_suffix;
	if(empty($attr10_title))
			$attr10_title = '';
	if	(empty($attr10_type))
		$tmp_tag = 'span';
	else
		switch( $attr10_type )
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
?><<?php echo $tmp_tag ?> class="<?php echo $attr10_class ?>" title="<?php echo $attr10_title ?>"><?php
	$attr10_title = '';
	if	( $attr10_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr10_array))
	{
		$tmpArray = $$attr10_array;
		if (!empty($attr10_var))
			$tmp_text = $tmpArray[$attr10_var];
		else
			$tmp_text = $langF($tmpArray[$attr10_text]);
	}
	elseif (!empty($attr10_text))
		$tmp_text = $langF($attr10_text);
	elseif (!empty($attr10_textvar))
		$tmp_text = $langF($$attr10_textvar);
	elseif (!empty($attr10_key))
		$tmp_text = $langF($attr10_key);
	elseif (!empty($attr10_var))
		$tmp_text = isset($$attr10_var)?$$attr10_var:'?unset:'.$attr10_var.'?';	
	elseif (!empty($attr10_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr10_raw);
	elseif (!empty($attr10_value))
		$tmp_text = $attr10_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr10_maxlength) && intval($attr10_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr10_maxlength) );
	if	(isset($attr10_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr10_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr10) ?><?php unset($attr10_class) ?><?php unset($attr10_text) ?><?php unset($attr10_escape) ?><?php $attr10_debug_info = 'a:0:{}' ?><?php $attr10 = array() ?><br/><?php unset($attr10) ?><?php $attr8_debug_info = 'a:0:{}' ?><?php $attr8 = array() ?></td><?php unset($attr8) ?><?php $attr9_debug_info = 'a:0:{}' ?><?php $attr9 = array() ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr9_class))
		$attr9['class']=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr9_rowspan) )
		$attr9['width']=$column_widths[$cell_column_nr-1];
?><td <?php foreach( $attr9 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr9) ?><?php $attr10_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:40:"config:editor/text-markup/table-cell-sep";s:6:"escape";s:4:"true";}' ?><?php $attr10 = array('class'=>'text','text'=>@$conf['editor']['text-markup']['table-cell-sep'],'escape'=>true) ?><?php $attr10_class='text' ?><?php $attr10_text=@$conf['editor']['text-markup']['table-cell-sep'] ?><?php $attr10_escape=true ?><?php
	if	( isset($attr10_prefix)&& isset($attr10_key))
		$attr10_key = $attr10_prefix.$attr10_key;
	if	( isset($attr10_suffix)&& isset($attr10_key))
		$attr10_key = $attr10_key.$attr10_suffix;
	if(empty($attr10_title))
			$attr10_title = '';
	if	(empty($attr10_type))
		$tmp_tag = 'span';
	else
		switch( $attr10_type )
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
?><<?php echo $tmp_tag ?> class="<?php echo $attr10_class ?>" title="<?php echo $attr10_title ?>"><?php
	$attr10_title = '';
	if	( $attr10_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr10_array))
	{
		$tmpArray = $$attr10_array;
		if (!empty($attr10_var))
			$tmp_text = $tmpArray[$attr10_var];
		else
			$tmp_text = $langF($tmpArray[$attr10_text]);
	}
	elseif (!empty($attr10_text))
		$tmp_text = $langF($attr10_text);
	elseif (!empty($attr10_textvar))
		$tmp_text = $langF($$attr10_textvar);
	elseif (!empty($attr10_key))
		$tmp_text = $langF($attr10_key);
	elseif (!empty($attr10_var))
		$tmp_text = isset($$attr10_var)?$$attr10_var:'?unset:'.$attr10_var.'?';	
	elseif (!empty($attr10_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr10_raw);
	elseif (!empty($attr10_value))
		$tmp_text = $attr10_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr10_maxlength) && intval($attr10_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr10_maxlength) );
	if	(isset($attr10_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr10_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr10) ?><?php unset($attr10_class) ?><?php unset($attr10_text) ?><?php unset($attr10_escape) ?><?php $attr10_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:25:"message:text_markup_table";s:6:"escape";s:4:"true";}' ?><?php $attr10 = array('class'=>'text','text'=>lang('text_markup_table'),'escape'=>true) ?><?php $attr10_class='text' ?><?php $attr10_text=lang('text_markup_table') ?><?php $attr10_escape=true ?><?php
	if	( isset($attr10_prefix)&& isset($attr10_key))
		$attr10_key = $attr10_prefix.$attr10_key;
	if	( isset($attr10_suffix)&& isset($attr10_key))
		$attr10_key = $attr10_key.$attr10_suffix;
	if(empty($attr10_title))
			$attr10_title = '';
	if	(empty($attr10_type))
		$tmp_tag = 'span';
	else
		switch( $attr10_type )
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
?><<?php echo $tmp_tag ?> class="<?php echo $attr10_class ?>" title="<?php echo $attr10_title ?>"><?php
	$attr10_title = '';
	if	( $attr10_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr10_array))
	{
		$tmpArray = $$attr10_array;
		if (!empty($attr10_var))
			$tmp_text = $tmpArray[$attr10_var];
		else
			$tmp_text = $langF($tmpArray[$attr10_text]);
	}
	elseif (!empty($attr10_text))
		$tmp_text = $langF($attr10_text);
	elseif (!empty($attr10_textvar))
		$tmp_text = $langF($$attr10_textvar);
	elseif (!empty($attr10_key))
		$tmp_text = $langF($attr10_key);
	elseif (!empty($attr10_var))
		$tmp_text = isset($$attr10_var)?$$attr10_var:'?unset:'.$attr10_var.'?';	
	elseif (!empty($attr10_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr10_raw);
	elseif (!empty($attr10_value))
		$tmp_text = $attr10_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr10_maxlength) && intval($attr10_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr10_maxlength) );
	if	(isset($attr10_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr10_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr10) ?><?php unset($attr10_class) ?><?php unset($attr10_text) ?><?php unset($attr10_escape) ?><?php $attr10_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:40:"config:editor/text-markup/table-cell-sep";s:6:"escape";s:4:"true";}' ?><?php $attr10 = array('class'=>'text','text'=>@$conf['editor']['text-markup']['table-cell-sep'],'escape'=>true) ?><?php $attr10_class='text' ?><?php $attr10_text=@$conf['editor']['text-markup']['table-cell-sep'] ?><?php $attr10_escape=true ?><?php
	if	( isset($attr10_prefix)&& isset($attr10_key))
		$attr10_key = $attr10_prefix.$attr10_key;
	if	( isset($attr10_suffix)&& isset($attr10_key))
		$attr10_key = $attr10_key.$attr10_suffix;
	if(empty($attr10_title))
			$attr10_title = '';
	if	(empty($attr10_type))
		$tmp_tag = 'span';
	else
		switch( $attr10_type )
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
?><<?php echo $tmp_tag ?> class="<?php echo $attr10_class ?>" title="<?php echo $attr10_title ?>"><?php
	$attr10_title = '';
	if	( $attr10_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr10_array))
	{
		$tmpArray = $$attr10_array;
		if (!empty($attr10_var))
			$tmp_text = $tmpArray[$attr10_var];
		else
			$tmp_text = $langF($tmpArray[$attr10_text]);
	}
	elseif (!empty($attr10_text))
		$tmp_text = $langF($attr10_text);
	elseif (!empty($attr10_textvar))
		$tmp_text = $langF($$attr10_textvar);
	elseif (!empty($attr10_key))
		$tmp_text = $langF($attr10_key);
	elseif (!empty($attr10_var))
		$tmp_text = isset($$attr10_var)?$$attr10_var:'?unset:'.$attr10_var.'?';	
	elseif (!empty($attr10_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr10_raw);
	elseif (!empty($attr10_value))
		$tmp_text = $attr10_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr10_maxlength) && intval($attr10_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr10_maxlength) );
	if	(isset($attr10_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr10_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr10) ?><?php unset($attr10_class) ?><?php unset($attr10_text) ?><?php unset($attr10_escape) ?><?php $attr10_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:4:":...";s:6:"escape";s:4:"true";}' ?><?php $attr10 = array('class'=>'text','text'=>'...','escape'=>true) ?><?php $attr10_class='text' ?><?php $attr10_text='...' ?><?php $attr10_escape=true ?><?php
	if	( isset($attr10_prefix)&& isset($attr10_key))
		$attr10_key = $attr10_prefix.$attr10_key;
	if	( isset($attr10_suffix)&& isset($attr10_key))
		$attr10_key = $attr10_key.$attr10_suffix;
	if(empty($attr10_title))
			$attr10_title = '';
	if	(empty($attr10_type))
		$tmp_tag = 'span';
	else
		switch( $attr10_type )
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
?><<?php echo $tmp_tag ?> class="<?php echo $attr10_class ?>" title="<?php echo $attr10_title ?>"><?php
	$attr10_title = '';
	if	( $attr10_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr10_array))
	{
		$tmpArray = $$attr10_array;
		if (!empty($attr10_var))
			$tmp_text = $tmpArray[$attr10_var];
		else
			$tmp_text = $langF($tmpArray[$attr10_text]);
	}
	elseif (!empty($attr10_text))
		$tmp_text = $langF($attr10_text);
	elseif (!empty($attr10_textvar))
		$tmp_text = $langF($$attr10_textvar);
	elseif (!empty($attr10_key))
		$tmp_text = $langF($attr10_key);
	elseif (!empty($attr10_var))
		$tmp_text = isset($$attr10_var)?$$attr10_var:'?unset:'.$attr10_var.'?';	
	elseif (!empty($attr10_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr10_raw);
	elseif (!empty($attr10_value))
		$tmp_text = $attr10_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr10_maxlength) && intval($attr10_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr10_maxlength) );
	if	(isset($attr10_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr10_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr10) ?><?php unset($attr10_class) ?><?php unset($attr10_text) ?><?php unset($attr10_escape) ?><?php $attr10_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:40:"config:editor/text-markup/table-cell-sep";s:6:"escape";s:4:"true";}' ?><?php $attr10 = array('class'=>'text','text'=>@$conf['editor']['text-markup']['table-cell-sep'],'escape'=>true) ?><?php $attr10_class='text' ?><?php $attr10_text=@$conf['editor']['text-markup']['table-cell-sep'] ?><?php $attr10_escape=true ?><?php
	if	( isset($attr10_prefix)&& isset($attr10_key))
		$attr10_key = $attr10_prefix.$attr10_key;
	if	( isset($attr10_suffix)&& isset($attr10_key))
		$attr10_key = $attr10_key.$attr10_suffix;
	if(empty($attr10_title))
			$attr10_title = '';
	if	(empty($attr10_type))
		$tmp_tag = 'span';
	else
		switch( $attr10_type )
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
?><<?php echo $tmp_tag ?> class="<?php echo $attr10_class ?>" title="<?php echo $attr10_title ?>"><?php
	$attr10_title = '';
	if	( $attr10_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr10_array))
	{
		$tmpArray = $$attr10_array;
		if (!empty($attr10_var))
			$tmp_text = $tmpArray[$attr10_var];
		else
			$tmp_text = $langF($tmpArray[$attr10_text]);
	}
	elseif (!empty($attr10_text))
		$tmp_text = $langF($attr10_text);
	elseif (!empty($attr10_textvar))
		$tmp_text = $langF($$attr10_textvar);
	elseif (!empty($attr10_key))
		$tmp_text = $langF($attr10_key);
	elseif (!empty($attr10_var))
		$tmp_text = isset($$attr10_var)?$$attr10_var:'?unset:'.$attr10_var.'?';	
	elseif (!empty($attr10_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr10_raw);
	elseif (!empty($attr10_value))
		$tmp_text = $attr10_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr10_maxlength) && intval($attr10_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr10_maxlength) );
	if	(isset($attr10_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr10_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr10) ?><?php unset($attr10_class) ?><?php unset($attr10_text) ?><?php unset($attr10_escape) ?><?php $attr10_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:4:":...";s:6:"escape";s:4:"true";}' ?><?php $attr10 = array('class'=>'text','text'=>'...','escape'=>true) ?><?php $attr10_class='text' ?><?php $attr10_text='...' ?><?php $attr10_escape=true ?><?php
	if	( isset($attr10_prefix)&& isset($attr10_key))
		$attr10_key = $attr10_prefix.$attr10_key;
	if	( isset($attr10_suffix)&& isset($attr10_key))
		$attr10_key = $attr10_key.$attr10_suffix;
	if(empty($attr10_title))
			$attr10_title = '';
	if	(empty($attr10_type))
		$tmp_tag = 'span';
	else
		switch( $attr10_type )
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
?><<?php echo $tmp_tag ?> class="<?php echo $attr10_class ?>" title="<?php echo $attr10_title ?>"><?php
	$attr10_title = '';
	if	( $attr10_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr10_array))
	{
		$tmpArray = $$attr10_array;
		if (!empty($attr10_var))
			$tmp_text = $tmpArray[$attr10_var];
		else
			$tmp_text = $langF($tmpArray[$attr10_text]);
	}
	elseif (!empty($attr10_text))
		$tmp_text = $langF($attr10_text);
	elseif (!empty($attr10_textvar))
		$tmp_text = $langF($$attr10_textvar);
	elseif (!empty($attr10_key))
		$tmp_text = $langF($attr10_key);
	elseif (!empty($attr10_var))
		$tmp_text = isset($$attr10_var)?$$attr10_var:'?unset:'.$attr10_var.'?';	
	elseif (!empty($attr10_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr10_raw);
	elseif (!empty($attr10_value))
		$tmp_text = $attr10_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr10_maxlength) && intval($attr10_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr10_maxlength) );
	if	(isset($attr10_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr10_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr10) ?><?php unset($attr10_class) ?><?php unset($attr10_text) ?><?php unset($attr10_escape) ?><?php $attr10_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:40:"config:editor/text-markup/table-cell-sep";s:6:"escape";s:4:"true";}' ?><?php $attr10 = array('class'=>'text','text'=>@$conf['editor']['text-markup']['table-cell-sep'],'escape'=>true) ?><?php $attr10_class='text' ?><?php $attr10_text=@$conf['editor']['text-markup']['table-cell-sep'] ?><?php $attr10_escape=true ?><?php
	if	( isset($attr10_prefix)&& isset($attr10_key))
		$attr10_key = $attr10_prefix.$attr10_key;
	if	( isset($attr10_suffix)&& isset($attr10_key))
		$attr10_key = $attr10_key.$attr10_suffix;
	if(empty($attr10_title))
			$attr10_title = '';
	if	(empty($attr10_type))
		$tmp_tag = 'span';
	else
		switch( $attr10_type )
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
?><<?php echo $tmp_tag ?> class="<?php echo $attr10_class ?>" title="<?php echo $attr10_title ?>"><?php
	$attr10_title = '';
	if	( $attr10_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr10_array))
	{
		$tmpArray = $$attr10_array;
		if (!empty($attr10_var))
			$tmp_text = $tmpArray[$attr10_var];
		else
			$tmp_text = $langF($tmpArray[$attr10_text]);
	}
	elseif (!empty($attr10_text))
		$tmp_text = $langF($attr10_text);
	elseif (!empty($attr10_textvar))
		$tmp_text = $langF($$attr10_textvar);
	elseif (!empty($attr10_key))
		$tmp_text = $langF($attr10_key);
	elseif (!empty($attr10_var))
		$tmp_text = isset($$attr10_var)?$$attr10_var:'?unset:'.$attr10_var.'?';	
	elseif (!empty($attr10_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr10_raw);
	elseif (!empty($attr10_value))
		$tmp_text = $attr10_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr10_maxlength) && intval($attr10_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr10_maxlength) );
	if	(isset($attr10_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr10_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr10) ?><?php unset($attr10_class) ?><?php unset($attr10_text) ?><?php unset($attr10_escape) ?><?php $attr10_debug_info = 'a:0:{}' ?><?php $attr10 = array() ?><br/><?php unset($attr10) ?><?php $attr10_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:40:"config:editor/text-markup/table-cell-sep";s:6:"escape";s:4:"true";}' ?><?php $attr10 = array('class'=>'text','text'=>@$conf['editor']['text-markup']['table-cell-sep'],'escape'=>true) ?><?php $attr10_class='text' ?><?php $attr10_text=@$conf['editor']['text-markup']['table-cell-sep'] ?><?php $attr10_escape=true ?><?php
	if	( isset($attr10_prefix)&& isset($attr10_key))
		$attr10_key = $attr10_prefix.$attr10_key;
	if	( isset($attr10_suffix)&& isset($attr10_key))
		$attr10_key = $attr10_key.$attr10_suffix;
	if(empty($attr10_title))
			$attr10_title = '';
	if	(empty($attr10_type))
		$tmp_tag = 'span';
	else
		switch( $attr10_type )
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
?><<?php echo $tmp_tag ?> class="<?php echo $attr10_class ?>" title="<?php echo $attr10_title ?>"><?php
	$attr10_title = '';
	if	( $attr10_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr10_array))
	{
		$tmpArray = $$attr10_array;
		if (!empty($attr10_var))
			$tmp_text = $tmpArray[$attr10_var];
		else
			$tmp_text = $langF($tmpArray[$attr10_text]);
	}
	elseif (!empty($attr10_text))
		$tmp_text = $langF($attr10_text);
	elseif (!empty($attr10_textvar))
		$tmp_text = $langF($$attr10_textvar);
	elseif (!empty($attr10_key))
		$tmp_text = $langF($attr10_key);
	elseif (!empty($attr10_var))
		$tmp_text = isset($$attr10_var)?$$attr10_var:'?unset:'.$attr10_var.'?';	
	elseif (!empty($attr10_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr10_raw);
	elseif (!empty($attr10_value))
		$tmp_text = $attr10_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr10_maxlength) && intval($attr10_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr10_maxlength) );
	if	(isset($attr10_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr10_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr10) ?><?php unset($attr10_class) ?><?php unset($attr10_text) ?><?php unset($attr10_escape) ?><?php $attr10_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:4:":...";s:6:"escape";s:4:"true";}' ?><?php $attr10 = array('class'=>'text','text'=>'...','escape'=>true) ?><?php $attr10_class='text' ?><?php $attr10_text='...' ?><?php $attr10_escape=true ?><?php
	if	( isset($attr10_prefix)&& isset($attr10_key))
		$attr10_key = $attr10_prefix.$attr10_key;
	if	( isset($attr10_suffix)&& isset($attr10_key))
		$attr10_key = $attr10_key.$attr10_suffix;
	if(empty($attr10_title))
			$attr10_title = '';
	if	(empty($attr10_type))
		$tmp_tag = 'span';
	else
		switch( $attr10_type )
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
?><<?php echo $tmp_tag ?> class="<?php echo $attr10_class ?>" title="<?php echo $attr10_title ?>"><?php
	$attr10_title = '';
	if	( $attr10_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr10_array))
	{
		$tmpArray = $$attr10_array;
		if (!empty($attr10_var))
			$tmp_text = $tmpArray[$attr10_var];
		else
			$tmp_text = $langF($tmpArray[$attr10_text]);
	}
	elseif (!empty($attr10_text))
		$tmp_text = $langF($attr10_text);
	elseif (!empty($attr10_textvar))
		$tmp_text = $langF($$attr10_textvar);
	elseif (!empty($attr10_key))
		$tmp_text = $langF($attr10_key);
	elseif (!empty($attr10_var))
		$tmp_text = isset($$attr10_var)?$$attr10_var:'?unset:'.$attr10_var.'?';	
	elseif (!empty($attr10_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr10_raw);
	elseif (!empty($attr10_value))
		$tmp_text = $attr10_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr10_maxlength) && intval($attr10_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr10_maxlength) );
	if	(isset($attr10_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr10_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr10) ?><?php unset($attr10_class) ?><?php unset($attr10_text) ?><?php unset($attr10_escape) ?><?php $attr10_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:40:"config:editor/text-markup/table-cell-sep";s:6:"escape";s:4:"true";}' ?><?php $attr10 = array('class'=>'text','text'=>@$conf['editor']['text-markup']['table-cell-sep'],'escape'=>true) ?><?php $attr10_class='text' ?><?php $attr10_text=@$conf['editor']['text-markup']['table-cell-sep'] ?><?php $attr10_escape=true ?><?php
	if	( isset($attr10_prefix)&& isset($attr10_key))
		$attr10_key = $attr10_prefix.$attr10_key;
	if	( isset($attr10_suffix)&& isset($attr10_key))
		$attr10_key = $attr10_key.$attr10_suffix;
	if(empty($attr10_title))
			$attr10_title = '';
	if	(empty($attr10_type))
		$tmp_tag = 'span';
	else
		switch( $attr10_type )
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
?><<?php echo $tmp_tag ?> class="<?php echo $attr10_class ?>" title="<?php echo $attr10_title ?>"><?php
	$attr10_title = '';
	if	( $attr10_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr10_array))
	{
		$tmpArray = $$attr10_array;
		if (!empty($attr10_var))
			$tmp_text = $tmpArray[$attr10_var];
		else
			$tmp_text = $langF($tmpArray[$attr10_text]);
	}
	elseif (!empty($attr10_text))
		$tmp_text = $langF($attr10_text);
	elseif (!empty($attr10_textvar))
		$tmp_text = $langF($$attr10_textvar);
	elseif (!empty($attr10_key))
		$tmp_text = $langF($attr10_key);
	elseif (!empty($attr10_var))
		$tmp_text = isset($$attr10_var)?$$attr10_var:'?unset:'.$attr10_var.'?';	
	elseif (!empty($attr10_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr10_raw);
	elseif (!empty($attr10_value))
		$tmp_text = $attr10_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr10_maxlength) && intval($attr10_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr10_maxlength) );
	if	(isset($attr10_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr10_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr10) ?><?php unset($attr10_class) ?><?php unset($attr10_text) ?><?php unset($attr10_escape) ?><?php $attr10_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:4:":...";s:6:"escape";s:4:"true";}' ?><?php $attr10 = array('class'=>'text','text'=>'...','escape'=>true) ?><?php $attr10_class='text' ?><?php $attr10_text='...' ?><?php $attr10_escape=true ?><?php
	if	( isset($attr10_prefix)&& isset($attr10_key))
		$attr10_key = $attr10_prefix.$attr10_key;
	if	( isset($attr10_suffix)&& isset($attr10_key))
		$attr10_key = $attr10_key.$attr10_suffix;
	if(empty($attr10_title))
			$attr10_title = '';
	if	(empty($attr10_type))
		$tmp_tag = 'span';
	else
		switch( $attr10_type )
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
?><<?php echo $tmp_tag ?> class="<?php echo $attr10_class ?>" title="<?php echo $attr10_title ?>"><?php
	$attr10_title = '';
	if	( $attr10_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr10_array))
	{
		$tmpArray = $$attr10_array;
		if (!empty($attr10_var))
			$tmp_text = $tmpArray[$attr10_var];
		else
			$tmp_text = $langF($tmpArray[$attr10_text]);
	}
	elseif (!empty($attr10_text))
		$tmp_text = $langF($attr10_text);
	elseif (!empty($attr10_textvar))
		$tmp_text = $langF($$attr10_textvar);
	elseif (!empty($attr10_key))
		$tmp_text = $langF($attr10_key);
	elseif (!empty($attr10_var))
		$tmp_text = isset($$attr10_var)?$$attr10_var:'?unset:'.$attr10_var.'?';	
	elseif (!empty($attr10_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr10_raw);
	elseif (!empty($attr10_value))
		$tmp_text = $attr10_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr10_maxlength) && intval($attr10_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr10_maxlength) );
	if	(isset($attr10_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr10_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr10) ?><?php unset($attr10_class) ?><?php unset($attr10_text) ?><?php unset($attr10_escape) ?><?php $attr10_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:40:"config:editor/text-markup/table-cell-sep";s:6:"escape";s:4:"true";}' ?><?php $attr10 = array('class'=>'text','text'=>@$conf['editor']['text-markup']['table-cell-sep'],'escape'=>true) ?><?php $attr10_class='text' ?><?php $attr10_text=@$conf['editor']['text-markup']['table-cell-sep'] ?><?php $attr10_escape=true ?><?php
	if	( isset($attr10_prefix)&& isset($attr10_key))
		$attr10_key = $attr10_prefix.$attr10_key;
	if	( isset($attr10_suffix)&& isset($attr10_key))
		$attr10_key = $attr10_key.$attr10_suffix;
	if(empty($attr10_title))
			$attr10_title = '';
	if	(empty($attr10_type))
		$tmp_tag = 'span';
	else
		switch( $attr10_type )
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
?><<?php echo $tmp_tag ?> class="<?php echo $attr10_class ?>" title="<?php echo $attr10_title ?>"><?php
	$attr10_title = '';
	if	( $attr10_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr10_array))
	{
		$tmpArray = $$attr10_array;
		if (!empty($attr10_var))
			$tmp_text = $tmpArray[$attr10_var];
		else
			$tmp_text = $langF($tmpArray[$attr10_text]);
	}
	elseif (!empty($attr10_text))
		$tmp_text = $langF($attr10_text);
	elseif (!empty($attr10_textvar))
		$tmp_text = $langF($$attr10_textvar);
	elseif (!empty($attr10_key))
		$tmp_text = $langF($attr10_key);
	elseif (!empty($attr10_var))
		$tmp_text = isset($$attr10_var)?$$attr10_var:'?unset:'.$attr10_var.'?';	
	elseif (!empty($attr10_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr10_raw);
	elseif (!empty($attr10_value))
		$tmp_text = $attr10_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr10_maxlength) && intval($attr10_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr10_maxlength) );
	if	(isset($attr10_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr10_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr10) ?><?php unset($attr10_class) ?><?php unset($attr10_text) ?><?php unset($attr10_escape) ?><?php $attr10_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:4:":...";s:6:"escape";s:4:"true";}' ?><?php $attr10 = array('class'=>'text','text'=>'...','escape'=>true) ?><?php $attr10_class='text' ?><?php $attr10_text='...' ?><?php $attr10_escape=true ?><?php
	if	( isset($attr10_prefix)&& isset($attr10_key))
		$attr10_key = $attr10_prefix.$attr10_key;
	if	( isset($attr10_suffix)&& isset($attr10_key))
		$attr10_key = $attr10_key.$attr10_suffix;
	if(empty($attr10_title))
			$attr10_title = '';
	if	(empty($attr10_type))
		$tmp_tag = 'span';
	else
		switch( $attr10_type )
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
?><<?php echo $tmp_tag ?> class="<?php echo $attr10_class ?>" title="<?php echo $attr10_title ?>"><?php
	$attr10_title = '';
	if	( $attr10_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr10_array))
	{
		$tmpArray = $$attr10_array;
		if (!empty($attr10_var))
			$tmp_text = $tmpArray[$attr10_var];
		else
			$tmp_text = $langF($tmpArray[$attr10_text]);
	}
	elseif (!empty($attr10_text))
		$tmp_text = $langF($attr10_text);
	elseif (!empty($attr10_textvar))
		$tmp_text = $langF($$attr10_textvar);
	elseif (!empty($attr10_key))
		$tmp_text = $langF($attr10_key);
	elseif (!empty($attr10_var))
		$tmp_text = isset($$attr10_var)?$$attr10_var:'?unset:'.$attr10_var.'?';	
	elseif (!empty($attr10_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr10_raw);
	elseif (!empty($attr10_value))
		$tmp_text = $attr10_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr10_maxlength) && intval($attr10_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr10_maxlength) );
	if	(isset($attr10_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr10_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr10) ?><?php unset($attr10_class) ?><?php unset($attr10_text) ?><?php unset($attr10_escape) ?><?php $attr10_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:40:"config:editor/text-markup/table-cell-sep";s:6:"escape";s:4:"true";}' ?><?php $attr10 = array('class'=>'text','text'=>@$conf['editor']['text-markup']['table-cell-sep'],'escape'=>true) ?><?php $attr10_class='text' ?><?php $attr10_text=@$conf['editor']['text-markup']['table-cell-sep'] ?><?php $attr10_escape=true ?><?php
	if	( isset($attr10_prefix)&& isset($attr10_key))
		$attr10_key = $attr10_prefix.$attr10_key;
	if	( isset($attr10_suffix)&& isset($attr10_key))
		$attr10_key = $attr10_key.$attr10_suffix;
	if(empty($attr10_title))
			$attr10_title = '';
	if	(empty($attr10_type))
		$tmp_tag = 'span';
	else
		switch( $attr10_type )
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
?><<?php echo $tmp_tag ?> class="<?php echo $attr10_class ?>" title="<?php echo $attr10_title ?>"><?php
	$attr10_title = '';
	if	( $attr10_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr10_array))
	{
		$tmpArray = $$attr10_array;
		if (!empty($attr10_var))
			$tmp_text = $tmpArray[$attr10_var];
		else
			$tmp_text = $langF($tmpArray[$attr10_text]);
	}
	elseif (!empty($attr10_text))
		$tmp_text = $langF($attr10_text);
	elseif (!empty($attr10_textvar))
		$tmp_text = $langF($$attr10_textvar);
	elseif (!empty($attr10_key))
		$tmp_text = $langF($attr10_key);
	elseif (!empty($attr10_var))
		$tmp_text = isset($$attr10_var)?$$attr10_var:'?unset:'.$attr10_var.'?';	
	elseif (!empty($attr10_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr10_raw);
	elseif (!empty($attr10_value))
		$tmp_text = $attr10_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr10_maxlength) && intval($attr10_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr10_maxlength) );
	if	(isset($attr10_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr10_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr10) ?><?php unset($attr10_class) ?><?php unset($attr10_text) ?><?php unset($attr10_escape) ?><?php $attr10_debug_info = 'a:0:{}' ?><?php $attr10 = array() ?><br/><?php unset($attr10) ?><?php $attr8_debug_info = 'a:0:{}' ?><?php $attr8 = array() ?></td><?php unset($attr8) ?><?php $attr7_debug_info = 'a:0:{}' ?><?php $attr7 = array() ?></table><?php unset($attr7) ?><?php $attr6_debug_info = 'a:0:{}' ?><?php $attr6 = array() ?><?php } ?><?php unset($attr6) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php } ?><?php unset($attr3) ?><?php $attr4_debug_info = 'a:2:{s:6:"equals";s:4:"link";s:5:"value";s:8:"var:type";}' ?><?php $attr4 = array('equals'=>'link','value'=>$type) ?><?php $attr4_equals='link' ?><?php $attr4_value=$type ?><?php 
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
<?php unset($attr4) ?><?php unset($attr4_equals) ?><?php unset($attr4_value) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];
	if (empty($attr5_class))
		$attr5_class=$row_class;
	global $cell_column_nr;
	$cell_column_nr=0;
	$column_class_idx = 999;
?><tr class="<?php echo $attr5_class ?>"><?php unset($attr5) ?><?php $attr6_debug_info = 'a:2:{s:5:"class";s:2:"fx";s:7:"colspan";s:1:"2";}' ?><?php $attr6 = array('class'=>'fx','colspan'=>'2') ?><?php $attr6_class='fx' ?><?php $attr6_colspan='2' ?><?php
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_colspan) ?><?php $attr7_debug_info = 'a:9:{s:4:"list";s:7:"objects";s:4:"name";s:12:"linkobjectid";s:8:"onchange";s:0:"";s:5:"title";s:0:"";s:5:"class";s:0:"";s:8:"addempty";s:5:"false";s:8:"multiple";s:5:"false";s:4:"size";s:1:"1";s:4:"lang";s:5:"false";}' ?><?php $attr7 = array('list'=>'objects','name'=>'linkobjectid','onchange'=>'','title'=>'','class'=>'','addempty'=>false,'multiple'=>false,'size'=>'1','lang'=>false) ?><?php $attr7_list='objects' ?><?php $attr7_name='linkobjectid' ?><?php $attr7_onchange='' ?><?php $attr7_title='' ?><?php $attr7_class='' ?><?php $attr7_addempty=false ?><?php $attr7_multiple=false ?><?php $attr7_size='1' ?><?php $attr7_lang=false ?><?php
if ($this->isEditable() && $this->getRequestVar('mode')!='edit') $attr7_readonly=true;
if ( $attr7_addempty!==FALSE  )
{
	if ($attr7_addempty===TRUE)
		$$attr7_list = array(''=>lang('LIST_ENTRY_EMPTY'))+$$attr7_list;
	else
		$$attr7_list = array(''=>'- '.lang($attr7_addempty).' -')+$$attr7_list;
}
?><select<?php if ($attr7_readonly) echo ' disabled="disabled"' ?> id="id_<?php echo $attr7_name ?>"  name="<?php echo $attr7_name; if ($attr7_multiple) echo '[]'; ?>" onchange="<?php echo $attr7_onchange ?>" title="<?php echo $attr7_title ?>" class="<?php echo $attr7_class ?>"<?php
if (count($$attr7_list)<=1) echo ' disabled="disabled"';
if	($attr7_multiple) echo ' multiple="multiple"';
if (in_array($attr7_name,$errors)) echo ' style="background-color:red; border:2px dashed red;"';
echo ' size="'.intval($attr7_size).'"';
?>><?php
		$attr7_tmp_list = $$attr7_list;
		if	( isset($$attr7_name) && isset($attr7_tmp_list[$$attr7_name]) )
			$attr7_tmp_default = $$attr7_name;
		elseif ( isset($attr7_default) )
			$attr7_tmp_default = $attr7_default;
		else
			$attr7_tmp_default = '';
		foreach( $attr7_tmp_list as $box_key=>$box_value )
		{
			if	( is_array($box_value) )
			{
				$box_key   = $box_value['key'  ];
				$box_title = $box_value['title'];
				$box_value = $box_value['value'];
			}
			elseif( $attr7_lang )
			{
				$box_title = lang( $box_value.'_DESC');
				$box_value = lang( $box_value        );
			}
			else
			{
				$box_title = '';
			}
			echo '<option class="'.$attr7_class.'" value="'.$box_key.'" title="'.$box_title.'"';
			if ($box_key==$attr7_tmp_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select><?php
if (count($$attr7_list)==0) echo '<input type="hidden" name="'.$attr7_name.'" value="" />';
if (count($$attr7_list)==1) echo '<input type="hidden" name="'.$attr7_name.'" value="'.$box_key.'" />'
?><?php unset($attr7) ?><?php unset($attr7_list) ?><?php unset($attr7_name) ?><?php unset($attr7_onchange) ?><?php unset($attr7_title) ?><?php unset($attr7_class) ?><?php unset($attr7_addempty) ?><?php unset($attr7_multiple) ?><?php unset($attr7_size) ?><?php unset($attr7_lang) ?><?php $attr7_debug_info = 'a:1:{s:5:"field";s:12:"linkobjectid";}' ?><?php $attr7 = array('field'=>'linkobjectid') ?><?php $attr7_field='linkobjectid' ?><?php
if (isset($errors[0])) $attr7_field = $errors[0];
?><script name="JavaScript" type="text/javascript"><!--
document.forms[0].<?php echo $attr7_field ?>.focus();
document.forms[0].<?php echo $attr7_field ?>.select();
</script>
<?php unset($attr7) ?><?php unset($attr7_field) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php } ?><?php unset($attr3) ?><?php $attr4_debug_info = 'a:2:{s:6:"equals";s:4:"list";s:5:"value";s:8:"var:type";}' ?><?php $attr4 = array('equals'=>'list','value'=>$type) ?><?php $attr4_equals='list' ?><?php $attr4_value=$type ?><?php 
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
<?php unset($attr4) ?><?php unset($attr4_equals) ?><?php unset($attr4_value) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];
	if (empty($attr5_class))
		$attr5_class=$row_class;
	global $cell_column_nr;
	$cell_column_nr=0;
	$column_class_idx = 999;
?><tr class="<?php echo $attr5_class ?>"><?php unset($attr5) ?><?php $attr6_debug_info = 'a:2:{s:5:"class";s:2:"fx";s:7:"colspan";s:1:"2";}' ?><?php $attr6 = array('class'=>'fx','colspan'=>'2') ?><?php $attr6_class='fx' ?><?php $attr6_colspan='2' ?><?php
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_colspan) ?><?php $attr7_debug_info = 'a:9:{s:4:"list";s:7:"objects";s:4:"name";s:12:"linkobjectid";s:8:"onchange";s:0:"";s:5:"title";s:0:"";s:5:"class";s:0:"";s:8:"addempty";s:5:"false";s:8:"multiple";s:5:"false";s:4:"size";s:1:"1";s:4:"lang";s:5:"false";}' ?><?php $attr7 = array('list'=>'objects','name'=>'linkobjectid','onchange'=>'','title'=>'','class'=>'','addempty'=>false,'multiple'=>false,'size'=>'1','lang'=>false) ?><?php $attr7_list='objects' ?><?php $attr7_name='linkobjectid' ?><?php $attr7_onchange='' ?><?php $attr7_title='' ?><?php $attr7_class='' ?><?php $attr7_addempty=false ?><?php $attr7_multiple=false ?><?php $attr7_size='1' ?><?php $attr7_lang=false ?><?php
if ($this->isEditable() && $this->getRequestVar('mode')!='edit') $attr7_readonly=true;
if ( $attr7_addempty!==FALSE  )
{
	if ($attr7_addempty===TRUE)
		$$attr7_list = array(''=>lang('LIST_ENTRY_EMPTY'))+$$attr7_list;
	else
		$$attr7_list = array(''=>'- '.lang($attr7_addempty).' -')+$$attr7_list;
}
?><select<?php if ($attr7_readonly) echo ' disabled="disabled"' ?> id="id_<?php echo $attr7_name ?>"  name="<?php echo $attr7_name; if ($attr7_multiple) echo '[]'; ?>" onchange="<?php echo $attr7_onchange ?>" title="<?php echo $attr7_title ?>" class="<?php echo $attr7_class ?>"<?php
if (count($$attr7_list)<=1) echo ' disabled="disabled"';
if	($attr7_multiple) echo ' multiple="multiple"';
if (in_array($attr7_name,$errors)) echo ' style="background-color:red; border:2px dashed red;"';
echo ' size="'.intval($attr7_size).'"';
?>><?php
		$attr7_tmp_list = $$attr7_list;
		if	( isset($$attr7_name) && isset($attr7_tmp_list[$$attr7_name]) )
			$attr7_tmp_default = $$attr7_name;
		elseif ( isset($attr7_default) )
			$attr7_tmp_default = $attr7_default;
		else
			$attr7_tmp_default = '';
		foreach( $attr7_tmp_list as $box_key=>$box_value )
		{
			if	( is_array($box_value) )
			{
				$box_key   = $box_value['key'  ];
				$box_title = $box_value['title'];
				$box_value = $box_value['value'];
			}
			elseif( $attr7_lang )
			{
				$box_title = lang( $box_value.'_DESC');
				$box_value = lang( $box_value        );
			}
			else
			{
				$box_title = '';
			}
			echo '<option class="'.$attr7_class.'" value="'.$box_key.'" title="'.$box_title.'"';
			if ($box_key==$attr7_tmp_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select><?php
if (count($$attr7_list)==0) echo '<input type="hidden" name="'.$attr7_name.'" value="" />';
if (count($$attr7_list)==1) echo '<input type="hidden" name="'.$attr7_name.'" value="'.$box_key.'" />'
?><?php unset($attr7) ?><?php unset($attr7_list) ?><?php unset($attr7_name) ?><?php unset($attr7_onchange) ?><?php unset($attr7_title) ?><?php unset($attr7_class) ?><?php unset($attr7_addempty) ?><?php unset($attr7_multiple) ?><?php unset($attr7_size) ?><?php unset($attr7_lang) ?><?php $attr7_debug_info = 'a:1:{s:5:"field";s:12:"linkobjectid";}' ?><?php $attr7 = array('field'=>'linkobjectid') ?><?php $attr7_field='linkobjectid' ?><?php
if (isset($errors[0])) $attr7_field = $errors[0];
?><script name="JavaScript" type="text/javascript"><!--
document.forms[0].<?php echo $attr7_field ?>.focus();
document.forms[0].<?php echo $attr7_field ?>.select();
</script>
<?php unset($attr7) ?><?php unset($attr7_field) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php } ?><?php unset($attr3) ?><?php $attr4_debug_info = 'a:2:{s:6:"equals";s:6:"number";s:5:"value";s:8:"var:type";}' ?><?php $attr4 = array('equals'=>'number','value'=>$type) ?><?php $attr4_equals='number' ?><?php $attr4_value=$type ?><?php 
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
<?php unset($attr4) ?><?php unset($attr4_equals) ?><?php unset($attr4_value) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];
	if (empty($attr5_class))
		$attr5_class=$row_class;
	global $cell_column_nr;
	$cell_column_nr=0;
	$column_class_idx = 999;
?><tr class="<?php echo $attr5_class ?>"><?php unset($attr5) ?><?php $attr6_debug_info = 'a:2:{s:5:"class";s:2:"fx";s:7:"colspan";s:1:"2";}' ?><?php $attr6 = array('class'=>'fx','colspan'=>'2') ?><?php $attr6_class='fx' ?><?php $attr6_colspan='2' ?><?php
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_colspan) ?><?php $attr7_debug_info = 'a:2:{s:4:"name";s:8:"decimals";s:7:"default";s:8:"decimals";}' ?><?php $attr7 = array('name'=>'decimals','default'=>'decimals') ?><?php $attr7_name='decimals' ?><?php $attr7_default='decimals' ?><?php
if (isset($$attr7_name))
	$attr7_tmp_value = $$attr7_name;
elseif ( isset($attr7_default) )
	$attr7_tmp_value = $attr7_default;
else
	$attr7_tmp_value = "";
?><input type="hidden" name="<?php echo $attr7_name ?>" value="<?php echo $attr7_tmp_value ?>" /><?php unset($attr7) ?><?php unset($attr7_name) ?><?php unset($attr7_default) ?><?php $attr7_debug_info = 'a:8:{s:5:"class";s:0:"";s:7:"default";s:0:"";s:4:"type";s:4:"text";s:4:"name";s:6:"number";s:4:"size";s:2:"15";s:9:"maxlength";s:2:"20";s:8:"onchange";s:0:"";s:8:"readonly";s:5:"false";}' ?><?php $attr7 = array('class'=>'','default'=>'','type'=>'text','name'=>'number','size'=>'15','maxlength'=>'20','onchange'=>'','readonly'=>false) ?><?php $attr7_class='' ?><?php $attr7_default='' ?><?php $attr7_type='text' ?><?php $attr7_name='number' ?><?php $attr7_size='15' ?><?php $attr7_maxlength='20' ?><?php $attr7_onchange='' ?><?php $attr7_readonly=false ?><?php if ($this->isEditable() && $this->getRequestVar('mode')!='edit') $attr7_readonly=true;
	  if ($attr7_readonly && empty($$attr7_name)) $$attr7_name = '- '.lang('EMPTY').' -';
      if(!isset($attr7_default)) $attr7_default='';
?><?php if (!$attr7_readonly || $attr7_type=='hidden') {
?><input<?php if ($attr7_readonly) echo ' disabled="true"' ?> id="id_<?php echo $attr7_name ?><?php if ($attr7_readonly) echo '_disabled' ?>" name="<?php echo $attr7_name ?><?php if ($attr7_readonly) echo '_disabled' ?>" type="<?php echo $attr7_type ?>" size="<?php echo $attr7_size ?>" maxlength="<?php echo $attr7_maxlength ?>" class="<?php echo $attr7_class ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" <?php if (in_array($attr7_name,$errors)) echo 'style="border-rightx:10px solid red; background-colorx:yellow; border:2px dashed red;"' ?> /><?php
if	($attr7_readonly) {
?><input type="hidden" id="id_<?php echo $attr7_name ?>" name="<?php echo $attr7_name ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" /><?php
 } } else { ?><span class="<?php echo $attr7_class ?>"><?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?></span><?php } ?><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_default) ?><?php unset($attr7_type) ?><?php unset($attr7_name) ?><?php unset($attr7_size) ?><?php unset($attr7_maxlength) ?><?php unset($attr7_onchange) ?><?php unset($attr7_readonly) ?><?php $attr7_debug_info = 'a:1:{s:5:"field";s:6:"number";}' ?><?php $attr7 = array('field'=>'number') ?><?php $attr7_field='number' ?><?php
if (isset($errors[0])) $attr7_field = $errors[0];
?><script name="JavaScript" type="text/javascript"><!--
document.forms[0].<?php echo $attr7_field ?>.focus();
document.forms[0].<?php echo $attr7_field ?>.select();
</script>
<?php unset($attr7) ?><?php unset($attr7_field) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php } ?><?php unset($attr3) ?><?php $attr4_debug_info = 'a:2:{s:6:"equals";s:6:"select";s:5:"value";s:8:"var:type";}' ?><?php $attr4 = array('equals'=>'select','value'=>$type) ?><?php $attr4_equals='select' ?><?php $attr4_value=$type ?><?php 
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
<?php unset($attr4) ?><?php unset($attr4_equals) ?><?php unset($attr4_value) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];
	if (empty($attr5_class))
		$attr5_class=$row_class;
	global $cell_column_nr;
	$cell_column_nr=0;
	$column_class_idx = 999;
?><tr class="<?php echo $attr5_class ?>"><?php unset($attr5) ?><?php $attr6_debug_info = 'a:2:{s:5:"class";s:2:"fx";s:7:"colspan";s:1:"2";}' ?><?php $attr6 = array('class'=>'fx','colspan'=>'2') ?><?php $attr6_class='fx' ?><?php $attr6_colspan='2' ?><?php
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_colspan) ?><?php $attr7_debug_info = 'a:9:{s:4:"list";s:5:"items";s:4:"name";s:4:"text";s:8:"onchange";s:0:"";s:5:"title";s:0:"";s:5:"class";s:0:"";s:8:"addempty";s:5:"false";s:8:"multiple";s:5:"false";s:4:"size";s:1:"1";s:4:"lang";s:5:"false";}' ?><?php $attr7 = array('list'=>'items','name'=>'text','onchange'=>'','title'=>'','class'=>'','addempty'=>false,'multiple'=>false,'size'=>'1','lang'=>false) ?><?php $attr7_list='items' ?><?php $attr7_name='text' ?><?php $attr7_onchange='' ?><?php $attr7_title='' ?><?php $attr7_class='' ?><?php $attr7_addempty=false ?><?php $attr7_multiple=false ?><?php $attr7_size='1' ?><?php $attr7_lang=false ?><?php
if ($this->isEditable() && $this->getRequestVar('mode')!='edit') $attr7_readonly=true;
if ( $attr7_addempty!==FALSE  )
{
	if ($attr7_addempty===TRUE)
		$$attr7_list = array(''=>lang('LIST_ENTRY_EMPTY'))+$$attr7_list;
	else
		$$attr7_list = array(''=>'- '.lang($attr7_addempty).' -')+$$attr7_list;
}
?><select<?php if ($attr7_readonly) echo ' disabled="disabled"' ?> id="id_<?php echo $attr7_name ?>"  name="<?php echo $attr7_name; if ($attr7_multiple) echo '[]'; ?>" onchange="<?php echo $attr7_onchange ?>" title="<?php echo $attr7_title ?>" class="<?php echo $attr7_class ?>"<?php
if (count($$attr7_list)<=1) echo ' disabled="disabled"';
if	($attr7_multiple) echo ' multiple="multiple"';
if (in_array($attr7_name,$errors)) echo ' style="background-color:red; border:2px dashed red;"';
echo ' size="'.intval($attr7_size).'"';
?>><?php
		$attr7_tmp_list = $$attr7_list;
		if	( isset($$attr7_name) && isset($attr7_tmp_list[$$attr7_name]) )
			$attr7_tmp_default = $$attr7_name;
		elseif ( isset($attr7_default) )
			$attr7_tmp_default = $attr7_default;
		else
			$attr7_tmp_default = '';
		foreach( $attr7_tmp_list as $box_key=>$box_value )
		{
			if	( is_array($box_value) )
			{
				$box_key   = $box_value['key'  ];
				$box_title = $box_value['title'];
				$box_value = $box_value['value'];
			}
			elseif( $attr7_lang )
			{
				$box_title = lang( $box_value.'_DESC');
				$box_value = lang( $box_value        );
			}
			else
			{
				$box_title = '';
			}
			echo '<option class="'.$attr7_class.'" value="'.$box_key.'" title="'.$box_title.'"';
			if ($box_key==$attr7_tmp_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select><?php
if (count($$attr7_list)==0) echo '<input type="hidden" name="'.$attr7_name.'" value="" />';
if (count($$attr7_list)==1) echo '<input type="hidden" name="'.$attr7_name.'" value="'.$box_key.'" />'
?><?php unset($attr7) ?><?php unset($attr7_list) ?><?php unset($attr7_name) ?><?php unset($attr7_onchange) ?><?php unset($attr7_title) ?><?php unset($attr7_class) ?><?php unset($attr7_addempty) ?><?php unset($attr7_multiple) ?><?php unset($attr7_size) ?><?php unset($attr7_lang) ?><?php $attr7_debug_info = 'a:1:{s:5:"field";s:4:"text";}' ?><?php $attr7 = array('field'=>'text') ?><?php $attr7_field='text' ?><?php
if (isset($errors[0])) $attr7_field = $errors[0];
?><script name="JavaScript" type="text/javascript"><!--
document.forms[0].<?php echo $attr7_field ?>.focus();
document.forms[0].<?php echo $attr7_field ?>.select();
</script>
<?php unset($attr7) ?><?php unset($attr7_field) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php } ?><?php unset($attr3) ?><?php $attr4_debug_info = 'a:1:{s:4:"true";s:9:"mode:edit";}' ?><?php $attr4 = array('true'=>$this->getRequestVar("mode")=="edit") ?><?php $attr4_true=$this->getRequestVar("mode")=="edit" ?><?php 
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
<?php unset($attr4) ?><?php unset($attr4_true) ?><?php $attr5_debug_info = 'a:1:{s:7:"present";s:7:"release";}' ?><?php $attr5 = array('present'=>'release') ?><?php $attr5_present='release' ?><?php 
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
<?php unset($attr5) ?><?php unset($attr5_present) ?><?php $attr6_debug_info = 'a:1:{s:7:"present";s:7:"publish";}' ?><?php $attr6 = array('present'=>'publish') ?><?php $attr6_present='publish' ?><?php 
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
<?php unset($attr6) ?><?php unset($attr6_present) ?><?php $attr7_debug_info = 'a:0:{}' ?><?php $attr7 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];
	if (empty($attr7_class))
		$attr7_class=$row_class;
	global $cell_column_nr;
	$cell_column_nr=0;
	$column_class_idx = 999;
?><tr class="<?php echo $attr7_class ?>"><?php unset($attr7) ?><?php $attr8_debug_info = 'a:1:{s:7:"colspan";s:1:"2";}' ?><?php $attr8 = array('colspan'=>'2') ?><?php $attr8_colspan='2' ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr8_class))
		$attr8['class']=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr8_rowspan) )
		$attr8['width']=$column_widths[$cell_column_nr-1];
?><td <?php foreach( $attr8 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr8) ?><?php unset($attr8_colspan) ?><?php $attr9_debug_info = 'a:1:{s:5:"title";s:15:"message:options";}' ?><?php $attr9 = array('title'=>lang('options')) ?><?php $attr9_title=lang('options') ?><fieldset><?php if(isset($attr9_title)) { ?><legend><?php echo encodeHtml($attr9_title) ?></legend><?php } ?><?php unset($attr9) ?><?php unset($attr9_title) ?><?php $attr8_debug_info = 'a:0:{}' ?><?php $attr8 = array() ?></fieldset><?php unset($attr8) ?><?php $attr7_debug_info = 'a:0:{}' ?><?php $attr7 = array() ?></td><?php unset($attr7) ?><?php $attr6_debug_info = 'a:0:{}' ?><?php $attr6 = array() ?></tr><?php unset($attr6) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?><?php } ?><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?><?php } ?><?php unset($attr4) ?><?php $attr5_debug_info = 'a:1:{s:7:"present";s:7:"release";}' ?><?php $attr5 = array('present'=>'release') ?><?php $attr5_present='release' ?><?php 
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
<?php unset($attr5) ?><?php unset($attr5_present) ?><?php $attr6_debug_info = 'a:0:{}' ?><?php $attr6 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];
	if (empty($attr6_class))
		$attr6_class=$row_class;
	global $cell_column_nr;
	$cell_column_nr=0;
	$column_class_idx = 999;
?><tr class="<?php echo $attr6_class ?>"><?php unset($attr6) ?><?php $attr7_debug_info = 'a:2:{s:5:"class";s:2:"fx";s:7:"colspan";s:1:"2";}' ?><?php $attr7 = array('class'=>'fx','colspan'=>'2') ?><?php $attr7_class='fx' ?><?php $attr7_colspan='2' ?><?php
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
?><td <?php foreach( $attr7 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_colspan) ?><?php $attr8_debug_info = 'a:3:{s:7:"default";s:5:"false";s:8:"readonly";s:5:"false";s:4:"name";s:7:"release";}' ?><?php $attr8 = array('default'=>false,'readonly'=>false,'name'=>'release') ?><?php $attr8_default=false ?><?php $attr8_readonly=false ?><?php $attr8_name='release' ?><?php
	if ($this->isEditable() && $this->getRequestVar('mode')!='edit') $attr8_readonly=true;
	if	( isset($$attr8_name) )
		$checked = $$attr8_name;
	else
		$checked = $attr8_default;
?><input type="checkbox" id="id_<?php echo $attr8_name ?>" name="<?php echo $attr8_name  ?>"  <?php if ($attr8_readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?><?php if (in_array($attr8_name,$errors)) echo ' style="background-color:red;"' ?> /><?php
if ( $attr8_readonly && $checked )
{ 
?><input type="hidden" name="<?php echo $attr8_name ?>" value="1" /><?php
}
?><?php unset($attr8_name); unset($attr8_readonly); unset($attr8_default); ?><?php unset($attr8) ?><?php unset($attr8_default) ?><?php unset($attr8_readonly) ?><?php unset($attr8_name) ?><?php $attr8_debug_info = 'a:1:{s:3:"for";s:7:"release";}' ?><?php $attr8 = array('for'=>'release') ?><?php $attr8_for='release' ?><label for="id_<?php echo $attr8_for ?><?php if (!empty($attr8_value)) echo '_'.$attr8_value ?>"><?php unset($attr8) ?><?php unset($attr8_for) ?><?php $attr9_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:14:"GLOBAL_RELEASE";s:6:"escape";s:4:"true";}' ?><?php $attr9 = array('class'=>'text','text'=>'GLOBAL_RELEASE','escape'=>true) ?><?php $attr9_class='text' ?><?php $attr9_text='GLOBAL_RELEASE' ?><?php $attr9_escape=true ?><?php
	if	( isset($attr9_prefix)&& isset($attr9_key))
		$attr9_key = $attr9_prefix.$attr9_key;
	if	( isset($attr9_suffix)&& isset($attr9_key))
		$attr9_key = $attr9_key.$attr9_suffix;
	if(empty($attr9_title))
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
	if	( $attr9_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr9_array))
	{
		$tmpArray = $$attr9_array;
		if (!empty($attr9_var))
			$tmp_text = $tmpArray[$attr9_var];
		else
			$tmp_text = $langF($tmpArray[$attr9_text]);
	}
	elseif (!empty($attr9_text))
		$tmp_text = $langF($attr9_text);
	elseif (!empty($attr9_textvar))
		$tmp_text = $langF($$attr9_textvar);
	elseif (!empty($attr9_key))
		$tmp_text = $langF($attr9_key);
	elseif (!empty($attr9_var))
		$tmp_text = isset($$attr9_var)?$$attr9_var:'?unset:'.$attr9_var.'?';	
	elseif (!empty($attr9_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr9_raw);
	elseif (!empty($attr9_value))
		$tmp_text = $attr9_value;
	else
	  $tmp_text = '&nbsp;';
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
?></<?php echo $tmp_tag ?>><?php unset($attr9) ?><?php unset($attr9_class) ?><?php unset($attr9_text) ?><?php unset($attr9_escape) ?><?php $attr7_debug_info = 'a:0:{}' ?><?php $attr7 = array() ?></label><?php unset($attr7) ?><?php $attr6_debug_info = 'a:0:{}' ?><?php $attr6 = array() ?></td><?php unset($attr6) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></tr><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?><?php } ?><?php unset($attr4) ?><?php $attr5_debug_info = 'a:1:{s:7:"present";s:7:"publish";}' ?><?php $attr5 = array('present'=>'publish') ?><?php $attr5_present='publish' ?><?php 
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
<?php unset($attr5) ?><?php unset($attr5_present) ?><?php $attr6_debug_info = 'a:0:{}' ?><?php $attr6 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];
	if (empty($attr6_class))
		$attr6_class=$row_class;
	global $cell_column_nr;
	$cell_column_nr=0;
	$column_class_idx = 999;
?><tr class="<?php echo $attr6_class ?>"><?php unset($attr6) ?><?php $attr7_debug_info = 'a:2:{s:5:"class";s:2:"fx";s:7:"colspan";s:1:"2";}' ?><?php $attr7 = array('class'=>'fx','colspan'=>'2') ?><?php $attr7_class='fx' ?><?php $attr7_colspan='2' ?><?php
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
?><td <?php foreach( $attr7 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_colspan) ?><?php $attr8_debug_info = 'a:3:{s:7:"default";s:5:"false";s:8:"readonly";s:5:"false";s:4:"name";s:7:"publish";}' ?><?php $attr8 = array('default'=>false,'readonly'=>false,'name'=>'publish') ?><?php $attr8_default=false ?><?php $attr8_readonly=false ?><?php $attr8_name='publish' ?><?php
	if ($this->isEditable() && $this->getRequestVar('mode')!='edit') $attr8_readonly=true;
	if	( isset($$attr8_name) )
		$checked = $$attr8_name;
	else
		$checked = $attr8_default;
?><input type="checkbox" id="id_<?php echo $attr8_name ?>" name="<?php echo $attr8_name  ?>"  <?php if ($attr8_readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?><?php if (in_array($attr8_name,$errors)) echo ' style="background-color:red;"' ?> /><?php
if ( $attr8_readonly && $checked )
{ 
?><input type="hidden" name="<?php echo $attr8_name ?>" value="1" /><?php
}
?><?php unset($attr8_name); unset($attr8_readonly); unset($attr8_default); ?><?php unset($attr8) ?><?php unset($attr8_default) ?><?php unset($attr8_readonly) ?><?php unset($attr8_name) ?><?php $attr8_debug_info = 'a:1:{s:3:"for";s:7:"publish";}' ?><?php $attr8 = array('for'=>'publish') ?><?php $attr8_for='publish' ?><label for="id_<?php echo $attr8_for ?><?php if (!empty($attr8_value)) echo '_'.$attr8_value ?>"><?php unset($attr8) ?><?php unset($attr8_for) ?><?php $attr9_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:23:"PAGE_PUBLISH_AFTER_SAVE";s:6:"escape";s:4:"true";}' ?><?php $attr9 = array('class'=>'text','text'=>'PAGE_PUBLISH_AFTER_SAVE','escape'=>true) ?><?php $attr9_class='text' ?><?php $attr9_text='PAGE_PUBLISH_AFTER_SAVE' ?><?php $attr9_escape=true ?><?php
	if	( isset($attr9_prefix)&& isset($attr9_key))
		$attr9_key = $attr9_prefix.$attr9_key;
	if	( isset($attr9_suffix)&& isset($attr9_key))
		$attr9_key = $attr9_key.$attr9_suffix;
	if(empty($attr9_title))
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
	if	( $attr9_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr9_array))
	{
		$tmpArray = $$attr9_array;
		if (!empty($attr9_var))
			$tmp_text = $tmpArray[$attr9_var];
		else
			$tmp_text = $langF($tmpArray[$attr9_text]);
	}
	elseif (!empty($attr9_text))
		$tmp_text = $langF($attr9_text);
	elseif (!empty($attr9_textvar))
		$tmp_text = $langF($$attr9_textvar);
	elseif (!empty($attr9_key))
		$tmp_text = $langF($attr9_key);
	elseif (!empty($attr9_var))
		$tmp_text = isset($$attr9_var)?$$attr9_var:'?unset:'.$attr9_var.'?';	
	elseif (!empty($attr9_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr9_raw);
	elseif (!empty($attr9_value))
		$tmp_text = $attr9_value;
	else
	  $tmp_text = '&nbsp;';
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
?></<?php echo $tmp_tag ?>><?php unset($attr9) ?><?php unset($attr9_class) ?><?php unset($attr9_text) ?><?php unset($attr9_escape) ?><?php $attr7_debug_info = 'a:0:{}' ?><?php $attr7 = array() ?></label><?php unset($attr7) ?><?php $attr6_debug_info = 'a:0:{}' ?><?php $attr6 = array() ?></td><?php unset($attr6) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></tr><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?><?php } ?><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php } ?><?php unset($attr3) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];
	if (empty($attr4_class))
		$attr4_class=$row_class;
	global $cell_column_nr;
	$cell_column_nr=0;
	$column_class_idx = 999;
?><tr class="<?php echo $attr4_class ?>"><?php unset($attr4) ?><?php $attr5_debug_info = 'a:2:{s:5:"class";s:3:"act";s:7:"colspan";s:1:"2";}' ?><?php $attr5 = array('class'=>'act','colspan'=>'2') ?><?php $attr5_class='act' ?><?php $attr5_colspan='2' ?><?php
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
?><td <?php foreach( $attr5 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr5) ?><?php unset($attr5_class) ?><?php unset($attr5_colspan) ?><?php $attr6_debug_info = 'a:4:{s:4:"type";s:2:"ok";s:5:"class";s:2:"ok";s:5:"value";s:2:"ok";s:4:"text";s:9:"button_ok";}' ?><?php $attr6 = array('type'=>'ok','class'=>'ok','value'=>'ok','text'=>'button_ok') ?><?php $attr6_type='ok' ?><?php $attr6_class='ok' ?><?php $attr6_value='ok' ?><?php $attr6_text='button_ok' ?><?php
	if ($attr6_type=='ok')
	{
		if ($this->isEditable() && !$this->isEditMode())
		$attr6_text = 'MODE_EDIT';
	}
	if ($attr6_type=='ok')
		$attr6_type  = 'submit';
	if (isset($attr6_src))
		$attr6_type  = 'image';
	else
		$attr6_src  = '';
?><input type="<?php echo $attr6_type ?>"<?php if(isset($attr6_src)) { ?> src="<?php echo $image_dir.'icon_'.$attr6_src.IMG_ICON_EXT ?>"<?php } ?> name="<?php echo $attr6_value ?>" class="<?php echo $attr6_class ?>" title="<?php echo lang($attr6_text.'_DESC') ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo langHtml($attr6_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($attr6_src) ?><?php
?><?php unset($attr6) ?><?php unset($attr6_type) ?><?php unset($attr6_class) ?><?php unset($attr6_value) ?><?php unset($attr6_text) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></td><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?></tr><?php unset($attr3) ?><?php $attr2_debug_info = 'a:0:{}' ?><?php $attr2 = array() ?>      </table>
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