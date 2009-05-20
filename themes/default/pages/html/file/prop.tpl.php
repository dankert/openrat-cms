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
<?php /* Debug-Information */ if ($showDuration) { echo "<!--\n";print_r($this->templateVars);echo "\n-->";} ?><?php unset($attr1_class); ?><?php  $attr2_name='';  $attr2_target='_self';  $attr2_method='post';  $attr2_enctype='application/x-www-form-urlencoded';  ?><?php
		$attr2_action = $actionName;
		$attr2_subaction = $targetSubActionName;
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
?><?php unset($attr2_name);unset($attr2_target);unset($attr2_method);unset($attr2_enctype); ?><?php  $attr3_icon='folder';  $attr3_widths='40%,60%';  $attr3_width='70%';  $attr3_rowclasses='odd,even';  $attr3_columnclasses='1,2,3';  ?><?php
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
<?php unset($attr3_icon);unset($attr3_widths);unset($attr3_width);unset($attr3_rowclasses);unset($attr3_columnclasses); ?><?php  ?><?php
	$attr4_tmp_class='';
	$attr4_last_class = $attr4_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr4_tmp_class));
?><?php  ?><?php  ?><?php
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
?>><?php  ?><?php  $attr6_class='text';  $attr6_text='global_name';  $attr6_escape=true;  ?><?php
		$attr6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
		$langF = $attr6_escape?'langHtml':'lang';
		$tmp_text = $langF($$attr6_textvar);
		$tmp_text = $langF($attr6_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_text);unset($attr6_escape); ?><?php  ?></td><?php  ?><?php  $attr5_class='name';  ?><?php
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
?>><?php unset($attr5_class); ?><?php  $attr6_class='name';  $attr6_default='';  $attr6_type='text';  $attr6_name='name';  $attr6_size='50';  $attr6_maxlength='256';  $attr6_onchange='';  $attr6_readonly=false;  ?><?php if ($this->isEditable() && !$this->isEditMode()) $attr6_readonly=true;
	  if ($attr6_readonly && empty($$attr6_name)) $$attr6_name = '- '.lang('EMPTY').' -';
      if(!isset($attr6_default)) $attr6_default='';
?><?php if (!$attr6_readonly || $attr6_type=='hidden') {
?><input<?php if ($attr6_readonly) echo ' disabled="true"' ?> id="id_<?php echo $attr6_name ?><?php if ($attr6_readonly) echo '_disabled' ?>" name="<?php echo $attr6_name ?><?php if ($attr6_readonly) echo '_disabled' ?>" type="<?php echo $attr6_type ?>" size="<?php echo $attr6_size ?>" maxlength="<?php echo $attr6_maxlength ?>" class="<?php echo $attr6_class ?>" value="<?php echo isset($$attr6_name)?$$attr6_name:$attr6_default ?>" <?php if (in_array($attr6_name,$errors)) echo 'style="border-rightx:10px solid red; background-colorx:yellow; border:2px dashed red;"' ?> /><?php
if	($attr6_readonly) {
?><input type="hidden" id="id_<?php echo $attr6_name ?>" name="<?php echo $attr6_name ?>" value="<?php echo isset($$attr6_name)?$$attr6_name:$attr6_default ?>" /><?php
 } } else { ?><span class="<?php echo $attr6_class ?>"><?php echo isset($$attr6_name)?$$attr6_name:$attr6_default ?></span><?php } ?><?php unset($attr6_class);unset($attr6_default);unset($attr6_type);unset($attr6_name);unset($attr6_size);unset($attr6_maxlength);unset($attr6_onchange);unset($attr6_readonly); ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php
	$attr4_tmp_class='';
	$attr4_last_class = $attr4_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr4_tmp_class));
