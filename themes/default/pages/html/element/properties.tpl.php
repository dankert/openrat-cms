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
?><?php unset($attr2) ?><?php unset($attr2_name) ?><?php unset($attr2_target) ?><?php unset($attr2_method) ?><?php unset($attr2_enctype) ?><?php $attr3_debug_info = 'a:5:{s:4:"name";s:12:"GLOBAL_PREFS";s:6:"widths";s:7:"30%,70%";s:5:"width";s:3:"93%";s:10:"rowclasses";s:8:"odd,even";s:13:"columnclasses";s:5:"1,2,3";}' ?><?php $attr3 = array('name'=>'GLOBAL_PREFS','widths'=>'30%,70%','width'=>'93%','rowclasses'=>'odd,even','columnclasses'=>'1,2,3') ?><?php $attr3_name='GLOBAL_PREFS' ?><?php $attr3_widths='30%,70%' ?><?php $attr3_width='93%' ?><?php $attr3_rowclasses='odd,even' ?><?php $attr3_columnclasses='1,2,3' ?><?php
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
<?php unset($attr3) ?><?php unset($attr3_name) ?><?php unset($attr3_widths) ?><?php unset($attr3_width) ?><?php unset($attr3_rowclasses) ?><?php unset($attr3_columnclasses) ?><?php $attr4_debug_info = 'a:1:{s:7:"present";s:7:"subtype";}' ?><?php $attr4 = array('present'=>'subtype') ?><?php $attr4_present='subtype' ?><?php 
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr7_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:15:"ELEMENT_SUBTYPE";s:6:"escape";s:4:"true";}' ?><?php $attr7 = array('class'=>'text','text'=>'ELEMENT_SUBTYPE','escape'=>true) ?><?php $attr7_class='text' ?><?php $attr7_text='ELEMENT_SUBTYPE' ?><?php $attr7_escape=true ?><?php
	if	( isset($attr7_prefix)&& isset($attr7_key))
		$attr7_key = $attr7_prefix.$attr7_key;
	if	( isset($attr7_suffix)&& isset($attr7_key))
		$attr7_key = $attr7_key.$attr7_suffix;
	if(empty($attr7_title))
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
	if	( $attr7_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr7_array))
	{
		$tmpArray = $$attr7_array;
		if (!empty($attr7_var))
			$tmp_text = $tmpArray[$attr7_var];
		else
			$tmp_text = $langF($tmpArray[$attr7_text]);
	}
	elseif (!empty($attr7_text))
		$tmp_text = $langF($attr7_text);
	elseif (!empty($attr7_textvar))
		$tmp_text = $langF($$attr7_textvar);
	elseif (!empty($attr7_key))
		$tmp_text = $langF($attr7_key);
	elseif (!empty($attr7_var))
		$tmp_text = isset($$attr7_var)?$$attr7_var:'?unset:'.$attr7_var.'?';	
	elseif (!empty($attr7_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr7_raw);
	elseif (!empty($attr7_value))
		$tmp_text = $attr7_value;
	else
	  $tmp_text = '&nbsp;';
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
?></<?php echo $tmp_tag ?>><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_text) ?><?php unset($attr7_escape) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr6_debug_info = 'a:1:{s:5:"class";s:2:"fx";}' ?><?php $attr6 = array('class'=>'fx') ?><?php $attr6_class='fx' ?><?php
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr7_debug_info = 'a:1:{s:7:"present";s:8:"subtypes";}' ?><?php $attr7 = array('present'=>'subtypes') ?><?php $attr7_present='subtypes' ?><?php 
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
<?php unset($attr7) ?><?php unset($attr7_present) ?><?php $attr8_debug_info = 'a:9:{s:4:"list";s:8:"subtypes";s:4:"name";s:7:"subtype";s:8:"onchange";s:0:"";s:5:"title";s:0:"";s:5:"class";s:0:"";s:8:"addempty";s:5:"false";s:8:"multiple";s:5:"false";s:4:"size";s:1:"1";s:4:"lang";s:5:"false";}' ?><?php $attr8 = array('list'=>'subtypes','name'=>'subtype','onchange'=>'','title'=>'','class'=>'','addempty'=>false,'multiple'=>false,'size'=>'1','lang'=>false) ?><?php $attr8_list='subtypes' ?><?php $attr8_name='subtype' ?><?php $attr8_onchange='' ?><?php $attr8_title='' ?><?php $attr8_class='' ?><?php $attr8_addempty=false ?><?php $attr8_multiple=false ?><?php $attr8_size='1' ?><?php $attr8_lang=false ?><?php
$attr8_tmp_list = $$attr8_list;
if ($this->isEditable() && $this->getRequestVar('mode')!='edit')
{
	echo empty($$attr8_name)?'- '.lang('EMPTY').' -':$attr8_tmp_list[$$attr8_name];
}
else
{
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
if (count($$attr8_list)==1) echo '<input type="hidden" name="'.$attr8_name.'" value="'.$box_key.'" />';
}
?><?php unset($attr8) ?><?php unset($attr8_list) ?><?php unset($attr8_name) ?><?php unset($attr8_onchange) ?><?php unset($attr8_title) ?><?php unset($attr8_class) ?><?php unset($attr8_addempty) ?><?php unset($attr8_multiple) ?><?php unset($attr8_size) ?><?php unset($attr8_lang) ?><?php $attr6_debug_info = 'a:0:{}' ?><?php $attr6 = array() ?><?php } ?><?php unset($attr6) ?><?php $attr7_debug_info = 'a:2:{s:3:"not";s:4:"true";s:7:"present";s:8:"subtypes";}' ?><?php $attr7 = array('not'=>true,'present'=>'subtypes') ?><?php $attr7_not=true ?><?php $attr7_present='subtypes' ?><?php 
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
<?php unset($attr7) ?><?php unset($attr7_not) ?><?php unset($attr7_present) ?><?php $attr8_debug_info = 'a:8:{s:5:"class";s:0:"";s:7:"default";s:0:"";s:4:"type";s:4:"text";s:4:"name";s:7:"subtype";s:4:"size";s:2:"40";s:9:"maxlength";s:3:"256";s:8:"onchange";s:0:"";s:8:"readonly";s:5:"false";}' ?><?php $attr8 = array('class'=>'','default'=>'','type'=>'text','name'=>'subtype','size'=>'40','maxlength'=>'256','onchange'=>'','readonly'=>false) ?><?php $attr8_class='' ?><?php $attr8_default='' ?><?php $attr8_type='text' ?><?php $attr8_name='subtype' ?><?php $attr8_size='40' ?><?php $attr8_maxlength='256' ?><?php $attr8_onchange='' ?><?php $attr8_readonly=false ?><?php if ($this->isEditable() && $this->getRequestVar('mode')!='edit') $attr8_readonly=true;
	  if ($attr8_readonly && empty($$attr8_name)) $$attr8_name = '- '.lang('EMPTY').' -';
      if(!isset($attr8_default)) $attr8_default='';
