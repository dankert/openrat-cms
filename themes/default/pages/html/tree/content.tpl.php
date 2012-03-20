<?php $a2_width='93%';$a2_rowclasses='odd,even';$a2_columnclasses='1,2,3'; ?><?php if (false) { ?>
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
<?php } ?><?php unset($a2_width,$a2_rowclasses,$a2_columnclasses) ?><?php $a3_class='tree';$a3_width='100%';$a3_space='0';$a3_padding='0'; ?><?php
	$last_column_idx = @$column_idx;
	$column_idx = 0;
	$coloumn_widths = array();
	$row_classes    = array();
	$column_classes = array();
?><table class="tree" cellspacing="0" width="100%" cellpadding="0">
<?php unset($a3_class,$a3_width,$a3_space,$a3_padding) ?><?php $a4_list='zeilen';$a4_extract=true;$a4_key='list_key';$a4_value='list_value'; ?><?php
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
?><?php unset($a4_list,$a4_extract,$a4_key,$a4_value) ?><?php $a5_class=$class; ?><?php
	$column_idx = 0;
?>
<tr
 class="<?php echo $class ?>"
>
<?php unset($a5_class) ?><?php $a6_list='cols';$a6_extract=false;$a6_key='list_key';$a6_value='i'; ?><?php
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
?><?php unset($a6_list,$a6_extract,$a6_key,$a6_value) ?><?php $a7_class='treecol';$a7_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="treecol"
><?php unset($a7_class,$a7_header) ?><?php $a8_align='left';$a8_tree=$i; ?><?php
	$a8_tmp_image_file = $image_dir.'tree_'.$a8_tree.IMG_EXT;
	$a8_size = '18x18';
	$a8_tmp_title = basename($a8_tmp_image_file);
