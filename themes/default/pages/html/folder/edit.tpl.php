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
<?php /* Debug-Information */ if ($showDuration) { echo "<!-- Output Variables are:\n";echo str_replace('-->','-- >',print_r($this->templateVars,true));echo "\n-->";} ?><?php unset($attr1_class); ?><?php  $attr2_action='folder';  $attr2_subaction='multiple';  $attr2_name='';  $attr2_target='_self';  $attr2_method='post';  $attr2_enctype='application/x-www-form-urlencoded';  ?><?php
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
?><?php unset($attr2_action);unset($attr2_subaction);unset($attr2_name);unset($attr2_target);unset($attr2_method);unset($attr2_enctype); ?><?php  $attr3_name='ids';  ?><?php
if (isset($$attr3_name))
	$attr3_tmp_value = $$attr3_name;
elseif ( isset($attr3_default) )
	$attr3_tmp_value = $attr3_default;
else
	$attr3_tmp_value = "";
?><input type="hidden" name="<?php echo $attr3_name ?>" value="<?php echo $attr3_tmp_value ?>" /><?php unset($attr3_name); ?><?php  $attr3_name='type';  ?><?php
if (isset($$attr3_name))
	$attr3_tmp_value = $$attr3_name;
elseif ( isset($attr3_default) )
	$attr3_tmp_value = $attr3_default;
else
	$attr3_tmp_value = "";
?><input type="hidden" name="<?php echo $attr3_name ?>" value="<?php echo $attr3_tmp_value ?>" /><?php unset($attr3_name); ?><?php  $attr3_title='titelso';  $attr3_name='bla';  $attr3_widths='5%,75%';  $attr3_width='93%';  $attr3_rowclasses='odd,even';  $attr3_columnclasses='1,2,3';  ?><?php
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
<?php unset($attr3_title);unset($attr3_name);unset($attr3_widths);unset($attr3_width);unset($attr3_rowclasses);unset($attr3_columnclasses); ?><?php  ?><?php
	$attr4_tmp_class='';
	$attr4_last_class = $attr4_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr4_tmp_class));
?><?php  ?><?php  $attr5_class='help';  ?><?php
	if( isset($column_class_idx) )
	{
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
		$column_class=$column_classes[$column_class_idx-1];
		if (empty($attr5_class))
			$attr5_class=$column_class;
	}
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr5_rowspan) )
		$attr5_width=$column_widths[$cell_column_nr-1];
?><td<?php
?> class="<?php   echo $attr5_class   ?>" <?php
?>><?php unset($attr5_class); ?><?php  $attr6_class='text';  $attr6_raw='_';  $attr6_escape=true;  ?><?php
		$attr6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
		$langF = $attr6_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$attr6_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_raw);unset($attr6_escape); ?><?php  ?></td><?php  ?><?php  $attr5_class='help';  ?><?php
	if( isset($column_class_idx) )
	{
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
		$column_class=$column_classes[$column_class_idx-1];
		if (empty($attr5_class))
			$attr5_class=$column_class;
	}
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr5_rowspan) )
		$attr5_width=$column_widths[$cell_column_nr-1];
?><td<?php
?> class="<?php   echo $attr5_class   ?>" <?php
?>><?php unset($attr5_class); ?><?php  $attr6_class='text';  $attr6_text='GLOBAL_NAME';  $attr6_escape=true;  ?><?php
		$attr6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
		$langF = $attr6_escape?'langHtml':'lang';
		$tmp_text = $langF($attr6_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_text);unset($attr6_escape); ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  $attr4_list='objectlist';  $attr4_extract=true;  $attr4_key='list_key';  $attr4_value='list_value';  ?><?php
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
?><?php unset($attr4_list);unset($attr4_extract);unset($attr4_key);unset($attr4_value); ?><?php  ?><?php
	$attr5_tmp_class='';
	$attr5_last_class = $attr5_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr5_tmp_class));
