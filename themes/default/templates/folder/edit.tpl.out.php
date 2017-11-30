<!-- Compiling output/output-begin --><!-- Compiling header/header-begin --><?php $a2_name='';$a2_views='order';$a2_back=false; ?><?php if(!empty($a2_views)) { ?>
  <div class="headermenu">
    <?php foreach( explode(',',$a2_views) as $a2_tmp_view ) { ?>
  	<div class="toolbar-icon clickable">
    <a href="javascript:void(0);" data-type="dialog" data-name="<?php echo lang('MENU_'.$a2_tmp_view) ?>" data-method="<?php echo $a2_tmp_view ?>">
		  <img src="<?php  echo $image_dir ?>icon/<?php echo $a2_tmp_view ?>.png" title="<?php echo lang('MENU_'.$a2_tmp_view.'_DESC') ?>" /> <?php echo lang('MENU_'.$a2_tmp_view) ?>
		</a>
  </div>
		<?php } ?>
  </div>
<?php } ?>
<?php unset($a2_name,$a2_views,$a2_back) ?>
		<form name=""
      target="_self"
      action="folder"
      data-method="edit"
      data-action="folder"
      data-id="<?php echo OR_ID ?>"
      method="edit"
      enctype="application/x-www-form-urlencoded"
      class="folder"
      data-async=""
      data-autosave=""
      onSubmit="formSubmit( $(this) ); return false;"><input type="submit" class="invisible" />
      
<input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="folder" />
<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="edit" />
<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
<?php
		if	( $conf['interface']['url_sessionid'] )
			echo '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";
?>

			<table width="100%'><!-- Compiling row/row-begin --><?php $a4_class='headline'; ?><?php
	$column_idx = 0;
?>
<tr
 class="headline"
>
<?php unset($a4_class) ?>
					<td class="help">
						<?php { $tmpname     = 'checkall';$default  = '';$readonly = '';		
		if	( isset($$tmpname) )
			$checked = $$tmpname;
		else
			$checked = $default;

		?><input class="checkbox" type="checkbox" id="<?php echo REQUEST_ID ?>_<?php echo $tmpname ?>" name="<?php echo $tmpname  ?>"  <?php if ($readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?> /><?php

		if ( $readonly && $checked )
		{ 
		?><input type="hidden" name="<?php echo $tmpname ?>" value="1" /><?php
		}
		} ?>
						
					</td>
					<td class="help">
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'GLOBAL_TYPE'.'')))); ?></span>
						
						<span class="text"><?php echo nl2br('&nbsp;/&nbsp;'); ?></span>
						
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'GLOBAL_NAME'.'')))); ?></span>
						
					</td><!-- Compiling row/row-end --></tr><!-- Compiling list/list-begin --><?php $a4_list='object';$a4_extract=true;$a4_key='list_key';$a4_value='list_value'; ?><?php
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
?><?php unset($a4_list,$a4_extract,$a4_key,$a4_value) ?><!-- Compiling row/row-begin --><?php $a5_class='data'; ?><?php
	$column_idx = 0;
?>
<tr
 class="data"
