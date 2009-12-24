<?php  $attr1_class='main';  ?><?php
 if (!defined('OR_VERSION')) die('Forbidden');
 if (!headers_sent()) header('Content-Type: text/html; charset='.$charset)
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
  <title><?php echo isset($attr1_title)?$attr1_title.' - ':(isset($windowTitle)?langHtml($windowTitle).' - ':'') ?><?php echo $cms_title ?></title>
  <meta http-equiv="content-type" content="text/html; charset=<?php echo $charset ?>" >
<?php if ( isset($refresh_url) ) { ?>
  <meta http-equiv="refresh" content="<?php echo isset($refresh_timeout)?$refresh_timeout:0 ?>; URL=<?php echo $refresh_url ?>">
<?php } ?>
  <meta name="MSSmartTagsPreventParsing" content="true" >
  <meta name="robots" content="noindex,nofollow" >
<?php if (isset($windowMenu) && is_array($windowMenu)) foreach( $windowMenu as $menu )
      {
       	?>
  <link rel="section" href="<?php echo Html::url($actionName,@$menu['subaction'],$this->getRequestId() ) ?>" title="<?php echo lang($menu['text']) ?>" >
<?php
      }
?><?php if (isset($metaList) && is_array($metaList)) foreach( $metaList as $meta )
      {
       	?>
  <link rel="<?php echo $meta['name'] ?>" href="<?php echo $meta['url'] ?>" title="<?php echo $meta['title'] ?>" ><?php
      }
?><?php if(!empty($root_stylesheet)) { ?>
  <link rel="stylesheet" type="text/css" href="<?php echo $root_stylesheet ?>" >
<?php } ?>
<?php if($root_stylesheet!=$user_stylesheet) { ?>
  <link rel="stylesheet" type="text/css" href="<?php echo $user_stylesheet ?>" >
<?php } ?>
</head>
<body class="<?php echo $attr1_class ?>" <?php if (@$conf['interface']['application_mode']) { ?> style="padding:0px;margin:0px;"<?php } ?> >
<?php /* Debug-Information */ if ($showDuration) { echo "<!-- Output Variables are:\n";echo str_replace('-->','-- >',print_r($this->templateVars,true));echo "\n-->";} ?><?php unset($attr1_class); ?><?php  $attr2_name='';  $attr2_target='_self';  $attr2_method='post';  $attr2_enctype='application/x-www-form-urlencoded';  ?><?php
		$attr2_action = $actionName;
		$attr2_subaction = $targetSubActionName;
		$attr2_id = $this->getRequestId();
	if ($this->isEditable())
	{
		if	($this->isEditMode())
		{
			$attr2_method    = 'POST';
		}
		else
		{
			$attr2_method    = 'GET';
			$attr2_subaction = $subActionName;
		}
	}
?><form name="<?php echo $attr2_name ?>"
      target="<?php echo $attr2_target ?>"
      action="<?php echo Html::url( $attr2_action,$attr2_subaction,$attr2_id ) ?>"
      method="<?php echo $attr2_method ?>"
      enctype="<?php echo $attr2_enctype ?>" style="margin:0px;padding:0px;">
<?php if ($this->isEditable() && !$this->isEditMode()) { ?>
<input type="hidden" name="mode" value="edit" />
<?php } ?>
<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo $attr2_action ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo $attr2_subaction ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo $attr2_id ?>" /><?php
		if	( $conf['interface']['url_sessionid'] )
			echo '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";
