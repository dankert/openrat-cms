<?php $a3_name='';$a3_target='_self';$a3_method='post';$a3_enctype='application/x-www-form-urlencoded';$a3_type=''; ?><?php
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
?><?php unset($a3_name,$a3_target,$a3_method,$a3_enctype,$a3_type) ?><?php $a4_name='GLOBAL_PREFS';$a4_widths='30%,70%';$a4_width='93%';$a4_rowclasses='odd,even';$a4_columnclasses='1,2,3'; ?><?php if (false) { ?>
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
<?php } ?><?php unset($a4_name,$a4_widths,$a4_width,$a4_rowclasses,$a4_columnclasses) ?><?php $a5_present='subtype'; ?><?php 
	$a5_tmp_exec = isset($$a5_present);
	$a5_tmp_last_exec = $a5_tmp_exec;
	if	( $a5_tmp_exec )
	{
?>
<?php unset($a5_present) ?><?php
	$column_idx = 0;
?>
<tr
>
<?php $a7_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a7_header) ?><?php $a8_class='text';$a8_text='ELEMENT_SUBTYPE';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_text,$a8_escape,$a8_cut) ?></td><?php $a7_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a7_header) ?><?php $a8_present='subtypes'; ?><?php 
	$a8_tmp_exec = isset($$a8_present);
	$a8_tmp_last_exec = $a8_tmp_exec;
	if	( $a8_tmp_exec )
	{
?>
<?php unset($a8_present) ?><?php $a9_list='subtypes';$a9_name='subtype';$a9_onchange='';$a9_title='';$a9_class='';$a9_addempty=true;$a9_multiple=false;$a9_size='1';$a9_lang=false; ?><?php
$a9_readonly=false;
$a9_tmp_list = $$a9_list;
if ($this->isEditable() && !$this->isEditMode())
{
	echo empty($$a9_name)?'- '.lang('EMPTY').' -':$a9_tmp_list[$$a9_name];
}
else
{
if ( $a9_addempty!==FALSE  )
{
	if ($a9_addempty===TRUE)
		$a9_tmp_list = array(''=>lang('LIST_ENTRY_EMPTY'))+$a9_tmp_list;
	else
		$a9_tmp_list = array(''=>'- '.lang($a9_addempty).' -')+$a9_tmp_list;
}
?><select<?php if ($a9_readonly) echo ' disabled="disabled"' ?> id="id_<?php echo $a9_name ?>"  name="<?php echo $a9_name; if ($a9_multiple) echo '[]'; ?>" onchange="<?php echo $a9_onchange ?>" title="<?php echo $a9_title ?>" class="<?php echo $a9_class ?>"<?php
if (count($$a9_list)<=1) echo ' disabled="disabled"';
if	($a9_multiple) echo ' multiple="multiple"';
if (in_array($a9_name,$errors)) echo ' style="background-color:red; border:2px dashed red;"';
echo ' size="'.intval($a9_size).'"';
?>><?php
		if	( isset($$a9_name) && isset($a9_tmp_list[$$a9_name]) )
			$a9_tmp_default = $$a9_name;
		elseif ( isset($a9_default) )
			$a9_tmp_default = $a9_default;
		else
			$a9_tmp_default = '';
		foreach( $a9_tmp_list as $box_key=>$box_value )
		{
			if	( is_array($box_value) )
			{
				$box_key   = $box_value['key'  ];
				$box_title = $box_value['title'];
				$box_value = $box_value['value'];
			}
			elseif( $a9_lang )
			{
				$box_title = lang( $box_value.'_DESC');
				$box_value = lang( $box_value        );
			}
			else
			{
				$box_title = '';
			}
			echo '<option class="'.$a9_class.'" value="'.$box_key.'" title="'.$box_title.'"';
			if ((string)$box_key==$a9_tmp_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select><?php
if (count($$a9_list)==0) echo '<input type="hidden" name="'.$a9_name.'" value="" />';
if (count($$a9_list)==1) echo '<input type="hidden" name="'.$a9_name.'" value="'.$box_key.'" />';
}
?><?php unset($a9_list,$a9_name,$a9_onchange,$a9_title,$a9_class,$a9_addempty,$a9_multiple,$a9_size,$a9_lang) ?><?php } ?><?php $a8_not=true;$a8_present='subtypes'; ?><?php 
	$a8_tmp_exec = isset($$a8_present);
	$a8_tmp_exec = !$a8_tmp_exec;
	$a8_tmp_last_exec = $a8_tmp_exec;
	if	( $a8_tmp_exec )
	{
?>
<?php unset($a8_not,$a8_present) ?><?php $a9_class='text';$a9_default='';$a9_type='text';$a9_name='subtype';$a9_size='';$a9_maxlength='256';$a9_onchange='';$a9_readonly=false; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a9_readonly=true;
	  if ($a9_readonly && empty($$a9_name)) $$a9_name = '- '.lang('EMPTY').' -';
      if(!isset($a9_default)) $a9_default='';
      $tmp_value = Text::encodeHtml(isset($$a9_name)?$$a9_name:$a9_default);
?><?php if (!$a9_readonly || $a9_type=='hidden') {
?><input<?php if ($a9_readonly) echo ' disabled="true"' ?> id="id_<?php echo $a9_name ?><?php if ($a9_readonly) echo '_disabled' ?>" name="<?php echo $a9_name ?><?php if ($a9_readonly) echo '_disabled' ?>" type="<?php echo $a9_type ?>" maxlength="<?php echo $a9_maxlength ?>" class="<?php echo str_replace(',',' ',$a9_class) ?>" value="<?php echo $tmp_value ?>" <?php if (in_array($a9_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php
if	($a9_readonly) {
?><input type="hidden" id="id_<?php echo $a9_name ?>" name="<?php echo $a9_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subactionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a9_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a9_class,$a9_default,$a9_type,$a9_name,$a9_size,$a9_maxlength,$a9_onchange,$a9_readonly) ?><?php } ?></td></tr><?php } ?><?php $a5_present='with_icon'; ?><?php 
	$a5_tmp_exec = isset($$a5_present);
	$a5_tmp_last_exec = $a5_tmp_exec;
	if	( $a5_tmp_exec )
	{
?>
<?php unset($a5_present) ?><?php
	$column_idx = 0;
?>
<tr
>
<?php $a7_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a7_header) ?><?php $a8_class='text';$a8_text='EL_PROP_WITH_ICON';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_text,$a8_escape,$a8_cut) ?></td><?php $a7_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a7_header) ?><?php $a8_default=false;$a8_readonly=false;$a8_name='with_icon'; ?><?php
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
?><?php unset($a8_name); unset($a8_readonly); unset($a8_default); ?><?php unset($a8_default,$a8_readonly,$a8_name) ?></td></tr><?php } ?><?php $a5_present='all_languages'; ?><?php 
	$a5_tmp_exec = isset($$a5_present);
	$a5_tmp_last_exec = $a5_tmp_exec;
	if	( $a5_tmp_exec )
	{
?>
<?php unset($a5_present) ?><?php
	$column_idx = 0;
?>
<tr
>
<?php $a7_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a7_header) ?><?php $a8_class='text';$a8_text='EL_PROP_ALL_LANGUAGES';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_text,$a8_escape,$a8_cut) ?></td><?php $a7_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a7_header) ?><?php $a8_default=false;$a8_readonly=false;$a8_name='all_languages'; ?><?php
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
?><?php unset($a8_name); unset($a8_readonly); unset($a8_default); ?><?php unset($a8_default,$a8_readonly,$a8_name) ?></td></tr><?php } ?><?php $a5_present='writable'; ?><?php 
	$a5_tmp_exec = isset($$a5_present);
	$a5_tmp_last_exec = $a5_tmp_exec;
	if	( $a5_tmp_exec )
	{
?>
<?php unset($a5_present) ?><?php
	$column_idx = 0;
?>
<tr
>
<?php $a7_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a7_header) ?><?php $a8_class='text';$a8_text='EL_PROP_writable';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_text,$a8_escape,$a8_cut) ?></td><?php $a7_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a7_header) ?><?php $a8_default=false;$a8_readonly=false;$a8_name='writable'; ?><?php
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
?><?php unset($a8_name); unset($a8_readonly); unset($a8_default); ?><?php unset($a8_default,$a8_readonly,$a8_name) ?></td></tr><?php } ?><?php $a5_present='width'; ?><?php 
	$a5_tmp_exec = isset($$a5_present);
	$a5_tmp_last_exec = $a5_tmp_exec;
	if	( $a5_tmp_exec )
	{
?>
<?php unset($a5_present) ?><?php
	$column_idx = 0;
?>
<tr
>
<?php $a7_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a7_header) ?><?php $a8_class='text';$a8_text='width';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_text,$a8_escape,$a8_cut) ?></td><?php $a7_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a7_header) ?><?php $a8_class='text';$a8_default='';$a8_type='text';$a8_name='width';$a8_size='10';$a8_maxlength='256';$a8_onchange='';$a8_readonly=false; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a8_readonly=true;
	  if ($a8_readonly && empty($$a8_name)) $$a8_name = '- '.lang('EMPTY').' -';
      if(!isset($a8_default)) $a8_default='';
      $tmp_value = Text::encodeHtml(isset($$a8_name)?$$a8_name:$a8_default);
