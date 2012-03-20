<?php $a2_equals='folder';$a2_value=$type; ?><?php 
	$a2_tmp_exec = $a2_equals == $a2_value;
	$a2_tmp_last_exec = $a2_tmp_exec;
	if	( $a2_tmp_exec )
	{
?>
<?php unset($a2_equals,$a2_value) ?><?php $a3_name='';$a3_views='inherit,aclform';$a3_back=false; ?><div class="header">
  <?php if ($a3_back) { ?>
  <a href="javascript:void(0);" onclick="javascript:refreshActualView(this);" class="back button">
    <img src="<?php  echo $image_dir ?>icon/window/back.gif" />
    <?php echo lang('BACK') ?>
  </a>
  <?php } ?><?php if(!empty($a3_views)) { ?>
  <img src="<?php  echo $image_dir ?>icon/window/down.gif" />
  <div class="headermenu">
    <?php foreach( explode(',',$a3_views) as $a3_tmp_view ) { ?>
	<a class="entry" href="javascript:void(0);" onclick="javascript:startView(this,'<?php echo $a3_tmp_view ?>');">
	  <img src="<?php  echo $image_dir ?>icon/<?php echo $a3_tmp_view ?>.png" /><?php echo lang('MENU_'.$a3_tmp_view) ?>
	</a>
    <?php } ?>
  </div>
<?php } ?>
</div><?php unset($a3_name,$a3_views,$a3_back) ?><?php } ?><?php if (!$a2_tmp_last_exec) { ?>
<?php $a3_name='';$a3_views='aclform';$a3_back=false; ?><div class="header">
  <?php if ($a3_back) { ?>
  <a href="javascript:void(0);" onclick="javascript:refreshActualView(this);" class="back button">
    <img src="<?php  echo $image_dir ?>icon/window/back.gif" />
    <?php echo lang('BACK') ?>
  </a>
  <?php } ?><?php if(!empty($a3_views)) { ?>
  <img src="<?php  echo $image_dir ?>icon/window/down.gif" />
  <div class="headermenu">
    <?php foreach( explode(',',$a3_views) as $a3_tmp_view ) { ?>
	<a class="entry" href="javascript:void(0);" onclick="javascript:startView(this,'<?php echo $a3_tmp_view ?>');">
	  <img src="<?php  echo $image_dir ?>icon/<?php echo $a3_tmp_view ?>.png" /><?php echo lang('MENU_'.$a3_tmp_view) ?>
	</a>
    <?php } ?>
  </div>
<?php } ?>
</div><?php unset($a3_name,$a3_views,$a3_back) ?><?php }
unset($a1_tmp_last_exec) ?><?php $a2_width='100%';$a2_space='0px';$a2_padding='0px'; ?><?php
	$last_column_idx = @$column_idx;
	$column_idx = 0;
	$coloumn_widths = array();
	$row_classes    = array();
	$column_classes = array();
?><table class="%class%" cellspacing="0px" width="100%" cellpadding="0px">
<?php unset($a2_width,$a2_space,$a2_padding) ?><?php $a3_class='headline'; ?><?php
	$column_idx = 0;
?>
<tr
 class="headline"
