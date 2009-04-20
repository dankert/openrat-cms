<?php  $attr1_class='main';  ?><?php
 if (!headers_sent()) header('Content-Type: text/html; charset='.$charset)
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
  <title><?php echo isset($attr1_title)?$attr1_title.' - ':(isset($windowTitle)?lang($windowTitle).' - ':'') ?><?php echo $cms_title ?></title>
  <meta http-equiv="content-type" content="text/html; charset=<?php echo $charset ?>" >
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
  <link rel="<?php echo $meta['name'] ?>" href="<?php echo $meta['url'] ?>" title="<?php echo lang($meta['title']) ?>" ><?php
      }
?><?php if(!empty($root_stylesheet)) { ?>
  <link rel="stylesheet" type="text/css" href="<?php echo $root_stylesheet ?>" >
<?php } ?>
<?php if($root_stylesheet!=$user_stylesheet) { ?>
  <link rel="stylesheet" type="text/css" href="<?php echo $user_stylesheet ?>" >
<?php } ?>
</head>
<body class="<?php echo $attr1_class ?>" <?php if (@$conf['interface']['application_mode']) { ?> style="padding:0px;margin:0px;"<?php } ?> >
<?php unset($attr1_class); ?><?php  $attr2_action='folder';  $attr2_subaction='edit';  $attr2_name='';  $attr2_target='_self';  $attr2_method='post';  $attr2_enctype='application/x-www-form-urlencoded';  ?><?php
		$attr2_id = $this->getRequestId();
	if ($this->isEditable() && !$this->isEditMode())
		$attr2_subaction = $subActionName;
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
?><?php unset($attr2_action);unset($attr2_subaction);unset($attr2_name);unset($attr2_target);unset($attr2_method);unset($attr2_enctype); ?><?php  $attr3_title='titelso';  $attr3_name='bla';  $attr3_widths='5%,75%';  $attr3_width='93%';  $attr3_rowclasses='odd,even';  $attr3_columnclasses='1,2,3';  ?><?php
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
  <?php if ($this->isEditMode()) { 
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
    <td>
      <table cellspacing="0" width="100%" cellpadding="4">
<?php unset($attr3_title);unset($attr3_name);unset($attr3_widths);unset($attr3_width);unset($attr3_rowclasses);unset($attr3_columnclasses); ?><?php  ?><?php
	$attr4_tmp_class='';
	$attr4_last_class = $attr4_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr4_tmp_class));
?><?php  ?><?php  $attr5_class='help';  ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr5_class))
		$attr5_class=$column_class;
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
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_raw);unset($attr6_escape); ?><?php  ?></td><?php  ?><?php  $attr5_class='help';  ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr5_class))
		$attr5_class=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr5_rowspan) )
		$attr5_width=$column_widths[$cell_column_nr-1];
?><td<?php
?> class="<?php   echo $attr5_class   ?>" <?php
?>><?php unset($attr5_class); ?><?php  $attr6_class='text';  $attr6_text='GLOBAL_TYPE';  $attr6_escape=true;  ?><?php
		$attr6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
		$langF = $attr6_escape?'langHtml':'lang';
		$tmp_text = $langF($$attr6_textvar);
		$tmp_text = $langF($attr6_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_text);unset($attr6_escape); ?><?php  $attr6_class='text';  $attr6_raw='_/_';  $attr6_escape=true;  ?><?php
		$attr6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
		$langF = $attr6_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$attr6_raw);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_raw);unset($attr6_escape); ?><?php  $attr6_class='text';  $attr6_text='GLOBAL_NAME';  $attr6_escape=true;  ?><?php
		$attr6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
		$langF = $attr6_escape?'langHtml':'lang';
		$tmp_text = $langF($$attr6_textvar);
		$tmp_text = $langF($attr6_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_text);unset($attr6_escape); ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  $attr4_list='object';  $attr4_extract=true;  $attr4_key='list_key';  $attr4_value='list_value';  ?><?php
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
?><?php unset($attr4_list);unset($attr4_extract);unset($attr4_key);unset($attr4_value); ?><?php  $attr5_class='data';  ?><?php
	$attr5_tmp_class='';
	$attr5_tmp_class_list = explode(',',$attr5_classes);
	$last_pos = array_search($attr5_last_class,$attr5_tmp_class_list);
	if	( $last_pos === FALSE || $last_pos == count($attr5_tmp_class_list)-1)
		$attr5_tmp_class = $attr5_tmp_class_list[0];
	else
		$attr5_tmp_class = $attr5_tmp_class_list[++$last_pos];
	$attr5_tmp_class=$attr5_class;
	$attr5_last_class = $attr5_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr5_tmp_class));