?><?php if (!$a8_readonly || $a8_type=='hidden') {
?><input<?php if ($a8_readonly) echo ' disabled="true"' ?> id="id_<?php echo $a8_name ?><?php if ($a8_readonly) echo '_disabled' ?>" name="<?php echo $a8_name ?><?php if ($a8_readonly) echo '_disabled' ?>" type="<?php echo $a8_type ?>" maxlength="<?php echo $a8_maxlength ?>" class="<?php echo str_replace(',',' ',$a8_class) ?>" value="<?php echo $tmp_value ?>" <?php if (in_array($a8_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php
if	($a8_readonly) {
?><input type="hidden" id="id_<?php echo $a8_name ?>" name="<?php echo $a8_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subactionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a8_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a8_class,$a8_default,$a8_type,$a8_name,$a8_size,$a8_maxlength,$a8_onchange,$a8_readonly) ?></td></tr><?php } ?><?php $a5_present='height'; ?><?php 
	$a5_tmp_exec = isset($$a5_present);
	$a5_tmp_last_exec = $a5_tmp_exec;
	if	( $a5_tmp_exec )
	{
?>
<?php unset($a5_present) ?><?php
	$column_idx = 0;
?>
<tr
>
<?php $a7_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a7_header) ?><?php $a8_class='text';$a8_text='height';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_text,$a8_escape,$a8_cut) ?></td><?php $a7_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a7_header) ?><?php $a8_class='text';$a8_default='';$a8_type='text';$a8_name='height';$a8_size='10';$a8_maxlength='256';$a8_onchange='';$a8_readonly=false; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a8_readonly=true;
	  if ($a8_readonly && empty($$a8_name)) $$a8_name = '- '.lang('EMPTY').' -';
      if(!isset($a8_default)) $a8_default='';
      $tmp_value = Text::encodeHtml(isset($$a8_name)?$$a8_name:$a8_default);
?><?php if (!$a8_readonly || $a8_type=='hidden') {
?><input<?php if ($a8_readonly) echo ' disabled="true"' ?> id="id_<?php echo $a8_name ?><?php if ($a8_readonly) echo '_disabled' ?>" name="<?php echo $a8_name ?><?php if ($a8_readonly) echo '_disabled' ?>" type="<?php echo $a8_type ?>" maxlength="<?php echo $a8_maxlength ?>" class="<?php echo str_replace(',',' ',$a8_class) ?>" value="<?php echo $tmp_value ?>" <?php if (in_array($a8_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php
if	($a8_readonly) {
?><input type="hidden" id="id_<?php echo $a8_name ?>" name="<?php echo $a8_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subactionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a8_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a8_class,$a8_default,$a8_type,$a8_name,$a8_size,$a8_maxlength,$a8_onchange,$a8_readonly) ?></td></tr><?php } ?><?php $a5_present='dateformat'; ?><?php 
	$a5_tmp_exec = isset($$a5_present);
	$a5_tmp_last_exec = $a5_tmp_exec;
	if	( $a5_tmp_exec )
	{
?>
<?php unset($a5_present) ?><?php
	$column_idx = 0;
?>
<tr
>
<?php $a7_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a7_header) ?><?php $a8_class='text';$a8_text='EL_PROP_DATEFORMAT';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_text,$a8_escape,$a8_cut) ?></td><?php $a7_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a7_header) ?><?php $a8_list='dateformats';$a8_name='dateformat';$a8_onchange='';$a8_title='';$a8_class='';$a8_addempty=false;$a8_multiple=false;$a8_size='1';$a8_lang=false; ?><?php
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
?><?php unset($a8_list,$a8_name,$a8_onchange,$a8_title,$a8_class,$a8_addempty,$a8_multiple,$a8_size,$a8_lang) ?></td></tr><?php } ?><?php $a5_present='format'; ?><?php 
	$a5_tmp_exec = isset($$a5_present);
	$a5_tmp_last_exec = $a5_tmp_exec;
	if	( $a5_tmp_exec )
	{
?>
<?php unset($a5_present) ?><?php
	$column_idx = 0;
?>
<tr
>
<?php $a7_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a7_header) ?><?php $a8_class='text';$a8_text='EL_PROP_FORMAT';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_text,$a8_escape,$a8_cut) ?></td><?php $a7_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a7_header) ?><?php $a8_list='formatlist';$a8_name='format';$a8_onchange='';$a8_title='';$a8_class=''; ?><?php $a8_tmp_list = $$a8_list;
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
			echo ' />&nbsp;<label for="'.$id.'">'.$box_value.'</label><br />';
		}
