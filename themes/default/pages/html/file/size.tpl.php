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
<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo $a2_action ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo $a2_subaction ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo $a2_id ?>" /><?php
		if	( $conf['interface']['url_sessionid'] )
			echo '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";
?><?php unset($a2_name,$a2_target,$a2_method,$a2_enctype) ?><?php $a3_widths='5%,40%,55%';$a3_width='70%';$a3_rowclasses='odd,even';$a3_columnclasses='1,2,3'; ?><?php
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
<?php unset($a3_widths,$a3_width,$a3_rowclasses,$a3_columnclasses) ?><?php
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
><?php unset($a5_colspan) ?><?php $a6_class='text';$a6_text='IMAGE_OLD_SIZE';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_text,$a6_escape,$a6_cut) ?></td><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php $a6_class='text';$a6_var='width';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = isset($$a6_var)?$$a6_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_var,$a6_escape,$a6_cut) ?><?php $a6_class='text';$a6_raw='_*_';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a6_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_raw,$a6_escape,$a6_cut) ?><?php $a6_class='text';$a6_var='height';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = isset($$a6_var)?$$a6_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_var,$a6_escape,$a6_cut) ?></td></tr><?php $a4_not='';$a4_empty='formats'; ?><?php 
	if	( !isset($$a4_empty) )
		$a4_tmp_exec = empty($a4_empty);
	elseif	( is_array($$a4_empty) )
		$a4_tmp_exec = (count($$a4_empty)==0);
	elseif	( is_bool($$a4_empty) )
		$a4_tmp_exec = true;
	else
		$a4_tmp_exec = empty( $$a4_empty );
	$a4_tmp_exec = !$a4_tmp_exec;
	$a4_tmp_last_exec = $a4_tmp_exec;
	if	( $a4_tmp_exec )
	{
?>
<?php unset($a4_not,$a4_empty) ?><?php $a5_true=$mode=="edit"; ?><?php 
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
<?php $a7_colspan='3'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
 colspan="3"
><?php unset($a7_colspan) ?><?php $a8_title=lang('IMAGE_NEW_SIZE'); ?><fieldset><?php if(isset($a8_title)) { ?><legend><?php echo encodeHtml($a8_title) ?></legend><?php } ?><?php unset($a8_title) ?></fieldset></td></tr><?php
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
><?php $a8_readonly=false;$a8_name='type';$a8_value='factor';$a8_default=false;$a8_prefix='';$a8_suffix='';$a8_class='';$a8_onchange=''; ?><?php
		if ($this->isEditable() && !$this->isEditMode()) $a8_readonly=true;
		if	( isset($$a8_name)  )
			$a8_tmp_default = $$a8_name;
		elseif ( isset($a8_default) )
			$a8_tmp_default = $a8_default;
		else
			$a8_tmp_default = '';
 ?><input onclick="<?php echo $a8_name.'_'.$a8_value ?>_valueChanged(this);" class="radio" type="radio" id="id_<?php echo $a8_name.'_'.$a8_value ?>"  name="<?php echo $a8_prefix.$a8_name ?>"<?php if ( $a8_readonly ) echo ' disabled="disabled"' ?> value="<?php echo $a8_value ?>" <?php if($a8_value==$a8_tmp_default) echo 'checked="checked"' ?><?php if (in_array($a8_name,$errors)) echo ' style="borderx:2px dashed red; background-color:red;"' ?> />
<?php /* #END-IF# */ ?><?php unset($a8_readonly,$a8_name,$a8_value,$a8_default,$a8_prefix,$a8_suffix,$a8_class,$a8_onchange) ?></td><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php $a8_for='type_factor'; ?><label for="id_<?php echo $a8_for ?><?php if (!empty($a8_value)) echo '_'.$a8_value ?>"><?php unset($a8_for) ?><?php $a9_class='text';$a9_text='FILE_IMAGE_SIZE_FACTOR';$a9_escape=true;$a9_cut='both'; ?><?php
		$a9_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a9_class ?>" title="<?php echo $a9_title ?>"><?php
		$langF = $a9_escape?'langHtml':'lang';
		$tmp_text = $langF($a9_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a9_class,$a9_text,$a9_escape,$a9_cut) ?></label></td><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php $a8_list='factors';$a8_name='factor';$a8_onchange='';$a8_title='';$a8_class='';$a8_addempty=false;$a8_multiple=false;$a8_size='1';$a8_lang=false; ?><?php
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
?><?php unset($a8_list,$a8_name,$a8_onchange,$a8_title,$a8_class,$a8_addempty,$a8_multiple,$a8_size,$a8_lang) ?><?php $a8_var='factor';$a8_value='1'; ?><?php
	if (isset($a8_key))
		$$a8_var = $a8_value[$a8_key];
	else
		$$a8_var = $a8_value;
?><?php unset($a8_var,$a8_value) ?></td></tr><?php
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
><?php $a8_readonly=false;$a8_name='type';$a8_value='input';$a8_default=false;$a8_prefix='';$a8_suffix='';$a8_class='';$a8_onchange=''; ?><?php
		if ($this->isEditable() && !$this->isEditMode()) $a8_readonly=true;
		if	( isset($$a8_name)  )
			$a8_tmp_default = $$a8_name;
		elseif ( isset($a8_default) )
			$a8_tmp_default = $a8_default;
		else
			$a8_tmp_default = '';
 ?><input onclick="<?php echo $a8_name.'_'.$a8_value ?>_valueChanged(this);" class="radio" type="radio" id="id_<?php echo $a8_name.'_'.$a8_value ?>"  name="<?php echo $a8_prefix.$a8_name ?>"<?php if ( $a8_readonly ) echo ' disabled="disabled"' ?> value="<?php echo $a8_value ?>" <?php if($a8_value==$a8_tmp_default) echo 'checked="checked"' ?><?php if (in_array($a8_name,$errors)) echo ' style="borderx:2px dashed red; background-color:red;"' ?> />
<?php /* #END-IF# */ ?><?php unset($a8_readonly,$a8_name,$a8_value,$a8_default,$a8_prefix,$a8_suffix,$a8_class,$a8_onchange) ?></td><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php $a8_for='type_input'; ?><label for="id_<?php echo $a8_for ?><?php if (!empty($a8_value)) echo '_'.$a8_value ?>"><?php unset($a8_for) ?><?php $a9_class='text';$a9_text='FILE_IMAGE_NEW_WIDTH_HEIGHT';$a9_escape=true;$a9_cut='both'; ?><?php
		$a9_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a9_class ?>" title="<?php echo $a9_title ?>"><?php
		$langF = $a9_escape?'langHtml':'lang';
		$tmp_text = $langF($a9_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a9_class,$a9_text,$a9_escape,$a9_cut) ?></label></td><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php $a8_class='text';$a8_default='';$a8_type='text';$a8_name='width';$a8_size='10';$a8_maxlength='256';$a8_onchange='';$a8_readonly=false; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a8_readonly=true;
	  if ($a8_readonly && empty($$a8_name)) $$a8_name = '- '.lang('EMPTY').' -';
      if(!isset($a8_default)) $a8_default='';
?><?php if (!$a8_readonly || $a8_type=='hidden') {
?><input<?php if ($a8_readonly) echo ' disabled="true"' ?> id="id_<?php echo $a8_name ?><?php if ($a8_readonly) echo '_disabled' ?>" name="<?php echo $a8_name ?><?php if ($a8_readonly) echo '_disabled' ?>" type="<?php echo $a8_type ?>" size="<?php echo $a8_size ?>" maxlength="<?php echo $a8_maxlength ?>" class="<?php echo $a8_class ?>" value="<?php echo isset($$a8_name)?$$a8_name:$a8_default ?>" <?php if (in_array($a8_name,$errors)) echo 'style="border-rightx:10px solid red; background-colorx:yellow; border:2px dashed red;"' ?> /><?php
if	($a8_readonly) {
?><input type="hidden" id="id_<?php echo $a8_name ?>" name="<?php echo $a8_name ?>" value="<?php echo isset($$a8_name)?$$a8_name:$a8_default ?>" /><?php
 } } else { ?><span class="<?php echo $a8_class ?>"><?php echo isset($$a8_name)?$$a8_name:$a8_default ?></span><?php } ?><?php unset($a8_class,$a8_default,$a8_type,$a8_name,$a8_size,$a8_maxlength,$a8_onchange,$a8_readonly) ?><?php $a8_class='text';$a8_raw='_*_';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a8_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_raw,$a8_escape,$a8_cut) ?><?php $a8_class='text';$a8_default='';$a8_type='text';$a8_name='height';$a8_size='10';$a8_maxlength='256';$a8_onchange='';$a8_readonly=false; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a8_readonly=true;
	  if ($a8_readonly && empty($$a8_name)) $$a8_name = '- '.lang('EMPTY').' -';
      if(!isset($a8_default)) $a8_default='';
