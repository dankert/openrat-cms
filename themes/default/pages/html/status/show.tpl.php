<?php $attr1_debug_info = 'a:1:{s:5:"class";s:6:"status";}' ?><?php $attr1 = array('class'=>'status') ?><?php $attr1_class='status' ?><?php if (!headers_sent()) header('Content-Type: text/html; charset='.lang('CHARSET'))
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
  <title><?php echo isset($attr1_title)?$attr1_title.' - ':(isset($windowTitle)?lang($windowTitle).' - ':'') ?><?php echo $cms_title ?></title>
  <meta http-equiv="content-type" content="text/html; charset=<?php echo lang('CHARSET') ?>" />
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
?>
<?php if(!empty($root_stylesheet)) { ?>
  <link rel="stylesheet" type="text/css" href="<?php echo $root_stylesheet ?>" />
<?php } ?>
<?php if($root_stylesheet!=$user_stylesheet) { ?>
  <link rel="stylesheet" type="text/css" href="<?php echo $user_stylesheet ?>" />
<?php } ?>
</head>
<body class="<?php echo $attr1_class ?>" <?php if (@$conf['interface']['application_mode']) { ?> style="padding:0px;margin:0px;"<?php } ?> >
<?php unset($attr1) ?><?php unset($attr1_class) ?><?php $attr2_debug_info = 'a:4:{s:5:"width";s:4:"100%";s:5:"space";s:3:"0px";s:7:"padding";s:3:"0px";s:10:"rowclasses";s:8:"odd,even";}' ?><?php $attr2 = array('width'=>'100%','space'=>'0px','padding'=>'0px','rowclasses'=>'odd,even') ?><?php $attr2_width='100%' ?><?php $attr2_space='0px' ?><?php $attr2_padding='0px' ?><?php $attr2_rowclasses='odd,even' ?><?php
	$coloumn_widths=array();
	$row_classes   = array('');
	$column_classes= array('');
	if(empty($attr2_class))
		$attr2_class='';
	if	(!empty($attr2_widths))
	{
		$column_widths = explode(',',$attr2_widths);
		unset($attr2['widths']);
	}
	if	(!empty($attr2_classes))
	{
		$row_classes   = explode(',',$attr2_rowclasses);
		$row_class_idx = 999;
		unset($attr2['rowclasses']);
	}
	if	(!empty($attr2_rowclasses))
	{
		$row_classes   = explode(',',$attr2_rowclasses);
		$row_class_idx = 999;
		unset($attr2['rowclasses']);
	}
	if	(!empty($attr2_columnclasses))
	{
		$column_classes   = explode(',',$attr2_columnclasses);
		unset($attr2['columnclasses']);
	}
?><table class="<?php echo $attr2_class ?>" cellspacing="<?php echo $attr2_space ?>" width="<?php echo $attr2_width ?>" cellpadding="<?php echo $attr2_padding ?>"><?php unset($attr2) ?><?php unset($attr2_width) ?><?php unset($attr2_space) ?><?php unset($attr2_padding) ?><?php unset($attr2_rowclasses) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];
	if (empty($attr3_class))
		$attr3_class=$row_class;
	global $cell_column_nr;
	$cell_column_nr=0;
	$column_class_idx = 999;
?><tr class="<?php echo $attr3_class ?>"><?php unset($attr3) ?><?php $attr4_debug_info = 'a:1:{s:7:"present";s:8:"projects";}' ?><?php $attr4 = array('present'=>'projects') ?><?php $attr4_present='projects' ?><?php 
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
?><td <?php foreach( $attr5 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr5) ?><?php $attr6_debug_info = 'a:6:{s:6:"action";s:5:"index";s:9:"subaction";s:7:"project";s:4:"name";s:0:"";s:6:"target";s:4:"_top";s:6:"method";s:4:"post";s:7:"enctype";s:33:"application/x-www-form-urlencoded";}' ?><?php $attr6 = array('action'=>'index','subaction'=>'project','name'=>'','target'=>'_top','method'=>'post','enctype'=>'application/x-www-form-urlencoded') ?><?php $attr6_action='index' ?><?php $attr6_subaction='project' ?><?php $attr6_name='' ?><?php $attr6_target='_top' ?><?php $attr6_method='post' ?><?php $attr6_enctype='application/x-www-form-urlencoded' ?><?php
	if	(empty($attr6_action))
		$attr6_action = $actionName;
	if	(empty($attr6_subaction))
		$attr6_subaction = $targetSubActionName;
	if	(empty($attr6_id))
		$attr6_id = $this->getRequestId();
?><form name="<?php echo $attr6_name ?>"
      target="<?php echo $attr6_target ?>"
      action="<?php echo Html::url( $attr6_action,$attr6_subaction,$attr6_id ) ?>"
      method="<?php echo $attr6_method ?>"
      enctype="<?php echo $attr6_enctype ?>" style="margin:0px;padding:0px;">
<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo $attr6_action ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo $attr6_subaction ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo $attr6_id ?>" /><?php
		if	( $conf['interface']['url_sessionid'] )
			echo '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";
?><?php unset($attr6) ?><?php unset($attr6_action) ?><?php unset($attr6_subaction) ?><?php unset($attr6_name) ?><?php unset($attr6_target) ?><?php unset($attr6_method) ?><?php unset($attr6_enctype) ?><?php $attr7_debug_info = 'a:8:{s:5:"class";s:0:"";s:7:"default";s:14:"text:projectid";s:4:"type";s:6:"hidden";s:4:"name";s:5:"idvar";s:4:"size";s:2:"40";s:9:"maxlength";s:3:"256";s:8:"onchange";s:0:"";s:8:"readonly";s:5:"false";}' ?><?php $attr7 = array('class'=>'','default'=>'projectid','type'=>'hidden','name'=>'idvar','size'=>'40','maxlength'=>'256','onchange'=>'','readonly'=>false) ?><?php $attr7_class='' ?><?php $attr7_default='projectid' ?><?php $attr7_type='hidden' ?><?php $attr7_name='idvar' ?><?php $attr7_size='40' ?><?php $attr7_maxlength='256' ?><?php $attr7_onchange='' ?><?php $attr7_readonly=false ?><?php if(!isset($attr7_default)) $attr7_default='';
?><input<?php if ($attr7_readonly) echo ' disabled="true"' ?> id="id_<?php echo $attr7_name ?><?php if ($attr7_readonly) echo '_disabled' ?>" name="<?php echo $attr7_name ?><?php if ($attr7_readonly) echo '_disabled' ?>" type="<?php echo $attr7_type ?>" size="<?php echo $attr7_size ?>" maxlength="<?php echo $attr7_maxlength ?>" class="<?php echo $attr7_class ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" <?php if (in_array($attr7_name,$errors)) echo 'style="border-rightx:10px solid red; background-colorx:yellow; border:2px dashed red;"' ?> /><?php
if	($attr7_readonly) {
?><input type="hidden" id="id_<?php echo $attr7_name ?>" name="<?php echo $attr7_name ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" /><?php
 } ?><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_default) ?><?php unset($attr7_type) ?><?php unset($attr7_name) ?><?php unset($attr7_size) ?><?php unset($attr7_maxlength) ?><?php unset($attr7_onchange) ?><?php unset($attr7_readonly) ?><?php $attr7_debug_info = 'a:2:{s:4:"icon";s:7:"project";s:5:"align";s:4:"left";}' ?><?php $attr7 = array('icon'=>'project','align'=>'left') ?><?php $attr7_icon='project' ?><?php $attr7_align='left' ?><?php
