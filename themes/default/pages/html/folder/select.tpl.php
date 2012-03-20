<?php $a3_action='folder';$a3_subaction='multiple';$a3_name='';$a3_target='_self';$a3_method='post';$a3_enctype='application/x-www-form-urlencoded';$a3_type=''; ?><?php
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
?><?php unset($a3_action,$a3_subaction,$a3_name,$a3_target,$a3_method,$a3_enctype,$a3_type) ?><?php $a4_name='ids'; ?><?php
if (isset($$a4_name))
	$a4_tmp_value = $$a4_name;
elseif ( isset($a4_default) )
	$a4_tmp_value = $a4_default;
else
	$a4_tmp_value = "";
?><input type="hidden" name="<?php echo $a4_name ?>" value="<?php echo $a4_tmp_value ?>" /><?php unset($a4_name) ?><?php $a4_name='type'; ?><?php
if (isset($$a4_name))
	$a4_tmp_value = $$a4_name;
elseif ( isset($a4_default) )
	$a4_tmp_value = $a4_default;
else
	$a4_tmp_value = "";
?><input type="hidden" name="<?php echo $a4_name ?>" value="<?php echo $a4_tmp_value ?>" /><?php unset($a4_name) ?><?php $a4_width='93%';$a4_rowclasses='odd,even';$a4_columnclasses='1,2,3'; ?><?php if (false) { ?>
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
<?php } ?><?php unset($a4_width,$a4_rowclasses,$a4_columnclasses) ?><?php $a5_width='100%';$a5_space='0px';$a5_padding='0px'; ?><?php
	$last_column_idx = @$column_idx;
	$column_idx = 0;
	$coloumn_widths = array();
	$row_classes    = array();
	$column_classes = array();
?><table class="%class%" cellspacing="0px" width="100%" cellpadding="0px">
<?php unset($a5_width,$a5_space,$a5_padding) ?><?php
	$column_idx = 0;
?>
<tr
>
<?php $a7_class='help';$a7_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="help"
><?php unset($a7_class,$a7_header) ?><?php $a8_class='text';$a8_raw='_';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a8_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_raw,$a8_escape,$a8_cut) ?></td><?php $a7_class='help';$a7_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="help"
><?php unset($a7_class,$a7_header) ?><?php $a8_class='text';$a8_text='GLOBAL_NAME';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_text,$a8_escape,$a8_cut) ?></td></tr><?php $a6_list='objectlist';$a6_extract=true;$a6_key='list_key';$a6_value='list_value'; ?><?php
	$a6_list_tmp_key   = $a6_key;
	$a6_list_tmp_value = $a6_value;
	$a6_list_extract   = $a6_extract;
	unset($a6_key);
	unset($a6_value);
	if	( !isset($$a6_list) || !is_array($$a6_list) )
		$$a6_list = array();
	foreach( $$a6_list as $$a6_list_tmp_key => $$a6_list_tmp_value )
	{
		if	( $a6_list_extract )
		{
			if	( !is_array($$a6_list_tmp_value) )
			{
				print_r($$a6_list_tmp_value);
				die( 'not an array at key: '.$$a6_list_tmp_key );
			}
			extract($$a6_list_tmp_value);
		}
?><?php unset($a6_list,$a6_extract,$a6_key,$a6_value) ?><?php $a7_class='data'; ?><?php
	$column_idx = 0;
?>
<tr
 class="data"
>
<?php unset($a7_class) ?><?php $a8_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a8_header) ?><?php $a9_icon=$type;$a9_align='left'; ?><?php
	$a9_tmp_image_file = $image_dir.'icon_'.$a9_icon.IMG_ICON_EXT;
	$a9_size = '16x16';
	$a9_tmp_title = basename($a9_tmp_image_file);
