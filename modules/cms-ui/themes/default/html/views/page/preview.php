
	
		<div class="toolbar-icon">
			<i class="image-icon image-icon--menu-refresh"></i>
			
		</div>
		<div class="clickable">
			<a class="action" target="_self" data-url="<?php echo $preview_url ?>" data-type="popup" data-action="" data-method="preview" data-id="<?php echo OR_ID ?>" data-extra="[]" href="<?php echo Html::url('','','',array()) ?>">
				<i class="image-icon image-icon--menu-open_in_new"></i>
				
				<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'link_open_in_new_window'.'')))); ?></span>
				
			</a>

		</div>
		<iframe name="preview" src="<?php echo $preview_url ?>"></iframe>
		
	