if (isset($attr7_elementtype)) {
?><img src="<?php echo $image_dir.'icon_el_'.$attr7_elementtype.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr7_align ?>"><?php
} elseif (isset($attr7_type)) {
?><img src="<?php echo $image_dir.'icon_'.$attr7_type.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr7_align ?>"><?php
} elseif (isset($attr7_icon)) {
?><img src="<?php echo $image_dir.'icon_'.$attr7_icon.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr7_align ?>"><?php
} elseif (isset($attr7_url)) {
?><img src="<?php echo $attr7_url ?>" border="0" align="<?php echo $attr7_align ?>"><?php
} elseif (isset($attr7_fileext)) {
?><img src="<?php echo $image_dir.$attr7_fileext ?>" border="0" align="<?php echo $attr7_align ?>"><?php
} elseif (isset($attr7_file)) {
?><img src="<?php echo $image_dir.$attr7_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr7_align ?>"><?php } ?><?php unset($attr7) ?><?php unset($attr7_icon) ?><?php unset($attr7_align) ?><?php $attr7_debug_info = 'a:9:{s:4:"list";s:8:"projects";s:4:"name";s:9:"projectid";s:8:"onchange";s:8:"submit()";s:5:"title";s:0:"";s:5:"class";s:0:"";s:8:"addempty";s:8:"projects";s:8:"multiple";s:5:"false";s:4:"size";s:1:"1";s:4:"lang";s:5:"false";}' ?><?php $attr7 = array('list'=>'projects','name'=>'projectid','onchange'=>'submit()','title'=>'','class'=>'','addempty'=>'projects','multiple'=>false,'size'=>'1','lang'=>false) ?><?php $attr7_list='projects' ?><?php $attr7_name='projectid' ?><?php $attr7_onchange='submit()' ?><?php $attr7_title='' ?><?php $attr7_class='' ?><?php $attr7_addempty='projects' ?><?php $attr7_multiple=false ?><?php $attr7_size='1' ?><?php $attr7_lang=false ?><?php
if ( $attr7_addempty!==FALSE  )
{
	if ($attr7_addempty===TRUE)
		$$attr7_list = array(''=>lang('LIST_ENTRY_EMPTY'))+$$attr7_list;
	else
		$$attr7_list = array(''=>'- '.lang($attr7_addempty).' -')+$$attr7_list;
}
?><select id="id_<?php echo $attr7_name ?>"  name="<?php echo $attr7_name; if ($attr7_multiple) echo '[]'; ?>" onchange="<?php echo $attr7_onchange ?>" title="<?php echo $attr7_title ?>" class="<?php echo $attr7_class ?>"<?php
if (count($$attr7_list)<=1) echo ' disabled="disabled"';
if	($attr7_multiple) echo ' multiple="multiple"';
if (in_array($attr7_name,$errors)) echo ' style="background-color:red; border:2px dashed red;"';
echo ' size="'.intval($attr7_size).'"';
?>><?php
		$attr7_tmp_list = $$attr7_list;
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
if (count($$attr7_list)==1) echo '<input type="hidden" name="'.$attr7_name.'" value="'.$box_key.'" />'
?><?php unset($attr7) ?><?php unset($attr7_list) ?><?php unset($attr7_name) ?><?php unset($attr7_onchange) ?><?php unset($attr7_title) ?><?php unset($attr7_class) ?><?php unset($attr7_addempty) ?><?php unset($attr7_multiple) ?><?php unset($attr7_size) ?><?php unset($attr7_lang) ?><?php $attr7_debug_info = 'a:4:{s:4:"type";s:2:"ok";s:5:"class";s:2:"ok";s:5:"value";s:2:"ok";s:4:"text";s:9:"message:>";}' ?><?php $attr7 = array('type'=>'ok','class'=>'ok','value'=>'ok','text'=>lang('>')) ?><?php $attr7_type='ok' ?><?php $attr7_class='ok' ?><?php $attr7_value='ok' ?><?php $attr7_text=lang('>') ?><?php
	if ($attr7_type=='ok')
		$attr7_type  = 'submit';
	if (isset($attr7_src))
		$attr7_type  = 'image';
	else
		$attr7_src  = '';
?><input type="<?php echo $attr7_type ?>"<?php if(isset($attr7_src)) { ?> src="<?php echo $image_dir.'icon_'.$attr7_src.IMG_ICON_EXT ?>"<?php } ?> name="<?php echo $attr7_value ?>" class="<?php echo $attr7_class ?>" title="<?php echo lang($attr7_text.'_DESC') ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo lang($attr7_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($attr7_src) ?><?php unset($attr7) ?><?php unset($attr7_type) ?><?php unset($attr7_class) ?><?php unset($attr7_value) ?><?php unset($attr7_text) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></form>
<?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></td><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php } ?><?php unset($attr3) ?><?php $attr4_debug_info = 'a:2:{s:5:"value";s:11:"size:models";s:11:"greaterthan";s:1:"1";}' ?><?php $attr4 = array('value'=>@count($models),'greaterthan'=>'1') ?><?php $attr4_value=@count($models) ?><?php $attr4_greaterthan='1' ?><?php 
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
<?php unset($attr4) ?><?php unset($attr4_value) ?><?php unset($attr4_greaterthan) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?><?php
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
?><td <?php foreach( $attr5 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr5) ?><?php $attr6_debug_info = 'a:6:{s:6:"action";s:5:"index";s:9:"subaction";s:5:"model";s:4:"name";s:0:"";s:6:"target";s:4:"_top";s:6:"method";s:3:"get";s:7:"enctype";s:33:"application/x-www-form-urlencoded";}' ?><?php $attr6 = array('action'=>'index','subaction'=>'model','name'=>'','target'=>'_top','method'=>'get','enctype'=>'application/x-www-form-urlencoded') ?><?php $attr6_action='index' ?><?php $attr6_subaction='model' ?><?php $attr6_name='' ?><?php $attr6_target='_top' ?><?php $attr6_method='get' ?><?php $attr6_enctype='application/x-www-form-urlencoded' ?><?php
	if	(empty($attr6_action))
		$attr6_action = $actionName;
	if	(empty($attr6_subaction))
		$attr6_subaction = $targetSubActionName;
	if	(empty($attr6_id))
		$attr6_id = $this->getRequestId();
?><form name="<?php echo $attr6_name ?>"
      target="<?php echo $attr6_target ?>"
      action="<?php echo Html::url( $attr6_action,$attr6_subaction,$attr6_id ) ?>"
      method="<?php echo $attr6_method ?>"
      enctype="<?php echo $attr6_enctype ?>" style="margin:0px;padding:0px;">
<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo $attr6_action ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo $attr6_subaction ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo $attr6_id ?>" /><?php
		if	( $conf['interface']['url_sessionid'] )
			echo '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";
