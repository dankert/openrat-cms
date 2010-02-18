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
<?php /* Debug-Information */ if ($showDuration) { echo "<!-- Output Variables are:\n";echo str_replace('-->','-- >',print_r($this->templateVars,true));echo "\n-->";} ?><?php unset($a1_class) ?><?php $a2_action='folder';$a2_subaction='edit';$a2_name='';$a2_target='_self';$a2_method='post';$a2_enctype='application/x-www-form-urlencoded'; ?><?php
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
<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo $a2_action ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo $a2_subaction ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo $a2_id ?>" /><?php
		if	( $conf['interface']['url_sessionid'] )
			echo '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";
?><?php unset($a2_action,$a2_subaction,$a2_name,$a2_target,$a2_method,$a2_enctype) ?><?php $a3_title='titelso';$a3_name='bla';$a3_widths='5%,75%';$a3_width='93%';$a3_rowclasses='odd,even';$a3_columnclasses='1,2,3'; ?><?php
	$coloumn_widths=array();
	$column_widths = explode(',',$a3_widths);
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
<?php unset($a3_title,$a3_name,$a3_widths,$a3_width,$a3_rowclasses,$a3_columnclasses) ?><?php $a4_class='headline'; ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
 class="headline"
>
<?php unset($a4_class) ?><?php $a5_class='help'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="help"
><?php unset($a5_class) ?><?php $a6_class='text';$a6_key='SELECT';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_key,$a6_escape,$a6_cut) ?></td><?php $a5_class='help'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="help"
><?php unset($a5_class) ?><?php $a6_class='text';$a6_key='GLOBAL_TYPE';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_key,$a6_escape,$a6_cut) ?><?php $a6_class='text';$a6_raw='_/_';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a6_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_raw,$a6_escape,$a6_cut) ?><?php $a6_class='text';$a6_key='GLOBAL_NAME';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_key,$a6_escape,$a6_cut) ?></td></tr><?php $a4_list='object';$a4_extract=true;$a4_key='list_key';$a4_value='list_value'; ?><?php
	$a4_list_tmp_key   = $a4_key;
	$a4_list_tmp_value = $a4_value;
	$a4_list_extract   = $a4_extract;
	unset($a4_key);
	unset($a4_value);
	if	( !isset($$a4_list) || !is_array($$a4_list) )
		$$a4_list = array();
	foreach( $$a4_list as $$a4_list_tmp_key => $$a4_list_tmp_value )
	{
		if	( $a4_list_extract )
		{
			if	( !is_array($$a4_list_tmp_value) )
			{
				print_r($$a4_list_tmp_value);
				die( 'not an array at key: '.$$a4_list_tmp_key );
			}
			extract($$a4_list_tmp_value);
		}
?><?php unset($a4_list,$a4_extract,$a4_key,$a4_value) ?><?php $a5_class='data'; ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
 class="data"
>
<?php unset($a5_class) ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php $a7_true='writable'; ?><?php 
	if	(gettype($a7_true) === '' && gettype($a7_true) === '1')
		$a7_tmp_exec = $$a7_true == true;
	else
		$a7_tmp_exec = $a7_true == true;
	$a7_tmp_last_exec = $a7_tmp_exec;
	if	( $a7_tmp_exec )
	{
?>
<?php unset($a7_true) ?><?php $a8_default=false;$a8_readonly=false;$a8_name=$id; ?><?php
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
?><?php unset($a8_name); unset($a8_readonly); unset($a8_default); ?><?php unset($a8_default,$a8_readonly,$a8_name) ?><?php } ?><?php $a7_false='writable'; ?><?php 
	if	(gettype($a7_false) === '' && gettype($a7_false) === '1')
		$a7_tmp_exec = $$a7_false == false;
	else
		$a7_tmp_exec = $a7_false == false;
	$a7_tmp_last_exec = $a7_tmp_exec;
	if	( $a7_tmp_exec )
	{
?>
<?php unset($a7_false) ?><?php $a8_class='text';$a8_raw='_';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a8_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_raw,$a8_escape,$a8_cut) ?><?php } ?></td><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php $a7_for=$id; ?><label for="id_<?php echo $a7_for ?><?php if (!empty($a7_value)) echo '_'.$a7_value ?>"><?php unset($a7_for) ?><?php $a8_align='left';$a8_type=$icon; ?><?php
	$a8_tmp_image_file = $image_dir.'icon_'.$a8_type.IMG_ICON_EXT;
	$a8_size = '16x16';
	$a8_tmp_title = basename($a8_tmp_image_file);
