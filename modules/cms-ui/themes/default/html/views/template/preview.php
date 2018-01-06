
	
		<iframe src="<?php echo $preview_url ?>"></iframe>
		
		<a class="action" target="_self" data-action="file" data-method="edit" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
			<img class="" title="" src="./modules/cms-ui/themes/default/images/icon/icon/edit.png" />
			
			<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_file_edit'.'')))); ?></span>
			
		</a>

		<a class="action" target="_self" data-action="file" data-method="editvalue" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
			<img class="" title="" src="./modules/cms-ui/themes/default/images/icon/icon/editvalue.png" />
			
			<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_file_editvalue'.'')))); ?></span>
			
		</a>

	