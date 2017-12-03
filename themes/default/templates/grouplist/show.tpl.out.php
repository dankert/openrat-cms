<!-- Compiling output/output-begin -->
		
		
		<table width="100%">
			<tr class="headline">
				<td>
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'name'.'')))); ?></span>
					
				</td>
			</tr>
			<?php foreach($el as $list_key=>$list_value){ ?><?php extract($list_value) ?>
				<tr class="data">
					<td onclick="javascript:openNewAction('<?php echo $name ?>','group','<?php echo $id ?>');">
						<img class="" title="" src="./themes/default/images/icon/icon_group.png" />
						
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
						
					</td>
				</tr>
			<?php } ?>
			<tr class="data">
				<td class="clickable" colspan="2">
					<a target="_self" date-name="<?php echo lang('menu_add') ?>" name="<?php echo lang('menu_add') ?>" data-type="dialog" data-action="<?php echo OR_ACTION ?>" data-method="add" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
						<img class="" title="" src="./themes/default/images/icon/add.png" />
						
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('new')))); ?></span>
						
					</a>

				</td>
			</tr>
		</table>