?><img alt="<?php echo $a8_tmp_title; if (isset($a8_size)) { echo ' ('; list($a8_tmp_width,$a8_tmp_height)=explode('x',$a8_size);echo $a8_tmp_width.'x'.$a8_tmp_height; echo')';} ?>" src="<?php echo $a8_tmp_image_file ?>" border="0"<?php if(isset($a8_align)) echo ' align="'.$a8_align.'"' ?><?php if (isset($a8_size)) { list($a8_tmp_width,$a8_tmp_height)=explode('x',$a8_size);echo ' width="'.$a8_tmp_width.'" height="'.$a8_tmp_height.'"';} ?>><?php unset($a8_align,$a8_type) ?><?php $a8_class='text';$a8_var='name';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = isset($$a8_var)?$$a8_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_var,$a8_escape,$a8_cut) ?><?php $a8_class='text';$a8_raw='_';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a8_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_raw,$a8_escape,$a8_cut) ?></label></td></tr><?php } ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a5_colspan='2'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
 colspan="2"
><?php unset($a5_colspan) ?><?php $a6_align='left';$a6_fileext='tree_none_end.gif'; ?><?php
	$a6_tmp_image_file = $image_dir.$a6_fileext;
	$a6_tmp_title = basename($a6_tmp_image_file);
?><img alt="<?php echo $a6_tmp_title; if (isset($a6_size)) { echo ' ('; list($a6_tmp_width,$a6_tmp_height)=explode('x',$a6_size);echo $a6_tmp_width.'x'.$a6_tmp_height; echo')';} ?>" src="<?php echo $a6_tmp_image_file ?>" border="0"<?php if(isset($a6_align)) echo ' align="'.$a6_align.'"' ?><?php if (isset($a6_size)) { list($a6_tmp_width,$a6_tmp_height)=explode('x',$a6_size);echo ' width="'.$a6_tmp_width.'" height="'.$a6_tmp_height.'"';} ?>><?php unset($a6_align,$a6_fileext) ?><?php $a6_class='text';$a6_raw='_';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a6_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_raw,$a6_escape,$a6_cut) ?><?php $a6_title='';$a6_target='_self';$a6_class='';$a6_action=$actionName;$a6_subaction='select';$a6_var1='markall';$a6_value1='1'; ?><?php
	$params = array();
		$params[$a6_var1]=$a6_value1;
	$tmp_url = '';
		$tmp_url = Html::url($a6_action,$a6_subaction,!empty($a6_id)?$a6_id:$this->getRequestId(),$params);
?><a<?php if (isset($a6_name)) echo ' name="'.$a6_name.'"'; else echo ' href="'.$tmp_url.(isset($a6_anchor)?'#'.$a6_anchor:'').'"' ?> class="<?php echo $a6_class ?>" target="<?php echo $a6_target ?>"<?php if (isset($a6_accesskey)) echo ' accesskey="'.$a6_accesskey.'"' ?>  title="<?php echo encodeHtml($a6_title) ?>"><?php unset($a6_title,$a6_target,$a6_class,$a6_action,$a6_subaction,$a6_var1,$a6_value1) ?><?php $a7_class='text';$a7_key='FOLDER_MARK_ALL';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_key,$a7_escape,$a7_cut) ?></a><?php $a6_class='text';$a6_raw='_|_';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a6_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_raw,$a6_escape,$a6_cut) ?><?php $a6_title='';$a6_target='_self';$a6_url='javascript:unmark();';$a6_class=''; ?><?php
	$params = array();
	$tmp_url = '';
		$tmp_url = $a6_url;
