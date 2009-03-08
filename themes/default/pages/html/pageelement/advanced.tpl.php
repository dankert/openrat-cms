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
?><?php unset($attr2) ?><?php unset($attr2_name) ?><?php unset($attr2_target) ?><?php unset($attr2_method) ?><?php unset($attr2_enctype) ?><?php $attr3_debug_info = 'a:4:{s:4:"name";s:7:"element";s:5:"width";s:3:"93%";s:10:"rowclasses";s:8:"odd,even";s:13:"columnclasses";s:5:"1,2,3";}' ?><?php $attr3 = array('name'=>'element','width'=>'93%','rowclasses'=>'odd,even','columnclasses'=>'1,2,3') ?><?php $attr3_name='element' ?><?php $attr3_width='93%' ?><?php $attr3_rowclasses='odd,even' ?><?php $attr3_columnclasses='1,2,3' ?><?php
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
<?php unset($attr4) ?><?php unset($attr4_equals) ?><?php unset($attr4_value) ?><?php $attr5_debug_info = 'a:4:{s:5:"width";s:3:"85%";s:5:"space";s:3:"0px";s:7:"padding";s:3:"0px";s:10:"rowclasses";s:8:"odd,even";}' ?><?php $attr5 = array('width'=>'85%','space'=>'0px','padding'=>'0px','rowclasses'=>'odd,even') ?><?php $attr5_width='85%' ?><?php $attr5_space='0px' ?><?php $attr5_padding='0px' ?><?php $attr5_rowclasses='odd,even' ?><?php
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
?><tr class="<?php echo $attr6_class ?>"><?php unset($attr6) ?><?php $attr7_debug_info = 'a:2:{s:5:"class";s:4:"help";s:7:"colspan";s:1:"7";}' ?><?php $attr7 = array('class'=>'help','colspan'=>'7') ?><?php $attr7_class='help' ?><?php $attr7_colspan='7' ?><?php
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
?><td <?php foreach( $attr7 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_colspan) ?><?php $attr8_debug_info = 'a:4:{s:5:"title";s:0:"";s:6:"target";s:5:"_self";s:3:"url";s:16:"var:lastmonthurl";s:5:"class";s:0:"";}' ?><?php $attr8 = array('title'=>'','target'=>'_self','url'=>$lastmonthurl,'class'=>'') ?><?php $attr8_title='' ?><?php $attr8_target='_self' ?><?php $attr8_url=$lastmonthurl ?><?php $attr8_class='' ?><?php
	$params = array();
	if (!empty($attr8_var1) && isset($attr8_value1))
		$params[$attr8_var1]=$attr8_value1;
	if (!empty($attr8_var2) && isset($attr8_value2))
		$params[$attr8_var2]=$attr8_value2;
	if (!empty($attr8_var3) && isset($attr8_value3))
		$params[$attr8_var3]=$attr8_value3;
	if (!empty($attr8_var4) && isset($attr8_value4))
		$params[$attr8_var4]=$attr8_value4;
	if (!empty($attr8_var5) && isset($attr8_value5))
		$params[$attr8_var5]=$attr8_value5;
	if(empty($attr8_class))
		$attr8_class='';
	if(empty($attr8_title))
		$attr8_title = '';
	if(!empty($attr8_url))
		$tmp_url = $attr8_url;
	else
		$tmp_url = Html::url($attr8_action,$attr8_subaction,!empty($attr8_id)?$attr8_id:$this->getRequestId(),$params);
?><a<?php if (isset($attr8_name)) echo ' name="'.$attr8_name.'"'; else echo ' href="'.$tmp_url.($attr8_anchor?'#'.$attr8_anchor:'').'"' ?> class="<?php echo $attr8_class ?>" target="<?php echo $attr8_target ?>"<?php if (isset($attr8_accesskey)) echo ' accesskey="'.$attr8_accesskey.'"' ?>  title="<?php echo encodeHtml($attr8_title) ?>"><?php unset($attr8) ?><?php unset($attr8_title) ?><?php unset($attr8_target) ?><?php unset($attr8_url) ?><?php unset($attr8_class) ?><?php $attr9_debug_info = 'a:2:{s:4:"file";s:4:"left";s:5:"align";s:6:"middle";}' ?><?php $attr9 = array('file'=>'left','align'=>'middle') ?><?php $attr9_file='left' ?><?php $attr9_align='middle' ?><?php
if (isset($attr9_elementtype)) {
?><img src="<?php echo $image_dir.'icon_el_'.$attr9_elementtype.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_type)) {
?><img src="<?php echo $image_dir.'icon_'.$attr9_type.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_icon)) {
?><img src="<?php echo $image_dir.'icon_'.$attr9_icon.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_tree)) {
?><img src="<?php echo $image_dir.'tree_'.$attr9_tree.IMG_EXT ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_url)) {
?><img src="<?php echo $attr9_url ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_fileext)) {
?><img src="<?php echo $image_dir.$attr9_fileext ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_file)) {
?><img src="<?php echo $image_dir.$attr9_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr9_align ?>"><?php } ?><?php unset($attr9) ?><?php unset($attr9_file) ?><?php unset($attr9_align) ?><?php $attr7_debug_info = 'a:0:{}' ?><?php $attr7 = array() ?></a><?php unset($attr7) ?><?php $attr8_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"raw";s:1:"_";s:6:"escape";s:4:"true";}' ?><?php $attr8 = array('class'=>'text','raw'=>'_','escape'=>true) ?><?php $attr8_class='text' ?><?php $attr8_raw='_' ?><?php $attr8_escape=true ?><?php
	if	( isset($attr8_prefix)&& isset($attr8_key))
		$attr8_key = $attr8_prefix.$attr8_key;
	if	( isset($attr8_suffix)&& isset($attr8_key))
		$attr8_key = $attr8_key.$attr8_suffix;
	if(empty($attr8_title))
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
	if	( $attr8_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr8_array))
	{
		$tmpArray = $$attr8_array;
		if (!empty($attr8_var))
			$tmp_text = $tmpArray[$attr8_var];
		else
			$tmp_text = $langF($tmpArray[$attr8_text]);
	}
	elseif (!empty($attr8_text))
		$tmp_text = $langF($attr8_text);
	elseif (!empty($attr8_textvar))
		$tmp_text = $langF($$attr8_textvar);
	elseif (!empty($attr8_key))
		$tmp_text = $langF($attr8_key);
	elseif (!empty($attr8_var))
		$tmp_text = isset($$attr8_var)?$$attr8_var:'?unset:'.$attr8_var.'?';	
	elseif (!empty($attr8_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr8_raw);
	elseif (!empty($attr8_value))
		$tmp_text = $attr8_value;
	else
	  $tmp_text = '&nbsp;';
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
?></<?php echo $tmp_tag ?>><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_raw) ?><?php unset($attr8_escape) ?><?php $attr8_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"var";s:9:"monthname";s:6:"escape";s:4:"true";}' ?><?php $attr8 = array('class'=>'text','var'=>'monthname','escape'=>true) ?><?php $attr8_class='text' ?><?php $attr8_var='monthname' ?><?php $attr8_escape=true ?><?php
	if	( isset($attr8_prefix)&& isset($attr8_key))
		$attr8_key = $attr8_prefix.$attr8_key;
	if	( isset($attr8_suffix)&& isset($attr8_key))
		$attr8_key = $attr8_key.$attr8_suffix;
	if(empty($attr8_title))
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
	if	( $attr8_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr8_array))
	{
		$tmpArray = $$attr8_array;
		if (!empty($attr8_var))
			$tmp_text = $tmpArray[$attr8_var];
		else
			$tmp_text = $langF($tmpArray[$attr8_text]);
	}
	elseif (!empty($attr8_text))
		$tmp_text = $langF($attr8_text);
	elseif (!empty($attr8_textvar))
		$tmp_text = $langF($$attr8_textvar);
	elseif (!empty($attr8_key))
		$tmp_text = $langF($attr8_key);
	elseif (!empty($attr8_var))
		$tmp_text = isset($$attr8_var)?$$attr8_var:'?unset:'.$attr8_var.'?';	
	elseif (!empty($attr8_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr8_raw);
	elseif (!empty($attr8_value))
		$tmp_text = $attr8_value;
	else
	  $tmp_text = '&nbsp;';
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
?></<?php echo $tmp_tag ?>><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_var) ?><?php unset($attr8_escape) ?><?php $attr8_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"raw";s:1:"_";s:6:"escape";s:4:"true";}' ?><?php $attr8 = array('class'=>'text','raw'=>'_','escape'=>true) ?><?php $attr8_class='text' ?><?php $attr8_raw='_' ?><?php $attr8_escape=true ?><?php
	if	( isset($attr8_prefix)&& isset($attr8_key))
		$attr8_key = $attr8_prefix.$attr8_key;
	if	( isset($attr8_suffix)&& isset($attr8_key))
		$attr8_key = $attr8_key.$attr8_suffix;
	if(empty($attr8_title))
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
	if	( $attr8_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr8_array))
	{
		$tmpArray = $$attr8_array;
		if (!empty($attr8_var))
			$tmp_text = $tmpArray[$attr8_var];
		else
			$tmp_text = $langF($tmpArray[$attr8_text]);
	}
	elseif (!empty($attr8_text))
		$tmp_text = $langF($attr8_text);
	elseif (!empty($attr8_textvar))
		$tmp_text = $langF($$attr8_textvar);
	elseif (!empty($attr8_key))
		$tmp_text = $langF($attr8_key);
	elseif (!empty($attr8_var))
		$tmp_text = isset($$attr8_var)?$$attr8_var:'?unset:'.$attr8_var.'?';	
	elseif (!empty($attr8_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr8_raw);
	elseif (!empty($attr8_value))
		$tmp_text = $attr8_value;
	else
	  $tmp_text = '&nbsp;';
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
?></<?php echo $tmp_tag ?>><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_raw) ?><?php unset($attr8_escape) ?><?php $attr8_debug_info = 'a:4:{s:5:"title";s:0:"";s:6:"target";s:5:"_self";s:3:"url";s:16:"var:nextmonthurl";s:5:"class";s:0:"";}' ?><?php $attr8 = array('title'=>'','target'=>'_self','url'=>$nextmonthurl,'class'=>'') ?><?php $attr8_title='' ?><?php $attr8_target='_self' ?><?php $attr8_url=$nextmonthurl ?><?php $attr8_class='' ?><?php
	$params = array();
	if (!empty($attr8_var1) && isset($attr8_value1))
		$params[$attr8_var1]=$attr8_value1;
	if (!empty($attr8_var2) && isset($attr8_value2))
		$params[$attr8_var2]=$attr8_value2;
	if (!empty($attr8_var3) && isset($attr8_value3))
		$params[$attr8_var3]=$attr8_value3;
	if (!empty($attr8_var4) && isset($attr8_value4))
		$params[$attr8_var4]=$attr8_value4;
	if (!empty($attr8_var5) && isset($attr8_value5))
		$params[$attr8_var5]=$attr8_value5;
	if(empty($attr8_class))
		$attr8_class='';
	if(empty($attr8_title))
		$attr8_title = '';
	if(!empty($attr8_url))
		$tmp_url = $attr8_url;
	else
		$tmp_url = Html::url($attr8_action,$attr8_subaction,!empty($attr8_id)?$attr8_id:$this->getRequestId(),$params);
?><a<?php if (isset($attr8_name)) echo ' name="'.$attr8_name.'"'; else echo ' href="'.$tmp_url.($attr8_anchor?'#'.$attr8_anchor:'').'"' ?> class="<?php echo $attr8_class ?>" target="<?php echo $attr8_target ?>"<?php if (isset($attr8_accesskey)) echo ' accesskey="'.$attr8_accesskey.'"' ?>  title="<?php echo encodeHtml($attr8_title) ?>"><?php unset($attr8) ?><?php unset($attr8_title) ?><?php unset($attr8_target) ?><?php unset($attr8_url) ?><?php unset($attr8_class) ?><?php $attr9_debug_info = 'a:2:{s:4:"file";s:5:"right";s:5:"align";s:6:"middle";}' ?><?php $attr9 = array('file'=>'right','align'=>'middle') ?><?php $attr9_file='right' ?><?php $attr9_align='middle' ?><?php
if (isset($attr9_elementtype)) {
?><img src="<?php echo $image_dir.'icon_el_'.$attr9_elementtype.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_type)) {
?><img src="<?php echo $image_dir.'icon_'.$attr9_type.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_icon)) {
?><img src="<?php echo $image_dir.'icon_'.$attr9_icon.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_tree)) {
?><img src="<?php echo $image_dir.'tree_'.$attr9_tree.IMG_EXT ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_url)) {
?><img src="<?php echo $attr9_url ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_fileext)) {
?><img src="<?php echo $image_dir.$attr9_fileext ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_file)) {
?><img src="<?php echo $image_dir.$attr9_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr9_align ?>"><?php } ?><?php unset($attr9) ?><?php unset($attr9_file) ?><?php unset($attr9_align) ?><?php $attr7_debug_info = 'a:0:{}' ?><?php $attr7 = array() ?></a><?php unset($attr7) ?><?php $attr8_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"raw";s:5:"_____";s:6:"escape";s:4:"true";}' ?><?php $attr8 = array('class'=>'text','raw'=>'_____','escape'=>true) ?><?php $attr8_class='text' ?><?php $attr8_raw='_____' ?><?php $attr8_escape=true ?><?php
	if	( isset($attr8_prefix)&& isset($attr8_key))
		$attr8_key = $attr8_prefix.$attr8_key;
	if	( isset($attr8_suffix)&& isset($attr8_key))
		$attr8_key = $attr8_key.$attr8_suffix;
	if(empty($attr8_title))
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
	if	( $attr8_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr8_array))
	{
		$tmpArray = $$attr8_array;
		if (!empty($attr8_var))
			$tmp_text = $tmpArray[$attr8_var];
		else
			$tmp_text = $langF($tmpArray[$attr8_text]);
	}
	elseif (!empty($attr8_text))
		$tmp_text = $langF($attr8_text);
	elseif (!empty($attr8_textvar))
		$tmp_text = $langF($$attr8_textvar);
	elseif (!empty($attr8_key))
		$tmp_text = $langF($attr8_key);
	elseif (!empty($attr8_var))
		$tmp_text = isset($$attr8_var)?$$attr8_var:'?unset:'.$attr8_var.'?';	
	elseif (!empty($attr8_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr8_raw);
	elseif (!empty($attr8_value))
		$tmp_text = $attr8_value;
	else
	  $tmp_text = '&nbsp;';
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
?></<?php echo $tmp_tag ?>><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_raw) ?><?php unset($attr8_escape) ?><?php $attr8_debug_info = 'a:4:{s:5:"title";s:0:"";s:6:"target";s:5:"_self";s:3:"url";s:15:"var:lastyearurl";s:5:"class";s:0:"";}' ?><?php $attr8 = array('title'=>'','target'=>'_self','url'=>$lastyearurl,'class'=>'') ?><?php $attr8_title='' ?><?php $attr8_target='_self' ?><?php $attr8_url=$lastyearurl ?><?php $attr8_class='' ?><?php
	$params = array();
	if (!empty($attr8_var1) && isset($attr8_value1))
		$params[$attr8_var1]=$attr8_value1;
	if (!empty($attr8_var2) && isset($attr8_value2))
		$params[$attr8_var2]=$attr8_value2;
	if (!empty($attr8_var3) && isset($attr8_value3))
		$params[$attr8_var3]=$attr8_value3;
	if (!empty($attr8_var4) && isset($attr8_value4))
		$params[$attr8_var4]=$attr8_value4;
	if (!empty($attr8_var5) && isset($attr8_value5))
		$params[$attr8_var5]=$attr8_value5;
	if(empty($attr8_class))
		$attr8_class='';
	if(empty($attr8_title))
		$attr8_title = '';
	if(!empty($attr8_url))
		$tmp_url = $attr8_url;
	else
		$tmp_url = Html::url($attr8_action,$attr8_subaction,!empty($attr8_id)?$attr8_id:$this->getRequestId(),$params);
