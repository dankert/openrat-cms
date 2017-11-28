<!-- Compiling output/output-begin @ Tue, 28 Nov 2017 22:02:39 +0100 --><!-- Compiling if/if-begin @ Tue, 28 Nov 2017 22:02:39 +0100 --><?php $a2_equals='folder';$a2_value=$type; ?><?php 
	$a2_tmp_exec = $a2_equals == $a2_value;
	$a2_tmp_last_exec = $a2_tmp_exec;
	if	( $a2_tmp_exec )
	{
?>
<?php unset($a2_equals,$a2_value) ?><!-- Compiling header/header-begin @ Tue, 28 Nov 2017 22:02:39 +0100 --><?php $a3_name='';$a3_views='inherit,aclform';$a3_back=false; ?><?php if(!empty($a3_views)) { ?>
  <div class="headermenu">
    <?php foreach( explode(',',$a3_views) as $a3_tmp_view ) { ?>
  	<div class="toolbar-icon clickable">
    <a href="javascript:void(0);" data-type="dialog" data-name="<?php echo lang('MENU_'.$a3_tmp_view) ?>" data-method="<?php echo $a3_tmp_view ?>">
		  <img src="<?php  echo $image_dir ?>icon/<?php echo $a3_tmp_view ?>.png" title="<?php echo lang('MENU_'.$a3_tmp_view.'_DESC') ?>" /> <?php echo lang('MENU_'.$a3_tmp_view) ?>
		</a>
  </div>
		<?php } ?>
  </div>
<?php } ?>
<?php unset($a3_name,$a3_views,$a3_back) ?><!-- Compiling if/if-end @ Tue, 28 Nov 2017 22:02:39 +0100 --><?php } ?><!-- Compiling else/else-begin @ Tue, 28 Nov 2017 22:02:39 +0100 --><?php if (!$a2_tmp_last_exec) { ?>
<!-- Compiling header/header-begin @ Tue, 28 Nov 2017 22:02:39 +0100 --><?php $a3_name='';$a3_views='aclform';$a3_back=false; ?><?php if(!empty($a3_views)) { ?>
  <div class="headermenu">
    <?php foreach( explode(',',$a3_views) as $a3_tmp_view ) { ?>
  	<div class="toolbar-icon clickable">
    <a href="javascript:void(0);" data-type="dialog" data-name="<?php echo lang('MENU_'.$a3_tmp_view) ?>" data-method="<?php echo $a3_tmp_view ?>">
		  <img src="<?php  echo $image_dir ?>icon/<?php echo $a3_tmp_view ?>.png" title="<?php echo lang('MENU_'.$a3_tmp_view.'_DESC') ?>" /> <?php echo lang('MENU_'.$a3_tmp_view) ?>
		</a>
  </div>
		<?php } ?>
  </div>
<?php } ?>
<?php unset($a3_name,$a3_views,$a3_back) ?><!-- Compiling else/else-end @ Tue, 28 Nov 2017 22:02:39 +0100 --><?php }
unset($a2_tmp_last_exec) ?><!-- Compiling table/table-begin @ Tue, 28 Nov 2017 22:02:39 +0100 --><?php $a2_width='100%';$a2_space='0px';$a2_padding='0px'; ?><?php
	$last_column_idx = @$column_idx;
	$column_idx = 0;
	$coloumn_widths = array();
	$row_classes    = array();
	$column_classes = array();
?><table class="%class%" cellspacing="0px" width="100%" cellpadding="0px">
<?php unset($a2_width,$a2_space,$a2_padding) ?><!-- Compiling row/row-begin @ Tue, 28 Nov 2017 22:02:39 +0100 --><?php $a3_class='headline'; ?><?php
	$column_idx = 0;
?>
<tr
 class="headline"
