<?php $a2_name='';$a2_views='link,import,export,archive';$a2_back=false; ?><div class="header">
  <?php if ($a2_back) { ?>
  <a href="javascript:void(0);" onclick="javascript:refreshActualView(this);" class="back button">
    <img src="<?php  echo $image_dir ?>icon/window/back.gif" />
    <?php echo lang('BACK') ?>
  </a>
  <?php } ?><?php if(!empty($a2_views)) { ?>
  <img src="<?php  echo $image_dir ?>icon/window/down.gif" />
  <div class="headermenu">
    <?php foreach( explode(',',$a2_views) as $a2_tmp_view ) { ?>
	<a class="entry" href="javascript:void(0);" onclick="javascript:startView(this,'<?php echo $a2_tmp_view ?>');">
	  <img src="<?php  echo $image_dir ?>icon/<?php echo $a2_tmp_view ?>.png" /><?php echo lang('MENU_'.$a2_tmp_view) ?>
	</a>
    <?php } ?>
  </div>
<?php } ?>
</div><?php unset($a2_name,$a2_views,$a2_back) ?><?php $a2_name='';$a2_target='_self';$a2_method='post';$a2_enctype='application/x-www-form-urlencoded';$a2_type=''; ?><?php
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
	switch( $a2_type )
	{
		case 'upload':
			$a2_tmp_submitFunction = '';
			break;
		default:
			$a2_tmp_submitFunction = 'formSubmit( $(this) ); return false;';
	}
?><form name="<?php echo $a2_name ?>"
      target="<?php echo $a2_target ?>"
      action="<?php echo Html::url( $a2_action,$a2_subaction,$a2_id ) ?>"
      method="<?php echo $a2_method ?>"
      enctype="<?php echo $a2_enctype ?>" style="margin:0px;padding:0px;"
      class="<?php echo $a2_action ?>"
      onSubmit="<?php echo $a2_tmp_submitFunction ?>"><input type="submit" class="invisible" />
<?php if ($this->isEditable() && !$this->isEditMode()) { ?>
<input type="hidden" name="mode" value="edit" />
<?php } ?>
<input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo $this->actionName ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo $this->subActionName ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo $this->getRequestId() ?>" /><?php
		if	( $conf['interface']['url_sessionid'] )
			echo '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";
?><?php unset($a2_name,$a2_target,$a2_method,$a2_enctype,$a2_type) ?><?php $a3_class='text';$a3_default='';$a3_type='hidden';$a3_name='elementid';$a3_size='';$a3_maxlength='256';$a3_onchange='';$a3_readonly=false; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a3_readonly=true;
	  if ($a3_readonly && empty($$a3_name)) $$a3_name = '- '.lang('EMPTY').' -';
      if(!isset($a3_default)) $a3_default='';
      $tmp_value = Text::encodeHtml(isset($$a3_name)?$$a3_name:$a3_default);