>
<?php unset($a3_class) ?><?php $a4_class='help';$a4_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="help"
><?php unset($a4_class,$a4_header) ?><?php $a5_class='text';$a5_key='GLOBAL_NAME';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = $langF($a5_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_key,$a5_escape,$a5_cut) ?></td><?php $a4_class='help';$a4_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="help"
><?php unset($a4_class,$a4_header) ?><?php $a5_class='text';$a5_key='GLOBAL_LANGUAGE';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = $langF($a5_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_key,$a5_escape,$a5_cut) ?></td><?php $a4_list='show';$a4_extract=false;$a4_key='list_key';$a4_value='t'; ?><?php
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
?><?php unset($a4_list,$a4_extract,$a4_key,$a4_value) ?><?php $a5_class='help';$a5_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="help"
><?php unset($a5_class,$a5_header) ?><?php $a6_class='text';$a6_key=$t;$a6_suffix='_abbrev';$a6_prefix='acl_';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_key = $a6_prefix.$a6_key;
		$a6_key = $a6_key.$a6_suffix;
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_key,$a6_suffix,$a6_prefix,$a6_escape,$a6_cut) ?></td><?php } ?><?php $a4_class='help';$a4_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="help"
><?php unset($a4_class,$a4_header) ?><?php $a5_class='text';$a5_key='global_delete';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = $langF($a5_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_key,$a5_escape,$a5_cut) ?></td></tr><?php $a3_empty='acls'; ?><?php 
	if	( !isset($$a3_empty) )
		$a3_tmp_exec = empty($a3_empty);
	elseif	( is_array($$a3_empty) )
		$a3_tmp_exec = (count($$a3_empty)==0);
	elseif	( is_bool($$a3_empty) )
		$a3_tmp_exec = true;
	else
		$a3_tmp_exec = empty( $$a3_empty );
	$a3_tmp_last_exec = $a3_tmp_exec;
	if	( $a3_tmp_exec )
	{
?>
<?php unset($a3_empty) ?><?php $a4_class='data'; ?><?php
	$column_idx = 0;
?>
<tr
 class="data"
>
<?php unset($a4_class) ?><?php $a5_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a5_header) ?><?php $a6_class='text';$a6_text='GLOBAL_NOT_FOUND';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_text,$a6_escape,$a6_cut) ?></td></tr><?php } ?><?php $a3_not=true;$a3_empty='acls'; ?><?php 
	if	( !isset($$a3_empty) )
		$a3_tmp_exec = empty($a3_empty);
	elseif	( is_array($$a3_empty) )
		$a3_tmp_exec = (count($$a3_empty)==0);
	elseif	( is_bool($$a3_empty) )
		$a3_tmp_exec = true;
	else
		$a3_tmp_exec = empty( $$a3_empty );
	$a3_tmp_exec = !$a3_tmp_exec;
	$a3_tmp_last_exec = $a3_tmp_exec;
	if	( $a3_tmp_exec )
	{
?>
<?php unset($a3_not,$a3_empty) ?><?php } ?><?php $a3_list='acls';$a3_extract=true;$a3_key='aclid';$a3_value='acl'; ?><?php
	$a3_list_tmp_key   = $a3_key;
	$a3_list_tmp_value = $a3_value;
	$a3_list_extract   = $a3_extract;
	unset($a3_key);
	unset($a3_value);
	if	( !isset($$a3_list) || !is_array($$a3_list) )
		$$a3_list = array();
	foreach( $$a3_list as $$a3_list_tmp_key => $$a3_list_tmp_value )
	{
		if	( $a3_list_extract )
		{
			if	( !is_array($$a3_list_tmp_value) )
			{
				print_r($$a3_list_tmp_value);
				die( 'not an array at key: '.$$a3_list_tmp_key );
			}
			extract($$a3_list_tmp_value);
		}
?><?php unset($a3_list,$a3_extract,$a3_key,$a3_value) ?><?php $a4_class='data'; ?><?php
	$column_idx = 0;
?>
<tr
 class="data"
>
<?php unset($a4_class) ?><?php $a5_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a5_header) ?><?php $a6_present='username'; ?><?php 
	$a6_tmp_exec = isset($$a6_present);
	$a6_tmp_last_exec = $a6_tmp_exec;
	if	( $a6_tmp_exec )
	{
?>
<?php unset($a6_present) ?><?php $a7_align='left';$a7_type='user'; ?><?php
	$a7_tmp_image_file = $image_dir.'icon_'.$a7_type.IMG_ICON_EXT;
	$a7_size = '16x16';
	$a7_tmp_title = basename($a7_tmp_image_file);
?><img alt="<?php echo $a7_tmp_title; if (isset($a7_size)) { echo ' ('; list($a7_tmp_width,$a7_tmp_height)=explode('x',$a7_size);echo $a7_tmp_width.'x'.$a7_tmp_height; echo')';} ?>" src="<?php echo $a7_tmp_image_file ?>" border="0"<?php if(isset($a7_align)) echo ' align="'.$a7_align.'"' ?><?php if (isset($a7_size)) { list($a7_tmp_width,$a7_tmp_height)=explode('x',$a7_size);echo ' width="'.$a7_tmp_width.'" height="'.$a7_tmp_height.'"';} ?> /><?php unset($a7_align,$a7_type) ?><?php $a7_class='text';$a7_var='username';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = isset($$a7_var)?$$a7_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_var,$a7_escape,$a7_cut) ?><?php } ?><?php $a6_present='groupname'; ?><?php 
	$a6_tmp_exec = isset($$a6_present);
	$a6_tmp_last_exec = $a6_tmp_exec;
	if	( $a6_tmp_exec )
	{
?>
<?php unset($a6_present) ?><?php $a7_align='left';$a7_type='group'; ?><?php
	$a7_tmp_image_file = $image_dir.'icon_'.$a7_type.IMG_ICON_EXT;
	$a7_size = '16x16';
	$a7_tmp_title = basename($a7_tmp_image_file);
?><img alt="<?php echo $a7_tmp_title; if (isset($a7_size)) { echo ' ('; list($a7_tmp_width,$a7_tmp_height)=explode('x',$a7_size);echo $a7_tmp_width.'x'.$a7_tmp_height; echo')';} ?>" src="<?php echo $a7_tmp_image_file ?>" border="0"<?php if(isset($a7_align)) echo ' align="'.$a7_align.'"' ?><?php if (isset($a7_size)) { list($a7_tmp_width,$a7_tmp_height)=explode('x',$a7_size);echo ' width="'.$a7_tmp_width.'" height="'.$a7_tmp_height.'"';} ?> /><?php unset($a7_align,$a7_type) ?><?php $a7_class='text';$a7_var='groupname';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = isset($$a7_var)?$$a7_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_var,$a7_escape,$a7_cut) ?><?php } ?><?php $a6_not=true;$a6_present='username'; ?><?php 
	$a6_tmp_exec = isset($$a6_present);
	$a6_tmp_exec = !$a6_tmp_exec;
	$a6_tmp_last_exec = $a6_tmp_exec;
	if	( $a6_tmp_exec )
	{
?>
<?php unset($a6_not,$a6_present) ?><?php $a7_not=true;$a7_present='groupname'; ?><?php 
	$a7_tmp_exec = isset($$a7_present);
	$a7_tmp_exec = !$a7_tmp_exec;
	$a7_tmp_last_exec = $a7_tmp_exec;
	if	( $a7_tmp_exec )
	{
?>
<?php unset($a7_not,$a7_present) ?><?php $a8_align='left';$a8_type='group'; ?><?php
	$a8_tmp_image_file = $image_dir.'icon_'.$a8_type.IMG_ICON_EXT;
	$a8_size = '16x16';
	$a8_tmp_title = basename($a8_tmp_image_file);
?><img alt="<?php echo $a8_tmp_title; if (isset($a8_size)) { echo ' ('; list($a8_tmp_width,$a8_tmp_height)=explode('x',$a8_size);echo $a8_tmp_width.'x'.$a8_tmp_height; echo')';} ?>" src="<?php echo $a8_tmp_image_file ?>" border="0"<?php if(isset($a8_align)) echo ' align="'.$a8_align.'"' ?><?php if (isset($a8_size)) { list($a8_tmp_width,$a8_tmp_height)=explode('x',$a8_size);echo ' width="'.$a8_tmp_width.'" height="'.$a8_tmp_height.'"';} ?> /><?php unset($a8_align,$a8_type) ?><?php $a8_class='text';$a8_key='global_all';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_key,$a8_escape,$a8_cut) ?><?php } ?><?php } ?></td><?php $a5_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a5_header) ?><?php $a6_class='text';$a6_var='languagename';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = isset($$a6_var)?$$a6_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_var,$a6_escape,$a6_cut) ?></td><?php $a5_list='show';$a5_extract=false;$a5_key='list_key';$a5_value='t'; ?><?php
	$a5_list_tmp_key   = $a5_key;
	$a5_list_tmp_value = $a5_value;
	$a5_list_extract   = $a5_extract;
	unset($a5_key);
	unset($a5_value);
	if	( !isset($$a5_list) || !is_array($$a5_list) )
		$$a5_list = array();
	foreach( $$a5_list as $$a5_list_tmp_key => $$a5_list_tmp_value )
	{
		if	( $a5_list_extract )
		{
			if	( !is_array($$a5_list_tmp_value) )
			{
				print_r($$a5_list_tmp_value);
				die( 'not an array at key: '.$$a5_list_tmp_key );
			}
			extract($$a5_list_tmp_value);
		}
?><?php unset($a5_list,$a5_extract,$a5_key,$a5_value) ?><?php $a6_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a6_header) ?><?php $a7_default=false;$a7_readonly=true;$a7_name=$t; ?><?php
	if ($this->isEditable() && !$this->isEditMode()) $a7_readonly=true;
	if	( isset($$a7_name) )
		$checked = $$a7_name;
	else
		$checked = $a7_default;