>
<?php unset($a3_class) ?><td class="help"><!-- Compiling text/text-begin @ Tue, 28 Nov 2017 22:02:39 +0100 --><?php $a5_class='text';$a5_key='GLOBAL_NAME';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = $langF($a5_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_key,$a5_escape,$a5_cut) ?></td><td class="help"><!-- Compiling text/text-begin @ Tue, 28 Nov 2017 22:02:39 +0100 --><?php $a5_class='text';$a5_key='GLOBAL_LANGUAGE';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = $langF($a5_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_key,$a5_escape,$a5_cut) ?></td><!-- Compiling list/list-begin @ Tue, 28 Nov 2017 22:02:39 +0100 --><?php $a4_list='show';$a4_extract=false;$a4_key='list_key';$a4_value='t'; ?><?php
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
?><?php unset($a4_list,$a4_extract,$a4_key,$a4_value) ?><td class="help"><!-- Compiling text/text-begin @ Tue, 28 Nov 2017 22:02:39 +0100 --><?php $a6_class='text';$a6_key=$t;$a6_suffix='_abbrev';$a6_prefix='acl_';$a6_escape=true;$a6_cut='both'; ?><?php
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
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_key,$a6_suffix,$a6_prefix,$a6_escape,$a6_cut) ?></td><!-- Compiling list/list-end @ Tue, 28 Nov 2017 22:02:39 +0100 --><?php } ?><td class="help"><!-- Compiling text/text-begin @ Tue, 28 Nov 2017 22:02:39 +0100 --><?php $a5_class='text';$a5_key='global_delete';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = $langF($a5_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_key,$a5_escape,$a5_cut) ?></td><!-- Compiling row/row-end @ Tue, 28 Nov 2017 22:02:39 +0100 --></tr><!-- Compiling if/if-begin @ Tue, 28 Nov 2017 22:02:39 +0100 --><?php $a3_empty='acls'; ?><?php 
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
<?php unset($a3_empty) ?><!-- Compiling row/row-begin @ Tue, 28 Nov 2017 22:02:39 +0100 --><?php $a4_class='data'; ?><?php
	$column_idx = 0;
?>
<tr
 class="data"
>
<?php unset($a4_class) ?><td colspan="99"><!-- Compiling text/text-begin @ Tue, 28 Nov 2017 22:02:39 +0100 --><?php $a6_class='text';$a6_text='GLOBAL_NOT_FOUND';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_text,$a6_escape,$a6_cut) ?></td><!-- Compiling row/row-end @ Tue, 28 Nov 2017 22:02:39 +0100 --></tr><!-- Compiling if/if-end @ Tue, 28 Nov 2017 22:02:39 +0100 --><?php } ?><!-- Compiling if/if-begin @ Tue, 28 Nov 2017 22:02:39 +0100 --><?php $a3_not=true;$a3_empty='acls'; ?><?php 
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
<?php unset($a3_not,$a3_empty) ?><!-- Compiling if/if-end @ Tue, 28 Nov 2017 22:02:39 +0100 --><?php } ?><!-- Compiling list/list-begin @ Tue, 28 Nov 2017 22:02:39 +0100 --><?php $a3_list='acls';$a3_extract=true;$a3_key='aclid';$a3_value='acl'; ?><?php
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
?><?php unset($a3_list,$a3_extract,$a3_key,$a3_value) ?><!-- Compiling row/row-begin @ Tue, 28 Nov 2017 22:02:39 +0100 --><?php $a4_class='data'; ?><?php
	$column_idx = 0;
?>
<tr
 class="data"