?><?php unset($attr6) ?><?php unset($attr6_action) ?><?php unset($attr6_subaction) ?><?php unset($attr6_name) ?><?php unset($attr6_target) ?><?php unset($attr6_method) ?><?php unset($attr6_enctype) ?><?php $attr7_debug_info = 'a:8:{s:5:"class";s:0:"";s:7:"default";s:12:"text:modelid";s:4:"type";s:6:"hidden";s:4:"name";s:5:"idvar";s:4:"size";s:2:"40";s:9:"maxlength";s:3:"256";s:8:"onchange";s:0:"";s:8:"readonly";s:5:"false";}' ?><?php $attr7 = array('class'=>'','default'=>'modelid','type'=>'hidden','name'=>'idvar','size'=>'40','maxlength'=>'256','onchange'=>'','readonly'=>false) ?><?php $attr7_class='' ?><?php $attr7_default='modelid' ?><?php $attr7_type='hidden' ?><?php $attr7_name='idvar' ?><?php $attr7_size='40' ?><?php $attr7_maxlength='256' ?><?php $attr7_onchange='' ?><?php $attr7_readonly=false ?><?php if(!isset($attr7_default)) $attr7_default='';
?><input<?php if ($attr7_readonly) echo ' disabled="true"' ?> id="id_<?php echo $attr7_name ?><?php if ($attr7_readonly) echo '_disabled' ?>" name="<?php echo $attr7_name ?><?php if ($attr7_readonly) echo '_disabled' ?>" type="<?php echo $attr7_type ?>" size="<?php echo $attr7_size ?>" maxlength="<?php echo $attr7_maxlength ?>" class="<?php echo $attr7_class ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" <?php if (in_array($attr7_name,$errors)) echo 'style="border-rightx:10px solid red; background-colorx:yellow; border:2px dashed red;"' ?> /><?php
if	($attr7_readonly) {
?><input type="hidden" id="id_<?php echo $attr7_name ?>" name="<?php echo $attr7_name ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" /><?php
 } ?><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_default) ?><?php unset($attr7_type) ?><?php unset($attr7_name) ?><?php unset($attr7_size) ?><?php unset($attr7_maxlength) ?><?php unset($attr7_onchange) ?><?php unset($attr7_readonly) ?><?php $attr7_debug_info = 'a:2:{s:4:"icon";s:5:"model";s:5:"align";s:4:"left";}' ?><?php $attr7 = array('icon'=>'model','align'=>'left') ?><?php $attr7_icon='model' ?><?php $attr7_align='left' ?><?php
if (isset($attr7_elementtype)) {
?><img src="<?php echo $image_dir.'icon_el_'.$attr7_elementtype.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr7_align ?>"><?php
} elseif (isset($attr7_type)) {
?><img src="<?php echo $image_dir.'icon_'.$attr7_type.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr7_align ?>"><?php
} elseif (isset($attr7_icon)) {
?><img src="<?php echo $image_dir.'icon_'.$attr7_icon.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr7_align ?>"><?php
} elseif (isset($attr7_url)) {
?><img src="<?php echo $attr7_url ?>" border="0" align="<?php echo $attr7_align ?>"><?php
} elseif (isset($attr7_fileext)) {
?><img src="<?php echo $image_dir.$attr7_fileext ?>" border="0" align="<?php echo $attr7_align ?>"><?php
} elseif (isset($attr7_file)) {
?><img src="<?php echo $image_dir.$attr7_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr7_align ?>"><?php } ?><?php unset($attr7) ?><?php unset($attr7_icon) ?><?php unset($attr7_align) ?><?php $attr7_debug_info = 'a:9:{s:4:"list";s:6:"models";s:4:"name";s:7:"modelid";s:8:"onchange";s:8:"submit()";s:5:"title";s:0:"";s:5:"class";s:0:"";s:8:"addempty";s:5:"model";s:8:"multiple";s:5:"false";s:4:"size";s:1:"1";s:4:"lang";s:5:"false";}' ?><?php $attr7 = array('list'=>'models','name'=>'modelid','onchange'=>'submit()','title'=>'','class'=>'','addempty'=>'model','multiple'=>false,'size'=>'1','lang'=>false) ?><?php $attr7_list='models' ?><?php $attr7_name='modelid' ?><?php $attr7_onchange='submit()' ?><?php $attr7_title='' ?><?php $attr7_class='' ?><?php $attr7_addempty='model' ?><?php $attr7_multiple=false ?><?php $attr7_size='1' ?><?php $attr7_lang=false ?><?php
if ( $attr7_addempty!==FALSE  )
{
	if ($attr7_addempty===TRUE)
		$$attr7_list = array(''=>lang('LIST_ENTRY_EMPTY'))+$$attr7_list;
	else
		$$attr7_list = array(''=>'- '.lang($attr7_addempty).' -')+$$attr7_list;
}
?><select id="id_<?php echo $attr7_name ?>"  name="<?php echo $attr7_name; if ($attr7_multiple) echo '[]'; ?>" onchange="<?php echo $attr7_onchange ?>" title="<?php echo $attr7_title ?>" class="<?php echo $attr7_class ?>"<?php
if (count($$attr7_list)<=1) echo ' disabled="disabled"';
if	($attr7_multiple) echo ' multiple="multiple"';
if (in_array($attr7_name,$errors)) echo ' style="background-color:red; border:2px dashed red;"';
echo ' size="'.intval($attr7_size).'"';
?>><?php
		$attr7_tmp_list = $$attr7_list;
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
if (count($$attr7_list)==1) echo '<input type="hidden" name="'.$attr7_name.'" value="'.$box_key.'" />'
?><?php unset($attr7) ?><?php unset($attr7_list) ?><?php unset($attr7_name) ?><?php unset($attr7_onchange) ?><?php unset($attr7_title) ?><?php unset($attr7_class) ?><?php unset($attr7_addempty) ?><?php unset($attr7_multiple) ?><?php unset($attr7_size) ?><?php unset($attr7_lang) ?><?php $attr7_debug_info = 'a:4:{s:4:"type";s:2:"ok";s:5:"class";s:2:"ok";s:5:"value";s:2:"ok";s:4:"text";s:1:">";}' ?><?php $attr7 = array('type'=>'ok','class'=>'ok','value'=>'ok','text'=>'>') ?><?php $attr7_type='ok' ?><?php $attr7_class='ok' ?><?php $attr7_value='ok' ?><?php $attr7_text='>' ?><?php
	if ($attr7_type=='ok')
		$attr7_type  = 'submit';
	if (isset($attr7_src))
		$attr7_type  = 'image';
	else
		$attr7_src  = '';