?><?php  ?><?php  ?><?php
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
?>><?php  ?><?php  $attr6_class='text';  $attr6_text='global_filename';  $attr6_escape=true;  ?><?php
		$attr6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
		$langF = $attr6_escape?'langHtml':'lang';
		$tmp_text = $langF($$attr6_textvar);
		$tmp_text = $langF($attr6_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_text);unset($attr6_escape); ?><?php  ?></td><?php  ?><?php  $attr5_class='filename';  ?><?php
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
?>><?php unset($attr5_class); ?><?php  $attr6_class='filename';  $attr6_default='';  $attr6_type='text';  $attr6_name='filename';  $attr6_size='40';  $attr6_maxlength='256';  $attr6_onchange='';  $attr6_readonly=false;  ?><?php if ($this->isEditable() && !$this->isEditMode()) $attr6_readonly=true;
	  if ($attr6_readonly && empty($$attr6_name)) $$attr6_name = '- '.lang('EMPTY').' -';
      if(!isset($attr6_default)) $attr6_default='';
?><?php if (!$attr6_readonly || $attr6_type=='hidden') {
?><input<?php if ($attr6_readonly) echo ' disabled="true"' ?> id="id_<?php echo $attr6_name ?><?php if ($attr6_readonly) echo '_disabled' ?>" name="<?php echo $attr6_name ?><?php if ($attr6_readonly) echo '_disabled' ?>" type="<?php echo $attr6_type ?>" size="<?php echo $attr6_size ?>" maxlength="<?php echo $attr6_maxlength ?>" class="<?php echo $attr6_class ?>" value="<?php echo isset($$attr6_name)?$$attr6_name:$attr6_default ?>" <?php if (in_array($attr6_name,$errors)) echo 'style="border-rightx:10px solid red; background-colorx:yellow; border:2px dashed red;"' ?> /><?php
if	($attr6_readonly) {
?><input type="hidden" id="id_<?php echo $attr6_name ?>" name="<?php echo $attr6_name ?>" value="<?php echo isset($$attr6_name)?$$attr6_name:$attr6_default ?>" /><?php
 } } else { ?><span class="<?php echo $attr6_class ?>"><?php echo isset($$attr6_name)?$$attr6_name:$attr6_default ?></span><?php } ?><?php unset($attr6_class);unset($attr6_default);unset($attr6_type);unset($attr6_name);unset($attr6_size);unset($attr6_maxlength);unset($attr6_onchange);unset($attr6_readonly); ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php
	$attr4_tmp_class='';
	$attr4_last_class = $attr4_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr4_tmp_class));
?><?php  ?><?php  ?><?php
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
?>><?php  ?><?php  $attr6_class='text';  $attr6_text='file_extension';  $attr6_escape=true;  ?><?php
		$attr6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
		$langF = $attr6_escape?'langHtml':'lang';
		$tmp_text = $langF($$attr6_textvar);
		$tmp_text = $langF($attr6_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_text);unset($attr6_escape); ?><?php  ?></td><?php  ?><?php  $attr5_class='filename';  ?><?php
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
?>><?php unset($attr5_class); ?><?php  $attr6_class='extension';  $attr6_default='';  $attr6_type='text';  $attr6_name='extension';  $attr6_size='10';  $attr6_maxlength='256';  $attr6_onchange='';  $attr6_readonly=false;  ?><?php if ($this->isEditable() && !$this->isEditMode()) $attr6_readonly=true;
	  if ($attr6_readonly && empty($$attr6_name)) $$attr6_name = '- '.lang('EMPTY').' -';
      if(!isset($attr6_default)) $attr6_default='';
