
	
		<?php $if2=($image); if($if2){?>
			<iframe src="<?php echo $preview_url ?>"></iframe>
			
		<?php } ?>
		<?php if(!$if2){?>
			<div class="clickable">
				<a class="action" target="_self" data-url="<?php echo $preview_url ?>" data-type="popup" data-action="" data-method="<?php echo OR_METHOD ?>" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'LINK_OPEN_IN_NEW_WINDOW'.'')))); ?></span>
					
				</a>

			</div>
		<?php } ?>
	