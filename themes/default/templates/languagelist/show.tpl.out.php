<!-- Compiling output/output-begin @ Wed, 29 Nov 2017 00:50:42 +0100 --><!-- Compiling table/table-begin @ Wed, 29 Nov 2017 00:50:42 +0100 --><?php $a2_width='100%';$a2_space='0px';$a2_padding='0px'; ?><?php
	$last_column_idx = @$column_idx;
	$column_idx = 0;
	$coloumn_widths = array();
	$row_classes    = array();
	$column_classes = array();
?><table class="%class%" cellspacing="0px" width="100%" cellpadding="0px">
<?php unset($a2_width,$a2_space,$a2_padding) ?><!-- Compiling row/row-begin @ Wed, 29 Nov 2017 00:50:42 +0100 --><?php $a3_class='headline'; ?><?php
	$column_idx = 0;
?>
<tr
 class="headline"
>
<?php unset($a3_class) ?>
				<td><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:50:42 +0100 --><?php $a5_class='text';$a5_key='NAME';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = $langF($a5_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_key,$a5_escape,$a5_cut) ?>
				</td>
				<td><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:50:42 +0100 --><?php $a5_class='text';$a5_key='LANGUAGE_ISOCODE';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = $langF($a5_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_key,$a5_escape,$a5_cut) ?>
				</td>
				<td><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:50:42 +0100 --><?php $a5_class='text';$a5_raw='';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a5_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_raw,$a5_escape,$a5_cut) ?>
				</td>
				<td><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:50:42 +0100 --><?php $a5_class='text';$a5_raw='';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a5_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_raw,$a5_escape,$a5_cut) ?>
				</td><!-- Compiling row/row-end @ Wed, 29 Nov 2017 00:50:42 +0100 --></tr><!-- Compiling list/list-begin @ Wed, 29 Nov 2017 00:50:42 +0100 --><?php $a3_list='el';$a3_extract=true;$a3_key='list_key';$a3_value='list_value'; ?><?php
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
?><?php unset($a3_list,$a3_extract,$a3_key,$a3_value) ?><!-- Compiling row/row-begin @ Wed, 29 Nov 2017 00:50:42 +0100 --><?php $a4_class='data'; ?><?php
	$column_idx = 0;
?>
<tr
 class="data"
