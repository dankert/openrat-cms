
	
		<iframe name="preview" src="<?php echo $preview_url ?>"></iframe>
		
		<div class="clickable">
			<a class="action" target="_self" data-url="<?php echo $preview_url ?>" data-type="popup" data-action="" data-method="<?php echo OR_METHOD ?>" data-id="<?php echo OR_ID ?>" data-extra="[]" href="<?php echo Html::url('','','',array()) ?>">
				<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'link_open_in_new_window'.'')))); ?></span>
				
			</a>

		</div>
	