?><a<?php if (isset($a6_name)) echo ' name="'.$a6_name.'"'; else echo ' href="'.$tmp_url.(isset($a6_anchor)?'#'.$a6_anchor:'').'"' ?> class="<?php echo $a6_class ?>" target="<?php echo $a6_target ?>"<?php if (isset($a6_accesskey)) echo ' accesskey="'.$a6_accesskey.'"' ?>  title="<?php echo encodeHtml($a6_title) ?>"><?php unset($a6_title,$a6_target,$a6_url,$a6_class) ?><?php $a7_class='text';$a7_key='FOLDER_UNMARK_ALL';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_key,$a7_escape,$a7_cut) ?></a><?php $a6_class='text';$a6_raw='_|_';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a6_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_raw,$a6_escape,$a6_cut) ?><?php $a6_title='';$a6_target='_self';$a6_url='javascript:flip();';$a6_class=''; ?><?php
	$params = array();
	$tmp_url = '';
		$tmp_url = $a6_url;
?><a<?php if (isset($a6_name)) echo ' name="'.$a6_name.'"'; else echo ' href="'.$tmp_url.(isset($a6_anchor)?'#'.$a6_anchor:'').'"' ?> class="<?php echo $a6_class ?>" target="<?php echo $a6_target ?>"<?php if (isset($a6_accesskey)) echo ' accesskey="'.$a6_accesskey.'"' ?>  title="<?php echo encodeHtml($a6_title) ?>"><?php unset($a6_title,$a6_target,$a6_url,$a6_class) ?><?php $a7_class='text';$a7_key='FOLDER_FLIP_MARK';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_key,$a7_escape,$a7_cut) ?></a></td></tr><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a5_colspan='2'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
 colspan="2"
><?php unset($a5_colspan) ?><?php $a6_title=lang('options'); ?><fieldset><?php if(isset($a6_title)) { ?><legend><?php echo encodeHtml($a6_title) ?></legend><?php } ?><?php unset($a6_title) ?></fieldset></td></tr><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a5_colspan='2'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
 colspan="2"
><?php unset($a5_colspan) ?><?php $a6_var='type';$a6_value=$defaulttype; ?><?php
	if (isset($a6_key))
		$$a6_var = $a6_value[$a6_key];
	else
		$$a6_var = $a6_value;