?><?php if (!$attr6_readonly || $attr6_type=='hidden') {
?><input<?php if ($attr6_readonly) echo ' disabled="true"' ?> id="id_<?php echo $attr6_name ?><?php if ($attr6_readonly) echo '_disabled' ?>" name="<?php echo $attr6_name ?><?php if ($attr6_readonly) echo '_disabled' ?>" type="<?php echo $attr6_type ?>" size="<?php echo $attr6_size ?>" maxlength="<?php echo $attr6_maxlength ?>" class="<?php echo $attr6_class ?>" value="<?php echo isset($$attr6_name)?$$attr6_name:$attr6_default ?>" <?php if (in_array($attr6_name,$errors)) echo 'style="border-rightx:10px solid red; background-colorx:yellow; border:2px dashed red;"' ?> /><?php
if	($attr6_readonly) {
?><input type="hidden" id="id_<?php echo $attr6_name ?>" name="<?php echo $attr6_name ?>" value="<?php echo isset($$attr6_name)?$$attr6_name:$attr6_default ?>" /><?php
 } } else { ?><span class="<?php echo $attr6_class ?>"><?php echo isset($$attr6_name)?$$attr6_name:$attr6_default ?></span><?php } ?><?php unset($attr6_class);unset($attr6_default);unset($attr6_type);unset($attr6_name);unset($attr6_size);unset($attr6_maxlength);unset($attr6_onchange);unset($attr6_readonly); ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php
	$attr4_tmp_class='';
	$attr4_last_class = $attr4_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr4_tmp_class));
?><?php  ?><?php  ?><?php
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
?>><?php  ?><?php  $attr6_class='text';  $attr6_text='global_description';  $attr6_escape=true;  ?><?php
		$attr6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
		$langF = $attr6_escape?'langHtml':'lang';
		$tmp_text = $langF($$attr6_textvar);
		$tmp_text = $langF($attr6_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_text);unset($attr6_escape); ?><?php  ?></td><?php  ?><?php  ?><?php
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
?>><?php  ?><?php  $attr6_name='description';  $attr6_rows='10';  $attr6_cols='40';  $attr6_class='description';  $attr6_default='';  ?><?php if ($this->isEditable() && !$this->isEditMode()) $attr6_readonly=true;
      if ( !$attr6_readonly) {
?><textarea <?php if ($attr6_readonly) echo ' disabled="true"' ?> class="<?php echo $attr6_class ?>" name="<?php echo $attr6_name ?>" rows="<?php echo $attr6_rows ?>" cols="<?php echo $attr6_cols ?>"><?php echo htmlentities(isset($$attr6_name)?$$attr6_name:$attr6_default) ?></textarea><?php
 } else {
?><span class="<?php echo $attr6_class ?>"><?php echo isset($$attr6_name)?$$attr6_name:$attr6_default ?></span><?php } ?><?php unset($attr6_name);unset($attr6_rows);unset($attr6_cols);unset($attr6_class);unset($attr6_default); ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php
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
?>><?php unset($attr5_colspan); ?><?php  $attr6_title=lang('additional_info');  ?><fieldset><?php if(isset($attr6_title)) { ?><legend><?php echo encodeHtml($attr6_title) ?></legend><?php } ?><?php unset($attr6_title); ?><?php  ?></fieldset><?php  ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  $attr4_false=$mode=="edit";  ?><?php 
	if	(gettype($attr4_false) === '' && gettype($attr4_false) === '1')
		$attr4_tmp_exec = $$attr4_false == false;
	else
		$attr4_tmp_exec = $attr4_false == false;
	$attr4_tmp_last_exec = $attr4_tmp_exec;
	if	( $attr4_tmp_exec )
	{
?>
<?php unset($attr4_false); ?><?php  ?><?php
	$attr5_tmp_class='';
	$attr5_last_class = $attr5_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr5_tmp_class));
?><?php  ?><?php  ?><?php
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
?>><?php  ?><?php  $attr7_class='text';  $attr7_text='global_full_filename';  $attr7_escape=true;  ?><?php
		$attr7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr7_class ?>" title="<?php echo $attr7_title ?>"><?php
		$langF = $attr7_escape?'langHtml':'lang';
		$tmp_text = $langF($$attr7_textvar);
		$tmp_text = $langF($attr7_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr7_class);unset($attr7_text);unset($attr7_escape); ?><?php  ?></td><?php  ?><?php  $attr6_class='filename';  ?><?php
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
?> class="<?php   echo $attr6_class   ?>" <?php
?>><?php unset($attr6_class); ?><?php  $attr7_class='text';  $attr7_var='full_filename';  $attr7_escape=true;  ?><?php
		$attr7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr7_class ?>" title="<?php echo $attr7_title ?>"><?php
		$langF = $attr7_escape?'langHtml':'lang';
		$tmp_text = isset($$attr7_var)?$$attr7_var:'?unset:'.$attr7_var.'?';
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr7_class);unset($attr7_var);unset($attr7_escape); ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php } ?><?php  ?><?php  ?><?php
	$attr4_tmp_class='';
	$attr4_last_class = $attr4_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr4_tmp_class));