?><?php if (!$a3_readonly || $a3_type=='hidden') {
?><input<?php if ($a3_readonly) echo ' disabled="true"' ?> id="id_<?php echo $a3_name ?><?php if ($a3_readonly) echo '_disabled' ?>" name="<?php echo $a3_name ?><?php if ($a3_readonly) echo '_disabled' ?>" type="<?php echo $a3_type ?>" maxlength="<?php echo $a3_maxlength ?>" class="<?php echo str_replace(',',' ',$a3_class) ?>" value="<?php echo $tmp_value ?>" <?php if (in_array($a3_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php
if	($a3_readonly) {
?><input type="hidden" id="id_<?php echo $a3_name ?>" name="<?php echo $a3_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subactionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a3_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a3_class,$a3_default,$a3_type,$a3_name,$a3_size,$a3_maxlength,$a3_onchange,$a3_readonly) ?><?php $a3_class='text';$a3_default='';$a3_type='hidden';$a3_name='value_time';$a3_size='';$a3_maxlength='256';$a3_onchange='';$a3_readonly=false; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a3_readonly=true;
	  if ($a3_readonly && empty($$a3_name)) $$a3_name = '- '.lang('EMPTY').' -';
      if(!isset($a3_default)) $a3_default='';
      $tmp_value = Text::encodeHtml(isset($$a3_name)?$$a3_name:$a3_default);
?><?php if (!$a3_readonly || $a3_type=='hidden') {
?><input<?php if ($a3_readonly) echo ' disabled="true"' ?> id="id_<?php echo $a3_name ?><?php if ($a3_readonly) echo '_disabled' ?>" name="<?php echo $a3_name ?><?php if ($a3_readonly) echo '_disabled' ?>" type="<?php echo $a3_type ?>" maxlength="<?php echo $a3_maxlength ?>" class="<?php echo str_replace(',',' ',$a3_class) ?>" value="<?php echo $tmp_value ?>" <?php if (in_array($a3_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php
if	($a3_readonly) {
?><input type="hidden" id="id_<?php echo $a3_name ?>" name="<?php echo $a3_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subactionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a3_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a3_class,$a3_default,$a3_type,$a3_name,$a3_size,$a3_maxlength,$a3_onchange,$a3_readonly) ?><?php $a3_name='element';$a3_width='93%';$a3_rowclasses='odd,even';$a3_columnclasses='1,2,3'; ?><?php if (false) { ?>
<div class="window">
<div class="title">
		<?php $icon=$actionName; ?>
		<img src="<?php echo $image_dir.'icon_'.$icon.IMG_ICON_EXT ?>" align="left" />
		<?php if ($this->isEditable()) { ?>
  <?php if ($this->isEditMode()) { 
  ?><a href="<?php echo Html::url($actionName,$subActionName,$this->getRequestId()                       ) ?>" accesskey="1" title="<?php echo langHtml('MODE_EDIT_DESC') ?>" class="path" style="text-align:right;font-weight:bold;font-weight:bold;"><img src="<?php echo $image_dir ?>mode-edit.png" style="vertical-align:top; " border="0" /></a> <?php }
   elseif (readonly()) {
  ?><img src="<?php echo $image_dir ?>readonly.png" style="vertical-align:top; " border="0" /> <?php } else {
  ?><a href="<?php echo Html::url($actionName,$subActionName,$this->getRequestId(),array('mode'=>'edit') ) ?>" accesskey="1" title="<?php echo langHtml('MODE_SHOW_DESC') ?>" class="path" style="text-align:right;font-weight:bold;font-weight:bold;"><img src="<?php echo $image_dir ?>readonly.png" style="vertical-align:top; " border="0" /></a> <?php }
  ?><?php } ?>
		<span class="path"><?php echo langHtml($actionName) ?></span>&nbsp;<strong>&rarr;</strong>&nbsp;
		<?php
		if	( !isset($path) || !is_array($path) )
			$path = array();
		foreach( $path as $pathElement)
		{
			extract($pathElement); ?>
			<a javascript:void(0);" onclick="javascript:loadViewByName('<?php echo $view ?>','<?php echo $url ?>'); return false; " title="<?php echo $title ?>" class="path"><?php echo (!empty($key)?langHtml($key):$name) ?></a>
			&nbsp;&rarr;&nbsp;
		<?php } ?>
		<span class="title"><?php echo langHtml(@$windowTitle) ?></span>
		<?php
		if	( isset($notice_status))
		{
			?><img src="<?php echo $image_dir.'notice_'.$notice_status.IMG_ICON_EXT ?>" align="right" /><?php
		}
		?>
		<?php ?>		
    <?php if (isset($windowIcons)) foreach( $windowIcons as $icon )
          {
          	?><a href="<?php echo $icon['url'] ?>" title="<?php echo 'ICON_'.langHtml($menu['type'].'_DESC') ?>"><image border="0" src="<?php echo $image_dir.$icon['type'].IMG_ICON_EXT ?>"></a>&nbsp;<?php
          }
     ?>
</div>
<ul class="menu">
<?php
	if	( !isset($windowMenu) || !is_array($windowMenu) ) $windowMenu = array();
    foreach( $windowMenu as $menu )
          {
          	$tmp_text = langHtml($menu['text']);
          	$tmp_key  = strtoupper(langHtml($menu['key' ]));
			$tmp_pos = strpos(strtolower($tmp_text),strtolower($tmp_key));
			if	( $tmp_pos !== false )
				$tmp_text = substr($tmp_text,0,max($tmp_pos,0)).'<span class="accesskey">'. substr($tmp_text,$tmp_pos,1).'</span>'.substr($tmp_text,$tmp_pos+1);
			$liClass  = (isset($menu['url'])?'':'no').'action'.($this->subActionName==$menu['subaction']?' active':'');
			$icon_url = $image_dir.'icon/'.$menu['subaction'].'.png';
			?><li class="<?php echo $liClass?>"><?php
          	if	( isset($menu['url']) )
          	{
          		$link_url = Html::url($actionName,$menu['subaction'],$this->getRequestId() );
          		?><a href="javascript:void(0);" onclick="javascript:loadSubaction(this,'<?php echo $actionName ?>','<?php echo $menu['subaction'] ?>','<?php echo $this->getRequestId() ?>'); return false; " accesskey="<?php echo $tmp_key ?>" title="<?php echo langHtml($menu['text'].'_DESC') ?>"><img src="<?php echo $icon_url ?>" /><?php echo $tmp_text ?></a><?php
          	}
          	else
          	{
          		?><span><img src="<?php echo $icon_url ?>" /><?php echo $tmp_text ?></span><?php
          	}
          }
          	?></li><?php
          if ( /* Deaktiviert */ false && @$conf['help']['enabled'] )
          	{
             ?><a class="help" href="<?php echo $conf['help']['url'].$actionName.'/'.$subActionName.@$conf['help']['suffix'] ?> " target="_new" title="<?php echo langHtml('MENU_HELP_DESC') ?>"><img src="<?php echo $image_dir.'icon/help.png' ?>" /><?php echo @$conf['help']['only_question_mark']?'?':langHtml('MENU_HELP') ?></a><?php
          	}
          	?><?php
		?>
</ul>
<?php 		global $image_dir; 
      if (isset($notices) && count($notices)>0 )
      { ?>
    	<dl class="notice">
  <?php foreach( $notices as $notice_idx=>$notice ) { ?>
  <?php if ($notice['name']!='') { ?>
    <dt><img src="<?php echo $image_dir.'icon_'.$notice['type'].IMG_ICON_EXT ?>" align="left" /><?php echo $notice['name'] ?></dt>
<?php } ?>
  <dd class="<?php echo $notice['status'] ?>">
    <td style="padding:10px;" width="30px"><img src="<?php echo $image_dir.'notice_'.$notice['status'].IMG_ICON_EXT ?>" style="padding:10px" /></td>
    <td style="padding:10px;padding-right:10px;padding-bottom:10px;"><?php if ($notice['status']=='error') { ?><strong><?php } ?><?php echo langHtml($notice['key'],$notice['vars']) ?><?php if ($notice['status']=='error') { ?></strong><?php } ?>
    <?php if (!empty($notice['log'])) { ?><pre><?php echo htmlentities(implode("\n",$notice['log'])) ?></pre><?php } ?>
    </td>
  </dd>
  <?php } ?>
    </dl>
<?php } ?>
<div class="content"><div class="filler">
<?php } ?><?php unset($a3_name,$a3_width,$a3_rowclasses,$a3_columnclasses) ?><?php $a4_class='help';$a4_var='desc';$a4_escape=true;$a4_cut='both'; ?><?php
		$a4_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a4_class ?>" title="<?php echo $a4_title ?>"><?php
		$langF = $a4_escape?'langHtml':'lang';
		$tmp_text = isset($$a4_var)?$$a4_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a4_class,$a4_var,$a4_escape,$a4_cut) ?><?php $a4_equals='date';$a4_value=$type; ?><?php 
	$a4_tmp_exec = $a4_equals == $a4_value;
	$a4_tmp_last_exec = $a4_tmp_exec;
	if	( $a4_tmp_exec )
	{
?>
<?php unset($a4_equals,$a4_value) ?><?php $a5_true=$mode=="edit"; ?><?php 
	if	(gettype($a5_true) === '' && gettype($a5_true) === '1')
		$a5_tmp_exec = $$a5_true == true;
	else
		$a5_tmp_exec = $a5_true == true;
	$a5_tmp_last_exec = $a5_tmp_exec;
	if	( $a5_tmp_exec )
	{
?>
<?php unset($a5_true) ?><?php $a6_title=lang('calendar'); ?><fieldset><?php if(isset($a6_title)) { ?><legend><?php if(isset($a6_icon)) { ?><img src="<?php echo $image_dir.'icon_'.$a6_icon.IMG_ICON_EXT ?>" align="left" border="0" /><?php } ?>&nbsp;&nbsp;<?php echo encodeHtml($a6_title) ?>&nbsp;&nbsp;</legend><?php } ?><?php unset($a6_title) ?><div><?php $a8_class='calendar';$a8_width='85%';$a8_space='0px';$a8_padding='0px'; ?><?php
	$last_column_idx = @$column_idx;
	$column_idx = 0;
	$coloumn_widths = array();
	$row_classes    = array();
	$column_classes = array();
?><table class="calendar" cellspacing="0px" width="85%" cellpadding="0px">
<?php unset($a8_class,$a8_width,$a8_space,$a8_padding) ?><?php
	$column_idx = 0;
?>
<tr
>
<?php $a10_class='help';$a10_colspan='8';$a10_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="help"
 colspan="8"
><?php unset($a10_class,$a10_colspan,$a10_header) ?><?php $a11_true=$mode=="edit"; ?><?php 
	if	(gettype($a11_true) === '' && gettype($a11_true) === '1')
		$a11_tmp_exec = $$a11_true == true;
	else
		$a11_tmp_exec = $a11_true == true;
	$a11_tmp_last_exec = $a11_tmp_exec;
	if	( $a11_tmp_exec )
	{
?>
<?php unset($a11_true) ?><?php $a12_title='';$a12_type='';$a12_url=$lastmonthurl;$a12_class='';$a12_frame='_self'; ?><?php
	$params = array();
	$tmp_url = '';
	$a12_target = $view;
	switch( $a12_type )
	{
		case 'post':
			$json = new JSON();
			$tmp_data = $json->encode( array('action'=>!empty($a12_action)?$a12_action:$this->actionName,'subaction'=>!empty($a12_subaction)?$a12_subaction:$this->subActionName,'id'=>!empty($a12_id)?$a12_id:$this->getRequestId())
		                          +array(REQ_PARAM_TOKEN=>token())
		                          +$params );
			$tmp_function_call = "submitLink(this,'".str_replace("\n",'',str_replace('"','&quot;',$tmp_data))."');";
			break;
		case 'view':
			$tmp_function_call = "startView(this,'".(!empty($a12_subaction)?$a12_subaction:$this->subActionName)."');";
			break;
		case 'url':
			$tmp_function_call = "submitUrl(this,'".($a12_url)."');";
			break;
		case 'external':
			$tmp_function_call = "location.href='".$a12_url."';";
			break;
		case 'popup':
			$tmp_function_call = "window.open('".$a12_url."', 'Popup', 'location=no,menubar=no,scrollbars=yes,toolbar=no,resizable=yes');";
			break;
		default:
			$tmp_function_call = "alert('TODO');";
	}
?><a target="<?php echo $a12_frame ?>"<?php if (isset($a12_name)) { ?> name="<?php echo $a12_name ?>"<?php }else{ ?> href="javascript:void(0);" onclick="<?php echo $tmp_function_call ?>" <?php } ?> class="<?php echo $a12_class ?>"<?php if (isset($a12_accesskey)) echo ' accesskey="'.$a12_accesskey.'"' ?>  title="<?php echo encodeHtml($a12_title) ?>"><?php unset($a12_title,$a12_type,$a12_url,$a12_class,$a12_frame) ?><?php $a13_file='left';$a13_align='middle'; ?><?php
	$a13_tmp_image_file = $image_dir.$a13_file.IMG_ICON_EXT;
	$a13_tmp_title = basename($a13_tmp_image_file);
?><img alt="<?php echo $a13_tmp_title; if (isset($a13_size)) { echo ' ('; list($a13_tmp_width,$a13_tmp_height)=explode('x',$a13_size);echo $a13_tmp_width.'x'.$a13_tmp_height; echo')';} ?>" src="<?php echo $a13_tmp_image_file ?>" border="0"<?php if(isset($a13_align)) echo ' align="'.$a13_align.'"' ?><?php if (isset($a13_size)) { list($a13_tmp_width,$a13_tmp_height)=explode('x',$a13_size);echo ' width="'.$a13_tmp_width.'" height="'.$a13_tmp_height.'"';} ?> /><?php unset($a13_file,$a13_align) ?></a><?php $a12_class='text';$a12_raw='_';$a12_escape=true;$a12_cut='both'; ?><?php
		$a12_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a12_class ?>" title="<?php echo $a12_title ?>"><?php
		$langF = $a12_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a12_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a12_class,$a12_raw,$a12_escape,$a12_cut) ?><?php } ?><?php $a11_class='text';$a11_var='monthname';$a11_escape=true;$a11_type='strong';$a11_cut='both'; ?><?php
		$a11_title = '';
		$tmp_tag = 'strong';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = isset($$a11_var)?$$a11_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_var,$a11_escape,$a11_type,$a11_cut) ?><?php $a11_true=$mode=="edit"; ?><?php 
	if	(gettype($a11_true) === '' && gettype($a11_true) === '1')
		$a11_tmp_exec = $$a11_true == true;
	else
		$a11_tmp_exec = $a11_true == true;
	$a11_tmp_last_exec = $a11_tmp_exec;
	if	( $a11_tmp_exec )
	{
?>
<?php unset($a11_true) ?><?php $a12_class='text';$a12_raw='_';$a12_escape=true;$a12_cut='both'; ?><?php
		$a12_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a12_class ?>" title="<?php echo $a12_title ?>"><?php
		$langF = $a12_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a12_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a12_class,$a12_raw,$a12_escape,$a12_cut) ?><?php $a12_title='';$a12_type='';$a12_url=$nextmonthurl;$a12_class='';$a12_frame='_self'; ?><?php
	$params = array();
	$tmp_url = '';
	$a12_target = $view;
	switch( $a12_type )
	{
		case 'post':
			$json = new JSON();
			$tmp_data = $json->encode( array('action'=>!empty($a12_action)?$a12_action:$this->actionName,'subaction'=>!empty($a12_subaction)?$a12_subaction:$this->subActionName,'id'=>!empty($a12_id)?$a12_id:$this->getRequestId())
		                          +array(REQ_PARAM_TOKEN=>token())
		                          +$params );
			$tmp_function_call = "submitLink(this,'".str_replace("\n",'',str_replace('"','&quot;',$tmp_data))."');";
			break;
		case 'view':
			$tmp_function_call = "startView(this,'".(!empty($a12_subaction)?$a12_subaction:$this->subActionName)."');";
			break;
		case 'url':
			$tmp_function_call = "submitUrl(this,'".($a12_url)."');";
			break;
		case 'external':
			$tmp_function_call = "location.href='".$a12_url."';";
			break;
		case 'popup':
			$tmp_function_call = "window.open('".$a12_url."', 'Popup', 'location=no,menubar=no,scrollbars=yes,toolbar=no,resizable=yes');";
			break;
		default:
			$tmp_function_call = "alert('TODO');";
	}
?><a target="<?php echo $a12_frame ?>"<?php if (isset($a12_name)) { ?> name="<?php echo $a12_name ?>"<?php }else{ ?> href="javascript:void(0);" onclick="<?php echo $tmp_function_call ?>" <?php } ?> class="<?php echo $a12_class ?>"<?php if (isset($a12_accesskey)) echo ' accesskey="'.$a12_accesskey.'"' ?>  title="<?php echo encodeHtml($a12_title) ?>"><?php unset($a12_title,$a12_type,$a12_url,$a12_class,$a12_frame) ?><?php $a13_file='right';$a13_align='middle'; ?><?php
	$a13_tmp_image_file = $image_dir.$a13_file.IMG_ICON_EXT;
	$a13_tmp_title = basename($a13_tmp_image_file);
?><img alt="<?php echo $a13_tmp_title; if (isset($a13_size)) { echo ' ('; list($a13_tmp_width,$a13_tmp_height)=explode('x',$a13_size);echo $a13_tmp_width.'x'.$a13_tmp_height; echo')';} ?>" src="<?php echo $a13_tmp_image_file ?>" border="0"<?php if(isset($a13_align)) echo ' align="'.$a13_align.'"' ?><?php if (isset($a13_size)) { list($a13_tmp_width,$a13_tmp_height)=explode('x',$a13_size);echo ' width="'.$a13_tmp_width.'" height="'.$a13_tmp_height.'"';} ?> /><?php unset($a13_file,$a13_align) ?></a><?php } ?><?php $a11_class='text';$a11_raw='_____';$a11_escape=true;$a11_cut='both'; ?><?php
		$a11_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a11_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_raw,$a11_escape,$a11_cut) ?><?php $a11_true=$mode=="edit"; ?><?php 
	if	(gettype($a11_true) === '' && gettype($a11_true) === '1')
		$a11_tmp_exec = $$a11_true == true;
	else
		$a11_tmp_exec = $a11_true == true;
	$a11_tmp_last_exec = $a11_tmp_exec;
	if	( $a11_tmp_exec )
	{
?>
<?php unset($a11_true) ?><?php $a12_title='';$a12_type='';$a12_url=$lastyearurl;$a12_class='';$a12_frame='_self'; ?><?php
	$params = array();
	$tmp_url = '';
	$a12_target = $view;
	switch( $a12_type )
	{
		case 'post':
			$json = new JSON();
			$tmp_data = $json->encode( array('action'=>!empty($a12_action)?$a12_action:$this->actionName,'subaction'=>!empty($a12_subaction)?$a12_subaction:$this->subActionName,'id'=>!empty($a12_id)?$a12_id:$this->getRequestId())
		                          +array(REQ_PARAM_TOKEN=>token())
		                          +$params );
			$tmp_function_call = "submitLink(this,'".str_replace("\n",'',str_replace('"','&quot;',$tmp_data))."');";
			break;
		case 'view':
			$tmp_function_call = "startView(this,'".(!empty($a12_subaction)?$a12_subaction:$this->subActionName)."');";
			break;
		case 'url':
			$tmp_function_call = "submitUrl(this,'".($a12_url)."');";
			break;
		case 'external':
			$tmp_function_call = "location.href='".$a12_url."';";
			break;
		case 'popup':
			$tmp_function_call = "window.open('".$a12_url."', 'Popup', 'location=no,menubar=no,scrollbars=yes,toolbar=no,resizable=yes');";
			break;
		default:
			$tmp_function_call = "alert('TODO');";
	}
?><a target="<?php echo $a12_frame ?>"<?php if (isset($a12_name)) { ?> name="<?php echo $a12_name ?>"<?php }else{ ?> href="javascript:void(0);" onclick="<?php echo $tmp_function_call ?>" <?php } ?> class="<?php echo $a12_class ?>"<?php if (isset($a12_accesskey)) echo ' accesskey="'.$a12_accesskey.'"' ?>  title="<?php echo encodeHtml($a12_title) ?>"><?php unset($a12_title,$a12_type,$a12_url,$a12_class,$a12_frame) ?><?php $a13_file='left';$a13_align='middle'; ?><?php
	$a13_tmp_image_file = $image_dir.$a13_file.IMG_ICON_EXT;
	$a13_tmp_title = basename($a13_tmp_image_file);
?><img alt="<?php echo $a13_tmp_title; if (isset($a13_size)) { echo ' ('; list($a13_tmp_width,$a13_tmp_height)=explode('x',$a13_size);echo $a13_tmp_width.'x'.$a13_tmp_height; echo')';} ?>" src="<?php echo $a13_tmp_image_file ?>" border="0"<?php if(isset($a13_align)) echo ' align="'.$a13_align.'"' ?><?php if (isset($a13_size)) { list($a13_tmp_width,$a13_tmp_height)=explode('x',$a13_size);echo ' width="'.$a13_tmp_width.'" height="'.$a13_tmp_height.'"';} ?> /><?php unset($a13_file,$a13_align) ?></a><?php $a12_class='text';$a12_raw='_';$a12_escape=true;$a12_cut='both'; ?><?php
		$a12_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a12_class ?>" title="<?php echo $a12_title ?>"><?php
		$langF = $a12_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a12_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a12_class,$a12_raw,$a12_escape,$a12_cut) ?><?php } ?><?php $a11_class='text';$a11_var='yearname';$a11_escape=true;$a11_type='strong';$a11_cut='both'; ?><?php
		$a11_title = '';
		$tmp_tag = 'strong';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = isset($$a11_var)?$$a11_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_var,$a11_escape,$a11_type,$a11_cut) ?><?php $a11_true=$mode=="edit"; ?><?php 
	if	(gettype($a11_true) === '' && gettype($a11_true) === '1')
		$a11_tmp_exec = $$a11_true == true;
	else
		$a11_tmp_exec = $a11_true == true;
	$a11_tmp_last_exec = $a11_tmp_exec;
	if	( $a11_tmp_exec )
	{
?>
<?php unset($a11_true) ?><?php $a12_class='text';$a12_raw='_';$a12_escape=true;$a12_cut='both'; ?><?php
		$a12_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a12_class ?>" title="<?php echo $a12_title ?>"><?php
		$langF = $a12_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a12_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a12_class,$a12_raw,$a12_escape,$a12_cut) ?><?php $a12_title='';$a12_type='';$a12_url=$nextyearurl;$a12_class='';$a12_frame='_self'; ?><?php
	$params = array();
	$tmp_url = '';
	$a12_target = $view;
	switch( $a12_type )
	{
		case 'post':
			$json = new JSON();
			$tmp_data = $json->encode( array('action'=>!empty($a12_action)?$a12_action:$this->actionName,'subaction'=>!empty($a12_subaction)?$a12_subaction:$this->subActionName,'id'=>!empty($a12_id)?$a12_id:$this->getRequestId())
		                          +array(REQ_PARAM_TOKEN=>token())
		                          +$params );
			$tmp_function_call = "submitLink(this,'".str_replace("\n",'',str_replace('"','&quot;',$tmp_data))."');";
			break;
		case 'view':
			$tmp_function_call = "startView(this,'".(!empty($a12_subaction)?$a12_subaction:$this->subActionName)."');";
			break;
		case 'url':
			$tmp_function_call = "submitUrl(this,'".($a12_url)."');";
			break;
		case 'external':
			$tmp_function_call = "location.href='".$a12_url."';";
			break;
		case 'popup':
			$tmp_function_call = "window.open('".$a12_url."', 'Popup', 'location=no,menubar=no,scrollbars=yes,toolbar=no,resizable=yes');";
			break;
		default:
			$tmp_function_call = "alert('TODO');";
	}
?><a target="<?php echo $a12_frame ?>"<?php if (isset($a12_name)) { ?> name="<?php echo $a12_name ?>"<?php }else{ ?> href="javascript:void(0);" onclick="<?php echo $tmp_function_call ?>" <?php } ?> class="<?php echo $a12_class ?>"<?php if (isset($a12_accesskey)) echo ' accesskey="'.$a12_accesskey.'"' ?>  title="<?php echo encodeHtml($a12_title) ?>"><?php unset($a12_title,$a12_type,$a12_url,$a12_class,$a12_frame) ?><?php $a13_file='right';$a13_align='middle'; ?><?php
	$a13_tmp_image_file = $image_dir.$a13_file.IMG_ICON_EXT;
	$a13_tmp_title = basename($a13_tmp_image_file);
?><img alt="<?php echo $a13_tmp_title; if (isset($a13_size)) { echo ' ('; list($a13_tmp_width,$a13_tmp_height)=explode('x',$a13_size);echo $a13_tmp_width.'x'.$a13_tmp_height; echo')';} ?>" src="<?php echo $a13_tmp_image_file ?>" border="0"<?php if(isset($a13_align)) echo ' align="'.$a13_align.'"' ?><?php if (isset($a13_size)) { list($a13_tmp_width,$a13_tmp_height)=explode('x',$a13_size);echo ' width="'.$a13_tmp_width.'" height="'.$a13_tmp_height.'"';} ?> /><?php unset($a13_file,$a13_align) ?></a><?php } ?></td></tr><?php
	$column_idx = 0;
?>
<tr
>
<?php $a10_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a10_header) ?><?php $a11_class='text';$a11_key='week';$a11_escape=true;$a11_cut='both'; ?><?php
		$a11_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = $langF($a11_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_key,$a11_escape,$a11_cut) ?></td><?php $a10_list='weekdays';$a10_extract=false;$a10_key='list_key';$a10_value='weekday'; ?><?php
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
?><?php unset($a10_list,$a10_extract,$a10_key,$a10_value) ?><?php $a11_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a11_header) ?><?php $a12_class='text';$a12_var='weekday';$a12_escape=true;$a12_cut='both'; ?><?php
		$a12_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a12_class ?>" title="<?php echo $a12_title ?>"><?php
		$langF = $a12_escape?'langHtml':'lang';
		$tmp_text = isset($$a12_var)?$$a12_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a12_class,$a12_var,$a12_escape,$a12_cut) ?></td><?php } ?></tr><?php $a9_list='weeklist';$a9_extract=false;$a9_key='weeknr';$a9_value='week'; ?><?php
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
?><?php unset($a9_list,$a9_extract,$a9_key,$a9_value) ?><?php
	$column_idx = 0;