?><?php if (!$attr8_readonly || $attr8_type=='hidden') {
?><input<?php if ($attr8_readonly) echo ' disabled="true"' ?> id="id_<?php echo $attr8_name ?><?php if ($attr8_readonly) echo '_disabled' ?>" name="<?php echo $attr8_name ?><?php if ($attr8_readonly) echo '_disabled' ?>" type="<?php echo $attr8_type ?>" size="<?php echo $attr8_size ?>" maxlength="<?php echo $attr8_maxlength ?>" class="<?php echo $attr8_class ?>" value="<?php echo isset($$attr8_name)?$$attr8_name:$attr8_default ?>" <?php if (in_array($attr8_name,$errors)) echo 'style="border-rightx:10px solid red; background-colorx:yellow; border:2px dashed red;"' ?> /><?php
if	($attr8_readonly) {
?><input type="hidden" id="id_<?php echo $attr8_name ?>" name="<?php echo $attr8_name ?>" value="<?php echo isset($$attr8_name)?$$attr8_name:$attr8_default ?>" /><?php
 } } else { ?><span class="<?php echo $attr8_class ?>"><?php echo isset($$attr8_name)?$$attr8_name:$attr8_default ?></span><?php } ?><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_default) ?><?php unset($attr8_type) ?><?php unset($attr8_name) ?><?php unset($attr8_size) ?><?php unset($attr8_maxlength) ?><?php unset($attr8_onchange) ?><?php unset($attr8_readonly) ?><?php $attr6_debug_info = 'a:0:{}' ?><?php $attr6 = array() ?><?php } ?><?php unset($attr6) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php } ?><?php unset($attr3) ?><?php $attr4_debug_info = 'a:1:{s:7:"present";s:9:"with_icon";}' ?><?php $attr4 = array('present'=>'with_icon') ?><?php $attr4_present='with_icon' ?><?php 
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr7_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:17:"EL_PROP_WITH_ICON";s:6:"escape";s:4:"true";}' ?><?php $attr7 = array('class'=>'text','text'=>'EL_PROP_WITH_ICON','escape'=>true) ?><?php $attr7_class='text' ?><?php $attr7_text='EL_PROP_WITH_ICON' ?><?php $attr7_escape=true ?><?php
	if	( isset($attr7_prefix)&& isset($attr7_key))
		$attr7_key = $attr7_prefix.$attr7_key;
	if	( isset($attr7_suffix)&& isset($attr7_key))
		$attr7_key = $attr7_key.$attr7_suffix;
	if(empty($attr7_title))
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
	if	( $attr7_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr7_array))
	{
		$tmpArray = $$attr7_array;
		if (!empty($attr7_var))
			$tmp_text = $tmpArray[$attr7_var];
		else
			$tmp_text = $langF($tmpArray[$attr7_text]);
	}
	elseif (!empty($attr7_text))
		$tmp_text = $langF($attr7_text);
	elseif (!empty($attr7_textvar))
		$tmp_text = $langF($$attr7_textvar);
	elseif (!empty($attr7_key))
		$tmp_text = $langF($attr7_key);
	elseif (!empty($attr7_var))
		$tmp_text = isset($$attr7_var)?$$attr7_var:'?unset:'.$attr7_var.'?';	
	elseif (!empty($attr7_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr7_raw);
	elseif (!empty($attr7_value))
		$tmp_text = $attr7_value;
	else
	  $tmp_text = '&nbsp;';
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
?></<?php echo $tmp_tag ?>><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_text) ?><?php unset($attr7_escape) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr6_debug_info = 'a:1:{s:5:"class";s:2:"fx";}' ?><?php $attr6 = array('class'=>'fx') ?><?php $attr6_class='fx' ?><?php
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr7_debug_info = 'a:3:{s:7:"default";s:5:"false";s:8:"readonly";s:5:"false";s:4:"name";s:9:"with_icon";}' ?><?php $attr7 = array('default'=>false,'readonly'=>false,'name'=>'with_icon') ?><?php $attr7_default=false ?><?php $attr7_readonly=false ?><?php $attr7_name='with_icon' ?><?php
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
?><?php unset($attr7_name); unset($attr7_readonly); unset($attr7_default); ?><?php unset($attr7) ?><?php unset($attr7_default) ?><?php unset($attr7_readonly) ?><?php unset($attr7_name) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php } ?><?php unset($attr3) ?><?php $attr4_debug_info = 'a:1:{s:7:"present";s:13:"all_languages";}' ?><?php $attr4 = array('present'=>'all_languages') ?><?php $attr4_present='all_languages' ?><?php 
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr7_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:21:"EL_PROP_ALL_LANGUAGES";s:6:"escape";s:4:"true";}' ?><?php $attr7 = array('class'=>'text','text'=>'EL_PROP_ALL_LANGUAGES','escape'=>true) ?><?php $attr7_class='text' ?><?php $attr7_text='EL_PROP_ALL_LANGUAGES' ?><?php $attr7_escape=true ?><?php
	if	( isset($attr7_prefix)&& isset($attr7_key))
		$attr7_key = $attr7_prefix.$attr7_key;
	if	( isset($attr7_suffix)&& isset($attr7_key))
		$attr7_key = $attr7_key.$attr7_suffix;
	if(empty($attr7_title))
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
	if	( $attr7_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr7_array))
	{
		$tmpArray = $$attr7_array;
		if (!empty($attr7_var))
			$tmp_text = $tmpArray[$attr7_var];
		else
			$tmp_text = $langF($tmpArray[$attr7_text]);
	}
	elseif (!empty($attr7_text))
		$tmp_text = $langF($attr7_text);
	elseif (!empty($attr7_textvar))
		$tmp_text = $langF($$attr7_textvar);
	elseif (!empty($attr7_key))
		$tmp_text = $langF($attr7_key);
	elseif (!empty($attr7_var))
		$tmp_text = isset($$attr7_var)?$$attr7_var:'?unset:'.$attr7_var.'?';	
	elseif (!empty($attr7_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr7_raw);
	elseif (!empty($attr7_value))
		$tmp_text = $attr7_value;
	else
	  $tmp_text = '&nbsp;';
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
?></<?php echo $tmp_tag ?>><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_text) ?><?php unset($attr7_escape) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr6_debug_info = 'a:1:{s:5:"class";s:2:"fx";}' ?><?php $attr6 = array('class'=>'fx') ?><?php $attr6_class='fx' ?><?php
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr7_debug_info = 'a:3:{s:7:"default";s:5:"false";s:8:"readonly";s:5:"false";s:4:"name";s:13:"all_languages";}' ?><?php $attr7 = array('default'=>false,'readonly'=>false,'name'=>'all_languages') ?><?php $attr7_default=false ?><?php $attr7_readonly=false ?><?php $attr7_name='all_languages' ?><?php
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
?><?php unset($attr7_name); unset($attr7_readonly); unset($attr7_default); ?><?php unset($attr7) ?><?php unset($attr7_default) ?><?php unset($attr7_readonly) ?><?php unset($attr7_name) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php } ?><?php unset($attr3) ?><?php $attr4_debug_info = 'a:1:{s:7:"present";s:8:"writable";}' ?><?php $attr4 = array('present'=>'writable') ?><?php $attr4_present='writable' ?><?php 
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr7_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:16:"EL_PROP_writable";s:6:"escape";s:4:"true";}' ?><?php $attr7 = array('class'=>'text','text'=>'EL_PROP_writable','escape'=>true) ?><?php $attr7_class='text' ?><?php $attr7_text='EL_PROP_writable' ?><?php $attr7_escape=true ?><?php
	if	( isset($attr7_prefix)&& isset($attr7_key))
		$attr7_key = $attr7_prefix.$attr7_key;
	if	( isset($attr7_suffix)&& isset($attr7_key))
		$attr7_key = $attr7_key.$attr7_suffix;
	if(empty($attr7_title))
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
	if	( $attr7_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr7_array))
	{
		$tmpArray = $$attr7_array;
		if (!empty($attr7_var))
			$tmp_text = $tmpArray[$attr7_var];
		else
			$tmp_text = $langF($tmpArray[$attr7_text]);
	}
	elseif (!empty($attr7_text))
		$tmp_text = $langF($attr7_text);
	elseif (!empty($attr7_textvar))
		$tmp_text = $langF($$attr7_textvar);
	elseif (!empty($attr7_key))
		$tmp_text = $langF($attr7_key);
	elseif (!empty($attr7_var))
		$tmp_text = isset($$attr7_var)?$$attr7_var:'?unset:'.$attr7_var.'?';	
	elseif (!empty($attr7_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr7_raw);
	elseif (!empty($attr7_value))
		$tmp_text = $attr7_value;
	else
	  $tmp_text = '&nbsp;';
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
?></<?php echo $tmp_tag ?>><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_text) ?><?php unset($attr7_escape) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr6_debug_info = 'a:1:{s:5:"class";s:2:"fx";}' ?><?php $attr6 = array('class'=>'fx') ?><?php $attr6_class='fx' ?><?php
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr7_debug_info = 'a:3:{s:7:"default";s:5:"false";s:8:"readonly";s:5:"false";s:4:"name";s:8:"writable";}' ?><?php $attr7 = array('default'=>false,'readonly'=>false,'name'=>'writable') ?><?php $attr7_default=false ?><?php $attr7_readonly=false ?><?php $attr7_name='writable' ?><?php
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
?><?php unset($attr7_name); unset($attr7_readonly); unset($attr7_default); ?><?php unset($attr7) ?><?php unset($attr7_default) ?><?php unset($attr7_readonly) ?><?php unset($attr7_name) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php } ?><?php unset($attr3) ?><?php $attr4_debug_info = 'a:1:{s:7:"present";s:5:"width";}' ?><?php $attr4 = array('present'=>'width') ?><?php $attr4_present='width' ?><?php 
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr7_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:5:"width";s:6:"escape";s:4:"true";}' ?><?php $attr7 = array('class'=>'text','text'=>'width','escape'=>true) ?><?php $attr7_class='text' ?><?php $attr7_text='width' ?><?php $attr7_escape=true ?><?php
	if	( isset($attr7_prefix)&& isset($attr7_key))
		$attr7_key = $attr7_prefix.$attr7_key;
	if	( isset($attr7_suffix)&& isset($attr7_key))
		$attr7_key = $attr7_key.$attr7_suffix;
	if(empty($attr7_title))
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
	if	( $attr7_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr7_array))
	{
		$tmpArray = $$attr7_array;
		if (!empty($attr7_var))
			$tmp_text = $tmpArray[$attr7_var];
		else
			$tmp_text = $langF($tmpArray[$attr7_text]);
	}
	elseif (!empty($attr7_text))
		$tmp_text = $langF($attr7_text);
	elseif (!empty($attr7_textvar))
		$tmp_text = $langF($$attr7_textvar);
	elseif (!empty($attr7_key))
		$tmp_text = $langF($attr7_key);
	elseif (!empty($attr7_var))
		$tmp_text = isset($$attr7_var)?$$attr7_var:'?unset:'.$attr7_var.'?';	
	elseif (!empty($attr7_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr7_raw);
	elseif (!empty($attr7_value))
		$tmp_text = $attr7_value;
	else
	  $tmp_text = '&nbsp;';
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
?></<?php echo $tmp_tag ?>><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_text) ?><?php unset($attr7_escape) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr6_debug_info = 'a:1:{s:5:"class";s:2:"fx";}' ?><?php $attr6 = array('class'=>'fx') ?><?php $attr6_class='fx' ?><?php
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr7_debug_info = 'a:8:{s:5:"class";s:0:"";s:7:"default";s:0:"";s:4:"type";s:4:"text";s:4:"name";s:5:"width";s:4:"size";s:2:"10";s:9:"maxlength";s:3:"256";s:8:"onchange";s:0:"";s:8:"readonly";s:5:"false";}' ?><?php $attr7 = array('class'=>'','default'=>'','type'=>'text','name'=>'width','size'=>'10','maxlength'=>'256','onchange'=>'','readonly'=>false) ?><?php $attr7_class='' ?><?php $attr7_default='' ?><?php $attr7_type='text' ?><?php $attr7_name='width' ?><?php $attr7_size='10' ?><?php $attr7_maxlength='256' ?><?php $attr7_onchange='' ?><?php $attr7_readonly=false ?><?php if ($this->isEditable() && $this->getRequestVar('mode')!='edit') $attr7_readonly=true;
	  if ($attr7_readonly && empty($$attr7_name)) $$attr7_name = '- '.lang('EMPTY').' -';
      if(!isset($attr7_default)) $attr7_default='';