?><?php  ?><?php  ?><?php
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
?>><?php  ?><?php  $attr6_class='text';  $attr6_text='FILE_SIZE';  $attr6_escape=true;  ?><?php
		$attr6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
		$langF = $attr6_escape?'langHtml':'lang';
		$tmp_text = $langF($$attr6_textvar);
		$tmp_text = $langF($attr6_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_text);unset($attr6_escape); ?><?php  ?></td><?php  ?><?php  ?><?php
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
?>><?php  ?><?php  $attr6_class='text';  $attr6_var='size';  $attr6_escape=true;  ?><?php
		$attr6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
		$langF = $attr6_escape?'langHtml':'lang';
		$tmp_text = isset($$attr6_var)?$$attr6_var:'?unset:'.$attr6_var.'?';
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_var);unset($attr6_escape); ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php
	$attr4_tmp_class='';
	$attr4_last_class = $attr4_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr4_tmp_class));
?><?php  ?><?php  ?><?php
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
?>><?php  ?><?php  $attr6_class='text';  $attr6_text='FILE_mimetype';  $attr6_escape=true;  ?><?php
		$attr6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
		$langF = $attr6_escape?'langHtml':'lang';
		$tmp_text = $langF($$attr6_textvar);
		$tmp_text = $langF($attr6_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_text);unset($attr6_escape); ?><?php  ?></td><?php  ?><?php  $attr5_class='filename';  ?><?php
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
?>><?php unset($attr5_class); ?><?php  $attr6_class='text';  $attr6_var='mimetype';  $attr6_escape=true;  ?><?php
		$attr6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
		$langF = $attr6_escape?'langHtml':'lang';
		$tmp_text = isset($$attr6_var)?$$attr6_var:'?unset:'.$attr6_var.'?';
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_var);unset($attr6_escape); ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php
	$attr4_tmp_class='';
	$attr4_last_class = $attr4_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr4_tmp_class));
?><?php  ?><?php  ?><?php
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
?>><?php  ?><?php  $attr6_class='text';  $attr6_text=lang('id');  $attr6_escape=true;  ?><?php
		$attr6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
		$langF = $attr6_escape?'langHtml':'lang';
		$tmp_text = $langF($$attr6_textvar);
		$tmp_text = $langF($attr6_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_text);unset($attr6_escape); ?><?php  ?></td><?php  ?><?php  ?><?php
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
?>><?php  ?><?php  $attr6_class='text';  $attr6_var='objectid';  $attr6_escape=true;  ?><?php
		$attr6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
		$langF = $attr6_escape?'langHtml':'lang';
		$tmp_text = isset($$attr6_var)?$$attr6_var:'?unset:'.$attr6_var.'?';
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_var);unset($attr6_escape); ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php
	$attr4_tmp_class='';
	$attr4_last_class = $attr4_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr4_tmp_class));