?>
<tr
>
<?php $a11_width='12%';$a11_header=false; ?><?php $column_idx++; ?><td
 width="12%"
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a11_width,$a11_header) ?><?php $a12_class='text';$a12_var='weeknr';$a12_escape=true;$a12_cut='both'; ?><?php
		$a12_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a12_class ?>" title="<?php echo $a12_title ?>"><?php
		$langF = $a12_escape?'langHtml':'lang';
		$tmp_text = isset($$a12_var)?$$a12_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a12_class,$a12_var,$a12_escape,$a12_cut) ?></td><?php $a11_list='week';$a11_extract=true;$a11_key='list_key';$a11_value='list_value'; ?><?php
	$a11_list_tmp_key   = $a11_key;
	$a11_list_tmp_value = $a11_value;
	$a11_list_extract   = $a11_extract;
	unset($a11_key);
	unset($a11_value);
	if	( !isset($$a11_list) || !is_array($$a11_list) )
		$$a11_list = array();
	foreach( $$a11_list as $$a11_list_tmp_key => $$a11_list_tmp_value )
	{
		if	( $a11_list_extract )
		{
			if	( !is_array($$a11_list_tmp_value) )
			{
				print_r($$a11_list_tmp_value);
				die( 'not an array at key: '.$$a11_list_tmp_key );
			}
			extract($$a11_list_tmp_value);
		}
?><?php unset($a11_list,$a11_extract,$a11_key,$a11_value) ?><?php $a12_width='12%';$a12_header=false; ?><?php $column_idx++; ?><td
 width="12%"
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a12_width,$a12_header) ?><?php $a13_empty='url'; ?><?php 
	if	( !isset($$a13_empty) )
		$a13_tmp_exec = empty($a13_empty);
	elseif	( is_array($$a13_empty) )
		$a13_tmp_exec = (count($$a13_empty)==0);
	elseif	( is_bool($$a13_empty) )
		$a13_tmp_exec = true;
	else
		$a13_tmp_exec = empty( $$a13_empty );
	$a13_tmp_last_exec = $a13_tmp_exec;
	if	( $a13_tmp_exec )
	{
?>
<?php unset($a13_empty) ?><?php $a14_class='text';$a14_raw='__';$a14_escape=true;$a14_cut='both'; ?><?php
		$a14_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a14_class ?>" title="<?php echo $a14_title ?>"><?php
		$langF = $a14_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a14_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a14_class,$a14_raw,$a14_escape,$a14_cut) ?><?php $a14_class='text';$a14_var='nr';$a14_escape=true;$a14_type='strong';$a14_cut='both'; ?><?php
		$a14_title = '';
		$tmp_tag = 'strong';