?><a<?php if (isset($attr8_name)) echo ' name="'.$attr8_name.'"'; else echo ' href="'.$tmp_url.($attr8_anchor?'#'.$attr8_anchor:'').'"' ?> class="<?php echo $attr8_class ?>" target="<?php echo $attr8_target ?>"<?php if (isset($attr8_accesskey)) echo ' accesskey="'.$attr8_accesskey.'"' ?>  title="<?php echo encodeHtml($attr8_title) ?>"><?php unset($attr8) ?><?php unset($attr8_title) ?><?php unset($attr8_target) ?><?php unset($attr8_url) ?><?php unset($attr8_class) ?><?php $attr9_debug_info = 'a:2:{s:4:"file";s:4:"left";s:5:"align";s:6:"middle";}' ?><?php $attr9 = array('file'=>'left','align'=>'middle') ?><?php $attr9_file='left' ?><?php $attr9_align='middle' ?><?php
if (isset($attr9_elementtype)) {
?><img src="<?php echo $image_dir.'icon_el_'.$attr9_elementtype.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_type)) {
?><img src="<?php echo $image_dir.'icon_'.$attr9_type.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_icon)) {
?><img src="<?php echo $image_dir.'icon_'.$attr9_icon.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_tree)) {
?><img src="<?php echo $image_dir.'tree_'.$attr9_tree.IMG_EXT ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_url)) {
?><img src="<?php echo $attr9_url ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_fileext)) {
?><img src="<?php echo $image_dir.$attr9_fileext ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_file)) {
?><img src="<?php echo $image_dir.$attr9_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr9_align ?>"><?php } ?><?php unset($attr9) ?><?php unset($attr9_file) ?><?php unset($attr9_align) ?><?php $attr7_debug_info = 'a:0:{}' ?><?php $attr7 = array() ?></a><?php unset($attr7) ?><?php $attr8_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"raw";s:1:"_";s:6:"escape";s:4:"true";}' ?><?php $attr8 = array('class'=>'text','raw'=>'_','escape'=>true) ?><?php $attr8_class='text' ?><?php $attr8_raw='_' ?><?php $attr8_escape=true ?><?php
	if	( isset($attr8_prefix)&& isset($attr8_key))
		$attr8_key = $attr8_prefix.$attr8_key;
	if	( isset($attr8_suffix)&& isset($attr8_key))
		$attr8_key = $attr8_key.$attr8_suffix;
	if(empty($attr8_title))
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
	if	( $attr8_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr8_array))
	{
		$tmpArray = $$attr8_array;
		if (!empty($attr8_var))
			$tmp_text = $tmpArray[$attr8_var];
		else
			$tmp_text = $langF($tmpArray[$attr8_text]);
	}
	elseif (!empty($attr8_text))
		$tmp_text = $langF($attr8_text);
	elseif (!empty($attr8_textvar))
		$tmp_text = $langF($$attr8_textvar);
	elseif (!empty($attr8_key))
		$tmp_text = $langF($attr8_key);
	elseif (!empty($attr8_var))
		$tmp_text = isset($$attr8_var)?$$attr8_var:'?unset:'.$attr8_var.'?';	
	elseif (!empty($attr8_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr8_raw);
	elseif (!empty($attr8_value))
		$tmp_text = $attr8_value;
	else
	  $tmp_text = '&nbsp;';
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
?></<?php echo $tmp_tag ?>><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_raw) ?><?php unset($attr8_escape) ?><?php $attr8_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"var";s:8:"yearname";s:6:"escape";s:4:"true";}' ?><?php $attr8 = array('class'=>'text','var'=>'yearname','escape'=>true) ?><?php $attr8_class='text' ?><?php $attr8_var='yearname' ?><?php $attr8_escape=true ?><?php
	if	( isset($attr8_prefix)&& isset($attr8_key))
		$attr8_key = $attr8_prefix.$attr8_key;
	if	( isset($attr8_suffix)&& isset($attr8_key))
		$attr8_key = $attr8_key.$attr8_suffix;
	if(empty($attr8_title))
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
	if	( $attr8_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr8_array))
	{
		$tmpArray = $$attr8_array;
		if (!empty($attr8_var))
			$tmp_text = $tmpArray[$attr8_var];
		else
			$tmp_text = $langF($tmpArray[$attr8_text]);
	}
	elseif (!empty($attr8_text))
		$tmp_text = $langF($attr8_text);
	elseif (!empty($attr8_textvar))
		$tmp_text = $langF($$attr8_textvar);
	elseif (!empty($attr8_key))
		$tmp_text = $langF($attr8_key);
	elseif (!empty($attr8_var))
		$tmp_text = isset($$attr8_var)?$$attr8_var:'?unset:'.$attr8_var.'?';	
	elseif (!empty($attr8_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr8_raw);
	elseif (!empty($attr8_value))
		$tmp_text = $attr8_value;
	else
	  $tmp_text = '&nbsp;';
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
?></<?php echo $tmp_tag ?>><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_var) ?><?php unset($attr8_escape) ?><?php $attr8_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"raw";s:1:"_";s:6:"escape";s:4:"true";}' ?><?php $attr8 = array('class'=>'text','raw'=>'_','escape'=>true) ?><?php $attr8_class='text' ?><?php $attr8_raw='_' ?><?php $attr8_escape=true ?><?php
	if	( isset($attr8_prefix)&& isset($attr8_key))
		$attr8_key = $attr8_prefix.$attr8_key;
	if	( isset($attr8_suffix)&& isset($attr8_key))
		$attr8_key = $attr8_key.$attr8_suffix;
	if(empty($attr8_title))
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
	if	( $attr8_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr8_array))
	{
		$tmpArray = $$attr8_array;
		if (!empty($attr8_var))
			$tmp_text = $tmpArray[$attr8_var];
		else
			$tmp_text = $langF($tmpArray[$attr8_text]);
	}
	elseif (!empty($attr8_text))
		$tmp_text = $langF($attr8_text);
	elseif (!empty($attr8_textvar))
		$tmp_text = $langF($$attr8_textvar);
	elseif (!empty($attr8_key))
		$tmp_text = $langF($attr8_key);
	elseif (!empty($attr8_var))
		$tmp_text = isset($$attr8_var)?$$attr8_var:'?unset:'.$attr8_var.'?';	
	elseif (!empty($attr8_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr8_raw);
	elseif (!empty($attr8_value))
		$tmp_text = $attr8_value;
	else
	  $tmp_text = '&nbsp;';
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
?></<?php echo $tmp_tag ?>><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_raw) ?><?php unset($attr8_escape) ?><?php $attr8_debug_info = 'a:4:{s:5:"title";s:0:"";s:6:"target";s:5:"_self";s:3:"url";s:15:"var:nextyearurl";s:5:"class";s:0:"";}' ?><?php $attr8 = array('title'=>'','target'=>'_self','url'=>$nextyearurl,'class'=>'') ?><?php $attr8_title='' ?><?php $attr8_target='_self' ?><?php $attr8_url=$nextyearurl ?><?php $attr8_class='' ?><?php
	$params = array();
	if (!empty($attr8_var1) && isset($attr8_value1))
		$params[$attr8_var1]=$attr8_value1;
	if (!empty($attr8_var2) && isset($attr8_value2))
		$params[$attr8_var2]=$attr8_value2;
	if (!empty($attr8_var3) && isset($attr8_value3))
		$params[$attr8_var3]=$attr8_value3;
	if (!empty($attr8_var4) && isset($attr8_value4))
		$params[$attr8_var4]=$attr8_value4;
	if (!empty($attr8_var5) && isset($attr8_value5))
		$params[$attr8_var5]=$attr8_value5;
	if(empty($attr8_class))
		$attr8_class='';
	if(empty($attr8_title))
		$attr8_title = '';
	if(!empty($attr8_url))
		$tmp_url = $attr8_url;
	else
		$tmp_url = Html::url($attr8_action,$attr8_subaction,!empty($attr8_id)?$attr8_id:$this->getRequestId(),$params);
?><a<?php if (isset($attr8_name)) echo ' name="'.$attr8_name.'"'; else echo ' href="'.$tmp_url.($attr8_anchor?'#'.$attr8_anchor:'').'"' ?> class="<?php echo $attr8_class ?>" target="<?php echo $attr8_target ?>"<?php if (isset($attr8_accesskey)) echo ' accesskey="'.$attr8_accesskey.'"' ?>  title="<?php echo encodeHtml($attr8_title) ?>"><?php unset($attr8) ?><?php unset($attr8_title) ?><?php unset($attr8_target) ?><?php unset($attr8_url) ?><?php unset($attr8_class) ?><?php $attr9_debug_info = 'a:2:{s:4:"file";s:5:"right";s:5:"align";s:6:"middle";}' ?><?php $attr9 = array('file'=>'right','align'=>'middle') ?><?php $attr9_file='right' ?><?php $attr9_align='middle' ?><?php
if (isset($attr9_elementtype)) {
?><img src="<?php echo $image_dir.'icon_el_'.$attr9_elementtype.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_type)) {
?><img src="<?php echo $image_dir.'icon_'.$attr9_type.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_icon)) {
?><img src="<?php echo $image_dir.'icon_'.$attr9_icon.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_tree)) {
?><img src="<?php echo $image_dir.'tree_'.$attr9_tree.IMG_EXT ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_url)) {
?><img src="<?php echo $attr9_url ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_fileext)) {
?><img src="<?php echo $image_dir.$attr9_fileext ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_file)) {
?><img src="<?php echo $image_dir.$attr9_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr9_align ?>"><?php } ?><?php unset($attr9) ?><?php unset($attr9_file) ?><?php unset($attr9_align) ?><?php $attr7_debug_info = 'a:0:{}' ?><?php $attr7 = array() ?></a><?php unset($attr7) ?><?php $attr6_debug_info = 'a:0:{}' ?><?php $attr6 = array() ?></td><?php unset($attr6) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></tr><?php unset($attr5) ?><?php $attr6_debug_info = 'a:0:{}' ?><?php $attr6 = array() ?><?php
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
?><td <?php foreach( $attr7 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr7) ?><?php $attr8_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"key";s:9:"global_nr";s:6:"escape";s:4:"true";}' ?><?php $attr8 = array('class'=>'text','key'=>'global_nr','escape'=>true) ?><?php $attr8_class='text' ?><?php $attr8_key='global_nr' ?><?php $attr8_escape=true ?><?php
	if	( isset($attr8_prefix)&& isset($attr8_key))
		$attr8_key = $attr8_prefix.$attr8_key;
	if	( isset($attr8_suffix)&& isset($attr8_key))
		$attr8_key = $attr8_key.$attr8_suffix;
	if(empty($attr8_title))
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
	if	( $attr8_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr8_array))
	{
		$tmpArray = $$attr8_array;
		if (!empty($attr8_var))
			$tmp_text = $tmpArray[$attr8_var];
		else
			$tmp_text = $langF($tmpArray[$attr8_text]);
	}
	elseif (!empty($attr8_text))
		$tmp_text = $langF($attr8_text);
	elseif (!empty($attr8_textvar))
		$tmp_text = $langF($$attr8_textvar);
	elseif (!empty($attr8_key))
		$tmp_text = $langF($attr8_key);
	elseif (!empty($attr8_var))
		$tmp_text = isset($$attr8_var)?$$attr8_var:'?unset:'.$attr8_var.'?';	
	elseif (!empty($attr8_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr8_raw);
	elseif (!empty($attr8_value))
		$tmp_text = $attr8_value;
	else
	  $tmp_text = '&nbsp;';
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
?></<?php echo $tmp_tag ?>><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_key) ?><?php unset($attr8_escape) ?><?php $attr6_debug_info = 'a:0:{}' ?><?php $attr6 = array() ?></td><?php unset($attr6) ?><?php $attr7_debug_info = 'a:4:{s:4:"list";s:8:"weekdays";s:7:"extract";s:5:"false";s:3:"key";s:8:"list_key";s:5:"value";s:7:"weekday";}' ?><?php $attr7 = array('list'=>'weekdays','extract'=>false,'key'=>'list_key','value'=>'weekday') ?><?php $attr7_list='weekdays' ?><?php $attr7_extract=false ?><?php $attr7_key='list_key' ?><?php $attr7_value='weekday' ?><?php
	$attr7_list_tmp_key   = $attr7_key;
	$attr7_list_tmp_value = $attr7_value;
	$attr7_list_extract   = $attr7_extract;
	unset($attr7_key);
	unset($attr7_value);
	if	( !isset($$attr7_list) || !is_array($$attr7_list) )
		$$attr7_list = array();
	foreach( $$attr7_list as $$attr7_list_tmp_key => $$attr7_list_tmp_value )
	{
		if	( $attr7_list_extract )
		{
			if	( !is_array($$attr7_list_tmp_value) )
			{
				print_r($$attr7_list_tmp_value);
				die( 'not an array at key: '.$$attr7_list_tmp_key );
			}
			extract($$attr7_list_tmp_value);
		}
?><?php unset($attr7) ?><?php unset($attr7_list) ?><?php unset($attr7_extract) ?><?php unset($attr7_key) ?><?php unset($attr7_value) ?><?php $attr8_debug_info = 'a:0:{}' ?><?php $attr8 = array() ?><?php
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
?><td <?php foreach( $attr8 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr8) ?><?php $attr9_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"var";s:7:"weekday";s:6:"escape";s:4:"true";}' ?><?php $attr9 = array('class'=>'text','var'=>'weekday','escape'=>true) ?><?php $attr9_class='text' ?><?php $attr9_var='weekday' ?><?php $attr9_escape=true ?><?php
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
?></<?php echo $tmp_tag ?>><?php unset($attr9) ?><?php unset($attr9_class) ?><?php unset($attr9_var) ?><?php unset($attr9_escape) ?><?php $attr7_debug_info = 'a:0:{}' ?><?php $attr7 = array() ?></td><?php unset($attr7) ?><?php $attr6_debug_info = 'a:0:{}' ?><?php $attr6 = array() ?><?php } ?><?php unset($attr6) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></tr><?php unset($attr5) ?><?php $attr6_debug_info = 'a:4:{s:4:"list";s:8:"weeklist";s:7:"extract";s:5:"false";s:3:"key";s:6:"weeknr";s:5:"value";s:4:"week";}' ?><?php $attr6 = array('list'=>'weeklist','extract'=>false,'key'=>'weeknr','value'=>'week') ?><?php $attr6_list='weeklist' ?><?php $attr6_extract=false ?><?php $attr6_key='weeknr' ?><?php $attr6_value='week' ?><?php
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
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];
	if (empty($attr7_class))
		$attr7_class=$row_class;
	global $cell_column_nr;
	$cell_column_nr=0;
	$column_class_idx = 999;
