<?php $a1_class='main'; ?><?php
 if (!defined('OR_VERSION')) die('Forbidden');
 if (!headers_sent()) header('Content-Type: text/html; charset='.$charset)
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
  <title><?php echo isset($a1_title)?langHtml($a1_title).' - ':(isset($windowTitle)?langHtml($windowTitle).' - ':'') ?><?php echo $cms_title ?></title>
  <meta http-equiv="content-type" content="text/html; charset=<?php echo $charset ?>" >
<?php if ( isset($refresh_url) ) { ?>
  <meta http-equiv="refresh" content="<?php echo isset($refresh_timeout)?$refresh_timeout:0 ?>; URL=<?php echo $refresh_url; if (ini_get('session.use_trans_sid')) echo '&'.session_name().'='.session_id(); ?>">
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
<body class="main" <?php if (@$conf['interface']['application_mode']) { ?> style="padding:0px;margin:0px;"<?php } ?> >
<?php /* Debug-Information */ if ($showDuration) { echo "<!-- Output Variables are:\n";echo str_replace('-->','-- >',print_r($this->templateVars,true));echo "\n-->";} ?><?php unset($a1_class) ?><?php $a2_name='';$a2_target='_self';$a2_method='post';$a2_enctype='application/x-www-form-urlencoded'; ?><?php
		$a2_action = $actionName;
		$a2_subaction = $targetSubActionName;
		$a2_id = $this->getRequestId();
	if ($this->isEditable())
	{
		if	($this->isEditMode())
		{
			$a2_method    = 'POST';
		}
		else
		{
			$a2_method    = 'GET';
			$a2_subaction = $subActionName;
		}
	}
?><form name="<?php echo $a2_name ?>"
      target="<?php echo $a2_target ?>"
      action="<?php echo Html::url( $a2_action,$a2_subaction,$a2_id ) ?>"
      method="<?php echo $a2_method ?>"
      enctype="<?php echo $a2_enctype ?>" style="margin:0px;padding:0px;">
<?php if ($this->isEditable() && !$this->isEditMode()) { ?>
<input type="hidden" name="mode" value="edit" />
<?php } ?>
<input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo $a2_action ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo $a2_subaction ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo $a2_id ?>" /><?php
		if	( $conf['interface']['url_sessionid'] )
			echo '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";
?><?php unset($a2_name,$a2_target,$a2_method,$a2_enctype) ?><?php $a3_class='text';$a3_default='';$a3_type='hidden';$a3_name='elementid';$a3_size='40';$a3_maxlength='256';$a3_onchange='';$a3_readonly=false; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a3_readonly=true;
	  if ($a3_readonly && empty($$a3_name)) $$a3_name = '- '.lang('EMPTY').' -';
      if(!isset($a3_default)) $a3_default='';
      $tmp_value = Text::encodeHtml(isset($$a3_name)?$$a3_name:$a3_default);
?><?php if (!$a3_readonly || $a3_type=='hidden') {
?><input<?php if ($a3_readonly) echo ' disabled="true"' ?> id="id_<?php echo $a3_name ?><?php if ($a3_readonly) echo '_disabled' ?>" name="<?php echo $a3_name ?><?php if ($a3_readonly) echo '_disabled' ?>" type="<?php echo $a3_type ?>" size="<?php echo $a3_size ?>" maxlength="<?php echo $a3_maxlength ?>" class="<?php echo $a3_class ?>" value="<?php echo $tmp_value ?>" <?php if (in_array($a3_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php
if	($a3_readonly) {
?><input type="hidden" id="id_<?php echo $a3_name ?>" name="<?php echo $a3_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><span class="<?php echo $a3_class ?>"><?php echo $tmp_value ?></span><?php } ?><?php unset($a3_class,$a3_default,$a3_type,$a3_name,$a3_size,$a3_maxlength,$a3_onchange,$a3_readonly) ?><?php $a3_class='text';$a3_default='';$a3_type='hidden';$a3_name='value_time';$a3_size='40';$a3_maxlength='256';$a3_onchange='';$a3_readonly=false; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a3_readonly=true;
	  if ($a3_readonly && empty($$a3_name)) $$a3_name = '- '.lang('EMPTY').' -';
      if(!isset($a3_default)) $a3_default='';
      $tmp_value = Text::encodeHtml(isset($$a3_name)?$$a3_name:$a3_default);
?><?php if (!$a3_readonly || $a3_type=='hidden') {
?><input<?php if ($a3_readonly) echo ' disabled="true"' ?> id="id_<?php echo $a3_name ?><?php if ($a3_readonly) echo '_disabled' ?>" name="<?php echo $a3_name ?><?php if ($a3_readonly) echo '_disabled' ?>" type="<?php echo $a3_type ?>" size="<?php echo $a3_size ?>" maxlength="<?php echo $a3_maxlength ?>" class="<?php echo $a3_class ?>" value="<?php echo $tmp_value ?>" <?php if (in_array($a3_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php
if	($a3_readonly) {
?><input type="hidden" id="id_<?php echo $a3_name ?>" name="<?php echo $a3_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><span class="<?php echo $a3_class ?>"><?php echo $tmp_value ?></span><?php } ?><?php unset($a3_class,$a3_default,$a3_type,$a3_name,$a3_size,$a3_maxlength,$a3_onchange,$a3_readonly) ?><?php $a3_name='element';$a3_width='93%';$a3_rowclasses='odd,even';$a3_columnclasses='1,2,3'; ?><?php
	$coloumn_widths=array();
	$icon=$actionName;
	$row_classes   = explode(',',$a3_rowclasses);
	$row_class_idx = 999;
	$column_classes = explode(',',$a3_columnclasses);
	$row_idx    = 0;
	$column_idx = 0;
		global $image_dir;
		if (@$conf['interface']['application_mode'] )
		{
			echo '<table class="main" cellspacing="0" cellpadding="4" width="100%" style="margin:0px;border:0px; padding:0px;" height_oo="100%">';
		}
		else
		{
			echo '<br/><br/><br/><center>';
			echo '<table class="main" cellspacing="0" cellpadding="4" width="'.$a3_width.'">';
		}
		if (!@$conf['interface']['application_mode'] )
		{
		echo '<tr class="title"><td>';
		echo '<img src="'.$image_dir.'icon_'.$icon.IMG_ICON_EXT.'" align="left" border="0">';
		if ($this->isEditable()) { ?>
  <?php if ($this->isEditMode()) { 
  ?><a href="<?php echo Html::url($actionName,$subActionName,$this->getRequestId()                       ) ?>" accesskey="1" title="<?php echo langHtml('MODE_EDIT_DESC') ?>" class="path" style="text-align:right;font-weight:bold;font-weight:bold;"><img src="<?php echo $image_dir ?>mode-edit.png" style="vertical-align:top; " border="0" /></a> <?php }
   elseif (readonly()) {
  ?><img src="<?php echo $image_dir ?>readonly.png" style="vertical-align:top; " border="0" /> <?php } else {
  ?><a href="<?php echo Html::url($actionName,$subActionName,$this->getRequestId(),array('mode'=>'edit') ) ?>" accesskey="1" title="<?php echo langHtml('MODE_SHOW_DESC') ?>" class="path" style="text-align:right;font-weight:bold;font-weight:bold;"><img src="<?php echo $image_dir ?>readonly.png" style="vertical-align:top; " border="0" /></a> <?php }
  ?><?php }
		echo '<span class="path">'.langHtml($actionName).'</span>&nbsp;<strong>&raquo;</strong>&nbsp;';
		if	( !isset($path) || is_array($path) )
			$path = array();
		foreach( $path as $pathElement)
		{
			extract($pathElement);
			echo '<a href="'.$url.'" class="path">'.langHtml($name).'</a>';
			echo '&nbsp;&raquo;&nbsp;';
		}
		echo '<span class="title">'.langHtml($windowTitle).'</span>';
		if	( isset($notice_status))
		{
			?><img src="<?php echo $image_dir.'notice_'.$notice_status.IMG_ICON_EXT ?>" align="right" /><?php
		}
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
  <tr class="menu"><td>
      <table class="menu"><tr>
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
          		?><td class="action"><a href="<?php echo Html::url($actionName,$menu['subaction'],$this->getRequestId() ) ?>" accesskey="<?php echo $tmp_key ?>" title="<?php echo langHtml($menu['text'].'_DESC') ?>" class="menu<?php echo $this->subActionName==$menu['subaction']?'_highlight':'' ?>"><?php echo $tmp_text ?></a></td><?php
          	}
          	else
          	{
          		?><td class="noaction"><?php echo $tmp_text ?></td><?php
          	}
          }
          	if (@$conf['help']['enabled'] )
          	{
             ?><td><a href="<?php echo $conf['help']['url'].$actionName.'/'.$subActionName.@$conf['help']['suffix'] ?> " target="_new" title="<?php echo langHtml('MENU_HELP_DESC') ?>" class="menu" style="cursor:help;"><?php echo @$conf['help']['only_question_mark']?'?':langHtml('MENU_HELP') ?></a></td><?php
          	}
          	?>
          	</tr></table></td>
  </tr>
<?php if (isset($notices) && count($notices)>0 )
      { ?>
  <tr>
    <td align="center" class="notice">
  <?php foreach( $notices as $notice_idx=>$notice ) { ?>
    	<br><table class="notice">
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
<?php unset($a3_name,$a3_width,$a3_rowclasses,$a3_columnclasses) ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a5_class='help';$a5_colspan='2'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="help"
 colspan="2"
><?php unset($a5_class,$a5_colspan) ?><?php $a6_class='text';$a6_var='desc';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = isset($$a6_var)?$$a6_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_var,$a6_escape,$a6_cut) ?></td></tr><?php $a4_equals='date';$a4_value=$type; ?><?php 
	$a4_tmp_exec = $a4_equals == $a4_value;
	$a4_tmp_last_exec = $a4_tmp_exec;
	if	( $a4_tmp_exec )
	{
?>
<?php unset($a4_equals,$a4_value) ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a6_colspan='2'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
 colspan="2"
><?php unset($a6_colspan) ?><?php $a7_title=lang('calendar'); ?><fieldset><?php if(isset($a7_title)) { ?><legend><?php if(isset($a7_icon)) { ?><image src="<?php echo $image_dir.'icon_'.$a7_icon.IMG_ICON_EXT ?>" align="left" border="0"><?php } ?><?php echo encodeHtml($a7_title) ?></legend><?php } ?><?php unset($a7_title) ?></fieldset></td></tr><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a6_colspan='2'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
 colspan="2"
><?php unset($a6_colspan) ?><?php $a7_class='calendar';$a7_width='85%';$a7_space='0px';$a7_padding='0px'; ?><?php
	$last_row_idx    = @$row_idx;
	$last_column_idx = @$column_idx;
	$row_idx    = 0;
	$column_idx = 0;
	$coloumn_widths = array();
	$row_classes    = array();
	$column_classes = array();
?><table class="calendar" cellspacing="0px" width="85%" cellpadding="0px">
<?php unset($a7_class,$a7_width,$a7_space,$a7_padding) ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a9_class='help';$a9_colspan='8'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="help"
 colspan="8"
><?php unset($a9_class,$a9_colspan) ?><?php $a10_true=$mode=="edit"; ?><?php 
	if	(gettype($a10_true) === '' && gettype($a10_true) === '1')
		$a10_tmp_exec = $$a10_true == true;
	else
		$a10_tmp_exec = $a10_true == true;
	$a10_tmp_last_exec = $a10_tmp_exec;
	if	( $a10_tmp_exec )
	{
?>
<?php unset($a10_true) ?><?php $a11_title='';$a11_target='_self';$a11_url=$lastmonthurl;$a11_class=''; ?><?php
	$params = array();
	$tmp_url = '';
		$tmp_url = $a11_url;
?><a<?php if (isset($a11_name)) echo ' name="'.$a11_name.'"'; else echo ' href="'.$tmp_url.(isset($a11_anchor)?'#'.$a11_anchor:'').'"' ?> class="<?php echo $a11_class ?>" target="<?php echo $a11_target ?>"<?php if (isset($a11_accesskey)) echo ' accesskey="'.$a11_accesskey.'"' ?>  title="<?php echo encodeHtml($a11_title) ?>"><?php unset($a11_title,$a11_target,$a11_url,$a11_class) ?><?php $a12_file='left';$a12_align='middle'; ?><?php
	$a12_tmp_image_file = $image_dir.$a12_file.IMG_ICON_EXT;
	$a12_tmp_title = basename($a12_tmp_image_file);
?><img alt="<?php echo $a12_tmp_title; if (isset($a12_size)) { echo ' ('; list($a12_tmp_width,$a12_tmp_height)=explode('x',$a12_size);echo $a12_tmp_width.'x'.$a12_tmp_height; echo')';} ?>" src="<?php echo $a12_tmp_image_file ?>" border="0"<?php if(isset($a12_align)) echo ' align="'.$a12_align.'"' ?><?php if (isset($a12_size)) { list($a12_tmp_width,$a12_tmp_height)=explode('x',$a12_size);echo ' width="'.$a12_tmp_width.'" height="'.$a12_tmp_height.'"';} ?>><?php unset($a12_file,$a12_align) ?></a><?php $a11_class='text';$a11_raw='_';$a11_escape=true;$a11_cut='both'; ?><?php
		$a11_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a11_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_raw,$a11_escape,$a11_cut) ?><?php } ?><?php $a10_class='text';$a10_var='monthname';$a10_escape=true;$a10_type='strong';$a10_cut='both'; ?><?php
		$a10_title = '';
		$tmp_tag = 'strong';
?><<?php echo $tmp_tag ?> class="<?php echo $a10_class ?>" title="<?php echo $a10_title ?>"><?php
		$langF = $a10_escape?'langHtml':'lang';
		$tmp_text = isset($$a10_var)?$$a10_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a10_class,$a10_var,$a10_escape,$a10_type,$a10_cut) ?><?php $a10_true=$mode=="edit"; ?><?php 
	if	(gettype($a10_true) === '' && gettype($a10_true) === '1')
		$a10_tmp_exec = $$a10_true == true;
	else
		$a10_tmp_exec = $a10_true == true;
	$a10_tmp_last_exec = $a10_tmp_exec;
	if	( $a10_tmp_exec )
	{
?>
<?php unset($a10_true) ?><?php $a11_class='text';$a11_raw='_';$a11_escape=true;$a11_cut='both'; ?><?php
		$a11_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a11_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_raw,$a11_escape,$a11_cut) ?><?php $a11_title='';$a11_target='_self';$a11_url=$nextmonthurl;$a11_class=''; ?><?php
	$params = array();
	$tmp_url = '';
		$tmp_url = $a11_url;
?><a<?php if (isset($a11_name)) echo ' name="'.$a11_name.'"'; else echo ' href="'.$tmp_url.(isset($a11_anchor)?'#'.$a11_anchor:'').'"' ?> class="<?php echo $a11_class ?>" target="<?php echo $a11_target ?>"<?php if (isset($a11_accesskey)) echo ' accesskey="'.$a11_accesskey.'"' ?>  title="<?php echo encodeHtml($a11_title) ?>"><?php unset($a11_title,$a11_target,$a11_url,$a11_class) ?><?php $a12_file='right';$a12_align='middle'; ?><?php
	$a12_tmp_image_file = $image_dir.$a12_file.IMG_ICON_EXT;
	$a12_tmp_title = basename($a12_tmp_image_file);
?><img alt="<?php echo $a12_tmp_title; if (isset($a12_size)) { echo ' ('; list($a12_tmp_width,$a12_tmp_height)=explode('x',$a12_size);echo $a12_tmp_width.'x'.$a12_tmp_height; echo')';} ?>" src="<?php echo $a12_tmp_image_file ?>" border="0"<?php if(isset($a12_align)) echo ' align="'.$a12_align.'"' ?><?php if (isset($a12_size)) { list($a12_tmp_width,$a12_tmp_height)=explode('x',$a12_size);echo ' width="'.$a12_tmp_width.'" height="'.$a12_tmp_height.'"';} ?>><?php unset($a12_file,$a12_align) ?></a><?php } ?><?php $a10_class='text';$a10_raw='_____';$a10_escape=true;$a10_cut='both'; ?><?php
		$a10_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a10_class ?>" title="<?php echo $a10_title ?>"><?php
		$langF = $a10_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a10_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a10_class,$a10_raw,$a10_escape,$a10_cut) ?><?php $a10_true=$mode=="edit"; ?><?php 
	if	(gettype($a10_true) === '' && gettype($a10_true) === '1')
		$a10_tmp_exec = $$a10_true == true;
	else
		$a10_tmp_exec = $a10_true == true;
	$a10_tmp_last_exec = $a10_tmp_exec;
	if	( $a10_tmp_exec )
	{
?>
<?php unset($a10_true) ?><?php $a11_title='';$a11_target='_self';$a11_url=$lastyearurl;$a11_class=''; ?><?php
	$params = array();
	$tmp_url = '';
		$tmp_url = $a11_url;
?><a<?php if (isset($a11_name)) echo ' name="'.$a11_name.'"'; else echo ' href="'.$tmp_url.(isset($a11_anchor)?'#'.$a11_anchor:'').'"' ?> class="<?php echo $a11_class ?>" target="<?php echo $a11_target ?>"<?php if (isset($a11_accesskey)) echo ' accesskey="'.$a11_accesskey.'"' ?>  title="<?php echo encodeHtml($a11_title) ?>"><?php unset($a11_title,$a11_target,$a11_url,$a11_class) ?><?php $a12_file='left';$a12_align='middle'; ?><?php
	$a12_tmp_image_file = $image_dir.$a12_file.IMG_ICON_EXT;
	$a12_tmp_title = basename($a12_tmp_image_file);
?><img alt="<?php echo $a12_tmp_title; if (isset($a12_size)) { echo ' ('; list($a12_tmp_width,$a12_tmp_height)=explode('x',$a12_size);echo $a12_tmp_width.'x'.$a12_tmp_height; echo')';} ?>" src="<?php echo $a12_tmp_image_file ?>" border="0"<?php if(isset($a12_align)) echo ' align="'.$a12_align.'"' ?><?php if (isset($a12_size)) { list($a12_tmp_width,$a12_tmp_height)=explode('x',$a12_size);echo ' width="'.$a12_tmp_width.'" height="'.$a12_tmp_height.'"';} ?>><?php unset($a12_file,$a12_align) ?></a><?php $a11_class='text';$a11_raw='_';$a11_escape=true;$a11_cut='both'; ?><?php
		$a11_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a11_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_raw,$a11_escape,$a11_cut) ?><?php } ?><?php $a10_class='text';$a10_var='yearname';$a10_escape=true;$a10_type='strong';$a10_cut='both'; ?><?php
		$a10_title = '';
		$tmp_tag = 'strong';
?><<?php echo $tmp_tag ?> class="<?php echo $a10_class ?>" title="<?php echo $a10_title ?>"><?php
		$langF = $a10_escape?'langHtml':'lang';
		$tmp_text = isset($$a10_var)?$$a10_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a10_class,$a10_var,$a10_escape,$a10_type,$a10_cut) ?><?php $a10_true=$mode=="edit"; ?><?php 
	if	(gettype($a10_true) === '' && gettype($a10_true) === '1')
		$a10_tmp_exec = $$a10_true == true;
	else
		$a10_tmp_exec = $a10_true == true;
	$a10_tmp_last_exec = $a10_tmp_exec;
	if	( $a10_tmp_exec )
	{
?>
<?php unset($a10_true) ?><?php $a11_class='text';$a11_raw='_';$a11_escape=true;$a11_cut='both'; ?><?php
		$a11_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a11_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_raw,$a11_escape,$a11_cut) ?><?php $a11_title='';$a11_target='_self';$a11_url=$nextyearurl;$a11_class=''; ?><?php
	$params = array();
	$tmp_url = '';
		$tmp_url = $a11_url;
?><a<?php if (isset($a11_name)) echo ' name="'.$a11_name.'"'; else echo ' href="'.$tmp_url.(isset($a11_anchor)?'#'.$a11_anchor:'').'"' ?> class="<?php echo $a11_class ?>" target="<?php echo $a11_target ?>"<?php if (isset($a11_accesskey)) echo ' accesskey="'.$a11_accesskey.'"' ?>  title="<?php echo encodeHtml($a11_title) ?>"><?php unset($a11_title,$a11_target,$a11_url,$a11_class) ?><?php $a12_file='right';$a12_align='middle'; ?><?php
	$a12_tmp_image_file = $image_dir.$a12_file.IMG_ICON_EXT;
	$a12_tmp_title = basename($a12_tmp_image_file);
?><img alt="<?php echo $a12_tmp_title; if (isset($a12_size)) { echo ' ('; list($a12_tmp_width,$a12_tmp_height)=explode('x',$a12_size);echo $a12_tmp_width.'x'.$a12_tmp_height; echo')';} ?>" src="<?php echo $a12_tmp_image_file ?>" border="0"<?php if(isset($a12_align)) echo ' align="'.$a12_align.'"' ?><?php if (isset($a12_size)) { list($a12_tmp_width,$a12_tmp_height)=explode('x',$a12_size);echo ' width="'.$a12_tmp_width.'" height="'.$a12_tmp_height.'"';} ?>><?php unset($a12_file,$a12_align) ?></a><?php } ?></td></tr><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php $a10_class='text';$a10_key='week';$a10_escape=true;$a10_cut='both'; ?><?php
		$a10_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a10_class ?>" title="<?php echo $a10_title ?>"><?php
		$langF = $a10_escape?'langHtml':'lang';
		$tmp_text = $langF($a10_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a10_class,$a10_key,$a10_escape,$a10_cut) ?></td><?php $a9_list='weekdays';$a9_extract=false;$a9_key='list_key';$a9_value='weekday'; ?><?php
	$a9_list_tmp_key   = $a9_key;
	$a9_list_tmp_value = $a9_value;
	$a9_list_extract   = $a9_extract;
	unset($a9_key);
	unset($a9_value);
	if	( !isset($$a9_list) || !is_array($$a9_list) )
		$$a9_list = array();
	foreach( $$a9_list as $$a9_list_tmp_key => $$a9_list_tmp_value )
	{
		if	( $a9_list_extract )
		{
			if	( !is_array($$a9_list_tmp_value) )
			{
				print_r($$a9_list_tmp_value);
				die( 'not an array at key: '.$$a9_list_tmp_key );
			}
			extract($$a9_list_tmp_value);
		}
?><?php unset($a9_list,$a9_extract,$a9_key,$a9_value) ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php $a11_class='text';$a11_var='weekday';$a11_escape=true;$a11_cut='both'; ?><?php
		$a11_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = isset($$a11_var)?$$a11_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_var,$a11_escape,$a11_cut) ?></td><?php } ?></tr><?php $a8_list='weeklist';$a8_extract=false;$a8_key='weeknr';$a8_value='week'; ?><?php
	$a8_list_tmp_key   = $a8_key;
	$a8_list_tmp_value = $a8_value;
	$a8_list_extract   = $a8_extract;
	unset($a8_key);
	unset($a8_value);
	if	( !isset($$a8_list) || !is_array($$a8_list) )
		$$a8_list = array();
	foreach( $$a8_list as $$a8_list_tmp_key => $$a8_list_tmp_value )
	{
		if	( $a8_list_extract )
		{
			if	( !is_array($$a8_list_tmp_value) )
			{
				print_r($$a8_list_tmp_value);
				die( 'not an array at key: '.$$a8_list_tmp_key );
			}
			extract($$a8_list_tmp_value);
		}
?><?php unset($a8_list,$a8_extract,$a8_key,$a8_value) ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a10_width='12%'; ?><?php $column_idx++; ?><td
 width="12%"
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a10_width) ?><?php $a11_class='text';$a11_var='weeknr';$a11_escape=true;$a11_cut='both'; ?><?php
		$a11_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = isset($$a11_var)?$$a11_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_var,$a11_escape,$a11_cut) ?></td><?php $a10_list='week';$a10_extract=true;$a10_key='list_key';$a10_value='list_value'; ?><?php
	$a10_list_tmp_key   = $a10_key;
	$a10_list_tmp_value = $a10_value;
	$a10_list_extract   = $a10_extract;
	unset($a10_key);
	unset($a10_value);
	if	( !isset($$a10_list) || !is_array($$a10_list) )
		$$a10_list = array();
	foreach( $$a10_list as $$a10_list_tmp_key => $$a10_list_tmp_value )
	{
		if	( $a10_list_extract )
		{
			if	( !is_array($$a10_list_tmp_value) )
			{
				print_r($$a10_list_tmp_value);
				die( 'not an array at key: '.$$a10_list_tmp_key );
			}
			extract($$a10_list_tmp_value);
		}
?><?php unset($a10_list,$a10_extract,$a10_key,$a10_value) ?><?php $a11_width='12%'; ?><?php $column_idx++; ?><td
 width="12%"
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a11_width) ?><?php $a12_empty='url'; ?><?php 
	if	( !isset($$a12_empty) )
		$a12_tmp_exec = empty($a12_empty);
	elseif	( is_array($$a12_empty) )
		$a12_tmp_exec = (count($$a12_empty)==0);
	elseif	( is_bool($$a12_empty) )
		$a12_tmp_exec = true;
	else
		$a12_tmp_exec = empty( $$a12_empty );
	$a12_tmp_last_exec = $a12_tmp_exec;
	if	( $a12_tmp_exec )
	{
?>
<?php unset($a12_empty) ?><?php $a13_class='text';$a13_raw='__';$a13_escape=true;$a13_cut='both'; ?><?php
		$a13_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a13_class ?>" title="<?php echo $a13_title ?>"><?php
		$langF = $a13_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a13_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a13_class,$a13_raw,$a13_escape,$a13_cut) ?><?php $a13_class='text';$a13_var='nr';$a13_escape=true;$a13_type='strong';$a13_cut='both'; ?><?php
		$a13_title = '';
		$tmp_tag = 'strong';
?><<?php echo $tmp_tag ?> class="<?php echo $a13_class ?>" title="<?php echo $a13_title ?>"><?php
		$langF = $a13_escape?'langHtml':'lang';
		$tmp_text = isset($$a13_var)?$$a13_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a13_class,$a13_var,$a13_escape,$a13_type,$a13_cut) ?><?php $a13_class='text';$a13_raw='__';$a13_escape=true;$a13_cut='both'; ?><?php
		$a13_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a13_class ?>" title="<?php echo $a13_title ?>"><?php
		$langF = $a13_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a13_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a13_class,$a13_raw,$a13_escape,$a13_cut) ?><?php } ?><?php $a12_not=true;$a12_empty='url'; ?><?php 
	if	( !isset($$a12_empty) )
		$a12_tmp_exec = empty($a12_empty);
	elseif	( is_array($$a12_empty) )
		$a12_tmp_exec = (count($$a12_empty)==0);
	elseif	( is_bool($$a12_empty) )
		$a12_tmp_exec = true;
	else
		$a12_tmp_exec = empty( $$a12_empty );
	$a12_tmp_exec = !$a12_tmp_exec;
	$a12_tmp_last_exec = $a12_tmp_exec;
	if	( $a12_tmp_exec )
	{
?>
<?php unset($a12_not,$a12_empty) ?><?php $a13_title='';$a13_target='_self';$a13_url=$url;$a13_class=''; ?><?php
	$params = array();
	$tmp_url = '';
		$tmp_url = $a13_url;
?><a<?php if (isset($a13_name)) echo ' name="'.$a13_name.'"'; else echo ' href="'.$tmp_url.(isset($a13_anchor)?'#'.$a13_anchor:'').'"' ?> class="<?php echo $a13_class ?>" target="<?php echo $a13_target ?>"<?php if (isset($a13_accesskey)) echo ' accesskey="'.$a13_accesskey.'"' ?>  title="<?php echo encodeHtml($a13_title) ?>"><?php unset($a13_title,$a13_target,$a13_url,$a13_class) ?><?php $a14_class='text';$a14_raw='__';$a14_escape=true;$a14_cut='both'; ?><?php
		$a14_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a14_class ?>" title="<?php echo $a14_title ?>"><?php
		$langF = $a14_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a14_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a14_class,$a14_raw,$a14_escape,$a14_cut) ?><?php $a14_class='text';$a14_var='nr';$a14_escape=true;$a14_cut='both'; ?><?php
		$a14_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a14_class ?>" title="<?php echo $a14_title ?>"><?php
		$langF = $a14_escape?'langHtml':'lang';
		$tmp_text = isset($$a14_var)?$$a14_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a14_class,$a14_var,$a14_escape,$a14_cut) ?><?php $a14_class='text';$a14_raw='__';$a14_escape=true;$a14_cut='both'; ?><?php
		$a14_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a14_class ?>" title="<?php echo $a14_title ?>"><?php
		$langF = $a14_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a14_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a14_class,$a14_raw,$a14_escape,$a14_cut) ?></a><?php } ?><?php $a12_true=$today; ?><?php 
	if	(gettype($a12_true) === '' && gettype($a12_true) === '1')
		$a12_tmp_exec = $$a12_true == true;
	else
		$a12_tmp_exec = $a12_true == true;
	$a12_tmp_last_exec = $a12_tmp_exec;
	if	( $a12_tmp_exec )
	{
?>
<?php unset($a12_true) ?><?php $a13_class='text';$a13_raw='*';$a13_escape=true;$a13_cut='both'; ?><?php
		$a13_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a13_class ?>" title="<?php echo $a13_title ?>"><?php
		$langF = $a13_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a13_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a13_class,$a13_raw,$a13_escape,$a13_cut) ?><?php } ?></td><?php } ?></tr><?php } ?><?php
	$row_idx    = $last_row_idx;
	$column_idx = $last_column_idx;
