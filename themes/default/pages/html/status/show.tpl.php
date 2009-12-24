<?php  $attr1_class='status';  ?><?php
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
<?php /* Debug-Information */ if ($showDuration) { echo "<!-- Output Variables are:\n";echo str_replace('-->','-- >',print_r($this->templateVars,true));echo "\n-->";} ?><?php unset($attr1_class); ?><?php  $attr2_width='100%';  $attr2_space='0px';  $attr2_padding='0px';  ?><?php
	$coloumn_widths = array();
	$row_classes    = array();
	$column_classes = array();
		$attr2_class='';
?><table class="<?php echo $attr2_class ?>" cellspacing="<?php echo $attr2_space ?>" width="<?php echo $attr2_width ?>" cellpadding="<?php echo $attr2_padding ?>"><?php unset($attr2_width);unset($attr2_space);unset($attr2_padding); ?><?php  ?><?php
	$attr3_tmp_class='';
	$attr3_last_class = $attr3_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr3_tmp_class));
?><?php  ?><?php  $attr4_present='projects';  ?><?php 
	$attr4_tmp_exec = isset($$attr4_present);
	$attr4_tmp_last_exec = $attr4_tmp_exec;
	if	( $attr4_tmp_exec )
	{
?>
<?php unset($attr4_present); ?><?php  ?><?php
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
?>><?php  ?><?php  $attr6_action='index';  $attr6_subaction='project';  $attr6_name='';  $attr6_target='_top';  $attr6_method='post';  $attr6_enctype='application/x-www-form-urlencoded';  ?><?php
		$attr6_id = $this->getRequestId();
	if ($this->isEditable())
	{
		if	($this->isEditMode())
		{
			$attr6_method    = 'POST';
		}
		else
		{
			$attr6_method    = 'GET';
			$attr6_subaction = $subActionName;
		}
	}
?><form name="<?php echo $attr6_name ?>"
      target="<?php echo $attr6_target ?>"
      action="<?php echo Html::url( $attr6_action,$attr6_subaction,$attr6_id ) ?>"
      method="<?php echo $attr6_method ?>"
      enctype="<?php echo $attr6_enctype ?>" style="margin:0px;padding:0px;">
<?php if ($this->isEditable() && !$this->isEditMode()) { ?>
<input type="hidden" name="mode" value="edit" />
<?php } ?>
<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo $attr6_action ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo $attr6_subaction ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo $attr6_id ?>" /><?php
		if	( $conf['interface']['url_sessionid'] )
			echo '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";
?><?php unset($attr6_action);unset($attr6_subaction);unset($attr6_name);unset($attr6_target);unset($attr6_method);unset($attr6_enctype); ?><?php  $attr7_class='text';  $attr7_default='projectid';  $attr7_type='hidden';  $attr7_name='idvar';  $attr7_size='40';  $attr7_maxlength='256';  $attr7_onchange='';  $attr7_readonly=false;  ?><?php if ($this->isEditable() && !$this->isEditMode()) $attr7_readonly=true;
	  if ($attr7_readonly && empty($$attr7_name)) $$attr7_name = '- '.lang('EMPTY').' -';
      if(!isset($attr7_default)) $attr7_default='';
?><?php if (!$attr7_readonly || $attr7_type=='hidden') {
?><input<?php if ($attr7_readonly) echo ' disabled="true"' ?> id="id_<?php echo $attr7_name ?><?php if ($attr7_readonly) echo '_disabled' ?>" name="<?php echo $attr7_name ?><?php if ($attr7_readonly) echo '_disabled' ?>" type="<?php echo $attr7_type ?>" size="<?php echo $attr7_size ?>" maxlength="<?php echo $attr7_maxlength ?>" class="<?php echo $attr7_class ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" <?php if (in_array($attr7_name,$errors)) echo 'style="border-rightx:10px solid red; background-colorx:yellow; border:2px dashed red;"' ?> /><?php
if	($attr7_readonly) {
?><input type="hidden" id="id_<?php echo $attr7_name ?>" name="<?php echo $attr7_name ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" /><?php
 } } else { ?><span class="<?php echo $attr7_class ?>"><?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?></span><?php } ?><?php unset($attr7_class);unset($attr7_default);unset($attr7_type);unset($attr7_name);unset($attr7_size);unset($attr7_maxlength);unset($attr7_onchange);unset($attr7_readonly); ?><?php  $attr7_icon='project';  $attr7_align='left';  ?><?php
	$attr7_tmp_image_file = $image_dir.'icon_'.$attr7_icon.IMG_ICON_EXT;
	$attr7_size = '16x16';
	$attr7_tmp_title = basename($attr7_tmp_image_file);
?><img alt="<?php echo $attr7_tmp_title; if (isset($attr7_size)) { echo ' ('; list($attr7_tmp_width,$attr7_tmp_height)=explode('x',$attr7_size);echo $attr7_tmp_width.'x'.$attr7_tmp_height; echo')';} ?>" src="<?php echo $attr7_tmp_image_file ?>" border="0"<?php if(isset($attr7_align)) echo ' align="'.$attr7_align.'"' ?><?php if (isset($attr7_size)) { list($attr7_tmp_width,$attr7_tmp_height)=explode('x',$attr7_size);echo ' width="'.$attr7_tmp_width.'" height="'.$attr7_tmp_height.'"';} ?>><?php unset($attr7_icon);unset($attr7_align); ?><?php  $attr7_list='projects';  $attr7_name='projectid';  $attr7_onchange='submit()';  $attr7_title='';  $attr7_class='';  $attr7_addempty='projects';  $attr7_multiple=false;  $attr7_size='1';  $attr7_lang=false;  ?><?php
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
?><?php unset($attr7_list);unset($attr7_name);unset($attr7_onchange);unset($attr7_title);unset($attr7_class);unset($attr7_addempty);unset($attr7_multiple);unset($attr7_size);unset($attr7_lang); ?><?php  $attr7_type='ok';  $attr7_class='ok';  $attr7_value='ok';  $attr7_text=lang('>');  ?><?php
		if ($this->isEditable() && !$this->isEditMode())
		$attr7_text = 'MODE_EDIT';
		$attr7_type = 'submit';
		if	( $this->isEditable() && readonly() )
			$attr7_type = ''; // Knopf nicht anzeigen
		$attr7_src  = '';
	if	( !empty($attr7_type) ) {
?><input type="<?php echo $attr7_type ?>"<?php if(isset($attr7_src)) { ?> src="<?php echo $image_dir.'icon_'.$attr7_src.IMG_ICON_EXT ?>"<?php } ?> name="<?php echo $attr7_value ?>" class="<?php echo $attr7_class ?>" title="<?php echo lang($attr7_text.'_DESC') ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo langHtml($attr7_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($attr7_src)
?><?php } 
?><?php unset($attr7_type);unset($attr7_class);unset($attr7_value);unset($attr7_text); ?><?php  ?></form>
<?php  ?><?php  ?></td><?php  ?><?php  ?><?php } ?><?php  ?><?php  $attr4_value=@count($models);  $attr4_greaterthan='1';  ?><?php 
	$attr4_tmp_exec = intval($attr4_greaterthan) < intval($attr4_value);
	$attr4_tmp_last_exec = $attr4_tmp_exec;
	if	( $attr4_tmp_exec )
	{
?>
<?php unset($attr4_value);unset($attr4_greaterthan); ?><?php  ?><?php
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
?>><?php  ?><?php  $attr6_action='index';  $attr6_subaction='model';  $attr6_name='';  $attr6_target='_top';  $attr6_method='get';  $attr6_enctype='application/x-www-form-urlencoded';  ?><?php
		$attr6_id = $this->getRequestId();
	if ($this->isEditable())
	{
		if	($this->isEditMode())
		{
			$attr6_method    = 'POST';
		}
		else
		{
			$attr6_method    = 'GET';
			$attr6_subaction = $subActionName;
		}
	}
?><form name="<?php echo $attr6_name ?>"
      target="<?php echo $attr6_target ?>"
      action="<?php echo Html::url( $attr6_action,$attr6_subaction,$attr6_id ) ?>"
      method="<?php echo $attr6_method ?>"
      enctype="<?php echo $attr6_enctype ?>" style="margin:0px;padding:0px;">
<?php if ($this->isEditable() && !$this->isEditMode()) { ?>
<input type="hidden" name="mode" value="edit" />
<?php } ?>
<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo $attr6_action ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo $attr6_subaction ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo $attr6_id ?>" /><?php
		if	( $conf['interface']['url_sessionid'] )
			echo '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";
?><?php unset($attr6_action);unset($attr6_subaction);unset($attr6_name);unset($attr6_target);unset($attr6_method);unset($attr6_enctype); ?><?php  $attr7_class='text';  $attr7_default='modelid';  $attr7_type='hidden';  $attr7_name='idvar';  $attr7_size='40';  $attr7_maxlength='256';  $attr7_onchange='';  $attr7_readonly=false;  ?><?php if ($this->isEditable() && !$this->isEditMode()) $attr7_readonly=true;
	  if ($attr7_readonly && empty($$attr7_name)) $$attr7_name = '- '.lang('EMPTY').' -';
      if(!isset($attr7_default)) $attr7_default='';
?><?php if (!$attr7_readonly || $attr7_type=='hidden') {
?><input<?php if ($attr7_readonly) echo ' disabled="true"' ?> id="id_<?php echo $attr7_name ?><?php if ($attr7_readonly) echo '_disabled' ?>" name="<?php echo $attr7_name ?><?php if ($attr7_readonly) echo '_disabled' ?>" type="<?php echo $attr7_type ?>" size="<?php echo $attr7_size ?>" maxlength="<?php echo $attr7_maxlength ?>" class="<?php echo $attr7_class ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" <?php if (in_array($attr7_name,$errors)) echo 'style="border-rightx:10px solid red; background-colorx:yellow; border:2px dashed red;"' ?> /><?php
if	($attr7_readonly) {
?><input type="hidden" id="id_<?php echo $attr7_name ?>" name="<?php echo $attr7_name ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" /><?php
 } } else { ?><span class="<?php echo $attr7_class ?>"><?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?></span><?php } ?><?php unset($attr7_class);unset($attr7_default);unset($attr7_type);unset($attr7_name);unset($attr7_size);unset($attr7_maxlength);unset($attr7_onchange);unset($attr7_readonly); ?><?php  $attr7_icon='model';  $attr7_align='left';  ?><?php
	$attr7_tmp_image_file = $image_dir.'icon_'.$attr7_icon.IMG_ICON_EXT;
	$attr7_size = '16x16';
	$attr7_tmp_title = basename($attr7_tmp_image_file);
?><img alt="<?php echo $attr7_tmp_title; if (isset($attr7_size)) { echo ' ('; list($attr7_tmp_width,$attr7_tmp_height)=explode('x',$attr7_size);echo $attr7_tmp_width.'x'.$attr7_tmp_height; echo')';} ?>" src="<?php echo $attr7_tmp_image_file ?>" border="0"<?php if(isset($attr7_align)) echo ' align="'.$attr7_align.'"' ?><?php if (isset($attr7_size)) { list($attr7_tmp_width,$attr7_tmp_height)=explode('x',$attr7_size);echo ' width="'.$attr7_tmp_width.'" height="'.$attr7_tmp_height.'"';} ?>><?php unset($attr7_icon);unset($attr7_align); ?><?php  $attr7_list='models';  $attr7_name='modelid';  $attr7_onchange='submit()';  $attr7_title='';  $attr7_class='';  $attr7_addempty='model';  $attr7_multiple=false;  $attr7_size='1';  $attr7_lang=false;  ?><?php
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
?><?php unset($attr7_list);unset($attr7_name);unset($attr7_onchange);unset($attr7_title);unset($attr7_class);unset($attr7_addempty);unset($attr7_multiple);unset($attr7_size);unset($attr7_lang); ?><?php  $attr7_type='ok';  $attr7_class='ok';  $attr7_value='ok';  $attr7_text='>';  ?><?php
		if ($this->isEditable() && !$this->isEditMode())
		$attr7_text = 'MODE_EDIT';
		$attr7_type = 'submit';
		if	( $this->isEditable() && readonly() )
			$attr7_type = ''; // Knopf nicht anzeigen
		$attr7_src  = '';
	if	( !empty($attr7_type) ) {
?><input type="<?php echo $attr7_type ?>"<?php if(isset($attr7_src)) { ?> src="<?php echo $image_dir.'icon_'.$attr7_src.IMG_ICON_EXT ?>"<?php } ?> name="<?php echo $attr7_value ?>" class="<?php echo $attr7_class ?>" title="<?php echo lang($attr7_text.'_DESC') ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo langHtml($attr7_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($attr7_src)
?><?php } 
?><?php unset($attr7_type);unset($attr7_class);unset($attr7_value);unset($attr7_text); ?><?php  ?></form>
<?php  ?><?php  ?></td><?php  ?><?php  ?><?php } ?><?php  ?><?php  $attr4_value=@count($languages);  $attr4_greaterthan='1';  ?><?php 
	$attr4_tmp_exec = intval($attr4_greaterthan) < intval($attr4_value);
	$attr4_tmp_last_exec = $attr4_tmp_exec;
	if	( $attr4_tmp_exec )
	{
?>
<?php unset($attr4_value);unset($attr4_greaterthan); ?><?php  ?><?php
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
?>><?php  ?><?php  $attr6_action='index';  $attr6_subaction='language';  $attr6_name='';  $attr6_target='_top';  $attr6_method='get';  $attr6_enctype='application/x-www-form-urlencoded';  ?><?php
		$attr6_id = $this->getRequestId();
	if ($this->isEditable())
	{
		if	($this->isEditMode())
		{
			$attr6_method    = 'POST';
		}
		else
		{
			$attr6_method    = 'GET';
			$attr6_subaction = $subActionName;
		}
	}
?><form name="<?php echo $attr6_name ?>"
      target="<?php echo $attr6_target ?>"
      action="<?php echo Html::url( $attr6_action,$attr6_subaction,$attr6_id ) ?>"
      method="<?php echo $attr6_method ?>"
      enctype="<?php echo $attr6_enctype ?>" style="margin:0px;padding:0px;">
<?php if ($this->isEditable() && !$this->isEditMode()) { ?>
<input type="hidden" name="mode" value="edit" />
<?php } ?>
<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo $attr6_action ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo $attr6_subaction ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo $attr6_id ?>" /><?php
		if	( $conf['interface']['url_sessionid'] )
			echo '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";
?><?php unset($attr6_action);unset($attr6_subaction);unset($attr6_name);unset($attr6_target);unset($attr6_method);unset($attr6_enctype); ?><?php  $attr7_class='text';  $attr7_default='languageid';  $attr7_type='hidden';  $attr7_name='idvar';  $attr7_size='40';  $attr7_maxlength='256';  $attr7_onchange='';  $attr7_readonly=false;  ?><?php if ($this->isEditable() && !$this->isEditMode()) $attr7_readonly=true;
	  if ($attr7_readonly && empty($$attr7_name)) $$attr7_name = '- '.lang('EMPTY').' -';
      if(!isset($attr7_default)) $attr7_default='';
?><?php if (!$attr7_readonly || $attr7_type=='hidden') {
?><input<?php if ($attr7_readonly) echo ' disabled="true"' ?> id="id_<?php echo $attr7_name ?><?php if ($attr7_readonly) echo '_disabled' ?>" name="<?php echo $attr7_name ?><?php if ($attr7_readonly) echo '_disabled' ?>" type="<?php echo $attr7_type ?>" size="<?php echo $attr7_size ?>" maxlength="<?php echo $attr7_maxlength ?>" class="<?php echo $attr7_class ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" <?php if (in_array($attr7_name,$errors)) echo 'style="border-rightx:10px solid red; background-colorx:yellow; border:2px dashed red;"' ?> /><?php
if	($attr7_readonly) {
?><input type="hidden" id="id_<?php echo $attr7_name ?>" name="<?php echo $attr7_name ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" /><?php
 } } else { ?><span class="<?php echo $attr7_class ?>"><?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?></span><?php } ?><?php unset($attr7_class);unset($attr7_default);unset($attr7_type);unset($attr7_name);unset($attr7_size);unset($attr7_maxlength);unset($attr7_onchange);unset($attr7_readonly); ?><?php  $attr7_icon='language';  $attr7_align='left';  ?><?php
	$attr7_tmp_image_file = $image_dir.'icon_'.$attr7_icon.IMG_ICON_EXT;
	$attr7_size = '16x16';
	$attr7_tmp_title = basename($attr7_tmp_image_file);
?><img alt="<?php echo $attr7_tmp_title; if (isset($attr7_size)) { echo ' ('; list($attr7_tmp_width,$attr7_tmp_height)=explode('x',$attr7_size);echo $attr7_tmp_width.'x'.$attr7_tmp_height; echo')';} ?>" src="<?php echo $attr7_tmp_image_file ?>" border="0"<?php if(isset($attr7_align)) echo ' align="'.$attr7_align.'"' ?><?php if (isset($attr7_size)) { list($attr7_tmp_width,$attr7_tmp_height)=explode('x',$attr7_size);echo ' width="'.$attr7_tmp_width.'" height="'.$attr7_tmp_height.'"';} ?>><?php unset($attr7_icon);unset($attr7_align); ?><?php  $attr7_list='languages';  $attr7_name='languageid';  $attr7_onchange='submit()';  $attr7_title='';  $attr7_class='';  $attr7_addempty='language';  $attr7_multiple=false;  $attr7_size='1';  $attr7_lang=false;  ?><?php
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
?><?php unset($attr7_list);unset($attr7_name);unset($attr7_onchange);unset($attr7_title);unset($attr7_class);unset($attr7_addempty);unset($attr7_multiple);unset($attr7_size);unset($attr7_lang); ?><?php  $attr7_type='ok';  $attr7_class='ok';  $attr7_value='ok';  $attr7_text='>';  ?><?php
		if ($this->isEditable() && !$this->isEditMode())
		$attr7_text = 'MODE_EDIT';
		$attr7_type = 'submit';
		if	( $this->isEditable() && readonly() )
			$attr7_type = ''; // Knopf nicht anzeigen
		$attr7_src  = '';
	if	( !empty($attr7_type) ) {
?><input type="<?php echo $attr7_type ?>"<?php if(isset($attr7_src)) { ?> src="<?php echo $image_dir.'icon_'.$attr7_src.IMG_ICON_EXT ?>"<?php } ?> name="<?php echo $attr7_value ?>" class="<?php echo $attr7_class ?>" title="<?php echo lang($attr7_text.'_DESC') ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo langHtml($attr7_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($attr7_src)
?><?php } 
?><?php unset($attr7_type);unset($attr7_class);unset($attr7_value);unset($attr7_text); ?><?php  ?></form>
<?php  ?><?php  ?></td><?php  ?><?php  ?><?php } ?><?php  ?><?php  $attr4_present='templates';  ?><?php 
	$attr4_tmp_exec = isset($$attr4_present);
	$attr4_tmp_last_exec = $attr4_tmp_exec;
	if	( $attr4_tmp_exec )
	{
?>
<?php unset($attr4_present); ?><?php  ?><?php
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
?>><?php  ?><?php  $attr6_action='main';  $attr6_subaction='template';  $attr6_name='';  $attr6_target='cms_main';  $attr6_method='get';  $attr6_enctype='application/x-www-form-urlencoded';  ?><?php
		$attr6_id = $this->getRequestId();
	if ($this->isEditable())
	{
		if	($this->isEditMode())
		{
			$attr6_method    = 'POST';
		}
		else
		{
			$attr6_method    = 'GET';
			$attr6_subaction = $subActionName;
		}
	}
?><form name="<?php echo $attr6_name ?>"
      target="<?php echo $attr6_target ?>"
      action="<?php echo Html::url( $attr6_action,$attr6_subaction,$attr6_id ) ?>"
      method="<?php echo $attr6_method ?>"
      enctype="<?php echo $attr6_enctype ?>" style="margin:0px;padding:0px;">
<?php if ($this->isEditable() && !$this->isEditMode()) { ?>
<input type="hidden" name="mode" value="edit" />
<?php } ?>
<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo $attr6_action ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo $attr6_subaction ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo $attr6_id ?>" /><?php
		if	( $conf['interface']['url_sessionid'] )
			echo '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";
?><?php unset($attr6_action);unset($attr6_subaction);unset($attr6_name);unset($attr6_target);unset($attr6_method);unset($attr6_enctype); ?><?php  $attr7_class='text';  $attr7_default='templateid';  $attr7_type='hidden';  $attr7_name='idvar';  $attr7_size='40';  $attr7_maxlength='256';  $attr7_onchange='';  $attr7_readonly=false;  ?><?php if ($this->isEditable() && !$this->isEditMode()) $attr7_readonly=true;
	  if ($attr7_readonly && empty($$attr7_name)) $$attr7_name = '- '.lang('EMPTY').' -';
      if(!isset($attr7_default)) $attr7_default='';
?><?php if (!$attr7_readonly || $attr7_type=='hidden') {
?><input<?php if ($attr7_readonly) echo ' disabled="true"' ?> id="id_<?php echo $attr7_name ?><?php if ($attr7_readonly) echo '_disabled' ?>" name="<?php echo $attr7_name ?><?php if ($attr7_readonly) echo '_disabled' ?>" type="<?php echo $attr7_type ?>" size="<?php echo $attr7_size ?>" maxlength="<?php echo $attr7_maxlength ?>" class="<?php echo $attr7_class ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" <?php if (in_array($attr7_name,$errors)) echo 'style="border-rightx:10px solid red; background-colorx:yellow; border:2px dashed red;"' ?> /><?php
if	($attr7_readonly) {
?><input type="hidden" id="id_<?php echo $attr7_name ?>" name="<?php echo $attr7_name ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" /><?php
 } } else { ?><span class="<?php echo $attr7_class ?>"><?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?></span><?php } ?><?php unset($attr7_class);unset($attr7_default);unset($attr7_type);unset($attr7_name);unset($attr7_size);unset($attr7_maxlength);unset($attr7_onchange);unset($attr7_readonly); ?><?php  $attr7_icon='template';  $attr7_align='left';  ?><?php
	$attr7_tmp_image_file = $image_dir.'icon_'.$attr7_icon.IMG_ICON_EXT;
	$attr7_size = '16x16';
	$attr7_tmp_title = basename($attr7_tmp_image_file);
?><img alt="<?php echo $attr7_tmp_title; if (isset($attr7_size)) { echo ' ('; list($attr7_tmp_width,$attr7_tmp_height)=explode('x',$attr7_size);echo $attr7_tmp_width.'x'.$attr7_tmp_height; echo')';} ?>" src="<?php echo $attr7_tmp_image_file ?>" border="0"<?php if(isset($attr7_align)) echo ' align="'.$attr7_align.'"' ?><?php if (isset($attr7_size)) { list($attr7_tmp_width,$attr7_tmp_height)=explode('x',$attr7_size);echo ' width="'.$attr7_tmp_width.'" height="'.$attr7_tmp_height.'"';} ?>><?php unset($attr7_icon);unset($attr7_align); ?><?php  $attr7_list='templates';  $attr7_name='templateid';  $attr7_onchange='submit()';  $attr7_title='';  $attr7_class='';  $attr7_addempty='template';  $attr7_multiple=false;  $attr7_size='1';  $attr7_lang=false;  ?><?php
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
?><?php unset($attr7_list);unset($attr7_name);unset($attr7_onchange);unset($attr7_title);unset($attr7_class);unset($attr7_addempty);unset($attr7_multiple);unset($attr7_size);unset($attr7_lang); ?><?php  $attr7_type='ok';  $attr7_class='ok';  $attr7_value='ok';  $attr7_text='>';  ?><?php
		if ($this->isEditable() && !$this->isEditMode())
		$attr7_text = 'MODE_EDIT';
		$attr7_type = 'submit';
		if	( $this->isEditable() && readonly() )
			$attr7_type = ''; // Knopf nicht anzeigen
		$attr7_src  = '';
	if	( !empty($attr7_type) ) {
?><input type="<?php echo $attr7_type ?>"<?php if(isset($attr7_src)) { ?> src="<?php echo $image_dir.'icon_'.$attr7_src.IMG_ICON_EXT ?>"<?php } ?> name="<?php echo $attr7_value ?>" class="<?php echo $attr7_class ?>" title="<?php echo lang($attr7_text.'_DESC') ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo langHtml($attr7_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($attr7_src)
?><?php } 
?><?php unset($attr7_type);unset($attr7_class);unset($attr7_value);unset($attr7_text); ?><?php  ?></form>
<?php  ?><?php  ?></td><?php  ?><?php  ?><?php } ?><?php  ?><?php  $attr4_present='users';  ?><?php 
	$attr4_tmp_exec = isset($$attr4_present);
	$attr4_tmp_last_exec = $attr4_tmp_exec;
	if	( $attr4_tmp_exec )
	{
?>
<?php unset($attr4_present); ?><?php  ?><?php
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
?>><?php  ?><?php  $attr6_action='main';  $attr6_subaction='user';  $attr6_name='';  $attr6_target='cms_main';  $attr6_method='get';  $attr6_enctype='application/x-www-form-urlencoded';  ?><?php
		$attr6_id = $this->getRequestId();
	if ($this->isEditable())
	{
		if	($this->isEditMode())
		{
			$attr6_method    = 'POST';
		}
		else
		{
			$attr6_method    = 'GET';
			$attr6_subaction = $subActionName;
		}
	}
?><form name="<?php echo $attr6_name ?>"
      target="<?php echo $attr6_target ?>"
      action="<?php echo Html::url( $attr6_action,$attr6_subaction,$attr6_id ) ?>"
      method="<?php echo $attr6_method ?>"
      enctype="<?php echo $attr6_enctype ?>" style="margin:0px;padding:0px;">
<?php if ($this->isEditable() && !$this->isEditMode()) { ?>
<input type="hidden" name="mode" value="edit" />
<?php } ?>
<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo $attr6_action ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo $attr6_subaction ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo $attr6_id ?>" /><?php
		if	( $conf['interface']['url_sessionid'] )
			echo '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";
?><?php unset($attr6_action);unset($attr6_subaction);unset($attr6_name);unset($attr6_target);unset($attr6_method);unset($attr6_enctype); ?><?php  $attr7_class='text';  $attr7_default='userid';  $attr7_type='hidden';  $attr7_name='idvar';  $attr7_size='40';  $attr7_maxlength='256';  $attr7_onchange='';  $attr7_readonly=false;  ?><?php if ($this->isEditable() && !$this->isEditMode()) $attr7_readonly=true;
	  if ($attr7_readonly && empty($$attr7_name)) $$attr7_name = '- '.lang('EMPTY').' -';
      if(!isset($attr7_default)) $attr7_default='';
?><?php if (!$attr7_readonly || $attr7_type=='hidden') {
?><input<?php if ($attr7_readonly) echo ' disabled="true"' ?> id="id_<?php echo $attr7_name ?><?php if ($attr7_readonly) echo '_disabled' ?>" name="<?php echo $attr7_name ?><?php if ($attr7_readonly) echo '_disabled' ?>" type="<?php echo $attr7_type ?>" size="<?php echo $attr7_size ?>" maxlength="<?php echo $attr7_maxlength ?>" class="<?php echo $attr7_class ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" <?php if (in_array($attr7_name,$errors)) echo 'style="border-rightx:10px solid red; background-colorx:yellow; border:2px dashed red;"' ?> /><?php
if	($attr7_readonly) {
?><input type="hidden" id="id_<?php echo $attr7_name ?>" name="<?php echo $attr7_name ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" /><?php
 } } else { ?><span class="<?php echo $attr7_class ?>"><?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?></span><?php } ?><?php unset($attr7_class);unset($attr7_default);unset($attr7_type);unset($attr7_name);unset($attr7_size);unset($attr7_maxlength);unset($attr7_onchange);unset($attr7_readonly); ?><?php  $attr7_icon='user';  $attr7_align='left';  ?><?php
	$attr7_tmp_image_file = $image_dir.'icon_'.$attr7_icon.IMG_ICON_EXT;
	$attr7_size = '16x16';
	$attr7_tmp_title = basename($attr7_tmp_image_file);
?><img alt="<?php echo $attr7_tmp_title; if (isset($attr7_size)) { echo ' ('; list($attr7_tmp_width,$attr7_tmp_height)=explode('x',$attr7_size);echo $attr7_tmp_width.'x'.$attr7_tmp_height; echo')';} ?>" src="<?php echo $attr7_tmp_image_file ?>" border="0"<?php if(isset($attr7_align)) echo ' align="'.$attr7_align.'"' ?><?php if (isset($attr7_size)) { list($attr7_tmp_width,$attr7_tmp_height)=explode('x',$attr7_size);echo ' width="'.$attr7_tmp_width.'" height="'.$attr7_tmp_height.'"';} ?>><?php unset($attr7_icon);unset($attr7_align); ?><?php  $attr7_list='users';  $attr7_name='userid';  $attr7_onchange='submit()';  $attr7_title='';  $attr7_class='';  $attr7_addempty='user';  $attr7_multiple=false;  $attr7_size='1';  $attr7_lang=false;  ?><?php
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
?><?php unset($attr7_list);unset($attr7_name);unset($attr7_onchange);unset($attr7_title);unset($attr7_class);unset($attr7_addempty);unset($attr7_multiple);unset($attr7_size);unset($attr7_lang); ?><?php  $attr7_type='ok';  $attr7_class='ok';  $attr7_value='ok';  $attr7_text='>';  ?><?php
		if ($this->isEditable() && !$this->isEditMode())
		$attr7_text = 'MODE_EDIT';
		$attr7_type = 'submit';
		if	( $this->isEditable() && readonly() )
			$attr7_type = ''; // Knopf nicht anzeigen
		$attr7_src  = '';
	if	( !empty($attr7_type) ) {
?><input type="<?php echo $attr7_type ?>"<?php if(isset($attr7_src)) { ?> src="<?php echo $image_dir.'icon_'.$attr7_src.IMG_ICON_EXT ?>"<?php } ?> name="<?php echo $attr7_value ?>" class="<?php echo $attr7_class ?>" title="<?php echo lang($attr7_text.'_DESC') ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo langHtml($attr7_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($attr7_src)
?><?php } 
?><?php unset($attr7_type);unset($attr7_class);unset($attr7_value);unset($attr7_text); ?><?php  ?></form>
<?php  ?><?php  ?></td><?php  ?><?php  ?><?php } ?><?php  ?><?php  $attr4_present='groups';  ?><?php 
	$attr4_tmp_exec = isset($$attr4_present);
	$attr4_tmp_last_exec = $attr4_tmp_exec;
	if	( $attr4_tmp_exec )
	{
?>
<?php unset($attr4_present); ?><?php  ?><?php
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
?>><?php  ?><?php  $attr6_action='main';  $attr6_subaction='group';  $attr6_name='';  $attr6_target='cms_main';  $attr6_method='get';  $attr6_enctype='application/x-www-form-urlencoded';  ?><?php
		$attr6_id = $this->getRequestId();
	if ($this->isEditable())
	{
		if	($this->isEditMode())
		{
			$attr6_method    = 'POST';
		}
		else
		{
			$attr6_method    = 'GET';
			$attr6_subaction = $subActionName;
		}
	}
?><form name="<?php echo $attr6_name ?>"
      target="<?php echo $attr6_target ?>"
      action="<?php echo Html::url( $attr6_action,$attr6_subaction,$attr6_id ) ?>"
      method="<?php echo $attr6_method ?>"
      enctype="<?php echo $attr6_enctype ?>" style="margin:0px;padding:0px;">
<?php if ($this->isEditable() && !$this->isEditMode()) { ?>
<input type="hidden" name="mode" value="edit" />
<?php } ?>
<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo $attr6_action ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo $attr6_subaction ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo $attr6_id ?>" /><?php
		if	( $conf['interface']['url_sessionid'] )
			echo '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";
?><?php unset($attr6_action);unset($attr6_subaction);unset($attr6_name);unset($attr6_target);unset($attr6_method);unset($attr6_enctype); ?><?php  $attr7_class='text';  $attr7_default='groupid';  $attr7_type='hidden';  $attr7_name='idvar';  $attr7_size='40';  $attr7_maxlength='256';  $attr7_onchange='';  $attr7_readonly=false;  ?><?php if ($this->isEditable() && !$this->isEditMode()) $attr7_readonly=true;
	  if ($attr7_readonly && empty($$attr7_name)) $$attr7_name = '- '.lang('EMPTY').' -';
      if(!isset($attr7_default)) $attr7_default='';
?><?php if (!$attr7_readonly || $attr7_type=='hidden') {
?><input<?php if ($attr7_readonly) echo ' disabled="true"' ?> id="id_<?php echo $attr7_name ?><?php if ($attr7_readonly) echo '_disabled' ?>" name="<?php echo $attr7_name ?><?php if ($attr7_readonly) echo '_disabled' ?>" type="<?php echo $attr7_type ?>" size="<?php echo $attr7_size ?>" maxlength="<?php echo $attr7_maxlength ?>" class="<?php echo $attr7_class ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" <?php if (in_array($attr7_name,$errors)) echo 'style="border-rightx:10px solid red; background-colorx:yellow; border:2px dashed red;"' ?> /><?php
if	($attr7_readonly) {
?><input type="hidden" id="id_<?php echo $attr7_name ?>" name="<?php echo $attr7_name ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" /><?php
 } } else { ?><span class="<?php echo $attr7_class ?>"><?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?></span><?php } ?><?php unset($attr7_class);unset($attr7_default);unset($attr7_type);unset($attr7_name);unset($attr7_size);unset($attr7_maxlength);unset($attr7_onchange);unset($attr7_readonly); ?><?php  $attr7_icon='group';  $attr7_align='left';  ?><?php
	$attr7_tmp_image_file = $image_dir.'icon_'.$attr7_icon.IMG_ICON_EXT;
	$attr7_size = '16x16';
	$attr7_tmp_title = basename($attr7_tmp_image_file);
?><img alt="<?php echo $attr7_tmp_title; if (isset($attr7_size)) { echo ' ('; list($attr7_tmp_width,$attr7_tmp_height)=explode('x',$attr7_size);echo $attr7_tmp_width.'x'.$attr7_tmp_height; echo')';} ?>" src="<?php echo $attr7_tmp_image_file ?>" border="0"<?php if(isset($attr7_align)) echo ' align="'.$attr7_align.'"' ?><?php if (isset($attr7_size)) { list($attr7_tmp_width,$attr7_tmp_height)=explode('x',$attr7_size);echo ' width="'.$attr7_tmp_width.'" height="'.$attr7_tmp_height.'"';} ?>><?php unset($attr7_icon);unset($attr7_align); ?><?php  $attr7_list='groups';  $attr7_name='groupid';  $attr7_onchange='submit()';  $attr7_title='';  $attr7_class='';  $attr7_addempty='group';  $attr7_multiple=false;  $attr7_size='1';  $attr7_lang=false;  ?><?php
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
?><?php unset($attr7_list);unset($attr7_name);unset($attr7_onchange);unset($attr7_title);unset($attr7_class);unset($attr7_addempty);unset($attr7_multiple);unset($attr7_size);unset($attr7_lang); ?><?php  $attr7_type='ok';  $attr7_class='ok';  $attr7_value='ok';  $attr7_text='>';  ?><?php
		if ($this->isEditable() && !$this->isEditMode())
		$attr7_text = 'MODE_EDIT';
		$attr7_type = 'submit';
		if	( $this->isEditable() && readonly() )
			$attr7_type = ''; // Knopf nicht anzeigen
		$attr7_src  = '';
	if	( !empty($attr7_type) ) {
?><input type="<?php echo $attr7_type ?>"<?php if(isset($attr7_src)) { ?> src="<?php echo $image_dir.'icon_'.$attr7_src.IMG_ICON_EXT ?>"<?php } ?> name="<?php echo $attr7_value ?>" class="<?php echo $attr7_class ?>" title="<?php echo lang($attr7_text.'_DESC') ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo langHtml($attr7_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($attr7_src)
?><?php } 
?><?php unset($attr7_type);unset($attr7_class);unset($attr7_value);unset($attr7_text); ?><?php  ?></form>
<?php  ?><?php  ?></td><?php  ?><?php  ?><?php } ?><?php  ?><?php  ?></tr><?php  ?><?php  ?></table><?php  ?><?php  ?></body>
</html><?php  ?>