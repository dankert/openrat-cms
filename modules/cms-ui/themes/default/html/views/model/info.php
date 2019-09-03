
	
		<form name="" target="_self" data-target="view" action="./" data-method="info" data-action="model" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form model" data-async="" data-autosave=""><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="model" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="info" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<span class="headline"><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
			
			<div class="line">
				<div class="label">
					<span><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_NAME')))); ?></span>
					
				</div>
				<div class="input clickable">
					<span><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
					
					<a class="or-link-btn" target="_self" data-type="edit" data-action="model" data-method="prop" data-id="<?php echo OR_ID ?>" data-extra="[]" href="./#/model/">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'edit'.'')))); ?></span>
						
					</a>
				</div>
			</div>
		<div class="or-form-actionbar"></div></form>
	