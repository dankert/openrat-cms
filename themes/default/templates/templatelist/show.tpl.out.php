<!-- Compiling output/output-begin -->
		<table width="100%">
			<tr class="headline">
				<td>
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'name'.'')))); ?></span>
					
				</td>
			</tr>
			<?php foreach($templates as $list_key=>$list_value){ ?><?php extract($list_value) ?>
				<tr class="data">
					<td onclick="javascript:openNewAction('<?php echo $name ?>','template','<?php echo $id ?>');">
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
						
					</td>
				</tr>
			<?php } ?>
			<?php $if3=(empty($templates)); if($if3){?>
				<tr>
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_NO_TEMPLATES_AVAILABLE_DESC')))); ?></span>
					
				</tr>
			<?php } ?>
			<tr class="data">
				<td class="clickable" colspan="1">
					<a target="_self" data-type="view" data-action="<?php echo OR_ACTION ?>" data-method="add" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
						<img class="" title="" src="./themes/default/images/icon/add.png" />
						
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('new')))); ?></span>
						
					</a>

				</td>
			</tr>
		</table>