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
<?php /* Debug-Information */ if ($showDuration) { echo "<!--\n";print_r($this->templateVars);echo "\n-->";} ?><?php unset($attr1_class); ?><?php  $attr2_name='';  $attr2_target='_top';  $attr2_method='post';  $attr2_enctype='application/x-www-form-urlencoded';  ?><?php
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
?><?php unset($attr2_name);unset($attr2_target);unset($attr2_method);unset($attr2_enctype); ?><?php  $attr3_title='GLOBAL_REGISTER';  $attr3_name='login';  $attr3_icon='user';  $attr3_width='400';  $attr3_rowclasses='fx1,fx2';  $attr3_columnclasses='x,y';  ?><?php
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
<?php unset($attr3_title);unset($attr3_name);unset($attr3_icon);unset($attr3_width);unset($attr3_rowclasses);unset($attr3_columnclasses); ?><?php  ?><?php
	$attr4_tmp_class='';
	$attr4_last_class = $attr4_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr4_tmp_class));
?><?php  ?><?php  $attr5_class='logo';  $attr5_colspan='2';  ?><?php
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
?>><?php unset($attr5_class);unset($attr5_colspan); ?><?php  $attr6_name='register';  ?><img src="<?php echo $image_dir.'logo_'.$attr6_name.IMG_ICON_EXT ?>" border="0" align="left"><h2 class="logo"><?php echo langHtml('logo_'.$attr6_name) ?></h2><p class="logo"><?php echo langHtml('logo_'.$attr6_name.'_text') ?></p><?php unset($attr6_name); ?><?php  ?></td><?php  ?><?php  ?><?php
	$attr5_tmp_class='';
	$attr5_last_class = $attr5_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr5_tmp_class));
?><?php  ?><?php  $attr6_width='50%';  ?><?php
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
?> width="<?php echo $attr6_width ?>"<?php
?>><?php unset($attr6_width); ?><?php  $attr7_class='text';  $attr7_text='USER_REGISTER_CODE';  $attr7_escape=true;  ?><?php
		$attr7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr7_class ?>" title="<?php echo $attr7_title ?>"><?php
		$langF = $attr7_escape?'langHtml':'lang';
		$tmp_text = $langF($$attr7_textvar);
		$tmp_text = $langF($attr7_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr7_class);unset($attr7_text);unset($attr7_escape); ?><?php  ?></td><?php  ?><?php  $attr6_width='50%';  ?><?php
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
?> width="<?php echo $attr6_width ?>"<?php
?>><?php unset($attr6_width); ?><?php  $attr7_class='text';  $attr7_default='';  $attr7_type='text';  $attr7_name='code';  $attr7_size='25';  $attr7_maxlength='256';  $attr7_onchange='';  $attr7_readonly=false;  ?><?php if ($this->isEditable() && !$this->isEditMode()) $attr7_readonly=true;
	  if ($attr7_readonly && empty($$attr7_name)) $$attr7_name = '- '.lang('EMPTY').' -';
      if(!isset($attr7_default)) $attr7_default='';
?><?php if (!$attr7_readonly || $attr7_type=='hidden') {
?><input<?php if ($attr7_readonly) echo ' disabled="true"' ?> id="id_<?php echo $attr7_name ?><?php if ($attr7_readonly) echo '_disabled' ?>" name="<?php echo $attr7_name ?><?php if ($attr7_readonly) echo '_disabled' ?>" type="<?php echo $attr7_type ?>" size="<?php echo $attr7_size ?>" maxlength="<?php echo $attr7_maxlength ?>" class="<?php echo $attr7_class ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" <?php if (in_array($attr7_name,$errors)) echo 'style="border-rightx:10px solid red; background-colorx:yellow; border:2px dashed red;"' ?> /><?php
if	($attr7_readonly) {
?><input type="hidden" id="id_<?php echo $attr7_name ?>" name="<?php echo $attr7_name ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" /><?php
 } } else { ?><span class="<?php echo $attr7_class ?>"><?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?></span><?php } ?><?php unset($attr7_class);unset($attr7_default);unset($attr7_type);unset($attr7_name);unset($attr7_size);unset($attr7_maxlength);unset($attr7_onchange);unset($attr7_readonly); ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php
	$attr5_tmp_class='';
	$attr5_last_class = $attr5_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr5_tmp_class));
?><?php  ?><?php  $attr6_width='50%';  ?><?php
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
?> width="<?php echo $attr6_width ?>"<?php
?>><?php unset($attr6_width); ?><?php  $attr7_class='text';  $attr7_text='USER_USERNAME';  $attr7_escape=true;  ?><?php
		$attr7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr7_class ?>" title="<?php echo $attr7_title ?>"><?php
		$langF = $attr7_escape?'langHtml':'lang';
		$tmp_text = $langF($$attr7_textvar);
		$tmp_text = $langF($attr7_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr7_class);unset($attr7_text);unset($attr7_escape); ?><?php  ?></td><?php  ?><?php  $attr6_width='50%';  ?><?php
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
?> width="<?php echo $attr6_width ?>"<?php
?>><?php unset($attr6_width); ?><?php  $attr7_class='text';  $attr7_default='';  $attr7_type='text';  $attr7_name='username';  $attr7_value='';  $attr7_size='25';  $attr7_maxlength='256';  $attr7_onchange='';  $attr7_readonly=false;  ?><?php if ($this->isEditable() && !$this->isEditMode()) $attr7_readonly=true;
	  if ($attr7_readonly && empty($$attr7_name)) $$attr7_name = '- '.lang('EMPTY').' -';
      if(!isset($attr7_default)) $attr7_default='';