?><tr class="<?php echo $attr7_class ?>"><?php unset($attr7) ?><?php $attr8_debug_info = 'a:1:{s:5:"width";s:3:"12%";}' ?><?php $attr8 = array('width'=>'12%') ?><?php $attr8_width='12%' ?><?php
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
?><td <?php foreach( $attr8 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr8) ?><?php unset($attr8_width) ?><?php $attr9_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"var";s:6:"weeknr";s:6:"escape";s:4:"true";}' ?><?php $attr9 = array('class'=>'text','var'=>'weeknr','escape'=>true) ?><?php $attr9_class='text' ?><?php $attr9_var='weeknr' ?><?php $attr9_escape=true ?><?php
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
?></<?php echo $tmp_tag ?>><?php unset($attr9) ?><?php unset($attr9_class) ?><?php unset($attr9_var) ?><?php unset($attr9_escape) ?><?php $attr7_debug_info = 'a:0:{}' ?><?php $attr7 = array() ?></td><?php unset($attr7) ?><?php $attr8_debug_info = 'a:4:{s:4:"list";s:4:"week";s:7:"extract";s:4:"true";s:3:"key";s:8:"list_key";s:5:"value";s:10:"list_value";}' ?><?php $attr8 = array('list'=>'week','extract'=>true,'key'=>'list_key','value'=>'list_value') ?><?php $attr8_list='week' ?><?php $attr8_extract=true ?><?php $attr8_key='list_key' ?><?php $attr8_value='list_value' ?><?php
	$attr8_list_tmp_key   = $attr8_key;
	$attr8_list_tmp_value = $attr8_value;
	$attr8_list_extract   = $attr8_extract;
	unset($attr8_key);
	unset($attr8_value);
	if	( !isset($$attr8_list) || !is_array($$attr8_list) )
		$$attr8_list = array();
	foreach( $$attr8_list as $$attr8_list_tmp_key => $$attr8_list_tmp_value )
	{
		if	( $attr8_list_extract )
		{
			if	( !is_array($$attr8_list_tmp_value) )
			{
				print_r($$attr8_list_tmp_value);
				die( 'not an array at key: '.$$attr8_list_tmp_key );
			}
			extract($$attr8_list_tmp_value);
		}
?><?php unset($attr8) ?><?php unset($attr8_list) ?><?php unset($attr8_extract) ?><?php unset($attr8_key) ?><?php unset($attr8_value) ?><?php $attr9_debug_info = 'a:1:{s:5:"width";s:3:"12%";}' ?><?php $attr9 = array('width'=>'12%') ?><?php $attr9_width='12%' ?><?php
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
?><td <?php foreach( $attr9 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr9) ?><?php unset($attr9_width) ?><?php $attr10_debug_info = 'a:1:{s:5:"empty";s:3:"url";}' ?><?php $attr10 = array('empty'=>'url') ?><?php $attr10_empty='url' ?><?php 
	if	( isset($attr10_true) )
	{
		if	(gettype($attr10_true) === '' && gettype($attr10_true) === '1')
			$exec = $$attr10_true == true;
		else
			$exec = $attr10_true == true;
	}
	elseif	( isset($attr10_false) )
	{
		if	(gettype($attr10_false) === '' && gettype($attr10_false) === '1')
			$exec = $$attr10_false == false;
		else
			$exec = $attr10_false == false;
	}
	elseif( isset($attr10_contains) )
		$exec = in_array($attr10_value,explode(',',$attr10_contains));
	elseif( isset($attr10_equals)&& isset($attr10_value) )
		$exec = $attr10_equals == $attr10_value;
	elseif( isset($attr10_lessthan)&& isset($attr10_value) )
		$exec = intval($attr10_lessthan) > intval($attr10_value);
	elseif( isset($attr10_greaterthan)&& isset($attr10_value) )
		$exec = intval($attr10_greaterthan) < intval($attr10_value);
	elseif	( isset($attr10_empty) )
	{
		if	( !isset($$attr10_empty) )
			$exec = empty($attr10_empty);
		elseif	( is_array($$attr10_empty) )
			$exec = (count($$attr10_empty)==0);
		elseif	( is_bool($$attr10_empty) )
			$exec = true;
		else
			$exec = empty( $$attr10_empty );
	}
	elseif	( isset($attr10_present) )
	{
		$exec = isset($$attr10_present);
	}
	else
	{
		trigger_error("error in IF, assume: FALSE");
		$exec = false;
	}
	if  ( !empty($attr10_invert) )
		$exec = !$exec;
	if  ( !empty($attr10_not) )
		$exec = !$exec;
	unset($attr10_true);
	unset($attr10_false);
	unset($attr10_notempty);
	unset($attr10_empty);
	unset($attr10_contains);
	unset($attr10_present);
	unset($attr10_invert);
	unset($attr10_not);
	unset($attr10_value);
	unset($attr10_equals);
	$last_exec = $exec;
	if	( $exec )
	{
?>
<?php unset($attr10) ?><?php unset($attr10_empty) ?><?php $attr11_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"raw";s:2:"__";s:6:"escape";s:4:"true";}' ?><?php $attr11 = array('class'=>'text','raw'=>'__','escape'=>true) ?><?php $attr11_class='text' ?><?php $attr11_raw='__' ?><?php $attr11_escape=true ?><?php
	if	( isset($attr11_prefix)&& isset($attr11_key))
		$attr11_key = $attr11_prefix.$attr11_key;
	if	( isset($attr11_suffix)&& isset($attr11_key))
		$attr11_key = $attr11_key.$attr11_suffix;
	if(empty($attr11_title))
			$attr11_title = '';
	if	(empty($attr11_type))
		$tmp_tag = 'span';
	else
		switch( $attr11_type )
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
?><<?php echo $tmp_tag ?> class="<?php echo $attr11_class ?>" title="<?php echo $attr11_title ?>"><?php
	$attr11_title = '';
	if	( $attr11_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr11_array))
	{
		$tmpArray = $$attr11_array;
		if (!empty($attr11_var))
			$tmp_text = $tmpArray[$attr11_var];
		else
			$tmp_text = $langF($tmpArray[$attr11_text]);
	}
	elseif (!empty($attr11_text))
		$tmp_text = $langF($attr11_text);
	elseif (!empty($attr11_textvar))
		$tmp_text = $langF($$attr11_textvar);
	elseif (!empty($attr11_key))
		$tmp_text = $langF($attr11_key);
	elseif (!empty($attr11_var))
		$tmp_text = isset($$attr11_var)?$$attr11_var:'?unset:'.$attr11_var.'?';	
	elseif (!empty($attr11_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr11_raw);
	elseif (!empty($attr11_value))
		$tmp_text = $attr11_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr11_maxlength) && intval($attr11_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr11_maxlength) );
	if	(isset($attr11_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr11_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr11) ?><?php unset($attr11_class) ?><?php unset($attr11_raw) ?><?php unset($attr11_escape) ?><?php $attr11_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"var";s:2:"nr";s:6:"escape";s:4:"true";}' ?><?php $attr11 = array('class'=>'text','var'=>'nr','escape'=>true) ?><?php $attr11_class='text' ?><?php $attr11_var='nr' ?><?php $attr11_escape=true ?><?php
	if	( isset($attr11_prefix)&& isset($attr11_key))
		$attr11_key = $attr11_prefix.$attr11_key;
	if	( isset($attr11_suffix)&& isset($attr11_key))
		$attr11_key = $attr11_key.$attr11_suffix;
	if(empty($attr11_title))
			$attr11_title = '';
	if	(empty($attr11_type))
		$tmp_tag = 'span';
	else
		switch( $attr11_type )
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
?><<?php echo $tmp_tag ?> class="<?php echo $attr11_class ?>" title="<?php echo $attr11_title ?>"><?php
	$attr11_title = '';
	if	( $attr11_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr11_array))
	{
		$tmpArray = $$attr11_array;
		if (!empty($attr11_var))
			$tmp_text = $tmpArray[$attr11_var];
		else
			$tmp_text = $langF($tmpArray[$attr11_text]);
	}
	elseif (!empty($attr11_text))
		$tmp_text = $langF($attr11_text);
	elseif (!empty($attr11_textvar))
		$tmp_text = $langF($$attr11_textvar);
	elseif (!empty($attr11_key))
		$tmp_text = $langF($attr11_key);
	elseif (!empty($attr11_var))
		$tmp_text = isset($$attr11_var)?$$attr11_var:'?unset:'.$attr11_var.'?';	
	elseif (!empty($attr11_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr11_raw);
	elseif (!empty($attr11_value))
		$tmp_text = $attr11_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr11_maxlength) && intval($attr11_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr11_maxlength) );
	if	(isset($attr11_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr11_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr11) ?><?php unset($attr11_class) ?><?php unset($attr11_var) ?><?php unset($attr11_escape) ?><?php $attr11_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"raw";s:2:"__";s:6:"escape";s:4:"true";}' ?><?php $attr11 = array('class'=>'text','raw'=>'__','escape'=>true) ?><?php $attr11_class='text' ?><?php $attr11_raw='__' ?><?php $attr11_escape=true ?><?php
	if	( isset($attr11_prefix)&& isset($attr11_key))
		$attr11_key = $attr11_prefix.$attr11_key;
	if	( isset($attr11_suffix)&& isset($attr11_key))
		$attr11_key = $attr11_key.$attr11_suffix;
	if(empty($attr11_title))
			$attr11_title = '';
	if	(empty($attr11_type))
		$tmp_tag = 'span';
	else
		switch( $attr11_type )
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
?><<?php echo $tmp_tag ?> class="<?php echo $attr11_class ?>" title="<?php echo $attr11_title ?>"><?php
	$attr11_title = '';
	if	( $attr11_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr11_array))
	{
		$tmpArray = $$attr11_array;
		if (!empty($attr11_var))
			$tmp_text = $tmpArray[$attr11_var];
		else
			$tmp_text = $langF($tmpArray[$attr11_text]);
	}
	elseif (!empty($attr11_text))
		$tmp_text = $langF($attr11_text);
	elseif (!empty($attr11_textvar))
		$tmp_text = $langF($$attr11_textvar);
	elseif (!empty($attr11_key))
		$tmp_text = $langF($attr11_key);
	elseif (!empty($attr11_var))
		$tmp_text = isset($$attr11_var)?$$attr11_var:'?unset:'.$attr11_var.'?';	
	elseif (!empty($attr11_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr11_raw);
	elseif (!empty($attr11_value))
		$tmp_text = $attr11_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr11_maxlength) && intval($attr11_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr11_maxlength) );
	if	(isset($attr11_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr11_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr11) ?><?php unset($attr11_class) ?><?php unset($attr11_raw) ?><?php unset($attr11_escape) ?><?php $attr9_debug_info = 'a:0:{}' ?><?php $attr9 = array() ?><?php } ?><?php unset($attr9) ?><?php $attr10_debug_info = 'a:2:{s:3:"not";s:4:"true";s:5:"empty";s:3:"url";}' ?><?php $attr10 = array('not'=>true,'empty'=>'url') ?><?php $attr10_not=true ?><?php $attr10_empty='url' ?><?php 
	if	( isset($attr10_true) )
	{
		if	(gettype($attr10_true) === '' && gettype($attr10_true) === '1')
			$exec = $$attr10_true == true;
		else
			$exec = $attr10_true == true;
	}
	elseif	( isset($attr10_false) )
	{
		if	(gettype($attr10_false) === '' && gettype($attr10_false) === '1')
			$exec = $$attr10_false == false;
		else
			$exec = $attr10_false == false;
	}
	elseif( isset($attr10_contains) )
		$exec = in_array($attr10_value,explode(',',$attr10_contains));
	elseif( isset($attr10_equals)&& isset($attr10_value) )
		$exec = $attr10_equals == $attr10_value;
	elseif( isset($attr10_lessthan)&& isset($attr10_value) )
		$exec = intval($attr10_lessthan) > intval($attr10_value);
	elseif( isset($attr10_greaterthan)&& isset($attr10_value) )
		$exec = intval($attr10_greaterthan) < intval($attr10_value);
	elseif	( isset($attr10_empty) )
	{
		if	( !isset($$attr10_empty) )
			$exec = empty($attr10_empty);
		elseif	( is_array($$attr10_empty) )
			$exec = (count($$attr10_empty)==0);
		elseif	( is_bool($$attr10_empty) )
			$exec = true;
		else
			$exec = empty( $$attr10_empty );
	}
	elseif	( isset($attr10_present) )
	{
		$exec = isset($$attr10_present);
	}
	else
	{
		trigger_error("error in IF, assume: FALSE");
		$exec = false;
	}
	if  ( !empty($attr10_invert) )
		$exec = !$exec;
	if  ( !empty($attr10_not) )
		$exec = !$exec;
	unset($attr10_true);
	unset($attr10_false);
	unset($attr10_notempty);
	unset($attr10_empty);
	unset($attr10_contains);
	unset($attr10_present);
	unset($attr10_invert);
	unset($attr10_not);
	unset($attr10_value);
	unset($attr10_equals);
	$last_exec = $exec;
	if	( $exec )
	{
?>
<?php unset($attr10) ?><?php unset($attr10_not) ?><?php unset($attr10_empty) ?><?php $attr11_debug_info = 'a:4:{s:5:"title";s:0:"";s:6:"target";s:5:"_self";s:3:"url";s:7:"var:url";s:5:"class";s:0:"";}' ?><?php $attr11 = array('title'=>'','target'=>'_self','url'=>$url,'class'=>'') ?><?php $attr11_title='' ?><?php $attr11_target='_self' ?><?php $attr11_url=$url ?><?php $attr11_class='' ?><?php
	$params = array();
	if (!empty($attr11_var1) && isset($attr11_value1))
		$params[$attr11_var1]=$attr11_value1;
	if (!empty($attr11_var2) && isset($attr11_value2))
		$params[$attr11_var2]=$attr11_value2;
	if (!empty($attr11_var3) && isset($attr11_value3))
		$params[$attr11_var3]=$attr11_value3;
	if (!empty($attr11_var4) && isset($attr11_value4))
		$params[$attr11_var4]=$attr11_value4;
	if (!empty($attr11_var5) && isset($attr11_value5))
		$params[$attr11_var5]=$attr11_value5;
	if(empty($attr11_class))
		$attr11_class='';
	if(empty($attr11_title))
		$attr11_title = '';
	if(!empty($attr11_url))
		$tmp_url = $attr11_url;
	else
		$tmp_url = Html::url($attr11_action,$attr11_subaction,!empty($attr11_id)?$attr11_id:$this->getRequestId(),$params);
?><a<?php if (isset($attr11_name)) echo ' name="'.$attr11_name.'"'; else echo ' href="'.$tmp_url.($attr11_anchor?'#'.$attr11_anchor:'').'"' ?> class="<?php echo $attr11_class ?>" target="<?php echo $attr11_target ?>"<?php if (isset($attr11_accesskey)) echo ' accesskey="'.$attr11_accesskey.'"' ?>  title="<?php echo encodeHtml($attr11_title) ?>"><?php unset($attr11) ?><?php unset($attr11_title) ?><?php unset($attr11_target) ?><?php unset($attr11_url) ?><?php unset($attr11_class) ?><?php $attr12_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"raw";s:2:"__";s:6:"escape";s:4:"true";}' ?><?php $attr12 = array('class'=>'text','raw'=>'__','escape'=>true) ?><?php $attr12_class='text' ?><?php $attr12_raw='__' ?><?php $attr12_escape=true ?><?php
	if	( isset($attr12_prefix)&& isset($attr12_key))
		$attr12_key = $attr12_prefix.$attr12_key;
	if	( isset($attr12_suffix)&& isset($attr12_key))
		$attr12_key = $attr12_key.$attr12_suffix;
	if(empty($attr12_title))
			$attr12_title = '';
	if	(empty($attr12_type))
		$tmp_tag = 'span';
	else
		switch( $attr12_type )
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
?><<?php echo $tmp_tag ?> class="<?php echo $attr12_class ?>" title="<?php echo $attr12_title ?>"><?php
	$attr12_title = '';
	if	( $attr12_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr12_array))
	{
		$tmpArray = $$attr12_array;
		if (!empty($attr12_var))
			$tmp_text = $tmpArray[$attr12_var];
		else
			$tmp_text = $langF($tmpArray[$attr12_text]);
	}
	elseif (!empty($attr12_text))
		$tmp_text = $langF($attr12_text);
	elseif (!empty($attr12_textvar))
		$tmp_text = $langF($$attr12_textvar);
	elseif (!empty($attr12_key))
		$tmp_text = $langF($attr12_key);
	elseif (!empty($attr12_var))
		$tmp_text = isset($$attr12_var)?$$attr12_var:'?unset:'.$attr12_var.'?';	
	elseif (!empty($attr12_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr12_raw);
	elseif (!empty($attr12_value))
		$tmp_text = $attr12_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr12_maxlength) && intval($attr12_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr12_maxlength) );
	if	(isset($attr12_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr12_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr12) ?><?php unset($attr12_class) ?><?php unset($attr12_raw) ?><?php unset($attr12_escape) ?><?php $attr12_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"var";s:2:"nr";s:6:"escape";s:4:"true";}' ?><?php $attr12 = array('class'=>'text','var'=>'nr','escape'=>true) ?><?php $attr12_class='text' ?><?php $attr12_var='nr' ?><?php $attr12_escape=true ?><?php
	if	( isset($attr12_prefix)&& isset($attr12_key))
		$attr12_key = $attr12_prefix.$attr12_key;
	if	( isset($attr12_suffix)&& isset($attr12_key))
		$attr12_key = $attr12_key.$attr12_suffix;
	if(empty($attr12_title))
			$attr12_title = '';
	if	(empty($attr12_type))
		$tmp_tag = 'span';
	else
		switch( $attr12_type )
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
?><<?php echo $tmp_tag ?> class="<?php echo $attr12_class ?>" title="<?php echo $attr12_title ?>"><?php
	$attr12_title = '';
	if	( $attr12_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr12_array))
	{
		$tmpArray = $$attr12_array;
		if (!empty($attr12_var))
			$tmp_text = $tmpArray[$attr12_var];
		else
			$tmp_text = $langF($tmpArray[$attr12_text]);
	}
	elseif (!empty($attr12_text))
		$tmp_text = $langF($attr12_text);
	elseif (!empty($attr12_textvar))
		$tmp_text = $langF($$attr12_textvar);
	elseif (!empty($attr12_key))
		$tmp_text = $langF($attr12_key);
	elseif (!empty($attr12_var))
		$tmp_text = isset($$attr12_var)?$$attr12_var:'?unset:'.$attr12_var.'?';	
	elseif (!empty($attr12_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr12_raw);
	elseif (!empty($attr12_value))
		$tmp_text = $attr12_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr12_maxlength) && intval($attr12_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr12_maxlength) );
	if	(isset($attr12_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr12_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr12) ?><?php unset($attr12_class) ?><?php unset($attr12_var) ?><?php unset($attr12_escape) ?><?php $attr12_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"raw";s:2:"__";s:6:"escape";s:4:"true";}' ?><?php $attr12 = array('class'=>'text','raw'=>'__','escape'=>true) ?><?php $attr12_class='text' ?><?php $attr12_raw='__' ?><?php $attr12_escape=true ?><?php
	if	( isset($attr12_prefix)&& isset($attr12_key))
		$attr12_key = $attr12_prefix.$attr12_key;
	if	( isset($attr12_suffix)&& isset($attr12_key))
		$attr12_key = $attr12_key.$attr12_suffix;
	if(empty($attr12_title))
			$attr12_title = '';
	if	(empty($attr12_type))
		$tmp_tag = 'span';
	else
		switch( $attr12_type )
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
?><<?php echo $tmp_tag ?> class="<?php echo $attr12_class ?>" title="<?php echo $attr12_title ?>"><?php
	$attr12_title = '';
	if	( $attr12_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr12_array))
	{
		$tmpArray = $$attr12_array;
		if (!empty($attr12_var))
			$tmp_text = $tmpArray[$attr12_var];
		else
			$tmp_text = $langF($tmpArray[$attr12_text]);
	}
	elseif (!empty($attr12_text))
		$tmp_text = $langF($attr12_text);
	elseif (!empty($attr12_textvar))
		$tmp_text = $langF($$attr12_textvar);
	elseif (!empty($attr12_key))
		$tmp_text = $langF($attr12_key);
	elseif (!empty($attr12_var))
		$tmp_text = isset($$attr12_var)?$$attr12_var:'?unset:'.$attr12_var.'?';	
	elseif (!empty($attr12_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr12_raw);
	elseif (!empty($attr12_value))
		$tmp_text = $attr12_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr12_maxlength) && intval($attr12_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr12_maxlength) );
	if	(isset($attr12_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr12_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr12) ?><?php unset($attr12_class) ?><?php unset($attr12_raw) ?><?php unset($attr12_escape) ?><?php $attr10_debug_info = 'a:0:{}' ?><?php $attr10 = array() ?></a><?php unset($attr10) ?><?php $attr9_debug_info = 'a:0:{}' ?><?php $attr9 = array() ?><?php } ?><?php unset($attr9) ?><?php $attr10_debug_info = 'a:1:{s:4:"true";s:9:"var:today";}' ?><?php $attr10 = array('true'=>$today) ?><?php $attr10_true=$today ?><?php 
	if	( isset($attr10_true) )
	{
		if	(gettype($attr10_true) === '' && gettype($attr10_true) === '1')
			$exec = $$attr10_true == true;
		else
			$exec = $attr10_true == true;
	}
	elseif	( isset($attr10_false) )
	{
		if	(gettype($attr10_false) === '' && gettype($attr10_false) === '1')
			$exec = $$attr10_false == false;
		else
			$exec = $attr10_false == false;
	}
	elseif( isset($attr10_contains) )
		$exec = in_array($attr10_value,explode(',',$attr10_contains));
	elseif( isset($attr10_equals)&& isset($attr10_value) )
		$exec = $attr10_equals == $attr10_value;
	elseif( isset($attr10_lessthan)&& isset($attr10_value) )
		$exec = intval($attr10_lessthan) > intval($attr10_value);
	elseif( isset($attr10_greaterthan)&& isset($attr10_value) )
		$exec = intval($attr10_greaterthan) < intval($attr10_value);
	elseif	( isset($attr10_empty) )
	{
		if	( !isset($$attr10_empty) )
			$exec = empty($attr10_empty);
		elseif	( is_array($$attr10_empty) )
			$exec = (count($$attr10_empty)==0);
		elseif	( is_bool($$attr10_empty) )
			$exec = true;
		else
			$exec = empty( $$attr10_empty );
	}
	elseif	( isset($attr10_present) )
	{
		$exec = isset($$attr10_present);
	}
	else
	{
		trigger_error("error in IF, assume: FALSE");
		$exec = false;
	}
	if  ( !empty($attr10_invert) )
		$exec = !$exec;
	if  ( !empty($attr10_not) )
		$exec = !$exec;
	unset($attr10_true);
	unset($attr10_false);
	unset($attr10_notempty);
	unset($attr10_empty);
	unset($attr10_contains);
	unset($attr10_present);
	unset($attr10_invert);
	unset($attr10_not);
	unset($attr10_value);
	unset($attr10_equals);
	$last_exec = $exec;
	if	( $exec )
	{
?>
<?php unset($attr10) ?><?php unset($attr10_true) ?><?php $attr11_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"raw";s:1:"*";s:6:"escape";s:4:"true";}' ?><?php $attr11 = array('class'=>'text','raw'=>'*','escape'=>true) ?><?php $attr11_class='text' ?><?php $attr11_raw='*' ?><?php $attr11_escape=true ?><?php
	if	( isset($attr11_prefix)&& isset($attr11_key))
		$attr11_key = $attr11_prefix.$attr11_key;
	if	( isset($attr11_suffix)&& isset($attr11_key))
		$attr11_key = $attr11_key.$attr11_suffix;
	if(empty($attr11_title))
			$attr11_title = '';
	if	(empty($attr11_type))
		$tmp_tag = 'span';
	else
		switch( $attr11_type )
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
?><<?php echo $tmp_tag ?> class="<?php echo $attr11_class ?>" title="<?php echo $attr11_title ?>"><?php
	$attr11_title = '';
	if	( $attr11_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr11_array))
	{
		$tmpArray = $$attr11_array;
		if (!empty($attr11_var))
			$tmp_text = $tmpArray[$attr11_var];
		else
			$tmp_text = $langF($tmpArray[$attr11_text]);
	}
	elseif (!empty($attr11_text))
		$tmp_text = $langF($attr11_text);
	elseif (!empty($attr11_textvar))
		$tmp_text = $langF($$attr11_textvar);
	elseif (!empty($attr11_key))
		$tmp_text = $langF($attr11_key);
	elseif (!empty($attr11_var))
		$tmp_text = isset($$attr11_var)?$$attr11_var:'?unset:'.$attr11_var.'?';	
	elseif (!empty($attr11_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr11_raw);
	elseif (!empty($attr11_value))
		$tmp_text = $attr11_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr11_maxlength) && intval($attr11_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr11_maxlength) );
	if	(isset($attr11_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr11_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr11) ?><?php unset($attr11_class) ?><?php unset($attr11_raw) ?><?php unset($attr11_escape) ?><?php $attr9_debug_info = 'a:0:{}' ?><?php $attr9 = array() ?><?php } ?><?php unset($attr9) ?><?php $attr8_debug_info = 'a:0:{}' ?><?php $attr8 = array() ?></td><?php unset($attr8) ?><?php $attr7_debug_info = 'a:0:{}' ?><?php $attr7 = array() ?><?php } ?><?php unset($attr7) ?><?php $attr6_debug_info = 'a:0:{}' ?><?php $attr6 = array() ?></tr><?php unset($attr6) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?><?php } ?><?php unset($attr5) ?><?php $attr6_debug_info = 'a:0:{}' ?><?php $attr6 = array() ?><?php
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
?><td <?php foreach( $attr7 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_colspan) ?><?php $attr8_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"key";s:4:"date";s:6:"escape";s:4:"true";}' ?><?php $attr8 = array('class'=>'text','key'=>'date','escape'=>true) ?><?php $attr8_class='text' ?><?php $attr8_key='date' ?><?php $attr8_escape=true ?><?php
	if	( isset($attr8_prefix)&& isset($attr8_key))
		$attr8_key = $attr8_prefix.$attr8_key;
	if	( isset($attr8_suffix)&& isset($attr8_key))
		$attr8_key = $attr8_key.$attr8_suffix;
	if(empty($attr8_title))
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
	if	( $attr8_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr8_array))
	{
		$tmpArray = $$attr8_array;
		if (!empty($attr8_var))
			$tmp_text = $tmpArray[$attr8_var];
		else
			$tmp_text = $langF($tmpArray[$attr8_text]);
	}
	elseif (!empty($attr8_text))
		$tmp_text = $langF($attr8_text);
	elseif (!empty($attr8_textvar))
		$tmp_text = $langF($$attr8_textvar);
	elseif (!empty($attr8_key))
		$tmp_text = $langF($attr8_key);
	elseif (!empty($attr8_var))
		$tmp_text = isset($$attr8_var)?$$attr8_var:'?unset:'.$attr8_var.'?';	
	elseif (!empty($attr8_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr8_raw);
	elseif (!empty($attr8_value))
		$tmp_text = $attr8_value;
	else
	  $tmp_text = '&nbsp;';
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
?></<?php echo $tmp_tag ?>><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_key) ?><?php unset($attr8_escape) ?><?php $attr6_debug_info = 'a:0:{}' ?><?php $attr6 = array() ?></td><?php unset($attr6) ?><?php $attr7_debug_info = 'a:2:{s:5:"class";s:2:"fx";s:7:"colspan";s:1:"5";}' ?><?php $attr7 = array('class'=>'fx','colspan'=>'5') ?><?php $attr7_class='fx' ?><?php $attr7_colspan='5' ?><?php
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
?><td <?php foreach( $attr7 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_colspan) ?><?php $attr8_debug_info = 'a:9:{s:4:"list";s:9:"all_years";s:4:"name";s:4:"year";s:8:"onchange";s:0:"";s:5:"title";s:0:"";s:5:"class";s:0:"";s:8:"addempty";s:5:"false";s:8:"multiple";s:5:"false";s:4:"size";s:1:"1";s:4:"lang";s:5:"false";}' ?><?php $attr8 = array('list'=>'all_years','name'=>'year','onchange'=>'','title'=>'','class'=>'','addempty'=>false,'multiple'=>false,'size'=>'1','lang'=>false) ?><?php $attr8_list='all_years' ?><?php $attr8_name='year' ?><?php $attr8_onchange='' ?><?php $attr8_title='' ?><?php $attr8_class='' ?><?php $attr8_addempty=false ?><?php $attr8_multiple=false ?><?php $attr8_size='1' ?><?php $attr8_lang=false ?><?php
if ($this->isEditable() && $this->getRequestVar('mode')!='edit') $attr8_readonly=true;
if ( $attr8_addempty!==FALSE  )
{
	if ($attr8_addempty===TRUE)
		$$attr8_list = array(''=>lang('LIST_ENTRY_EMPTY'))+$$attr8_list;
	else
		$$attr8_list = array(''=>'- '.lang($attr8_addempty).' -')+$$attr8_list;
}
?><select<?php if ($attr8_readonly) echo ' disabled="disabled"' ?> id="id_<?php echo $attr8_name ?>"  name="<?php echo $attr8_name; if ($attr8_multiple) echo '[]'; ?>" onchange="<?php echo $attr8_onchange ?>" title="<?php echo $attr8_title ?>" class="<?php echo $attr8_class ?>"<?php
if (count($$attr8_list)<=1) echo ' disabled="disabled"';
if	($attr8_multiple) echo ' multiple="multiple"';
if (in_array($attr8_name,$errors)) echo ' style="background-color:red; border:2px dashed red;"';
echo ' size="'.intval($attr8_size).'"';
?>><?php
		$attr8_tmp_list = $$attr8_list;
		if	( isset($$attr8_name) && isset($attr8_tmp_list[$$attr8_name]) )
			$attr8_tmp_default = $$attr8_name;
		elseif ( isset($attr8_default) )
			$attr8_tmp_default = $attr8_default;
		else
			$attr8_tmp_default = '';
		foreach( $attr8_tmp_list as $box_key=>$box_value )
		{
			if	( is_array($box_value) )
			{
				$box_key   = $box_value['key'  ];
				$box_title = $box_value['title'];
				$box_value = $box_value['value'];
			}
			elseif( $attr8_lang )
			{
				$box_title = lang( $box_value.'_DESC');
				$box_value = lang( $box_value        );
			}
			else
			{
				$box_title = '';
			}
			echo '<option class="'.$attr8_class.'" value="'.$box_key.'" title="'.$box_title.'"';
			if ($box_key==$attr8_tmp_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select><?php
if (count($$attr8_list)==0) echo '<input type="hidden" name="'.$attr8_name.'" value="" />';
if (count($$attr8_list)==1) echo '<input type="hidden" name="'.$attr8_name.'" value="'.$box_key.'" />'
?><?php unset($attr8) ?><?php unset($attr8_list) ?><?php unset($attr8_name) ?><?php unset($attr8_onchange) ?><?php unset($attr8_title) ?><?php unset($attr8_class) ?><?php unset($attr8_addempty) ?><?php unset($attr8_multiple) ?><?php unset($attr8_size) ?><?php unset($attr8_lang) ?><?php $attr8_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"raw";s:3:"_-_";s:6:"escape";s:4:"true";}' ?><?php $attr8 = array('class'=>'text','raw'=>'_-_','escape'=>true) ?><?php $attr8_class='text' ?><?php $attr8_raw='_-_' ?><?php $attr8_escape=true ?><?php
	if	( isset($attr8_prefix)&& isset($attr8_key))
		$attr8_key = $attr8_prefix.$attr8_key;
	if	( isset($attr8_suffix)&& isset($attr8_key))
		$attr8_key = $attr8_key.$attr8_suffix;
	if(empty($attr8_title))
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
	if	( $attr8_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr8_array))
	{
		$tmpArray = $$attr8_array;
		if (!empty($attr8_var))
			$tmp_text = $tmpArray[$attr8_var];
		else
			$tmp_text = $langF($tmpArray[$attr8_text]);
	}
	elseif (!empty($attr8_text))
		$tmp_text = $langF($attr8_text);
	elseif (!empty($attr8_textvar))
		$tmp_text = $langF($$attr8_textvar);
	elseif (!empty($attr8_key))
		$tmp_text = $langF($attr8_key);
	elseif (!empty($attr8_var))
		$tmp_text = isset($$attr8_var)?$$attr8_var:'?unset:'.$attr8_var.'?';	
	elseif (!empty($attr8_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr8_raw);
	elseif (!empty($attr8_value))
		$tmp_text = $attr8_value;
	else
	  $tmp_text = '&nbsp;';
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
?></<?php echo $tmp_tag ?>><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_raw) ?><?php unset($attr8_escape) ?><?php $attr8_debug_info = 'a:9:{s:4:"list";s:10:"all_months";s:4:"name";s:5:"month";s:8:"onchange";s:0:"";s:5:"title";s:0:"";s:5:"class";s:0:"";s:8:"addempty";s:5:"false";s:8:"multiple";s:5:"false";s:4:"size";s:1:"1";s:4:"lang";s:5:"false";}' ?><?php $attr8 = array('list'=>'all_months','name'=>'month','onchange'=>'','title'=>'','class'=>'','addempty'=>false,'multiple'=>false,'size'=>'1','lang'=>false) ?><?php $attr8_list='all_months' ?><?php $attr8_name='month' ?><?php $attr8_onchange='' ?><?php $attr8_title='' ?><?php $attr8_class='' ?><?php $attr8_addempty=false ?><?php $attr8_multiple=false ?><?php $attr8_size='1' ?><?php $attr8_lang=false ?><?php
if ($this->isEditable() && $this->getRequestVar('mode')!='edit') $attr8_readonly=true;
if ( $attr8_addempty!==FALSE  )
{
	if ($attr8_addempty===TRUE)
		$$attr8_list = array(''=>lang('LIST_ENTRY_EMPTY'))+$$attr8_list;
	else
		$$attr8_list = array(''=>'- '.lang($attr8_addempty).' -')+$$attr8_list;
}
?><select<?php if ($attr8_readonly) echo ' disabled="disabled"' ?> id="id_<?php echo $attr8_name ?>"  name="<?php echo $attr8_name; if ($attr8_multiple) echo '[]'; ?>" onchange="<?php echo $attr8_onchange ?>" title="<?php echo $attr8_title ?>" class="<?php echo $attr8_class ?>"<?php
if (count($$attr8_list)<=1) echo ' disabled="disabled"';
if	($attr8_multiple) echo ' multiple="multiple"';
if (in_array($attr8_name,$errors)) echo ' style="background-color:red; border:2px dashed red;"';
echo ' size="'.intval($attr8_size).'"';
?>><?php
		$attr8_tmp_list = $$attr8_list;
		if	( isset($$attr8_name) && isset($attr8_tmp_list[$$attr8_name]) )
			$attr8_tmp_default = $$attr8_name;
		elseif ( isset($attr8_default) )
			$attr8_tmp_default = $attr8_default;
		else
			$attr8_tmp_default = '';
		foreach( $attr8_tmp_list as $box_key=>$box_value )
		{
			if	( is_array($box_value) )
			{
				$box_key   = $box_value['key'  ];
				$box_title = $box_value['title'];
				$box_value = $box_value['value'];
			}
			elseif( $attr8_lang )
			{
				$box_title = lang( $box_value.'_DESC');
				$box_value = lang( $box_value        );
			}
			else
			{
				$box_title = '';
			}
			echo '<option class="'.$attr8_class.'" value="'.$box_key.'" title="'.$box_title.'"';
			if ($box_key==$attr8_tmp_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select><?php
if (count($$attr8_list)==0) echo '<input type="hidden" name="'.$attr8_name.'" value="" />';
if (count($$attr8_list)==1) echo '<input type="hidden" name="'.$attr8_name.'" value="'.$box_key.'" />'
?><?php unset($attr8) ?><?php unset($attr8_list) ?><?php unset($attr8_name) ?><?php unset($attr8_onchange) ?><?php unset($attr8_title) ?><?php unset($attr8_class) ?><?php unset($attr8_addempty) ?><?php unset($attr8_multiple) ?><?php unset($attr8_size) ?><?php unset($attr8_lang) ?><?php $attr8_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"raw";s:3:"_-_";s:6:"escape";s:4:"true";}' ?><?php $attr8 = array('class'=>'text','raw'=>'_-_','escape'=>true) ?><?php $attr8_class='text' ?><?php $attr8_raw='_-_' ?><?php $attr8_escape=true ?><?php
	if	( isset($attr8_prefix)&& isset($attr8_key))
		$attr8_key = $attr8_prefix.$attr8_key;
	if	( isset($attr8_suffix)&& isset($attr8_key))
		$attr8_key = $attr8_key.$attr8_suffix;
	if(empty($attr8_title))
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
	if	( $attr8_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr8_array))
	{
		$tmpArray = $$attr8_array;
		if (!empty($attr8_var))
			$tmp_text = $tmpArray[$attr8_var];
		else
			$tmp_text = $langF($tmpArray[$attr8_text]);
	}
	elseif (!empty($attr8_text))
		$tmp_text = $langF($attr8_text);
	elseif (!empty($attr8_textvar))
		$tmp_text = $langF($$attr8_textvar);
	elseif (!empty($attr8_key))
		$tmp_text = $langF($attr8_key);
	elseif (!empty($attr8_var))
		$tmp_text = isset($$attr8_var)?$$attr8_var:'?unset:'.$attr8_var.'?';	
	elseif (!empty($attr8_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr8_raw);
	elseif (!empty($attr8_value))
		$tmp_text = $attr8_value;
	else
	  $tmp_text = '&nbsp;';
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
?></<?php echo $tmp_tag ?>><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_raw) ?><?php unset($attr8_escape) ?><?php $attr8_debug_info = 'a:9:{s:4:"list";s:8:"all_days";s:4:"name";s:3:"day";s:8:"onchange";s:0:"";s:5:"title";s:0:"";s:5:"class";s:0:"";s:8:"addempty";s:5:"false";s:8:"multiple";s:5:"false";s:4:"size";s:1:"1";s:4:"lang";s:5:"false";}' ?><?php $attr8 = array('list'=>'all_days','name'=>'day','onchange'=>'','title'=>'','class'=>'','addempty'=>false,'multiple'=>false,'size'=>'1','lang'=>false) ?><?php $attr8_list='all_days' ?><?php $attr8_name='day' ?><?php $attr8_onchange='' ?><?php $attr8_title='' ?><?php $attr8_class='' ?><?php $attr8_addempty=false ?><?php $attr8_multiple=false ?><?php $attr8_size='1' ?><?php $attr8_lang=false ?><?php
if ($this->isEditable() && $this->getRequestVar('mode')!='edit') $attr8_readonly=true;
if ( $attr8_addempty!==FALSE  )
{
	if ($attr8_addempty===TRUE)
		$$attr8_list = array(''=>lang('LIST_ENTRY_EMPTY'))+$$attr8_list;
	else
		$$attr8_list = array(''=>'- '.lang($attr8_addempty).' -')+$$attr8_list;
}
?><select<?php if ($attr8_readonly) echo ' disabled="disabled"' ?> id="id_<?php echo $attr8_name ?>"  name="<?php echo $attr8_name; if ($attr8_multiple) echo '[]'; ?>" onchange="<?php echo $attr8_onchange ?>" title="<?php echo $attr8_title ?>" class="<?php echo $attr8_class ?>"<?php
if (count($$attr8_list)<=1) echo ' disabled="disabled"';
if	($attr8_multiple) echo ' multiple="multiple"';
if (in_array($attr8_name,$errors)) echo ' style="background-color:red; border:2px dashed red;"';
echo ' size="'.intval($attr8_size).'"';
?>><?php
		$attr8_tmp_list = $$attr8_list;
		if	( isset($$attr8_name) && isset($attr8_tmp_list[$$attr8_name]) )
			$attr8_tmp_default = $$attr8_name;
		elseif ( isset($attr8_default) )
			$attr8_tmp_default = $attr8_default;
		else
			$attr8_tmp_default = '';
		foreach( $attr8_tmp_list as $box_key=>$box_value )
		{
			if	( is_array($box_value) )
			{
				$box_key   = $box_value['key'  ];
				$box_title = $box_value['title'];
				$box_value = $box_value['value'];
			}
			elseif( $attr8_lang )
			{
				$box_title = lang( $box_value.'_DESC');
				$box_value = lang( $box_value        );
			}
			else
			{
				$box_title = '';
			}
			echo '<option class="'.$attr8_class.'" value="'.$box_key.'" title="'.$box_title.'"';
			if ($box_key==$attr8_tmp_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select><?php
if (count($$attr8_list)==0) echo '<input type="hidden" name="'.$attr8_name.'" value="" />';
if (count($$attr8_list)==1) echo '<input type="hidden" name="'.$attr8_name.'" value="'.$box_key.'" />'
?><?php unset($attr8) ?><?php unset($attr8_list) ?><?php unset($attr8_name) ?><?php unset($attr8_onchange) ?><?php unset($attr8_title) ?><?php unset($attr8_class) ?><?php unset($attr8_addempty) ?><?php unset($attr8_multiple) ?><?php unset($attr8_size) ?><?php unset($attr8_lang) ?><?php $attr6_debug_info = 'a:0:{}' ?><?php $attr6 = array() ?></td><?php unset($attr6) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></tr><?php unset($attr5) ?><?php $attr6_debug_info = 'a:0:{}' ?><?php $attr6 = array() ?><?php
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
?><td <?php foreach( $attr7 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_colspan) ?><?php $attr8_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"key";s:9:"date_time";s:6:"escape";s:4:"true";}' ?><?php $attr8 = array('class'=>'text','key'=>'date_time','escape'=>true) ?><?php $attr8_class='text' ?><?php $attr8_key='date_time' ?><?php $attr8_escape=true ?><?php
	if	( isset($attr8_prefix)&& isset($attr8_key))
		$attr8_key = $attr8_prefix.$attr8_key;
	if	( isset($attr8_suffix)&& isset($attr8_key))
		$attr8_key = $attr8_key.$attr8_suffix;
	if(empty($attr8_title))
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
	if	( $attr8_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr8_array))
	{
		$tmpArray = $$attr8_array;
		if (!empty($attr8_var))
			$tmp_text = $tmpArray[$attr8_var];
		else
			$tmp_text = $langF($tmpArray[$attr8_text]);
	}
	elseif (!empty($attr8_text))
		$tmp_text = $langF($attr8_text);
	elseif (!empty($attr8_textvar))
		$tmp_text = $langF($$attr8_textvar);
	elseif (!empty($attr8_key))
		$tmp_text = $langF($attr8_key);
	elseif (!empty($attr8_var))
		$tmp_text = isset($$attr8_var)?$$attr8_var:'?unset:'.$attr8_var.'?';	
	elseif (!empty($attr8_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr8_raw);
	elseif (!empty($attr8_value))
		$tmp_text = $attr8_value;
	else
	  $tmp_text = '&nbsp;';
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
?></<?php echo $tmp_tag ?>><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_key) ?><?php unset($attr8_escape) ?><?php $attr6_debug_info = 'a:0:{}' ?><?php $attr6 = array() ?></td><?php unset($attr6) ?><?php $attr7_debug_info = 'a:2:{s:5:"class";s:2:"fx";s:7:"colspan";s:1:"5";}' ?><?php $attr7 = array('class'=>'fx','colspan'=>'5') ?><?php $attr7_class='fx' ?><?php $attr7_colspan='5' ?><?php
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
?><td <?php foreach( $attr7 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_colspan) ?><?php $attr8_debug_info = 'a:9:{s:4:"list";s:9:"all_hours";s:4:"name";s:4:"hour";s:8:"onchange";s:0:"";s:5:"title";s:0:"";s:5:"class";s:0:"";s:8:"addempty";s:5:"false";s:8:"multiple";s:5:"false";s:4:"size";s:1:"1";s:4:"lang";s:5:"false";}' ?><?php $attr8 = array('list'=>'all_hours','name'=>'hour','onchange'=>'','title'=>'','class'=>'','addempty'=>false,'multiple'=>false,'size'=>'1','lang'=>false) ?><?php $attr8_list='all_hours' ?><?php $attr8_name='hour' ?><?php $attr8_onchange='' ?><?php $attr8_title='' ?><?php $attr8_class='' ?><?php $attr8_addempty=false ?><?php $attr8_multiple=false ?><?php $attr8_size='1' ?><?php $attr8_lang=false ?><?php
if ($this->isEditable() && $this->getRequestVar('mode')!='edit') $attr8_readonly=true;
if ( $attr8_addempty!==FALSE  )
{
	if ($attr8_addempty===TRUE)
		$$attr8_list = array(''=>lang('LIST_ENTRY_EMPTY'))+$$attr8_list;
	else
		$$attr8_list = array(''=>'- '.lang($attr8_addempty).' -')+$$attr8_list;
}
?><select<?php if ($attr8_readonly) echo ' disabled="disabled"' ?> id="id_<?php echo $attr8_name ?>"  name="<?php echo $attr8_name; if ($attr8_multiple) echo '[]'; ?>" onchange="<?php echo $attr8_onchange ?>" title="<?php echo $attr8_title ?>" class="<?php echo $attr8_class ?>"<?php
if (count($$attr8_list)<=1) echo ' disabled="disabled"';
if	($attr8_multiple) echo ' multiple="multiple"';
if (in_array($attr8_name,$errors)) echo ' style="background-color:red; border:2px dashed red;"';
echo ' size="'.intval($attr8_size).'"';
?>><?php
		$attr8_tmp_list = $$attr8_list;
		if	( isset($$attr8_name) && isset($attr8_tmp_list[$$attr8_name]) )
			$attr8_tmp_default = $$attr8_name;
		elseif ( isset($attr8_default) )
			$attr8_tmp_default = $attr8_default;
		else
			$attr8_tmp_default = '';
		foreach( $attr8_tmp_list as $box_key=>$box_value )
		{
			if	( is_array($box_value) )
			{
				$box_key   = $box_value['key'  ];
				$box_title = $box_value['title'];
				$box_value = $box_value['value'];
			}
			elseif( $attr8_lang )
			{
				$box_title = lang( $box_value.'_DESC');
				$box_value = lang( $box_value        );
			}
			else
			{
				$box_title = '';
			}
			echo '<option class="'.$attr8_class.'" value="'.$box_key.'" title="'.$box_title.'"';
			if ($box_key==$attr8_tmp_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select><?php
if (count($$attr8_list)==0) echo '<input type="hidden" name="'.$attr8_name.'" value="" />';
if (count($$attr8_list)==1) echo '<input type="hidden" name="'.$attr8_name.'" value="'.$box_key.'" />'
?><?php unset($attr8) ?><?php unset($attr8_list) ?><?php unset($attr8_name) ?><?php unset($attr8_onchange) ?><?php unset($attr8_title) ?><?php unset($attr8_class) ?><?php unset($attr8_addempty) ?><?php unset($attr8_multiple) ?><?php unset($attr8_size) ?><?php unset($attr8_lang) ?><?php $attr8_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"raw";s:3:"_-_";s:6:"escape";s:4:"true";}' ?><?php $attr8 = array('class'=>'text','raw'=>'_-_','escape'=>true) ?><?php $attr8_class='text' ?><?php $attr8_raw='_-_' ?><?php $attr8_escape=true ?><?php
	if	( isset($attr8_prefix)&& isset($attr8_key))
		$attr8_key = $attr8_prefix.$attr8_key;
	if	( isset($attr8_suffix)&& isset($attr8_key))
		$attr8_key = $attr8_key.$attr8_suffix;
	if(empty($attr8_title))
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
	if	( $attr8_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr8_array))
	{
		$tmpArray = $$attr8_array;
		if (!empty($attr8_var))
			$tmp_text = $tmpArray[$attr8_var];
		else
			$tmp_text = $langF($tmpArray[$attr8_text]);
	}
	elseif (!empty($attr8_text))
		$tmp_text = $langF($attr8_text);
	elseif (!empty($attr8_textvar))
		$tmp_text = $langF($$attr8_textvar);
	elseif (!empty($attr8_key))
		$tmp_text = $langF($attr8_key);
	elseif (!empty($attr8_var))
		$tmp_text = isset($$attr8_var)?$$attr8_var:'?unset:'.$attr8_var.'?';	
	elseif (!empty($attr8_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr8_raw);
	elseif (!empty($attr8_value))
		$tmp_text = $attr8_value;
	else
	  $tmp_text = '&nbsp;';
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
?></<?php echo $tmp_tag ?>><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_raw) ?><?php unset($attr8_escape) ?><?php $attr8_debug_info = 'a:9:{s:4:"list";s:11:"all_minutes";s:4:"name";s:6:"minute";s:8:"onchange";s:0:"";s:5:"title";s:0:"";s:5:"class";s:0:"";s:8:"addempty";s:5:"false";s:8:"multiple";s:5:"false";s:4:"size";s:1:"1";s:4:"lang";s:5:"false";}' ?><?php $attr8 = array('list'=>'all_minutes','name'=>'minute','onchange'=>'','title'=>'','class'=>'','addempty'=>false,'multiple'=>false,'size'=>'1','lang'=>false) ?><?php $attr8_list='all_minutes' ?><?php $attr8_name='minute' ?><?php $attr8_onchange='' ?><?php $attr8_title='' ?><?php $attr8_class='' ?><?php $attr8_addempty=false ?><?php $attr8_multiple=false ?><?php $attr8_size='1' ?><?php $attr8_lang=false ?><?php
if ($this->isEditable() && $this->getRequestVar('mode')!='edit') $attr8_readonly=true;
if ( $attr8_addempty!==FALSE  )
{
	if ($attr8_addempty===TRUE)
		$$attr8_list = array(''=>lang('LIST_ENTRY_EMPTY'))+$$attr8_list;
	else
		$$attr8_list = array(''=>'- '.lang($attr8_addempty).' -')+$$attr8_list;
}
?><select<?php if ($attr8_readonly) echo ' disabled="disabled"' ?> id="id_<?php echo $attr8_name ?>"  name="<?php echo $attr8_name; if ($attr8_multiple) echo '[]'; ?>" onchange="<?php echo $attr8_onchange ?>" title="<?php echo $attr8_title ?>" class="<?php echo $attr8_class ?>"<?php
if (count($$attr8_list)<=1) echo ' disabled="disabled"';
if	($attr8_multiple) echo ' multiple="multiple"';
if (in_array($attr8_name,$errors)) echo ' style="background-color:red; border:2px dashed red;"';
echo ' size="'.intval($attr8_size).'"';
?>><?php
		$attr8_tmp_list = $$attr8_list;
		if	( isset($$attr8_name) && isset($attr8_tmp_list[$$attr8_name]) )
			$attr8_tmp_default = $$attr8_name;
		elseif ( isset($attr8_default) )
			$attr8_tmp_default = $attr8_default;
		else
			$attr8_tmp_default = '';
		foreach( $attr8_tmp_list as $box_key=>$box_value )
		{
			if	( is_array($box_value) )
			{
				$box_key   = $box_value['key'  ];
				$box_title = $box_value['title'];
				$box_value = $box_value['value'];
			}
			elseif( $attr8_lang )
			{
				$box_title = lang( $box_value.'_DESC');
				$box_value = lang( $box_value        );
			}
			else
			{
				$box_title = '';
			}
			echo '<option class="'.$attr8_class.'" value="'.$box_key.'" title="'.$box_title.'"';
			if ($box_key==$attr8_tmp_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select><?php
if (count($$attr8_list)==0) echo '<input type="hidden" name="'.$attr8_name.'" value="" />';
if (count($$attr8_list)==1) echo '<input type="hidden" name="'.$attr8_name.'" value="'.$box_key.'" />'
?><?php unset($attr8) ?><?php unset($attr8_list) ?><?php unset($attr8_name) ?><?php unset($attr8_onchange) ?><?php unset($attr8_title) ?><?php unset($attr8_class) ?><?php unset($attr8_addempty) ?><?php unset($attr8_multiple) ?><?php unset($attr8_size) ?><?php unset($attr8_lang) ?><?php $attr8_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"raw";s:3:"_-_";s:6:"escape";s:4:"true";}' ?><?php $attr8 = array('class'=>'text','raw'=>'_-_','escape'=>true) ?><?php $attr8_class='text' ?><?php $attr8_raw='_-_' ?><?php $attr8_escape=true ?><?php
	if	( isset($attr8_prefix)&& isset($attr8_key))
		$attr8_key = $attr8_prefix.$attr8_key;
	if	( isset($attr8_suffix)&& isset($attr8_key))
		$attr8_key = $attr8_key.$attr8_suffix;
	if(empty($attr8_title))
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
	if	( $attr8_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr8_array))
	{
		$tmpArray = $$attr8_array;
		if (!empty($attr8_var))
			$tmp_text = $tmpArray[$attr8_var];
		else
			$tmp_text = $langF($tmpArray[$attr8_text]);
	}
	elseif (!empty($attr8_text))
		$tmp_text = $langF($attr8_text);
	elseif (!empty($attr8_textvar))
		$tmp_text = $langF($$attr8_textvar);
	elseif (!empty($attr8_key))
		$tmp_text = $langF($attr8_key);
	elseif (!empty($attr8_var))
		$tmp_text = isset($$attr8_var)?$$attr8_var:'?unset:'.$attr8_var.'?';	
	elseif (!empty($attr8_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr8_raw);
	elseif (!empty($attr8_value))
		$tmp_text = $attr8_value;
	else
	  $tmp_text = '&nbsp;';
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
?></<?php echo $tmp_tag ?>><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_raw) ?><?php unset($attr8_escape) ?><?php $attr8_debug_info = 'a:9:{s:4:"list";s:11:"all_seconds";s:4:"name";s:6:"second";s:8:"onchange";s:0:"";s:5:"title";s:0:"";s:5:"class";s:0:"";s:8:"addempty";s:5:"false";s:8:"multiple";s:5:"false";s:4:"size";s:1:"1";s:4:"lang";s:5:"false";}' ?><?php $attr8 = array('list'=>'all_seconds','name'=>'second','onchange'=>'','title'=>'','class'=>'','addempty'=>false,'multiple'=>false,'size'=>'1','lang'=>false) ?><?php $attr8_list='all_seconds' ?><?php $attr8_name='second' ?><?php $attr8_onchange='' ?><?php $attr8_title='' ?><?php $attr8_class='' ?><?php $attr8_addempty=false ?><?php $attr8_multiple=false ?><?php $attr8_size='1' ?><?php $attr8_lang=false ?><?php
if ($this->isEditable() && $this->getRequestVar('mode')!='edit') $attr8_readonly=true;
if ( $attr8_addempty!==FALSE  )
{
	if ($attr8_addempty===TRUE)
		$$attr8_list = array(''=>lang('LIST_ENTRY_EMPTY'))+$$attr8_list;
	else
		$$attr8_list = array(''=>'- '.lang($attr8_addempty).' -')+$$attr8_list;
}
?><select<?php if ($attr8_readonly) echo ' disabled="disabled"' ?> id="id_<?php echo $attr8_name ?>"  name="<?php echo $attr8_name; if ($attr8_multiple) echo '[]'; ?>" onchange="<?php echo $attr8_onchange ?>" title="<?php echo $attr8_title ?>" class="<?php echo $attr8_class ?>"<?php
if (count($$attr8_list)<=1) echo ' disabled="disabled"';
if	($attr8_multiple) echo ' multiple="multiple"';
if (in_array($attr8_name,$errors)) echo ' style="background-color:red; border:2px dashed red;"';
echo ' size="'.intval($attr8_size).'"';
?>><?php
		$attr8_tmp_list = $$attr8_list;
		if	( isset($$attr8_name) && isset($attr8_tmp_list[$$attr8_name]) )
			$attr8_tmp_default = $$attr8_name;
		elseif ( isset($attr8_default) )
			$attr8_tmp_default = $attr8_default;
		else
			$attr8_tmp_default = '';
		foreach( $attr8_tmp_list as $box_key=>$box_value )
		{
			if	( is_array($box_value) )
			{
				$box_key   = $box_value['key'  ];
				$box_title = $box_value['title'];
				$box_value = $box_value['value'];
			}
			elseif( $attr8_lang )
			{
				$box_title = lang( $box_value.'_DESC');
				$box_value = lang( $box_value        );
			}
			else
			{
				$box_title = '';
			}
			echo '<option class="'.$attr8_class.'" value="'.$box_key.'" title="'.$box_title.'"';
			if ($box_key==$attr8_tmp_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select><?php
if (count($$attr8_list)==0) echo '<input type="hidden" name="'.$attr8_name.'" value="" />';
if (count($$attr8_list)==1) echo '<input type="hidden" name="'.$attr8_name.'" value="'.$box_key.'" />'
?><?php unset($attr8) ?><?php unset($attr8_list) ?><?php unset($attr8_name) ?><?php unset($attr8_onchange) ?><?php unset($attr8_title) ?><?php unset($attr8_class) ?><?php unset($attr8_addempty) ?><?php unset($attr8_multiple) ?><?php unset($attr8_size) ?><?php unset($attr8_lang) ?><?php $attr6_debug_info = 'a:0:{}' ?><?php $attr6 = array() ?></td><?php unset($attr6) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></tr><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></table><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php } ?><?php unset($attr3) ?><?php $attr4_debug_info = 'a:2:{s:6:"equals";s:4:"text";s:5:"value";s:8:"var:type";}' ?><?php $attr4 = array('equals'=>'text','value'=>$type) ?><?php $attr4_equals='text' ?><?php $attr4_value=$type ?><?php 
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_colspan) ?><?php $attr7_debug_info = 'a:2:{s:6:"equals";s:4:"html";s:5:"value";s:10:"var:editor";}' ?><?php $attr7 = array('equals'=>'html','value'=>$editor) ?><?php $attr7_equals='html' ?><?php $attr7_value=$editor ?><?php 
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
<?php unset($attr7) ?><?php unset($attr7_equals) ?><?php unset($attr7_value) ?><?php $attr8_debug_info = 'a:2:{s:4:"name";s:4:"text";s:4:"type";s:4:"html";}' ?><?php $attr8 = array('name'=>'text','type'=>'html') ?><?php $attr8_name='text' ?><?php $attr8_type='html' ?><?php
	function checkbox( $name,$value=false,$writable=true,$params=Array() )
	{
		$src = '<input type="checkbox" name="'.$name.'"';
		foreach( $params as $name=>$val )
			$src .= " $name=\"$val\"";
		if	( !$writable )
			$src .= ' disabled="disabled"';
		if	( $value )
			$src .= ' value="1" checked="checked"';
		$src .= ' />';
		return $src;
	}
	function selectBox( $name,$values,$default='',$params=Array() )
	{
		if	( ! is_array($values) )
			$values = array($values);
		$src = '<select size="1" name="'.$name.'"';
		foreach( $params as $name=>$value )
			$src .= " $name=\"$value\"";
		$src .= '>';
		foreach( $values as $key=>$value )
		{
			$src .= '<option value="'.$key.'"';
			if ($key == $default)
				$src .= ' selected="selected"';
			$src .= '>'.$value.'</option>';
		}
		$src .= '</select>';
		return $src;
	}
 ?><?php