?><?php unset($attr5_class); ?><?php  ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr6_class))
		$attr6_class=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr6_rowspan) )
		$attr6_width=$column_widths[$cell_column_nr-1];
?><td<?php
?>><?php  ?><?php  $attr7_true='writable';  ?><?php 
	if	(gettype($attr7_true) === '' && gettype($attr7_true) === '1')
		$attr7_tmp_exec = $$attr7_true == true;
	else
		$attr7_tmp_exec = $attr7_true == true;
	$attr7_tmp_last_exec = $attr7_tmp_exec;
	if	( $attr7_tmp_exec )
	{
?>
<?php unset($attr7_true); ?><?php  $attr8_default=false;  $attr8_readonly=false;  $attr8_name=$id;  ?><?php
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
?><?php unset($attr8_name); unset($attr8_readonly); unset($attr8_default); ?><?php unset($attr8_default);unset($attr8_readonly);unset($attr8_name); ?><?php  ?><?php } ?><?php  ?><?php  $attr7_false='writable';  ?><?php 
	if	(gettype($attr7_false) === '' && gettype($attr7_false) === '1')
		$attr7_tmp_exec = $$attr7_false == false;
	else
		$attr7_tmp_exec = $attr7_false == false;
	$attr7_tmp_last_exec = $attr7_tmp_exec;
	if	( $attr7_tmp_exec )
	{
?>
<?php unset($attr7_false); ?><?php  $attr8_class='text';  $attr8_raw='_';  $attr8_escape=true;  ?><?php
		$attr8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr8_class ?>" title="<?php echo $attr8_title ?>"><?php
		$langF = $attr8_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$attr8_raw);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr8_class);unset($attr8_raw);unset($attr8_escape); ?><?php  ?><?php } ?><?php  ?><?php  ?></td><?php  ?><?php  ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr6_class))
		$attr6_class=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr6_rowspan) )
		$attr6_width=$column_widths[$cell_column_nr-1];
?><td<?php
?>><?php  ?><?php  $attr7_for=$id;  ?><label for="id_<?php echo $attr7_for ?><?php if (!empty($attr7_value)) echo '_'.$attr7_value ?>"><?php unset($attr7_for); ?><?php  $attr8_align='left';  $attr8_type=$icon;  ?><?php
	$attr8_tmp_image_file = $image_dir.'icon_'.$attr8_type.IMG_ICON_EXT;
	$attr8_size = '16x16';
?><img alt="<?php echo basename($attr8_tmp_image_file); echo ' ('; if (isset($attr8_size)) { list($attr8_tmp_width,$attr8_tmp_height)=explode('x',$attr8_size);echo $attr8_tmp_width.'x'.$attr8_tmp_height; echo')';} ?>" src="<?php echo $attr8_tmp_image_file ?>" border="0"<?php if(isset($attr8_align)) echo ' align="'.$attr8_align.'"' ?><?php if (isset($attr8_size)) { list($attr8_tmp_width,$attr8_tmp_height)=explode('x',$attr8_size);echo ' width="'.$attr8_tmp_width.'" height="'.$attr8_tmp_height.'"';} ?>><?php unset($attr8_align);unset($attr8_type); ?><?php  $attr8_class='text';  $attr8_var='name';  $attr8_escape=true;  ?><?php
		$attr8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr8_class ?>" title="<?php echo $attr8_title ?>"><?php
		$langF = $attr8_escape?'langHtml':'lang';
		$tmp_text = isset($$attr8_var)?$$attr8_var:'?unset:'.$attr8_var.'?';
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr8_class);unset($attr8_var);unset($attr8_escape); ?><?php  $attr8_class='text';  $attr8_raw='_';  $attr8_escape=true;  ?><?php
		$attr8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr8_class ?>" title="<?php echo $attr8_title ?>"><?php
		$langF = $attr8_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$attr8_raw);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr8_class);unset($attr8_raw);unset($attr8_escape); ?><?php  ?></label><?php  ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php } ?><?php  ?><?php  ?><?php
	$attr4_tmp_class='';
	$attr4_last_class = $attr4_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr4_tmp_class));