?><<?php echo $tmp_tag ?> class="<?php echo $a14_class ?>" title="<?php echo $a14_title ?>"><?php
		$langF = $a14_escape?'langHtml':'lang';
		$tmp_text = isset($$a14_var)?$$a14_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a14_class,$a14_var,$a14_escape,$a14_type,$a14_cut) ?><?php $a14_class='text';$a14_raw='__';$a14_escape=true;$a14_cut='both'; ?><?php
		$a14_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a14_class ?>" title="<?php echo $a14_title ?>"><?php
		$langF = $a14_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a14_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a14_class,$a14_raw,$a14_escape,$a14_cut) ?><?php } ?><?php $a13_not=true;$a13_empty='url'; ?><?php 
	if	( !isset($$a13_empty) )
		$a13_tmp_exec = empty($a13_empty);
	elseif	( is_array($$a13_empty) )
		$a13_tmp_exec = (count($$a13_empty)==0);
	elseif	( is_bool($$a13_empty) )
		$a13_tmp_exec = true;
	else
		$a13_tmp_exec = empty( $$a13_empty );
	$a13_tmp_exec = !$a13_tmp_exec;
	$a13_tmp_last_exec = $a13_tmp_exec;
	if	( $a13_tmp_exec )
	{
?>
<?php unset($a13_not,$a13_empty) ?><?php $a14_title='';$a14_type='';$a14_url=$url;$a14_class='';$a14_frame='_self'; ?><?php
	$params = array();
	$tmp_url = '';
	$a14_target = $view;
	switch( $a14_type )
	{
		case 'post':
			$json = new JSON();
			$tmp_data = $json->encode( array('action'=>!empty($a14_action)?$a14_action:$this->actionName,'subaction'=>!empty($a14_subaction)?$a14_subaction:$this->subActionName,'id'=>!empty($a14_id)?$a14_id:$this->getRequestId())
		                          +array(REQ_PARAM_TOKEN=>token())
		                          +$params );
			$tmp_function_call = "submitLink(this,'".str_replace("\n",'',str_replace('"','&quot;',$tmp_data))."');";
			break;
		case 'view':
			$tmp_function_call = "startView(this,'".(!empty($a14_subaction)?$a14_subaction:$this->subActionName)."');";
			break;
		case 'url':
			$tmp_function_call = "submitUrl(this,'".($a14_url)."');";
			break;
		case 'external':
			$tmp_function_call = "location.href='".$a14_url."';";
			break;
		case 'popup':
			$tmp_function_call = "window.open('".$a14_url."', 'Popup', 'location=no,menubar=no,scrollbars=yes,toolbar=no,resizable=yes');";
			break;
		default:
			$tmp_function_call = "alert('TODO');";
	}
?><a target="<?php echo $a14_frame ?>"<?php if (isset($a14_name)) { ?> name="<?php echo $a14_name ?>"<?php }else{ ?> href="javascript:void(0);" onclick="<?php echo $tmp_function_call ?>" <?php } ?> class="<?php echo $a14_class ?>"<?php if (isset($a14_accesskey)) echo ' accesskey="'.$a14_accesskey.'"' ?>  title="<?php echo encodeHtml($a14_title) ?>"><?php unset($a14_title,$a14_type,$a14_url,$a14_class,$a14_frame) ?><?php $a15_class='text';$a15_raw='__';$a15_escape=true;$a15_cut='both'; ?><?php
		$a15_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a15_class ?>" title="<?php echo $a15_title ?>"><?php
		$langF = $a15_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a15_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a15_class,$a15_raw,$a15_escape,$a15_cut) ?><?php $a15_class='text';$a15_var='nr';$a15_escape=true;$a15_cut='both'; ?><?php
		$a15_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a15_class ?>" title="<?php echo $a15_title ?>"><?php
		$langF = $a15_escape?'langHtml':'lang';
		$tmp_text = isset($$a15_var)?$$a15_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a15_class,$a15_var,$a15_escape,$a15_cut) ?><?php $a15_class='text';$a15_raw='__';$a15_escape=true;$a15_cut='both'; ?><?php
		$a15_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a15_class ?>" title="<?php echo $a15_title ?>"><?php
		$langF = $a15_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a15_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a15_class,$a15_raw,$a15_escape,$a15_cut) ?></a><?php } ?><?php $a13_true=$today; ?><?php 
	if	(gettype($a13_true) === '' && gettype($a13_true) === '1')
		$a13_tmp_exec = $$a13_true == true;
	else
		$a13_tmp_exec = $a13_true == true;
	$a13_tmp_last_exec = $a13_tmp_exec;
	if	( $a13_tmp_exec )
	{
?>
<?php unset($a13_true) ?><?php $a14_class='text';$a14_raw='*';$a14_escape=true;$a14_cut='both'; ?><?php
		$a14_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a14_class ?>" title="<?php echo $a14_title ?>"><?php
		$langF = $a14_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a14_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a14_class,$a14_raw,$a14_escape,$a14_cut) ?><?php } ?></td><?php } ?></tr><?php } ?><?php
	$column_idx = $last_column_idx;
