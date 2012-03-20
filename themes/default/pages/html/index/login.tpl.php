<?php $a1_class='main'; ?><?php unset($a1_class) ?><?php $a2_action='index';$a2_subaction='login';$a2_name='';$a2_target='_top';$a2_method='post';$a2_enctype='application/x-www-form-urlencoded'; ?><?php
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
?><?php unset($a2_action,$a2_subaction,$a2_name,$a2_target,$a2_method,$a2_enctype) ?><?php $a3_title='GLOBAL_LOGIN';$a3_name='login';$a3_icon='user';$a3_width='400px';$a3_rowclasses='odd,even';$a3_columnclasses='1,2,3'; ?><div class="breadcrumb">
		<?php 
	$icon=$a3_icon;
	$icon=$actionName;
		echo '<img src="'.$image_dir.'icon_'.$icon.IMG_ICON_EXT.'" align="left" border="0">';
		if ($this->isEditable()) { ?>
  <?php if ($this->isEditMode()) { 
  ?><a href="<?php echo Html::url($actionName,$subActionName,$this->getRequestId()                       ) ?>" accesskey="1" title="<?php echo langHtml('MODE_EDIT_DESC') ?>" class="path" style="text-align:right;font-weight:bold;font-weight:bold;"><img src="<?php echo $image_dir ?>mode-edit.png" style="vertical-align:top; " border="0" /></a> <?php }
   elseif (readonly()) {
  ?><img src="<?php echo $image_dir ?>readonly.png" style="vertical-align:top; " border="0" /> <?php } else {
  ?><a href="<?php echo Html::url($actionName,$subActionName,$this->getRequestId(),array('mode'=>'edit') ) ?>" accesskey="1" title="<?php echo langHtml('MODE_SHOW_DESC') ?>" class="path" style="text-align:right;font-weight:bold;font-weight:bold;"><img src="<?php echo $image_dir ?>readonly.png" style="vertical-align:top; " border="0" /></a> <?php }
  ?><?php }
		echo '<span class="path">'.langHtml($actionName).'</span>&nbsp;<strong>&rarr;</strong>&nbsp;';
		if	( !isset($path) || !is_array($path) )
			$path = array();
		foreach( $path as $pathElement)
		{
			extract($pathElement);
			echo '<a href="'.$url.'" title="'.$title.'" class="path">'.(!empty($key)?langHtml($key):$name).'</a>';
			echo '&nbsp;&rarr;&nbsp;';
		}
		echo '<span class="title">'.langHtml($windowTitle).'</span>';
		if	( isset($notice_status))
		{
			?><img src="<?php echo $image_dir.'notice_'.$notice_status.IMG_ICON_EXT ?>" align="right" /><?php
		}
		?>
</div>
<?php ?>		<!--<td class="menu" style="align:right;">
    <?php if (isset($windowIcons)) foreach( $windowIcons as $icon )
          {
          	?><a href="<?php echo $icon['url'] ?>" title="<?php echo 'ICON_'.langHtml($menu['type'].'_DESC') ?>"><image border="0" src="<?php echo $image_dir.$icon['type'].IMG_ICON_EXT ?>"></a>&nbsp;<?php
          }
     ?>
    </td>--><nix/>
  </tr>
<?php
	$coloumn_widths=array();
	$row_classes   = explode(',',$a3_rowclasses);
	$row_class_idx = 999;
	$column_classes = explode(',',$a3_columnclasses);
	$row_idx    = 0;
	$column_idx = 0;
	    if	( !isset($windowMenu) || !is_array($windowMenu) )
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
          		?><a class="action<?php echo $this->subActionName==$menu['subaction']?'_active':'' ?>" href="<?php echo Html::url($actionName,$menu['subaction'],$this->getRequestId() ) ?>" accesskey="<?php echo $tmp_key ?>" title="<?php echo langHtml($menu['text'].'_DESC') ?>"><!-- <img src="<?php echo $image_dir.'icon_'.$menu['subaction'].'.png' ?>" align="left" />--><?php echo $tmp_text ?></a><?php
          	}
          	else
          	{
          		?><div class="noaction"><!-- <img src="<?php echo $image_dir.'icon_'.$menu['subaction'].'.png' ?>" align="left" />--><?php echo $tmp_text ?></div><?php
          	}
          }
          	if (@$conf['help']['enabled'] )
          	{
             ?><a class="help" href="<?php echo $conf['help']['url'].$actionName.'/'.$subActionName.@$conf['help']['suffix'] ?> " target="_new" title="<?php echo langHtml('MENU_HELP_DESC') ?>"><!-- <img src="<?php echo $image_dir.'icon_help.png' ?>" align="left" />--><?php echo @$conf['help']['only_question_mark']?'?':langHtml('MENU_HELP') ?></a><?php
          	}
          	?><br/><?php
		global $image_dir;
		echo '<br/><br/>';
		echo '<table class="x-main" cellspacing="0" cellpadding="4" width="'.$a3_width.'">';
		?>
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
    <td class="x-window">
      <table cellspacing="0" width="100%" cellpadding="4">