?><input type="<?php echo $attr7_type ?>"<?php if(isset($attr7_src)) { ?> src="<?php echo $image_dir.'icon_'.$attr7_src.IMG_ICON_EXT ?>"<?php } ?> name="<?php echo $attr7_value ?>" class="<?php echo $attr7_class ?>" title="<?php echo lang($attr7_text.'_DESC') ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo lang($attr7_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($attr7_src) ?><?php unset($attr7) ?><?php unset($attr7_type) ?><?php unset($attr7_class) ?><?php unset($attr7_value) ?><?php unset($attr7_text) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></form>
<?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></td><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php } ?><?php unset($attr3) ?><?php $attr4_debug_info = 'a:2:{s:5:"value";s:14:"size:languages";s:11:"greaterthan";s:1:"1";}' ?><?php $attr4 = array('value'=>@count($languages),'greaterthan'=>'1') ?><?php $attr4_value=@count($languages) ?><?php $attr4_greaterthan='1' ?><?php 
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
<?php unset($attr4) ?><?php unset($attr4_value) ?><?php unset($attr4_greaterthan) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?><?php
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
?><td <?php foreach( $attr5 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr5) ?><?php $attr6_debug_info = 'a:6:{s:6:"action";s:5:"index";s:9:"subaction";s:8:"language";s:4:"name";s:0:"";s:6:"target";s:4:"_top";s:6:"method";s:3:"get";s:7:"enctype";s:33:"application/x-www-form-urlencoded";}' ?><?php $attr6 = array('action'=>'index','subaction'=>'language','name'=>'','target'=>'_top','method'=>'get','enctype'=>'application/x-www-form-urlencoded') ?><?php $attr6_action='index' ?><?php $attr6_subaction='language' ?><?php $attr6_name='' ?><?php $attr6_target='_top' ?><?php $attr6_method='get' ?><?php $attr6_enctype='application/x-www-form-urlencoded' ?><?php
	if	(empty($attr6_action))
		$attr6_action = $actionName;
	if	(empty($attr6_subaction))
		$attr6_subaction = $targetSubActionName;
	if	(empty($attr6_id))
		$attr6_id = $this->getRequestId();
?><form name="<?php echo $attr6_name ?>"
      target="<?php echo $attr6_target ?>"
      action="<?php echo Html::url( $attr6_action,$attr6_subaction,$attr6_id ) ?>"
      method="<?php echo $attr6_method ?>"
      enctype="<?php echo $attr6_enctype ?>" style="margin:0px;padding:0px;">
<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo $attr6_action ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo $attr6_subaction ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo $attr6_id ?>" /><?php
		if	( $conf['interface']['url_sessionid'] )
			echo '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";
?><?php unset($attr6) ?><?php unset($attr6_action) ?><?php unset($attr6_subaction) ?><?php unset($attr6_name) ?><?php unset($attr6_target) ?><?php unset($attr6_method) ?><?php unset($attr6_enctype) ?><?php $attr7_debug_info = 'a:8:{s:5:"class";s:0:"";s:7:"default";s:15:"text:languageid";s:4:"type";s:6:"hidden";s:4:"name";s:5:"idvar";s:4:"size";s:2:"40";s:9:"maxlength";s:3:"256";s:8:"onchange";s:0:"";s:8:"readonly";s:5:"false";}' ?><?php $attr7 = array('class'=>'','default'=>'languageid','type'=>'hidden','name'=>'idvar','size'=>'40','maxlength'=>'256','onchange'=>'','readonly'=>false) ?><?php $attr7_class='' ?><?php $attr7_default='languageid' ?><?php $attr7_type='hidden' ?><?php $attr7_name='idvar' ?><?php $attr7_size='40' ?><?php $attr7_maxlength='256' ?><?php $attr7_onchange='' ?><?php $attr7_readonly=false ?><?php if(!isset($attr7_default)) $attr7_default='';
?><input<?php if ($attr7_readonly) echo ' disabled="true"' ?> id="id_<?php echo $attr7_name ?><?php if ($attr7_readonly) echo '_disabled' ?>" name="<?php echo $attr7_name ?><?php if ($attr7_readonly) echo '_disabled' ?>" type="<?php echo $attr7_type ?>" size="<?php echo $attr7_size ?>" maxlength="<?php echo $attr7_maxlength ?>" class="<?php echo $attr7_class ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" <?php if (in_array($attr7_name,$errors)) echo 'style="border-rightx:10px solid red; background-colorx:yellow; border:2px dashed red;"' ?> /><?php
if	($attr7_readonly) {
?><input type="hidden" id="id_<?php echo $attr7_name ?>" name="<?php echo $attr7_name ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" /><?php
 } ?><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_default) ?><?php unset($attr7_type) ?><?php unset($attr7_name) ?><?php unset($attr7_size) ?><?php unset($attr7_maxlength) ?><?php unset($attr7_onchange) ?><?php unset($attr7_readonly) ?><?php $attr7_debug_info = 'a:2:{s:4:"icon";s:8:"language";s:5:"align";s:4:"left";}' ?><?php $attr7 = array('icon'=>'language','align'=>'left') ?><?php $attr7_icon='language' ?><?php $attr7_align='left' ?><?php
if (isset($attr7_elementtype)) {
?><img src="<?php echo $image_dir.'icon_el_'.$attr7_elementtype.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr7_align ?>"><?php
} elseif (isset($attr7_type)) {
?><img src="<?php echo $image_dir.'icon_'.$attr7_type.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr7_align ?>"><?php
} elseif (isset($attr7_icon)) {
?><img src="<?php echo $image_dir.'icon_'.$attr7_icon.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr7_align ?>"><?php
} elseif (isset($attr7_url)) {
?><img src="<?php echo $attr7_url ?>" border="0" align="<?php echo $attr7_align ?>"><?php
} elseif (isset($attr7_fileext)) {
?><img src="<?php echo $image_dir.$attr7_fileext ?>" border="0" align="<?php echo $attr7_align ?>"><?php
} elseif (isset($attr7_file)) {
?><img src="<?php echo $image_dir.$attr7_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr7_align ?>"><?php } ?><?php unset($attr7) ?><?php unset($attr7_icon) ?><?php unset($attr7_align) ?><?php $attr7_debug_info = 'a:9:{s:4:"list";s:9:"languages";s:4:"name";s:10:"languageid";s:8:"onchange";s:8:"submit()";s:5:"title";s:0:"";s:5:"class";s:0:"";s:8:"addempty";s:8:"language";s:8:"multiple";s:5:"false";s:4:"size";s:1:"1";s:4:"lang";s:5:"false";}' ?><?php $attr7 = array('list'=>'languages','name'=>'languageid','onchange'=>'submit()','title'=>'','class'=>'','addempty'=>'language','multiple'=>false,'size'=>'1','lang'=>false) ?><?php $attr7_list='languages' ?><?php $attr7_name='languageid' ?><?php $attr7_onchange='submit()' ?><?php $attr7_title='' ?><?php $attr7_class='' ?><?php $attr7_addempty='language' ?><?php $attr7_multiple=false ?><?php $attr7_size='1' ?><?php $attr7_lang=false ?><?php
if ( $attr7_addempty!==FALSE  )
{
	if ($attr7_addempty===TRUE)
		$$attr7_list = array(''=>lang('LIST_ENTRY_EMPTY'))+$$attr7_list;
	else
		$$attr7_list = array(''=>'- '.lang($attr7_addempty).' -')+$$attr7_list;
}
?><select id="id_<?php echo $attr7_name ?>"  name="<?php echo $attr7_name; if ($attr7_multiple) echo '[]'; ?>" onchange="<?php echo $attr7_onchange ?>" title="<?php echo $attr7_title ?>" class="<?php echo $attr7_class ?>"<?php
if (count($$attr7_list)<=1) echo ' disabled="disabled"';
if	($attr7_multiple) echo ' multiple="multiple"';
if (in_array($attr7_name,$errors)) echo ' style="background-color:red; border:2px dashed red;"';
echo ' size="'.intval($attr7_size).'"';
?>><?php
		$attr7_tmp_list = $$attr7_list;
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
if (count($$attr7_list)==1) echo '<input type="hidden" name="'.$attr7_name.'" value="'.$box_key.'" />'
?><?php unset($attr7) ?><?php unset($attr7_list) ?><?php unset($attr7_name) ?><?php unset($attr7_onchange) ?><?php unset($attr7_title) ?><?php unset($attr7_class) ?><?php unset($attr7_addempty) ?><?php unset($attr7_multiple) ?><?php unset($attr7_size) ?><?php unset($attr7_lang) ?><?php $attr7_debug_info = 'a:4:{s:4:"type";s:2:"ok";s:5:"class";s:2:"ok";s:5:"value";s:2:"ok";s:4:"text";s:1:">";}' ?><?php $attr7 = array('type'=>'ok','class'=>'ok','value'=>'ok','text'=>'>') ?><?php $attr7_type='ok' ?><?php $attr7_class='ok' ?><?php $attr7_value='ok' ?><?php $attr7_text='>' ?><?php
	if ($attr7_type=='ok')
		$attr7_type  = 'submit';
	if (isset($attr7_src))
		$attr7_type  = 'image';
	else
		$attr7_src  = '';