?><?php  ?><?php  ?><?php
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
?>><?php  ?><?php  $attr7_icon=$type;  $attr7_align='left';  ?><?php
	$attr7_tmp_image_file = $image_dir.'icon_'.$attr7_icon.IMG_ICON_EXT;
	$attr7_size = '16x16';
	$attr7_tmp_title = basename($attr7_tmp_image_file);
?><img alt="<?php echo $attr7_tmp_title; if (isset($attr7_size)) { echo ' ('; list($attr7_tmp_width,$attr7_tmp_height)=explode('x',$attr7_size);echo $attr7_tmp_width.'x'.$attr7_tmp_height; echo')';} ?>" src="<?php echo $attr7_tmp_image_file ?>" border="0"<?php if(isset($attr7_align)) echo ' align="'.$attr7_align.'"' ?><?php if (isset($attr7_size)) { list($attr7_tmp_width,$attr7_tmp_height)=explode('x',$attr7_size);echo ' width="'.$attr7_tmp_width.'" height="'.$attr7_tmp_height.'"';} ?>><?php unset($attr7_icon);unset($attr7_align); ?><?php  ?></td><?php  ?><?php  ?><?php
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
?>><?php  ?><?php  $attr7_class='text';  $attr7_var='name';  $attr7_escape=true;  ?><?php
		$attr7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr7_class ?>" title="<?php echo $attr7_title ?>"><?php
		$langF = $attr7_escape?'langHtml':'lang';
		$tmp_text = isset($$attr7_var)?$$attr7_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr7_class);unset($attr7_var);unset($attr7_escape); ?><?php  $attr7_class='text';  $attr7_raw='_';  $attr7_escape=true;  ?><?php
		$attr7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr7_class ?>" title="<?php echo $attr7_title ?>"><?php
		$langF = $attr7_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$attr7_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr7_class);unset($attr7_raw);unset($attr7_escape); ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php } ?><?php  ?><?php  $attr4_present='folder';  ?><?php 
	$attr4_tmp_exec = isset($$attr4_present);
	$attr4_tmp_last_exec = $attr4_tmp_exec;
	if	( $attr4_tmp_exec )
	{
?>
<?php unset($attr4_present); ?><?php  ?><?php
	$attr5_tmp_class='';
	$attr5_last_class = $attr5_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr5_tmp_class));
?><?php  ?><?php  $attr6_colspan='2';  ?><?php
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
?>><?php unset($attr6_colspan); ?><?php  $attr7_class='text';  $attr7_key='folder_select_target_folder';  $attr7_escape=true;  ?><?php
		$attr7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr7_class ?>" title="<?php echo $attr7_title ?>"><?php
		$langF = $attr7_escape?'langHtml':'lang';
		$tmp_text = $langF($attr7_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr7_class);unset($attr7_key);unset($attr7_escape); ?><?php  $attr7_class='text';  $attr7_raw='_';  $attr7_escape=true;  ?><?php
		$attr7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr7_class ?>" title="<?php echo $attr7_title ?>"><?php
		$langF = $attr7_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$attr7_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr7_class);unset($attr7_raw);unset($attr7_escape); ?><?php  $attr7_list='folder';  $attr7_name='targetobjectid';  $attr7_onchange='';  $attr7_title='';  $attr7_class='';  $attr7_addempty=false;  $attr7_multiple=false;  $attr7_size='1';  $attr7_lang=false;  ?><?php