?>
</table></td><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a7_colspan='2'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
 colspan="2"
><?php unset($a7_colspan) ?><?php $a8_title=lang('date'); ?><fieldset><?php if(isset($a8_title)) { ?><legend><?php if(isset($a8_icon)) { ?><image src="<?php echo $image_dir.'icon_'.$a8_icon.IMG_ICON_EXT ?>" align="left" border="0"><?php } ?><?php echo encodeHtml($a8_title) ?></legend><?php } ?><?php unset($a8_title) ?></fieldset></td></tr><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php $a8_class='text';$a8_key='date';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_key,$a8_escape,$a8_cut) ?></td><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php $a8_list='all_years';$a8_name='year';$a8_onchange='';$a8_title='';$a8_class='';$a8_addempty=false;$a8_multiple=false;$a8_size='1';$a8_lang=false; ?><?php
$a8_readonly=false;
$a8_tmp_list = $$a8_list;
if ($this->isEditable() && !$this->isEditMode())
{
	echo empty($$a8_name)?'- '.lang('EMPTY').' -':$a8_tmp_list[$$a8_name];
}
else
{
if ( $a8_addempty!==FALSE  )
{
	if ($a8_addempty===TRUE)
		$a8_tmp_list = array(''=>lang('LIST_ENTRY_EMPTY'))+$a8_tmp_list;
	else
		$a8_tmp_list = array(''=>'- '.lang($a8_addempty).' -')+$a8_tmp_list;
}
?><select<?php if ($a8_readonly) echo ' disabled="disabled"' ?> id="id_<?php echo $a8_name ?>"  name="<?php echo $a8_name; if ($a8_multiple) echo '[]'; ?>" onchange="<?php echo $a8_onchange ?>" title="<?php echo $a8_title ?>" class="<?php echo $a8_class ?>"<?php
if (count($$a8_list)<=1) echo ' disabled="disabled"';
if	($a8_multiple) echo ' multiple="multiple"';
if (in_array($a8_name,$errors)) echo ' style="background-color:red; border:2px dashed red;"';
echo ' size="'.intval($a8_size).'"';
?>><?php
		if	( isset($$a8_name) && isset($a8_tmp_list[$$a8_name]) )
			$a8_tmp_default = $$a8_name;
		elseif ( isset($a8_default) )
			$a8_tmp_default = $a8_default;
		else
			$a8_tmp_default = '';
		foreach( $a8_tmp_list as $box_key=>$box_value )
		{
			if	( is_array($box_value) )
			{
				$box_key   = $box_value['key'  ];
				$box_title = $box_value['title'];
				$box_value = $box_value['value'];
			}
			elseif( $a8_lang )
			{
				$box_title = lang( $box_value.'_DESC');
				$box_value = lang( $box_value        );
			}
			else
			{
				$box_title = '';
			}
			echo '<option class="'.$a8_class.'" value="'.$box_key.'" title="'.$box_title.'"';
			if ((string)$box_key==$a8_tmp_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select><?php
if (count($$a8_list)==0) echo '<input type="hidden" name="'.$a8_name.'" value="" />';
if (count($$a8_list)==1) echo '<input type="hidden" name="'.$a8_name.'" value="'.$box_key.'" />';
}
?><?php unset($a8_list,$a8_name,$a8_onchange,$a8_title,$a8_class,$a8_addempty,$a8_multiple,$a8_size,$a8_lang) ?><?php $a8_class='text';$a8_raw='_-_';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a8_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_raw,$a8_escape,$a8_cut) ?><?php $a8_list='all_months';$a8_name='month';$a8_onchange='';$a8_title='';$a8_class='';$a8_addempty=false;$a8_multiple=false;$a8_size='1';$a8_lang=false; ?><?php
$a8_readonly=false;
$a8_tmp_list = $$a8_list;
if ($this->isEditable() && !$this->isEditMode())
{
	echo empty($$a8_name)?'- '.lang('EMPTY').' -':$a8_tmp_list[$$a8_name];
}
else
{
if ( $a8_addempty!==FALSE  )
{
	if ($a8_addempty===TRUE)
		$a8_tmp_list = array(''=>lang('LIST_ENTRY_EMPTY'))+$a8_tmp_list;
	else
		$a8_tmp_list = array(''=>'- '.lang($a8_addempty).' -')+$a8_tmp_list;
}
?><select<?php if ($a8_readonly) echo ' disabled="disabled"' ?> id="id_<?php echo $a8_name ?>"  name="<?php echo $a8_name; if ($a8_multiple) echo '[]'; ?>" onchange="<?php echo $a8_onchange ?>" title="<?php echo $a8_title ?>" class="<?php echo $a8_class ?>"<?php
if (count($$a8_list)<=1) echo ' disabled="disabled"';
if	($a8_multiple) echo ' multiple="multiple"';
if (in_array($a8_name,$errors)) echo ' style="background-color:red; border:2px dashed red;"';
echo ' size="'.intval($a8_size).'"';
?>><?php
		if	( isset($$a8_name) && isset($a8_tmp_list[$$a8_name]) )
			$a8_tmp_default = $$a8_name;
		elseif ( isset($a8_default) )
			$a8_tmp_default = $a8_default;
		else
			$a8_tmp_default = '';
		foreach( $a8_tmp_list as $box_key=>$box_value )
		{
			if	( is_array($box_value) )
			{
				$box_key   = $box_value['key'  ];
				$box_title = $box_value['title'];
				$box_value = $box_value['value'];
			}
			elseif( $a8_lang )
			{
				$box_title = lang( $box_value.'_DESC');
				$box_value = lang( $box_value        );
			}
			else
			{
				$box_title = '';
			}
			echo '<option class="'.$a8_class.'" value="'.$box_key.'" title="'.$box_title.'"';
			if ((string)$box_key==$a8_tmp_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select><?php
if (count($$a8_list)==0) echo '<input type="hidden" name="'.$a8_name.'" value="" />';
if (count($$a8_list)==1) echo '<input type="hidden" name="'.$a8_name.'" value="'.$box_key.'" />';
}
?><?php unset($a8_list,$a8_name,$a8_onchange,$a8_title,$a8_class,$a8_addempty,$a8_multiple,$a8_size,$a8_lang) ?><?php $a8_class='text';$a8_raw='_-_';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a8_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_raw,$a8_escape,$a8_cut) ?><?php $a8_list='all_days';$a8_name='day';$a8_onchange='';$a8_title='';$a8_class='';$a8_addempty=false;$a8_multiple=false;$a8_size='1';$a8_lang=false; ?><?php
$a8_readonly=false;
$a8_tmp_list = $$a8_list;
if ($this->isEditable() && !$this->isEditMode())
{
	echo empty($$a8_name)?'- '.lang('EMPTY').' -':$a8_tmp_list[$$a8_name];
}
else
{
if ( $a8_addempty!==FALSE  )
{
	if ($a8_addempty===TRUE)
		$a8_tmp_list = array(''=>lang('LIST_ENTRY_EMPTY'))+$a8_tmp_list;
	else
		$a8_tmp_list = array(''=>'- '.lang($a8_addempty).' -')+$a8_tmp_list;
}
?><select<?php if ($a8_readonly) echo ' disabled="disabled"' ?> id="id_<?php echo $a8_name ?>"  name="<?php echo $a8_name; if ($a8_multiple) echo '[]'; ?>" onchange="<?php echo $a8_onchange ?>" title="<?php echo $a8_title ?>" class="<?php echo $a8_class ?>"<?php
if (count($$a8_list)<=1) echo ' disabled="disabled"';
if	($a8_multiple) echo ' multiple="multiple"';
if (in_array($a8_name,$errors)) echo ' style="background-color:red; border:2px dashed red;"';
echo ' size="'.intval($a8_size).'"';
?>><?php
		if	( isset($$a8_name) && isset($a8_tmp_list[$$a8_name]) )
			$a8_tmp_default = $$a8_name;
		elseif ( isset($a8_default) )
			$a8_tmp_default = $a8_default;
		else
			$a8_tmp_default = '';
		foreach( $a8_tmp_list as $box_key=>$box_value )
		{
			if	( is_array($box_value) )
			{
				$box_key   = $box_value['key'  ];
				$box_title = $box_value['title'];
				$box_value = $box_value['value'];
			}
			elseif( $a8_lang )
			{
				$box_title = lang( $box_value.'_DESC');
				$box_value = lang( $box_value        );
			}
			else
			{
				$box_title = '';
			}
			echo '<option class="'.$a8_class.'" value="'.$box_key.'" title="'.$box_title.'"';
			if ((string)$box_key==$a8_tmp_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select><?php
if (count($$a8_list)==0) echo '<input type="hidden" name="'.$a8_name.'" value="" />';
if (count($$a8_list)==1) echo '<input type="hidden" name="'.$a8_name.'" value="'.$box_key.'" />';
}
?><?php unset($a8_list,$a8_name,$a8_onchange,$a8_title,$a8_class,$a8_addempty,$a8_multiple,$a8_size,$a8_lang) ?></td></tr><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php $a8_class='text';$a8_key='date_time';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_key,$a8_escape,$a8_cut) ?></td><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php $a8_list='all_hours';$a8_name='hour';$a8_onchange='';$a8_title='';$a8_class='';$a8_addempty=false;$a8_multiple=false;$a8_size='1';$a8_lang=false; ?><?php
$a8_readonly=false;
$a8_tmp_list = $$a8_list;
if ($this->isEditable() && !$this->isEditMode())
{
	echo empty($$a8_name)?'- '.lang('EMPTY').' -':$a8_tmp_list[$$a8_name];
}
else
{
if ( $a8_addempty!==FALSE  )
{
	if ($a8_addempty===TRUE)
		$a8_tmp_list = array(''=>lang('LIST_ENTRY_EMPTY'))+$a8_tmp_list;
	else
		$a8_tmp_list = array(''=>'- '.lang($a8_addempty).' -')+$a8_tmp_list;
}
?><select<?php if ($a8_readonly) echo ' disabled="disabled"' ?> id="id_<?php echo $a8_name ?>"  name="<?php echo $a8_name; if ($a8_multiple) echo '[]'; ?>" onchange="<?php echo $a8_onchange ?>" title="<?php echo $a8_title ?>" class="<?php echo $a8_class ?>"<?php
if (count($$a8_list)<=1) echo ' disabled="disabled"';
if	($a8_multiple) echo ' multiple="multiple"';
if (in_array($a8_name,$errors)) echo ' style="background-color:red; border:2px dashed red;"';
echo ' size="'.intval($a8_size).'"';
?>><?php
		if	( isset($$a8_name) && isset($a8_tmp_list[$$a8_name]) )
			$a8_tmp_default = $$a8_name;
		elseif ( isset($a8_default) )
			$a8_tmp_default = $a8_default;
		else
			$a8_tmp_default = '';
		foreach( $a8_tmp_list as $box_key=>$box_value )
		{
			if	( is_array($box_value) )
			{
				$box_key   = $box_value['key'  ];
				$box_title = $box_value['title'];
				$box_value = $box_value['value'];
			}
			elseif( $a8_lang )
			{
				$box_title = lang( $box_value.'_DESC');
				$box_value = lang( $box_value        );
			}
			else
			{
				$box_title = '';
			}
			echo '<option class="'.$a8_class.'" value="'.$box_key.'" title="'.$box_title.'"';
			if ((string)$box_key==$a8_tmp_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select><?php
if (count($$a8_list)==0) echo '<input type="hidden" name="'.$a8_name.'" value="" />';
if (count($$a8_list)==1) echo '<input type="hidden" name="'.$a8_name.'" value="'.$box_key.'" />';
}
?><?php unset($a8_list,$a8_name,$a8_onchange,$a8_title,$a8_class,$a8_addempty,$a8_multiple,$a8_size,$a8_lang) ?><?php $a8_class='text';$a8_raw='_-_';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a8_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_raw,$a8_escape,$a8_cut) ?><?php $a8_list='all_minutes';$a8_name='minute';$a8_onchange='';$a8_title='';$a8_class='';$a8_addempty=false;$a8_multiple=false;$a8_size='1';$a8_lang=false; ?><?php
$a8_readonly=false;
$a8_tmp_list = $$a8_list;
if ($this->isEditable() && !$this->isEditMode())
{
	echo empty($$a8_name)?'- '.lang('EMPTY').' -':$a8_tmp_list[$$a8_name];
}
else
{
if ( $a8_addempty!==FALSE  )
{
	if ($a8_addempty===TRUE)
		$a8_tmp_list = array(''=>lang('LIST_ENTRY_EMPTY'))+$a8_tmp_list;
	else
		$a8_tmp_list = array(''=>'- '.lang($a8_addempty).' -')+$a8_tmp_list;
}
?><select<?php if ($a8_readonly) echo ' disabled="disabled"' ?> id="id_<?php echo $a8_name ?>"  name="<?php echo $a8_name; if ($a8_multiple) echo '[]'; ?>" onchange="<?php echo $a8_onchange ?>" title="<?php echo $a8_title ?>" class="<?php echo $a8_class ?>"<?php
if (count($$a8_list)<=1) echo ' disabled="disabled"';
if	($a8_multiple) echo ' multiple="multiple"';
if (in_array($a8_name,$errors)) echo ' style="background-color:red; border:2px dashed red;"';
echo ' size="'.intval($a8_size).'"';
?>><?php
		if	( isset($$a8_name) && isset($a8_tmp_list[$$a8_name]) )
			$a8_tmp_default = $$a8_name;
		elseif ( isset($a8_default) )
			$a8_tmp_default = $a8_default;
		else
			$a8_tmp_default = '';
		foreach( $a8_tmp_list as $box_key=>$box_value )
		{
			if	( is_array($box_value) )
			{
				$box_key   = $box_value['key'  ];
				$box_title = $box_value['title'];
				$box_value = $box_value['value'];
			}
			elseif( $a8_lang )
			{
				$box_title = lang( $box_value.'_DESC');
				$box_value = lang( $box_value        );
			}
			else
			{
				$box_title = '';
			}
			echo '<option class="'.$a8_class.'" value="'.$box_key.'" title="'.$box_title.'"';
			if ((string)$box_key==$a8_tmp_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select><?php
if (count($$a8_list)==0) echo '<input type="hidden" name="'.$a8_name.'" value="" />';
if (count($$a8_list)==1) echo '<input type="hidden" name="'.$a8_name.'" value="'.$box_key.'" />';
}
?><?php unset($a8_list,$a8_name,$a8_onchange,$a8_title,$a8_class,$a8_addempty,$a8_multiple,$a8_size,$a8_lang) ?><?php $a8_class='text';$a8_raw='_-_';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a8_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_raw,$a8_escape,$a8_cut) ?><?php $a8_list='all_seconds';$a8_name='second';$a8_onchange='';$a8_title='';$a8_class='';$a8_addempty=false;$a8_multiple=false;$a8_size='1';$a8_lang=false; ?><?php
$a8_readonly=false;
$a8_tmp_list = $$a8_list;
if ($this->isEditable() && !$this->isEditMode())
{
	echo empty($$a8_name)?'- '.lang('EMPTY').' -':$a8_tmp_list[$$a8_name];
}
else
{
if ( $a8_addempty!==FALSE  )
{
	if ($a8_addempty===TRUE)
		$a8_tmp_list = array(''=>lang('LIST_ENTRY_EMPTY'))+$a8_tmp_list;
	else
		$a8_tmp_list = array(''=>'- '.lang($a8_addempty).' -')+$a8_tmp_list;
}
?><select<?php if ($a8_readonly) echo ' disabled="disabled"' ?> id="id_<?php echo $a8_name ?>"  name="<?php echo $a8_name; if ($a8_multiple) echo '[]'; ?>" onchange="<?php echo $a8_onchange ?>" title="<?php echo $a8_title ?>" class="<?php echo $a8_class ?>"<?php
if (count($$a8_list)<=1) echo ' disabled="disabled"';
if	($a8_multiple) echo ' multiple="multiple"';
if (in_array($a8_name,$errors)) echo ' style="background-color:red; border:2px dashed red;"';
echo ' size="'.intval($a8_size).'"';
?>><?php
		if	( isset($$a8_name) && isset($a8_tmp_list[$$a8_name]) )
			$a8_tmp_default = $$a8_name;
		elseif ( isset($a8_default) )
			$a8_tmp_default = $a8_default;
		else
			$a8_tmp_default = '';
		foreach( $a8_tmp_list as $box_key=>$box_value )
		{
			if	( is_array($box_value) )
			{
				$box_key   = $box_value['key'  ];
				$box_title = $box_value['title'];
				$box_value = $box_value['value'];
			}
			elseif( $a8_lang )
			{
				$box_title = lang( $box_value.'_DESC');
				$box_value = lang( $box_value        );
			}
			else
			{
				$box_title = '';
			}
			echo '<option class="'.$a8_class.'" value="'.$box_key.'" title="'.$box_title.'"';
			if ((string)$box_key==$a8_tmp_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select><?php
if (count($$a8_list)==0) echo '<input type="hidden" name="'.$a8_name.'" value="" />';
if (count($$a8_list)==1) echo '<input type="hidden" name="'.$a8_name.'" value="'.$box_key.'" />';
}
?><?php unset($a8_list,$a8_name,$a8_onchange,$a8_title,$a8_class,$a8_addempty,$a8_multiple,$a8_size,$a8_lang) ?></td></tr></tr><?php } ?><?php $a4_equals='text';$a4_value=$type; ?><?php 
	$a4_tmp_exec = $a4_equals == $a4_value;
	$a4_tmp_last_exec = $a4_tmp_exec;
	if	( $a4_tmp_exec )
	{
?>
<?php unset($a4_equals,$a4_value) ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a6_colspan='2'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
 colspan="2"
><?php unset($a6_colspan) ?><?php $a7_class='text';$a7_default='';$a7_type='text';$a7_name='text';$a7_size='50';$a7_maxlength='255';$a7_onchange='';$a7_readonly=false; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a7_readonly=true;
	  if ($a7_readonly && empty($$a7_name)) $$a7_name = '- '.lang('EMPTY').' -';
      if(!isset($a7_default)) $a7_default='';
      $tmp_value = Text::encodeHtml(isset($$a7_name)?$$a7_name:$a7_default);
?><?php if (!$a7_readonly || $a7_type=='hidden') {
?><input<?php if ($a7_readonly) echo ' disabled="true"' ?> id="id_<?php echo $a7_name ?><?php if ($a7_readonly) echo '_disabled' ?>" name="<?php echo $a7_name ?><?php if ($a7_readonly) echo '_disabled' ?>" type="<?php echo $a7_type ?>" size="<?php echo $a7_size ?>" maxlength="<?php echo $a7_maxlength ?>" class="<?php echo $a7_class ?>" value="<?php echo $tmp_value ?>" <?php if (in_array($a7_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php
if	($a7_readonly) {
?><input type="hidden" id="id_<?php echo $a7_name ?>" name="<?php echo $a7_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><span class="<?php echo $a7_class ?>"><?php echo $tmp_value ?></span><?php } ?><?php unset($a7_class,$a7_default,$a7_type,$a7_name,$a7_size,$a7_maxlength,$a7_onchange,$a7_readonly) ?><?php $a7_field='text'; ?><?php
if (isset($errors[0])) $a7_field = $errors[0];
?><script name="JavaScript" type="text/javascript"><!--
document.forms[0].<?php echo $a7_field ?>.focus();
document.forms[0].<?php echo $a7_field ?>.select();
</script>
<?php unset($a7_field) ?></td></tr><?php } ?><?php $a4_equals='longtext';$a4_value=$type; ?><?php 
	$a4_tmp_exec = $a4_equals == $a4_value;
	$a4_tmp_last_exec = $a4_tmp_exec;
	if	( $a4_tmp_exec )
	{
?>
<?php unset($a4_equals,$a4_value) ?><?php $a5_present='preview'; ?><?php 
	$a5_tmp_exec = isset($$a5_present);
	$a5_tmp_last_exec = $a5_tmp_exec;
	if	( $a5_tmp_exec )
	{
?>
<?php unset($a5_present) ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a7_class='preview';$a7_colspan='2'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="preview"
 colspan="2"
><?php unset($a7_class,$a7_colspan) ?><?php $a8_title=lang('page_preview'); ?><fieldset><?php if(isset($a8_title)) { ?><legend><?php if(isset($a8_icon)) { ?><image src="<?php echo $image_dir.'icon_'.$a8_icon.IMG_ICON_EXT ?>" align="left" border="0"><?php } ?><?php echo encodeHtml($a8_title) ?></legend><?php } ?><?php unset($a8_title) ?><?php $a9_class='text';$a9_var='preview';$a9_escape=false;$a9_cut='both'; ?><?php
		$a9_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a9_class ?>" title="<?php echo $a9_title ?>"><?php
		$langF = $a9_escape?'langHtml':'lang';
		$tmp_text = isset($$a9_var)?$$a9_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a9_class,$a9_var,$a9_escape,$a9_cut) ?></fieldset><br/><br/></td></tr><?php } ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a6_colspan='2'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
 colspan="2"
><?php unset($a6_colspan) ?><?php $a7_equals='html';$a7_value=$editor; ?><?php 
	$a7_tmp_exec = $a7_equals == $a7_value;
	$a7_tmp_last_exec = $a7_tmp_exec;
	if	( $a7_tmp_exec )
	{
?>
<?php unset($a7_equals,$a7_value) ?><?php $a8_name='text';$a8_type='html'; ?><?php
	function checkbox( $name,$value=false,$writable=true,$params=Array() )
	{
		$src = '<input type="checkbox" id="id_'.$name.'" name="'.$name.'"';
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
	function add_control($type,$image)
	{
		global $image_dir;
		echo '<td><noscript>'.checkbox($type).'</noscript><label for="id_'.$type.'"><a href="javascript:'.$type.'();" title="'.langHtml('PAGE_EDITOR_ADD_'.$type).'"><img src="'.$image_dir.'/editor/'.$image.'" border"0" /></a></label>';
	}
 ?><?php
switch( $a8_type )
{
	case 'fckeditor':
	case 'html':
		if	( $this->isEditMode() )
		{
			include_once('./editor/editor/ckeditor.php');
			$editor = new CKeditor() ;
			$url = FileUtils::slashify(dirname($_SERVER['SCRIPT_NAME']));
			$base = defined('OR_BASE_URL')?slashify(OR_BASE_URL).'editor/editor/':'./editor/editor/';
			$editor->basePath = $base;
			$editor->config['skin' ] = 'v2';
			$editor->config['language' ] = config('language','language_code');
			$editor->config['toolbar' ] = 'Openrat';
			$editor->config['toolbar_Openrat' ] =  array( 
	array('Save','Preview','-'/*,'Templates'*/),
    array('Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'),
    array('Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'),
    array('Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'),
    '/',
    array('Bold','Italic',/*'Underline',*/'Strike','-','Subscript','Superscript'),
    array('NumberedList','BulletedList','-','Outdent','Indent','Blockquote'),
    array('JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'),
    array('Link','Unlink','Anchor'),
    array('Image','Flash','Table','HorizontalRule','SpecialChar','PageBreak'),
    '/',
    array(/*'Styles',*/'Format','Font','FontSize'),
    array('TextColor','BGColor'),
    array('Source','-', 'ShowBlocks','Maximize') );
			$editor->config['filebrowserUploadUrl' ] = str_replace('&amp;','&',Html::url('filebrowser','directupload','-',array(REQ_PARAM_TOKEN=>token(),'name'=>'upload')));
			$editor->config['filebrowserBrowseUrl' ] = str_replace('&amp;','&',Html::url('filebrowser','browse','-'));
			$editor->editor($a8_name,$$a8_name);
		}
		else
		{
			echo ($$a8_name);
		}
		break;
	case 'wiki':
		$conf_tags = $conf['editor']['text-markup'];
		if	( $this->isEditMode() )
		{
		?>
<script name="Javascript" type="text/javascript" src="<?php echo $tpl_dir ?>../../js/editor.js"></script>
<script name="JavaScript" type="text/javascript">
function strong()
{
	insert('<?php echo $a8_name ?>','<?php echo $conf_tags['strong-begin'] ?>','<?php echo $conf_tags['strong-end'] ?>');
}
function emphatic()
{
	insert('<?php echo $a8_name ?>','<?php echo $conf_tags['emphatic-begin'] ?>','<?php echo $conf_tags['emphatic-end'] ?>');
}
function link()
{
	objectid = document.forms[0].objectid.value;
	if	(objectid=="" ||objectid=="0"||objectid==null)
		objectid = window.prompt("Id","");
	if	(objectid=="" ||objectid=="0"||objectid==null)
		return;
	insert('<?php echo $a8_name ?>','"','"<?php echo $conf_tags['linkto'] ?>"'+objectid+'"');
}
function image()
{
	objectid = document.forms[0].objectid.value;
	if	(objectid=="" ||objectid=="0"||objectid==null)
		objectid = window.prompt("Id","");
	if	(objectid=="" ||objectid=="0"||objectid==null)
		return;
	insert('<?php echo $a8_name ?>','','<?php echo $conf_tags['image-begin'] ?>"'+objectid+'"<?php echo $conf_tags['image-end'] ?>');
}
function list()
{
 	insert('<?php echo $a8_name ?>',"","\n");
	while( true )
	{
		t = window.prompt('<?php echo langHtml('EDITOR_PROMPT_LIST_ENTRY') ?>','');
		if	( t != '' && t != null )
		 	insert('<?php echo $a8_name ?>',"<?php echo $conf_tags['list-unnumbered'] ?> "+t+"\n","");
		else
			break;
	}
}
function numlist()
{
	insert('<?php echo $a8_name ?>',"\n\n<?php echo $conf_tags['list-numbered'] ?> ","\n<?php echo $conf_tags['list-numbered'] ?> \n<?php echo $conf_tags['list-numbered'] ?> \n");
}
function table()
{
	column=1;
	while( true )
	{
		if	( column==1 )
			text='<?php echo langHtml('EDITOR_PROMPT_TABLE_CELL_FIRST_COLUMN') ?>';
		else
			text='<?php echo langHtml('EDITOR_PROMPT_TABLE_CELL') ?>';
		t = window.prompt(text,'');
		if	( t != '' && t != null )
		{
		 	insert('<?php echo $a8_name ?>',"<?php echo $conf_tags['table-cell-sep'] ?>"+t,"");
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
</script>
    <fieldset><legend><?php echo langHtml('EDITOR') ?></legend></fieldset>
    <table>
      <tr>
      	<td><noscript><input type="text" name="addtext" size="30" /></noscript></td>
        <td><?php add_control('strong'  ,'bold.png'  )?></td>
        <td><?php add_control('emphatic','italic.png') ?></td>
        <td>&nbsp;&nbsp;&nbsp;</td>
        <td><?php add_control('table','table.png') ?></td>
        <td>&nbsp;&nbsp;&nbsp;</td>
        <td><?php add_control('list'   ,'list.png')  ; ?></td>
        <td><?php add_control('numlist','numlist.png') ?></td>
        <td>&nbsp;&nbsp;&nbsp;</td>
        <td><?php add_control('image','image.png') ?></td>
        <td><?php add_control('link' ,'link.png' ) ?></td>
        <td><input name="objectid" size="6" title="<?php echo langHtml('LINK_TO') ?>"></td>
        <td><noscript>&nbsp;&nbsp;<input type="submit" class="submit" name="addmarkup" value="<?php echo langHtml('ADD') ?>"/></noscript></td>
      </tr>
    </table>
    <fieldset><legend><?php echo langHtml('CONTENT') ?></legend></fieldset>
	<textarea name="<?php echo $a8_name ?>" class="editor"><?php echo $$a8_name ?></textarea>
<?php
		}
		else
		{
			$a8_tmp_text = $$a8_name;
			if	( !is_array($a8_tmp_text))
				$a8_tmp_text = explode("\n",$a8_tmp_text);
			echo implode('',$a8_tmp_text);
		}
		break;
	case 'text':
	case 'raw':
		if	( $this->isEditMode() )
			echo '<textarea name="'.$a8_name.'" class="editor" style="width:100%;height:300px;">'.$$a8_name.'</textarea>';
		else
			echo nl2br($$a8_name);
		break;
	case 'dom':
	case 'tree':
		$a8_tmp_doc = new DocumentElement();
		$a8_tmp_text = $$a8_name;
		if	( !is_array($a8_tmp_text))
			$a8_tmp_text = explode("\n",$a8_tmp_text);
		$a8_tmp_doc->parse($a8_tmp_text);
		echo $a8_tmp_doc->render('application/html-dom');
		break;
	default:
		echo "Unknown editor type: ".$a8_type;
}
?><?php unset($a8_name,$a8_type) ?><?php } ?><?php $a7_equals='wiki';$a7_value=$editor; ?><?php 
	$a7_tmp_exec = $a7_equals == $a7_value;
	$a7_tmp_last_exec = $a7_tmp_exec;
	if	( $a7_tmp_exec )
	{
?>
<?php unset($a7_equals,$a7_value) ?><?php $a8_present='languagetext'; ?><?php 
	$a8_tmp_exec = isset($$a8_present);
	$a8_tmp_last_exec = $a8_tmp_exec;
	if	( $a8_tmp_exec )
	{
?>
<?php unset($a8_present) ?><?php $a9_title=$languagename; ?><fieldset><?php if(isset($a9_title)) { ?><legend><?php if(isset($a9_icon)) { ?><image src="<?php echo $image_dir.'icon_'.$a9_icon.IMG_ICON_EXT ?>" align="left" border="0"><?php } ?><?php echo encodeHtml($a9_title) ?></legend><?php } ?><?php unset($a9_title) ?><?php $a10_class='text';$a10_var='languagetext';$a10_escape=true;$a10_cut='both'; ?><?php
		$a10_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a10_class ?>" title="<?php echo $a10_title ?>"><?php
		$langF = $a10_escape?'langHtml':'lang';
		$tmp_text = isset($$a10_var)?$$a10_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a10_class,$a10_var,$a10_escape,$a10_cut) ?></fieldset><br/><br/><?php } ?><?php $a8_name='text';$a8_type='wiki'; ?><?php
	function checkbox( $name,$value=false,$writable=true,$params=Array() )
	{
		$src = '<input type="checkbox" id="id_'.$name.'" name="'.$name.'"';
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
	function add_control($type,$image)
	{
		global $image_dir;
		echo '<td><noscript>'.checkbox($type).'</noscript><label for="id_'.$type.'"><a href="javascript:'.$type.'();" title="'.langHtml('PAGE_EDITOR_ADD_'.$type).'"><img src="'.$image_dir.'/editor/'.$image.'" border"0" /></a></label>';
	}
 ?><?php
switch( $a8_type )
{
	case 'fckeditor':
	case 'html':
		if	( $this->isEditMode() )
		{
			include_once('./editor/editor/ckeditor.php');
			$editor = new CKeditor() ;
			$url = FileUtils::slashify(dirname($_SERVER['SCRIPT_NAME']));
			$base = defined('OR_BASE_URL')?slashify(OR_BASE_URL).'editor/editor/':'./editor/editor/';
			$editor->basePath = $base;
			$editor->config['skin' ] = 'v2';
			$editor->config['language' ] = config('language','language_code');
			$editor->config['toolbar' ] = 'Openrat';
			$editor->config['toolbar_Openrat' ] =  array( 
	array('Save','Preview','-'/*,'Templates'*/),
    array('Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'),
    array('Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'),
    array('Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'),
    '/',
    array('Bold','Italic',/*'Underline',*/'Strike','-','Subscript','Superscript'),
    array('NumberedList','BulletedList','-','Outdent','Indent','Blockquote'),
    array('JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'),
    array('Link','Unlink','Anchor'),
    array('Image','Flash','Table','HorizontalRule','SpecialChar','PageBreak'),
    '/',
    array(/*'Styles',*/'Format','Font','FontSize'),
    array('TextColor','BGColor'),
    array('Source','-', 'ShowBlocks','Maximize') );
			$editor->config['filebrowserUploadUrl' ] = str_replace('&amp;','&',Html::url('filebrowser','directupload','-',array(REQ_PARAM_TOKEN=>token(),'name'=>'upload')));
			$editor->config['filebrowserBrowseUrl' ] = str_replace('&amp;','&',Html::url('filebrowser','browse','-'));
			$editor->editor($a8_name,$$a8_name);
		}
		else
		{
			echo ($$a8_name);
		}
		break;
	case 'wiki':
		$conf_tags = $conf['editor']['text-markup'];
		if	( $this->isEditMode() )
		{
		?>
<script name="Javascript" type="text/javascript" src="<?php echo $tpl_dir ?>../../js/editor.js"></script>
<script name="JavaScript" type="text/javascript">
function strong()
{
	insert('<?php echo $a8_name ?>','<?php echo $conf_tags['strong-begin'] ?>','<?php echo $conf_tags['strong-end'] ?>');
}
function emphatic()
{
	insert('<?php echo $a8_name ?>','<?php echo $conf_tags['emphatic-begin'] ?>','<?php echo $conf_tags['emphatic-end'] ?>');
}
function link()
{
	objectid = document.forms[0].objectid.value;
	if	(objectid=="" ||objectid=="0"||objectid==null)
		objectid = window.prompt("Id","");
	if	(objectid=="" ||objectid=="0"||objectid==null)
		return;
	insert('<?php echo $a8_name ?>','"','"<?php echo $conf_tags['linkto'] ?>"'+objectid+'"');
}
function image()
{
	objectid = document.forms[0].objectid.value;
	if	(objectid=="" ||objectid=="0"||objectid==null)
		objectid = window.prompt("Id","");
	if	(objectid=="" ||objectid=="0"||objectid==null)
		return;
	insert('<?php echo $a8_name ?>','','<?php echo $conf_tags['image-begin'] ?>"'+objectid+'"<?php echo $conf_tags['image-end'] ?>');
}
function list()
{
 	insert('<?php echo $a8_name ?>',"","\n");
	while( true )
	{
		t = window.prompt('<?php echo langHtml('EDITOR_PROMPT_LIST_ENTRY') ?>','');
		if	( t != '' && t != null )
		 	insert('<?php echo $a8_name ?>',"<?php echo $conf_tags['list-unnumbered'] ?> "+t+"\n","");
		else
			break;
	}
}
function numlist()
{
	insert('<?php echo $a8_name ?>',"\n\n<?php echo $conf_tags['list-numbered'] ?> ","\n<?php echo $conf_tags['list-numbered'] ?> \n<?php echo $conf_tags['list-numbered'] ?> \n");
}
function table()
{
	column=1;
	while( true )
	{
		if	( column==1 )
			text='<?php echo langHtml('EDITOR_PROMPT_TABLE_CELL_FIRST_COLUMN') ?>';
		else
			text='<?php echo langHtml('EDITOR_PROMPT_TABLE_CELL') ?>';
		t = window.prompt(text,'');
		if	( t != '' && t != null )
		{
		 	insert('<?php echo $a8_name ?>',"<?php echo $conf_tags['table-cell-sep'] ?>"+t,"");
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
</script>
    <fieldset><legend><?php echo langHtml('EDITOR') ?></legend></fieldset>
    <table>
      <tr>
      	<td><noscript><input type="text" name="addtext" size="30" /></noscript></td>
        <td><?php add_control('strong'  ,'bold.png'  )?></td>
        <td><?php add_control('emphatic','italic.png') ?></td>
        <td>&nbsp;&nbsp;&nbsp;</td>
        <td><?php add_control('table','table.png') ?></td>
        <td>&nbsp;&nbsp;&nbsp;</td>
        <td><?php add_control('list'   ,'list.png')  ; ?></td>
        <td><?php add_control('numlist','numlist.png') ?></td>
        <td>&nbsp;&nbsp;&nbsp;</td>
        <td><?php add_control('image','image.png') ?></td>
        <td><?php add_control('link' ,'link.png' ) ?></td>
        <td><input name="objectid" size="6" title="<?php echo langHtml('LINK_TO') ?>"></td>
        <td><noscript>&nbsp;&nbsp;<input type="submit" class="submit" name="addmarkup" value="<?php echo langHtml('ADD') ?>"/></noscript></td>
      </tr>
    </table>
    <fieldset><legend><?php echo langHtml('CONTENT') ?></legend></fieldset>
	<textarea name="<?php echo $a8_name ?>" class="editor"><?php echo $$a8_name ?></textarea>
<?php
		}
		else
		{
			$a8_tmp_text = $$a8_name;
			if	( !is_array($a8_tmp_text))
				$a8_tmp_text = explode("\n",$a8_tmp_text);
			echo implode('',$a8_tmp_text);
		}
		break;
	case 'text':
	case 'raw':
		if	( $this->isEditMode() )
			echo '<textarea name="'.$a8_name.'" class="editor" style="width:100%;height:300px;">'.$$a8_name.'</textarea>';
		else
			echo nl2br($$a8_name);
		break;
	case 'dom':
	case 'tree':
		$a8_tmp_doc = new DocumentElement();
		$a8_tmp_text = $$a8_name;
		if	( !is_array($a8_tmp_text))
			$a8_tmp_text = explode("\n",$a8_tmp_text);
		$a8_tmp_doc->parse($a8_tmp_text);
		echo $a8_tmp_doc->render('application/html-dom');
		break;
	default:
		echo "Unknown editor type: ".$a8_type;
}
?><?php unset($a8_name,$a8_type) ?><?php $a8_true=$mode=="edit"; ?><?php 
	if	(gettype($a8_true) === '' && gettype($a8_true) === '1')
		$a8_tmp_exec = $$a8_true == true;
	else
		$a8_tmp_exec = $a8_true == true;
	$a8_tmp_last_exec = $a8_tmp_exec;
	if	( $a8_tmp_exec )
	{
?>
<?php unset($a8_true) ?><?php $a9_title=lang('help'); ?><fieldset><?php if(isset($a9_title)) { ?><legend><?php if(isset($a9_icon)) { ?><image src="<?php echo $image_dir.'icon_'.$a9_icon.IMG_ICON_EXT ?>" align="left" border="0"><?php } ?><?php echo encodeHtml($a9_title) ?></legend><?php } ?><?php unset($a9_title) ?></fieldset><?php $a9_width='100%';$a9_space='0px';$a9_padding='0px'; ?><?php
	$last_row_idx    = @$row_idx;
	$last_column_idx = @$column_idx;
	$row_idx    = 0;
	$column_idx = 0;
	$coloumn_widths = array();
	$row_classes    = array();
	$column_classes = array();
?><table class="%class%" cellspacing="0px" width="100%" cellpadding="0px">
<?php unset($a9_width,$a9_space,$a9_padding) ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php $a11_class='text';$a11_value=@$conf['editor']['text-markup']['strong-begin'];$a11_escape=true;$a11_cut='both'; ?><?php
		$a11_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = $a11_escape?htmlentities($a11_value):$a11_value;
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_value,$a11_escape,$a11_cut) ?><?php $a11_class='text';$a11_key='text_markup_strong';$a11_escape=true;$a11_cut='both'; ?><?php
		$a11_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = $langF($a11_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_key,$a11_escape,$a11_cut) ?><?php $a11_class='text';$a11_value=@$conf['editor']['text-markup']['strong-end'];$a11_escape=true;$a11_cut='both'; ?><?php
		$a11_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = $a11_escape?htmlentities($a11_value):$a11_value;
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_value,$a11_escape,$a11_cut) ?><br/><?php $a11_class='text';$a11_value=@$conf['editor']['text-markup']['emphatic-begin'];$a11_escape=true;$a11_cut='both'; ?><?php
		$a11_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = $a11_escape?htmlentities($a11_value):$a11_value;
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_value,$a11_escape,$a11_cut) ?><?php $a11_class='text';$a11_key='text_markup_emphatic';$a11_escape=true;$a11_cut='both'; ?><?php
		$a11_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = $langF($a11_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_key,$a11_escape,$a11_cut) ?><?php $a11_class='text';$a11_value=@$conf['editor']['text-markup']['emphatic-end'];$a11_escape=true;$a11_cut='both'; ?><?php
		$a11_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = $a11_escape?htmlentities($a11_value):$a11_value;
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_value,$a11_escape,$a11_cut) ?></td><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php $a11_class='text';$a11_value=@$conf['editor']['text-markup']['list-numbered'];$a11_escape=true;$a11_cut='both'; ?><?php
		$a11_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = $a11_escape?htmlentities($a11_value):$a11_value;
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_value,$a11_escape,$a11_cut) ?><?php $a11_class='text';$a11_key='text_markup_numbered_list';$a11_escape=true;$a11_cut='both'; ?><?php
		$a11_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = $langF($a11_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_key,$a11_escape,$a11_cut) ?><br/><?php $a11_class='text';$a11_value=@$conf['editor']['text-markup']['list-numbered'];$a11_escape=true;$a11_cut='both'; ?><?php
		$a11_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = $a11_escape?htmlentities($a11_value):$a11_value;
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_value,$a11_escape,$a11_cut) ?><?php $a11_class='text';$a11_raw='...';$a11_escape=true;$a11_cut='both'; ?><?php
		$a11_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a11_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_raw,$a11_escape,$a11_cut) ?><br/></td><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php $a11_class='text';$a11_value=@$conf['editor']['text-markup']['list-unnumbered'];$a11_escape=true;$a11_cut='both'; ?><?php
		$a11_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = $a11_escape?htmlentities($a11_value):$a11_value;
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_value,$a11_escape,$a11_cut) ?><?php $a11_class='text';$a11_key='text_markup_unnumbered_list';$a11_escape=true;$a11_cut='both'; ?><?php
		$a11_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = $langF($a11_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_key,$a11_escape,$a11_cut) ?><br/><?php $a11_class='text';$a11_value=@$conf['editor']['text-markup']['list-unnumbered'];$a11_escape=true;$a11_cut='both'; ?><?php
		$a11_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = $a11_escape?htmlentities($a11_value):$a11_value;
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_value,$a11_escape,$a11_cut) ?><?php $a11_class='text';$a11_raw='...';$a11_escape=true;$a11_cut='both'; ?><?php
		$a11_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a11_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_raw,$a11_escape,$a11_cut) ?><br/></td><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php $a11_class='text';$a11_value=@$conf['editor']['text-markup']['table-cell-sep'];$a11_escape=true;$a11_cut='both'; ?><?php
		$a11_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = $a11_escape?htmlentities($a11_value):$a11_value;
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_value,$a11_escape,$a11_cut) ?><?php $a11_class='text';$a11_key='text_markup_table';$a11_escape=true;$a11_cut='both'; ?><?php
		$a11_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = $langF($a11_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_key,$a11_escape,$a11_cut) ?><?php $a11_class='text';$a11_value=@$conf['editor']['text-markup']['table-cell-sep'];$a11_escape=true;$a11_cut='both'; ?><?php
		$a11_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = $a11_escape?htmlentities($a11_value):$a11_value;
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_value,$a11_escape,$a11_cut) ?><?php $a11_class='text';$a11_raw='...';$a11_escape=true;$a11_cut='both'; ?><?php
		$a11_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a11_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_raw,$a11_escape,$a11_cut) ?><?php $a11_class='text';$a11_value=@$conf['editor']['text-markup']['table-cell-sep'];$a11_escape=true;$a11_cut='both'; ?><?php
		$a11_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = $a11_escape?htmlentities($a11_value):$a11_value;
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_value,$a11_escape,$a11_cut) ?><?php $a11_class='text';$a11_raw='...';$a11_escape=true;$a11_cut='both'; ?><?php
		$a11_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a11_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_raw,$a11_escape,$a11_cut) ?><?php $a11_class='text';$a11_value=@$conf['editor']['text-markup']['table-cell-sep'];$a11_escape=true;$a11_cut='both'; ?><?php
		$a11_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = $a11_escape?htmlentities($a11_value):$a11_value;
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_value,$a11_escape,$a11_cut) ?><br/><?php $a11_class='text';$a11_value=@$conf['editor']['text-markup']['table-cell-sep'];$a11_escape=true;$a11_cut='both'; ?><?php
		$a11_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = $a11_escape?htmlentities($a11_value):$a11_value;
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_value,$a11_escape,$a11_cut) ?><?php $a11_class='text';$a11_raw='...';$a11_escape=true;$a11_cut='both'; ?><?php
		$a11_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a11_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_raw,$a11_escape,$a11_cut) ?><?php $a11_class='text';$a11_value=@$conf['editor']['text-markup']['table-cell-sep'];$a11_escape=true;$a11_cut='both'; ?><?php
		$a11_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = $a11_escape?htmlentities($a11_value):$a11_value;
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_value,$a11_escape,$a11_cut) ?><?php $a11_class='text';$a11_raw='...';$a11_escape=true;$a11_cut='both'; ?><?php
		$a11_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a11_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_raw,$a11_escape,$a11_cut) ?><?php $a11_class='text';$a11_value=@$conf['editor']['text-markup']['table-cell-sep'];$a11_escape=true;$a11_cut='both'; ?><?php
		$a11_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = $a11_escape?htmlentities($a11_value):$a11_value;
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_value,$a11_escape,$a11_cut) ?><?php $a11_class='text';$a11_raw='...';$a11_escape=true;$a11_cut='both'; ?><?php
		$a11_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a11_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_raw,$a11_escape,$a11_cut) ?><?php $a11_class='text';$a11_value=@$conf['editor']['text-markup']['table-cell-sep'];$a11_escape=true;$a11_cut='both'; ?><?php
		$a11_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = $a11_escape?htmlentities($a11_value):$a11_value;
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_value,$a11_escape,$a11_cut) ?><br/></td><?php
	$row_idx    = $last_row_idx;
	$column_idx = $last_column_idx;