?><?php  ?><?php  $attr5_colspan='2';  ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr5_class))
		$attr5_class=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr5_rowspan) )
		$attr5_width=$column_widths[$cell_column_nr-1];
?><td<?php
?> colspan="<?php echo $attr5_colspan ?>" <?php
?>><?php unset($attr5_colspan); ?><?php  $attr6_align='left';  $attr6_fileext='tree_none_end.gif';  ?><?php
	$attr6_tmp_image_file = $image_dir.$attr6_fileext;
?><img alt="<?php echo basename($attr6_tmp_image_file); echo ' ('; if (isset($attr6_size)) { list($attr6_tmp_width,$attr6_tmp_height)=explode('x',$attr6_size);echo $attr6_tmp_width.'x'.$attr6_tmp_height; echo')';} ?>" src="<?php echo $attr6_tmp_image_file ?>" border="0"<?php if(isset($attr6_align)) echo ' align="'.$attr6_align.'"' ?><?php if (isset($attr6_size)) { list($attr6_tmp_width,$attr6_tmp_height)=explode('x',$attr6_size);echo ' width="'.$attr6_tmp_width.'" height="'.$attr6_tmp_height.'"';} ?>><?php unset($attr6_align);unset($attr6_fileext); ?><?php  $attr6_class='text';  $attr6_raw='_';  $attr6_escape=true;  ?><?php
		$attr6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
		$langF = $attr6_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$attr6_raw);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_raw);unset($attr6_escape); ?><?php  $attr6_title='';  $attr6_target='_self';  $attr6_url='javascript:mark();';  $attr6_class='';  ?><?php
	$params = array();
		$tmp_url = $attr6_url;
?><a<?php if (isset($attr6_name)) echo ' name="'.$attr6_name.'"'; else echo ' href="'.$tmp_url.($attr6_anchor?'#'.$attr6_anchor:'').'"' ?> class="<?php echo $attr6_class ?>" target="<?php echo $attr6_target ?>"<?php if (isset($attr6_accesskey)) echo ' accesskey="'.$attr6_accesskey.'"' ?>  title="<?php echo encodeHtml($attr6_title) ?>"><?php unset($attr6_title);unset($attr6_target);unset($attr6_url);unset($attr6_class); ?><?php  $attr7_class='text';  $attr7_key='FOLDER_MARK_ALL';  $attr7_escape=true;  ?><?php
		$attr7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr7_class ?>" title="<?php echo $attr7_title ?>"><?php
		$langF = $attr7_escape?'langHtml':'lang';
		$tmp_text = $langF($attr7_key);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr7_class);unset($attr7_key);unset($attr7_escape); ?><?php  ?></a><?php  ?><?php  $attr6_class='text';  $attr6_raw='_|_';  $attr6_escape=true;  ?><?php
		$attr6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
		$langF = $attr6_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$attr6_raw);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_raw);unset($attr6_escape); ?><?php  $attr6_title='';  $attr6_target='_self';  $attr6_url='javascript:unmark();';  $attr6_class='';  ?><?php
	$params = array();
		$tmp_url = $attr6_url;