?><?php unset($attr2_name);unset($attr2_target);unset($attr2_method);unset($attr2_enctype); ?><?php  $attr3_title='TEMPLATE_ELEMENTS';  $attr3_name='TEMPLATE_ELEMENTS';  $attr3_widths='30%,5%,65%';  $attr3_width='93%';  $attr3_rowclasses='odd,even';  $attr3_columnclasses='1,2,3';  ?><?php
	$coloumn_widths=array();
	$column_widths = explode(',',$attr3_widths);
	$row_classes   = explode(',',$attr3_rowclasses);
	$row_class_idx = 999;
	$column_classes = explode(',',$attr3_columnclasses);
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
  <?php if ($this->isEditMode()) { 
  ?><a href="<?php echo Html::url($actionName,$subActionName,$this->getRequestId()                       ) ?>" accesskey="1" title="<?php echo langHtml('MODE_EDIT_DESC') ?>" class="path" style="text-align:right;font-weight:bold;font-weight:bold;"><img src="<?php echo $image_dir ?>mode-edit.png" style="vertical-align:top; " border="0" /></a> <?php }
   elseif (readonly()) {
  ?><img src="<?php echo $image_dir ?>readonly.png" style="vertical-align:top; " border="0" /> <?php } else {
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
    <th colspan="2"><img src="<?php echo $image_dir.'icon_'.$notice['type'].IMG_ICON_EXT ?>" align="left" /><?php echo $notice['name'] ?>
    </th>
  </tr>
<?php } ?>
  <tr class="<?php echo $notice['status'] ?>">
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
    <td class="window">
      <table cellspacing="0" width="100%" cellpadding="4">
<?php unset($attr3_title);unset($attr3_name);unset($attr3_widths);unset($attr3_width);unset($attr3_rowclasses);unset($attr3_columnclasses); ?><?php  $attr4_empty='el';  ?><?php 
	if	( !isset($$attr4_empty) )
		$attr4_tmp_exec = empty($attr4_empty);
	elseif	( is_array($$attr4_empty) )
		$attr4_tmp_exec = (count($$attr4_empty)==0);
	elseif	( is_bool($$attr4_empty) )
		$attr4_tmp_exec = true;
	else
		$attr4_tmp_exec = empty( $$attr4_empty );
	$attr4_tmp_last_exec = $attr4_tmp_exec;
	if	( $attr4_tmp_exec )
	{
?>
<?php unset($attr4_empty); ?><?php  ?><?php
	$attr5_tmp_class='';
	$attr5_last_class = $attr5_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr5_tmp_class));
?><?php  ?><?php  $attr6_colspan='4';  ?><?php
	if( isset($column_class_idx) )
	{
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
		$column_class=$column_classes[$column_class_idx-1];
		if (empty($attr6_class))
			$attr6_class=$column_class;
	}
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr6_rowspan) )
		$attr6_width=$column_widths[$cell_column_nr-1];
?><td<?php
?> colspan="<?php echo $attr6_colspan ?>" <?php
?>><?php unset($attr6_colspan); ?><?php  $attr7_class='text';  $attr7_text='GLOBAL_NOT_FOUND';  $attr7_escape=true;  ?><?php
		$attr7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr7_class ?>" title="<?php echo $attr7_title ?>"><?php
		$langF = $attr7_escape?'langHtml':'lang';
		$tmp_text = $langF($attr7_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr7_class);unset($attr7_text);unset($attr7_escape); ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php } ?><?php  ?><?php  $attr4_not='';  $attr4_empty='el';  ?><?php 
	if	( !isset($$attr4_empty) )
		$attr4_tmp_exec = empty($attr4_empty);
	elseif	( is_array($$attr4_empty) )
		$attr4_tmp_exec = (count($$attr4_empty)==0);
	elseif	( is_bool($$attr4_empty) )
		$attr4_tmp_exec = true;
	else
		$attr4_tmp_exec = empty( $$attr4_empty );
	$attr4_tmp_exec = !$attr4_tmp_exec;
	$attr4_tmp_last_exec = $attr4_tmp_exec;
	if	( $attr4_tmp_exec )
	{
?>
<?php unset($attr4_not);unset($attr4_empty); ?><?php  ?><?php
	$attr5_tmp_class='';
	$attr5_last_class = $attr5_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr5_tmp_class));
