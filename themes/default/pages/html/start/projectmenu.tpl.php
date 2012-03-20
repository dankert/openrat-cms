<?php $a3_title='GLOBAL_PROJECTS';$a3_width='93%';$a3_rowclasses='odd,even';$a3_columnclasses='1,2,3'; ?><?php if (false) { ?>
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
<?php } ?><?php unset($a3_title,$a3_width,$a3_rowclasses,$a3_columnclasses) ?><?php
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
><?php unset($a5_class,$a5_colspan,$a5_header) ?><?php $a6_name='projectmenu'; ?><img src="<?php echo $image_dir.'logo_'.$a6_name.IMG_ICON_EXT ?>" border="0" align="left" /><h2 class="logo"><?php echo langHtml('logo_'.$a6_name) ?></h2><p class="logo"><?php echo langHtml('logo_'.$a6_name.'_text') ?></p><?php unset($a6_name) ?></td></tr><?php $a4_list='projects';$a4_extract=true;$a4_key='list_key';$a4_value='list_value'; ?><?php
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
<?php $a6_colspan='2';$a6_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
 colspan="2"
><?php unset($a6_colspan,$a6_header) ?><?php $a7_title=$name; ?><fieldset><?php if(isset($a7_title)) { ?><legend><?php if(isset($a7_icon)) { ?><img src="<?php echo $image_dir.'icon_'.$a7_icon.IMG_ICON_EXT ?>" align="left" border="0" /><?php } ?>&nbsp;&nbsp;<?php echo encodeHtml($a7_title) ?>&nbsp;&nbsp;</legend><?php } ?><?php unset($a7_title) ?><?php $a8_title=lang('TREE_CHOOSE_PROJECT');$a8_type='post';$a8_class='';$a8_id=$id;$a8_frame='_self'; ?><?php
	$params = array();
	$tmp_url = '';
	$a8_target = $view;
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
?><a target="<?php echo $a8_frame ?>"<?php if (isset($a8_name)) { ?> name="<?php echo $a8_name ?>"<?php }else{ ?> href="javascript:void(0);" onclick="<?php echo $tmp_function_call ?>" <?php } ?> class="<?php echo $a8_class ?>"<?php if (isset($a8_accesskey)) echo ' accesskey="'.$a8_accesskey.'"' ?>  title="<?php echo encodeHtml($a8_title) ?>"><?php unset($a8_title,$a8_type,$a8_class,$a8_id,$a8_frame) ?><?php $a9_var='project';$a9_value='project'; ?><?php
	if (isset($a9_key))
		$$a9_var = $a9_value[$a9_key];
	else
		$$a9_var = $a9_value;
?><?php unset($a9_var,$a9_value) ?><?php $a9_align='left';$a9_type='project'; ?><?php
	$a9_tmp_image_file = $image_dir.'icon_'.$a9_type.IMG_ICON_EXT;
	$a9_size = '16x16';
	$a9_tmp_title = basename($a9_tmp_image_file);
?><img alt="<?php echo $a9_tmp_title; if (isset($a9_size)) { echo ' ('; list($a9_tmp_width,$a9_tmp_height)=explode('x',$a9_size);echo $a9_tmp_width.'x'.$a9_tmp_height; echo')';} ?>" src="<?php echo $a9_tmp_image_file ?>" border="0"<?php if(isset($a9_align)) echo ' align="'.$a9_align.'"' ?><?php if (isset($a9_size)) { list($a9_tmp_width,$a9_tmp_height)=explode('x',$a9_size);echo ' width="'.$a9_tmp_width.'" height="'.$a9_tmp_height.'"';} ?> /><?php unset($a9_align,$a9_type) ?><?php $a9_class='text';$a9_var='name';$a9_maxlength='30';$a9_escape=true;$a9_cut='both'; ?><?php
		$a9_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a9_class ?>" title="<?php echo $a9_title ?>"><?php
		$langF = $a9_escape?'langHtml':'lang';
		$tmp_text = isset($$a9_var)?$$a9_var:$langF('UNKNOWN');
		$tmp_text = Text::maxLength( $tmp_text,intval($a9_maxlength),'..',constant('STR_PAD_'.strtoupper($a9_cut)) );
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a9_class,$a9_var,$a9_maxlength,$a9_escape,$a9_cut) ?></a><?php $a8_action='index';$a8_subaction='project';$a8_id=$id;$a8_name='';$a8_target='_self';$a8_method='post';$a8_enctype='application/x-www-form-urlencoded';$a8_type=''; ?><?php
	if ($this->isEditable())
	{
		if	($this->isEditMode())
		{
			$a8_method    = 'POST';
		}
		else
		{
			$a8_method    = 'GET';
			$a8_subaction = $subActionName;
		}
	}
	switch( $a8_type )
	{
		case 'upload':
			$a8_tmp_submitFunction = '';
			break;
		default:
			$a8_tmp_submitFunction = 'formSubmit( $(this) ); return false;';
	}
?><form name="<?php echo $a8_name ?>"
      target="<?php echo $a8_target ?>"
      action="<?php echo Html::url( $a8_action,$a8_subaction,$a8_id ) ?>"
      method="<?php echo $a8_method ?>"
      enctype="<?php echo $a8_enctype ?>" style="margin:0px;padding:0px;"
      class="<?php echo $a8_action ?>"
      onSubmit="<?php echo $a8_tmp_submitFunction ?>"><input type="submit" class="invisible" />