<?php unset($a3_title,$a3_name,$a3_icon,$a3_width,$a3_rowclasses,$a3_columnclasses) ?><?php $a4_present=@$conf['login']['logo']['file']; ?><?php 
	$a4_tmp_exec = isset($$a4_present);
	$a4_tmp_last_exec = $a4_tmp_exec;
	if	( $a4_tmp_exec )
	{
?>
<?php unset($a4_present) ?><?php $a5_false=$this->mustChangePassword; ?><?php 
	if	(gettype($a5_false) === '' && gettype($a5_false) === '1')
		$a5_tmp_exec = $$a5_false == false;
	else
		$a5_tmp_exec = $a5_false == false;
	$a5_tmp_last_exec = $a5_tmp_exec;
	if	( $a5_tmp_exec )
	{
?>
<?php unset($a5_false) ?><?php
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
><?php unset($a7_colspan) ?><?php $a8_present=@$conf['login']['logo']['url']; ?><?php 
	$a8_tmp_exec = isset($$a8_present);
	$a8_tmp_last_exec = $a8_tmp_exec;
	if	( $a8_tmp_exec )
	{
?>
<?php unset($a8_present) ?><?php $a9_title='';$a9_target='_top';$a9_url=@$conf['login']['logo']['url'];$a9_class=''; ?><?php
	$params = array();
	$tmp_url = '';
	$params[REQ_PARAM_TARGET] = $a9_target;
		$tmp_url = $a9_url;
?><a<?php if (isset($a9_name)) echo ' name="'.$a9_name.'"'; else echo ' href="'.$tmp_url.(isset($a9_anchor)?'#'.$a9_anchor:'').'"' ?> class="<?php echo $a9_class ?>"<?php if (isset($a9_accesskey)) echo ' accesskey="'.$a9_accesskey.'"' ?>  title="<?php echo encodeHtml($a9_title) ?>"><?php unset($a9_title,$a9_target,$a9_url,$a9_class) ?><?php $a10_url=@$conf['login']['logo']['file'];$a10_align='left'; ?><?php
	$a10_tmp_image_file = $a10_url;
	$a10_tmp_title = basename($a10_tmp_image_file);
?><img alt="<?php echo $a10_tmp_title; if (isset($a10_size)) { echo ' ('; list($a10_tmp_width,$a10_tmp_height)=explode('x',$a10_size);echo $a10_tmp_width.'x'.$a10_tmp_height; echo')';} ?>" src="<?php echo $a10_tmp_image_file ?>" border="0"<?php if(isset($a10_align)) echo ' align="'.$a10_align.'"' ?><?php if (isset($a10_size)) { list($a10_tmp_width,$a10_tmp_height)=explode('x',$a10_size);echo ' width="'.$a10_tmp_width.'" height="'.$a10_tmp_height.'"';} ?>><?php unset($a10_url,$a10_align) ?></a><?php } ?><?php $a8_empty=@$conf['login']['logo']['url']; ?><?php 
	if	( !isset($$a8_empty) )
		$a8_tmp_exec = empty($a8_empty);
	elseif	( is_array($$a8_empty) )
		$a8_tmp_exec = (count($$a8_empty)==0);
	elseif	( is_bool($$a8_empty) )
		$a8_tmp_exec = true;
	else
		$a8_tmp_exec = empty( $$a8_empty );
	$a8_tmp_last_exec = $a8_tmp_exec;
	if	( $a8_tmp_exec )
	{
?>
<?php unset($a8_empty) ?><?php $a9_url=@$conf['login']['logo']['file'];$a9_align='left'; ?><?php
	$a9_tmp_image_file = $a9_url;
	$a9_tmp_title = basename($a9_tmp_image_file);
?><img alt="<?php echo $a9_tmp_title; if (isset($a9_size)) { echo ' ('; list($a9_tmp_width,$a9_tmp_height)=explode('x',$a9_size);echo $a9_tmp_width.'x'.$a9_tmp_height; echo')';} ?>" src="<?php echo $a9_tmp_image_file ?>" border="0"<?php if(isset($a9_align)) echo ' align="'.$a9_align.'"' ?><?php if (isset($a9_size)) { list($a9_tmp_width,$a9_tmp_height)=explode('x',$a9_size);echo ' width="'.$a9_tmp_width.'" height="'.$a9_tmp_height.'"';} ?>><?php unset($a9_url,$a9_align) ?><?php } ?></td></tr><?php } ?><?php } ?><?php $a4_not='';$a4_empty=@$conf['login']['motd']; ?><?php 
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
<?php unset($a4_not,$a4_empty) ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a6_class='motd';$a6_colspan='2'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="motd"
 colspan="2"