?><?php  ?><?php  $attr6_class='help';  ?><?php
	if( isset($column_class_idx) )
	{
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
		$column_class=$column_classes[$column_class_idx-1];
		if (empty($attr6_class))
			$attr6_class=$column_class;
	}
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr6_rowspan) )
		$attr6_width=$column_widths[$cell_column_nr-1];
?><td<?php
?> class="<?php   echo $attr6_class   ?>" <?php
?>><?php unset($attr6_class); ?><?php  $attr7_class='text';  $attr7_text='PAGE_ELEMENT_NAME';  $attr7_escape=true;  ?><?php
		$attr7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr7_class ?>" title="<?php echo $attr7_title ?>"><?php
		$langF = $attr7_escape?'langHtml':'lang';
		$tmp_text = $langF($attr7_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr7_class);unset($attr7_text);unset($attr7_escape); ?><?php  ?></td><?php  ?><?php  $attr6_class='help';  ?><?php
	if( isset($column_class_idx) )
	{
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
		$column_class=$column_classes[$column_class_idx-1];
		if (empty($attr6_class))
			$attr6_class=$column_class;
	}
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr6_rowspan) )
		$attr6_width=$column_widths[$cell_column_nr-1];
?><td<?php
?> class="<?php   echo $attr6_class   ?>" <?php
?>><?php unset($attr6_class); ?><?php  $attr7_class='text';  $attr7_text='GLOBAL_CHANGE';  $attr7_escape=true;  ?><?php
		$attr7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr7_class ?>" title="<?php echo $attr7_title ?>"><?php
		$langF = $attr7_escape?'langHtml':'lang';
		$tmp_text = $langF($attr7_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr7_class);unset($attr7_text);unset($attr7_escape); ?><?php  ?></td><?php  ?><?php  $attr6_class='help';  ?><?php
	if( isset($column_class_idx) )
	{
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
		$column_class=$column_classes[$column_class_idx-1];
		if (empty($attr6_class))
			$attr6_class=$column_class;
	}
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr6_rowspan) )
		$attr6_width=$column_widths[$cell_column_nr-1];
?><td<?php
?> class="<?php   echo $attr6_class   ?>" <?php
?>><?php unset($attr6_class); ?><?php  $attr7_class='text';  $attr7_text='GLOBAL_VALUE';  $attr7_escape=true;  ?><?php
		$attr7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr7_class ?>" title="<?php echo $attr7_title ?>"><?php
		$langF = $attr7_escape?'langHtml':'lang';
		$tmp_text = $langF($attr7_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr7_class);unset($attr7_text);unset($attr7_escape); ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  $attr5_list='el';  $attr5_extract=true;  $attr5_key='list_key';  $attr5_value='list_value';  ?><?php
	$attr5_list_tmp_key   = $attr5_key;
	$attr5_list_tmp_value = $attr5_value;
	$attr5_list_extract   = $attr5_extract;
	unset($attr5_key);
	unset($attr5_value);
	if	( !isset($$attr5_list) || !is_array($$attr5_list) )
		$$attr5_list = array();
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
?><?php unset($attr5_list);unset($attr5_extract);unset($attr5_key);unset($attr5_value); ?><?php  $attr6_class='data';  ?><?php
	$attr6_tmp_class='';
	$attr6_tmp_class=$attr6_class;
	$attr6_last_class = $attr6_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr6_tmp_class));
?><?php unset($attr6_class); ?><?php  ?><?php
	if( isset($column_class_idx) )
	{
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
		$column_class=$column_classes[$column_class_idx-1];
		if (empty($attr7_class))
			$attr7_class=$column_class;
	}
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr7_rowspan) )
		$attr7_width=$column_widths[$cell_column_nr-1];