?>
</table><?php } ?><?php } ?><?php $a7_equals='text';$a7_value=$editor; ?><?php 
	$a7_tmp_exec = $a7_equals == $a7_value;
	$a7_tmp_last_exec = $a7_tmp_exec;
	if	( $a7_tmp_exec )
	{
?>
<?php unset($a7_equals,$a7_value) ?><?php $a8_name='text';$a8_rows='25';$a8_cols='70';$a8_class='longtext';$a8_default=''; ?><?php if ($this->isEditMode()) {
?><textarea class="<?php echo $a8_class ?>" name="<?php echo $a8_name ?>" rows="<?php echo $a8_rows ?>" cols="<?php echo $a8_cols ?>"><?php echo htmlentities(isset($$a8_name)?$$a8_name:$a8_default) ?></textarea><?php
 } else {
?><span class="<?php echo $a8_class ?>"><?php echo isset($$a8_name)?$$a8_name:$a8_default ?></span><?php } ?><?php unset($a8_name,$a8_rows,$a8_cols,$a8_class,$a8_default) ?><?php $a8_field='text'; ?><?php
if (isset($errors[0])) $a8_field = $errors[0];
?><script name="JavaScript" type="text/javascript"><!--
document.forms[0].<?php echo $a8_field ?>.focus();
document.forms[0].<?php echo $a8_field ?>.select();
</script>
<?php unset($a8_field) ?><?php } ?></td></tr><?php } ?><?php $a4_equals='link';$a4_value=$type; ?><?php 
	$a4_tmp_exec = $a4_equals == $a4_value;
	$a4_tmp_last_exec = $a4_tmp_exec;
	if	( $a4_tmp_exec )
	{
?>
<?php unset($a4_equals,$a4_value) ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php $a7_class='text';$a7_key='link_target';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_key,$a7_escape,$a7_cut) ?></td><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php $a7_list='objects';$a7_name='linkobjectid';$a7_onchange='';$a7_title='';$a7_class='';$a7_addempty=true;$a7_multiple=false;$a7_size='1';$a7_lang=false; ?><?php
$a7_readonly=false;
$a7_tmp_list = $$a7_list;
if ($this->isEditable() && !$this->isEditMode())
{
	echo empty($$a7_name)?'- '.lang('EMPTY').' -':$a7_tmp_list[$$a7_name];
}
else
{
if ( $a7_addempty!==FALSE  )
{
	if ($a7_addempty===TRUE)
		$a7_tmp_list = array(''=>lang('LIST_ENTRY_EMPTY'))+$a7_tmp_list;
	else
		$a7_tmp_list = array(''=>'- '.lang($a7_addempty).' -')+$a7_tmp_list;
}
?><select<?php if ($a7_readonly) echo ' disabled="disabled"' ?> id="id_<?php echo $a7_name ?>"  name="<?php echo $a7_name; if ($a7_multiple) echo '[]'; ?>" onchange="<?php echo $a7_onchange ?>" title="<?php echo $a7_title ?>" class="<?php echo $a7_class ?>"<?php
if (count($$a7_list)<=1) echo ' disabled="disabled"';
if	($a7_multiple) echo ' multiple="multiple"';
if (in_array($a7_name,$errors)) echo ' style="background-color:red; border:2px dashed red;"';
echo ' size="'.intval($a7_size).'"';
?>><?php
		if	( isset($$a7_name) && isset($a7_tmp_list[$$a7_name]) )
			$a7_tmp_default = $$a7_name;
		elseif ( isset($a7_default) )
			$a7_tmp_default = $a7_default;
		else
			$a7_tmp_default = '';
		foreach( $a7_tmp_list as $box_key=>$box_value )
		{
			if	( is_array($box_value) )
			{
				$box_key   = $box_value['key'  ];
				$box_title = $box_value['title'];
				$box_value = $box_value['value'];
			}
			elseif( $a7_lang )
			{
				$box_title = lang( $box_value.'_DESC');
				$box_value = lang( $box_value        );
			}
			else
			{
				$box_title = '';
			}
			echo '<option class="'.$a7_class.'" value="'.$box_key.'" title="'.$box_title.'"';
			if ((string)$box_key==$a7_tmp_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select><?php
if (count($$a7_list)==0) echo '<input type="hidden" name="'.$a7_name.'" value="" />';
if (count($$a7_list)==1) echo '<input type="hidden" name="'.$a7_name.'" value="'.$box_key.'" />';
}
?><?php unset($a7_list,$a7_name,$a7_onchange,$a7_title,$a7_class,$a7_addempty,$a7_multiple,$a7_size,$a7_lang) ?><?php $a7_field='linkobjectid'; ?><?php
if (isset($errors[0])) $a7_field = $errors[0];
?><script name="JavaScript" type="text/javascript"><!--
document.forms[0].<?php echo $a7_field ?>.focus();
document.forms[0].<?php echo $a7_field ?>.select();
</script>
<?php unset($a7_field) ?></td></tr><?php $a5_true=$mode=="edit"; ?><?php 
	if	(gettype($a5_true) === '' && gettype($a5_true) === '1')
		$a5_tmp_exec = $$a5_true == true;
	else
		$a5_tmp_exec = $a5_true == true;
	$a5_tmp_last_exec = $a5_tmp_exec;
	if	( $a5_tmp_exec )
	{
?>
<?php unset($a5_true) ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php $a8_class='text';$a8_key='link_url';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_key,$a8_escape,$a8_cut) ?></td><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php $a8_class='text';$a8_default='';$a8_type='text';$a8_name='linkurl';$a8_size='40';$a8_maxlength='256';$a8_onchange='';$a8_readonly=false; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a8_readonly=true;
	  if ($a8_readonly && empty($$a8_name)) $$a8_name = '- '.lang('EMPTY').' -';
      if(!isset($a8_default)) $a8_default='';
      $tmp_value = Text::encodeHtml(isset($$a8_name)?$$a8_name:$a8_default);
?><?php if (!$a8_readonly || $a8_type=='hidden') {
?><input<?php if ($a8_readonly) echo ' disabled="true"' ?> id="id_<?php echo $a8_name ?><?php if ($a8_readonly) echo '_disabled' ?>" name="<?php echo $a8_name ?><?php if ($a8_readonly) echo '_disabled' ?>" type="<?php echo $a8_type ?>" size="<?php echo $a8_size ?>" maxlength="<?php echo $a8_maxlength ?>" class="<?php echo $a8_class ?>" value="<?php echo $tmp_value ?>" <?php if (in_array($a8_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php
if	($a8_readonly) {
?><input type="hidden" id="id_<?php echo $a8_name ?>" name="<?php echo $a8_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><span class="<?php echo $a8_class ?>"><?php echo $tmp_value ?></span><?php } ?><?php unset($a8_class,$a8_default,$a8_type,$a8_name,$a8_size,$a8_maxlength,$a8_onchange,$a8_readonly) ?></td></tr><?php } ?><?php } ?><?php $a4_equals='list';$a4_value=$type; ?><?php 
	$a4_tmp_exec = $a4_equals == $a4_value;
	$a4_tmp_last_exec = $a4_tmp_exec;
	if	( $a4_tmp_exec )
	{
?>
<?php unset($a4_equals,$a4_value) ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a6_colspan='2'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
 colspan="2"
><?php unset($a6_colspan) ?><?php $a7_list='objects';$a7_name='linkobjectid';$a7_onchange='';$a7_title='';$a7_class='';$a7_addempty=false;$a7_multiple=false;$a7_size='1';$a7_lang=false; ?><?php
$a7_readonly=false;
$a7_tmp_list = $$a7_list;
if ($this->isEditable() && !$this->isEditMode())
{
	echo empty($$a7_name)?'- '.lang('EMPTY').' -':$a7_tmp_list[$$a7_name];
}
else
{
if ( $a7_addempty!==FALSE  )
{
	if ($a7_addempty===TRUE)
		$a7_tmp_list = array(''=>lang('LIST_ENTRY_EMPTY'))+$a7_tmp_list;
	else
		$a7_tmp_list = array(''=>'- '.lang($a7_addempty).' -')+$a7_tmp_list;
}
?><select<?php if ($a7_readonly) echo ' disabled="disabled"' ?> id="id_<?php echo $a7_name ?>"  name="<?php echo $a7_name; if ($a7_multiple) echo '[]'; ?>" onchange="<?php echo $a7_onchange ?>" title="<?php echo $a7_title ?>" class="<?php echo $a7_class ?>"<?php
if (count($$a7_list)<=1) echo ' disabled="disabled"';
if	($a7_multiple) echo ' multiple="multiple"';
if (in_array($a7_name,$errors)) echo ' style="background-color:red; border:2px dashed red;"';
echo ' size="'.intval($a7_size).'"';
?>><?php
		if	( isset($$a7_name) && isset($a7_tmp_list[$$a7_name]) )
			$a7_tmp_default = $$a7_name;
		elseif ( isset($a7_default) )
			$a7_tmp_default = $a7_default;
		else
			$a7_tmp_default = '';
		foreach( $a7_tmp_list as $box_key=>$box_value )
		{
			if	( is_array($box_value) )
			{
				$box_key   = $box_value['key'  ];
				$box_title = $box_value['title'];
				$box_value = $box_value['value'];
			}
			elseif( $a7_lang )
			{
				$box_title = lang( $box_value.'_DESC');
				$box_value = lang( $box_value        );
			}
			else
			{
				$box_title = '';
			}
			echo '<option class="'.$a7_class.'" value="'.$box_key.'" title="'.$box_title.'"';
			if ((string)$box_key==$a7_tmp_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select><?php
if (count($$a7_list)==0) echo '<input type="hidden" name="'.$a7_name.'" value="" />';
if (count($$a7_list)==1) echo '<input type="hidden" name="'.$a7_name.'" value="'.$box_key.'" />';
}
?><?php unset($a7_list,$a7_name,$a7_onchange,$a7_title,$a7_class,$a7_addempty,$a7_multiple,$a7_size,$a7_lang) ?><?php $a7_field='linkobjectid'; ?><?php
if (isset($errors[0])) $a7_field = $errors[0];
?><script name="JavaScript" type="text/javascript"><!--
document.forms[0].<?php echo $a7_field ?>.focus();
document.forms[0].<?php echo $a7_field ?>.select();
</script>
<?php unset($a7_field) ?></td></tr><?php } ?><?php $a4_equals='insert';$a4_value=$type; ?><?php 
	$a4_tmp_exec = $a4_equals == $a4_value;
	$a4_tmp_last_exec = $a4_tmp_exec;
	if	( $a4_tmp_exec )
	{
?>
<?php unset($a4_equals,$a4_value) ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a6_colspan='2'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
 colspan="2"
><?php unset($a6_colspan) ?><?php $a7_list='objects';$a7_name='linkobjectid';$a7_onchange='';$a7_title='';$a7_class='';$a7_addempty=false;$a7_multiple=false;$a7_size='1';$a7_lang=false; ?><?php
$a7_readonly=false;
$a7_tmp_list = $$a7_list;
if ($this->isEditable() && !$this->isEditMode())
{
	echo empty($$a7_name)?'- '.lang('EMPTY').' -':$a7_tmp_list[$$a7_name];
}
else
{
if ( $a7_addempty!==FALSE  )
{
	if ($a7_addempty===TRUE)
		$a7_tmp_list = array(''=>lang('LIST_ENTRY_EMPTY'))+$a7_tmp_list;
	else
		$a7_tmp_list = array(''=>'- '.lang($a7_addempty).' -')+$a7_tmp_list;
}
?><select<?php if ($a7_readonly) echo ' disabled="disabled"' ?> id="id_<?php echo $a7_name ?>"  name="<?php echo $a7_name; if ($a7_multiple) echo '[]'; ?>" onchange="<?php echo $a7_onchange ?>" title="<?php echo $a7_title ?>" class="<?php echo $a7_class ?>"<?php
if (count($$a7_list)<=1) echo ' disabled="disabled"';
if	($a7_multiple) echo ' multiple="multiple"';
if (in_array($a7_name,$errors)) echo ' style="background-color:red; border:2px dashed red;"';
echo ' size="'.intval($a7_size).'"';
?>><?php
		if	( isset($$a7_name) && isset($a7_tmp_list[$$a7_name]) )
			$a7_tmp_default = $$a7_name;
		elseif ( isset($a7_default) )
			$a7_tmp_default = $a7_default;
		else
			$a7_tmp_default = '';
		foreach( $a7_tmp_list as $box_key=>$box_value )
		{
			if	( is_array($box_value) )
			{
				$box_key   = $box_value['key'  ];
				$box_title = $box_value['title'];
				$box_value = $box_value['value'];
			}
			elseif( $a7_lang )
			{
				$box_title = lang( $box_value.'_DESC');
				$box_value = lang( $box_value        );
			}
			else
			{
				$box_title = '';
			}
			echo '<option class="'.$a7_class.'" value="'.$box_key.'" title="'.$box_title.'"';
			if ((string)$box_key==$a7_tmp_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select><?php
if (count($$a7_list)==0) echo '<input type="hidden" name="'.$a7_name.'" value="" />';
if (count($$a7_list)==1) echo '<input type="hidden" name="'.$a7_name.'" value="'.$box_key.'" />';
}
?><?php unset($a7_list,$a7_name,$a7_onchange,$a7_title,$a7_class,$a7_addempty,$a7_multiple,$a7_size,$a7_lang) ?><?php $a7_field='linkobjectid'; ?><?php
if (isset($errors[0])) $a7_field = $errors[0];
?><script name="JavaScript" type="text/javascript"><!--
document.forms[0].<?php echo $a7_field ?>.focus();
document.forms[0].<?php echo $a7_field ?>.select();
</script>
<?php unset($a7_field) ?></td></tr><?php } ?><?php $a4_equals='number';$a4_value=$type; ?><?php 
	$a4_tmp_exec = $a4_equals == $a4_value;
	$a4_tmp_last_exec = $a4_tmp_exec;
	if	( $a4_tmp_exec )
	{
?>
<?php unset($a4_equals,$a4_value) ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a6_colspan='2'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
 colspan="2"
><?php unset($a6_colspan) ?><?php $a7_name='decimals';$a7_default='decimals'; ?><?php
if (isset($$a7_name))
	$a7_tmp_value = $$a7_name;
elseif ( isset($a7_default) )
	$a7_tmp_value = $a7_default;
else
	$a7_tmp_value = "";
?><input type="hidden" name="<?php echo $a7_name ?>" value="<?php echo $a7_tmp_value ?>" /><?php unset($a7_name,$a7_default) ?><?php $a7_class='text';$a7_default='';$a7_type='text';$a7_name='number';$a7_size='15';$a7_maxlength='20';$a7_onchange='';$a7_readonly=false; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a7_readonly=true;
	  if ($a7_readonly && empty($$a7_name)) $$a7_name = '- '.lang('EMPTY').' -';
      if(!isset($a7_default)) $a7_default='';
      $tmp_value = Text::encodeHtml(isset($$a7_name)?$$a7_name:$a7_default);
?><?php if (!$a7_readonly || $a7_type=='hidden') {
?><input<?php if ($a7_readonly) echo ' disabled="true"' ?> id="id_<?php echo $a7_name ?><?php if ($a7_readonly) echo '_disabled' ?>" name="<?php echo $a7_name ?><?php if ($a7_readonly) echo '_disabled' ?>" type="<?php echo $a7_type ?>" size="<?php echo $a7_size ?>" maxlength="<?php echo $a7_maxlength ?>" class="<?php echo $a7_class ?>" value="<?php echo $tmp_value ?>" <?php if (in_array($a7_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php
if	($a7_readonly) {
?><input type="hidden" id="id_<?php echo $a7_name ?>" name="<?php echo $a7_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><span class="<?php echo $a7_class ?>"><?php echo $tmp_value ?></span><?php } ?><?php unset($a7_class,$a7_default,$a7_type,$a7_name,$a7_size,$a7_maxlength,$a7_onchange,$a7_readonly) ?><?php $a7_field='number'; ?><?php
if (isset($errors[0])) $a7_field = $errors[0];
?><script name="JavaScript" type="text/javascript"><!--
document.forms[0].<?php echo $a7_field ?>.focus();
document.forms[0].<?php echo $a7_field ?>.select();
</script>
<?php unset($a7_field) ?></td></tr><?php } ?><?php $a4_equals='select';$a4_value=$type; ?><?php 
	$a4_tmp_exec = $a4_equals == $a4_value;
	$a4_tmp_last_exec = $a4_tmp_exec;
	if	( $a4_tmp_exec )
	{
?>
<?php unset($a4_equals,$a4_value) ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a6_colspan='2'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
 colspan="2"
><?php unset($a6_colspan) ?><?php $a7_list='items';$a7_name='text';$a7_onchange='';$a7_title='';$a7_class='';$a7_addempty=false;$a7_multiple=false;$a7_size='1';$a7_lang=false; ?><?php
$a7_readonly=false;
$a7_tmp_list = $$a7_list;
if ($this->isEditable() && !$this->isEditMode())
{
	echo empty($$a7_name)?'- '.lang('EMPTY').' -':$a7_tmp_list[$$a7_name];
}
else
{
if ( $a7_addempty!==FALSE  )
{
	if ($a7_addempty===TRUE)
		$a7_tmp_list = array(''=>lang('LIST_ENTRY_EMPTY'))+$a7_tmp_list;
	else
		$a7_tmp_list = array(''=>'- '.lang($a7_addempty).' -')+$a7_tmp_list;
}
?><select<?php if ($a7_readonly) echo ' disabled="disabled"' ?> id="id_<?php echo $a7_name ?>"  name="<?php echo $a7_name; if ($a7_multiple) echo '[]'; ?>" onchange="<?php echo $a7_onchange ?>" title="<?php echo $a7_title ?>" class="<?php echo $a7_class ?>"<?php
if (count($$a7_list)<=1) echo ' disabled="disabled"';
if	($a7_multiple) echo ' multiple="multiple"';
if (in_array($a7_name,$errors)) echo ' style="background-color:red; border:2px dashed red;"';
echo ' size="'.intval($a7_size).'"';
?>><?php
		if	( isset($$a7_name) && isset($a7_tmp_list[$$a7_name]) )
			$a7_tmp_default = $$a7_name;
		elseif ( isset($a7_default) )
			$a7_tmp_default = $a7_default;
		else
			$a7_tmp_default = '';
		foreach( $a7_tmp_list as $box_key=>$box_value )
		{
			if	( is_array($box_value) )
			{
				$box_key   = $box_value['key'  ];
				$box_title = $box_value['title'];
				$box_value = $box_value['value'];
			}
			elseif( $a7_lang )
			{
				$box_title = lang( $box_value.'_DESC');
				$box_value = lang( $box_value        );
			}
			else
			{
				$box_title = '';
			}
			echo '<option class="'.$a7_class.'" value="'.$box_key.'" title="'.$box_title.'"';
			if ((string)$box_key==$a7_tmp_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select><?php
if (count($$a7_list)==0) echo '<input type="hidden" name="'.$a7_name.'" value="" />';
if (count($$a7_list)==1) echo '<input type="hidden" name="'.$a7_name.'" value="'.$box_key.'" />';
}
?><?php unset($a7_list,$a7_name,$a7_onchange,$a7_title,$a7_class,$a7_addempty,$a7_multiple,$a7_size,$a7_lang) ?><?php $a7_field='text'; ?><?php
if (isset($errors[0])) $a7_field = $errors[0];
?><script name="JavaScript" type="text/javascript"><!--
document.forms[0].<?php echo $a7_field ?>.focus();
document.forms[0].<?php echo $a7_field ?>.select();
</script>
<?php unset($a7_field) ?></td></tr><?php } ?><?php $a4_true=$mode=="edit"; ?><?php 
	if	(gettype($a4_true) === '' && gettype($a4_true) === '1')
		$a4_tmp_exec = $$a4_true == true;
	else
		$a4_tmp_exec = $a4_true == true;
	$a4_tmp_last_exec = $a4_tmp_exec;
	if	( $a4_tmp_exec )
	{
?>
<?php unset($a4_true) ?><?php $a5_equals='longtext';$a5_value=$type; ?><?php 
	$a5_tmp_exec = $a5_equals == $a5_value;
	$a5_tmp_last_exec = $a5_tmp_exec;
	if	( $a5_tmp_exec )
	{
?>
<?php unset($a5_equals,$a5_value) ?><?php $a6_equals='wiki';$a6_value=$editor; ?><?php 
	$a6_tmp_exec = $a6_equals == $a6_value;
	$a6_tmp_last_exec = $a6_tmp_exec;
	if	( $a6_tmp_exec )
	{
?>
<?php unset($a6_equals,$a6_value) ?><?php $a7_present='languages'; ?><?php 
	$a7_tmp_exec = isset($$a7_present);
	$a7_tmp_last_exec = $a7_tmp_exec;
	if	( $a7_tmp_exec )
	{
?>
<?php unset($a7_present) ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a9_colspan='2'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
 colspan="2"
><?php unset($a9_colspan) ?><?php $a10_title=lang('editor_show_language'); ?><fieldset><?php if(isset($a10_title)) { ?><legend><?php if(isset($a10_icon)) { ?><image src="<?php echo $image_dir.'icon_'.$a10_icon.IMG_ICON_EXT ?>" align="left" border="0"><?php } ?><?php echo encodeHtml($a10_title) ?></legend><?php } ?><?php unset($a10_title) ?></fieldset></td></tr><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a9_colspan='2'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
 colspan="2"
><?php unset($a9_colspan) ?><?php $a10_list='languages';$a10_extract=false;$a10_key='languageid';$a10_value='languagename'; ?><?php
	$a10_list_tmp_key   = $a10_key;
	$a10_list_tmp_value = $a10_value;
	$a10_list_extract   = $a10_extract;
	unset($a10_key);
	unset($a10_value);
	if	( !isset($$a10_list) || !is_array($$a10_list) )
		$$a10_list = array();
	foreach( $$a10_list as $$a10_list_tmp_key => $$a10_list_tmp_value )
	{
		if	( $a10_list_extract )
		{
			if	( !is_array($$a10_list_tmp_value) )
			{
				print_r($$a10_list_tmp_value);
				die( 'not an array at key: '.$$a10_list_tmp_key );
			}
			extract($$a10_list_tmp_value);
		}
?><?php unset($a10_list,$a10_extract,$a10_key,$a10_value) ?><?php $a11_readonly=false;$a11_name='otherlanguageid';$a11_value=$languageid;$a11_default=false;$a11_prefix='';$a11_suffix='';$a11_class='';$a11_onchange=''; ?><?php
		if ($this->isEditable() && !$this->isEditMode()) $a11_readonly=true;
		if	( isset($$a11_name)  )
			$a11_tmp_default = $$a11_name;
		elseif ( isset($a11_default) )
			$a11_tmp_default = $a11_default;
		else
			$a11_tmp_default = '';
 ?><input onclick="" class="radio" type="radio" id="id_<?php echo $a11_name.'_'.$a11_value ?>"  name="<?php echo $a11_prefix.$a11_name ?>"<?php if ( $a11_readonly ) echo ' disabled="disabled"' ?> value="<?php echo $a11_value ?>" <?php if($a11_value==$a11_tmp_default) echo 'checked="checked"' ?><?php if (in_array($a11_name,$errors)) echo ' style="borderx:2px dashed red; background-color:red;"' ?> />
<?php /* #END-IF# */ ?><?php unset($a11_readonly,$a11_name,$a11_value,$a11_default,$a11_prefix,$a11_suffix,$a11_class,$a11_onchange) ?><?php $a11_for='otherlanguageid_'.$languageid.''; ?><label for="id_<?php echo $a11_for ?><?php if (!empty($a11_value)) echo '_'.$a11_value ?>"><?php unset($a11_for) ?><?php $a12_class='text';$a12_var='languagename';$a12_escape=true;$a12_cut='both'; ?><?php
		$a12_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a12_class ?>" title="<?php echo $a12_title ?>"><?php
		$langF = $a12_escape?'langHtml':'lang';
		$tmp_text = isset($$a12_var)?$$a12_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a12_class,$a12_var,$a12_escape,$a12_cut) ?></label><br/><?php } ?></td></tr><?php } ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a8_colspan='2'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
 colspan="2"
><?php unset($a8_colspan) ?><?php $a9_title=lang('PAGE_PREVIEW'); ?><fieldset><?php if(isset($a9_title)) { ?><legend><?php if(isset($a9_icon)) { ?><image src="<?php echo $image_dir.'icon_'.$a9_icon.IMG_ICON_EXT ?>" align="left" border="0"><?php } ?><?php echo encodeHtml($a9_title) ?></legend><?php } ?><?php unset($a9_title) ?></fieldset></td></tr><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a8_colspan='2'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
 colspan="2"
><?php unset($a8_colspan) ?><?php $a9_default=false;$a9_readonly=false;$a9_name='preview'; ?><?php
	if ($this->isEditable() && !$this->isEditMode()) $a9_readonly=true;
	if	( isset($$a9_name) )
		$checked = $$a9_name;
	else
		$checked = $a9_default;
?><input class="checkbox" type="checkbox" id="id_<?php echo $a9_name ?>" name="<?php echo $a9_name  ?>"  <?php if ($a9_readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?><?php if (in_array($a9_name,$errors)) echo ' style="background-color:red;"' ?> /><?php
if ( $a9_readonly && $checked )
{ 
?><input type="hidden" name="<?php echo $a9_name ?>" value="1" /><?php
}
?><?php unset($a9_name); unset($a9_readonly); unset($a9_default); ?><?php unset($a9_default,$a9_readonly,$a9_name) ?><?php $a9_for='preview'; ?><label for="id_<?php echo $a9_for ?><?php if (!empty($a9_value)) echo '_'.$a9_value ?>"><?php unset($a9_for) ?><?php $a10_class='text';$a10_key='PAGE_PREVIEW';$a10_escape=true;$a10_cut='both'; ?><?php
		$a10_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a10_class ?>" title="<?php echo $a10_title ?>"><?php
		$langF = $a10_escape?'langHtml':'lang';
		$tmp_text = $langF($a10_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a10_class,$a10_key,$a10_escape,$a10_cut) ?></label></td></tr><?php } ?><?php } ?><?php } ?><?php $a4_true=$mode=="edit"; ?><?php 
	if	(gettype($a4_true) === '' && gettype($a4_true) === '1')
		$a4_tmp_exec = $$a4_true == true;
	else
		$a4_tmp_exec = $a4_true == true;
	$a4_tmp_last_exec = $a4_tmp_exec;
	if	( $a4_tmp_exec )
	{
?>
<?php unset($a4_true) ?><?php $a5_present='release'; ?><?php 
	$a5_tmp_exec = isset($$a5_present);
	$a5_tmp_last_exec = $a5_tmp_exec;
	if	( $a5_tmp_exec )
	{
?>
<?php unset($a5_present) ?><?php $a6_present='publish'; ?><?php 
	$a6_tmp_exec = isset($$a6_present);
	$a6_tmp_last_exec = $a6_tmp_exec;
	if	( $a6_tmp_exec )
	{
?>
<?php unset($a6_present) ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a8_colspan='2'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
 colspan="2"
><?php unset($a8_colspan) ?><?php $a9_title=lang('options'); ?><fieldset><?php if(isset($a9_title)) { ?><legend><?php if(isset($a9_icon)) { ?><image src="<?php echo $image_dir.'icon_'.$a9_icon.IMG_ICON_EXT ?>" align="left" border="0"><?php } ?><?php echo encodeHtml($a9_title) ?></legend><?php } ?><?php unset($a9_title) ?></fieldset></td></tr><?php } ?><?php } ?><?php $a5_present='release'; ?><?php 
	$a5_tmp_exec = isset($$a5_present);
	$a5_tmp_last_exec = $a5_tmp_exec;
	if	( $a5_tmp_exec )
	{
?>
<?php unset($a5_present) ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a7_colspan='2'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
 colspan="2"
><?php unset($a7_colspan) ?><?php $a8_default=false;$a8_readonly=false;$a8_name='release'; ?><?php
	if ($this->isEditable() && !$this->isEditMode()) $a8_readonly=true;
	if	( isset($$a8_name) )
		$checked = $$a8_name;
	else
		$checked = $a8_default;
?><input class="checkbox" type="checkbox" id="id_<?php echo $a8_name ?>" name="<?php echo $a8_name  ?>"  <?php if ($a8_readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?><?php if (in_array($a8_name,$errors)) echo ' style="background-color:red;"' ?> /><?php
if ( $a8_readonly && $checked )
{ 
?><input type="hidden" name="<?php echo $a8_name ?>" value="1" /><?php
}
?><?php unset($a8_name); unset($a8_readonly); unset($a8_default); ?><?php unset($a8_default,$a8_readonly,$a8_name) ?><?php $a8_for='release'; ?><label for="id_<?php echo $a8_for ?><?php if (!empty($a8_value)) echo '_'.$a8_value ?>"><?php unset($a8_for) ?><?php $a9_class='text';$a9_text='GLOBAL_RELEASE';$a9_escape=true;$a9_cut='both'; ?><?php
		$a9_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a9_class ?>" title="<?php echo $a9_title ?>"><?php
		$langF = $a9_escape?'langHtml':'lang';
		$tmp_text = $langF($a9_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a9_class,$a9_text,$a9_escape,$a9_cut) ?></label></td></tr><?php } ?><?php $a5_present='publish'; ?><?php 
	$a5_tmp_exec = isset($$a5_present);
	$a5_tmp_last_exec = $a5_tmp_exec;
	if	( $a5_tmp_exec )
	{
?>
<?php unset($a5_present) ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a7_colspan='2'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
 colspan="2"
><?php unset($a7_colspan) ?><?php $a8_default=false;$a8_readonly=false;$a8_name='publish'; ?><?php
	if ($this->isEditable() && !$this->isEditMode()) $a8_readonly=true;
	if	( isset($$a8_name) )
		$checked = $$a8_name;
	else
		$checked = $a8_default;
?><input class="checkbox" type="checkbox" id="id_<?php echo $a8_name ?>" name="<?php echo $a8_name  ?>"  <?php if ($a8_readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?><?php if (in_array($a8_name,$errors)) echo ' style="background-color:red;"' ?> /><?php
if ( $a8_readonly && $checked )
{ 
?><input type="hidden" name="<?php echo $a8_name ?>" value="1" /><?php
}
?><?php unset($a8_name); unset($a8_readonly); unset($a8_default); ?><?php unset($a8_default,$a8_readonly,$a8_name) ?><?php $a8_for='publish'; ?><label for="id_<?php echo $a8_for ?><?php if (!empty($a8_value)) echo '_'.$a8_value ?>"><?php unset($a8_for) ?><?php $a9_class='text';$a9_text='PAGE_PUBLISH_AFTER_SAVE';$a9_escape=true;$a9_cut='both'; ?><?php
		$a9_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a9_class ?>" title="<?php echo $a9_title ?>"><?php
		$langF = $a9_escape?'langHtml':'lang';
		$tmp_text = $langF($a9_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a9_class,$a9_text,$a9_escape,$a9_cut) ?></label></td></tr><?php } ?><?php } ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a5_class='act';$a5_colspan='2'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="act"
 colspan="2"
><?php unset($a5_class,$a5_colspan) ?><?php $a6_type='ok';$a6_class='ok';$a6_value='ok';$a6_text='button_ok'; ?><?php
		if ($this->isEditable() && !$this->isEditMode())
		$a6_text = 'MODE_EDIT';
		$a6_type = 'submit';
		if	( $this->isEditable() && readonly() )
			$a6_type = ''; // Knopf nicht anzeigen
		$a6_src  = '';
	if	( !empty($a6_type) ) {
?><input type="<?php echo $a6_type ?>"<?php if(isset($a6_src)) { ?> src="<?php echo $image_dir.'icon_'.$a6_src.IMG_ICON_EXT ?>"<?php } ?> name="<?php echo $a6_value ?>" class="ok" title="<?php echo lang($a6_text.'_DESC') ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo langHtml($a6_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($a6_src)
?><?php } 
?><?php unset($a6_type,$a6_class,$a6_value,$a6_text) ?></td></tr>      </table>
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
</form>
</body>
</html>