><?php unset($a6_class,$a6_colspan) ?><?php $a7_class='text';$a7_raw=@$conf['login']['motd'];$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a7_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_raw,$a7_escape,$a7_cut) ?></td></tr><?php } ?><?php $a4_true=@$conf['login']['nologin']; ?><?php 
	if	(gettype($a4_true) === '' && gettype($a4_true) === '1')
		$a4_tmp_exec = $$a4_true == true;
	else
		$a4_tmp_exec = $a4_true == true;
	$a4_tmp_last_exec = $a4_tmp_exec;
	if	( $a4_tmp_exec )
	{
?>
<?php unset($a4_true) ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a6_class='help';$a6_colspan='2'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="help"
 colspan="2"
><?php unset($a6_class,$a6_colspan) ?><?php $a7_class='text';$a7_key='LOGIN_NOLOGIN_DESC';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_key,$a7_escape,$a7_cut) ?></td></tr><?php } ?><?php $a4_true=@$conf['security']['readonly']; ?><?php 
	if	(gettype($a4_true) === '' && gettype($a4_true) === '1')
		$a4_tmp_exec = $$a4_true == true;
	else
		$a4_tmp_exec = $a4_true == true;
	$a4_tmp_last_exec = $a4_tmp_exec;
	if	( $a4_tmp_exec )
	{
?>
<?php unset($a4_true) ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a6_class='help';$a6_colspan='2'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="help"
 colspan="2"
><?php unset($a6_class,$a6_colspan) ?><?php $a7_class='text';$a7_key='GLOBAL_READONLY_DESC';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_key,$a7_escape,$a7_cut) ?></td></tr><?php } ?><?php $a4_true=@$conf['security']['nopublish']; ?><?php 
	if	(gettype($a4_true) === '' && gettype($a4_true) === '1')
		$a4_tmp_exec = $$a4_true == true;
	else
		$a4_tmp_exec = $a4_true == true;
	$a4_tmp_last_exec = $a4_tmp_exec;
	if	( $a4_tmp_exec )
	{
?>
<?php unset($a4_true) ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a6_class='help';$a6_colspan='2'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="help"
 colspan="2"
><?php unset($a6_class,$a6_colspan) ?><?php $a7_class='text';$a7_key='GLOBAL_NOPUBLISH_DESC';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_key,$a7_escape,$a7_cut) ?></td></tr><?php } ?><?php $a4_false=@$conf['login']['nologin']; ?><?php 
	if	(gettype($a4_false) === '' && gettype($a4_false) === '1')
		$a4_tmp_exec = $$a4_false == false;
	else
		$a4_tmp_exec = $a4_false == false;
	$a4_tmp_last_exec = $a4_tmp_exec;
	if	( $a4_tmp_exec )
	{
?>
<?php unset($a4_false) ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a6_class='logo';$a6_colspan='2'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="logo"
 colspan="2"
><?php unset($a6_class,$a6_colspan) ?><?php $a7_name='login'; ?><img src="<?php echo $image_dir.'logo_'.$a7_name.IMG_ICON_EXT ?>" border="0" align="left"><h2 class="logo"><?php echo langHtml('logo_'.$a7_name) ?></h2><p class="logo"><?php echo langHtml('logo_'.$a7_name.'_text') ?></p><?php unset($a7_name) ?></td></tr><?php
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
><?php $a7_class='text';$a7_key='USER_USERNAME';$a7_escape=true;$a7_cut='both'; ?><?php
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
><?php $a7_not=true;$a7_present='force_username'; ?><?php 
	$a7_tmp_exec = isset($$a7_present);
	$a7_tmp_exec = !$a7_tmp_exec;
	$a7_tmp_last_exec = $a7_tmp_exec;
	if	( $a7_tmp_exec )
	{
?>
<?php unset($a7_not,$a7_present) ?><?php $a8_class='name';$a8_default='';$a8_type='text';$a8_name='login_name';$a8_value='';$a8_size='20';$a8_maxlength='256';$a8_onchange='';$a8_readonly=false; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a8_readonly=true;
	  if ($a8_readonly && empty($$a8_name)) $$a8_name = '- '.lang('EMPTY').' -';
      if(!isset($a8_default)) $a8_default='';
      $tmp_value = Text::encodeHtml(isset($$a8_name)?$$a8_name:$a8_default);
?><?php if (!$a8_readonly || $a8_type=='hidden') {
?><input<?php if ($a8_readonly) echo ' disabled="true"' ?> id="id_<?php echo $a8_name ?><?php if ($a8_readonly) echo '_disabled' ?>" name="<?php echo $a8_name ?><?php if ($a8_readonly) echo '_disabled' ?>" type="<?php echo $a8_type ?>" size="<?php echo $a8_size ?>" maxlength="<?php echo $a8_maxlength ?>" class="<?php echo $a8_class ?>" value="<?php echo $tmp_value ?>" <?php if (in_array($a8_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php
if	($a8_readonly) {
?><input type="hidden" id="id_<?php echo $a8_name ?>" name="<?php echo $a8_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a href="<?php echo Html::url('','',0,array('mode'=>'edit')) ?>"><span class="<?php echo $a8_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a8_class,$a8_default,$a8_type,$a8_name,$a8_value,$a8_size,$a8_maxlength,$a8_onchange,$a8_readonly) ?><?php } ?><?php if (!$a7_tmp_last_exec) { ?>
<?php $a8_class='text';$a8_default='';$a8_type='hidden';$a8_name='login_name';$a8_value=$force_username;$a8_size='40';$a8_maxlength='256';$a8_onchange='';$a8_readonly=false; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a8_readonly=true;
	  if ($a8_readonly && empty($$a8_name)) $$a8_name = '- '.lang('EMPTY').' -';
      if(!isset($a8_default)) $a8_default='';
      $tmp_value = Text::encodeHtml(isset($$a8_name)?$$a8_name:$a8_default);
?><?php if (!$a8_readonly || $a8_type=='hidden') {
?><input<?php if ($a8_readonly) echo ' disabled="true"' ?> id="id_<?php echo $a8_name ?><?php if ($a8_readonly) echo '_disabled' ?>" name="<?php echo $a8_name ?><?php if ($a8_readonly) echo '_disabled' ?>" type="<?php echo $a8_type ?>" size="<?php echo $a8_size ?>" maxlength="<?php echo $a8_maxlength ?>" class="<?php echo $a8_class ?>" value="<?php echo $tmp_value ?>" <?php if (in_array($a8_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php
if	($a8_readonly) {
?><input type="hidden" id="id_<?php echo $a8_name ?>" name="<?php echo $a8_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a href="<?php echo Html::url('','',0,array('mode'=>'edit')) ?>"><span class="<?php echo $a8_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a8_class,$a8_default,$a8_type,$a8_name,$a8_value,$a8_size,$a8_maxlength,$a8_onchange,$a8_readonly) ?><?php $a8_class='text';$a8_value=$force_username;$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $a8_escape?htmlentities($a8_value):$a8_value;
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_value,$a8_escape,$a8_cut) ?><?php }
unset($a6_tmp_last_exec) ?></td></tr><?php
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
><?php $a7_class='text';$a7_key='USER_PASSWORD';$a7_escape=true;$a7_cut='both'; ?><?php
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
><?php $a7_name='login_password';$a7_default='';$a7_class='name';$a7_size='20';$a7_maxlength='256'; ?><input type="password" name="<?php echo $a7_name ?>" size="<?php echo $a7_size ?>" maxlength="<?php echo $a7_maxlength ?>" class="<?php echo $a7_class ?>" value="<?php if (count($errors)==0) echo isset($$a7_name)?$$a7_name:$a7_default ?>" <?php if (in_array($a7_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php unset($a7_name,$a7_default,$a7_class,$a7_size,$a7_maxlength) ?></td></tr><?php $a5_true=$this->mustChangePassword; ?><?php 
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
<?php $a7_colspan='2'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
 colspan="2"
><?php unset($a7_colspan) ?><?php $a8_title=lang('USER_NEW_PASSWORD'); ?><fieldset><?php if(isset($a8_title)) { ?><legend><?php if(isset($a8_icon)) { ?><image src="<?php echo $image_dir.'icon_'.$a8_icon.IMG_ICON_EXT ?>" align="left" border="0"><?php } ?><?php echo encodeHtml($a8_title) ?></legend><?php } ?><?php unset($a8_title) ?></fieldset></td></tr><?php
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
><?php $a8_class='text';$a8_key='USER_NEW_PASSWORD';$a8_escape=true;$a8_cut='both'; ?><?php
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
><?php $a8_name='password1';$a8_default='';$a8_class='';$a8_size='25';$a8_maxlength='256'; ?><input type="password" name="<?php echo $a8_name ?>" size="<?php echo $a8_size ?>" maxlength="<?php echo $a8_maxlength ?>" class="<?php echo $a8_class ?>" value="<?php if (count($errors)==0) echo isset($$a8_name)?$$a8_name:$a8_default ?>" <?php if (in_array($a8_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php unset($a8_name,$a8_default,$a8_class,$a8_size,$a8_maxlength) ?></td></tr><?php
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
><?php $a8_class='text';$a8_key='USER_NEW_PASSWORD_REPEAT';$a8_escape=true;$a8_cut='both'; ?><?php
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
><?php $a8_name='password2';$a8_default='';$a8_class='';$a8_size='25';$a8_maxlength='256'; ?><input type="password" name="<?php echo $a8_name ?>" size="<?php echo $a8_size ?>" maxlength="<?php echo $a8_maxlength ?>" class="<?php echo $a8_class ?>" value="<?php if (count($errors)==0) echo isset($$a8_name)?$$a8_name:$a8_default ?>" <?php if (in_array($a8_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php unset($a8_name,$a8_default,$a8_class,$a8_size,$a8_maxlength) ?></td></tr><?php } ?><?php
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
></td><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php $a7_title='';$a7_class='action';$a7_action='index';$a7_subaction='password'; ?><?php
	$params = array();
	$tmp_url = '';
		$tmp_url = Html::url($a7_action,$a7_subaction,!empty($a7_id)?$a7_id:$this->getRequestId(),$params);
?><a<?php if (isset($a7_name)) echo ' name="'.$a7_name.'"'; else echo ' href="'.$tmp_url.(isset($a7_anchor)?'#'.$a7_anchor:'').'"' ?> class="<?php echo $a7_class ?>"<?php if (isset($a7_accesskey)) echo ' accesskey="'.$a7_accesskey.'"' ?>  title="<?php echo encodeHtml($a7_title) ?>"><?php unset($a7_title,$a7_class,$a7_action,$a7_subaction) ?><?php $a8_class='text';$a8_key='menu_index_password';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_key,$a8_escape,$a8_cut) ?></a><?php $a7_title='';$a7_class='action';$a7_action='index';$a7_subaction='register'; ?><?php
	$params = array();
	$tmp_url = '';
		$tmp_url = Html::url($a7_action,$a7_subaction,!empty($a7_id)?$a7_id:$this->getRequestId(),$params);
?><a<?php if (isset($a7_name)) echo ' name="'.$a7_name.'"'; else echo ' href="'.$tmp_url.(isset($a7_anchor)?'#'.$a7_anchor:'').'"' ?> class="<?php echo $a7_class ?>"<?php if (isset($a7_accesskey)) echo ' accesskey="'.$a7_accesskey.'"' ?>  title="<?php echo encodeHtml($a7_title) ?>"><?php unset($a7_title,$a7_class,$a7_action,$a7_subaction) ?><?php $a8_class='text';$a8_key='menu_index_register';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_key,$a8_escape,$a8_cut) ?></a></td></tr><?php $a5_true=@$conf['security']['openid']['enable']; ?><?php 
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
<?php $a7_colspan='2'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
 colspan="2"
><?php unset($a7_colspan) ?><?php $a8_title=lang('OPENID'); ?><fieldset><?php if(isset($a8_title)) { ?><legend><?php if(isset($a8_icon)) { ?><image src="<?php echo $image_dir.'icon_'.$a8_icon.IMG_ICON_EXT ?>" align="left" border="0"><?php } ?><?php echo encodeHtml($a8_title) ?></legend><?php } ?><?php unset($a8_title) ?></fieldset></td></tr><?php
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
><?php $a8_not=true;$a8_empty=@$conf['security']['openid']['logo_url']; ?><?php 
	if	( !isset($$a8_empty) )
		$a8_tmp_exec = empty($a8_empty);
	elseif	( is_array($$a8_empty) )
		$a8_tmp_exec = (count($$a8_empty)==0);
	elseif	( is_bool($$a8_empty) )
		$a8_tmp_exec = true;
	else
		$a8_tmp_exec = empty( $$a8_empty );
	$a8_tmp_exec = !$a8_tmp_exec;
	$a8_tmp_last_exec = $a8_tmp_exec;
	if	( $a8_tmp_exec )
	{
?>
<?php unset($a8_not,$a8_empty) ?><?php $a9_url=@$conf['security']['openid']['logo_url'];$a9_align='left'; ?><?php
	$a9_tmp_image_file = $a9_url;
	$a9_tmp_title = basename($a9_tmp_image_file);
?><img alt="<?php echo $a9_tmp_title; if (isset($a9_size)) { echo ' ('; list($a9_tmp_width,$a9_tmp_height)=explode('x',$a9_size);echo $a9_tmp_width.'x'.$a9_tmp_height; echo')';} ?>" src="<?php echo $a9_tmp_image_file ?>" border="0"<?php if(isset($a9_align)) echo ' align="'.$a9_align.'"' ?><?php if (isset($a9_size)) { list($a9_tmp_width,$a9_tmp_height)=explode('x',$a9_size);echo ' width="'.$a9_tmp_width.'" height="'.$a9_tmp_height.'"';} ?>><?php unset($a9_url,$a9_align) ?><?php } ?><?php $a8_class='text';$a8_key='openid_user';$a8_escape=true;$a8_cut='both'; ?><?php
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
><?php $a8_list='openid_providers';$a8_name='openid_provider';$a8_onchange='';$a8_title='';$a8_class=''; ?><?php $a8_tmp_list = $$a8_list;
		if	( isset($$a8_name) && isset($a8_tmp_list[$$a8_name]) )
			$a8_tmp_default = $$a8_name;
		elseif ( isset($a8_default) )
			$a8_tmp_default = $a8_default;
		else
			$a8_tmp_default = '';
		foreach( $a8_tmp_list as $box_key=>$box_value )
		{
			$box_value = is_array($box_value)?(isset($box_value['lang'])?langHtml($box_value['lang']):$box_value['value']):$box_value;
			$id = 'id_'.$a8_name.'_'.$box_key;
			echo '<input id="'.$id.'" name="'.$a8_name.'" type="radio" class="'.$a8_class.'" value="'.$box_key.'"';
			if ($box_key==$a8_tmp_default)
				echo ' checked="checked"';
			echo '>&nbsp;<label for="'.$id.'">'.$box_value.'</label><br>';
		}
?><?php unset($a8_list,$a8_name,$a8_onchange,$a8_title,$a8_class) ?><?php $a8_true=$openid_user_identity; ?><?php 
	if	(gettype($a8_true) === '' && gettype($a8_true) === '1')
		$a8_tmp_exec = $$a8_true == true;
	else
		$a8_tmp_exec = $a8_true == true;
	$a8_tmp_last_exec = $a8_tmp_exec;
	if	( $a8_tmp_exec )
	{
?>
<?php unset($a8_true) ?><?php $a9_readonly=false;$a9_name='openid_provider';$a9_value='identity';$a9_default=false;$a9_prefix='';$a9_suffix='';$a9_class='';$a9_onchange=''; ?><?php
		if ($this->isEditable() && !$this->isEditMode()) $a9_readonly=true;
		if	( isset($$a9_name)  )
			$a9_tmp_default = $$a9_name;
		elseif ( isset($a9_default) )
			$a9_tmp_default = $a9_default;
		else
			$a9_tmp_default = '';
 ?><input onclick="" class="radio" type="radio" id="id_<?php echo $a9_name.'_'.$a9_value ?>"  name="<?php echo $a9_prefix.$a9_name ?>"<?php if ( $a9_readonly ) echo ' disabled="disabled"' ?> value="<?php echo $a9_value ?>" <?php if($a9_value==$a9_tmp_default) echo 'checked="checked"' ?><?php if (in_array($a9_name,$errors)) echo ' style="borderx:2px dashed red; background-color:red;"' ?> />
<?php /* #END-IF# */ ?><?php unset($a9_readonly,$a9_name,$a9_value,$a9_default,$a9_prefix,$a9_suffix,$a9_class,$a9_onchange) ?><?php $a9_class='name';$a9_default='';$a9_type='text';$a9_name='openid_url';$a9_size='20';$a9_maxlength='256';$a9_onchange='';$a9_readonly=false; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a9_readonly=true;
	  if ($a9_readonly && empty($$a9_name)) $$a9_name = '- '.lang('EMPTY').' -';
      if(!isset($a9_default)) $a9_default='';
      $tmp_value = Text::encodeHtml(isset($$a9_name)?$$a9_name:$a9_default);
?><?php if (!$a9_readonly || $a9_type=='hidden') {
?><input<?php if ($a9_readonly) echo ' disabled="true"' ?> id="id_<?php echo $a9_name ?><?php if ($a9_readonly) echo '_disabled' ?>" name="<?php echo $a9_name ?><?php if ($a9_readonly) echo '_disabled' ?>" type="<?php echo $a9_type ?>" size="<?php echo $a9_size ?>" maxlength="<?php echo $a9_maxlength ?>" class="<?php echo $a9_class ?>" value="<?php echo $tmp_value ?>" <?php if (in_array($a9_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php
if	($a9_readonly) {
?><input type="hidden" id="id_<?php echo $a9_name ?>" name="<?php echo $a9_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a href="<?php echo Html::url('','',0,array('mode'=>'edit')) ?>"><span class="<?php echo $a9_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a9_class,$a9_default,$a9_type,$a9_name,$a9_size,$a9_maxlength,$a9_onchange,$a9_readonly) ?><?php } ?></td></tr><?php } ?><?php $a5_value=@count($dbids);$a5_greaterthan='1'; ?><?php 
	$a5_tmp_exec = intval($a5_greaterthan) < intval($a5_value);
	$a5_tmp_last_exec = $a5_tmp_exec;
	if	( $a5_tmp_exec )
	{
?>
<?php unset($a5_value,$a5_greaterthan) ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php
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
><?php unset($a8_colspan) ?><?php $a9_title=lang('DATABASE');$a9_icon='database'; ?><fieldset><?php if(isset($a9_title)) { ?><legend><?php if(isset($a9_icon)) { ?><image src="<?php echo $image_dir.'icon_'.$a9_icon.IMG_ICON_EXT ?>" align="left" border="0"><?php } ?><?php echo encodeHtml($a9_title) ?></legend><?php } ?><?php unset($a9_title,$a9_icon) ?></fieldset></td></tr><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php $a8_class='text';$a8_key='DATABASE';$a8_escape=true;$a8_cut='both'; ?><?php
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
><?php $a8_list='dbids';$a8_name='dbid';$a8_default=$actdbid;$a8_onchange='';$a8_title='';$a8_class='';$a8_addempty=false;$a8_multiple=false;$a8_size='1';$a8_lang=false; ?><?php
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
?><?php unset($a8_list,$a8_name,$a8_default,$a8_onchange,$a8_title,$a8_class,$a8_addempty,$a8_multiple,$a8_size,$a8_lang) ?><?php $a8_name='screenwidth';$a8_default='9999'; ?><?php
if (isset($$a8_name))
	$a8_tmp_value = $$a8_name;
elseif ( isset($a8_default) )
	$a8_tmp_value = $a8_default;
else
	$a8_tmp_value = "";
?><input type="hidden" name="<?php echo $a8_name ?>" value="<?php echo $a8_tmp_value ?>" /><?php unset($a8_name,$a8_default) ?></td></tr><?php } ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a6_class='act';$a6_colspan='2'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="act"
 colspan="2"
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
?><?php unset($a7_type,$a7_class,$a7_value,$a7_text) ?><?php $a7_script='screenwidth';$a7_inline=false; ?><?php
$a7_tmp_file = $tpl_dir.'../../js/'.basename($a7_script).'.js';
if	(!$a7_inline)
{
	?><script src="<?php echo $a7_tmp_file ?>" type="text/javascript"></script><?php 
}
else
{
	echo '<script type="text/javascript">';
	echo str_replace('  ',' ',str_replace('~','',strtr(implode('',file($a7_tmp_file)),"\t\n\b",'~~~')));
	echo '</script>';
}
?>
<?php unset($a7_script,$a7_inline) ?></td></tr><?php } ?>      </table>
	</td>
  </tr>
</table>
<?php if ($showDuration)
      { ?>
<br/>
<center><small>&nbsp;
<?php $dur = time()-START_TIME;
      echo floor($dur/60).':'.str_pad($dur%60,2,'0',STR_PAD_LEFT); ?></small></center>
<?php } ?>
<?php $a3_value=@count($dbids);$a3_lessthan='2'; ?><?php 
	$a3_tmp_exec = intval($a3_lessthan) > intval($a3_value);
	$a3_tmp_last_exec = $a3_tmp_exec;
	if	( $a3_tmp_exec )
	{
?>
<?php unset($a3_value,$a3_lessthan) ?><?php $a4_name='dbid';$a4_default=$actdbid; ?><?php
if (isset($$a4_name))
	$a4_tmp_value = $$a4_name;
elseif ( isset($a4_default) )
	$a4_tmp_value = $a4_default;
else
	$a4_tmp_value = "";
?><input type="hidden" name="<?php echo $a4_name ?>" value="<?php echo $a4_tmp_value ?>" /><?php unset($a4_name,$a4_default) ?><?php } ?><?php $a3_name='objectid'; ?><?php
if (isset($$a3_name))
	$a3_tmp_value = $$a3_name;
elseif ( isset($a3_default) )
	$a3_tmp_value = $a3_default;
else
	$a3_tmp_value = "";
?><input type="hidden" name="<?php echo $a3_name ?>" value="<?php echo $a3_tmp_value ?>" /><?php unset($a3_name) ?><?php $a3_name='modelid'; ?><?php
if (isset($$a3_name))
	$a3_tmp_value = $$a3_name;
elseif ( isset($a3_default) )
	$a3_tmp_value = $a3_default;
else
	$a3_tmp_value = "";
?><input type="hidden" name="<?php echo $a3_name ?>" value="<?php echo $a3_tmp_value ?>" /><?php unset($a3_name) ?><?php $a3_name='projectid'; ?><?php
if (isset($$a3_name))
	$a3_tmp_value = $$a3_name;
elseif ( isset($a3_default) )
	$a3_tmp_value = $a3_default;
else
	$a3_tmp_value = "";
?><input type="hidden" name="<?php echo $a3_name ?>" value="<?php echo $a3_tmp_value ?>" /><?php unset($a3_name) ?><?php $a3_name='languageid'; ?><?php
if (isset($$a3_name))
	$a3_tmp_value = $$a3_name;
elseif ( isset($a3_default) )
	$a3_tmp_value = $a3_default;
else
	$a3_tmp_value = "";
?><input type="hidden" name="<?php echo $a3_name ?>" value="<?php echo $a3_tmp_value ?>" /><?php unset($a3_name) ?></form>
<br/><br/><?php $a2_title='';$a2_target='_top';$a2_url=@$conf['login']['gpl']['url'];$a2_class='copyright'; ?><?php
	$params = array();
	$tmp_url = '';
	$params[REQ_PARAM_TARGET] = $a2_target;
		$tmp_url = $a2_url;
?><a<?php if (isset($a2_name)) echo ' name="'.$a2_name.'"'; else echo ' href="'.$tmp_url.(isset($a2_anchor)?'#'.$a2_anchor:'').'"' ?> class="<?php echo $a2_class ?>"<?php if (isset($a2_accesskey)) echo ' accesskey="'.$a2_accesskey.'"' ?>  title="<?php echo encodeHtml($a2_title) ?>"><?php unset($a2_title,$a2_target,$a2_url,$a2_class) ?><?php $a3_class='text';$a3_value=lang('GPL');$a3_escape=true;$a3_cut='both'; ?><?php
		$a3_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a3_class ?>" title="<?php echo $a3_title ?>"><?php
		$langF = $a3_escape?'langHtml':'lang';
		$tmp_text = $a3_escape?htmlentities($a3_value):$a3_value;
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a3_class,$a3_value,$a3_escape,$a3_cut) ?></a><?php $a2_present='force_username'; ?><?php 
	$a2_tmp_exec = isset($$a2_present);
	$a2_tmp_last_exec = $a2_tmp_exec;
	if	( $a2_tmp_exec )
	{
?>
<?php unset($a2_present) ?><?php $a3_field='login_password'; ?><?php
if (isset($errors[0])) $a3_field = $errors[0];
?><script name="JavaScript" type="text/javascript"><!--
document.forms[0].<?php echo $a3_field ?>.focus();
document.forms[0].<?php echo $a3_field ?>.select();
</script>
<?php unset($a3_field) ?><?php } ?><?php if (!$a2_tmp_last_exec) { ?>
<?php $a3_field='login_name'; ?><?php
if (isset($errors[0])) $a3_field = $errors[0];
?><script name="JavaScript" type="text/javascript"><!--
document.forms[0].<?php echo $a3_field ?>.focus();
document.forms[0].<?php echo $a3_field ?>.select();
</script>
<?php unset($a3_field) ?><?php }
unset($a1_tmp_last_exec) ?>