?><td<?php
?>><?php  ?><?php  $attr8_for=$saveid;  ?><label for="id_<?php echo $attr8_for ?><?php if (!empty($attr8_value)) echo '_'.$attr8_value ?>"><?php unset($attr8_for); ?><?php  $attr9_align='left';  $attr9_elementtype=$type;  ?><?php
	$attr9_tmp_image_file = $image_dir.'icon_el_'.$attr9_elementtype.IMG_ICON_EXT;
	$attr9_size           = '16x16';
	$attr9_tmp_title = basename($attr9_tmp_image_file);
?><img alt="<?php echo $attr9_tmp_title; if (isset($attr9_size)) { echo ' ('; list($attr9_tmp_width,$attr9_tmp_height)=explode('x',$attr9_size);echo $attr9_tmp_width.'x'.$attr9_tmp_height; echo')';} ?>" src="<?php echo $attr9_tmp_image_file ?>" border="0"<?php if(isset($attr9_align)) echo ' align="'.$attr9_align.'"' ?><?php if (isset($attr9_size)) { list($attr9_tmp_width,$attr9_tmp_height)=explode('x',$attr9_size);echo ' width="'.$attr9_tmp_width.'" height="'.$attr9_tmp_height.'"';} ?>><?php unset($attr9_align);unset($attr9_elementtype); ?><?php  $attr9_class='text';  $attr9_var='name';  $attr9_escape=true;  ?><?php
		$attr9_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr9_class ?>" title="<?php echo $attr9_title ?>"><?php
		$langF = $attr9_escape?'langHtml':'lang';
		$tmp_text = isset($$attr9_var)?$$attr9_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr9_class);unset($attr9_var);unset($attr9_escape); ?><?php  ?></label><?php  ?><?php  ?></td><?php  ?><?php  ?><?php
	if( isset($column_class_idx) )
	{
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
		$column_class=$column_classes[$column_class_idx-1];
		if (empty($attr7_class))
			$attr7_class=$column_class;
	}
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr7_rowspan) )
		$attr7_width=$column_widths[$cell_column_nr-1];
?><td<?php
?>><?php  ?><?php  $attr8_default=false;  $attr8_readonly=false;  $attr8_name=$saveid;  ?><?php
	if ($this->isEditable() && !$this->isEditMode()) $attr8_readonly=true;
	if	( isset($$attr8_name) )
		$checked = $$attr8_name;
	else
		$checked = $attr8_default;
?><input class="checkbox" type="checkbox" id="id_<?php echo $attr8_name ?>" name="<?php echo $attr8_name  ?>"  <?php if ($attr8_readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?><?php if (in_array($attr8_name,$errors)) echo ' style="background-color:red;"' ?> /><?php
if ( $attr8_readonly && $checked )
{ 
?><input type="hidden" name="<?php echo $attr8_name ?>" value="1" /><?php
}
?><?php unset($attr8_name); unset($attr8_readonly); unset($attr8_default); ?><?php unset($attr8_default);unset($attr8_readonly);unset($attr8_name); ?><?php  ?></td><?php  ?><?php  ?><?php
	if( isset($column_class_idx) )
	{
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
		$column_class=$column_classes[$column_class_idx-1];
		if (empty($attr7_class))
			$attr7_class=$column_class;
	}
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr7_rowspan) )
		$attr7_width=$column_widths[$cell_column_nr-1];
