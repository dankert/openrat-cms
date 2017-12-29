
	
		<div class="headermenu"><div class="toolbar-icon clickable"><a href="javascript:void(0);" title="<?php echo lang('MENU_ADD') ?>" data-type="dialog" data-name="<?php echo lang('MENU_ADD') ?>" data-method="add"><img src="./themes/default/images/icon/action/add.svg" title="<?php echo lang('MENU_add_DESC') ?>" /><?php echo lang('MENU_add') ?></a></div></div>
		
		<table width="100%">
			<tr class="headline">
				<td>
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'name'.'')))); ?></span>
					
				</td>
			</tr>
			<?php foreach($projects as $list_key=>$list_value){ ?><?php extract($list_value) ?>
				<tr class="data">
					<td class="clickable">
						<a target="_self" date-name="<?php echo $name ?>" name="<?php echo $name ?>" data-type="open" data-action="project" data-method="<?php echo OR_METHOD ?>" data-id="<?php echo $id ?>" href="javascript:void(0);">
							<img class="" title="" src="./themes/default/images/icon/icon_project.png" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(Text::maxLength( $name,30,'..',constant('STR_PAD_BOTH') )))); ?></span>
							
						</a>

					</td>
				</tr>
			<?php } ?>
			<tr class="data">
				<td class="clickable">
					<a target="_self" date-name="<?php echo lang('new') ?>" name="<?php echo lang('new') ?>" data-type="dialog" data-action="" data-method="add" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
						<img class="" title="" src="./themes/default/images/icon/add.png" />
						
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('new')))); ?></span>
						
					</a>

				</td>
			</tr>
		</table>
	