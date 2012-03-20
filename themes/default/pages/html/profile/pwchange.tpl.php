<?php $a1_class='main'; ?><?php unset($a1_class) ?><?php $a2_name='';$a2_target='_self';$a2_method='post';$a2_enctype='application/x-www-form-urlencoded'; ?><?php
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
      enctype="<?php echo $a2_enctype ?>" style="margin:0px;padding:0px;"
      class="<?php echo $a2_action ?>">
<?php if ($this->isEditable() && !$this->isEditMode()) { ?>
<input type="hidden" name="mode" value="edit" />
<?php } ?>
<input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo $a2_action ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo $a2_subaction ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo $a2_id ?>" /><?php
		if	( $conf['interface']['url_sessionid'] )
			echo '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";
?><?php unset($a2_name,$a2_target,$a2_method,$a2_enctype) ?><?php $a3_name='user_profile';$a3_icon='user';$a3_width='93%';$a3_rowclasses='odd,even';$a3_columnclasses='1,2,3'; ?><div class="breadcrumb">
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
			<a href="<?php echo $url ?>" title="<?php echo $title ?>" class="path"><?php echo (!empty($key)?langHtml($key):$name) ?></a>
			&nbsp;&rarr;&nbsp;
		<?php } ?>
		<span class="title"><?php echo langHtml($windowTitle) ?></span>
		<?php
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
<div class="menu">
<?php
	if	( !isset($windowMenu) || !is_array($windowMenu) ) $windowMenu = array();
    foreach( $windowMenu as $menu )
          {
          	$tmp_text = langHtml($menu['text']);
          	$tmp_key  = strtoupper(langHtml($menu['key' ]));
			$tmp_pos = strpos(strtolower($tmp_text),strtolower($tmp_key));
			if	( $tmp_pos !== false )
				$tmp_text = substr($tmp_text,0,max($tmp_pos,0)).'<span class="accesskey">'. substr($tmp_text,$tmp_pos,1).'</span>'.substr($tmp_text,$tmp_pos+1);
          	if	( isset($menu['url']) )
          	{
          		?><a class="action<?php echo $this->subActionName==$menu['subaction']?'_active':'' ?>" href="<?php echo Html::url($actionName,$menu['subaction'],$this->getRequestId() ) ?>" accesskey="<?php echo $tmp_key ?>" title="<?php echo langHtml($menu['text'].'_DESC') ?>"><img src="<?php echo $image_dir.'icon/'.$menu['subaction'].'.png' ?>" /><?php echo $tmp_text ?></a><?php
          	}
          	else
          	{
          		?><div class="noaction"><img src="<?php echo $image_dir.'icon/'.$menu['subaction'].'.png' ?>" /><?php echo $tmp_text ?></div><?php
          	}
          }
          	if (@$conf['help']['enabled'] )
          	{
             ?><a class="help" href="<?php echo $conf['help']['url'].$actionName.'/'.$subActionName.@$conf['help']['suffix'] ?> " target="_new" title="<?php echo langHtml('MENU_HELP_DESC') ?>"><img src="<?php echo $image_dir.'icon/help.png' ?>" /><?php echo @$conf['help']['only_question_mark']?'?':langHtml('MENU_HELP') ?></a><?php
          	}
          	?><br/><?php
		?>
</div>
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
<?php unset($a3_name,$a3_icon,$a3_width,$a3_rowclasses,$a3_columnclasses) ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a5_class='logo';$a5_colspan='2';$a5_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="logo"
 colspan="2"
><?php unset($a5_class,$a5_colspan,$a5_header) ?><?php $a6_name='changepassword'; ?><img src="<?php echo $image_dir.'logo_'.$a6_name.IMG_ICON_EXT ?>" border="0" align="left"><h2 class="logo"><?php echo langHtml('logo_'.$a6_name) ?></h2><p class="logo"><?php echo langHtml('logo_'.$a6_name.'_text') ?></p><?php unset($a6_name) ?></td></tr><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a5_colspan='2';$a5_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
 colspan="2"
