<?php $a3_name='';$a3_target='_top';$a3_method='post';$a3_enctype='application/x-www-form-urlencoded';$a3_type=''; ?><?php
		$a3_action = $actionName;
		$a3_subaction = $targetSubActionName;
		$a3_id = $this->getRequestId();
	if ($this->isEditable())
	{
		if	($this->isEditMode())
		{
			$a3_method    = 'POST';
		}
		else
		{
			$a3_method    = 'GET';
			$a3_subaction = $subActionName;
		}
	}
	switch( $a3_type )
	{
		case 'upload':
			$a3_tmp_submitFunction = '';
			break;
		default:
			$a3_tmp_submitFunction = 'formSubmit( $(this) ); return false;';
	}
?><form name="<?php echo $a3_name ?>"
      target="<?php echo $a3_target ?>"
      action="<?php echo Html::url( $a3_action,$a3_subaction,$a3_id ) ?>"
      method="<?php echo $a3_method ?>"
      enctype="<?php echo $a3_enctype ?>" style="margin:0px;padding:0px;"
      class="<?php echo $a3_action ?>"
      onSubmit="<?php echo $a3_tmp_submitFunction ?>"><input type="submit" class="invisible" />
<?php if ($this->isEditable() && !$this->isEditMode()) { ?>
<input type="hidden" name="mode" value="edit" />
<?php } ?>
<input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo $this->actionName ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo $this->subActionName ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo $this->getRequestId() ?>" /><?php
		if	( $conf['interface']['url_sessionid'] )
			echo '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";
?><?php unset($a3_name,$a3_target,$a3_method,$a3_enctype,$a3_type) ?><?php $a4_title='GLOBAL_CHOOSE';$a4_name='login';$a4_icon='user';$a4_width='400';$a4_rowclasses='fx1,fx2';$a4_columnclasses='x,y'; ?><?php if (false) { ?>
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
<?php } ?><?php unset($a4_title,$a4_name,$a4_icon,$a4_width,$a4_rowclasses,$a4_columnclasses) ?><?php
	$column_idx = 0;
?>
<tr
>
<?php $a6_class='logo';$a6_colspan='2';$a6_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="logo"
 colspan="2"
><?php unset($a6_class,$a6_colspan,$a6_header) ?><?php $a7_name='changepassword'; ?><img src="<?php echo $image_dir.'logo_'.$a7_name.IMG_ICON_EXT ?>" border="0" align="left" /><h2 class="logo"><?php echo langHtml('logo_'.$a7_name) ?></h2><p class="logo"><?php echo langHtml('logo_'.$a7_name.'_text') ?></p><?php unset($a7_name) ?></td><?php
	$column_idx = 0;
