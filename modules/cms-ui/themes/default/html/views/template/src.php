
	
		<div class="headermenu"><div class="toolbar-icon clickable"><a href="javascript:void(0);" title="<?php echo lang('MENU_SRCELEMENT') ?>" data-type="dialog" data-name="<?php echo lang('MENU_SRCELEMENT') ?>" data-method="srcelement"><img src="./themes/default/images/icon/action/srcelement.svg" title="<?php echo lang('MENU_srcelement_DESC') ?>" /><?php echo lang('MENU_srcelement') ?></a></div></div>
		
		<form name="" target="_self" action="<?php echo OR_ACTION ?>" data-method="<?php echo OR_METHOD ?>" data-action="<?php echo OR_ACTION ?>" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="<?php echo OR_ACTION ?>" data-async="" data-autosave=""><input type="submit" class="invisible" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo OR_ACTION ?>" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo OR_METHOD ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<textarea name="src" data-extension="" data-mimetype="" data-mode="htmlmixed" class="editor__code-editor"><?php echo ${'src'} ?></textarea>
			
		<div class="bottom"><div class="command "><input type="button" class="submit ok" value="OK" /></div></div></form>
	