?><?php  ?><?php  ?><?php
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
?>><?php  ?><?php  $attr6_class='text';  $attr6_text='CACHE_FILENAME';  $attr6_escape=true;  ?><?php
		$attr6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
		$langF = $attr6_escape?'langHtml':'lang';
		$tmp_text = $langF($$attr6_textvar);
		$tmp_text = $langF($attr6_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_text);unset($attr6_escape); ?><?php  ?></td><?php  ?><?php  $attr5_class='filename';  ?><?php
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
?>><?php unset($attr5_class); ?><?php  $attr6_present='cache_filename';  ?><?php 
	$attr6_tmp_exec = isset($$attr6_present);
	$attr6_tmp_last_exec = $attr6_tmp_exec;
	if	( $attr6_tmp_exec )
	{
?>
<?php unset($attr6_present); ?><?php  $attr7_class='text';  $attr7_var='cache_filename';  $attr7_escape=true;  ?><?php
		$attr7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr7_class ?>" title="<?php echo $attr7_title ?>"><?php
		$langF = $attr7_escape?'langHtml':'lang';
		$tmp_text = isset($$attr7_var)?$$attr7_var:'?unset:'.$attr7_var.'?';
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr7_class);unset($attr7_var);unset($attr7_escape); ?><?php  ?><?php } ?><?php  ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  $attr4_present='cache_filename';  ?><?php 
	$attr4_tmp_exec = isset($$attr4_present);
	$attr4_tmp_last_exec = $attr4_tmp_exec;
	if	( $attr4_tmp_exec )
	{
?>
<?php unset($attr4_present); ?><?php  ?><?php
	$attr5_tmp_class='';
	$attr5_last_class = $attr5_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr5_tmp_class));
?><?php  ?><?php  ?><?php
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
?>><?php  ?><?php  ?></td><?php  ?><?php  ?><?php
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
?>><?php  ?><?php  $attr7_icon='el_date';  $attr7_align='left';  ?><?php
	$attr7_tmp_image_file = $image_dir.'icon_'.$attr7_icon.IMG_ICON_EXT;
	$attr7_size = '16x16';
?><img alt="<?php echo basename($attr7_tmp_image_file); echo ' ('; if (isset($attr7_size)) { list($attr7_tmp_width,$attr7_tmp_height)=explode('x',$attr7_size);echo $attr7_tmp_width.'x'.$attr7_tmp_height; echo')';} ?>" src="<?php echo $attr7_tmp_image_file ?>" border="0"<?php if(isset($attr7_align)) echo ' align="'.$attr7_align.'"' ?><?php if (isset($attr7_size)) { list($attr7_tmp_width,$attr7_tmp_height)=explode('x',$attr7_size);echo ' width="'.$attr7_tmp_width.'" height="'.$attr7_tmp_height.'"';} ?>><?php unset($attr7_icon);unset($attr7_align); ?><?php  $attr7_date=$cache_filemtime;  ?><?php	
    global $conf;
	$time = $attr7_date;
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
?><?php unset($attr7_date); ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php } ?><?php  ?><?php  ?><?php
	$attr4_tmp_class='';
	$attr4_last_class = $attr4_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr4_tmp_class));
?><?php  ?><?php  ?><?php
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
?>><?php  ?><?php  $attr6_class='text';  $attr6_text='FILE_PAGES';  $attr6_escape=true;  ?><?php
		$attr6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
		$langF = $attr6_escape?'langHtml':'lang';
		$tmp_text = $langF($$attr6_textvar);
		$tmp_text = $langF($attr6_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_text);unset($attr6_escape); ?><?php  ?></td><?php  ?><?php  ?><?php
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
?>><?php  ?><?php  $attr6_list='pages';  $attr6_extract=true;  $attr6_key='list_key';  $attr6_value='list_value';  ?><?php
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
?><?php unset($attr6_list);unset($attr6_extract);unset($attr6_key);unset($attr6_value); ?><?php  $attr7_title='';  $attr7_target='cms_main';  $attr7_url='url';  $attr7_class='';  ?><?php
	$params = array();
		$tmp_url = $attr7_url;