switch( $attr8_type )
{
	case 'fckeditor':
	case 'html':
		include('./editor/fckeditor.php');
		$editor = new FCKeditor( $attr8_name ) ;
		$editor->BasePath	= defined('OR_BASE_URL')?slashify(OR_BASE_URL).'editor/':'./editor/';
		$editor->Value = $$attr8_name;
		$editor->Height = '290';
		$editor->Config['CustomConfigurationsPath'] = '../openrat-fckconfig.js';
		$editor->Create();
		break;
	case 'wiki':
		$conf_tags = $conf['editor']['text-markup'];
		?>
<script name="Javascript" type="text/javascript" src="<?php echo $tpl_dir ?>../../js/editor.js"></script>
<script name="JavaScript" type="text/javascript">
function strong()
{
	insert('<?php echo $attr8_name ?>','<?php echo $conf_tags['strong-begin'] ?>','<?php echo $conf_tags['strong-end'] ?>');
}
function emphatic()
{
	insert('<?php echo $attr8_name ?>','<?php echo $conf_tags['emphatic-begin'] ?>','<?php echo $conf_tags['emphatic-end'] ?>');
}
function link()
{
	objectid = document.forms[0].objectid.value;
	if	(objectid=="" ||objectid=="0"||objectid==null)
		objectid = window.prompt("Id","");
	if	(objectid=="" ||objectid=="0"||objectid==null)
		return;
	insert('<?php echo $attr8_name ?>','"','"<?php echo $conf_tags['linkto'] ?>"'+objectid+'"');
}
function image()
{
	objectid = document.forms[0].objectid.value;
	if	(objectid=="" ||objectid=="0"||objectid==null)
		objectid = window.prompt("Id","");
	if	(objectid=="" ||objectid=="0"||objectid==null)
		return;
	insert('<?php echo $attr8_name ?>','','<?php echo $conf_tags['image-begin'] ?>"'+objectid+'"<?php echo $conf_tags['image-end'] ?>');
}
function list()
{
 	insert('<?php echo $attr8_name ?>',"","\n");
	while( true )
	{
		t = window.prompt('<?php echo lang('EDITOR_PROMPT_LIST_ENTRY') ?>','');
		if	( t != '' && t != null )
		 	insert('<?php echo $attr8_name ?>',"<?php echo $conf_tags['list-unnumbered'] ?> "+t+"\n","");
		else
			break;
	}
}
function numlist()
{
	insert('<?php echo $attr8_name ?>',"\n\n<?php echo $conf_tags['list-numbered'] ?> ","\n<?php echo $conf_tags['list-numbered'] ?> \n<?php echo $conf_tags['list-numbered'] ?> \n");
}
function table()
{
	column=1;
	while( true )
	{
		if	( column==1 )
			text='<?php echo lang('EDITOR_PROMPT_TABLE_CELL_FIRST_COLUMN') ?>';
		else
			text='<?php echo lang('EDITOR_PROMPT_TABLE_CELL') ?>';
		t = window.prompt(text,'');
		if	( t != '' && t != null )
		{
		 	insert('<?php echo $attr8_name ?>',"<?php echo $conf_tags['table-cell-sep'] ?>"+t,"");
		 	column++;
		}
		else
		{
			if (column==1)
			{
				break;
			}
			else
			{
			 	insert('text',"\n","");
			 	column=1;
			 }
		}
	}
}
-->
</script>
	<?php
		?>
    <?php
    ?>
<?php
		$doc = new DocumentElement();
		$text = $$attr8_name;
		if	( !is_array($text))
			$text = explode("\n",$text);
		$doc->parse($text);
		echo $doc->render('application/html-dom');
		echo '<hr />';
		echo $doc->render('application/html-editor');
		break;
	case 'text':
	case 'raw':
		echo '<textarea name="'.$attr8_name.'" class="editor" style="width:100%;height:300px;">'.$$attr8_name.'</textarea>';
		break;
	default:
		echo "Unknown editor type: ".$attr8_type;
}
?><?php unset($attr8) ?><?php unset($attr8_name) ?><?php unset($attr8_type) ?><?php $attr6_debug_info = 'a:0:{}' ?><?php $attr6 = array() ?><?php } ?><?php unset($attr6) ?><?php $attr7_debug_info = 'a:2:{s:6:"equals";s:4:"wiki";s:5:"value";s:10:"var:editor";}' ?><?php $attr7 = array('equals'=>'wiki','value'=>$editor) ?><?php $attr7_equals='wiki' ?><?php $attr7_value=$editor ?><?php 
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
<?php unset($attr7) ?><?php unset($attr7_equals) ?><?php unset($attr7_value) ?><?php $attr8_debug_info = 'a:1:{s:7:"present";s:12:"preview_text";}' ?><?php $attr8 = array('present'=>'preview_text') ?><?php $attr8_present='preview_text' ?><?php 
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
<?php unset($attr8) ?><?php unset($attr8_present) ?><?php $attr9_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"var";s:12:"preview_text";s:6:"escape";s:4:"true";}' ?><?php $attr9 = array('class'=>'text','var'=>'preview_text','escape'=>true) ?><?php $attr9_class='text' ?><?php $attr9_var='preview_text' ?><?php $attr9_escape=true ?><?php
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
?></<?php echo $tmp_tag ?>><?php unset($attr9) ?><?php unset($attr9_class) ?><?php unset($attr9_var) ?><?php unset($attr9_escape) ?><?php $attr9_debug_info = 'a:0:{}' ?><?php $attr9 = array() ?><br/><?php unset($attr9) ?><?php $attr7_debug_info = 'a:0:{}' ?><?php $attr7 = array() ?><?php } ?><?php unset($attr7) ?><?php $attr8_debug_info = 'a:2:{s:4:"name";s:4:"text";s:4:"type";s:4:"wiki";}' ?><?php $attr8 = array('name'=>'text','type'=>'wiki') ?><?php $attr8_name='text' ?><?php $attr8_type='wiki' ?><?php
	function checkbox( $name,$value=false,$writable=true,$params=Array() )
	{
		$src = '<input type="checkbox" name="'.$name.'"';
		foreach( $params as $name=>$val )
			$src .= " $name=\"$val\"";
		if	( !$writable )
			$src .= ' disabled="disabled"';
		if	( $value )
			$src .= ' value="1" checked="checked"';
		$src .= ' />';
		return $src;
	}
	function selectBox( $name,$values,$default='',$params=Array() )
	{
		if	( ! is_array($values) )
			$values = array($values);
		$src = '<select size="1" name="'.$name.'"';
		foreach( $params as $name=>$value )
			$src .= " $name=\"$value\"";
		$src .= '>';
		foreach( $values as $key=>$value )
		{
			$src .= '<option value="'.$key.'"';
			if ($key == $default)
				$src .= ' selected="selected"';
			$src .= '>'.$value.'</option>';
		}
		$src .= '</select>';
		return $src;
	}
 ?><?php