?><?php if (!$attr7_readonly || $attr7_type=='hidden') {
?><input<?php if ($attr7_readonly) echo ' disabled="true"' ?> id="id_<?php echo $attr7_name ?><?php if ($attr7_readonly) echo '_disabled' ?>" name="<?php echo $attr7_name ?><?php if ($attr7_readonly) echo '_disabled' ?>" type="<?php echo $attr7_type ?>" size="<?php echo $attr7_size ?>" maxlength="<?php echo $attr7_maxlength ?>" class="<?php echo $attr7_class ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" <?php if (in_array($attr7_name,$errors)) echo 'style="border-rightx:10px solid red; background-colorx:yellow; border:2px dashed red;"' ?> /><?php
if	($attr7_readonly) {
?><input type="hidden" id="id_<?php echo $attr7_name ?>" name="<?php echo $attr7_name ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" /><?php
 } } else { ?><span class="<?php echo $attr7_class ?>"><?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?></span><?php } ?><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_default) ?><?php unset($attr7_type) ?><?php unset($attr7_name) ?><?php unset($attr7_size) ?><?php unset($attr7_maxlength) ?><?php unset($attr7_onchange) ?><?php unset($attr7_readonly) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php } ?><?php unset($attr3) ?><?php $attr4_debug_info = 'a:1:{s:7:"present";s:6:"height";}' ?><?php $attr4 = array('present'=>'height') ?><?php $attr4_present='height' ?><?php 
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr7_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:6:"height";s:6:"escape";s:4:"true";}' ?><?php $attr7 = array('class'=>'text','text'=>'height','escape'=>true) ?><?php $attr7_class='text' ?><?php $attr7_text='height' ?><?php $attr7_escape=true ?><?php
	if	( isset($attr7_prefix)&& isset($attr7_key))
		$attr7_key = $attr7_prefix.$attr7_key;
	if	( isset($attr7_suffix)&& isset($attr7_key))
		$attr7_key = $attr7_key.$attr7_suffix;
	if(empty($attr7_title))
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
	if	( $attr7_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr7_array))
	{
		$tmpArray = $$attr7_array;
		if (!empty($attr7_var))
			$tmp_text = $tmpArray[$attr7_var];
		else
			$tmp_text = $langF($tmpArray[$attr7_text]);
	}
	elseif (!empty($attr7_text))
		$tmp_text = $langF($attr7_text);
	elseif (!empty($attr7_textvar))
		$tmp_text = $langF($$attr7_textvar);
	elseif (!empty($attr7_key))
		$tmp_text = $langF($attr7_key);
	elseif (!empty($attr7_var))
		$tmp_text = isset($$attr7_var)?$$attr7_var:'?unset:'.$attr7_var.'?';	
	elseif (!empty($attr7_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr7_raw);
	elseif (!empty($attr7_value))
		$tmp_text = $attr7_value;
	else
	  $tmp_text = '&nbsp;';
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
?></<?php echo $tmp_tag ?>><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_text) ?><?php unset($attr7_escape) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr6_debug_info = 'a:1:{s:5:"class";s:2:"fx";}' ?><?php $attr6 = array('class'=>'fx') ?><?php $attr6_class='fx' ?><?php
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr7_debug_info = 'a:8:{s:5:"class";s:0:"";s:7:"default";s:0:"";s:4:"type";s:4:"text";s:4:"name";s:6:"height";s:4:"size";s:2:"10";s:9:"maxlength";s:3:"256";s:8:"onchange";s:0:"";s:8:"readonly";s:5:"false";}' ?><?php $attr7 = array('class'=>'','default'=>'','type'=>'text','name'=>'height','size'=>'10','maxlength'=>'256','onchange'=>'','readonly'=>false) ?><?php $attr7_class='' ?><?php $attr7_default='' ?><?php $attr7_type='text' ?><?php $attr7_name='height' ?><?php $attr7_size='10' ?><?php $attr7_maxlength='256' ?><?php $attr7_onchange='' ?><?php $attr7_readonly=false ?><?php if ($this->isEditable() && $this->getRequestVar('mode')!='edit') $attr7_readonly=true;
	  if ($attr7_readonly && empty($$attr7_name)) $$attr7_name = '- '.lang('EMPTY').' -';
      if(!isset($attr7_default)) $attr7_default='';
?><?php if (!$attr7_readonly || $attr7_type=='hidden') {
?><input<?php if ($attr7_readonly) echo ' disabled="true"' ?> id="id_<?php echo $attr7_name ?><?php if ($attr7_readonly) echo '_disabled' ?>" name="<?php echo $attr7_name ?><?php if ($attr7_readonly) echo '_disabled' ?>" type="<?php echo $attr7_type ?>" size="<?php echo $attr7_size ?>" maxlength="<?php echo $attr7_maxlength ?>" class="<?php echo $attr7_class ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" <?php if (in_array($attr7_name,$errors)) echo 'style="border-rightx:10px solid red; background-colorx:yellow; border:2px dashed red;"' ?> /><?php
if	($attr7_readonly) {
?><input type="hidden" id="id_<?php echo $attr7_name ?>" name="<?php echo $attr7_name ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" /><?php
 } } else { ?><span class="<?php echo $attr7_class ?>"><?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?></span><?php } ?><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_default) ?><?php unset($attr7_type) ?><?php unset($attr7_name) ?><?php unset($attr7_size) ?><?php unset($attr7_maxlength) ?><?php unset($attr7_onchange) ?><?php unset($attr7_readonly) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php } ?><?php unset($attr3) ?><?php $attr4_debug_info = 'a:1:{s:7:"present";s:10:"dateformat";}' ?><?php $attr4 = array('present'=>'dateformat') ?><?php $attr4_present='dateformat' ?><?php 
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr7_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:18:"EL_PROP_DATEFORMAT";s:6:"escape";s:4:"true";}' ?><?php $attr7 = array('class'=>'text','text'=>'EL_PROP_DATEFORMAT','escape'=>true) ?><?php $attr7_class='text' ?><?php $attr7_text='EL_PROP_DATEFORMAT' ?><?php $attr7_escape=true ?><?php
	if	( isset($attr7_prefix)&& isset($attr7_key))
		$attr7_key = $attr7_prefix.$attr7_key;
	if	( isset($attr7_suffix)&& isset($attr7_key))
		$attr7_key = $attr7_key.$attr7_suffix;
	if(empty($attr7_title))
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
	if	( $attr7_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr7_array))
	{
		$tmpArray = $$attr7_array;
		if (!empty($attr7_var))
			$tmp_text = $tmpArray[$attr7_var];
		else
			$tmp_text = $langF($tmpArray[$attr7_text]);
	}
	elseif (!empty($attr7_text))
		$tmp_text = $langF($attr7_text);
	elseif (!empty($attr7_textvar))
		$tmp_text = $langF($$attr7_textvar);
	elseif (!empty($attr7_key))
		$tmp_text = $langF($attr7_key);
	elseif (!empty($attr7_var))
		$tmp_text = isset($$attr7_var)?$$attr7_var:'?unset:'.$attr7_var.'?';	
	elseif (!empty($attr7_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr7_raw);
	elseif (!empty($attr7_value))
		$tmp_text = $attr7_value;
	else
	  $tmp_text = '&nbsp;';
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
?></<?php echo $tmp_tag ?>><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_text) ?><?php unset($attr7_escape) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr6_debug_info = 'a:1:{s:5:"class";s:2:"fx";}' ?><?php $attr6 = array('class'=>'fx') ?><?php $attr6_class='fx' ?><?php
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr7_debug_info = 'a:9:{s:4:"list";s:11:"dateformats";s:4:"name";s:10:"dateformat";s:8:"onchange";s:0:"";s:5:"title";s:0:"";s:5:"class";s:0:"";s:8:"addempty";s:5:"false";s:8:"multiple";s:5:"false";s:4:"size";s:1:"1";s:4:"lang";s:5:"false";}' ?><?php $attr7 = array('list'=>'dateformats','name'=>'dateformat','onchange'=>'','title'=>'','class'=>'','addempty'=>false,'multiple'=>false,'size'=>'1','lang'=>false) ?><?php $attr7_list='dateformats' ?><?php $attr7_name='dateformat' ?><?php $attr7_onchange='' ?><?php $attr7_title='' ?><?php $attr7_class='' ?><?php $attr7_addempty=false ?><?php $attr7_multiple=false ?><?php $attr7_size='1' ?><?php $attr7_lang=false ?><?php
$attr7_tmp_list = $$attr7_list;
if ($this->isEditable() && $this->getRequestVar('mode')!='edit')
{
	echo empty($$attr7_name)?'- '.lang('EMPTY').' -':$attr7_tmp_list[$$attr7_name];
}
else
{
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
if (count($$attr7_list)==1) echo '<input type="hidden" name="'.$attr7_name.'" value="'.$box_key.'" />';
}
?><?php unset($attr7) ?><?php unset($attr7_list) ?><?php unset($attr7_name) ?><?php unset($attr7_onchange) ?><?php unset($attr7_title) ?><?php unset($attr7_class) ?><?php unset($attr7_addempty) ?><?php unset($attr7_multiple) ?><?php unset($attr7_size) ?><?php unset($attr7_lang) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php } ?><?php unset($attr3) ?><?php $attr4_debug_info = 'a:1:{s:7:"present";s:6:"format";}' ?><?php $attr4 = array('present'=>'format') ?><?php $attr4_present='format' ?><?php 
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr7_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:14:"EL_PROP_FORMAT";s:6:"escape";s:4:"true";}' ?><?php $attr7 = array('class'=>'text','text'=>'EL_PROP_FORMAT','escape'=>true) ?><?php $attr7_class='text' ?><?php $attr7_text='EL_PROP_FORMAT' ?><?php $attr7_escape=true ?><?php
	if	( isset($attr7_prefix)&& isset($attr7_key))
		$attr7_key = $attr7_prefix.$attr7_key;
	if	( isset($attr7_suffix)&& isset($attr7_key))
		$attr7_key = $attr7_key.$attr7_suffix;
	if(empty($attr7_title))
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
	if	( $attr7_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr7_array))
	{
		$tmpArray = $$attr7_array;
		if (!empty($attr7_var))
			$tmp_text = $tmpArray[$attr7_var];
		else
			$tmp_text = $langF($tmpArray[$attr7_text]);
	}
	elseif (!empty($attr7_text))
		$tmp_text = $langF($attr7_text);
	elseif (!empty($attr7_textvar))
		$tmp_text = $langF($$attr7_textvar);
	elseif (!empty($attr7_key))
		$tmp_text = $langF($attr7_key);
	elseif (!empty($attr7_var))
		$tmp_text = isset($$attr7_var)?$$attr7_var:'?unset:'.$attr7_var.'?';	
	elseif (!empty($attr7_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr7_raw);
	elseif (!empty($attr7_value))
		$tmp_text = $attr7_value;
	else
	  $tmp_text = '&nbsp;';
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
?></<?php echo $tmp_tag ?>><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_text) ?><?php unset($attr7_escape) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr6_debug_info = 'a:1:{s:5:"class";s:2:"fx";}' ?><?php $attr6 = array('class'=>'fx') ?><?php $attr6_class='fx' ?><?php
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr7_debug_info = 'a:5:{s:4:"list";s:10:"formatlist";s:4:"name";s:6:"format";s:8:"onchange";s:0:"";s:5:"title";s:0:"";s:5:"class";s:0:"";}' ?><?php $attr7 = array('list'=>'formatlist','name'=>'format','onchange'=>'','title'=>'','class'=>'') ?><?php $attr7_list='formatlist' ?><?php $attr7_name='format' ?><?php $attr7_onchange='' ?><?php $attr7_title='' ?><?php $attr7_class='' ?><?php $attr7_tmp_list = $$attr7_list;
		if	( isset($$attr7_name) && isset($attr7_tmp_list[$$attr7_name]) )
			$attr7_tmp_default = $$attr7_name;
		elseif ( isset($attr7_default) )
			$attr7_tmp_default = $attr7_default;
		else
			$attr7_tmp_default = '';
		foreach( $attr7_tmp_list as $box_key=>$box_value )
		{
			$id = 'id_'.$attr7_name.'_'.$box_key;
			echo '<input id="'.$id.'" name="'.$attr7_name.'" type="radio" class="'.$attr7_class.'" value="'.$box_key.'"';
			if ($box_key==$attr7_tmp_default)
				echo ' checked="checked"';
			echo '>&nbsp;<label for="'.$id.'">'.$box_value.'</label><br>';
		}