?><a<?php if (isset($attr7_name)) echo ' name="'.$attr7_name.'"'; else echo ' href="'.$tmp_url.($attr7_anchor?'#'.$attr7_anchor:'').'"' ?> class="<?php echo $attr7_class ?>" target="<?php echo $attr7_target ?>"<?php if (isset($attr7_accesskey)) echo ' accesskey="'.$attr7_accesskey.'"' ?>  title="<?php echo encodeHtml($attr7_title) ?>"><?php unset($attr7_title);unset($attr7_target);unset($attr7_url);unset($attr7_class); ?><?php  $attr8_align='left';  $attr8_type='page';  ?><?php
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
?></<?php echo $tmp_tag ?>><?php unset($attr8_class);unset($attr8_var);unset($attr8_escape); ?><?php  ?></a><?php  ?><?php  ?><br/><?php  ?><?php  ?><?php } ?><?php  ?><?php  $attr6_empty='pages';  ?><?php 
	if	( !isset($$attr6_empty) )
		$attr6_tmp_exec = empty($attr6_empty);
	elseif	( is_array($$attr6_empty) )
		$attr6_tmp_exec = (count($$attr6_empty)==0);
	elseif	( is_bool($$attr6_empty) )
		$attr6_tmp_exec = true;
	else
		$attr6_tmp_exec = empty( $$attr6_empty );
	$attr6_tmp_last_exec = $attr6_tmp_exec;
	if	( $attr6_tmp_exec )
	{
?>
<?php unset($attr6_empty); ?><?php  $attr7_class='text';  $attr7_text='GLOBAL_NOT_FOUND';  $attr7_escape=true;  ?><?php
		$attr7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr7_class ?>" title="<?php echo $attr7_title ?>"><?php
		$langF = $attr7_escape?'langHtml':'lang';
		$tmp_text = $langF($$attr7_textvar);
		$tmp_text = $langF($attr7_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr7_class);unset($attr7_text);unset($attr7_escape); ?><?php  ?><?php } ?><?php  ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php
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
?>><?php unset($attr5_colspan); ?><?php  $attr6_title=lang('prop_userinfo');  ?><fieldset><?php if(isset($attr6_title)) { ?><legend><?php echo encodeHtml($attr6_title) ?></legend><?php } ?><?php unset($attr6_title); ?><?php  ?></fieldset><?php  ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php
	$attr4_tmp_class='';
	$attr4_last_class = $attr4_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr4_tmp_class));
?><?php  ?><?php  ?><?php
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
?>><?php  ?><?php  $attr6_class='text';  $attr6_text='global_created';  $attr6_escape=true;  ?><?php
		$attr6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
		$langF = $attr6_escape?'langHtml':'lang';
		$tmp_text = $langF($$attr6_textvar);
		$tmp_text = $langF($attr6_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_text);unset($attr6_escape); ?><?php  ?></td><?php  ?><?php  ?><?php
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
?>><?php  ?><?php  $attr6_width='100%';  $attr6_space='0px';  $attr6_padding='0px';  ?><?php
	$coloumn_widths = array();
	$row_classes    = array();
	$column_classes = array();
		$attr6_class='';
		$column_widths = explode(',',$attr6_widths);
		unset($attr6['widths']);
?><table class="<?php echo $attr6_class ?>" cellspacing="<?php echo $attr6_space ?>" width="<?php echo $attr6_width ?>" cellpadding="<?php echo $attr6_padding ?>"><?php unset($attr6_width);unset($attr6_space);unset($attr6_padding); ?><?php  ?><?php
	$attr7_tmp_class='';
	$attr7_last_class = $attr7_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr7_tmp_class));
?><?php  ?><?php  ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr8_class))
		$attr8_class=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr8_rowspan) )
		$attr8_width=$column_widths[$cell_column_nr-1];
?><td<?php
?>><?php  ?><?php  $attr9_icon='el_date';  $attr9_align='left';  ?><?php
	$attr9_tmp_image_file = $image_dir.'icon_'.$attr9_icon.IMG_ICON_EXT;
	$attr9_size = '16x16';
?><img alt="<?php echo basename($attr9_tmp_image_file); echo ' ('; if (isset($attr9_size)) { list($attr9_tmp_width,$attr9_tmp_height)=explode('x',$attr9_size);echo $attr9_tmp_width.'x'.$attr9_tmp_height; echo')';} ?>" src="<?php echo $attr9_tmp_image_file ?>" border="0"<?php if(isset($attr9_align)) echo ' align="'.$attr9_align.'"' ?><?php if (isset($attr9_size)) { list($attr9_tmp_width,$attr9_tmp_height)=explode('x',$attr9_size);echo ' width="'.$attr9_tmp_width.'" height="'.$attr9_tmp_height.'"';} ?>><?php unset($attr9_icon);unset($attr9_align); ?><?php  $attr9_date=$create_date;  ?><?php	
    global $conf;
	$time = $attr9_date;
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
?><?php unset($attr9_date); ?><?php  ?></td><?php  ?><?php  ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr8_class))
		$attr8_class=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr8_rowspan) )
		$attr8_width=$column_widths[$cell_column_nr-1];