?><input type="<?php echo $attr7_type ?>"<?php if(isset($attr7_src)) { ?> src="<?php echo $image_dir.'icon_'.$attr7_src.IMG_ICON_EXT ?>"<?php } ?> name="<?php echo $attr7_value ?>" class="<?php echo $attr7_class ?>" title="<?php echo lang($attr7_text.'_DESC') ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo lang($attr7_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($attr7_src) ?><?php unset($attr7) ?><?php unset($attr7_type) ?><?php unset($attr7_class) ?><?php unset($attr7_value) ?><?php unset($attr7_text) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></form>
<?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></td><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php } ?><?php unset($attr3) ?><?php $attr4_debug_info = 'a:1:{s:7:"present";s:9:"templates";}' ?><?php $attr4 = array('present'=>'templates') ?><?php $attr4_present='templates' ?><?php 
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
?><td <?php foreach( $attr5 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr5) ?><?php $attr6_debug_info = 'a:6:{s:6:"action";s:4:"main";s:9:"subaction";s:8:"template";s:4:"name";s:0:"";s:6:"target";s:8:"cms_main";s:6:"method";s:3:"get";s:7:"enctype";s:33:"application/x-www-form-urlencoded";}' ?><?php $attr6 = array('action'=>'main','subaction'=>'template','name'=>'','target'=>'cms_main','method'=>'get','enctype'=>'application/x-www-form-urlencoded') ?><?php $attr6_action='main' ?><?php $attr6_subaction='template' ?><?php $attr6_name='' ?><?php $attr6_target='cms_main' ?><?php $attr6_method='get' ?><?php $attr6_enctype='application/x-www-form-urlencoded' ?><?php
	if	(empty($attr6_action))
		$attr6_action = $actionName;
	if	(empty($attr6_subaction))
		$attr6_subaction = $targetSubActionName;
	if	(empty($attr6_id))
		$attr6_id = $this->getRequestId();
?><form name="<?php echo $attr6_name ?>"
      target="<?php echo $attr6_target ?>"
      action="<?php echo Html::url( $attr6_action,$attr6_subaction,$attr6_id ) ?>"
      method="<?php echo $attr6_method ?>"
      enctype="<?php echo $attr6_enctype ?>" style="margin:0px;padding:0px;">
<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo $attr6_action ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo $attr6_subaction ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo $attr6_id ?>" /><?php
		if	( $conf['interface']['url_sessionid'] )
			echo '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";
?><?php unset($attr6) ?><?php unset($attr6_action) ?><?php unset($attr6_subaction) ?><?php unset($attr6_name) ?><?php unset($attr6_target) ?><?php unset($attr6_method) ?><?php unset($attr6_enctype) ?><?php $attr7_debug_info = 'a:8:{s:5:"class";s:0:"";s:7:"default";s:15:"text:templateid";s:4:"type";s:6:"hidden";s:4:"name";s:5:"idvar";s:4:"size";s:2:"40";s:9:"maxlength";s:3:"256";s:8:"onchange";s:0:"";s:8:"readonly";s:5:"false";}' ?><?php $attr7 = array('class'=>'','default'=>'templateid','type'=>'hidden','name'=>'idvar','size'=>'40','maxlength'=>'256','onchange'=>'','readonly'=>false) ?><?php $attr7_class='' ?><?php $attr7_default='templateid' ?><?php $attr7_type='hidden' ?><?php $attr7_name='idvar' ?><?php $attr7_size='40' ?><?php $attr7_maxlength='256' ?><?php $attr7_onchange='' ?><?php $attr7_readonly=false ?><?php if(!isset($attr7_default)) $attr7_default='';
?><input<?php if ($attr7_readonly) echo ' disabled="true"' ?> id="id_<?php echo $attr7_name ?><?php if ($attr7_readonly) echo '_disabled' ?>" name="<?php echo $attr7_name ?><?php if ($attr7_readonly) echo '_disabled' ?>" type="<?php echo $attr7_type ?>" size="<?php echo $attr7_size ?>" maxlength="<?php echo $attr7_maxlength ?>" class="<?php echo $attr7_class ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" <?php if (in_array($attr7_name,$errors)) echo 'style="border-rightx:10px solid red; background-colorx:yellow; border:2px dashed red;"' ?> /><?php
if	($attr7_readonly) {
?><input type="hidden" id="id_<?php echo $attr7_name ?>" name="<?php echo $attr7_name ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" /><?php
 } ?><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_default) ?><?php unset($attr7_type) ?><?php unset($attr7_name) ?><?php unset($attr7_size) ?><?php unset($attr7_maxlength) ?><?php unset($attr7_onchange) ?><?php unset($attr7_readonly) ?><?php $attr7_debug_info = 'a:2:{s:4:"icon";s:8:"template";s:5:"align";s:4:"left";}' ?><?php $attr7 = array('icon'=>'template','align'=>'left') ?><?php $attr7_icon='template' ?><?php $attr7_align='left' ?><?php