?><?php if (!$a8_readonly || $a8_type=='hidden') {
?><input<?php if ($a8_readonly) echo ' disabled="true"' ?> id="id_<?php echo $a8_name ?><?php if ($a8_readonly) echo '_disabled' ?>" name="<?php echo $a8_name ?><?php if ($a8_readonly) echo '_disabled' ?>" type="<?php echo $a8_type ?>" size="<?php echo $a8_size ?>" maxlength="<?php echo $a8_maxlength ?>" class="<?php echo $a8_class ?>" value="<?php echo isset($$a8_name)?$$a8_name:$a8_default ?>" <?php if (in_array($a8_name,$errors)) echo 'style="border-rightx:10px solid red; background-colorx:yellow; border:2px dashed red;"' ?> /><?php
if	($a8_readonly) {
?><input type="hidden" id="id_<?php echo $a8_name ?>" name="<?php echo $a8_name ?>" value="<?php echo isset($$a8_name)?$$a8_name:$a8_default ?>" /><?php
 } } else { ?><span class="<?php echo $a8_class ?>"><?php echo isset($$a8_name)?$$a8_name:$a8_default ?></span><?php } ?><?php unset($a8_class,$a8_default,$a8_type,$a8_name,$a8_size,$a8_maxlength,$a8_onchange,$a8_readonly) ?></td></tr><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a7_colspan='3'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
 colspan="3"