?><input class="checkbox" type="checkbox" id="id_<?php echo $a7_name ?>" name="<?php echo $a7_name  ?>"  <?php if ($a7_readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?><?php if (in_array($a7_name,$errors)) echo ' style="background-color:red;"' ?> /><?php
if ( $a7_readonly && $checked )
{ 
?><input type="hidden" name="<?php echo $a7_name ?>" value="1" /><?php
}
?><?php unset($a7_name); unset($a7_readonly); unset($a7_default); ?><?php unset($a7_default,$a7_readonly,$a7_name) ?></td><?php } ?><?php $a5_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a5_header) ?><?php $a6_title='';$a6_type='post';$a6_class='';$a6_subaction='delacl';$a6_id=$aclid;$a6_frame='_self'; ?><?php
	$params = array();
	$tmp_url = '';
	$a6_target = $view;
	switch( $a6_type )
	{
		case 'post':
			$json = new JSON();
			$tmp_data = $json->encode( array('action'=>!empty($a6_action)?$a6_action:$this->actionName,'subaction'=>!empty($a6_subaction)?$a6_subaction:$this->subActionName,'id'=>!empty($a6_id)?$a6_id:$this->getRequestId())
		                          +array(REQ_PARAM_TOKEN=>token())
		                          +$params );
			$tmp_function_call = "submitLink(this,'".str_replace("\n",'',str_replace('"','&quot;',$tmp_data))."');";
			break;
		case 'view':
			$tmp_function_call = "startView(this,'".(!empty($a6_subaction)?$a6_subaction:$this->subActionName)."');";
			break;
		case 'url':
			$tmp_function_call = "submitUrl(this,'".($a6_url)."');";
			break;
		case 'external':
			$tmp_function_call = "location.href='".$a6_url."';";
			break;
		case 'popup':
			$tmp_function_call = "window.open('".$a6_url."', 'Popup', 'location=no,menubar=no,scrollbars=yes,toolbar=no,resizable=yes');";
			break;
		default:
			$tmp_function_call = "alert('TODO');";
	}
?><a target="<?php echo $a6_frame ?>"<?php if (isset($a6_name)) { ?> name="<?php echo $a6_name ?>"<?php }else{ ?> href="javascript:void(0);" onclick="<?php echo $tmp_function_call ?>" <?php } ?> class="<?php echo $a6_class ?>"<?php if (isset($a6_accesskey)) echo ' accesskey="'.$a6_accesskey.'"' ?>  title="<?php echo encodeHtml($a6_title) ?>"><?php unset($a6_title,$a6_type,$a6_class,$a6_subaction,$a6_id,$a6_frame) ?><?php $a7_class='text';$a7_key='GLOBAL_DELETE';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_key,$a7_escape,$a7_cut) ?></a></td></tr><?php } ?><?php
	$column_idx = $last_column_idx;
?>
</table>