if (isset($attr7_elementtype)) {
?><img src="<?php echo $image_dir.'icon_el_'.$attr7_elementtype.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr7_align ?>"><?php
} elseif (isset($attr7_type)) {
?><img src="<?php echo $image_dir.'icon_'.$attr7_type.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr7_align ?>"><?php
} elseif (isset($attr7_icon)) {
?><img src="<?php echo $image_dir.'icon_'.$attr7_icon.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr7_align ?>"><?php
} elseif (isset($attr7_url)) {
?><img src="<?php echo $attr7_url ?>" border="0" align="<?php echo $attr7_align ?>"><?php
} elseif (isset($attr7_fileext)) {
?><img src="<?php echo $image_dir.$attr7_fileext ?>" border="0" align="<?php echo $attr7_align ?>"><?php
} elseif (isset($attr7_file)) {
?><img src="<?php echo $image_dir.$attr7_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr7_align ?>"><?php } ?><?php unset($attr7) ?><?php unset($attr7_icon) ?><?php unset($attr7_align) ?><?php $attr7_debug_info = 'a:9:{s:4:"list";s:9:"templates";s:4:"name";s:10:"templateid";s:8:"onchange";s:8:"submit()";s:5:"title";s:0:"";s:5:"class";s:0:"";s:8:"addempty";s:8:"template";s:8:"multiple";s:5:"false";s:4:"size";s:1:"1";s:4:"lang";s:5:"false";}' ?><?php $attr7 = array('list'=>'templates','name'=>'templateid','onchange'=>'submit()','title'=>'','class'=>'','addempty'=>'template','multiple'=>false,'size'=>'1','lang'=>false) ?><?php $attr7_list='templates' ?><?php $attr7_name='templateid' ?><?php $attr7_onchange='submit()' ?><?php $attr7_title='' ?><?php $attr7_class='' ?><?php $attr7_addempty='template' ?><?php $attr7_multiple=false ?><?php $attr7_size='1' ?><?php $attr7_lang=false ?><?php
if ( $attr7_addempty!==FALSE  )
{
	if ($attr7_addempty===TRUE)
		$$attr7_list = array(''=>lang('LIST_ENTRY_EMPTY'))+$$attr7_list;
	else
		$$attr7_list = array(''=>'- '.lang($attr7_addempty).' -')+$$attr7_list;
}
?><select id="id_<?php echo $attr7_name ?>"  name="<?php echo $attr7_name; if ($attr7_multiple) echo '[]'; ?>" onchange="<?php echo $attr7_onchange ?>" title="<?php echo $attr7_title ?>" class="<?php echo $attr7_class ?>"<?php
if (count($$attr7_list)<=1) echo ' disabled="disabled"';
if	($attr7_multiple) echo ' multiple="multiple"';
if (in_array($attr7_name,$errors)) echo ' style="background-color:red; border:2px dashed red;"';
echo ' size="'.intval($attr7_size).'"';
?>><?php
		$attr7_tmp_list = $$attr7_list;
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
if (count($$attr7_list)==1) echo '<input type="hidden" name="'.$attr7_name.'" value="'.$box_key.'" />'
?><?php unset($attr7) ?><?php unset($attr7_list) ?><?php unset($attr7_name) ?><?php unset($attr7_onchange) ?><?php unset($attr7_title) ?><?php unset($attr7_class) ?><?php unset($attr7_addempty) ?><?php unset($attr7_multiple) ?><?php unset($attr7_size) ?><?php unset($attr7_lang) ?><?php $attr7_debug_info = 'a:4:{s:4:"type";s:2:"ok";s:5:"class";s:2:"ok";s:5:"value";s:2:"ok";s:4:"text";s:1:">";}' ?><?php $attr7 = array('type'=>'ok','class'=>'ok','value'=>'ok','text'=>'>') ?><?php $attr7_type='ok' ?><?php $attr7_class='ok' ?><?php $attr7_value='ok' ?><?php $attr7_text='>' ?><?php
	if ($attr7_type=='ok')
		$attr7_type  = 'submit';
	if (isset($attr7_src))
		$attr7_type  = 'image';
	else
		$attr7_src  = '';
?><input type="<?php echo $attr7_type ?>"<?php if(isset($attr7_src)) { ?> src="<?php echo $image_dir.'icon_'.$attr7_src.IMG_ICON_EXT ?>"<?php } ?> name="<?php echo $attr7_value ?>" class="<?php echo $attr7_class ?>" title="<?php echo lang($attr7_text.'_DESC') ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo lang($attr7_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($attr7_src) ?><?php unset($attr7) ?><?php unset($attr7_type) ?><?php unset($attr7_class) ?><?php unset($attr7_value) ?><?php unset($attr7_text) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></form>
<?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></td><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php } ?><?php unset($attr3) ?><?php $attr4_debug_info = 'a:1:{s:7:"present";s:5:"users";}' ?><?php $attr4 = array('present'=>'users') ?><?php $attr4_present='users' ?><?php 
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
?><td <?php foreach( $attr5 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr5) ?><?php $attr6_debug_info = 'a:6:{s:6:"action";s:4:"main";s:9:"subaction";s:4:"user";s:4:"name";s:0:"";s:6:"target";s:8:"cms_main";s:6:"method";s:3:"get";s:7:"enctype";s:33:"application/x-www-form-urlencoded";}' ?><?php $attr6 = array('action'=>'main','subaction'=>'user','name'=>'','target'=>'cms_main','method'=>'get','enctype'=>'application/x-www-form-urlencoded') ?><?php $attr6_action='main' ?><?php $attr6_subaction='user' ?><?php $attr6_name='' ?><?php $attr6_target='cms_main' ?><?php $attr6_method='get' ?><?php $attr6_enctype='application/x-www-form-urlencoded' ?><?php
	if	(empty($attr6_action))
		$attr6_action = $actionName;
	if	(empty($attr6_subaction))
		$attr6_subaction = $targetSubActionName;
	if	(empty($attr6_id))
		$attr6_id = $this->getRequestId();
?><form name="<?php echo $attr6_name ?>"
      target="<?php echo $attr6_target ?>"
      action="<?php echo Html::url( $attr6_action,$attr6_subaction,$attr6_id ) ?>"
      method="<?php echo $attr6_method ?>"
      enctype="<?php echo $attr6_enctype ?>" style="margin:0px;padding:0px;">
<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo $attr6_action ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo $attr6_subaction ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo $attr6_id ?>" /><?php
		if	( $conf['interface']['url_sessionid'] )
			echo '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";
?><?php unset($attr6) ?><?php unset($attr6_action) ?><?php unset($attr6_subaction) ?><?php unset($attr6_name) ?><?php unset($attr6_target) ?><?php unset($attr6_method) ?><?php unset($attr6_enctype) ?><?php $attr7_debug_info = 'a:8:{s:5:"class";s:0:"";s:7:"default";s:11:"text:userid";s:4:"type";s:6:"hidden";s:4:"name";s:5:"idvar";s:4:"size";s:2:"40";s:9:"maxlength";s:3:"256";s:8:"onchange";s:0:"";s:8:"readonly";s:5:"false";}' ?><?php $attr7 = array('class'=>'','default'=>'userid','type'=>'hidden','name'=>'idvar','size'=>'40','maxlength'=>'256','onchange'=>'','readonly'=>false) ?><?php $attr7_class='' ?><?php $attr7_default='userid' ?><?php $attr7_type='hidden' ?><?php $attr7_name='idvar' ?><?php $attr7_size='40' ?><?php $attr7_maxlength='256' ?><?php $attr7_onchange='' ?><?php $attr7_readonly=false ?><?php if(!isset($attr7_default)) $attr7_default='';
?><input<?php if ($attr7_readonly) echo ' disabled="true"' ?> id="id_<?php echo $attr7_name ?><?php if ($attr7_readonly) echo '_disabled' ?>" name="<?php echo $attr7_name ?><?php if ($attr7_readonly) echo '_disabled' ?>" type="<?php echo $attr7_type ?>" size="<?php echo $attr7_size ?>" maxlength="<?php echo $attr7_maxlength ?>" class="<?php echo $attr7_class ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" <?php if (in_array($attr7_name,$errors)) echo 'style="border-rightx:10px solid red; background-colorx:yellow; border:2px dashed red;"' ?> /><?php
if	($attr7_readonly) {
?><input type="hidden" id="id_<?php echo $attr7_name ?>" name="<?php echo $attr7_name ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" /><?php
 } ?><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_default) ?><?php unset($attr7_type) ?><?php unset($attr7_name) ?><?php unset($attr7_size) ?><?php unset($attr7_maxlength) ?><?php unset($attr7_onchange) ?><?php unset($attr7_readonly) ?><?php $attr7_debug_info = 'a:2:{s:4:"icon";s:4:"user";s:5:"align";s:4:"left";}' ?><?php $attr7 = array('icon'=>'user','align'=>'left') ?><?php $attr7_icon='user' ?><?php $attr7_align='left' ?><?php
