<!-- Compiling output/output-begin --><!-- Compiling table/table-begin --><?php $a2_width='100%';$a2_space='0px';$a2_padding='0px'; ?><?php
	$last_column_idx = @$column_idx;
	$column_idx = 0;
	$coloumn_widths = array();
	$row_classes    = array();
	$column_classes = array();
?><table class="%class%" cellspacing="0px" width="100%" cellpadding="0px">
<?php unset($a2_width,$a2_space,$a2_padding) ?><!-- Compiling row/row-begin --><?php $a3_class='data'; ?><?php
	$column_idx = 0;
?>
<tr
 class="data"
>
<?php unset($a3_class) ?>
				<td colspan="2"><!-- Compiling link/link-begin --><?php $a5_title='';$a5_type='';$a5_class='';$a5_action='index';$a5_subaction='projectmenu';$a5_frame='_self';$a5_modal=false; ?><?php
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
?><a data-url="<?php echo $a5_url ?>" target="<?php echo $a5_frame ?>"<?php if (isset($a5_name)) { ?> data-name="<?php echo $a5_name ?>" name="<?php echo $a5_name ?>"<?php }else{ ?> href="<?php echo $tmp_href ?>" <?php } ?> class="<?php echo $a5_class ?>" data-id="<?php echo @$a5_id ?>" data-type="<?php echo $a5_type ?>" data-action="<?php echo @$a5_action ?>" data-method="<?php echo @$a5_subaction ?>" data-data="<?php echo $tmp_data ?>" <?php if (isset($a5_accesskey)) echo ' accesskey="'.$a5_accesskey.'"' ?>  title="<?php echo encodeHtml($a5_title) ?>"><?php unset($a5_title,$a5_type,$a5_class,$a5_action,$a5_subaction,$a5_frame,$a5_modal) ?><!-- Compiling text/text-begin --><?php $a6_class='text';$a6_raw='OpenRat';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a6_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_raw,$a6_escape,$a6_cut) ?><!-- Compiling link/link-end --></a>
				</td><!-- Compiling row/row-end --></tr><!-- Compiling list/list-begin --><?php $a3_list='applications';$a3_extract=true;$a3_key='list_key';$a3_value='list_value'; ?><?php
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
?><?php unset($a3_list,$a3_extract,$a3_key,$a3_value) ?><!-- Compiling row/row-begin --><?php $a4_class='data'; ?><?php
	$column_idx = 0;
?>
<tr
 class="data"
>
<?php unset($a4_class) ?>
					<td><!-- Compiling link/link-begin --><?php $a6_title='';$a6_type='';$a6_url=$url;$a6_class='';$a6_frame='_self';$a6_modal=false; ?><?php
	$params = array();
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
?><a data-url="<?php echo $a6_url ?>" target="<?php echo $a6_frame ?>"<?php if (isset($a6_name)) { ?> data-name="<?php echo $a6_name ?>" name="<?php echo $a6_name ?>"<?php }else{ ?> href="<?php echo $tmp_href ?>" <?php } ?> class="<?php echo $a6_class ?>" data-id="<?php echo @$a6_id ?>" data-type="<?php echo $a6_type ?>" data-action="<?php echo @$a6_action ?>" data-method="<?php echo @$a6_subaction ?>" data-data="<?php echo $tmp_data ?>" <?php if (isset($a6_accesskey)) echo ' accesskey="'.$a6_accesskey.'"' ?>  title="<?php echo encodeHtml($a6_title) ?>"><?php unset($a6_title,$a6_type,$a6_url,$a6_class,$a6_frame,$a6_modal) ?><!-- Compiling text/text-begin --><?php $a7_class='text';$a7_var='name';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = isset($$a7_var)?$$a7_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_var,$a7_escape,$a7_cut) ?><!-- Compiling link/link-end --></a>
					</td>
					<td><!-- Compiling text/text-begin --><?php $a6_class='text';$a6_var='description';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = isset($$a6_var)?$$a6_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_var,$a6_escape,$a6_cut) ?>
					</td><!-- Compiling row/row-end --></tr><!-- Compiling list/list-end --><?php } ?><!-- Compiling table/table-end --><?php
	$column_idx = $last_column_idx;
?>
</table>