?><?php if (!$attr7_readonly || $attr7_type=='hidden') {
?><input<?php if ($attr7_readonly) echo ' disabled="true"' ?> id="id_<?php echo $attr7_name ?><?php if ($attr7_readonly) echo '_disabled' ?>" name="<?php echo $attr7_name ?><?php if ($attr7_readonly) echo '_disabled' ?>" type="<?php echo $attr7_type ?>" size="<?php echo $attr7_size ?>" maxlength="<?php echo $attr7_maxlength ?>" class="<?php echo $attr7_class ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" <?php if (in_array($attr7_name,$errors)) echo 'style="border-rightx:10px solid red; background-colorx:yellow; border:2px dashed red;"' ?> /><?php
if	($attr7_readonly) {
?><input type="hidden" id="id_<?php echo $attr7_name ?>" name="<?php echo $attr7_name ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" /><?php
 } } else { ?><span class="<?php echo $attr7_class ?>"><?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?></span><?php } ?><?php unset($attr7_class);unset($attr7_default);unset($attr7_type);unset($attr7_name);unset($attr7_value);unset($attr7_size);unset($attr7_maxlength);unset($attr7_onchange);unset($attr7_readonly); ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php
	$attr5_tmp_class='';
	$attr5_last_class = $attr5_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr5_tmp_class));
?><?php  ?><?php  $attr6_width='50%';  ?><?php
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
?> width="<?php echo $attr6_width ?>"<?php
?>><?php unset($attr6_width); ?><?php  $attr7_class='text';  $attr7_text='USER_PASSWORD';  $attr7_escape=true;  ?><?php
		$attr7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr7_class ?>" title="<?php echo $attr7_title ?>"><?php
		$langF = $attr7_escape?'langHtml':'lang';
		$tmp_text = $langF($$attr7_textvar);
		$tmp_text = $langF($attr7_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr7_class);unset($attr7_text);unset($attr7_escape); ?><?php  ?></td><?php  ?><?php  $attr6_width='50%';  ?><?php
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
?> width="<?php echo $attr6_width ?>"<?php
?>><?php unset($attr6_width); ?><?php  $attr7_name='password';  $attr7_default='';  $attr7_class='';  $attr7_size='25';  $attr7_maxlength='256';  ?><input type="password" name="<?php echo $attr7_name ?>" size="<?php echo $attr7_size ?>" maxlength="<?php echo $attr7_maxlength ?>" class="<?php echo $attr7_class ?>" value="<?php if (count($errors)==0) echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" <?php if (in_array($attr7_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php unset($attr7_name);unset($attr7_default);unset($attr7_class);unset($attr7_size);unset($attr7_maxlength); ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php
	$attr5_tmp_class='';
	$attr5_last_class = $attr5_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr5_tmp_class));
?><?php  ?><?php  $attr6_width='50%';  ?><?php
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
?> width="<?php echo $attr6_width ?>"<?php
?>><?php unset($attr6_width); ?><?php  $attr7_class='text';  $attr7_text='GLOBAL_DATABASE';  $attr7_escape=true;  ?><?php
		$attr7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr7_class ?>" title="<?php echo $attr7_title ?>"><?php
		$langF = $attr7_escape?'langHtml':'lang';
		$tmp_text = $langF($$attr7_textvar);
		$tmp_text = $langF($attr7_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr7_class);unset($attr7_text);unset($attr7_escape); ?><?php  ?></td><?php  ?><?php  $attr6_width='50%';  ?><?php
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
?> width="<?php echo $attr6_width ?>"<?php
?>><?php unset($attr6_width); ?><?php  $attr7_list='dbids';  $attr7_name='dbid';  $attr7_default='actdbid';  $attr7_onchange='';  $attr7_title='';  $attr7_class='';  $attr7_addempty=false;  $attr7_multiple=false;  $attr7_size='1';  $attr7_lang=false;  ?><?php
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
?><?php unset($attr7_list);unset($attr7_name);unset($attr7_default);unset($attr7_onchange);unset($attr7_title);unset($attr7_class);unset($attr7_addempty);unset($attr7_multiple);unset($attr7_size);unset($attr7_lang); ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php
	$attr5_tmp_class='';
	$attr5_last_class = $attr5_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr5_tmp_class));
?><?php  ?><?php  $attr6_class='act';  $attr6_colspan='2';  ?><?php
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
?> colspan="<?php echo $attr6_colspan ?>" <?php
?>><?php unset($attr6_class);unset($attr6_colspan); ?><?php  $attr7_type='ok';  $attr7_class='ok';  $attr7_value='ok';  $attr7_text='button_ok';  ?><?php
		if ($this->isEditable() && !$this->isEditMode())
		$attr7_text = 'MODE_EDIT';
		$attr7_type = 'submit';
		$attr7_src  = '';
?><input type="<?php echo $attr7_type ?>"<?php if(isset($attr7_src)) { ?> src="<?php echo $image_dir.'icon_'.$attr7_src.IMG_ICON_EXT ?>"<?php } ?> name="<?php echo $attr7_value ?>" class="<?php echo $attr7_class ?>" title="<?php echo lang($attr7_text.'_DESC') ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo langHtml($attr7_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($attr7_src) ?><?php
?><?php unset($attr7_type);unset($attr7_class);unset($attr7_value);unset($attr7_text); ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?></tr><?php  ?><?php  ?>      </table>
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
<?php  ?><?php  $attr2_field='code';  ?><?php
if (isset($errors[0])) $attr2_field = $errors[0];
?><script name="JavaScript" type="text/javascript"><!--
document.forms[0].<?php echo $attr2_field ?>.focus();
document.forms[0].<?php echo $attr2_field ?>.select();
</script>
<?php unset($attr2_field); ?><?php  ?></body>
</html><?php  ?>