>
<?php unset($a5_class) ?>
						<td width="1%">
							<?php $if7=('writable'); if($if7){?>
								<?php { $tmpname     = $id;$default  = '';$readonly = '';		
		if	( isset($$tmpname) )
			$checked = $$tmpname;
		else
			$checked = $default;

		?><input class="checkbox" type="checkbox" id="<?php echo REQUEST_ID ?>_<?php echo $tmpname ?>" name="<?php echo $tmpname  ?>"  <?php if ($readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?> /><?php

		if ( $readonly && $checked )
		{ 
		?><input type="hidden" name="<?php echo $tmpname ?>" value="1" /><?php
		}
		} ?>
								
							<?php } ?>
							<?php $if7=(!'writable'); if($if7){?>
								<span class="text"><?php echo nl2br('&nbsp;'); ?></span>
								
							<?php } ?>
						</td>
						<td class="clickable"><!-- Compiling label/label-begin --><?php $a7_for=$id; ?><label<?php if (isset($a7_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a7_for ?><?php if (!empty($a7_value)) echo '_'.$a7_value ?>" <?php if(hasLang(@$a7_key.'_desc')) { ?> title="<?php echo lang(@$a7_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a7_key)) { echo lang($a7_key); ?><?php if (isset($a7_text)) { echo $a7_text; } ?><?php } ?><?php unset($a7_for) ?><!-- Compiling link/link-begin --><?php $a8_title='';$a8_type='open';$a8_class='';$a8_action=$type;$a8_id=$objectid;$a8_name=$name;$a8_frame='_self';$a8_modal=false; ?><?php
	$params = array();
		$a8_url='';
	$tmp_url = '';
	$a8_target = $view;
	$tmp_href = 'javascript:void(0);';		                          
	switch( $a8_type )
	{
		case 'post':
			$json = new JSON();
			$tmp_data = $json->encode( array('action'=>!empty($a8_action)?$a8_action:$this->actionName,'subaction'=>!empty($a8_subaction)?$a8_subaction:$this->subActionName,'id'=>!empty($a8_id)?$a8_id:$this->getRequestId())
		                          +array(REQ_PARAM_TOKEN=>token())
		                          +$params );
			$tmp_data = str_replace("\n",'',str_replace('"','&quot;',$tmp_data));
			break;
		case 'html';
			$tmp_href = $a8_url;
		default:
			$tmp_data = '';
	}
?><a data-url="<?php echo $a8_url ?>" target="<?php echo $a8_frame ?>"<?php if (isset($a8_name)) { ?> data-name="<?php echo $a8_name ?>" name="<?php echo $a8_name ?>"<?php }else{ ?> href="<?php echo $tmp_href ?>" <?php } ?> class="<?php echo $a8_class ?>" data-id="<?php echo @$a8_id ?>" data-type="<?php echo $a8_type ?>" data-action="<?php echo @$a8_action ?>" data-method="<?php echo @$a8_subaction ?>" data-data="<?php echo $tmp_data ?>" <?php if (isset($a8_accesskey)) echo ' accesskey="'.$a8_accesskey.'"' ?>  title="<?php echo encodeHtml($a8_title) ?>"><?php unset($a8_title,$a8_type,$a8_class,$a8_action,$a8_id,$a8_name,$a8_frame,$a8_modal) ?>
									<img class="" title="" src="./themes/default/images/icon_<?php echo $icon ?>.png" />
									
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(Text::maxLength( $name,40,'..',constant('STR_PAD_BOTH') )))); ?></span>
									
									<span class="text"><?php echo nl2br('&nbsp;'); ?></span>
									<!-- Compiling link/link-end --></a><!-- Compiling label/label-end --></label>
						</td><!-- Compiling row/row-end --></tr><!-- Compiling list/list-end --><?php } ?>
				<?php $if4=(empty($object)); if($if4){?><!-- Compiling row/row-begin --><?php
	$column_idx = 0;
?>
<tr
>

						<td colspan="2">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_NOT_FOUND')))); ?></span>
							
						</td><!-- Compiling row/row-end --></tr>
				<?php } ?><!-- Compiling row/row-begin --><?php $a4_class='data'; ?><?php
	$column_idx = 0;
?>
<tr
 class="data"
>
<?php unset($a4_class) ?>
					<td>
						<span class="text"><?php echo nl2br('&nbsp;'); ?></span>
						
					</td>
					<td class="clickable" colspan="2"><!-- Compiling link/link-begin --><?php $a6_title='';$a6_type='view';$a6_class='';$a6_action='folder';$a6_subaction='createfolder';$a6_frame='_self';$a6_modal=false; ?><?php
	$params = array();
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
?><a data-url="<?php echo $a6_url ?>" target="<?php echo $a6_frame ?>"<?php if (isset($a6_name)) { ?> data-name="<?php echo $a6_name ?>" name="<?php echo $a6_name ?>"<?php }else{ ?> href="<?php echo $tmp_href ?>" <?php } ?> class="<?php echo $a6_class ?>" data-id="<?php echo @$a6_id ?>" data-type="<?php echo $a6_type ?>" data-action="<?php echo @$a6_action ?>" data-method="<?php echo @$a6_subaction ?>" data-data="<?php echo $tmp_data ?>" <?php if (isset($a6_accesskey)) echo ' accesskey="'.$a6_accesskey.'"' ?>  title="<?php echo encodeHtml($a6_title) ?>"><?php unset($a6_title,$a6_type,$a6_class,$a6_action,$a6_subaction,$a6_frame,$a6_modal) ?>
							<img class="" title="" src="./themes/default/images/icon/icon/create.png" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_folder_createfolder'.'')))); ?></span>
							<!-- Compiling link/link-end --></a>
					</td><!-- Compiling row/row-end --></tr><!-- Compiling row/row-begin --><?php $a4_class='data'; ?><?php
	$column_idx = 0;
