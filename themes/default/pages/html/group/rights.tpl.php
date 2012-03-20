<?php $a3_width='93%';$a3_rowclasses='odd,even';$a3_columnclasses='1,2,3'; ?><?php if (false) { ?>
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
<?php } ?><?php unset($a3_width,$a3_rowclasses,$a3_columnclasses) ?><?php $a4_list='projects';$a4_extract=true;$a4_key='list_key';$a4_value='list_value'; ?><?php
	$a4_list_tmp_key   = $a4_key;
	$a4_list_tmp_value = $a4_value;
	$a4_list_extract   = $a4_extract;
	unset($a4_key);
	unset($a4_value);
	if	( !isset($$a4_list) || !is_array($$a4_list) )
		$$a4_list = array();
	foreach( $$a4_list as $$a4_list_tmp_key => $$a4_list_tmp_value )
	{
		if	( $a4_list_extract )
		{
			if	( !is_array($$a4_list_tmp_value) )
			{
				print_r($$a4_list_tmp_value);
				die( 'not an array at key: '.$$a4_list_tmp_key );
			}
			extract($$a4_list_tmp_value);
		}
?><?php unset($a4_list,$a4_extract,$a4_key,$a4_value) ?><?php
	$column_idx = 0;
?>
<tr
>
<?php $a6_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a6_header) ?><?php $a7_title=$projectname; ?><fieldset><?php if(isset($a7_title)) { ?><legend><?php if(isset($a7_icon)) { ?><img src="<?php echo $image_dir.'icon_'.$a7_icon.IMG_ICON_EXT ?>" align="left" border="0" /><?php } ?>&nbsp;&nbsp;<?php echo encodeHtml($a7_title) ?>&nbsp;&nbsp;</legend><?php } ?><?php unset($a7_title) ?><?php $a8_empty='acls'; ?><?php 
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
<?php unset($a8_empty) ?><?php
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
><?php unset($a10_header) ?><?php $a11_class='text';$a11_text='GLOBAL_NOT_FOUND';$a11_escape=true;$a11_cut='both'; ?><?php
		$a11_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = $langF($a11_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_text,$a11_escape,$a11_cut) ?></td></tr><?php } ?><?php $a8_not=true;$a8_empty='acls'; ?><?php 
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
<?php unset($a8_not,$a8_empty) ?><?php $a9_width='100%';$a9_space='0px';$a9_padding='0px'; ?><?php
	$last_column_idx = @$column_idx;
	$column_idx = 0;
	$coloumn_widths = array();
	$row_classes    = array();
	$column_classes = array();
?><table class="%class%" cellspacing="0px" width="100%" cellpadding="0px">
<?php unset($a9_width,$a9_space,$a9_padding) ?><?php $a10_class='headline'; ?><?php
	$column_idx = 0;
?>
<tr
 class="headline"
>
<?php unset($a10_class) ?><?php $a11_class='help';$a11_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="help"
><?php unset($a11_class,$a11_header) ?><?php $a12_class='text';$a12_text='GLOBAL_USER';$a12_escape=true;$a12_cut='both'; ?><?php
		$a12_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a12_class ?>" title="<?php echo $a12_title ?>"><?php
		$langF = $a12_escape?'langHtml':'lang';
		$tmp_text = $langF($a12_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a12_class,$a12_text,$a12_escape,$a12_cut) ?></td><?php $a11_class='help';$a11_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="help"
><?php unset($a11_class,$a11_header) ?><?php $a12_class='text';$a12_text='GLOBAL_NAME';$a12_escape=true;$a12_cut='both'; ?><?php
		$a12_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a12_class ?>" title="<?php echo $a12_title ?>"><?php
		$langF = $a12_escape?'langHtml':'lang';
		$tmp_text = $langF($a12_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a12_class,$a12_text,$a12_escape,$a12_cut) ?></td><?php $a11_class='help';$a11_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="help"
