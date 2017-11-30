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
				<td>
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'name'.'')))); ?></span>
					
				</td><!-- Compiling row/row-end --></tr>
			<?php $if3=(empty('groups')); if($if3){?><!-- Compiling row/row-begin --><?php $a4_class='data'; ?><?php
	$column_idx = 0;
?>
<tr
 class="data"
>
<?php unset($a4_class) ?>
					<td>
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'NOT_FOUND'.'')))); ?></span>
						
					</td><!-- Compiling row/row-end --></tr>
			<?php } ?><!-- Compiling list/list-begin --><?php $a3_list='groups';$a3_extract=false;$a3_key='list_key';$a3_value='group'; ?><?php
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
					<td>
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities($group))); ?></span>
						
					</td><!-- Compiling row/row-end --></tr><!-- Compiling list/list-end --><?php } ?><!-- Compiling table/table-end --><?php
	$column_idx = $last_column_idx;
?>
</table>