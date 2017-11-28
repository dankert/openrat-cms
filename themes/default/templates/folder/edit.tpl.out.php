<!-- Compiling output/output-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><!-- Compiling header/header-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a2_name='';$a2_views='order';$a2_back=false; ?><?php if(!empty($a2_views)) { ?>
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
<!-- Compiling table/table-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a3_width='100%';$a3_space='0px';$a3_padding='0px'; ?><?php
	$last_column_idx = @$column_idx;
	$column_idx = 0;
	$coloumn_widths = array();
	$row_classes    = array();
	$column_classes = array();
?><table class="%class%" cellspacing="0px" width="100%" cellpadding="0px">
<?php unset($a3_width,$a3_space,$a3_padding) ?><!-- Compiling row/row-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a4_class='headline'; ?><?php
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
					<td class="help"><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a6_class='text';$a6_key='GLOBAL_TYPE';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_key,$a6_escape,$a6_cut) ?><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a6_class='text';$a6_raw='_/_';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a6_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_raw,$a6_escape,$a6_cut) ?><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a6_class='text';$a6_key='GLOBAL_NAME';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_key,$a6_escape,$a6_cut) ?>
					</td><!-- Compiling row/row-end @ Wed, 29 Nov 2017 00:51:17 +0100 --></tr><!-- Compiling list/list-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a4_list='object';$a4_extract=true;$a4_key='list_key';$a4_value='list_value'; ?><?php
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
?><?php unset($a4_list,$a4_extract,$a4_key,$a4_value) ?><!-- Compiling row/row-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a5_class='data'; ?><?php
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
							<?php $if7=(!'writable'); if($if7){?><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a8_class='text';$a8_raw='_';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a8_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_raw,$a8_escape,$a8_cut) ?>
							<?php } ?>
						</td>
						<td class="clickable"><!-- Compiling label/label-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a7_for=$id; ?><label<?php if (isset($a7_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a7_for ?><?php if (!empty($a7_value)) echo '_'.$a7_value ?>" <?php if(hasLang(@$a7_key.'_desc')) { ?> title="<?php echo lang(@$a7_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a7_key)) { echo lang($a7_key); ?><?php if (isset($a7_text)) { echo $a7_text; } ?><?php } ?><?php unset($a7_for) ?><!-- Compiling link/link-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a8_title='';$a8_type='open';$a8_class='';$a8_action=$type;$a8_id=$objectid;$a8_name=$name;$a8_frame='_self';$a8_modal=false; ?><?php
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
									<!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a9_class='text';$a9_var='name';$a9_maxlength='40';$a9_escape=true;$a9_cut='both'; ?><?php
		$a9_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a9_class ?>" title="<?php echo $a9_title ?>"><?php
		$langF = $a9_escape?'langHtml':'lang';
		$tmp_text = isset($$a9_var)?$$a9_var:$langF('UNKNOWN');
		$tmp_text = Text::maxLength( $tmp_text,intval($a9_maxlength),'..',constant('STR_PAD_'.strtoupper($a9_cut)) );
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a9_class,$a9_var,$a9_maxlength,$a9_escape,$a9_cut) ?><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a9_class='text';$a9_raw='_';$a9_escape=true;$a9_cut='both'; ?><?php
		$a9_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a9_class ?>" title="<?php echo $a9_title ?>"><?php
		$langF = $a9_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a9_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a9_class,$a9_raw,$a9_escape,$a9_cut) ?><!-- Compiling link/link-end @ Wed, 29 Nov 2017 00:51:17 +0100 --></a><!-- Compiling label/label-end @ Wed, 29 Nov 2017 00:51:17 +0100 --></label>
						</td><!-- Compiling row/row-end @ Wed, 29 Nov 2017 00:51:17 +0100 --></tr><!-- Compiling list/list-end @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php } ?>
				<?php $if4=(empty('object')); if($if4){?><!-- Compiling row/row-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php
	$column_idx = 0;
?>
<tr
>

						<td colspan="2"><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a7_class='text';$a7_text='GLOBAL_NOT_FOUND';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_text,$a7_escape,$a7_cut) ?>
						</td><!-- Compiling row/row-end @ Wed, 29 Nov 2017 00:51:17 +0100 --></tr>
				<?php } ?><!-- Compiling row/row-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a4_class='data'; ?><?php
	$column_idx = 0;
?>
<tr
 class="data"
>
<?php unset($a4_class) ?>
					<td><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a6_class='text';$a6_raw='_';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a6_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_raw,$a6_escape,$a6_cut) ?>
					</td>
					<td class="clickable" colspan="2"><!-- Compiling link/link-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a6_title='';$a6_type='view';$a6_class='';$a6_action='folder';$a6_subaction='createfolder';$a6_frame='_self';$a6_modal=false; ?><?php
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
							<!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a7_class='text';$a7_key='menu_folder_createfolder';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_key,$a7_escape,$a7_cut) ?><!-- Compiling link/link-end @ Wed, 29 Nov 2017 00:51:17 +0100 --></a>
					</td><!-- Compiling row/row-end @ Wed, 29 Nov 2017 00:51:17 +0100 --></tr><!-- Compiling row/row-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a4_class='data'; ?><?php
	$column_idx = 0;