?>
<tr
 class="data"
>
<?php unset($a4_class) ?>
					<td>
						<span class="text"><?php echo nl2br('&nbsp;'); ?></span>
						
					</td>
					<td class="clickable" colspan="2"><!-- Compiling link/link-begin --><?php $a6_title='';$a6_type='view';$a6_class='';$a6_action='folder';$a6_subaction='createpage';$a6_frame='_self';$a6_modal=false; ?><?php
	$params = array();
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
?><a data-url="<?php echo $a6_url ?>" target="<?php echo $a6_frame ?>"<?php if (isset($a6_name)) { ?> data-name="<?php echo $a6_name ?>" name="<?php echo $a6_name ?>"<?php }else{ ?> href="<?php echo $tmp_href ?>" <?php } ?> class="<?php echo $a6_class ?>" data-id="<?php echo @$a6_id ?>" data-type="<?php echo $a6_type ?>" data-action="<?php echo @$a6_action ?>" data-method="<?php echo @$a6_subaction ?>" data-data="<?php echo $tmp_data ?>" <?php if (isset($a6_accesskey)) echo ' accesskey="'.$a6_accesskey.'"' ?>  title="<?php echo encodeHtml($a6_title) ?>"><?php unset($a6_title,$a6_type,$a6_class,$a6_action,$a6_subaction,$a6_frame,$a6_modal) ?>
							<img class="" title="" src="./themes/default/images/icon/icon/create.png" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_folder_createpage'.'')))); ?></span>
							<!-- Compiling link/link-end --></a>
					</td><!-- Compiling row/row-end --></tr><!-- Compiling row/row-begin --><?php $a4_class='data'; ?><?php
	$column_idx = 0;
?>
<tr
 class="data"
>
<?php unset($a4_class) ?>
					<td>
						<span class="text"><?php echo nl2br('&nbsp;'); ?></span>
						
					</td>
					<td class="clickable" colspan="2"><!-- Compiling link/link-begin --><?php $a6_title='';$a6_type='view';$a6_class='';$a6_action='folder';$a6_subaction='createfile';$a6_frame='_self';$a6_modal=false; ?><?php
	$params = array();
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
?><a data-url="<?php echo $a6_url ?>" target="<?php echo $a6_frame ?>"<?php if (isset($a6_name)) { ?> data-name="<?php echo $a6_name ?>" name="<?php echo $a6_name ?>"<?php }else{ ?> href="<?php echo $tmp_href ?>" <?php } ?> class="<?php echo $a6_class ?>" data-id="<?php echo @$a6_id ?>" data-type="<?php echo $a6_type ?>" data-action="<?php echo @$a6_action ?>" data-method="<?php echo @$a6_subaction ?>" data-data="<?php echo $tmp_data ?>" <?php if (isset($a6_accesskey)) echo ' accesskey="'.$a6_accesskey.'"' ?>  title="<?php echo encodeHtml($a6_title) ?>"><?php unset($a6_title,$a6_type,$a6_class,$a6_action,$a6_subaction,$a6_frame,$a6_modal) ?>
							<img class="" title="" src="./themes/default/images/icon/icon/create.png" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_folder_createfile'.'')))); ?></span>
							<!-- Compiling link/link-end --></a>
					</td><!-- Compiling row/row-end --></tr><!-- Compiling row/row-begin --><?php $a4_class='data'; ?><?php
	$column_idx = 0;