<?php if ($this->isEditable() && !$this->isEditMode()) { ?>
<input type="hidden" name="mode" value="edit" />
<?php } ?>
<input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo $this->actionName ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo $this->subActionName ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo $this->getRequestId() ?>" /><?php
		if	( $conf['interface']['url_sessionid'] )
			echo '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";
?><?php unset($a8_action,$a8_subaction,$a8_id,$a8_name,$a8_target,$a8_method,$a8_enctype,$a8_type) ?><?php $a9_width='100%';$a9_space='0px';$a9_padding='0px';$a9_widths='150px,150px'; ?><?php
	$last_column_idx = @$column_idx;
	$column_idx = 0;
	$coloumn_widths = array();
	$row_classes    = array();
	$column_classes = array();
		$column_widths = explode(',',$a9_widths);
?><table class="%class%" cellspacing="0px" width="100%" cellpadding="0px">
<?php unset($a9_width,$a9_space,$a9_padding,$a9_widths) ?><?php
	$column_idx = 0;
?>
<tr
>
<?php $a11_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a11_header) ?><?php $a12_list='models';$a12_name='modelid';$a12_default=$defaultmodelid;$a12_onchange='';$a12_title='';$a12_class=''; ?><?php $a12_tmp_list = $$a12_list;
		if	( isset($$a12_name) && isset($a12_tmp_list[$$a12_name]) )
			$a12_tmp_default = $$a12_name;
		elseif ( isset($a12_default) )
			$a12_tmp_default = $a12_default;
		else
			$a12_tmp_default = '';
		foreach( $a12_tmp_list as $box_key=>$box_value )
		{
			$box_value = is_array($box_value)?(isset($box_value['lang'])?langHtml($box_value['lang']):$box_value['value']):$box_value;
			$id = 'id_'.$a12_name.'_'.$box_key;
			echo '<input id="'.$id.'" name="'.$a12_name.'" type="radio" class="'.$a12_class.'" value="'.$box_key.'"';
			if ($box_key==$a12_tmp_default)
				echo ' checked="checked"';
			echo ' />&nbsp;<label for="'.$id.'">'.$box_value.'</label><br />';
		}
?><?php unset($a12_list,$a12_name,$a12_default,$a12_onchange,$a12_title,$a12_class) ?></td><?php $a11_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a11_header) ?><?php $a12_list='languages';$a12_name='languageid';$a12_default=$defaultlanguageid;$a12_onchange='';$a12_title='';$a12_class=''; ?><?php $a12_tmp_list = $$a12_list;
		if	( isset($$a12_name) && isset($a12_tmp_list[$$a12_name]) )
			$a12_tmp_default = $$a12_name;
		elseif ( isset($a12_default) )
			$a12_tmp_default = $a12_default;
		else
			$a12_tmp_default = '';
		foreach( $a12_tmp_list as $box_key=>$box_value )
		{
			$box_value = is_array($box_value)?(isset($box_value['lang'])?langHtml($box_value['lang']):$box_value['value']):$box_value;
			$id = 'id_'.$a12_name.'_'.$box_key;
			echo '<input id="'.$id.'" name="'.$a12_name.'" type="radio" class="'.$a12_class.'" value="'.$box_key.'"';
			if ($box_key==$a12_tmp_default)
				echo ' checked="checked"';
			echo ' />&nbsp;<label for="'.$id.'">'.$box_value.'</label><br />';
		}
?><?php unset($a12_list,$a12_name,$a12_default,$a12_onchange,$a12_title,$a12_class) ?></td><?php $a11_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a11_header) ?><?php $a12_type='ok';$a12_class='ok';$a12_value='ok';$a12_text=lang('start'); ?><div class="invisible">
<?php
		if ($this->isEditable() && !$this->isEditMode() && !readonly() )
		{
			$a12_type = ''; // Knopf nicht anzeigen
			?><a class="action" href="<?php echo Html::url($actionName,$subactionName,0,array('mode'=>'edit')) ?>"><span title="<?php echo lang('MODE_EDIT_DESC') ?>"><?php echo langHtml('MODE_EDIT') ?></span></a><?php
		} else
		{
			$a12_type = 'submit';
		}
		$a12_tmp_src  = '';
	if	( !empty($a12_type)) { 
?>
<input type="<?php echo $a12_type ?>"<?php if(isset($a12_src)) { ?> src="<?php $a12_tmp_src ?>"<?php } ?> name="<?php echo $a12_value ?>" class="ok" title="<?php echo lang($a12_text.'_DESC') ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo langHtml($a12_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($a12_src); ?>
<?php }
		if ($this->isEditable() && $this->isEditMode() )
		{
			?><a class="action" href="<?php echo Html::url($actionName,$subactionName,0,array('mode'=>'')) ?>"><span title="<?php echo lang('CANCEL_DESC') ?>"><?php echo langHtml('CANCEL') ?></span></a><?php
		}
?>
</div><?php unset($a12_type,$a12_class,$a12_value,$a12_text) ?></td></tr><?php
	$column_idx = $last_column_idx;
?>
</table></form>
</fieldset></td></tr><?php } ?><?php if (false) { ?>
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