?>
<tr
 class="data"
>
<?php unset($a4_class) ?>
					<td><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a6_class='text';$a6_raw='_';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a6_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_raw,$a6_escape,$a6_cut) ?>
					</td>
					<td class="clickable" colspan="2"><!-- Compiling link/link-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a6_title='';$a6_type='view';$a6_class='';$a6_action='folder';$a6_subaction='createpage';$a6_frame='_self';$a6_modal=false; ?><?php
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
							<!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a7_class='text';$a7_key='menu_folder_createpage';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_key,$a7_escape,$a7_cut) ?><!-- Compiling link/link-end @ Wed, 29 Nov 2017 00:51:17 +0100 --></a>
					</td><!-- Compiling row/row-end @ Wed, 29 Nov 2017 00:51:17 +0100 --></tr><!-- Compiling row/row-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a4_class='data'; ?><?php
	$column_idx = 0;
?>
<tr
 class="data"
>
<?php unset($a4_class) ?>
					<td><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a6_class='text';$a6_raw='_';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a6_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_raw,$a6_escape,$a6_cut) ?>
					</td>
					<td class="clickable" colspan="2"><!-- Compiling link/link-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a6_title='';$a6_type='view';$a6_class='';$a6_action='folder';$a6_subaction='createfile';$a6_frame='_self';$a6_modal=false; ?><?php
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
							<!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a7_class='text';$a7_key='menu_folder_createfile';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_key,$a7_escape,$a7_cut) ?><!-- Compiling link/link-end @ Wed, 29 Nov 2017 00:51:17 +0100 --></a>
					</td><!-- Compiling row/row-end @ Wed, 29 Nov 2017 00:51:17 +0100 --></tr><!-- Compiling row/row-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a4_class='data'; ?><?php
	$column_idx = 0;
?>
<tr
 class="data"
>
<?php unset($a4_class) ?>
					<td><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a6_class='text';$a6_raw='_';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a6_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_raw,$a6_escape,$a6_cut) ?>
					</td>
					<td class="clickable" colspan="2"><!-- Compiling link/link-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a6_title='';$a6_type='view';$a6_class='';$a6_action='folder';$a6_subaction='createlink';$a6_frame='_self';$a6_modal=false; ?><?php
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
							<!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a7_class='text';$a7_key='menu_folder_createlink';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_key,$a7_escape,$a7_cut) ?><!-- Compiling link/link-end @ Wed, 29 Nov 2017 00:51:17 +0100 --></a>
					</td><!-- Compiling row/row-end @ Wed, 29 Nov 2017 00:51:17 +0100 --></tr><!-- Compiling row/row-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php
	$column_idx = 0;
?>
<tr
>

					<td colspan="2">
						<fieldset class="<?php echo 1?" open":"" ?><?php echo 1?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('options') ?></legend><div>
							<?php $type= $defaulttype; ?>
							<!-- Compiling list/list-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a7_list='actionlist';$a7_extract=false;$a7_key='list_key';$a7_value='actiontype'; ?><?php
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
?><?php unset($a7_list,$a7_extract,$a7_key,$a7_value) ?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a8_class='line'; ?><div class="<?php echo $a8_class ?>"><?php unset($a8_class) ?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a9_class='label'; ?><div class="<?php echo $a9_class ?>"><?php unset($a9_class) ?><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:51:17 +0100 --></div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a9_class='input'; ?><div class="<?php echo $a9_class ?>"><?php unset($a9_class) ?><!-- Compiling radio/radio-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a10_readonly=false;$a10_name='type';$a10_value=$actiontype;$a10_default=false;$a10_prefix='';$a10_suffix='';$a10_class='';$a10_onchange=''; ?><?php
		if ($this->isEditable() && !$this->isEditMode()) $a10_readonly=true;
		if	( isset($$a10_name)  )
			$a10_tmp_default = $$a10_name;
		elseif ( isset($a10_default) )
			$a10_tmp_default = $a10_default;
		else
			$a10_tmp_default = '';
 ?><input onclick="" class="radio" type="radio" id="<?php echo REQUEST_ID ?>_<?php echo $a10_name.'_'.$a10_value ?>"  name="<?php echo $a10_prefix.$a10_name ?>"<?php if ( $a10_readonly ) echo ' disabled="disabled"' ?> value="<?php echo $a10_value ?>"<?php if($a10_value==$a10_tmp_default||@$a10_checked) echo ' checked="checked"' ?> />