?>
<tr
 class="data"
>
<?php unset($a4_class) ?>
					<td>
						<span class="text"><?php echo nl2br('&nbsp;'); ?></span>
						
					</td>
					<td class="clickable" colspan="2"><!-- Compiling link/link-begin --><?php $a6_title='';$a6_type='view';$a6_class='';$a6_action='folder';$a6_subaction='createlink';$a6_frame='_self';$a6_modal=false; ?><?php
	$params = array();
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
?><a data-url="<?php echo $a6_url ?>" target="<?php echo $a6_frame ?>"<?php if (isset($a6_name)) { ?> data-name="<?php echo $a6_name ?>" name="<?php echo $a6_name ?>"<?php }else{ ?> href="<?php echo $tmp_href ?>" <?php } ?> class="<?php echo $a6_class ?>" data-id="<?php echo @$a6_id ?>" data-type="<?php echo $a6_type ?>" data-action="<?php echo @$a6_action ?>" data-method="<?php echo @$a6_subaction ?>" data-data="<?php echo $tmp_data ?>" <?php if (isset($a6_accesskey)) echo ' accesskey="'.$a6_accesskey.'"' ?>  title="<?php echo encodeHtml($a6_title) ?>"><?php unset($a6_title,$a6_type,$a6_class,$a6_action,$a6_subaction,$a6_frame,$a6_modal) ?>
							<img class="" title="" src="./themes/default/images/icon/icon/create.png" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_folder_createlink'.'')))); ?></span>
							<!-- Compiling link/link-end --></a>
					</td><!-- Compiling row/row-end --></tr><!-- Compiling row/row-begin --><?php
	$column_idx = 0;
?>
<tr
>

					<td colspan="2">
						<fieldset class="<?php echo '1'?" open":"" ?><?php echo '1'?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('options') ?></legend><div>
							<?php $type= $defaulttype; ?>
							<!-- Compiling list/list-begin --><?php $a7_list='actionlist';$a7_extract=false;$a7_key='list_key';$a7_value='actiontype'; ?><?php
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
?><?php unset($a7_list,$a7_extract,$a7_key,$a7_value) ?><!-- Compiling part/part-begin --><?php $a8_class='line'; ?><div class="<?php echo $a8_class ?>"><?php unset($a8_class) ?><!-- Compiling part/part-begin --><?php $a9_class='label'; ?><div class="<?php echo $a9_class ?>"><?php unset($a9_class) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a9_class='input'; ?><div class="<?php echo $a9_class ?>"><?php unset($a9_class) ?><!-- Compiling radio/radio-begin --><?php $a10_readonly=false;$a10_name='type';$a10_value=$actiontype;$a10_default=false;$a10_prefix='';$a10_suffix='';$a10_class='';$a10_onchange=''; ?><?php
		if ($this->isEditable() && !$this->isEditMode()) $a10_readonly=true;
		if	( isset($$a10_name)  )
			$a10_tmp_default = $$a10_name;
		elseif ( isset($a10_default) )
			$a10_tmp_default = $a10_default;
		else
			$a10_tmp_default = '';
 ?><input onclick="" class="radio" type="radio" id="<?php echo REQUEST_ID ?>_<?php echo $a10_name.'_'.$a10_value ?>"  name="<?php echo $a10_prefix.$a10_name ?>"<?php if ( $a10_readonly ) echo ' disabled="disabled"' ?> value="<?php echo $a10_value ?>"<?php if($a10_value==$a10_tmp_default||@$a10_checked) echo ' checked="checked"' ?> />