?>
</table></div></fieldset><?php } ?><?php $a5_title=lang('date'); ?><fieldset><?php if(isset($a5_title)) { ?><legend><?php if(isset($a5_icon)) { ?><img src="<?php echo $image_dir.'icon_'.$a5_icon.IMG_ICON_EXT ?>" align="left" border="0" /><?php } ?>&nbsp;&nbsp;<?php echo encodeHtml($a5_title) ?>&nbsp;&nbsp;</legend><?php } ?><?php unset($a5_title) ?><div><?php $a7_for='year'; ?><label<?php if (isset($a7_for)) { ?> for="id_<?php echo $a7_for ?><?php if (!empty($a7_value)) echo '_'.$a7_value ?>" class="label"<?php } ?>>
<?php if (isset($a7_key)) { echo lang($a7_key); if(hasLang($a7_key.'_desc')) { ?><div class="description"><?php echo lang($a7_key.'_desc')?></div> <?php } } ?><?php unset($a7_for) ?><?php $a8_class='text';$a8_key='date';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_key,$a8_escape,$a8_cut) ?></label><?php $a7_list='all_years';$a7_name='year';$a7_onchange='';$a7_title='';$a7_class='';$a7_addempty=false;$a7_multiple=false;$a7_size='1';$a7_lang=false; ?><?php
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
?><?php unset($a7_list,$a7_name,$a7_onchange,$a7_title,$a7_class,$a7_addempty,$a7_multiple,$a7_size,$a7_lang) ?><?php $a7_class='text';$a7_raw='_-_';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a7_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_raw,$a7_escape,$a7_cut) ?><?php $a7_list='all_months';$a7_name='month';$a7_onchange='';$a7_title='';$a7_class='';$a7_addempty=false;$a7_multiple=false;$a7_size='1';$a7_lang=false; ?><?php
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
?><?php unset($a7_list,$a7_name,$a7_onchange,$a7_title,$a7_class,$a7_addempty,$a7_multiple,$a7_size,$a7_lang) ?><?php $a7_class='text';$a7_raw='_-_';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a7_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_raw,$a7_escape,$a7_cut) ?><?php $a7_list='all_days';$a7_name='day';$a7_onchange='';$a7_title='';$a7_class='';$a7_addempty=false;$a7_multiple=false;$a7_size='1';$a7_lang=false; ?><?php
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
?><?php unset($a7_list,$a7_name,$a7_onchange,$a7_title,$a7_class,$a7_addempty,$a7_multiple,$a7_size,$a7_lang) ?></div><div><?php $a7_for='hour'; ?><label<?php if (isset($a7_for)) { ?> for="id_<?php echo $a7_for ?><?php if (!empty($a7_value)) echo '_'.$a7_value ?>" class="label"<?php } ?>>
<?php if (isset($a7_key)) { echo lang($a7_key); if(hasLang($a7_key.'_desc')) { ?><div class="description"><?php echo lang($a7_key.'_desc')?></div> <?php } } ?><?php unset($a7_for) ?><?php $a8_class='text';$a8_key='date_time';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_key,$a8_escape,$a8_cut) ?></label><?php $a7_list='all_hours';$a7_name='hour';$a7_onchange='';$a7_title='';$a7_class='';$a7_addempty=false;$a7_multiple=false;$a7_size='1';$a7_lang=false; ?><?php
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
?><?php unset($a7_list,$a7_name,$a7_onchange,$a7_title,$a7_class,$a7_addempty,$a7_multiple,$a7_size,$a7_lang) ?><?php $a7_class='text';$a7_raw='_-_';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a7_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_raw,$a7_escape,$a7_cut) ?><?php $a7_list='all_minutes';$a7_name='minute';$a7_onchange='';$a7_title='';$a7_class='';$a7_addempty=false;$a7_multiple=false;$a7_size='1';$a7_lang=false; ?><?php
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
?><?php unset($a7_list,$a7_name,$a7_onchange,$a7_title,$a7_class,$a7_addempty,$a7_multiple,$a7_size,$a7_lang) ?><?php $a7_class='text';$a7_raw='_-_';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a7_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_raw,$a7_escape,$a7_cut) ?><?php $a7_list='all_seconds';$a7_name='second';$a7_onchange='';$a7_title='';$a7_class='';$a7_addempty=false;$a7_multiple=false;$a7_size='1';$a7_lang=false; ?><?php
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
?><?php unset($a7_list,$a7_name,$a7_onchange,$a7_title,$a7_class,$a7_addempty,$a7_multiple,$a7_size,$a7_lang) ?></div></fieldset><?php } ?><?php $a4_equals='text';$a4_value=$type; ?><?php 
	$a4_tmp_exec = $a4_equals == $a4_value;
	$a4_tmp_last_exec = $a4_tmp_exec;
	if	( $a4_tmp_exec )
	{
?>
<?php unset($a4_equals,$a4_value) ?><?php
	$column_idx = 0;
?>
<tr
>
<?php $a6_colspan='2';$a6_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
 colspan="2"
><?php unset($a6_colspan,$a6_header) ?><?php $a7_class='text';$a7_default='';$a7_type='text';$a7_name='text';$a7_size='50';$a7_maxlength='255';$a7_onchange='';$a7_readonly=false; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a7_readonly=true;
	  if ($a7_readonly && empty($$a7_name)) $$a7_name = '- '.lang('EMPTY').' -';
      if(!isset($a7_default)) $a7_default='';
      $tmp_value = Text::encodeHtml(isset($$a7_name)?$$a7_name:$a7_default);
?><?php if (!$a7_readonly || $a7_type=='hidden') {
?><input<?php if ($a7_readonly) echo ' disabled="true"' ?> id="id_<?php echo $a7_name ?><?php if ($a7_readonly) echo '_disabled' ?>" name="<?php echo $a7_name ?><?php if ($a7_readonly) echo '_disabled' ?>" type="<?php echo $a7_type ?>" maxlength="<?php echo $a7_maxlength ?>" class="<?php echo str_replace(',',' ',$a7_class) ?>" value="<?php echo $tmp_value ?>" <?php if (in_array($a7_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php
if	($a7_readonly) {
?><input type="hidden" id="id_<?php echo $a7_name ?>" name="<?php echo $a7_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subactionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a7_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a7_class,$a7_default,$a7_type,$a7_name,$a7_size,$a7_maxlength,$a7_onchange,$a7_readonly) ?><?php $a7_field='text'; ?><script name="JavaScript" type="text/javascript"><!--
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
<?php unset($a5_present) ?><?php $a6_class='preview'; ?><div class="<?php echo $a6_class ?>"><?php unset($a6_class) ?><?php $a7_title=lang('page_preview'); ?><fieldset><?php if(isset($a7_title)) { ?><legend><?php if(isset($a7_icon)) { ?><img src="<?php echo $image_dir.'icon_'.$a7_icon.IMG_ICON_EXT ?>" align="left" border="0" /><?php } ?>&nbsp;&nbsp;<?php echo encodeHtml($a7_title) ?>&nbsp;&nbsp;</legend><?php } ?><?php unset($a7_title) ?><?php $a8_class='text';$a8_var='preview';$a8_escape=false;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = isset($$a8_var)?$$a8_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_var,$a8_escape,$a8_cut) ?></fieldset></div><?php } ?><?php $a5_equals='html';$a5_value=$editor; ?><?php 
	$a5_tmp_exec = $a5_equals == $a5_value;
	$a5_tmp_last_exec = $a5_tmp_exec;
	if	( $a5_tmp_exec )
	{
?>
<?php unset($a5_equals,$a5_value) ?><?php $a6_name='text';$a6_type='html'; ?><?php
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
switch( $a6_type )
{
	case 'fckeditor':
	case 'html':
		echo '<textarea name="'.$a6_name.'" class="editor htmleditor" id="pageelement_edit_editor">'.$$a6_name.'</textarea>';
		break;
	case 'wiki':
		$conf_tags = $conf['editor']['text-markup'];
		?><textarea name="<?php echo $a6_name ?>" class="editor wikieditor"><?php echo $$a6_name ?></textarea><?php
		break;
	case 'text':
	case 'raw':
		if	( $this->isEditMode() )
			echo '<textarea name="'.$a6_name.'" class="editor" style="width:100%;height:300px;">'.$$a6_name.'</textarea>';
		else
			echo nl2br($$a6_name);
		break;
	case 'dom':
	case 'tree':
		$a6_tmp_doc = new DocumentElement();
		$a6_tmp_text = $$a6_name;
		if	( !is_array($a6_tmp_text))
			$a6_tmp_text = explode("\n",$a6_tmp_text);
		$a6_tmp_doc->parse($a6_tmp_text);
		echo $a6_tmp_doc->render('application/html-dom');
		break;
	default:
		echo "Unknown editor type: ".$a6_type;
}
?><?php unset($a6_name,$a6_type) ?><?php } ?><?php $a5_equals='wiki';$a5_value=$editor; ?><?php 
	$a5_tmp_exec = $a5_equals == $a5_value;
	$a5_tmp_last_exec = $a5_tmp_exec;
	if	( $a5_tmp_exec )
	{
?>
<?php unset($a5_equals,$a5_value) ?><?php $a6_present='languagetext'; ?><?php 
	$a6_tmp_exec = isset($$a6_present);
	$a6_tmp_last_exec = $a6_tmp_exec;
	if	( $a6_tmp_exec )
	{
?>
<?php unset($a6_present) ?><?php $a7_title=$languagename; ?><fieldset><?php if(isset($a7_title)) { ?><legend><?php if(isset($a7_icon)) { ?><img src="<?php echo $image_dir.'icon_'.$a7_icon.IMG_ICON_EXT ?>" align="left" border="0" /><?php } ?>&nbsp;&nbsp;<?php echo encodeHtml($a7_title) ?>&nbsp;&nbsp;</legend><?php } ?><?php unset($a7_title) ?><?php $a8_class='text';$a8_var='languagetext';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = isset($$a8_var)?$$a8_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_var,$a8_escape,$a8_cut) ?></fieldset><br/><br/><?php } ?><?php $a6_name='text';$a6_type='wiki'; ?><?php
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
switch( $a6_type )
{
	case 'fckeditor':
	case 'html':
		echo '<textarea name="'.$a6_name.'" class="editor htmleditor" id="pageelement_edit_editor">'.$$a6_name.'</textarea>';
		break;
	case 'wiki':
		$conf_tags = $conf['editor']['text-markup'];
		?><textarea name="<?php echo $a6_name ?>" class="editor wikieditor"><?php echo $$a6_name ?></textarea><?php
		break;
	case 'text':
	case 'raw':
		if	( $this->isEditMode() )
			echo '<textarea name="'.$a6_name.'" class="editor" style="width:100%;height:300px;">'.$$a6_name.'</textarea>';
		else
			echo nl2br($$a6_name);
		break;
	case 'dom':
	case 'tree':
		$a6_tmp_doc = new DocumentElement();
		$a6_tmp_text = $$a6_name;
		if	( !is_array($a6_tmp_text))
			$a6_tmp_text = explode("\n",$a6_tmp_text);
		$a6_tmp_doc->parse($a6_tmp_text);
		echo $a6_tmp_doc->render('application/html-dom');
		break;
	default:
		echo "Unknown editor type: ".$a6_type;
}
?><?php unset($a6_name,$a6_type) ?><?php $a6_true=$mode=="edit"; ?><?php 
	if	(gettype($a6_true) === '' && gettype($a6_true) === '1')
		$a6_tmp_exec = $$a6_true == true;
	else
		$a6_tmp_exec = $a6_true == true;
	$a6_tmp_last_exec = $a6_tmp_exec;
	if	( $a6_tmp_exec )
	{
?>
<?php unset($a6_true) ?><?php $a7_title=lang('help'); ?><fieldset><?php if(isset($a7_title)) { ?><legend><?php if(isset($a7_icon)) { ?><img src="<?php echo $image_dir.'icon_'.$a7_icon.IMG_ICON_EXT ?>" align="left" border="0" /><?php } ?>&nbsp;&nbsp;<?php echo encodeHtml($a7_title) ?>&nbsp;&nbsp;</legend><?php } ?><?php unset($a7_title) ?><?php $a8_width='100%';$a8_space='0px';$a8_padding='0px'; ?><?php
	$last_column_idx = @$column_idx;
	$column_idx = 0;
	$coloumn_widths = array();
	$row_classes    = array();
	$column_classes = array();
?><table class="%class%" cellspacing="0px" width="100%" cellpadding="0px">
<?php unset($a8_width,$a8_space,$a8_padding) ?><?php $a9_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a9_header) ?><?php $a10_class='text';$a10_value=@$conf['editor']['text-markup']['strong-begin'];$a10_escape=true;$a10_cut='both'; ?><?php
		$a10_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a10_class ?>" title="<?php echo $a10_title ?>"><?php
		$langF = $a10_escape?'langHtml':'lang';
		$tmp_text = $a10_escape?htmlentities($a10_value):$a10_value;
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a10_class,$a10_value,$a10_escape,$a10_cut) ?><?php $a10_class='text';$a10_key='text_markup_strong';$a10_escape=true;$a10_cut='both'; ?><?php
		$a10_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a10_class ?>" title="<?php echo $a10_title ?>"><?php
		$langF = $a10_escape?'langHtml':'lang';
		$tmp_text = $langF($a10_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a10_class,$a10_key,$a10_escape,$a10_cut) ?><?php $a10_class='text';$a10_value=@$conf['editor']['text-markup']['strong-end'];$a10_escape=true;$a10_cut='both'; ?><?php
		$a10_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a10_class ?>" title="<?php echo $a10_title ?>"><?php
		$langF = $a10_escape?'langHtml':'lang';
		$tmp_text = $a10_escape?htmlentities($a10_value):$a10_value;
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a10_class,$a10_value,$a10_escape,$a10_cut) ?><br/><?php $a10_class='text';$a10_value=@$conf['editor']['text-markup']['emphatic-begin'];$a10_escape=true;$a10_cut='both'; ?><?php
		$a10_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a10_class ?>" title="<?php echo $a10_title ?>"><?php
		$langF = $a10_escape?'langHtml':'lang';
		$tmp_text = $a10_escape?htmlentities($a10_value):$a10_value;
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a10_class,$a10_value,$a10_escape,$a10_cut) ?><?php $a10_class='text';$a10_key='text_markup_emphatic';$a10_escape=true;$a10_cut='both'; ?><?php
		$a10_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a10_class ?>" title="<?php echo $a10_title ?>"><?php
		$langF = $a10_escape?'langHtml':'lang';
		$tmp_text = $langF($a10_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a10_class,$a10_key,$a10_escape,$a10_cut) ?><?php $a10_class='text';$a10_value=@$conf['editor']['text-markup']['emphatic-end'];$a10_escape=true;$a10_cut='both'; ?><?php
		$a10_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a10_class ?>" title="<?php echo $a10_title ?>"><?php
		$langF = $a10_escape?'langHtml':'lang';
		$tmp_text = $a10_escape?htmlentities($a10_value):$a10_value;
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a10_class,$a10_value,$a10_escape,$a10_cut) ?></td><?php $a9_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a9_header) ?><?php $a10_class='text';$a10_value=@$conf['editor']['text-markup']['list-numbered'];$a10_escape=true;$a10_cut='both'; ?><?php
		$a10_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a10_class ?>" title="<?php echo $a10_title ?>"><?php
		$langF = $a10_escape?'langHtml':'lang';
		$tmp_text = $a10_escape?htmlentities($a10_value):$a10_value;
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a10_class,$a10_value,$a10_escape,$a10_cut) ?><?php $a10_class='text';$a10_key='text_markup_numbered_list';$a10_escape=true;$a10_cut='both'; ?><?php
		$a10_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a10_class ?>" title="<?php echo $a10_title ?>"><?php
		$langF = $a10_escape?'langHtml':'lang';
		$tmp_text = $langF($a10_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a10_class,$a10_key,$a10_escape,$a10_cut) ?><br/><?php $a10_class='text';$a10_value=@$conf['editor']['text-markup']['list-numbered'];$a10_escape=true;$a10_cut='both'; ?><?php
		$a10_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a10_class ?>" title="<?php echo $a10_title ?>"><?php
		$langF = $a10_escape?'langHtml':'lang';
		$tmp_text = $a10_escape?htmlentities($a10_value):$a10_value;
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a10_class,$a10_value,$a10_escape,$a10_cut) ?><?php $a10_class='text';$a10_raw='...';$a10_escape=true;$a10_cut='both'; ?><?php
		$a10_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a10_class ?>" title="<?php echo $a10_title ?>"><?php
		$langF = $a10_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a10_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a10_class,$a10_raw,$a10_escape,$a10_cut) ?><br/></td><?php $a9_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a9_header) ?><?php $a10_class='text';$a10_value=@$conf['editor']['text-markup']['list-unnumbered'];$a10_escape=true;$a10_cut='both'; ?><?php
		$a10_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a10_class ?>" title="<?php echo $a10_title ?>"><?php
		$langF = $a10_escape?'langHtml':'lang';
		$tmp_text = $a10_escape?htmlentities($a10_value):$a10_value;
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a10_class,$a10_value,$a10_escape,$a10_cut) ?><?php $a10_class='text';$a10_key='text_markup_unnumbered_list';$a10_escape=true;$a10_cut='both'; ?><?php
		$a10_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a10_class ?>" title="<?php echo $a10_title ?>"><?php
		$langF = $a10_escape?'langHtml':'lang';
		$tmp_text = $langF($a10_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a10_class,$a10_key,$a10_escape,$a10_cut) ?><br/><?php $a10_class='text';$a10_value=@$conf['editor']['text-markup']['list-unnumbered'];$a10_escape=true;$a10_cut='both'; ?><?php
		$a10_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a10_class ?>" title="<?php echo $a10_title ?>"><?php
		$langF = $a10_escape?'langHtml':'lang';
		$tmp_text = $a10_escape?htmlentities($a10_value):$a10_value;
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a10_class,$a10_value,$a10_escape,$a10_cut) ?><?php $a10_class='text';$a10_raw='...';$a10_escape=true;$a10_cut='both'; ?><?php
		$a10_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a10_class ?>" title="<?php echo $a10_title ?>"><?php
		$langF = $a10_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a10_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a10_class,$a10_raw,$a10_escape,$a10_cut) ?><br/></td><?php $a9_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a9_header) ?><?php $a10_class='text';$a10_value=@$conf['editor']['text-markup']['table-cell-sep'];$a10_escape=true;$a10_cut='both'; ?><?php
		$a10_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a10_class ?>" title="<?php echo $a10_title ?>"><?php
		$langF = $a10_escape?'langHtml':'lang';
		$tmp_text = $a10_escape?htmlentities($a10_value):$a10_value;
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a10_class,$a10_value,$a10_escape,$a10_cut) ?><?php $a10_class='text';$a10_key='text_markup_table';$a10_escape=true;$a10_cut='both'; ?><?php
		$a10_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a10_class ?>" title="<?php echo $a10_title ?>"><?php
		$langF = $a10_escape?'langHtml':'lang';
		$tmp_text = $langF($a10_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a10_class,$a10_key,$a10_escape,$a10_cut) ?><?php $a10_class='text';$a10_value=@$conf['editor']['text-markup']['table-cell-sep'];$a10_escape=true;$a10_cut='both'; ?><?php
		$a10_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a10_class ?>" title="<?php echo $a10_title ?>"><?php
		$langF = $a10_escape?'langHtml':'lang';
		$tmp_text = $a10_escape?htmlentities($a10_value):$a10_value;
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a10_class,$a10_value,$a10_escape,$a10_cut) ?><?php $a10_class='text';$a10_raw='...';$a10_escape=true;$a10_cut='both'; ?><?php
		$a10_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a10_class ?>" title="<?php echo $a10_title ?>"><?php
		$langF = $a10_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a10_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a10_class,$a10_raw,$a10_escape,$a10_cut) ?><?php $a10_class='text';$a10_value=@$conf['editor']['text-markup']['table-cell-sep'];$a10_escape=true;$a10_cut='both'; ?><?php
		$a10_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a10_class ?>" title="<?php echo $a10_title ?>"><?php
		$langF = $a10_escape?'langHtml':'lang';
		$tmp_text = $a10_escape?htmlentities($a10_value):$a10_value;
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a10_class,$a10_value,$a10_escape,$a10_cut) ?><?php $a10_class='text';$a10_raw='...';$a10_escape=true;$a10_cut='both'; ?><?php
		$a10_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a10_class ?>" title="<?php echo $a10_title ?>"><?php
		$langF = $a10_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a10_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a10_class,$a10_raw,$a10_escape,$a10_cut) ?><?php $a10_class='text';$a10_value=@$conf['editor']['text-markup']['table-cell-sep'];$a10_escape=true;$a10_cut='both'; ?><?php
		$a10_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a10_class ?>" title="<?php echo $a10_title ?>"><?php
		$langF = $a10_escape?'langHtml':'lang';
		$tmp_text = $a10_escape?htmlentities($a10_value):$a10_value;
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a10_class,$a10_value,$a10_escape,$a10_cut) ?><br/><?php $a10_class='text';$a10_value=@$conf['editor']['text-markup']['table-cell-sep'];$a10_escape=true;$a10_cut='both'; ?><?php
		$a10_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a10_class ?>" title="<?php echo $a10_title ?>"><?php
		$langF = $a10_escape?'langHtml':'lang';
		$tmp_text = $a10_escape?htmlentities($a10_value):$a10_value;
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a10_class,$a10_value,$a10_escape,$a10_cut) ?><?php $a10_class='text';$a10_raw='...';$a10_escape=true;$a10_cut='both'; ?><?php
		$a10_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a10_class ?>" title="<?php echo $a10_title ?>"><?php
		$langF = $a10_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a10_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a10_class,$a10_raw,$a10_escape,$a10_cut) ?><?php $a10_class='text';$a10_value=@$conf['editor']['text-markup']['table-cell-sep'];$a10_escape=true;$a10_cut='both'; ?><?php
		$a10_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a10_class ?>" title="<?php echo $a10_title ?>"><?php
		$langF = $a10_escape?'langHtml':'lang';
		$tmp_text = $a10_escape?htmlentities($a10_value):$a10_value;
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a10_class,$a10_value,$a10_escape,$a10_cut) ?><?php $a10_class='text';$a10_raw='...';$a10_escape=true;$a10_cut='both'; ?><?php
		$a10_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a10_class ?>" title="<?php echo $a10_title ?>"><?php
		$langF = $a10_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a10_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a10_class,$a10_raw,$a10_escape,$a10_cut) ?><?php $a10_class='text';$a10_value=@$conf['editor']['text-markup']['table-cell-sep'];$a10_escape=true;$a10_cut='both'; ?><?php
		$a10_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a10_class ?>" title="<?php echo $a10_title ?>"><?php
		$langF = $a10_escape?'langHtml':'lang';
		$tmp_text = $a10_escape?htmlentities($a10_value):$a10_value;
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a10_class,$a10_value,$a10_escape,$a10_cut) ?><?php $a10_class='text';$a10_raw='...';$a10_escape=true;$a10_cut='both'; ?><?php
		$a10_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a10_class ?>" title="<?php echo $a10_title ?>"><?php
		$langF = $a10_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a10_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a10_class,$a10_raw,$a10_escape,$a10_cut) ?><?php $a10_class='text';$a10_value=@$conf['editor']['text-markup']['table-cell-sep'];$a10_escape=true;$a10_cut='both'; ?><?php
		$a10_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a10_class ?>" title="<?php echo $a10_title ?>"><?php
		$langF = $a10_escape?'langHtml':'lang';
		$tmp_text = $a10_escape?htmlentities($a10_value):$a10_value;
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a10_class,$a10_value,$a10_escape,$a10_cut) ?><br/></td><?php
	$column_idx = $last_column_idx;