if (isset($attr7_elementtype)) {
?><img src="<?php echo $image_dir.'icon_el_'.$attr7_elementtype.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr7_align ?>"><?php
} elseif (isset($attr7_type)) {
?><img src="<?php echo $image_dir.'icon_'.$attr7_type.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr7_align ?>"><?php
} elseif (isset($attr7_icon)) {
?><img src="<?php echo $image_dir.'icon_'.$attr7_icon.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr7_align ?>"><?php
} elseif (isset($attr7_url)) {
?><img src="<?php echo $attr7_url ?>" border="0" align="<?php echo $attr7_align ?>"><?php
} elseif (isset($attr7_fileext)) {
?><img src="<?php echo $image_dir.$attr7_fileext ?>" border="0" align="<?php echo $attr7_align ?>"><?php
} elseif (isset($attr7_file)) {
?><img src="<?php echo $image_dir.$attr7_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr7_align ?>"><?php } ?><?php unset($attr7) ?><?php unset($attr7_icon) ?><?php unset($attr7_align) ?><?php $attr7_debug_info = 'a:9:{s:4:"list";s:5:"users";s:4:"name";s:6:"userid";s:8:"onchange";s:8:"submit()";s:5:"title";s:0:"";s:5:"class";s:0:"";s:8:"addempty";s:4:"user";s:8:"multiple";s:5:"false";s:4:"size";s:1:"1";s:4:"lang";s:5:"false";}' ?><?php $attr7 = array('list'=>'users','name'=>'userid','onchange'=>'submit()','title'=>'','class'=>'','addempty'=>'user','multiple'=>false,'size'=>'1','lang'=>false) ?><?php $attr7_list='users' ?><?php $attr7_name='userid' ?><?php $attr7_onchange='submit()' ?><?php $attr7_title='' ?><?php $attr7_class='' ?><?php $attr7_addempty='user' ?><?php $attr7_multiple=false ?><?php $attr7_size='1' ?><?php $attr7_lang=false ?><?php
if ( $attr7_addempty!==FALSE  )
{
	if ($attr7_addempty===TRUE)
		$$attr7_list = array(''=>lang('LIST_ENTRY_EMPTY'))+$$attr7_list;
	else
		$$attr7_list = array(''=>'- '.lang($attr7_addempty).' -')+$$attr7_list;
}
?><select id="id_<?php echo $attr7_name ?>"  name="<?php echo $attr7_name; if ($attr7_multiple) echo '[]'; ?>" onchange="<?php echo $attr7_onchange ?>" title="<?php echo $attr7_title ?>" class="<?php echo $attr7_class ?>"<?php
if (count($$attr7_list)<=1) echo ' disabled="disabled"';
if	($attr7_multiple) echo ' multiple="multiple"';
if (in_array($attr7_name,$errors)) echo ' style="background-color:red; border:2px dashed red;"';
echo ' size="'.intval($attr7_size).'"';
?>><?php
		$attr7_tmp_list = $$attr7_list;
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
if (count($$attr7_list)==1) echo '<input type="hidden" name="'.$attr7_name.'" value="'.$box_key.'" />'
?><?php unset($attr7) ?><?php unset($attr7_list) ?><?php unset($attr7_name) ?><?php unset($attr7_onchange) ?><?php unset($attr7_title) ?><?php unset($attr7_class) ?><?php unset($attr7_addempty) ?><?php unset($attr7_multiple) ?><?php unset($attr7_size) ?><?php unset($attr7_lang) ?><?php $attr7_debug_info = 'a:4:{s:4:"type";s:2:"ok";s:5:"class";s:2:"ok";s:5:"value";s:2:"ok";s:4:"text";s:1:">";}' ?><?php $attr7 = array('type'=>'ok','class'=>'ok','value'=>'ok','text'=>'>') ?><?php $attr7_type='ok' ?><?php $attr7_class='ok' ?><?php $attr7_value='ok' ?><?php $attr7_text='>' ?><?php
	if ($attr7_type=='ok')
		$attr7_type  = 'submit';
	if (isset($attr7_src))
		$attr7_type  = 'image';
	else
		$attr7_src  = '';
?><input type="<?php echo $attr7_type ?>"<?php if(isset($attr7_src)) { ?> src="<?php echo $image_dir.'icon_'.$attr7_src.IMG_ICON_EXT ?>"<?php } ?> name="<?php echo $attr7_value ?>" class="<?php echo $attr7_class ?>" title="<?php echo lang($attr7_text.'_DESC') ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo lang($attr7_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($attr7_src) ?><?php unset($attr7) ?><?php unset($attr7_type) ?><?php unset($attr7_class) ?><?php unset($attr7_value) ?><?php unset($attr7_text) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></form>
<?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></td><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php } ?><?php unset($attr3) ?><?php $attr4_debug_info = 'a:1:{s:7:"present";s:6:"groups";}' ?><?php $attr4 = array('present'=>'groups') ?><?php $attr4_present='groups' ?><?php 
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
?><td <?php foreach( $attr5 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr5) ?><?php $attr6_debug_info = 'a:6:{s:6:"action";s:4:"main";s:9:"subaction";s:5:"group";s:4:"name";s:0:"";s:6:"target";s:8:"cms_main";s:6:"method";s:3:"get";s:7:"enctype";s:33:"application/x-www-form-urlencoded";}' ?><?php $attr6 = array('action'=>'main','subaction'=>'group','name'=>'','target'=>'cms_main','method'=>'get','enctype'=>'application/x-www-form-urlencoded') ?><?php $attr6_action='main' ?><?php $attr6_subaction='group' ?><?php $attr6_name='' ?><?php $attr6_target='cms_main' ?><?php $attr6_method='get' ?><?php $attr6_enctype='application/x-www-form-urlencoded' ?><?php
	if	(empty($attr6_action))
		$attr6_action = $actionName;
	if	(empty($attr6_subaction))
		$attr6_subaction = $targetSubActionName;
	if	(empty($attr6_id))
		$attr6_id = $this->getRequestId();
?><form name="<?php echo $attr6_name ?>"
      target="<?php echo $attr6_target ?>"
      action="<?php echo Html::url( $attr6_action,$attr6_subaction,$attr6_id ) ?>"
      method="<?php echo $attr6_method ?>"
      enctype="<?php echo $attr6_enctype ?>" style="margin:0px;padding:0px;">
<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo $attr6_action ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo $attr6_subaction ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo $attr6_id ?>" /><?php
		if	( $conf['interface']['url_sessionid'] )
			echo '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";