><?php unset($a11_class,$a11_header) ?><?php $a12_class='text';$a12_text='GLOBAL_LANGUAGE';$a12_escape=true;$a12_cut='both'; ?><?php
		$a12_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a12_class ?>" title="<?php echo $a12_title ?>"><?php
		$langF = $a12_escape?'langHtml':'lang';
		$tmp_text = $langF($a12_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a12_class,$a12_text,$a12_escape,$a12_cut) ?></td><?php $a11_list='show';$a11_extract=false;$a11_key='list_key';$a11_value='t'; ?><?php
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
?><?php unset($a11_list,$a11_extract,$a11_key,$a11_value) ?><?php $a12_class='help';$a12_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="help"
><?php unset($a12_class,$a12_header) ?><?php $a13_title=lang('acl_'.$t.'');$a13_class='text';$a13_key=$t;$a13_suffix='_abbrev';$a13_prefix='acl_';$a13_escape=true;$a13_cut='both'; ?><?php
		$a13_key = $a13_prefix.$a13_key;
		$a13_key = $a13_key.$a13_suffix;
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a13_class ?>" title="<?php echo $a13_title ?>"><?php
		$langF = $a13_escape?'langHtml':'lang';
		$tmp_text = $langF($a13_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a13_title,$a13_class,$a13_key,$a13_suffix,$a13_prefix,$a13_escape,$a13_cut) ?></td><?php } ?></tr><?php $a10_list='rights';$a10_extract=true;$a10_key='aclid';$a10_value='acl'; ?><?php
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
?><?php unset($a10_list,$a10_extract,$a10_key,$a10_value) ?><?php $a11_class='data'; ?><?php
	$column_idx = 0;
?>
<tr
 class="data"
>
<?php unset($a11_class) ?><?php $a12_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a12_header) ?><?php $a13_present='groupname'; ?><?php 
	$a13_tmp_exec = isset($$a13_present);
	$a13_tmp_last_exec = $a13_tmp_exec;
	if	( $a13_tmp_exec )
	{
?>
<?php unset($a13_present) ?><?php $a14_align='left';$a14_type='group'; ?><?php
	$a14_tmp_image_file = $image_dir.'icon_'.$a14_type.IMG_ICON_EXT;
	$a14_size = '16x16';
	$a14_tmp_title = basename($a14_tmp_image_file);
?><img alt="<?php echo $a14_tmp_title; if (isset($a14_size)) { echo ' ('; list($a14_tmp_width,$a14_tmp_height)=explode('x',$a14_size);echo $a14_tmp_width.'x'.$a14_tmp_height; echo')';} ?>" src="<?php echo $a14_tmp_image_file ?>" border="0"<?php if(isset($a14_align)) echo ' align="'.$a14_align.'"' ?><?php if (isset($a14_size)) { list($a14_tmp_width,$a14_tmp_height)=explode('x',$a14_size);echo ' width="'.$a14_tmp_width.'" height="'.$a14_tmp_height.'"';} ?> /><?php unset($a14_align,$a14_type) ?><?php $a14_class='text';$a14_var='groupname';$a14_maxlength='20';$a14_escape=true;$a14_cut='both'; ?><?php
		$a14_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a14_class ?>" title="<?php echo $a14_title ?>"><?php
		$langF = $a14_escape?'langHtml':'lang';
		$tmp_text = isset($$a14_var)?$$a14_var:$langF('UNKNOWN');
		$tmp_text = Text::maxLength( $tmp_text,intval($a14_maxlength),'..',constant('STR_PAD_'.strtoupper($a14_cut)) );
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a14_class,$a14_var,$a14_maxlength,$a14_escape,$a14_cut) ?><?php } ?><?php $a13_not=true;$a13_present='username'; ?><?php 
	$a13_tmp_exec = isset($$a13_present);
	$a13_tmp_exec = !$a13_tmp_exec;
	$a13_tmp_last_exec = $a13_tmp_exec;
	if	( $a13_tmp_exec )
	{
?>
<?php unset($a13_not,$a13_present) ?><?php $a14_not=true;$a14_present='groupname'; ?><?php 
	$a14_tmp_exec = isset($$a14_present);
	$a14_tmp_exec = !$a14_tmp_exec;
	$a14_tmp_last_exec = $a14_tmp_exec;
	if	( $a14_tmp_exec )
	{
?>
<?php unset($a14_not,$a14_present) ?><?php $a15_align='left';$a15_type='group'; ?><?php
	$a15_tmp_image_file = $image_dir.'icon_'.$a15_type.IMG_ICON_EXT;
	$a15_size = '16x16';
	$a15_tmp_title = basename($a15_tmp_image_file);
?><img alt="<?php echo $a15_tmp_title; if (isset($a15_size)) { echo ' ('; list($a15_tmp_width,$a15_tmp_height)=explode('x',$a15_size);echo $a15_tmp_width.'x'.$a15_tmp_height; echo')';} ?>" src="<?php echo $a15_tmp_image_file ?>" border="0"<?php if(isset($a15_align)) echo ' align="'.$a15_align.'"' ?><?php if (isset($a15_size)) { list($a15_tmp_width,$a15_tmp_height)=explode('x',$a15_size);echo ' width="'.$a15_tmp_width.'" height="'.$a15_tmp_height.'"';} ?> /><?php unset($a15_align,$a15_type) ?><?php $a15_class='text';$a15_key='global_all';$a15_escape=true;$a15_cut='both'; ?><?php
		$a15_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a15_class ?>" title="<?php echo $a15_title ?>"><?php
		$langF = $a15_escape?'langHtml':'lang';
		$tmp_text = $langF($a15_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a15_class,$a15_key,$a15_escape,$a15_cut) ?><?php } ?><?php } ?><?php $a13_var='username'; ?><?php
	if (!isset($a13_value))
		unset($$a13_var);
