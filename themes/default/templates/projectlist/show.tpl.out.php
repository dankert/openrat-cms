<!-- Compiling output/output-begin -->
		
		
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
					<a target="_self" date-name="<?php echo lang('new') ?>" name="<?php echo lang('new') ?>" data-type="dialog" data-action="<?php echo OR_ACTION ?>" data-method="add" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
						<img class="" title="" src="./themes/default/images/icon/add.png" />
						
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('new')))); ?></span>
						
					</a>

				</td>
			</tr>
		</table>