?><?php unset($a6_var,$a6_value) ?><?php $a6_list='actionlist';$a6_extract=false;$a6_key='list_key';$a6_value='actiontype'; ?><?php
	$a6_list_tmp_key   = $a6_key;
	$a6_list_tmp_value = $a6_value;
	$a6_list_extract   = $a6_extract;
	unset($a6_key);
	unset($a6_value);
	if	( !isset($$a6_list) || !is_array($$a6_list) )
		$$a6_list = array();
	foreach( $$a6_list as $$a6_list_tmp_key => $$a6_list_tmp_value )
	{
		if	( $a6_list_extract )
		{
			if	( !is_array($$a6_list_tmp_value) )
			{
				print_r($$a6_list_tmp_value);
				die( 'not an array at key: '.$$a6_list_tmp_key );
			}
			extract($$a6_list_tmp_value);
		}
?><?php unset($a6_list,$a6_extract,$a6_key,$a6_value) ?><?php $a7_readonly=false;$a7_name='type';$a7_value=$actiontype;$a7_default=false;$a7_prefix='';$a7_suffix='';$a7_class='';$a7_onchange=''; ?><?php
		if ($this->isEditable() && !$this->isEditMode()) $a7_readonly=true;
		if	( isset($$a7_name)  )
			$a7_tmp_default = $$a7_name;
		elseif ( isset($a7_default) )
			$a7_tmp_default = $a7_default;
		else
			$a7_tmp_default = '';
 ?><input onclick="" class="radio" type="radio" id="id_<?php echo $a7_name.'_'.$a7_value ?>"  name="<?php echo $a7_prefix.$a7_name ?>"<?php if ( $a7_readonly ) echo ' disabled="disabled"' ?> value="<?php echo $a7_value ?>" <?php if($a7_value==$a7_tmp_default) echo 'checked="checked"' ?><?php if (in_array($a7_name,$errors)) echo ' style="borderx:2px dashed red; background-color:red;"' ?> />
<?php /* #END-IF# */ ?><?php unset($a7_readonly,$a7_name,$a7_value,$a7_default,$a7_prefix,$a7_suffix,$a7_class,$a7_onchange) ?><?php $a7_for='type';$a7_value=$actiontype; ?><label for="id_<?php echo $a7_for ?><?php if (!empty($a7_value)) echo '_'.$a7_value ?>"><?php unset($a7_for,$a7_value) ?><?php $a8_class='text';$a8_raw='_';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a8_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_raw,$a8_escape,$a8_cut) ?><?php $a8_class='text';$a8_key=$actiontype;$a8_prefix='FOLDER_SELECT_';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_key = $a8_prefix.$a8_key;
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_key,$a8_prefix,$a8_escape,$a8_cut) ?></label><br/><?php } ?></td></tr><?php
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
><?php unset($a5_class,$a5_colspan) ?><?php $a6_type='ok';$a6_class='ok';$a6_value='ok';$a6_text='button_next'; ?><?php
		if ($this->isEditable() && !$this->isEditMode())
		$a6_text = 'MODE_EDIT';
		$a6_type = 'submit';
		if	( $this->isEditable() && readonly() )
			$a6_type = ''; // Knopf nicht anzeigen
		$a6_src  = '';
	if	( !empty($a6_type) ) {
?><input type="<?php echo $a6_type ?>"<?php if(isset($a6_src)) { ?> src="<?php echo $image_dir.'icon_'.$a6_src.IMG_ICON_EXT ?>"<?php } ?> name="<?php echo $a6_value ?>" class="ok" title="<?php echo lang($a6_text.'_DESC') ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo langHtml($a6_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($a6_src)
?><?php } 
?><?php unset($a6_type,$a6_class,$a6_value,$a6_text) ?></td></tr><?php $a4_empty='object'; ?><?php 
	if	( !isset($$a4_empty) )
		$a4_tmp_exec = empty($a4_empty);
	elseif	( is_array($$a4_empty) )
		$a4_tmp_exec = (count($$a4_empty)==0);
	elseif	( is_bool($$a4_empty) )
		$a4_tmp_exec = true;
	else
		$a4_tmp_exec = empty( $$a4_empty );
	$a4_tmp_last_exec = $a4_tmp_exec;
	if	( $a4_tmp_exec )
	{
?>
<?php unset($a4_empty) ?><?php
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
><?php unset($a6_colspan) ?><?php $a7_class='text';$a7_text='GLOBAL_NOT_FOUND';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_text,$a7_escape,$a7_cut) ?></td></tr><?php } ?>      </table>
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
<?php $a2_script='mark';$a2_inline=true; ?><?php
$a2_tmp_file = $tpl_dir.'../../js/'.basename($a2_script).'.js';
if	(!$a2_inline)
{
	?><script src="<?php echo $a2_tmp_file ?>" type="text/javascript"></script><?php 
}
else
{
	echo '<script type="text/javascript">';
	echo str_replace('  ',' ',str_replace('~','',strtr(implode('',file($a2_tmp_file)),"\t\n\b",'~~~')));
	echo '</script>';
}
?>
<?php unset($a2_script,$a2_inline) ?></body>
</html>