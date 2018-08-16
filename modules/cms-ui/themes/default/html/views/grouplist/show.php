
	
		
		
		<table width="100%">
			<tr class="headline">
				<td>
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'name'.'')))); ?></span>
					
				</td>
			</tr>
			<?php foreach($el as $list_key=>$list_value){ ?><?php extract($list_value) ?>
				<tr class="data">
					<td data-name="<?php echo $name ?>" data-action="group" data-id="<?php echo $id ?>" class="clickable">
						<img class="" title="" src="./modules/cms-ui/themes/default/images/icon/icon_group.png" />
						
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
						
					</td>
				</tr>
			<?php } ?>
			<tr class="data">
				<td colspan="2" class="clickable">
					<a target="_self" date-name="<?php echo lang('menu_add') ?>" name="<?php echo lang('menu_add') ?>" data-type="dialog" data-action="" data-method="add" data-id="<?php echo OR_ID ?>" data-extra="[]" href="<?php echo Html::url('','add','',array()) ?>">
						<img class="" title="" src="./modules/cms-ui/themes/default/images/icon/add.png" />
						
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('new')))); ?></span>
						
					</a>

				</td>
			</tr>
		</table>
	