$attr7_readonly=false;
$attr7_tmp_list = $$attr7_list;
if ($this->isEditable() && !$this->isEditMode())
{
	echo empty($$attr7_name)?'- '.lang('EMPTY').' -':$attr7_tmp_list[$$attr7_name];
}
else
{
if ( $attr7_addempty!==FALSE  )
{
	if ($attr7_addempty===TRUE)
		$attr7_tmp_list = array(''=>lang('LIST_ENTRY_EMPTY'))+$attr7_tmp_list;
	else
		$attr7_tmp_list = array(''=>'- '.lang($attr7_addempty).' -')+$attr7_tmp_list;
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
			if ((string)$box_key==$attr7_tmp_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select><?php
if (count($$attr7_list)==0) echo '<input type="hidden" name="'.$attr7_name.'" value="" />';
if (count($$attr7_list)==1) echo '<input type="hidden" name="'.$attr7_name.'" value="'.$box_key.'" />';
}
?><?php unset($attr7_list);unset($attr7_name);unset($attr7_onchange);unset($attr7_title);unset($attr7_class);unset($attr7_addempty);unset($attr7_multiple);unset($attr7_size);unset($attr7_lang); ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php } ?><?php  ?><?php  $attr4_present='ask_filename';  ?><?php 
	$attr4_tmp_exec = isset($$attr4_present);
	$attr4_tmp_last_exec = $attr4_tmp_exec;
	if	( $attr4_tmp_exec )
	{
?>
<?php unset($attr4_present); ?><?php  ?><?php
	$attr5_tmp_class='';
	$attr5_last_class = $attr5_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr5_tmp_class));
?><?php  ?><?php  $attr6_colspan='2';  ?><?php
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
?>><?php unset($attr6_colspan); ?><?php  $attr7_class='text';  $attr7_default='';  $attr7_type='text';  $attr7_name='filename';  $attr7_size='40';  $attr7_maxlength='256';  $attr7_onchange='';  $attr7_readonly=false;  ?><?php if ($this->isEditable() && !$this->isEditMode()) $attr7_readonly=true;
	  if ($attr7_readonly && empty($$attr7_name)) $$attr7_name = '- '.lang('EMPTY').' -';
      if(!isset($attr7_default)) $attr7_default='';
?><?php if (!$attr7_readonly || $attr7_type=='hidden') {
?><input<?php if ($attr7_readonly) echo ' disabled="true"' ?> id="id_<?php echo $attr7_name ?><?php if ($attr7_readonly) echo '_disabled' ?>" name="<?php echo $attr7_name ?><?php if ($attr7_readonly) echo '_disabled' ?>" type="<?php echo $attr7_type ?>" size="<?php echo $attr7_size ?>" maxlength="<?php echo $attr7_maxlength ?>" class="<?php echo $attr7_class ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" <?php if (in_array($attr7_name,$errors)) echo 'style="border-rightx:10px solid red; background-colorx:yellow; border:2px dashed red;"' ?> /><?php
if	($attr7_readonly) {
?><input type="hidden" id="id_<?php echo $attr7_name ?>" name="<?php echo $attr7_name ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" /><?php
 } } else { ?><span class="<?php echo $attr7_class ?>"><?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?></span><?php } ?><?php unset($attr7_class);unset($attr7_default);unset($attr7_type);unset($attr7_name);unset($attr7_size);unset($attr7_maxlength);unset($attr7_onchange);unset($attr7_readonly); ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php } ?><?php  ?><?php  $attr4_present='ask_commit';  ?><?php 
	$attr4_tmp_exec = isset($$attr4_present);
	$attr4_tmp_last_exec = $attr4_tmp_exec;
	if	( $attr4_tmp_exec )
	{
?>
<?php unset($attr4_present); ?><?php  ?><?php
	$attr5_tmp_class='';
	$attr5_last_class = $attr5_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr5_tmp_class));
?><?php  ?><?php  $attr6_colspan='2';  ?><?php
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
?>><?php unset($attr6_colspan); ?><?php  $attr7_title=lang('options');  ?><fieldset><?php if(isset($attr7_title)) { ?><legend><?php echo encodeHtml($attr7_title) ?></legend><?php } ?><?php unset($attr7_title); ?><?php  ?></fieldset><?php  ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php
	$attr5_tmp_class='';
	$attr5_last_class = $attr5_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr5_tmp_class));