?><?php unset($attr7) ?><?php unset($attr7_list) ?><?php unset($attr7_name) ?><?php unset($attr7_onchange) ?><?php unset($attr7_title) ?><?php unset($attr7_class) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php } ?><?php unset($attr3) ?><?php $attr4_debug_info = 'a:1:{s:7:"present";s:8:"decimals";}' ?><?php $attr4 = array('present'=>'decimals') ?><?php $attr4_present='decimals' ?><?php 
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr7_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:16:"EL_PROP_DECIMALS";s:6:"escape";s:4:"true";}' ?><?php $attr7 = array('class'=>'text','text'=>'EL_PROP_DECIMALS','escape'=>true) ?><?php $attr7_class='text' ?><?php $attr7_text='EL_PROP_DECIMALS' ?><?php $attr7_escape=true ?><?php
	if	( isset($attr7_prefix)&& isset($attr7_key))
		$attr7_key = $attr7_prefix.$attr7_key;
	if	( isset($attr7_suffix)&& isset($attr7_key))
		$attr7_key = $attr7_key.$attr7_suffix;
	if(empty($attr7_title))
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
	if	( $attr7_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr7_array))
	{
		$tmpArray = $$attr7_array;
		if (!empty($attr7_var))
			$tmp_text = $tmpArray[$attr7_var];
		else
			$tmp_text = $langF($tmpArray[$attr7_text]);
	}
	elseif (!empty($attr7_text))
		$tmp_text = $langF($attr7_text);
	elseif (!empty($attr7_textvar))
		$tmp_text = $langF($$attr7_textvar);
	elseif (!empty($attr7_key))
		$tmp_text = $langF($attr7_key);
	elseif (!empty($attr7_var))
		$tmp_text = isset($$attr7_var)?$$attr7_var:'?unset:'.$attr7_var.'?';	
	elseif (!empty($attr7_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr7_raw);
	elseif (!empty($attr7_value))
		$tmp_text = $attr7_value;
	else
	  $tmp_text = '&nbsp;';
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
?></<?php echo $tmp_tag ?>><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_text) ?><?php unset($attr7_escape) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr6_debug_info = 'a:1:{s:5:"class";s:2:"fx";}' ?><?php $attr6 = array('class'=>'fx') ?><?php $attr6_class='fx' ?><?php
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr7_debug_info = 'a:8:{s:5:"class";s:0:"";s:7:"default";s:0:"";s:4:"type";s:4:"text";s:4:"name";s:8:"decimals";s:4:"size";s:2:"10";s:9:"maxlength";s:1:"2";s:8:"onchange";s:0:"";s:8:"readonly";s:5:"false";}' ?><?php $attr7 = array('class'=>'','default'=>'','type'=>'text','name'=>'decimals','size'=>'10','maxlength'=>'2','onchange'=>'','readonly'=>false) ?><?php $attr7_class='' ?><?php $attr7_default='' ?><?php $attr7_type='text' ?><?php $attr7_name='decimals' ?><?php $attr7_size='10' ?><?php $attr7_maxlength='2' ?><?php $attr7_onchange='' ?><?php $attr7_readonly=false ?><?php if ($this->isEditable() && $this->getRequestVar('mode')!='edit') $attr7_readonly=true;
	  if ($attr7_readonly && empty($$attr7_name)) $$attr7_name = '- '.lang('EMPTY').' -';
      if(!isset($attr7_default)) $attr7_default='';
?><?php if (!$attr7_readonly || $attr7_type=='hidden') {
?><input<?php if ($attr7_readonly) echo ' disabled="true"' ?> id="id_<?php echo $attr7_name ?><?php if ($attr7_readonly) echo '_disabled' ?>" name="<?php echo $attr7_name ?><?php if ($attr7_readonly) echo '_disabled' ?>" type="<?php echo $attr7_type ?>" size="<?php echo $attr7_size ?>" maxlength="<?php echo $attr7_maxlength ?>" class="<?php echo $attr7_class ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" <?php if (in_array($attr7_name,$errors)) echo 'style="border-rightx:10px solid red; background-colorx:yellow; border:2px dashed red;"' ?> /><?php
if	($attr7_readonly) {
?><input type="hidden" id="id_<?php echo $attr7_name ?>" name="<?php echo $attr7_name ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" /><?php
 } } else { ?><span class="<?php echo $attr7_class ?>"><?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?></span><?php } ?><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_default) ?><?php unset($attr7_type) ?><?php unset($attr7_name) ?><?php unset($attr7_size) ?><?php unset($attr7_maxlength) ?><?php unset($attr7_onchange) ?><?php unset($attr7_readonly) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php } ?><?php unset($attr3) ?><?php $attr4_debug_info = 'a:1:{s:7:"present";s:9:"dec_point";}' ?><?php $attr4 = array('present'=>'dec_point') ?><?php $attr4_present='dec_point' ?><?php 
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr7_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:17:"EL_PROP_DEC_POINT";s:6:"escape";s:4:"true";}' ?><?php $attr7 = array('class'=>'text','text'=>'EL_PROP_DEC_POINT','escape'=>true) ?><?php $attr7_class='text' ?><?php $attr7_text='EL_PROP_DEC_POINT' ?><?php $attr7_escape=true ?><?php
	if	( isset($attr7_prefix)&& isset($attr7_key))
		$attr7_key = $attr7_prefix.$attr7_key;
	if	( isset($attr7_suffix)&& isset($attr7_key))
		$attr7_key = $attr7_key.$attr7_suffix;
	if(empty($attr7_title))
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
	if	( $attr7_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr7_array))
	{
		$tmpArray = $$attr7_array;
		if (!empty($attr7_var))
			$tmp_text = $tmpArray[$attr7_var];
		else
			$tmp_text = $langF($tmpArray[$attr7_text]);
	}
	elseif (!empty($attr7_text))
		$tmp_text = $langF($attr7_text);
	elseif (!empty($attr7_textvar))
		$tmp_text = $langF($$attr7_textvar);
	elseif (!empty($attr7_key))
		$tmp_text = $langF($attr7_key);
	elseif (!empty($attr7_var))
		$tmp_text = isset($$attr7_var)?$$attr7_var:'?unset:'.$attr7_var.'?';	
	elseif (!empty($attr7_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr7_raw);
	elseif (!empty($attr7_value))
		$tmp_text = $attr7_value;
	else
	  $tmp_text = '&nbsp;';
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
?></<?php echo $tmp_tag ?>><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_text) ?><?php unset($attr7_escape) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr6_debug_info = 'a:1:{s:5:"class";s:2:"fx";}' ?><?php $attr6 = array('class'=>'fx') ?><?php $attr6_class='fx' ?><?php
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr7_debug_info = 'a:8:{s:5:"class";s:0:"";s:7:"default";s:0:"";s:4:"type";s:4:"text";s:4:"name";s:9:"dec_point";s:4:"size";s:2:"10";s:9:"maxlength";s:1:"5";s:8:"onchange";s:0:"";s:8:"readonly";s:5:"false";}' ?><?php $attr7 = array('class'=>'','default'=>'','type'=>'text','name'=>'dec_point','size'=>'10','maxlength'=>'5','onchange'=>'','readonly'=>false) ?><?php $attr7_class='' ?><?php $attr7_default='' ?><?php $attr7_type='text' ?><?php $attr7_name='dec_point' ?><?php $attr7_size='10' ?><?php $attr7_maxlength='5' ?><?php $attr7_onchange='' ?><?php $attr7_readonly=false ?><?php if ($this->isEditable() && $this->getRequestVar('mode')!='edit') $attr7_readonly=true;
	  if ($attr7_readonly && empty($$attr7_name)) $$attr7_name = '- '.lang('EMPTY').' -';
      if(!isset($attr7_default)) $attr7_default='';