?><?php unset($attr6) ?><?php unset($attr6_action) ?><?php unset($attr6_subaction) ?><?php unset($attr6_name) ?><?php unset($attr6_target) ?><?php unset($attr6_method) ?><?php unset($attr6_enctype) ?><?php $attr7_debug_info = 'a:8:{s:5:"class";s:0:"";s:7:"default";s:12:"text:groupid";s:4:"type";s:6:"hidden";s:4:"name";s:5:"idvar";s:4:"size";s:2:"40";s:9:"maxlength";s:3:"256";s:8:"onchange";s:0:"";s:8:"readonly";s:5:"false";}' ?><?php $attr7 = array('class'=>'','default'=>'groupid','type'=>'hidden','name'=>'idvar','size'=>'40','maxlength'=>'256','onchange'=>'','readonly'=>false) ?><?php $attr7_class='' ?><?php $attr7_default='groupid' ?><?php $attr7_type='hidden' ?><?php $attr7_name='idvar' ?><?php $attr7_size='40' ?><?php $attr7_maxlength='256' ?><?php $attr7_onchange='' ?><?php $attr7_readonly=false ?><?php if(!isset($attr7_default)) $attr7_default='';
?><input<?php if ($attr7_readonly) echo ' disabled="true"' ?> id="id_<?php echo $attr7_name ?><?php if ($attr7_readonly) echo '_disabled' ?>" name="<?php echo $attr7_name ?><?php if ($attr7_readonly) echo '_disabled' ?>" type="<?php echo $attr7_type ?>" size="<?php echo $attr7_size ?>" maxlength="<?php echo $attr7_maxlength ?>" class="<?php echo $attr7_class ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" <?php if (in_array($attr7_name,$errors)) echo 'style="border-rightx:10px solid red; background-colorx:yellow; border:2px dashed red;"' ?> /><?php
if	($attr7_readonly) {
?><input type="hidden" id="id_<?php echo $attr7_name ?>" name="<?php echo $attr7_name ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" /><?php
 } ?><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_default) ?><?php unset($attr7_type) ?><?php unset($attr7_name) ?><?php unset($attr7_size) ?><?php unset($attr7_maxlength) ?><?php unset($attr7_onchange) ?><?php unset($attr7_readonly) ?><?php $attr7_debug_info = 'a:2:{s:4:"icon";s:5:"group";s:5:"align";s:4:"left";}' ?><?php $attr7 = array('icon'=>'group','align'=>'left') ?><?php $attr7_icon='group' ?><?php $attr7_align='left' ?><?php
if (isset($attr7_elementtype)) {
?><img src="<?php echo $image_dir.'icon_el_'.$attr7_elementtype.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr7_align ?>"><?php
} elseif (isset($attr7_type)) {
?><img src="<?php echo $image_dir.'icon_'.$attr7_type.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr7_align ?>"><?php
} elseif (isset($attr7_icon)) {
?><img src="<?php echo $image_dir.'icon_'.$attr7_icon.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr7_align ?>"><?php
} elseif (isset($attr7_url)) {
?><img src="<?php echo $attr7_url ?>" border="0" align="<?php echo $attr7_align ?>"><?php
} elseif (isset($attr7_fileext)) {
?><img src="<?php echo $image_dir.$attr7_fileext ?>" border="0" align="<?php echo $attr7_align ?>"><?php
} elseif (isset($attr7_file)) {
?><img src="<?php echo $image_dir.$attr7_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr7_align ?>"><?php } ?><?php unset($attr7) ?><?php unset($attr7_icon) ?><?php unset($attr7_align) ?><?php $attr7_debug_info = 'a:9:{s:4:"list";s:6:"groups";s:4:"name";s:7:"groupid";s:8:"onchange";s:8:"submit()";s:5:"title";s:0:"";s:5:"class";s:0:"";s:8:"addempty";s:5:"group";s:8:"multiple";s:5:"false";s:4:"size";s:1:"1";s:4:"lang";s:5:"false";}' ?><?php $attr7 = array('list'=>'groups','name'=>'groupid','onchange'=>'submit()','title'=>'','class'=>'','addempty'=>'group','multiple'=>false,'size'=>'1','lang'=>false) ?><?php $attr7_list='groups' ?><?php $attr7_name='groupid' ?><?php $attr7_onchange='submit()' ?><?php $attr7_title='' ?><?php $attr7_class='' ?><?php $attr7_addempty='group' ?><?php $attr7_multiple=false ?><?php $attr7_size='1' ?><?php $attr7_lang=false ?><?php
if ( $attr7_addempty!==FALSE  )
{
	if ($attr7_addempty===TRUE)
		$$attr7_list = array(''=>lang('LIST_ENTRY_EMPTY'))+$$attr7_list;
	else
		$$attr7_list = array(''=>'- '.lang($attr7_addempty).' -')+$$attr7_list;
}
?><select id="id_<?php echo $attr7_name ?>"  name="<?php echo $attr7_name; if ($attr7_multiple) echo '[]'; ?>" onchange="<?php echo $attr7_onchange ?>" title="<?php echo $attr7_title ?>" class="<?php echo $attr7_class ?>"<?php
if (count($$attr7_list)<=1) echo ' disabled="disabled"';
if	($attr7_multiple) echo ' multiple="multiple"';
if (in_array($attr7_name,$errors)) echo ' style="background-color:red; border:2px dashed red;"';
echo ' size="'.intval($attr7_size).'"';
?>><?php
		$attr7_tmp_list = $$attr7_list;
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
if (count($$attr7_list)==1) echo '<input type="hidden" name="'.$attr7_name.'" value="'.$box_key.'" />'
?><?php unset($attr7) ?><?php unset($attr7_list) ?><?php unset($attr7_name) ?><?php unset($attr7_onchange) ?><?php unset($attr7_title) ?><?php unset($attr7_class) ?><?php unset($attr7_addempty) ?><?php unset($attr7_multiple) ?><?php unset($attr7_size) ?><?php unset($attr7_lang) ?><?php $attr7_debug_info = 'a:4:{s:4:"type";s:2:"ok";s:5:"class";s:2:"ok";s:5:"value";s:2:"ok";s:4:"text";s:1:">";}' ?><?php $attr7 = array('type'=>'ok','class'=>'ok','value'=>'ok','text'=>'>') ?><?php $attr7_type='ok' ?><?php $attr7_class='ok' ?><?php $attr7_value='ok' ?><?php $attr7_text='>' ?><?php
	if ($attr7_type=='ok')
		$attr7_type  = 'submit';
	if (isset($attr7_src))
		$attr7_type  = 'image';
	else
		$attr7_src  = '';
?><input type="<?php echo $attr7_type ?>"<?php if(isset($attr7_src)) { ?> src="<?php echo $image_dir.'icon_'.$attr7_src.IMG_ICON_EXT ?>"<?php } ?> name="<?php echo $attr7_value ?>" class="<?php echo $attr7_class ?>" title="<?php echo lang($attr7_text.'_DESC') ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo lang($attr7_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($attr7_src) ?><?php unset($attr7) ?><?php unset($attr7_type) ?><?php unset($attr7_class) ?><?php unset($attr7_value) ?><?php unset($attr7_text) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></form>
<?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></td><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php } ?><?php unset($attr3) ?><?php $attr2_debug_info = 'a:0:{}' ?><?php $attr2 = array() ?></tr><?php unset($attr2) ?><?php $attr1_debug_info = 'a:0:{}' ?><?php $attr1 = array() ?></table><?php unset($attr1) ?><?php $attr0_debug_info = 'a:0:{}' ?><?php $attr0 = array() ?></body>
</html><?php unset($attr0) ?>