>
<?php unset($a4_class) ?><td><!-- Compiling if/if-begin @ Tue, 28 Nov 2017 22:02:39 +0100 --><?php $a6_present='username'; ?><?php 
	$a6_tmp_exec = isset($$a6_present);
	$a6_tmp_last_exec = $a6_tmp_exec;
	if	( $a6_tmp_exec )
	{
?>
<?php unset($a6_present) ?><img class="" title="" src="./themes/default/images/icon_user.png" /><!-- Compiling text/text-begin @ Tue, 28 Nov 2017 22:02:39 +0100 --><?php $a7_class='text';$a7_var='username';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = isset($$a7_var)?$$a7_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_var,$a7_escape,$a7_cut) ?><!-- Compiling if/if-end @ Tue, 28 Nov 2017 22:02:39 +0100 --><?php } ?><!-- Compiling if/if-begin @ Tue, 28 Nov 2017 22:02:39 +0100 --><?php $a6_present='groupname'; ?><?php 
	$a6_tmp_exec = isset($$a6_present);
	$a6_tmp_last_exec = $a6_tmp_exec;
	if	( $a6_tmp_exec )
	{
?>
<?php unset($a6_present) ?><img class="" title="" src="./themes/default/images/icon_group.png" /><!-- Compiling text/text-begin @ Tue, 28 Nov 2017 22:02:39 +0100 --><?php $a7_class='text';$a7_var='groupname';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = isset($$a7_var)?$$a7_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_var,$a7_escape,$a7_cut) ?><!-- Compiling if/if-end @ Tue, 28 Nov 2017 22:02:39 +0100 --><?php } ?><!-- Compiling if/if-begin @ Tue, 28 Nov 2017 22:02:39 +0100 --><?php $a6_not=true;$a6_present='username'; ?><?php 
	$a6_tmp_exec = isset($$a6_present);
	$a6_tmp_exec = !$a6_tmp_exec;
	$a6_tmp_last_exec = $a6_tmp_exec;
	if	( $a6_tmp_exec )
	{
?>
<?php unset($a6_not,$a6_present) ?><!-- Compiling if/if-begin @ Tue, 28 Nov 2017 22:02:39 +0100 --><?php $a7_not=true;$a7_present='groupname'; ?><?php 
	$a7_tmp_exec = isset($$a7_present);
	$a7_tmp_exec = !$a7_tmp_exec;
	$a7_tmp_last_exec = $a7_tmp_exec;
	if	( $a7_tmp_exec )
	{
?>
<?php unset($a7_not,$a7_present) ?><img class="" title="" src="./themes/default/images/icon_group.png" /><!-- Compiling text/text-begin @ Tue, 28 Nov 2017 22:02:39 +0100 --><?php $a8_class='text';$a8_key='global_all';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_key,$a8_escape,$a8_cut) ?><!-- Compiling if/if-end @ Tue, 28 Nov 2017 22:02:39 +0100 --><?php } ?><!-- Compiling if/if-end @ Tue, 28 Nov 2017 22:02:39 +0100 --><?php } ?></td><td><!-- Compiling text/text-begin @ Tue, 28 Nov 2017 22:02:39 +0100 --><?php $a6_class='text';$a6_var='languagename';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = isset($$a6_var)?$$a6_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_var,$a6_escape,$a6_cut) ?></td><!-- Compiling list/list-begin @ Tue, 28 Nov 2017 22:02:39 +0100 --><?php $a5_list='show';$a5_extract=false;$a5_key='list_key';$a5_value='t'; ?><?php
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
?><?php unset($a5_list,$a5_extract,$a5_key,$a5_value) ?><td><?php { $tmpname     = $t;$default  = false;$readonly = true;		
		if	( isset($$tmpname) )
			$checked = $$tmpname;
		else
			$checked = $default;

		?><input class="checkbox" type="checkbox" id="<?php echo REQUEST_ID ?>_<?php echo $tmpname ?>" name="<?php echo $tmpname  ?>"  <?php if ($readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?> /><?php

		if ( $readonly && $checked )
		{ 
		?><input type="hidden" name="<?php echo $tmpname ?>" value="1" /><?php
		}
		} ?></td><!-- Compiling list/list-end @ Tue, 28 Nov 2017 22:02:39 +0100 --><?php } ?><td class="clickable"><!-- Compiling link/link-begin @ Tue, 28 Nov 2017 22:02:39 +0100 --><?php $a6_title='';$a6_type='post';$a6_class='';$a6_subaction='delacl';$a6_var1='aclid';$a6_value1=$aclid;$a6_frame='_self';$a6_modal=false; ?><?php
	$params = array();
		$params[$a6_var1]=$a6_value1;
		$a6_url='';
	$tmp_url = '';
	$a6_target = $view;
	$tmp_href = 'javascript:void(0);';		                          
	switch( $a6_type )
	{
		case 'post':
			$json = new JSON();
			$tmp_data = $json->encode( array('action'=>!empty($a6_action)?$a6_action:$this->actionName,'subaction'=>!empty($a6_subaction)?$a6_subaction:$this->subActionName,'id'=>!empty($a6_id)?$a6_id:$this->getRequestId())
		                          +array(REQ_PARAM_TOKEN=>token())
		                          +$params );
			$tmp_data = str_replace("\n",'',str_replace('"','&quot;',$tmp_data));
			break;
		case 'html';
			$tmp_href = $a6_url;
		default:
			$tmp_data = '';
	}
