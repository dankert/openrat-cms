<!-- Compiling output/output-begin @ Wed, 29 Nov 2017 00:50:50 +0100 --><!-- Compiling header/header-begin @ Wed, 29 Nov 2017 00:50:50 +0100 --><?php $a2_name='';$a2_views='src,remove';$a2_back=false; ?><?php if(!empty($a2_views)) { ?>
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
<?php unset($a2_name,$a2_views,$a2_back) ?><!-- Compiling table/table-begin @ Wed, 29 Nov 2017 00:50:50 +0100 --><?php $a2_width='100%';$a2_space='0px';$a2_padding='0px'; ?><?php
	$last_column_idx = @$column_idx;
	$column_idx = 0;
	$coloumn_widths = array();
	$row_classes    = array();
	$column_classes = array();
?><table class="%class%" cellspacing="0px" width="100%" cellpadding="0px">
<?php unset($a2_width,$a2_space,$a2_padding) ?><!-- Compiling row/row-begin @ Wed, 29 Nov 2017 00:50:50 +0100 --><?php $a3_class='headline'; ?><?php
	$column_idx = 0;
?>
<tr
 class="headline"
>
<?php unset($a3_class) ?>
				<td><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:50:50 +0100 --><?php $a5_class='text';$a5_key='name';$a5_escape=true;$a5_cut='both'; ?><?php
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
				<td><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:50:50 +0100 --><?php $a5_class='text';$a5_key='type';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = $langF($a5_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_key,$a5_escape,$a5_cut) ?>
				</td><!-- Compiling row/row-end @ Wed, 29 Nov 2017 00:50:50 +0100 --></tr><!-- Compiling list/list-begin @ Wed, 29 Nov 2017 00:50:50 +0100 --><?php $a3_list='elements';$a3_extract=true;$a3_key='list_key';$a3_value='list_value'; ?><?php
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
?><?php unset($a3_list,$a3_extract,$a3_key,$a3_value) ?><!-- Compiling row/row-begin @ Wed, 29 Nov 2017 00:50:50 +0100 --><?php $a4_class='data'; ?><?php
	$column_idx = 0;
?>
<tr
 class="data"
>
<?php unset($a4_class) ?>
					<td onclick="javascript:openNewAction('<?php echo $name ?>','element','<?php echo $id ?>');">
						<img class="image-icon image-icon--element" title="" src="./themes/default/images/icon/element/<?php echo $type ?>.svg" />
						<!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:50:50 +0100 --><?php $a6_title=$description;$a6_class='text';$a6_var='name';$a6_escape=true;$a6_cut='both'; ?><?php
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = isset($$a6_var)?$$a6_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_title,$a6_class,$a6_var,$a6_escape,$a6_cut) ?>
					</td>
					<td><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:50:50 +0100 --><?php $a6_class='text';$a6_key=$type;$a6_prefix='EL_';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_key = $a6_prefix.$a6_key;
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_key,$a6_prefix,$a6_escape,$a6_cut) ?>
					</td><!-- Compiling row/row-end @ Wed, 29 Nov 2017 00:50:50 +0100 --></tr><!-- Compiling list/list-end @ Wed, 29 Nov 2017 00:50:50 +0100 --><?php } ?>
			<?php $if3=(empty('el')); if($if3){?><!-- Compiling row/row-begin @ Wed, 29 Nov 2017 00:50:50 +0100 --><?php
	$column_idx = 0;
?>
<tr
>

					<td colspan="2"><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:50:50 +0100 --><?php $a6_class='text';$a6_key='GLOBAL_NOT_FOUND';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_key,$a6_escape,$a6_cut) ?>
					</td><!-- Compiling row/row-end @ Wed, 29 Nov 2017 00:50:50 +0100 --></tr>
			<?php } ?><!-- Compiling row/row-begin @ Wed, 29 Nov 2017 00:50:50 +0100 --><?php $a3_class='data'; ?><?php
	$column_idx = 0;
?>
<tr
 class="data"