?><img alt="<?php echo $a9_tmp_title; if (isset($a9_size)) { echo ' ('; list($a9_tmp_width,$a9_tmp_height)=explode('x',$a9_size);echo $a9_tmp_width.'x'.$a9_tmp_height; echo')';} ?>" src="<?php echo $a9_tmp_image_file ?>" border="0"<?php if(isset($a9_align)) echo ' align="'.$a9_align.'"' ?><?php if (isset($a9_size)) { list($a9_tmp_width,$a9_tmp_height)=explode('x',$a9_size);echo ' width="'.$a9_tmp_width.'" height="'.$a9_tmp_height.'"';} ?> /><?php unset($a9_icon,$a9_align) ?></td><?php $a8_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a8_header) ?><?php $a9_class='text';$a9_var='name';$a9_escape=true;$a9_cut='both'; ?><?php
		$a9_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a9_class ?>" title="<?php echo $a9_title ?>"><?php
		$langF = $a9_escape?'langHtml':'lang';
		$tmp_text = isset($$a9_var)?$$a9_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a9_class,$a9_var,$a9_escape,$a9_cut) ?><?php $a9_class='text';$a9_raw='_';$a9_escape=true;$a9_cut='both'; ?><?php
		$a9_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a9_class ?>" title="<?php echo $a9_title ?>"><?php
		$langF = $a9_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a9_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a9_class,$a9_raw,$a9_escape,$a9_cut) ?></td></tr><?php } ?><?php $a6_present='folder'; ?><?php 
	$a6_tmp_exec = isset($$a6_present);
	$a6_tmp_last_exec = $a6_tmp_exec;
	if	( $a6_tmp_exec )
	{
?>
<?php unset($a6_present) ?><?php
	$column_idx = 0;
?>
<tr
>
<?php $a8_colspan='2';$a8_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
 colspan="2"
><?php unset($a8_colspan,$a8_header) ?><?php $a9_title=lang('folder_select_target_folder'); ?><fieldset><?php if(isset($a9_title)) { ?><legend><?php if(isset($a9_icon)) { ?><img src="<?php echo $image_dir.'icon_'.$a9_icon.IMG_ICON_EXT ?>" align="left" border="0" /><?php } ?>&nbsp;&nbsp;<?php echo encodeHtml($a9_title) ?>&nbsp;&nbsp;</legend><?php } ?><?php unset($a9_title) ?></fieldset></td></tr><?php $a7_list='folder';$a7_extract=false;$a7_key='list_key';$a7_value='list_value'; ?><?php
	$a7_list_tmp_key   = $a7_key;
	$a7_list_tmp_value = $a7_value;
	$a7_list_extract   = $a7_extract;
	unset($a7_key);
	unset($a7_value);
	if	( !isset($$a7_list) || !is_array($$a7_list) )
		$$a7_list = array();
	foreach( $$a7_list as $$a7_list_tmp_key => $$a7_list_tmp_value )
	{
		if	( $a7_list_extract )
		{
			if	( !is_array($$a7_list_tmp_value) )
			{
				print_r($$a7_list_tmp_value);
				die( 'not an array at key: '.$$a7_list_tmp_key );
			}
			extract($$a7_list_tmp_value);
		}
?><?php unset($a7_list,$a7_extract,$a7_key,$a7_value) ?><?php $a8_class='data'; ?><?php
	$column_idx = 0;
?>
<tr
 class="data"
>
<?php unset($a8_class) ?><?php $a9_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a9_header) ?><?php $a10_readonly=false;$a10_name='targetobjectid';$a10_value=$list_key;$a10_default=false;$a10_prefix='';$a10_suffix='';$a10_class='';$a10_onchange=''; ?><?php
		if ($this->isEditable() && !$this->isEditMode()) $a10_readonly=true;
		if	( isset($$a10_name)  )
			$a10_tmp_default = $$a10_name;
		elseif ( isset($a10_default) )
			$a10_tmp_default = $a10_default;
		else
			$a10_tmp_default = '';
 ?><input onclick="" class="radio" type="radio" id="id_<?php echo $a10_name.'_'.$a10_value ?>"  name="<?php echo $a10_prefix.$a10_name ?>"<?php if ( $a10_readonly ) echo ' disabled="disabled"' ?> value="<?php echo $a10_value ?>" <?php if($a10_value==$a10_tmp_default) echo 'checked="checked"' ?><?php if (in_array($a10_name,$errors)) echo ' style="borderx:2px dashed red; background-color:red;"' ?> />
<?php /* #END-IF# */ ?><?php unset($a10_readonly,$a10_name,$a10_value,$a10_default,$a10_prefix,$a10_suffix,$a10_class,$a10_onchange) ?></td><?php $a9_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a9_header) ?><?php $a10_for='targetobjectid_'.$list_key.''; ?><label<?php if (isset($a10_for)) { ?> for="id_<?php echo $a10_for ?><?php if (!empty($a10_value)) echo '_'.$a10_value ?>" class="label"<?php } ?>>
<?php if (isset($a10_key)) { echo lang($a10_key); if(hasLang($a10_key.'_desc')) { ?><div class="description"><?php echo lang($a10_key.'_desc')?></div> <?php } } ?><?php unset($a10_for) ?><?php $a11_class='text';$a11_var='list_value';$a11_escape=true;$a11_cut='both'; ?><?php
		$a11_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = isset($$a11_var)?$$a11_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_var,$a11_escape,$a11_cut) ?></label></td></tr><?php } ?><?php } ?><?php $a6_present='ask_filename'; ?><?php 
	$a6_tmp_exec = isset($$a6_present);
	$a6_tmp_last_exec = $a6_tmp_exec;
	if	( $a6_tmp_exec )
	{
?>
<?php unset($a6_present) ?><?php
	$column_idx = 0;
?>
<tr
>
<?php $a8_colspan='2';$a8_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
 colspan="2"
><?php unset($a8_colspan,$a8_header) ?><?php $a9_class='text';$a9_default='';$a9_type='text';$a9_name='filename';$a9_size='';$a9_maxlength='256';$a9_onchange='';$a9_readonly=false; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a9_readonly=true;
	  if ($a9_readonly && empty($$a9_name)) $$a9_name = '- '.lang('EMPTY').' -';
      if(!isset($a9_default)) $a9_default='';
      $tmp_value = Text::encodeHtml(isset($$a9_name)?$$a9_name:$a9_default);
?><?php if (!$a9_readonly || $a9_type=='hidden') {
?><input<?php if ($a9_readonly) echo ' disabled="true"' ?> id="id_<?php echo $a9_name ?><?php if ($a9_readonly) echo '_disabled' ?>" name="<?php echo $a9_name ?><?php if ($a9_readonly) echo '_disabled' ?>" type="<?php echo $a9_type ?>" maxlength="<?php echo $a9_maxlength ?>" class="<?php echo str_replace(',',' ',$a9_class) ?>" value="<?php echo $tmp_value ?>" <?php if (in_array($a9_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php
if	($a9_readonly) {
?><input type="hidden" id="id_<?php echo $a9_name ?>" name="<?php echo $a9_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subactionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a9_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a9_class,$a9_default,$a9_type,$a9_name,$a9_size,$a9_maxlength,$a9_onchange,$a9_readonly) ?></td></tr><?php } ?><?php $a6_present='ask_commit'; ?><?php 
	$a6_tmp_exec = isset($$a6_present);
	$a6_tmp_last_exec = $a6_tmp_exec;
	if	( $a6_tmp_exec )
	{
?>
<?php unset($a6_present) ?><?php
	$column_idx = 0;
?>
<tr
>
<?php $a8_colspan='2';$a8_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
 colspan="2"
><?php unset($a8_colspan,$a8_header) ?><?php $a9_title=lang('options'); ?><fieldset><?php if(isset($a9_title)) { ?><legend><?php if(isset($a9_icon)) { ?><img src="<?php echo $image_dir.'icon_'.$a9_icon.IMG_ICON_EXT ?>" align="left" border="0" /><?php } ?>&nbsp;&nbsp;<?php echo encodeHtml($a9_title) ?>&nbsp;&nbsp;</legend><?php } ?><?php unset($a9_title) ?><?php $a10_default=false;$a10_readonly=false;$a10_name='commit'; ?><?php
	if ($this->isEditable() && !$this->isEditMode()) $a10_readonly=true;
	if	( isset($$a10_name) )
		$checked = $$a10_name;
	else
		$checked = $a10_default;
?><input class="checkbox" type="checkbox" id="id_<?php echo $a10_name ?>" name="<?php echo $a10_name  ?>"  <?php if ($a10_readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?><?php if (in_array($a10_name,$errors)) echo ' style="background-color:red;"' ?> /><?php
if ( $a10_readonly && $checked )
{ 
?><input type="hidden" name="<?php echo $a10_name ?>" value="1" /><?php
}
?><?php unset($a10_name); unset($a10_readonly); unset($a10_default); ?><?php unset($a10_default,$a10_readonly,$a10_name) ?><?php $a10_for='commit'; ?><label<?php if (isset($a10_for)) { ?> for="id_<?php echo $a10_for ?><?php if (!empty($a10_value)) echo '_'.$a10_value ?>" class="label"<?php } ?>>
<?php if (isset($a10_key)) { echo lang($a10_key); if(hasLang($a10_key.'_desc')) { ?><div class="description"><?php echo lang($a10_key.'_desc')?></div> <?php } } ?><?php unset($a10_for) ?><?php $a11_class='text';$a11_key='FOLDER_SELECT_DELETE_COMMIT';$a11_escape=true;$a11_cut='both'; ?><?php
		$a11_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = $langF($a11_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_key,$a11_escape,$a11_cut) ?></label></fieldset></td></tr><?php } ?><?php
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
</div><?php unset($a8_type,$a8_class,$a8_value,$a8_text) ?></td></tr><?php
	$column_idx = $last_column_idx;
?>
</table><?php if (false) { ?>
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
