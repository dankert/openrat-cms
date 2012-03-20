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
?><?php unset($a3_name,$a3_target,$a3_method,$a3_enctype,$a3_type) ?><?php $a4_width='93%';$a4_rowclasses='odd,even';$a4_columnclasses='1,2,3'; ?><?php if (false) { ?>
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
<?php unset($a5_width,$a5_space,$a5_padding) ?><?php $a6_empty='el'; ?><?php 
	if	( !isset($$a6_empty) )
		$a6_tmp_exec = empty($a6_empty);
	elseif	( is_array($$a6_empty) )
		$a6_tmp_exec = (count($$a6_empty)==0);
	elseif	( is_bool($$a6_empty) )
		$a6_tmp_exec = true;
	else
		$a6_tmp_exec = empty( $$a6_empty );
	$a6_tmp_last_exec = $a6_tmp_exec;
	if	( $a6_tmp_exec )
	{
?>
<?php unset($a6_empty) ?><?php
	$column_idx = 0;
?>
<tr
>
<?php $a8_colspan='4';$a8_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
 colspan="4"
><?php unset($a8_colspan,$a8_header) ?><?php $a9_class='text';$a9_text='GLOBAL_NOT_FOUND';$a9_escape=true;$a9_cut='both'; ?><?php
		$a9_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a9_class ?>" title="<?php echo $a9_title ?>"><?php
		$langF = $a9_escape?'langHtml':'lang';
		$tmp_text = $langF($a9_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a9_class,$a9_text,$a9_escape,$a9_cut) ?></td></tr><?php } ?><?php $a6_not='';$a6_empty='el'; ?><?php 
	if	( !isset($$a6_empty) )
		$a6_tmp_exec = empty($a6_empty);
	elseif	( is_array($$a6_empty) )
		$a6_tmp_exec = (count($$a6_empty)==0);
	elseif	( is_bool($$a6_empty) )
		$a6_tmp_exec = true;
	else
		$a6_tmp_exec = empty( $$a6_empty );
	$a6_tmp_exec = !$a6_tmp_exec;
	$a6_tmp_last_exec = $a6_tmp_exec;
	if	( $a6_tmp_exec )
	{
?>
<?php unset($a6_not,$a6_empty) ?><?php
	$column_idx = 0;
?>
<tr
>
<?php $a8_class='help';$a8_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="help"
><?php unset($a8_class,$a8_header) ?><?php $a9_class='text';$a9_text='PAGE_ELEMENT_NAME';$a9_escape=true;$a9_cut='both'; ?><?php
		$a9_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a9_class ?>" title="<?php echo $a9_title ?>"><?php
		$langF = $a9_escape?'langHtml':'lang';
		$tmp_text = $langF($a9_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a9_class,$a9_text,$a9_escape,$a9_cut) ?></td><?php $a8_class='help';$a8_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="help"
><?php unset($a8_class,$a8_header) ?><?php $a9_class='text';$a9_text='GLOBAL_CHANGE';$a9_escape=true;$a9_cut='both'; ?><?php
		$a9_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a9_class ?>" title="<?php echo $a9_title ?>"><?php
		$langF = $a9_escape?'langHtml':'lang';
		$tmp_text = $langF($a9_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a9_class,$a9_text,$a9_escape,$a9_cut) ?></td><?php $a8_class='help';$a8_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="help"
><?php unset($a8_class,$a8_header) ?><?php $a9_class='text';$a9_text='GLOBAL_VALUE';$a9_escape=true;$a9_cut='both'; ?><?php
		$a9_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a9_class ?>" title="<?php echo $a9_title ?>"><?php
		$langF = $a9_escape?'langHtml':'lang';
		$tmp_text = $langF($a9_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a9_class,$a9_text,$a9_escape,$a9_cut) ?></td></tr><?php $a7_list='el';$a7_extract=true;$a7_key='list_key';$a7_value='list_value'; ?><?php
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
><?php unset($a9_header) ?><?php $a10_for=$saveid; ?><label<?php if (isset($a10_for)) { ?> for="id_<?php echo $a10_for ?><?php if (!empty($a10_value)) echo '_'.$a10_value ?>" class="label"<?php } ?>>
<?php if (isset($a10_key)) { echo lang($a10_key); if(hasLang($a10_key.'_desc')) { ?><div class="description"><?php echo lang($a10_key.'_desc')?></div> <?php } } ?><?php unset($a10_for) ?><?php $a11_align='left';$a11_elementtype=$type; ?><?php
	$a11_tmp_image_file = $image_dir.'icon_el_'.$a11_elementtype.IMG_ICON_EXT;
	$a11_size           = '16x16';
	$a11_tmp_title = basename($a11_tmp_image_file);
?><img alt="<?php echo $a11_tmp_title; if (isset($a11_size)) { echo ' ('; list($a11_tmp_width,$a11_tmp_height)=explode('x',$a11_size);echo $a11_tmp_width.'x'.$a11_tmp_height; echo')';} ?>" src="<?php echo $a11_tmp_image_file ?>" border="0"<?php if(isset($a11_align)) echo ' align="'.$a11_align.'"' ?><?php if (isset($a11_size)) { list($a11_tmp_width,$a11_tmp_height)=explode('x',$a11_size);echo ' width="'.$a11_tmp_width.'" height="'.$a11_tmp_height.'"';} ?> /><?php unset($a11_align,$a11_elementtype) ?><?php $a11_class='text';$a11_var='name';$a11_escape=true;$a11_cut='both'; ?><?php
		$a11_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = isset($$a11_var)?$$a11_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_var,$a11_escape,$a11_cut) ?></label></td><?php $a9_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a9_header) ?><?php $a10_default=false;$a10_readonly=false;$a10_name=$saveid; ?><?php
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
?><?php unset($a10_name); unset($a10_readonly); unset($a10_default); ?><?php unset($a10_default,$a10_readonly,$a10_name) ?></td><?php $a9_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a9_header) ?><?php $a10_value=$type;$a10_contains='text,date,number'; ?><?php 
	$a10_tmp_exec = in_array($a10_value,explode(',',$a10_contains));
	$a10_tmp_last_exec = $a10_tmp_exec;
	if	( $a10_tmp_exec )
	{
?>
<?php unset($a10_value,$a10_contains) ?><?php $a11_class='text';$a11_default=$value;$a11_type='text';$a11_index=true;$a11_name=$id;$a11_size='40';$a11_maxlength='255';$a11_onchange='onchange';$a11_readonly=false; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a11_readonly=true;
	  if ($a11_readonly && empty($$a11_name)) $$a11_name = '- '.lang('EMPTY').' -';
      if(!isset($a11_default)) $a11_default='';
      $tmp_value = Text::encodeHtml(isset($$a11_name)?$$a11_name:$a11_default);
?><?php if (!$a11_readonly || $a11_type=='hidden') {
?><input<?php if ($a11_readonly) echo ' disabled="true"' ?> id="id_<?php echo $a11_name ?><?php if ($a11_readonly) echo '_disabled' ?>" name="<?php echo $a11_name ?><?php if ($a11_readonly) echo '_disabled' ?>" type="<?php echo $a11_type ?>" maxlength="<?php echo $a11_maxlength ?>" class="<?php echo str_replace(',',' ',$a11_class) ?>" value="<?php echo $tmp_value ?>" <?php if (in_array($a11_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php
if	($a11_readonly) {
?><input type="hidden" id="id_<?php echo $a11_name ?>" name="<?php echo $a11_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subactionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a11_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a11_class,$a11_default,$a11_type,$a11_index,$a11_name,$a11_size,$a11_maxlength,$a11_onchange,$a11_readonly) ?><?php } ?><?php $a10_equals='longtext';$a10_value=$type; ?><?php 
	$a10_tmp_exec = $a10_equals == $a10_value;
	$a10_tmp_last_exec = $a10_tmp_exec;
	if	( $a10_tmp_exec )
	{
?>
<?php unset($a10_equals,$a10_value) ?><?php $a11_name=$id;$a11_rows='7';$a11_cols='50';$a11_index=true;$a11_onchange='onchange';$a11_class='inputarea';$a11_default=$value; ?><?php if ($this->isEditMode()) {
?><textarea class="<?php echo $a11_class ?>" name="<?php echo $a11_name ?>" rows="<?php echo $a11_rows ?>" cols="<?php echo $a11_cols ?>"><?php echo htmlentities(isset($$a11_name)?$$a11_name:$a11_default) ?></textarea><?php
 } else {
?><span class="<?php echo $a11_class ?>"><?php echo isset($$a11_name)?$$a11_name:$a11_default ?></span><?php } ?><?php unset($a11_name,$a11_rows,$a11_cols,$a11_index,$a11_onchange,$a11_class,$a11_default) ?><?php } ?><?php $a10_value=$type;$a10_contains='select,link,list'; ?><?php 
	$a10_tmp_exec = in_array($a10_value,explode(',',$a10_contains));
	$a10_tmp_last_exec = $a10_tmp_exec;
	if	( $a10_tmp_exec )
	{
?>
<?php unset($a10_value,$a10_contains) ?><?php $a11_list='list';$a11_name=$id;$a11_default=$value;$a11_onchange='';$a11_title='';$a11_class='';$a11_addempty=false;$a11_multiple=false;$a11_size='1';$a11_lang=false; ?><?php
$a11_readonly=false;
$a11_tmp_list = $$a11_list;
if ($this->isEditable() && !$this->isEditMode())
{
	echo empty($$a11_name)?'- '.lang('EMPTY').' -':$a11_tmp_list[$$a11_name];
}
else
{
if ( $a11_addempty!==FALSE  )
{
	if ($a11_addempty===TRUE)
		$a11_tmp_list = array(''=>lang('LIST_ENTRY_EMPTY'))+$a11_tmp_list;
	else
		$a11_tmp_list = array(''=>'- '.lang($a11_addempty).' -')+$a11_tmp_list;
}
?><select<?php if ($a11_readonly) echo ' disabled="disabled"' ?> id="id_<?php echo $a11_name ?>"  name="<?php echo $a11_name; if ($a11_multiple) echo '[]'; ?>" onchange="<?php echo $a11_onchange ?>" title="<?php echo $a11_title ?>" class="<?php echo $a11_class ?>"<?php
if (count($$a11_list)<=1) echo ' disabled="disabled"';
if	($a11_multiple) echo ' multiple="multiple"';
if (in_array($a11_name,$errors)) echo ' style="background-color:red; border:2px dashed red;"';
echo ' size="'.intval($a11_size).'"';
?>><?php
		if	( isset($$a11_name) && isset($a11_tmp_list[$$a11_name]) )
			$a11_tmp_default = $$a11_name;
		elseif ( isset($a11_default) )
			$a11_tmp_default = $a11_default;
		else
			$a11_tmp_default = '';
		foreach( $a11_tmp_list as $box_key=>$box_value )
		{
			if	( is_array($box_value) )
			{
				$box_key   = $box_value['key'  ];
				$box_title = $box_value['title'];
				$box_value = $box_value['value'];
			}
			elseif( $a11_lang )
			{
				$box_title = lang( $box_value.'_DESC');
				$box_value = lang( $box_value        );
			}
			else
			{
				$box_title = '';
			}
			echo '<option class="'.$a11_class.'" value="'.$box_key.'" title="'.$box_title.'"';
			if ((string)$box_key==$a11_tmp_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select><?php
if (count($$a11_list)==0) echo '<input type="hidden" name="'.$a11_name.'" value="" />';
if (count($$a11_list)==1) echo '<input type="hidden" name="'.$a11_name.'" value="'.$box_key.'" />';
}
?><?php unset($a11_list,$a11_name,$a11_default,$a11_onchange,$a11_title,$a11_class,$a11_addempty,$a11_multiple,$a11_size,$a11_lang) ?><?php } ?></td></tr><?php } ?><?php } ?><?php
	$column_idx = $last_column_idx;
?>
</table><?php $a5_title=lang('options'); ?><fieldset><?php if(isset($a5_title)) { ?><legend><?php if(isset($a5_icon)) { ?><img src="<?php echo $image_dir.'icon_'.$a5_icon.IMG_ICON_EXT ?>" align="left" border="0" /><?php } ?>&nbsp;&nbsp;<?php echo encodeHtml($a5_title) ?>&nbsp;&nbsp;</legend><?php } ?><?php unset($a5_title) ?><?php $a6_present='release'; ?><?php 
	$a6_tmp_exec = isset($$a6_present);
	$a6_tmp_last_exec = $a6_tmp_exec;
	if	( $a6_tmp_exec )
	{
?>
<?php unset($a6_present) ?><div><?php $a8_default=false;$a8_readonly=false;$a8_name='release'; ?><?php
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
?><?php unset($a8_name); unset($a8_readonly); unset($a8_default); ?><?php unset($a8_default,$a8_readonly,$a8_name) ?><?php $a8_for='release'; ?><label<?php if (isset($a8_for)) { ?> for="id_<?php echo $a8_for ?><?php if (!empty($a8_value)) echo '_'.$a8_value ?>" class="label"<?php } ?>>
<?php if (isset($a8_key)) { echo lang($a8_key); if(hasLang($a8_key.'_desc')) { ?><div class="description"><?php echo lang($a8_key.'_desc')?></div> <?php } } ?><?php unset($a8_for) ?><?php $a9_class='text';$a9_raw='_';$a9_escape=true;$a9_cut='both'; ?><?php
		$a9_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a9_class ?>" title="<?php echo $a9_title ?>"><?php
		$langF = $a9_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a9_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a9_class,$a9_raw,$a9_escape,$a9_cut) ?><?php $a9_class='text';$a9_text='GLOBAL_RELEASE';$a9_escape=true;$a9_cut='both'; ?><?php
		$a9_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a9_class ?>" title="<?php echo $a9_title ?>"><?php
		$langF = $a9_escape?'langHtml':'lang';
		$tmp_text = $langF($a9_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a9_class,$a9_text,$a9_escape,$a9_cut) ?></label></div><?php } ?><?php $a6_present='publish'; ?><?php 
	$a6_tmp_exec = isset($$a6_present);
	$a6_tmp_last_exec = $a6_tmp_exec;
	if	( $a6_tmp_exec )
	{
?>
<?php unset($a6_present) ?><div><?php $a8_default=false;$a8_readonly=false;$a8_name='publish'; ?><?php
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
?><?php unset($a8_name); unset($a8_readonly); unset($a8_default); ?><?php unset($a8_default,$a8_readonly,$a8_name) ?><?php $a8_for='publish'; ?><label<?php if (isset($a8_for)) { ?> for="id_<?php echo $a8_for ?><?php if (!empty($a8_value)) echo '_'.$a8_value ?>" class="label"<?php } ?>>
<?php if (isset($a8_key)) { echo lang($a8_key); if(hasLang($a8_key.'_desc')) { ?><div class="description"><?php echo lang($a8_key.'_desc')?></div> <?php } } ?><?php unset($a8_for) ?><?php $a9_class='text';$a9_raw='_';$a9_escape=true;$a9_cut='both'; ?><?php
		$a9_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a9_class ?>" title="<?php echo $a9_title ?>"><?php
		$langF = $a9_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a9_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a9_class,$a9_raw,$a9_escape,$a9_cut) ?><?php $a9_class='text';$a9_text='PAGE_PUBLISH_AFTER_SAVE';$a9_escape=true;$a9_cut='both'; ?><?php
		$a9_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a9_class ?>" title="<?php echo $a9_title ?>"><?php
		$langF = $a9_escape?'langHtml':'lang';
		$tmp_text = $langF($a9_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a9_class,$a9_text,$a9_escape,$a9_cut) ?></label></div><?php } ?></fieldset><?php $a5_type='ok';$a5_class='ok';$a5_value='ok';$a5_text='button_ok'; ?><div class="invisible">
<?php
		if ($this->isEditable() && !$this->isEditMode() && !readonly() )
		{
			$a5_type = ''; // Knopf nicht anzeigen
			?><a class="action" href="<?php echo Html::url($actionName,$subactionName,0,array('mode'=>'edit')) ?>"><span title="<?php echo lang('MODE_EDIT_DESC') ?>"><?php echo langHtml('MODE_EDIT') ?></span></a><?php
		} else
		{
			$a5_type = 'submit';
		}
		$a5_tmp_src  = '';
	if	( !empty($a5_type)) { 
?>
<input type="<?php echo $a5_type ?>"<?php if(isset($a5_src)) { ?> src="<?php $a5_tmp_src ?>"<?php } ?> name="<?php echo $a5_value ?>" class="ok" title="<?php echo lang($a5_text.'_DESC') ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo langHtml($a5_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($a5_src); ?>
<?php }
		if ($this->isEditable() && $this->isEditMode() )
		{
			?><a class="action" href="<?php echo Html::url($actionName,$subactionName,0,array('mode'=>'')) ?>"><span title="<?php echo lang('CANCEL_DESC') ?>"><?php echo langHtml('CANCEL') ?></span></a><?php
		}
?>
</div><?php unset($a5_type,$a5_class,$a5_value,$a5_text) ?><?php if (false) { ?>
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