><?php unset($a5_colspan,$a5_header) ?><?php $a6_title=lang('user_act_password'); ?><fieldset><?php if(isset($a6_title)) { ?><legend><?php if(isset($a6_icon)) { ?><image src="<?php echo $image_dir.'icon_'.$a6_icon.IMG_ICON_EXT ?>" align="left" border="0"><?php } ?>&nbsp;&nbsp;<?php echo encodeHtml($a6_title) ?>&nbsp;&nbsp;</legend><?php } ?><?php unset($a6_title) ?><?php $a7_for='act_password'; ?><label for="id_<?php echo $a7_for ?><?php if (!empty($a7_value)) echo '_'.$a7_value ?>"><?php unset($a7_for) ?><?php $a8_class='text';$a8_text='user_password';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_text,$a8_escape,$a8_cut) ?></label><?php $a7_name='act_password';$a7_default='';$a7_class='';$a7_size='40';$a7_maxlength='256'; ?><input type="password" name="<?php echo $a7_name ?>"  id="id_<?php echo $a7_name ?>" size="<?php echo $a7_size ?>" maxlength="<?php echo $a7_maxlength ?>" class="<?php echo $a7_class ?>" value="<?php if (count($errors)==0) echo isset($$a7_name)?$$a7_name:$a7_default ?>" <?php if (in_array($a7_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php unset($a7_name,$a7_default,$a7_class,$a7_size,$a7_maxlength) ?></fieldset><?php $a6_title=lang('user_new_password'); ?><fieldset><?php if(isset($a6_title)) { ?><legend><?php if(isset($a6_icon)) { ?><image src="<?php echo $image_dir.'icon_'.$a6_icon.IMG_ICON_EXT ?>" align="left" border="0"><?php } ?>&nbsp;&nbsp;<?php echo encodeHtml($a6_title) ?>&nbsp;&nbsp;</legend><?php } ?><?php unset($a6_title) ?><?php $a7_for='password1'; ?><label for="id_<?php echo $a7_for ?><?php if (!empty($a7_value)) echo '_'.$a7_value ?>"><?php unset($a7_for) ?><?php $a8_class='text';$a8_text='user_new_password';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_text,$a8_escape,$a8_cut) ?></label><?php $a7_name='password1';$a7_default='';$a7_class='';$a7_size='40';$a7_maxlength='256'; ?><input type="password" name="<?php echo $a7_name ?>"  id="id_<?php echo $a7_name ?>" size="<?php echo $a7_size ?>" maxlength="<?php echo $a7_maxlength ?>" class="<?php echo $a7_class ?>" value="<?php if (count($errors)==0) echo isset($$a7_name)?$$a7_name:$a7_default ?>" <?php if (in_array($a7_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php unset($a7_name,$a7_default,$a7_class,$a7_size,$a7_maxlength) ?><br/><?php $a7_for='password2'; ?><label for="id_<?php echo $a7_for ?><?php if (!empty($a7_value)) echo '_'.$a7_value ?>"><?php unset($a7_for) ?><?php $a8_class='text';$a8_text='user_new_password_repeat';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_text,$a8_escape,$a8_cut) ?></label><?php $a7_name='password2';$a7_default='';$a7_class='';$a7_size='40';$a7_maxlength='256'; ?><input type="password" name="<?php echo $a7_name ?>"  id="id_<?php echo $a7_name ?>" size="<?php echo $a7_size ?>" maxlength="<?php echo $a7_maxlength ?>" class="<?php echo $a7_class ?>" value="<?php if (count($errors)==0) echo isset($$a7_name)?$$a7_name:$a7_default ?>" <?php if (in_array($a7_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php unset($a7_name,$a7_default,$a7_class,$a7_size,$a7_maxlength) ?></fieldset></td></tr><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a5_class='act';$a5_colspan='2';$a5_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="act"
 colspan="2"
><?php unset($a5_class,$a5_colspan,$a5_header) ?><?php $a6_type='ok';$a6_class='ok';$a6_value='ok';$a6_text='button_ok'; ?><?php
		if ($this->isEditable() && !$this->isEditMode() && !readonly() )
		{
			$a6_type = ''; // Knopf nicht anzeigen
			?><a class="action" href="<?php echo Html::url($actionName,$subactionName,0,array('mode'=>'edit')) ?>"><span title="<?php echo lang('MODE_EDIT_DESC') ?>"><?php echo langHtml('MODE_EDIT') ?></span></a><?php
		} else
		{
			$a6_type = 'submit';
		}
		$a6_tmp_src  = '';
	if	( !empty($a6_type)) { 
?>
<input type="<?php echo $a6_type ?>"<?php if(isset($a6_src)) { ?> src="<?php $a6_tmp_src ?>"<?php } ?> name="<?php echo $a6_value ?>" class="ok" title="<?php echo lang($a6_text.'_DESC') ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo langHtml($a6_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($a6_src); ?>
<?php }
		if ($this->isEditable() && $this->isEditMode() )
		{
			?><a class="action" href="<?php echo Html::url($actionName,$subactionName,0,array('mode'=>'')) ?>"><span title="<?php echo lang('CANCEL_DESC') ?>"><?php echo langHtml('CANCEL') ?></span></a><?php
		}
?><?php unset($a6_type,$a6_class,$a6_value,$a6_text) ?></td></tr><?php if ($showDuration)
      { ?>
<br/>
<center><small>&nbsp;
<?php $dur = time()-START_TIME;
      echo floor($dur/60).':'.str_pad($dur%60,2,'0',STR_PAD_LEFT); ?></small></center>
<?php } ?>
</form>
<?php $a2_field='act_password'; ?><?php
if (isset($errors[0])) $a2_field = $errors[0];
?><script name="JavaScript" type="text/javascript"><!--
document.forms[0].<?php echo $a2_field ?>.focus();
document.forms[0].<?php echo $a2_field ?>.select();
</script>
<?php unset($a2_field) ?>