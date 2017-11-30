<!-- Compiling output/output-begin --><!-- Compiling table/table-begin --><?php $a2_width='100%';$a2_space='0px';$a2_padding='0px'; ?><?php
	$last_column_idx = @$column_idx;
	$column_idx = 0;
	$coloumn_widths = array();
	$row_classes    = array();
	$column_classes = array();
?><table class="%class%" cellspacing="0px" width="100%" cellpadding="0px">
<?php unset($a2_width,$a2_space,$a2_padding) ?><!-- Compiling row/row-begin --><?php $a3_class='headline'; ?><?php
	$column_idx = 0;
?>
<tr
 class="headline"
>
<?php unset($a3_class) ?>
				<td><!-- Compiling text/text-begin --><?php $a5_class='text';$a5_key='name';$a5_escape=true;$a5_cut='both'; ?><?php
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
				<td><!-- Compiling text/text-begin --><?php $a5_class='text';$a5_key='filename';$a5_escape=true;$a5_cut='both'; ?><?php
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
				<td><!-- Compiling text/text-begin --><?php $a5_class='text';$a5_key='lastchange';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = $langF($a5_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_key,$a5_escape,$a5_cut) ?>
				</td><!-- Compiling row/row-end --></tr><!-- Compiling list/list-begin --><?php $a3_list='timeline';$a3_extract=true;$a3_key='list_key';$a3_value='list_value'; ?><?php
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
?><?php unset($a3_list,$a3_extract,$a3_key,$a3_value) ?>
				<?php $if4=($is_folder=='1'); if($if4){?>
					<?php $type= 'folder'; ?>
					
				<?php } ?>
				<?php $if4=($is_file=='1'); if($if4){?>
					<?php $type= 'file'; ?>
					
				<?php } ?>
				<?php $if4=($is_link=='1'); if($if4){?>
					<?php $type= 'link'; ?>
					
				<?php } ?>
				<?php $if4=($is_page=='1'); if($if4){?>
					<?php $type= 'page'; ?>
					
				<?php } ?><!-- Compiling row/row-begin --><?php $a4_class='data'; ?><?php
	$column_idx = 0;
?>
<tr
 class="data"
>
<?php unset($a4_class) ?>
					<td class="clickable"><!-- Compiling link/link-begin --><?php $a6_title='';$a6_type='open';$a6_class='';$a6_action=$type;$a6_id=$objectid;$a6_name=$name;$a6_frame='_self';$a6_modal=false; ?><?php
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
?><a data-url="<?php echo $a6_url ?>" target="<?php echo $a6_frame ?>"<?php if (isset($a6_name)) { ?> data-name="<?php echo $a6_name ?>" name="<?php echo $a6_name ?>"<?php }else{ ?> href="<?php echo $tmp_href ?>" <?php } ?> class="<?php echo $a6_class ?>" data-id="<?php echo @$a6_id ?>" data-type="<?php echo $a6_type ?>" data-action="<?php echo @$a6_action ?>" data-method="<?php echo @$a6_subaction ?>" data-data="<?php echo $tmp_data ?>" <?php if (isset($a6_accesskey)) echo ' accesskey="'.$a6_accesskey.'"' ?>  title="<?php echo encodeHtml($a6_title) ?>"><?php unset($a6_title,$a6_type,$a6_class,$a6_action,$a6_id,$a6_name,$a6_frame,$a6_modal) ?><!-- Compiling text/text-begin --><?php $a7_class='text';$a7_var='name';$a7_maxlength='30';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = isset($$a7_var)?$$a7_var:$langF('UNKNOWN');
		$tmp_text = Text::maxLength( $tmp_text,intval($a7_maxlength),'..',constant('STR_PAD_'.strtoupper($a7_cut)) );
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_var,$a7_maxlength,$a7_escape,$a7_cut) ?><!-- Compiling link/link-end --></a>
					</td>
					<td><!-- Compiling text/text-begin --><?php $a6_class='text';$a6_var='filename';$a6_maxlength='30';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = isset($$a6_var)?$$a6_var:$langF('UNKNOWN');
		$tmp_text = Text::maxLength( $tmp_text,intval($a6_maxlength),'..',constant('STR_PAD_'.strtoupper($a6_cut)) );
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_var,$a6_maxlength,$a6_escape,$a6_cut) ?>
					</td>
					<td>
						<?php include_once( OR_THEMES_DIR.'default/include/html/date/component-date.php') ?><?php component_date($lastchange_date) ?>
						
					</td><!-- Compiling row/row-end --></tr><!-- Compiling list/list-end --><?php } ?><!-- Compiling table/table-end --><?php
	$column_idx = $last_column_idx;
?>
</table>