>
<?php unset($a3_class) ?>
				<td class="clickable" colspan="2"><!-- Compiling link/link-begin @ Wed, 29 Nov 2017 00:50:50 +0100 --><?php $a5_title='';$a5_type='view';$a5_class='';$a5_subaction='addel';$a5_frame='_self';$a5_modal=false; ?><?php
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
						<!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:50:50 +0100 --><?php $a6_class='text';$a6_key='menu_template_addel';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_key,$a6_escape,$a6_cut) ?><!-- Compiling link/link-end @ Wed, 29 Nov 2017 00:50:50 +0100 --></a>
				</td><!-- Compiling row/row-end @ Wed, 29 Nov 2017 00:50:50 +0100 --></tr><!-- Compiling table/table-end @ Wed, 29 Nov 2017 00:50:50 +0100 --><?php
	$column_idx = $last_column_idx;
?>
</table>
		<fieldset class="<?php echo 1?" open":"" ?><?php echo 1?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('src') ?></legend><div><!-- Compiling table/table-begin @ Wed, 29 Nov 2017 00:50:50 +0100 --><?php $a3_width='100%';$a3_space='0px';$a3_padding='0px'; ?><?php
	$last_column_idx = @$column_idx;
	$column_idx = 0;
	$coloumn_widths = array();
	$row_classes    = array();
	$column_classes = array();
?><table class="%class%" cellspacing="0px" width="100%" cellpadding="0px">
<?php unset($a3_width,$a3_space,$a3_padding) ?><!-- Compiling row/row-begin @ Wed, 29 Nov 2017 00:50:50 +0100 --><?php $a4_class='data'; ?><?php
	$column_idx = 0;
?>
<tr
 class="data"
>
<?php unset($a4_class) ?>
					<td class="clickable"><!-- Compiling link/link-begin @ Wed, 29 Nov 2017 00:50:50 +0100 --><?php $a6_title='';$a6_type='view';$a6_class='';$a6_subaction='src';$a6_frame='_self';$a6_modal=false; ?><?php
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
?><a data-url="<?php echo $a6_url ?>" target="<?php echo $a6_frame ?>"<?php if (isset($a6_name)) { ?> data-name="<?php echo $a6_name ?>" name="<?php echo $a6_name ?>"<?php }else{ ?> href="<?php echo $tmp_href ?>" <?php } ?> class="<?php echo $a6_class ?>" data-id="<?php echo @$a6_id ?>" data-type="<?php echo $a6_type ?>" data-action="<?php echo @$a6_action ?>" data-method="<?php echo @$a6_subaction ?>" data-data="<?php echo $tmp_data ?>" <?php if (isset($a6_accesskey)) echo ' accesskey="'.$a6_accesskey.'"' ?>  title="<?php echo encodeHtml($a6_title) ?>"><?php unset($a6_title,$a6_type,$a6_class,$a6_subaction,$a6_frame,$a6_modal) ?>
							<img class="" title="" src="./themes/default/images/icon/template.png" />
							<!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:50:50 +0100 --><?php $a7_class='text';$a7_key='edit';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_key,$a7_escape,$a7_cut) ?><!-- Compiling link/link-end @ Wed, 29 Nov 2017 00:50:50 +0100 --></a>
					</td><!-- Compiling row/row-end @ Wed, 29 Nov 2017 00:50:50 +0100 --></tr><!-- Compiling table/table-end @ Wed, 29 Nov 2017 00:50:50 +0100 --><?php
	$column_idx = $last_column_idx;
?>
</table><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:50:50 +0100 --><?php $a3_class='text';$a3_var='text';$a3_escape=false;$a3_type='code';$a3_cut='both'; ?><?php
		$a3_title = '';
		$tmp_tag = 'code';
?><<?php echo $tmp_tag ?> class="<?php echo $a3_class ?>" title="<?php echo $a3_title ?>"><?php
		$langF = $a3_escape?'langHtml':'lang';
		$tmp_text = isset($$a3_var)?$$a3_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a3_class,$a3_var,$a3_escape,$a3_type,$a3_cut) ?>
		</div></fieldset>