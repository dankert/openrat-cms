
	
		<table width="100%">
			<tr class="data">
				<td colspan="2">
					<a target="_self" data-action="index" data-method="projectmenu" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
						<span class="text"><?php echo nl2br('OpenRat'); ?></span>
						
					</a>

				</td>
			</tr>
			<?php foreach($applications as $list_key=>$list_value){ ?><?php extract($list_value) ?>
				<tr class="data">
					<td>
						<a target="_self" data-url="<?php echo $url ?>" data-action="" data-method="<?php echo OR_METHOD ?>" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
							
						</a>

					</td>
					<td>
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities($description))); ?></span>
						
					</td>
				</tr>
			<?php } ?>
		</table>
	