?><td<?php
?>><?php  ?><?php  $attr9_icon='user';  $attr9_align='left';  ?><?php
	$attr9_tmp_image_file = $image_dir.'icon_'.$attr9_icon.IMG_ICON_EXT;
	$attr9_size = '16x16';
?><img alt="<?php echo basename($attr9_tmp_image_file); echo ' ('; if (isset($attr9_size)) { list($attr9_tmp_width,$attr9_tmp_height)=explode('x',$attr9_size);echo $attr9_tmp_width.'x'.$attr9_tmp_height; echo')';} ?>" src="<?php echo $attr9_tmp_image_file ?>" border="0"<?php if(isset($attr9_align)) echo ' align="'.$attr9_align.'"' ?><?php if (isset($attr9_size)) { list($attr9_tmp_width,$attr9_tmp_height)=explode('x',$attr9_size);echo ' width="'.$attr9_tmp_width.'" height="'.$attr9_tmp_height.'"';} ?>><?php unset($attr9_icon);unset($attr9_align); ?><?php  $attr9_user=$create_user;  ?><?php
		if	( is_object($attr9_user) )
			$user = $attr9_user;
		else
			$user = $$attr9_user;
		if	( empty($user->name) )
			$user->name = lang('GLOBAL_UNKNOWN');
		if	( empty($user->fullname) )
			$user->fullname = lang('GLOBAL_NO_DESCRIPTION_AVAILABLE');
		if	( !empty($user->mail) && $conf['security']['user']['show_mail'] )
			echo '<a href="mailto:'.$user->mail.'" title="'.$user->fullname.'">'.$user->name.'</a>';
		else
			echo '<span title="'.$user->fullname.'">'.$user->name.'</span>';
?><?php unset($attr9_user); ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?></table><?php  ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php
	$attr4_tmp_class='';
	$attr4_last_class = $attr4_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr4_tmp_class));
?><?php  ?><?php  ?><?php
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
?>><?php  ?><?php  $attr6_class='text';  $attr6_text='global_lastchange';  $attr6_escape=true;  ?><?php
		$attr6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
		$langF = $attr6_escape?'langHtml':'lang';
		$tmp_text = $langF($$attr6_textvar);
		$tmp_text = $langF($attr6_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_text);unset($attr6_escape); ?><?php  ?></td><?php  ?><?php  ?><?php
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
?>><?php  ?><?php  $attr6_width='100%';  $attr6_space='0px';  $attr6_padding='0px';  ?><?php
	$coloumn_widths = array();
	$row_classes    = array();
	$column_classes = array();
		$attr6_class='';
		$column_widths = explode(',',$attr6_widths);
		unset($attr6['widths']);
?><table class="<?php echo $attr6_class ?>" cellspacing="<?php echo $attr6_space ?>" width="<?php echo $attr6_width ?>" cellpadding="<?php echo $attr6_padding ?>"><?php unset($attr6_width);unset($attr6_space);unset($attr6_padding); ?><?php  ?><?php
	$attr7_tmp_class='';
	$attr7_last_class = $attr7_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr7_tmp_class));
?><?php  ?><?php  ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr8_class))
		$attr8_class=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr8_rowspan) )
		$attr8_width=$column_widths[$cell_column_nr-1];
?><td<?php
?>><?php  ?><?php  $attr9_icon='el_date';  $attr9_align='left';  ?><?php
	$attr9_tmp_image_file = $image_dir.'icon_'.$attr9_icon.IMG_ICON_EXT;
	$attr9_size = '16x16';