?><a<?php if (isset($attr6_name)) echo ' name="'.$attr6_name.'"'; else echo ' href="'.$tmp_url.($attr6_anchor?'#'.$attr6_anchor:'').'"' ?> class="<?php echo $attr6_class ?>" target="<?php echo $attr6_target ?>"<?php if (isset($attr6_accesskey)) echo ' accesskey="'.$attr6_accesskey.'"' ?>  title="<?php echo encodeHtml($attr6_title) ?>"><?php unset($attr6_title);unset($attr6_target);unset($attr6_url);unset($attr6_class); ?><?php  $attr7_class='text';  $attr7_key='FOLDER_UNMARK_ALL';  $attr7_escape=true;  ?><?php
		$attr7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr7_class ?>" title="<?php echo $attr7_title ?>"><?php
		$langF = $attr7_escape?'langHtml':'lang';
		$tmp_text = $langF($attr7_key);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr7_class);unset($attr7_key);unset($attr7_escape); ?><?php  ?></a><?php  ?><?php  $attr6_class='text';  $attr6_raw='_|_';  $attr6_escape=true;  ?><?php
		$attr6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
		$langF = $attr6_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$attr6_raw);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_raw);unset($attr6_escape); ?><?php  $attr6_title='';  $attr6_target='_self';  $attr6_url='javascript:flip();';  $attr6_class='';  ?><?php
	$params = array();
		$tmp_url = $attr6_url;
?><a<?php if (isset($attr6_name)) echo ' name="'.$attr6_name.'"'; else echo ' href="'.$tmp_url.($attr6_anchor?'#'.$attr6_anchor:'').'"' ?> class="<?php echo $attr6_class ?>" target="<?php echo $attr6_target ?>"<?php if (isset($attr6_accesskey)) echo ' accesskey="'.$attr6_accesskey.'"' ?>  title="<?php echo encodeHtml($attr6_title) ?>"><?php unset($attr6_title);unset($attr6_target);unset($attr6_url);unset($attr6_class); ?><?php  $attr7_class='text';  $attr7_key='FOLDER_FLIP_MARK';  $attr7_escape=true;  ?><?php
		$attr7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr7_class ?>" title="<?php echo $attr7_title ?>"><?php
		$langF = $attr7_escape?'langHtml':'lang';
		$tmp_text = $langF($attr7_key);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr7_class);unset($attr7_key);unset($attr7_escape); ?><?php  ?></a><?php  ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php
	$attr4_tmp_class='';
	$attr4_last_class = $attr4_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr4_tmp_class));
?><?php  ?><?php  $attr5_colspan='2';  ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr5_class))
		$attr5_class=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr5_rowspan) )
		$attr5_width=$column_widths[$cell_column_nr-1];
?><td<?php
?> colspan="<?php echo $attr5_colspan ?>" <?php
?>><?php unset($attr5_colspan); ?><?php  $attr6_list='actionlist';  $attr6_extract=true;  $attr6_key='list_key';  $attr6_value='list_value';  ?><?php
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
?><?php unset($attr6_list);unset($attr6_extract);unset($attr6_key);unset($attr6_value); ?><?php  $attr7_readonly=false;  $attr7_name='type';  $attr7_value=$type;  $attr7_default=false;  $attr7_prefix='';  $attr7_suffix='';  $attr7_class='';  $attr7_onchange='';  ?><?php
		if ($this->isEditable() && !$this->isEditMode()) $attr7_readonly=true;
		if	( isset($$attr7_name)  )
			$attr7_tmp_default = $$attr7_name;
		elseif ( isset($attr7_default) )
			$attr7_tmp_default = $attr7_default;
		else
			$attr7_tmp_default = '';
 ?><input onclick="<?php echo $attr7_name.'_'.$attr7_value ?>_valueChanged(this);" class="radio" type="radio" id="id_<?php echo $attr7_name.'_'.$attr7_value ?>"  name="<?php echo $attr7_prefix.$attr7_name ?>"<?php if ( $attr7_readonly ) echo ' disabled="disabled"' ?> value="<?php echo $attr7_value ?>" <?php if($attr7_value==$attr7_tmp_default) echo 'checked="checked"' ?><?php if (in_array($attr7_name,$errors)) echo ' style="borderx:2px dashed red; background-color:red;"' ?> />