?><?php  ?><?php  $attr6_colspan='2';  ?><?php
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
?>><?php unset($attr6_colspan); ?><?php  $attr7_default=false;  $attr7_readonly=false;  $attr7_name='commit';  ?><?php
	if ($this->isEditable() && !$this->isEditMode()) $attr7_readonly=true;
	if	( isset($$attr7_name) )
		$checked = $$attr7_name;
	else
		$checked = $attr7_default;
?><input class="checkbox" type="checkbox" id="id_<?php echo $attr7_name ?>" name="<?php echo $attr7_name  ?>"  <?php if ($attr7_readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?><?php if (in_array($attr7_name,$errors)) echo ' style="background-color:red;"' ?> /><?php
if ( $attr7_readonly && $checked )
{ 
?><input type="hidden" name="<?php echo $attr7_name ?>" value="1" /><?php
}
?><?php unset($attr7_name); unset($attr7_readonly); unset($attr7_default); ?><?php unset($attr7_default);unset($attr7_readonly);unset($attr7_name); ?><?php  $attr7_for='commit';  ?><label for="id_<?php echo $attr7_for ?><?php if (!empty($attr7_value)) echo '_'.$attr7_value ?>"><?php unset($attr7_for); ?><?php  $attr8_class='text';  $attr8_raw='_';  $attr8_escape=true;  ?><?php
		$attr8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr8_class ?>" title="<?php echo $attr8_title ?>"><?php
		$langF = $attr8_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$attr8_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr8_class);unset($attr8_raw);unset($attr8_escape); ?><?php  $attr8_class='text';  $attr8_key='FOLDER_SELECT_DELETE_COMMIT';  $attr8_escape=true;  ?><?php
		$attr8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr8_class ?>" title="<?php echo $attr8_title ?>"><?php
		$langF = $attr8_escape?'langHtml':'lang';
		$tmp_text = $langF($attr8_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr8_class);unset($attr8_key);unset($attr8_escape); ?><?php  ?></label><?php  ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php } ?><?php  ?><?php  ?><?php
	$attr4_tmp_class='';
	$attr4_last_class = $attr4_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr4_tmp_class));
?><?php  ?><?php  $attr5_class='act';  $attr5_colspan='2';  ?><?php
	if( isset($column_class_idx) )
	{
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
		$column_class=$column_classes[$column_class_idx-1];
		if (empty($attr5_class))
			$attr5_class=$column_class;
	}
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr5_rowspan) )
		$attr5_width=$column_widths[$cell_column_nr-1];
?><td<?php
?> class="<?php   echo $attr5_class   ?>" <?php
?> colspan="<?php echo $attr5_colspan ?>" <?php
?>><?php unset($attr5_class);unset($attr5_colspan); ?><?php  $attr6_type='ok';  $attr6_class='ok';  $attr6_value='ok';  $attr6_text='button_ok';  ?><?php
		if ($this->isEditable() && !$this->isEditMode())
		$attr6_text = 'MODE_EDIT';
		$attr6_type = 'submit';
		if	( $this->isEditable() && readonly() )
			$attr6_type = ''; // Knopf nicht anzeigen
		$attr6_src  = '';
	if	( !empty($attr6_type) ) {
?><input type="<?php echo $attr6_type ?>"<?php if(isset($attr6_src)) { ?> src="<?php echo $image_dir.'icon_'.$attr6_src.IMG_ICON_EXT ?>"<?php } ?> name="<?php echo $attr6_value ?>" class="<?php echo $attr6_class ?>" title="<?php echo lang($attr6_text.'_DESC') ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo langHtml($attr6_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($attr6_src)
?><?php } 
?><?php unset($attr6_type);unset($attr6_class);unset($attr6_value);unset($attr6_text); ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?>      </table>
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
<?php  ?><?php  ?><?php  ?><?php  ?></body>
</html><?php  ?>