?><img alt="<?php echo basename($attr9_tmp_image_file); echo ' ('; if (isset($attr9_size)) { list($attr9_tmp_width,$attr9_tmp_height)=explode('x',$attr9_size);echo $attr9_tmp_width.'x'.$attr9_tmp_height; echo')';} ?>" src="<?php echo $attr9_tmp_image_file ?>" border="0"<?php if(isset($attr9_align)) echo ' align="'.$attr9_align.'"' ?><?php if (isset($attr9_size)) { list($attr9_tmp_width,$attr9_tmp_height)=explode('x',$attr9_size);echo ' width="'.$attr9_tmp_width.'" height="'.$attr9_tmp_height.'"';} ?>><?php unset($attr9_icon);unset($attr9_align); ?><?php  $attr9_date=$lastchange_date;  ?><?php	
    global $conf;
	$time = $attr9_date;
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
?><?php unset($attr9_date); ?><?php  ?></td><?php  ?><?php  ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr8_class))
		$attr8_class=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr8_rowspan) )
		$attr8_width=$column_widths[$cell_column_nr-1];
?><td<?php
?>><?php  ?><?php  $attr9_icon='user';  $attr9_align='left';  ?><?php
	$attr9_tmp_image_file = $image_dir.'icon_'.$attr9_icon.IMG_ICON_EXT;
	$attr9_size = '16x16';
?><img alt="<?php echo basename($attr9_tmp_image_file); echo ' ('; if (isset($attr9_size)) { list($attr9_tmp_width,$attr9_tmp_height)=explode('x',$attr9_size);echo $attr9_tmp_width.'x'.$attr9_tmp_height; echo')';} ?>" src="<?php echo $attr9_tmp_image_file ?>" border="0"<?php if(isset($attr9_align)) echo ' align="'.$attr9_align.'"' ?><?php if (isset($attr9_size)) { list($attr9_tmp_width,$attr9_tmp_height)=explode('x',$attr9_size);echo ' width="'.$attr9_tmp_width.'" height="'.$attr9_tmp_height.'"';} ?>><?php unset($attr9_icon);unset($attr9_align); ?><?php  $attr9_user=$lastchange_user;  ?><?php
		if	( is_object($attr9_user) )
			$user = $attr9_user;
		else
			$user = $$attr9_user;
		if	( empty($user->name) )
			$user->name = lang('GLOBAL_UNKNOWN');
		if	( empty($user->fullname) )
			$user->fullname = lang('GLOBAL_NO_DESCRIPTION_AVAILABLE');
		if	( !empty($user->mail) && $conf['security']['user']['show_mail'] )
			echo '<a href="mailto:'.$user->mail.'" title="'.$user->fullname.'">'.$user->name.'</a>';
		else
			echo '<span title="'.$user->fullname.'">'.$user->name.'</span>';
?><?php unset($attr9_user); ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?></table><?php  ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php
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
?>><?php unset($attr5_class);unset($attr5_colspan); ?><?php  $attr6_type='ok';  $attr6_class='ok';  $attr6_value='ok';  $attr6_text='button_ok';  ?><?php
		if ($this->isEditable() && !$this->isEditMode())
		$attr6_text = 'MODE_EDIT';
		$attr6_type = 'submit';
		$attr6_src  = '';
?><input type="<?php echo $attr6_type ?>"<?php if(isset($attr6_src)) { ?> src="<?php echo $image_dir.'icon_'.$attr6_src.IMG_ICON_EXT ?>"<?php } ?> name="<?php echo $attr6_value ?>" class="<?php echo $attr6_class ?>" title="<?php echo lang($attr6_text.'_DESC') ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo langHtml($attr6_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($attr6_src) ?><?php
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
<?php  ?><?php  $attr2_field='name';  ?><?php
if (isset($errors[0])) $attr2_field = $errors[0];
?><script name="JavaScript" type="text/javascript"><!--
document.forms[0].<?php echo $attr2_field ?>.focus();
document.forms[0].<?php echo $attr2_field ?>.select();
</script>
<?php unset($attr2_field); ?><?php  ?></body>
</html><?php  ?>