?><td<?php
?>><?php  ?><?php  $attr8_value=$type;  $attr8_contains='text,date,number';  ?><?php 
	$attr8_tmp_exec = in_array($attr8_value,explode(',',$attr8_contains));
	$attr8_tmp_last_exec = $attr8_tmp_exec;
	if	( $attr8_tmp_exec )
	{
?>
<?php unset($attr8_value);unset($attr8_contains); ?><?php  $attr9_class='text';  $attr9_default=$value;  $attr9_type='text';  $attr9_index=true;  $attr9_name=$id;  $attr9_size='40';  $attr9_maxlength='255';  $attr9_onchange='onchange';  $attr9_readonly=false;  ?><?php if ($this->isEditable() && !$this->isEditMode()) $attr9_readonly=true;
	  if ($attr9_readonly && empty($$attr9_name)) $$attr9_name = '- '.lang('EMPTY').' -';
      if(!isset($attr9_default)) $attr9_default='';
?><?php if (!$attr9_readonly || $attr9_type=='hidden') {
?><input<?php if ($attr9_readonly) echo ' disabled="true"' ?> id="id_<?php echo $attr9_name ?><?php if ($attr9_readonly) echo '_disabled' ?>" name="<?php echo $attr9_name ?><?php if ($attr9_readonly) echo '_disabled' ?>" type="<?php echo $attr9_type ?>" size="<?php echo $attr9_size ?>" maxlength="<?php echo $attr9_maxlength ?>" class="<?php echo $attr9_class ?>" value="<?php echo isset($$attr9_name)?$$attr9_name:$attr9_default ?>" <?php if (in_array($attr9_name,$errors)) echo 'style="border-rightx:10px solid red; background-colorx:yellow; border:2px dashed red;"' ?> /><?php
if	($attr9_readonly) {
?><input type="hidden" id="id_<?php echo $attr9_name ?>" name="<?php echo $attr9_name ?>" value="<?php echo isset($$attr9_name)?$$attr9_name:$attr9_default ?>" /><?php
 } } else { ?><span class="<?php echo $attr9_class ?>"><?php echo isset($$attr9_name)?$$attr9_name:$attr9_default ?></span><?php } ?><?php unset($attr9_class);unset($attr9_default);unset($attr9_type);unset($attr9_index);unset($attr9_name);unset($attr9_size);unset($attr9_maxlength);unset($attr9_onchange);unset($attr9_readonly); ?><?php  ?><?php } ?><?php  ?><?php  $attr8_equals='longtext';  $attr8_value=$type;  ?><?php 
	$attr8_tmp_exec = $attr8_equals == $attr8_value;
	$attr8_tmp_last_exec = $attr8_tmp_exec;
	if	( $attr8_tmp_exec )
	{
?>
<?php unset($attr8_equals);unset($attr8_value); ?><?php  $attr9_name=$id;  $attr9_rows='7';  $attr9_cols='50';  $attr9_index=true;  $attr9_onchange='onchange';  $attr9_class='inputarea';  $attr9_default=$value;  ?><?php if ($this->isEditable() && !$this->isEditMode()) $attr9_readonly=true;
      if ( !$attr9_readonly) {
?><textarea <?php if ($attr9_readonly) echo ' disabled="true"' ?> class="<?php echo $attr9_class ?>" name="<?php echo $attr9_name ?>" rows="<?php echo $attr9_rows ?>" cols="<?php echo $attr9_cols ?>"><?php echo htmlentities(isset($$attr9_name)?$$attr9_name:$attr9_default) ?></textarea><?php
 } else {
?><span class="<?php echo $attr9_class ?>"><?php echo isset($$attr9_name)?$$attr9_name:$attr9_default ?></span><?php } ?><?php unset($attr9_name);unset($attr9_rows);unset($attr9_cols);unset($attr9_index);unset($attr9_onchange);unset($attr9_class);unset($attr9_default); ?><?php  ?><?php } ?><?php  ?><?php  $attr8_value=$type;  $attr8_contains='select,link,list';  ?><?php 
	$attr8_tmp_exec = in_array($attr8_value,explode(',',$attr8_contains));
	$attr8_tmp_last_exec = $attr8_tmp_exec;
	if	( $attr8_tmp_exec )
	{
?>
<?php unset($attr8_value);unset($attr8_contains); ?><?php  $attr9_list='list';  $attr9_name=$id;  $attr9_default=$value;  $attr9_onchange='';  $attr9_title='';  $attr9_class='';  $attr9_addempty=false;  $attr9_multiple=false;  $attr9_size='1';  $attr9_lang=false;  ?><?php
$attr9_readonly=false;
$attr9_tmp_list = $$attr9_list;
if ($this->isEditable() && !$this->isEditMode())
{
	echo empty($$attr9_name)?'- '.lang('EMPTY').' -':$attr9_tmp_list[$$attr9_name];
}
else
{
if ( $attr9_addempty!==FALSE  )
{
	if ($attr9_addempty===TRUE)
		$attr9_tmp_list = array(''=>lang('LIST_ENTRY_EMPTY'))+$attr9_tmp_list;
	else
		$attr9_tmp_list = array(''=>'- '.lang($attr9_addempty).' -')+$attr9_tmp_list;
}
?><select<?php if ($attr9_readonly) echo ' disabled="disabled"' ?> id="id_<?php echo $attr9_name ?>"  name="<?php echo $attr9_name; if ($attr9_multiple) echo '[]'; ?>" onchange="<?php echo $attr9_onchange ?>" title="<?php echo $attr9_title ?>" class="<?php echo $attr9_class ?>"<?php
if (count($$attr9_list)<=1) echo ' disabled="disabled"';
if	($attr9_multiple) echo ' multiple="multiple"';
if (in_array($attr9_name,$errors)) echo ' style="background-color:red; border:2px dashed red;"';
echo ' size="'.intval($attr9_size).'"';
?>><?php
		if	( isset($$attr9_name) && isset($attr9_tmp_list[$$attr9_name]) )
			$attr9_tmp_default = $$attr9_name;
		elseif ( isset($attr9_default) )
			$attr9_tmp_default = $attr9_default;
		else
			$attr9_tmp_default = '';
		foreach( $attr9_tmp_list as $box_key=>$box_value )
		{
			if	( is_array($box_value) )
			{
				$box_key   = $box_value['key'  ];
				$box_title = $box_value['title'];
				$box_value = $box_value['value'];
			}
			elseif( $attr9_lang )
			{
				$box_title = lang( $box_value.'_DESC');
				$box_value = lang( $box_value        );
			}
			else
			{
				$box_title = '';
			}
			echo '<option class="'.$attr9_class.'" value="'.$box_key.'" title="'.$box_title.'"';
			if ((string)$box_key==$attr9_tmp_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select><?php
if (count($$attr9_list)==0) echo '<input type="hidden" name="'.$attr9_name.'" value="" />';
if (count($$attr9_list)==1) echo '<input type="hidden" name="'.$attr9_name.'" value="'.$box_key.'" />';
}
?><?php unset($attr9_list);unset($attr9_name);unset($attr9_default);unset($attr9_onchange);unset($attr9_title);unset($attr9_class);unset($attr9_addempty);unset($attr9_multiple);unset($attr9_size);unset($attr9_lang); ?><?php  ?><?php } ?><?php  ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php } ?><?php  ?><?php  $attr5_present='release';  ?><?php 
	$attr5_tmp_exec = isset($$attr5_present);
	$attr5_tmp_last_exec = $attr5_tmp_exec;
	if	( $attr5_tmp_exec )
	{
?>
<?php unset($attr5_present); ?><?php  $attr6_present='publish';  ?><?php 
	$attr6_tmp_exec = isset($$attr6_present);
	$attr6_tmp_last_exec = $attr6_tmp_exec;
	if	( $attr6_tmp_exec )
	{
?>
<?php unset($attr6_present); ?><?php  ?><?php
	$attr7_tmp_class='';
	$attr7_last_class = $attr7_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr7_tmp_class));
?><?php  ?><?php  $attr8_colspan='3';  ?><?php
	if( isset($column_class_idx) )
	{
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
		$column_class=$column_classes[$column_class_idx-1];
		if (empty($attr8_class))
			$attr8_class=$column_class;
	}
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr8_rowspan) )
		$attr8_width=$column_widths[$cell_column_nr-1];
