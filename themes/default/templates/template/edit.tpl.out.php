<!-- Compiling output/output-begin -->
		
		
		<table width="100%">
			<tr class="headline">
				<td>
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'name'.'')))); ?></span>
					
				</td>
				<td>
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'type'.'')))); ?></span>
					
				</td>
			</tr><!-- Compiling list/list-begin --><?php $a3_list='elements';$a3_extract=true;$a3_key='list_key';$a3_value='list_value'; ?><?php
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
				<tr class="data">
					<td onclick="javascript:openNewAction('<?php echo $name ?>','element','<?php echo $id ?>');">
						<img class="image-icon image-icon--element" title="" src="./themes/default/images/icon/element/<?php echo $type ?>.svg" />
						
						<span class="text" title="<?php echo $description ?>"><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
						
					</td>
					<td>
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('EL_'.$type.'')))); ?></span>
						
					</td>
				</tr><!-- Compiling list/list-end --><?php } ?>
			<?php $if3=(empty($el)); if($if3){?>
				<tr>
					<td colspan="2">
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'GLOBAL_NOT_FOUND'.'')))); ?></span>
						
					</td>
				</tr>
			<?php } ?>
			<tr class="data">
				<td class="clickable" colspan="2">
					<a target="_self" data-type="view" data-action="<?php echo OR_ACTION ?>" data-method="addel" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
						<img class="" title="" src="./themes/default/images/icon/add.png" />
						
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_template_addel'.'')))); ?></span>
						
					</a>

				</td>
			</tr>
		</table>
		<fieldset class="<?php echo '1'?" open":"" ?><?php echo '1'?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('src') ?></legend><div>
			<table width="100%">
				<tr class="data">
					<td class="clickable">
						<a target="_self" data-type="view" data-action="<?php echo OR_ACTION ?>" data-method="src" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
							<img class="" title="" src="./themes/default/images/icon/template.png" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'edit'.'')))); ?></span>
							
						</a>

					</td>
				</tr>
			</table>
			<code class="text"><?php echo nl2br(encodeHtml(htmlentities($text))); ?></code>
			
		</div></fieldset>