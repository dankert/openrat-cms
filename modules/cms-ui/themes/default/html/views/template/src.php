
	
		
		
		<form name="" target="_self" data-target="view" action="./" data-method="src" data-action="template" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form template" data-async="" data-autosave=""><input type="hidden" name="<?php echo REQ_PARAM_EMBED ?>" value="1" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="template" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="src" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<input type="hidden" name="templateid" value="<?php echo $templateid ?>"/>
			
			<input type="hidden" name="modelid" value="<?php echo $modelid ?>"/>
			
			<textarea name="src" data-extension="" data-mimetype="" data-mode="htmlmixed" class="editor code-editor"><?php echo ${'src'} ?></textarea>
			
		<div class="or-form-actionbar"><input type="submit" class="or-form-btn or-form-btn--primary" value="OK" /></div></form>
	