?><img alt="<?php echo $a8_tmp_title; if (isset($a8_size)) { echo ' ('; list($a8_tmp_width,$a8_tmp_height)=explode('x',$a8_size);echo $a8_tmp_width.'x'.$a8_tmp_height; echo')';} ?>" src="<?php echo $a8_tmp_image_file ?>" border="0"<?php if(isset($a8_align)) echo ' align="'.$a8_align.'"' ?><?php if (isset($a8_size)) { list($a8_tmp_width,$a8_tmp_height)=explode('x',$a8_size);echo ' width="'.$a8_tmp_width.'" height="'.$a8_tmp_height.'"';} ?> /><?php unset($a8_align,$a8_tree) ?></td><?php } ?><?php $a6_present='image'; ?><?php 
	$a6_tmp_exec = isset($$a6_present);
	$a6_tmp_last_exec = $a6_tmp_exec;
	if	( $a6_tmp_exec )
	{
?>
<?php unset($a6_present) ?><?php $a7_class='treeimage';$a7_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="treeimage"
><?php unset($a7_class,$a7_header) ?><?php $a8_present='image_url'; ?><?php 
	$a8_tmp_exec = isset($$a8_present);
	$a8_tmp_last_exec = $a8_tmp_exec;
	if	( $a8_tmp_exec )
	{
?>
<?php unset($a8_present) ?><?php $a9_title=$image_url_desc;$a9_type='';$a9_target='_self';$a9_url=$image_url;$a9_class='tree';$a9_frame='_self'; ?><?php
	$params = array();
	$tmp_url = '';
	$params[REQ_PARAM_TARGET] = $a9_target;
	switch( $a9_type )
	{
		case 'post':
			$json = new JSON();
			$tmp_data = $json->encode( array('action'=>!empty($a9_action)?$a9_action:$this->actionName,'subaction'=>!empty($a9_subaction)?$a9_subaction:$this->subActionName,'id'=>!empty($a9_id)?$a9_id:$this->getRequestId())
		                          +array(REQ_PARAM_TOKEN=>token())
		                          +$params );
			$tmp_function_call = "submitLink(this,'".str_replace("\n",'',str_replace('"','&quot;',$tmp_data))."');";
			break;
		case 'view':
			$tmp_function_call = "startView(this,'".(!empty($a9_subaction)?$a9_subaction:$this->subActionName)."');";
			break;
		case 'url':
			$tmp_function_call = "submitUrl(this,'".($a9_url)."');";
			break;
		case 'external':
			$tmp_function_call = "location.href='".$a9_url."';";
			break;
		case 'popup':
			$tmp_function_call = "window.open('".$a9_url."', 'Popup', 'location=no,menubar=no,scrollbars=yes,toolbar=no,resizable=yes');";
			break;
		default:
			$tmp_function_call = "alert('TODO');";
	}
?><a target="<?php echo $a9_frame ?>"<?php if (isset($a9_name)) { ?> name="<?php echo $a9_name ?>"<?php }else{ ?> href="javascript:void(0);" onclick="<?php echo $tmp_function_call ?>" <?php } ?> class="<?php echo $a9_class ?>"<?php if (isset($a9_accesskey)) echo ' accesskey="'.$a9_accesskey.'"' ?>  title="<?php echo encodeHtml($a9_title) ?>"><?php unset($a9_title,$a9_type,$a9_target,$a9_url,$a9_class,$a9_frame) ?><?php $a10_align='left';$a10_tree=$image; ?><?php
	$a10_tmp_image_file = $image_dir.'tree_'.$a10_tree.IMG_EXT;
	$a10_size = '18x18';
	$a10_tmp_title = basename($a10_tmp_image_file);
?><img alt="<?php echo $a10_tmp_title; if (isset($a10_size)) { echo ' ('; list($a10_tmp_width,$a10_tmp_height)=explode('x',$a10_size);echo $a10_tmp_width.'x'.$a10_tmp_height; echo')';} ?>" src="<?php echo $a10_tmp_image_file ?>" border="0"<?php if(isset($a10_align)) echo ' align="'.$a10_align.'"' ?><?php if (isset($a10_size)) { list($a10_tmp_width,$a10_tmp_height)=explode('x',$a10_size);echo ' width="'.$a10_tmp_width.'" height="'.$a10_tmp_height.'"';} ?> /><?php unset($a10_align,$a10_tree) ?></a><?php } ?><?php if (!$a8_tmp_last_exec) { ?>
<?php $a9_align='left';$a9_tree=$image; ?><?php
	$a9_tmp_image_file = $image_dir.'tree_'.$a9_tree.IMG_EXT;
	$a9_size = '18x18';
	$a9_tmp_title = basename($a9_tmp_image_file);
?><img alt="<?php echo $a9_tmp_title; if (isset($a9_size)) { echo ' ('; list($a9_tmp_width,$a9_tmp_height)=explode('x',$a9_size);echo $a9_tmp_width.'x'.$a9_tmp_height; echo')';} ?>" src="<?php echo $a9_tmp_image_file ?>" border="0"<?php if(isset($a9_align)) echo ' align="'.$a9_align.'"' ?><?php if (isset($a9_size)) { list($a9_tmp_width,$a9_tmp_height)=explode('x',$a9_size);echo ' width="'.$a9_tmp_width.'" height="'.$a9_tmp_height.'"';} ?> /><?php unset($a9_align,$a9_tree) ?><?php }
unset($a7_tmp_last_exec) ?></td><?php } ?><?php $a6_class='treevalue';$a6_colspan=$colspan;$a6_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="treevalue"
 colspan="<?php echo $colspan ?>"