?><td<?php
?> colspan="<?php echo $attr8_colspan ?>" <?php
?>><?php unset($attr8_colspan); ?><?php  $attr9_title=lang('options');  ?><fieldset><?php if(isset($attr9_title)) { ?><legend><?php echo encodeHtml($attr9_title) ?></legend><?php } ?><?php unset($attr9_title); ?><?php  ?></fieldset><?php  ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php } ?><?php  ?><?php  ?><?php } ?><?php  ?><?php  $attr5_present='release';  ?><?php 
	$attr5_tmp_exec = isset($$attr5_present);
	$attr5_tmp_last_exec = $attr5_tmp_exec;
	if	( $attr5_tmp_exec )
	{
?>
<?php unset($attr5_present); ?><?php  ?><?php
	$attr6_tmp_class='';
	$attr6_last_class = $attr6_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr6_tmp_class));
?><?php  ?><?php  $attr7_colspan='3';  ?><?php
	if( isset($column_class_idx) )
	{
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
		$column_class=$column_classes[$column_class_idx-1];
		if (empty($attr7_class))
			$attr7_class=$column_class;
	}
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr7_rowspan) )
		$attr7_width=$column_widths[$cell_column_nr-1];
?><td<?php
?> colspan="<?php echo $attr7_colspan ?>" <?php
?>><?php unset($attr7_colspan); ?><?php  $attr8_default=false;  $attr8_readonly=false;  $attr8_name='release';  ?><?php
	if ($this->isEditable() && !$this->isEditMode()) $attr8_readonly=true;
	if	( isset($$attr8_name) )
		$checked = $$attr8_name;
	else
		$checked = $attr8_default;