?>
</table></fieldset><?php } ?><?php } ?><?php $a5_equals='text';$a5_value=$editor; ?><?php 
	$a5_tmp_exec = $a5_equals == $a5_value;
	$a5_tmp_last_exec = $a5_tmp_exec;
	if	( $a5_tmp_exec )
	{
?>
<?php unset($a5_equals,$a5_value) ?><?php $a6_name='text';$a6_rows='25';$a6_cols='70';$a6_class='longtext';$a6_default=''; ?><?php if ($this->isEditMode()) {
?><textarea class="<?php echo $a6_class ?>" name="<?php echo $a6_name ?>" rows="<?php echo $a6_rows ?>" cols="<?php echo $a6_cols ?>"><?php echo htmlentities(isset($$a6_name)?$$a6_name:$a6_default) ?></textarea><?php
 } else {
?><span class="<?php echo $a6_class ?>"><?php echo isset($$a6_name)?$$a6_name:$a6_default ?></span><?php } ?><?php unset($a6_name,$a6_rows,$a6_cols,$a6_class,$a6_default) ?><?php $a6_field='text'; ?><script name="JavaScript" type="text/javascript"><!--
</script>
<?php unset($a6_field) ?><?php } ?><?php } ?><?php $a4_equals='link';$a4_value=$type; ?><?php 
	$a4_tmp_exec = $a4_equals == $a4_value;
	$a4_tmp_last_exec = $a4_tmp_exec;
	if	( $a4_tmp_exec )
	{
?>
<?php unset($a4_equals,$a4_value) ?><fieldset><?php if(isset($a5_title)) { ?><legend><?php if(isset($a5_icon)) { ?><img src="<?php echo $image_dir.'icon_'.$a5_icon.IMG_ICON_EXT ?>" align="left" border="0" /><?php } ?>&nbsp;&nbsp;<?php echo encodeHtml($a5_title) ?>&nbsp;&nbsp;</legend><?php } ?><div><?php $a7_for='linkobjectid'; ?><label<?php if (isset($a7_for)) { ?> for="id_<?php echo $a7_for ?><?php if (!empty($a7_value)) echo '_'.$a7_value ?>" class="label"<?php } ?>>
<?php if (isset($a7_key)) { echo lang($a7_key); if(hasLang($a7_key.'_desc')) { ?><div class="description"><?php echo lang($a7_key.'_desc')?></div> <?php } } ?><?php unset($a7_for) ?><?php $a8_class='text';$a8_key='link_target';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_key,$a8_escape,$a8_cut) ?></label><?php $a7_list='objects';$a7_name='linkobjectid';$a7_onchange='';$a7_title='';$a7_class='';$a7_addempty=true;$a7_multiple=false;$a7_size='1';$a7_lang=false; ?><?php
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
?><?php unset($a7_list,$a7_name,$a7_onchange,$a7_title,$a7_class,$a7_addempty,$a7_multiple,$a7_size,$a7_lang) ?><?php $a7_field='linkobjectid'; ?><script name="JavaScript" type="text/javascript"><!--
</script>
<?php unset($a7_field) ?></div><?php $a6_true=$mode=="edit"; ?><?php 
	if	(gettype($a6_true) === '' && gettype($a6_true) === '1')
		$a6_tmp_exec = $$a6_true == true;
	else
		$a6_tmp_exec = $a6_true == true;
	$a6_tmp_last_exec = $a6_tmp_exec;
	if	( $a6_tmp_exec )
	{
?>
<?php unset($a6_true) ?><div><?php $a8_for='link_url'; ?><label<?php if (isset($a8_for)) { ?> for="id_<?php echo $a8_for ?><?php if (!empty($a8_value)) echo '_'.$a8_value ?>" class="label"<?php } ?>>
<?php if (isset($a8_key)) { echo lang($a8_key); if(hasLang($a8_key.'_desc')) { ?><div class="description"><?php echo lang($a8_key.'_desc')?></div> <?php } } ?><?php unset($a8_for) ?><?php $a9_class='text';$a9_key='link_url';$a9_escape=true;$a9_cut='both'; ?><?php
		$a9_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a9_class ?>" title="<?php echo $a9_title ?>"><?php
		$langF = $a9_escape?'langHtml':'lang';
		$tmp_text = $langF($a9_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a9_class,$a9_key,$a9_escape,$a9_cut) ?></label><?php $a8_class='text';$a8_default='';$a8_type='text';$a8_name='linkurl';$a8_size='';$a8_maxlength='256';$a8_onchange='';$a8_readonly=false; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a8_readonly=true;
	  if ($a8_readonly && empty($$a8_name)) $$a8_name = '- '.lang('EMPTY').' -';
      if(!isset($a8_default)) $a8_default='';
      $tmp_value = Text::encodeHtml(isset($$a8_name)?$$a8_name:$a8_default);
?><?php if (!$a8_readonly || $a8_type=='hidden') {
?><input<?php if ($a8_readonly) echo ' disabled="true"' ?> id="id_<?php echo $a8_name ?><?php if ($a8_readonly) echo '_disabled' ?>" name="<?php echo $a8_name ?><?php if ($a8_readonly) echo '_disabled' ?>" type="<?php echo $a8_type ?>" maxlength="<?php echo $a8_maxlength ?>" class="<?php echo str_replace(',',' ',$a8_class) ?>" value="<?php echo $tmp_value ?>" <?php if (in_array($a8_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php
if	($a8_readonly) {
?><input type="hidden" id="id_<?php echo $a8_name ?>" name="<?php echo $a8_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subactionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a8_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a8_class,$a8_default,$a8_type,$a8_name,$a8_size,$a8_maxlength,$a8_onchange,$a8_readonly) ?></div><?php } ?></fieldset><?php } ?><?php $a4_equals='list';$a4_value=$type; ?><?php 
	$a4_tmp_exec = $a4_equals == $a4_value;
	$a4_tmp_last_exec = $a4_tmp_exec;
	if	( $a4_tmp_exec )
	{
?>
<?php unset($a4_equals,$a4_value) ?><fieldset><?php if(isset($a5_title)) { ?><legend><?php if(isset($a5_icon)) { ?><img src="<?php echo $image_dir.'icon_'.$a5_icon.IMG_ICON_EXT ?>" align="left" border="0" /><?php } ?>&nbsp;&nbsp;<?php echo encodeHtml($a5_title) ?>&nbsp;&nbsp;</legend><?php } ?><div><?php $a7_list='objects';$a7_name='linkobjectid';$a7_onchange='';$a7_title='';$a7_class='';$a7_addempty=false;$a7_multiple=false;$a7_size='1';$a7_lang=false; ?><?php
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
?><?php unset($a7_list,$a7_name,$a7_onchange,$a7_title,$a7_class,$a7_addempty,$a7_multiple,$a7_size,$a7_lang) ?><?php $a7_field='linkobjectid'; ?><script name="JavaScript" type="text/javascript"><!--
</script>
<?php unset($a7_field) ?></div></fieldset><?php } ?><?php $a4_equals='insert';$a4_value=$type; ?><?php 
	$a4_tmp_exec = $a4_equals == $a4_value;
	$a4_tmp_last_exec = $a4_tmp_exec;
	if	( $a4_tmp_exec )
	{
?>
<?php unset($a4_equals,$a4_value) ?><fieldset><?php if(isset($a5_title)) { ?><legend><?php if(isset($a5_icon)) { ?><img src="<?php echo $image_dir.'icon_'.$a5_icon.IMG_ICON_EXT ?>" align="left" border="0" /><?php } ?>&nbsp;&nbsp;<?php echo encodeHtml($a5_title) ?>&nbsp;&nbsp;</legend><?php } ?><div><?php $a7_list='objects';$a7_name='linkobjectid';$a7_onchange='';$a7_title='';$a7_class='';$a7_addempty=false;$a7_multiple=false;$a7_size='1';$a7_lang=false; ?><?php
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
?><?php unset($a7_list,$a7_name,$a7_onchange,$a7_title,$a7_class,$a7_addempty,$a7_multiple,$a7_size,$a7_lang) ?><?php $a7_field='linkobjectid'; ?><script name="JavaScript" type="text/javascript"><!--
</script>
<?php unset($a7_field) ?></div></fieldset><?php } ?><?php $a4_equals='number';$a4_value=$type; ?><?php 
	$a4_tmp_exec = $a4_equals == $a4_value;
	$a4_tmp_last_exec = $a4_tmp_exec;
	if	( $a4_tmp_exec )
	{
?>
<?php unset($a4_equals,$a4_value) ?><fieldset><?php if(isset($a5_title)) { ?><legend><?php if(isset($a5_icon)) { ?><img src="<?php echo $image_dir.'icon_'.$a5_icon.IMG_ICON_EXT ?>" align="left" border="0" /><?php } ?>&nbsp;&nbsp;<?php echo encodeHtml($a5_title) ?>&nbsp;&nbsp;</legend><?php } ?><div><?php $a7_name='decimals';$a7_default='decimals'; ?><?php
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
?><input<?php if ($a7_readonly) echo ' disabled="true"' ?> id="id_<?php echo $a7_name ?><?php if ($a7_readonly) echo '_disabled' ?>" name="<?php echo $a7_name ?><?php if ($a7_readonly) echo '_disabled' ?>" type="<?php echo $a7_type ?>" maxlength="<?php echo $a7_maxlength ?>" class="<?php echo str_replace(',',' ',$a7_class) ?>" value="<?php echo $tmp_value ?>" <?php if (in_array($a7_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php
if	($a7_readonly) {
?><input type="hidden" id="id_<?php echo $a7_name ?>" name="<?php echo $a7_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subactionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a7_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a7_class,$a7_default,$a7_type,$a7_name,$a7_size,$a7_maxlength,$a7_onchange,$a7_readonly) ?><?php $a7_field='number'; ?><script name="JavaScript" type="text/javascript"><!--
</script>
<?php unset($a7_field) ?></div></fieldset><?php } ?><?php $a4_equals='select';$a4_value=$type; ?><?php 
	$a4_tmp_exec = $a4_equals == $a4_value;
	$a4_tmp_last_exec = $a4_tmp_exec;
	if	( $a4_tmp_exec )
	{
?>
<?php unset($a4_equals,$a4_value) ?><fieldset><?php if(isset($a5_title)) { ?><legend><?php if(isset($a5_icon)) { ?><img src="<?php echo $image_dir.'icon_'.$a5_icon.IMG_ICON_EXT ?>" align="left" border="0" /><?php } ?>&nbsp;&nbsp;<?php echo encodeHtml($a5_title) ?>&nbsp;&nbsp;</legend><?php } ?><div><?php $a7_list='items';$a7_name='text';$a7_onchange='';$a7_title='';$a7_class='';$a7_addempty=false;$a7_multiple=false;$a7_size='1';$a7_lang=false; ?><?php
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
?><?php unset($a7_list,$a7_name,$a7_onchange,$a7_title,$a7_class,$a7_addempty,$a7_multiple,$a7_size,$a7_lang) ?><?php $a7_field='text'; ?><script name="JavaScript" type="text/javascript"><!--
</script>
<?php unset($a7_field) ?></div></fieldset><?php } ?><?php $a4_true=$mode=="edit"; ?><?php 
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
<?php unset($a7_present) ?><?php $a8_title=lang('editor_show_language'); ?><fieldset><?php if(isset($a8_title)) { ?><legend><?php if(isset($a8_icon)) { ?><img src="<?php echo $image_dir.'icon_'.$a8_icon.IMG_ICON_EXT ?>" align="left" border="0" /><?php } ?>&nbsp;&nbsp;<?php echo encodeHtml($a8_title) ?>&nbsp;&nbsp;</legend><?php } ?><?php unset($a8_title) ?><div><?php $a10_list='languages';$a10_extract=false;$a10_key='languageid';$a10_value='languagename'; ?><?php
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
<?php /* #END-IF# */ ?><?php unset($a11_readonly,$a11_name,$a11_value,$a11_default,$a11_prefix,$a11_suffix,$a11_class,$a11_onchange) ?><?php $a11_for='otherlanguageid_'.$languageid.''; ?><label<?php if (isset($a11_for)) { ?> for="id_<?php echo $a11_for ?><?php if (!empty($a11_value)) echo '_'.$a11_value ?>" class="label"<?php } ?>>
<?php if (isset($a11_key)) { echo lang($a11_key); if(hasLang($a11_key.'_desc')) { ?><div class="description"><?php echo lang($a11_key.'_desc')?></div> <?php } } ?><?php unset($a11_for) ?><?php $a12_class='text';$a12_var='languagename';$a12_escape=true;$a12_cut='both'; ?><?php
		$a12_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a12_class ?>" title="<?php echo $a12_title ?>"><?php
		$langF = $a12_escape?'langHtml':'lang';
		$tmp_text = isset($$a12_var)?$$a12_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a12_class,$a12_var,$a12_escape,$a12_cut) ?></label><br/><?php } ?></div></fieldset><?php } ?><?php $a7_title=lang('PAGE_PREVIEW'); ?><fieldset><?php if(isset($a7_title)) { ?><legend><?php if(isset($a7_icon)) { ?><img src="<?php echo $image_dir.'icon_'.$a7_icon.IMG_ICON_EXT ?>" align="left" border="0" /><?php } ?>&nbsp;&nbsp;<?php echo encodeHtml($a7_title) ?>&nbsp;&nbsp;</legend><?php } ?><?php unset($a7_title) ?><div><?php $a9_default=false;$a9_readonly=false;$a9_name='preview'; ?><?php
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
?><?php unset($a9_name); unset($a9_readonly); unset($a9_default); ?><?php unset($a9_default,$a9_readonly,$a9_name) ?><?php $a9_for='preview'; ?><label<?php if (isset($a9_for)) { ?> for="id_<?php echo $a9_for ?><?php if (!empty($a9_value)) echo '_'.$a9_value ?>" class="label"<?php } ?>>
<?php if (isset($a9_key)) { echo lang($a9_key); if(hasLang($a9_key.'_desc')) { ?><div class="description"><?php echo lang($a9_key.'_desc')?></div> <?php } } ?><?php unset($a9_for) ?><?php $a10_class='text';$a10_key='PAGE_PREVIEW';$a10_escape=true;$a10_cut='both'; ?><?php
		$a10_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a10_class ?>" title="<?php echo $a10_title ?>"><?php
		$langF = $a10_escape?'langHtml':'lang';
		$tmp_text = $langF($a10_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a10_class,$a10_key,$a10_escape,$a10_cut) ?></label></div></fieldset><?php } ?><?php } ?><?php } ?><?php $a4_title=lang('options'); ?><fieldset><?php if(isset($a4_title)) { ?><legend><?php if(isset($a4_icon)) { ?><img src="<?php echo $image_dir.'icon_'.$a4_icon.IMG_ICON_EXT ?>" align="left" border="0" /><?php } ?>&nbsp;&nbsp;<?php echo encodeHtml($a4_title) ?>&nbsp;&nbsp;</legend><?php } ?><?php unset($a4_title) ?><?php $a5_present='release'; ?><?php 
	$a5_tmp_exec = isset($$a5_present);
	$a5_tmp_last_exec = $a5_tmp_exec;
	if	( $a5_tmp_exec )
	{
?>
<?php unset($a5_present) ?><div><?php $a7_default=false;$a7_readonly=false;$a7_name='release'; ?><?php
	if ($this->isEditable() && !$this->isEditMode()) $a7_readonly=true;
	if	( isset($$a7_name) )
		$checked = $$a7_name;
	else
		$checked = $a7_default;
?><input class="checkbox" type="checkbox" id="id_<?php echo $a7_name ?>" name="<?php echo $a7_name  ?>"  <?php if ($a7_readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?><?php if (in_array($a7_name,$errors)) echo ' style="background-color:red;"' ?> /><?php
if ( $a7_readonly && $checked )
{ 
?><input type="hidden" name="<?php echo $a7_name ?>" value="1" /><?php
}
?><?php unset($a7_name); unset($a7_readonly); unset($a7_default); ?><?php unset($a7_default,$a7_readonly,$a7_name) ?><?php $a7_for='release'; ?><label<?php if (isset($a7_for)) { ?> for="id_<?php echo $a7_for ?><?php if (!empty($a7_value)) echo '_'.$a7_value ?>" class="label"<?php } ?>>
<?php if (isset($a7_key)) { echo lang($a7_key); if(hasLang($a7_key.'_desc')) { ?><div class="description"><?php echo lang($a7_key.'_desc')?></div> <?php } } ?><?php unset($a7_for) ?><?php $a8_class='text';$a8_text='GLOBAL_RELEASE';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_text,$a8_escape,$a8_cut) ?></label></div><?php } ?><?php $a5_present='publish'; ?><?php 
	$a5_tmp_exec = isset($$a5_present);
	$a5_tmp_last_exec = $a5_tmp_exec;
	if	( $a5_tmp_exec )
	{
?>
<?php unset($a5_present) ?><div><?php $a7_default=false;$a7_readonly=false;$a7_name='publish'; ?><?php
	if ($this->isEditable() && !$this->isEditMode()) $a7_readonly=true;
	if	( isset($$a7_name) )
		$checked = $$a7_name;
	else
		$checked = $a7_default;
?><input class="checkbox" type="checkbox" id="id_<?php echo $a7_name ?>" name="<?php echo $a7_name  ?>"  <?php if ($a7_readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?><?php if (in_array($a7_name,$errors)) echo ' style="background-color:red;"' ?> /><?php
if ( $a7_readonly && $checked )
{ 
?><input type="hidden" name="<?php echo $a7_name ?>" value="1" /><?php
}
?><?php unset($a7_name); unset($a7_readonly); unset($a7_default); ?><?php unset($a7_default,$a7_readonly,$a7_name) ?><?php $a7_for='publish'; ?><label<?php if (isset($a7_for)) { ?> for="id_<?php echo $a7_for ?><?php if (!empty($a7_value)) echo '_'.$a7_value ?>" class="label"<?php } ?>>
<?php if (isset($a7_key)) { echo lang($a7_key); if(hasLang($a7_key.'_desc')) { ?><div class="description"><?php echo lang($a7_key.'_desc')?></div> <?php } } ?><?php unset($a7_for) ?><?php $a8_class='text';$a8_text='PAGE_PUBLISH_AFTER_SAVE';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_text,$a8_escape,$a8_cut) ?></label></div><?php } ?></fieldset><?php if (false) { ?>
</div>
</div>
<div class="bottom">
	<div class="status">
	</div>
	<div class="command">
	<input type="button" value="<?php echo lang('OK') ?>" onclick="formSubmit( $(this),'<?php echo $view ?>');" />
	<input type="cancel" value="<?php echo lang('CANCEL') ?>" />
	</div>
</div>
</div>
<?php if ($showDuration)
      { ?>
<br/>
<center><small>&nbsp;
<?php $dur = time()-START_TIME;
      echo floor($dur/60).':'.str_pad($dur%60,2,'0',STR_PAD_LEFT); ?></small></center>
<?php } ?>
<?php } ?></form>