?><?php unset($a8_list,$a8_name,$a8_onchange,$a8_title,$a8_class) ?></td></tr><?php } ?><?php $a5_present='decimals'; ?><?php 
	$a5_tmp_exec = isset($$a5_present);
	$a5_tmp_last_exec = $a5_tmp_exec;
	if	( $a5_tmp_exec )
	{
?>
<?php unset($a5_present) ?><?php
	$column_idx = 0;
?>
<tr
>
<?php $a7_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a7_header) ?><?php $a8_class='text';$a8_text='EL_PROP_DECIMALS';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_text,$a8_escape,$a8_cut) ?></td><?php $a7_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a7_header) ?><?php $a8_class='text';$a8_default='';$a8_type='text';$a8_name='decimals';$a8_size='10';$a8_maxlength='2';$a8_onchange='';$a8_readonly=false; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a8_readonly=true;
	  if ($a8_readonly && empty($$a8_name)) $$a8_name = '- '.lang('EMPTY').' -';
      if(!isset($a8_default)) $a8_default='';
      $tmp_value = Text::encodeHtml(isset($$a8_name)?$$a8_name:$a8_default);
?><?php if (!$a8_readonly || $a8_type=='hidden') {
?><input<?php if ($a8_readonly) echo ' disabled="true"' ?> id="id_<?php echo $a8_name ?><?php if ($a8_readonly) echo '_disabled' ?>" name="<?php echo $a8_name ?><?php if ($a8_readonly) echo '_disabled' ?>" type="<?php echo $a8_type ?>" maxlength="<?php echo $a8_maxlength ?>" class="<?php echo str_replace(',',' ',$a8_class) ?>" value="<?php echo $tmp_value ?>" <?php if (in_array($a8_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php
if	($a8_readonly) {
?><input type="hidden" id="id_<?php echo $a8_name ?>" name="<?php echo $a8_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subactionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a8_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a8_class,$a8_default,$a8_type,$a8_name,$a8_size,$a8_maxlength,$a8_onchange,$a8_readonly) ?></td></tr><?php } ?><?php $a5_present='dec_point'; ?><?php 
	$a5_tmp_exec = isset($$a5_present);
	$a5_tmp_last_exec = $a5_tmp_exec;
	if	( $a5_tmp_exec )
	{
?>
<?php unset($a5_present) ?><?php
	$column_idx = 0;
?>
<tr
>
<?php $a7_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a7_header) ?><?php $a8_class='text';$a8_text='EL_PROP_DEC_POINT';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_text,$a8_escape,$a8_cut) ?></td><?php $a7_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a7_header) ?><?php $a8_class='text';$a8_default='';$a8_type='text';$a8_name='dec_point';$a8_size='10';$a8_maxlength='5';$a8_onchange='';$a8_readonly=false; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a8_readonly=true;
	  if ($a8_readonly && empty($$a8_name)) $$a8_name = '- '.lang('EMPTY').' -';
      if(!isset($a8_default)) $a8_default='';
      $tmp_value = Text::encodeHtml(isset($$a8_name)?$$a8_name:$a8_default);
?><?php if (!$a8_readonly || $a8_type=='hidden') {
?><input<?php if ($a8_readonly) echo ' disabled="true"' ?> id="id_<?php echo $a8_name ?><?php if ($a8_readonly) echo '_disabled' ?>" name="<?php echo $a8_name ?><?php if ($a8_readonly) echo '_disabled' ?>" type="<?php echo $a8_type ?>" maxlength="<?php echo $a8_maxlength ?>" class="<?php echo str_replace(',',' ',$a8_class) ?>" value="<?php echo $tmp_value ?>" <?php if (in_array($a8_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php
if	($a8_readonly) {
?><input type="hidden" id="id_<?php echo $a8_name ?>" name="<?php echo $a8_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subactionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a8_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a8_class,$a8_default,$a8_type,$a8_name,$a8_size,$a8_maxlength,$a8_onchange,$a8_readonly) ?></td></tr><?php } ?><?php $a5_present='thousand_sep'; ?><?php 
	$a5_tmp_exec = isset($$a5_present);
	$a5_tmp_last_exec = $a5_tmp_exec;
	if	( $a5_tmp_exec )
	{
?>
<?php unset($a5_present) ?><?php
	$column_idx = 0;
?>
<tr
>
<?php $a7_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a7_header) ?><?php $a8_class='text';$a8_text='EL_PROP_thousand_sep';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_text,$a8_escape,$a8_cut) ?></td><?php $a7_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a7_header) ?><?php $a8_class='text';$a8_default='';$a8_type='text';$a8_name='thousand_sep';$a8_size='10';$a8_maxlength='1';$a8_onchange='';$a8_readonly=false; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a8_readonly=true;
	  if ($a8_readonly && empty($$a8_name)) $$a8_name = '- '.lang('EMPTY').' -';
      if(!isset($a8_default)) $a8_default='';
      $tmp_value = Text::encodeHtml(isset($$a8_name)?$$a8_name:$a8_default);
?><?php if (!$a8_readonly || $a8_type=='hidden') {
?><input<?php if ($a8_readonly) echo ' disabled="true"' ?> id="id_<?php echo $a8_name ?><?php if ($a8_readonly) echo '_disabled' ?>" name="<?php echo $a8_name ?><?php if ($a8_readonly) echo '_disabled' ?>" type="<?php echo $a8_type ?>" maxlength="<?php echo $a8_maxlength ?>" class="<?php echo str_replace(',',' ',$a8_class) ?>" value="<?php echo $tmp_value ?>" <?php if (in_array($a8_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php
if	($a8_readonly) {
?><input type="hidden" id="id_<?php echo $a8_name ?>" name="<?php echo $a8_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subactionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a8_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a8_class,$a8_default,$a8_type,$a8_name,$a8_size,$a8_maxlength,$a8_onchange,$a8_readonly) ?></td></tr><?php } ?><?php $a5_present='default_text'; ?><?php 
	$a5_tmp_exec = isset($$a5_present);
	$a5_tmp_last_exec = $a5_tmp_exec;
	if	( $a5_tmp_exec )
	{
?>
<?php unset($a5_present) ?><?php
	$column_idx = 0;
?>
<tr
>
<?php $a7_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a7_header) ?><?php $a8_class='text';$a8_text='EL_PROP_default_text';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_text,$a8_escape,$a8_cut) ?></td><?php $a7_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a7_header) ?><?php $a8_class='text';$a8_default='';$a8_type='text';$a8_name='default_text';$a8_size='40';$a8_maxlength='255';$a8_onchange='';$a8_readonly=false; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a8_readonly=true;
	  if ($a8_readonly && empty($$a8_name)) $$a8_name = '- '.lang('EMPTY').' -';
      if(!isset($a8_default)) $a8_default='';
      $tmp_value = Text::encodeHtml(isset($$a8_name)?$$a8_name:$a8_default);
?><?php if (!$a8_readonly || $a8_type=='hidden') {
?><input<?php if ($a8_readonly) echo ' disabled="true"' ?> id="id_<?php echo $a8_name ?><?php if ($a8_readonly) echo '_disabled' ?>" name="<?php echo $a8_name ?><?php if ($a8_readonly) echo '_disabled' ?>" type="<?php echo $a8_type ?>" maxlength="<?php echo $a8_maxlength ?>" class="<?php echo str_replace(',',' ',$a8_class) ?>" value="<?php echo $tmp_value ?>" <?php if (in_array($a8_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php
if	($a8_readonly) {
?><input type="hidden" id="id_<?php echo $a8_name ?>" name="<?php echo $a8_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subactionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a8_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a8_class,$a8_default,$a8_type,$a8_name,$a8_size,$a8_maxlength,$a8_onchange,$a8_readonly) ?></td></tr><?php } ?><?php $a5_present='default_longtext'; ?><?php 
	$a5_tmp_exec = isset($$a5_present);
	$a5_tmp_last_exec = $a5_tmp_exec;
	if	( $a5_tmp_exec )
	{
?>
<?php unset($a5_present) ?><?php
	$column_idx = 0;
?>
<tr
>
<?php $a7_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a7_header) ?><?php $a8_class='text';$a8_text='EL_PROP_default_longtext';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_text,$a8_escape,$a8_cut) ?></td><?php $a7_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a7_header) ?><?php $a8_name='default_longtext';$a8_rows='10';$a8_cols='40';$a8_class='inputarea';$a8_default=''; ?><?php if ($this->isEditMode()) {
?><textarea class="<?php echo $a8_class ?>" name="<?php echo $a8_name ?>" rows="<?php echo $a8_rows ?>" cols="<?php echo $a8_cols ?>"><?php echo htmlentities(isset($$a8_name)?$$a8_name:$a8_default) ?></textarea><?php
 } else {
?><span class="<?php echo $a8_class ?>"><?php echo isset($$a8_name)?$$a8_name:$a8_default ?></span><?php } ?><?php unset($a8_name,$a8_rows,$a8_cols,$a8_class,$a8_default) ?></td></tr><?php } ?><?php $a5_present='parameters'; ?><?php 
	$a5_tmp_exec = isset($$a5_present);
	$a5_tmp_last_exec = $a5_tmp_exec;
	if	( $a5_tmp_exec )
	{
?>
<?php unset($a5_present) ?><?php
	$column_idx = 0;
?>
<tr
>
<?php $a7_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a7_header) ?><?php $a8_class='text';$a8_text='EL_PROP_DYNAMIC_PARAMETERS';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_text,$a8_escape,$a8_cut) ?></td><?php $a7_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a7_header) ?><?php $a8_name='parameters';$a8_rows='15';$a8_cols='40';$a8_class='inputarea';$a8_default=''; ?><?php if ($this->isEditMode()) {
?><textarea class="<?php echo $a8_class ?>" name="<?php echo $a8_name ?>" rows="<?php echo $a8_rows ?>" cols="<?php echo $a8_cols ?>"><?php echo htmlentities(isset($$a8_name)?$$a8_name:$a8_default) ?></textarea><?php
 } else {
?><span class="<?php echo $a8_class ?>"><?php echo isset($$a8_name)?$$a8_name:$a8_default ?></span><?php } ?><?php unset($a8_name,$a8_rows,$a8_cols,$a8_class,$a8_default) ?></td></tr><?php
	$column_idx = 0;
?>
<tr
>
<?php $a7_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a7_header) ?></td><?php $a7_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a7_header) ?><?php $a8_list='dynamic_class_parameters';$a8_extract=false;$a8_key='paramName';$a8_value='defaultValue'; ?><?php
	$a8_list_tmp_key   = $a8_key;
	$a8_list_tmp_value = $a8_value;
	$a8_list_extract   = $a8_extract;
	unset($a8_key);
	unset($a8_value);
	if	( !isset($$a8_list) || !is_array($$a8_list) )
		$$a8_list = array();
	foreach( $$a8_list as $$a8_list_tmp_key => $$a8_list_tmp_value )
	{
		if	( $a8_list_extract )
		{
			if	( !is_array($$a8_list_tmp_value) )
			{
				print_r($$a8_list_tmp_value);
				die( 'not an array at key: '.$$a8_list_tmp_key );
			}
			extract($$a8_list_tmp_value);
		}
?><?php unset($a8_list,$a8_extract,$a8_key,$a8_value) ?><?php $a9_class='text';$a9_var='paramName';$a9_escape=true;$a9_cut='both'; ?><?php
		$a9_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a9_class ?>" title="<?php echo $a9_title ?>"><?php
		$langF = $a9_escape?'langHtml':'lang';
		$tmp_text = isset($$a9_var)?$$a9_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a9_class,$a9_var,$a9_escape,$a9_cut) ?><?php $a9_class='text';$a9_raw='_(';$a9_escape=true;$a9_cut='both'; ?><?php
		$a9_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a9_class ?>" title="<?php echo $a9_title ?>"><?php
		$langF = $a9_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a9_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a9_class,$a9_raw,$a9_escape,$a9_cut) ?><?php $a9_class='text';$a9_text='GLOBAL_DEFAULT';$a9_escape=true;$a9_cut='both'; ?><?php
		$a9_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a9_class ?>" title="<?php echo $a9_title ?>"><?php
		$langF = $a9_escape?'langHtml':'lang';
		$tmp_text = $langF($a9_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a9_class,$a9_text,$a9_escape,$a9_cut) ?><?php $a9_class='text';$a9_raw=')_=_';$a9_escape=true;$a9_cut='both'; ?><?php
		$a9_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a9_class ?>" title="<?php echo $a9_title ?>"><?php
		$langF = $a9_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a9_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a9_class,$a9_raw,$a9_escape,$a9_cut) ?><?php $a9_class='text';$a9_var='defaultValue';$a9_escape=true;$a9_cut='both'; ?><?php
		$a9_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a9_class ?>" title="<?php echo $a9_title ?>"><?php
		$langF = $a9_escape?'langHtml':'lang';
		$tmp_text = isset($$a9_var)?$$a9_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a9_class,$a9_var,$a9_escape,$a9_cut) ?><br/><?php } ?></td></tr><?php } ?><?php $a5_present='select_items'; ?><?php 
	$a5_tmp_exec = isset($$a5_present);
	$a5_tmp_last_exec = $a5_tmp_exec;
	if	( $a5_tmp_exec )
	{
?>
<?php unset($a5_present) ?><?php
	$column_idx = 0;
?>
<tr
>
<?php $a7_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a7_header) ?><?php $a8_class='text';$a8_text='EL_PROP_select_items';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_text,$a8_escape,$a8_cut) ?></td><?php $a7_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a7_header) ?><?php $a8_name='select_items';$a8_rows='15';$a8_cols='40';$a8_class='inputarea';$a8_default=''; ?><?php if ($this->isEditMode()) {
?><textarea class="<?php echo $a8_class ?>" name="<?php echo $a8_name ?>" rows="<?php echo $a8_rows ?>" cols="<?php echo $a8_cols ?>"><?php echo htmlentities(isset($$a8_name)?$$a8_name:$a8_default) ?></textarea><?php
 } else {
?><span class="<?php echo $a8_class ?>"><?php echo isset($$a8_name)?$$a8_name:$a8_default ?></span><?php } ?><?php unset($a8_name,$a8_rows,$a8_cols,$a8_class,$a8_default) ?></td></tr><?php } ?><?php $a5_present='linkelement'; ?><?php 
	$a5_tmp_exec = isset($$a5_present);
	$a5_tmp_last_exec = $a5_tmp_exec;
	if	( $a5_tmp_exec )
	{
?>
<?php unset($a5_present) ?><?php
	$column_idx = 0;
?>
<tr
>
<?php $a7_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a7_header) ?><?php $a8_class='text';$a8_text='EL_LINK';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_text,$a8_escape,$a8_cut) ?></td><?php $a7_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a7_header) ?><?php $a8_list='linkelements';$a8_name='linkelement';$a8_onchange='';$a8_title='';$a8_class='';$a8_addempty=false;$a8_multiple=false;$a8_size='1';$a8_lang=false; ?><?php
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
?><?php unset($a8_list,$a8_name,$a8_onchange,$a8_title,$a8_class,$a8_addempty,$a8_multiple,$a8_size,$a8_lang) ?></td></tr><?php } ?><?php $a5_present='name'; ?><?php 
	$a5_tmp_exec = isset($$a5_present);
	$a5_tmp_last_exec = $a5_tmp_exec;
	if	( $a5_tmp_exec )
	{
?>
<?php unset($a5_present) ?><?php
	$column_idx = 0;
?>
<tr
>
<?php $a7_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a7_header) ?><?php $a8_class='text';$a8_text='ELEMENT_NAME';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_text,$a8_escape,$a8_cut) ?></td><?php $a7_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a7_header) ?><?php $a8_list='names';$a8_name='name';$a8_onchange='';$a8_title='';$a8_class='';$a8_addempty=false;$a8_multiple=false;$a8_size='1';$a8_lang=false; ?><?php
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
?><?php unset($a8_list,$a8_name,$a8_onchange,$a8_title,$a8_class,$a8_addempty,$a8_multiple,$a8_size,$a8_lang) ?></td></tr><?php } ?><?php $a5_present='folderobjectid'; ?><?php 
	$a5_tmp_exec = isset($$a5_present);
	$a5_tmp_last_exec = $a5_tmp_exec;
	if	( $a5_tmp_exec )
	{
?>
<?php unset($a5_present) ?><?php
	$column_idx = 0;
?>
<tr
>
<?php $a7_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a7_header) ?><?php $a8_class='text';$a8_text='EL_PROP_DEFAULT_FOLDEROBJECT';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_text,$a8_escape,$a8_cut) ?></td><?php $a7_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a7_header) ?><?php $a8_list='folders';$a8_name='folderobjectid';$a8_onchange='';$a8_title='';$a8_class='';$a8_addempty=false;$a8_multiple=false;$a8_size='1';$a8_lang=false; ?><?php
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
?><?php unset($a8_list,$a8_name,$a8_onchange,$a8_title,$a8_class,$a8_addempty,$a8_multiple,$a8_size,$a8_lang) ?></td></tr><?php } ?><?php $a5_present='default_objectid'; ?><?php 
	$a5_tmp_exec = isset($$a5_present);
	$a5_tmp_last_exec = $a5_tmp_exec;
	if	( $a5_tmp_exec )
	{
?>
<?php unset($a5_present) ?><?php
	$column_idx = 0;
?>
<tr
>
<?php $a7_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a7_header) ?><?php $a8_class='text';$a8_text='EL_PROP_DEFAULT_OBJECT';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_text,$a8_escape,$a8_cut) ?></td><?php $a7_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a7_header) ?><?php $a8_list='objects';$a8_name='default_objectid';$a8_onchange='';$a8_title='';$a8_class='';$a8_addempty=true;$a8_multiple=false;$a8_size='1';$a8_lang=false; ?><?php
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
?><?php unset($a8_list,$a8_name,$a8_onchange,$a8_title,$a8_class,$a8_addempty,$a8_multiple,$a8_size,$a8_lang) ?></td></tr><?php } ?><?php $a5_present='code'; ?><?php 
	$a5_tmp_exec = isset($$a5_present);
	$a5_tmp_last_exec = $a5_tmp_exec;
	if	( $a5_tmp_exec )
	{
?>
<?php unset($a5_present) ?><?php
	$column_idx = 0;
?>
<tr
>
<?php $a7_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a7_header) ?><?php $a8_class='text';$a8_text='EL_PROP_code';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_text,$a8_escape,$a8_cut) ?></td><?php $a7_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a7_header) ?><?php $a8_name='code';$a8_rows='35';$a8_cols='60';$a8_class='inputarea';$a8_default=''; ?><?php if ($this->isEditMode()) {
?><textarea class="<?php echo $a8_class ?>" name="<?php echo $a8_name ?>" rows="<?php echo $a8_rows ?>" cols="<?php echo $a8_cols ?>"><?php echo htmlentities(isset($$a8_name)?$$a8_name:$a8_default) ?></textarea><?php
 } else {
?><span class="<?php echo $a8_class ?>"><?php echo isset($$a8_name)?$$a8_name:$a8_default ?></span><?php } ?><?php unset($a8_name,$a8_rows,$a8_cols,$a8_class,$a8_default) ?></td></tr><?php } ?><?php
	$column_idx = 0;