switch( $attr8_type )
{
	case 'fckeditor':
	case 'html':
		include('./editor/fckeditor.php');
		$editor = new FCKeditor( $attr8_name ) ;
		$editor->BasePath	= defined('OR_BASE_URL')?slashify(OR_BASE_URL).'editor/':'./editor/';
		$editor->Value = $$attr8_name;
		$editor->Height = '290';
		$editor->Config['CustomConfigurationsPath'] = '../openrat-fckconfig.js';
		$editor->Create();
		break;
	case 'wiki':
		$conf_tags = $conf['editor']['text-markup'];
		?>
<script name="Javascript" type="text/javascript" src="<?php echo $tpl_dir ?>../../js/editor.js"></script>
<script name="JavaScript" type="text/javascript">
function strong()
{
	insert('<?php echo $attr8_name ?>','<?php echo $conf_tags['strong-begin'] ?>','<?php echo $conf_tags['strong-end'] ?>');
}
function emphatic()
{
	insert('<?php echo $attr8_name ?>','<?php echo $conf_tags['emphatic-begin'] ?>','<?php echo $conf_tags['emphatic-end'] ?>');
}
function link()
{
	objectid = document.forms[0].objectid.value;
	if	(objectid=="" ||objectid=="0"||objectid==null)
		objectid = window.prompt("Id","");
	if	(objectid=="" ||objectid=="0"||objectid==null)
		return;
	insert('<?php echo $attr8_name ?>','"','"<?php echo $conf_tags['linkto'] ?>"'+objectid+'"');
}
function image()
{
	objectid = document.forms[0].objectid.value;
	if	(objectid=="" ||objectid=="0"||objectid==null)
		objectid = window.prompt("Id","");
	if	(objectid=="" ||objectid=="0"||objectid==null)
		return;
	insert('<?php echo $attr8_name ?>','','<?php echo $conf_tags['image-begin'] ?>"'+objectid+'"<?php echo $conf_tags['image-end'] ?>');
}
function list()
{
 	insert('<?php echo $attr8_name ?>',"","\n");
	while( true )
	{
		t = window.prompt('<?php echo lang('EDITOR_PROMPT_LIST_ENTRY') ?>','');
		if	( t != '' && t != null )
		 	insert('<?php echo $attr8_name ?>',"<?php echo $conf_tags['list-unnumbered'] ?> "+t+"\n","");
		else
			break;
	}
}
function numlist()
{
	insert('<?php echo $attr8_name ?>',"\n\n<?php echo $conf_tags['list-numbered'] ?> ","\n<?php echo $conf_tags['list-numbered'] ?> \n<?php echo $conf_tags['list-numbered'] ?> \n");
}
function table()
{
	column=1;
	while( true )
	{
		if	( column==1 )
			text='<?php echo lang('EDITOR_PROMPT_TABLE_CELL_FIRST_COLUMN') ?>';
		else
			text='<?php echo lang('EDITOR_PROMPT_TABLE_CELL') ?>';
		t = window.prompt(text,'');
		if	( t != '' && t != null )
		{
		 	insert('<?php echo $attr8_name ?>',"<?php echo $conf_tags['table-cell-sep'] ?>"+t,"");
		 	column++;
		}
		else
		{
			if (column==1)
			{
				break;
			}
			else
			{
			 	insert('text',"\n","");
			 	column=1;
			 }
		}
	}
}
-->
</script>
	<?php
		?>
    <?php
    ?>
<?php
		$doc = new DocumentElement();
		$text = $$attr8_name;
		if	( !is_array($text))
			$text = explode("\n",$text);
		$doc->parse($text);
		echo $doc->render('application/html-dom');
		echo '<hr />';
		echo $doc->render('application/html-editor');
		break;
	case 'text':
	case 'raw':
		echo '<textarea name="'.$attr8_name.'" class="editor" style="width:100%;height:300px;">'.$$attr8_name.'</textarea>';
		break;
	default:
		echo "Unknown editor type: ".$attr8_type;
}
?><?php unset($attr8) ?><?php unset($attr8_name) ?><?php unset($attr8_type) ?><?php $attr6_debug_info = 'a:0:{}' ?><?php $attr6 = array() ?><?php } ?><?php unset($attr6) ?><?php $attr7_debug_info = 'a:2:{s:6:"equals";s:4:"text";s:5:"value";s:10:"var:editor";}' ?><?php $attr7 = array('equals'=>'text','value'=>$editor) ?><?php $attr7_equals='text' ?><?php $attr7_value=$editor ?><?php 
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
<?php unset($attr7) ?><?php unset($attr7_equals) ?><?php unset($attr7_value) ?><?php $attr8_debug_info = 'a:5:{s:4:"name";s:4:"text";s:4:"rows";s:2:"25";s:4:"cols";s:2:"70";s:5:"class";s:8:"longtext";s:7:"default";s:0:"";}' ?><?php $attr8 = array('name'=>'text','rows'=>'25','cols'=>'70','class'=>'longtext','default'=>'') ?><?php $attr8_name='text' ?><?php $attr8_rows='25' ?><?php $attr8_cols='70' ?><?php $attr8_class='longtext' ?><?php $attr8_default='' ?><?php if ($this->isEditable() && $this->getRequestVar('mode')!='edit') $attr8_readonly=true;
      if ( !$attr8_readonly) {
?><textarea <?php if ($attr8_readonly) echo ' disabled="true"' ?> class="<?php echo $attr8_class ?>" name="<?php echo $attr8_name ?>" rows="<?php echo $attr8_rows ?>" cols="<?php echo $attr8_cols ?>"><?php echo htmlentities(isset($$attr8_name)?$$attr8_name:$attr8_default) ?></textarea><?php
 } else {
?><span class="<?php echo $attr8_class ?>"><?php echo isset($$attr8_name)?$$attr8_name:$attr8_default ?></span><?php } ?><?php unset($attr8) ?><?php unset($attr8_name) ?><?php unset($attr8_rows) ?><?php unset($attr8_cols) ?><?php unset($attr8_class) ?><?php unset($attr8_default) ?><?php $attr8_debug_info = 'a:1:{s:5:"field";s:4:"text";}' ?><?php $attr8 = array('field'=>'text') ?><?php $attr8_field='text' ?><?php
if (isset($errors[0])) $attr8_field = $errors[0];
?><script name="JavaScript" type="text/javascript"><!--
document.forms[0].<?php echo $attr8_field ?>.focus();
document.forms[0].<?php echo $attr8_field ?>.select();
</script>
<?php unset($attr8) ?><?php unset($attr8_field) ?><?php $attr6_debug_info = 'a:0:{}' ?><?php $attr6 = array() ?><?php } ?><?php unset($attr6) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php } ?><?php unset($attr3) ?><?php $attr4_debug_info = 'a:2:{s:6:"equals";s:4:"link";s:5:"value";s:8:"var:type";}' ?><?php $attr4 = array('equals'=>'link','value'=>$type) ?><?php $attr4_equals='link' ?><?php $attr4_value=$type ?><?php 
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
<?php unset($attr7) ?><?php unset($attr7_field) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php } ?><?php unset($attr3) ?><?php $attr4_debug_info = 'a:1:{s:7:"present";s:7:"release";}' ?><?php $attr4 = array('present'=>'release') ?><?php $attr4_present='release' ?><?php 
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
<?php unset($attr4) ?><?php unset($attr4_present) ?><?php $attr5_debug_info = 'a:1:{s:7:"present";s:7:"publish";}' ?><?php $attr5 = array('present'=>'publish') ?><?php $attr5_present='publish' ?><?php 
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
?><tr class="<?php echo $attr6_class ?>"><?php unset($attr6) ?><?php $attr7_debug_info = 'a:1:{s:7:"colspan";s:1:"2";}' ?><?php $attr7 = array('colspan'=>'2') ?><?php $attr7_colspan='2' ?><?php
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
?><td <?php foreach( $attr7 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr7) ?><?php unset($attr7_colspan) ?><?php $attr8_debug_info = 'a:1:{s:5:"title";s:15:"message:options";}' ?><?php $attr8 = array('title'=>lang('options')) ?><?php $attr8_title=lang('options') ?><fieldset><?php if(isset($attr8_title)) { ?><legend><?php echo encodeHtml($attr8_title) ?></legend><?php } ?><?php unset($attr8) ?><?php unset($attr8_title) ?><?php $attr7_debug_info = 'a:0:{}' ?><?php $attr7 = array() ?></fieldset><?php unset($attr7) ?><?php $attr6_debug_info = 'a:0:{}' ?><?php $attr6 = array() ?></td><?php unset($attr6) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></tr><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?><?php } ?><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php } ?><?php unset($attr3) ?><?php $attr4_debug_info = 'a:1:{s:7:"present";s:7:"release";}' ?><?php $attr4 = array('present'=>'release') ?><?php $attr4_present='release' ?><?php 
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
<?php unset($attr4) ?><?php unset($attr4_present) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?><?php
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_colspan) ?><?php $attr7_debug_info = 'a:3:{s:7:"default";s:5:"false";s:8:"readonly";s:5:"false";s:4:"name";s:7:"release";}' ?><?php $attr7 = array('default'=>false,'readonly'=>false,'name'=>'release') ?><?php $attr7_default=false ?><?php $attr7_readonly=false ?><?php $attr7_name='release' ?><?php
	if ($this->isEditable() && $this->getRequestVar('mode')!='edit') $attr7_readonly=true;
	if	( isset($$attr7_name) )
		$checked = $$attr7_name;
	else
		$checked = $attr7_default;
