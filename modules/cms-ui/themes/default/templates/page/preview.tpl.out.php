
	
		<iframe name="preview" src="<?php echo $preview_url ?>"></iframe>
		
		<div class="clickable">
			<a class="action" target="_self" data-url="<?php echo $preview_url ?>" data-type="popup" data-action="<?php echo OR_ACTION ?>" data-method="<?php echo OR_METHOD ?>" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
				<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'link_open_in_new_window'.'')))); ?></span>
				
			</a>

		</div>
	