?><?php unset($a13_var) ?><?php $a13_var='groupname'; ?><?php
	if (!isset($a13_value))
		unset($$a13_var);
?><?php unset($a13_var) ?></td><?php $a12_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a12_header) ?><?php $a13_align='left';$a13_type=$objecttype; ?><?php
	$a13_tmp_image_file = $image_dir.'icon_'.$a13_type.IMG_ICON_EXT;
	$a13_size = '16x16';
	$a13_tmp_title = basename($a13_tmp_image_file);
?><img alt="<?php echo $a13_tmp_title; if (isset($a13_size)) { echo ' ('; list($a13_tmp_width,$a13_tmp_height)=explode('x',$a13_size);echo $a13_tmp_width.'x'.$a13_tmp_height; echo')';} ?>" src="<?php echo $a13_tmp_image_file ?>" border="0"<?php if(isset($a13_align)) echo ' align="'.$a13_align.'"' ?><?php if (isset($a13_size)) { list($a13_tmp_width,$a13_tmp_height)=explode('x',$a13_size);echo ' width="'.$a13_tmp_width.'" height="'.$a13_tmp_height.'"';} ?> /><?php unset($a13_align,$a13_type) ?><?php $a13_title='';$a13_type='';$a13_class='';$a13_action=$objecttype;$a13_subaction='';$a13_id=$objectid;$a13_frame='_self'; ?><?php
	$params = array();
	$tmp_url = '';
	$a13_target = $view;
	switch( $a13_type )
	{
		case 'post':
			$json = new JSON();
			$tmp_data = $json->encode( array('action'=>!empty($a13_action)?$a13_action:$this->actionName,'subaction'=>!empty($a13_subaction)?$a13_subaction:$this->subActionName,'id'=>!empty($a13_id)?$a13_id:$this->getRequestId())
		                          +array(REQ_PARAM_TOKEN=>token())
		                          +$params );
			$tmp_function_call = "submitLink(this,'".str_replace("\n",'',str_replace('"','&quot;',$tmp_data))."');";
			break;
		case 'view':
			$tmp_function_call = "startView(this,'".(!empty($a13_subaction)?$a13_subaction:$this->subActionName)."');";
			break;
		case 'url':
			$tmp_function_call = "submitUrl(this,'".($a13_url)."');";
			break;
		case 'external':
			$tmp_function_call = "location.href='".$a13_url."';";
			break;
		case 'popup':
			$tmp_function_call = "window.open('".$a13_url."', 'Popup', 'location=no,menubar=no,scrollbars=yes,toolbar=no,resizable=yes');";
			break;
		default:
			$tmp_function_call = "alert('TODO');";
	}
