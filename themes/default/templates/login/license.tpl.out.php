<!-- Compiling output/output-begin --><!-- Compiling newline/newline-begin --><br/>
		<table ><!-- Compiling row/row-begin --><?php $a3_class='headline'; ?><?php
	$column_idx = 0;
?>
<tr
 class="headline"
>
<?php unset($a3_class) ?>
				<td>
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'name'.'')))); ?></span>
					
				</td>
				<td>
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'license'.'')))); ?></span>
					
				</td><!-- Compiling row/row-end --></tr><!-- Compiling list/list-begin --><?php $a3_list='software';$a3_extract=true;$a3_key='list_key';$a3_value='list_value'; ?><?php
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
					<td class="clickable"><!-- Compiling link/link-begin --><?php $a6_title='';$a6_type='external';$a6_url=$url;$a6_class='';$a6_frame='_self';$a6_modal=false; ?><?php
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
?><a data-url="<?php echo $a6_url ?>" target="<?php echo $a6_frame ?>"<?php if (isset($a6_name)) { ?> data-name="<?php echo $a6_name ?>" name="<?php echo $a6_name ?>"<?php }else{ ?> href="<?php echo $tmp_href ?>" <?php } ?> class="<?php echo $a6_class ?>" data-id="<?php echo @$a6_id ?>" data-type="<?php echo $a6_type ?>" data-action="<?php echo @$a6_action ?>" data-method="<?php echo @$a6_subaction ?>" data-data="<?php echo $tmp_data ?>" <?php if (isset($a6_accesskey)) echo ' accesskey="'.$a6_accesskey.'"' ?>  title="<?php echo encodeHtml($a6_title) ?>"><?php unset($a6_title,$a6_type,$a6_url,$a6_class,$a6_frame,$a6_modal) ?>
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
							<!-- Compiling link/link-end --></a>
					</td>
					<td>
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities($license))); ?></span>
						
					</td><!-- Compiling row/row-end --></tr><!-- Compiling list/list-end --><?php } ?>
		</table>