?><a data-url="<?php echo $a6_url ?>" target="<?php echo $a6_frame ?>"<?php if (isset($a6_name)) { ?> data-name="<?php echo $a6_name ?>" name="<?php echo $a6_name ?>"<?php }else{ ?> href="<?php echo $tmp_href ?>" <?php } ?> class="<?php echo $a6_class ?>" data-id="<?php echo @$a6_id ?>" data-type="<?php echo $a6_type ?>" data-action="<?php echo @$a6_action ?>" data-method="<?php echo @$a6_subaction ?>" data-data="<?php echo $tmp_data ?>" <?php if (isset($a6_accesskey)) echo ' accesskey="'.$a6_accesskey.'"' ?>  title="<?php echo encodeHtml($a6_title) ?>"><?php unset($a6_title,$a6_type,$a6_class,$a6_subaction,$a6_var1,$a6_value1,$a6_frame,$a6_modal) ?><!-- Compiling text/text-begin @ Tue, 28 Nov 2017 22:02:39 +0100 --><?php $a7_class='text';$a7_key='GLOBAL_DELETE';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_key,$a7_escape,$a7_cut) ?><!-- Compiling link/link-end @ Tue, 28 Nov 2017 22:02:39 +0100 --></a></td><!-- Compiling row/row-end @ Tue, 28 Nov 2017 22:02:39 +0100 --></tr><!-- Compiling list/list-end @ Tue, 28 Nov 2017 22:02:39 +0100 --><?php } ?><!-- Compiling row/row-begin @ Tue, 28 Nov 2017 22:02:39 +0100 --><?php $a3_class='data'; ?><?php
	$column_idx = 0;
?>
<tr
 class="data"
>
<?php unset($a3_class) ?><td class="clickable" colspan="99"><!-- Compiling link/link-begin @ Tue, 28 Nov 2017 22:02:39 +0100 --><?php $a5_title='';$a5_type='dialog';$a5_class='';$a5_subaction='aclform';$a5_name=lang('menu_aclform');$a5_frame='_self';$a5_modal=false; ?><?php
	$params = array();
		$a5_url='';
	$tmp_url = '';
	$a5_target = $view;
	$tmp_href = 'javascript:void(0);';		                          
	switch( $a5_type )
	{
		case 'post':
			$json = new JSON();
			$tmp_data = $json->encode( array('action'=>!empty($a5_action)?$a5_action:$this->actionName,'subaction'=>!empty($a5_subaction)?$a5_subaction:$this->subActionName,'id'=>!empty($a5_id)?$a5_id:$this->getRequestId())
		                          +array(REQ_PARAM_TOKEN=>token())
		                          +$params );
			$tmp_data = str_replace("\n",'',str_replace('"','&quot;',$tmp_data));
			break;
		case 'html';
			$tmp_href = $a5_url;
		default:
			$tmp_data = '';
	}
?><a data-url="<?php echo $a5_url ?>" target="<?php echo $a5_frame ?>"<?php if (isset($a5_name)) { ?> data-name="<?php echo $a5_name ?>" name="<?php echo $a5_name ?>"<?php }else{ ?> href="<?php echo $tmp_href ?>" <?php } ?> class="<?php echo $a5_class ?>" data-id="<?php echo @$a5_id ?>" data-type="<?php echo $a5_type ?>" data-action="<?php echo @$a5_action ?>" data-method="<?php echo @$a5_subaction ?>" data-data="<?php echo $tmp_data ?>" <?php if (isset($a5_accesskey)) echo ' accesskey="'.$a5_accesskey.'"' ?>  title="<?php echo encodeHtml($a5_title) ?>"><?php unset($a5_title,$a5_type,$a5_class,$a5_subaction,$a5_name,$a5_frame,$a5_modal) ?><img class="" title="" src="./themes/default/images/icon/add.png" /><!-- Compiling text/text-begin @ Tue, 28 Nov 2017 22:02:39 +0100 --><?php $a6_class='text';$a6_text='new';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_text,$a6_escape,$a6_cut) ?><!-- Compiling link/link-end @ Tue, 28 Nov 2017 22:02:39 +0100 --></a></td><!-- Compiling row/row-end @ Tue, 28 Nov 2017 22:02:39 +0100 --></tr><!-- Compiling table/table-end @ Tue, 28 Nov 2017 22:02:39 +0100 --><?php
	$column_idx = $last_column_idx;
?>
</table>