?><input class="checkbox" type="checkbox" id="id_<?php echo $attr8_name ?>" name="<?php echo $attr8_name  ?>"  <?php if ($attr8_readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?><?php if (in_array($attr8_name,$errors)) echo ' style="background-color:red;"' ?> /><?php
if ( $attr8_readonly && $checked )
{ 
?><input type="hidden" name="<?php echo $attr8_name ?>" value="1" /><?php
}
?><?php unset($attr8_name); unset($attr8_readonly); unset($attr8_default); ?><?php unset($attr8_default);unset($attr8_readonly);unset($attr8_name); ?><?php  $attr8_for='release';  ?><label for="id_<?php echo $attr8_for ?><?php if (!empty($attr8_value)) echo '_'.$attr8_value ?>"><?php unset($attr8_for); ?><?php  $attr9_class='text';  $attr9_raw='_';  $attr9_escape=true;  ?><?php
		$attr9_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr9_class ?>" title="<?php echo $attr9_title ?>"><?php
		$langF = $attr9_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$attr9_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr9_class);unset($attr9_raw);unset($attr9_escape); ?><?php  $attr9_class='text';  $attr9_text='GLOBAL_RELEASE';  $attr9_escape=true;  ?><?php
		$attr9_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr9_class ?>" title="<?php echo $attr9_title ?>"><?php
		$langF = $attr9_escape?'langHtml':'lang';
		$tmp_text = $langF($attr9_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr9_class);unset($attr9_text);unset($attr9_escape); ?><?php  ?></label><?php  ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php } ?><?php  ?><?php  $attr5_present='publish';  ?><?php 
	$attr5_tmp_exec = isset($$attr5_present);
	$attr5_tmp_last_exec = $attr5_tmp_exec;
	if	( $attr5_tmp_exec )
	{
?>
<?php unset($attr5_present); ?><?php  ?><?php
	$attr6_tmp_class='';
	$attr6_last_class = $attr6_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr6_tmp_class));
?><?php  ?><?php  $attr7_colspan='3';  ?><?php
	if( isset($column_class_idx) )
	{
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
		$column_class=$column_classes[$column_class_idx-1];
		if (empty($attr7_class))
			$attr7_class=$column_class;
	}
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr7_rowspan) )
		$attr7_width=$column_widths[$cell_column_nr-1];