?><?php if (!$attr7_readonly || $attr7_type=='hidden') {
?><input<?php if ($attr7_readonly) echo ' disabled="true"' ?> id="id_<?php echo $attr7_name ?><?php if ($attr7_readonly) echo '_disabled' ?>" name="<?php echo $attr7_name ?><?php if ($attr7_readonly) echo '_disabled' ?>" type="<?php echo $attr7_type ?>" size="<?php echo $attr7_size ?>" maxlength="<?php echo $attr7_maxlength ?>" class="<?php echo $attr7_class ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" <?php if (in_array($attr7_name,$errors)) echo 'style="border-rightx:10px solid red; background-colorx:yellow; border:2px dashed red;"' ?> /><?php
if	($attr7_readonly) {
?><input type="hidden" id="id_<?php echo $attr7_name ?>" name="<?php echo $attr7_name ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" /><?php
 } } else { ?><span class="<?php echo $attr7_class ?>"><?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?></span><?php } ?><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_default) ?><?php unset($attr7_type) ?><?php unset($attr7_name) ?><?php unset($attr7_size) ?><?php unset($attr7_maxlength) ?><?php unset($attr7_onchange) ?><?php unset($attr7_readonly) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php } ?><?php unset($attr3) ?><?php $attr4_debug_info = 'a:1:{s:7:"present";s:12:"thousand_sep";}' ?><?php $attr4 = array('present'=>'thousand_sep') ?><?php $attr4_present='thousand_sep' ?><?php 
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr7_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:20:"EL_PROP_thousand_sep";s:6:"escape";s:4:"true";}' ?><?php $attr7 = array('class'=>'text','text'=>'EL_PROP_thousand_sep','escape'=>true) ?><?php $attr7_class='text' ?><?php $attr7_text='EL_PROP_thousand_sep' ?><?php $attr7_escape=true ?><?php
	if	( isset($attr7_prefix)&& isset($attr7_key))
		$attr7_key = $attr7_prefix.$attr7_key;
	if	( isset($attr7_suffix)&& isset($attr7_key))
		$attr7_key = $attr7_key.$attr7_suffix;
	if(empty($attr7_title))
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
	if	( $attr7_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr7_array))
	{
		$tmpArray = $$attr7_array;
		if (!empty($attr7_var))
			$tmp_text = $tmpArray[$attr7_var];
		else
			$tmp_text = $langF($tmpArray[$attr7_text]);
	}
	elseif (!empty($attr7_text))
		$tmp_text = $langF($attr7_text);
	elseif (!empty($attr7_textvar))
		$tmp_text = $langF($$attr7_textvar);
	elseif (!empty($attr7_key))
		$tmp_text = $langF($attr7_key);
	elseif (!empty($attr7_var))
		$tmp_text = isset($$attr7_var)?$$attr7_var:'?unset:'.$attr7_var.'?';	
	elseif (!empty($attr7_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr7_raw);
	elseif (!empty($attr7_value))
		$tmp_text = $attr7_value;
	else
	  $tmp_text = '&nbsp;';
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
?></<?php echo $tmp_tag ?>><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_text) ?><?php unset($attr7_escape) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr6_debug_info = 'a:1:{s:5:"class";s:2:"fx";}' ?><?php $attr6 = array('class'=>'fx') ?><?php $attr6_class='fx' ?><?php
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr7_debug_info = 'a:8:{s:5:"class";s:0:"";s:7:"default";s:0:"";s:4:"type";s:4:"text";s:4:"name";s:12:"thousand_sep";s:4:"size";s:2:"10";s:9:"maxlength";s:1:"1";s:8:"onchange";s:0:"";s:8:"readonly";s:5:"false";}' ?><?php $attr7 = array('class'=>'','default'=>'','type'=>'text','name'=>'thousand_sep','size'=>'10','maxlength'=>'1','onchange'=>'','readonly'=>false) ?><?php $attr7_class='' ?><?php $attr7_default='' ?><?php $attr7_type='text' ?><?php $attr7_name='thousand_sep' ?><?php $attr7_size='10' ?><?php $attr7_maxlength='1' ?><?php $attr7_onchange='' ?><?php $attr7_readonly=false ?><?php if ($this->isEditable() && $this->getRequestVar('mode')!='edit') $attr7_readonly=true;
	  if ($attr7_readonly && empty($$attr7_name)) $$attr7_name = '- '.lang('EMPTY').' -';
      if(!isset($attr7_default)) $attr7_default='';
?><?php if (!$attr7_readonly || $attr7_type=='hidden') {
?><input<?php if ($attr7_readonly) echo ' disabled="true"' ?> id="id_<?php echo $attr7_name ?><?php if ($attr7_readonly) echo '_disabled' ?>" name="<?php echo $attr7_name ?><?php if ($attr7_readonly) echo '_disabled' ?>" type="<?php echo $attr7_type ?>" size="<?php echo $attr7_size ?>" maxlength="<?php echo $attr7_maxlength ?>" class="<?php echo $attr7_class ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" <?php if (in_array($attr7_name,$errors)) echo 'style="border-rightx:10px solid red; background-colorx:yellow; border:2px dashed red;"' ?> /><?php
if	($attr7_readonly) {
?><input type="hidden" id="id_<?php echo $attr7_name ?>" name="<?php echo $attr7_name ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" /><?php
 } } else { ?><span class="<?php echo $attr7_class ?>"><?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?></span><?php } ?><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_default) ?><?php unset($attr7_type) ?><?php unset($attr7_name) ?><?php unset($attr7_size) ?><?php unset($attr7_maxlength) ?><?php unset($attr7_onchange) ?><?php unset($attr7_readonly) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php } ?><?php unset($attr3) ?><?php $attr4_debug_info = 'a:1:{s:7:"present";s:12:"default_text";}' ?><?php $attr4 = array('present'=>'default_text') ?><?php $attr4_present='default_text' ?><?php 
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr7_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:20:"EL_PROP_default_text";s:6:"escape";s:4:"true";}' ?><?php $attr7 = array('class'=>'text','text'=>'EL_PROP_default_text','escape'=>true) ?><?php $attr7_class='text' ?><?php $attr7_text='EL_PROP_default_text' ?><?php $attr7_escape=true ?><?php
	if	( isset($attr7_prefix)&& isset($attr7_key))
		$attr7_key = $attr7_prefix.$attr7_key;
	if	( isset($attr7_suffix)&& isset($attr7_key))
		$attr7_key = $attr7_key.$attr7_suffix;
	if(empty($attr7_title))
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
	if	( $attr7_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr7_array))
	{
		$tmpArray = $$attr7_array;
		if (!empty($attr7_var))
			$tmp_text = $tmpArray[$attr7_var];
		else
			$tmp_text = $langF($tmpArray[$attr7_text]);
	}
	elseif (!empty($attr7_text))
		$tmp_text = $langF($attr7_text);
	elseif (!empty($attr7_textvar))
		$tmp_text = $langF($$attr7_textvar);
	elseif (!empty($attr7_key))
		$tmp_text = $langF($attr7_key);
	elseif (!empty($attr7_var))
		$tmp_text = isset($$attr7_var)?$$attr7_var:'?unset:'.$attr7_var.'?';	
	elseif (!empty($attr7_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr7_raw);
	elseif (!empty($attr7_value))
		$tmp_text = $attr7_value;
	else
	  $tmp_text = '&nbsp;';
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
?></<?php echo $tmp_tag ?>><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_text) ?><?php unset($attr7_escape) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr6_debug_info = 'a:1:{s:5:"class";s:2:"fx";}' ?><?php $attr6 = array('class'=>'fx') ?><?php $attr6_class='fx' ?><?php
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr7_debug_info = 'a:8:{s:5:"class";s:0:"";s:7:"default";s:0:"";s:4:"type";s:4:"text";s:4:"name";s:12:"default_text";s:4:"size";s:2:"40";s:9:"maxlength";s:3:"255";s:8:"onchange";s:0:"";s:8:"readonly";s:5:"false";}' ?><?php $attr7 = array('class'=>'','default'=>'','type'=>'text','name'=>'default_text','size'=>'40','maxlength'=>'255','onchange'=>'','readonly'=>false) ?><?php $attr7_class='' ?><?php $attr7_default='' ?><?php $attr7_type='text' ?><?php $attr7_name='default_text' ?><?php $attr7_size='40' ?><?php $attr7_maxlength='255' ?><?php $attr7_onchange='' ?><?php $attr7_readonly=false ?><?php if ($this->isEditable() && $this->getRequestVar('mode')!='edit') $attr7_readonly=true;
	  if ($attr7_readonly && empty($$attr7_name)) $$attr7_name = '- '.lang('EMPTY').' -';
      if(!isset($attr7_default)) $attr7_default='';