?><a target="<?php echo $a13_frame ?>"<?php if (isset($a13_name)) { ?> name="<?php echo $a13_name ?>"<?php }else{ ?> href="javascript:void(0);" onclick="<?php echo $tmp_function_call ?>" <?php } ?> class="<?php echo $a13_class ?>"<?php if (isset($a13_accesskey)) echo ' accesskey="'.$a13_accesskey.'"' ?>  title="<?php echo encodeHtml($a13_title) ?>"><?php unset($a13_title,$a13_type,$a13_class,$a13_action,$a13_subaction,$a13_id,$a13_frame) ?><?php $a14_title=lang('select');$a14_class='text';$a14_var='objectname';$a14_maxlength='20';$a14_escape=true;$a14_cut='both'; ?><?php
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a14_class ?>" title="<?php echo $a14_title ?>"><?php
		$langF = $a14_escape?'langHtml':'lang';
		$tmp_text = isset($$a14_var)?$$a14_var:$langF('UNKNOWN');
		$tmp_text = Text::maxLength( $tmp_text,intval($a14_maxlength),'..',constant('STR_PAD_'.strtoupper($a14_cut)) );
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a14_title,$a14_class,$a14_var,$a14_maxlength,$a14_escape,$a14_cut) ?></a></td><?php $a12_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a12_header) ?><?php $a13_class='text';$a13_var='languagename';$a13_maxlength='20';$a13_escape=true;$a13_cut='both'; ?><?php
		$a13_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a13_class ?>" title="<?php echo $a13_title ?>"><?php
		$langF = $a13_escape?'langHtml':'lang';
		$tmp_text = isset($$a13_var)?$$a13_var:$langF('UNKNOWN');
		$tmp_text = Text::maxLength( $tmp_text,intval($a13_maxlength),'..',constant('STR_PAD_'.strtoupper($a13_cut)) );
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a13_class,$a13_var,$a13_maxlength,$a13_escape,$a13_cut) ?></td><?php $a12_list='show';$a12_extract=false;$a12_key='list_key';$a12_value='list_value'; ?><?php
	$a12_list_tmp_key   = $a12_key;
	$a12_list_tmp_value = $a12_value;
	$a12_list_extract   = $a12_extract;
	unset($a12_key);
	unset($a12_value);
	if	( !isset($$a12_list) || !is_array($$a12_list) )
		$$a12_list = array();
	foreach( $$a12_list as $$a12_list_tmp_key => $$a12_list_tmp_value )
	{
		if	( $a12_list_extract )
		{
			if	( !is_array($$a12_list_tmp_value) )
			{
				print_r($$a12_list_tmp_value);
				die( 'not an array at key: '.$$a12_list_tmp_key );
			}
			extract($$a12_list_tmp_value);
		}
?><?php unset($a12_list,$a12_extract,$a12_key,$a12_value) ?><?php $a13_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a13_header) ?><?php $a14_var=$list_value;$a14_value=$bits;$a14_key=$list_value; ?><?php
	if (isset($a14_key))
		$$a14_var = $a14_value[$a14_key];
	else
		$$a14_var = $a14_value;
?><?php unset($a14_var,$a14_value,$a14_key) ?><?php $a14_default=false;$a14_readonly=true;$a14_name=$list_value; ?><?php
	if ($this->isEditable() && !$this->isEditMode()) $a14_readonly=true;
	if	( isset($$a14_name) )
		$checked = $$a14_name;
	else
		$checked = $a14_default;
?><input class="checkbox" type="checkbox" id="id_<?php echo $a14_name ?>" name="<?php echo $a14_name  ?>"  <?php if ($a14_readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?><?php if (in_array($a14_name,$errors)) echo ' style="background-color:red;"' ?> /><?php
if ( $a14_readonly && $checked )
{ 
?><input type="hidden" name="<?php echo $a14_name ?>" value="1" /><?php
}
?><?php unset($a14_name); unset($a14_readonly); unset($a14_default); ?><?php unset($a14_default,$a14_readonly,$a14_name) ?></td><?php } ?></tr><?php } ?><?php
	$column_idx = $last_column_idx;
?>
</table><?php } ?></fieldset></td></tr><?php } ?><?php if (false) { ?>
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
<?php } ?>