>
<?php unset($a4_class) ?>
					<td class="clickable">
						<img class="" title="" src="./themes/default/images/icon/icon_language.png" />
						<!-- Compiling link/link-begin @ Wed, 29 Nov 2017 00:50:42 +0100 --><?php $a6_title='';$a6_type='open';$a6_class='';$a6_action='language';$a6_id=$id;$a6_name=$name;$a6_frame='_self';$a6_modal=false; ?><?php
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
?><a data-url="<?php echo $a6_url ?>" target="<?php echo $a6_frame ?>"<?php if (isset($a6_name)) { ?> data-name="<?php echo $a6_name ?>" name="<?php echo $a6_name ?>"<?php }else{ ?> href="<?php echo $tmp_href ?>" <?php } ?> class="<?php echo $a6_class ?>" data-id="<?php echo @$a6_id ?>" data-type="<?php echo $a6_type ?>" data-action="<?php echo @$a6_action ?>" data-method="<?php echo @$a6_subaction ?>" data-data="<?php echo $tmp_data ?>" <?php if (isset($a6_accesskey)) echo ' accesskey="'.$a6_accesskey.'"' ?>  title="<?php echo encodeHtml($a6_title) ?>"><?php unset($a6_title,$a6_type,$a6_class,$a6_action,$a6_id,$a6_name,$a6_frame,$a6_modal) ?><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:50:42 +0100 --><?php $a7_class='text';$a7_var='name';$a7_maxlength='25';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = isset($$a7_var)?$$a7_var:$langF('UNKNOWN');
		$tmp_text = Text::maxLength( $tmp_text,intval($a7_maxlength),'..',constant('STR_PAD_'.strtoupper($a7_cut)) );
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_var,$a7_maxlength,$a7_escape,$a7_cut) ?><!-- Compiling link/link-end @ Wed, 29 Nov 2017 00:50:42 +0100 --></a>
					</td>
					<td><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:50:42 +0100 --><?php $a6_class='text';$a6_var='isocode';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = isset($$a6_var)?$$a6_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_var,$a6_escape,$a6_cut) ?>
					</td>
					<?php $if5=(!empty('default_url')); if($if5){?>
						<td class="clickable"><!-- Compiling link/link-begin @ Wed, 29 Nov 2017 00:50:42 +0100 --><?php $a7_title='';$a7_type='post';$a7_class='';$a7_action='language';$a7_subaction='setdefault';$a7_id=$id;$a7_frame='_self';$a7_modal=false; ?><?php
	$params = array();
		$a7_url='';
	$tmp_url = '';
	$a7_target = $view;
	$tmp_href = 'javascript:void(0);';		                          
	switch( $a7_type )
	{
		case 'post':
			$json = new JSON();
			$tmp_data = $json->encode( array('action'=>!empty($a7_action)?$a7_action:$this->actionName,'subaction'=>!empty($a7_subaction)?$a7_subaction:$this->subActionName,'id'=>!empty($a7_id)?$a7_id:$this->getRequestId())
		                          +array(REQ_PARAM_TOKEN=>token())
		                          +$params );
			$tmp_data = str_replace("\n",'',str_replace('"','&quot;',$tmp_data));
			break;
		case 'html';
			$tmp_href = $a7_url;
		default:
			$tmp_data = '';
	}
?><a data-url="<?php echo $a7_url ?>" target="<?php echo $a7_frame ?>"<?php if (isset($a7_name)) { ?> data-name="<?php echo $a7_name ?>" name="<?php echo $a7_name ?>"<?php }else{ ?> href="<?php echo $tmp_href ?>" <?php } ?> class="<?php echo $a7_class ?>" data-id="<?php echo @$a7_id ?>" data-type="<?php echo $a7_type ?>" data-action="<?php echo @$a7_action ?>" data-method="<?php echo @$a7_subaction ?>" data-data="<?php echo $tmp_data ?>" <?php if (isset($a7_accesskey)) echo ' accesskey="'.$a7_accesskey.'"' ?>  title="<?php echo encodeHtml($a7_title) ?>"><?php unset($a7_title,$a7_type,$a7_class,$a7_action,$a7_subaction,$a7_id,$a7_frame,$a7_modal) ?><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:50:42 +0100 --><?php $a8_class='text';$a8_text='GLOBAL_make_default';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_text,$a8_escape,$a8_cut) ?><!-- Compiling link/link-end @ Wed, 29 Nov 2017 00:50:42 +0100 --></a>
						</td>
					<?php } ?>
					<?php if(!$if5){?>
						<td><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:50:42 +0100 --><?php $a7_class='text';$a7_text='GLOBAL_is_default';$a7_escape=true;$a7_type='emphatic';$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'em';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_text,$a7_escape,$a7_type,$a7_cut) ?>
						</td>
					<?php } ?>
					<?php $if5=(!empty('select_url')); if($if5){?>
						<td class="clickable"><!-- Compiling link/link-begin @ Wed, 29 Nov 2017 00:50:42 +0100 --><?php $a7_title='';$a7_type='post';$a7_class='';$a7_action='start';$a7_subaction='language';$a7_id=$id;$a7_frame='_self';$a7_modal=false; ?><?php
	$params = array();
		$a7_url='';
	$tmp_url = '';
	$a7_target = $view;
	$tmp_href = 'javascript:void(0);';		                          
	switch( $a7_type )
	{
		case 'post':
			$json = new JSON();
			$tmp_data = $json->encode( array('action'=>!empty($a7_action)?$a7_action:$this->actionName,'subaction'=>!empty($a7_subaction)?$a7_subaction:$this->subActionName,'id'=>!empty($a7_id)?$a7_id:$this->getRequestId())
		                          +array(REQ_PARAM_TOKEN=>token())
		                          +$params );
			$tmp_data = str_replace("\n",'',str_replace('"','&quot;',$tmp_data));
			break;
		case 'html';
			$tmp_href = $a7_url;
		default:
			$tmp_data = '';
	}
?><a data-url="<?php echo $a7_url ?>" target="<?php echo $a7_frame ?>"<?php if (isset($a7_name)) { ?> data-name="<?php echo $a7_name ?>" name="<?php echo $a7_name ?>"<?php }else{ ?> href="<?php echo $tmp_href ?>" <?php } ?> class="<?php echo $a7_class ?>" data-id="<?php echo @$a7_id ?>" data-type="<?php echo $a7_type ?>" data-action="<?php echo @$a7_action ?>" data-method="<?php echo @$a7_subaction ?>" data-data="<?php echo $tmp_data ?>" <?php if (isset($a7_accesskey)) echo ' accesskey="'.$a7_accesskey.'"' ?>  title="<?php echo encodeHtml($a7_title) ?>"><?php unset($a7_title,$a7_type,$a7_class,$a7_action,$a7_subaction,$a7_id,$a7_frame,$a7_modal) ?><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:50:42 +0100 --><?php $a8_class='text';$a8_text='GLOBAL_select';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_text,$a8_escape,$a8_cut) ?><!-- Compiling link/link-end @ Wed, 29 Nov 2017 00:50:42 +0100 --></a>
						</td>
					<?php } ?>
					<?php if(!$if5){?>
						<td><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:50:42 +0100 --><?php $a7_class='text';$a7_text='GLOBAL_selected';$a7_escape=true;$a7_type='emphatic';$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'em';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_text,$a7_escape,$a7_type,$a7_cut) ?>
						</td>
					<?php } ?><!-- Compiling row/row-end @ Wed, 29 Nov 2017 00:50:42 +0100 --></tr>
				<?php unset($select_url) ?>
				
				<?php unset($default_url) ?>
				<!-- Compiling list/list-end @ Wed, 29 Nov 2017 00:50:42 +0100 --><?php } ?><!-- Compiling row/row-begin @ Wed, 29 Nov 2017 00:50:42 +0100 --><?php $a3_class='data'; ?><?php
	$column_idx = 0;