?><td<?php
?> colspan="<?php echo $attr7_colspan ?>" <?php
?>><?php unset($attr7_colspan); ?><?php  $attr8_default=false;  $attr8_readonly=false;  $attr8_name='publish';  ?><?php
	if ($this->isEditable() && !$this->isEditMode()) $attr8_readonly=true;
	if	( isset($$attr8_name) )
		$checked = $$attr8_name;
	else
		$checked = $attr8_default;
?><input class="checkbox" type="checkbox" id="id_<?php echo $attr8_name ?>" name="<?php echo $attr8_name  ?>"  <?php if ($attr8_readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?><?php if (in_array($attr8_name,$errors)) echo ' style="background-color:red;"' ?> /><?php
if ( $attr8_readonly && $checked )
{ 
?><input type="hidden" name="<?php echo $attr8_name ?>" value="1" /><?php
}
?><?php unset($attr8_name); unset($attr8_readonly); unset($attr8_default); ?><?php unset($attr8_default);unset($attr8_readonly);unset($attr8_name); ?><?php  $attr8_for='publish';  ?><label for="id_<?php echo $attr8_for ?><?php if (!empty($attr8_value)) echo '_'.$attr8_value ?>"><?php unset($attr8_for); ?><?php  $attr9_class='text';  $attr9_raw='_';  $attr9_escape=true;  ?><?php
		$attr9_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr9_class ?>" title="<?php echo $attr9_title ?>"><?php
		$langF = $attr9_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$attr9_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr9_class);unset($attr9_raw);unset($attr9_escape); ?><?php  $attr9_class='text';  $attr9_text='PAGE_PUBLISH_AFTER_SAVE';  $attr9_escape=true;  ?><?php
		$attr9_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr9_class ?>" title="<?php echo $attr9_title ?>"><?php
		$langF = $attr9_escape?'langHtml':'lang';
		$tmp_text = $langF($attr9_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr9_class);unset($attr9_text);unset($attr9_escape); ?><?php  ?></label><?php  ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php } ?><?php  ?><?php  ?><?php
	$attr5_tmp_class='';
	$attr5_last_class = $attr5_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr5_tmp_class));
?><?php  ?><?php  $attr6_class='act';  $attr6_colspan='3';  ?><?php
	if( isset($column_class_idx) )
	{
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
		$column_class=$column_classes[$column_class_idx-1];
		if (empty($attr6_class))
			$attr6_class=$column_class;
	}
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr6_rowspan) )
		$attr6_width=$column_widths[$cell_column_nr-1];
?><td<?php
?> class="<?php   echo $attr6_class   ?>" <?php
?> colspan="<?php echo $attr6_colspan ?>" <?php
?>><?php unset($attr6_class);unset($attr6_colspan); ?><?php  $attr7_type='ok';  $attr7_class='ok';  $attr7_value='ok';  $attr7_text='button_ok';  ?><?php
		if ($this->isEditable() && !$this->isEditMode())
		$attr7_text = 'MODE_EDIT';
		$attr7_type = 'submit';
		if	( $this->isEditable() && readonly() )
			$attr7_type = ''; // Knopf nicht anzeigen
		$attr7_src  = '';
	if	( !empty($attr7_type) ) {
?><input type="<?php echo $attr7_type ?>"<?php if(isset($attr7_src)) { ?> src="<?php echo $image_dir.'icon_'.$attr7_src.IMG_ICON_EXT ?>"<?php } ?> name="<?php echo $attr7_value ?>" class="<?php echo $attr7_class ?>" title="<?php echo lang($attr7_text.'_DESC') ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo langHtml($attr7_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($attr7_src)
?><?php } 
?><?php unset($attr7_type);unset($attr7_class);unset($attr7_value);unset($attr7_text); ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php } ?><?php  ?><?php  ?>      </table>
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
<?php  ?><?php  ?></form>
<?php  ?><?php  ?></body>
</html><?php  ?>