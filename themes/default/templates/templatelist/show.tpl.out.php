<!-- Compiling output/output-begin @ Wed, 29 Nov 2017 00:50:51 +0100 --><!-- Compiling table/table-begin @ Wed, 29 Nov 2017 00:50:51 +0100 --><?php $a2_width='100%';$a2_space='0px';$a2_padding='0px'; ?><?php
	$last_column_idx = @$column_idx;
	$column_idx = 0;
	$coloumn_widths = array();
	$row_classes    = array();
	$column_classes = array();
?><table class="%class%" cellspacing="0px" width="100%" cellpadding="0px">
<?php unset($a2_width,$a2_space,$a2_padding) ?><!-- Compiling row/row-begin @ Wed, 29 Nov 2017 00:50:51 +0100 --><?php $a3_class='headline'; ?><?php
	$column_idx = 0;
?>
<tr
 class="headline"
>
<?php unset($a3_class) ?>
				<td><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:50:51 +0100 --><?php $a5_class='text';$a5_key='name';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = $langF($a5_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_key,$a5_escape,$a5_cut) ?>
				</td><!-- Compiling row/row-end @ Wed, 29 Nov 2017 00:50:51 +0100 --></tr><!-- Compiling list/list-begin @ Wed, 29 Nov 2017 00:50:51 +0100 --><?php $a3_list='templates';$a3_extract=true;$a3_key='list_key';$a3_value='list_value'; ?><?php
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
?><?php unset($a3_list,$a3_extract,$a3_key,$a3_value) ?><!-- Compiling row/row-begin @ Wed, 29 Nov 2017 00:50:51 +0100 --><?php $a4_class='data'; ?><?php
	$column_idx = 0;
?>
<tr
 class="data"
>
<?php unset($a4_class) ?>
					<td onclick="javascript:openNewAction('<?php echo $name ?>','template','<?php echo $id ?>');"><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:50:51 +0100 --><?php $a6_class='text';$a6_var='name';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = isset($$a6_var)?$$a6_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_var,$a6_escape,$a6_cut) ?>
					</td><!-- Compiling row/row-end @ Wed, 29 Nov 2017 00:50:51 +0100 --></tr><!-- Compiling list/list-end @ Wed, 29 Nov 2017 00:50:51 +0100 --><?php } ?>
			<?php $if3=(empty('templates')); if($if3){?><!-- Compiling row/row-begin @ Wed, 29 Nov 2017 00:50:51 +0100 --><?php
	$column_idx = 0;
?>
<tr
>
<!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:50:51 +0100 --><?php $a5_class='text';$a5_text='GLOBAL_NO_TEMPLATES_AVAILABLE_DESC';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = $langF($a5_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_text,$a5_escape,$a5_cut) ?><!-- Compiling row/row-end @ Wed, 29 Nov 2017 00:50:51 +0100 --></tr>
			<?php } ?><!-- Compiling row/row-begin @ Wed, 29 Nov 2017 00:50:51 +0100 --><?php $a3_class='data'; ?><?php
	$column_idx = 0;
?>
<tr
 class="data"
>
<?php unset($a3_class) ?>
				<td class="clickable" colspan="1"><!-- Compiling link/link-begin @ Wed, 29 Nov 2017 00:50:51 +0100 --><?php $a5_title='';$a5_type='view';$a5_class='';$a5_subaction='add';$a5_frame='_self';$a5_modal=false; ?><?php
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
						<!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:50:51 +0100 --><?php $a6_class='text';$a6_text='new';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_text,$a6_escape,$a6_cut) ?><!-- Compiling link/link-end @ Wed, 29 Nov 2017 00:50:51 +0100 --></a>
				</td><!-- Compiling row/row-end @ Wed, 29 Nov 2017 00:50:51 +0100 --></tr><!-- Compiling table/table-end @ Wed, 29 Nov 2017 00:50:51 +0100 --><?php
	$column_idx = $last_column_idx;
?>
</table>