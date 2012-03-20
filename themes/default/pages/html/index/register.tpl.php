<?php $a1_class='main'; ?><?php unset($a1_class) ?><?php $a2_name='';$a2_target='_top';$a2_method='post';$a2_enctype='application/x-www-form-urlencoded'; ?><?php
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
?><?php unset($a2_name,$a2_target,$a2_method,$a2_enctype) ?><?php $a3_title='GLOBAL_REGISTER';$a3_name='login';$a3_icon='user';$a3_width='400';$a3_rowclasses='odd,even';$a3_columnclasses='x'; ?><div class="breadcrumb">
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
<?php unset($a3_title,$a3_name,$a3_icon,$a3_width,$a3_rowclasses,$a3_columnclasses) ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a5_class='logo';$a5_colspan='2'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="logo"
 colspan="2"
><?php unset($a5_class,$a5_colspan) ?><?php $a6_name='register'; ?><img src="<?php echo $image_dir.'logo_'.$a6_name.IMG_ICON_EXT ?>" border="0" align="left"><h2 class="logo"><?php echo langHtml('logo_'.$a6_name) ?></h2><p class="logo"><?php echo langHtml('logo_'.$a6_name.'_text') ?></p><?php unset($a6_name) ?></td><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a6_width='50%'; ?><?php $column_idx++; ?><td
 width="50%"
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a6_width) ?><?php $a7_class='text';$a7_text='USER_MAIL';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_text,$a7_escape,$a7_cut) ?></td><?php $a6_width='50%'; ?><?php $column_idx++; ?><td
 width="50%"
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a6_width) ?><?php $a7_class='text';$a7_default='';$a7_type='text';$a7_name='mail';$a7_size='25';$a7_maxlength='256';$a7_onchange='';$a7_readonly=false; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a7_readonly=true;
	  if ($a7_readonly && empty($$a7_name)) $$a7_name = '- '.lang('EMPTY').' -';
      if(!isset($a7_default)) $a7_default='';
      $tmp_value = Text::encodeHtml(isset($$a7_name)?$$a7_name:$a7_default);
?><?php if (!$a7_readonly || $a7_type=='hidden') {
?><input<?php if ($a7_readonly) echo ' disabled="true"' ?> id="id_<?php echo $a7_name ?><?php if ($a7_readonly) echo '_disabled' ?>" name="<?php echo $a7_name ?><?php if ($a7_readonly) echo '_disabled' ?>" type="<?php echo $a7_type ?>" size="<?php echo $a7_size ?>" maxlength="<?php echo $a7_maxlength ?>" class="<?php echo $a7_class ?>" value="<?php echo $tmp_value ?>" <?php if (in_array($a7_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php
if	($a7_readonly) {
?><input type="hidden" id="id_<?php echo $a7_name ?>" name="<?php echo $a7_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a href="<?php echo Html::url('','',0,array('mode'=>'edit')) ?>"><span class="<?php echo $a7_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a7_class,$a7_default,$a7_type,$a7_name,$a7_size,$a7_maxlength,$a7_onchange,$a7_readonly) ?></td></tr><?php
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
><?php unset($a6_class,$a6_colspan) ?><?php $a7_type='ok';$a7_class='ok';$a7_value='ok';$a7_text='button_next'; ?><?php
		if ($this->isEditable() && !$this->isEditMode())
		$a7_text = 'MODE_EDIT';
		$a7_type = 'submit';
		if	( $this->isEditable() && readonly() )
			$a7_type = ''; // Knopf nicht anzeigen
		$a7_src  = '';
	if	( !empty($a7_type) ) {
?><input type="<?php echo $a7_type ?>"<?php if(isset($a7_src)) { ?> src="<?php echo $image_dir.'icon_'.$a7_src.IMG_ICON_EXT ?>"<?php } ?> name="<?php echo $a7_value ?>" class="ok" title="<?php echo lang($a7_text.'_DESC') ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo langHtml($a7_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($a7_src)
?><?php } 
?><?php unset($a7_type,$a7_class,$a7_value,$a7_text) ?></td></tr></tr>      </table>
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
</form>
<?php $a2_field='mail'; ?><?php
if (isset($errors[0])) $a2_field = $errors[0];
?><script name="JavaScript" type="text/javascript"><!--
document.forms[0].<?php echo $a2_field ?>.focus();
document.forms[0].<?php echo $a2_field ?>.select();
</script>
<?php unset($a2_field) ?>