<?php /* #END-IF# */ ?><?php unset($attr7_readonly);unset($attr7_name);unset($attr7_value);unset($attr7_default);unset($attr7_prefix);unset($attr7_suffix);unset($attr7_class);unset($attr7_onchange); ?><?php  $attr7_for='type';  $attr7_value=$type;  ?><label for="id_<?php echo $attr7_for ?><?php if (!empty($attr7_value)) echo '_'.$attr7_value ?>"><?php unset($attr7_for);unset($attr7_value); ?><?php  $attr8_class='text';  $attr8_raw='_';  $attr8_escape=true;  ?><?php
		$attr8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr8_class ?>" title="<?php echo $attr8_title ?>"><?php
		$langF = $attr8_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$attr8_raw);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr8_class);unset($attr8_raw);unset($attr8_escape); ?><?php  $attr8_class='text';  $attr8_key=$type;  $attr8_prefix='FOLDER_SELECT_';  $attr8_escape=true;  ?><?php
		$attr8_key = $attr8_prefix.$attr8_key;
		$attr8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr8_class ?>" title="<?php echo $attr8_title ?>"><?php
		$langF = $attr8_escape?'langHtml':'lang';
		$tmp_text = $langF($attr8_key);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr8_class);unset($attr8_key);unset($attr8_prefix);unset($attr8_escape); ?><?php  ?></label><?php  ?><?php  ?><br/><?php  ?><?php  ?><?php } ?><?php  ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php
	$attr4_tmp_class='';
	$attr4_last_class = $attr4_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr4_tmp_class));
?><?php  ?><?php  $attr5_class='act';  $attr5_colspan='2';  ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr5_class))
		$attr5_class=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr5_rowspan) )
		$attr5_width=$column_widths[$cell_column_nr-1];
?><td<?php
?> class="<?php   echo $attr5_class   ?>" <?php
?> colspan="<?php echo $attr5_colspan ?>" <?php
?>><?php unset($attr5_class);unset($attr5_colspan); ?><?php  $attr6_type='ok';  $attr6_class='ok';  $attr6_value='ok';  $attr6_text='button_next';  ?><?php
		if ($this->isEditable() && !$this->isEditMode())
		$attr6_text = 'MODE_EDIT';
		$attr6_type = 'submit';
		$attr6_src  = '';
?><input type="<?php echo $attr6_type ?>"<?php if(isset($attr6_src)) { ?> src="<?php echo $image_dir.'icon_'.$attr6_src.IMG_ICON_EXT ?>"<?php } ?> name="<?php echo $attr6_value ?>" class="<?php echo $attr6_class ?>" title="<?php echo lang($attr6_text.'_DESC') ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo langHtml($attr6_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($attr6_src) ?><?php
?><?php unset($attr6_type);unset($attr6_class);unset($attr6_value);unset($attr6_text); ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  $attr4_empty='object';  ?><?php 
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
?><?php  ?><?php  $attr6_colspan='2';  ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr6_class))
		$attr6_class=$column_class;
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
		$tmp_text = $langF($$attr7_textvar);
		$tmp_text = $langF($attr7_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr7_class);unset($attr7_text);unset($attr7_escape); ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php } ?><?php  ?><?php  ?>      </table>
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
<?php  ?><?php  $attr2_script='mark';  $attr2_inline=true;  ?><?php
$attr2_tmp_file = $tpl_dir.'../../js/'.basename($attr2_script).'.js';
if	(!$attr2_inline)
{
	?><script src="<?php echo $attr2_tmp_file ?>" type="text/javascript"></script><?php 
}
else
{
	echo '<script type="text/javascript">';
	echo str_replace('  ',' ',str_replace('~','',strtr(implode('',file($attr2_tmp_file)),"\t\n\b",'~~~')));
	echo '</script>';
}
?>
<?php unset($attr2_script);unset($attr2_inline); ?><?php  ?></body>
</html><?php  ?>