><?php unset($a7_colspan) ?><?php $a8_title=lang('options'); ?><fieldset><?php if(isset($a8_title)) { ?><legend><?php echo encodeHtml($a8_title) ?></legend><?php } ?><?php unset($a8_title) ?></fieldset></td></tr><?php
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
><?php unset($a7_colspan) ?><?php $a8_for='format'; ?><label for="id_<?php echo $a8_for ?><?php if (!empty($a8_value)) echo '_'.$a8_value ?>"><?php unset($a8_for) ?><?php $a9_class='text';$a9_text='FILE_IMAGE_FORMAT';$a9_escape=true;$a9_cut='both'; ?><?php
		$a9_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a9_class ?>" title="<?php echo $a9_title ?>"><?php
		$langF = $a9_escape?'langHtml':'lang';
		$tmp_text = $langF($a9_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a9_class,$a9_text,$a9_escape,$a9_cut) ?></label></td><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php $a8_list='formats';$a8_name='format';$a8_onchange='';$a8_title='';$a8_class='';$a8_addempty=false;$a8_multiple=false;$a8_size='1';$a8_lang=false; ?><?php
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
<?php $a7_colspan='2'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
 colspan="2"
><?php unset($a7_colspan) ?><?php $a8_for='jpeglist_compression'; ?><label for="id_<?php echo $a8_for ?><?php if (!empty($a8_value)) echo '_'.$a8_value ?>"><?php unset($a8_for) ?><?php $a9_class='text';$a9_text='FILE_IMAGE_JPEG_COMPRESSION';$a9_escape=true;$a9_cut='both'; ?><?php
		$a9_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a9_class ?>" title="<?php echo $a9_title ?>"><?php
		$langF = $a9_escape?'langHtml':'lang';
		$tmp_text = $langF($a9_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a9_class,$a9_text,$a9_escape,$a9_cut) ?></label></td><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php $a8_var='jpeg_compression';$a8_value='70'; ?><?php
	if (isset($a8_key))
		$$a8_var = $a8_value[$a8_key];
	else
		$$a8_var = $a8_value;
?><?php unset($a8_var,$a8_value) ?><?php $a8_list='jpeglist';$a8_name='jpeg_compression';$a8_onchange='';$a8_title='';$a8_class='';$a8_addempty=false;$a8_multiple=false;$a8_size='1';$a8_lang=false; ?><?php
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
<?php $a7_colspan='3'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
 colspan="3"
><?php unset($a7_colspan) ?><?php $a8_default=false;$a8_readonly=false;$a8_name='copy'; ?><?php
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
?><?php unset($a8_name); unset($a8_readonly); unset($a8_default); ?><?php unset($a8_default,$a8_readonly,$a8_name) ?><?php $a8_for='copy'; ?><label for="id_<?php echo $a8_for ?><?php if (!empty($a8_value)) echo '_'.$a8_value ?>"><?php unset($a8_for) ?><?php $a9_class='text';$a9_key='copy';$a9_escape=true;$a9_cut='both'; ?><?php
		$a9_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a9_class ?>" title="<?php echo $a9_title ?>"><?php
		$langF = $a9_escape?'langHtml':'lang';
		$tmp_text = $langF($a9_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a9_class,$a9_key,$a9_escape,$a9_cut) ?></label></td></tr><?php } ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a6_class='act';$a6_colspan='3'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="act"
 colspan="3"
><?php unset($a6_class,$a6_colspan) ?><?php $a7_type='ok';$a7_class='ok';$a7_value='ok';$a7_text='button_ok'; ?><?php
		if ($this->isEditable() && !$this->isEditMode())
		$a7_text = 'MODE_EDIT';
		$a7_type = 'submit';
		if	( $this->isEditable() && readonly() )
			$a7_type = ''; // Knopf nicht anzeigen
		$a7_src  = '';
	if	( !empty($a7_type) ) {
?><input type="<?php echo $a7_type ?>"<?php if(isset($a7_src)) { ?> src="<?php echo $image_dir.'icon_'.$a7_src.IMG_ICON_EXT ?>"<?php } ?> name="<?php echo $a7_value ?>" class="ok" title="<?php echo lang($a7_text.'_DESC') ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo langHtml($a7_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($a7_src)
?><?php } 
?><?php unset($a7_type,$a7_class,$a7_value,$a7_text) ?></td></tr><?php } ?>      </table>
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
<?php $a3_field='width'; ?><?php
if (isset($errors[0])) $a3_field = $errors[0];
?><script name="JavaScript" type="text/javascript"><!--
document.forms[0].<?php echo $a3_field ?>.focus();
document.forms[0].<?php echo $a3_field ?>.select();
</script>
<?php unset($a3_field) ?></form>
</body>
</html>