?><input type="checkbox" id="id_<?php echo $attr7_name ?>" name="<?php echo $attr7_name  ?>"  <?php if ($attr7_readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?><?php if (in_array($attr7_name,$errors)) echo ' style="background-color:red;"' ?> /><?php
if ( $attr7_readonly && $checked )
{ 
?><input type="hidden" name="<?php echo $attr7_name ?>" value="1" /><?php
}
?><?php unset($attr7_name); unset($attr7_readonly); unset($attr7_default); ?><?php unset($attr7) ?><?php unset($attr7_default) ?><?php unset($attr7_readonly) ?><?php unset($attr7_name) ?><?php $attr7_debug_info = 'a:1:{s:3:"for";s:7:"release";}' ?><?php $attr7 = array('for'=>'release') ?><?php $attr7_for='release' ?><label for="id_<?php echo $attr7_for ?><?php if (!empty($attr7_value)) echo '_'.$attr7_value ?>"><?php unset($attr7) ?><?php unset($attr7_for) ?><?php $attr8_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:14:"GLOBAL_RELEASE";s:6:"escape";s:4:"true";}' ?><?php $attr8 = array('class'=>'text','text'=>'GLOBAL_RELEASE','escape'=>true) ?><?php $attr8_class='text' ?><?php $attr8_text='GLOBAL_RELEASE' ?><?php $attr8_escape=true ?><?php
	if	( isset($attr8_prefix)&& isset($attr8_key))
		$attr8_key = $attr8_prefix.$attr8_key;
	if	( isset($attr8_suffix)&& isset($attr8_key))
		$attr8_key = $attr8_key.$attr8_suffix;
	if(empty($attr8_title))
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
	if	( $attr8_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr8_array))
	{
		$tmpArray = $$attr8_array;
		if (!empty($attr8_var))
			$tmp_text = $tmpArray[$attr8_var];
		else
			$tmp_text = $langF($tmpArray[$attr8_text]);
	}
	elseif (!empty($attr8_text))
		$tmp_text = $langF($attr8_text);
	elseif (!empty($attr8_textvar))
		$tmp_text = $langF($$attr8_textvar);
	elseif (!empty($attr8_key))
		$tmp_text = $langF($attr8_key);
	elseif (!empty($attr8_var))
		$tmp_text = isset($$attr8_var)?$$attr8_var:'?unset:'.$attr8_var.'?';	
	elseif (!empty($attr8_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr8_raw);
	elseif (!empty($attr8_value))
		$tmp_text = $attr8_value;
	else
	  $tmp_text = '&nbsp;';
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
?></<?php echo $tmp_tag ?>><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_text) ?><?php unset($attr8_escape) ?><?php $attr6_debug_info = 'a:0:{}' ?><?php $attr6 = array() ?></label><?php unset($attr6) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php } ?><?php unset($attr3) ?><?php $attr4_debug_info = 'a:1:{s:7:"present";s:7:"publish";}' ?><?php $attr4 = array('present'=>'publish') ?><?php $attr4_present='publish' ?><?php 
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
<?php unset($attr4) ?><?php unset($attr4_present) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?><?php
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_colspan) ?><?php $attr7_debug_info = 'a:3:{s:7:"default";s:5:"false";s:8:"readonly";s:5:"false";s:4:"name";s:7:"publish";}' ?><?php $attr7 = array('default'=>false,'readonly'=>false,'name'=>'publish') ?><?php $attr7_default=false ?><?php $attr7_readonly=false ?><?php $attr7_name='publish' ?><?php
	if ($this->isEditable() && $this->getRequestVar('mode')!='edit') $attr7_readonly=true;
	if	( isset($$attr7_name) )
		$checked = $$attr7_name;
	else
		$checked = $attr7_default;