<?php /* #END-IF# */ ?><?php unset($a10_readonly,$a10_name,$a10_value,$a10_default,$a10_prefix,$a10_suffix,$a10_class,$a10_onchange) ?><!-- Compiling label/label-begin --><?php $a10_for='type';$a10_value=$actiontype; ?><label<?php if (isset($a10_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a10_for ?><?php if (!empty($a10_value)) echo '_'.$a10_value ?>" <?php if(hasLang(@$a10_key.'_desc')) { ?> title="<?php echo lang(@$a10_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a10_key)) { echo lang($a10_key); ?><?php if (isset($a10_text)) { echo $a10_text; } ?><?php } ?><?php unset($a10_for,$a10_value) ?>
											<span class="text"><?php echo nl2br('&nbsp;'); ?></span>
											
											<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('FOLDER_SELECT_'.$actiontype.'')))); ?></span>
											<!-- Compiling label/label-end --></label><!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div><!-- Compiling list/list-end --><?php } ?><!-- Compiling part/part-begin --><?php $a7_class='line'; ?><div class="<?php echo $a7_class ?>"><?php unset($a7_class) ?><!-- Compiling part/part-begin --><?php $a8_class='label'; ?><div class="<?php echo $a8_class ?>"><?php unset($a8_class) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a8_class='input'; ?><div class="<?php echo $a8_class ?>"><?php unset($a8_class) ?>
									<span class="text"><?php echo nl2br('&nbsp;&nbsp;&nbsp;&nbsp;'); ?></span>
									
									<?php { $tmpname     = 'confirm';$default  = '';$readonly = '';		
		if	( isset($$tmpname) )
			$checked = $$tmpname;
		else
			$checked = $default;

		?><input class="checkbox" type="checkbox" id="<?php echo REQUEST_ID ?>_<?php echo $tmpname ?>" name="<?php echo $tmpname  ?>"  <?php if ($readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?> /><?php

		if ( $readonly && $checked )
		{ 
		?><input type="hidden" name="<?php echo $tmpname ?>" value="1" /><?php
		}
		} ?>
									<!-- Compiling label/label-begin --><?php $a9_for='confirm'; ?><label<?php if (isset($a9_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a9_for ?><?php if (!empty($a9_value)) echo '_'.$a9_value ?>" <?php if(hasLang(@$a9_key.'_desc')) { ?> title="<?php echo lang(@$a9_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a9_key)) { echo lang($a9_key); ?><?php if (isset($a9_text)) { echo $a9_text; } ?><?php } ?><?php unset($a9_for) ?>
										<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'CONFIRM_DELETE'.'')))); ?></span>
										<!-- Compiling label/label-end --></label><!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a7_class='line'; ?><div class="<?php echo $a7_class ?>"><?php unset($a7_class) ?><!-- Compiling part/part-begin --><?php $a8_class='label'; ?><div class="<?php echo $a8_class ?>"><?php unset($a8_class) ?>
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'FOLDER_SELECT_TARGET_FOLDER'.'')))); ?></span>
									<!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a8_class='input'; ?><div class="<?php echo $a8_class ?>"><?php unset($a8_class) ?>
									<div class="selector">
<div class="inputholder">
<input type="hidden" name="targetobjectid" value="{id}" />
<input type="text" disabled="disabled" value="{name}" />
</div>
<div class="tree selector" data-types="{types}" data-init-id="<?php echo $rootfolderid ?>" data-init-folderid="<?php echo $rootfolderid ?>">
									<!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div>
						</div></fieldset>
					</td><!-- Compiling row/row-end --></tr>
			</table>
		
<div class="bottom">
	<div class="command ">
	
		<input type="button" class="submit ok" value="OK" onclick="$(this).closest('div.sheet').find('form').submit(); " />
		
		<!-- Cancel-Button nicht anzeigen, wenn cancel==false. -->	</div>
</div>

</form>
<!-- Compiling insert/insert-begin --><?php $a2_script='mark';$a2_inline=true; ?><?php
$a2_tmp_file = $tpl_dir.'../../js/'.basename($a2_script).'.js';
if	(!$a2_inline)
{
	?><script src="<?php echo $a2_tmp_file ?>" type="text/javascript"></script><?php 
}
else
{
	echo '<script type="text/javascript">';
	echo str_replace('  ',' ',str_replace('~','',strtr(implode('',file($a2_tmp_file)),"\t\n\b",'~~~')));
	echo '</script>';
}
?>
<iframe
></iframe>
<?php unset($a2_script,$a2_inline) ?>