><?php unset($a6_class,$a6_colspan,$a6_header) ?><?php $a7_title='';$a7_type='';$a7_class='';$a7_name=$name;$a7_frame='_self'; ?><?php
	$params = array();
	$tmp_url = '';
	$a7_target = $view;
	switch( $a7_type )
	{
		case 'post':
			$json = new JSON();
			$tmp_data = $json->encode( array('action'=>!empty($a7_action)?$a7_action:$this->actionName,'subaction'=>!empty($a7_subaction)?$a7_subaction:$this->subActionName,'id'=>!empty($a7_id)?$a7_id:$this->getRequestId())
		                          +array(REQ_PARAM_TOKEN=>token())
		                          +$params );
			$tmp_function_call = "submitLink(this,'".str_replace("\n",'',str_replace('"','&quot;',$tmp_data))."');";
			break;
		case 'view':
			$tmp_function_call = "startView(this,'".(!empty($a7_subaction)?$a7_subaction:$this->subActionName)."');";
			break;
		case 'url':
			$tmp_function_call = "submitUrl(this,'".($a7_url)."');";
			break;
		case 'external':
			$tmp_function_call = "location.href='".$a7_url."';";
			break;
		case 'popup':
			$tmp_function_call = "window.open('".$a7_url."', 'Popup', 'location=no,menubar=no,scrollbars=yes,toolbar=no,resizable=yes');";
			break;
		default:
			$tmp_function_call = "alert('TODO');";
	}