?><input type="checkbox" id="id_<?php echo $attr7_name ?>" name="<?php echo $attr7_name  ?>"  <?php if ($attr7_readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?><?php if (in_array($attr7_name,$errors)) echo ' style="background-color:red;"' ?> /><?php
if ( $attr7_readonly && $checked )
{ 
?><input type="hidden" name="<?php echo $attr7_name ?>" value="1" /><?php
}
?><?php unset($attr7_name); unset($attr7_readonly); unset($attr7_default); ?><?php unset($attr7) ?><?php unset($attr7_default) ?><?php unset($attr7_readonly) ?><?php unset($attr7_name) ?><?php $attr7_debug_info = 'a:1:{s:3:"for";s:7:"publish";}' ?><?php $attr7 = array('for'=>'publish') ?><?php $attr7_for='publish' ?><label for="id_<?php echo $attr7_for ?><?php if (!empty($attr7_value)) echo '_'.$attr7_value ?>"><?php unset($attr7) ?><?php unset($attr7_for) ?><?php $attr8_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:23:"PAGE_PUBLISH_AFTER_SAVE";s:6:"escape";s:4:"true";}' ?><?php $attr8 = array('class'=>'text','text'=>'PAGE_PUBLISH_AFTER_SAVE','escape'=>true) ?><?php $attr8_class='text' ?><?php $attr8_text='PAGE_PUBLISH_AFTER_SAVE' ?><?php $attr8_escape=true ?><?php
	if	( isset($attr8_prefix)&& isset($attr8_key))
		$attr8_key = $attr8_prefix.$attr8_key;
	if	( isset($attr8_suffix)&& isset($attr8_key))
		$attr8_key = $attr8_key.$attr8_suffix;
	if(empty($attr8_title))
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
	if	( $attr8_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr8_array))
	{
		$tmpArray = $$attr8_array;
		if (!empty($attr8_var))
			$tmp_text = $tmpArray[$attr8_var];
		else
			$tmp_text = $langF($tmpArray[$attr8_text]);
	}
	elseif (!empty($attr8_text))
		$tmp_text = $langF($attr8_text);
	elseif (!empty($attr8_textvar))
		$tmp_text = $langF($$attr8_textvar);
	elseif (!empty($attr8_key))
		$tmp_text = $langF($attr8_key);
	elseif (!empty($attr8_var))
		$tmp_text = isset($$attr8_var)?$$attr8_var:'?unset:'.$attr8_var.'?';	
	elseif (!empty($attr8_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr8_raw);
	elseif (!empty($attr8_value))
		$tmp_text = $attr8_value;
	else
	  $tmp_text = '&nbsp;';
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
?></<?php echo $tmp_tag ?>><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_text) ?><?php unset($attr8_escape) ?><?php $attr6_debug_info = 'a:0:{}' ?><?php $attr6 = array() ?></label><?php unset($attr6) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php } ?><?php unset($attr3) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?><?php
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
<?php unset($attr1) ?><?php $attr2_debug_info = 'a:1:{s:5:"field";s:4:"text";}' ?><?php $attr2 = array('field'=>'text') ?><?php $attr2_field='text' ?><?php
if (isset($errors[0])) $attr2_field = $errors[0];
?><script name="JavaScript" type="text/javascript"><!--
document.forms[0].<?php echo $attr2_field ?>.focus();
document.forms[0].<?php echo $attr2_field ?>.select();
</script>
<?php unset($attr2) ?><?php unset($attr2_field) ?><?php $attr0_debug_info = 'a:0:{}' ?><?php $attr0 = array() ?></body>
</html><?php unset($attr0) ?>