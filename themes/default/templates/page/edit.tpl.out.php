<!-- Compiling output/output-begin @ Wed, 29 Nov 2017 00:51:14 +0100 --><!-- Compiling table/table-begin @ Wed, 29 Nov 2017 00:51:14 +0100 --><?php $a2_width='100%';$a2_space='0px';$a2_padding='0px'; ?><?php
	$last_column_idx = @$column_idx;
	$column_idx = 0;
	$coloumn_widths = array();
	$row_classes    = array();
	$column_classes = array();
?><table class="%class%" cellspacing="0px" width="100%" cellpadding="0px">
<?php unset($a2_width,$a2_space,$a2_padding) ?>
			<?php $if3=(empty('el')); if($if3){?><!-- Compiling row/row-begin @ Wed, 29 Nov 2017 00:51:14 +0100 --><?php $a4_class='headline'; ?><?php
	$column_idx = 0;
?>
<tr
 class="headline"
>
<?php unset($a4_class) ?>
					<td class="help"><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:51:14 +0100 --><?php $a6_class='text';$a6_text='PAGE_ELEMENT_NAME';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_text,$a6_escape,$a6_cut) ?>
					</td>
					<td class="help"><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:51:14 +0100 --><?php $a6_class='text';$a6_text='PAGE_ELEMENT_VALUE';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_text,$a6_escape,$a6_cut) ?>
					</td><!-- Compiling row/row-end @ Wed, 29 Nov 2017 00:51:14 +0100 --></tr>
			<?php } ?>
			<?php $if3=(empty('el')); if($if3){?><!-- Compiling row/row-begin @ Wed, 29 Nov 2017 00:51:14 +0100 --><?php
	$column_idx = 0;
?>
<tr
>

					<td><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:51:14 +0100 --><?php $a6_class='text';$a6_text='GLOBAL_NOT_FOUND';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_text,$a6_escape,$a6_cut) ?>
					</td><!-- Compiling row/row-end @ Wed, 29 Nov 2017 00:51:14 +0100 --></tr>
			<?php } ?><!-- Compiling list/list-begin @ Wed, 29 Nov 2017 00:51:14 +0100 --><?php $a3_list='el';$a3_extract=true;$a3_key='list_key';$a3_value='list_value'; ?><?php
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
?><?php unset($a3_list,$a3_extract,$a3_key,$a3_value) ?><!-- Compiling row/row-begin @ Wed, 29 Nov 2017 00:51:14 +0100 --><?php $a4_class='data'; ?><?php
	$column_idx = 0;
?>
<tr
 class="data"
>
<?php unset($a4_class) ?>
					<td class="clickable"><!-- Compiling link/link-begin @ Wed, 29 Nov 2017 00:51:14 +0100 --><?php $a6_title=$desc;$a6_type='open';$a6_class='';$a6_action='pageelement';$a6_id=$pageelementid;$a6_name=$name;$a6_frame='_self';$a6_modal=false; ?><?php
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
?><a data-url="<?php echo $a6_url ?>" target="<?php echo $a6_frame ?>"<?php if (isset($a6_name)) { ?> data-name="<?php echo $a6_name ?>" name="<?php echo $a6_name ?>"<?php }else{ ?> href="<?php echo $tmp_href ?>" <?php } ?> class="<?php echo $a6_class ?>" data-id="<?php echo @$a6_id ?>" data-type="<?php echo $a6_type ?>" data-action="<?php echo @$a6_action ?>" data-method="<?php echo @$a6_subaction ?>" data-data="<?php echo $tmp_data ?>" <?php if (isset($a6_accesskey)) echo ' accesskey="'.$a6_accesskey.'"' ?>  title="<?php echo encodeHtml($a6_title) ?>"><?php unset($a6_title,$a6_type,$a6_class,$a6_action,$a6_id,$a6_name,$a6_frame,$a6_modal) ?>
							<img class="image-icon image-icon--element" title="" src="./themes/default/images/icon/element/<?php echo $type ?>.svg" />
							<!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:51:14 +0100 --><?php $a7_class='text';$a7_var='name';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = isset($$a7_var)?$$a7_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_var,$a7_escape,$a7_cut) ?><!-- Compiling link/link-end @ Wed, 29 Nov 2017 00:51:14 +0100 --></a>
					</td>
					<td><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:51:14 +0100 --><?php $a6_class='text';$a6_var='value';$a6_maxlength='50';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = isset($$a6_var)?$$a6_var:$langF('UNKNOWN');
		$tmp_text = Text::maxLength( $tmp_text,intval($a6_maxlength),'..',constant('STR_PAD_'.strtoupper($a6_cut)) );
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_var,$a6_maxlength,$a6_escape,$a6_cut) ?><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:51:14 +0100 --><?php $a6_class='text';$a6_raw='_';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a6_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_raw,$a6_escape,$a6_cut) ?>
					</td><!-- Compiling row/row-end @ Wed, 29 Nov 2017 00:51:14 +0100 --></tr><!-- Compiling list/list-end @ Wed, 29 Nov 2017 00:51:14 +0100 --><?php } ?><!-- Compiling table/table-end @ Wed, 29 Nov 2017 00:51:14 +0100 --><?php
	$column_idx = $last_column_idx;
?>
</table>
		<fieldset class="<?php echo 1?" open":"" ?><?php echo 1?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('menu_page_show') ?></legend><div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:51:14 +0100 --><div><!-- Compiling insert/insert-begin @ Wed, 29 Nov 2017 00:51:14 +0100 --><?php $a4_inline=false;$a4_url=$preview_url;$a4_name='preview'; ?><iframe
 name="<?php echo $a4_name ?>"
 src="<?php echo $a4_url ?>"
></iframe>
<?php unset($a4_inline,$a4_url,$a4_name) ?><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:51:14 +0100 --></div>
		</div></fieldset>