<?php /* #END-IF# */ ?><?php unset($a10_readonly,$a10_name,$a10_value,$a10_default,$a10_prefix,$a10_suffix,$a10_class,$a10_onchange) ?><!-- Compiling label/label-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a10_for='type';$a10_value=$actiontype; ?><label<?php if (isset($a10_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a10_for ?><?php if (!empty($a10_value)) echo '_'.$a10_value ?>" <?php if(hasLang(@$a10_key.'_desc')) { ?> title="<?php echo lang(@$a10_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a10_key)) { echo lang($a10_key); ?><?php if (isset($a10_text)) { echo $a10_text; } ?><?php } ?><?php unset($a10_for,$a10_value) ?><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a11_class='text';$a11_raw='_';$a11_escape=true;$a11_cut='both'; ?><?php
		$a11_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a11_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_raw,$a11_escape,$a11_cut) ?><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a11_class='text';$a11_key=$actiontype;$a11_prefix='FOLDER_SELECT_';$a11_escape=true;$a11_cut='both'; ?><?php
		$a11_key = $a11_prefix.$a11_key;
		$a11_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = $langF($a11_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_key,$a11_prefix,$a11_escape,$a11_cut) ?><!-- Compiling label/label-end @ Wed, 29 Nov 2017 00:51:17 +0100 --></label><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:51:17 +0100 --></div><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:51:17 +0100 --></div><!-- Compiling list/list-end @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php } ?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a7_class='line'; ?><div class="<?php echo $a7_class ?>"><?php unset($a7_class) ?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a8_class='label'; ?><div class="<?php echo $a8_class ?>"><?php unset($a8_class) ?><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:51:17 +0100 --></div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a8_class='input'; ?><div class="<?php echo $a8_class ?>"><?php unset($a8_class) ?><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a9_class='text';$a9_raw='____';$a9_escape=true;$a9_cut='both'; ?><?php
		$a9_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a9_class ?>" title="<?php echo $a9_title ?>"><?php
		$langF = $a9_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a9_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a9_class,$a9_raw,$a9_escape,$a9_cut) ?>
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
									<!-- Compiling label/label-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a9_for='confirm'; ?><label<?php if (isset($a9_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a9_for ?><?php if (!empty($a9_value)) echo '_'.$a9_value ?>" <?php if(hasLang(@$a9_key.'_desc')) { ?> title="<?php echo lang(@$a9_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a9_key)) { echo lang($a9_key); ?><?php if (isset($a9_text)) { echo $a9_text; } ?><?php } ?><?php unset($a9_for) ?><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a10_class='text';$a10_key='CONFIRM_DELETE';$a10_escape=true;$a10_cut='both'; ?><?php
		$a10_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a10_class ?>" title="<?php echo $a10_title ?>"><?php
		$langF = $a10_escape?'langHtml':'lang';
		$tmp_text = $langF($a10_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a10_class,$a10_key,$a10_escape,$a10_cut) ?><!-- Compiling label/label-end @ Wed, 29 Nov 2017 00:51:17 +0100 --></label><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:51:17 +0100 --></div><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:51:17 +0100 --></div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a7_class='line'; ?><div class="<?php echo $a7_class ?>"><?php unset($a7_class) ?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a8_class='label'; ?><div class="<?php echo $a8_class ?>"><?php unset($a8_class) ?><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a9_class='text';$a9_key='FOLDER_SELECT_TARGET_FOLDER';$a9_escape=true;$a9_cut='both'; ?><?php
		$a9_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a9_class ?>" title="<?php echo $a9_title ?>"><?php
		$langF = $a9_escape?'langHtml':'lang';
		$tmp_text = $langF($a9_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a9_class,$a9_key,$a9_escape,$a9_cut) ?><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:51:17 +0100 --></div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a8_class='input'; ?><div class="<?php echo $a8_class ?>"><?php unset($a8_class) ?><!-- Compiling selector/selector-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a9_types='folder';$a9_name=$rootfoldername;$a9_id=$rootfolderid;$a9_folderid=$rootfolderid;$a9_param='targetobjectid'; ?><div class="selector">
	<div class="inputholder">
		<input type="hidden" name="<?php echo $a9_param ?>" value="<?php echo $a9_id ?>" />
		<input type="text" disabled="disabled" value="<?php echo $a9_name ?>" />
	</div>
	<div class="tree selector" data-types="<?php echo $a9_types ?>" data-init-id="<?php echo $a9_id ?>" data-init-folderid="<?php echo $a9_folderid ?>"></div>
</div><?php unset($a9_types,$a9_name,$a9_id,$a9_folderid,$a9_param) ?><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:51:17 +0100 --></div><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:51:17 +0100 --></div>
						</div></fieldset>
					</td><!-- Compiling row/row-end @ Wed, 29 Nov 2017 00:51:17 +0100 --></tr><!-- Compiling table/table-end @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php
	$column_idx = $last_column_idx;
?>
</table>
		
<div class="bottom">
	<div class="command ">
	
		<input type="button" class="submit ok" value="OK" onclick="$(this).closest('div.sheet').find('form').submit(); " />
		
		<!-- Cancel-Button nicht anzeigen, wenn cancel==false. -->	</div>
</div>

</form>
<!-- Compiling insert/insert-begin @ Wed, 29 Nov 2017 00:51:17 +0100 --><?php $a2_script='mark';$a2_inline=true; ?><?php
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