?><?php if (!$attr7_readonly || $attr7_type=='hidden') {
?><input<?php if ($attr7_readonly) echo ' disabled="true"' ?> id="id_<?php echo $attr7_name ?><?php if ($attr7_readonly) echo '_disabled' ?>" name="<?php echo $attr7_name ?><?php if ($attr7_readonly) echo '_disabled' ?>" type="<?php echo $attr7_type ?>" size="<?php echo $attr7_size ?>" maxlength="<?php echo $attr7_maxlength ?>" class="<?php echo $attr7_class ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" <?php if (in_array($attr7_name,$errors)) echo 'style="border-rightx:10px solid red; background-colorx:yellow; border:2px dashed red;"' ?> /><?php
if	($attr7_readonly) {
?><input type="hidden" id="id_<?php echo $attr7_name ?>" name="<?php echo $attr7_name ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" /><?php
 } } else { ?><span class="<?php echo $attr7_class ?>"><?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?></span><?php } ?><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_default) ?><?php unset($attr7_type) ?><?php unset($attr7_name) ?><?php unset($attr7_size) ?><?php unset($attr7_maxlength) ?><?php unset($attr7_onchange) ?><?php unset($attr7_readonly) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php } ?><?php unset($attr3) ?><?php $attr4_debug_info = 'a:1:{s:7:"present";s:16:"default_longtext";}' ?><?php $attr4 = array('present'=>'default_longtext') ?><?php $attr4_present='default_longtext' ?><?php 
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr7_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:24:"EL_PROP_default_longtext";s:6:"escape";s:4:"true";}' ?><?php $attr7 = array('class'=>'text','text'=>'EL_PROP_default_longtext','escape'=>true) ?><?php $attr7_class='text' ?><?php $attr7_text='EL_PROP_default_longtext' ?><?php $attr7_escape=true ?><?php
	if	( isset($attr7_prefix)&& isset($attr7_key))
		$attr7_key = $attr7_prefix.$attr7_key;
	if	( isset($attr7_suffix)&& isset($attr7_key))
		$attr7_key = $attr7_key.$attr7_suffix;
	if(empty($attr7_title))
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
	if	( $attr7_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr7_array))
	{
		$tmpArray = $$attr7_array;
		if (!empty($attr7_var))
			$tmp_text = $tmpArray[$attr7_var];
		else
			$tmp_text = $langF($tmpArray[$attr7_text]);
	}
	elseif (!empty($attr7_text))
		$tmp_text = $langF($attr7_text);
	elseif (!empty($attr7_textvar))
		$tmp_text = $langF($$attr7_textvar);
	elseif (!empty($attr7_key))
		$tmp_text = $langF($attr7_key);
	elseif (!empty($attr7_var))
		$tmp_text = isset($$attr7_var)?$$attr7_var:'?unset:'.$attr7_var.'?';	
	elseif (!empty($attr7_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr7_raw);
	elseif (!empty($attr7_value))
		$tmp_text = $attr7_value;
	else
	  $tmp_text = '&nbsp;';
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
?></<?php echo $tmp_tag ?>><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_text) ?><?php unset($attr7_escape) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr6_debug_info = 'a:1:{s:5:"class";s:2:"fx";}' ?><?php $attr6 = array('class'=>'fx') ?><?php $attr6_class='fx' ?><?php
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr7_debug_info = 'a:5:{s:4:"name";s:16:"default_longtext";s:4:"rows";s:2:"10";s:4:"cols";s:2:"40";s:5:"class";s:0:"";s:7:"default";s:0:"";}' ?><?php $attr7 = array('name'=>'default_longtext','rows'=>'10','cols'=>'40','class'=>'','default'=>'') ?><?php $attr7_name='default_longtext' ?><?php $attr7_rows='10' ?><?php $attr7_cols='40' ?><?php $attr7_class='' ?><?php $attr7_default='' ?><?php if ($this->isEditable() && $this->getRequestVar('mode')!='edit') $attr7_readonly=true;
      if ( !$attr7_readonly) {
?><textarea <?php if ($attr7_readonly) echo ' disabled="true"' ?> class="<?php echo $attr7_class ?>" name="<?php echo $attr7_name ?>" rows="<?php echo $attr7_rows ?>" cols="<?php echo $attr7_cols ?>"><?php echo htmlentities(isset($$attr7_name)?$$attr7_name:$attr7_default) ?></textarea><?php
 } else {
?><span class="<?php echo $attr7_class ?>"><?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?></span><?php } ?><?php unset($attr7) ?><?php unset($attr7_name) ?><?php unset($attr7_rows) ?><?php unset($attr7_cols) ?><?php unset($attr7_class) ?><?php unset($attr7_default) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php } ?><?php unset($attr3) ?><?php $attr4_debug_info = 'a:1:{s:7:"present";s:10:"parameters";}' ?><?php $attr4 = array('present'=>'parameters') ?><?php $attr4_present='parameters' ?><?php 
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr7_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:26:"EL_PROP_DYNAMIC_PARAMETERS";s:6:"escape";s:4:"true";}' ?><?php $attr7 = array('class'=>'text','text'=>'EL_PROP_DYNAMIC_PARAMETERS','escape'=>true) ?><?php $attr7_class='text' ?><?php $attr7_text='EL_PROP_DYNAMIC_PARAMETERS' ?><?php $attr7_escape=true ?><?php
	if	( isset($attr7_prefix)&& isset($attr7_key))
		$attr7_key = $attr7_prefix.$attr7_key;
	if	( isset($attr7_suffix)&& isset($attr7_key))
		$attr7_key = $attr7_key.$attr7_suffix;
	if(empty($attr7_title))
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
	if	( $attr7_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr7_array))
	{
		$tmpArray = $$attr7_array;
		if (!empty($attr7_var))
			$tmp_text = $tmpArray[$attr7_var];
		else
			$tmp_text = $langF($tmpArray[$attr7_text]);
	}
	elseif (!empty($attr7_text))
		$tmp_text = $langF($attr7_text);
	elseif (!empty($attr7_textvar))
		$tmp_text = $langF($$attr7_textvar);
	elseif (!empty($attr7_key))
		$tmp_text = $langF($attr7_key);
	elseif (!empty($attr7_var))
		$tmp_text = isset($$attr7_var)?$$attr7_var:'?unset:'.$attr7_var.'?';	
	elseif (!empty($attr7_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr7_raw);
	elseif (!empty($attr7_value))
		$tmp_text = $attr7_value;
	else
	  $tmp_text = '&nbsp;';
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
?></<?php echo $tmp_tag ?>><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_text) ?><?php unset($attr7_escape) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr6_debug_info = 'a:1:{s:5:"class";s:2:"fx";}' ?><?php $attr6 = array('class'=>'fx') ?><?php $attr6_class='fx' ?><?php
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr7_debug_info = 'a:5:{s:4:"name";s:10:"parameters";s:4:"rows";s:2:"15";s:4:"cols";s:2:"40";s:5:"class";s:0:"";s:7:"default";s:0:"";}' ?><?php $attr7 = array('name'=>'parameters','rows'=>'15','cols'=>'40','class'=>'','default'=>'') ?><?php $attr7_name='parameters' ?><?php $attr7_rows='15' ?><?php $attr7_cols='40' ?><?php $attr7_class='' ?><?php $attr7_default='' ?><?php if ($this->isEditable() && $this->getRequestVar('mode')!='edit') $attr7_readonly=true;
      if ( !$attr7_readonly) {
?><textarea <?php if ($attr7_readonly) echo ' disabled="true"' ?> class="<?php echo $attr7_class ?>" name="<?php echo $attr7_name ?>" rows="<?php echo $attr7_rows ?>" cols="<?php echo $attr7_cols ?>"><?php echo htmlentities(isset($$attr7_name)?$$attr7_name:$attr7_default) ?></textarea><?php
 } else {
?><span class="<?php echo $attr7_class ?>"><?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?></span><?php } ?><?php unset($attr7) ?><?php unset($attr7_name) ?><?php unset($attr7_rows) ?><?php unset($attr7_cols) ?><?php unset($attr7_class) ?><?php unset($attr7_default) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?><?php
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr6_debug_info = 'a:1:{s:5:"class";s:2:"fx";}' ?><?php $attr6 = array('class'=>'fx') ?><?php $attr6_class='fx' ?><?php
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr7_debug_info = 'a:4:{s:4:"list";s:24:"dynamic_class_parameters";s:7:"extract";s:5:"false";s:3:"key";s:9:"paramName";s:5:"value";s:12:"defaultValue";}' ?><?php $attr7 = array('list'=>'dynamic_class_parameters','extract'=>false,'key'=>'paramName','value'=>'defaultValue') ?><?php $attr7_list='dynamic_class_parameters' ?><?php $attr7_extract=false ?><?php $attr7_key='paramName' ?><?php $attr7_value='defaultValue' ?><?php
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
?><?php unset($attr7) ?><?php unset($attr7_list) ?><?php unset($attr7_extract) ?><?php unset($attr7_key) ?><?php unset($attr7_value) ?><?php $attr8_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"var";s:9:"paramName";s:6:"escape";s:4:"true";}' ?><?php $attr8 = array('class'=>'text','var'=>'paramName','escape'=>true) ?><?php $attr8_class='text' ?><?php $attr8_var='paramName' ?><?php $attr8_escape=true ?><?php
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
?></<?php echo $tmp_tag ?>><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_var) ?><?php unset($attr8_escape) ?><?php $attr8_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"raw";s:2:"_(";s:6:"escape";s:4:"true";}' ?><?php $attr8 = array('class'=>'text','raw'=>'_(','escape'=>true) ?><?php $attr8_class='text' ?><?php $attr8_raw='_(' ?><?php $attr8_escape=true ?><?php
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
?></<?php echo $tmp_tag ?>><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_raw) ?><?php unset($attr8_escape) ?><?php $attr8_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:14:"GLOBAL_DEFAULT";s:6:"escape";s:4:"true";}' ?><?php $attr8 = array('class'=>'text','text'=>'GLOBAL_DEFAULT','escape'=>true) ?><?php $attr8_class='text' ?><?php $attr8_text='GLOBAL_DEFAULT' ?><?php $attr8_escape=true ?><?php
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
?></<?php echo $tmp_tag ?>><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_text) ?><?php unset($attr8_escape) ?><?php $attr8_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"raw";s:4:")_=_";s:6:"escape";s:4:"true";}' ?><?php $attr8 = array('class'=>'text','raw'=>')_=_','escape'=>true) ?><?php $attr8_class='text' ?><?php $attr8_raw=')_=_' ?><?php $attr8_escape=true ?><?php
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
?></<?php echo $tmp_tag ?>><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_raw) ?><?php unset($attr8_escape) ?><?php $attr8_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"var";s:12:"defaultValue";s:6:"escape";s:4:"true";}' ?><?php $attr8 = array('class'=>'text','var'=>'defaultValue','escape'=>true) ?><?php $attr8_class='text' ?><?php $attr8_var='defaultValue' ?><?php $attr8_escape=true ?><?php
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
?></<?php echo $tmp_tag ?>><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_var) ?><?php unset($attr8_escape) ?><?php $attr8_debug_info = 'a:0:{}' ?><?php $attr8 = array() ?><br/><?php unset($attr8) ?><?php $attr6_debug_info = 'a:0:{}' ?><?php $attr6 = array() ?><?php } ?><?php unset($attr6) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php } ?><?php unset($attr3) ?><?php $attr4_debug_info = 'a:1:{s:7:"present";s:12:"select_items";}' ?><?php $attr4 = array('present'=>'select_items') ?><?php $attr4_present='select_items' ?><?php 
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr7_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:20:"EL_PROP_select_items";s:6:"escape";s:4:"true";}' ?><?php $attr7 = array('class'=>'text','text'=>'EL_PROP_select_items','escape'=>true) ?><?php $attr7_class='text' ?><?php $attr7_text='EL_PROP_select_items' ?><?php $attr7_escape=true ?><?php
	if	( isset($attr7_prefix)&& isset($attr7_key))
		$attr7_key = $attr7_prefix.$attr7_key;
	if	( isset($attr7_suffix)&& isset($attr7_key))
		$attr7_key = $attr7_key.$attr7_suffix;
	if(empty($attr7_title))
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
	if	( $attr7_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr7_array))
	{
		$tmpArray = $$attr7_array;
		if (!empty($attr7_var))
			$tmp_text = $tmpArray[$attr7_var];
		else
			$tmp_text = $langF($tmpArray[$attr7_text]);
	}
	elseif (!empty($attr7_text))
		$tmp_text = $langF($attr7_text);
	elseif (!empty($attr7_textvar))
		$tmp_text = $langF($$attr7_textvar);
	elseif (!empty($attr7_key))
		$tmp_text = $langF($attr7_key);
	elseif (!empty($attr7_var))
		$tmp_text = isset($$attr7_var)?$$attr7_var:'?unset:'.$attr7_var.'?';	
	elseif (!empty($attr7_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr7_raw);
	elseif (!empty($attr7_value))
		$tmp_text = $attr7_value;
	else
	  $tmp_text = '&nbsp;';
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
?></<?php echo $tmp_tag ?>><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_text) ?><?php unset($attr7_escape) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr6_debug_info = 'a:1:{s:5:"class";s:2:"fx";}' ?><?php $attr6 = array('class'=>'fx') ?><?php $attr6_class='fx' ?><?php
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr7_debug_info = 'a:5:{s:4:"name";s:12:"select_items";s:4:"rows";s:2:"15";s:4:"cols";s:2:"40";s:5:"class";s:0:"";s:7:"default";s:0:"";}' ?><?php $attr7 = array('name'=>'select_items','rows'=>'15','cols'=>'40','class'=>'','default'=>'') ?><?php $attr7_name='select_items' ?><?php $attr7_rows='15' ?><?php $attr7_cols='40' ?><?php $attr7_class='' ?><?php $attr7_default='' ?><?php if ($this->isEditable() && $this->getRequestVar('mode')!='edit') $attr7_readonly=true;
      if ( !$attr7_readonly) {
?><textarea <?php if ($attr7_readonly) echo ' disabled="true"' ?> class="<?php echo $attr7_class ?>" name="<?php echo $attr7_name ?>" rows="<?php echo $attr7_rows ?>" cols="<?php echo $attr7_cols ?>"><?php echo htmlentities(isset($$attr7_name)?$$attr7_name:$attr7_default) ?></textarea><?php
 } else {
?><span class="<?php echo $attr7_class ?>"><?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?></span><?php } ?><?php unset($attr7) ?><?php unset($attr7_name) ?><?php unset($attr7_rows) ?><?php unset($attr7_cols) ?><?php unset($attr7_class) ?><?php unset($attr7_default) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php } ?><?php unset($attr3) ?><?php $attr4_debug_info = 'a:1:{s:7:"present";s:11:"linkelement";}' ?><?php $attr4 = array('present'=>'linkelement') ?><?php $attr4_present='linkelement' ?><?php 
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr7_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:7:"EL_LINK";s:6:"escape";s:4:"true";}' ?><?php $attr7 = array('class'=>'text','text'=>'EL_LINK','escape'=>true) ?><?php $attr7_class='text' ?><?php $attr7_text='EL_LINK' ?><?php $attr7_escape=true ?><?php
	if	( isset($attr7_prefix)&& isset($attr7_key))
		$attr7_key = $attr7_prefix.$attr7_key;
	if	( isset($attr7_suffix)&& isset($attr7_key))
		$attr7_key = $attr7_key.$attr7_suffix;
	if(empty($attr7_title))
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
	if	( $attr7_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr7_array))
	{
		$tmpArray = $$attr7_array;
		if (!empty($attr7_var))
			$tmp_text = $tmpArray[$attr7_var];
		else
			$tmp_text = $langF($tmpArray[$attr7_text]);
	}
	elseif (!empty($attr7_text))
		$tmp_text = $langF($attr7_text);
	elseif (!empty($attr7_textvar))
		$tmp_text = $langF($$attr7_textvar);
	elseif (!empty($attr7_key))
		$tmp_text = $langF($attr7_key);
	elseif (!empty($attr7_var))
		$tmp_text = isset($$attr7_var)?$$attr7_var:'?unset:'.$attr7_var.'?';	
	elseif (!empty($attr7_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr7_raw);
	elseif (!empty($attr7_value))
		$tmp_text = $attr7_value;
	else
	  $tmp_text = '&nbsp;';
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
?></<?php echo $tmp_tag ?>><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_text) ?><?php unset($attr7_escape) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr6_debug_info = 'a:1:{s:5:"class";s:2:"fx";}' ?><?php $attr6 = array('class'=>'fx') ?><?php $attr6_class='fx' ?><?php
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr7_debug_info = 'a:9:{s:4:"list";s:12:"linkelements";s:4:"name";s:11:"linkelement";s:8:"onchange";s:0:"";s:5:"title";s:0:"";s:5:"class";s:0:"";s:8:"addempty";s:5:"false";s:8:"multiple";s:5:"false";s:4:"size";s:1:"1";s:4:"lang";s:5:"false";}' ?><?php $attr7 = array('list'=>'linkelements','name'=>'linkelement','onchange'=>'','title'=>'','class'=>'','addempty'=>false,'multiple'=>false,'size'=>'1','lang'=>false) ?><?php $attr7_list='linkelements' ?><?php $attr7_name='linkelement' ?><?php $attr7_onchange='' ?><?php $attr7_title='' ?><?php $attr7_class='' ?><?php $attr7_addempty=false ?><?php $attr7_multiple=false ?><?php $attr7_size='1' ?><?php $attr7_lang=false ?><?php
$attr7_tmp_list = $$attr7_list;
if ($this->isEditable() && $this->getRequestVar('mode')!='edit')
{
	echo empty($$attr7_name)?'- '.lang('EMPTY').' -':$attr7_tmp_list[$$attr7_name];
}
else
{
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
if (count($$attr7_list)==1) echo '<input type="hidden" name="'.$attr7_name.'" value="'.$box_key.'" />';
}
?><?php unset($attr7) ?><?php unset($attr7_list) ?><?php unset($attr7_name) ?><?php unset($attr7_onchange) ?><?php unset($attr7_title) ?><?php unset($attr7_class) ?><?php unset($attr7_addempty) ?><?php unset($attr7_multiple) ?><?php unset($attr7_size) ?><?php unset($attr7_lang) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php } ?><?php unset($attr3) ?><?php $attr4_debug_info = 'a:1:{s:7:"present";s:4:"name";}' ?><?php $attr4 = array('present'=>'name') ?><?php $attr4_present='name' ?><?php 
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr7_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:12:"ELEMENT_NAME";s:6:"escape";s:4:"true";}' ?><?php $attr7 = array('class'=>'text','text'=>'ELEMENT_NAME','escape'=>true) ?><?php $attr7_class='text' ?><?php $attr7_text='ELEMENT_NAME' ?><?php $attr7_escape=true ?><?php
	if	( isset($attr7_prefix)&& isset($attr7_key))
		$attr7_key = $attr7_prefix.$attr7_key;
	if	( isset($attr7_suffix)&& isset($attr7_key))
		$attr7_key = $attr7_key.$attr7_suffix;
	if(empty($attr7_title))
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
	if	( $attr7_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr7_array))
	{
		$tmpArray = $$attr7_array;
		if (!empty($attr7_var))
			$tmp_text = $tmpArray[$attr7_var];
		else
			$tmp_text = $langF($tmpArray[$attr7_text]);
	}
	elseif (!empty($attr7_text))
		$tmp_text = $langF($attr7_text);
	elseif (!empty($attr7_textvar))
		$tmp_text = $langF($$attr7_textvar);
	elseif (!empty($attr7_key))
		$tmp_text = $langF($attr7_key);
	elseif (!empty($attr7_var))
		$tmp_text = isset($$attr7_var)?$$attr7_var:'?unset:'.$attr7_var.'?';	
	elseif (!empty($attr7_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr7_raw);
	elseif (!empty($attr7_value))
		$tmp_text = $attr7_value;
	else
	  $tmp_text = '&nbsp;';
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
?></<?php echo $tmp_tag ?>><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_text) ?><?php unset($attr7_escape) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr6_debug_info = 'a:1:{s:5:"class";s:2:"fx";}' ?><?php $attr6 = array('class'=>'fx') ?><?php $attr6_class='fx' ?><?php
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr7_debug_info = 'a:9:{s:4:"list";s:5:"names";s:4:"name";s:4:"name";s:8:"onchange";s:0:"";s:5:"title";s:0:"";s:5:"class";s:0:"";s:8:"addempty";s:5:"false";s:8:"multiple";s:5:"false";s:4:"size";s:1:"1";s:4:"lang";s:5:"false";}' ?><?php $attr7 = array('list'=>'names','name'=>'name','onchange'=>'','title'=>'','class'=>'','addempty'=>false,'multiple'=>false,'size'=>'1','lang'=>false) ?><?php $attr7_list='names' ?><?php $attr7_name='name' ?><?php $attr7_onchange='' ?><?php $attr7_title='' ?><?php $attr7_class='' ?><?php $attr7_addempty=false ?><?php $attr7_multiple=false ?><?php $attr7_size='1' ?><?php $attr7_lang=false ?><?php
$attr7_tmp_list = $$attr7_list;
if ($this->isEditable() && $this->getRequestVar('mode')!='edit')
{
	echo empty($$attr7_name)?'- '.lang('EMPTY').' -':$attr7_tmp_list[$$attr7_name];
}
else
{
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
if (count($$attr7_list)==1) echo '<input type="hidden" name="'.$attr7_name.'" value="'.$box_key.'" />';
}
?><?php unset($attr7) ?><?php unset($attr7_list) ?><?php unset($attr7_name) ?><?php unset($attr7_onchange) ?><?php unset($attr7_title) ?><?php unset($attr7_class) ?><?php unset($attr7_addempty) ?><?php unset($attr7_multiple) ?><?php unset($attr7_size) ?><?php unset($attr7_lang) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php } ?><?php unset($attr3) ?><?php $attr4_debug_info = 'a:1:{s:7:"present";s:14:"folderobjectid";}' ?><?php $attr4 = array('present'=>'folderobjectid') ?><?php $attr4_present='folderobjectid' ?><?php 
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr7_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:28:"EL_PROP_DEFAULT_FOLDEROBJECT";s:6:"escape";s:4:"true";}' ?><?php $attr7 = array('class'=>'text','text'=>'EL_PROP_DEFAULT_FOLDEROBJECT','escape'=>true) ?><?php $attr7_class='text' ?><?php $attr7_text='EL_PROP_DEFAULT_FOLDEROBJECT' ?><?php $attr7_escape=true ?><?php
	if	( isset($attr7_prefix)&& isset($attr7_key))
		$attr7_key = $attr7_prefix.$attr7_key;
	if	( isset($attr7_suffix)&& isset($attr7_key))
		$attr7_key = $attr7_key.$attr7_suffix;
	if(empty($attr7_title))
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
	if	( $attr7_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr7_array))
	{
		$tmpArray = $$attr7_array;
		if (!empty($attr7_var))
			$tmp_text = $tmpArray[$attr7_var];
		else
			$tmp_text = $langF($tmpArray[$attr7_text]);
	}
	elseif (!empty($attr7_text))
		$tmp_text = $langF($attr7_text);
	elseif (!empty($attr7_textvar))
		$tmp_text = $langF($$attr7_textvar);
	elseif (!empty($attr7_key))
		$tmp_text = $langF($attr7_key);
	elseif (!empty($attr7_var))
		$tmp_text = isset($$attr7_var)?$$attr7_var:'?unset:'.$attr7_var.'?';	
	elseif (!empty($attr7_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr7_raw);
	elseif (!empty($attr7_value))
		$tmp_text = $attr7_value;
	else
	  $tmp_text = '&nbsp;';
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
?></<?php echo $tmp_tag ?>><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_text) ?><?php unset($attr7_escape) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr6_debug_info = 'a:1:{s:5:"class";s:2:"fx";}' ?><?php $attr6 = array('class'=>'fx') ?><?php $attr6_class='fx' ?><?php
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr7_debug_info = 'a:9:{s:4:"list";s:7:"folders";s:4:"name";s:14:"folderobjectid";s:8:"onchange";s:0:"";s:5:"title";s:0:"";s:5:"class";s:0:"";s:8:"addempty";s:5:"false";s:8:"multiple";s:5:"false";s:4:"size";s:1:"1";s:4:"lang";s:5:"false";}' ?><?php $attr7 = array('list'=>'folders','name'=>'folderobjectid','onchange'=>'','title'=>'','class'=>'','addempty'=>false,'multiple'=>false,'size'=>'1','lang'=>false) ?><?php $attr7_list='folders' ?><?php $attr7_name='folderobjectid' ?><?php $attr7_onchange='' ?><?php $attr7_title='' ?><?php $attr7_class='' ?><?php $attr7_addempty=false ?><?php $attr7_multiple=false ?><?php $attr7_size='1' ?><?php $attr7_lang=false ?><?php
$attr7_tmp_list = $$attr7_list;
if ($this->isEditable() && $this->getRequestVar('mode')!='edit')
{
	echo empty($$attr7_name)?'- '.lang('EMPTY').' -':$attr7_tmp_list[$$attr7_name];
}
else
{
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
if (count($$attr7_list)==1) echo '<input type="hidden" name="'.$attr7_name.'" value="'.$box_key.'" />';
}
?><?php unset($attr7) ?><?php unset($attr7_list) ?><?php unset($attr7_name) ?><?php unset($attr7_onchange) ?><?php unset($attr7_title) ?><?php unset($attr7_class) ?><?php unset($attr7_addempty) ?><?php unset($attr7_multiple) ?><?php unset($attr7_size) ?><?php unset($attr7_lang) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php } ?><?php unset($attr3) ?><?php $attr4_debug_info = 'a:1:{s:7:"present";s:16:"default_objectid";}' ?><?php $attr4 = array('present'=>'default_objectid') ?><?php $attr4_present='default_objectid' ?><?php 
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr7_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:22:"EL_PROP_DEFAULT_OBJECT";s:6:"escape";s:4:"true";}' ?><?php $attr7 = array('class'=>'text','text'=>'EL_PROP_DEFAULT_OBJECT','escape'=>true) ?><?php $attr7_class='text' ?><?php $attr7_text='EL_PROP_DEFAULT_OBJECT' ?><?php $attr7_escape=true ?><?php
	if	( isset($attr7_prefix)&& isset($attr7_key))
		$attr7_key = $attr7_prefix.$attr7_key;
	if	( isset($attr7_suffix)&& isset($attr7_key))
		$attr7_key = $attr7_key.$attr7_suffix;
	if(empty($attr7_title))
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
	if	( $attr7_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr7_array))
	{
		$tmpArray = $$attr7_array;
		if (!empty($attr7_var))
			$tmp_text = $tmpArray[$attr7_var];
		else
			$tmp_text = $langF($tmpArray[$attr7_text]);
	}
	elseif (!empty($attr7_text))
		$tmp_text = $langF($attr7_text);
	elseif (!empty($attr7_textvar))
		$tmp_text = $langF($$attr7_textvar);
	elseif (!empty($attr7_key))
		$tmp_text = $langF($attr7_key);
	elseif (!empty($attr7_var))
		$tmp_text = isset($$attr7_var)?$$attr7_var:'?unset:'.$attr7_var.'?';	
	elseif (!empty($attr7_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr7_raw);
	elseif (!empty($attr7_value))
		$tmp_text = $attr7_value;
	else
	  $tmp_text = '&nbsp;';
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
?></<?php echo $tmp_tag ?>><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_text) ?><?php unset($attr7_escape) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr6_debug_info = 'a:1:{s:5:"class";s:2:"fx";}' ?><?php $attr6 = array('class'=>'fx') ?><?php $attr6_class='fx' ?><?php
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr7_debug_info = 'a:9:{s:4:"list";s:7:"objects";s:4:"name";s:16:"default_objectid";s:8:"onchange";s:0:"";s:5:"title";s:0:"";s:5:"class";s:0:"";s:8:"addempty";s:5:"false";s:8:"multiple";s:5:"false";s:4:"size";s:1:"1";s:4:"lang";s:5:"false";}' ?><?php $attr7 = array('list'=>'objects','name'=>'default_objectid','onchange'=>'','title'=>'','class'=>'','addempty'=>false,'multiple'=>false,'size'=>'1','lang'=>false) ?><?php $attr7_list='objects' ?><?php $attr7_name='default_objectid' ?><?php $attr7_onchange='' ?><?php $attr7_title='' ?><?php $attr7_class='' ?><?php $attr7_addempty=false ?><?php $attr7_multiple=false ?><?php $attr7_size='1' ?><?php $attr7_lang=false ?><?php
$attr7_tmp_list = $$attr7_list;
if ($this->isEditable() && $this->getRequestVar('mode')!='edit')
{
	echo empty($$attr7_name)?'- '.lang('EMPTY').' -':$attr7_tmp_list[$$attr7_name];
}
else
{
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
if (count($$attr7_list)==1) echo '<input type="hidden" name="'.$attr7_name.'" value="'.$box_key.'" />';
}
?><?php unset($attr7) ?><?php unset($attr7_list) ?><?php unset($attr7_name) ?><?php unset($attr7_onchange) ?><?php unset($attr7_title) ?><?php unset($attr7_class) ?><?php unset($attr7_addempty) ?><?php unset($attr7_multiple) ?><?php unset($attr7_size) ?><?php unset($attr7_lang) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php } ?><?php unset($attr3) ?><?php $attr4_debug_info = 'a:1:{s:7:"present";s:4:"code";}' ?><?php $attr4 = array('present'=>'code') ?><?php $attr4_present='code' ?><?php 
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr7_debug_info = 'a:3:{s:5:"class";s:4:"text";s:4:"text";s:12:"EL_PROP_code";s:6:"escape";s:4:"true";}' ?><?php $attr7 = array('class'=>'text','text'=>'EL_PROP_code','escape'=>true) ?><?php $attr7_class='text' ?><?php $attr7_text='EL_PROP_code' ?><?php $attr7_escape=true ?><?php
	if	( isset($attr7_prefix)&& isset($attr7_key))
		$attr7_key = $attr7_prefix.$attr7_key;
	if	( isset($attr7_suffix)&& isset($attr7_key))
		$attr7_key = $attr7_key.$attr7_suffix;
	if(empty($attr7_title))
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
	if	( $attr7_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr7_array))
	{
		$tmpArray = $$attr7_array;
		if (!empty($attr7_var))
			$tmp_text = $tmpArray[$attr7_var];
		else
			$tmp_text = $langF($tmpArray[$attr7_text]);
	}
	elseif (!empty($attr7_text))
		$tmp_text = $langF($attr7_text);
	elseif (!empty($attr7_textvar))
		$tmp_text = $langF($$attr7_textvar);
	elseif (!empty($attr7_key))
		$tmp_text = $langF($attr7_key);
	elseif (!empty($attr7_var))
		$tmp_text = isset($$attr7_var)?$$attr7_var:'?unset:'.$attr7_var.'?';	
	elseif (!empty($attr7_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr7_raw);
	elseif (!empty($attr7_value))
		$tmp_text = $attr7_value;
	else
	  $tmp_text = '&nbsp;';
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
?></<?php echo $tmp_tag ?>><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_text) ?><?php unset($attr7_escape) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr6_debug_info = 'a:1:{s:5:"class";s:2:"fx";}' ?><?php $attr6 = array('class'=>'fx') ?><?php $attr6_class='fx' ?><?php
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
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr7_debug_info = 'a:5:{s:4:"name";s:4:"code";s:4:"rows";s:2:"35";s:4:"cols";s:2:"60";s:5:"class";s:0:"";s:7:"default";s:0:"";}' ?><?php $attr7 = array('name'=>'code','rows'=>'35','cols'=>'60','class'=>'','default'=>'') ?><?php $attr7_name='code' ?><?php $attr7_rows='35' ?><?php $attr7_cols='60' ?><?php $attr7_class='' ?><?php $attr7_default='' ?><?php if ($this->isEditable() && $this->getRequestVar('mode')!='edit') $attr7_readonly=true;
      if ( !$attr7_readonly) {
?><textarea <?php if ($attr7_readonly) echo ' disabled="true"' ?> class="<?php echo $attr7_class ?>" name="<?php echo $attr7_name ?>" rows="<?php echo $attr7_rows ?>" cols="<?php echo $attr7_cols ?>"><?php echo htmlentities(isset($$attr7_name)?$$attr7_name:$attr7_default) ?></textarea><?php
 } else {
?><span class="<?php echo $attr7_class ?>"><?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?></span><?php } ?><?php unset($attr7) ?><?php unset($attr7_name) ?><?php unset($attr7_rows) ?><?php unset($attr7_cols) ?><?php unset($attr7_class) ?><?php unset($attr7_default) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php } ?><?php unset($attr3) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?><?php
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
<?php unset($attr1) ?><?php $attr2_debug_info = 'a:1:{s:5:"field";s:4:"name";}' ?><?php $attr2 = array('field'=>'name') ?><?php $attr2_field='name' ?><?php
if (isset($errors[0])) $attr2_field = $errors[0];
?><script name="JavaScript" type="text/javascript"><!--
document.forms[0].<?php echo $attr2_field ?>.focus();
document.forms[0].<?php echo $attr2_field ?>.select();
</script>
<?php unset($attr2) ?><?php unset($attr2_field) ?><?php $attr0_debug_info = 'a:0:{}' ?><?php $attr0 = array() ?></body>
</html><?php unset($attr0) ?>