?>
<tr
>
<?php $a7_width='50%';$a7_header=false; ?><?php $column_idx++; ?><td
 width="50%"
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a7_width,$a7_header) ?><?php $a8_class='text';$a8_text='USER_PASSWORD';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_text,$a8_escape,$a8_cut) ?></td><?php $a7_width='50%';$a7_header=false; ?><?php $column_idx++; ?><td
 width="50%"
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a7_width,$a7_header) ?><?php $a8_name='password_old';$a8_default='';$a8_class='';$a8_size='25';$a8_maxlength='256'; ?><input type="password" name="<?php echo $a8_name ?>"  id="id_<?php echo $a8_name ?>" size="<?php echo $a8_size ?>" maxlength="<?php echo $a8_maxlength ?>" class="<?php echo $a8_class ?>" value="<?php if (count($errors)==0) echo isset($$a8_name)?$$a8_name:$a8_default ?>" <?php if (in_array($a8_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php unset($a8_name,$a8_default,$a8_class,$a8_size,$a8_maxlength) ?></td></tr><?php
	$column_idx = 0;
?>
<tr
>
<?php $a7_width='50%';$a7_header=false; ?><?php $column_idx++; ?><td
 width="50%"
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a7_width,$a7_header) ?><?php $a8_class='text';$a8_text='USER_NEW_PASSWORD';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_text,$a8_escape,$a8_cut) ?></td><?php $a7_width='50%';$a7_header=false; ?><?php $column_idx++; ?><td
 width="50%"
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a7_width,$a7_header) ?><?php $a8_name='password_new_1';$a8_default='';$a8_class='';$a8_size='25';$a8_maxlength='256'; ?><input type="password" name="<?php echo $a8_name ?>"  id="id_<?php echo $a8_name ?>" size="<?php echo $a8_size ?>" maxlength="<?php echo $a8_maxlength ?>" class="<?php echo $a8_class ?>" value="<?php if (count($errors)==0) echo isset($$a8_name)?$$a8_name:$a8_default ?>" <?php if (in_array($a8_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php unset($a8_name,$a8_default,$a8_class,$a8_size,$a8_maxlength) ?></td></tr><?php
	$column_idx = 0;
?>
<tr
>
<?php $a7_width='50%';$a7_header=false; ?><?php $column_idx++; ?><td
 width="50%"
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a7_width,$a7_header) ?><?php $a8_class='text';$a8_text='USER_NEW_PASSWORD_REPEAT';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_text,$a8_escape,$a8_cut) ?></td><?php $a7_width='50%';$a7_header=false; ?><?php $column_idx++; ?><td
 width="50%"
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a7_width,$a7_header) ?><?php $a8_name='password_new_2';$a8_default='';$a8_class='';$a8_size='25';$a8_maxlength='256'; ?><input type="password" name="<?php echo $a8_name ?>"  id="id_<?php echo $a8_name ?>" size="<?php echo $a8_size ?>" maxlength="<?php echo $a8_maxlength ?>" class="<?php echo $a8_class ?>" value="<?php if (count($errors)==0) echo isset($$a8_name)?$$a8_name:$a8_default ?>" <?php if (in_array($a8_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php unset($a8_name,$a8_default,$a8_class,$a8_size,$a8_maxlength) ?></td></tr><?php
	$column_idx = 0;
?>
<tr
>
<?php $a7_class='act';$a7_colspan='2';$a7_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="act"
 colspan="2"
><?php unset($a7_class,$a7_colspan,$a7_header) ?><?php $a8_type='ok';$a8_class='ok';$a8_value='ok';$a8_text='button_ok'; ?><div class="invisible">
<?php
		if ($this->isEditable() && !$this->isEditMode() && !readonly() )
		{
			$a8_type = ''; // Knopf nicht anzeigen
			?><a class="action" href="<?php echo Html::url($actionName,$subactionName,0,array('mode'=>'edit')) ?>"><span title="<?php echo lang('MODE_EDIT_DESC') ?>"><?php echo langHtml('MODE_EDIT') ?></span></a><?php
		} else
		{
			$a8_type = 'submit';
		}
		$a8_tmp_src  = '';
	if	( !empty($a8_type)) { 
?>
<input type="<?php echo $a8_type ?>"<?php if(isset($a8_src)) { ?> src="<?php $a8_tmp_src ?>"<?php } ?> name="<?php echo $a8_value ?>" class="ok" title="<?php echo lang($a8_text.'_DESC') ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo langHtml($a8_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($a8_src); ?>
<?php }
		if ($this->isEditable() && $this->isEditMode() )
		{
			?><a class="action" href="<?php echo Html::url($actionName,$subactionName,0,array('mode'=>'')) ?>"><span title="<?php echo lang('CANCEL_DESC') ?>"><?php echo langHtml('CANCEL') ?></span></a><?php
		}
?>
</div><?php unset($a8_type,$a8_class,$a8_value,$a8_text) ?></td></tr></tr><?php if (false) { ?>
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
<?php $a3_field='password_old'; ?><script name="JavaScript" type="text/javascript"><!--
</script>
<?php unset($a3_field) ?>