?>
<tr
 class="data"
>
<?php unset($a3_class) ?>
				<td class="clickable" colspan="4"><!-- Compiling link/link-begin @ Wed, 29 Nov 2017 00:50:42 +0100 --><?php $a5_title='';$a5_type='view';$a5_class='';$a5_subaction='add';$a5_frame='_self';$a5_modal=false; ?><?php
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
?><a data-url="<?php echo $a5_url ?>" target="<?php echo $a5_frame ?>"<?php if (isset($a5_name)) { ?> data-name="<?php echo $a5_name ?>" name="<?php echo $a5_name ?>"<?php }else{ ?> href="<?php echo $tmp_href ?>" <?php } ?> class="<?php echo $a5_class ?>" data-id="<?php echo @$a5_id ?>" data-type="<?php echo $a5_type ?>" data-action="<?php echo @$a5_action ?>" data-method="<?php echo @$a5_subaction ?>" data-data="<?php echo $tmp_data ?>" <?php if (isset($a5_accesskey)) echo ' accesskey="'.$a5_accesskey.'"' ?>  title="<?php echo encodeHtml($a5_title) ?>"><?php unset($a5_title,$a5_type,$a5_class,$a5_subaction,$a5_frame,$a5_modal) ?>
						<img class="" title="" src="./themes/default/images/icon/add.png" />
						<!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:50:42 +0100 --><?php $a6_class='text';$a6_text='new';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_text,$a6_escape,$a6_cut) ?><!-- Compiling link/link-end @ Wed, 29 Nov 2017 00:50:42 +0100 --></a>
				</td><!-- Compiling row/row-end @ Wed, 29 Nov 2017 00:50:42 +0100 --></tr><!-- Compiling table/table-end @ Wed, 29 Nov 2017 00:50:42 +0100 --><?php
	$column_idx = $last_column_idx;
?>
</table>