?><a target="<?php echo $a7_frame ?>"<?php if (isset($a7_name)) { ?> name="<?php echo $a7_name ?>"<?php }else{ ?> href="javascript:void(0);" onclick="<?php echo $tmp_function_call ?>" <?php } ?> class="<?php echo $a7_class ?>"<?php if (isset($a7_accesskey)) echo ' accesskey="'.$a7_accesskey.'"' ?>  title="<?php echo encodeHtml($a7_title) ?>"><?php unset($a7_title,$a7_type,$a7_class,$a7_name,$a7_frame) ?></a><?php $a7_present='url'; ?><?php 
	$a7_tmp_exec = isset($$a7_present);
	$a7_tmp_last_exec = $a7_tmp_exec;
	if	( $a7_tmp_exec )
	{
?>
<?php unset($a7_present) ?><?php $a8_title=$desc;$a8_type='';$a8_target=$target;$a8_url=$url;$a8_class='tree';$a8_frame='_self'; ?><?php
	$params = array();
	$tmp_url = '';
	$params[REQ_PARAM_TARGET] = $a8_target;
	switch( $a8_type )
	{
		case 'post':
			$json = new JSON();
			$tmp_data = $json->encode( array('action'=>!empty($a8_action)?$a8_action:$this->actionName,'subaction'=>!empty($a8_subaction)?$a8_subaction:$this->subActionName,'id'=>!empty($a8_id)?$a8_id:$this->getRequestId())
		                          +array(REQ_PARAM_TOKEN=>token())
		                          +$params );
			$tmp_function_call = "submitLink(this,'".str_replace("\n",'',str_replace('"','&quot;',$tmp_data))."');";
			break;
		case 'view':
			$tmp_function_call = "startView(this,'".(!empty($a8_subaction)?$a8_subaction:$this->subActionName)."');";
			break;
		case 'url':
			$tmp_function_call = "submitUrl(this,'".($a8_url)."');";
			break;
		case 'external':
			$tmp_function_call = "location.href='".$a8_url."';";
			break;
		case 'popup':
			$tmp_function_call = "window.open('".$a8_url."', 'Popup', 'location=no,menubar=no,scrollbars=yes,toolbar=no,resizable=yes');";
			break;
		default:
			$tmp_function_call = "alert('TODO');";
	}
?><a target="<?php echo $a8_frame ?>"<?php if (isset($a8_name)) { ?> name="<?php echo $a8_name ?>"<?php }else{ ?> href="javascript:void(0);" onclick="<?php echo $tmp_function_call ?>" <?php } ?> class="<?php echo $a8_class ?>"<?php if (isset($a8_accesskey)) echo ' accesskey="'.$a8_accesskey.'"' ?>  title="<?php echo encodeHtml($a8_title) ?>"><?php unset($a8_title,$a8_type,$a8_target,$a8_url,$a8_class,$a8_frame) ?><?php $a9_icon=$icon;$a9_align='left'; ?><?php
	$a9_tmp_image_file = $image_dir.'icon_'.$a9_icon.IMG_ICON_EXT;
	$a9_size = '16x16';
	$a9_tmp_title = basename($a9_tmp_image_file);
?><img alt="<?php echo $a9_tmp_title; if (isset($a9_size)) { echo ' ('; list($a9_tmp_width,$a9_tmp_height)=explode('x',$a9_size);echo $a9_tmp_width.'x'.$a9_tmp_height; echo')';} ?>" src="<?php echo $a9_tmp_image_file ?>" border="0"<?php if(isset($a9_align)) echo ' align="'.$a9_align.'"' ?><?php if (isset($a9_size)) { list($a9_tmp_width,$a9_tmp_height)=explode('x',$a9_size);echo ' width="'.$a9_tmp_width.'" height="'.$a9_tmp_height.'"';} ?> /><?php unset($a9_icon,$a9_align) ?><?php $a9_class='text';$a9_var='text';$a9_maxlength='20';$a9_escape=true;$a9_cut='right'; ?><?php
		$a9_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a9_class ?>" title="<?php echo $a9_title ?>"><?php
		$langF = $a9_escape?'langHtml':'lang';
		$tmp_text = isset($$a9_var)?$$a9_var:$langF('UNKNOWN');
		$tmp_text = Text::maxLength( $tmp_text,intval($a9_maxlength),'..',constant('STR_PAD_'.strtoupper($a9_cut)) );
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a9_class,$a9_var,$a9_maxlength,$a9_escape,$a9_cut) ?></a><?php } ?><?php if (!$a7_tmp_last_exec) { ?>
<?php $a8_icon=$icon;$a8_align='left'; ?><?php
	$a8_tmp_image_file = $image_dir.'icon_'.$a8_icon.IMG_ICON_EXT;
	$a8_size = '16x16';
	$a8_tmp_title = basename($a8_tmp_image_file);
?><img alt="<?php echo $a8_tmp_title; if (isset($a8_size)) { echo ' ('; list($a8_tmp_width,$a8_tmp_height)=explode('x',$a8_size);echo $a8_tmp_width.'x'.$a8_tmp_height; echo')';} ?>" src="<?php echo $a8_tmp_image_file ?>" border="0"<?php if(isset($a8_align)) echo ' align="'.$a8_align.'"' ?><?php if (isset($a8_size)) { list($a8_tmp_width,$a8_tmp_height)=explode('x',$a8_size);echo ' width="'.$a8_tmp_width.'" height="'.$a8_tmp_height.'"';} ?> /><?php unset($a8_icon,$a8_align) ?><?php $a8_title=$desc;$a8_class='text';$a8_var='text';$a8_maxlength='20';$a8_escape=true;$a8_cut='right'; ?><?php
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = isset($$a8_var)?$$a8_var:$langF('UNKNOWN');
		$tmp_text = Text::maxLength( $tmp_text,intval($a8_maxlength),'..',constant('STR_PAD_'.strtoupper($a8_cut)) );
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_title,$a8_class,$a8_var,$a8_maxlength,$a8_escape,$a8_cut) ?><?php }
unset($a6_tmp_last_exec) ?></td><?php $a6_var='url'; ?><?php
	if (!isset($a6_value))
		unset($$a6_var);
?><?php unset($a6_var) ?><?php $a6_var='image'; ?><?php
	if (!isset($a6_value))
		unset($$a6_var);
?><?php unset($a6_var) ?></tr><?php } ?><?php
	$column_idx = $last_column_idx;
?>
</table><?php $a3_inline=false;$a3_function='loadTree'; ?>Hallo!
<script type="text/javascript" name="JavaScript"><?php echo $a3_function?>();</script>
<?php unset($a3_inline,$a3_function) ?><?php if (false) { ?>
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