?>
<tr
>
<?php $a6_class='act';$a6_colspan='2';$a6_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="act"
 colspan="2"
><?php unset($a6_class,$a6_colspan,$a6_header) ?><?php $a7_type='ok';$a7_class='ok';$a7_value='ok';$a7_text='button_ok'; ?><div class="invisible">
<?php
		if ($this->isEditable() && !$this->isEditMode() && !readonly() )
		{
			$a7_type = ''; // Knopf nicht anzeigen
			?><a class="action" href="<?php echo Html::url($actionName,$subactionName,0,array('mode'=>'edit')) ?>"><span title="<?php echo lang('MODE_EDIT_DESC') ?>"><?php echo langHtml('MODE_EDIT') ?></span></a><?php
		} else
		{
			$a7_type = 'submit';
		}
		$a7_tmp_src  = '';
	if	( !empty($a7_type)) { 
?>
<input type="<?php echo $a7_type ?>"<?php if(isset($a7_src)) { ?> src="<?php $a7_tmp_src ?>"<?php } ?> name="<?php echo $a7_value ?>" class="ok" title="<?php echo lang($a7_text.'_DESC') ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo langHtml($a7_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($a7_src); ?>
<?php }
		if ($this->isEditable() && $this->isEditMode() )
		{
			?><a class="action" href="<?php echo Html::url($actionName,$subactionName,0,array('mode'=>'')) ?>"><span title="<?php echo lang('CANCEL_DESC') ?>"><?php echo langHtml('CANCEL') ?></span></a><?php
		}
?>
</div><?php unset($a7_type,$a7_class,$a7_value,$a7_text) ?></td></tr><?php if (false) { ?>
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
<?php $a3_field='name'; ?><script name="JavaScript" type="text/javascript"><!--
</script>
<?php unset($a3_field) ?>